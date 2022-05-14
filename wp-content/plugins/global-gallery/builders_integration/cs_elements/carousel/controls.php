<?php

/**
 * Element Controls
 */


// image rows
$img_rows = array();
for($a=1; $a<=10; $a++) {
	$img_rows[] = array('value' => $a, 'label' => $a);	 
} 
 
 

/* FIELDS */
$fields =  array(
	'gid' => array(
		'type'    => 'select',
		'ui' => array(
			'title'   => __('Gallery', 'gg_ml'),
			'tooltip' => '',
		),
		'options' => array(
			'choices' => $GLOBALS['gg_galls_arr']
		),
	),
	
	'img_max_w' => array(
		'type'    => 'number',
		'ui' => array(
			'title'   => __('Images max width', 'mg_ml'),
			'tooltip' => ''
		),
	),
	
	'height' => array(
		'type'    => 'number',
		'ui' => array(
			'title'   => __('Images Height (in pixels)', 'mg_ml'),
			'tooltip' => __("Carousel images height in pixels", 'mg_ml')
		),
	),
	
	'h_type' => array(
		'type'    => 'select',
		'ui' => array(
			'title'   => __('Height type', 'gg_ml'),
			'tooltip' => '',
		),
		'options' => array(
			'choices' => array(
				array('value' => 'px', 'label' => 'px'),
				array('value' => '%', 'label' => '%'),
			)
		),
	),
	
	'rows' => array(
		'type'    => 'select',
		'ui' => array(
			'title'   => __('Rows', 'gg_ml'),
			'tooltip' => __("Choose how many image rows to use", 'mg_ml'),
		),
		'options' => array(
			'choices' => $img_rows
		),
	),
	
	'multiscroll' => array(
		'type'    => 'toggle',
		'ui' => array(
			'title'   => __('Multiple Scroll?', 'gg_ml'),
			'tooltip' => __('Slides multiple images per time', 'gg_ml'),
		),
	),
	
	'center' => array(
		'type'    => 'toggle',
		'ui' => array(
			'title'   => __('Center mode?', 'gg_ml'),
			'tooltip' => __('Enables center display mode', 'gg_ml')
		),
	),
	
	'nocrop' => array(
		'type'    => 'toggle',
		'ui' => array(
			'title'   => __('Avoid images crop?', 'gg_ml'),
			'tooltip' => __('Just downscales images', 'gg_ml')
		),
	),
	
	'random' => array(
		'type'    => 'toggle',
		'ui' => array(
			'title'   => __('Random display?', 'gg_ml'),
			'tooltip' => __('Display images randomly', 'gg_ml'),
		),
	),
	
	'watermark' => array(
		'type'    => 'toggle',
		'ui' => array(
			'title'   => __('Use Watermark?', 'gg_ml'),
			'tooltip' => __('Apply watermark to images (if available)', 'gg_ml'),
		),
	),

	'autoplay' => array(
		'type'    => 'select',
		'ui' => array(
			'title'   => __('Autoplay', 'gg_ml'),
			'tooltip' => '',
		),
		'options' => array(
			'choices' => array(
				array('value' => 'auto',	'label' => __('(as default)', 'gg_ml')),
				array('value' => 1, 		'label' => __('Yes', 'gg_ml')),
				array('value' => 0,			'label' => __('No', 'gg_ml')),
			)
		),
	),
);



///// OVERLAY MANAGER ADD-ON ///////////
if(isset($GLOBALS['ggom_cs_field'])) {
	$fields['overlay'] = $GLOBALS['ggom_cs_field'];
}
////////////////////////////////////////


return $fields;
