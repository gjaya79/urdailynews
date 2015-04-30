<?php

class Bw_metabox {
	
	static $pages = array(
		'page',
		'post',
		'gallery',
		'portfolio',
		'product'
	);
	
	static function init() {
		
		foreach(self::$pages as $page) {
			call_user_func(array("Bw_metabox_{$page}", 'init'));
		}
		
	}
	
}

?>