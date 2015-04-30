<?php

class Bw_metabox_gallery {
	
	static $metabox;
	
	static function init() {
		
		self::$metabox = array(
		
			'id'          => 'general_gallery',
			'title'       => 'Gallery',
			'desc'        => '',
			'pages'       => array( 'bw_gallery' ),
			'context'     => 'normal', //side
			'priority'    => 'high', //low
			'fields'      => array(
				
				array(
					'label'       => 'Image gallery',
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