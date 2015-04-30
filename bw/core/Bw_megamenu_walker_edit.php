<?php

require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

if ( !class_exists( "Bw_walker_nav_menu_edit" ) && class_exists( 'Walker_Nav_Menu_Edit' ) && Bw_megamenu::$enable ):

class Bw_walker_nav_menu_edit extends Walker_Nav_Menu_Edit {
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		// append next menu element to $output
		parent::start_el($output, $item, $depth, $args);
		
		// now let's add the megamenu layout select box but only for the first level
		if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {
			
			set_time_limit(0);
			
			//load up the library
			if(!function_exists('bw_str_get_dom')) { require_once BW_FRAME_LIB . 'ganon/ganon.php'; }

			// Create DOM from string
			$_doc = bw_str_get_dom($output);

			$_li = $_doc->select( '.menu-item-depth-0',-1); // "-1" aka the last element is important, because $output will contain all the menu elements before current element

			// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
			// just a safety, should never happen...
			$menu_item_id = str_replace( 'menu-item-', '', $_li->getAttribute( 'id' ) );

			if( $menu_item_id != $item->ID ) {
				return;
			}

			//somewhere to save the new HTML code
			$newHtml = '';
			
			// fetch previously saved meta for the post (menu_item is just a post type)
			$current_val = esc_attr( get_post_meta( $item->ID, 'bw_megamenu_layout', TRUE ) );
			
			//let's make the HTML
			//go through the options values and titles
			$supermenu_layout = array(
				'default' => __('Default', BW_THEME),
				'latest_posts' => __('Latest Posts', BW_THEME),
				'slider_latest_posts' => __('Slider + Latest Posts', BW_THEME),
			);
			
			if (!empty($supermenu_layout)) {
				$newHtml .= '<p class="link-to-original bw_custom_menu_meta"><label>'.__('Select MegaMenu Layout:',BW_THEME).' <select name="bw_megamenu_layout_'.$menu_item_id.'">';
				foreach ($supermenu_layout as $key => $value) {
					$selected = '';
					if ($key == $current_val) $selected = 'selected';

					$newHtml .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
				$newHtml .= '</select></label></p>';
			}
			
			// inject the new input field
			$whereto = $_li->select( '.menu-item-actions',0);
			//add it before
			$whereto->setInnerText($newHtml.$whereto->getInnerText());
			
			// swap the $output
			$output = $_doc->getInnerText();
			
			//cleanup
			//$_doc->__destruct();
			unset($_doc);
			
		}
	}
}

endif;
