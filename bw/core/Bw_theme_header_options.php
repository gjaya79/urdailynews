<?php

class Bw_theme_header_options {
	
	static $internal_css = '';
	static $body_class = '';
	
	static $body_font = array(
		''
	);
	
	static function init() {
		
		Bw_theme_header_options::general();
		
		add_action( 'wp_head', array( 'Bw_theme_header_options', 'set_header' ) );
		
	}
	
	static function add_body_class($class) {
		self::$body_class .= ' ' . $class;
	}
	
	static function body_class($additional_class = '') {
		return trim( self::$body_class . ' ' . $additional_class );
	}
	
	static function add_css($css) {
		self::$internal_css .= $css;
	}
	
	static function general() {
		if(Bw::get_option('hide_wp_bar')) {
			add_filter('show_admin_bar', '__return_false');
		}
		if(Bw::get_option('add_navigation_home_icon')) {
			add_filter('wp_nav_menu_items', array('Bw_theme_header_options', 'add_nav_home_icon'), 10, 2);
		}
		if( ! Bw::get_option('enable_image_effect')) {
			Bw::add_body_class( 'disable-image-hover' );
		}
		if( Bw::get_option('enable_lazy_image')) {
			Bw::add_body_class( 'enable-lazy-image' );
		}
	}
	
	static function set_header() {
		
		self::fav_icon();
		self::theme_options();
		self::custom_css();
		
	}
	
	static function fav_icon() {
		$fav = Bw::get_option('fav_icon');
		if ($fav) { echo "<link rel='shortcut icon' href='{$fav}'>"; }
	}
	
	static function theme_options() {
		
		Bw_theme_style::init();
		
	}
	
	static function custom_css() {
		$internal_css = self::$internal_css;
		$custom_css = Bw::get_option('custom_css');
		if($internal_css or $custom_css) { echo "<style>{$internal_css}{$custom_css}</style>"; }
	}
	
	static function logo() {
		
		$ot_logo = Bw::get_option( 'logo' );
		$output = '';
		
		$output .= '<div id="logo"><a href="' . esc_url( home_url( '/' ) ) . '">';
			if(!empty($ot_logo)) {
				$output .= '<img class="desktop" src="' . Bw::get_option( 'logo' ) . '" alt="' . get_bloginfo( 'name' ) . '">';
				$output .= Bw::get_option( 'logo_mobile' ) ? '<img class="mobile" src="' . Bw::get_option( 'logo_mobile' ) . '" alt="">' : '<h4 class="bb mobile plain">' . get_bloginfo( 'name' ) . '</h4>';
			}else{
				$output .= '<h1>' . get_bloginfo( 'name' ) . '</h1><h2>' . get_bloginfo( 'description' ) . '</h2>';
			}
		$output .= '</a></div>';
		
		return $output;
	}
	
	static function the_breadcrumb() {
		echo '<ul>';
		if (!is_front_page()) {
			echo '<li><a href="';
			echo home_url();
			echo '">';
			echo 'Home';
			echo "</a></li>";
			if (is_category() || is_single()) {
				echo '<li>';
				the_category(' </li><li> ');
				if (is_single()) {
					echo "</li><li>";
					the_title();
					echo '</li>';
				}
			} elseif (is_page()) {
				echo '<li>';
				echo the_title();
				echo '</li>';
			}
		}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
		elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
		elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
		elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
		elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
		echo '</ul>';
	}
	
	static function add_nav_home_icon( $items, $args ) {
		
		if( $args->theme_location == 'primary' ) {
			
			$class = is_front_page() ? 'class="current_page_item"' : '';
			$outout = '<li ' . $class . '>' . $args->before . '<a href="' . home_url( '/' ) . '" title="Home">';
			$outout .= $args->link_before . '<i class="fa fa-home"></i>' . $args->link_after;
			$outout .= '<i class="fa fa-circle"></i></a>' . $args->after . '</li>';
			return $outout . $items;
			
		}
		
		return $items;
		
	}
	
}

?>