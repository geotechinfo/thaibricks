<?php

use Illuminate\Routing\Controller;

class AdminsLocationsController extends Controller {


	public function location()
	{
		
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$rules = ["parent_id" => 0];
		//$rules = ["type" => 1];
		$parents = Location::where($rules)->get();
		$dataset["parents"] = array();
		$dataset["parents"][""] = "Select Location/City";
		foreach($parents as $parent){
			$dataset["parents"][$parent->location_id] = $parent->location_name;
		}
		
		$locations  = Location::all();
		$builder = array();
		$counter_parent = 0;
		foreach($locations as $parent){
			if($parent->parent_id == 0){
				$builder[$counter_parent]["text"] = $parent->location_name;
				$builder[$counter_parent]["location_name"] = $parent->location_name;
				$builder[$counter_parent]["location_id"] = $parent->location_id;
				$builder[$counter_parent]["parent_id"] = $parent->parent_id;
				$counter_child = 0;
				foreach($locations as $child){
					if($parent->location_id == $child->parent_id){
						$builder[$counter_parent]["nodes"][$counter_child]["text"] = $child->location_name;
						$builder[$counter_parent]["nodes"][$counter_child]["location_name"] = $child->location_name;
						$builder[$counter_parent]["nodes"][$counter_child]["location_id"] = $child->location_id;
						$builder[$counter_parent]["nodes"][$counter_child]["parent_id"] = $child->parent_id;
						$counter_child++;
					}
				}
				$counter_parent++;
			}
		}
		$dataset["locations"] = json_encode($builder, true);

		return View::make('admin.locations.show', array("dataset"=>$dataset));
	}
	
	public function addlocation(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'location_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.location')->withErrors($validator)->withInput();
        }
		
		$location = new Location();
		
		$location->parent_id = 0;
		$location->location_name = Input::get('location_name');
        if($location->save()){
			return Redirect::route('location.location')->with('success','Location successfully added in ThaiBricks.');
		}
	}
	
	public function addsublocation(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'location_id' => 'required',
			'sub_location' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.location')->withErrors($validator)->withInput();
        }
		
		$location = new Location();
		
		$location->parent_id = Input::get('location_id');
		$location->location_name = Input::get('sub_location');
        if($location->save()){
			return Redirect::route('location.location')->with('success','Sub Location successfully added in ThaiBricks.');
		}
	}
	
	public function transport()
	{
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$rules = ["parent_id" => 0];
		$locations = Location::where($rules)->get();
		$dataset["locations"] = array();
		$dataset["locations"][""] = "Select Location";
		foreach($locations as $location){
			$dataset["locations"][$location->location_id] = $location->location_name;
		}
	
		$rules = ["parent_id" => 0];
		$rules = ["type" => 1];

		$parents = Transport::where($rules)->join('pr_locations','pr_locations.location_id','=','pr_location_transports.location_id')->get();
		//pr($parents);
		$dataset["groups"] = array();
		$dataset["groups"][""] = "Select Transport Group";
		foreach($parents as $parent){
			$dataset["groups"][$parent->location_name][$parent->transport_id] = $parent->transport_name;
			$dataset['transport_parents'][$parent->location_name][$parent->transport_id] = $parent->transport_name;
		}
		//pr($dataset["transport_parents"],1);
		$transports  = Transport::where(array('type'=>1))->get();
		$builder = array();
		$counter_group = 0;
		foreach($transports as $group){
			if($group->parent_id == 0){
				$builder[$counter_group]["text"] = $group->transport_name."[".$group->location->location_name."]";
				$builder[$counter_group]["href"] = '#ppppp-'.$group->transport_id;
				$builder[$counter_group]["tid"] = $group->transport_id;
				$counter_child = 0;
				foreach($transports as $child){
					if($group->transport_id == $child->parent_id){
						$builder[$counter_group]["nodes"][$counter_child]["text"] = $child->transport_name;
						$builder[$counter_group]["nodes"][$counter_child]["href"] = "#ppppp-".$child->transport_id;
						$builder[$counter_group]["nodes"][$counter_child]["tid"] = $child->transport_id;
						$counter_child++;
					}
				}
				$counter_group++;
			}
		}
		//pr($builder,1);
		$dataset["transports"] = json_encode($builder, true);

		return View::make('admin.locations.view', array("dataset"=>$dataset));
	}
	
	public function addgroup(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'location_id' => 'required',
			'group_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.transport')->withErrors($validator)->withInput();
        }
		
		$transport = new Transport();
		
		$transport->parent_id = 0;
		$transport->location_id = Input::get('location_id');
		$transport->transport_name = Input::get('group_name');
        if($transport->save()){
			return Redirect::route('location.transport')->with('success','Transport group successfully added in ThaiBricks.');
		}
	}
	
	public function addtransport(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'transport_group' => 'required',
			'transport_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.transport')->withErrors($validator)->withInput();
        }
		
		$transport = new Transport();
		
		$transport->parent_id = Input::get('transport_group');
		$transport->transport_name = Input::get('transport_name');
        if($transport->save()){
			return Redirect::route('location.transport')->with('success','Transport successfully added in ThaiBricks.');
		}
	}
	
	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create(){
		
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
		//
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
		//
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


	public function nearby()
	{

		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$rules = ["parent_id" => 0];
		$locations = Location::where($rules)->get();
		$dataset["locations"] = array();
		$dataset["locations"][""] = "Select Location";
		foreach($locations as $location){
			$dataset["locations"][$location->location_id] = $location->location_name;
		}
	
		$rules = ["parent_id" => 0];
		$rules = ["type" => 2];
		$parents = Transport::where($rules)->join('pr_locations','pr_locations.location_id','=','pr_location_transports.location_id')->get();
		//pr($parents,1);
		$dataset["groups"] = array();
		$dataset["groups"][""] = "Select NearBy Group";
		foreach($parents as $parent){
			$dataset["groups"][$parent->location_name][$parent->transport_id] = $parent->transport_name;
			$dataset['transport_parents'][$parent->location_name][$parent->transport_id] = $parent->transport_name;
		}
	
		$transports  = Transport::where(array('type'=>2))->get();
		$builder = array();
		$counter_group = 0;
		foreach($transports as $group){
			if($group->parent_id == 0){
				$builder[$counter_group]["text"] = $group->transport_name."[".$group->location->location_name."]";
				$builder[$counter_group]["transport_id"] = $group->transport_id;
				$counter_child = 0;
				foreach($transports as $child){
					if($group->transport_id == $child->parent_id){
						$builder[$counter_group]["nodes"][$counter_child]["text"] = $child->transport_name;
						$builder[$counter_group]["nodes"][$counter_child]["transport_id"] = $child->transport_id;
						$counter_child++;
					}
				}
				$counter_group++;
			}
		}
		$dataset["transports"] = json_encode($builder, true);
		//pr($dataset,1);
		return View::make('admin.locations.nearby', array("dataset"=>$dataset));
	}
	
	public function addnearbygroup(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'location_id' => 'required',
			'group_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.nearby')->withErrors($validator)->withInput();
        }
		
		$transport = new Transport();
		
		$transport->parent_id = 0;
		$transport->location_id = Input::get('location_id');
		$transport->transport_name = Input::get('group_name');
		$transport->type = 2;
        if($transport->save()){
			return Redirect::route('location.nearby')->with('success','NearBy group successfully added in ThaiBricks.');
		}
	}
	
	public function addnearby(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$validators = array(
			'transport_group' => 'required',
			'transport_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.nearby')->withErrors($validator)->withInput();
        }
		
		$transport = new Transport();
		$transport->type=2;
		$transport->parent_id = Input::get('transport_group');
		$transport->transport_name = Input::get('transport_name');
        if($transport->save()){
			return Redirect::route('location.nearby')->with('success','NearBy successfully added in ThaiBricks.');
		}
	}
	
	
	

	function update_transport(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$transport = new Transport();
		$tr = $transport ::find(Input::get('transport_id'));
		$tr->parent_id = Input::get('parent_id');
		$tr->transport_name = Input::get('transport_name');
		$tr->save();
		echo json_encode($tr);exit;
		//DB::statement('UPDATE pr_location_transports SET transport_name = "'.Input::get('transport_name').'" WHERE transport_id = '.Input::get('transport_id'));

	}

	function get_transport_tree($type=1){
		

		$transports  = Transport::where(array('type'=>$type))->get();
		$builder = array();
		$counter_group = 0;
		//pr($transports,1);
		$queries = DB::getQueryLog();
		//echo $last_query = end($queries);
		$k = 0;
		foreach($transports as  $group){

			if($group->parent_id == 0){
				$builder[$k]["text"] = $group->transport_name."[".$group->location->location_name."]";
				$builder[$k]["transport_name"] = $group->transport_name;
				$builder[$k]["transport_id"] = $group->transport_id;
				$builder[$k]["parent_id"] = $group->parent_id;
				//$builder[$k]["nodes"] = array();
				$ck =0;
				foreach($transports as $child){
					if($group->transport_id == $child->parent_id){
						$builder[$k]["nodes"][$ck]["text"] = $child->transport_name;
						$builder[$k]["nodes"][$ck]["transport_id"] = $child->transport_id;
						$builder[$k]["nodes"][$ck]["transport_name"] = $child->transport_name;
						$builder[$k]["nodes"][$ck]["parent_id"] = $child->parent_id;
						$ck++;
					}
				}
				$k++;
			}
			
		}
		//pr($builder,1);
		echo json_encode($builder, true);exit;

	}

	function get_location_tree(){
		$locations  = Location::all();
		$builder = array();
		$counter_parent = 0;
		foreach($locations as $parent){
			if($parent->parent_id == 0){
				$builder[$counter_parent]["text"] = $parent->location_name;
				$builder[$counter_parent]["location_name"] = $parent->location_name;
				$builder[$counter_parent]["location_id"] = $parent->location_id;
				$builder[$counter_parent]["parent_id"] = $parent->parent_id;
				$counter_child = 0;
				foreach($locations as $child){
					if($parent->location_id == $child->parent_id){
						$builder[$counter_parent]["nodes"][$counter_child]["text"] = $child->location_name;
						$builder[$counter_parent]["nodes"][$counter_child]["location_name"] = $child->location_name;
						$builder[$counter_parent]["nodes"][$counter_child]["location_id"] = $child->location_id;
						$builder[$counter_parent]["nodes"][$counter_child]["parent_id"] = $child->parent_id;
						$counter_child++;
					}
				}
				$counter_parent++;
			}
		}
		echo json_encode($builder, true);

	}

	function update_location(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$location = new Location();
		$tr = $location ::find(Input::get('location_id'));
		$tr->parent_id = Input::get('parent_id');
		$tr->location_name = Input::get('location_name');
		$tr->save();
		echo json_encode($tr);exit;
		//DB::statement('UPDATE pr_location_transports SET transport_name = "'.Input::get('transport_name').'" WHERE transport_id = '.Input::get('transport_id'));

	}

}