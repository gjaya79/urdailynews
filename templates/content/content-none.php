<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bad Weather
 */
?>

<section class="no-results">
	
	<div class="page">
		
		<div class="heading">
			<h2 class="page-title"><?php echo __( 'Nothing found', BW_THEME ); ?></h2>
		</div>
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', BW_THEME ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', BW_THEME ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', BW_THEME ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
