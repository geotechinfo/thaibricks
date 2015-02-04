<?php

class Property extends Eloquent {
	protected $fillable = ['user_id', 'deal_id', 'type_id', 'title', 'description', 'location', 'location_sub', 'address', 'price', 'phone', 'email'];

	protected $table = 'pr_properties';
	protected $primaryKey = 'property_id';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public function getlist_deals(){
		$return =array();
		foreach (DB::table('pr_deals')->get() as $value){
			$return[$value->deal_id] = $value->deal_name;
		}
		return $return;
	}
	
	public function getlist_types(){
		$return =array();
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
	
	public function get_properties($user_id=null, $property_id=null, $location_id=null, $sublocation_id=null){
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
	
		$properties = DB::select("
			SELECT
			`pr_properties`.*,
			`ac_users`.`first_name`,
			`ac_users`.`last_name`
			FROM
			`pr_properties`,
			`ac_users`
			WHERE
			`pr_properties`.`user_id`=`ac_users`.`user_id`
			".$property_sql."
			ORDER BY
			`pr_properties`.`property_id` DESC
		");

		$returns = array();
		foreach($properties as $key=>$property){
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
			
			$returns[$key] = $property;
			$returns[$key]->attributes = $attributes;
		}
		
		$returns = array();
		foreach($properties as $key=>$property){
			$media = DB::select("
				SELECT
				`pr_media`.*
				FROM
				`pr_media`
				WHERE
				`pr_media`.`property_id`=".$property->property_id."
			");
			
			$returns[$key] = $property;
			$returns[$key]->media = $media;
		}
		return $returns;
	}
}
