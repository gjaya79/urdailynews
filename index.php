<?php

/**
 * The main template file.
 *
 */

get_header(); ?>
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
		<?php if ( have_posts() ) : ?>
			
			<div class="posts-grid-holder fullwidth">
				<div class="posts-grid bw-over">
				
					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php get_template_part('templates/post-templates/content-grid'); ?>
						
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