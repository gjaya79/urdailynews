<?php
/**
 * Hook in on activation
 */

class Bw_woo {
	
	static $enable = true;
	
	static function init() {
		
		# check if woocommerce plugin is active
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			
			# enqueue styles
			self::enqueue_assets();
			
			# main settings
			self::setup();
		
			# ajaxify add to cart
			add_filter('add_to_cart_fragments', array('Bw_woo', 'woocommerce_header_add_to_cart_fragment'));
			
			# change the default empty image path
			add_filter('woocommerce_placeholder_img_src', array('Bw_woo', 'custom_image_placeholder'));
			
			# fix for mobile devices and drag widget
			self::load_touch_punch_js();
			
			/* This snippet removes the action that inserts thumbnails to products in teh loop
			 * and re-adds the function customized with our wrapper in it.
			 * It applies to all archives with products.
			 *
			 * @original plugin: WooCommerce
			 * @author of snippet: Brian Krogsard
			 */
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
			add_action( 'woocommerce_before_shop_loop_item_title', array('Bw_woo', 'get_product_thumbnail'), 10);
			
			# custom onsale text
			add_filter('woocommerce_sale_flash', array('Bw_woo', 'onsale_flash'), 10, 3);
			
			# set 3 columns per row for shop if the right bar is active
			if( get_post_meta( woocommerce_get_page_id( 'shop' ), 'page_layout', true ) == 'right' ) {
				self::shop_items_per_row();
			}
			
			# remove default lightbox
			self::remove_prettyphoto();
			
			# add custom lightbox to gallery
			self::add_lightbox();
			
			# change the number of related products displayed
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			add_action( 'woocommerce_after_single_product_summary', array('Bw_woo', 'child_after_summary'), 20 );
			
		}
	}
	
	static function woo_active_plugin() {
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { return true; }
		return false;
	}
	
	static function is_woo_page() {
		return is_woocommerce() || is_page('store') || is_shop() || is_product_category() || is_product() || is_cart() || is_checkout();
	}
	
	static function set_default_thumbnails() {
		
		$catalog = array(
			'width' 	=> '400',	# px
			'height'	=> '480',	# px
			'crop'		=> 1 		# true
		);
	 
		$single = array(
			'width' 	=> '600',	# px
			'height'	=> '720',	# px
			'crop'		=> 1 		# true
		);
	 
		$thumbnail = array(
			'width' 	=> '300',	# px
			'height'	=> '300',	# px
			'crop'		=> 1 		# true
		);
	 
		# Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		# Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		# Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	# Image gallery thumbs
		
	}
	
	static function custom_image_placeholder($src) {
		return BW_URI_ASSETS . 'img/empty/400x480.png';
	}
	
	static function custom_image_paypal($src) {
		return BW_URI_ASSETS . 'img/woocommerce/paypal.png';
	}
	
	static function shop_items_per_row() {
		add_filter('loop_shop_columns', array('Bw_woo', 'loop_columns'), 999);
	}
	
	static function loop_columns() {
		return 3;
	}
	
	static function load_touch_punch_js() {
		
		global $version;
		
		Bw_assets::addScript( 'jquery-ui-widget' );
		Bw_assets::addScript( 'jquery-ui-mouse' );
		Bw_assets::addScript( 'jquery-ui-slider' );
		Bw_assets::addScript( 'woo-jquery-touch-punch', "bw/assets/js/vendors/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js", array('jquery'), $version, true );
		
	}
	
	static function woocommerce_header_add_to_cart_fragment( $fragments ) {
		
		global $woocommerce;
		
		ob_start();
		
		?><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a><?php
		
		$fragments['a.cart-contents'] = ob_get_clean();
		
		return $fragments;
		
	}
	
	static function enqueue_assets() {
		
		# Remove default woocommerce styles
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		
		# enqueue theme\'s woocommerce styles
		Bw_assets::addStyle('bw-woo-layout', 'assets/css/woocommerce/woocommerce-layout.css');
		Bw_assets::addStyle('bw-woo-smallscreen', 'assets/css/woocommerce/woocommerce-smallscreen.css', array(), BW_VERSION, 'only screen and (max-width: 768px)');
		Bw_assets::addStyle('bw-woo-general', 'assets/css/woocommerce/woocommerce.css');
		
	}
	
	static function setup() {
		
		add_theme_support( 'woocommerce' );
		
		add_action( 'init', array('Bw_woo', 'jk_remove_wc_breadcrumbs') );
		
	}
	
	static function jk_remove_wc_breadcrumbs() {
		
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		
	}
	
	static function is_woo() {
		
		if( ! function_exists( 'is_woocommerce' ) ) { return false; }
		
		return is_woocommerce() or is_cart();
	}
	
	static function post_meta_shop($meta_key) {
		
		if( self::is_woo_page() and self::$enable == true ) {
			
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			
			return get_post_meta( $shop_page_id, $meta_key, true );
			
		}
		
		return false;
	}
	
	static function get_product_thumbnail() {
		get_template_part( 'templates/woocommerce/loop_archive_product' );
	}
	
	static function onsale_flash($text, $post, $_product) {
		return '<span class="onsale">Sale</span>'; 
	}
	
	static function remove_prettyphoto() {
		add_action( 'wp_print_scripts', array('Bw_woo', 'deregister_js'), 100 );
		add_action( 'wp_print_styles', array('Bw_woo', 'deregister_css'), 100 );
	}
	
	static function deregister_js() {
		if ( self::is_woo_page() ) {
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
		}
	}
	
	static function deregister_css() {
		if ( self::is_woo_page() ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		}
	}
	
	static function add_lightbox() {
		add_action( 'wp_enqueue_scripts', array('Bw_woo', 'enqueue_lighbox_scripts') );
	}
	
	static function enqueue_lighbox_scripts() {
		if ( self::is_woo_page() ) {
			Bw_assets::addStyle('bw-magnific-popup', 'assets/css/vendors/jquery.magnific-popup/magnific-popup.css');
			Bw_assets::addScript('bw-magnific-popup-js', 'assets/js/vendors/jquery.magnific-popup/jquery.magnific-popup.min.js' );
		}
	}
	
	static function child_after_summary() {
		woocommerce_related_products( array( 'posts_per_page' => 4, 'columns' => 4 ) );
	}
}

?>