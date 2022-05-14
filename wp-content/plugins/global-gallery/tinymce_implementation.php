<?php
// implement tinymce button

add_action('media_buttons', 'gg_editor_btn', 20);
add_action('admin_footer', 'gg_editor_btn_content');


//action to add a custom button to the content editor
function gg_editor_btn($context) {
	$img = GG_URL . '/img/gg_logo_small.png';
  
	//append the icon
	echo '
	<a id="gg_scw_btn" title="Global Gallery">
	  <img src="'.$img.'" />
	</a>';
	
	$GLOBALS['gg_tinymce_editor'] = true;
}



function gg_editor_btn_content() {
	if(strpos($_SERVER['REQUEST_URI'], 'post.php') === false && strpos($_SERVER['REQUEST_URI'], 'post-new.php') === false && !isset($GLOBALS['gg_tinymce_editor'])) {return false;}


	// get galleries
	$args = array(
		'post_type' => 'gg_galleries',
		'numberposts' => -1,
		'post_status' => 'publish',
		'fields' => 'ids'
	);
	
	$gall_ids = get_posts( $args );
	$galleries = array();
	
	foreach($gall_ids as $id) {
		$galleries[ $id ] = get_the_title($id);	
	}
	
	
	// get collections
	$collections = get_terms('gg_collections', 'hide_empty=0');
	
	
	////////////////////////////////////////////////////////////
	// OVERLAY MANAGER ADD-ON - variable containing dropdown
	if(defined('GGOM_DIR')) {
		$ggom_block = '
		<li class="lcwp_scw_field gg_scw_field">
			<label>'. __('Custom Overlay', 'gg_ml') .'</label>
		  
			<select data-placeholder="'. __('Select an overlay', 'gg_ml') .'.." name="gg_custom_overlay" class="lcweb-chosen" autocomplete="off">
				<option value="">('. __('default one', 'gg_ml') .')</option>';
		
			   $overlays = get_terms('ggom_overlays', 'hide_empty=0&orderby=name');
			   foreach($overlays as $ol) {
				  $ggom_block .= '<option value="'.$ol->term_id.'">'.$ol->name.'</option>'; 
			   }
		
		$ggom_block .= '
			</select>
		</li>';  
	}
	else {$ggom_block = '';}
	////////////////////////////////////////////////////////////
?>


	<div id="ggallery_sc_wizard" style="display:none;">
    	<div class="lcwp_scw_choser_wrap gg_scw_choser_wrap">
            <select name="gg_scw_choser" class="lcwp_scw_choser gg_scw_choser" autocomplete="off">
                <option value="#gg_sc_gall" selected="selected"><?php _e('Gallery', 'gg_ml') ?></option>
                <option value="#gg_sc_itg"><?php _e('Image-to-Gallery', 'gg_ml') ?></option>
                <option value="#gg_sc_coll"><?php _e('Collection', 'gg_ml') ?></option>	
                <option value="#gg_sc_slider"><?php _e('Slider', 'gg_ml') ?></option>	
                <option value="#gg_sc_car"><?php _e('Carousel', 'gg_ml') ?></option>	
            </select>	
        </div>
        
        
        
		<div id="gg_sc_gall" class="lcwp_scw_block gg_scw_block"> 
            <ul>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Which gallery?', 'gg_ml') ?></label>
               		<select id="gg_gall_choose" data-placeholder="<?php _e('Select gallery', 'gg_ml') ?> .." name="gg_gall_choose" class="lcweb-chosen" autocomplete="off">
						<?php
						foreach($galleries as $gid => $g_tit) {
							echo '<option value="'.$gid.'">'.$g_tit.'</option>';	
						}
                        ?>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Random display?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_random" name="gg_random" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Use watermark?', 'gg_ml') ?> <em>(<?php _e('where available', 'gg_ml') ?>)</em></label>
                    <input type="checkbox" id="gg_watermark" name="gg_watermark" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Use tags filter?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_tag_filter" name="gg_tag_filter" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Pagination system', 'gg_ml') ?></label>
               		<select id="gg_gall_pagination" data-placeholder="<?php _e('Select an option', 'gg_ml') ?> .." name="gg_gall_pagination" class="lcweb-chosen" autocomplete="off">
						
                        <option value=""><?php _e('Auto - follow global settings', 'gg_ml') ?></option>
                        <option value="standard"><?php _e('Standard', 'gg_ml') ?></option>
                        <option value="inf_scroll"><?php _e('Infinite scroll', 'gg_ml') ?></option>
                	</select>
                </li>
                <?php echo $ggom_block; ?>
                <li class="lcwp_scw_field gg_scw_field">
                	<input type="button" value="<?php _e('Insert Gallery', 'gg_ml') ?>" name="gg_insert_gallery" id="gg_insert_gallery" class="button-primary" />
                </li>
			</ul>
		</div>  
        
        
        
        <div id="gg_sc_itg" class="lcwp_scw_block gg_scw_block"> 
            <ul>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Which gallery?', 'gg_ml') ?></label>
               		<select data-placeholder="<?php _e('Select gallery', 'gg_ml') ?> .." name="gg_itg_gall" class="lcweb-chosen" autocomplete="off">
						<?php
						foreach($galleries as $gid => $g_tit) {
							echo '<option value="'.$gid.'">'.$g_tit.'</option>';	
						}
                        ?>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("Box width", 'gg_ml') ?></label>
                    <input type="number" name="gg_itg_w" value="100" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" />
                    
                    <select name="gg_itg_w_type" style="width: 50px; min-width: 0px; position: relative; top: -3px;" autocomplete="off">
                    	<option value="%">%</option>
                        <option value="px">px</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("Images height", 'gg_ml') ?> <em>(<?php _e('% is proportional to width', 'gg_ml') ?>)</em></label>
                    
                    <input type="number" name="gg_itg_h" value="75" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" />
                    
                    <select name="gg_itg_h_type" style="width: 50px; min-width: 0px; position: relative; top: -3px;" autocomplete="off">
                    	<option value="%">%</option>
                        <option value="px">px</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e("Layout", 'gg_ml') ?></label>

                    <select name="gg_itg_layout" class="lcweb-chosen" autocomplete="off">
                    	<option value="">(<?php _e('default one', 'gg_ml') ?>)</option>
                       	<?php
						include_once(GG_DIR .'/settings/field_options.php');
						foreach(gg_itg_layouts() as $key => $val) {
							echo '<option value="'. $key .'">'. $val .'</option>';	
						}
						?>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("How many images to display?", 'gg_ml') ?> <span class="dashicons dashicons-info" title="<?php echo esc_attr(__('This will be ignored if chosen layout is "main image + two on sides"', 'gg_ml')) ?>" style="cursor: help; opacity: 0.3;"></span></label>

                    <select name="gg_itg_img_num" style="width: 50px; min-width: 0px;" autocomplete="off">
                    	<option value="1">1</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("Custom font size", 'gg_ml') ?> <span class="dashicons dashicons-info" title="<?php echo esc_attr(__('Leave empty to use default one', 'gg_ml')) ?>" style="cursor: help; opacity: 0.3;"></span></label>

                     <input type="number" name="gg_itg_font_size" value="" max="5" min="0.1" step="0.1" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" /> rem
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Random images?', 'gg_ml') ?> <span class="dashicons dashicons-info" title="<?php echo esc_attr(__('Check to randomly pick images randomly from gallery', 'gg_ml')) ?>" style="cursor: help; opacity: 0.3;"></span></label>
                    <input type="checkbox" name="gg_itg_random" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Use watermark?', 'gg_ml') ?> <em>(<?php _e('where available', 'gg_ml') ?>)</em></label>
                    <input type="checkbox" name="gg_itg_watermark" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field gg_itg_img_num">
                	<label><?php _e("Custom overlay text", 'gg_ml') ?> <span class="dashicons dashicons-info" title="<?php echo esc_attr(__('Remember you can use placeholders and FontAwesome icons as explained in settings', 'gg_ml')) ?>" style="cursor: help; opacity: 0.3;"></span></label>
                    
                	<textarea name="gg_itg_cust_txt"></textarea>
				</li>

                <li class="lcwp_scw_field gg_scw_field">
                	<input type="button" value="<?php _e('Insert Image', 'gg_ml') ?>" name="gg_insert_itg" id="gg_insert_itg" class="button-primary" />
                </li>
			</ul>
		</div>  
		
        
        
        <div id="gg_sc_coll" class="lcwp_scw_block gg_scw_block"> 
            <ul>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Which collection?', 'gg_ml') ?></label>
               		<select id="gg_collection_choose" name="gg_collection_choose" data-placeholder="<?php _e('Select gallery', 'gg_ml') ?> .." class="lcweb-chosen" autocomplete="off">
						<?php
						foreach ( $collections as $collection ) {
							echo '<option value="'.$collection->term_id.'">'.$collection->name.'</option>';
						}
                        ?>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Allow filters?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_coll_filter" name="gg_coll_filter" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Random display?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_coll_random" name="gg_coll_random" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <?php echo $ggom_block; ?>
                <li class="lcwp_scw_field gg_scw_field">
                	<input type="button" value="<?php _e('Insert Collection', 'gg_ml') ?>" name="gg_insert_collection" id="gg_insert_collection" class="button-primary" />
                </li>
			</ul>
		</div>  
        
        
        
        <div id="gg_sc_slider" class="lcwp_scw_block gg_scw_block"> 
            <ul>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Images source', 'gg_ml') ?></label>
               		<select name="gg_slider_gallery" id="gg_slider_gallery" data-placeholder="<?php _e('Select gallery', 'gg_ml') ?> .." class="lcweb-chosen" autocomplete="off">
						<?php
						foreach($galleries as $gid => $g_tit) {
							echo '<option value="'.$gid.'">'.$g_tit.'</option>';	
						}
                        ?>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("Slider's width", 'gg_ml') ?></label>
                    
                    <input type="number" name="gg_slider_w" value="" id="gg_slider_w" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" />
                    
                    <select name="gg_slider_w_type"  id="gg_slider_w_type" style="width: 50px; min-width: 0px; position: relative; top: -3px;" autocomplete="off">
                    	<option value="%">%</option>
                        <option value="px">px</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e("Slider's height", 'gg_ml') ?> <em>(<?php _e('% is proportional to width', 'gg_ml') ?>)</em></label>
                    
                    <input type="number" name="gg_slider_h" value="" id="gg_slider_h" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" />
                    
                    <select name="gg_slider_h_type"  id="gg_slider_h_type" style="width: 50px; min-width: 0px; position: relative; top: -3px;" autocomplete="off">
                    	<option value="%">%</option>
                        <option value="px">px</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Random display?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_slider_random" name="gg_slider_random" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Use watermark?', 'gg_ml') ?> <em>(<?php _e('where available', 'gg_ml') ?>)</em></label>
                    <input type="checkbox" id="gg_slider_watermark" name="gg_slider_watermark" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Autoplay slider?', 'gg_ml') ?></label>
               		<select id="gg_slider_autop" data-placeholder="<?php _e('Select an option', 'gg_ml') ?> .." name="gg_slider_autop" class="lcweb-chosen" autocomplete="off">
						
                        <option value="auto">(<?php _e('as default', 'gg_ml') ?>)</option>
						<option value="1"><?php _e('Yes', 'gg_ml') ?></option>
                      	<option value="0"><?php _e('No', 'gg_ml') ?></option>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field">
                	<input type="button" value="<?php _e('Insert Slider', 'gg_ml') ?>" name="gg_insert_slider" id="gg_insert_slider" class="button-primary" />
                </li>
			</ul>
		</div>  
        
        
        
        <div id="gg_sc_car" class="lcwp_scw_block gg_scw_block"> 
            <ul>
                <li class="lcwp_scw_field gg_scw_field">
                	<label><?php _e('Which gallery?', 'gg_ml') ?></label>
               		<select name="gg_car_gallery" id="gg_car_gallery" data-placeholder="<?php _e('Select gallery', 'gg_ml') ?> .." class="lcweb-chosen" autocomplete="off">
						<?php
						foreach($galleries as $gid => $g_tit) {
							echo '<option value="'.$gid.'">'.$g_tit.'</option>';	
						}
                        ?>
                	</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Images max width', 'gg_ml') ?></label>
                    <input type="number" name="gg_car_max_w" value="" min="20" id="gg_car_max_w" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" /> px
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Images height', 'gg_ml') ?></label>
                    <input type="number" name="gg_car_h" value="" id="gg_car_h" style="width: 70px; text-align: center;" maxlength="4" autocomplete="off" /> 
                    
                    <select name="gg_car_h_type" id="gg_car_h_type" autocomplete="off" style="width: 50px; min-width: 0px; position: relative; top: -3px;">
                        <option value="px">px</option>
                        <option value="%">%</option>
                    </select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Rows', 'gg_ml') ?></label>
                    
                    <select id="gg_car_rows" data-placeholder="<?php _e('Select an option', 'gg_ml') ?> .." name="gg_car_rows" style="width: 70px;" autocomplete="off">
						<?php
                        for($a=1; $a<=10; $a++) {
                        	echo '<option value="'.$a.'">'.$a.'</option>';  
                        }
                        ?>
					</select>
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Multi-scroll?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_car_multiscroll" name="gg_car_multiscroll" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Center display mode?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_car_center_mode" name="gg_car_center_mode" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Avoid images crop?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_car_nocrop" name="gg_car_nocrop" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Static mode?', 'gg_ml') ?> <span class="dashicons dashicons-info" title="<?php echo esc_attr(__('Disables overlay and lightbox', 'gg_ml')) ?>" style="cursor: help; opacity: 0.3;"></span></label>
                    <input type="checkbox" id="gg_car_static" name="gg_car_static" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Random display?', 'gg_ml') ?></label>
                    <input type="checkbox" id="gg_car_random" name="gg_car_random" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Use watermark?', 'gg_ml') ?> <em>(<?php _e('where available', 'gg_ml') ?>)</em></label>
                    <input type="checkbox" id="gg_car_watermark" name="gg_car_watermark" value="1" class="ip-checkbox" autocomplete="off" />
                </li>
                <li class="lcwp_scw_field gg_scw_field lcwp_scwf_half">
                	<label><?php _e('Autoplay carousel?', 'gg_ml') ?></label>
               		<select id="gg_car_autop" data-placeholder="<?php _e('Select an option', 'gg_ml') ?> .." name="gg_car_autop" class="lcweb-chosen" autocomplete="off">
						
                        <option value="auto">(<?php _e('as default', 'gg_ml') ?>)</option>
						<option value="1"><?php _e('Yes', 'gg_ml') ?></option>
                      	<option value="0"><?php _e('No', 'gg_ml') ?></option>
                	</select>
                </li>
                <?php echo $ggom_block; ?>
                <li class="lcwp_scw_field gg_scw_field">
                	<input type="button" value="<?php _e('Insert Carousel', 'gg_ml') ?>" name="gg_insert_carousel" id="gg_insert_carousel" class="button-primary" />
                </li>
			</ul>
    	</div> 
	</div> 
   
   
   
	<?php // SCRIPTS ?>
    <link rel="stylesheet" href="<?php echo GG_URL; ?>/js/lightboxes/magnific-popup/magnific-popup.css" media="all" />
    <script src="<?php echo GG_URL; ?>/js/lightboxes/magnific-popup/magnific-popup.pckg.js" type="text/javascript"></script>
	
    <script src="<?php echo GG_URL; ?>/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo GG_URL; ?>/js/lc-switch/lc_switch.min.js" type="text/javascript"></script>
    
    <script src="<?php echo GG_URL; ?>/js/functions.js" type="text/javascript"></script>
    <script src="<?php echo GG_URL; ?>/js/tinymce_btn.js" type="text/javascript"></script>
<?php    
}
