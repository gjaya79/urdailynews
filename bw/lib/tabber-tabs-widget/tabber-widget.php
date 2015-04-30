<?php
/**
 * Tabber Tabs Widget
 *
 * Create the actual tabbed widget
 *
 * @package Tabber Tabs
 * @subpackage Widget
 */


 // Let's build a widget
class Slipfire_Widget_Tabber extends WP_Widget {

	function Slipfire_Widget_Tabber() {
		$widget_ops = array( 'classname' => 'tabbertabs', 'description' => __('Place items in the TABBER TABS WIDGET AREA and have them show up here.', 'slipfire') );
		$control_ops = array( 'width' => 230, 'height' => 350, 'id_base' => 'slipfire-tabber' );
		$this->WP_Widget( 'slipfire-tabber', __('Tabber Tabs Widget', 'slipfire'), $widget_ops, $control_ops );
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		//$style = $instance['style']; // get the widget style from settings
		
		echo $before_widget;
?>		
		<div class="tabber style1">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('tabber_tabs') ); ?>
		</div>
		
<?php 	echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		//$instance = $old_instance;
		//$instance['style'] = $new_instance['style'];
		
		//return $instance;
	}

	function form( $instance ) {

		//Defaults
		$defaults = array( 'title' => __('Tabber', 'slipfire'), 'style' => 'style1' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:98%;"></div>
		<p>
		<?php _e('Place items in the TABBER TABS WIDGET AREA and have them show up here.', 'slipfire')?>
		</p>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

?>