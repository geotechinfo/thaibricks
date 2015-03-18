<?php

class Property extends Eloquent {
	protected $fillable = ['user_id', 'deal_id', 'type_id', 'title', 'description', 'location', 'location_sub', 'address', 'price', 'phone', 'email'];

	protected $table = 'pr_properties';
	protected $primaryKey = 'property_id';
	public $timestamps = false;
	public $limit = null;
	public $transport=null;
	public $sub_transport=null;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	public function getlist_deals(){
		$return =array('0'=>'Select Transaction Type');
		foreach (DB::table('pr_deals')->get() as $value){
			$return[$value->deal_id] = $value->deal_name;
		}
		return $return;
	}
	
	public function getlist_types(){
		$return =array('0'=>'Select Property Type');
		foreach (DB::table('pr_types')->get() as $parent){
			if($parent->parent_id == 0){
				$rule = ['parent_id' => $parent->type_id];
				foreach (DB::table('pr_types')->where($rule)->get() as $child){
					$return[$parent->type_name][$child->type_id] = $child->type_name;
				}
			}
		}
		return $return;
	}
	 	 
	 public function get_attributes($deal_id, $type_id){
		/*$relations = DB::table('pr_relations')
			->join('pr_deals', 'pr_deals.deal_id', '=', 'pr_relations.deal_id')
			->join('pr_types', 'pr_types.type_id', '=', 'pr_relations.type_id')
			->join('pr_groups', 'pr_groups.group_id', '=', 'pr_relations.group_id')
			->join('pr_attributes', 'pr_attributes.attribute_id', '=', 'pr_relations.attribute_id')
			->where('pr_relations.deal_id', '=', 1)
			->where('pr_relations.type_id', '=', 1)
		->get();*/	
		$relations = DB::select("
			SELECT
			`pr_groups`.`group_id`,
			`pr_groups`.`group_name`,
			`pr_attributes`.`attribute_id`,
			`pr_attributes`.`attribute_name`,
			`pr_attributes`.`attribute_type`
			FROM
			`pr_relations`, `pr_groups`, `pr_attributes`
			WHERE
			`pr_relations`.`deal_id` = ".$deal_id."
			AND
			`pr_relations`.`type_id` = ".$type_id."
			AND
			`pr_relations`.`group_id` = `pr_groups`.`group_id`
			AND
			`pr_relations`.`attribute_id` = `pr_attributes`.`attribute_id`
		");
		$return = array();

		$group_counter = -1;
		$group_lastid = null;
		foreach ($relations as $group){
			if($group_lastid != $group->group_id){
				$group_lastid = $group->group_id;
				$group_counter++;
			}
			$return[$group_counter]["group_name"] = $group->group_name;
			
			$attribute_counter = -1;
			$attribute_lastid = null;
			foreach ($relations as $attribute){
				if($group->group_id == $attribute->group_id){
					if($attribute_lastid != $attribute->attribute_id){
						$attribute_lastid = $attribute->attribute_id;
						$attribute_counter++;
					}
					$return[$group_counter]["attributes"][$attribute_counter]["attribute_id"] = $attribute->attribute_id;
					$return[$group_counter]["attributes"][$attribute_counter]["attribute_name"] = $attribute->attribute_name;
					$return[$group_counter]["attributes"][$attribute_counter]["attribute_type"] = $attribute->attribute_type;
				}
			}
		}
		
		return $return;
	}
	
	public function insert_value($property_id, $attribute_id, $value){
		DB::statement("INSERT INTO `pr_values` SET `property_id`=".$property_id.", `attribute_id`=".$attribute_id.", `attribute_value`='".$value."'");
	}
	public function delete_values($property_id){
		DB::statement("DELETE FROM `pr_values` WHERE `property_id`=".$property_id);
	}

	public function delete_property_transport($property_id){
		DB::statement("DELETE FROM `pr_property_transport` WHERE `property_id`=".$property_id);
	}
	public function insert_property_transport($arr=array()){
		if(count($arr)){
			$str = '';
			foreach ($arr as $key => $value) {
				$str = $str."`$key`='$value',";
			}
			$str = trim($str,',');
			DB::statement("INSERT INTO `pr_property_transport` SET $str");
		}
	}
	public function get_properties($user_id=null, $property_id=null, $location_id=null, $sublocation_id=null,$bedroom=array(),$types=array(),$price_range=array(),$additional=array()){
		$property_sql = "";
		if($user_id != null){
			$property_sql .= " AND `pr_properties`.`user_id` = ".$user_id;			
		}
		
		if($property_id != null){
			$property_sql .= " AND `pr_properties`.`property_id` = ".$property_id;
		}
		if($location_id != null){
			$property_sql .= " AND `pr_properties`.`location` = '".$location_id."'";
		}
		if($sublocation_id != null){
			$property_sql .= " AND `pr_properties`.`location_sub` = '".$sublocation_id."'";
		}
		if(count($types)){
			$property_sql .= " AND 	`pr_properties`.`type_id` IN (".implode(',',$types).")";
		}
		if(count($price_range)){
			if(count($price_range)==1){
				$property_sql .= " AND 	`pr_properties`.`price` < ".$price_range[0];
			}
			if(count($price_range)==2){
				$property_sql .= " AND 	`pr_properties`.`price` BETWEEN ".$price_range[0]." AND ".$price_range[1];
			}			
		}
		if(count($bedroom)){
			$property_sql .= " AND 	`pr_properties`.`property_id` IN (SELECT `property_id` FROM `pr_values` WHERE `attribute_id` =1 AND `attribute_value` IN(".implode(',',$bedroom)."))";
		}
		if($user_id!=Auth::User()->user_id && $property_id==null && !isset($additional['property_code']) && !Session::has('admin')){
				$property_sql .= "  AND  `pr_properties`.`is_tenancy` = 0";
				$property_sql .=" AND `pr_properties`.`status` = 1";
		}
		if(count($additional)){
			foreach ($additional as $col => $val) {
				$property_sql .=" AND $col= '".$val."'";
			}
		}
		if($this->transport!=null && $this->sub_transport==null){
			//die('ok');
			$property_sql = $property_sql. " AND property_id in (SELECT 
		DISTINCT pr_property_transport.property_id
FROM `pr_property_transport` 
LEFT JOIN pr_location_transports ON pr_location_transports.transport_id = pr_property_transport.transport_id AND pr_location_transports.type = 1
LEFT JOIN pr_location_transports p ON p.transport_id = pr_location_transports.parent_id
WHERE pr_location_transports.parent_id in(".$this->transport."))";

		}
		if($this->sub_transport!=null && is_array($this->sub_transport)){
			//die('ok');
			$property_sql = $property_sql. " AND property_id in (SELECT 
		DISTINCT pr_property_transport.property_id
FROM `pr_property_transport` 
WHERE pr_property_transport.transport_id in(".implode(',', $this->sub_transport)."))";

		}
	  $sql = "
			SELECT
			`pr_properties`.*,
			`location`.`location_name` AS `location_name`,
			`location_sub`.`location_name` AS `locationsub_name`,
			`ac_users`.`first_name`,
			`ac_users`.`last_name`,
			`ac_users`.`user_code`
			FROM
			`pr_properties`
			INNER JOIN
			`ac_users`
			ON
			`pr_properties`.`user_id` = `ac_users`.`user_id`
			LEFT JOIN
			`pr_locations` AS `location`
			ON
			`location`.`location_id` = `pr_properties`.`location`
			LEFT JOIN
			`pr_locations` AS `location_sub`
			ON
			`location_sub`.`location_id` = `pr_properties`.`location_sub`
			WHERE
			1 = 1
			".$property_sql."
			ORDER BY
			`pr_properties`.`property_id` DESC
		";
		//echo $sql;
		if($this->limit!=null && $this->limit>0){

			$sql = $sql." Limit 0, ".$this->limit;
			$this->limit= null;
		}
		$properties = DB::select($sql);

		$returns = array();
		foreach($properties as $key=>$property){
			$returns[$key] = $property;

			$attributes = DB::select("
				SELECT
				`pr_values`.*,
				`pr_attributes`.*
				FROM
				`pr_values`
				INNER JOIN
				`pr_attributes`
				ON
				`pr_attributes`.`attribute_id` = `pr_values`.`attribute_id`
				WHERE
				`pr_values`.`property_id`=".$property->property_id."
			");
			$returns[$key]->attributes = $attributes;
			
			$alltransport = DB::select('SELECT * FROM pr_location_transports WHERE location_id = '.$property->location);
			foreach ($alltransport as $ka => $va) {
				$alltransport[$ka]->Child= DB::select('SELECT * FROM pr_location_transports WHERE parent_id = '.$va->transport_id);
			}
			$trans = DB::select("
				SELECT 
						ppt.transport_id,
						ppt.distance
				FROM 
					pr_property_transport ppt
				WHERE ppt.property_id = ".$property->property_id
				);
			$transport_distance = array();
			foreach ($trans as $kt => $vt) {
				$transport_distance[$vt->transport_id]=$vt->distance;
			}
			$returns[$key]->transports = $alltransport;
			$returns[$key]->selected_transports = $transport_distance;

			$media = DB::select("
				SELECT
				`pr_media`.*
				FROM
				`pr_media`
				WHERE
				`pr_media`.`property_id`=".$property->property_id."
			");
			if(count($media)==0){
				$default=new stdClass();
				$default->media_data='no_image.png';
				$media[0] = $default;	
			}

			$returns[$key]->media = $media;

			$sql = "SELECT * FROM pr_property_amenities LEFT JOIN pr_amenities ON pr_amenities.amenity_id = pr_property_amenities.amenity_id WHERE property_id = ".$property->property_id;
			$amenity_ids = array();
			$amenities = array();

			foreach (DB::select($sql) as $k => $v) {
				//pr($value->amenity_id);
				$amenities[$v->amenity_id]['amenity_icon'] =$v->amenity_icon; 
				$amenities[$v->amenity_id]['amenity_title'] =$v->amenity_title; 
				$amenity_ids[$k]=$v->amenity_id;
			}
			//pr($amenities);
			$returns[$key]->amenity_ids = $amenity_ids;
			$returns[$key]->amenities = $amenities;
		}
		return $returns;
	}

	function activate($ids=array()){
		//pr(implode(',',$ids),1);
		if(count($ids)){
			echo $sql = "UPDATE `pr_properties` SET `status` = 1 WHERE `property_id` IN(".implode(',',$ids).")";
			return DB::statement($sql);
		}else{
			return 0;
		}
	}
}
