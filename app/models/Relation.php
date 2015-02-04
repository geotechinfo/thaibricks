<?php

class Relation extends Eloquent {
	protected $table = 'pr_relations';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	/*public function samples(){
		return $this->hasOne('Sample');
	}
	public function samples(){
		return $this->hasMany('Sample');
	}
	public function samples(){
		return $this->belongsTo('Sample');
	}*/
	public function deals(){
		$return =array();
		foreach (DB::table('pr_deals')->get() as $value){
			$return[$value->deal_id] = $value->deal_name;
		}
		return $return;
	}
	
	public function types(){
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
	
	public function groups(){
		$return =array();
		foreach (DB::table('pr_groups')->get() as $parent){
			if($parent->parent_id == 0){
				$has_child = false;
				$rule = ['parent_id' => $parent->group_id];
				foreach (DB::table('pr_groups')->where($rule)->get() as $child){
					$has_child = true;
					$return[$parent->group_name][$child->group_id] = $child->group_name;
				}
				if($has_child == false){
					$return[$parent->group_id] = $parent->group_name;
				}
			}
		}
		return $return;
	}
	
	public function attributes(){
		$return =array();
		foreach (DB::table('pr_attributes')->get() as $value){
			$return[$value->attribute_id] = $value->attribute_name;
		}
		return $return;
	}
	
	public function relations(){
		$relations = DB::table('pr_relations')
			->join('pr_deals', 'pr_deals.deal_id', '=', 'pr_relations.deal_id')
			->join('pr_types', 'pr_types.type_id', '=', 'pr_relations.type_id')
			->join('pr_groups', 'pr_groups.group_id', '=', 'pr_relations.group_id')
			->join('pr_attributes', 'pr_attributes.attribute_id', '=', 'pr_relations.attribute_id')
		->get();	
		$return = array();

		$deal_counter = -1;
		$deal_lastid = null;
		foreach ($relations as $deal){
			if($deal_lastid != $deal->deal_id){
				$deal_lastid = $deal->deal_id;
				$deal_counter++;
			}
			$return[$deal_counter]["text"] = $deal->deal_name;
			
			$type_counter = -1;
			$type_lastid = null;
			foreach ($relations as $type){
				if($type_lastid != $type->type_id){
					$type_lastid = $type->type_id;
					$type_counter++;
				}
				$return[$deal_counter]["nodes"][$type_counter]["text"] = $type->type_name;
				
				$group_counter = -1;
				$group_lastid = null;
				foreach ($relations as $group){
					if($group_lastid != $group->group_id){
						$group_lastid = $group->group_id;
						$group_counter++;
					}
					$return[$deal_counter]["nodes"][$type_counter]["nodes"][$group_counter]["text"] = $group->group_name;
					
					$attribute_counter = -1;
					foreach ($relations as $attribute){
						$attribute_counter ++;
						$return[$deal_counter]["nodes"][$type_counter]["nodes"][$group_counter]["nodes"][$attribute_counter]["text"] = $attribute->attribute_name;
					}
				}
			}
		}
		
		return $return;
	}
}
