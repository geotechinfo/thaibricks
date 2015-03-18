<?php

class Amenity extends Eloquent {
	protected $table = 'pr_amenities';
	protected $primaryKey = 'amenity_id';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	
	public function getlist(){
		$return =array();
		//$counter_parent = 0;
		foreach (DB::table($this->table)->get() as $amenity){
			$return[$amenity->amenity_id] = $amenity->amenity_title;
		}
		return $return;
	}

	function insert_property_amenity($insert){
		return DB::table('pr_property_amenities')->insertGetId($insert);		
	}
	function delete_property_amenity($id=0){
		return DB::statement("DELETE FROM pr_property_amenities WHERE property_id=".$id);
	}
}
