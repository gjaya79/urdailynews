<?php

$c = 0;

$content_left = '';
$content_right = '';

while($posts->have_posts()): $posts->the_post();

if($c == 0) {
	
	ob_start();
	?>
	<a href="<?php the_permalink(); ?>">
		<div class="article-thumb">
			
			<div class="image-hide">
				<div class="image-wrap">
					
					<?php if( Bw::get_option('enable_lazy_image') ): ?>
						<img class="lazy" data-src="<?php echo ( has_post_thumbnail() ) ? Bw::get_image_src( 'bw_700x450' ) : Bw::empty_img( '700x450' ); ?>" src="<?php echo Bw::empty_img(); ?>" alt="" >
					<?php else: ?>
						<img src="<?php echo Bw::get_image_src( 'bw_700x450' ); ?>" alt="" >
					<?php endif; ?>
					
				</div>
			</div>
			<span class="over"></span>
			<?php echo Bw::get_format_icon(); ?>
			<?php echo Bw::get_rate(); ?>
			
		</div>
	</a>
	<div class="article-header">
		<h3 class="bb"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="article-date">
			<?php $grid_date = get_the_date(); ?>
			<?php $grid_category = get_the_category_list(', '); ?>
			<?php $grid_separator = ( !empty( $grid_date ) and !empty( $grid_category ) ) ? ' / ' : ''; ?>
			<?php echo "{$grid_date}{$grid_separator}{$grid_category}"; ?>
		</div>
		<?php the_excerpt(); ?>
	</div>
	<?php
	$content_left = ob_get_contents();
	ob_end_clean();
	
}else{
	
	ob_start();
	?>
	<article class="article <?php if( ! has_post_thumbnail() ) { echo 'no-thumb'; } ?>">
		<a href="<?php the_permalink(); ?>">
			<?php if( has_post_thumbnail() ): ?>
			<div class="article-thumb">
				<div class="image-hide">
					<div class="image-wrap">
						
						<?php if( Bw::get_option('enable_lazy_image') ): ?>
							<img class="lazy" data-src="<?php echo Bw::get_image_src( 'thumbnail' ); ?>" src="<?php echo Bw::empty_img(); ?>" alt="" >
						<?php else: ?>
							<img src="<?php echo Bw::get_image_src( 'thumbnail' ); ?>" alt="" >
						<?php endif; ?>
						
					</div>
				</div>
				<span class="over"></span>
			</div>
			<?php endif; ?>
		</a>
		<div class="article-content">
			<div class="article-title">
				<h3 class="bb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			</div>
			<div class="article-date">
				<?php $grid_date = get_the_date(); ?>
				<?php $grid_category = get_the_category_list(', '); ?>
				<?php $grid_separator = ( !empty( $grid_date ) and !empty( $grid_category ) ) ? ' / ' : ''; ?>
				<?php echo "{$grid_date}{$grid_separator}{$grid_category}"; ?>
			</div>
			<?php echo Bw::truncate( get_the_excerpt(), 10 ); ?>
		</div>
	</article>
	<?php
	$content_right .= ob_get_contents();
	ob_end_clean();
	
}

$c++;
	
endwhile;
wp_reset_postdata();

?>

<div class="papa-grid bw-over">
	
	<article class="part left-part">
		
		<?php echo $content_left; ?>
		
	</article>

	<div class="part right-part">
		
		<?php echo $content_right; ?>
		
	</div>

</div>

