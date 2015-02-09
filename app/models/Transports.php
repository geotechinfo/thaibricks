<?php

class Transport extends Eloquent {
	protected $table = 'pr_location_transports';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	public function location()
	{
		return $this->belongsTo('Location', 'location_id', 'location_id');
	}
	
	public function getlist_transports(){
		$return =array();
		$counter_parent = 0;
		foreach (DB::table('pr_transports')->get() as $parent){
			$return[$counter_parent]["transport_id"] = $parent->transport_id;
			$return[$counter_parent]["transport_name"] = $parent->transport_name;
			$return[$counter_parent]["transport_sub"] = array();
			if($parent->parent_id == 0){
				$counter_child = 0;
				$rule = ['parent_id' => $parent->transport_id];
				foreach (DB::table('pr_transports')->where($rule)->get() as $child){
					$return[$counter_child]["transport_id"] = $parent->transport_id;
					$return[$counter_child]["transport_name"] = $parent->transport_name;
					$counter_child++;
				}
			}
			$counter_parent++;
		}
		return DB::table('pr_transports')->get();
	}
}
