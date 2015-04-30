<?php

#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------

// Bad Weather
$bw_shortcodes['header_0'] = array( 
	'type'=>'heading', 
	'title'=>__('Columns', BW_THEME)
);

$bw_shortcodes['one_half'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Half (1/2)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);


//Thirds
$bw_shortcodes['one_third'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Third Column (1/3)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);

$bw_shortcodes['two_thirds'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Two Thirds Column (2/3)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);


//Fourths
$bw_shortcodes['one_fourth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Fourth Column (1/4)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);

$bw_shortcodes['three_fourths'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Three Fourths Column (3/4)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);


//Sixths
$bw_shortcodes['one_sixth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Sixth Column (1/6)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);

$bw_shortcodes['five_sixths'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Five Sixths Column (5/6)', BW_THEME ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column',BW_THEME)),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text',BW_THEME)),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column',BW_THEME), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', BW_THEME))
	)
);


#-----------------------------------------------------------------
# Elements 
#-----------------------------------------------------------------

$bw_shortcodes['header_6'] = array( 
	'type'=>'heading', 
	'title'=>__('Elements', BW_THEME )
);

// Page title
$bw_shortcodes['page_title'] = array( 
	'type'=>'regular',
	'title'=>__('Title', BW_THEME ),
	'attr'=>array( 
		'text'=>array('type'=>'text', 'title'=>__('Text for title', BW_THEME)),
	)
);

// Dropcap
$bw_shortcodes['dropcap'] = array( 
	'type'=>'regular',
	'title'=>__('Dropcap', BW_THEME ),
	'attr'=>array( 
		'text'=>array('type'=>'text', 'title'=>__('Content', BW_THEME)),
	)
);

//Bar Graph
$bw_shortcodes['bargraph'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Bar Graph', BW_THEME ), 
	'attr'=>array(
		'bargraph'=>array('type'=>'custom')
	)
);

//Toggle
$bw_shortcodes['toggle'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Toggle', BW_THEME ), 
	'attr'=>array(
		'title'=>array('type'=>'text', 'title'=>__('Title', BW_THEME)),
		'active'=>array('type'=>'custom', 'title'=>__('Active',BW_THEME))
	)
);

//Divider
$bw_shortcodes['divider'] = array( 
	'type'=>'regular', 
	'title'=>__('Divider', BW_THEME ), 
	'attr'=>array( 
		'line'=>array('type'=>'checkbox', 'title'=>__('Show line?', BW_THEME))
	)
);

//Button
$bw_shortcodes['button'] = array( 
	'type'=>'radios', 
	'title'=>__('Button', BW_THEME), 
	'attr'=>array(
		'size'=>array(
			'type'=>'radio', 
			'title'=>__('Size', BW_THEME), 
			'opt'=>array(
				'small'=>'Small',
				'medium'=>'Medium',
				'large'=>'Large'
			)
		),
		'url'=>array(
			'type'=>'text', 
			'title'=>'Link URL'
		),
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Text', BW_THEME)
		),
		'blank'=>array('type'=>'checkbox', 'title'=>__('Open in a new tab?', BW_THEME))
	) 
);

?>