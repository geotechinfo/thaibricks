<?php
class CommonHelper{
	static function dateToUx($date){
		list($year, $month, $day) = explode("-", $date);
		if($year!=0 || $month!=0 || $day!=0)
		{
			return $day."/".$month."/".$year;
		}else{
			return '';
		}
	}
	static function dateToDb($date){
		list($day, $month, $year) = explode("/", $date);
		return $year."-".$month."-".$day;
	}
	static function propertyTypes(){
		$properties = new Property();
		return $properties->getlist_types();
	}
	static function dealTypes(){
		$properties = new Property();
		return $properties->getlist_deals();
	}
	static function change_bool($con = array()){

		if(isset($con['table']) && $con['table']!=='' && isset($con['field']) && $con['field']!=''){
			$sql = "UPDATE ".$con['table']." SET ".$con['field']."=IF(".$con['field']."=1,0,1) WHERE 1=1 ";
			if(isset($con['where'])){
				foreach ($con['where'] as $k => $v) {
					$sql = $sql." AND ".$k."=".$v;
				}
			}
			return DB::statement($sql);
		}else{
			return false;
		}
		
	} 
}