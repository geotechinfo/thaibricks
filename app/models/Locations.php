<?php

class Location extends Eloquent {
	protected $table = 'pr_locations';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 	
	public function getlist_locations(){
		$return =array();
		$counter_parent = 0;
		foreach (DB::table('pr_locations')->get() as $parent){
			$return[$counter_parent]["location_id"] = $parent->location_id;
			$return[$counter_parent]["location_name"] = $parent->location_name;
			$return[$counter_parent]["location_sub"] = array();
			if($parent->parent_id == 0){
				$counter_child = 0;
				$rule = ['parent_id' => $parent->location_id];
				foreach (DB::table('pr_locations')->where($rule)->get() as $child){
					$return[$counter_child]["location_id"] = $parent->location_id;
					$return[$counter_child]["location_name"] = $parent->location_name;
					$counter_child++;
				}
			}
			$counter_parent++;
		}
		return DB::table('pr_locations')->get();
	}
}
