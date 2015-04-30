<?php

$post_args = array(
	'numberposts' 	=> 15,
	'offset'		=> 0,
	'post_type'     => 'post',
	'post_status'   => 'publish',
	'category'   	=> get_query_var('cat'),
);

$post_args['meta_query'] = array(
	array(
		'key' => 'bw_category_slider',
		'value' => '1'
	),
	array(
		'key' => '_thumbnail_id',
        'compare' => 'EXISTS'
	)
);

$slideposts = get_posts( $post_args );
$effect = Bw::get_option('category_slider_effect');
$autoplay = Bw::get_option( 'category_slider_autoplay' );

if (count($slideposts)): ?>

<div class="bw-slider-holder">
	<div class="category-slider-loader">
		<div class="category-slider bw-slider <?php echo ( $autoplay ? 'auto-play' : '' ); ?>" data-speed="3000" data-transition="<?php echo ( ! $effect ? 'slide' : $effect ); ?>">
			<?php
			foreach( $slideposts as $post ) : setup_postdata( $post );
			
			$thumb_img = Bw::get_image_src( 'bw_700x450' );
			
			if (!empty($thumb_img)):
			?>
			<article class="item">
				
				<div class="article-thumb">
					<img src="<?php echo $thumb_img; ?>" alt="<?php the_title(); ?>" >
				</div>
				
				<div class="title shadow">
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
				</div>
				
			</article>
			<?php endif; endforeach; ?>
		</div>
	</div>
</div>

<?php
endif;
wp_reset_query();
?>
