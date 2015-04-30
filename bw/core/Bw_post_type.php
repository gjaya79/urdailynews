<?php

class Bw_post_type {
	
	static $post_types = array(
		//'gallery',
		//'portfolio'
	);
	
	static function init() {
		
		foreach(self::$post_types as $post_type) {
			call_user_func(array("Bw_post_type_{$post_type}", 'init'));
		}
		
	}
	
}

?>