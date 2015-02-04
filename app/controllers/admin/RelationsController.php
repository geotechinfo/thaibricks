<?php

use Illuminate\Routing\Controller;

class RelationsController extends Controller {

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
		$relations = new Relation();
		
		$dataset["deals"] = $relations->deals();
		$dataset["types"] = $relations->types();
		$dataset["groups"] = $relations->groups();
		$dataset["attributes"] = $relations->attributes();
		return View::make('admin.relations.create', array("dataset"=>$dataset));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store(){
		$rules = ['deal_id' => Input::get('deal_id'), 'type_id' => Input::get('type_id'), 'group_id' => Input::get('group_id'), 'attribute_id' => Input::get('attribute_id')];
		$relation = Relation::where($rules)->get();

		if(!$relation->isEmpty()){
			Session::flash('exist', true);
		}else{
			$relation = new Relation();
			$relation->deal_id = Input::get('deal_id');
			$relation->type_id = Input::get('type_id');
			$relation->group_id = Input::get('group_id');
			$relation->attribute_id = Input::get('attribute_id');
			$relation->save();
			
			Session::flash('success', true);
		}
		return Redirect::route('admin.relation.create')->withInput();
		
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
		$relations = new Relation();
		$dataset = $relations->relations();
		
		if(empty($dataset)){
			Session::flash('empty', true);
		}
		$dataset = json_encode($dataset);
		return View::make('admin.relations.show', array("dataset"=>$dataset));
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