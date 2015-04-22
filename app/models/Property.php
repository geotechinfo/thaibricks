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
		$return =array(''=>'Select Transaction Type');
		//$return =array(''=>'Select Transaction Type');
		foreach (DB::table('pr_deals')->get() as $value){
			$return[$value->deal_id] = $value->deal_name;
		}
		return $return;
	}
	
	public function getlist_types(){
		$return =array('0'=>'Select Property Type');
		//$return =array(''=>'Select Property Type');
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
	public function get_properties($query_set=array()){
		$property_sql = "";
		//pr($query_set);
		if(isset($query_set['user_id'])){
			$property_sql .= " AND `pr_properties`.`user_id` = ".$query_set['user_id'];			
		}
		if(isset($query_set['type_id']) && count($query_set['type_id'])){
			$property_sql .= " AND `pr_properties`.`type_id` IN (".implode(',',$query_set['type_id']).")";			
		}
		if(isset($query_set['deal_id']) && count($query_set['deal_id'])){
			$property_sql .= " AND `pr_properties`.`deal_id` IN (".implode(',',$query_set['deal_id']).")";		
		}

		if(isset($query_set['property_id'])){
			$property_sql .= " AND `pr_properties`.`property_id` = ".$query_set['property_id'];
		}
		if(isset($query_set['property_code']) && $query_set['property_code']!=''){
			$property_sql .= " AND `pr_properties`.`property_code` = '".$query_set['property_code']."'";
		}
		if(isset($query_set['property_ignore'])){
			$property_sql .= " AND `pr_properties`.`property_id` != '".$query_set['property_id']."'";
		}

		if(isset($query_set['location_id']) && $query_set['location_id']!=''){
			$property_sql .= " AND `pr_properties`.`location` = '".$query_set['location_id']."'";
		}
		if(isset($query_set['sublocation_id'])){
			$property_sql .= " AND `pr_properties`.`location_sub` = '".$query_set['sublocation_id']."'";
		}
		
		if(isset($query_set['price_range'])){
			if(count($query_set['price_range'])==1 && isset($query_set['price_range'][0]) && $query_set['price_range'][0]>0){
				$property_sql .= " AND 	`pr_properties`.`price` < ".$query_set['price_range'][0];
			}
			if(count($query_set['price_range'])==2){
				$property_sql .= " AND 	`pr_properties`.`price` BETWEEN ".$query_set['price_range'][0]." AND ".$query_set['price_range'][1];
			}			
		}
		if(isset($query_set['bedroom']) && count($query_set['bedroom'])){
			$property_sql .= " AND 	`pr_properties`.`property_id` IN (SELECT `property_id` FROM `pr_values` WHERE `attribute_id` =1 AND `attribute_value` IN(".implode(',',$query_set['bedroom'])."))";
		}

		if(isset($query_set['property_status'])){
			$property_sql .=" AND `pr_properties`.`status` = ".$query_set['property_status'];
		}
		if(isset($query_set['is_tanency']) && is_array($query_set['is_tanency'])){
			$property_sql .= "  AND  `pr_properties`.`is_tenancy` IN (".implode(',',$query_set['is_tanency']).")";
		}else{
			$property_sql .= "  AND  `pr_properties`.`is_tenancy` = 0";
		}

		if(isset($query_set['is_hot'])){
			$property_sql .=" AND `pr_properties`.`is_hot` = ".$query_set['is_hot'];
		}

		

		//pr($additional);
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
			`types`.`type_name` AS `type_name`,
			`location`.`location_name` AS `location_name`,
			`location_sub`.`location_name` AS `locationsub_name`,
			`ac_users`.`first_name`,
			`ac_users`.`last_name`,
			`ac_users`.`user_code`,
			`pr_deals`.`deal_name`,
			(Select `parent_id` FROM `pr_types` WHERE `type_id` = `pr_properties`.`type_id`) as `type_parent_id`
			FROM
			`pr_properties`
				INNER JOIN	`ac_users`	ON	`pr_properties`.`user_id` = `ac_users`.`user_id`
				LEFT JOIN	`pr_types` AS `types` ON `types`.`type_id` = `pr_properties`.`type_id`
				LEFT JOIN	`pr_locations` AS `location` ON	`location`.`location_id` = `pr_properties`.`location`
				LEFT JOIN	`pr_locations` AS `location_sub` ON	`location_sub`.`location_id` = `pr_properties`.`location_sub`
				LEFT JOIN	`pr_deals` AS `pr_deals` ON	`pr_deals`.`deal_id` = `pr_properties`.`deal_id`			
			WHERE
			1 = 1
			".$property_sql."
			ORDER BY
			`pr_properties`.`property_id` DESC
		";
		//echo $sql."<hr/>";die;
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
