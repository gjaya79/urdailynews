<?php

class Bw_taxonomy_portfolio_categories {
	
	static $name = 'bw_taxonomy_portfolio_categories';
	
	static function init() {
		
		register_taxonomy(
			'portfolio',
			'bw_portfolio',
			array(
				'label' => __( 'Portfolio categories' ),
				'rewrite' => array( 'slug' => 'portfolio' ),
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