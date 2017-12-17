<?php
function dump() {
	$data = func_get_args();
	foreach ($data as $value) {
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}
}