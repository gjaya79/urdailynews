<?php

class Bw_metabox_product {
	
	static function init() {
		
		if( !Bw_woo::$enable ) { return; }
		
		$settings = array(
		
			'id'          => 'settings_product',
			'title'       => 'Product settings',
			'pages'       => array( 'product' ),
			'context'     => 'side', //side
			'priority'    => 'high', //low
			'class'		  => '',
			'fields'      => array(
				
				
				
			)
		);
		
		ot_register_meta_box( $settings );
		
	}
}

?>