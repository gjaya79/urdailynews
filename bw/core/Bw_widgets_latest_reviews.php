<?php

class Bw_widgets_latest_reviews extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'bw_latest_reviews', // Base ID
			__('BW Latest Reviews', BW_THEME), // Name
			array( 'description' => __( 'Display the latest posts with reviews', BW_THEME ) ) // Args
		);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

		$query_args = array(
			'posts_per_page' => $number,
			'meta_query' => array(
				array(
					'key' => 'enable_post_review',
					'value' => '1',
				)
			)
		);

		$reviews_query = new WP_Query($query_args);

		echo $before_widget;
		
		if ($reviews_query->have_posts()): ?>
			<?php if ($title): ?>
				<h3 class="widget-title">
					<span><?php echo $title; ?></span>
				</h3>
			<?php endif; ?>
			<ol class="reviews">
				<?php while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
					<li class="review">
						<article>
							
							<div class="bar">
								
								<div class="score-label">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								
								<div class="bar">
									<div class="progress" style="width: <?php echo Bw::get_average_score() * 10;  ?>%;"></div>
								</div>
								
								<?php $average_score = Bw::get_average_score(); ?>
								<span class="badge bb"><?php echo $average_score ? $average_score : '&nbsp;' ?></span>
								
							</div>
							
						</article>
					</li>
				<?php endwhile; ?>
			</ol>
		<?php endif;

		// Reset Post Data
		wp_reset_postdata();
		wp_reset_query();
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	function form($instance) {
		
		!empty($instance['title'])  ? $title = esc_attr($instance['title']) : $title = __('Latest Reviews',BW_THEME);
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', BW_THEME); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:',BW_THEME ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<?php
		
	}
}