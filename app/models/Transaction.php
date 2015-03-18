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

	public function getlist($condi=array(),$feature=array()){
		//return $this->belongsTo('User','user_id');

		$sql = "SELECT 
					ll_transaction_heads.* ,
					ll_tenancy.* ,
					ll_transactions.* ,
					ll_vendors.* ,
					pr_properties.* ,
					ac_users.* ,
					ll_tenants.first_name as `tenants_first_name`,
					ll_tenants.last_name as `tenants_last_name`,
					`ll_transactions`.`amount`	as transaction_amount
				FROM `ll_transactions`
				LEFT JOIN `ll_transaction_heads` ON `ll_transaction_heads`.`transaction_head_id` = `ll_transactions`.`transaction_head_id`
				LEFT JOIN `ll_tenancy` ON `ll_tenancy`.`tenancy_id` = `ll_transactions`.`tenancy_id` 
				LEFT JOIN `ll_tenants` ON `ll_tenants`.`tenant_id` = `ll_tenancy`.`tenant_id` 
				LEFT JOIN `ll_vendors` ON `ll_vendors`.`vendor_id` = `ll_transactions`.`vendor_id` 
				LEFT JOIN `pr_properties` ON `pr_properties`.`property_id` = `ll_tenancy`.`property_id`
				LEFT JOIN `ac_users` ON `ac_users`.`user_id` = `ll_transactions`.`user_id` 
				WHERE  1=1
		";
		if(isset($condi['transaction_id']) && $condi['transaction_id']>0){
				$sql = $sql." AND `ll_transactions`.`transaction_id`= ".  $condi['transaction_id'];
		}
		if(isset($condi['user_id']) && $condi['user_id']>0){
				$sql = $sql." AND `ll_transactions`.`user_id`= ".  $condi['user_id'];
		}
		if(isset($condi['transaction_date']) && $condi['transaction_date']>0){
				$sql = $sql." AND `ll_transactions`.`transaction_date`= ".  $condi['transaction_date'];
		}
		if(isset($condi['max_amount']) && $condi['max_amount']>0){
				$sql = $sql." AND `ll_transactions`.`amount`< ".  $condi['max_amount'];
		}
		if(isset($condi['min_amount']) && $condi['min_amount']>0){
				$sql = $sql." AND `ll_transactions`.`amount`> ".  $condi['min_amount'];
		}
		if(isset($condi['vendor_id']) && $condi['vendor_id']>0){
				$sql = $sql." AND `ll_transactions`.`vendor_id`= ".  $condi['vendor_id'];
		}
		if(isset($condi['vendor_name']) && $condi['vendor_name']!=''){
				$sql = $sql." AND `ll_vendors`.`vendor_name` like '%".  $condi['vendor_id']."%'";
		}
		if(isset($condi['vendor_email']) && $condi['vendor_email']!=''){
				$sql = $sql." AND `ll_vendors`.`vendor_email` like '%".  $condi['vendor_email']."%'";
		}
		if(isset($condi['transaction_type']) && $condi['transaction_type']!=''){
				$sql = $sql." AND `ll_transaction_heads`.`transaction_type` = '".  $condi['transaction_type']."'";
		}
		if(isset($condi['transaction_title']) && $condi['transaction_title']!=''){
				$sql = $sql." AND `ll_transaction_heads`.`transaction_title` like '%".  $condi['transaction_title']."%'";
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
		//echo $sql;
		$r = DB::select($sql);
		
		return $r;
	}


}
