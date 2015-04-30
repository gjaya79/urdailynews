<?php

class Bw_after_activation {
	
	static function init() {
		
		if( self::on_theme_activation() ) {
			
			# load option tree settings
			self::ot_settings();
			
			# load option tree theme options
			self::ot_theme_options();
			
			# woocommerce set default thumbnails
			Bw_woo::set_default_thumbnails();
			
			# tell wp that the configuration was done
			self::theme_was_installed();
			
			# redirect to option panel after theme activation
			self::redirect_to_options();
			
		}
	}
	
	static function on_theme_activation() {
		global $pagenow;
		return is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php';
	}
	
	static function theme_was_installed() {
		update_option( 'bw_theme_was_installed', true );
	}
	
	static function is_theme_installed() {
		return get_option( 'bw_theme_was_installed', false );
	}
	
	static function ot_settings() {
		
		$theme_options_file = BW_DEMO.'theme-options.php';
		
		if( isset( $_GET['activated'] ) && !self::is_theme_installed() && file_exists($theme_options_file)) {
			
			load_template( $theme_options_file );
			
		}
	}
	
	static function ot_theme_options() {
		
		if(!self::is_theme_installed()) {
			
			$theme_options_settings =  BW_DEMO . 'theme-options-settings.txt';
			
			if(file_exists($theme_options_settings)) {
				
				$theme_options_settings_content = file_get_contents($theme_options_settings);
				
				$default_option_tree = unserialize(ot_decode($theme_options_settings_content));
				
				update_option( 'option_tree', $default_option_tree );
				
			}
		}
	}
	
	static function redirect_to_options() {
		Bw::redirect( 'admin.php?page=ot-theme-options' );
	}
	
}

?>