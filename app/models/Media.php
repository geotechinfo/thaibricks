<?php

class Media extends Eloquent {
	protected $fillable = ['property_id', 'media_type', 'media_title', 'media_data'];

	protected $table = 'pr_media';
	public $timestamps = false;
}
