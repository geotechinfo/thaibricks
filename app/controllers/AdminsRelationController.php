<?php

use Illuminate\Routing\Controller;

class AdminsRelationController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{		
		$g = DB::table('pr_groups')->where('parent_id','=',0)->get();
		$dataset['parent_group']['0']='Select Group';
		foreach ($g as $k=>$v) {
			$dataset['parent_group'][$v->group_id]=$v->group_name;
		}

		$g = DB::table('pr_types')->where('parent_id','=',0)->get();
		$dataset['parent_types']['0']='Select Transactipn Type';
		foreach ($g as $k=>$v) {
			$dataset['parent_types'][$v->type_id]=$v->type_name;
		}
		
		return View::make('admin.relation.index', array("dataset"=>$dataset));
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
	
	function get_deals_tree(){
		$json=array();
		$r = DB::table('pr_deals')
			->get();
		foreach ($r as $k => $v) {
			$json[]=array(
				'text'=>$v->deal_name,
				'deal_name'=>$v->deal_name,
				'deal_id'=>$v->deal_id,
				'nodes'=>array()
			);
		}
		echo json_encode($json);exit;
	}

	function get_types_tree(){
		$json=array();
		
		$r = DB::table('pr_types')->where('parent_id','=','0')->get();
		
		foreach ($r as $k => $v) {
			$child = DB::table('pr_types')->where(array('parent_id'=>$v->type_id))->get();
			
			$nodes = array();
			foreach ($child as $ck => $cv) {
				//pr($cv);
				$nodes[]=array(
					'text'=>$cv->type_name,
					'type_name'=>$cv->type_name,
					'type_id'=>$cv->type_id,
					'parent_id'=>$cv->parent_id
				);
			}
			$json[]=array(
				'text'=>$v->type_name,
				'type_name'=>$v->type_name,
				'type_id'=>$v->type_id,
				'parent_id'=>$v->parent_id,
				'nodes'=>$nodes 
			);
		}
		
		echo json_encode($json);exit;
	}

	function get_groups_tree(){
		$json=array();
		
		$r = DB::table('pr_groups')->where('parent_id','=','0')->get();
		
		foreach ($r as $k => $v) {
			$child = DB::table('pr_groups')->where(array('parent_id'=>$v->group_id))->get();
			
			$nodes = array();
			foreach ($child as $ck => $cv) {
				//pr($cv);
				$nodes[]=array(
					'text'=>$cv->group_name,
					'group_name'=>$cv->group_name,
					'group_id'=>$cv->group_id,
					'parent_id'=>$cv->parent_id
				);
			}
			$json[]=array(
				'text'=>$v->group_name,
				'group_name'=>$v->group_name,
				'group_id'=>$v->group_id,
				'parent_id'=>$v->parent_id,
				'nodes'=>$nodes 
			);
		}
		
		echo json_encode($json);exit;
	}

	function get_attributes_tree(){
		$json=array();
		
		$r = DB::table('pr_attributes')->get();
		
		foreach ($r as $k => $v) {
			$json[]=array(
				'text'=>$v->attribute_name,
				'attribute_name'=>$v->attribute_name,
				'attribute_id'=>$v->attribute_id,
				'attribute_type'=>$v->attribute_type,				
				'nodes'=>array() 
			);
		}
		
		echo json_encode($json);exit;
	}

	function save_group(){
		$post = Input::All();
		//pr($post,1);
		$up = $post;
		if(isset($up['_token'])){
			unset($up['_token']);
		}
		if(isset($post['group_id']) && $post['group_id']>0){
			
			echo DB::table('pr_groups')->where('group_id', $post['group_id'])->update($up);
		}else{
			//insert
			echo DB::table('pr_groups')->insertGetId($up);
		}
		exit();
	}

	function save_deal(){
		$post = Input::All();
		//pr($post,1);
		$up = $post;
		if(isset($up['_token'])){
			unset($up['_token']);
		}
		if(isset($post['deal_id']) && $post['deal_id']>0){
			
			echo DB::table('pr_deals')->where('deal_id', $post['deal_id'])->update($up);
		}else{
			//insert
			echo DB::table('pr_deals')->insertGetId($up);
		}
		exit();
	}

	
	function save_type(){
		$post = Input::All();
		//pr($post,1);
		$up = $post;
		if(isset($up['_token'])){
			unset($up['_token']);
		}
		if(isset($post['type_id']) && $post['type_id']>0){			
			echo DB::table('pr_types')->where('type_id', $post['type_id'])->update($up);
		}else{
			//insert
			echo DB::table('pr_types')->insertGetId($up);
		}
		exit();
	}
	//

	function save_attribute(){
		$post = Input::All();
		//pr($post,1);
		$up = $post;
		if(isset($up['_token'])){
			unset($up['_token']);
		}
		if(isset($post['attribute_id']) && $post['attribute_id']>0){			
			echo DB::table('pr_attributes')->where('attribute_id', $post['attribute_id'])->update($up);
		}else{
			//insert
			echo DB::table('pr_attributes')->insertGetId($up);
		}
		exit();
	}
}