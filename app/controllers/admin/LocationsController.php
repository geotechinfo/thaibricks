<?php

use Illuminate\Routing\Controller;

class LocationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function location()
	{
		$rules = ["parent_id" => 0];
		$parents = Location::where($rules)->get();
		$dataset["parents"] = array();
		$dataset["parents"][0] = "Not Applicable";
		foreach($parents as $parent){
			$dataset["parents"][$parent->location_id] = $parent->location_name;
		}
		
		$locations  = Location::all();
		$builder = array();
		$counter_parent = 0;
		foreach($locations as $parent){
			if($parent->parent_id == 0){
				$builder[$counter_parent]["text"] = $parent->location_name;
				$counter_child = 0;
				foreach($locations as $child){
					if($parent->location_id == $child->parent_id){
						$builder[$counter_parent]["nodes"][$counter_child]["text"] = $child->location_name;
						$counter_child++;
					}
				}
				$counter_parent++;
			}
		}
		$dataset["locations"] = json_encode($builder, true);

		return View::make('admin.locations.show', array("dataset"=>$dataset));
	}
	
	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store(){
		$validators = array(
			'location_name' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('location.transport')->withErrors($validator)->withInput();
        }
		
		$location = new Location();
		
		$location->parent_id = Input::get('parent_location');
		$location->location_name = Input::get('location_name');
        if($location->save()){
			return Redirect::route('location.transport')->with('success','Location successfully added in ThaiBricks.');
		}
	}
	
	public function transport()
	{
		$rules = ["parent_id" => 0];
		$locations = Location::where($rules)->get();
		$dataset["locations"] = array();
		$dataset["locations"][""] = "Select Location";
		foreach($locations as $location){
			$dataset["locations"][$location->location_id] = $location->location_name;
		}
	
		$rules = ["parent_id" => 0];
		$parents = Transport::where($rules)->get();
		$dataset["groups"] = array();
		$dataset["groups"][""] = "Select Transport Group";
		foreach($parents as $parent){
			$dataset["groups"][$parent->transport_id] = $parent->transport_name;
		}
		
		$transports  = Transport::all();
		$builder = array();
		$counter_group = 0;
		foreach($transports as $group){
			if($group->parent_id == 0){
				$builder[$counter_group]["text"] = $group->transport_name;
				$counter_child = 0;
				foreach($transports as $child){
					if($group->transport_id == $child->parent_id){
						$builder[$counter_group]["nodes"][$counter_child]["text"] = $child->transport_name;
						$counter_child++;
					}
				}
				$counter_group++;
			}
		}
		$dataset["transports"] = json_encode($builder, true);

		return View::make('admin.locations.view', array("dataset"=>$dataset));
	}
	
	public function addgroup(){
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

}