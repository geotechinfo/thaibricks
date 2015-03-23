<?php
use Illuminate\Routing\Controller;
class PagesController extends Controller {
	protected $layout = 'layouts.dashboard';

	public function index(){
		$properties = new Property();
		$location = new Location;
		
		$dataset['locations']=$location->get_location_with_sub();
		$dataset["types"] = $properties->getlist_types();
		$properties->limit = 12;
		$dataset["properties"] = $properties->get_properties(null, null);
		$price['sale']['min'] = DB::table('pr_properties')->where('deal_id','1')->min('price');
		$price['sale']['max'] = DB::table('pr_properties')->where('deal_id','1')->max('price');
		$price['rent']['min'] = DB::table('pr_properties')->where('deal_id','2')->min('price');
		$price['rent']['max'] = DB::table('pr_properties')->where('deal_id','2')->max('price');
		
		$dataset['price'] = $price;
		$dataset['search_panel'] =  View::make('pages.search_panel',array("dataset"=>$dataset));
		
		$dataset['featured_apartment'] = $properties->get_properties(null,null,null,null,null,null,null,array('type_id'=>4,'pr_properties.is_featured'=>1));
		$dataset['featured_house'] = $properties->get_properties(null,null,null,null,null,null,null,array('type_id'=>5,'pr_properties.is_featured'=>1));
		$dataset['featured_user'] = User::select('user_id','first_name','last_name','user_code','profile_image')->where(array('ac_users.is_featured'=>'1'))->get();

		//echo $dataset['search_panel'];die;
		//pr($dataset['featured_user'],1);
		return View::make('pages.index', array("dataset"=>$dataset));
	}
	public function about(){
		return View::make('pages.about');
	}

	public function agents($location='all'){
		$dataset = array('selected'=>$location);
		//die($location);
		$q = DB::table('ac_users')
				->leftJoin('pr_locations','pr_locations.location_id',"=",'ac_users.location')
				->where('status','1')				
				->orderBy('user_id','desc');
		if($location>0 && $location!='all'){
			
			$q->where('location',$location);
		}		
		$dataset['list']=$q->get(); 
		//pr($dataset['list'],1);
		//echo "ok";
		return View::make('pages.agents',array('dataset'=>$dataset));
	}


	public function rent(){
		$dataset = array();
		$properties = new Property();
		$dataset['title'] = 'Rent';
		$dataset['properties'] = $properties->get_properties(null,null,null,null,null,null,null,array('deal_id'=>2));
		//pr($dataset['list'],1);
		return View::make('pages.property_list',array('dataset'=>$dataset));
	}
	public function sale(){
		$dataset = array();

		$dataset['title'] = 'Sale';
		$properties = new Property();
		$dataset['properties'] = $properties->get_properties(null,null,null,null,null,null,null,array('deal_id'=>1));
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
		$r = DB::table('nw_newsletters')->where('newslette_id','=',$id)->get();
		$json = $r[0];
		echo json_encode($json);exit;
	}

	public function dashboard(){
		//$this->layout = 'layouts.dashboard';
		return View::make('pages.test');
	}
}
