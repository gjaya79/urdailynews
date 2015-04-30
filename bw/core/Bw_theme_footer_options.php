<?php

class Bw_theme_footer_options {
	
	static function init() {
		
		add_action( 'wp_footer', array( 'Bw_theme_footer_options', 'set_footer' ) );
		
	}
	
	static function set_footer() {
		
		self::google_analytics();
		self::custom_js();
		
	}
	
	static function google_analytics() {
		$google_id = Bw::get_option('analytics_id');
		if($google_id) { echo "<script type='text/javascript'>var _gaq = _gaq || [];_gaq.push(['_setAccount', '{$google_id}']);_gaq.push(['_trackPageview']);(function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>"; }
		
	}
	
	static function custom_js() {
		$custom_js = Bw::get_option('custom_js');
		if ($custom_js) { echo "<script type='text/javascript'>{$custom_js}</script>"; }
	}
}

?>