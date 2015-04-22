<?php

class Advertise extends Eloquent {
	protected $table = 'ad_advertisements';
	public $timestamps = false;
	
	
	public function get_list($conditions=array()){
		
		$list = DB::table($this->table)
					->leftJoin('ad_packages','ad_packages.ad_package_id','=','ad_advertisements.ad_package_id')
					->leftJoin('pr_locations','pr_locations.location_id','=','ad_packages.location_id');
					
		if(isset($conditions['where']))	{
			$list->where($conditions['where']);
		}
		if(isset($conditions['whereIn']) && count($conditions['whereIn'])){
			foreach ($conditions['whereIn'] as $field => $array) {
				if(count($array)){
					$list->whereIn($field,$array);
				}
				
			}
			
		}		
		$list->orderBy('advertisement_id','DESC');
		return $list->get();
	}
	
	
	public function get_location($is_select_list=0){

		$list =  DB::table('pr_locations')->where('parent_id','=',0)->get();
		$rt = array();
		if($is_select_list==1){
			$rt['']='For Home Page';
		}
		foreach ($list as $k=>$v){
			$rt[$v->location_id] = $v->location_name;
						
		}
		return $rt;
	}

	public function get_adpackages($condi=array()){	
			
			return DB::table('ad_packages')
						->leftJoin('pr_locations','pr_locations.location_id','=','ad_packages.location_id')
						->where($condi)
						->orderBy('ad_package_id','DESC')
						->get();
						
	}

	public function get_adpackages_list($condi=array(),$is_select_list=0){		
		$list = DB::table('ad_packages')->where($condi)->get();
		
		$rt = array();
		if($is_select_list==1){
			$rt['']='Select Packages';
		}
		foreach ($list as $k=>$v){
			$rt[$v->ad_package_id] = $v->package_name;						
		}
		return $rt;
	}

	function save_package($p = array()){
			if(isset($p['ad_package_id']) && $p['ad_package_id']>0){	
				$update = $p;	
				return DB::table('ad_packages')->where('ad_package_id', $update['ad_package_id'])->update($update);
			}else{
				$insert = $p;	
				$c = DB::table('ad_packages')->where(array('location_id'=>$p['location_id'],'ad_type'=>$p['ad_type'],'duration'=>$p['duration']))->count();
				if($c==0){								
					return DB::table('ad_packages')->insertGetId($insert);
				}else{
					return -1;
				}				
			}
		
	}

	function save_advertisement($p = array()){
		if(isset($p['advertisement_id']) && $p['advertisement_id']>0){	
			$update = $p;	
			return DB::table('ad_advertisements')->where('advertisement_id', $update['advertisement_id'])->update($update);
		}else{
			$insert['admin_id'] = (isset($p['admin_id'])?$p['admin_id']:0);
			$insert['ad_package_id'] = (isset($p['ad_package_id'])?$p['ad_package_id']:0);
			$insert['image_file'] = (isset($p['image_file'])?$p['image_file']:'');
			$insert['start_date'] = (isset($p['start_date'])?$p['start_date']:NULL);
			$insert['end_date'] = (isset($p['end_date'])?$p['end_date']:NULL);
			$insert['grace_period'] = (isset($p['grace_period'])?$p['grace_period']:0);
			$insert['type'] = (isset($p['type'])?$p['type']:0);
			$insert['ad_status'] = (isset($p['ad_status'])?$p['ad_status']:1);
			$insert['property_id'] = (isset($p['property_id'])?$p['property_id']:0);
			$insert['external_link'] = (isset($p['external_link'])?$p['external_link']:'');
			$insert['google_ads'] = (isset($p['google_ads'])?$p['google_ads']:'');
			$insert['description'] = (isset($p['description'])?$p['description']:'');
			return DB::table('ad_advertisements')->insertGetId($insert);			
		}		
	}

	function save_payment($p = array()){
		if(isset($p['payment_id']) && $p['payment_id']>0){	
			$update = $p;	
			return DB::table('ad_payment')->where('payment_id', $update['payment_id'])->update($update);			
		}else{
			$insert['advetisement_id'] = (isset($p['advetisement_id'])?$p['advetisement_id']:0);
			$insert['start_date'] = (isset($p['start_date'])?$p['start_date']:NULL);
			$insert['end_date'] = (isset($p['end_date'])?$p['end_date']:NULL);
			$insert['price'] = (isset($p['price'])?$p['price']:0);
			$insert['discount_percentage'] = (isset($p['discount_percentage'])?$p['discount_percentage']:0);
			$insert['discounted_price'] = (isset($p['discounted_price'])?$p['discounted_price']:0);
			return DB::table('ad_payment')->insertGetId($insert);
		}		
	}

	function update_package($p = array(),$conditions=array()){
			return DB::table('ad_packages')->where($conditions)->update($p);		
	}
	
}
