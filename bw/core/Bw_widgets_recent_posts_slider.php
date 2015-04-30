<?php


class Bw_widgets_recent_posts_slider extends WP_Widget {
 
	function __construct() {
		parent::__construct(
			'bw_slider_widget', // Base ID
			__('BW Recent Posts Slider', BW_THEME), // Name
			array( 'description' => __( 'BW slider widget', BW_THEME ), ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		
		if ( !empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$category = $instance['category'];
		$unserialized_categories = unserialize($category);
		$cat_string = is_array($unserialized_categories) ? join(',', $unserialized_categories) : '';
		$max_posts = (int)$instance['max_posts'];
		$autoheight = (int)$instance['autoheight'];
		$autoplay = (int)$instance['autoplay'];
		
		// the query
		$q = new WP_Query(
			array(
				'orderby' => 'date',
				'posts_per_page' => ($max_posts > 0 && $max_posts <= 10) ? $max_posts : 5,
				'category__in' => $unserialized_categories,
				'meta_key'    => '_thumbnail_id',
			)
		);
		
		$list  = '<div class="bw-widget-slider-holder">';
		$list .= '<ul class="bw-widget-slider ' . ( $autoplay ? 'auto-play' : '' ) . '" ' . ( $autoplay ? 'data-speed="3000"' : '' ) . '>';
		
		while($q->have_posts()) : $q->the_post();
			
			$size = $autoheight ? 'bw_350' : 'bw_350x300';
			
			if( Bw::get_option('enable_lazy_image') ) {
				$thumbnail = '<img class="lazy" data-src="' . Bw::get_image_src( $size ) . '" src="' . Bw::empty_img( '350x300' ) . '" alt="">';
			}else{
				$thumbnail = '<img src="' . Bw::get_image_src( $size ) . '" alt="">';
			}
			
			$list .= "<li>
				<a class='image' href='" . get_permalink() . "'>
					{$thumbnail}
				</a>
				<div class='box'>
					<h4 class='bb'><a href='" . get_permalink() . "' title='" . get_the_title() . "'>" . get_the_title() . "</a></h4>
				</div>
			</li>";

		endwhile;

		wp_reset_query();
		
		$list .= "</ul>";
		$list .= "</div>";
		
		echo $list;
		
		echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$max_posts = isset( $instance[ 'max_posts' ] ) ? $instance[ 'max_posts' ] : '';
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$autoheight = isset( $instance[ 'autoheight' ] ) ? $instance[ 'autoheight' ] : '';
		$autoplay = isset( $instance[ 'autoplay' ] ) ? $instance[ 'autoplay' ] : '';
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'max_posts' ); ?>"><?php _e( 'Number of posts (between 1 and 10):' ); ?></label> 
		<input class="widefat" name="<?php echo $this->get_field_name( 'max_posts' ); ?>" type="text" value="<?php echo esc_attr( $max_posts ); ?>">
		</p>
		
		<!--input class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>"-->
		
		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category (leave empty for all categories):' ); ?></label> 
		<?php $unserilized_category = is_array(unserialize( $category )) ? unserialize( $category ) : array(); ?>
		<?php $categories = get_categories(  ); ?>
		<select name="<?php echo $this->get_field_name('category'); ?>[]" multiple="multiple" style="width:100%;" >
			<?php foreach($categories as $key => $category): ?>
				<option value="<?php echo $category->cat_ID; ?>" <?php if( in_array($category->cat_ID, $unserilized_category) ) { echo 'selected="selected"'; } ?>><?php echo $category->name; ?></option>
			<?php endforeach; ?>
		</select>
		</p>
		
		<p>
		<input class="widefat" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" type="checkbox" value="1" <?php if(esc_attr($autoplay) == 1) {echo 'checked="checked"';}?>>
		<span>Autoplay</span>
		</p>
		
		<p>
		<input class="widefat" name="<?php echo $this->get_field_name( 'autoheight' ); ?>" type="checkbox" value="1" <?php if(esc_attr($autoheight) == 1) {echo 'checked="checked"';}?>>
		<span>Autoheight: By checking this option, your images will appear with the original size.</span>
		</p>
		
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['max_posts'] = ( ! empty( $new_instance['max_posts'] ) ) ? strip_tags( $new_instance['max_posts'] ) : '';
		$instance['category'] = serialize($new_instance['category']);
		$instance['autoheight'] = ( ! empty( $new_instance['autoheight'] ) ) ? strip_tags( $new_instance['autoheight'] ) : '';
		$instance['autoplay'] = ( ! empty( $new_instance['autoplay'] ) ) ? strip_tags( $new_instance['autoplay'] ) : '';

		return $instance;
	}
}

?>