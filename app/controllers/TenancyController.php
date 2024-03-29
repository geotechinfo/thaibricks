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
		$dataset["properties"] = $properties->get_properties(array("user_id"=>$id,'property_status'=>1));
		
		return View::make('tenancies.create', array("dataset"=>$dataset));
	}
	
	public function store()
	{
		$validators = array(
			'property' => 'required',
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
			$tenancy->property_id = Input::get('property');
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
		$dataset["properties"] = $properties->get_properties(array("user_id"=>$user_id,'is_tenancy'=>array(0,1)));
		//pr($dataset["properties"]);
		$tenancies = new Tenancy();
		$tenancy = $tenancies->get_tenancies(null, $id);
		$dataset["tenancy"] = $tenancy[0];
		$dataset['is_edit'] = 1;
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
		if(count($dataset["tenancies"]) == 0){
			Session::flash('info', "You don't have any tenancies yet!");
		}
		//echo "<pre>";print_r($dataset["tenancies"]);die;
		$document = new Document();
		$dataset['document_head']=$document->getlist_head();
		$dataset['documents']=$document->getlist_document(Auth::User()->user_id);
		

		return View::make('tenancies.list', array("dataset"=>$dataset));
	}
	
	public function transaction_list(){
		$user_id = Auth::user()->user_id;
		$transaction = new Transaction();
		
		
		$dataset['list'] = $transaction->getlist(array('user_id'=>$user_id),array('orderby'=>array('transaction_id DESC')));
		
		
		return View::make('tenancies.transaction_list', array("dataset"=>$dataset));
	}	

	public function transaction($id){
		$user_id = Auth::user()->user_id;
	
		$tenancies = new Tenancy();
		$dataset["tenancies"] = $tenancies->get_tenancies($user_id);
		$dataset["tenancy_id"] = $id;
		
		$dataset['vendors'] = DB::table('ll_vendors')->where(array('user_id'=>Auth::User()->user_id))->get();
		$transaction = new Transaction();
		$dataset["transaction_heads"] = $transaction->getlist_heads();
		
		return View::make('tenancies.transaction', array("dataset"=>$dataset));
	}

	public function transaction_edit($id){
		$user_id = Auth::user()->user_id;
	
		$tenancies = new Tenancy();
		$dataset["tenancies"] = $tenancies->get_tenancies($user_id);
		$dataset["tenancy_id"] = '';//$id;
		$dataset["is_edit"] = 1;
		$dataset['vendors'] = DB::table('ll_vendors')->where(array('user_id'=>Auth::User()->user_id))->get();
		$transaction = new Transaction();
		$dataset["transaction_heads"] = $transaction->getlist_heads();
		$r = $transaction->getlist(array('transaction_id'=>$id,'user_id'=>$user_id));
		$dataset["transaction"] = isset($r[0])?$r[0]:array();
		return View::make('tenancies.transaction', array("dataset"=>$dataset));
	}

	public function addvendor(){
		$user_id = Auth::user()->user_id;
	
		$insert['user_id'] =$user_id;
		$insert['vendor_name'] =Input::get('vendor_name');
		$insert['vendor_phone'] =Input::get('vendor_phone');
		$insert['vendor_email'] =Input::get('vendor_email');
		$insert['vendor_address'] =Input::get('vendor_address');
		if (Request::ajax())
		{
		   	$vendor_id = DB::table('ll_vendors')->insertGetId($insert);		
			$row = Vendor::find($vendor_id);
			echo json_encode($row);exit;
		}else{
			$validators = array(
				'vendor_name' => 'required',
				'vendor_phone' => 'required|numeric',
				'vendor_email' => 'required|email',
				'vendor_address' => 'required'
			);
			$validator = Validator::make(
	            Input::all(),
	            $validators
	        );

			if($validator->fails()){
	            return Redirect::route('tenancy.vendor_create')->withErrors($validator)->withInput();
	            //return Redirect::action('TenancyController@vendor_create', array($id));
	        }else{
	        	echo $vendor_id = Input::get('vendor_id',0);
	        	//pr(Input::All(),1);
	        	$vendor_id = DB::table('ll_vendors')->insertGetId($insert);		
	        	return Redirect::route('tenancy.vendor_list')->with('success','Vendor successfully Added in ThaiBricks.');;	
	        }
		}
		
	}

public function updatevendor(){
		$user_id = Auth::user()->user_id;
	
		$insert['user_id'] =$user_id;
		$insert['vendor_name'] =Input::get('vendor_name');
		$insert['vendor_phone'] =Input::get('vendor_phone');
		$insert['vendor_email'] =Input::get('vendor_email');
		$insert['vendor_address'] =Input::get('vendor_address');
		$id = Input::get('vendor_id');
		//pr($id,0);
		$validators = array(
			'vendor_id' => 'required',
			'vendor_name' => 'required',
			'vendor_phone' => 'required|numeric',
			'vendor_email' => 'required|email',
			'vendor_address' => 'required'
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('tenancy.vendor_edit', array('id'=>$id))->withErrors($validator)->withInput();
            //return Redirect::action('TenancyController@vendor_create', array($id));
        }else{
        	echo $vendor_id = Input::get('vendor_id',0);
        	//pr(Input::All(),1);
        	$vendor_id = DB::table('ll_vendors')->where('vendor_id',$id)->update($insert);		
        	return Redirect::route('tenancy.vendor_list')->with('success','Vendor successfully Updated in ThaiBricks.');;	
        }
		
		
	}
	

	public function vendor_edit($id = 0){
		$user_id = Auth::user()->user_id;
		$vendor = new Vendor();
		$condi  = array('user_id'=>$user_id);
		if($id>0){
			$condi['vendor_id'] = $id;
			$r = $vendor->getlist($condi);
			$dataset['vendor'] = isset($r[0])?$r[0]:$vendor;
		}else{
			$dataset['vendor'] = $vendor;
		}
		return View::make('tenancies.create_vendor', array("dataset"=>$dataset));
	}

	public function vendor_create(){
		$user_id = Auth::user()->user_id;
		$vendor = new Vendor();		
		$dataset['vendor'] = $vendor;		
		return View::make('tenancies.create_vendor', array("dataset"=>$dataset));
	}

	public function vendor_list(){
		$user_id = Auth::user()->user_id;
		$vendor = new Vendor();
		
		
		$dataset['list'] = $vendor->getlist(array('user_id'=>$user_id),array('orderby'=>array('vendor_id DESC')));
		//pr($dataset['list']);
		
		return View::make('tenancies.vendor_list', array("dataset"=>$dataset));
	}
	
	public function transactionsave($id){
		$validators = array(
			/*'tenancy_name' => 'required',*/
			'transaction_head' => 'required',
			'transaction_date' => 'required',
			'transaction_amount' => 'required|numeric|min:0'			
		);
		$validator = Validator::make(
            Input::all(),
            $validators
        );

		if($validator->fails()){
            return Redirect::route('tenancy.transaction', array($id))->withErrors($validator)->withInput();
        }
		
		//$transaction = new Transaction();
		$transaction['transaction_id'] = Input::get('transaction_id');
		$transaction['user_id'] = Auth::user()->user_id;
		$transaction['tenancy_id'] = Input::get('tenancy_name');
		$transaction['transaction_head_id'] = Input::get('transaction_head');
		
		$transaction['vendor_id'] = Input::get('vendor_id',0);
		$transaction['transaction_date'] = CommonHelper::dateToDb(Input::get('transaction_date'));
		$transaction['amount'] = Input::get('transaction_amount');
		
		if($transaction['transaction_id']==0){
			$transaction_id = DB::table('ll_transactions')->insertGetId($transaction);
			if($transaction_id){
				return Redirect::route('tenancy.transaction_list')->with('success', 'Transaction successfully added.');
			}
		}else{
			
			DB::table('ll_transactions')
            ->where('transaction_id', $transaction['transaction_id'])
            ->update($transaction);
            return Redirect::route('tenancy.transaction_list')->with('success', 'Transaction successfully Updated.');
		}
        
	}
	public function adddocument(){
		//dd($_FILES);die;
		$document = new Document;
		
		if(Input::get('document_id')){
			$insert_document_tenancy = array();
			
			$insert_document_tenancy['user_id']=Auth::User()->user_id;
			$insert_document_tenancy['tenancy_id']=Input::get('tenancy_id');
			$insert_document_tenancy['document_id']=Input::get('document_id');
			try{
				$document_tenancy_id = DB::table('ll_document_tenancy')->insertGetId($insert_document_tenancy);
				return Redirect::route('tenancy.tenancies')->with('success','Additional Document successfully Attached With This Tenancy in ThaiBricks.');	
			}catch(Exception $e){
				//Session::flash('danger', "This Document Already Added.");
				return Redirect::route('tenancy.tenancies')->with('info','This Document Already Added.');		
			}
		}else{
			if (Input::hasFile('upfile'))
			{
				$insert_document = array();
			    $newfile = time()."".rand(10000,999999).".".$extension = Input::file('upfile')->getClientOriginalExtension();
			    $destinationPath= 'files/documents/';
			    Input::file('upfile')->move($destinationPath,$newfile);
			    $insert_document['user_id']=Auth::User()->user_id;
			    $insert_document['document_head_id']=Input::get('document_head_id');
			    $insert_document['document_file']=$newfile;
			    $insert_document['documentation_date']=CommonHelper::dateToDb(Input::get('documentation_date'));

				if(Input::get('expiry_date')){
					$insert_document['expiry_date'] = CommonHelper::dateToDb(Input::get('expiry_date'));
				}
				$lastdocumentid = DB::table('ll_documents')->insertGetId($insert_document);

				$insert_document_tenancy = array();
				$insert_document_tenancy['document_id'] = $lastdocumentid;
				$insert_document_tenancy['tenancy_id'] = Input::get('tenancy_id');
				$insert_document_tenancy['user_id']=Auth::User()->user_id;
				$document_tenancy_id = DB::table('ll_document_tenancy')->insertGetId($insert_document_tenancy);
				return Redirect::route('tenancy.tenancies')->with('success','Additional Document successfully added in ThaiBricks.');	
			}else{
				return Redirect::route('tenancy.tenancies')->with('info','Please Select Document');		
			}
		}
	}
	public function mail_alert(){
		$sql_alert = "SELECT 
						d.*,
						dh.*,
						u.first_name,
						u.last_name,
						u.email,
						DATE_ADD(CURDATE(),INTERVAL ``.`alert_before` DAY) AS EXP_DATE
					FROM ll_documents d
					LEFT JOIN ll_document_heads dh ON dh.document_head_id = d.document_head_id
					LEFT JOIN ac_users u ON u.user_id = d.user_id
					HAVING 	EXP_DATE = d.expiry_date			
		";

		$all = DB::select($sql_alert);
		pr($all);
		/*foreach ($all as $k => $v) {
			Mail::send('template.email.documanet_alert', ['data' =>$v], function($message){
                $message->to($v->email, $v->first_name." ".$v->last_name)->subject('Alert For Document Expiration');
            });
		}*/
	}
}
