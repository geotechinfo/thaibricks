<?php //namespace ;

use Illuminate\Routing\Controller;

class UsersController extends Controller {

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
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only(['first_name','last_name', 'location', 'email', 'phone', 'password', 'password_confirmation']);

		$validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
				'location' => 'required',
                'email' => 'required|email|unique:ac_users,email',
				'phone' => 'required|numeric|unique:ac_users,phone',
                'password' => 'required|min:6|confirmed',
                'password_confirmation'=> 'required|min:6'
            ]
        );

		if($validator->fails()){
            return Redirect::route('create')->withErrors($validator)->withInput();
        }

        $user = User::create(array(
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
			'location' => Input::get('location'),
			'email' => Input::get('email'),
			'phone' => Input::get('phone'),
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password'))
		));
        if($user){
			/*Mail::send('template.email.activate', ['link' => URL::route('activate', $code), 'username' => $username], function($message) use ($user)
            {
                $message->to($user->email, $user->username)->subject('Account Registration');
            });*/
		
            Auth::login($user);
            return Redirect::route('property.mylist', array("me"));
        }

        return Redirect::route('create')->withInput();
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
	
	public function login(){
		return View::make('users.login');
	}
	public function handleLogin(){
		$data = Input::only(['email', 'password']);
		
		$validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if($validator->fails()){
            return Redirect::route('login')->withErrors($validator)->withInput();
        }else{
			$remember = true;
			$auth = Auth::attempt(array(
					'email' => Input::get('email'),
					'password' => Input::get('password')
			), $remember);
	
			if($auth) {
				return Redirect::route('property.mylist', array("me"));
			}else{
				Session::flash('error', true);
				return Redirect::route('login')->withInput();
			}
        }
	}
	
	public function profile(){
		$relations = new Relation();
		
		$dataset["deals"] = $relations->deals();
		$dataset["types"] = $relations->types();

		return View::make('users.profile', array("dataset"=>$dataset));
	}
	
	public function change(){
	
	}
	
	public function logout(){
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::route('login');
	}

}