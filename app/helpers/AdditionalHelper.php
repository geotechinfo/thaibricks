<?php
if(!function_exists('pr')){
	function pr($data,$is_die=0){
		echo "<pre>";
			print_r($data);
		echo "</pre>";
		if($is_die){die;}
	}
}

if(!function_exists('seo_url')){
	function seo_url($data=''){
		//$replace = array('_','_n_');
		//$search = array(' ','&');
		//return str_replace($search, $replace, strtolower($data));
		$text = $data;
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text))
	  {
	    return 'n-a';
	  }

	  return $text;
	}
}