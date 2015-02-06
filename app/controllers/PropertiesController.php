<?php //namespace ;

use Illuminate\Routing\Controller;

class PropertiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	 
	public function index()
	{
		//
	}
	
	public function create(){
		

		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();

		$location = new Location;
		$dataset['locations']=$location->get_location_with_sub();
		//echo "<pre>"; print_r($dataset);die;


		$valid_deal = false;
		foreach($dataset["deals"] as $key=>$val){
			if($_GET["deal_id"] == $key){
				$valid_deal = true;
			}
		}
		$valid_type = false;
		foreach($dataset["types"] as $types){
			foreach($types as $key=>$val){
				if($_GET["type_id"] == $key){
					$valid_type = true;
				}
			}
		}
		if($valid_deal == false || $valid_type == false){
			return Redirect::route('property.mylist', array("me"));
		}
		
		$properties = new Property();
		
		/*$dataset["property"] = new stdClass();
		$dataset["property"]->title = null;
		$dataset["property"]->description = null;*/
		$dataset["groups"] = $properties->get_attributes($_GET["deal_id"], $_GET["type_id"]);

		$dataset["deal_id"] = $_GET["deal_id"];
		$dataset["type_id"] = $_GET["type_id"];
		$dataset['banner_panel'] = View::make('properties.banner_panel');
		return View::make('properties.create', array("dataset"=>$dataset));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$attributes = Input::only('attributes');
		$validators = array(
			'title' => 'required|min:10',
			'description' => 'required|min:15',
			'location' => 'required',
			'location_sub' => 'required',
			'address' => 'required',
			'price' => 'required|numeric|min:0',
			'email' => 'required|email',
			'phone' => 'required|numeric'/*,
			'attributes.1' => 'required',
			'image_files.0' => 'required',
			'image_titles.0' => 'required'*/
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('property.create', ['type_id' => $_POST["type_id"], 'deal_id' => $_POST["deal_id"]])->withErrors($validator)->withInput();
        }

		$property = new Property();
		
        $property->user_id = Auth::user()->user_id;
		$property->deal_id = Input::get('deal_id');
		$property->type_id = Input::get('type_id');
		$property->title = Input::get('title');
		$property->description = Input::get('description');
		$property->location = Input::get('location');
		$property->location_sub = Input::get('location_sub');
		$property->address = Input::get('address');
		$property->price = Input::get('price');
		$property->basis = Input::get('basis');
		$property->email = Input::get('email');
		$property->phone = Input::get('phone');
        if($property->save()){
			$properties = new Property();
			foreach(Input::get()["attributes"] as $key=>$value){
				if($value!=""){
					$properties->insert_value($property->property_id, $key, $value);
				}
			}

			//echo "<pre>";print_r(Input::get()["transport_id"]);die;
			//$properties->delete_property_transport($id);
			foreach(Input::get()["transport_id"] as $key=>$value){
				if($value!=""){
					$ins_prop_trns['property_id'] = $id;
					$ins_prop_trns['transport_id'] = $value;
					$ins_prop_trns['distance'] = Input::get()["transport_dist"][$key];
					$properties->insert_property_transport($ins_prop_trns);
				}
			}

			$image_titles = Input::get('image_titles');
			$image_files = Input::file('image_files');
			if(count($image_files)>0){
				foreach($image_files as $image_key=>$image_file) {
					$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
					$validator = Validator::make(array('file'=> $image_file), $rules);
					if($validator->passes()){
						$file_path = 'files/properties';
						$file_name = rand(1111111111,9999999999).'.jpg';
						$image_file->move($file_path, $file_name);
						
						$media = new Media();
						$media->property_id = $property->property_id;
						$media->media_type = "PROPERTY-IMAGE";
						$media->media_title = $image_titles[$image_key];
						$media->media_data = $file_name;
						$media->save();
					}
				}
			}
			
            return Redirect::route('property.mylist', array("me"))->with('success','Property successfully added in ThaiBricks.');
        }
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$dataset["properties"] = $properties->get_properties(null, $id);
		$dataset["related"] = $properties->get_properties(null, null);
		return View::make('properties.show', array("dataset"=>$dataset));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		$location = new Location;
		$dataset['locations']=$location->get_location_with_sub();
		
		$properties = new Property();
		$property = $properties->get_properties(null, $id);
		$property = $property[0];

		$dataset["property"] = $property;
		$dataset["groups"] = $properties->get_attributes($property->deal_id, $property->type_id);

		$dataset["deal_id"] = $property->deal_id;
		$dataset["type_id"] = $property->type_id;
		$dataset['banner_panel'] = View::make('properties.banner_panel');
		return View::make('properties.create', array("dataset"=>$dataset));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$attributes = Input::only('attributes');
		$validators = array(
			'title' => 'required|min:10',
			'description' => 'required|min:15',
			'location' => 'required',
			'location_sub' => 'required',
			'address' => 'required',
			'price' => 'required|numeric|min:0',
			'email' => 'required|email',
			'phone' => 'required|numeric'/*,
			'attributes.1' => 'required'*/
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('property.edit', array($id))->withErrors($validator)->withInput();
        }
		
		$property = Property::find($id);
		
        //$property->user_id = Auth::user()->user_id;
		//$property->deal_id = Input::get('deal_id');
		//$property->type_id = Input::get('type_id');
		$property->title = Input::get('title');
		$property->description = Input::get('description');
		$property->location = Input::get('location');
		$property->location_sub = Input::get('location_sub');
		$property->address = Input::get('address');
		$property->price = Input::get('price');
		$property->basis = Input::get('basis');
		$property->email = Input::get('email');
		$property->phone = Input::get('phone');
        if($property->save()){
			$properties = new Property();
			
			$properties->delete_values($id);
			foreach(Input::get()["attributes"] as $key=>$value){
				if($value!=""){
					$properties->insert_value($id, $key, $value);
				}
			}
			//echo "<pre>";print_r(Input::get()["transport_id"]);die;
			$properties->delete_property_transport($id);
			foreach(Input::get()["transport_id"] as $key=>$value){
				if($value!=""){
					$ins_prop_trns['property_id'] = $id;
					$ins_prop_trns['transport_id'] = $value;
					$ins_prop_trns['distance'] = Input::get()["transport_dist"][$key];
					$properties->insert_property_transport($ins_prop_trns);
				}
			}

			$image_titles = Input::get('image_titles');
			$image_files = Input::file('image_files');
			if(count($image_files)>0){
				foreach($image_files as $image_key=>$image_file) {
					$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
					$validator = Validator::make(array('file'=> $image_file), $rules);
					if($validator->passes()){
						$file_path = 'files/properties';
						$file_name = rand(1111111111,9999999999).'.jpg';
						$image_file->move($file_path, $file_name);
						
						$media = new Media();
						$media->property_id = $id;
						$media->media_type = "PROPERTY-IMAGE";
						$media->media_title = $image_titles[$image_key];
						$media->media_data = $file_name;
						$media->save();
					}
				}
			}
			
            return Redirect::route('property.mylist', array("me"))->with('success','Property successfully updated in ThaiBricks.');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function mylist($id){
		if($id == "me"){
			$id = Auth::user()->user_id;
		}
	
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$dataset["properties"] = $properties->get_properties($id, null);
		
		if(empty($dataset["properties"])){
			Session::flash('info', "You don't have any properties yet!");
		}
		
		$dataset["hot"] = $properties->get_properties(null, null);
		$dataset["user_id"] = $id;
		$dataset['banner_panel'] = View::make('properties.banner_panel');
		
		return View::make('properties.mylist', array("dataset"=>$dataset));
	}
	
	public function search(){
		if(isset($_GET["location"]) && $_GET["location"] != ""){
			$location_id = $_GET["location"];
		}else{
			$location_id = null;
		}
		
		if(isset($_GET["location_sub"]) && $_GET["location_sub"] != ""){
			$sublocation_id = $_GET["location_sub"];
		}else{
			$sublocation_id = null;
		}
	
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$dataset["properties"] = $properties->get_properties(null, null, $location_id, $sublocation_id);
		
		if(empty($dataset["properties"])){
			Session::flash('info', "No properties found for above search criteria!");
		}
		return View::make('properties.search', array("dataset"=>$dataset));
	}

}