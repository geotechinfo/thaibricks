<?php

class Document extends Eloquent {
	protected $fillable = ['tenancy_id', 'document_head_id', 'document_file', 'documentation_date'];

	protected $table = 'll_documents';
	protected $primaryKey = 'document_id';
	public $timestamps = false;
	
	public function getlist_head($value='')
	{
		$all = DB::table('ll_document_heads')->get();
		//dd($all);

		$list = array(''=>'Select Document Head');
		foreach ($all as $key => $value) {
			# code...
			//print_r($value);
			$list[$value->document_head_id] = $value->document_title;
		}
		//dd($list);
		return $list;
	}

	public function getlist_document($id=0)
	{
		$all = DB::table($this->table)
		->select($this->table.'.*','ll_document_heads.document_title')
		->join('ll_document_heads', 'll_document_heads.document_head_id', '=', $this->table.'.document_head_id')
		->where('user_id','=',$id)
		->get();
		
		return $all;
	}

	
}
