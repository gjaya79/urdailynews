<?php

$number_of_posts = get_sub_field('number_of_posts');
//$read_more_label = get_sub_field('read_more_label');

$post_args = array(
	'numberposts' 	=> 3,
	'offset'		=> 0,
	'post_type'     => 'post',
	'post_status'   => 'publish',
	'ignore_sticky_posts' => true,
);

$posts_source = get_sub_field('posts_source');

switch ( $posts_source ) :

	case 'featured' :
		/** In this case return only posts marked as featured */
		$post_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'bw_featured_post',
				'value' => '1',
				'compare' => '='
			)
		);
		break;
	
	case 'latest' :
		/** Return the latest posts only */
		$post_args['order'] = 'DESC';
		$post_args['orderby'] = 'date';
		break;
	
	case 'latest_by_cat' :
		/** Return posts from selected categories */
		$categories = get_sub_field('posts_source_category');
		$catarr = array();
		if(!is_array($categories)) { $post_args['category__in'] = ''; break;}
		foreach ($categories as $key => $value) {
			$catarr[] = (int) $value;
		}
		$post_args['category__in'] = $catarr;
		break;
		
	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		if (!isset($post_args['tax_query'])) {
			$post_args['tax_query'] = array();
		}
		foreach ( $formats as $key => &$format) {
			if ($format == 'standard') {
				//if we need to include the standard post formats
				//then we need to include the posts that don't have a post format set
				$all_post_formats = get_theme_support('post-formats');
				if (!empty($all_post_formats[0]) && count($all_post_formats[0])) {
					$allterms = array();
					foreach ($all_post_formats[0] as $format2) {
						$allterms[] = 'post-format-'.$format2;
					}
					
					$post_args['tax_query']['relation'] = 'AND';
					$post_args['tax_query'][] = array(
						'taxonomy' => 'post_format',
						'terms' => $allterms,
						'field' => 'slug',
						'operator' => 'NOT IN'
					);
				}
			} else {
				$terms[] = 'post-format-' . $format;
			}
		}
		
		if ( !empty($terms) ) {
			$post_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}
		break;

	case 'latest_by_reviews':
		$post_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'enable_post_review',
				'value' => '1',
				'compare' => '='
			)
		);
		break;
		
endswitch;

$post_args['meta_query'][] = array(
	'key' => '_thumbnail_id',
	'compare' => 'EXISTS'
);

$slideposts = get_posts( $post_args );

if ( count( $slideposts ) ): ?>

<div class="billboard-posts bw-over">
	<?php
	
	$c = 1;
	
	foreach( $slideposts as $post ) : setup_postdata( $post );
	
	$thumb_img = Bw::get_image_src( ($c == 1) ? 'bw_620x412' : 'bw_475x293' );
	
	if (!empty($thumb_img)):
	?>
	<article class="item <?php echo ($c == 1) ? 'item-main' : 'item-sub' ?>">
		
		<a href="<?php the_permalink(); ?>">
			
			<div class="article-thumb">
				
				<div class="image-hide">
					<div class="image-wrap">
						<img src="<?php echo $thumb_img; ?>" alt="<?php the_title(); ?>" >
					</div>
				</div>
				
				<span class="over"></span>
				
				<div class="article-content">
					<div class="article-shadow">
						<span class="article-date bl"><?php echo get_the_date() . ' / ' . Bw::first_cat(); ?></span>
						<h3 class="article-title bb"><?php the_title(); ?></h3>
					</div>
				</div>
				
			</div>
			
			
			
		</a>
		
	</article>
	<?php endif; $c++; endforeach; ?>
</div>

<?php
endif;
wp_reset_query();
?>