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

		foreach($tenancies as $key=>$tenancy){
			$sql_doc = "SELECT 
							`ll_documents`.*,
							`ll_document_heads`.`document_title`
						FROM `ll_document_tenancy`
						INNER JOIN `ll_documents` ON `ll_documents`.`document_id` = `ll_document_tenancy`.`document_id` 
						INNER JOIN `ll_document_heads` ON `ll_document_heads`.`document_head_id` = `ll_documents`.`document_head_id` 
						WHERE `ll_document_tenancy`.`tenancy_id` = ".$tenancy->tenancy_id."
						ORDER BY `ll_document_tenancy`.`document_tenancy_id` DESC";			
			//$tenant->documents = self::find($tenant->tenancy_id)->documents;
			$tenancy->documents = DB::select($sql_doc);
			
			$sql_doc = "SELECT 
							`ll_transactions`.*,
							`ll_transaction_heads`.*,
							`ll_vendors`.*
						FROM `ll_transactions`
						INNER JOIN `ll_transaction_heads` ON `ll_transaction_heads`.`transaction_head_id` = `ll_transactions`.`transaction_head_id`
						LEFT JOIN `ll_vendors` ON `ll_vendors`.`vendor_id` = `ll_transactions`.`vendor_id` 
						WHERE `ll_transactions`.`tenancy_id` = ".$tenancy->tenancy_id."
						ORDER BY `ll_transactions`.`transaction_date` DESC";
			$tenancy->transactions = DB::select($sql_doc);
			
			$returns[$key] = $tenancy;
		}

		return $returns;
	}

	
}
