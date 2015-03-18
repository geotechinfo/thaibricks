<?php

use Illuminate\Routing\Controller;

class AdminsAttributesController extends Controller {

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

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create(){
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}
		$rules = ['deal_id' => Input::get('deal_id'), 'type_id' => Input::get('type_id'), 'group_id' => Input::get('group_id'), 'attribute_id' => Input::get('attribute_id')];
		$relation = Relation::where($rules)->get();

		if(!$relation->isEmpty()){
			return Redirect::route('attribute.relation')->withInput();
		}else{
			$relation = new Relation();
			$relation->deal_id = Input::get('deal_id');
			$relation->type_id = Input::get('type_id');
			$relation->group_id = Input::get('group_id');
			$relation->attribute_id = Input::get('attribute_id');
			$relation->save();
			
			return Redirect::route('attribute.relation')->with('success','Attribute relation successfully added in ThaiBricks.');
		}
		return Redirect::route('attribute.relation')->withInput();
		
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
	
	public function relation(){		
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}
		
		$properties = new Property();
		$dataset["deals"] = $properties->getlist_deals();
		$dataset["types"] = $properties->getlist_types();
		
		$relations = new Relation();
		$dataset["groups"] = $relations->getlist_groups();
		$dataset["attributes"] = $relations->getlist_attributes();
		
		$builder = $relations->relations();
		$dataset["relations"] = json_encode($builder);
		
		return View::make('admin.attributes.relation', array("dataset"=>$dataset));
	}

}