<?php

namespace App\core;

class URL {
	static function getPath($url) {
		return urldecode(parse_url($url, PHP_URL_PATH));
	}

	static function modify($mod) 
	{ 
		$url = $_SERVER['REQUEST_URI']; 

		$query = explode("&", $_SERVER['QUERY_STRING']);
		if (!$_SERVER['QUERY_STRING']) {$queryStart = "?";} else {$queryStart = "&";}
		// modify/delete data 
		foreach($query as $q) 
		{ 
			list($key, $value) = explode("=", $q); 
			if(array_key_exists($key, $mod)) 
			{ 
				if($mod[$key]) 
				{ 
					$url = preg_replace('/'.$key.'='.$value.'/', $key.'='.$mod[$key], $url); 
				} 
				else 
				{ 
					$url = preg_replace('/&?'.$key.'='.$value.'/', '', $url); 
				} 
			} 
		} 
		// add new data 
		foreach($mod as $key => $value) 
		{ 
			if($value && !preg_match('/'.$key.'=/', $url)) 
			{ 
				$url .= $queryStart.$key.'='.$value; 
			} 
		} 
		
		return $url; 
	} 
}