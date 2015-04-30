<?php

class Bw_taxonomy_gallery_categories {
	
	static $name = 'bw_taxonomy_gallery_categories';
	
	static function init() {
		
		register_taxonomy(
			'gallery',
			'bw_gallery',
			array(
				'label' => __( 'Gallery category' ),
				'rewrite' => array( 'slug' => 'gallery' ),
				'capabilities' => array(
					'manage__terms' => 'edit_posts',
					'edit_terms' => 'manage_categories',
					'delete_terms' => 'manage_categories',
					'assign_terms' => 'edit_posts'
				),
				'hierarchical' => true,
				'public' => true,
				'show_admin_column' => true
			)
		);
		
	}
	
}

?>