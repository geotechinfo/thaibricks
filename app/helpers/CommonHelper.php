<?php
class CommonHelper{
	static function dateToUx($date){
		list($year, $month, $day) = explode("-", $date);
		if($year!=0 || $month!=0 || $day!=0)
		{
			return $day."/".$month."/".$year;
		}else{
			return '';
		}
	}
	static function dateToDb($date){
		list($day, $month, $year) = explode("/", $date);
		return $year."-".$month."-".$day;
	}
	static function propertyTypes(){
		$properties = new Property();
		return $properties->getlist_types();
	}
	static function dealTypes(){
		$properties = new Property();
		return $properties->getlist_deals();
	}
	static function change_bool($con = array()){

		if(isset($con['table']) && $con['table']!=='' && isset($con['field']) && $con['field']!=''){
			$sql = "UPDATE ".$con['table']." SET ".$con['field']."=IF(".$con['field']."=1,0,1) WHERE 1=1 ";
			if(isset($con['where'])){
				foreach ($con['where'] as $k => $v) {
					$sql = $sql." AND ".$k."=".$v;
				}
			}
			return DB::statement($sql);
		}else{
			return false;
		}		
	} 

	static function getLocation($i=0){
		$rt = array();
		if($i!=0){
			$rt[''] = 'Select Location';
		}
		$list = DB::table('pr_locations')->where('parent_id','=','0')->get();
		foreach($list as $k=>$v){
			$rt[$v->location_id] = $v->location_name;
		}
		return $rt;
	} 

	static function getAds($condi=array('ad_type'=>1,'location_id'=>0,'location_name'=>''),$limit=''){
			
		if(isset($condi['location_name']) && $condi['location_name']!=''){
			$condi['location_id'] = DB::table('pr_locations')->where('location_name','=',$condi['location_name'])->first()->location_id;
			unset($condi['location_name']);
		}
		$ads['1'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'default_premium_banner.jpg',
						'description'=>'<h3>House For Sale In Prachuap Khiri Khan</h3><p>he villa is located 6 km west of Hua Hin city center in green lush surroundings.</p>',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Premium Banner',
						'title'=>'',
						'property_code'=>''
					);
		$ads['2'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'featured_banner_1.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Featured Banner',
						'title'=>'',
						'property_code'=>''
					);
		$ads['3'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'featured_banner_2.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Featured Banner',
						'title'=>'',
						'property_code'=>''
					);
		$ads['4'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'featured_banner_3.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Featured Banner',
						'title'=>'',
						'property_code'=>''
					);
		$ads['5'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'featured_banner_4.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Featured Banner',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad1.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad2.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad3.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad4.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad5.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad6.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad7.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad8.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad9.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);
		$ads['6'][] = (object)array(
						'advertisement_id'=>0,
						'admin_id'=>'0',
						'ad_package_id'=>'0',
						'image_file'=>'ad10.jpg',
						'description'=>'',
						'start_date'=>'',
						'end_date'=>'',
						'grace_period'=>'',
						'type'=>$condi['ad_type'],
						'ad_status'=>'1',
						'property_id'=>'0',
						'external_link'=>'',
						'google_ads'=>'',
						'location_id'=>$condi['location_id'],
						'ad_type_name'=>'Box Pannel',
						'title'=>'',
						'property_code'=>''
					);

		$r = DB::table('ad_packages')
				->where($condi)->get();

		foreach ($r as $key => $value) {
			$rows = DB::table('ad_advertisements')
				->select('ad_advertisements.*','pr_properties.property_id','pr_properties.property_code','pr_properties.title')
				->leftJoin('pr_properties','pr_properties.property_id','=','ad_advertisements.property_id')
				->where('ad_package_id','=',$value->ad_package_id)
				->where('ad_status','=',1)
				//->where('status','=',1)
				->where('start_date','<=',date('Y-m-d'))
				->where('end_date','>=',date('Y-m-d'));
			
			if($condi['ad_type']!=1){
				$rows->orderByRaw("RAND()");
			}

				
			if($limit>0){
				$rows->take($limit);
			}	
			//pr($rows->get());	
			if(count($rows->get())){
				$ads[$condi['ad_type']] = $rows->get();	
			}
						
			
			//pr($ads);
			//$queries = DB::getQueryLog();pr(end($queries),1);
		}
		if($condi['ad_type']==6){
			shuffle($ads[$condi['ad_type']]);
		}
		
		$rnt = array();
		foreach ($ads[$condi['ad_type']] as $key => $value) {
			if($key<$limit){
				$rnt[$key] = $value;
				if($value->property_code!='' || $value->property_code>0){
					$url = URL::action('PropertiesController@details',[seo_url($value->title)."_".$value->property_code]);
				}else{
					$url = $value->external_link;
				}
				$rnt[$key]->link = $url;
			}else{
				break;
			}
		}
		//pr($rnt);
		return $rnt;
	}

	static function getRecommendation($limit=0){
		$reco = DB::table('ad_recommendations')
			 ->select('ad_recommendations.*','pr_properties.title','pr_properties.property_code')
			 ->leftJoin('pr_properties','pr_properties.property_id','=','ad_recommendations.property_id')
			 ->where('location_id','=',(LOCATION_ID==''?0:LOCATION_ID));
		if($limit>0){
			$reco->take($limit);
		}	 
		$reco->orderByRaw("RAND()");
		//$queries = DB::getQueryLog();pr(end($queries),1);
		return $reco->get();	
	}
}