<?php

/*----------------------------------------------------*/
/*	Prints human-readable information about a variable
/*----------------------------------------------------*/
function d($what) {
	print '<pre>';
	print_r($what);
	print '</pre>';
}

/*----------------------------------------------------*/
/*	Define bw variables
/*----------------------------------------------------*/
define('BW_THEME', 'marroco');

define('DS', DIRECTORY_SEPARATOR);
define('BW_FRAME_ROOT', dirname(__FILE__).DS);
define('BW_FRAME_CORE', BW_FRAME_ROOT.'core'.DS);
define('BW_FRAME_ASSETS', BW_FRAME_ROOT.'assets'.DS);
define('BW_FRAME_LIB', BW_FRAME_ROOT.'lib'.DS);
define('BW_FRAME_PLUGINS', BW_FRAME_ROOT.'plugins'.DS);
define('BW_ROOT', dirname(BW_FRAME_ROOT).DS);
define('BW_DEMO', BW_ROOT.'bw'.DS.'demo'.DS);
define('BW_VERSION', '1.4');

define('BW_URI', get_template_directory_uri() . '/');
define('BW_URI_ASSETS', BW_URI.'assets/');
define('BW_URI_FRAME_ASSETS', BW_URI.'bw/assets/');

# require core feature
require 'core/Bw.php';


/*----------------------------------------------------*/
/*	Dynamically load in all classes
/*----------------------------------------------------*/
Bw::require_all(array(BW_FRAME_CORE));

Bw::init();

?>