<?php

class Bw_post_type_gallery {
	
	static $enable = true;
	
	static $name = 'bw_gallery';
	
	static function init() {
		
		if(!self::$enable) return;
		
		/*
		 * Uncomment for post formats to the current post type.
		 */
		# add_post_type_support( 'bw_gallery', 'post-formats' );
		
		register_post_type( 'bw_gallery',
			array(
				'menu_icon' => 'dashicons-format-gallery',
				'labels' => array (
					'name' => __('Gallery', BW_THEME),
					'singular_name' => __('Gallery', BW_THEME),
					'add_new' => __('Add New', BW_THEME),
					'add_new_item' => __('Add New Gallery', BW_THEME),
					'edit_item' => __('Edit Gallery', BW_THEME),
					'new_item' => __('New Gallery', BW_THEME),
					'all_items' => __('All Galleries', BW_THEME),
					'view_item' => __('View Gallery', BW_THEME),
					'search_items' => __('Search Galleries', BW_THEME),
					'not_found' => __('No Gallery found', BW_THEME),
					'not_found_in_trash' => __('No Gallery found in Trash', BW_THEME),
					'menu_name' => __('Galleries', BW_THEME),
				),
				'taxonomies' => array('gallery'),
				'public' => true,
				'has_archive' => 'galleries-archive',
				'supports' => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
			)
		);
		
	}
	
}

?>