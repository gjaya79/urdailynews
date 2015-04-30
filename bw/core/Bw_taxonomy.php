<?php

class Bw_taxonomy {
	
	static $enable = true;
	
	static $taxonomies = array(
		//'portfolio_categories',
		//'gallery_categories'
	);
	
	static function init() {
		
		if(!self::$enable or !Bw_post_type_gallery::$enable) return;
		
		foreach(self::$taxonomies as $taxonomy) {
			call_user_func(array("Bw_taxonomy_{$taxonomy}", 'init'));
		}
		
	}
	
}

?>