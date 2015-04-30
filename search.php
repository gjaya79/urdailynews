<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Bad Weather
 */

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<?php if( have_posts() ): ?>
		
		<div class="heading">
			<h1 class="page-title">
				<?php echo __( 'Looking for: ', BW_THEME ) . get_search_query(); ?>
			</h1>
		</div>
		
		<?php $layout = Bw::get_option( 'blog_layout' ) ? Bw::get_option( 'blog_layout' ) : 'list' ; ?>

		<div class="posts-<?php echo $layout; ?>-holder">
			<div class="posts-<?php echo $layout; ?> bw-over">
				
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part("templates/post-templates/content-{$layout}"); ?>

				<?php endwhile; ?>
				
			</div>
		</div>
		
		<?php Bw::paging_nav(); ?>
			
		<?php else : ?>
			
			<?php get_template_part( 'templates/content/content', 'none' ); ?>
			
		<?php endif; ?>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>