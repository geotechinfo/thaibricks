<?php
use Illuminate\Routing\Controller;
class PagesController extends Controller {
	protected $layout = 'layouts.dashboard';

	public function index($url_location=''){
		//pr($url_location);
		//pr(CommonHelper::getLocation());
		$properties = new Property();
		$location = new Location;
		$url_loc = DB::table('pr_locations')->where('location_name','=',$url_location)->first();
		$url_loc_id = null;
		if(count($url_loc)){
			$url_loc_id = $url_loc->location_id;
		}
		$dataset['locations']=$location->get_location_with_sub();
		$dataset["types"] = $properties->getlist_types();
		$properties->limit = 12;
		$dataset["properties_latest"] = $properties->get_properties(array("location_id"=>LOCATION_ID, "property_status"=>1,'is_tanency'=>array(0)));
		$price['all']['min'] = DB::table('pr_properties')->min('price');
		$price['all']['max'] = DB::table('pr_properties')->max('price');
		$price['sale']['min'] = DB::table('pr_properties')->where('deal_id','1')->min('price');
		$price['sale']['max'] = DB::table('pr_properties')->where('deal_id','1')->max('price');
		$price['rent']['min'] = DB::table('pr_properties')->where('deal_id','2')->min('price');
		$price['rent']['max'] = DB::table('pr_properties')->where('deal_id','2')->max('price');
		$price['lease']['min'] = DB::table('pr_properties')->where('deal_id','3')->min('price');
		$price['lease']['max'] = DB::table('pr_properties')->where('deal_id','3')->max('price');
	
		$dataset['price'] = $price;
		$dataset['search_panel'] =  View::make('layouts.search_panel',array("dataset"=>$dataset));
		
		$dataset['featured_apartment'] = $properties->get_properties(array("location_id"=>LOCATION_ID, "type_id"=>array(4), "is_featured"=>1, "property_status"=>1,'is_tanency'=>array(0)));
		$dataset['featured_house'] = $properties->get_properties(array("location_id"=>LOCATION_ID, "type_id"=>array(4), "is_featured"=>1, "property_status"=>1,'is_tanency'=>array(0)));
		$user_condition = array('ac_users.is_featured'=>'1','status'=>1);
		if(LOCATION_ID!=null){
			$user_condition['location'] = LOCATION_ID;
			//$user_condition['status'] = 1;

		}
		$dataset['featured_user'] = User::select('user_id','first_name','last_name','user_code','profile_image')->where($user_condition)->get();
		return View::make('pages.index', array("dataset"=>$dataset));
	}
	public function about(){
		return View::make('pages.about');
	}
	public function contact(){
		return View::make('pages.contact');
	}
	public function  privacy_policy(){
		return View::make('pages.privacy_policy');
	}	
	public function  terms_n_conditions(){
		return View::make('pages.terms_n_conditions');
	}
	

	


	public function rent(){
		$dataset = array();
		$properties = new Property();
		$dataset['title'] = 'Rent';
		$dataset['properties'] = $properties->get_properties(array('deal_id'=>2, "property_status"=>1,'is_tanency'=>array(0)));
		//pr($dataset['list'],1);
		return View::make('pages.property_list',array('dataset'=>$dataset));
	}
	public function sale(){
		$dataset = array();

		$dataset['title'] = 'Sale';
		$properties = new Property();
		$dataset['properties'] = $properties->get_properties(array('deal_id'=>1, "property_status"=>1,'is_tanency'=>array(0)));
		//pr($dataset['list'],1);
		return View::make('pages.property_list',array('dataset'=>$dataset));
	}

	public function getlocation($lid = 0){
		$list = DB::table('pr_locations')->where('parent_id',$lid)->get();
		echo json_encode($list);exit;
	}

	public function newsletter_email_check(){
		$c  = DB::table('nw_newsletters')->where($_POST)->count();
		echo ($c==0?'true':'false');exit;
	}

	public function newsletter(){
		$data = Input::all();
		unset($data['_token']);
		$data['created'] = date('Y-m-d H:i:s');
		$id  = DB::table('nw_newsletters')->insertGetId($data);
		$r = DB::table('nw_newsletters')->where('newsletter_id','=',$id)->get();
		$json = $r[0];
		echo json_encode($json);exit;
	}

	public function dashboard(){
		//$this->layout = 'layouts.dashboard';
		return View::make('pages.test');
	}
}
