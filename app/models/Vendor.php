<?php

class Vendor extends Eloquent {

	protected $fillable = [];

	protected $table = 'll_vendors';
	protected $primaryKey = 'vendor_id';
	public $timestamps = false;
	


	public function getlist($condi=array(),$feature=array()){
		//return $this->belongsTo('User','user_id');

		$sql = "SELECT 
						* 
				FROM `ll_vendors`
				LEFT JOIN `ac_users` ON `ac_users`.`user_id` = `ll_vendors`.`user_id` 
				WHERE  1=1
		";
		if(isset($condi['user_id']) && $condi['user_id']>0){
				$sql = $sql." AND `ll_vendors`.`user_id`= ".  $condi['user_id'];
		}
		if(isset($condi['vendor_id']) && $condi['vendor_id']>0){
				$sql = $sql." AND `ll_vendors`.`vendor_id`= ".  $condi['vendor_id'];
		}
		if(isset($condi['vendor_name']) && $condi['vendor_name']!=''){
				$sql = $sql." AND `ll_vendors`.`vendor_name` like '%".  $condi['vendor_id']."%'";
		}
		if(isset($condi['vendor_email']) && $condi['vendor_email']!=''){
				$sql = $sql." AND `ll_vendors`.`vendor_email` like '%".  $condi['vendor_email']."%'";
		}
		if(isset($condi['first_name']) && $condi['first_name']!=''){
				$sql = $sql." AND `ac_users`.`first_name` like '%".  $condi['first_name']."%'";
		}
		if(isset($condi['last_name']) && $condi['last_name']!=''){
				$sql = $sql." AND `ac_users`.`last_name` like '%".  $condi['last_name']."%'";
		}
		if(isset($condi['email']) && $condi['email']!=''){
				$sql = $sql." AND `ac_users`.`email` like '%".  $condi['email']."%'";
		}
		if(isset($condi['phone']) && $condi['phone']!=''){
				$sql = $sql." AND `ac_users`.`phone` like '%".  $condi['phone']."%'";
		}
		if(isset($condi['location']) && $condi['location']>0){
				$sql = $sql." AND `ac_users`.`location` = '".  $condi['location']."'";
		}
		if(isset($feature['orderby']) && is_array($feature['orderby'])){
			$order_str = ' ORDER BY';
			foreach ($feature['orderby'] as $col => $order) {
				if(is_numeric($col)){
					$order_str = $order_str." ".$order;
				}else{
					$order_str = $order_str." ".$col." ".$order;
				}
				
			}
			$sql = $sql.$order_str;
		}
		$r = DB::select($sql);
		$transaction  = new Transaction();
		foreach ($r as $key => $value) {
			$list = $transaction->getlist(array('vendor_id'=>$value->vendor_id));
			//pr($list);
			$r[$key]->transaction_list = $list;
		}
		//pr($r);
		return $r;
	}
}
