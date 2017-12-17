<?php

namespace gbook\core;

require_once APP_ROOT . 'lib/htmlawed/Htmlawed.php';

class Htmlawed {
	/*
		§ <a href=”” title=””> </a>
		§ <code> </code>
		§ <i> </i>
		§ <strike></strike>
		§ <strong> </strong>
	 */

	public static function purify($text, $config = null, $spec = null) {
		if (!$config) {
			$config = [
				'elements'=>'a,code,strike,i,strong',
				'schemes'=>'*:http,https,ftp,mailto',
			//	'deny_attribute'=>'on*,id,script'
				'deny_attribute'=>'*'
			];
		}
		if (!$spec) {
			$spec = 'a=href, title';
		}
		return htmlawed($text, $config, $spec);
	}
}

