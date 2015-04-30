<?php

/* 
 * Sets up theme defaults
 */

class Bw_setup {
	
	static function init() {
		
		# default theme setup
		add_action( 'after_setup_theme', array('Bw_setup', 'setup') );
		
		# replace default wp caption shortcode
		add_action( 'after_setup_theme', array('Bw_setup', 'wpse_74735_replace_wp_caption_shortcode') );
		
	}
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	static function setup() {
		
		/**
		 * http://codex.wordpress.org/Content_Width
		 */
		if ( ! isset($content_width)) { $content_width = 960; }
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /lang/ directory.
		 * If you're building a theme based on Bad Weather framework, use a find and replace
		 * to change 'BW_THEME' static variable to the name of your theme, located in bootstrap.php
		 */
		load_theme_textdomain( BW_THEME, get_template_directory() . '/lang' );
		//load_textdomain('marroco', get_template_directory() . '/lang/default.mo');
		
		# Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		# This theme uses wp_nav_menu() in one location.
		register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', BW_THEME ),
		) );

		# Secondary top left menu
		register_nav_menus(
		array(
			'top_left' => __( 'Top Left Menu', BW_THEME ),
		) );

		# Secondary top right menu
		register_nav_menus(
		array(
			'top_right' => __( 'Top Right Menu', BW_THEME ),
		) );

		# Footer menu
		register_nav_menus(
		array(
			'footer' => __( 'Footer bottom menu', BW_THEME ),
		) );

		# Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video' ) );

		# Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bad_weather_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		# Enable support for HTML5 markup.
		add_theme_support( 'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
			)
		);
		
		# remove parentheses from category list and add span class to post count
		add_filter('wp_list_categories', array('Bw_setup', 'categories_postcount_filter'));
		
		# same for archives
		add_filter('get_archives_link', array('Bw_setup', 'archive_postcount_filter'));
		
		# custom excerpt text
		add_filter('excerpt_more', array('Bw_setup', 'new_excerpt_more'));
		
		# custom excerpt length
		add_filter('excerpt_length', array('Bw_setup', 'new_excerpt_length'), 999);
		
		# custom widget titles
		add_filter( 'dynamic_sidebar_params', array('Bw_setup', 'wrap_widget_titles'));
		
		# add custom attributes to native wordpress gallery
		add_filter('wp_get_attachment_link', array('Bw_setup', 'modify_attachment_link'));
		
		# author\'s social media details
		add_filter('user_contactmethods', array('Bw_setup', 'custom_author_social_details'));
		
	}
	
	/**
	 * Replace the default caption shortcode handler.
	 *
	 * @return void
	 */
	static function wpse_74735_replace_wp_caption_shortcode() {
		remove_shortcode( 'caption', 'img_caption_shortcode' );
		remove_shortcode( 'wp_caption', 'img_caption_shortcode' );
		add_shortcode( 'caption', array('Bw_setup', 'wpse_74735_caption_shortcode') );
		add_shortcode( 'wp_caption', array('Bw_setup', 'wpse_74735_caption_shortcode') );
	}
	
	/**
	 * Add the new class to the caption.
	 *
	 * @param  array  $attr    Shortcode attributes
	 * @param  string $content Caption text
	 * @return string
	 */
	static function wpse_74735_caption_shortcode( $attr, $content = NULL )
	{
		$caption = img_caption_shortcode( $attr, $content );
		$caption = str_replace( 'a href="', 'a class="mp-item" href="', $caption );
		return $caption;
	}
	
	static function custom_author_social_details( $details ) {
		return $details = array(
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'google_plus' => 'Google plus',
		);
	}
	
	static function modify_attachment_link( $link ) {
		
		preg_match('/href=(["\'])([^\1]*)\1/i', $link, $output);
		$href = $output[2];
		$class = @GetImageSize($href) ? 'class="mp-item"' : '';
		return str_replace("<a href", "<a {$class} href", $link);
		
	}
	
	static function wrap_widget_titles( array $params ) {
		
		$widget =& $params[0];
		$widget['before_title'] = '<h3 class="widget-title"><span>';
		$widget['after_title'] = '</span></h3>';
		return $params;
		
	}
	
	static function categories_postcount_filter($variable) {
		$variable = str_replace('(', '<span class="post-count">', $variable);
		$variable = str_replace(')', '</span>', $variable);
		return $variable;
	}
	
	static function archive_postcount_filter($links) {
		$links = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post-count">', $links);
		$links = str_replace(')', '</span>', $links);
		return $links;
	}
	
	static function new_excerpt_more() {
		return ' ...';
	}
	
	static function new_excerpt_length( $length ) {
		return 15;
	}
	
}

?>