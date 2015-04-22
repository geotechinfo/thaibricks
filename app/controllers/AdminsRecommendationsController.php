<?php

use Illuminate\Routing\Controller;

class AdminsRecommendationsController extends Controller {

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
		$dataset['locations']=$advertise->get_location(1);
		$dataset['list']=array();
		//pr($dataset['list']);					
		//echo "ok";die;
		//pr($dataset,1);
		return View::make('admin.recommendation.index', array("dataset"=>$dataset));
	}

	public function add_recommendation()
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
		return View::make('admin.recommendation.ad_form', array("dataset"=>$dataset));
	}	

	

	




	

	

	function get_recommendation(){
		$advertise = new Advertise();
		$dataset = array();		
		$condi = array();
		if(isset($_REQUEST['location_id'])){
			$condi['ad_recommendations.location_id'] = $_REQUEST['location_id'];			
		}
		
		$list=DB::table('ad_recommendations')
							->leftJoin('pr_locations','pr_locations.location_id','=','ad_recommendations.location_id')
							->where($condi)
							->orderBy('recommendation_id','Desc')
							->get();	
		$dataset['list']  = $list;
		$dataset['heading'] = "<h3>Recommendation Ads</h3>";
		$dataset['location_id'] = Input::get('location_id');
		echo View::make('admin.recommendation.list', array("dataset"=>$dataset)); exit;
	}

	function save_recommendation(){
		$advertise = new Advertise();
		$p = Input::All();
		//pr($p,1);
		$admin = Session::get('admin');
		$condi['location_id'] = $p['location_id'];
		$condi['status'] = 1;

		$count = DB::table('ad_recommendations')->where($condi)->count();
		//pr($count);
		//pr($condi,1);

		if($count<5){
			$property_id = DB::table('pr_properties')->where('property_code','=',$p['property_code'])->first()->property_id;

			$ad['recommendation_id'] = (isset($p['recommendation_id'])?$p['recommendation_id']:0);
			$ad['admin_id'] = $admin->admin_id;
			$ad['image_file'] = (isset($p['image_file'])?$p['image_file']:'');
			$ad['status'] = 1;
			$ad['location_id'] = (isset($p['location_id'])?$p['location_id']:'0');
			$ad['property_id'] = $property_id;
			$ad['description'] = (isset($p['description'])?$p['description']:'');
			$ad_id = DB::table('ad_recommendations')->insertGetId($ad);		
			return Redirect::route('admin.recommendation')->with('success','Recommendation has been successfully Saved.');		
		}else{
			return Redirect::route('admin.recommendation')->with('danger','Unable to add recommendation because  You have already 5 active recommendation for this location.');		
		}
		

	}

	

	function property_code_check(){
		$c = DB::table('pr_properties')->where('property_code','=',$_POST['property_code'])->count();
		echo ($c!=0?'true':'false');exit;
	}

	function upload_recommendation(){
		$WI = new WideImage;
		$file_path = 'files/recommendation/';
		$image_file = time().".png";
		$WI::loadFromUpload('up_file')->saveToFile($file_path.$image_file);
		$WI::load($file_path.$image_file)->resize(84,64,'fill')->saveToFile($file_path.'thumb_'.$image_file);

		$message = $_FILES['up_file'];
		$message['new_file_name'] = $image_file;
		$message['new_file_url'] = URL::to('/')."/files/recommendation/".$image_file;
		echo json_encode($message);exit();
	}
	
	function deactivate_recommendation(){

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
		$ad['status'] = 0;
		$ad['recommendation_id'] = $p['recommendation_id'];

		DB::table('ad_recommendations')->where('recommendation_id','=',$p['recommendation_id'])->update(array('status'=>0));
		if(Request::ajax()){
			$json['status_code'] = '1';
			$json['message'] = 'Your Recommendation has been deactivated';
			echo json_encode($json);exit;
		}else{
			return Redirect::route('admin.recommendation')->with('success','Your Recommendation has been deactivated.');	
		}

	}

	function password_check(){
		$admin = Session::get('admin');
		//pr($_POST);
		echo ($admin->password == $_POST['password']?'true':'false');exit;
	}
	
}