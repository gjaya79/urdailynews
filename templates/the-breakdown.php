<?php if( get_field('enable_post_review') ): ?>
	<?php if (get_field('score_breakdown') && count(get_field('score_breakdown')) > 1 ): ?>
		
		<div class="heading">
			<h3 class="page-title"><?php _e('The Breakdown', BW_THEME); ?></h3>
		</div>
		
		<div class="the-breakdown">
		
		<?php while (has_sub_fields('score_breakdown')): ?>
			
			<div class="review-score">
				
				<div class="score-label bb"><?php echo get_sub_field('label'); ?></div>
				
				<span class="badge bb"><?php echo get_sub_field('score'); ?></span>
				
				<div class="bar">
					
					<div class="progress" style="width: <?php echo get_sub_field('score')*10; ?>%;"></div>
					
				</div>
				
			</div>
			
		<?php endwhile; ?>
		
		</div>
		
	<?php endif; ?>
<?php endif; ?>