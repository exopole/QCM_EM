<?php
use Illuminate\Support\Str;


if (!function_exists('limit_text')){

	function limit_text($value, $limite = 20, $end = null){

		if(isset($value)  ) return Str::limit($value, $limit, $end);
	}
}

