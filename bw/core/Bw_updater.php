<?php

class Bw_updater {
	
	static function init() {
		
		# check if envato wordpress toolkit plugin is active
		if ( in_array( 'envato-wordpress-toolkit-master/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			self::verify_user();
		}
	}
	
	static function verify_user() {
		
		# proceed if automatic updates are enabled
		$enable_updates = Bw::get_option('enable_updates');
		if( ! $enable_updates ) { return; }
		
		# use credentials used in toolkit plugin
		$credentials = get_option( 'envato-wordpress-toolkit' );
		
		if ( empty( $credentials['user_name'] ) || empty( $credentials['api_key'] ) ) {
			
			# display a notice in the admin to remind the user to enter their credentials
			add_action( 'admin_notices', array('Bw_updater', 'admin_notices') );
			return;
			
		}else{
			
			if( ! self::set_timeout() ) { self::check_for_updates($credentials); }
			
		}
	}
	
	static function set_timeout() {
		$last_check = get_option( 'toolkit-last-toolkit-check' );
		if ( $last_check == false ) { update_option( 'toolkit-last-toolkit-check', time() ); return; }
		if ( 10800 > ( time() - $last_check ) ) { return true; } # update every 3 hours
		update_option( 'toolkit-last-toolkit-check', time() ); return;
	}
	
	static function check_for_updates($credentials) {
		
		# include the library
		include_once( BW_FRAME_LIB . 'envato-wtl/class-envato-wordpress-theme-upgrader.php' );
		
		# Check for updates
		$upgrader = new Envato_WordPress_Theme_Upgrader( $credentials['user_name'], $credentials['api_key'] );
		$updates = $upgrader->check_for_theme_update();
		
		if ( $updates->updated_themes_count ) {
			
			add_action( 'admin_notices', array('Bw_updater', 'admin_notices_download_update') );
			
		}
		
	}
	
	static function admin_notices() {
		$message = sprintf( __( "To enable theme update notifications, please enter your Envato Marketplace credentials in the %s", "default" ),
			"<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
		echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
	}
	
	static function admin_notices_download_update() {
		$message = sprintf( __( "An update to the theme is available! Head over to %s to update it now.", "default" ),
			"<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
		echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
		
	}
	
}

?>