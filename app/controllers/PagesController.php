<?php
use Illuminate\Routing\Controller;
class PagesController extends Controller {
	protected $layout = 'layouts.default';

	public function index(){
		$properties = new Property();

		$dataset["types"] = $properties->getlist_types();
		$dataset["properties"] = $properties->get_properties(null, null);
		
		return View::make('pages.index', array("dataset"=>$dataset));
	}
	public function about(){
		return View::make('pages.about');
	}
}
