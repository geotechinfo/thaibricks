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
		$data = Input::only(['first_name','last_name', 'location','description', 'email', 'phone', 'password', 'password_confirmation','terms_condition']);

		$validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
				'location' => 'required',
				'description' => 'required|min:10',
                'email' => 'required|email|unique:ac_users,email',
				'phone' => 'required|numeric|unique:ac_users,phone',
                'password' => 'required|min:6|confirmed',
                'password_confirmation'=> 'required|min:6',
                'terms_condition'=>'required'
            ]
        );

		if($validator->fails()){
            return Redirect::route('create')->withErrors($validator)->withInput();
        }

        $user = User::create(
				        array(
				            'first_name' => Input::get('first_name'),
				            'last_name' => Input::get('last_name'),
							'location' => Input::get('location'),
							'email' => Input::get('email'),
							'description' => Input::get('description'),
							'phone' => Input::get('phone'),
				            'username' => Input::get('username'),
				            'password' => Hash::make(Input::get('password')),
				            'status' => '0'				            	
						)
	     		);
        if($user){
        	$nw['newsletter_user'] = $user->first_name." ".$user->last_name;
        	$nw['newsletter_email'] = $user->email;
        	$nw['created'] = date('Y-m-d H:i:s');
        	$id  = DB::table('nw_newsletters')->insertGetId($nw);

        	$dataset['user'] =$user;
        	$dataset['password'] =  Input::get('password');
			Mail::send('emails.signup', ['dataset' => $dataset], function($message) use ($user)
            {
                $message->to($user->email, $user->username)->subject('You have been successfully registered with thaibricks.');
            });
		
            Auth::login($user);
            return Redirect::route('property.myproperties');
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
		$data = Input::only(['first_name','last_name', 'location', 'description','email', 'phone', 'password', 'password_confirmation']);

		$validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
				'location' => 'required|min:1',
				'description' => 'required|min:10',
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
        	$user->description = $data['description'];


        	if($user->save()){
        	/*Mail::send('template.emails.activate', ['link' => URL::route('activate', $code), 'username' => $username], function($message) use ($user)
            {
                $message->to($user->email, $user->username)->subject('Account Registration');
            });*/
		
            //Auth::login($user);
				Session::flash('success', 'Your Profile has been successfully updated');
            	
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
		return View::make('users.changepassword');
	}

	public function do_changepassword()
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
            return Redirect::route('profile.changepassword')->withErrors($validator)->withInput();
        }else{

        	$user = User::find(Auth::User()->user_id);
        	
        	if (Hash::check($data['password'], $user->password)){
        		$user->password = Hash::make($data['new_password']);
        		//die($user->password);	
        		if($user->save()){		        	
					Session::flash('success', 'Your Password has been successfully changed.');
		           	return Redirect::route('profile');
	        	}else{
	        		Session::flash('success', 'Unable to change your password.');	

	        	}
        	}else{
        		Session::flash('error', 'Please Enter Correct Old Password.');
        		return Redirect::route('profile.changepassword',array('#changePass'));
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
					'email' 	=> Input::get('email'),
					'password' 	=> Input::get('password')
			), $remember);
	
			if($auth) {
				return Redirect::route('property.myproperties');
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
		$dataset['banner_panel'] = View::make('layouts.banner_panel');
		
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
	
	public function userimages()
	{
		return View::make('users.userimages');
	}

	public function profileimage()
	{
		return View::make('users.profileimage');
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

	public function bannerimage()
	{
		return View::make('users.bannerimage');
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

	/*function mail_test(){

		$user  = User::find(9);
		//pr($user,1);
		$dataset['user'] =$user;
    	$dataset['password'] =  'asdfghjkl';
		Mail::send('emails.signup', ['dataset' => $dataset], function($message) use ($user)
        {
            $message->to('santanujana1987@yopmail.com', 'Santanu Jana')->subject('Account Registration');
        });
	}*/
	
	function email_verification($token=''){
		//die($token);
		$sql = 'UPDATE ac_users SET is_email_verified = 1 WHERE md5(email) = "'.$token.'"';
		DB::statement($sql);
		$r = DB::select('Select * FROM ac_users WHERE is_email_verified = 1 AND md5(email) = "'.$token.'"');

		//pr($r[0]->cnt,1);
		if(isset($r[0]->user_id) && $r[0]->user_id>0){
			//die(Crypt::decrypt('$2y$10$pkVwU1PDlJOltVlboXrbrO.JuosygZKaLVTHaCPWo82wsVeeCtLAG'));

			return Redirect::route('login')->with('success','Your email has been successfully verified.');
		}else{
			return Redirect::route('login')->with('info','Unable to verified your email');
		}
	}
	
	function userimagecreate(){
		$WI = new WideImage;
		
		$raw = Input::get('image_raw_data');
		$image_file = time().".png";
		
		if(Input::get('field')=='bannerImage'){
			$file_path = 'files/banners/';
			$image_file = "banner_".Auth::user()->user_id.".png";
			$user = User::find(Auth::User()->user_id);
			$user->banner_image = $image_file;
			$user->save();
			$WI::load(Input::get('imagedata'))->saveToFile($file_path.$image_file);
		}
		if(Input::get('field')=='profileImage'){
			$file_path = 'files/profiles/';
			$image_file = "profile_".Auth::user()->user_id.".png";			
			$user = User::find(Auth::User()->user_id);
			$user->profile_image = $image_file;
			$user->save();
			$WI::load(Input::get('imagedata'))->saveToFile($file_path.$image_file);
		}

		
	}

	public function agents($location_name=''){
		$url_location = str_replace('_', ' ',  $location_name);
		$location = DB::table('pr_locations')->where('location_name','=',$url_location)->first()->location_id;
		$location = ($location)?$location:'0';
		//$dataset = array('selected'=>LOCATION_ID);
		//die($location);
		//$location = LOCATION_ID;
		$q = DB::table('ac_users')
				->leftJoin('pr_locations','pr_locations.location_id',"=",'ac_users.location')
				->where('status','1')				
				->orderBy('user_id','desc');
		if($location>0){
			
			$q->where('location',$location);
		}		
		$dataset['list']=$q->get(); 
		//pr($dataset['list'],1);
		//echo "ok";
		$dataset['location']=$location;
		return View::make('users.agents',array('dataset'=>$dataset));
	}

	public function agent($title = ''){
		$ar = explode('_', $title);
		$code = end($ar);
		$r = DB::select("SELECT user_id FROM ac_users WHERE user_code = '".$code."' AND status = 1");
		//pr($r[0],1);
		if(!isset($r[0])){
			return Response::view('errors.missing', array(), 404);
		}
		$id = (isset($r[0])?$r[0]->user_id:0);
		$dataset['user'] = User::find($id);		
		$dataset['user']->location_name = Location::find($dataset['user']->location)->location_name;
		$dataset['banner_panel'] = View::make('layouts.banner_panel',$dataset);
		
		$properties = new Property();		
		$dataset["properties"] = $properties->get_properties(array("user_id"=>$id, "property_status"=>1));
		
		if(count($dataset["properties"])==0){
			Session::flash('info', "You don't have any properties yet!");
		}
		$properties->limit=12;
		$dataset["hot"] = $properties->get_properties(array("is_hot"=>1, "property_status"=>1));
		$dataset["user_id"] = $id;
		
		return View::make('users.mylist', array("dataset"=>$dataset));
	}

	function forgotpassword(){
		$p = Input::All();
		$user = User::where('email','=',$p['email'])->first();
		//pr($user,1);

		if(isset($user->user_id)){
			$reset_code = rand(100000,999999);
			$user = User::find($user->user_id);
			$user->reset_code = $reset_code;
			$user->save();
			$dataset = $user;
			$dataset['reset_link'] = URL::action('UsersController@reset_password',['uid'=>$user->user_id,'reset_code'=>$reset_code]);
			Mail::send('emails.forgotpassword', ['dataset' => $dataset], function($message) use ($user)
	        {
	            $message->to($user->email, $user->username)->subject('Reset Password');
	        });
	        return Redirect::route('login')->with('info','Password reset link successfully sent to your mail.Please Check your mail');
		}else{
			return Redirect::route('login')->with('info','This is not a registred email in our site');
		}
		
	}

	function reset_password($id,$code){
		
		$dataset['user_id'] = $id;
		$dataset['reset_code'] = $code;
		return View::make('users.reset_password',array('dataset'=>$dataset));
		//die('ok');
	}

	function do_reset_password(){
		$p = Input::All();
		$row = DB::table('ac_users')->where($p['con'])->first();
		$user = User::find($row->user_id);
		$user->password = Hash::make($p['new_password']);
		$user->save();
		//$dataset = $user;
		//User::update(array('password'=>Hash::make($p['new_password'])))->where($p['con']);
		return Redirect::route('login')->with('success','Your Password has been successfully updated');
	}
}