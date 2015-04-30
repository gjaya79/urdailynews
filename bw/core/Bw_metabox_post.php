<?php

class Bw_metabox_post {
	
	static $metabox;
	
	static function init() {
		
		self::$metabox = array(
		
			'id'          => 'general_post',
			'title'       => 'General post settings',
			'pages'       => array( 'post' ),
			'context'     => 'normal', //side
			'priority'    => 'high', //low
			'class'		  => 'dynamic-meta', // add this class to dynamically change metas for post formats ( post type only )
			'fields'      => array(
				
				# gallery
				array(
					'label'       => 'Slider gallery',
					'id'          => 'bw_gallery',
					'type'        => 'bw_gallery',
					'class'       => 'post-format-gallery',
				),
				array(
					'label'       => 'Slider options',
					'id'          => 'auto_height',
					'type'        => 'checkbox',
					'choices' => array(
						array (
							'label' => 'Auto-height: check this so you can use diffrent heights on each slide. Don\'t use it on large content websites',
							'value' => '1'
						)
					),
					'desc'        => '',
					'class'       => 'post-format-gallery'
				),
				array(
					'label'       => '',
					'id'          => 'auto_play',
					'type'        => 'checkbox',
					'choices' => array(
						array (
							'label' => 'Auto-play: check this if you want your slider to play automatically',
							'value' => '1'
						)
					),
					'desc'        => '',
					'class'       => 'post-format-gallery'
				),
				array(
					'label'       => '',
					'id'          => 'hide_nav',
					'type'        => 'checkbox',
					'choices' => array(
						array (
							'label' => 'Hide navigation: this option will hide the previous and next button of the slider',
							'value' => '1'
						)
					),
					'desc'        => '',
					'class'       => 'post-format-gallery'
				),
				array(
					'label'       => 'Slider effect',
					'id'          => 'slider_effect',
					'type'        => 'select',
					'choices' => array(
						array ('label' => 'slide','value' => false),
						array ('label' => 'fade','value' => 'fade'),
						array ('label' => 'backSlide','value' => 'backSlide'),
						array ('label' => 'goDown','value' => 'goDown'),
						array ('label' => 'fadeUp','value' => 'fadeUp'),
					),
					'desc'        => '',
					'class'       => 'post-format-gallery'
				),
				
				# video
				array(
					'label'       => 'Embed code',
					'id'          => 'embed_code',
					'type'        => 'textarea_simple',
					'desc'        => '',
					'class'       => 'post-format-video'
				),
				array(
					'label'       => 'Auto-height video',
					'id'          => 'embed_height',
					'type'        => 'checkbox',
					'choices' => array(
						array (
							'label' => 'Check if you want your embed code to be dipsplayed in 16:9 aspect',
							'value' => '1'
						)
					),
					'desc'        => '',
					'class'       => 'post-format-video'
				),
				
			)
		);
		
		ot_register_meta_box( self::$metabox );
		
		$settings = array(
		
			'id'          => 'settings_post',
			'title'       => 'Post settings',
			'pages'       => array( 'post' ),
			'context'     => 'side', //normal
			'priority'    => 'high', //low
			'class'		  => '',
			'fields'      => array(
				
				array(
					'label'       => 'Featured post',
					'id'          => 'bw_featured_post',
					'type'        => 'bw_on_off',
					'choices' => array(
						array (
							'label' => '',
							'value' => '1'
						)
					),
					'desc'        => ''
				),
				
				array(
					'label'       => 'Enable category slider',
					'id'          => 'bw_category_slider',
					'type'        => 'bw_on_off',
					'choices' => array(
						array (
							'label' => '',
							'value' => '1'
						)
					),
					'desc'        => ''
				),
				
				array(
					'label'       => 'Full width featured image / video',
					'id'          => 'bw_full_width_featured',
					'type'        => 'bw_on_off',
					'choices' => array(
						array (
							'label' => '',
							'value' => '1'
						)
					),
					'desc'        => ''
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
		
		ot_register_meta_box( $settings );
		
	}
}

?>