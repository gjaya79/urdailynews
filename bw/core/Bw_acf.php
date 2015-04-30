<?php

class Bw_acf {
	
	static function init() {
		
		# call acf
		self::call_plugin();
		
		# remove fields for standard users
		add_action( 'admin_menu', array('Bw_acf', 'remove_acf_menu'), 999 );
		
		# register addons
		self::addons();
		
		# load scripts
		self::enqueue_assets();
		
		
		
	}
	
	static function call_plugin() {
		
		# load acf core
		include_once( BW_FRAME_LIB . 'acf/acf.php' );
		# load acf configurations
		include_once( BW_FRAME_LIB . 'acf/acf-config.php' );
		
	}
	
	static function remove_acf_menu() {
		
		// provide a list of usernames who can edit custom field definitions here
		$admins = array( 'BadWeather' );
	 
		// get the current user
		$current_user = wp_get_current_user();
	 
		// match and remove if needed
		if( !in_array( $current_user->user_login, $admins ) ) {
			remove_menu_page('edit.php?post_type=acf');
		}
		
	}
	
	static function addons() {
		
		include_once( BW_FRAME_LIB . 'acf/add-ons/acf-flexible-content/flexible-content.php');
		include_once( BW_FRAME_LIB . 'acf/add-ons/acf-repeater/repeater.php');
		
	}
	
	static function enqueue_assets() {
		
		Bw_assets::addScript('bw-acf-custom', 'bw/lib/acf/js/custom-admin.js');
		
	}
}

?>