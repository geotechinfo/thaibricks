<?php

use Illuminate\Routing\Controller;

class AdminsAdsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	

	public function index()
	{		
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$advertise = new Advertise();
		$dataset = array();		
		$dataset['ad_type_n'] = array('1'=>'Premium Banner','2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House','6'=>'Box Panel');
		$dataset['ad_type'] = array('1'=>'Premium Banner','Featured Banner'=>array('2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House'),'6'=>'Box Panel');
		$dataset['type'] = array('1'=>'Property','2'=>'External Link','3'=>'Google Ad');
		$dataset['locations']=$advertise->get_location(1);
		$dataset['list']=array();
		//echo "ok";die;
		//pr($dataset,1);
		return View::make('admin.ads.index', array("dataset"=>$dataset));
	}

	public function add_advertise()
	{		
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$advertise = new Advertise();
		$dataset = array();		
		$dataset['ad_type_n'] = array('1'=>'Premium Banner','2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House','6'=>'Box Panel');
		$dataset['ad_type'] = array('1'=>'Premium Banner','Featured Banner'=>array('2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House'),'6'=>'Box Panel');
		$dataset['type'] = array('1'=>'Property','2'=>'External Link','3'=>'Google Ad');
		$dataset['locations']=$advertise->get_location(1);
		$dataset['list']=array();
		//echo "ok";die;
		//pr($dataset,1);
		return View::make('admin.ads.ad_form', array("dataset"=>$dataset));
	}	

	public function packages()
	{		
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$advertise = new Advertise();
		$dataset = array();		
		$dataset['list']=$advertise->get_adpackages();		
		//pr($dataset['list'],1);
		$dataset['ad_type_n'] = array('1'=>'Premium Banner','2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House','6'=>'Box Panel');
		$dataset['ad_type'] = array('1'=>'Premium Banner','Featured Banner'=>array('2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House'),'6'=>'Box Panel');
		$dataset['locations']=$advertise->get_location(1);
		return View::make('admin.ads.packages', array("dataset"=>$dataset));
	}

	




	function save_package(){
		$p = Input::all();
		$data = $p;
		unset($data['_token']);
		$advertise = new Advertise();
		$bool = 1;
		$ids=array();
		$ratio[1]['image_height']='527';
		$ratio[1]['image_width']='1349';

		$ratio[2]['image_height']='143';
		$ratio[2]['image_width']='1012';

		$ratio[3]['image_height']='143';
		$ratio[3]['image_width']='1012';

		$ratio[4]['image_height']='143';
		$ratio[4]['image_width']='1012';

		$ratio[5]['image_height']='143';
		$ratio[5]['image_width']='1012';

		$ratio[6]['image_height']='250';
		$ratio[6]['image_width']='250';

		

		foreach ($data['location_id'] as $k => $v) {
			$insert['ad_package_id'] = $data['ad_package_id'];
			$insert['location_id'] = $v;
			$insert['ad_type'] = $data['ad_type'];
			$insert['duration'] = $data['duration'];
			$insert['grace_period'] = $data['grace_period'];			
			$insert['price'] = $data['price'];
			$insert['image_height'] = $ratio[$data['ad_type']]['image_height'];
			$insert['image_width'] = $ratio[$data['ad_type']]['image_width'];
			$r = $advertise->save_package($insert);
			$ids[] = $r;
			if($r<0){
				$bool=0;
			}
		}		
		
		if(in_array('-1', $ids)){
			return Redirect::route('admin.adpackages')->with('info','We have ignored one or more entries due to it\'s already exist in package.');		
		}else{
			return Redirect::route('admin.adpackages')->with('success','Ad Package has been successfully Saved.');		
		}	
	}

	

	function get_advertise(){
		$advertise = new Advertise();
		$dataset = array();		
		$condi = array();
		$condi['ad_advertisements.location_id'] = Input::get('location_id');
		$condi['ad_advertisements.master_id'] = Input::get('master_id');
		$dataset['list']=$advertise->get_list();
		$dataset['ad_type_n'] = array('1'=>'Premium Banner','2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House','6'=>'Box Panel');
		$dataset['ad_type'] = array('1'=>'Premium Banner','Featured Banner'=>array('2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House'),'6'=>'Box Panel');
		$dataset['location_id'] = Input::get('location_id');
		$dataset['master_id'] = Input::get('master_id');
		$dataset['type'] = array(''=>'Select Type', '1'=>'Property Code', '2'=>'External Link','3'=>'Google Ad Sence');
		echo View::make('admin.ads.list', array("dataset"=>$dataset)); exit;
	}

	function save_advertise(){
		$advertise = new Advertise();
		$p = Input::All();
		//pr($p,1);
		$property_id = DB::table('pr_properties')->where('property_code','=',$p['property_code'])->first()->property_id;

		$ad['advertisement_id'] = (isset($p['advertisement_id'])?$p['advertisement_id']:0);
		$ad['admin_id'] = (isset($p['admin_id'])?$p['admin_id']:0);
		$ad['ad_package_id'] = (isset($p['ad_package_id'])?$p['ad_package_id']:0);
		$ad['image_file'] = (isset($p['image_file'])?$p['image_file']:'');
		$ad['start_date'] = (isset($p['start_date'])?CommonHelper::dateToDb($p['start_date']):NULL);
		$ad['end_date'] = (isset($p['end_date'])?CommonHelper::dateToDb($p['end_date']):NULL);
		$ad['grace_period'] = (isset($p['grace_period'])?$p['grace_period']:0);
		$ad['type'] = (isset($p['type'])?$p['type']:0);
		$ad['ad_status'] = (isset($p['ad_status'])?$p['ad_status']:1);
		$ad['property_id'] = $property_id;
		$ad['external_link'] = (isset($p['external_link'])?$p['external_link']:'');
		$ad['google_ads'] = (isset($p['google_ads'])?$p['google_ads']:'');
		$ad['description'] = (isset($p['description'])?serialize($p['description']):'');
		$ad_id = $advertise->save_advertisement($ad);

		

		$pay['payment_id'] = 0;
		$pay['advetisement_id'] = $ad_id;
		$pay['start_date'] = (isset($p['start_date'])?CommonHelper::dateToDb($p['start_date']):NULL);
		$pay['end_date'] = (isset($p['end_date'])?CommonHelper::dateToDb($p['end_date']):NULL);
		$pay['price'] = (isset($p['price'])?$p['price']:0);
		$pay['discount_percentage'] = (isset($p['discount'])?$p['discount']:0);
		$pay['discounted_price'] = (isset($p['discounted_price'])?$p['discounted_price']:0);
		$advertise->save_payment($pay);

		//$pkg['ad_package_id'] = $data['ad_package_id'];
		$condi['location_id'] = $p['location_id'];
		$condi['ad_type'] = $p['ad_type'];
		//$condi['duration'] = $p['duration'];
		$pkg['pkg_status'] = 1;
		$r = $advertise->update_package($pkg,$condi);
		//pr($ad);
		//pr($pay,1);
		return Redirect::route('admin.ads')->with('success','Advertisement has been successfully Saved.');	

	}

	function get_package_details(){
		$advertise = new Advertise();
		$condi['ad_packages.location_id'] = $_POST['location_id'];
		$condi['ad_packages.ad_type'] = $_POST['ad_type'];
		if($_POST['ad_type']!=6){
			$condi['ad_packages.pkg_status'] = 0;
		}	
		$dataset['list'] = $advertise->get_adpackages($condi);
		//pr($condi);
		$dataset['ad_type_n'] = array('1'=>'Premium Banner','2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House','6'=>'Box Panel');
		$dataset['ad_type'] = array('1'=>'Premium Banner','Featured Banner'=>array('2'=>'Featured Projects','3'=>'Featured Condos','4'=>'Featured Apartments','5'=>'Featured House'),'6'=>'Box Panel');
		//pr($condi);
		//pr($dataset['list']);
		if(count($dataset['list'])==0){
			//echo "o";
			unset($condi['ad_packages.pkg_status']);
			//$condi['ad_packages.status'] = 1;
			$pkg = $advertise->get_adpackages($condi);
			//pr($pkg);
			$ids = array();
			foreach ($pkg as $k => $v) {
				$ids[]=$v->ad_package_id;
			}
			if(count($pkg)){
				$dataset['heading'] = '<h3>Current Advertise List</h3>';
				$dataset['list'] = $advertise->get_list(array('whereIn'=>array('ad_advertisements.ad_package_id'=>$ids)));			
				//pr($dataset['list']);
				if(count($dataset['list'])){
				//pr($dataset['list']);
				echo View::make('admin.ads.list', array("dataset"=>$dataset)); exit;
				}else{
					$dataset['list'] = $advertise->get_adpackages($condi);
					$dataset['heading'] = '<h3>Available Package List</h3>';
					echo View::make('admin.ads.packagelist', array("dataset"=>$dataset)); exit;
				}
			}else{
				$dataset['heading'] = '<h3>Available Package List</h3>';
				echo View::make('admin.ads.packagelist', array("dataset"=>$dataset)); exit;
			}
			
			
		}else{
			$dataset['heading'] = '<h3>Available Package List</h3>';
			echo View::make('admin.ads.packagelist', array("dataset"=>$dataset)); exit;
		}
		//pr($dataset['ad_list'],1);
		//$default = array('duration'=>'','grace_period'=>'','price'=>'');
		//echo isset($r[0])?json_encode($r[0]):json_encode($default); exit;
		
	}

	function property_code_check(){
		$c = DB::table('pr_properties')->where('property_code','=',$_POST['property_code'])->count();
		echo ($c!=0?'true':'false');exit;
	}

	function upload_advertise(){
		$WI = new WideImage;
		$file_path = 'files/advertise/';
		$image_file = time().".png";
		$WI::loadFromUpload('up_file')->saveToFile($file_path.$image_file);
		$message = $_FILES['up_file'];
		$message['new_file_name'] = $image_file;
		$message['new_file_url'] = URL::to('/')."/files/advertise/".$image_file;
		echo json_encode($message);exit();
	}
	
	function deactivate_advertise(){

		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$admin = Session::get('admin');
		//pr($admin,1);
		$p = Input::All();
		if($admin->password!=$p['password']){
			$json['status_code'] = '0';
			$json['message'] = 'You have provided wrong password.';
			echo json_encode($json);exit;
		}
		

		$is_success[]=DB::table('ad_packages')->where('ad_package_id','=',$p['ad_package_id'])->update(array('pkg_status' => 0));
		$is_success[]=DB::table('ad_advertisements')->where('advertisement_id','=',$p['advertisement_id'])->update(array('ad_status' => 0));

		if(!in_array(0, $is_success)){
			$json['status_code'] = '1';
			$json['message'] = 'Your Advertisement has been deactivated';
		}else{
			$json['status_code'] = '0';
			$json['message'] = 'Unable to deactivate your Advertisement';
		}
		if(Request::ajax()){
			echo json_encode($json);exit;
		}else{
			return Redirect::route('admin.ads')->with('success','Your Advertisement has been deactivated.');	
		}

	}

	function password_check(){
		$admin = Session::get('admin');
		//pr($_POST);
		echo ($admin->password == $_POST['password']?'true':'false');exit;
	}
	
}