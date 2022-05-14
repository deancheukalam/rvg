<?php

/////////////////////////////////////
////// PAGINATION ///////////////////
/////////////////////////////////////

function gg_pagination() {
	if(isset($_POST['gg_type']) && $_POST['gg_type'] == 'gg_pagination') {
		include_once(GG_DIR . '/functions.php');
		include_once(GG_DIR . '/classes/gg_overlay_manager.php');
		
		if(!isset($_POST['gid']) || !filter_var($_POST['gid'], FILTER_VALIDATE_INT)) {die('Gallery ID is missing');}
		$gid = (int)$_POST['gid'];
		
		if(!isset($_POST['gg_page'])) {die('wrong page number');}
		$page = (is_array($_POST['gg_page'])) ? $_POST['gg_page'] : (int)$_POST['gg_page'];
		
		// overlay
		if(!isset($_POST['gg_ol'])) {die('overlay is missing');}
		$overlay = $_POST['gg_ol'];
		
		
		// is applying a filter? handle matching image indexes
		$filtered_indexes = (isset($_POST['gg_filtered_imgs'])) ? (array)$_POST['gg_filtered_imgs'] : false;
		
				
		// randomized images list trail
		if(!isset($_POST['gg_pag_vars']) || !is_array($_POST['gg_pag_vars'])) {die('missing gallery infos');}
		$per_page			= (int)$_POST['gg_pag_vars']['per_page']; if(!$per_page) {$per_page = 15;}
		$watermark 			= $_POST['gg_pag_vars']['watermark'];
		$randomized_order	= $_POST['gg_pag_vars']['random_trail']; if(!empty($randomized_order)) {$randomized_order = json_decode($randomized_order);}
		$wp_gall_hash		= $_POST['gg_pag_vars']['wp_gall_hash'];

		// get the gallery data
		$type 		= get_post_meta($gid, 'gg_type', true);
		$raw_layout = get_post_meta($gid, 'gg_layout', true);
		$thumb_q 	= get_option('gg_thumb_q', 90);

		// WP gall pagination fix
		if(!$type) {$type = 'wp_gall';}


		// layout options
		$layout = gg_check_default_val($gid, 'gg_layout');
		if($layout == 'standard') {
			$thumb_w = gg_check_default_val($gid, 'gg_thumb_w', 150, $raw_layout);
			$thumb_h = gg_check_default_val($gid, 'gg_thumb_h', 150, $raw_layout);
		}
		elseif($layout == 'columnized') {
			$thumb_w = (int)gg_check_default_val($gid, 'gg_colnzd_thumb_max_w', 260, $raw_layout);

			$thumb_h_val  = (int)gg_check_default_val($gid, 'gg_colnzd_thumb_h', 120, $raw_layout);
			$thumb_h_type = gg_check_default_val($gid, 'gg_colnzd_thumb_h_type', 'px', $raw_layout);
			$thumb_h = ($thumb_h_type == 'px') ? $thumb_h_val : ($thumb_w * ($thumb_h_val / 100));
		}
		elseif($layout == 'masonry') { 
			$cols = gg_check_default_val($gid, 'gg_masonry_cols', 4, $raw_layout); 
			$default_w = (int)get_option('gg_masonry_basewidth', 960);
			$col_w = floor( $default_w / $cols );
		}
		else {
			$row_h = gg_check_default_val($gid, 'gg_photostring_h', 180, $raw_layout);
		}
		
			
		//// prepare images
		// get them
		$images = gg_frontend_img_prepare($gid, $type, $wp_gall_hash);
		if(!is_array($images) || !count($images)) {$images = array();}
		$gall_img_count = count($images);

		
		// images array to be used (eventually watermarked)
		//// consider also an array value - flagging an infinite scroll restore after a filter
		
		if(is_array($page)) {
			$last_elem = (int)end($page) * $per_page;
			$selection = array(0, $last_elem);
		}
		else {
			$start = ($page == 1) ? 0 : (($page - 1) * $per_page); 
			$selection = ($filtered_indexes) ? 'all' : array($start, ($page * $per_page));  
		}
		
		$images = gg_frontend_img_split($gid, $images, $selection, $randomized_order, $watermark);	// PASS ALSO WATERMARK FLAG!!!!
		if(!is_array($images) || !count($images)) {$images = array();}
	
	
		// pagination limit
		if($gall_img_count > $per_page) {
			$tot_pages = ceil($gall_img_count / $per_page );	
		}
		
		
		// if is filtering - return only them
		if($filtered_indexes) {
			$filtered = array();
			
			foreach($filtered_indexes as $fid) {
				if(isset($images[$fid])) {
					$filtered[] = $images[$fid];	
				}
			}
			
			$images = $filtered;
		}
		
		
		// image overlay code 
		$ol_man = new gg_overlay_manager($overlay, false, 'gall');
			
		// create new block of gallery HTML
		$gallery = '';
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
			
			// SEO noscript part for full-res image
		  	$noscript = '<noscript><img src="'.$img['url'].'" alt="'.gg_sanitize_input($img['title']).'" /></noscript>';
					
			// common attributes + classes
			$atts = 'class="gg_img '.$add_class.'" data-gg-url="'.$img['url'].'" data-gg-title="'.gg_sanitize_input($img['title']).'" data-gg-author="'.gg_sanitize_input($img['author']).'" data-gg-descr="'.gg_sanitize_input($img['descr']).'" data-img-id="'.$img_index.'" rel="'.$gid.'"';
			
			
			
			/////////////////////////
			// standard layout
			if($layout == 'standard') {	 
				
				$thumb = gg_thumb_src($img['path'], $thumb_w, $thumb_h, $thumb_q, $img['thumb']);
				$gallery .= '
				'.$open_tag.' '.$atts.'>
				  <div class="gg_img_inner">';
					
					$gallery .= '
					<div class="gg_main_img_wrap">
						<div class="gg_img_wrap_inner">
							<img src="" data-gg-lazy-src="'.$thumb.'" alt="'.gg_sanitize_input($img['title']).'" class="gg_photo gg_main_thumb" />
							'.$noscript.'
						</div>
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
				'.$open_tag.' '.$atts.'>
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
				'.$open_tag.' '.$atts.'>
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
				'.$open_tag.' '.$atts.'>
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
		
		$pag = array(
			'html' => $gallery,
			'more' => (is_array($page) || $gall_img_count > ($page * $per_page)) ? 1 : 0,
		);
		
		echo json_encode($pag);
		die();
	}
}
add_action('init', 'gg_pagination');




//////////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////
////// LOAD GALLERY WITHIN COLLECTION //////
////////////////////////////////////////////

function gg_load_coll_gallery() {
	if(isset($_POST['gg_type']) && $_POST['gg_type'] == 'gg_load_coll_gallery') {
		
		if(!isset($_POST['gdata'])) {die('data is missing');}
		$gdata = json_decode(base64_decode($_POST['gdata']), true);
		
		$resp = '';
		if(get_option('gg_coll_show_gall_title')) {
			$resp .= '<h3 class="gg_coll_gall_title">'. get_the_title($gdata['id']) .'</h3>';
		}
		
		$resp .= '<div class="gg_coll_gall_topmargin"></div>';
		
		$resp .= do_shortcode('[g-gallery gid="'.$gdata['id'].'" random="'.$gdata['rand'].'" filters="'.$gdata['filters'].'" watermark="'.$gdata['wmark'].'"]');
		die($resp);
	}
}
add_action('init', 'gg_load_coll_gallery');

