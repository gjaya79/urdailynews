<?php

class Bw_admin_ajax {
	
	static function init() {
		
		# localize script
		add_action( 'admin_footer', array('Bw_admin_ajax','bad_weather_ajax') );
		
		self::alocate_callbacks();
		
	}
	
	static function bad_weather_ajax() {
		
		wp_localize_script( 'bw-admin', 'bw_admin_root', array( 'ajax' => admin_url( 'admin-ajax.php' ) ) );
		
	}
	
	static function alocate_callbacks() {
		
		foreach(Bw_admin_callbacks::$funcs as $func) {
			
			$hook_nopriv = 'wp_ajax_nopriv_' . $func;
			$hook = 'wp_ajax_' . $func;
			
			add_action( $hook_nopriv, array( 'Bw_admin_callbacks', $func ) );
			add_action( $hook, array( 'Bw_admin_callbacks', $func ) );
		}
		
	}
}

?>