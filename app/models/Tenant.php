<?php

class Tenant extends Eloquent {
	protected $table = 'll_tenants';
	public $timestamps = false;
	protected $primaryKey = 'tenant_id';
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
}
