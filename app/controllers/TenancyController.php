<?php

class TenancyController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function create(){
		$id = Auth::user()->user_id;
	
		$properties = new Property();
		$dataset["properties"] = $properties->get_properties($id, null);
		
		return View::make('tenancies.create', array("dataset"=>$dataset));
	}
	
	public function store()
	{
		$validators = array(
			'property_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|numeric',
			'address' => 'required',
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('tenancy.create')->withErrors($validator)->withInput();
        }
		
		$agreement_file = Input::file('agreement_file');
		if($agreement_file != ""){
			$extension_file = $agreement_file->guessClientExtension();
			if(in_array($extension_file, array("pdf", "doc", "docx"))){
				$file_path = 'files/agreements';
				$file_name = rand(1111111111,9999999999).'.'.$extension_file;
				$agreement_file->move($file_path, $file_name);
			}else{
				return Redirect::route('tenancy.create')->with("error", "You can upload pdf, doc and docx type file only.")->withInput();	
			}
		}
		
		$tenant = new Tenant();
		$tenant->first_name = Input::get('first_name');
		$tenant->last_name = Input::get('last_name');
		$tenant->email = Input::get('email');
		$tenant->phone = Input::get('phone');
		$tenant->address = Input::get('address');
        if($tenant->save()){
			$tenancy = new Tenancy();
			$tenancy->property_id = Input::get('property_id');
			$tenancy->tenant_id = $tenant->tenant_id;
			$tenancy->agreement_file = ($file_name != "") ? $file_name : "";
			$tenancy->start_date = CommonHelper::dateToDb(Input::get('start_date'));
			$tenancy->end_date = CommonHelper::dateToDb(Input::get('end_date'));
			$tenancy->amount = 100;
			$tenancy->basis_term = "M";
			if($tenancy->save()){
				return Redirect::route('tenancy.tenancies')->with('success','Tenancy successfully added in ThaiBricks.');	
			}
		}
	}
	
	public function edit($id){
		$user_id = Auth::user()->user_id;
	
		$properties = new Property();
		$dataset["properties"] = $properties->get_properties($user_id, null);
				
		$tenancies = new Tenancy();
		$tenancy = $tenancies->get_tenancies(null, $id);
		$dataset["tenancy"] = $tenancy[0];

		return View::make('tenancies.create', array("dataset"=>$dataset));
	}
	
	public function update($id)
	{
		$validators = array(
			'property_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|numeric',
			'address' => 'required',
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('tenancy.edit', array($id))->withErrors($validator)->withInput();
        }
		
		$agreement_file = Input::file('agreement_file');
		if($agreement_file != ""){
			$extension_file = $agreement_file->guessClientExtension();
			if(in_array($extension_file, array("pdf", "doc", "docx"))){
				$file_path = 'files/agreements';
				$file_name = rand(1111111111,9999999999).'.'.$extension_file;
				$agreement_file->move($file_path, $file_name);
			}else{
				return Redirect::route('tenancy.edit', array($id))->with("error", "You can upload pdf, doc and docx type file only.")->withInput();	
			}
		}
		
		$tenancy = Tenancy::find($id);
		$tenancy->property_id = Input::get('property_id');
		//$tenancy->tenant_id = $tenant->tenant_id;
		$tenancy->agreement_file = ($file_name != "") ? $file_name : $tenancy->agreement_file;
		$tenancy->start_date = CommonHelper::dateToDb(Input::get('start_date'));
		$tenancy->end_date = CommonHelper::dateToDb(Input::get('end_date'));
		$tenancy->amount = 100;
		$tenancy->basis_term = "M";
		if($tenancy->save()){
			$tenant = Tenant::find($tenancy->tenancy_id);
			$tenant->first_name = Input::get('first_name');
			$tenant->last_name = Input::get('last_name');
			$tenant->email = Input::get('email');
			$tenant->phone = Input::get('phone');
			$tenant->address = Input::get('address');
			if($tenant->save()){
				return Redirect::route('tenancy.tenancies')->with('success','Tenancy successfully updated in ThaiBricks.');
			}
		}
	}
	
	public function tenancies(){
		$id = Auth::user()->user_id;

		$tenancies = new Tenancy();		
		$dataset["tenancies"] = $tenancies->get_tenancies($id);
		if(empty($dataset["tenancies"])){
			Session::flash('info', "You don't have any tenancies yet!");
		}
		
		return View::make('tenancies.list', array("dataset"=>$dataset));
	}
	
	public function transaction($id){
		$id = Auth::user()->user_id;
	
		$tenancies = new Tenancy();
		$dataset["tenancies"] = $tenancies->get_tenancies($id);
		$dataset["tenancy_id"] = $id;
		
		return View::make('tenancies.transaction', array("dataset"=>$dataset));
	}
}
