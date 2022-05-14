<?php

/////////////////////////////////////////////////////
// [g-gallery]
function gg_gallery_shortcode( $atts, $content = null ) {
	include_once(GG_DIR . '/functions.php');
	include_once(GG_DIR . '/classes/gg_overlay_manager.php');
	
	extract( shortcode_atts( array(
		'gid' 			=> '',
		'random' 		=> 0,
		'watermark' 	=> 0,
		'filters'		=> 0,
		'pagination' 	=> '',
		'overlay' 		=> 'default',
		'wp_gall_hash' 	=> '' // hidden parameter for WP galleries - images list hash
	), $atts ) );

	if($gid == '') {return '';}
	
	// init
	$gallery 	= '';
	$type 		= (!empty($wp_gall_hash)) ? 'wp_gall' : get_post_meta($gid, 'gg_type', true);
	
	$thumb_q 	= get_option('gg_thumb_q', 90);
	$timestamp 	= current_time('timestamp');
	$unique_id 	= uniqid();
	
	$raw_layout = get_post_meta($gid, 'gg_layout', true);
	$layout 	= gg_check_default_val($gid, 'gg_layout');
	
	// layout options
	if($layout == 'standard') {
		$thumb_w = (int)gg_check_default_val($gid, 'gg_thumb_w', 150, $raw_layout);
		$thumb_h = (int)gg_check_default_val($gid, 'gg_thumb_h', 150, $raw_layout);
	}
	elseif($layout == 'columnized') {
		$thumb_w = (int)gg_check_default_val($gid, 'gg_colnzd_thumb_max_w', 260, $raw_layout);

		$thumb_h_val  = (int)gg_check_default_val($gid, 'gg_colnzd_thumb_h', 120, $raw_layout);
		$thumb_h_type = gg_check_default_val($gid, 'gg_colnzd_thumb_h_type', 'px', $raw_layout);
		$thumb_h = ($thumb_h_type == 'px') ? $thumb_h_val : ($thumb_w * ($thumb_h_val / 100));
	}
	elseif($layout == 'masonry') { 
		$cols = (int)gg_check_default_val($gid, 'gg_masonry_cols', 4, $raw_layout); 
		$default_w = (int)get_option('gg_masonry_basewidth', 960);
		
		$min_w = get_option('gg_masonry_min_width', 150);
		$col_w = floor( $default_w / $cols );
		if($col_w < $min_w) {$col_w = $min_w;}
	}
	else { 
		$row_h = gg_check_default_val($gid, 'gg_photostring_h', 180, $raw_layout); 
	}
	
	
	//// prepare images
	// get them
	$images = gg_frontend_img_prepare($gid, $type, $wp_gall_hash);
	if(!is_array($images) || !count($images)) {return '';}
	$gall_img_count = count($images);
	
	
	// gallery tags
	if(!empty($filters)) {
		$tags = gg_get_gallery_tags($images);	
		$gallery .= gg_gallery_tags_code($unique_id, $gid, $tags);
	}
	
	
	// paginate?
	$raw_paginate 	= get_post_meta($gid, 'gg_paginate', true);
	$paginate 		= gg_check_default_val($gid, 'gg_paginate');
	$per_page 		= (int)gg_check_default_val($gid, 'gg_per_page', 15, $raw_paginate);

	// randomize images 
	$randomized_order = ((int)$random) ? gg_random_img_indexes(count($images)) : false;

	// images array to be used (eventually watermarked)
	$selection = (!$paginate) ? 'all' : array(0, $per_page);  
	$images = gg_frontend_img_split($gid, $images, $selection, $randomized_order, $watermark);	
	if(!is_array($images) || !count($images)) {return '';}

	// pagination limit
	if($paginate && $gall_img_count > $per_page) {
		$tot_pages = ceil($gall_img_count / $per_page );	
	}
		
	// additional parameters
	switch($layout) {
		case 'columnized' :
			$add_param = 'data-col-maxw="'.$thumb_w.'"';
			break;
		
		case 'masonry' :
			$add_param = 'data-col-num="'.$cols.'"';
			
			if((int)get_post_meta($gid, 'gg_masonry_min_width', true)) {
				$add_param .= ' data-minw="'. (int)get_post_meta($gid, 'gg_masonry_min_width', true) .'"';	
			}
			break;
			
		case 'string' :
			$add_param = 'data-row-h="'.$row_h.'"';
			
			if((int)get_post_meta($gid, 'gg_photostring_min_width', true)) {
				$add_param .= ' data-minw="'. (int)get_post_meta($gid, 'gg_photostring_min_width', true) .'"';	
			}
			break;	
		
		default :
			$add_param = '';
			break;
	}
	
	
	// image overlay code 
	$ol_man = new gg_overlay_manager($overlay, false, 'gall');
	
	// overlay att value
	$overlay_att = $overlay; 
	if((!$overlay_att || $overlay_att == 'default') && defined('GGOM_DIR') && get_option('gg_gall_default_overlay')) {
		$overlay_att = get_option('gg_gall_default_overlay');
	}
	

	// build
	$gallery .= '
	<div id="'.$unique_id.'" class="gg_gallery_wrap gg_'.$layout.'_gallery gid_'.$gid.' '.$ol_man->ol_wrap_class.' '.$ol_man->txt_vis_class.'" data-gg_ol="'.$overlay_att.'" '.$add_param.' '.$ol_man->img_fx_attr.' rel="'.$gid.'" data-nores-txt="'. esc_attr(__('No images found in this page', 'gg_ml')) .'">
      '.gg_preloader().'
	  <div class="gg_container">';	
	    
	  foreach($images as $img_index => $img) {
		  
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
		
		
		// dunno why, but wp gall managed src must be managed // TODO
		if($wp_gall_hash) {
		  $img['url'] = gg_img_id_to_url($img['url']);  
		}
		
		
		// SEO noscript part for full-res image
		$noscript = '<noscript><img src="'.$img['url'].'" alt="'.gg_sanitize_input($img['title']).'" /></noscript>';
		
		// common attributes + classes
		$atts = 'class="gg_img '.$add_class.'" data-gg-url="'.$img['url'].'" data-gg-title="'.gg_sanitize_input($img['title']).'" data-gg-author="'.gg_sanitize_input($img['author']).'" data-gg-descr="'.gg_sanitize_input($img['descr']).'" data-img-id="'.$img_index.'" rel="'.$gid.'"';
		
		
		
		/////////////////////////
		// standard layout
		if($layout == 'standard') {	 
			
			$thumb = gg_thumb_src($img['path'], $thumb_w, $thumb_h, $thumb_q, $img['thumb']);
			$gallery .= '
			'. $open_tag .' '. $atts .'>
			  <div class="gg_img_inner">';
				
				$gallery .= '
				<div class="gg_main_img_wrap">
					<img src="" data-gg-lazy-src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />
					'.$noscript.'
				</div>';	
				
				$gallery .= '
				<div class="gg_overlays">'. $ol_man->get_img_ol($img['title'], $img['descr'], $img['author'], $img['url']) .'</div>';	
				
			$gallery .= '</div>' . $close_tag;
		}
		
		
		/////////////////////////
		// columnized layout
		else if($layout == 'columnized') {
			
			$thumb = gg_thumb_src($img['path'], $thumb_w, $thumb_h, $thumb_q, $img['thumb']);	
			$gallery .= '
			'. $open_tag .' '. $atts .'>
			  <div class="gg_img_inner" style="padding-bottom: '.$thumb_h_val.$thumb_h_type.'">
				<div class="gg_main_img_wrap">
					<div class="gg_img_wrap_inner">
						<img src="" data-gg-lazy-src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />
						'.$noscript.'	
					</div>
				</div>
				<div class="gg_overlays">'. $ol_man->get_img_ol($img['title'], $img['descr'], $img['author'], $img['url']) .'</div>	
			</div>'.$close_tag;  
		}
		
		
		/////////////////////////
		// masonry layout
		else if($layout == 'masonry') {
			
			$thumb = gg_thumb_src($img['path'], ($col_w + 40), false, $thumb_q, $img['thumb']);	
			$gallery .= '
			'. $open_tag .' '. $atts .'>
			  <div class="gg_img_inner">
				<div class="gg_main_img_wrap">
					<div class="gg_img_wrap_inner">
						<img src="" data-gg-lazy-src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />
						'.$noscript.'	
					</div>
				</div>
				<div class="gg_overlays">'. $ol_man->get_img_ol($img['title'], $img['descr'], $img['author'], $img['url']) .'</div>	
			</div>'.$close_tag;  
		}
		
		  
		/////////////////////////
		// photostring layout
		else {

			$thumb = gg_thumb_src($img['path'], false, $row_h, $thumb_q, $img['thumb']);
			$gallery .= '
			'. $open_tag .' '. $atts .'>
			  <div class="gg_img_inner" style="height: '.$row_h.'px;">
			  	<div class="gg_main_img_wrap">
					<div class="gg_img_wrap_inner">
						<img src="" data-gg-lazy-src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />	
						'.$noscript.'
					</div>
				</div>
				<div class="gg_overlays">'. $ol_man->get_img_ol($img['title'], $img['descr'], $img['author'], $img['url']) .'</div>	
			</div>'.$close_tag;  
		}	
	}
	  
	// container height trick for photostring
	if($layout == 'string') {$gallery .= '<div class="gg_string_clear_both" style="clear: both;"></div>';}

	// container closing
	$gallery .= '</div>'; 
	
	
	/////////////////////////
	// pagination
	if($paginate && $gall_img_count > $per_page) {		
		$gallery .= '<div class="gg_paginate gg_pag_'.get_option('gg_pag_style', 'light').'" gg-random="'.$random.'" data-gg-totpages="'.$tot_pages.'">';
		
		// pagination system
		$pag_system = get_option('gg_pag_system', 'standard');
		if($pagination) {$pag_system = $pagination;}
		
		// classic pagination
		if($pag_system == 'standard') {
			$pag_layout = get_option('gg_pag_layout', 'standard'); 
			$pl_class = '';
			
			if($pag_layout == 'only_num') {$pl_class .= 'gg_pag_onlynum';}
			if($pag_layout == 'only_arr_mb' || $pag_layout == 'only_arr') {
				$pl_class .= 'gg_only_arr';
				$pl_class .= ($pag_layout == 'only_arr_mb') ? ' gg_monoblock' : ' gg_detach_arr';
			}
			
			// mid nav - layout code
			if($pag_layout == 'standard') {
				$mid_code = '<div class="gg_nav_mid"><div>'. __('page', 'gg_ml') .' <span>1</span> '. __('of', 'gg_ml') .' '.$tot_pages.'</div></div>';	
			}
			elseif($pag_layout == 'only_num') {
				$mid_code = '<div class="gg_nav_mid"><div><span>1</span> <font>/</font> '.$tot_pages.'</div></div>';	
			}
			else {
				$mid_code = '<div class="gg_nav_mid" style="display: none;"><div><span>1</span> <font>-</font> '.$tot_pages.'</div></div>';
			}
			
			$gallery .= '
			<div class="gg_standard_pag '.$pl_class.'">
				<div class="gg_nav_left gg_prev_page gg_pag_disabled"><i></i></div>
				'.$mid_code.'
				<div class="gg_nav_right gg_next_page"><i></i></div>
			</div>';		
		}
		
		// infinite scroll
		else if($pag_system == 'inf_scroll') {
			$gallery .= '
			<div class="gg_infinite_scroll">
				<div class="gg_nav_left"></div>
				<div class="gg_nav_mid"><span>'. __('show more', 'gg_ml') .'</span></div>
				<div class="gg_nav_right"></div>
			</div>';
		}
		
		// numbered buttons
		else if($pag_system == 'num_btns') {
			$gallery .= '<div class="gg_num_btns_wrap">';
				for($a=1; $a<=$tot_pages; $a++) {
					$disabled = ($a==1) ? 'gg_pag_disabled' : '';
					$gallery .= '<div class="gg_pagenum '.$disabled.'" title="'. __('go to page', 'gg_ml') .' '.$a.'" rel="'.$a.'">'.$a.'</div>';
				}
			$gallery .= '</div>';
		}
		
		// dots
		else {
			$gallery .= '<div class="gg_dots_pag_wrap">';
				for($a=1; $a<=$tot_pages; $a++) {
					$disabled = ($a==1) ? 'gg_pag_disabled' : '';
					$gallery .= '<div class="gg_pag_dot '.$disabled.'" title="'. __('go to page', 'gg_ml') .' '.$a.'" rel="'.$a.'"></div>';
				}
			$gallery .= '</div>';
		}
		
		$gallery .= '</div>';
	}
	
	$gallery .= '<div style="clear: both;"></div>
	</div>'; // gallery wrap closing
	
	
	// pagination JS vars (WP-gall imgages - watermark flag - random order trail)
	if($paginate && $gall_img_count > $per_page) {	
		$random = (!empty($random)) ? json_encode($randomized_order) : 'false';
		
		$gallery .= '
		<script type="text/javascript"> 
		if(typeof(gg_pag_vars) == "undefined") {gg_pag_vars = {};}
		gg_pag_vars["'.$unique_id.'"] = {
			per_page		: '.$per_page.',
			watermark 		: '.(int)$watermark.',
			random_trail 	: "'. $random .'",
			wp_gall_hash	: "'. $wp_gall_hash .'"
		};
		</script>';
	}
	
	
	
	// js - init gallery
	$gallery .= '
	<script type="text/javascript"> 
	jQuery(document).ready(function($) { 
		if(typeof(gg_galleries_init) == "function") {
			gg_galleries_init("'.$unique_id.'"); 
		}
	});
	</script>';


	$gallery = str_replace(array("\r", "\n", "\t", "\v"), '', $gallery);
	return $gallery;
}
add_shortcode('g-gallery', 'gg_gallery_shortcode');

