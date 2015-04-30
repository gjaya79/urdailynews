<?php

class Bw_theme {
	
	static function init() {
		
		if( !is_admin() ) {
			add_action( 'init', array( 'Bw_theme', 'components' ) );
		}
	}
	
	static function components() {
		
		# assets
		self::enqueue_assets();
		
		# set the theme font styles
		Bw_theme_fonts::init();
		
		# ajax
		Bw_theme_ajax::init();
		
		# theme header options
		Bw_theme_header_options::init();
		
		# theme footer options
		Bw_theme_footer_options::init();
	}
	
	static function enqueue_assets() {
		
		# css
		Bw_assets::addStyle('style', 'style.css');
		Bw_assets::addStyle('bw-owl-carousel', 'assets/css/vendors/jquery.owl.carousel/owl.carousel.all.css');
		Bw_assets::addStyle('bw-magnific-popup', 'assets/css/vendors/jquery.magnific-popup/magnific-popup.css');
		Bw_assets::addStyle('bw-animate', 'assets/css/vendors/animate/animate.css');
		Bw_assets::addStyle('bw-style', 'assets/css/style.css');
		Bw_assets::addStyle('bw-media', 'assets/css/media.css');
		
		# js
		if( Bw::get_option( 'enable_smooth_scroll' ) ) {
			Bw_assets::addScript('bw-smooth-scroll', 'assets/js/vendors/jquery.smooth-scroll/jquery.smooth-scroll.js', array(), BW_VERSION, false);
		}
		Bw_assets::addScript('bw-unveil-master', 'assets/js/vendors/jquery.unveil-master/jquery.unveil.min.js');
		Bw_assets::addScript('bw-owl-transitions', 'assets/js/vendors/jquery.owl.slider/owl.carousel.js');
		Bw_assets::addScript('bw-magnific-popup-js', 'assets/js/vendors/jquery.magnific-popup/jquery.magnific-popup.min.js' );
		Bw_assets::addScript('bw-hover-intent', 'assets/js/vendors/jquery.hover-intent/jquery.hover-intent.min.js' );
		Bw_assets::addScript('bw-masonry', 'assets/js/vendors/jquery.masonry/isotope.pkgd.min.js' );
		Bw_assets::addScript('bw-tween-max', 'assets/js/vendors/tween-max/tweenmax.min.js');
		Bw_assets::addScript('bw-main', 'assets/js/main.js', array('jquery'));
		
	}
	
}

?>