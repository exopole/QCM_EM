<?php
use Illuminate\Support\Str;

use App\Score;


if (!function_exists('limit_text')){

	function limit_text($value, $limite = 20, $end = null){

		if(isset($value)  ) return Str::limit($value, $limit, $end);
	}
}


if (!function_exists('checkSelect')){

	function checkSelect($ID, $authID){

		if(isset($ID) &&   isset($authID) && $ID === $authID) return 'selected';
	}
}

if (!function_exists('checked')){

	function checked($ID, $authID){

		if(isset($ID) &&   isset($authID) && $ID === $authID) return 'Checked';
	}
}


if (!function_exists('getStatus')){

	function getStatus($status){

		if(isset($status)) 
			if ($status == "published") {
				return "publié";
			}
			if ($status == "unpublished") {
				return "dépublié";
			}
	}
}

if (!function_exists('checkOldValue')){

	function checkOldValue($oldValue, $value){

		if(!isset($oldValue)) {
			if (isset($value)) {
				return $value;
			}
			else {
				return "";
			}
		}
		else
			return $oldValue;
	}
}


