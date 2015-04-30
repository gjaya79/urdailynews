<?php

class Bw_theme_style {
	
	// option [ default_value ]
	static $options = array(
		'background_color' => '#f4f4f4',
		'main_color' => '#ff4f4f',
		'background_image' => '',
		'container_shadow' => 'none',
		'header_nav_color' => '#111',
		'header_color' => '#111',
	);
	
	static function init() {
		
		$variables = self::collect();
		
		self::style($variables);
		self::category_style($variables);
		self::article_style($variables);
		
	}
	
	static function collect() {
		
		foreach(self::$options as $option => $default) {
			$variables[$option] = Bw::get_option($option, $default);
		}
		return $variables;
	}
	
	static function style($ot) {
		
		# category styling
		if( is_category() ) {
			if( is_object( get_queried_object() ) and ! empty( get_queried_object()->term_id ) ) {
				$term = get_term( get_queried_object()->term_id, 'category' );
				$cat_color = get_field( 'category_color', $term );
				if( !empty( $cat_color ) ) {
					$ot['main_color'] = $cat_color;
				}
			}
		}
		
		# signle article inherit first category style
		if( is_single() ) {
			$cat_object = current( get_the_category() );
			if( is_object( $cat_object ) and ! empty( $cat_object->term_id ) ) {
				$term = get_term( $cat_object->term_id, 'category' );
				$cat_color = get_field( 'category_color', $term );
				if( !empty( $cat_color ) ) {
					$ot['main_color'] = $cat_color;
				}
			}
		}
		
		$style = "
			::selection {background:{$ot['main_color']};color:#fff;}
			::-moz-selection {background:{$ot['main_color']};color:#fff;}
		";
		
		# bg elements
		$style .= ".bargraph li span, .post-categories a, .post-tags a, .billboard-slider .info .read-more a:hover, .bw-slider .owl-buttons div:hover, .article-thumb:hover .icon, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, #footer .reviews article .bar .progress, .reviews article .bar .progress, .widget_tag_cloud a, #header.version-3 .right-content.black .search-submit:hover, #header.version-3 .search-form .search-submit, .page .search-form .search-submit:hover, #header.version-3 .search-form .search-submit:hover, .cat-tags a, .score-box .score, .review-score .bar .progress, .article-thumb .rate, #header .social a:hover {background-color:{$ot['main_color']}!important}";
		$style .= "#footer .widget_tag_cloud a:hover {background-color:{$ot['main_color']}!important;}";
		
		# color elements
		$style .= ".bw-button, .bw-slider .title h3:hover, .article-title h3.bb a:hover, #sidebar .reviews article .bar .score-label a:hover, .bw-megamenu .article-title span:hover, .bw-megamenu .megamenu-slider .item:hover .title h3, .bw-megamenu .small-link:hover, .woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button, .woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button, .woocommerce .product_meta a, #footer .bw-popular-widget-nav a.active, .widget_archive ul a, .widget_categories ul a, .widget_pages ul a, #content .post table th, .post-author .cont h4 a:hover, .cat-tags-list a, .header-parallax .date strong a:hover, .post-subtitle a:hover, a, a:visited {color:{$ot['main_color']}}";
		
		# other
		$style .= ".post-tags a:before, .cat-tags a:before {border-right-color:{$ot['main_color']}}";
		$style .= "blockquote {border-left:8px solid:{$ot['main_color']}}";
		$style .= "#footer #wp-calendar tbody td {border-top:1px solid {$ot['main_color']}}";
		$style .= "#footer #wp-calendar tfoot tr td {border-top:1px solid {$ot['main_color']}}";
		$style .= ".billboard-slider .info .read-more a:hover, .bw-slider .owl-buttons div:hover, .article-thumb:hover .icon {border-color:{$ot['main_color']}}";
		$style .= "blockquote {border-color:{$ot['main_color']}}";
		
		$style .= "
			body {background-color:{$ot['background_color']}}
			#header .row-holder {background-color:{$ot['header_nav_color']}}
			body.boxed #header .row-holder .row.for-sub-header {background-color:{$ot['header_nav_color']};}
		";
		
		$style .= ".papa-grid h3 a {color:#000}";
		$style .= ".post-categories a:hover, .post-tags a:hover {background-color:#000!important}";
		
		$style .= ".article-thumb .rate:after {border-color:rgba(" . Bw::color_saturation( Bw::hex2rgb( $ot['main_color'] ), -60 ) . ",1) transparent}";
		
		if( Bw::get_option( 'header_white' ) ) {
			$style .= '#header {background-color:#fff;}';
		}
		
		if( Bw::get_option( 'header_nav_color' ) or Bw::get_option( 'invert_header_nav_color' ) ) {
			$style .= '.bw-megamenu {padding-top:15px;}';
		}
		
		if( Bw::get_option( 'header_color' ) and !Bw::get_option( 'header_white' ) ) {
			$style .= "#header {background-color:{$ot['header_color']};}";
		}
		
		if($ot['background_image']) {
			$style .= "#bw-bg {background:url('{$ot['background_image']}') no-repeat center center;background-size:cover;background-attachment:fixed;}";
		}
		
		$style .= self::get_shadow( $ot['container_shadow'] );
		
		printf("<style>%s</style>", $style);
	}
	
	static function get_shadow( $option ) {
		
		switch( $option ) {
			case 'light':
				$shadow_css = 'box-shadow:0px 1px 5px 0px rgba(0, 0, 0, 0.2)'; break;
			case 'medium':
				$shadow_css = 'box-shadow:0px 1px 15px 0px rgba(0, 0, 0, 0.4)'; break;
			case 'dark':
				$shadow_css = 'box-shadow:0px 1px 25px 0px rgba(0, 0, 0, 0.7)'; break;
		}
		
		if( in_array( $option, array( 'light', 'medium', 'dark' ) ) ) {
			return "#container > .row {{$shadow_css};-moz-{$shadow_css};-webkit-{$shadow_css}}";
		}
		
		return '';
		
	}
	
	static function category_style($ot) {
		
		if( is_category() ) {
			
			$style = '';
			
			if( is_object( get_queried_object() ) and ! empty( get_queried_object()->term_id ) ) {
			
				$term = get_term( get_queried_object()->term_id, 'category' );
				
				$cat_color = get_field('category_color', $term);
				$cat_background = get_field('cat_background_image', $term);
				$cat_background_color = get_field('category_background_color', $term);
				$container_shadow = get_field('container_shadow', $term);
				
				if( ! empty( $cat_background_color ) ) {
					$style .= "body {background-color:{$cat_background_color}}";
				}
				
				if( isset( $cat_background['url'] ) and ! empty( $cat_background['url'] )) {
					$style .= "#bw-bg {background:url('{$cat_background['url']}') repeat center center;background-size:cover;background-attachment:fixed;}";
				}
				
				$style .= self::get_shadow( $container_shadow );
				
				printf("<style>%s</style>", $style);
			
			}
		}
	}
	
	static function article_style($ot) {
		
		if( is_single() ) {
			
			$style = '';
			
			$cat_object = current( get_the_category() );
			
			if( is_object( $cat_object ) and ! empty( $cat_object->term_id ) ) {
				
				$term = get_term( $cat_object->term_id, 'category' );
				
				$cat_color = get_field('category_color', $term);
				$cat_background = get_field('cat_background_image', $term);
				$cat_background_color = get_field('category_background_color', $term);
				$container_shadow = get_field('container_shadow', $term);
				
				if( ! empty( $cat_background_color ) ) {
					$style .= "body {background-color:{$cat_background_color}}";
				}
				
				if( isset( $cat_background['url'] ) and ! empty( $cat_background['url'] )) {
					$style .= "#bw-bg {background:url('{$cat_background['url']}') repeat center center;background-size:cover;background-attachment:fixed;}";
				}
				
				$style .= self::get_shadow( $container_shadow );
				
				printf("<style>%s</style>", $style);
			
			}
		}
	}
	
}

?>