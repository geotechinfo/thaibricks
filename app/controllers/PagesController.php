<?php
use Illuminate\Routing\Controller;
class PagesController extends Controller {
	protected $layout = 'layouts.default';

	public function index(){
		$properties = new Property();
		$location = new Location;
		
		$dataset['locations']=$location->get_location_with_sub();
		$dataset["types"] = $properties->getlist_types();
		$dataset["properties"] = $properties->get_properties(null, null);
		$price['min'] = DB::table('pr_properties')->min('price');
		$price['max'] = DB::table('pr_properties')->max('price');
		$dataset['price'] = $price;
		$dataset['search_panel'] = View::make('pages.search_panel',array("dataset"=>$dataset));
		//echo $dataset['search_panel'];die;
		return View::make('pages.index', array("dataset"=>$dataset));
	}
	public function about(){
		return View::make('pages.about');
	}


	public function getlocation($lid = 0){
		$list = DB::table('pr_locations')->where('parent_id',$lid)->get();
		echo json_encode($list);exit;
	}
}
