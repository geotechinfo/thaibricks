<?php
class CommonHelper{
	static function dateToUx($date){
		list($year, $month, $day) = explode("-", $date);
		return $day."/".$month."/".$year;
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
}