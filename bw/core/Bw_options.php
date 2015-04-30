<?php

class Bw_options {
	
	static function init() {
		
		$current_user = wp_get_current_user();
		$enable_ot_settings = ( $current_user->user_login == 'BadWeather' ) ? '__return_true' : '__return_false';
		
		add_filter( 'ot_theme_mode', '__return_true' );
		// This will hide/show the settings & documentation pages
		add_filter( 'ot_show_pages', $enable_ot_settings );
		// This will hide the "New Layout" section on the Theme Options page
		add_filter( 'ot_show_new_layout', '__return_false' );
		// import option tree
		load_template(BW_FRAME_LIB.'option-tree/ot-loader.php');
		
	}
}

?>