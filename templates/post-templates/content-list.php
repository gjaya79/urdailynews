<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>

<?php $classes = 'article' . ( ( has_post_thumbnail() ) ? " thumb" : " no-thumb" ); ?>

<article <?php post_class( $classes ); ?>>
	
	<div class="article-header">
		<a href="<?php the_permalink(); ?>">
			<div class="article-thumb">

				<?php
				
				if ( has_post_thumbnail() ):

					$thumbsize = 'bw_350x300';
				
					// grab the desired thumb size from the query params if present
					global $wp_query;

					if (isset($wp_query->query_vars['thumbnail_size'])) {
						$thumbsize = $wp_query->query_vars['thumbnail_size'];
					}
					
					?>
				
					<div class="image-hide">
						<div class="image-wrap">
							
							<?php if( Bw::get_option('enable_lazy_image') ): ?>
								<img class="lazy" data-src="<?php echo Bw::get_image_src( $thumbsize ); ?>" src="<?php echo Bw::empty_img(); ?>" alt="<?php the_title(); ?>" >
							<?php else: ?>
								<img src="<?php echo Bw::get_image_src( $thumbsize ); ?>" alt="<?php the_title(); ?>" >
							<?php endif; ?>
							
						</div>
					</div>
					
					<span class="over"></span>
					
					<?php echo Bw::get_format_icon(); ?>
					
					<?php echo Bw::get_rate(); ?>
					
				<?php endif; ?>
				
			</div>
		</a>
		
	</div>
	
	<div class="article-content">
		
		<div class="article-title">
			<h3 class="bb"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
		
		<div class="cat-tags-list">
		<?php $grid_date = get_the_date(); ?>
		<?php $grid_category = get_the_category_list(', '); ?>
		<?php $grid_separator = ( !empty( $grid_date ) and !empty( $grid_category ) ) ? ' / ' : ''; ?>
		<?php echo "{$grid_date}{$grid_separator}{$grid_category}"; ?>
		</div>
		
		<?php the_excerpt(); ?>
		
	</div>

</article> <!-- .article -->