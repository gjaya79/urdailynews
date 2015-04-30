<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Bad Weather
 */

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'templates/content/content-page' ); ?>
			
			<?php if( Bw::get_option('comment_type_page') == 'facebook' ): ?>
				<?php get_template_part( 'templates/comments/facebook' ); ?>
			<?php elseif( Bw::get_option('comment_type_page') == 'wp_comments' ): ?>
				<?php if ( comments_open() || '0' != get_comments_number() ) { comments_template(); } ?>
			<?php else: ?>
				<!-- comments are disabled -->
			<?php endif; ?>

		<?php endwhile; ?>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
