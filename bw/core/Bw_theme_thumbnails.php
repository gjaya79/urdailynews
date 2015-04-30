<?php

class Bw_theme_thumbnails {
	
	static function init() {
		
		/*
		 * Enabling Support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' ); 
		
		self::add_thumbs();
	}
	
	static function add_thumbs() {
		
		add_image_size( 'bw_350x300', 350, 300, true );
		add_image_size( 'bw_350', 350, 9999, false );
		add_image_size( 'bw_424x500', 424, 500, true );
		add_image_size( 'bw_475x293', 475, 293, true );
		add_image_size( 'bw_620x412', 620, 412, true );
		add_image_size( 'bw_700x450', 700, 450, true );
		add_image_size( 'bw_980x600', 980, 600, true );
		add_image_size( 'bw_700', 700, 9999, false );
		
	}
}

?>