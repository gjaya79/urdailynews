<?php

class Bw_admin {
	
	static function init() {
		
		# register required plugins
		Bw_required_plugins::init();
		
		add_action('admin_init',array( 'Bw_admin', 'components' ) );
		
	}
	
	static function components() {
		
		# enqueue scripts for admin area
		self::enqueue_assets();
		
		# call once after theme was activated
		Bw_after_activation::init();
		
		# admin ajax
		Bw_admin_ajax::init();
		
		# custom metabox
		Bw_metabox::init();
		
		# init themeforest auto updater
		Bw_updater::init();
		
		# enables the use of megamenu
		Bw_megamenu::init();
	}
	
	static function enqueue_assets() {
		
		# css
		Bw_assets::addStyle('bw-admin', 'bw/assets/css/admin.css');
		
		# js
		Bw_assets::addScript('bw-admin', 'bw/assets/js/admin.js', array('jquery'));
		Bw_assets::addScript('bw-admin', 'bw/assets/js/ajax.js', array('jquery'));
		
	}
	
}

?>