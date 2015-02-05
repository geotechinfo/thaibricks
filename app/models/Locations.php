<?php

class Location extends Eloquent {
	protected $table = 'pr_locations';
	public $timestamps = false;
	protected $primaryKey = 'location_id';
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	function subprop(){
		return $this->hasMany('Location','parent_id','location_id');
	}
	function subpropparent(){
		return $this->belongsTo('Location','parent_id','location_id');
	}

	public function get_location_with_sub($parent_id = 0){

		$list =  DB::table('pr_locations')->where('parent_id','=',$parent_id)->get();
		$rt = array();
		foreach ($list as $k=>$v){
			$rt[$v->location_id] = (array)$v;
			$rt[$v->location_id]['SubLocation'] = $this->get_location_with_sub($v->location_id);
			$transport = DB::table('pr_location_transports')->where('location_id','=',$v->location_id)->get();
			foreach ($transport as $kt => $vt) {
				$rt[$v->location_id]['Transport'][$vt->transport_id]=(array)$vt;
				$rt[$v->location_id]['Transport'][$vt->transport_id]['Child']=(array)DB::table('pr_location_transports')->where('parent_id','=',$vt->transport_id)->get();
			}
			//$rt[$v->location_id]['Transport'] = $transport;
		}
		return $rt;
	}
	

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
