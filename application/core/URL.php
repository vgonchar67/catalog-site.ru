<?php

namespace app\core;

class URL {
	static function getPath($url) {
		return urldecode(parse_url($url, PHP_URL_PATH));
	}
}