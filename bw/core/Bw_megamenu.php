<?php

class Bw_megamenu {
	
	static $enable = true;
	
	static function init() {
		
		if(self::$enable == false and is_admin()) { return; }
		
		# provide another admin menu walker class.
		add_action( 'wp_edit_nav_menu_walker', array('Bw_megamenu', 'bw_edit_nav_menu_walker') , 10, 2 );
		
		# save the menu item meta (posts of type "menu_item").
		add_action( 'wp_update_nav_menu_item', array('Bw_megamenu', 'bw_update_nav_menu_item') , 10, 3 );
		
	}
	
	static function bw_edit_nav_menu_walker( $walker ) {
		if ( $walker == 'Walker_Nav_Menu_Edit' ) {
			$walker = 'Bw_walker_nav_menu_edit';
		}
		return $walker;
	}
	
	static function bw_update_nav_menu_item($menu_id, $menu_item_id, $args) {

		if ( isset( $_POST[ "bw_megamenu_layout_$menu_item_id" ] ) ) {
			update_post_meta( $menu_item_id, 'bw_megamenu_layout', $_POST[ "bw_megamenu_layout_$menu_item_id" ] );
		} else {
			delete_post_meta( $menu_item_id, 'bw_megamenu_layout' );
		}
	}
	
	static function main_nav() {
		
		$args = array(
			'theme_location'  => 'primary',
			'menu'            => '',
			'container'       => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'walker'          => new Bw_walker_nav_menu()
		);
		
		if(has_nav_menu('primary')) {
			wp_nav_menu($args);
		}else{
			echo '<p>Please select a menu from Appearance > Menus.</p>';
		}
		
	}
	
}

?>