(function($) {
	var gg_gallery_w 		= []; // galleries width wrapper
	var gg_img_margin 		= []; // gallery images margin 
	var gg_img_border 		= []; // know border width for each gallery
	var gg_gallery_pag 		= []; // know which page is shown for each gallery
	var gg_gall_pag_cache	= []; // cache gallery pages to avoid double ajax calls
	var gg_gall_curr_filter = []; // cache matched image indexes derived from a filter (empty == no filter)
	
	var gg_first_init 		= []; // flag for initial gallery management
	var gg_new_images 		= []; // flag for new images added
	var gg_is_paginating	= []; // flag for pagination animation
	var gg_gall_is_showing 	= []; // showing animation debouncer
	var gg_shown_gall 		= []; // shown gallery flag
	var gg_debounce_resize	= []; // reesize trigger debounce for every gallery 
	
	var coll_ajax_obj 		= []; // where to store ajax objects to abort ajax calls
	var coll_gall_cache		= []; // store ajax-called galleries to avoid double ajax calls
	var coll_scroll_helper	= []; // store collection item clicked to return at proper scroll point
	
	// photostring manag - global vars
	var gg_temp_w 			= [];
	var gg_row_img 			= [];
	var gg_row_img_w 		= []; 
	
	// CSS3 loader code
	gg_loader = 
	'<div class="gg_loader">'+
		'<div class="ggl_1"></div><div class="ggl_2"></div><div class="ggl_3"></div><div class="ggl_4"></div>'+
	'</div>';
	
	
	// on init
	$(document).ready(function() {
		gg_get_cg_deeplink();
		
		// if old IE, hide secondary overlay
		if(gg_is_old_IE()) {$('.gg_sec_overlay').hide();}
	});
	
	
	// initialize the galleries
	gg_galleries_init = function(gid, after_resize) {
		// if need to initialize a specific gallery
		if(typeof(gid) != 'undefined' && gid) {
			if(!$('#'+gid).length) {return false;}
			
			if(typeof(after_resize) == 'undefined') {
				gg_first_init[gid] = 1;
				gg_new_images[gid] = 1;
				gg_is_paginating[gid] = 0;
			}
			
			gg_pagenum_btn_vis(gid);
			gg_gallery_process(gid, after_resize);
		}
		
		// execute every gallery in the page
		else {
			$('.gg_gallery_wrap').not(':empty').each(function() {
				var gg_gid = $(this).attr('id');
				gg_galleries_init(gg_gid, after_resize);
			}); 
		}
	};
	
	
	// store galleries info 
	gg_gallery_info = function(gid, after_resize) {
		var coll_sel = ($('#'+gid).hasClass('gg_collection_wrap')) ? '.gg_coll_container' : '';
		gg_gallery_w[gid] = (coll_sel) ? $('#'+gid+' .gg_coll_container').width() : $('#'+gid).width(); 

		if(typeof(after_resize) != 'undefined') {return true;} // only get size if resize event has been triggered
		
		gg_img_border[gid] = parseInt( $('#'+gid+' '+coll_sel+' .gg_img').first().css('border-right-width'));
		gg_img_margin[gid] = parseInt( $('#'+gid+' '+coll_sel+' .gg_img').first().css('margin-right')); 

		// exceptions for isotope elements
		if($('#'+gid).hasClass('gg_masonry_gallery')) {
			gg_img_margin[gid] = parseInt( $('#'+gid+' '+coll_sel+' .gg_img').first().css('padding-right')); 
		}
		else if($('#'+gid).hasClass('gg_collection_wrap')) {
			gg_img_margin[gid] = parseInt( $('#'+gid+' '+coll_sel+' .gg_coll_img_wrap').first().css('padding-right')); 			
		}
	};
	
	
	// process single gallery
	gg_gallery_process = function(gid, after_resize) {	
		if(typeof(gid) == 'undefined') {return false;}	
		
		gg_gallery_info(gid, after_resize);

		
		if( $('#'+gid).hasClass('gg_standard_gallery') ) {
			gg_man_standard_gallery(gid);	
		}
		else if( $('#'+gid).hasClass('gg_columnized_gallery') ) {
			gg_man_colnzd_gallery(gid);
		}
		else if( $('#'+gid).hasClass('gg_masonry_gallery') ) {
			gg_man_masonry_gallery(gid);
		}
		else if( $('#'+gid).hasClass('gg_string_gallery') ) {
			gg_man_string_gallery(gid);	
		}	
		else if( $('#'+gid).hasClass('gg_collection_wrap') ) {
			gg_man_collection(gid);	
		}	
		
		
		// OVERLAY MANAGER ADD-ON //
		if(typeof(ggom_hub) == "function") {
			ggom_hub(gid);
		}
		////////////////////////////
	};
	
	
	// get lazyload parameter and set it as image URL
	var lazy_to_img_url = function(subj_id, is_coll) {
		$subj = (typeof(is_coll) == 'undefined') ? $('#'+subj_id+ ' .gg_main_thumb') : $('#'+subj_id+ ' .gg_coll_outer_container .gg_main_thumb');
		
		$subj.each(function() {
			if($(this).data('gg-lazy-src') != 'undefined') {
				$(this).attr('src', $(this).data('gg-lazy-src'));
				$(this).removeAttr('gg-lazy-src');
			}
		});
	};
	
	
	
	/*** manage standard gallery ***/
	gg_man_standard_gallery = function(gid) {
		if(!$('#'+gid+' .gg_img').length) {return false;}
		lazy_to_img_url(gid);
		
		if(gg_new_images[gid]) {
			$('#'+gid+' .gg_img .gg_main_thumb').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					$('#'+gid+' .gg_loader').fadeOut('fast');
					gg_img_fx_setup(gid, width_arr, height_arr);
					
					$('#'+gid+' .gg_img').each(function(i) {
						$(this).addClass(gid+'-'+i).css('width', (width_arr[0] + gg_img_border[gid] * 2)); // set fixed width to allow CSS fx during filter
						
						var $to_display = $('#'+gid+' .gg_img').not('.gg_shown');
						if(i == 0) {
							gg_gallery_slideDown(gid, $to_display.not('.gg_excluded_img').length);
						}
						
						if(i == ($('#'+gid+' .gg_img').length - 1)) {
							$to_display.gg_display_images(gid);
						}	
					});
					gg_new_images[gid] = 0;
					
					$(window).trigger('gg_loaded_gallery', [gid]);
				}
			});
		}
		
		gg_check_primary_ol(gid);	
	}
	
	
	
	/*** manage columnized gallery ***/
	gg_man_colnzd_gallery = function(gid) {
		
		if(!$('#'+gid+' .gg_img').length) {return false;}
		lazy_to_img_url(gid);
		
		var cols = calc_colnzd_cols(gid);
		$('#'+gid+' .gg_container').css('width', 'calc(100% + '+ gg_img_margin[gid] +'px + '+ cols +'px)');
		$('#'+gid+' .gg_img').css('width', 'calc('+ (100 / cols) +'% - '+ gg_img_margin[gid] +'px - 1px)');	

		gg_check_primary_ol(gid);

		if(gg_new_images[gid]) {
			$('#'+gid+' .gg_img .gg_main_thumb').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					
					$('#'+gid+' .gg_loader').fadeOut('fast');
					gg_img_fx_setup(gid, width_arr, height_arr);
					
					$('#'+gid+' .gg_img').each(function(i) {
						$(this).addClass(gid+'-'+i);
						
						var $to_display = $('#'+gid+' .gg_img').not('.gg_shown');
						if(i == 0) {
							gg_gallery_slideDown(gid, $to_display.not('.gg_excluded_img').length);
						}
						if(i == ($('#'+gid+' .gg_img').length - 1)) {
							$to_display.gg_display_images(gid);
						}	
					});
					gg_new_images[gid] = 0;
					
					$(window).trigger('gg_loaded_gallery', [gid]);
				}
			});
		}
		
		gg_check_primary_ol(gid);	
	};
	
	
	// returns how many columns will gallery needs to show
	var calc_colnzd_cols = function(gid) {
		var tot_w = gg_gallery_w[gid] - gg_img_margin[gid];
		
		// calculate how many columns to show starting from 1
		var cols = 1;
		var col_w = tot_w;
		var max_w = parseInt($('#'+gid).data('col-maxw'));
		
		while(col_w >= max_w) {
			cols++;
			col_w = Math.round(tot_w / cols) - gg_img_margin[gid];	
		}

		return cols;
	};
	
	

	/*** manage masonry gallery ***/
	gg_man_masonry_gallery = function(gid) {
		lazy_to_img_url(gid);
		
		var cols = parseInt($('#'+gid).data('col-num')); 
		var margin = gg_img_margin[gid];
		var col_w = Math.floor((gg_gallery_w[gid] + margin) / cols);
		
		// custom min width?
		var min_w = (typeof($('#'+gid).data('minw')) != 'undefined') ? parseInt($('#'+gid).data('minw')) : gg_masonry_min_w;
		
		// find out right column number
		while(col_w < min_w) {
			if(cols <= 1) {
				cols = 1;
				return false; 
			}
			
			cols--;
			col_w = Math.floor((gg_gallery_w[gid] + margin) / cols);
		}

		$('#'+gid+' .gg_img').each(function(i) {
			var img_class = gid+'-'+i;
			$(this).css('width', col_w).addClass(img_class);
		});	
		
		
		// if is smaller than wrapper - center items
		var diff = gg_gallery_w[gid] + margin - (cols * col_w);
		if(diff > 0) {
			$('#'+gid+' .gg_container').css('left', Math.floor(diff / 2));	
		}


		
		
		gg_check_primary_ol(gid);
		

		if(gg_new_images[gid]) {
			$('#'+gid+' .gg_img:not(.gg_excluded_img) .gg_main_thumb').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					$('#'+gid+' .gg_loader').fadeOut('fast');
					gg_img_fx_setup(gid, width_arr, height_arr);
					
					$('#'+gid+' .gg_container').isotope({
						percentPosition	: true,
						isResizeBound	: false,
						resize			: false,
						originLeft		: !gg_rtl,
						masonry			: {
							columnWidth: 1
						},
						containerClass	: 'gg_isotope',	
						itemClass 		: 'gg_isotope-item',
						itemSelector	: '.gg_img',
						transitionDuration : 0,
					});
					
					setTimeout(function() { // litle delay to allow masonry placement
						var $to_display = $('#'+gid+' .gg_img').not('.gg_shown');
						
						gg_gallery_slideDown(gid, $to_display.not('.gg_excluded_img').length);
						$to_display.gg_display_images(gid);	
						
						gg_new_images[gid] = 0;
						$(window).trigger('gg_loaded_gallery', [gid]);
					}, 300);
				}
			});
		}
		else {
			setTimeout(function() {
				if(typeof($.Isotope) != 'undefined' && typeof($.Isotope.prototype.reLayout) != 'undefined') { // old Isotope
					$('#'+gid+' .gg_container').isotope('reLayout');
				} else { // new
					$('#'+gid+' .gg_container').isotope('layout');
				}
			}, 100);
		}
	}
	
	
	
	/*** manage photostring gallery ***/
	gg_man_string_gallery = function(gid, filter_relayout) {
		lazy_to_img_url(gid);
		
		if(gg_new_images[gid]) {
			$('#'+gid+' .gg_img .gg_main_thumb').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					
					gg_img_fx_setup(gid, width_arr, height_arr);
					layout_photostr_gall(gid, filter_relayout);
					
					$('#'+gid+' .gg_loader').fadeOut('fast');		
						
					var $to_display = $('#'+gid+' .gg_img').not('.gg_shown');
					gg_gallery_slideDown(gid, $to_display.not('.gg_excluded_img').length);
					$to_display.gg_display_images(gid);

					
					gg_new_images[gid] = 0;
					$(window).trigger('gg_loaded_gallery', [gid]);
				}
			});
		}
		else {
			layout_photostr_gall(gid, filter_relayout);
		}
		
		gg_check_primary_ol(gid);
	};
	
	var layout_photostr_gall = function(gid, filter_relayout) {
		
		// is re-layouting because of a filter? match the fakebox
		if(typeof(filter_relayout) != 'undefined') {
			var selector = filter_relayout +' .gg_img .gg_main_thumb';
			gid = filter_relayout.replace('#gg_fakebox_', '');
		} 
		else {
			var selector = '#'+gid+' .gg_img:not(.gg_excluded_img) .gg_main_thumb';	
		}
		
		gg_temp_w[gid] 		= 0;
		gg_row_img[gid] 	= [];
		gg_row_img_w[gid] 	= [];
		
		// sometimes browsers have bad behavior also using perfect width fit
		var container_w = gg_gallery_w[gid] + gg_img_margin[gid];

		$(selector).each(function(i, v) {
			var $img_obj = $(this).parents('.gg_img');
			var img_class = gid+'-'+ $img_obj.data('img-id');
			var w_to_match = 0;

			// reset sizes
			$img_obj.css('width', ($(this).width() - 2)).css('maxWidth', ($(this).width() + gg_img_border[gid]));

		 	$img_obj.addClass(img_class);
			var img_w = ($(this).width() - 2) + gg_img_border[gid] + gg_img_margin[gid]; // subtract 2 pixels to avoid empty bars on sides in rare extensions 
				
			gg_row_img[gid].push('.'+img_class);
			gg_row_img_w[gid].push(img_w);
			
			gg_temp_w[gid] = gg_temp_w[gid] + img_w;
			w_to_match = gg_temp_w[gid];
			
			// if you're lucky and size is perfect
			if(container_w == w_to_match) { 
				gg_row_img[gid] 	= [];
				gg_row_img_w[gid] 	= [];
				gg_temp_w[gid] 		= 0;
			}
			
			// adjust img sizes		
			else if(container_w < w_to_match) {
				var to_shrink = w_to_match - container_w;
				photostr_row_img_shrink(gid, to_shrink, container_w);  
				
				gg_row_img[gid] 	= [];
				gg_row_img_w[gid] 	= [];
				gg_temp_w[gid] 		= 0;
			}
		});
	};
	
	
	var photostr_row_img_shrink = function(gid, to_shrink, container_w) {
		var remaining_shrink = to_shrink;
		var new_row_w = 0;

		// custom min width?
		var min_w = (typeof($('#'+gid).data('minw')) != 'undefined') ? parseInt($('#'+gid).data('minw')) : gg_phosostr_min_w;
		
		// only one image - set to 100% width
		if(gg_row_img[gid].length == 1) {
			$(gg_row_img[gid][0]).css('width', 'calc(100% - '+ (gg_img_margin[gid] + 1) +'px)'); // +1 == security margin added previously
			return true;
		}
		
		// calculate
		var curr_img_w_arr = gg_row_img_w[gid];
		var reached_min = [];
		var extreme_shrink_done = false

		a = 0; // security stop
		while(ps_row_img_w(curr_img_w_arr) > container_w && !extreme_shrink_done && a < 100) {
			a++;

			var to_shrink_per_img = Math.ceil( remaining_shrink / (gg_row_img[gid].length - reached_min.length));
			var new_min_reached = false;
			
			// does this reduce too much an element? recalculate
			$.each(gg_row_img_w[gid], function(i, img_w) {
				if($.inArray(i, reached_min) !== -1) {
					return true;	
				}
				
				var new_w = img_w - to_shrink_per_img;
				if(new_w < min_w) {
					new_w = min_w;
					
					// min is greater than images width?
					var true_img_w = ($(gg_row_img[gid][i]).find('.gg_main_thumb').width() - 2) + gg_img_border[gid]; // subtract 2 pixels to avoid empty bars on sides in rare extensions 
					if(new_w > true_img_w) {
						new_w = true_img_w;
					}
					
					reached_min.push(i);	
					new_min_reached = true;
					
					remaining_shrink = remaining_shrink - (gg_row_img_w[gid][i] - new_w);
				}
			});
			if(new_min_reached) {continue;}


			// calculate new width for every image
			$.each(gg_row_img_w[gid], function(i, img_w) {
				if($.inArray(i, reached_min) !== -1) {
					return true;	
				}
				gg_row_img_w[gid][i] = img_w - to_shrink_per_img;
			});
			
			curr_img_w_arr = gg_row_img_w[gid];
			remaining_shrink = ps_row_img_w(curr_img_w_arr) - container_w;	
				
			
			// if every image reached the minimum - split the remaining between them
			if(reached_min.length >= gg_row_img[gid].length) {
				to_shrink_per_img = Math.ceil( remaining_shrink / gg_row_img[gid].length);
				
				$.each(gg_row_img_w[gid], function(i, img_w) {
					gg_row_img_w[gid][i] = img_w - to_shrink_per_img;	
				});
				
				extreme_shrink_done = true;
			}	
			
			curr_img_w_arr = gg_row_img_w[gid];	
		}

		
		// apply new width
		$.each(gg_row_img[gid], function(i, img_selector) {
			$(img_selector).css('width', gg_row_img_w[gid][i] - gg_img_margin[gid]);	
		});
		
		
		// overall width is smaller than container? enlarge the first useful image
		var diff = container_w - ps_row_img_w(gg_row_img_w[gid]);
		if(diff > 0) {
			
			$.each(gg_row_img[gid], function(i, img_selector) {	
				
				if($.inArray(i, reached_min) === -1 || i == (gg_row_img[gid].length - 1)) { // extrema ratio - last element will be enlarged if everyone already reached the maximum
					
					$(img_selector).css('width', gg_row_img_w[gid][i] - gg_img_margin[gid] + diff);	
					return false;	
				}
			});
		}
	};
	
	// gived an array of selectors - return the overall elements width
	var ps_row_img_w = function(img_w_array) {
		var tot_w = 0;
		$.each(img_w_array, function(i,img_w) {
			tot_w = tot_w + parseFloat(img_w);	
		});
		
		return tot_w;
	};
	
	
	
	
	
	/*** manage collection ***/
	gg_man_collection = function(cid) {
		lazy_to_img_url(cid, true);

		var cols = calc_coll_cols(cid);
		$('#'+cid+' .gg_coll_container').css('width', 'calc(100% + '+ gg_img_margin[cid] +'px + '+ cols +'px)');
		$('#'+cid+' .gg_coll_img_wrap').css('width', 'calc('+ (100 / cols) +'% - 1px)');	

		if(gg_rtl) {
			$('#'+cid+' .gg_coll_container').css('left', cols * -1);	
		}

		gg_check_primary_ol(cid);
		
		if(!gg_shown_gall[cid]) {
			$('#'+cid+' .gg_coll_img .gg_main_thumb').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					$('#'+cid+' .gg_loader').fadeOut('fast');
					gg_img_fx_setup(cid, width_arr, height_arr);
					
					
					$('#'+cid+' .gg_coll_img').each(function(i) {
						var img_class = cid+'-'+i;
						$(this).addClass(img_class);
					});
					
					$('#'+cid+' .gg_coll_container').isotope({
						layoutMode 		: 'fitRows',
						percentPosition	: true,
						isResizeBound	: false,
						resize			: false,
						originLeft		: !gg_rtl,
						containerClass	: 'gg_isotope',	
						itemClass 		: 'gg_isotope-item',
						itemSelector	: '.gg_coll_img_wrap',
						transitionDuration: '0.6s',
						filter: (typeof(gg_coll_dl_filter) != 'undefined') ? '.ggc_'+gg_coll_dl_filter : ''
					});
					
					setTimeout(function() { // litle delay to allow masonry placement
						var $to_display = $('#'+cid+' .gg_coll_img_wrap').not('.gg_shown');
						
						gg_gallery_slideDown(cid, $to_display.length);
						$to_display.gg_display_images();
							
						gg_new_images[cid] = 0;
						$(window).trigger('gg_loaded_collection', [cid]);
					}, 300);
				}
			});
		}
		else {
			setTimeout(function() {
				if(typeof($.Isotope) != 'undefined' && typeof($.Isotope.prototype.reLayout) != 'undefined') { // old Isotope
					$('#'+cid+' .gg_container').isotope('reLayout');
				} else { // new
					$('#'+cid+' .gg_container').isotope('layout');
				}
			}, 300);
		}	
	};
	
	
	// returns how many columns will collection needs to show
	var calc_coll_cols = function(cid) {
		var tot_w = gg_gallery_w[cid] - gg_img_margin[cid];
		
		// calculate how many columns to show starting from 1
		var cols = 1;
		var col_w = tot_w;
		
		while(col_w >= gg_coll_max_w) {
			cols++;
			col_w = Math.round(tot_w / cols) - gg_img_margin[cid];	
		}

		return cols;
	};
	
	
	////////////////////////////////////////////////////////////////
	

	// load a collection gallery - click trigger
	$(document).ready(function() {
		$('body').delegate('.gg_coll_img:not(.gg_linked_img)', 'click', function() {
			var cid = $(this).parents('.gg_collection_wrap').attr('id');
			var gdata = $(this).data('gall-data');
			var gid = $(this).attr('rel');
			
			if(typeof(coll_ajax_obj[cid]) == 'undefined' || !coll_ajax_obj[cid]) {
				gg_set_deeplink('coll-gall', gid);
				gg_load_coll_gallery(cid, gdata);
			}
		});
	});
	
	// load collection's gallery 
	gg_load_coll_gallery = function(cid, gdata) {
		var curr_url = $(location).attr('href');
		if(typeof(coll_gall_cache[cid]) == 'undefined') {
			coll_gall_cache[cid] = [];	
		}
		
		// set trigger to return at proper scroll point
		coll_scroll_helper[cid] = $('#'+cid+' .gg_coll_img[data-gall-data="'+gdata+'"]');
		
		// prepare
		if( $('#'+cid+' .gg_coll_gallery_container .gg_gallery_wrap').length) {
			$('#'+cid+' .gg_coll_gallery_container .gg_gallery_wrap').remove();	
			$('#'+cid+' .gg_coll_gallery_container').append('<div class="gg_gallery_wrap">'+ gg_loader +'</div>');
		}
		$('#'+cid+' .gg_coll_gallery_container .gg_gallery_wrap').addClass('gg_coll_ajax_wait');
	
		$('#'+cid+' > table').animate({'left' : '-100%'}, 700, function() {
			$('#'+cid+' .gg_coll_table_first_cell').css('opacity', 0);	
		});
		
		// set absolute position to keep just shown gallery's height
		setTimeout(function() {
			$('#'+cid+' .gg_coll_table_first_cell').css('position', 'absolute');
		}, 710);
		
		// scroll to the top of the collection - if is lower of the gallery top
		var coll_top_pos = $('#'+cid).offset().top;
		if( $(window).scrollTop() > coll_top_pos ) {
			$('html, body').animate({'scrollTop': coll_top_pos - 15}, 600);
		}

		// check in stored cache
		if(typeof(coll_gall_cache[cid][gdata]) != 'undefined') {
			fill_coll_gallery(cid, coll_gall_cache[cid][gdata]);
		}
		else {
			var data = {
				gg_type: 'gg_load_coll_gallery',
				cid: cid,
				gdata: gdata
			};
			coll_ajax_obj[cid] = $.post(curr_url, data, function(response) {
				coll_gall_cache[cid][gdata] = response;
				fill_coll_gallery(cid, response);
				
				// LC lightbox - deeplink
				if(typeof(gg_lcl_allow_deeplink) != 'undefined') {
					gg_lcl_allow_deeplink();
				}
			});	
		}
	}
	
	// given gallery data (through ajax or cache) - show it
	var fill_coll_gallery = function(cid, gall_data) {
		$('#'+cid+' .gg_coll_gallery_container .gg_gallery_wrap').remove();
		$('#'+cid+' .gg_coll_gallery_container').removeClass('gg_main_loader').append(gall_data);
		
		if($('#'+cid+' .gg_coll_gall_title').length > 1) {
			$('#'+cid+' .gg_coll_gall_title').first().remove();
		}
		
		gg_coll_gall_title_layout(cid);
		coll_ajax_obj[cid] = null;
		
		var gid = $('#'+cid+' .gg_coll_gallery_container').find('.gg_gallery_wrap').attr('id');
		gg_galleries_init(gid);
	};
	
	
	// collections title - mobile check
	gg_coll_gall_title_layout = function(cid) {
		$('#'+cid+' .gg_coll_gall_title').each(function() {
            var wrap_w = $(this).parents('.gg_coll_table_cell').width();
			var elem_w = $(this).parent().find('.gg_coll_go_back').outerWidth(true) + $(this).outerWidth();
			
			if(elem_w > wrap_w) {$(this).addClass('gg_narrow_coll');}
			else {$(this).removeClass('gg_narrow_coll');}
        });	
	}
	
	
	// back to collection
	$(document).ready(function() {
		$('body').delegate('.gg_coll_go_back', 'click', function() {
			var cid = $(this).parents('.gg_collection_wrap').attr('id');
			
			// if is performing ajax - abort
			if(typeof(coll_ajax_obj[cid]) != 'undefined' && coll_ajax_obj[cid]) {
				coll_ajax_obj[cid].abort();
				coll_ajax_obj[cid] = null;	
			}
			
			// scroll to previously clicked item only if it is out of screen
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();
			
			var elemTop = coll_scroll_helper[cid].offset().top;
			var elemBottom = elemTop + coll_scroll_helper[cid].height();
		
			if((elemBottom > docViewBottom) || elemTop < docViewTop) {
				var coll_top_pos = coll_scroll_helper[cid].offset().top - 60;
				$('html, body').animate({'scrollTop': coll_top_pos}, 600);	
			}
			
			// go back
			$('#'+cid+' .gg_coll_table_first_cell').css('opacity', 1).css('position', 'static');		
			$('#'+cid+' > table').animate({'left' : 0}, 700);
			
			setTimeout(function() {
				$('#'+cid +' .gg_coll_gallery_container > *').not('.gg_coll_go_back').remove(); 
			}, 700);
			
			gg_clear_deeplink();
		});
	});
	
	
	// manual collections filter - handlers
	$(document).ready(function() {
		$('body').delegate('.gg_filter a', 'click', function(e) {
			e.preventDefault();
			
			var cid = $(this).parents('.gg_filter').attr('id').substr(4);
			var sel = $(this).attr('rel');
			var cont_id = '#' + $(this).parents('.gg_collection_wrap').attr('id');

			$('#ggf_'+cid+' a').removeClass('gg_cats_selected');
			$(this).addClass('gg_cats_selected');	
	
			gg_coll_manual_filter(cid, sel, cont_id);
			
			// if there's a dropdown filter - select option 
			if( $('#ggmf_'+cid).length ) {
				$('#ggmf_'+cid+' option').removeAttr('selected');
				
				if($(this).attr('rel') !== '*') {
					$('#ggmf_'+cid+' option[value='+ $(this).attr('rel') +']').attr('selected', 'selected');
				}
			}
		});
		
		$('body').delegate('.gg_coll_table_cell .gg_mobile_filter_dd', 'change', function(e) {
			var cid = $(this).parents('.gg_mobile_filter').attr('id').substr(5);
			var sel = $(this).val();
			var cont_id = '#' + $(this).parents('.gg_collection_wrap').attr('id');
			
			gg_coll_manual_filter(cid, sel, cont_id);
			
			// select related desktop filter's button
			var btn_to_sel = ($(this).val() == '*') ? '.ggf_all' : '.ggf_id_'+sel
			$('#ggf_'+cid+' a').removeClass('gg_cats_selected');
			$('#ggf_'+cid+' '+btn_to_sel).addClass('gg_cats_selected');
		});
	});
	
	
	// manual collections filter - perform
	var gg_coll_manual_filter = function(cid, sel, cont_id) {
		
		// set deeplink
		if ( sel !== '*' ) { gg_set_deeplink('cat', sel); }
		else { gg_clear_deeplink(); }

		if ( sel !== '*' ) { sel = '.ggc_' + sel;}
		$(cont_id + ' .gg_coll_container').isotope({ filter: sel });
	};
	
	
	/////////////////////////////////////////////////
	// show gallery/collection images (selection = attribute to use recursively to filter images to show)
	
	$.fn.gg_display_images = function(gid, selection) {
	
		// no gid == collection | if no selection, check whether to show before filtered 
		if(typeof(gid) != 'undefined' && typeof(gg_gall_curr_filter[gid]) != 'undefined' && gg_gall_curr_filter[gid] && typeof(selection) == 'undefined') {
			
			this.gg_display_images(gid, ':not(.gg_excluded_img)');
			this.gg_display_images(gid, '.gg_excluded_img');
			return true;	
		}
		
		// apply some filter?
		var $subj = (typeof(selection) == 'undefined') ? this : $(this).filter(selection);

		// show		
		$subj.each(function(i, v) {
			var $subj = $(this);
			var delay = (typeof(gg_delayed_fx) != 'undefined' && gg_delayed_fx) ? 170 : 0;

			setTimeout(function() {
				if( navigator.appVersion.indexOf("MSIE 8.") != -1 || navigator.appVersion.indexOf("MSIE 9.") != -1 ) {
					$subj.fadeTo(450, 1);	
				}
				$subj.addClass('gg_shown');
			}, (delay * i));
		});
	};
	
	
	// remove loaders and slide down gallery
	gg_gallery_slideDown = function(gid, img_num, is_collection) {
		if(typeof(gg_gall_is_showing[gid]) != 'undefined' && gg_gall_is_showing[gid]) {
			return false;	
		}

		var fx_time = img_num * 200;
		var $subj = (typeof(is_collection) == 'undefined') ? $('#'+gid+' .gg_container') : $('#'+gid+' .gg_coll_container');

		$subj.animate({"min-height": 80}, 300, 'linear').animate({"max-height": 9999}, 6500, 'linear');		
		gg_gall_is_showing[gid] = setTimeout(function() {
			if( // fix for old safari
				navigator.appVersion.indexOf("Safari") == -1 || 
				(navigator.appVersion.indexOf("Safari") != -1 && navigator.appVersion.indexOf("Version/5.") == -1 && navigator.appVersion.indexOf("Version/4.") == -1)
			) {
				$subj.css('min-height', 'none');
			}
			
			$subj.stop().css('max-height', 'none');
			gg_gall_is_showing[gid] = false;
		}, fx_time);
			
		
		if(gg_new_images[gid]) {
			setTimeout(function() {
				gg_new_images[gid] = 0;
				$('#'+gid+' .gg_paginate > div').fadeTo(150, 1);
			}, 500);	
		}
		
		gg_shown_gall[gid] = true;
	};
	

	/////////////////////////////////////
	// collections deeplinking
	
	// get collection filters deeplink
	function gg_get_cf_deeplink(browser_history) {
		var hash = location.hash;
		if(hash == '' || hash == '#gg') {return false;}
		
		var arr = hash.split('/'); // ignore names
		hash = arr[0];
			
		if( $('.gg_filter').length ) {
			$('.gg_gallery_wrap').each(function() {
				var cid = $(this).attr('id');
				var val = hash.substring(hash.indexOf('#gg_cf')+7, hash.length)

				// check the cat existence
				if(hash.indexOf('#gg_cf') !== -1) {
					if( $('#'+cid+' .gg_filter a[rel=' + val + ']').length ) {
						var sel = '.ggc_' + $('#'+cid+' .gg_filter a[rel=' + val + ']').attr('rel');
		
						// filter
						$('#'+cid+' .gg_coll_container').isotope({ filter: sel });
						
						// set the selected
						$('#'+cid+' .gg_filter a').removeClass('gg_cats_selected');
						$('#'+cid+' .gg_filter a[rel=' + val + ']').addClass('gg_cats_selected');	
					}
				}
			});
		}
	};
	
	
	// get collection galleries - deeplink
	function gg_get_cg_deeplink(browser_history) { // coll selection
		var hash = location.hash;
		if(hash == '' || hash == '#gg') {return false;}
		
		var arr = hash.split('/'); // ignore names
		hash = arr[0];
		
		// call gallery
		if(hash.indexOf('#gg_cg') !== -1) {
			var gid = hash.substring(7);
			// check the item existence
			if( $('.gg_coll_img[rel=' + gid + ']').length ) {
				var cid = $('.gg_coll_img[rel=' + gid + ']').first().parents('.gg_gallery_wrap').attr('id');
				var gdata = $('.gg_coll_img[rel=' + gid + ']').first().data('gall-data');
				
				gg_load_coll_gallery(cid, gdata);
			}
		}
		
		// trigger filter
		else if(hash.indexOf('#gg_cf') !== -1) {
			gg_coll_dl_filter = hash.substring(7);
			
			setTimeout(function() {
				$('.ggf_id_'+gg_coll_dl_filter).trigger('click');
			}, 300);
		}
	};
	
	
	function gg_set_deeplink(subj, val) {
		if( gg_use_deeplink ) {
			gg_clear_deeplink();
			
			// add text
			if(subj == 'cat') {
				var txt = $('.ggf_id_'+val).text();
			} else {
				var txt = ($('.gg_coll_img[rel='+val+']').parents('.gg_coll_img_wrap').find('.gg_img_title_under').length) ? $('.gg_coll_img[rel='+val+']').parents('.gg_coll_img_wrap').find('.gg_img_title_under').text() : $('.gg_coll_img[rel='+val+']').find('.gg_img_title').text();
			}
			txt = (txt && typeof(txt) != 'undefined') ? '/' + encodeURIComponent(txt) : ''; 

			var gg_hash = (subj == 'cat') ? 'gg_cf' : 'gg_cg';  
			location.hash = gg_hash + '_' + val + txt;
		}
	};
	
	
	function gg_clear_deeplink() {
		if( gg_use_deeplink ) {
			var curr_hash = location.hash;

			// find if a mg hash exists
			if(curr_hash.indexOf('#gg_cg') !== false || curr_hash.indexOf('#gg_cf') !== false) {
				location.hash = 'gg';
			}
		}
	};


	
	//////////////////////////////////////
	// pagination
	
	$(document).ready(function() {
		//// standard pagination - next
		$('body').delegate('.gg_next_page', 'click', function() {
			var gid = $(this).parents('.gg_gallery_wrap').attr('id');
			
			if( !$(this).hasClass('gg_pag_disabled') && gg_is_paginating[gid] == 0 ){
				var curr_page = (typeof(gg_gallery_pag[gid]) == 'undefined') ? 1 : gg_gallery_pag[gid];
				gg_standard_pagination(gid, (curr_page + 1));
				
				gg_gallery_pag[gid] = curr_page + 1;
			}
		});
		// standard pagination - prev
		$('body').delegate('.gg_prev_page', 'click', function() {
			var gid = $(this).parents('.gg_gallery_wrap').attr('id');
			
			if( !$(this).hasClass('gg_pag_disabled') && gg_is_paginating[gid] == 0 ){
				var curr_page = (typeof(gg_gallery_pag[gid]) == 'undefined') ? 1 : gg_gallery_pag[gid];
				var new_pag = ((curr_page - 1) < 1) ? 1 : (curr_page - 1);
				
				gg_standard_pagination(gid, new_pag);
				
				gg_gallery_pag[gid] = new_pag;
			}
		});	
			
		// numbered buttons - handle click
		$(document).ready(function() {
			$('body').delegate('.gg_num_btns_wrap > div', 'click', function() {
				var gid = $(this).parents('.gg_gallery_wrap').attr('id');
				
				if( !$(this).hasClass('gg_pag_disabled') && gg_is_paginating[gid] == 0 ){
					gg_gallery_pag[gid] = $(this).attr('rel'); 
					gg_standard_pagination(gid, gg_gallery_pag[gid]);
				}
			});	
		});
		
		// dots - handle click
		$(document).ready(function() {
			$('body').delegate('.gg_dots_pag_wrap > div', 'click', function() {
				var gid = $(this).parents('.gg_gallery_wrap').attr('id');
				
				if( !$(this).hasClass('gg_pag_disabled') && gg_is_paginating[gid] == 0 ){
					gg_gallery_pag[gid] = $(this).attr('rel'); 
					gg_standard_pagination(gid, gg_gallery_pag[gid]);
				}
			});	
		});
	});
	
	
	// standard / num buttons / dots pagination - do pagination
	//// applying_filter == recall any item matching that tag and discard pagination parameters (but take advantage of the structure and fx)
	gg_standard_pagination = function(gid, new_pag, applying_filter) {
		applying_filter = (typeof(applying_filter) == 'undefined') ? false : applying_filter;

		if($('#'+gid).hasClass('gg_filtering_imgs') || gg_is_paginating[gid]) {
			console.error('GG - wait till previous tag filter or pagination to end');
			return false;
		}
				
		gg_is_paginating[gid] = 1;
		$('#'+gid).removeClass('gg_noresult');	
		
		// setup cache array
		if(typeof(gg_gall_pag_cache[gid]) == 'undefined') {
			gg_gall_pag_cache[gid] = [];	
		}
		
		// pagenum visibility management
		if(!applying_filter) {
			gg_pagenum_btn_vis(gid);		
		}
		
		// smooth change effect
		var curr_h = $('#'+gid+' .gg_container').height();
		var smooth_timing = Math.round( (curr_h / 30) * 25);
		if(smooth_timing < 220) {smooth_timing = 220;}

		if(typeof(gg_gall_is_showing[gid]) != 'undefined') {
			clearTimeout(gg_gall_is_showing[gid]);
			gg_gall_is_showing[gid] = false;
		}
		
		$('#'+gid+' .gg_container').css('max-height', curr_h).stop().animate({"max-height": 150}, smooth_timing);



		var is_closing = true
		setTimeout(function() {	is_closing = false; }, smooth_timing);
		
		// hide images
		$('#'+gid+' .gg_img').addClass('gg_old_page');
		if( navigator.appVersion.indexOf("MSIE 8.") != -1 || navigator.appVersion.indexOf("MSIE 9.") != -1 ) {
			$('#'+gid+' .gg_img').fadeTo(200, 0);
		}
		
		// show loader
		setTimeout(function() {	
			$('#'+gid+' .gg_loader').fadeIn('fast');
		}, 200);
		
		// destroy the old isotope layout
		setTimeout(function() {	
			if( $('#'+gid).hasClass('gg_masonry_gallery')) { 
				$('#'+gid+' .gg_container').isotope('destroy'); 
			}
		}, (smooth_timing - 10));

		// scroll to the top of the gallery
		if($(window).scrollTop() > ($("#"+gid).offset().top - 20)) {
			$('html,body').animate({scrollTop: ($("#"+gid).offset().top - 20)}, smooth_timing);
		}
		
		// manage disabled for standard pag system
		if(!applying_filter) {
			if($('#'+gid+' .gg_standard_pag').length) {
				if(new_pag >= parseInt($('#'+gid+' .gg_paginate').data('gg-totpages'))) {
					$('#'+gid+' .gg_paginate').find('.gg_next_page').addClass('gg_pag_disabled');
				} else {
					$('#'+gid+' .gg_paginate').find('.gg_next_page').removeClass('gg_pag_disabled');
				}
				
				if(new_pag == 1) {
					$('#'+gid+' .gg_paginate').find('.gg_prev_page').addClass('gg_pag_disabled');
				} else {
					$('#'+gid+' .gg_paginate').find('.gg_prev_page').removeClass('gg_pag_disabled');
				}
			}
			// manage for numbered buttons and dots
			else {
				$('#'+gid+' .gg_num_btns_wrap > div, #'+gid+' .gg_dots_pag_wrap > div').removeClass('gg_pag_disabled');
				$('#'+gid+' .gg_num_btns_wrap > div[rel='+ new_pag +'], #'+gid+' .gg_dots_pag_wrap > div[rel='+ new_pag +']').addClass('gg_pag_disabled');	
			}
		}
	
		// set new pag number 
		if(!applying_filter) {
			$('#'+gid+' .gg_nav_mid span').text(new_pag);
		}
		
		
		// cache index
		var cache_index = (!applying_filter || (applying_filter == '*' && typeof(new_pag) == 'number')) ? new_pag : applying_filter;
		
		// check in cache
		if(typeof(gg_gall_pag_cache[gid][cache_index]) != 'undefined' && typeof(new_pag) == 'number') {
			fill_standard_pagination(gid, gg_gall_pag_cache[gid][cache_index], new_pag, smooth_timing, applying_filter); 
		}
		else {
			// get new datas
			var data = {
				gid			: $("#"+gid).attr('rel'),
				gg_type		: 'gg_pagination',
				gg_page		: new_pag,
				gg_ol		: $('#'+gid).data('gg_ol'),
				gg_pag_vars	: gg_pag_vars[gid]
			};
			
			if(applying_filter && applying_filter != '*') {
				data.gg_filtered_imgs = applying_filter;	
			}

			$.post(window.location.href, data, function(response) {
				gg_gall_pag_cache[gid][cache_index] = response;
				fill_standard_pagination(gid, response, new_pag, smooth_timing, applying_filter); 
			});
		}
	};
	
	// standard / num buttons / dots pagination - fill gallery with new page images
	var fill_standard_pagination = function(gid, data, new_pag, delay, applying_filter) {
		setTimeout(function() {
			$('#'+gid+' .gg_paginate .gg_loader').remove();
	
			resp = $.parseJSON(data);
			$('#'+gid+' .gg_container').html(resp.html);
			
			// if old IE, hide secondary overlay
			if(gg_is_old_IE()) {
				$('.gg_sec_overlay').hide();
			}
			
			// was gallery filtered? re-apply
			if(!applying_filter && typeof(gg_gall_curr_filter[gid]) != 'undefined' && gg_gall_curr_filter[gid]) {
				gg_tag_filter(gid, gg_gall_curr_filter[gid], true);	
				
				if($('#'+gid).hasClass('gg_noresult')) {
					$('#'+gid+' .gg_loader').fadeOut('fast');
				}
			}

			gg_new_images[gid] = 1;
			gg_gallery_process(gid);
			gg_is_paginating[gid] = 0;
		}, delay);
	};
	
	
	
	// track galleries width and avoid pagenum and dots to go on two lines
	var gg_pagenum_btn_vis = function(gid) {
		if(!$('#'+gid).find('.gg_num_btns_wrap, .gg_dots_pag_wrap').length) {
			return false;	
		}

		var $pag_wrap = $('#'+gid).find('.gg_paginate'); 
		var $btns_wrap = $('#'+gid).find('.gg_num_btns_wrap, .gg_dots_pag_wrap');
		var $btns = $btns_wrap.find('> div');
		
		// reset
		$btns_wrap.removeClass('gg_hpb_after gg_hpb_before');
		$btns.removeClass('gg_hidden_pb');
		

		// there must be at least 5 buttons
		if($btns.length <= 5) {return false;}
		
		// calculate overall btns width
		var btns_width = 0;
		$btns.each(function() {
            btns_width += $(this).outerWidth(true) + 1; // add 1px to avoid any issue
        });  
		
		// act if is wider
		if(btns_width > $pag_wrap.outerWidth()) {
			var $sel_btn = $('#'+gid+' .gg_pag_disabled');
			var curr_pag = parseInt($sel_btn.attr('rel'));
			var tot_pages = parseInt($btns.last().attr('rel'));
			
			// side "there's more" dots width
			var dots_w = (curr_pag <= 2 || curr_pag >= (tot_pages - 1)) ? 26 : 52; // width = 16px + add 10px margin || 52 is the double
			
			var diff = btns_width + dots_w - $pag_wrap.outerWidth() ;
			var last_btn_w = $btns.last().outerWidth(true);
			var to_hide = Math.ceil( diff / last_btn_w );
			
			// manage pag btn visibility
			if(curr_pag <= 2 || curr_pag >= (tot_pages - 1)) {
				var to_hide_sel = [];
			
				if(curr_pag <= 2) {
					$btns_wrap.addClass('gg_hpb_after');		
					
					for(a=0; a < to_hide; a++) {
						to_hide_sel.push('[rel='+ (tot_pages - a) +']');	
					}
				}
				else if( curr_pag >= (tot_pages - 1)) {
					$btns_wrap.addClass('gg_hpb_before');	
					
					for(a=0; a < to_hide; a++) {
						to_hide_sel.push('[rel='+ (1 + a) +']');	
					}
				}
				
				$btns.filter( to_hide_sel.join(',') ).addClass('gg_hidden_pb');
				
			}
			else {
				$btns_wrap.addClass('gg_hpb_before gg_hpb_after');	
				var to_keep_sel = ['[rel='+ curr_pag +']'];
				
				// use opposite system: selected is the center and count how to keep 
				var to_keep = tot_pages - to_hide;
				var to_keep_pre = Math.floor( to_keep / 2 );
				var to_keep_post = Math.ceil( to_keep / 2 );
				
				// if pre/post already reaches the edge, sum remaining ones on the other side
				var reach_pre = curr_pag - to_keep_pre;
				var reach_post = curr_pag + to_keep_post;
				
				if(reach_pre <= 1) {
					$btns_wrap.removeClass('gg_hpb_before');	
					to_keep_post = to_keep_post + (reach_pre * -1 + 1);	
				}
				else if(reach_post >= tot_pages) {
					$btns_wrap.removeClass('gg_hpb_after');	
					to_keep_pre = to_keep_pre + (reach_post - tot_pages);	
				}
				
				for(a=1; a <= to_keep_pre; a++) {
					to_keep_sel.push('[rel='+ (curr_pag - a) +']');	
				}
				for(a=1; a <= to_keep_post; a++) {
					to_keep_sel.push('[rel='+ (curr_pag + a) +']');	
				}
				
				$btns.not( to_keep_sel.join(',') ).addClass('gg_hidden_pb');
			}	
		}
	};
	
	
	
	//// infinite scroll
	$(document).ready(function() {
		$('body').delegate('.gg_infinite_scroll', 'click', function() {
			var gid = $(this).parents('.gg_gallery_wrap').attr('id');
			var curr_url = window.location.href;
			
			if($('#'+gid).hasClass('gg_filtering_imgs') || gg_is_paginating[gid]) {
				console.error('GG - wait till previous tag filter or pagination to end');
				return false;
			}
			gg_is_paginating[gid] = 1;
			
			
			$('#'+gid+' .gg_container').css('max-height', $('#'+gid+' .gg_container').height());
			
			// hide nav and append loader
			if( $('#'+gid+' .gg_paginate .gg_loader').length ) {$('#'+gid+' .gg_paginate .gg_loader').remove();}
			$('#'+gid+' .gg_infinite_scroll').fadeTo(200, 0);
			setTimeout(function() {	
				$('#'+gid+' .gg_paginate').prepend(gg_loader);
			}, 200);

			// set the page to show
			if(typeof(gg_gallery_pag[gid]) == 'undefined') { 
				var next_pag = 2;
				gg_gallery_pag[gid] = next_pag; 
			} else {
				var next_pag = gg_gallery_pag[gid] + 1;
				gg_gallery_pag[gid] = next_pag; 	
			}

			var data = {
				gid			: $("#"+gid).attr('rel'),
				gg_type		: 'gg_pagination',
				gg_page		: next_pag,
				gg_ol		: $('#'+gid).data('gg_ol'),
				gg_pag_vars	: gg_pag_vars[gid]
			};
			$.post(window.location.href, data, function(response) {
				resp = $.parseJSON(response);
				
				if( $('#'+gid).hasClass('gg_string_gallery') ) {
					$('#'+gid+' .gg_container .gg_string_clear_both').remove();
					$('#'+gid+' .gg_container').append(resp.html);
					$('#'+gid+' .gg_container').append('<div class="gg_string_clear_both" style="clear: both;"></div>');
				}
				else {
					$('#'+gid+' .gg_container').append(resp.html);	
				}
				
				if( $('#'+gid).hasClass('gg_masonry_gallery')) {
					$('#'+gid+' .gg_container').isotope('reloadItems');
				}
				
				// if old IE, hide secondary overlay
				if(gg_is_old_IE()) {$('.gg_sec_overlay').hide();}


				// was gallery filtered? re-apply
				if(typeof(gg_gall_curr_filter[gid]) != 'undefined' && gg_gall_curr_filter[gid]) {
					gg_tag_filter(gid, gg_gall_curr_filter[gid], true);	
					
					if($('#'+gid).hasClass('gg_noresult')) {
						$('#'+gid+' .gg_loader').fadeOut('fast');
					}
				}


				gg_is_paginating[gid] = 0;
				gg_new_images[gid] = 1;
				gg_gallery_process(gid);
				
				
				if(resp.more != '1') { 
					$('#'+gid+' .gg_paginate').hide();
				}
				else {
					$('#'+gid+' .gg_paginate .gg_loader').remove();
					$('#'+gid+' .gg_infinite_scroll').fadeTo(200, 1);	
				}
			});
		});
	});
	
	
	
	///////////////////////////////////////////////////////
	
	
	// GALLERY TAGS FILTER
	$(document).ready(function() {
		
		// tags filter through tag click
		$('body').delegate('.gg_tag:not(.gg_tag_sel)', 'click', function(e) {
			var gid = $(this).parents('.gg_tags_wrap').data('gid');
			var tag = $(this).data('tag');
		
			if(tag == '*') {
				var img_indexes = '*';	
			} 
			else {	
				var raw_target_imgs = $(this).data('images').toString();
				var img_indexes = raw_target_imgs.split(',');	
			}

			// perform and manage tag selection
			if(gg_tag_filter(gid, img_indexes)) { 
				$(this).parents('.gg_tags_wrap').find('.gg_tag_sel').removeClass('gg_tag_sel');
				$(this).addClass('gg_tag_sel');	
			}
			
			// if there's a dropdown filter - select option 
			if( $(this).parents('.gg_tags_wrap').find('.gg_tags_dd').length ) {
				$(this).parents('.gg_tags_wrap').find('.gg_tags_dd option').removeAttr('selected');
				
				if(tag !== '*') {
					$(this).parents('.gg_tags_wrap').find('.gg_tags_dd option[value="'+ tag +'"]').attr('selected', 'selected');
				}
			}
		});
		
		
		// tag filter using mobile dropdown
		$('body').delegate('.gg_tags_dd', 'change', function(e) {
			var $wrap = $(this).parents('.gg_tags_wrap');
			var gid = $wrap.data('gid');

			var raw_target_imgs = $wrap.find('.gg_tag[data-tag="'+ $(this).val() +'"]').data('images'); // match filters to avoid misleading equal arrays
			var img_indexes = (raw_target_imgs == '*') ? raw_target_imgs : raw_target_imgs.split(',');	

			if(gg_tag_filter(gid, img_indexes)) { 
				$wrap.find('.gg_tag_sel').removeClass('gg_tag_sel');
				$wrap.find('.gg_tag[data-images="'+ raw_target_imgs +'"]').addClass('gg_tag_sel');	
			}
			else {
				return false;	
			}
		});
	});
	
	
	// performs the filter
	function gg_tag_filter(gid, matched_imgs_index, on_pagination) {
		var $gall = $('#'+gid);
		
		// is filtering? wait
		if($gall.hasClass('gg_filtering_imgs') && (typeof(on_pagination) == 'undefined' && gg_is_paginating[gid])) {
			console.error('GG - wait till previous tag filter or pagination to end');
			return false;	
		}
			
		
		// filter reset
		if(matched_imgs_index == '*') {
			gg_gall_curr_filter[gid] = '';
			
			// if is an ajax filtered - recall original page
			if($gall.hasClass('gg_ajax_filtered')) {
				
				$gall.removeClass('gg_ajax_filtered');
				$gall.find('.gg_paginate').css('visibility', 'visible');
				
				if(typeof(gg_gallery_pag[gid]) == 'undefined') {
					gg_gallery_pag[gid] = 1;	
				}
				
				// if is infinite scroll - pass an array
				var pag_to_restore = ($gall.find('.gg_infinite_scroll').length) ? [1, gg_gallery_pag[gid]] : gg_gallery_pag[gid];
				gg_standard_pagination(gid, pag_to_restore, '*'); 
			}
			else {
				local_tags_filter($gall, '*');		
			}
		}
		
		// filter
		else {
			gg_gall_curr_filter[gid] = matched_imgs_index;
			
			// every matched image is already in the gallery?
			var all_matched_showing = true;
			$.each(matched_imgs_index, function(i, v){
				
				if(!$('#'+gid+' .gg_img[data-img-id="'+ v +'"]').length) {
					all_matched_showing = false;
					return false;	
				}
			});
			
			
			// forced local filter or if every matched image is showing
			if(all_matched_showing || gg_monopage_filter) {
				local_tags_filter($gall, matched_imgs_index, on_pagination);
			}
			
			// ajax filter recallingany image
			else {
				$gall.addClass('gg_ajax_filtered');
				$gall.find('.gg_paginate').css('visibility', 'hidden');
				
				gg_standard_pagination(gid, '*', matched_imgs_index); 
			}
		}
		
		return true;
	};
	
	
	// local filter (animate and eventualy show "no results")
	var local_tags_filter = function($gall, matched_imgs_index, on_pagination) { 
	
		var gid 			= $gall.attr('id');
		var $container 		= $gall.find('.gg_container');
		var fakebox_id 		= 'gg_fakebox_'+gid;
		var string_gall 	= $gall.hasClass('gg_string_gallery'); 
		var matched_count 	= 0;
		
		// masonry gallery - just manage class
		if($gall.hasClass('gg_masonry_gallery')) {
			$gall.addClass('gg_filtering_imgs');
			
			$gall.find('.gg_img').each(function() {	
				var img_id = $(this).data('img-id');
				
				if(matched_imgs_index == '*' || $.inArray( img_id.toString(), matched_imgs_index) !== -1) {
					$(this).removeClass('gg_excluded_img');
					matched_count++;	
				} 
				else {
					$(this).addClass('gg_excluded_img');		
				}
			});
			
			$container.isotope({ filter: ':not(.gg_excluded_img)' });
		}
		
		
		// other layouts
		else {
		
			$container.css('height', $container.outerHeight());
			
			// create a fake container recreating the new layout
			var fakebox_align = ($gall.hasClass('gg_standard_gallery')) ? 'text-align: center;' : '';
			var fb_w = (string_gall) ? $gall.outerWidth(true) : $container.outerWidth(true);
			$('body').append('<div id="'+ fakebox_id +'" class="gg_filter_fakebox" style="width: '+ fb_w +'px; '+fakebox_align+'"></div>');
			
			
			// photostring - copy the whole gallery into fakebox
			if(string_gall) {
				$('#'+fakebox_id).html( $gall.clone() );
				$('#'+fakebox_id+' .gg_string_gallery').removeAttr('id');
				$('#'+fakebox_id+' .gg_img').removeClass('gg_excluded_img').removeAttr('style');
			}
				
			
			// prepend placeholders to prepare new positions
			$gall.find('.gg_img').each(function() {	
				var $img = $(this);
				var img_id = $img.data('img-id');
				
				if(matched_imgs_index == '*' || $.inArray( img_id.toString(), matched_imgs_index) !== -1) {
					matched_count++;	
					
					if(!string_gall) {
						$('#'+fakebox_id).append('<div style="display: inline-block; width: '+ $img.outerWidth(true) +'px; height: '+ $img.outerHeight(true) +'px;" data-img-id="'+ img_id +'"></div>');	
					}
				}
				
				// for photostring remove discarded images
				else {
					$('#'+fakebox_id).find('[data-img-id="'+ img_id +'"]').remove();
				}
				
				
				var pos = $img.position();
				$img.css({
					left 		: pos.left +'px',
					top 		: pos.top +'px',
				});
			});
			$gall.find('.gg_img').css('position', 'absolute');
			
			
			// wait a bit to let CSS to propagate
			setTimeout(function() {
				$gall.addClass('gg_filtering_imgs');
				
				// photostring - relayout fakebox gallery to get new positions
				if(matched_count && string_gall && typeof(on_pagination) == 'undefined') {
					layout_photostr_gall(false, '#'+fakebox_id);
				}
				
			
				// cycle again applying new positions and hiding others
				$gall.find('.gg_img').each(function() {	
					var img_id = $(this).data('img-id');
					
					if(matched_imgs_index == '*' || $.inArray( img_id.toString(), matched_imgs_index) !== -1) {
						
						var newpos = $('#'+fakebox_id +' [data-img-id="'+ img_id +'"]').position();
						$(this).css({
							left 		: newpos.left +'px',
							top 		: newpos.top +'px'

						});
						
						$(this).removeClass('gg_excluded_img');
					} 
					
					else {
						$(this).css({
							left 		: 'auto',
							top 		: 'auto'
						});
						
						$(this).addClass('gg_excluded_img');		
					}
				});
				
				// animate new container's height
				var new_cont_h = ($('#'+fakebox_id +' div').length) ? $('#'+fakebox_id +' div').last().position().top + $('#'+fakebox_id +' div').last().height() : 100;
				$container.css('height', new_cont_h);
				
				// if photostring - animate image to shape them
				if(matched_count && string_gall && typeof(on_pagination) == 'undefined') {
					layout_photostr_gall(gid);
				}
			}, 50);
		}
			
			
		// no matched?  show "no results in this page"
		if(!matched_count) {
			$gall.addClass('gg_noresult');	
		} else{
			$gall.removeClass('gg_noresult');	
		}	
			
		
		// remove filtering animation class
		setTimeout(function() {
			$gall.removeClass('gg_filtering_imgs');
			
			if(!$gall.hasClass('gg_masonry_gallery')) {
				$container.css('height', 'auto');
				
				$gall.find('.gg_img').not('.gg_excluded_img').css('position', 'static');
				$('#'+fakebox_id).remove();
			}
		}, 500);
	};
	
	
	
	///////////////////////////////////////////////////////
	
	
	
	//  primary overlay check - if no title hide
	gg_check_primary_ol = function(gid, respect_delay) {		
		$('#'+gid+' .gg_img').each(function(i, e) {
			var $ol_subj = $(this);

			if(!$.trim($ol_subj.find('.gg_img_title').html())) {
				$ol_subj.find('.gg_main_overlay').hide(); 	
			} else {
				$ol_subj.find('.gg_main_overlay').show();	
			}
		});	
	}
	
	
	
	///////////////////////////////////////////////////////
	
	
	
	// images effects
	gg_img_fx_setup = function(gid, width_arr, height_arr) {
		var fx_timing = $('#'+gid).data('ggom_timing'); 
		
		if( typeof($('#'+gid).data('ggom_fx')) != 'undefined' && $('#'+gid).data('ggom_fx').indexOf('grayscale') != -1) {
			
			// create and append grayscale image
			$('#'+gid+' .gg_main_thumb').each(function(i, v) {
				if( $(this).parents('.gg_img').find('.gg_fx_canvas.gg_grayscale_fx ').length == 0 ) {
					var img = new Image();
					img.onload = function(e) {
						Pixastic.process(img, "desaturate", {average : false});
					}
					
					$(img).addClass('gg_photo gg_grayscale_fx gg_fx_canvas');
					$(this).before(img);
					
					if(navigator.appVersion.indexOf("MSIE 9.") != -1 || navigator.appVersion.indexOf("MSIE 10.") != -1) {	
						if($(this).parents('.gg_img').hasClass('gg_car_item')) {
							$(this).parents('.gg_img').find('.gg_fx_canvas').css('width', width_arr[i]);
						}
						else {
							$(this).parents('.gg_img').find('.gg_fx_canvas').css('max-width', width_arr[i]).css('max-height', height_arr[i]);
							
							if( $(this).parents('.gg_gallery_wrap').hasClass('gg_collection_wrap') ) {
								$(this).parents('.gg_img').find('.gg_fx_canvas').css('min-width', width_arr[i]).css('min-height', height_arr[i]);	
							}
						}
					}
					
					img.src = $(this).attr('src');			
				}
			});
			
			// mouse hover opacity
			$('#'+gid).delegate('.gg_img','mouseenter touchstart', function(e) {
				if(!gg_is_old_IE()) {
					$(this).find('.gg_grayscale_fx').stop().animate({opacity: 0}, fx_timing);
				} else {
					$(this).find('.gg_grayscale_fx').stop().fadeOut(fx_timing);	
				}
			}).
			delegate('.gg_img','mouseleave touchend', function(e) {
				if(!gg_is_old_IE()) {
					$(this).find('.gg_grayscale_fx').stop().animate({opacity: 1}, fx_timing);
				} else {
					$(this).find('.gg_grayscale_fx').stop().fadeIn(fx_timing);	
				}
			});
		}
		
		if( typeof($('#'+gid).data('ggom_fx')) != 'undefined' && $('#'+gid).data('ggom_fx').indexOf('blur') != -1 ) {
			
			// create and append blurred image
			$('#'+gid+' .gg_main_thumb').each(function(i, v) {
				if( $(this).parents('.gg_img').find('.gg_fx_canvas.gg_blur_fx ').length == 0 ) {
					var img = new Image();
					img.onload = function() {
						Pixastic.process(img, "blurfast", {amount:0.15});
					}
	
					$(img).addClass('gg_photo gg_blur_fx gg_fx_canvas').attr('style', 'opacity: 0; filter: alpha(opacity=0);');
					$(this).before(img);

					if(navigator.appVersion.indexOf("MSIE 9.") != -1 || navigator.appVersion.indexOf("MSIE 10.") != -1) {	
						if($(this).parents('.gg_img').hasClass('gg_car_item')) {
							$(this).parents('.gg_img').find('.gg_fx_canvas').css('width', width_arr[i]);
						}
						else {
							$(this).parents('.gg_img').find('.gg_fx_canvas').css('max-width', width_arr[i]).css('max-height', height_arr[i]);
							
							if( $(this).parents('.gg_gallery_wrap').hasClass('gg_collection_wrap') ) {
								$(this).parents('.gg_img').find('.gg_fx_canvas').css('min-width', width_arr[i]).css('min-height', height_arr[i]);	
							}
						}
					}
					
					img.src = $(this).attr('src');
				}
			});
			
			
			// mouse hover opacity
			$('#'+gid).delegate('.gg_img','mouseenter touchstart', function(e) {
				if(!gg_is_old_IE()) {
					$(this).find('.gg_blur_fx').stop().animate({opacity: 1}, fx_timing);
				} else {
					$(this).find('.gg_blur_fx').stop().fadeIn(fx_timing);	
				}
			}).
			delegate('.gg_img','mouseleave touchend', function(e) {
				if(!gg_is_old_IE()) {
					$(this).find('.gg_blur_fx').stop().animate({opacity: 0}, fx_timing);
				} else {
					$(this).find('.gg_blur_fx').stop().fadeOut(fx_timing);	
				}
			});	
		}
	}
	
	
	/////////////////////////////////////

	
	// touch devices hover effects
	if( gg_is_touch_device() ) {
		$('.gg_img').bind('touchstart', function() { $(this).addClass('gg_touch_on'); });
		$('.gg_img').bind('touchend', function() { $(this).removeClass('gg_touch_on'); });
	}
	
	// check for touch device
	function gg_is_touch_device() {
		return !!('ontouchstart' in window);
	}
	
	
	
	/////////////////////////////////////
	// image-to-gallery functions
	
	gg_itg_init = function(id) {
		lazy_to_img_url(id);
		
		$('#'+id+' .gg_img .gg_main_thumb').lcweb_lazyload({
			allLoaded: function(url_arr, width_arr, height_arr) {
				
				$('#'+id+' .gg_itg_container').addClass('gg_itg_shown');
			}
		});
	};
	
	
	// launch lightbox
	$(document).delegate('.gg_itg_wrap', 'click', function(e) {
		var id = $(this).attr('id');
		
		// which index?
		if($(e.terget).hasClass('gg_itg_img')) {
			var clicked_index = $(e.target).data('index');	
		}
		else if($(e.target).parents('.gg_itg_img').length) {
			var clicked_index = $(e.target).parents('.gg_itg_img').data('index');	
		}
		else {
			var clicked_index = 0; 	
		}
		
		gg_throw_lb( gg_itg_obj[id], id, clicked_index, true);	
	});
	
	
	
	
	
	/////////////////////////////////////
	// galleria slider functions
	
	// manage the slider initial appearance
	gg_galleria_show = function(sid) {
		setTimeout(function() {
			if( $(sid+' .galleria-stage').length) {
				$(sid).removeClass('gg_show_loader');
				$(sid+' .galleria-container').fadeTo(200, 1);	
			} else {
				gg_galleria_show(sid);	
			}
		}, 50);
	}
	
	
	// manage the slider proportions on resize
	gg_galleria_height = function(sid) {
		if( $(sid).hasClass('gg_galleria_responsive')) {
			return parseFloat( $(sid).data('asp-ratio') );
		} else {
			return $(sid).height();	
		}
	}
	
	
	// Initialize Galleria
	gg_galleria_init = function(sid) {
		// autoplay flag
		var spec_autop = $(sid).data('gg-autoplay');
		var sl_autoplay = ((gg_galleria_autoplay && spec_autop != '0') || (spec_autop == '1')) ? true : false;

		// init
		Galleria.run(sid, {
			theme: 'ggallery', 
			height: gg_galleria_height(sid),
			fullscreenDoubleTap: false,
			wait: true,
			debug: false,
			
			// avoid using ALT for description
			dataConfig: function(img) {
				return {
					title: $(img).attr('alt'),
					description: $(img).data('description')
				};
			},
			
			// customizations
			extend: function() {
				var gg_slider_gall = this;
				$(sid+' .galleria-loader').append(gg_loader);
				
				if(sl_autoplay) {

					setTimeout(function() {
						$(sid+' .galleria-gg-play').addClass('galleria-gg-pause')
						gg_slider_gall.play(gg_galleria_interval);	
					}, 50);
				}
				
				// play-pause
				$(sid+' .galleria-gg-play').click(function() {
					$(this).toggleClass('galleria-gg-pause');
					gg_slider_gall.playToggle(gg_galleria_interval);
				});
				
				// pause slider on lightbox click
				$(sid+' .galleria-gg-lightbox').click(function() {
					// get the slider offset
					$(sid+' .galleria-thumbnails > div').each(function(k, v) {
                       if( $(this).hasClass('active') ) {gg_active_index = k;} 
                    });
					
					$(sid+' .galleria-gg-play').removeClass('galleria-gg-pause');
					gg_slider_gall.pause();
				});

				// thumbs navigator toggle
				$(sid+' .galleria-gg-toggle-thumb').click(function() {
					var $gg_slider_wrap = $(this).parents('.gg_galleria_slider_wrap');
					var thumb_h = $(this).parents('.gg_galleria_slider_wrap').find('.galleria-thumbnails-container').height();
					
					if( $gg_slider_wrap.hasClass('galleria-gg-show-thumbs') || $gg_slider_wrap.hasClass('gg_galleria_slider_show_thumbs') ) {
						$gg_slider_wrap.stop().animate({'padding-bottom' : '15px'}, 400);
						$gg_slider_wrap.find('.galleria-thumbnails-container').stop().animate({'bottom' : '20px', 'opacity' : 0}, 400);
						
						$gg_slider_wrap.removeClass('galleria-gg-show-thumbs');
						if( $gg_slider_wrap.hasClass('gg_galleria_slider_show_thumbs') ) {
							$gg_slider_wrap.removeClass('gg_galleria_slider_show_thumbs')
						}
					} 
					else {
						$gg_slider_wrap.stop().animate({'padding-bottom' : (thumb_h + 2 + 12)}, 400);
						$gg_slider_wrap.find('.galleria-thumbnails-container').stop().animate({'bottom' : '-'+ (thumb_h + 2 + 10) +'px', 'opacity' : 1}, 400);	
						
						$gg_slider_wrap.addClass('galleria-gg-show-thumbs');
					}
				});
				
				// LC lightbox - deeplink
				if(typeof(gg_lcl_allow_deeplink) != 'undefined') {
					gg_lcl_allow_deeplink();
				}
			}
		});
	}
	
	
	/////////////////////////////////////
	// Slick carousel functions
	
	
	// dynamically calculate breakpoints
	gg_car_calc_breakpoints = function(gid, img_max_w, multiscroll, forced_init_cols) {
		var bp = [];
		
		/* OLD forced sizes? try to find a good way to setup breakpoints */
		if(forced_init_cols) {
			var base_treshold = $("#gg_car_"+ gid).width() + 50;
			var base_img_w = Math.round( base_treshold / forced_init_cols ); 
			
			var obj = {
				breakpoint: base_treshold,
				settings: {
					slidesToShow: forced_init_cols,
					slidesToScroll: (multiscroll) ? forced_init_cols : 1
				}
			};
			bp.push( obj );
			
			for(a = forced_init_cols; a >= 1; a--) {
				
				obj = {
					breakpoint: (base_treshold - (base_img_w * (forced_init_cols - a))),
					settings: {
						slidesToShow: a,
						slidesToScroll: (multiscroll) ? a : 1
					}
				};
				bp.push( obj );
			}
		}

		/* new max-width based */
		else {
			for(a=1; a < 100; a++) {
				var overall_w = a * img_max_w; 
				if(overall_w > 2000) {break;}
				
				var obj = {
					breakpoint: overall_w,
					settings: {
						slidesToShow: a,
						slidesToScroll: (multiscroll) ? a : 1
					}
				};
				
				bp.push( obj );
			}
		}
		
		return bp;
	};
	
	
	/* preload visible images */
	gg_carousel_preload = function(gid, autoplay) {
		$('#gg_car_'+gid).prepend(gg_loader);
		
		// apply effects
		if( !$('#gg_car_'+gid+' .gg_grayscale_fx').length && !$('#gg_car_'+gid+' .gg_blur_fx').length ) {
			$('#gg_car_'+gid+' img').lcweb_lazyload({
				allLoaded: function(url_arr, width_arr, height_arr) {
					var true_h =  $('#gg_car_'+gid+' .gg_img_inner').height();
					
					// old IE fix - find true width related to height
					if(navigator.appVersion.indexOf("MSIE 9.") != -1 || navigator.appVersion.indexOf("MSIE 8.") != -1) {
						$.each(width_arr, function(i, v) {
							width_arr[i] = (width_arr[i] * true_h) / height_arr[i];
							height_arr[i] = true_h;
						});	
					}
					
					gg_img_fx_setup('gg_car_'+gid, width_arr, height_arr);
				}
			});
			var wait_for_fx = true;
		}
		else {var wait_for_fx = false;}
		
		var shown_first = (wait_for_fx) ? '' : '.slick-active';
		$('#gg_car_'+gid+' '+ shown_first +' img').lcweb_lazyload({
			allLoaded: function(url_arr, width_arr, height_arr) {
				$('#gg_car_'+gid+' .gg_loader').fadeOut(200, function() {
					$(this).remove();
				});
				$('#gg_car_'+gid).removeClass('gg_car_preload');
				
				if(autoplay) {
					$('#gg_car_'+gid).slick('slickPlay');	
				}
				
				// wait and show
				var delay = (wait_for_fx) ? 1200 : 320;
				setTimeout(function() {
					gg_car_center_images(gid);
					
					$(window).trigger('gg_loaded_carousel', [gid]);
				}, delay);
			}
		});
		
		
		// OVERLAY MANAGER ADD-ON //
		if(typeof(ggom_hub) == "function") {
			ggom_hub(gid);
		}
		////////////////////////////
	};
	
	
	var gg_car_center_images = function(subj_id) {
		var subj_sel = (typeof(subj_id) == 'undefined') ? '' : '#gg_car_'+subj_id;
		
		$(subj_sel + ' .gg_img.gg_car_item').each(function(i,v) {
			var $img = $(this);
			var $elements = $img.find('.gg_main_img_wrap > *');

			var wrap_w = $(this).width();
			var wrap_h = $(this).height(); 
			
			
			$('<img />').bind("load",function(){ 
				var ratio = Math.max(wrap_w / this.width, wrap_h / this.height);
				var new_w = this.width * ratio;
				var new_h = this.height * ratio;
				
				var margin_top = Math.ceil( (wrap_h - new_h) / 2);
				var margin_left = Math.ceil( (wrap_w - new_w) / 2);
				
				if(margin_top > 0) {margin_top = 0;}
				if(margin_left > 0) {margin_left = 0;}
				
				$elements.css('width', new_w).css('height', new_h);
				
				// mark to be shown
				$img.addClass('gg_car_img_ready'); 	
				
			}).attr('src',  $img.find('.gg_main_thumb').attr('src'));

        });
	}
	
	
	$(document).ready(function(e) {
		
		/* pause on hover fix */
        $(document).delegate('.gg_car_pause_on_h', 'mouseenter touchstart', function(e) {			
			$(this).slick('slickPause');
		}).
		delegate('.gg_car_pause_on_h', 'mouseleave touchend', function(e) {
			if($(this).hasClass('gg_car_autoplay')) {
				$(this).slick('slickPlay');
			}
		});	
		
		/* pause on lightbox open */
		$(document).delegate('.gg_carousel_wrap .gg_img:not(.gg_linked_img)', 'click tap', function(e) {			
			var $subj = $(this);
			setTimeout(function() {
				$subj.parents('.gg_carousel_wrap').slick('slickPause');
			}, 150);
		});
		
		// navigating through pages, disable autoplay on mouseleave
		$(document).delegate('.gg_carousel_wrap .slick-arrow, .gg_carousel_wrap .slick-dots li:not(.slick-active)', 'click tap', function(e) {		
			$(this).parents('.gg_carousel_wrap').removeClass('gg_car_autoplay');
		});
		$(document).delegate('.gg_carousel_wrap', 'swipe', function(e){
			$(this).removeClass('gg_car_autoplay');
		});
    });	
	
	

	/////////////////////////////////////
	// debouncers
	
	gg_debouncer = function($,cf,of, interval){
		var debounce = function (func, threshold, execAsap) {
			var timeout;
			
			return function debounced () {
				var obj = this, args = arguments;
				function delayed () {
					if (!execAsap) {func.apply(obj, args);}
					timeout = null;
				}
			
				if (timeout) {clearTimeout(timeout);}
				else if (execAsap) {func.apply(obj, args);}
				
				timeout = setTimeout(delayed, threshold || interval);
			};
		};
		$.fn[cf] = function(fn){ return fn ? this.bind(of, debounce(fn)) : this.trigger(cf); };
	};
	
	
	// bind resize to trigger only once event
	gg_debouncer($,'gg_smartresize', 'resize', 49);
	$(window).gg_smartresize(function() {
		
		// resize galleria slider
		$('.gg_galleria_responsive').each(function() {	
			var slider_w = $(this).width();
			var gg_asp_ratio = parseFloat($(this).data('asp-ratio'));
			var new_h = Math.ceil( slider_w * gg_asp_ratio );
			$(this).css('height', new_h);
		});
	});
	
	
	// bind scroll to keep "back to gallery" button visible
	gg_debouncer($,'gg_smartscroll', 'scroll', 50);
	$(window).gg_smartscroll(function() {
		gg_keep_back_to_gall_visible();
	});
	
	var gg_keep_back_to_gall_visible = function() {
		if( $('.gg_coll_back_to_new_style').length && typeof(gg_back_to_gall_scroll) != 'undefined' && gg_back_to_gall_scroll) {
			$('.gg_coll_gallery_container .gg_gallery_wrap').each(function(i, v) {
         		var gall_h = $(this).height();
				var $btn = $(this).parents('.gg_coll_gallery_container').find('.gg_coll_go_back');
				
				if(gall_h > $(window).height()) {
					
					var offset = $(this).offset();
					if( $(window).scrollTop() > offset.top && $(window).scrollTop() < (offset.top + gall_h - 60)) {
						var top = Math.round( $(window).scrollTop() - offset.top) + 55;
						if(top < 0) {top = 0;}
						
						$btn.addClass('gg_cgb_sticky').css('top', top);	
					}
					else {$btn.removeClass('gg_cgb_sticky').css('top', 0);}
				}
				else {$btn.removeClass('gg_cgb_sticky').css('top', 0);}
			       
            });
		}
	}
	
	
	// persistent check for galleries collections size change 
	$(document).ready(function() {
		setInterval(function() {
			$('.gg_gallery_wrap').each(function() {
				var gid = $(this).attr('id');
				if(typeof(gg_shown_gall[gid]) == 'undefined') {return true;} // only for shown galleries

				var new_w = ($(this).hasClass('gg_collection_wrap')) ? $('#'+gid+' .gg_coll_container').width() : $('#'+gid).width();
				
				if(typeof(gg_gallery_w[gid]) == 'undefined') {

					gg_gallery_w[gid] = new_w;	
					return true;
				}
				
				// trigger only if size is different
				if(gg_gallery_w[gid] != new_w) {
					persistent_resize_debounce(gid);
					gg_gallery_w[gid] = new_w;
				}
			});
		}, 200);
	});
	
	var persistent_resize_debounce = function(gall_id) {
		if(typeof(gg_debounce_resize[gall_id]) != 'undefined') {clearTimeout(gg_debounce_resize[gall_id]);}
		

		gg_debounce_resize[gall_id] = setTimeout(function() {	
			$('#'+gall_id).trigger('gg_resize_gallery', [gall_id]);	
		}, 50);
	}
	
	
	// standard GG operations on resize
	$(document).delegate('.gg_gallery_wrap', 'gg_resize_gallery', function(evt, gall_id) {
		
		// collection galleries title check 	
		if($(this).hasClass('gg_collection_wrap') && $(this).find('.gg_coll_gallery_container .gg_container').length) {
			gg_coll_gall_title_layout(gall_id); 
		} 
		
		
		// whether to trigger only carousel resizing
		if($(this).hasClass('gg_carousel_wrap')) {
			 gg_car_center_images(gall_id); // carousel images sizing	
		}
		else {
			gg_galleries_init(gall_id, true); // rebuilt galleries on resize	
		}
	});
	
	
	
	/////////////////////////////////////////////////////
	// full-resolution images preloading after galleries
	
	if(typeof(gg_preload_hires_img) != 'undefined' && gg_preload_hires_img) {
		var $phi_subjs = $('.gg_gallery_wrap, .gg_carousel_wrap');
		var phi_tot_subjs = $phi_subjs.length;
		var phi_loaded = 0;
		
		if(phi_tot_subjs) {
			$(window).on('gg_loaded_gallery gg_loaded_collection gg_loaded_carousel', function() {
				phi_loaded++;
				
				if(phi_loaded == phi_tot_subjs) {
					setTimeout(function() {
						$('.gg_img').not('.gg_coll_img, .gg_linked_img').each(function() {
							$('<img />')[0].src = $(this).data('gg-url');
						});	
					}, 300);
				}
			}); 
		}
	}
	


	/////////////////////////////////////////////////////
	// check if the browser is IE8 or older
	function gg_is_old_IE() {
		if( navigator.appVersion.indexOf("MSIE 7.") != -1 || navigator.appVersion.indexOf("MSIE 8.") != -1 ) {return true;}
		else {return false;}	
	};
	
	
	
	/////////////////////////////////////
	// Lightbox initialization

	// fix for HTML inside attribute
	gg_lb_html_fix = function(str) {
		var txt = (typeof(str) == 'string') ? str.replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
		return $.trim(txt);
	};
	
	
	// via image click
	$(document).ready(function() {
		$(document).delegate('.gg_gallery_wrap:not(.gg_static_car) div.gg_img:not(.gg_coll_img, .gg_linked_img, .gg_excluded_img)', 'click', function(e) {	
			e.preventDefault();	
			if( $(e.target).hasClass('.ggom_socials') || $(e.target).parents('.ggom_socials').length) {return false;}
	
			var gall_obj = [];
			
			var $clicked = $(this);
			var rel = $clicked.attr('rel');
			var gid = $clicked.parents('.gg_gallery_wrap').attr('id');
			var clicked_url = $clicked.data('gg-url');
			var clicked_index = 0;
			
			$('#'+gid+' .gg_img:not(.gg_coll_img, .gg_linked_img, .gg_excluded_img)').each(function(i, v) {
				var img_url = $(this).data('gg-url');
				
				if(typeof( gall_obj[img_url] ) == 'undefined') {
					gall_obj[img_url] = {
						"img"		: img_url,
						"title"		: gg_lb_html_fix($(this).data('gg-title')),
						"descr"		: gg_lb_html_fix($(this).data('gg-descr')),
						'author'	: gg_lb_html_fix($(this).data('gg-author'))
					};	
					
					if(img_url == clicked_url) {clicked_index = i;}
				}
			});
			
			gg_throw_lb(gall_obj, rel, clicked_index);
		});
	});
	
	
	// via slider
	gg_slider_lightbox = function(data, clicked_index) {
		var rel = $.now();
		var gall_obj = {};
		
		$.each(data, function(i, v)  {
			gall_obj[v.big] = {
				"img"		: v.big,
				"title"		: gg_lb_html_fix(v.title),
				"descr"		: gg_lb_html_fix(v.description),
				'author'	: '',
			};
		});
		gg_throw_lb(gall_obj, rel, clicked_index);
	};
})(jQuery);