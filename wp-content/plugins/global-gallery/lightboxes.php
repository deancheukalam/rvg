<?php
// LIGTBOXES SWITCH

///////////////////////////////////////////
// scripts and styles
function gg_lightbox_scripts() {
	if(is_admin()) {return false;}
	$lightbox = get_option('gg_lightbox', 'lcweb');
		
	switch($lightbox) {
		case 'lcweb':
		default		:
			$css_path = '/lc-lightbox/css/lc_lightbox.min.css';
			$js_path = '/lc-lightbox/js/lc_lightbox.gg.min.js';
			
			wp_enqueue_style('gg-lcl-skin', GG_URL .'/js/lightboxes/lc-lightbox/skins/'. get_option('gg_lb_lcl_style', 'minimal') .'.css', 99, GG_VER);
			wp_enqueue_script('gg-lb-alloyfinger', GG_URL .'/js/lightboxes/lc-lightbox/lib/alloy_finger.min.js', 99, GG_VER, true);
			break;
			
		case 'lightcase':
			$css_path = '/lightcase/src/css/lightcase.min.css';
			$js_path = '/lightcase/src/js/lightcase.min.js';
			
			wp_enqueue_script('gg-lb-jquerytouch', GG_URL .'/js/lightboxes/lightcase/vendor/jQuery/jquery.events.touch.js', 99, GG_VER, true);
			break;	
		
		case 'simplelb':
			$css_path = '/simplelightbox/simplelightbox.min.css';
			$js_path = '/simplelightbox/simple-lightbox.min.js';
			break;
			
		case 'tosrus':
			$css_path = '/jQuery.TosRUs/dist/css/jquery.tosrus.gg.min.css';
			$js_path = '/jQuery.TosRUs/dist/js/jquery.tosrus.all.min.js';
			
			wp_enqueue_script('gg-lb-hammer', GG_URL .'/js/lightboxes/jQuery.TosRUs/dist/js/addons/hammer.min.js', 99, GG_VER, true);
			wp_enqueue_script('gg-lb-FVS', GG_URL .'/js/lightboxes/jQuery.TosRUs/lib/FlameViewportScale.js', 99, GG_VER, true);
			break;
			
		case 'lightgall':
			$css_path = '/lightGallery/css/lightgallery.css';
			$js_path = '/lightGallery/js/lightgallery.min.js';
			break;
			
		case 'mag_popup':
			$css_path = '/magnific-popup/magnific-popup.css';
			$js_path = '/magnific-popup/magnific-popup.pckg.js';
			break;
			
		case 'imagelb':
			$css_path = '/imageLightbox/imagelightbox.css';
			$js_path = '/imageLightbox/imagelightbox.min.js';
			break;	
		
		case 'photobox':
			$css_path = '/photobox/photobox.css';
			$js_path = '/photobox/jquery.photobox.min.js';
			break;
						
		case 'fancybox':
			$css_path = '/fancybox-1.3.4/jquery.fancybox-1.3.4.css';
			$js_path = '/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js';
			break;
					
		case 'colorbox':
			$style = get_option('gg_lb_col_style', 1);
			if(empty($style)) {$style = 1;}
			
			$css_path = '/colorbox/example'.$style.'/colorbox.css';
			$js_path = '/colorbox/jquery.colorbox-min.js';
			break;
			
		case 'prettyphoto' :
			$css_path = '/prettyPhoto-3.1.6/css/prettyPhoto.css';
			$js_path = '/prettyPhoto-3.1.6/jquery.prettyPhoto.js';
			break;			
	}
	
	wp_enqueue_style('gg-lightbox-css', GG_URL .'/js/lightboxes'. $css_path, 90);
	wp_enqueue_script('gg-lightbox-js', GG_URL .'/js/lightboxes'. $js_path, 100, GG_VER, true);
}
add_action('wp_enqueue_scripts', 'gg_lightbox_scripts');




/////////////////////////////////////////////
// footer inline codes
function gg_lightboxes_footer() {
  	if(is_admin()) {return false;}
	$lightbox = get_option('gg_lightbox', 'lcweb');
	
	
	// images gathering 
	?>
    <script type="text/javascript">
		
	<?php if($lightbox == 'lcweb' && get_option('gg_lb_deeplink')) : ?>
	// LCweb LB trick - launch any gallery / slider / carousel to prepare elements and allow deeplinking
	gg_lcl_allow_deeplink = function() {
		if(typeof(gg_no_lb) != 'undefined') {
			return false;	
		}
		
		if(typeof(lcl_gg_nulling_prepare) != 'undefined') {clearTimeout(lcl_gg_nulling_prepare);}
		lcl_gg_prepare = true; 
		
		jQuery('.gg_carousel_wrap, .gg_container:not(.gg_coll_container)').each(function() {
			jQuery(this).find('.gg_img:not(.gg_linked_img, .gg_excluded_img)').first().trigger('click');
        });
		jQuery('.galleria-gg-lightbox').each(function() {
			jQuery(this).trigger('click');
		});
	};
	jQuery(document).ready(function(e) {
        gg_lcl_allow_deeplink();
    }); 
	<?php endif; ?>
	
	
	// thumbs maker
	var gg_lb_thumb = function(src) {
		<?php if(get_option('gg_use_timthumb')) : ?>
			return '<?php echo GG_TT_URL ?>?src='+ encodeURIComponent(src) +'&w=100&h=100';
		<?php else : ?>
			return '<?php echo GG_URL.'/classes/easy_wp_thumbs.php' ?>?src='+ encodeURIComponent(src) +'&w=100&h=100';
		<?php endif; ?>	
	};
	
	
	// show lightbox 
	gg_throw_lb = function(gall_obj, rel, clicked_index, no_deeplink) {
		if(!Object.keys(gall_obj).length) {return false;}

		if(jQuery('#gg_lb_gall').length) {jQuery('#gg_lb_gall').empty();}
		else {jQuery('body').append('<div id="gg_lb_gall"></div>');}
		
		<?php 
		switch($lightbox) : 
			case 'lcweb' : default : // LCwb lightbox ?>
				
				<?php
				if(!get_option('gg_lb_thumbs_full_img')) {
					$tm_url = (get_option('gg_use_timthumb')) ? "'".GG_TT_URL .'?src=%URL%&w=%W%&h=%H%&q=80'."'" : "'".GG_EWPT_URL .'?src=%URL%&w=%W%&h=%H%&q=80'."'";
				} else {
					$tm_url = 'false';
				}
				
				// comments object
				switch(get_option('gg_lb_lcl_comments')) {
					
					case 'disqus' :
						$comm_obj = "{
							type 		: 'disqus',
							shortname	: '". get_option('gg_lcl_disqus_shortname', '') ."'
						}";
						break;
						
					case 'fb' :
						$style = (get_option('gg_lb_lcl_style', 'minimal') == 'light') ? 'light' : 'dark';	
						$comm_obj = "{
							type 	: 'facebook',
							style	: '". $style ."'	
						}";
						break;
					
					default :
						$comm_obj = 'false';
						break;	
				}
				?>
				
				if(typeof(gg_no_lb) != 'undefined') {
					return false;	
				}

				var sel_img = [];
				jQuery.each(Object.keys(gall_obj), function(i, v) {	
					var obj = gall_obj[v];
					var o = {
						src				: obj.img,
						title			: obj.title,
						txt				: obj.descr,
						author			: obj.author,
						canonical_url	: (<?php echo $comm_obj ?>) ? "<?php echo site_url().'?lcl_canon=' ?>" + encodeURIComponent(obj.img) : false
					};
					sel_img.push(o);
				})
				
				var lcl_obj = lc_lightbox(sel_img, {
					deeplink 		: (typeof(no_deeplink) == 'undefined') ? <?php echo (get_option('gg_lb_deeplink')) ? 'true' : 'false'; ?> : false,
					img_zoom		: <?php echo (get_option('gg_lb_zoom')) ? 'true' : 'false'; ?>,
					global_type		: 'image',
					wrap_class		: '<?php echo get_option('gg_lb_lcl_openclose', 'lcl_zoomin_oc') ?>',
					
					slideshow		: true,
					open_close_time	: <?php echo (int)get_option('gg_lb_oc_time', 500) ?>,
					animation_time	: <?php echo (int)get_option('gg_lb_time', 400) ?>,
					slideshow_time	: <?php echo (int)get_option('gg_lb_ss_time', 4000) ?>,
					autoplay		: <?php echo (!get_option('gg_lb_slideshow')) ? 'false' : 'true'; ?>,
					counter			: <?php echo (get_option('gg_lb_counter')) ? 'true' : 'false'; ?>,
					progressbar		: <?php echo (get_option('gg_lb_progressbar')) ? 'true' : 'false'; ?>,

					max_width		: '<?php echo get_option('gg_lb_max_w') ?>%',
					max_height		: '<?php echo get_option('gg_lb_max_h') ?>%',
					ol_opacity		: <?php echo ((int)get_option('gg_lb_opacity') / 100) ?>,
					ol_color		: '<?php echo get_option('gg_lb_ol_color', '#111') ?>',
					ol_pattern		: <?php echo (get_option('gg_lb_ol_pattern', 'none') == 'none') ? 'false' : "'". str_replace('pattern-', '', get_option('gg_lb_ol_pattern')) ."'"; ?>,
					border_w		: <?php echo (int)get_option('gg_lb_border_w') ?>,
					border_col		: '<?php echo get_option('gg_lb_border_col', '#666') ?>',
					padding			: <?php echo (int)get_option('gg_lb_padding') ?>,
					radius			: <?php echo (int)get_option('gg_lb_radius') ?>,
					
					shadow			: <?php echo (get_option('gg_lb_use_shadow')) ? 'true' : 'false'; ?>,
					remove_scrollbar: false,
					skin			: '<?php echo get_option('gg_lb_lcl_style', 'minimal') ?>',
					
					data_position	: '<?php echo get_option('gg_lcl_txt_pos', 'under') ?>',
					cmd_position	: '<?php echo get_option('gg_lb_cmd_pos', 'inner') ?>',
					ins_close_pos	: '<?php echo (get_option('gg_lb_corner_close')) ? 'corner' : 'normal'; ?>',
					nav_btn_pos		: '<?php echo (get_option('gg_lb_middle_nav_pos')) ? 'middle' : 'normal'; ?>',
						
					txt_hidden		: <?php echo (int)get_option('gg_lb_txt_treshold', 500) ?>,
					
					thumbs_nav		: <?php echo (!get_option('gg_lb_thumbs')) ? 'false' : 'true'; ?>,
					tn_hidden		: <?php echo (int)get_option('gg_lb_tn_treshold', 500) ?>,
					thumbs_w		: <?php echo (int)get_option('gg_lb_thumb_w', 110) ?>,
					thumbs_h		: <?php echo (int)get_option('gg_lb_thumb_h', 110) ?>,
					thumbs_maker_url: <?php echo $tm_url ?>,
					
					fullscreen		: <?php echo (!get_option('gg_lb_fullscreen')) ? 'false' : 'true'; ?>,
					fs_only			: <?php echo (int)get_option('gg_lb_fs_treshold', 500) ?>,
					
					socials			: <?php echo (!get_option('gg_lb_socials')) ? 'false' : 'true'; ?>,
					fb_direct_share	: <?php echo (!get_option('gg_lb_lcl_direct_fb')) ? 'false' : 'true'; ?>,
					
					comments		: <?php echo $comm_obj ?>,		
					download		: <?php echo (!get_option('gg_lb_download')) ? 'false' : 'true'; ?>,
					rclick_prevent	: <?php echo (get_option('gg_disable_rclick')) ? 'true' : 'false'; ?>,
					
					
					<?php if(get_option('gg_lb_download')) : ?>
					html_is_ready	: function() {
						jQuery.each(this.vars.elems, function(i,v) {
							v.download = v.src;
						});
					}
					<?php endif; ?>
				});

				if(typeof(lcl_gg_prepare) == 'undefined' || !lcl_gg_prepare || typeof(no_deeplink) != 'undefined') {
					lcl_open(lcl_obj, clicked_index);
				}
				else {
					if(typeof(lcl_gg_nulling_prepare) != 'undefined') {clearTimeout(lcl_gg_nulling_prepare);}
					lcl_gg_nulling_prepare = setTimeout(function() {
						lcl_gg_prepare = false; 
					}, 150);
				}
				
		
			<?php break;
			case 'lightcase' : // LIGHTCASE - min jQuery 1.7  ?>	
				
				jQuery.each(Object.keys(gall_obj), function(i, v) {
					var obj = gall_obj[v];
					jQuery('#gg_lb_gall').append('<a href="'+obj.img+'" title="'+obj.title+'" data-rel="lightcase:'+rel+'">'+ obj.descr +'</a>');
				});

				jQuery('#gg_lb_gall > a').lightcase({
					transition	: '<?php echo get_option('gg_lightcase_anim_behav', 'scrollHorizontal') ?>',
					speedIn		: <?php echo (int)get_option('gg_lb_time', 400) ?>,
					speedOut	: <?php echo (int)get_option('gg_lb_time', 400) ?>,
					maxWidth	: '<?php echo get_option('gg_lb_max_w') ?>%',
					maxHeight	: '<?php echo get_option('gg_lb_max_h') ?>%',
					overlayOpacity : <?php echo ((int)get_option('gg_lb_opacity') / 100) ?>,
					slideshow	: true,
					slideshowAutoStart: <?php echo (!get_option('gg_lb_slideshow')) ? 'false' : 'true'; ?>,
					timeout		: <?php echo (int)get_option('gg_lb_ss_time', 4000) ?>,
					type		: 'image'
				});
				jQuery('#gg_lb_gall > a:eq('+ clicked_index +')').trigger('click');
				jQuery('#lightcase-overlay').addClass('gg_lc_ol');

		<?php 
			break;
			case 'simplelb' : // SIMPLE LIGHTBOX - min jQuery 1.7 - doesn't work with images not specifying extension ?>	
				
				jQuery.each(Object.keys(gall_obj), function(i, v) {
					var obj = gall_obj[v];
					var txt = (obj.descr) ? '<p style="margin-bottom: 10px;"><strong>'+obj.title+'</strong></p>'+obj.descr : obj.title;
					
					jQuery('#gg_lb_gall').append('<a href="'+obj.img+'"><img src="" title="'+ gg_lb_html_fix(txt) +'"></a>');
				});

				jQuery('#gg_lb_gall > a').simpleLightbox({
					widthRatio: <?php echo (float)get_option('gg_lb_max_w', 80) / 100 ?>,
					heightRatio: <?php echo (float)get_option('gg_lb_max_h', 90) / 100 ?>,
					animationSpeed: <?php echo (int)get_option('gg_lb_time', 400) ?>,
					animationSlide: <?php echo (get_option('gg_lb_anim_behav', 'slide') == 'slide') ? 'true' : 'false'; ?>,
					disableRightClick: <?php echo (get_option('gg_disable_rclick')) ? 'true' : 'false'; ?>,
					showCounter: false,
					className: 'gg_simplelb'
				});
				
				jQuery('#gg_lb_gall > a:eq('+ clicked_index +')').trigger('click');
				jQuery('.sl-overlay').addClass('gg_simplelb');
		
		
		<?php 
			break;
		case 'tosrus' : // TOS R US - min jQuery 1.7 ?>
			
			jQuery.each(Object.keys(gall_obj), function(i, v) {
				var obj = gall_obj[v];
				var txt = (obj.descr) ? '<p style="margin-bottom: 10px;"><strong>'+obj.title+'</strong></p>'+obj.descr : obj.title;
				
				jQuery('#gg_lb_gall').append('<a href="'+obj.img+'" title="'+ gg_lb_html_fix(txt) +'"></a>');
			});

			var IE8_class = (navigator.appVersion.indexOf("MSIE 8.") != -1) ? ' tosrus_ie8' : '';
			var tosrus = jQuery('#gg_lb_gall a').tosrus({
				show: true,
				infinite : true,
				effect: '<?php echo get_option('gg_lb_anim_behav', 'slide') ?>',
				wrapper : {
					classes : 'gg_tosrus' + IE8_class
				},
				pagination : {
					add	: true,
					type	: "<?php echo (get_option('gg_lb_thumbs')) ? 'thumbnails' : 'bullets'; ?>"
				},
				slides : {
					scale : "<?php echo (get_option('gg_lb_fullscreen')) ? 'fill' : 'fit'; ?>"
				},
				caption : {add	: true},
				buttons : {
					prev : true,
					next : true,
					close: true
				},
				keys: true
			});
			tosrus.trigger("open", [clicked_index]);
		
		
		<?php 
			break;
		case 'mag_popup' : // MAGNIFIC POPUP - min jQuery 1.8 ?>
			
			var sel_img = [];
			jQuery.each(Object.keys(gall_obj), function(i, v) {	
				var obj = gall_obj[v];
				var txt = (obj.descr) ? '<p style="margin-bottom: 10px;"><strong>'+obj.title+'</strong></p>'+obj.descr : obj.title;
				
				var o = {'src' : obj.img, 'type' : 'image', 'title' : txt};
                sel_img.push(o);
			});
			
			jQuery.magnificPopup.open({
				tLoading: '<span class="gg_mag_popup_loader"></span>',
				mainClass: 'gg_mp',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [1,1]
				},
				callbacks: {
					beforeClose: function() {
					  jQuery('body').find('.mfp-figure').stop().fadeOut(300);
					},
					updateStatus: function(data) {
						jQuery('body').find('.mfp-figure').stop().fadeOut(300);
					},
					imageLoadComplete: function() {
						jQuery('body').find('.mfp-figure').stop().fadeIn(300);
						
						if(typeof(ggmp_size_check) != 'undefined' && ggmp_size_check) {clearTimeout(ggmp_size_check);}
						ggmp_size_check = setTimeout(function() {
							var lb_h = jQuery('body').find('.mfp-content').outerHeight();
							var win_h = jQuery(window).height();
							
							if(win_h < lb_h) {
								var diff = lb_h - win_h; 
								var img_h = jQuery('body').find('.mfp-img').height() - diff;	
								
								if(navigator.appVersion.indexOf("MSIE 8.") == -1) { jQuery('body').find('.mfp-img').clearQueue().animate({'maxHeight': img_h}, 350); }
								else { jQuery('body').find('.mfp-img').clearQueue().css('max-height', img_h); } 
							}
							
							ggmp_size_check = false
						}, 50);
					},
				},
			 	items: sel_img
			});
			
			var gg_magnificPopup = jQuery.magnificPopup.instance;
			gg_magnificPopup.goTo(clicked_index);
		
		
		<?php 
			break;
		case 'imagelb' : // imageLightbox - min jQuery 1.7 - doesn't work with images not specifying extension ?>
			
			var uniqid = new Date().getTime();
			jQuery.each(Object.keys(gall_obj), function(i, v) {
				var obj = gall_obj[v];
				var txt = (obj.descr) ? '<p style="margin-bottom: 10px;"><strong>'+obj.title+'</strong></p>'+obj.descr : obj.title;
				
				jQuery('#gg_lb_gall').append('<a href="'+obj.img+'" rel="'+uniqid+'" style="display: none;"><img src="" alt="'+ gg_lb_html_fix(txt) +'" /></a>');
			});

			var selectorF = '#gg_lb_gall a[rel='+uniqid+']';
			var instanceF = jQuery( selectorF ).imageLightbox({
				animationSpeed	:	<?php echo (int)get_option('gg_lb_time', 400) ?>,
				onStart			:	function() { gg_overlayOn(); gg_closeButtonOn( instanceF ); gg_arrowsOn( instanceF, selectorF ); },
				onEnd			:	function() { gg_overlayOff(); gg_captionOff(); gg_closeButtonOff(); gg_arrowsOff(); gg_activityIndicatorOff(); },
				onLoadStart		: 	function() { gg_captionOff(); gg_activityIndicatorOn(); },
				onLoadEnd		: 	function() { gg_captionOn(); gg_activityIndicatorOff(); jQuery('.imagelightbox-arrow' ).css( 'display', 'block' ); }
			});
			
			jQuery('#gg_lb_gall > a:eq('+ clicked_index +')').trigger('click');
		
		
		<?php 
			break;
		case 'photobox' :  // PHOTOBOX - min jQuery 1.7 ?>
				
			jQuery.each(Object.keys(gall_obj), function(i, v) {
				var obj = gall_obj[v];
				var txt = (obj.descr) ? obj.title+' - '+obj.descr : obj.title;

				jQuery('#gg_lb_gall').append('<a href="'+ obj.img +'"><img src="'+ gg_lb_thumb(obj.img) +'" title="'+ txt +'" /></a>');
			});
		
			if(typeof(gg_ptb_executed) != 'undefined') {jQuery('#gg_lb_gall').photobox('destroy');}
			gg_ptb_executed = true;
			
			jQuery('#gg_lb_gall').photobox('a',{ 
				time: <?php echo (int)get_option('gg_lb_ss_time', 4000) ?>,
				history: false,
				loop: true,
				rotatable: false,
				zoomable: <?php echo (!get_option('gg_photobox_zoom')) ? 'false' : 'true'; ?>, 
				thumbs: <?php echo (!get_option('gg_lb_thumbs')) ? 'false' : 'true'; ?>, 
				autoplay: <?php echo (!get_option('gg_lb_slideshow')) ? 'false' : 'true'; ?> 
			});
			
			jQuery('#gg_lb_gall a:eq('+ clicked_index +')').trigger('mouseenter.photobox');
			jQuery('#gg_lb_gall a:eq('+ clicked_index +')').trigger('click');
			
		<?php
			break;	
		case 'fancybox' :  // FANCYBOX ?>
				
			var sel_img = [];
			jQuery.each(Object.keys(gall_obj), function(i, v) {	
				var obj = gall_obj[v];
				var txt = (obj.descr) ? '<p style="margin-bottom: 10px;"><strong>'+obj.title+'</strong></p>'+obj.descr : obj.title;
				
				var o = {'href' : obj.img, 'title' : txt};
                sel_img.push(o);
			});
		
			jQuery.fancybox(sel_img, {
				'titlePosition': '<?php echo (get_option('gg_lb_txt_pos') == 'standard') ? 'inside' : 'over' ?>',
				'type': 'image',
				'padding': <?php echo (int)get_option('gg_lb_padding') ?>,
				'changeSpeed': <?php echo (int)get_option('gg_lb_time') ?>,
				'overlayOpacity': <?php echo ((int)get_option('gg_lb_opacity') / 100) ?>,
				'overlayColor': '<?php echo get_option('gg_lb_ol_color') ?>',
				'centerOnScroll' : true,
				'cyclic': true,
				'index': clicked_index,
				'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
					var counter = '<p style="margin: 0;"><small>'+ (currentIndex + 1) + '/' + currentArray.length +'</small></p>';
					
					<?php if(get_option('gg_lb_txt_pos') == 'standard'): ?>
						return '<span id="fancybox-title-inside">'+ title + counter +'</span>';
					<?php else: ?>
		    			return '<span id="fancybox-title-over">'+ title + counter +'</span>';
					<?php endif; ?>
				}
			}); 			
			
			
		<?php
			break;
		case 'colorbox' :  // COLORBOX ?>
				
			jQuery.each(Object.keys(gall_obj), function(i, v) {
				var obj = gall_obj[v];
				jQuery('#gg_lb_gall').append('<a href="'+obj.img+'" title="'+obj.title+'" text="'+ obj.descr +'" rel="group_'+rel+'" class="group_'+rel+'"></a>');	
			});
		
			jQuery('#gg_lb_gall a').colorbox({
				rel: 'group_'+rel,
				returnFocus: false,
				scrolling : false,
				
				opacity: <?php echo ((int)get_option('gg_lb_opacity') / 100) ?>,
				speed: <?php echo (int)get_option('gg_lb_time') ?>,
				maxWidth: '<?php echo get_option('gg_lb_max_w') ?>%',
				maxHeight: '<?php echo get_option('gg_lb_max_h') ?>%',
				slideshow: true,
				slideshowSpeed:	<?php echo (int)get_option('gg_lb_ss_time') ?>,
				slideshowAuto: <?php echo (!get_option('gg_lb_slideshow')) ? 'false' : 'true'; ?>
			});
			
			jQuery('#gg_lb_gall a:eq('+ clicked_index +')').trigger('click');
		
		<?php
			break;
		case 'prettyphoto' :  // PRETTYPHOTO ?>

			var api_img = [];
			var api_tit = [];
			var api_descr = [];
			
			jQuery.each(Object.keys(gall_obj), function(i, v) {
				var obj = gall_obj[v];
				
				api_img.push( obj.img );
				api_tit.push( obj.title );
				api_descr.push( obj.descr );
			});
			
		
			jQuery.fn.prettyPhoto({
				opacity: <?php echo ((int)get_option('gg_lb_opacity') / 100) ?>,
				autoplay_slideshow: <?php echo (!get_option('gg_lb_slideshow')) ? 'false' : 'true'; ?>,
				animation_speed: <?php echo (int)get_option('gg_lb_time') ?>,
				slideshow: <?php echo (int)get_option('gg_lb_ss_time') ?>,
				allow_expand: false,
				deeplinking: false,
				horizontal_padding: 17,
				ie6_fallback: false
				<?php if(!get_option('gg_lb_socials')) : ?>
				,social_tools: ''
				<?php endif; ?>
			});
		
			jQuery.prettyPhoto.open(api_img, api_tit, api_descr);
			jQuery.prettyPhoto.changePage(clicked_index);
		
		
		<?php
			break;
		endswitch; ?>
	};
	</script>
	<?php
}
add_action('wp_footer', 'gg_lightboxes_footer', 999);

