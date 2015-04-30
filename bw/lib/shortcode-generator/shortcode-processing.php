<?php

#-----------------------------------------------------------------#
# General
#-----------------------------------------------------------------# 

// page title
function bw_page_title( $atts ) {
	
	extract(shortcode_atts(array(
		'text' => '',
		'center' => 'false'
	), $atts));
	
	return "<div class='heading'><h1 class='page-title'>{$text}</h1></div>";
}
add_shortcode( 'page_title', 'bw_page_title' );

// dropcap
function bw_dropcap( $atts ) {
	
	extract(shortcode_atts(array(
		'text' => ''
	), $atts));
	
	return "<span class='dropcap'>{$text}</span>";
}
add_shortcode( 'dropcap', 'bw_dropcap' );

//bar garph
function bw_bargraph($atts, $content = null) {  
    return '<ul class="bargraph">'.  do_shortcode($content) .'</ul>';
}
add_shortcode('bargraph', 'bw_bargraph');


// bar
function bw_bar($atts, $content = null) {
	extract(shortcode_atts(array("title" => 'Title', "percent" => '1', 'id' => ''), $atts));  
	$bar = '
	<li>
		<p>' . $title . '</p>
		<div class="bar-wrap"><span data-width="' . $percent . '"> <strong>' . $percent . '<em>%</em></strong> </span></div>
	</li>';
    return $bar;
}
add_shortcode('bar', 'bw_bar');

//toggle
function bw_toggle($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'active' => 'false'
	), $atts));
	
	$class = '';
	$inline = '';
	
	if($active == 'true') {
		$class .= 'active';
		$inline .= "style='display:block'";
	}
	
    return "<div class='toggle {$class}'><span class='toggle-title'>{$title}</span><div class='toggle-content' {$inline}>" . do_shortcode($content) . "</div></div>";
}
add_shortcode('toggle', 'bw_toggle');



#-----------------------------------------------------------------#
# Columns
#-----------------------------------------------------------------# 

//half columns
function bw_one_half( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_6' . $column_classes . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'bw_one_half');

function bw_one_half_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_6 col_last' . $column_classes . '">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'bw_one_half_last');



//one third columns
function bw_one_third( $atts, $content = null ) {
	extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_4' . $column_classes . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'bw_one_third');

function bw_one_third_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_4 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'bw_one_third_last');

function bw_two_thirds( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_8' . $column_classes . '">'. do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'bw_two_thirds');

function bw_two_thirds_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_8 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'bw_two_thirds_last');


//one fourth columns
function bw_one_fourth( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_3' . $column_classes . '">'. do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'bw_one_fourth');

function bw_one_fourth_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_3 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'bw_one_fourth_last');

function bw_three_fourths( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_9' . $column_classes . '">'. do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'bw_three_fourths');

function bw_three_fourths_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_9 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'bw_three_fourths_last');


//one sixth columns
function bw_one_sixth( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_2' . $column_classes . '">'. do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'bw_one_sixth');

function bw_one_sixth_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_2 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'bw_one_sixth_last');

function bw_five_sixths( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_10' . $column_classes . '">'. do_shortcode($content) . '</div>';
}
add_shortcode('five_sixths', 'bw_five_sixths');

function bw_five_sixths_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false'), $atts));
	$column_classes = null;
	if($boxed == 'true')  { $column_classes .= ' boxed'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
    return '<div class="col span_10 col_last' . $column_classes . '">'. do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixths_last', 'bw_five_sixths_last');


#-----------------------------------------------------------------#
# Elements
#-----------------------------------------------------------------# 

//heading
function bw_heading($atts, $content = null) { 
    extract(shortcode_atts(array("title" => 'Title', "subtitle" => 'Subtitle'), $atts));
	$subtitle_holder = null;
	
	if($subtitle != 'Subtitle') $subtitle_holder = '<p>'.$subtitle.'</p>';
    return'
    <div class="col span_12 section-title text-align-center extra-padding">
		<h2>'.$content.'</h2>'. $subtitle_holder .'</div><div class="clear"></div>';
}
add_shortcode('heading', 'bw_heading');

//divider
function bw_divider($atts, $content = null) {  
    extract(shortcode_atts(array("line" => 'false'), $atts));
	($line == 'true') ? $divider = '<div class="divider-border"></div>' :  $divider = '<div class="divider"></div>';
    return $divider;
}
add_shortcode('divider', 'bw_divider');


//button
function bw_button($atts, $content = null) {  
    extract(shortcode_atts(array("size" => 'small', "url" => '#', "text" => 'Button Text', 'blank' => 'false'), $atts));
	switch ($size) {
		case 'small' :
			$button_open_tag = '<a class="bw-button small"';
			break;
		case 'medium' :
			$button_open_tag = '<a class="bw-button medium"';
			break;
		case 'large' :
			$button_open_tag = '<a class="bw-button large"';
			break;	
	}
	$target = ($blank == 'false') ? "" : "target='_blank'";
    return $button_open_tag . ' href="' . $url . '" ' . $target . '>' . $text . '</a>';
}
add_shortcode('button', 'bw_button');


?>