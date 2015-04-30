<?php

class Bw_metabox_portfolio {
	
	static $metabox;
	
	static function init() {
		
		self::$metabox = array(
		
			'id'          => 'general_portfolio',
			'title'       => 'Gallery',
			'desc'        => '',
			'pages'       => array( 'bw_portfolio' ),
			'context'     => 'normal', //side
			'priority'    => 'high', //low
			'fields'      => array(
				
				array(
					'label'       => '',
					'id'          => 'bw_gallery',
					'type'        => 'bw_gallery',
					'desc'        => ''
				)
				
			)
		);
		
		ot_register_meta_box( self::$metabox );
		
	}
}

?>