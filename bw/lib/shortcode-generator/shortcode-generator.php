<?php
#-----------------------------------------------------------------
# BW Shortcode Generator
#-----------------------------------------------------------------

//Access Wordpress
require_once( 'access-wp.php' );

//Shortcodes Definitions
require_once( 'shortcode-definitions.php' );

//Option Element Function
require_once( 'option-element.php' );

//Shortcode html
$html_options = null;

$shortcode_html = '

<div id="shortcode-generator">
    
	<div class="shortcode-content">		
		<div class="label"><strong>BW Shortcodes</strong></div>			
		<div class="content"><select id="bw-shortcodes" data-placeholder="' . __("Choose a shortcode", BW_THEME) .'">
	    <option></option>';
		
		foreach( $bw_shortcodes as $shortcode => $options ) {
			
			if(strpos($shortcode,'header') !== false) {
				$shortcode_html .= '<optgroup label="'.$options['title'].'">';
			}
			else {
				$shortcode_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
				$html_options .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'" data-type="'.$options['type'].'">';
				
				if( !empty($options['attr']) ){
					 foreach( $options['attr'] as $name => $attr_option ){
						$html_options .= bw_option_element( $name, $attr_option, $options['type'], $shortcode );
					 }
				}

				$html_options .= '</div>'; 
			}
			
		} 

$shortcode_html .= '</select></div> <div class="hr"></div>'; ?>

<!DOCTYPE html>
<html>
<head>
<title></title>

	<!--style-->
	<link rel="stylesheet" href="<?php echo BW_URI; ?>bw/lib/shortcode-generator/css/tinymce.css" />
	<link rel="stylesheet" href="<?php echo BW_URI; ?>bw/lib/shortcode-generator/css/chosen/chosen.css" />
	<link rel="stylesheet" href="<?php echo BW_URI; ?>bw/lib/shortcode-generator/css/simple_slider/simple-slider.css" />
	<link rel="stylesheet" href="<?php echo BW_URI; ?>bw/lib/shortcode-generator/css/simple_slider/simple-slider-volume.css" />
	<link rel="stylesheet" href="<?php echo BW_URI; ?>bw/assets/fonts/font-awesome/font-awesome.css" />

	<!--scripts-->
	<script src="<?php echo BW_URI; ?>bw/lib/shortcode-generator/js/chosen/chosen.jquery.min.js"></script>
	<script src="<?php echo BW_URI; ?>bw/lib/shortcode-generator/js/simple_slider/simple-slider.min.js"></script>
	<script src="<?php echo BW_URI; ?>bw/lib/shortcode-generator/js/popup.js"></script>

</head>

<body>	
<?php echo $shortcode_html . $html_options;  ?>

	<div id="shortcode-content">
		
		<div class="label"><label id="option-label" for="shortcode-content"><?php echo __( 'Content: ', BW_THEME ); ?> </label></div>
		<div class="content"><textarea id="content"></textarea></div>
	
	    <div class="hr"></div>
	    
	</div>

	<code class="shortcode_storage"><span id="shortcode-storage-o" style=""></span><span id="shortcode-storage-d"></span><span id="shortcode-storage-c" style=""></span></code>
	<a class="btn" id="add-shortcode"><?php echo __( 'Add Shortcode', BW_THEME ); ?></a>
	
</div>

</div>
</body>
</html>