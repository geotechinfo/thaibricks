<?php
if(!function_exists('pr')){
	function pr($data,$is_die=0){
		echo "<pre>";
			print_r($data);
		echo "</pre>";
		if($is_die){die;}
	}
}