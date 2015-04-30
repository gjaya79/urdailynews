<?php
/**
 * @package Bad Weather
 */
?>

<?php $classes = 'post'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php Bw::set_post_views(); ?>
	
	<?php if( ! Bw::get_meta_checkbox( 'bw_full_width_featured' ) ): ?>
		<?php get_template_part( 'templates/post-templates/content-featured' ); ?>
	<?php endif; ?>
	
	<div class="post-excerpt">
		<?php if(is_single()): ?>
			<?php get_template_part( 'templates/the-score' ); ?>
			<?php the_content(); ?>
		<?php else: ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
	</div>
	
	<?php if(is_single()): ?>
	<?php get_template_part( 'templates/the-breakdown' ); ?>
	<?php endif; ?>
	
	<?php if(is_single() and !get_field('enable_post_review') ): ?>
		<hr class="border">
	<?php endif; ?>
	
	<?php if( is_single() && Bw::get_option('display_blog_categories') ): ?>
		<div class="cat-tags"><?php the_category(''); ?></div>
	<?php endif; ?>
	
	<?php if( is_single() && Bw::get_option('display_blog_tags') ): ?>
		<div class="post-tags"><?php the_tags('', ''); ?></div>
	<?php endif; ?>
	
	<?php if(is_single() && Bw::get_option('share_links_post')): ?>
		<?php get_template_part( 'templates/share' ); ?>
	<?php endif; ?>
	
	<?php if( is_single() && Bw::get_option('display_blog_author') ): ?>
	<?php $author_id = get_the_author_meta( 'ID' ); ?>
	<div class="post-author">
		<div class="thumb">
			<?php echo get_avatar( $author_id, 120 ); ?> 
		</div>
		<div class="cont">
			<h4><?php the_author_posts_link(); ?></h4>
			<p><?php echo Bw::truncate( get_the_author_meta( 'description' ) ); ?></p>
			
			<ul class="author-list">
			<?php
			
			$author_list = array('url', 'facebook', 'twitter', 'google_plus');
			
			foreach($author_list as $author_item) {
				if(get_the_author_meta($author_item, $author_id )) {
					echo '<li><a href="' . get_the_author_meta($author_item, $author_id ) . '" target="_blank">' . __( Bw::humanize( ( $author_item == 'url' ) ? 'Website' : $author_item ), BW_THEME) . '</a></li>';
				}
			}
			
			?>
			</ul>
			
		</div>
	</div>
	<?php endif; ?>
	
	<?php if( is_single() && Bw::get_option('display_also_like') ): ?>
		<?php get_template_part( 'templates/related-articles' ); ?>
	<?php endif; ?>
	
	<?php wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', BW_THEME ),
				'after'  => '</div>',
			)
	); ?>
	
</article> <!-- // article -->
