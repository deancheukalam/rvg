<?php

/////////////////////////////////////////////////////
// [g-itg][/g-itg]

function gg_itg_shortcode($atts, $content = null) {
	include_once(GG_DIR . '/functions.php');

	extract( shortcode_atts( array(
		'gid' 		=> '',
		'width' 	=> '100%',
		'img_h'		=> '75%',
		'layout'	=> '',
		'img_num'	=> 1,
		'font_size'	=> 0,
		'random'	=> 0,
		'watermark' => 0,
	), $atts ) );


	// which layout to use?
	if(empty($layout)) {
		$layout = get_option('gg_itg_layout', 'corner_txt');	
	}
	
	// which text to use?
	if(empty($content)) {
		$content = nl2br(trim(get_option('gg_itg_text', '+ %IMG-NUM% <i class="fa fa-camera"></i>')));	
	}
	
	// be sure to set images to show == 3 if layout is main + sides
	if($layout == 'main_n_sides') {$img_num = 3;}

	// sanitize images number to show
	else {
		if(!in_array((int)$img_num, array(1, 2, 4))) {
			$img_num = 1;	
		}
	}


	// retrieve gallery
	$images		 = gg_gall_data_get($gid);
	$thumb_q	 = get_option('gg_thumb_q', 90);
	$elems_max_w = (int)get_option('gg_masonry_basewidth', 1200);
	
	// check necessary shortcode values
	if(empty($images) || count($images) <= $img_num || empty($layout) || empty($content)) {return '';}
	
	
	
	// get wrapper's width
	if(strpos($width, 'px') !== false) {
		$wrapper_w = (int)str_replace('px', '', $width);	
	} else {
		$wrapper_w = ($elems_max_w * ((int)str_replace('%', '', $width) / 100));	
	}	

	// calculate thumbs width
	if($layout == 'main_n_sides') {$thumb_w = ($wrapper_w * 0.6);}
	else {
		$thumb_w = ($img_num == 1) ? $wrapper_w : floor($wrapper_w / 2);	
	}
	
	// calculate thumbs height
	if(strpos($img_h, 'px') !== false) {
		$thumb_h = (int)str_replace('px', '', $img_h);	
	} else {
		$thumb_h =	($thumb_w * ((int)str_replace('%', '', $img_h) / 100));	
	}
	
	
	
	// prepare images
	if($random) {
		shuffle($images);	
	}
	$images = gg_frontend_img_split($gid, $images, $selection = 'all', $randomized_order = false, $watermark);	
	if(!is_array($images) || count($images) <= $img_num) {return '';}
	
	
	// custom font size
	$cfs = (float)$font_size;
	if($cfs > 3) {$cfs = 3;}
	$cfs_attr = ($cfs) ? 'style="font-size: '. $cfs .'rem;"' : '';
	
	
	// overlay code
	$ol_txt = str_replace(
		array('%GALL-TITLE%', '%IMG-NUM%'),
		array(get_the_title($gid), count($images)), 
		$content
	);
	$ol_code = '<div class="gg_itg_ol" '. $cfs_attr .'><div class="gg_itg_ol_inner">'. $ol_txt .'</div></div>';
	
	
	// mono image or main + sides? add class to avoid margins
	$mono_img_class = ($layout == 'main_n_sides' || $img_num == 1) ? 'gg_itg_monoimage' : '';
	
	
	// hidden overlay class
	$hidden_ol_class = (get_option('gg_itg_ol_on_h')) ? 'gg_itg_hidden_ol' : '';
	
	
	// build
	$uniqid = uniqid();
	$code = '
	<div id="'. $uniqid .'" class="gg_itg_wrap gg_itg_'.$layout.' gid_'. $gid .' '. $mono_img_class .' '. $hidden_ol_class .'" style="max-width: '. $width .';">
		<div class="gg_itg_container">';
	
	
			// main image + side ones
			if($layout == 'main_n_sides') {
				for($a=0; $a<3; $a++) {
					$img = $images[$a]; 
					
					// side images must be shorter
					if($a) {
						$final_img_h = (strpos($img_h, 'px') !== false) ? floor((int)str_replace('px', '', $img_h) * 0.8) .'px' : ((int)str_replace('%', '', $img_h) * 0.8) .'%';	
						$final_thumb_h = ceil($thumb_h * 0.8);	
					} else {
						$final_img_h = $img_h; 
						$final_thumb_h = $thumb_h;
					}
					
					$thumb 		= gg_thumb_src($img['path'], $thumb_w, $final_thumb_h, $thumb_q, $img['thumb']);	
					$noscript 	= '<noscript><img src="'.$img['url'].'" alt="'.gg_sanitize_input($img['title']).'" /></noscript>';
					$overlay 	= (!$a) ? $ol_code : '';
	
					$code .= '
					<div class="gg_img gg_itg_img" data-index="'. $a .'">
						<div class="gg_img_inner" style="padding-bottom: '. $final_img_h .';">
							<div class="gg_main_img_wrap">
								<img src="" data-gg-lazy-src="'. $thumb .'" alt="'. gg_sanitize_input($img['title']) .'" class="gg_photo gg_main_thumb" />
								'. $noscript .'	
							</div>
							'. $overlay .'
						</div>
					</div>';  	
				}
			}
	
	
			// normal "columns" layout
			else {
				
				// overlay code
				if($layout != 'block_over') {
					$block_ol = '';
					$last_img_ol = $ol_code;	
				} else {
					$block_ol = $ol_code;	
					$last_img_ol = '';		
				}
				
				// images code
				for($a=0; $a<$img_num; $a++) {
					$img = $images[$a]; 

					$thumb 		= gg_thumb_src($img['path'], $thumb_w, $thumb_h, $thumb_q, $img['thumb']);	
					$noscript 	= '<noscript><img src="'.$img['url'].'" alt="'.gg_sanitize_input($img['title']).'" /></noscript>';
					$overlay 	= ($a == ($img_num - 1)) ? $last_img_ol : '';
	
					$code .= '
					<div class="gg_img gg_itg_img" data-index="'. $a .'">
						<div class="gg_img_inner" style="padding-bottom: '.$img_h.';">
							<div class="gg_main_img_wrap">
								<img src="" data-gg-lazy-src="'. $thumb .'" alt="'. gg_sanitize_input($img['title']) .'" class="gg_photo gg_main_thumb" />
								'. $noscript .'	
							</div>
							'. $overlay .'
						</div>
					</div>';  	
				}
				
				
				// overlay to be placed over images
				$code .= $block_ol;	
			}
	
		$code .= '
		</div>'; // container's closing
		
		
		
		// javascript object containing images data for lightbox
		$code .= '
		<script type="text/javascript">
		jQuery(document).ready(function() {
			if(typeof(gg_itg_obj) == "undefined") {gg_itg_obj = {};}
			gg_itg_init("'. $uniqid .'");
			
			gg_itg_obj["'. $uniqid .'"] = {';
				
				foreach($images as $img) {
					$code .= '
					"'. trim(addslashes($img['url'])) .'" : {
						
						"img"		: "'. trim(addslashes($img['url'])) .'",
						"title"		: "'. trim(addslashes($img['title'])) .'",
						"descr"		: "'. trim(addslashes($img['descr'])) .'",
						"author"	: "'. trim(addslashes($img['author'])) .'"
					},';	
				}
				
			$code .= '
			};
		});
		</script>';
		
		
	$code .= '	
	</div>'; // wrapper's closing
	
	//$code = str_replace(array("\r", "\n", "\t", "\v"), '', $code);
	return $code;
}
add_shortcode('g-itg', 'gg_itg_shortcode');

