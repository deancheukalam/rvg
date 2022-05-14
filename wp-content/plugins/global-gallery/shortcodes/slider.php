<?php

/////////////////////////////////////////////////////
// [g-slider]
function gg_slider_shortcode( $atts, $content = null ) {
	require_once(GG_DIR . '/functions.php');
	global $wp_version;
	
	extract( shortcode_atts( array(
		'gid' => '',
		'width' => '100%',
		'height' => '55%', 
		'random' => 0,
		'watermark' => 0,
		'autoplay' => 'auto',
		'wp_gall_hash' => '' // hidden parameter for WP galleries - images list hash
	), $atts ) );

	if($gid == '') {return '';}
	
	// width and height sanitization (for cornerstone)
	if(strpos($width, '%') === false && strpos($width, 'px') === false) {$width .= '%';}
	if(strpos($height, '%') === false && strpos($height, 'px') === false) {$height .= '%';}
	
	// init
	$slider = '';
	
	$thumb_q = get_option('gg_thumb_q', 90);
	$type = (!empty($wp_gall_hash)) ? 'wp_gall' : get_post_meta($gid, 'gg_type', true);
	$timestamp = current_time('timestamp');
	$unique_id = uniqid();
	$style = get_option('gg_slider_style', 'light');
	$thumbs = get_option('gg_slider_thumbs', 'yes');
	
	// slider thumbs visibility
	$thumbs_class = ($thumbs == 'yes' || $thumbs == 'always') ? 'gg_galleria_slider_show_thumbs' : '';	

	// no border class
	$borders_class = (get_option('gg_slider_no_border')) ? 'gg_slider_no_borders' : '';

	// slider proportions parameter
	if(strpos($height, '%') !== false) {
		$val = (int)str_replace("%", "", $height) / 100;
		$proportions_param = 'data-asp-ratio="'.$val.'"';
		$proportions_class = "gg_galleria_responsive";
		$slider_h = '';
	} else {
		$proportions_param = '';	
		$proportions_class = "";
		$slider_h = 'height: '.$height.';';
	}

	//// prepare images
	// get them
	$images = gg_frontend_img_prepare($gid, $type, $wp_gall_hash);
	if(!is_array($images) || !count($images)) {return '';}

	// randomize images 
	$randomized_order = ((int)$random) ? gg_random_img_indexes(count($images)) : false;

	// images array to be used (eventually watermarked) 
	$images = gg_frontend_img_split($gid, $images, 'all', $randomized_order, $watermark);	
	if(!is_array($images) || !count($images)) {return '';}
	
	// build
	$slider .= '<div id="'.$unique_id.'" rel="'.$gid.'" data-gg-autoplay="'.$autoplay.'" 
		class="gg_galleria_slider_wrap gg_galleria_slider_'.$style.' '.$thumbs_class.' '.$borders_class.' '.$proportions_class.' ggs_'.$gid.'" 
		style="width: '.$width.'; '.$slider_h.'" '.$proportions_param.'
	>';
	  
	  foreach($images as $img) {
		
		// if show author but not the title
		if(trim($img['author']) != '' && trim($img['title']) == '') {
			//$img['title'] = gg_sanitize_input('<span>by '.strip_tags($img['author'])).'</span>';	
		}

		// dunno why, but wp gall managed src must be managed // TODO
		if($wp_gall_hash) {
		  $img['url'] = gg_img_id_to_url($img['url']);  
		}
		

		$thumb = gg_thumb_src($img['path'], (int)get_option('gg_slider_thumb_w', 60), (int)get_option('gg_slider_thumb_h', 40), $thumb_q, $img['thumb']);
		$slider .= '
		<a href="'.$img['url'].'">
			<img src="'.gg_sanitize_input($thumb).'" data-big="'.gg_sanitize_input($img['url']).'" data-description="'.gg_sanitize_input($img['descr']).'" alt="'.gg_sanitize_input($img['title']).'" />
		</a>';
	}

	$slider .= '<div style="clear: both;"></div>
	</div>'; // slider wrap closing
	
	// slider init
	$slider .= '<script type="text/javascript"> 
	jQuery(document).ready(function($) { 
		if(typeof(gg_galleria_init) == "function") { 
			gg_galleria_show("#'.$unique_id.'");
			gg_galleria_init("#'.$unique_id.'");
		}
	});
	</script>';

	$slider = str_replace(array("\r", "\n", "\t", "\v"), '', $slider);
	return $slider;
}
add_shortcode('g-slider', 'gg_slider_shortcode');

