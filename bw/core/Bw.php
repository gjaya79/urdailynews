<?php

/* This file is property of bad Weather Themes. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    Bw
 * @category   functions
 * @author     Bad Weather Themes
 * @copyright  (c) 2014, Bad Weather Themes
 */

class Bw {
	
	# define startup classes
	static $startup_classes = array(
		'setup', 				# sets up theme defaults
		'options', 				# initiate option tree
		'woo', 					# woocommerce initialization
		'admin', 				# initiate admin stuff
		'theme', 				# load theme components
		'theme_thumbnails', 	# thumbnails
		'assets', 				# load css, javascript, erc.
		'post_type', 			# load custom post types
		'taxonomy', 			# load custom taxonomies
		'widgets', 				# widgets
		'shortcodes', 			# shortcode generator
		'acf', 					# advanced custom fields
	);
	
	# initiate defined modules in $startup_classes
	static function init() {
		
		foreach(self::$startup_classes as $stc) {
			call_user_func(array('Bw_' . $stc, 'init'));
		}
		
	}
	
	/**
	 * Requires all PHP files in a directory.
	 * Use case: callback directory, removes the need to manage callbacks.
	 *
	 * Should be used on a small directory chunks with no sub directories to
	 * keep code clear.
	 *
	 * @param string path
	 */
	static function require_all($path)
	{
		if(is_array($path)) {
			foreach($path as $p) {
				self::require_all($p);
			}
			return;
		}
		$files = self::find_files(rtrim($path, '\\/'));
		
		foreach ($files as $file) {
			if (strpos($file, '.php') && !strpos($file, 'Bw.php')) {
				require $file;
			}
		}
	}
	
	/**
	 * Recursively finds all files in a directory.
	 *
	 * @param string directory to search
	 * @return array found files
	 */
	static function find_files($dir)
	{
		$found_files = array();
		$files = scandir($dir);

		foreach ($files as $value) {
			// skip special dot files
			if ($value === '.' || $value === '..') {
				continue;
			}

			// is it a file?
			if (is_file("$dir/$value")) {
				$found_files[]= "$dir/$value";
				continue;
			}
			else { // it's a directory
				foreach (self::find_files("$dir/$value") as $value) {
					$found_files[]= $value;
				}
			}
		}

		return $found_files;
	}
	
	# display navigation to next/previous set of posts when applicable.
	static function paging_nav() {
		
		# Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) { return; }
		?>
		
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', BW_THEME ); ?></h1>
			<div class="nav-posts">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><span class="after">&nbsp;</span></span>', BW_THEME ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav"><span class="after">&nbsp;</span></span>', BW_THEME ) ); ?></div>
				<?php endif; ?>

			</div>
		</nav><?php
	}
	
	# get the current page
	static function current_page() {
		$var = is_front_page() ? 'page' : 'paged';
		return get_query_var( $var ) ? get_query_var( $var ) : 1;
	}
	
	# display numeric pagination
	static function pagination($pages = '', $range = 4, $show_map = false) {
		
		$showitems = ( $range * 2 ) + 1;

		$paged = Bw::current_page();

		if( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) { $pages = 1; }
		}   

		if( $pages !== 1 ) {
			
			echo "<div class='pagination'>";
			
			if( $show_map ) {
				echo "<span>Page {$paged} of {$pages}</span>";
			}
			
			if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>"; }
			if( $paged > 1 ) { echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>"; }

			for ( $i=1; $i <= $pages; $i++ ) {
				if ( $pages !== 1  && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
					echo ($paged == $i)? "<span class='current'>{$i}</span>":"<a href='" . get_pagenum_link($i) . "' class='inactive'>{$i}</a>";
				}
			}
			
			if ($paged < $pages) { echo "<a href='" . get_pagenum_link($paged + 1) . "'>Next &rsaquo;</a>"; }
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>"; }
			
			echo "</div>";
		}
	}
	
	# display navigation to next/previous post when applicable.
	static function post_nav() {
		
		# Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) { return; } ?>
		
		<div class="nav-links-holder">
			<nav class="navigation post-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Post navigation', BW_THEME ); ?></h1>
				<div class="nav-links">
					<?php
						previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', BW_THEME ) );
						next_post_link( '<div class="nav-next">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', BW_THEME ) );
					?>
				</div>
			</nav>
		</div><?php
	}
	
	# returns html of logo, located in \"Bw_theme_header_options\"
	static function logo() {
		echo Bw_theme_header_options::logo();
	}
	
	# generate page title
	static function page_title() {
		return !is_front_page() ? the_title() : bloginfo('name');
	}
	
	# redirect page based on native wp redirect
	static function redirect( $location, $status = '302' ) { // statuc code: temporary redirect
		wp_redirect( $location, $status );
	}
	
	# returns custom option tree option
	static function get_option($option_id, $default = '') {
		return ot_get_option($option_id, $default);
	}
	
	# echo custom option tree option
	static function the_option($option_id, $default = '') {
		echo ot_get_option($option_id, $default);
	}
	
	# returns option tree true / false option
	static function get_checkbox($option_id, $default = '') {
		$value = ot_get_option($option_id, $default);
		return isset($value[0]) ? $value[0] : false;
	}
	
	# echo option tree true / false option
	static function the_checkbox($option_id, $default = '') {
		$value = ot_get_option($option_id, $default);
		echo isset($value[0]) ? $value[0] : false;
	}
	
	# returns custom meta box
	static function get_meta( $meta_key, $post_id = 0, $single = true ) {
		return get_post_meta( ( ( (int)$post_id > 0 ) ? $post_id : get_the_ID() ), $meta_key, $single );
	}
	
	# echo custom meta box
	static function the_meta( $meta_key, $post_id = 0, $single = true ) {
		echo get_post_meta( ( ( (int)$post_id > 0 ) ? $post_id : get_the_ID() ), $meta_key, $single );
	}
	
	# echo true / false based on custom meta box
	static function get_meta_checkbox( $meta_key, $post_id = 0, $single = true ) {
		$value = get_post_meta( ( ( (int)$post_id > 0 ) ? $post_id : get_the_ID() ), $meta_key, $single );
		return isset($value[0]) ? $value[0] : false;
	}
	
	# returns true / false based on custom meta box
	static function the_meta_checkbox( $meta_key, $post_id = 0, $single = true ) {
		$value = get_post_meta( ( ( (int)$post_id > 0 ) ? $post_id : get_the_ID() ), $meta_key, $single );
		echo isset($value[0]) ? $value[0] : false;
	}
	
	# add additional css styles to header based on wp_head filter
	static function add_css($css) {
		Bw_theme_header_options::add_css($css);
	}
	
	# generates a list of social icons
	static function go_social() {
		
		// mono social icons unicode
		$unicode = array("aboutme"=>"&#xe001;", "aol"=>"&#xe004;", "amazon"=>"&#xe003;", "apple"=>"&#xe007;", "appstore"=>"&#xe006;", "bebo"=>"&#xe008;", "behance"=>"&#xe009;", "bing"=>"&#xe010;", "blogger"=>"&#xe012;", "dribble"=>"&#xe021;", "delicious"=>"&#xe015;", "diggalt"=>"&#xe019;", "ebay"=>"&#xe023;", "email"=>"&#xe024;", "facebook"=>"&#xe027;", "googleplus"=>"&#xe039;", "pinterest"=>"&#xe064;", "instagram"=>"&#xe100;", "linkedin"=>"&#xe052;", "skype"=>"&#xe074;", "tumblr"=>"&#xe085;", "github"=>"&#xe037;", "flickr"=>"&#xe029;", "foodspotting"=>"&#xe030;", "googlebuzz"=>"&#xe038;", "gowallapin"=>"&#xe041;", "grooveshark"=>"&#xe043;", "heart"=>"&#xe044;", "icq"=>"&#xe047;", "imessage"=>"&#xe049;", "itunes"=>"&#xe050;", "lastfm"=>"&#xe051;", "mobileme"=>"&#xe056;", "myspace"=>"&#xe059;", "picasa"=>"&#xe063;", "soundcloud"=>"&#xe078;", "star"=>"&#xe082;", "twitter"=>"&#xe086;", "vimeo"=>"&#xe089;", "wordpress"=>"&#xe094;", "yahoo"=>"&#xe097;", "youtube"=>"&#xe099;", "fivehundredpx"=>"&#xe000;");
		
		$social_icons = Bw::get_option('social_icons');
		if(is_array($social_icons)) {
			$output = '<ul class="social">';
			foreach($social_icons as $media) {
				$output .= '<li><a href="' . $media['social_url'] . '" target="_blank" title="' . $media['title'] . '"><span class="icon">' . $unicode[$media['social_media']] . '</span></a></li>';
			}
			$output .= '</ul>';
			echo $output;
		}
	}
	
	# generate page breadcrumbs, located in \"Bw_theme_header_options\"
	static function the_breadcrumb() {
		return Bw_theme_header_options::the_breadcrumb();
	}
	
	# returns array with image info based on string of ids
	static function gallerize_by_id($ids, $size = 'thumbnail', $icon = false) {
		
		$ids_array = array_filter(explode(',', $ids));
		$output = array();
		
		if( !empty($ids_array) ) {
			foreach($ids_array as $id) {
				$info = get_post($id);
				if(is_object($info)) {
					$output[] = array(
						'permalink' => get_permalink($info->ID),
						'title' => $info->post_title,
						'info' => $info->post_content,
						'thumb' => wp_get_attachment_image_src($id, $size, $icon)
					);
				}
			}
		}
		return $output;
	}
	
	# native wp truncate string
	static function truncate( $text, $num_words = 55, $more = null ) {
		return wp_trim_words( $text, $num_words, $more );
	}
	
	# sum to post view
	static function set_post_views($current_post_id = 0) {
		
		$post_id = ($current_post_id == 0) ? get_the_ID() : $current_post_id;
		
		$count_key = 'post_views_count';
		$count = get_post_meta($post_id, $count_key, true);
		if($count == '') {
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');
		}else{
			$count++;
			update_post_meta($post_id, $count_key, $count);
		}
	}
	
	# get the current post views by custom field
	static function get_post_views($current_post_id = 0) {
		
		$post_id = ($current_post_id == 0) ? get_the_ID() : $current_post_id;
		
		$count_key = 'post_views_count';
		$count = get_post_meta($post_id, $count_key, true);
		if($count == '') {
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');
			return 0;
		}
		return $count;
	}
	
	# returns the first category from post
	static function first_cat() {
		$category = get_the_category();
		if( is_object( $category[0] ) ) {
			return $category[0]->cat_name;
		}
		return;
	}
	
	# returns the first category from post + url
	static function first_ucat() {
		$category = get_the_category();
		if( is_object( $category[0] ) ) {
			return '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
		}
		return;
	}
	
	# get database perfix
	static function perfix() {
		global $wpdb;
		return $wpdb->prefix;
	}
	
	# convert string to human readable data
	static function humanize($str) {
		return ucfirst( str_replace( '_', ' ', strtolower( trim( $str ) ) ) );
	}
	
	static function content_class() {
		$content_class = '';
		
		switch(true) {
			case ( is_single() and Bw::get_meta('page_layout') == 'full' ) :
				$content_class .= 'full'; break;
			case is_single() :
				$content_class .= 'right'; break;
			case is_archive():
				$content_class .= 'right'; break;
			case get_post_type() == 'post':
				$content_class .= 'right'; break;
			default:
				$content_class .= Bw::the_meta('page_layout'); break;
		}
		
		echo $content_class;
	}
	
	# check if the current post icon and echo
	static function get_format_icon() {
		
		$has_icon = true;
		
		switch( get_post_format() ) {
			case( 'video' ):
				$icon = 'fa-video-camera'; break;
			case( 'gallery' ):
				$icon = 'fa-camera'; break;
			default:
				$has_icon = false;
		}
		
		if( $has_icon ) {
		
			$output  = "<div class=\"post-icons\">";
			$output .= "<div class=\"icon\"><i class=\"fa {$icon}\"></i></div>";
			$output .= "</div>";
			
			return $output;
		
		}
		
		return;
	}
	
	# returns the rating of the post
	static function get_rate() {
		
		if( Bw::has_average_score() ) {
			return "<span class=\"rate bb\">" . Bw::get_average_score() . "</span>";
		}
		
		return;
		
	}
	
	# add some additional class to body tag
	static function add_body_class($class) {
		Bw_theme_header_options::add_body_class($class);
	}
	
	# return the body classes
	static function body_class($class = '') {
		return Bw_theme_header_options::body_class($class);
	}
	
	# check if post reviews enabled
	static function has_average_score() {
		
		if (get_field('enable_post_review') && get_field('score_breakdown')) { return true; }
		return false;
		
	}
	
	# get the score of the current post
	static function get_average_score() {
		
		if (get_field('enable_post_review') && get_field('score_breakdown')):
			$average = 0;
			$scores = 0;
			while (has_sub_fields('score_breakdown')):
				$average = $average + get_sub_field('score');
				$scores++;
			endwhile;
			$average = round($average / $scores, 1);
			return $average;
		endif;

		return false;
	}
	
	# returns empty img or placeholder
	static function empty_img( $size = false ) {
		return BW_URI_ASSETS . 'img/empty/' . ( $size ? $size : 'pixel' ) . '.png';
	}
	
	# returns featured image src
	static function get_image_src( $size = 'thumbnail', $id = 0 ) {
		$id = ( $id == 0 ) ? get_the_ID() : $id;
		$thumb_id = get_post_thumbnail_id( $id );
		$thumb_img = wp_get_attachment_image_src( $thumb_id, $size );
		if( isset( $thumb_img[0] ) ) {
			return $thumb_img[0];
		}
		return;
	}
	
	# returns hex color format to rgb
	static function hex2rgb( $hex ) {
		
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);

		return $rgb; // returns an array with the rgb values
	}
	
	# change color saturation
	static function color_saturation( $color, $steps = -60 ) {
		$rgbs = array();
		foreach($color as $rgb) {
			
			$rgb = $rgb + $steps;
			
			if($rgb < 0) { $rgb = 0; }
			if($rgb > 255) { $rgb = 255; }
			
			$rgbs[] = $rgb;
		}
		
		return implode(',', $rgbs);
	}
	
}



?>