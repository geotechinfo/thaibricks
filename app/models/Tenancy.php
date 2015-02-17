<?php

class Tenancy extends Eloquent {
	protected $fillable = ['user_id', 'deal_id', 'type_id', 'title', 'description', 'location', 'location_sub', 'address', 'price', 'phone', 'email'];

	protected $table = 'll_tenancy';
	protected $primaryKey = 'tenancy_id';
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	public function property(){
		return $this->belongsTo('Property', 'property_id', 'property_id');
	}
	
	public function get_tenancies($user_id=null, $tenancy_id=null){
		$tenancy_sql = "";
		if($user_id != null){
			$tenancy_sql .= " AND `pr_properties`.`user_id` = ".$user_id;
		}
		if($tenancy_id != null){
			$tenancy_sql .= " AND `ll_tenancy`.`tenancy_id` = ".$tenancy_id;
		}
	
		$tenancies = DB::select("
			SELECT
			`ll_tenancy`.*,
			`ll_tenants`.`first_name` as `tenant_fname`,
			`ll_tenants`.`last_name` as `tenant_lname`,
			`ll_tenants`.`phone` as `tenant_phone`,
			`ll_tenants`.`email` as `tenant_email`,
			`ll_tenants`.`address` as `tenant_address`,
			`pr_properties`.*
			FROM
			`ll_tenancy`
			INNER JOIN
			`ll_tenants`
			ON
			`ll_tenants`.`tenant_id` = `ll_tenancy`.`tenant_id`
			INNER JOIN
			`pr_properties`
			ON
			`pr_properties`.`property_id` = `ll_tenancy`.`property_id`
			WHERE
			1 = 1
			".$tenancy_sql."
			ORDER BY
			`ll_tenancy`.`tenancy_id` DESC
		");

		$returns = array();
		foreach($tenancies as $key=>$tenant){
			$returns[$key] = $tenant;
		}

		return $returns;
	}
}
