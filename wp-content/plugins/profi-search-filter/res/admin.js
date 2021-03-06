jQuery( document ).ready( function(){
	jQuery( '.sf-accordion' ).accordion({
		heightStyle: "content"
	});
	
	if( jQuery( '.sf-group2' ).length != 0 ){
		if( jQuery( '.sf-group2' ).innerHeight() > jQuery( '.sf-group1' ).innerHeight() )
			jQuery( '.sf-group1' ).css({height:jQuery( '.sf-group2' ).innerHeight() + 'px'});
		else
			jQuery( '.sf-group2' ).css({height:jQuery( '.sf-group1' ).innerHeight() + 'px'});
	}
	
	if( typeof( sf_tab_index ) != 'undefined' ){
		jQuery( '.sf-tabs' ).tabs({
			active: sf_tab_index,
			activate: function(){
				jQuery( '.updated' ).slideUp();
				if( jQuery( '.sf-group2' ).length != 0 ){
					if( jQuery( '.sf-group2' ).innerHeight() > jQuery( '.sf-group1' ).innerHeight() )
						jQuery( '.sf-group1' ).css({height:jQuery( '.sf-group2' ).innerHeight() + 'px'});
					else
						jQuery( '.sf-group2' ).css({height:jQuery( '.sf-group1' ).innerHeight() + 'px'});
				}
			}
		});
	}
	
	jQuery( '.sf-group1 li.sf-drag, .sf-group2 li' ).draggable();
	jQuery( '.sf-group2' ).droppable({ 
		accept: ".sf-group1 .sf-drag",
		hoverClass: "ui-state-highlight",
		drop: function( event, ui ) {
			ui.draggable.css({left:'auto',top:'auto'}).appendTo( this );
		}
	});
	jQuery( '.sf-group1' ).droppable({ 
		accept: ".sf-group2 .sf-drag",
		hoverClass: "ui-state-highlight",
		drop: function( event, ui ) {
			if( ui.draggable.find( 'input' ).attr( 'name' ).match(/tax/i) )
				var putInto = jQuery( this ).find( 'ul.sf-tax-ul' );
			if( ui.draggable.find( 'input' ).attr( 'name' ).match(/meta/i) )
				var putInto = jQuery( this ).find( 'ul.sf-meta-ul' );
			ui.draggable.css({left:'auto',top:'auto'}).appendTo( putInto );
		}
	});
	
	
	jQuery( '.field.elements > div' ).draggable();
	jQuery( '.field.filter' ).droppable({ 
		accept: ".field.elements > div",
		hoverClass: "ui-state-highlight",
		drop: function( event, ui ) {
			var clone = ui.draggable.clone();
			ui.draggable.css({left:'auto',top:'auto'})
			clone.css({left:'auto',top:'auto'}).attr( 'data-id', jQuery( '.field.filter>div' ).length + 1 ).appendTo( this );
			clone.click();
		}
	});
	
	jQuery( document ).on( 'click', '.field.filter>div', function(){
		var element = jQuery( this );
		var fieldid = element.attr( 'data-id' );
		var attr = JSON.parse( element.attr( 'data-attr' ) );
		var value = 1;
		if( typeof attr.value != 'undefined' )
			value = attr.value;
		var fieldname = '';
		if( typeof attr.fieldname != 'undefined' )
			fieldname = attr.fieldname;
		var start_range = 0;
		if( typeof attr.start_range != 'undefined' )
			start_range = attr.start_range;
		var end_range = 100;
		if( typeof attr.end_range != 'undefined' )
			end_range = attr.end_range;
		var options = '';
		if( typeof attr.options != 'undefined' )
			options = attr.options;
		var operator = '';
		if( typeof attr.operator != 'undefined' )
			operator = attr.operator;
		var cond_key = '';
		if( typeof attr.cond_key != 'undefined' )
			cond_key = attr.cond_key;
		var cond_value = '';
		if( typeof attr.cond_value != 'undefined' )
			cond_value = attr.cond_value;
			
		var the_title_checked = '';
		var the_content_checked = '';
		var the_excerpt_checked = '';
		
		
		var meta_options = jQuery( '#sf-datasource' ).find( 'option' );
		if( typeof attr.contents != 'undefined' )
			jQuery( attr.contents ).each( function(){
				if( this == 'the_title' )
					the_title_checked = 'checked="checked"';
				if( this == 'the_content' )
					the_content_checked = 'checked="checked"';
				if( this == 'the_excerpt' )
					the_excerpt_checked = 'checked="checked"';
				var t = this;
				jQuery( meta_options ).each( function(){
					if( t == jQuery( this ).attr( 'value' ) )
						jQuery( this ).attr( 'fulltext_checked', '1' );
				});
			});
		
		
		var txt = '<div id="sf-dlg-shadow"></div><div id="sf-dlg">';
		if( attr.type == 'fulltext' )
			txt += '<h2>' + objectL10n.fulltext_search + '</h2>';
		if( attr.type == 'select' )
			txt += '<h2>' + objectL10n.selectbox + '</h2>';
		if( attr.type == 'hierarchical-taxonomies' )
			txt += '<h2>' + objectL10n.hierarchical_taxonomies + '</h2>';
		if( attr.type == 'date' )
			txt += '<h2>' + objectL10n.datebox + '</h2>';
		if( attr.type == 'radiobox' )
			txt += '<h2>' + objectL10n.radiobox + '</h2>';
		if( attr.type == 'input' )
			txt += '<h2>' + objectL10n.inputfield + '</h2>';
		if( attr.type == 'checkbox' )
			txt += '<h2>' + objectL10n.checkbox + '</h2>';
		if( attr.type == 'range' )
			txt += '<h2>' + objectL10n.range + '</h2>';
		if( attr.type == 'orderby' )
			txt += '<h2>' + objectL10n.orderby + '</h2>';
		if( attr.type == 'map' )
			txt += '<h2>' + objectL10n.map + '</h2>';
		if( attr.type == 'hidden' )
			txt += '<h2>' + objectL10n.hidden_field + '</h2>';
		
		txt += '<hr /><label>' + objectL10n.fieldname + ':</label><input name="fieldname" value="' + fieldname + '" /><br />';
		
		if( attr.type == 'fulltext' ){
			txt += '<span>' + objectL10n.search_contents + ':</span><br />';
			txt += '<label><input type="checkbox" ' + the_title_checked + ' class="sf-array" name="contents[]" value="the_title" /> ' + objectL10n.the_title + '</label><br />';
			txt += '<label><input type="checkbox" ' + the_content_checked + ' class="sf-array" name="contents[]" value="the_content" /> ' + objectL10n.the_content + '</label><br />';
			txt += '<label><input type="checkbox" ' + the_excerpt_checked + ' class="sf-array" name="contents[]" value="the_excerpt" /> ' + objectL10n.the_excerpt + '</label><br />';
			jQuery( '#sf-datasource' ).find( 'option' ).each( function(){
				if( jQuery( this ).attr( 'value' ).match( /meta\[(.*)\]/ ) ){
					var checked = '';
					if( typeof( jQuery( this ).attr( 'fulltext_checked' ) ) != 'undefined' && jQuery( this ).attr( 'fulltext_checked' ) == '1' )
						checked= ' checked="checked" ';
					txt += '<label><input ' + checked + ' type="checkbox" class="sf-array" name="contents[]" value="' + jQuery( this ).attr( 'value' ) + '" /> ' + jQuery( this ).text() + '</label><br />';
					}
			});
			jQuery( '#sf-datasource' ).find( 'option' ).attr( 'fulltext_checked', '' );
		}
		
		if( attr.type == 'range' ){
			txt += '<label>' + objectL10n.start_range + ':</label><input name="start_range" value="' + start_range + '" /><br />';
			txt += '<label>' + objectL10n.end_range + ':</label><input name="end_range" value="' + end_range + '" /><br />';
			
			if( typeof( attr.step ) != 'undefined' )
				var step = attr.step;
			else
				var step = 1;
				
			txt += '<label>' + objectL10n.step + ':</label><input name="step" value="' + step + '" /><br />';
			if( typeof attr.unit != 'undefined' )
				var unit_write = attr.unit;
			else
				var unit_write = '$';
			if( typeof attr.unit_front != 'undefined' && attr.unit_front == '1' )
				var check_unitfront = 'checked="checked"';
			else
				var check_unitfront = '';
			txt += '<label>' + objectL10n.unit + ':</label><input name="unit" value="' + unit_write + '" /><br />';
			txt += '<label>' + objectL10n.unit_in_front + ':</label><input type="checkbox" name="unit_front" value="1" ' + check_unitfront + ' /><br />';
		}
		
		if( attr.type == 'select' || attr.type == 'checkbox' || attr.type == 'radiobox' ){
			txt += '<label>' + objectL10n.options + ':</label><br />';
			txt += '<select name="options"><option value="auto" >' + objectL10n.automatic + '</option> ';
			txt += '<option value="individual">' + objectL10n.individual + '</option></select><div id="select_options"></div>';
		}
		
		if( attr.type == 'checkbox' ){
			txt += '<div id="check_term_attributes" style="display:none;border:1px solid #cacaca;padding: 2px;"><strong>' + objectL10n.term_operations + '</strong><br/>';
			txt += '<label>' + objectL10n.include_children + ':</label><br />';
			txt += '<select name="include_children"><option value="1" ';
			if( typeof( attr.include_children ) != 'undefined' && attr.include_children == '1' )
				txt += 'selected="selected"';
			txt += '>' + objectL10n.yes + '</option>';
			txt += '<option value="0" ';
			if( typeof( attr.include_children ) != 'undefined' && attr.include_children == '0' )
				txt += 'selected="selected"';
			txt += '>' + objectL10n.no + '</option></select><br />';
			txt += '<label>' + objectL10n.operator + ':</label><br />';
			txt += '<select name="operator"><option value="IN" ';
			if( typeof( attr.operator ) != 'undefined' && attr.operator == 'IN' )
				txt += 'selected="selected"';
			txt += '>' + objectL10n.txt_in + '</option>';
			txt += '<option value="NOT IN" ';
			if( typeof( attr.operator ) != 'undefined' && attr.operator == 'NOT IN' )
				txt += 'selected="selected"';
			txt += '>' + objectL10n.not_in + '</option><br />';
			txt += '<option value="AND" ';
			if( typeof( attr.operator ) != 'undefined' && attr.operator == 'AND' )
				txt += 'selected="selected"';
			txt += '>' + objectL10n.and + '</option></select><br />';
			txt += '</div>';
		}
		
		if( attr.type == 'select' ){
			txt += '<label>' + objectL10n.all_options + '</label><input name="all_options" value="';
			if( typeof( attr.all_options ) != 'undefined' ) 
				txt += attr.all_options;
			txt += '" /><br />';
			txt += '<div id="hierarchical" style="display:none;"><label>' + objectL10n.hierarchical + ':</label><input type="checkbox" name="hierarchical" value="1" ';
			if( typeof( attr.hierarchical ) != 'undefined' && attr.hierarchical == 1 )
				txt += 'checked="checked" ';
			txt += '/><br />';
			txt += '<label>' + objectL10n.symbol_to_indent + ':</label><input name="hierarchical_symbol_to_indent" value="';
			if( typeof( attr.hierarchical_symbol_to_indent ) != 'undefined' )
				txt += attr.hierarchical_symbol_to_indent;
			else
				txt += '--';
			txt += '" /><br />';
			txt += '</div>';
		}
		
		if( attr.type == 'input' ){
			txt += '<label>' + objectL10n.operator + ':</label><select name="operator"><option value="equal">' + objectL10n.equal + '</option><option value="like">' + objectL10n.like + '</option><option value="bt">' + objectL10n.bigger_than + '</option><option value="bte">' + objectL10n.bigger_than_or_equal + '</option><option value="st">' + objectL10n.smaller_than + '</option><option value="ste">' + objectL10n.smaller_than_or_equal + '</option></select><br />';
		}
		
		if( attr.type == 'orderby' ){
			txt += '<span>' + objectL10n.orderby + ':</span><br />';
			txt += '<div class="sf-orderby">' + jQuery( '#sf-orderbysource' ).html() + '</div>';			
		}
		
		if( attr.type == 'hidden' ){
			txt += '<label>' + objectL10n.value + ':</label><br />';
			var hidden_value = '';
			if( typeof( attr.value ) != 'undefined' )
				hidden_value = attr.value;
			txt += '<input name="value" value="' + hidden_value + '" /><br />';
		}
		
		if( attr.type == 'date' ){
			txt += '<label>' + objectL10n.type + ':</label><br />';
			txt += '<select name="searchtype">';
			if( typeof( attr.searchtype ) != 'undefined' && attr.searchtype == 'from' )
				txt += '<option value="from" selected="selected">' + objectL10n.from + '</option>';
			else
				txt += '<option value="from">' + objectL10n.from + '</option>';
			if( typeof( attr.searchtype ) != 'undefined' && attr.searchtype == 'till' )
				txt += '<option value="till" selected="selected">' + objectL10n.till + '</option>';
			else
				txt += '<option value="till">' + objectL10n.till + '</option>';
			if( typeof( attr.searchtype ) != 'undefined' && attr.searchtype == 'between' )
				txt += '<option value="between" selected="selected">' + objectL10n.between + '</option>';
			else
				txt += '<option value="between">' + objectL10n.between + '</option>';
			txt += '</select><br />';
			
			txt += '<label>' + objectL10n.source + ':</label><br />';
			txt += '<select name="source">';
			if( typeof( attr.source ) != 'undefined' && attr.source == 'published' )
				txt += '<option value="published" selected="selected">' + objectL10n.published + '</option>';
			else
				txt += '<option value="published">' + objectL10n.published + '</option>';
			if( typeof( attr.source ) != 'undefined' && attr.source == 'modified' )
				txt += '<option value="modified" selected="selected">' + objectL10n.modified + '</option>';
			else
				txt += '<option value="modified">' + objectL10n.modified + '</option>';
			
			txt += '</select><br />';
			
			txt += '<label>' + objectL10n.style + ':</label><br />';
			txt += '<select name="ui">';
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'smoothness' )
				txt += '<option value="smoothness" selected="selected">Smoothness</option>';
			else
				txt += '<option value="smoothness">Smoothness</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'ui-darkness' )
				txt += '<option value="ui-darkness" selected="selected">Darkness</option>';
			else
				txt += '<option value="ui-darkness">Darkness</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'ui-lightness' )
				txt += '<option value="ui-lightness" selected="selected">Lightness</option>';
			else
				txt += '<option value="ui-lightness">Lightness</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'start' )
				txt += '<option value="start" selected="selected">Start</option>';
			else
				txt += '<option value="start">Start</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'redmond' )
				txt += '<option value="redmond" selected="selected">Redmond</option>';
			else
				txt += '<option value="redmond">Redmond</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'sunny' )
				txt += '<option value="sunny" selected="selected">Sunny</option>';
			else
				txt += '<option value="sunny">Sunny</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'le-frog' )
				txt += '<option value="le-frog" selected="selected">Le Frog</option>';
			else
				txt += '<option value="le-frog">Le Frog</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'overcast' )
				txt += '<option value="overcast" selected="selected">Overcast</option>';
			else
				txt += '<option value="overcast">Overcast</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'flick' )
				txt += '<option value="flick" selected="selected">Flick</option>';
			else
				txt += '<option value="flick">Flick</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'pepper-grinder' )
				txt += '<option value="pepper-grinder" selected="selected">Pepper Grinder</option>';
			else
				txt += '<option value="pepper-grinder">Pepper Grinder</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'eggplant' )
				txt += '<option value="eggplant" selected="selected">Eggplant</option>';
			else
				txt += '<option value="eggplant">Eggplant</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'dark-hive' )
				txt += '<option value="dark-hive" selected="selected">Dark Hive</option>';
			else
				txt += '<option value="dark-hive">Dark Hive</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'cupertino' )
				txt += '<option value="cupertino" selected="selected">Cupertino</option>';
			else
				txt += '<option value="cupertino">Cupertino</option>';
				
			if( typeof( attr.ui ) != 'undefined' && attr.ui == 'none' )
				txt += '<option value="none" selected="selected">None</option>';
			else
				txt += '<option value="none">None</option>';
			
			txt += '</select><br />';
			
			var dateformat = 'yy-mm-dd';
			if( typeof( attr.dateformat ) != 'undefined' )
				dateformat = attr.dateformat;
			txt += '<label>' + objectL10n.dateformat + ':</label><br />';
			txt += '<input name="dateformat" value="' + dateformat + '" /><br />';
			
		}
		
		if( attr.type == 'map' ){
			
			var center_lat = '';
			if( typeof attr.center_lat != 'undefined' )
				center_lat = attr.center_lat;
			var center_lon = '';
			if( typeof attr.center_lon != 'undefined' )
				center_lon = attr.center_lon;
			var zoom = '';
			if( typeof attr.zoom != 'undefined' )
				zoom = attr.zoom;
			var apikey = '';
			if( typeof attr.apikey != 'undefined' )
				apikey = attr.apikey;
			txt += '<fieldset><legend>' + objectL10n.map_postmeta_options + '</legend>' + objectL10n.map_admin_text + '<br />';
			txt += objectL10n.latitude + ': <select name="lat"><option></option>' + jQuery( '#sf-allpostmeta' ).html() + '</select><br />';
			txt += objectL10n.longitude + ': <select name="lon"><option></option>' + jQuery( '#sf-allpostmeta' ).html() + '</select><br />';
			txt += '</fieldset><fieldset><legend>' + objectL10n.map_map_options + '</legend>';
			txt += objectL10n.map_center_lat + ': <input name="center_lat" value="' + center_lat + '" ><br />';
			txt += objectL10n.map_center_lon + ': <input name="center_lon" value="' + center_lon + '" ><br />';
			txt += objectL10n.map_zoom + ': <input value="' + zoom + '" placeholder="' + objectL10n.map_zoom_placeholder + '" name="zoom"><br />';
			txt += objectL10n.map_style + ': <select name="style"><option value="ROADMAP">'+objectL10n.ROADMAP+'</option><option value="SATELLITE">'+objectL10n.SATELLITE+'</option><option value="HYBRID">'+objectL10n.HYBRID+'</option><option value="TERRAIN">'+objectL10n.TERRAIN+'</option></select><br />';
			txt += objectL10n.apikey + ': <input name="apikey" value="' + apikey + '"><br />';
			txt += '</fieldset>';
		}
		
		if( attr.type != 'date' && attr.type != 'hierarchical-taxonomies' && attr.type != 'btnsearch' && attr.type != 'btnreset' && attr.type != 'fulltext' && attr.type != 'orderby' && attr.type != 'map' )
			txt += '<label>' + objectL10n.datasource + ':</label><select name="datasource">' + jQuery( '#sf-datasource' ).html() + '</select>';
		if(  attr.type == 'hierarchical-taxonomies' ){
			if( typeof( attr.select_label ) == 'undefined' )
				attr.select_label = objectL10n.choose + ' %name%';
			txt += '<label>' + objectL10n.label + ':</label><input name="select_label" value="' + attr.select_label + '" /><br />';
			txt += '<small>' + objectL10n.label_to_display_in_selectbox + '</small><br />';
			txt += '<label>' + objectL10n.datasource + ':</label><select name="datasource">';
			jQuery( '#sf-datasource' ).find( 'option[data-hierarchy]' ).each( function(){
				txt += '<option value="tax[' + jQuery( this ).text() + ']">' + jQuery( this ).text() + '</option>';
			});
			txt += '</select>';
		}
		
		var all_fields = []
		jQuery( '.field.filter div' ).each( function(){
			var field_attr = JSON.parse( jQuery( this ).attr( 'data-attr' ) );
			if( field_attr != attr && field_attr.type != 'map' && field_attr.type != 'range' )
				all_fields.push( { 'id' : jQuery( this ).attr( 'data-id' ), 'name' : jQuery( this ).find( 'span' ).text() });
		});
		
		if( attr.type != 'btnsearch' && attr.type != 'btnreset' && attr.type != 'hidden' ){
			txt += '<br /><label>' + objectL10n.show_field_when + '</label>';		
			txt += '<select name="cond_key"><option value="-1">' + objectL10n.show_always + '</option>';
			for( var i=0; i < all_fields.length; i++ ){
				var checked = '';
				if( cond_key == all_fields[i].id )
					checked=' selected="selected" ';
				txt += '<option ' + checked + 'value="' + all_fields[i].id + '">' + all_fields[i].name + '</option>';			
			}
			txt += '</select> = ';
			txt += '<input name="cond_value" value="'+ cond_value +'">';
		}
		
		txt += '<hr />';
		txt += '<a class="button button-primary" id="sf-save"><i class="fa fa-save"></i> ' + objectL10n.save + '</a> <a class="button" id="sf-cancel"><i class="fa fa-times"></i> ' + objectL10n.cancel + '</a> <a class="button" id="sf-delete"><i class="fa fa-trash-o"></i> ' + objectL10n.delete_element + '</a>';
		
		txt += '</div>';
		jQuery( txt ).appendTo( 'body' );
		
		if( attr.type == 'checkbox' ){
			if( jQuery( 'select[name="datasource"]' ).val().match( /tax\[(.*)\]/ ) )
				jQuery( '#check_term_attributes' ).show();
				
			jQuery( 'select[name="datasource"]' ).change( function(){
				if( jQuery( this ).val().match( /tax\[(.*)\]/ ) )
					jQuery( '#check_term_attributes' ).slideDown();
				else
					jQuery( '#check_term_attributes' ).slideUp();
			});
		}
		
		if( attr.type == 'map' ){
			var style = '';
			if( typeof attr.style != 'undefined' )
				style = attr.style;
			var lat = '';
			if( typeof attr.lat != 'undefined' )
				lat = attr.lat;
			var lon = '';
			if( typeof attr.lon != 'undefined' )
				lon = attr.lon;
				
			jQuery( '#sf-dlg select[name="style"]' ).val( style );
			jQuery( '#sf-dlg select[name="lat"]' ).val( lat );
			jQuery( '#sf-dlg select[name="lon"]' ).val( lon );
		
		}
		
		if( operator != '' )
			jQuery( 'select[name="operator"]' ).val( operator );
		if( options != '' ){
			var options_txt = '<input class="sf-noTransmit" id="new_option" placeholder="' + objectL10n.enter_option_value + '" /><input class="sf-noTransmit" id="new_option_key" placeholder="' + objectL10n.enter_option_key + '" /><a class="sf button" id="add_option">' + objectL10n.add_option + '</a><ul id="options"></ul>';
			jQuery( options_txt ).appendTo( '#select_options' );
			jQuery( 'select[name="options"]' ).val( options );
			if( typeof attr.option_key != 'undefined' ){
				for( var i = 0; i < attr.option_key.length; i++ ){
					jQuery( '<li><input class="sf-array" type="hidden" name="option_val['+i+']" value="' + attr.option_val[i] + '" /><input class="sf-array" type="hidden" name="option_key['+i+']" value="' + attr.option_key[i] + '" /><span>' +  attr.option_val[i] + ' (' + attr.option_key[i] + ')</span> <a class="button sf-option-delete"><i class="fa fa-trash-o" title="' + objectL10n.delete_option + '"></i></a></li>' ).appendTo( '#options' );
				}
			}
			jQuery( '#options' ).sortable();
			
			
		}		
			
		
		
		
		if( attr.type == 'orderby' ){
			if( typeof attr.orderby != 'undefined' ){
				jQuery( '#sf-dlg .sf-orderby input[type="checkbox"]' ).each( function(){
					jQuery( this ).prop( 'checked', false );
					for( var i = 0; i < attr.orderby.length; i++ ){
						if( attr.orderby[i] == jQuery( this ).val() ){
							jQuery( this ).prop( 'checked', true );
							jQuery( this ).next( 'input' ).val( attr.orderbylabel[i] );
						}
					}
				});
			}
		}
		
		if( attr.type == 'select' || attr.type == 'checkbox' || attr.type == 'radiobox' ){
			if( jQuery( 'select[name="options"]' ).val() == 'auto' ){
				jQuery( '#select_options' ).html( '' );
			}
			
			var others_datasource = '<optgroup label="' + objectL10n.others + '">';
			others_datasource += '<option value="others[author]">' + objectL10n.author + '</option>';
			
			if( attr.type == 'select' ){
				others_datasource += '<option value="others[pub_d]">' + objectL10n.pub_d + '</option>';
				others_datasource += '<option value="others[pub_m]">' + objectL10n.pub_m + '</option>';
				others_datasource += '<option value="others[pub_y]">' + objectL10n.pub_y + '</option>';
				others_datasource += '<option value="others[mod_d]">' + objectL10n.mod_d + '</option>';
				others_datasource += '<option value="others[mod_m]">' + objectL10n.mod_m + '</option>';
				others_datasource += '<option value="others[mod_y]">' + objectL10n.mod_y + '</option>';
			}
			
			others_datasource += '</optgroup>';
			jQuery( others_datasource ).appendTo( 'select[name="datasource"]' );
			
			jQuery( 'select[name="options"]' ).change( function(){
				var data = {
							action	:	'sf-optionsearch',
							val		:	jQuery( '#sf-dlg select[name="datasource"]' ).val()
				};
				var options_txt = '<input class="sf-noTransmit" id="new_option" placeholder="' + objectL10n.enter_option_value + '" /><input class="sf-noTransmit" id="new_option_key" placeholder="' + objectL10n.enter_option_key + '" /><a class="sf button" id="add_option">' + objectL10n.add_option + '</a><ul id="options"></ul>';
				if( jQuery( this ).val() == 'auto' )
					jQuery( '#select_options' ).html( '' );
				if( jQuery( this ).val() == 'individual' ){
					jQuery.post(
							'admin-ajax.php',
							data,
							function( response ){
								response = JSON.parse( response );
								var txt = ''
								if( response.length > 0 ){
									for( var i = 0; i < response.length; i++ )
										jQuery( '<li><input class="sf-array" type="hidden" name="option_val['+jQuery( '#options li' ).length+']" value="' + response[i].val + '" /><input class="sf-array" type="hidden" name="option_key['+jQuery( '#options li' ).length+']" value="' + response[i].key + '" /><span>' +  response[i].val + ' (' + response[i].key + ')</span> <a class="button sf-option-delete"><i class="fa fa-trash-o" title="' + objectL10n.delete_option + '"></i></a></li>' ).appendTo( '#options' );
								}
								jQuery( '#options' ).sortable();
								place_dlg();
							}
					);
					jQuery( '#select_options' ).html( options_txt );
					
					
				}
				place_dlg();
			});
		}
		
		if( typeof attr.datasource != 'undefined' ){
			jQuery( '#sf-dlg select[name="datasource"] option' ).each( function(){
				if( attr.datasource == jQuery( this ).val() )
					jQuery( this ).attr( 'selected', 'selected' );
			});
		}
		
		if( attr.type == 'select' ){
			if( jQuery( 'select[name="options"]' ).val() == 'auto' && jQuery( 'select[name="datasource"]' ).val().match( /tax\[(.*)\]/ ) ){
				jQuery( '#hierarchical' ).show();
			} else
				jQuery( '#hierarchical' ).hide();
		}
		
		jQuery( 'select[name="options"], select[name="datasource"]' ).change( function(){
			if( jQuery( 'select[name="options"]' ).val() == 'auto' && jQuery( 'select[name="datasource"]' ).val().match( /tax\[(.*)\]/ ) ){
				jQuery( '#hierarchical' ).show();
			} else {
				jQuery( '#hierarchical' ).hide();
				jQuery( '#hierarchical' ).find( 'input[type="checkbox"]' ).prop( 'checked', false );
				jQuery( 'input[name="hierarchical_symbol_to_indent"]' ).val( '' );
			}
		
		});
		
		place_dlg();
		
		jQuery( '#sf-cancel' ).click( function( event ){
			event.preventDefault();
			jQuery( '#sf-dlg, #sf-dlg-shadow' ).remove();
		});
		
		jQuery( '#sf-dlg' ).on( 'change', 'input', function(){
			var val = jQuery( this ).val();
			val = val.replace( /'/g, '???' );
			jQuery( this ).val( val );
		});
		
		
		jQuery( '#sf-save' ).click( function( event ){
			var new_attr = {type:attr.type};
			event.preventDefault();
			element.find( 'input' ).remove();
			element.children( 'span' ).text( jQuery( '#sf-dlg input[name="fieldname"]' ).val() );
			if( jQuery( 'select[name="options"]' ).val() == 'individual' && jQuery( '#options li' ).length == 0 ){
				alert( objectL10n.please_enter_an_option_value );
				return;
			}
			
			jQuery( '#sf-dlg .sf-orderby input[type="checkbox"]' ).each( function(){
				if( !jQuery( this ).prop( 'checked' ) )
					jQuery( this ).next( 'input' ).remove();
			});
			
			jQuery( '#sf-dlg input, #sf-dlg select' ).each( function(){
				if( !jQuery( this ).hasClass( 'sf-noTransmit' ) ){
					if( !jQuery( this ).hasClass( 'sf-array' ) ){
						if( jQuery( this ).attr( 'type' ) != 'checkbox' || jQuery( this ).prop( 'checked' ) ){
							new_attr[ jQuery( this ).attr( 'name' ) ] = jQuery( this ).val().replace( /'/g, '???' );
							jQuery( '<input type="hidden" name="sf[fields][' + fieldid + '][' + jQuery( this ).attr( 'name' ) + ']" value="' + jQuery( this ).val().replace( /'/g, '???' ) + '" />' ).appendTo( element );
						}
					} else {
						var attrkey = jQuery( this ).attr( 'name' ).split('[' );						
						if( typeof new_attr[ attrkey[0] ] == 'undefined' )
							new_attr[ attrkey[0] ] = [];
						if( jQuery( this ).attr( 'type' ) != 'checkbox' || jQuery( this ).prop( 'checked' ) ){
							new_attr[ attrkey[0] ].push( jQuery( this ).val().replace( /'/g, '???' ) );
							jQuery( '<input type="hidden" name="sf[fields][' + fieldid + '][' + attrkey[0] + '][]" value="' + jQuery( this ).val().replace( /'/g, '???' ) + '" />' ).appendTo( element );
						}
					}
				}
			});
			element.attr( 'data-attr',JSON.stringify( new_attr ) );
			jQuery( '<input type="hidden" name="sf[fields][' + fieldid + '][type]" value="' + attr.type + '" />' ).appendTo( element );
			jQuery( '#sf-dlg, #sf-dlg-shadow' ).remove();
		});
		
		jQuery( '#sf-delete' ).click( function( event ){
			event.preventDefault();
			element.remove();
			jQuery( '#sf-dlg, #sf-dlg-shadow' ).remove();
		});
		
	});
	
	function place_dlg(){
		var dlg_t = Math.round( jQuery( window ).innerHeight()/2 - jQuery( '#sf-dlg' ).outerHeight()/2 );
		var dlg_l = Math.round( jQuery( window ).innerWidth()/2 - jQuery( '#sf-dlg' ).innerWidth()/2 );
		if( dlg_t < 25 )
			dlg_t = 25;
		if( dlg_t < 2 )
			dlg_t = 2;
		
		if( typeof jQuery( '#sf-dlg' ).attr( 'data-place' ) != 'undefined' ){
			if( dlg_l > jQuery( '#sf-dlg' ).offset().left )
				return;
			if( dlg_t > jQuery( '#sf-dlg' ).offset().top )
				return;
		} else {
			jQuery( '#sf-dlg' ).attr( 'data-place','1' );
		}
		jQuery( '#sf-dlg' ).animate({left:dlg_l+'px',top:dlg_t+'px'});
	}
	
	jQuery( '.sf-form-delete' ).click( function( event ){
		event.preventDefault();
		var id = jQuery( this ).attr( 'data-id' );
		var row = jQuery( this ).parent().parent();
		var txt = '<div id="sf-dlg-shadow"></div><div id="sf-dlg">';
		txt += '<h3>' + objectL10n.really_delete + '</h3>';
		txt += '<p>Name: ' + id + '</p>';
		txt += '<hr /><a href="#" id="cancel_item" style="float:right" class="button">' + objectL10n.cancel + '</a>';
		txt += '<a href="#" id="delete_item" class="button-primary" data-id="' + id + '">' + objectL10n.item_delete + '</a>';
		txt += '</div>';
		jQuery( txt ).appendTo( 'body' );
		place_dlg();
		jQuery( '#cancel_item' ).click( function( event ){
			event.preventDefault();
			jQuery( '#sf-dlg, #sf-dlg-shadow' ).remove();
		});
		
		jQuery( '#delete_item' ).click( function(){
			var data = {
						'action'	:	'sf-deleteform',
						'id'		:	id
			};
			
			jQuery.post( 
							'admin-ajax.php',
							data,
							function( response ){
								if( response == 'OK' ){
									jQuery( row ).remove();
								}
								jQuery( '#sf-dlg, #sf-dlg-shadow' ).remove();
							}
			);
						
		});
	});
	
	
	jQuery( document ).on( 'click', '#options li', function( event ){
		if( jQuery( this ).find( 'input' ).attr( 'type' ) == 'text' )
			return;
			
		jQuery( this ).find( 'span' ).hide();
		jQuery( this ).find( 'input' ).attr( 'type', 'text' );	
		var txt = '<a href="#" title="' + objectL10n.update_option + '" class="button sf-option-update"><i class="fa fa-save"></i></a>';
		jQuery( txt ).appendTo( this );
		jQuery( '.sf-option-update' ).click( function( event ){	
			event.stopImmediatePropagation();
			jQuery( this ).parent().find( 'input' ).attr( 'type', 'hidden' );
			var new_txt = '';
			jQuery( this ).parent().find( 'input' ).each( function(){
				if( new_txt != '' )
					new_txt += ' (' + jQuery( this ).val() + ')';
				else
					new_txt = jQuery( this ).val() + new_txt;
			});
			jQuery( this ).parent().find( 'span' ).text( new_txt );
			jQuery( this ).parent().find( 'span' ).show();
			jQuery( this ).remove();
		});
	});
	
	
	
	jQuery( document ).on( 'click', '.sf-option-delete', function(){
		jQuery( this ).parent().remove();
	});
	
	jQuery( document ).on( 'click','#add_option', function( event ){
						event.preventDefault();
						key = jQuery( '#new_option_key' ).val();
						val = jQuery( '#new_option' ).val();
						if( key == '' )
							alert( objectL10n.please_enter_an_option_key )
						if( val == '' )
							alert( objectL10n.please_enter_an_option_value )
						if( val == '' || key == '' )
							return;
						var option_id = jQuery( '#options li' ).length;	
						var option_value = '<li><input class="sf-array" type="hidden" name="option_val['+option_id+']" value="' + val + '" /><input class="sf-array" type="hidden" name="option_key['+option_id+']" value="' + key + '" /><span>' +  val + ' (' + key + ')</span> <a class="button sf-option-delete"><i class="fa fa-trash-o " title=" title="' + objectL10n.delete_option + '"></i></a></li>'
						jQuery( option_value ).appendTo( '#options' );
						jQuery( '#options' ).sortable();
						jQuery( '#new_option_key' ).val('');
						jQuery( '#new_option' ).val('');
						place_dlg();						
	});
	
	jQuery( '.field.filter' ).sortable({
		update: function( event, ui ){
			var i = 1;
			
			var cond_key_replaced = {};
			jQuery( this ).children( 'div' ).each( function(){
				jQuery( this ).attr( 'data-id', i );
				jQuery( this ).find( 'input' ).each( function(){
					var name = jQuery( this ).attr( 'name' );
					cond_key_replaced[ name.match( /\d/g ) ] = i;
					jQuery( this ).attr( 'name', name.replace( /\d/g, i ) );
					
						
				});
				i++;
			});
			
			jQuery( this ).find( 'input' ).each( function(){
				if( jQuery( this ).attr( 'name' ).match( /cond_key/ ) && jQuery( this ).val() != '-1' ){
					jQuery( this ).val( cond_key_replaced[ jQuery( this ).val() ] );
					var a = JSON.parse( jQuery( this ).parent().attr( 'data-attr' ) );
					a.cond_key = cond_key_replaced[ a.cond_key ];
					jQuery( this ).parent().attr( 'data-attr', JSON.stringify( a ) );
					
				}
			});
		}
	});
	
	jQuery( '.sf-colorfield' ).wpColorPicker();
	
});