<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Bad Weather
 */

get_header(); ?>
	
	<?php if( Bw::get_meta_checkbox( 'bw_full_width_featured', get_the_ID() ) ): ?>
		<?php get_template_part( 'templates/post-templates/content-featured' ); ?>
	<?php endif; ?>
	
	<!-- post header -->
	<?php if( !get_field( 'enable_parallax_header' ) ): ?>
	<div class="post-header">
		
		<h1 class="post-title <?php if( get_post_format() == '' ) { echo 'no-padding'; } ?> <?php if ( Bw::get_meta_checkbox( 'bw_full_width_featured') ) { echo 'top'; } ?>">
		<?php if( !is_single() ): ?><a href="<?php the_permalink(); ?>"><?php endif ?>
		<?php the_title(); ?>
		<?php if( !is_single() ): ?></a><?php endif; ?>
		</h1>
		
		<?php if( is_single() ):
			
			$top_author = get_the_author();
			$top_date = get_the_date();
			
			if( !empty( $top_author ) and !empty( $top_date ) ): ?>
			
			<div class="post-subtitle">
				<?php if( Bw::get_option( 'display_blog_author' ) ): ?>
					<strong><?php the_author(); ?></strong>
					<?php // echo __('on', BW_THEME); ?>
				<?php endif; ?>
				<?php echo get_the_date(); ?>
			</div>
			
			<?php endif; ?>
			
		<?php endif; ?>
	
	</div>
	<?php endif; ?> <!-- // post header -->
	
	<div id="content" class="<?php Bw::content_class(); ?>">
		
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'templates/content/content', str_replace('bw_', '', get_post_type() ) ); ?>
				
				<?php Bw::post_nav(); ?>
				
				<?php if( Bw::get_option('comment_type_blog') == 'facebook' ): ?>
					<?php get_template_part( 'templates/comments/facebook' ); ?>
				<?php elseif( Bw::get_option('comment_type_blog') == 'none' ): ?>
					<!-- comments are disabled -->
				<?php else: ?>
					<?php if ( comments_open() || '0' != get_comments_number() ) { comments_template(); } ?>
				<?php endif; ?>

			<?php endwhile; ?>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>