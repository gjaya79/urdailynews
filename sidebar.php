<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Bad Weather
 */
?>

<?php if( Bw::get_meta('page_layout') == 'right'
		  or is_search()
		  or is_category()
		  or basename( @get_page_template() ) == 'custom-page-builder.php'
		  or ( get_post_type() == 'post' && Bw::get_meta('page_layout') !== 'full' )
		  or ( Bw_woo::woo_active_plugin() and is_shop() and Bw_woo::post_meta_shop( 'page_layout' ) == 'right' )
		  or ( Bw_woo::woo_active_plugin() and is_product_category() and Bw_woo::post_meta_shop( 'page_layout' ) == 'right' ) ) : ?>

<div id="sidebar" class="<?php echo (basename( get_page_template() ) == 'custom-page-builder.php') ? 'custom' : ''; ?>">
	<?php $sidebar = Bw_woo::is_woo() ? 'sidebar-shop' : 'sidebar-1'; ?>
	
	<?php if ( ! dynamic_sidebar( $sidebar ) ) :  ?>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<h1 class="widget-title"><?php _e( 'Archives', BW_THEME ); ?></h1>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget">
			<h1 class="widget-title"><?php _e( 'Meta', BW_THEME ); ?></h1>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; ?>
</div> <!-- #sidebar -->
<?php endif; ?>