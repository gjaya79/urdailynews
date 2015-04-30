<?php

class Bw_shortcodes {
	
	static function init() {
		
		if ( is_admin() ) { require_once BW_FRAME_LIB . 'shortcode-generator/shortcode-init.php'; }
		require_once BW_FRAME_LIB . 'shortcode-generator/shortcode-processing.php';
		
		self::enqueue_assets();
		
	}
	
	static function enqueue_assets() {
		
		Bw_assets::addStyle('bw-shortcode', 'bw/assets/css/shortcode.css');
		Bw_assets::addScript('bw-shortcode-js', 'bw/assets/js/shortcode.js', array('bw-tween-max'));
		
	}
	
}

?>