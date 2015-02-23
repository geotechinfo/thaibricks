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
		$location = new Location;
		$dataset['locations']=$location->get_location_with_sub();
		
		return View::make('users.create',array('dataset'=>$dataset));
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
	public function update()
	{
		$data = Input::only(['first_name','last_name', 'location', 'email', 'phone', 'password', 'password_confirmation']);

		$validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
				'location' => 'required|min:1',
                'email' => 'required|email|unique:ac_users,email,'.Auth::User()->user_id.",user_id",
				'phone' => 'required|numeric|unique:ac_users,phone,'.Auth::User()->user_id.",user_id"
            ]
        );
		if($validator->fails()){
            return Redirect::route('profile',array('#profile_edit'))->withErrors($validator)->withInput();
        }else{
        	//dd($data);die;
        	$user = User::find(Auth::User()->user_id);
        	$user->first_name = $data['first_name'];
        	$user->last_name = $data['last_name'];
        	$user->location = $data['location'];
        	$user->email = $data['email'];
        	$user->phone = $data['phone'];

        	if($user->save()){
        	/*Mail::send('template.email.activate', ['link' => URL::route('activate', $code), 'username' => $username], function($message) use ($user)
            {
                $message->to($user->email, $user->username)->subject('Account Registration');
            });*/
		
            //Auth::login($user);
				Session::flash('success', 'Your Profile has been successfuly updated');
            	
        	}else{
        		Session::flash('success', 'Unable to Update Your Profile');	
        	}

        	return Redirect::route('profile');
        }

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function changepassword()
	{
		$data = Input::only(['password','new_password', 'new_password_confirmation']);

		$validator = Validator::make(
            $data,
            [
                'password' => 'required|min:6',
                'new_password' => 'required|min:6|confirmed',
                'new_password_confirmation'=> 'required|min:6'
            ]
        );
		if($validator->fails()){
            return Redirect::route('profile',array('#changePass'))->withErrors($validator)->withInput();
        }else{

        	$user = User::find(Auth::User()->user_id);
        	
        	if (Hash::check($data['password'], $user->password)){
        		$user->password = Hash::make($data['new_password']);
        		//die($user->password);	
        		if($user->save()){
		        	/*Mail::send('emails.changepassword', ['new_password' => $data['new_password'], 'username' => $user->email], function($message) use ($user)
		            {
		                $message->from('santanujana1987@gmail.com')->to($user->email, $user->first_name." ".$user->last_name)->subject('New Password');
		            });*/
					Session::flash('success', 'Your Password has been successfuly Changed');
		           	return Redirect::route('profile');
	        	}else{
	        		Session::flash('success', 'Unable to Change Your Password');	

	        	}
        	}else{
        		Session::flash('error', 'Please Enter Correct Old Password');
        		return Redirect::route('profile',array('#changePass'));
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
		$dataset = array();
		//echo Auth::user()->location;die;
		$location = new Location;
		$dataset['locations']=$location->get_location_with_sub();
		$dataset['banner_panel'] = View::make('properties.banner_panel');
		
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

	function changeprofileimage(){
		$image_files = $_FILES['image_files'];
		//$image_files = Input::file('image_files');
			
		$json = $image_files;
		if($image_files['error']==0){
			$file_path = 'files/profiles/';
			$file_name = rand(1111111111,9999999999).'.jpg';
			move_uploaded_file($image_files['tmp_name'], $file_path.$file_name);
			$json['new_name'] = $file_name;
			$json['file_url'] = URL::to('/')."/".$file_path.$file_name;
			$user = User::find(Auth::User()->user_id);
			$user->profile_image = $file_name;
			$user->save();
		}

		echo json_encode($json); exit;
	}

	function changebannerimage(){
		//$image_files = $_FILES['image_files'];
		//$image_files = Input::file('image_files');
		$WI = new WideImage;
				
		$json = $image_files;
		if($image_files['error']==0){
			$file_path = 'files/banners/';
			$file_name = rand(1111111111,9999999999).'.jpg';
			//move_uploaded_file($image_files['tmp_name'], $file_path.$file_name);
			$WI::load('image_files')
			->crop(0,0,'932','200')			
			->saveToFile($file_path.$file_name);
			
			$json['new_name'] = $file_name;
			$json['file_url'] = URL::to('/')."/".$file_path.$file_name;
			$user = User::find(Auth::User()->user_id);
			$user->banner_image = $file_name;
			$user->save();
		}

		echo json_encode($json); exit;
	}

}