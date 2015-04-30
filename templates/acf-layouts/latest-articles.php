<?php

global $wp_query;
$wp_query->query_vars['thumbnail_size'] = 'bw_350x300';

$paged = (get_query_var('paged')) ? get_query_var('paged') : '';
if( empty($paged)) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

if( empty($paged)) {
	$paged = 1;
}

$number_of_posts = get_sub_field('number_of_posts');

$args = array(
	'paged' => $paged,
	'posts_per_page' => $number_of_posts,
	'order' => 'DESC',
	'orderby' => 'date',
	'ignore_sticky_posts' => true,
);

$latest_query = new WP_Query( $args );

$has_sidebar = false;

if ( get_sub_field('enable_sidebar') ) {
	$has_sidebar = true;
}

$layout_type = get_sub_field( 'layout' );
$layout = !empty( $layout_type ) ? $layout_type : 'grid' ;

if ($latest_query->have_posts()): ?>
	
	<div class="heading">
		<h2 class="page-title"><?php the_sub_field('section_title'); ?></h2>
	</div>
		
	<div class="posts-<?php echo $layout; ?>-holder <?php echo ! $has_sidebar ? 'fullwidth' : 'right'; ?>">
		<div class="posts-<?php echo $layout; ?> bw-over">
				
			<div class="latest-articles-content <?php echo $has_sidebar ? 'right' : ''; ?>">
				<?php while($latest_query->have_posts()): $latest_query->the_post();  ?>
					<?php get_template_part('templates/post-templates/content-' . $layout); ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			
		</div>
		
		<?php if ( get_sub_field('enable_pagination') ) {
			Bw::pagination($latest_query->max_num_pages);
		} ?>
		
	</div>
	
	<?php if ( $has_sidebar ): ?>
	<?php get_sidebar(); ?>
	<?php endif; ?>

<?php endif; ?>