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
		
		$amenity = new Amenity();
		$dataset["amenities"] = $amenity->getlist();
		
		
		
		$dataset['banner_panel'] = View::make('layouts.banner_panel');
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
			if(Request::ajax()){
				$arr['message'] = 'Valivation Error';
				$arr['status'] = 0;
				echo json_encode($arr);exit;
			}else{
				return Redirect::route('property.create', ['type_id' => $_POST["type_id"], 'deal_id' => $_POST["deal_id"]])->withErrors($validator)->withInput();
			}
            
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
		$property->last_active = strtotime("now");
        if($property->save()){
			$properties = new Property();
			foreach(Input::get()["attributes"] as $key=>$value){
				if($value!=""){
					$properties->insert_value($property->property_id, $key, $value);
				}
			}
			//pr(Input::get()["transport_id"]);
			//pr(Input::get()["transport_dist"],1);
			if(Input::get()["transport_id"]){
				foreach(Input::get()["transport_id"] as $key=>$value){
					$distanc = Input::get()["transport_dist"][$key];
					//if($value!="" || $value!=0){
						$ins_prop_trns = array();
						$ins_prop_trns['property_id'] = $property->property_id;
						$ins_prop_trns['transport_id'] = $value;
						$ins_prop_trns['distance'] = $distanc;
						//pr($ins_prop_trns);
						$properties->insert_property_transport($ins_prop_trns);
					//}
				}
			}
			if(Input::get()['amenities']){
				$amenity = new Amenity();
				foreach (Input::get()['amenities'] as $key => $value) {
					# code...
					$insert = array();
					$insert['amenity_id'] = $value;
					$insert['property_id']= $property->property_id;
					$amenity->insert_property_amenity($insert);
				}
			}
			
			$image_raw_data = Input::get('image_raw_data');
			$WI = new WideImage;
			
			if(count($image_raw_data)>0){
				$arr['files'][]=Input::get('imagefile');
				foreach($image_raw_data as $image_key=>$image_data) {
					if($image_data!=''){
						$arr['files'][$image_key] = $image_data;
						$file_path = 'files/properties/';
						$image_file = time()."_4_3.png";
						$WI::load($image_data)->saveToFile($file_path.$image_file);
						$media = new Media();
						$media->property_id = $property->property_id;
						$media->media_type = "PROPERTY-IMAGE";
						$media->media_title = $image_key;
						$media->media_data = $image_file;
						$media->save();
					}	
				}
			}

			$dataset['user'] =Auth::user();
			$p = $property->get_properties(array("property_id"=>$property->property_id));
			$dataset['property'] = $p[0];
        	
			Mail::send('emails.newproperty', ['dataset' => $dataset], function($message) 
            {
                $message->to(Auth::user()->email, Auth::user()->username)->subject('New Property Post');
            });
            
			if(Request::ajax()){
				$arr['message'] = '<p><i class="fa fa-check"></i>Property successfully added in ThaiBricks.</p><span>This Property will be shown on being approved by Admin</span>';
				$arr['status'] = 1;
				echo json_encode($arr);
			}else{
				return Redirect::route('property.myproperties')->with('success','Property successfully added in ThaiBricks.');	
			}
            
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
		if(!Session::has('admin') && !Auth::user()->user_id){
			return Response::view('errors.missing', array(), 404);
		}

		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$dataset["properties"] = $properties->get_properties(array("property_id"=>$id,'is_tanency'=>array(0,1)));
		//pr($dataset["properties"],1);
		$dataset["user"] = User::find($dataset["properties"][0]->user_id);
		//pr($dataset['user'],1);
		$properties->limit = 12;
		$dataset["related"] = $properties->get_properties(array("property_ignore"=>$id, "location_id"=>$dataset["properties"][0]->location, 'type_id'=>array($dataset["properties"][0]->type_id),'property_status'=>1));
		//pr($dataset["related"],1);
		return View::make('properties.show', array("dataset"=>$dataset));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$amenity = new Amenity();
		$dataset["amenities"] = $amenity->getlist();
						
		$properties = new Property();
		$property = $properties->get_properties(array("property_id" => $id,'is_tanency'=>array(0,1)));

		$property = $property[0];
		//pr($property,1);
		$dataset["property"] = $property;
		$dataset["groups"] = $properties->get_attributes($property->deal_id, $property->type_id);

		$dataset["deal_id"] = $property->deal_id;
		$dataset["type_id"] = $property->type_id;
		$dataset['banner_panel'] = View::make('layouts.banner_panel');
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
		$property->last_active = strtotime("now");
        if($property->save()){
			$properties = new Property();
			
			$properties->delete_values($id);
			if(count(Input::get()["attributes"])){
				foreach(Input::get()["attributes"] as $key=>$value){
					if($value!=""){
						$properties->insert_value($id, $key, $value);
					}
				}
			}
			//echo "<pre>";print_r(Input::get()["transport_id"]);die;
			$properties->delete_property_transport($id);
			if(Input::get()["transport_id"]){
				foreach(Input::get()["transport_id"] as $key=>$value){
					$distanc = Input::get()["transport_dist"][$key];
					//if($value!=""){
						$ins_prop_trns['property_id'] = $id;
						$ins_prop_trns['transport_id'] = $value;
						$ins_prop_trns['distance'] = $distanc;
						$properties->insert_property_transport($ins_prop_trns);
					//}
				}
			}
			$amenity = new Amenity();
			$amenity->delete_property_amenity($id);
			if(Input::get()['amenities']){
				
				foreach (Input::get()['amenities'] as $key => $value) {
					$insert = array();
					$insert['amenity_id'] = $value;
					$insert['property_id']= $property->property_id;
					$amenity->insert_property_amenity($insert);
				}
			}
			//
			$image_deletes = Input::get('image_deletes');
			if(count($image_deletes)>0){
				foreach($image_deletes as $image_id){
					Media::where(array("media_id" => $image_id))->delete();
				}
			}

			//$image_titles = Input::get('image_titles');
			//$image_files = Input::get('image_name');
			
			//$imagefile = Input::get('imagefile');
			$image_raw_data = Input::get('image_raw_data');
			$WI = new WideImage;
			
			if(count($image_raw_data)>0){
				$arr['files'][]=Input::get('imagefile');
				foreach($image_raw_data as $image_key=>$image_data) {
					if($image_data!=''){
						$arr['files'][$image_key] = $image_data;
						$file_path = 'files/properties/';
						$image_file = time()."_4_3.png";
						$WI::load($image_data)->saveToFile($file_path.$image_file);
						$media = new Media();
						$media->property_id = $property->property_id;
						$media->media_type = "PROPERTY-IMAGE";
						$media->media_title = $image_key;
						$media->media_data = $image_file;
						$media->save();
					}	
				}
			}
			
			if(Request::ajax()){
				$arr['message'] = '<p><i class="fa fa-check"></i>Property successfully updated in ThaiBricks.</p>';
				$arr['status'] = 1;
				echo json_encode($arr);
			}else{
				return Redirect::route('property.myproperties')->with('success','Property successfully updated in ThaiBricks.');
			}
            
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
	/*public function mylist($id){
		if($id == "me"){
			$id = Auth::user()->user_id;
		}
		$dataset['user'] = User::find($id);		
		$dataset['banner_panel'] = View::make('layouts.banner_panel',$dataset);
		
		$properties = new Property();		
		$dataset["properties"] = $properties->get_properties(array("user_id" => $id, "property_status"=>1));
		
		if(count($dataset["properties"])==0){
			Session::flash('info', "You don't have any properties yet!");
		}
		$properties->limit=12;
		$dataset["hot"] = $properties->get_properties(null, null);
		$dataset["user_id"] = $id;
		//pr($dataset['user'],1);
		
		return View::make('properties.mylist', array("dataset"=>$dataset));
	}*/

	public function myproperties(){
		//Quick fix for admin user
		if(Session::has('admin')){			
			return Redirect::route('admins.dashboard');
		}
	
		$id = Auth::user()->user_id;
		$properties = new Property();		
		$dataset["properties"] = $properties->get_properties(array("user_id"=>$id, "is_tanency"=>array(0,1)));
		
		if(count($dataset["properties"])==0){
			Session::flash('info', "You don't have any properties yet!");
		}

		$dataset["user_id"] = $id;
		return View::make('properties.propertylist', array("dataset"=>$dataset));
	}
	
	public function search(){

		$sublocation_id = null;
		$bedroom = array();
		$types = array();
		$price_range = array();
		$deals = array();
		//pr($_GET,1);
		
		
		if(isset($_GET["location_sub"]) && $_GET["location_sub"] != ""){
			$sublocation_id = $_GET["location_sub"];
		}else{
			$sublocation_id = null;
		}
		$bedroom = array();
		if(isset($_GET['bedroom'])){
			$bedroom = $_GET['bedroom'];
		}
		$types = array();
		if(isset($_GET['types'])){
			$types = $_GET['types'];
		}
		
		$deal_id = '';
		
		if(isset($_GET['deal_id']) && $_GET['deal_id']>0){			
			$deals = array($_GET['deal_id']);
			
		}
		$price_range = explode(',', $_GET['price_range']);
		//pr($price_range,1);
		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		if(!isset($_GET['transport']) && $_GET['transport']==''){
			$conditions = array("location_id"=>LOCATION_ID, "sublocation_id"=>$sublocation_id, "bedroom"=>$bedroom, "type_id"=>$types, "price_range"=>$price_range, "deal_id"=>$deals, "property_status"=>1);
			$dataset['transport'] = '';
			$dataset["properties"] = $properties->get_properties($conditions);			
		}else{
			$dataset['transport'] = $_GET['transport'];
			$properties->transport = $_GET['transport'];
			$properties->sub_transport = (isset($_GET['sub_transport'])?$_GET['sub_transport']:null);
			$dataset["properties"] = $properties->get_properties(array("location_id"=>LOCATION_ID, "property_status"=>1));
		}
		
		
		if(count($dataset["properties"])==0){
			Session::flash('info', "No properties found for above search criteria!");
		}
		//pr($dataset["properties"]);
		//pr($_GET,1);
		
		$properties = new Property();
		$location = new Location;
		
		$dataset['locations']=$location->get_location_with_sub();
		$dataset["types"] = $properties->getlist_types();
		
		$price['all']['min'] = DB::table('pr_properties')->min('price');
		$price['all']['max'] = DB::table('pr_properties')->max('price');
		$price['sale']['min'] = DB::table('pr_properties')->where('deal_id','1')->min('price');
		$price['sale']['max'] = DB::table('pr_properties')->where('deal_id','1')->max('price');
		$price['rent']['min'] = DB::table('pr_properties')->where('deal_id','2')->min('price');
		$price['rent']['max'] = DB::table('pr_properties')->where('deal_id','2')->max('price');
		$price['lease']['min'] = DB::table('pr_properties')->where('deal_id','3')->min('price');
		$price['lease']['max'] = DB::table('pr_properties')->where('deal_id','3')->max('price');
	
		$dataset['price'] = $price;
		$dataset['gmap'] = (isset($_GET['gmap'])?$_GET['gmap']:0);
		$dataset['search_panel'] = View::make('layouts.search_panel',array("dataset"=>$dataset));

		
		return View::make('properties.search', array("dataset"=>$dataset));
	}

	function date_extend(){
		$properties = new Property();
		$row = $properties::find($_POST['property_id']);
		$row->last_active = strtotime("now");
		$row->save();
		echo json_encode($row);exit;
	}

	function get_groups(){
		$properties = new Property();
		$dataset["groups"] = $properties->get_attributes($_POST["deal_id"], $_POST["type_id"]);
		
		$dataset["deal_id"] = $_POST["deal_id"];
		$dataset["type_id"] = $_POST["type_id"];
		
		$id = isset($_POST['property_id'])?$_POST['property_id']:0;
		$dataset["property_id"] = $id;
		if($id>0){
			$property = $properties->get_properties(array("property_id"=>$id));
			$dataset['property'] = $property[0];
		}
		return View::make('properties.property_group',array('dataset'=>$dataset));	
	}

	function propertyimage(){
		$image_files = $_FILES['image_files'];
		//$image_files = Input::file('image_files');
			
		$json = $image_files;
		if($image_files['error']==0){
			$file_path = 'files/tmp/';
			$file_name = rand(1111111111,9999999999).'.jpg';
			move_uploaded_file($image_files['tmp_name'], $file_path.$file_name);
			$json['new_name'] = $file_name;
			$json['file_url'] = URL::to('/')."/".$file_path.$file_name;
		}

		echo json_encode($json); exit;
	}

	function change_status($action='status',$id='0'){
		if($action=='status'){
			$con = array('table'=>'pr_properties','field'=>'status','where'=>array('property_id'=>$id));
		}
		if($action=='featured'){
			$con = array('table'=>'pr_properties','field'=>'is_featured','where'=>array('property_id'=>$id));
		}
		if($action=='hot'){
			$con = array('table'=>'pr_properties','field'=>'is_hot','where'=>array('property_id'=>$id));
		}
		CommonHelper::change_bool($con);
		return Redirect::route('property.show',array($id))->with('success','Property successfully updated in ThaiBricks.');
	}

	public function details($title='')
	{
		$ar = explode('_', $title);
		$code = end($ar);

		$properties = new Property();
		
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		$is_tanency = array(0);
		if(Auth::user()->user_id){
			$is_tanency[]=1;
		}
		$dataset["properties"] = $properties->get_properties(array('property_code'=>$code, "property_status"=>1,'is_tenancy'=>$is_tanency));
		if(count($dataset["properties"])==0){
			return Response::view('errors.missing', array(), 404);
		}

		$dataset["user"] = User::find($dataset["properties"][0]->user_id);
		$properties->limit = 12;
		$dataset["related"] = $properties->get_properties(array('property_ignore'=>$dataset["properties"][0]->property_id, 'location_id'=>$dataset["properties"][0]->location,'type_id'=>array($dataset["properties"][0]->type_id),'property_status'=>1));
		//pr($dataset["related"],1);
		return View::make('properties.show', array("dataset"=>$dataset));
	}

	

	function image_create_url(){
		$WI = new WideImage;
				
		$file_path = 'files/properties/';
		$image_file = time().".png";
		//$WI::loadFromString($image_data)->saveToFile($file_path.$file_name);
		//$arr['files'][] = stripcslashes($_POST['imagedata']);
		$arr['files'][] =str_replace('\\', '/', urldecode($_POST['imagedata']));
		echo json_encode($arr);exit;
					
	}

}