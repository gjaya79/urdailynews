<?php
	
	$migh_like_cat = array();
	$cats = get_the_category();
	foreach($cats as $cat) {
		$migh_like_cat[] = $cat->slug;
	}
	
	$new_cats = (count($migh_like_cat) > 0) ? implode(",", $migh_like_cat) : '';
	
	$num_posts = (Bw::get_meta('page_layout', get_the_ID()) == 'full') ? 3 : 2;
	
	$q = new WP_Query(
		array(
			'orderby' => 'rand',
			'posts_per_page' => $num_posts,
			'category_name' => implode(",", $migh_like_cat),
			'post__not_in' => array(get_the_ID()),
			'meta_key'    => '_thumbnail_id',
		)
	);
	
	echo '<div class="posts-grid-holder inner related-articles full">';
	echo '<div class="posts-grid bw-over">';
	
	while($q->have_posts()) : $q->the_post();
		
		get_template_part('templates/post-templates/content-grid');
		
	endwhile;

	wp_reset_query();

	echo '</div></div>';
	echo '<hr class="border" style="margin:10px 0 0;">';
	
?>