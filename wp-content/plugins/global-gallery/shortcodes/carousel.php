<?php

/////////////////////////////////////////////////////
// [g-carousel]
function gg_carousel_shortcode( $atts, $content = null ) {
	include_once(GG_DIR . '/functions.php');
	include_once(GG_DIR . '/classes/gg_overlay_manager.php');
	
	extract( shortcode_atts( array(
		'gid' 			=> '',
		'img_max_w'		=> 180,
		'height' 		=> 200,
		'h_type' 		=> 'px',
		'rows'			=> 1,
		'multiscroll' 	=> 0,
		'center' 		=> 0,
		'nocrop'		=> 0,
		'static'		=> 0,
		'random' 		=> 0,
		'watermark' 	=> 0,
		'autoplay' 		=> 'auto',
		'overlay' 		=> 'default',
		'wp_gall_hash' 	=> '', // hidden parameter for WP galleries - images list hash
		
		// old parameter - keep retrocompatibility
		'per_time' 		=> 0,
	), $atts ) );
	
	if(!$gid || empty($img_max_w) || empty($height)) {return '';}
	
	
	// init
	$car = '';
	$thumb_q = get_option('gg_thumb_q', 90);
	$type = get_post_meta($gid, 'gg_type', true);
	
	//// prepare images
	// get them
	$images = gg_frontend_img_prepare($gid, $type, $wp_gall_hash);
	if(!is_array($images) || !count($images)) {return '';}

	// randomize images 
	$randomized_order = ((int)$random) ? gg_random_img_indexes(count($images)) : false;

	// images array to be used (eventually watermarked) 
	$images = gg_frontend_img_split($gid, $images, 'all', $randomized_order, $watermark);	
	if(!is_array($images) || !count($images)) {return '';}
	
	
	// javascript parameters
	$param_arr = array();
	$nav_to_hide = get_option('gg_car_hide_nav_elem', array());
	
	$param_arr[] = (get_option('gg_car_infinite')) 	? 'infinite: true' : 'infinite: false';
	$param_arr[] = ($center)						? 'centerMode: true' : 'centerMode: false';
	$param_arr[] = ((int)$rows > 1)					? 'rows: '.(int)$rows : 'rows: 1';
	$param_arr[] = (is_array($nav_to_hide) && in_array('arrows', $nav_to_hide)) ? 'arrows: false' : 'arrows: true';
	$param_arr[] = (is_array($nav_to_hide) && in_array('dots', $nav_to_hide)) 	? 'dots: false' : 'dots: true';
	
	if($autoplay == 1 || ($autoplay == 'auto' && get_option('gg_car_autoplay'))) {
		$car_autoplay = 'true';
		$param_arr[] = 'autoplaySpeed: '.get_option('gg_car_ss_time', 4000);	
		$param_arr[] = (get_option('gg_car_pause_on_h')) 			? 'pauseOnHover: true' : 'pauseOnHover: false';
		$pause_on_h = (in_array('pauseOnHover: true', $param_arr)) 	? 'gg_car_autoplay gg_car_pause_on_h' : 'gg_car_autoplay';
	}
	else {
		$car_autoplay = 'false';	
		$pause_on_h = '';
	}
	
	// image overlay code 
	$ol_man = new gg_overlay_manager($overlay, false, 'car');
	
	// overlay att value
	$overlay_att = $overlay; 
	if((!$overlay_att || $overlay_att == 'default') && defined('GGOM_DIR') && get_option('gg_car_default_overlay')) {
		$overlay_att = get_option('gg_car_default_overlay');
	}
	
	
	// "has arrows" class
	$has_arrows_class = (is_array($nav_to_hide) && in_array('arrows', $nav_to_hide)) ? '' : 'gg_slick_has_arrows';
	
	// "no-crop images" class
	$nocrop_class = ($nocrop) ? 'gg_car_nocrop' : '';
	
	// "no lightbox" class
	$static_class = ($static) ? 'gg_static_car' : '';
	
	// old sizing system class
	$oss_class = (!empty($per_time)) ? 'gg_car_oss' : '';
	
	
	//// wrap up classes
	$addit_classes = implode(' ', array($has_arrows_class, $nocrop_class, $static_class, $oss_class, $pause_on_h, $ol_man->txt_vis_class, $ol_man->ol_wrap_class));
	
	
	// build
	$car .= '
	<div id="gg_car_'.$gid.'" rel="'.$gid.'" class="gg_carousel_wrap gg_gallery_wrap gg_car_preload gg_car_'.get_option('gg_car_elem_style', 'light').' '. $addit_classes .'" '.$ol_man->img_fx_attr.' data-gg_ol="'. $overlay_att .'">';
      
		foreach($images as $img) {
		  
			// image link codes
			if(isset($img['link']) && trim($img['link']) != '') {
				if($img['link_opt'] == 'page') {$thumb_link = get_permalink($img['link']);}
				else {$thumb_link = $img['link'];}
			  
				$open_tag = '<div data-gg-link="'.$thumb_link.'"';
				$add_class = "gg_linked_img";
				$close_tag = '</div>';
		 	 } else {
			  	$open_tag = '<div';
			  	$add_class = "";
			  	$close_tag = '</div>';
		  	}
		  
		  
			// create thumbnail
		  	$thumb_rs = ($nocrop) ? 3 : 1;
			
			/// retrocompatibility - using "per_time"
			if(!empty($per_time)) {
				$thumb_w = get_option('gg_masonry_basewidth', 960) / (int)$per_time; 
				$thumb_h = ($nocrop) ? $thumb_w : $height;
				
				$thumb =  gg_thumb_src($img['path'], $thumb_w, $thumb_h, $thumb_q, $img['thumb'], $thumb_rs);
			}
		  
			//// new way: fixed max width and calculating height
		  	else {
				$thumb_h = ($h_type == 'px') ? (int)$height : ((int)$img_max_w * ($height / 100));
				$thumb =  gg_thumb_src($img['path'], (int)$img_max_w, $thumb_h, $thumb_q, $img['thumb'], $thumb_rs);
			}
		  
		  
		  // dunno why, but wp gall managed src must be managed // TODO
		  if($wp_gall_hash) {
			$img['url'] = gg_img_id_to_url($img['url']);  
		  }
		  
		  		  
		  // SEO noscript part for full-res image
		  $noscript = '<noscript><img src="'.$img['url'].'" alt="'.gg_sanitize_input($img['title']).'" /></noscript>';
		  
		  // item code
		  $car .= '
		  <section class="gg_car_item_wrap">
		  '.$open_tag.' data-gg-url="'.$img['url'].'" data-gg-title="'.gg_sanitize_input($img['title']).'" class="gg_img gg_car_item '.$add_class.'" data-gg-author="'.gg_sanitize_input($img['author']).'" data-gg-descr="'.gg_sanitize_input($img['descr']).'" rel="'.$gid.'">
			
			<div class="gg_img_inner" style="padding-bottom: '. (int)$height.$h_type .'">';
			  
			  $car .= '
			  <div class="gg_main_img_wrap">
				  <div class="gg_img_wrap_inner">
					  <img src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />
					  '.$noscript.'
				  </div>
			  </div>';	
			  
			  $car .= '
			  <div class="gg_overlays">'. $ol_man->get_img_ol($img['title'], $img['descr'], $img['author'], $img['url']) .'</div>';	
			  
		  $car .= '
		  	</div>' . $close_tag .'
		  </section>';
	  }

	// close wrapper and JS init
	$car .= '
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#gg_car_'.$gid.'").slick({
			'.implode(' , ', $param_arr).',
			lazyLoad: "progressive",
			respondTo: "slider",
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: gg_car_calc_breakpoints("'. $gid .'", '. (int)$img_max_w .', '. (int)$multiscroll .', '. $per_time .')
		});
		gg_carousel_preload('.$gid.', '.$car_autoplay.');
	});
	</script>';

	$car = str_replace(array("\r", "\n", "\t", "\v"), '', $car);
	return $car;
}
add_shortcode('g-carousel', 'gg_carousel_shortcode');
