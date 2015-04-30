<?php

add_action( 'init', 'bw_shortcode_button' );
function bw_shortcode_button() {
	add_filter("mce_external_plugins", "bw_add_buttons");
    add_filter('mce_buttons', 'bw_register_buttons');
}
	
function bw_add_buttons($plugin_array) {
	$plugin_array['bwshortcode'] = BW_URI . 'bw/lib/shortcode-generator/shortcode-plugin.js';
	return $plugin_array;
}

function bw_register_buttons($buttons) {
	array_push( $buttons, 'dropcap', 'showrecent' );
	return $buttons;
}


?>