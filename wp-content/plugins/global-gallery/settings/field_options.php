<?php 

// get WP pages list - id => title
function gg_get_pages() {
	$pages = array();
	
	foreach(get_pages() as $pag) {
		$pages[ $pag->ID ] = $pag->post_title;	
	}
	
	return $pages;	
}


// galleries pagination systems
function gg_pag_sys() {
	return array(
		'standard' 		=> __('Standard', 'gg_ml'),
		'inf_scroll'	=> __('Infinite scroll', 'gg_ml'),
		'num_btns'	 	=> __('Numbered buttons', 'gg_ml'),
		'dots'	 		=> __('Dots', 'gg_ml'),
	);
}


// pagination layouts
function gg_pag_layouts($type = false) {
	$types = array(
		'standard' 	 	=> __('Commands + full text', 'gg_ml'),
		'only_num'  	=> __('Commands + page numbers', 'gg_ml'),
		'only_arr'		=> __('Only arrows', 'gg_ml'),
		'only_arr_mb'	=> __('Only arrows - monoblock', 'gg_ml'),	
	);
	
	if($type === false) {return $types;}
	else {return $types[$type];}
}


// image-to-gallery layouts
function gg_itg_layouts($layout = false) {
	$layouts = array(
		'corner_txt' 	=> __('Bottom-right corner overlay on last image', 'gg_ml'),
		'100_op_ol'  	=> __('100% opaque - full overlay on last image', 'gg_ml'),
		'50_op_ol'		=> __('50% opaque - full overlay on last image', 'gg_ml'),
		'0_op_ol'		=> __('0% opaque - full overlay on last image', 'gg_ml'),
		'block_over'	=> __('Centered text block over images', 'gg_ml'),	
		'main_n_sides'	=> __('Main image with central overlay + two smaller on sides', 'gg_ml'),	
	);
	
	if($layout === false) {return $layouts;}
	else {return $layouts[$layout];}	
}


// slider cropping methods
function gg_galleria_crop_methods($type = false) {
	$types = array(
		'true' 		=> __('Fit, center and crop', 'gg_ml'),
		'false' 	=> __('Scale down', 'gg_ml'),
		'height'	=> __('Scale to fill the height', 'gg_ml'),
		'width'		=> __('Scale to fill the width', 'gg_ml'),
		'landscape'	=> __('Fit images with landscape proportions', 'gg_ml'),
		'portrait' 	=> __('Fit images with portrait proportions', 'gg_ml')
	);
	
	if($type === false) {return $types;}
	else {return $types[$type];}
}


// slider effects
function gg_galleria_fx($type = false) {
	$types = array(
		'fadeslide' => __('Fade and slide', 'gg_ml'),
		'fade' 		=> __('Fade', 'gg_ml'),
		'flash'		=> __('Flash', 'gg_ml'),
		'pulse'		=> __('Pulse', 'gg_ml'),
		'slide'		=> __('Slide', 'gg_ml'),
		''			=> __('None', 'gg_ml')
	);
	
	if($type === false) {return $types;}
	else {return $types[$type];}
}


// slider thumbs visibility options
function gg_galleria_thumb_opts($type = false) {
	$types = array(
		'always'	=> __('Always', 'gg_ml'),
		'yes' 		=> __('Yes with toggle button', 'gg_ml'),
		'no' 		=> __('No with toggle button', 'gg_ml'),
		'never' 	=> __('Never', 'gg_ml'),
	);
	
	if($type === false) {return $types;}
	else {return $types[$type];}
}


// preloader types
function gg_preloader_types($type = false) {
	$types = array(
		'default' 				=> __('Default loader', 'gg_ml'),
		'rotating_square' 		=> __('Rotating square', 'gg_ml'),
		'overlapping_circles' 	=> __('Overlapping circles', 'gg_ml'),
		'stretch_rect' 			=> __('Stretching rectangles', 'gg_ml'),
		'spin_n_fill_square'	=> __('Spinning & filling square', 'gg_ml'),
		'pulsing_circle' 		=> __('Pulsing circle', 'gg_ml'),
		'spinning_dots'			=> __('Spinning dots', 'gg_ml'),
		'appearing_cubes'		=> __('Appearing cubes', 'gg_ml'),
		'folding_cube'			=> __('Folding cube', 'gg_ml'),
		'old_style_spinner'		=> __('Old-style spinner', 'gg_ml'),
		'minimal_spinner'		=> __('Minimal spinner', 'gg_ml'),
		'spotify_like'			=> __('Spotify-like spinner', 'gg_ml'),
		'vortex'				=> __('Vortex', 'gg_ml'),
		'bubbling_dots'			=> __('Bubbling Dots', 'gg_ml'),
		'overlapping_dots'		=> __('Overlapping dots', 'gg_ml'),
		'fading_circles'		=> __('Fading circles', 'gg_ml'),
	);
	return (!$type) ? $types : $types[$type];
}


// lightboxes list
function gg_lightboxes($type = false) {
	$types = array(
		'lcweb' 	=> 'LC Lightbox',
		'lightcase' => 'Lightcase',
		'simplelb' 	=> 'Simple Lightbox',
		'tosrus' 	=> 'Tos "R"Us',
		'mag_popup' => 'Magnific Popup',
		'imagelb' 	=> 'imageLightbox',
		'photobox' 	=> 'Photobox',
		'fancybox'	=> 'Fancybox (not responsive)',
		'colorbox' 	=> 'Colorbox',
		'prettyphoto' 	=> 'PrettyPhoto (not responsive)',
	);
	return (!$type) ? $types : $types[$type];
}



// lightcase lightbox - transition styles
function gg_lightcase_trans_styles() {
	return array(
		'none'				=> __('No transition', 'gg_ml'), 
		'fade'				=> __('Fade', 'gg_ml'),  
		'elastic'			=> __('Elastic', 'gg_ml'),
		'scrollTop'			=> __('Downwards', 'gg_ml'),
		'scrollRight'		=> __('Leftwards', 'gg_ml'), 
		'scrollBottom'		=> __('Upwards', 'gg_ml'),
		'scrollLeft'		=> __('Rightwards', 'gg_ml'),
		'scrollHorizontal'	=> __('Horizontal scroll', 'gg_ml'),
		'scrollVertical'	=> __('Vertical scroll', 'gg_ml'),
	);
}


// LC Lightbox - openClose effects list
function gg_lcl_openclose_list() {
	return array(
		'lcl_fade_oc' 		=> __('Fade', 'gg_ml'),
		'lcl_zoomin_oc' 	=> __('Zoom-in', 'gg_ml'),
		'lcl_bottop_oc' 	=> __('Bottom to top', 'gg_ml'),
		'lcl_bottop_v2_oc' 	=> __('Bottom to top v2', 'gg_ml'),
		'lcl_rtl_oc' 		=> __('Right to left', 'gg_ml'),
		'lcl_horiz_flip_oc' => __('Horizontal flip', 'gg_ml'),
		'lcl_vert_flip_oc' 	=> __('Vertical flip', 'gg_ml'),
		'' 					=> __('None (customizable through CSS)', 'gg_ml'),
	);
}


// get the LC lightbox patterns list 
function gg_lcl_patterns_list() {
	$patterns = array();
	$patterns_list = scandir(GG_DIR."/js/lightboxes/lc-lightbox/img/patterns");
	
	foreach($patterns_list as $pattern_name) {
		if($pattern_name != '.' && $pattern_name != '..') {
			$patterns[$pattern_name] = substr($pattern_name, 0, -4);
		}
	}
	return $patterns;	
}

