<?php

//set some variables to pass to the content-blog.php loaded below
global $wp_query;
$wp_query->query_vars['thumbnail_size'] = 'bw_350x300';

$number_of_posts = get_sub_field('number_of_posts');

$query_args = array(
	'posts_per_page' => $number_of_posts,
	'ignore_sticky_posts' => true,
);

$posts_source = get_sub_field('posts_source');

switch ( $posts_source ) :

	case 'featured' :
		/** In this case return only posts marked as featured */
		$query_args['meta_query'] = array(
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
		$query_args['order'] = 'DESC';
		$query_args['orderby'] = 'date';
		break;
	
	case 'latest_by_cat' :
		/** Return posts from selected categories */
		$categories = get_sub_field('posts_source_category');
		$catarr = array();
		if(!empty($categories)) {
			foreach ($categories as $key => $value) {
				$catarr[] = (int) $value;
			}
		}
		
		$query_args['category__in'] = $catarr;
		break;
		
	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		if (!isset($query_args['tax_query'])) {
			$query_args['tax_query'] = array();
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
					
					$query_args['tax_query']['relation'] = 'AND';
					$query_args['tax_query'][] = array(
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
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}
		break;

	case 'latest_by_reviews':
		$query_args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'enable_post_review',
				'value' => '1',
				'compare' => '='
			)
		);
		break;
	default : ;
endswitch;

$posts = new WP_Query( $query_args );


if ($posts->have_posts()): ?>
	
	<?php get_template_part('templates/post-templates/content-papa'); ?>
	
<?php endif;


