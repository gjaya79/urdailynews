
<?php if( get_field( 'enable_parallax_header' ) and is_single() ): ?>
	<?php $img_obj = get_field( 'parallax_image' ); ?>
	<div class="header-parallax" style="background:#dcdcdc url('<?php echo $img_obj['url']; ?>') no-repeat center 0;background-attachment:fixed;">
		<div class="row">
			<div class="parallax-title">
				<span class="date bl">
					<?php if( Bw::get_option( 'display_blog_author' ) ): ?>
						<strong><?php the_author_posts_link(); ?></strong>
						<?php echo __('on', BW_THEME); ?>
					<?php endif; ?>
					<?php the_date(); ?>
				</span>
				<h2 class="bb"><?php the_title(); ?></h2>
			</div>
		</div>
	</div>
	
<?php endif; ?>