<?php
// ARRAY CONTAINING OPTION VALUES TO SETUP PRESET STYLES


// preset style names
function gg_preset_style_names() {
	$ml_key = 'gg_ml';
	
	return array(
		'l_standard'	=> __("Light", $ml_key) .' - '. __('Standard', $ml_key),
		'l_minimal'		=> __("Light", $ml_key) .' - '. __('Minimal', $ml_key),
		'l_noborder'	=> __("Light", $ml_key) .' - '. __('No border', $ml_key),
		'l_photowall'	=> __("Light", $ml_key) .' - '. __('Photo wall', $ml_key),
		
		'd_standard'	=> __("Dark", $ml_key) .' - '. __('Standard', $ml_key),
		'd_minimal'		=> __("Dark", $ml_key) .' - '. __('Minimal', $ml_key),
		'd_noborder'	=> __("Dark", $ml_key) .' - '. __('No border', $ml_key),
		'd_photowall'	=> __("Dark", $ml_key) .' - '. __('Photo wall', $ml_key),		
	);			
}


// option values to apply
function gg_preset_styles_data($style = '') {
	$styles = array();
	
	
	/*** LIGHTS ***/
	$styles['l_standard'] = array(
		'gg_standard_hor_margin' => 5,
		'gg_standard_ver_margin' => 5,
		'gg_masonry_margin' => 7,
		'gg_photostring_margin' => 7,
		
		'gg_img_border' => 4,
		'gg_img_radius' => 4,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#FFFFFF',
		
		'gg_main_ol_color' => '#ffffff',
		'gg_main_ol_opacity' => 80,
		'gg_main_ol_txt_color' => '#222222',
		'gg_sec_ol_color' => '#555555',
		'gg_icons_col' => '#fcfcfc',
		'gg_txt_u_title_color' => '#444444',
		'gg_txt_u_descr_color' => '#555555',
		
		'gg_filters_border_w' => 2,
		'gg_filters_radius' => 2,
		
		'gg_filters_txt_color' => '#666666', 
		'gg_filters_bg_color' => '#ffffff',
		'gg_filters_border_color' => '#bbbbbb', 
		'gg_filters_txt_color_h' => '#535353', 
		'gg_filters_bg_color_h' => '#fdfdfd', 
		'gg_filters_border_color_h' => '#777777',
		'gg_filters_txt_color_sel' => '#333333', 
		'gg_filters_bg_color_sel' => '#efefef', 
		'gg_filters_border_color_sel' => '#aaaaaa',
		
		'gg_search_txt_color' => '#666666', 
		'gg_search_bg_color' => '#ffffff',
		'gg_search_border_color' => '#bbbbbb',
		'gg_search_txt_color_h' => '#333333', 
		'gg_search_bg_color_h' => '#fdfdfd',
		'gg_search_border_color_h' => '#aaaaaa',
		
		'gg_pag_txt_col' => '#666666', 
		'gg_pag_bg_col' => '#ffffff',
		'gg_pag_border_col' => '#bbbbbb',
		'gg_pag_txt_col_h' => '#333333', 
		'gg_pag_bg_col_h' => '#efefef',
		'gg_pag_border_col_h' => '#aaaaaa',
	);
	
	
	$styles['l_minimal'] = gg_ps_override_indexes($styles['l_standard'], array(
		'gg_standard_hor_margin' => 6,
		'gg_standard_ver_margin' => 6,
		'gg_masonry_margin' => 8,
		'gg_photostring_margin' => 8,
		
		'gg_img_border' => 4,
		'gg_img_radius' => 1,
		'gg_img_shadow' => 'outline',
		'gg_img_outline_color' => '#bbbbbb', 
		'gg_img_border_color' => 'transparent',
		
		'gg_main_ol_color' => '#ffffff',
		'gg_main_ol_opacity' => 90,
		'gg_main_ol_txt_color' => '#222222',
		'gg_sec_ol_color' => '#555555',
		'gg_icons_col' => '#fefefe',
		'gg_txt_u_title_color' => '#444444',
		'gg_txt_u_descr_color' => '#555555',
		
		'gg_filters_border_w' => 1,
	));
	

	$styles['l_noborder'] = gg_ps_override_indexes($styles['l_standard'], array(
		'gg_standard_hor_margin' => 5,
		'gg_standard_ver_margin' => 5,
		'gg_masonry_margin' => 5,
		'gg_photostring_margin' => 5,
		
		'gg_img_border' => 0,
		'gg_img_radius' => 2,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#FFFFFF',
		
		'gg_main_ol_color' => '#FFFFFF',
		'gg_main_ol_opacity' => 80,
		'gg_main_ol_txt_color' => '#222222',
		'gg_sec_ol_color' => '#555555',
		'gg_icons_col' => '#fcfcfc',
		'gg_txt_u_title_color' => '#444444',
		'gg_txt_u_descr_color' => '#555555',
		
		'gg_filters_border_w' => 0,
		
		'gg_filters_txt_color' => '#606060', 
		'gg_filters_bg_color' => '#f5f5f5',
		'gg_filters_txt_color_h' => '#4a4a4a', 
		'gg_filters_bg_color_h' => '#fafafa', 
		'gg_filters_txt_color_sel' => '#333333', 
		'gg_filters_bg_color_sel' => '#dfdfdf', 
		
		'gg_search_txt_color' => '#606060', 
		'gg_search_bg_color' => '#f5f5f5',
		'gg_search_txt_color_h' => '#333333', 
		'gg_search_bg_color_h' => '#eeeeee',
	));
	
	
	$styles['l_photowall'] = gg_ps_override_indexes($styles['l_noborder'], array(
		'gg_standard_hor_margin' => 0,
		'gg_standard_ver_margin' => 0,
		'gg_masonry_margin' => 0,
		'gg_photostring_margin' => 0,
		
		'gg_img_border' => 0,
		'gg_img_radius' => 0,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#CCCCCC',

		'gg_main_ol_color' => '#FFFFFF',
		'gg_main_ol_opacity' => 80,
		'gg_main_ol_txt_color' => '#222222',
		'gg_sec_ol_color' => '#555555',
		'gg_icons_col' => '#fcfcfc',
		'gg_txt_u_title_color' => '#444444',
		'gg_txt_u_descr_color' => '#555555',
	));
	
	
	
	
	
	/*** DARKS ***/
	$styles['d_standard'] = array(
		'gg_standard_hor_margin' => 5,
		'gg_standard_ver_margin' => 5,
		'gg_masonry_margin' => 7,
		'gg_photostring_margin' => 7,
		
		'gg_img_border' => 4,
		'gg_img_radius' => 4,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#888888',
		
		'gg_main_ol_color' => '#141414',
		'gg_main_ol_opacity' => 90,
		'gg_main_ol_txt_color' => '#ffffff',
		'gg_sec_ol_color' => '#bbbbbb',
		'gg_icons_col' => '#555555',
		'gg_txt_u_title_color' => '#fefefe',
		'gg_txt_u_descr_color' => '#f7f7f7',
		
		'gg_filters_border_w' => 2,
		'gg_filters_radius' => 2,
		
		'gg_filters_txt_color' => '#eeeeee', 
		'gg_filters_bg_color' => '#4f4f4f',
		'gg_filters_border_color' => '#4f4f4f', 
		'gg_filters_txt_color_h' => '#ffffff', 
		'gg_filters_bg_color_h' => '#585858', 
		'gg_filters_border_color_h' => '#777777',
		'gg_filters_txt_color_sel' => '#f3f3f3', 
		'gg_filters_bg_color_sel' => '#6a6a6a', 
		'gg_filters_border_color_sel' => '#6a6a6a',
		
		'gg_search_txt_color' => '#eeeeee', 
		'gg_search_bg_color' => '#4f4f4f',
		'gg_search_border_color' => '#4f4f4f',
		'gg_search_txt_color_h' => '#f3f3f3', 
		'gg_search_bg_color_h' => '#6a6a6a',
		'gg_search_border_color_h' => '#6a6a6a',
		
		'gg_pag_txt_col' => '#eeeeee', 
		'gg_pag_bg_col' => '#4f4f4f',
		'gg_pag_border_col' => '#4f4f4f',
		'gg_pag_txt_col_h' => '#f3f3f3', 
		'gg_pag_bg_col_h' => '#6a6a6a',
		'gg_pag_border_col_h' => '#6a6a6a',
	);
	
	
	$styles['d_minimal'] = gg_ps_override_indexes($styles['d_standard'], array(
		'gg_standard_hor_margin' => 6,
		'gg_standard_ver_margin' => 6,
		'gg_masonry_margin' => 8,
		'gg_photostring_margin' => 8,
		
		'gg_img_border' => 4,
		'gg_img_radius' => 1,
		'gg_img_shadow' => 'outline',
		'gg_img_outline_color' => '#777777', 
		'gg_img_border_color' => 'transparent',
		
		'gg_main_ol_color' => '#141414',
		'gg_main_ol_opacity' => 90,
		'gg_main_ol_txt_color' => '#ffffff',
		'gg_sec_ol_color' => '#bbbbbb',
		'gg_icons_col' => '#555555',
		'gg_txt_u_title_color' => '#fefefe',
		'gg_txt_u_descr_color' => '#f7f7f7',
		
		'gg_filters_border_w' => 1,
	));
	
	
	$styles['d_noborder'] = gg_ps_override_indexes($styles['d_standard'], array(
		'gg_standard_hor_margin' => 5,
		'gg_standard_ver_margin' => 5,
		'gg_masonry_margin' => 5,
		'gg_photostring_margin' => 5,
		
		'gg_img_border' => 0,
		'gg_img_radius' => 2,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#999999',
		
		'gg_main_ol_color' => '#141414',
		'gg_main_ol_opacity' => 90,
		'gg_main_ol_txt_color' => '#ffffff',
		'gg_sec_ol_color' => '#bbbbbb',
		'gg_icons_col' => '#555555',
		'gg_txt_u_title_color' => '#fefefe',
		'gg_txt_u_descr_color' => '#f7f7f7',
		
		'gg_filters_border_w' => 0,
	));

	
	$styles['d_photowall'] = gg_ps_override_indexes($styles['d_noborder'], array(
		'gg_standard_hor_margin' => 0,
		'gg_standard_ver_margin' => 0,
		'gg_masonry_margin' => 0,
		'gg_photostring_margin' => 0,
		
		'gg_img_border' => 0,
		'gg_img_radius' => 0,
		'gg_img_shadow' => 'outshadow',
		'gg_img_border_color' => '#999999',
		
		'gg_main_ol_color' => '#141414',
		'gg_main_ol_opacity' => 90,
		'gg_main_ol_txt_color' => '#ffffff',
		'gg_sec_ol_color' => '#bbbbbb',
		'gg_icons_col' => '#555555',
		'gg_txt_u_title_color' => '#fefefe',
		'gg_txt_u_descr_color' => '#f7f7f7',
	));


	if(empty($style)) {return $styles;}
	else {
		return (isset($styles[$style])) ? $styles[$style] : false;
	}	
}




// override only certain indexes to write less code
function gg_ps_override_indexes($array, $to_override) {
	foreach($to_override as $key => $val) {
		$array[$key] = $val;	
	}
	
	return $array;
}


