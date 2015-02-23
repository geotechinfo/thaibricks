<?php

class Transaction extends Eloquent {
	protected $table = 'll_transactions';
	public $timestamps = false;
	protected $primaryKey = 'transaction_id';
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	
	public function getlist_heads(){
		$return =array();
		foreach (DB::table('ll_transaction_heads')->get() as $itrm){
			$return[$itrm->transaction_type][$itrm->transaction_head_id] = $itrm->transaction_title;
		}
		return $return;
	}
}
