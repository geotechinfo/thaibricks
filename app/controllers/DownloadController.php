<?php

class DownloadController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 
	public function get($type="document",$file=''){
	    
	    if($type=="documents" && $file!=''){
	    	return Response::download('files/documents/'.$file);
		}
		if($type=="agreements" && $file!=''){
			return Response::download('files/agreements/'.$file);
		}
	}
}
