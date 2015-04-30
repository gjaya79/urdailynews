<?php

class Bw_metabox_page {
	
	static $metabox;
	
	static function init() {
		
		self::$metabox = array(
		
			'id'          => '_general_page',
			'title'       => 'General page settings',
			'pages'       => array( 'page' ),
			'context'     => 'side', //normal
			'priority'    => 'high', //low
			'class'		  => '',
			'fields'      => array(
				
				array(
					'label'       => 'Hide page title',
					'id'          => 'hide_title',
					'type'        => 'bw_on_off',
					'choices' => array(
						array (
							'label' => '',
							'value' => '1'
						)
					),
				),
				
				array(
					'label'       => 'Page layout',
					'id'          => 'page_layout',
					'type'        => 'radio_image',
					'desc'        => '',
					'choices'     => array(
						
						array(
							'label' => 'No',
							'value' => 'full',
							'src' => BW_URI_FRAME_ASSETS.'img/admin/layouts_small/full.png'
						),
						array(
							'label' => 'Yes',
							'value' => 'right',
							'src' => BW_URI_FRAME_ASSETS.'img/admin/layouts_small/right.png'
						),
					)
				),
				
			)
		);
		
		ot_register_meta_box( self::$metabox );
		
	}
}

?>