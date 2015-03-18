<?php

use Illuminate\Routing\Controller;

class AdminsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	/*
	function __construct(){
		if(!Session::has('admin')){
			return Redirect::route('property.create')->with('success','Please Login first.');
		}
	}*/
	public function index()
	{
		return View::make('admin.layouts.signin');
	}
	public function login()
	{
		//pr(Input::All(),1);
		if(Input::get('username')=='admin' && Input::get('password')=='admin123'){
			$admin = new stdClass();
			$admin->username = 'admin';
			$admin->password = 'admin123';			
			Session::put('admin', $admin);
			return Redirect::route('admin.dashboard');
		}else{
			return Redirect::route('admin.signin')->with('info','Invalid Login');
		}
	}
	public function logout()
	{
		Session::forget('admin');
		return Redirect::route('admin.signin');
	}
	public function dashboard()
	{
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}
		$properties = new Property();
		$dataset["list"] = $properties->get_properties(null,null,null,null,null,null,null,array('pr_properties.status'=>'0'));
		return View::make('admin.property.list', array("dataset"=>$dataset));
	}

	public function property_list()
	{
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$properties = new Property();
		$dataset["list"] = $properties->get_properties(null,null,null,null,null,null,null,null);
		return View::make('admin.property.list', array("dataset"=>$dataset));
	}

	function property_activate(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$ids = Input::get('ids');

		$properties = new Property();
		$properties->activate($ids);
		//pr($ids,1);
		if(Request::ajax()){
			$arr['meaasge'] = 'Selected properties are successfuly activeted';
			$arr['error'] = 0;
		}else{
			return Redirect::route('admin.property.list')->with("error", "Selected properties are successfuly activeted.");	
		}
	}


	public function user_list()
	{
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$user = new User();
		$dataset["list"] = $user::select('*')
							->leftJoin('pr_locations','pr_locations.location_id','=','ac_users.location')
							->orderBy('user_id','desc')
							->get();
		
		//pr($dataset['list'],1);
		return View::make('admin.users.list', array("dataset"=>$dataset));
	}

	function user_activate(){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$ids = Input::get('ids');

		$properties = new Property();
		$properties->activate($ids);
		//pr($ids,1);
		if(Request::ajax()){
			$arr['meaasge'] = 'Selected properties are successfuly activeted';
			$arr['error'] = 0;
		}else{
			return Redirect::route('admin.property.list')->with("error", "Selected properties are successfuly activeted.");	
		}
	}

	function userchangestatus($id=0){
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}
		DB::statement('UPDATE ac_users SET status  = IF(status=1,0,1) WHERE user_id = '.$id);
		return Redirect::route('admin.users.list');	
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
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

	function admin_auth($data=array('redirect_key'=>'admin.signin','msg'=>'Please Login First.')){
		if(!Session::has('admin')){
			
			return Redirect::route('admin.signin')->with('info',$data['msg']);
		}
	}

	public function newsletters()
	{
		if(!Session::has('admin')){			
			return Redirect::route('admin.signin')->with('info','Please Login First');
		}

		$dataset["list"] = DB::table('nw_newsletters')
							->orderBy('newsletter_id','desc')
							->get();
		
		//pr($dataset['list'],1);
		return View::make('admin.newsletter.list', array("dataset"=>$dataset));
	}

}