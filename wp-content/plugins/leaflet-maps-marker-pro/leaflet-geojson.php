<?php
/*
    GeoJSON generator - Maps Marker Pro
*/
//info redirect to permalink if file is being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'leaflet-geojson.php') {
	while (!is_file('wp-load.php')) {
		if (is_dir('..' . DIRECTORY_SEPARATOR)) {
			chdir('..' . DIRECTORY_SEPARATOR);
		} else {
			die('Error: Could not construct path to wp-load.php - please check <a href="https://www.mapsmarker.com/path-error">https://www.mapsmarker.com/path-error</a> for more details');
		}
	}
	require_once('wp-load.php');
	if (isset($_GET['layer'])) {
		$layer = esc_html($_GET['layer']);
		unset($_GET['layer']);
		$argv = (!empty($_GET)) ? '?' . http_build_query($_GET) : '';
		wp_redirect(MMP_Globals::translate_permalink(MMP_Rewrite::get_base_url() . MMP_Rewrite::get_slug() . '/geojson/layer/' . $layer . '/' . $argv), 301);
	} elseif (isset($_GET['marker'])) {
		$marker = intval($_GET['marker']);
		unset($_GET['marker']);
		$argv = (!empty($_GET)) ? '?' . http_build_query($_GET) : '';
		wp_redirect(MMP_Globals::translate_permalink(MMP_Rewrite::get_base_url() . MMP_Rewrite::get_slug() . '/geojson/marker/' . $marker . '/' . $argv), 301);
	}
	exit;
}

//info: get callback parameters for JSONP
$callback = (isset($_GET['callback'])) ? preg_replace( '/[^a-zA-Z0-9_]/', '', $_GET['callback']) : '';
//info: check if plugin is active (didnt use is_plugin_active() due to problems reported by users)
function lmm_is_plugin_active( $plugin ) {
	$active_plugins = get_option('active_plugins');
	$active_plugins = array_flip($active_plugins);
	if ( isset($active_plugins[$plugin]) || lmm_is_plugin_active_for_network( $plugin ) ) { return true; }
}
function lmm_is_plugin_active_for_network( $plugin ) {
	if ( !is_multisite() )
		return false;
	$plugins = get_site_option( 'active_sitewide_plugins');
	if ( isset($plugins[$plugin]) )
				return true;
	return false;
}
if (!lmm_is_plugin_active('leaflet-maps-marker-pro/leaflet-maps-marker.php') ) {
	echo sprintf(__('The plugin "Maps Marker Pro" is inactive on this site and therefore this API link is not working.<br/><br/>Please contact the site owner (%1s) who can activate this plugin again.','lmm'), antispambot(get_bloginfo('admin_email')) );
} else {
	//info: set php header to allow calls from other (sub)domains
	header('Access-Control-Allow-Origin: *');
	global $wpdb, $locale;
	$table_name_markers = $wpdb->prefix.'leafletmapsmarker_markers';
	$table_name_layers = $wpdb->prefix.'leafletmapsmarker_layers';
	$lmm_options = get_option( 'leafletmapsmarker_options' );
	//info: set custom marker icon dir/url
	if ( $lmm_options['defaults_marker_custom_icon_url_dir'] == 'no' ) {
		$defaults_marker_icon_url = LEAFLET_PLUGIN_ICONS_URL;
	} else {
		$defaults_marker_icon_url = esc_url($lmm_options['defaults_marker_icon_url']);
	}
	$full = (isset($_GET['full']) && $_GET['full'] == 'yes') ? '1' : '0';
	$listmarkers = (isset($_GET['listmarkers'])) ? intval($_GET['listmarkers']) : '0';
	$per_page = intval($lmm_options[ 'defaults_layer_listmarkers_limit' ]);
	$full_icon_url = (isset($_GET['full_icon_url']) && $_GET['full_icon_url'] == 'yes') ? 'yes' : 'no';
	//info: Google language localization (JSON API)
	if ($lmm_options['google_maps_language_localization'] == 'browser_setting') {
		$google_language = '';
	} else if ($lmm_options['google_maps_language_localization'] == 'wordpress_setting') {
		if ( $locale != NULL ) { $google_language = "&hl=" . substr($locale, 0, 2); } else { $google_language =  '&hl=en'; }
	} else {
		$google_language = "&hl=" . $lmm_options['google_maps_language_localization'];
	}
	if (get_query_var('layer', false)) {
		$layer_prepared = esc_sql(strtolower(get_query_var('layer')));
		$layer = str_replace(array("b","c","d","e","f","g","h","i","j","k","m","n","o","p","q","r","s","t","u","v","w","x","y","z","$","%","#","-","_","'","\"","\\","(",")"), "", $layer_prepared); //info: not intval() cause otherwise $layer=0 when creating new layer and showing all markers with layer id = 0
		$q = '';
		if (($layer_prepared == 'all') || ($layer_prepared == '*')) {
			$q = '';
		} else {
			$layers = explode(',', $layer);
			$checkedlayers = array();
			foreach ($layers as $clayer) {
				if (intval($clayer) > 0) {
					$checkedlayers[] = intval($clayer);
				}
			}
			if (count($checkedlayers) > 0) {
				$q .= ' WHERE ';
				$l = 0;
				foreach( $checkedlayers as $checked_layer){
					if(end($checkedlayers) == $checked_layer){
						$q .= " layer LIKE '%\"".$checked_layer."\"%' ";
					}else{
						$q .= " layer LIKE '%\"".$checked_layer."\"%' OR ";
					}
					$l++;
				}
			} else {
				die('Error: a layer with that ID does not exist!');
			}

		}

		if ($full == 0) {
			$sql = 'SELECT m.id as mid, m.lat as mlat, m.lon as mlon,m.layer as mlayer, m.markername as mmarkername, m.icon as micon, m.popuptext as mpopuptext, m.address as maddress, m.zoom as mzoom FROM '.$table_name_markers.' AS m '.$q;
		} else {
			$sql = 'SELECT m.id as mid, m.markername as mmarkername, m.layer as mlayer, m.icon as micon, m.createdby as mcreatedby, m.createdon as mcreatedon, m.updatedby as mupdatedby, m.updatedon as mupdatedon,m.zoom as mzoom, m.basemap as mbasemap, m.lat as mlat, m.lon as mlon, m.openpopup as mopenpopup, m.popuptext as mpopuptext, m.mapwidth as mmapwidth, m.mapwidthunit as mmapwidthunit, m.mapheight as mmapheight, m.controlbox as mcontrolbox, m.overlays_custom as moverlays_custom, m.overlays_custom2 as moverlays_custom2, m.overlays_custom3 as moverlays_custom3, m.overlays_custom4 as moverlays_custom4, m.wms as mwms, m.wms2 as mwms2, m.wms3 as mwms3, m.wms4 as mwms4, m.wms5 as mwms5, m.wms6 as mwms6, m.wms7 as mwms7, m.wms8 as mwms8, m.wms9 as mwms9, m.wms10 as mwms10, m.kml_timestamp as mkml_timestamp, m.address as maddress, m.gpx_url as mgpx_url, m.gpx_panel as mgpx_panel, l.createdby as lcreatedby, l.createdon as lcreatedon, l.updatedby as lupdatedby, l.updatedon as lupdatedon, l.name AS lname, l.mlm_filter as mlm_filter, l.mlm_filter_details as mlm_filter_details FROM `'.$table_name_markers.'` AS m INNER JOIN `'.$table_name_layers.'` AS l ON m.layer LIKE concat(\'%"\',l.id,\'"%\') '.$q;
		}
		$markers = $wpdb->get_results($sql, ARRAY_A);
		//info: prepare WPML supported strings
		if ($ml_checked = MMP_Globals::check_multilingual()) {
			foreach ($markers as $key => $marker) {
				$markers[$key]['mmarkername'] = MMP_Globals::translate_single_string($marker['mmarkername'], "Marker (ID {$marker['mid']}) name", $ml_checked);
				$markers[$key]['maddress'] = MMP_Globals::translate_single_string($marker['maddress'], "Marker (ID {$marker['mid']}) address", $ml_checked);
				$markers[$key]['mpopuptext'] = MMP_Globals::translate_single_string($marker['mpopuptext'], "Marker (ID {$marker['mid']}) popuptext", $ml_checked);
			}
		}

		$first = true;
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json; charset=utf-8');
		//info: callback for JSONP - part 1
		if ($callback != NULL) {
			echo $callback . '(';
		}
		echo '{"type":"FeatureCollection",'.PHP_EOL;
		echo '"features":['.PHP_EOL;
		if ($layer != NULL) { //info: needed for adding new layers
			//info: counter for limiting the outputting of `html_row`
			$i = 0;
			foreach ($markers as $marker) {
				if (!(($layer_prepared == 'all') || ($layer_prepared == '*')))
					$requested_layers = array_intersect(json_decode($marker['mlayer'], true), $layers);
				if ($first) $first = false;
				else echo ','.PHP_EOL;
				echo '{'.PHP_EOL;
				echo '"type":"Feature",'.PHP_EOL;
				echo '"geometry":'.PHP_EOL;
				echo '{'.PHP_EOL;
				echo '"type":"Point",'.PHP_EOL;
				echo '"coordinates":[' . $marker['mlon'] . ',' . $marker['mlat'] . ']'.PHP_EOL;
				echo '},'.PHP_EOL;
				echo '"properties":'.PHP_EOL;
				echo '{'.PHP_EOL;
					echo '"markerid":"'.$marker['mid'].'",'.PHP_EOL;
					echo '"layers":'.($marker['mlayer']).','.PHP_EOL;
					if (!(($layer_prepared == 'all') || ($layer_prepared == '*')))
					echo '"requested_layer":'.(json_encode(array_values($requested_layers))).','.PHP_EOL;
					echo '"markername":"' . wp_specialchars_decode(stripslashes(esc_js(preg_replace('/[\x00-\x1F\x7F]/', '', $marker['mmarkername'])))) . '",'.PHP_EOL;
					if($listmarkers == 1 && $i < $per_page){
						echo '"html_row":"'.htmlspecialchars(str_replace("\n", "", MMP_Globals::get_marker_list_row($marker))).'",'.PHP_EOL;
					}
					$i++;
				if ($full == 1) {
					echo '"basemap":"'.$marker['mbasemap'].'",'.PHP_EOL;
					echo '"lat":"'.$marker['mlat'].'",'.PHP_EOL;
					echo '"lon":"'.$marker['mlon'].'",'.PHP_EOL;
				}
				echo '"icon":"'.$marker['micon'].'",'.PHP_EOL;
				echo '"zoom":"' . $marker['mzoom'] . '",'.PHP_EOL;
				if ($full_icon_url == 'yes') {
					$marker_full_url = ($marker['micon'] == NULL) ? LEAFLET_PLUGIN_URL . "leaflet-dist/images/marker.png" : $defaults_marker_icon_url . "/" . $marker['micon'];
					echo '"iconUrl":"'.$marker_full_url.'",'.PHP_EOL;
				}
				$address_escaped = stripslashes(str_replace('"', '\'', preg_replace('/[\x00-\x1F\x7F]/', '', $marker['maddress'])));
				if ( ($full == 0) && ($lmm_options['directions_popuptext_panel'] == 'yes') ) {
					echo '"address":"'.$address_escaped.'",'.PHP_EOL;
				} else if ($full == 1) {
					echo '"address":'.json_encode($address_escaped).','.PHP_EOL;
				}
				//info: remove control chars & sanitize output
				$mpopuptext_prepare = MMP_Globals::sanitize_popuptext($marker['mpopuptext'], true, true);
				//info: second run for do_shortcode() -> do not replace new lines/brs with <br/>!
				$mpopuptext = MMP_Globals::sanitize_popuptext(do_shortcode($mpopuptext_prepare), true);
				echo '"text":"' . $mpopuptext . '"';
				if ( ($lmm_options['directions_popuptext_panel'] == 'yes') || ($full == 1) ) {
					$mpopuptext_css = ($marker['mpopuptext'] != NULL) ? "border-top:1px solid #f0f0e7;padding-top:5px;margin-top:5px;" : "";
					if ($lmm_options['directions_provider'] == 'googlemaps') {
						if ( isset($lmm_options['google_maps_base_domain_custom']) && ($lmm_options['google_maps_base_domain_custom'] == NULL) ) { $gmaps_base_domain_directions = $lmm_options['google_maps_base_domain']; } else { $gmaps_base_domain_directions = urlencode($lmm_options['google_maps_base_domain_custom']); }
						if ( $marker['maddress'] != NULL ) { $google_from = urlencode($marker['maddress']); } else { $google_from = $marker['mlat'] . ',' . $marker['mlon']; }
						$avoidhighways = (isset($lmm_options[ 'directions_googlemaps_route_type_highways' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_highways' ] == 1 ) ? '&dirflg=h' : '';
						$avoidtolls = (isset($lmm_options[ 'directions_googlemaps_route_type_tolls' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_tolls' ] == 1 ) ? '&dirflg=t' : '';
						$publictransport = (isset($lmm_options[ 'directions_googlemaps_route_type_public_transport' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_public_transport' ] == 1 ) ? '&dirflg=r' : '';
						$walking = (isset($lmm_options[ 'directions_googlemaps_route_type_walking' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_walking' ] == 1 ) ? '&dirflg=w' : '';
						$directionslink = "http://" . $gmaps_base_domain_directions . "/maps?daddr=" . $google_from . "&t=" . $lmm_options[ 'directions_googlemaps_map_type' ] . "&layer=" . $lmm_options[ 'directions_googlemaps_traffic' ] . "&doflg=" . $lmm_options[ 'directions_googlemaps_distance_units' ] . $avoidhighways . $avoidtolls . $publictransport . $walking . $google_language . "&om=" . $lmm_options[ 'directions_googlemaps_overview_map' ];
					} else if ($lmm_options['directions_provider'] == 'yours') {
						$directionslink = "http://www.yournavigation.org/?tlat=" . $marker['mlat'] . "&tlon=" . $marker['mlon'] . "&v=" . $lmm_options[ 'directions_yours_type_of_transport' ] . "&fast=" . $lmm_options[ 'directions_yours_route_type' ] . "&layer=" . $lmm_options[ 'directions_yours_layer' ];
					} else if ($lmm_options['directions_provider'] == 'ors') {
						$directionslink = "http://openrouteservice.org/?pos=" . $marker['mlon'] . "," . $marker['mlat'] . "&wp=" . $marker['mlon'] . "," . $marker['mlat'] . "&zoom=" . $marker['mzoom'] . "&routeWeigh=" . $lmm_options[ 'directions_ors_routeWeigh' ] . "&routeOpt=" . $lmm_options[ 'directions_ors_routeOpt' ] . "&layer=" . $lmm_options[ 'directions_ors_layer' ];
					} else if ($lmm_options['directions_provider'] == 'bingmaps') {
						if ( $marker['maddress'] != NULL ) { $bing_to = '_' . urlencode($marker['maddress']); } else { $bing_to = ''; }
						$directionslink = "http://www.bing.com/maps/default.aspx?v=2&rtp=pos___e_~pos." . $marker['mlat'] . "_" . $marker['mlon'] . $bing_to;
					}
					echo ','.PHP_EOL.'"dlink":"' . $directionslink . '"';
				}
				if ($full == 1) {
					echo ','.PHP_EOL.'"openpopup":"' . $marker['mopenpopup'] . '",'.PHP_EOL;
					echo '"mapwidth":"' . $marker['mmapwidth'] . '",'.PHP_EOL;
					echo '"mapwidthunit":"' . $marker['mmapwidthunit'] . '",'.PHP_EOL;
					echo '"mapheight":"' . $marker['mmapheight'] . '",'.PHP_EOL;
					echo '"marker-createdby":"' . stripslashes($marker['mcreatedby']) . '",'.PHP_EOL;
					echo '"marker-createdon":"' . $marker['mcreatedon'] . '",'.PHP_EOL;
					echo '"marker-updatedby":"' . stripslashes($marker['mupdatedby']) . '",'.PHP_EOL;
					echo '"marker-updatedon":"' . stripslashes($marker['mupdatedon']) . '",'.PHP_EOL;
					echo '"layerid":[';
					$assigned_layers = json_decode($marker['mlayer']);
					$assigned_layers_sanitized = array();
					foreach ($assigned_layers as $assigned_layer) {
						$assigned_layers_sanitized[] = '"' . $assigned_layer . '"';
					}

					echo implode( ', ', $assigned_layers_sanitized ) . '],'.PHP_EOL;
					echo '"layername":"' . stripslashes(preg_replace('/[\x00-\x1F\x7F]/', '', $marker['lname'])) . '",'.PHP_EOL;
					echo '"layer-createdby":"' . $marker['lcreatedby'] . '",'.PHP_EOL;
					echo '"layer-createdon":"' . $marker['lcreatedon'] . '",'.PHP_EOL;
					echo '"layer-updatedby":"' . stripslashes($marker['lupdatedby']) . '",'.PHP_EOL;
					echo '"layer-updatedon":"' . stripslashes($marker['lupdatedon']) . '",'.PHP_EOL;
					echo '"controlbox":"'.$marker['mcontrolbox'].'",'.PHP_EOL;
					echo '"overlays_custom":"'.$marker['moverlays_custom'].'",'.PHP_EOL;
					echo '"overlays_custom2":"'.$marker['moverlays_custom2'].'",'.PHP_EOL;
					echo '"overlays_custom3":"'.$marker['moverlays_custom3'].'",'.PHP_EOL;
					echo '"overlays_custom4":"'.$marker['moverlays_custom4'].'",'.PHP_EOL;
					echo '"wms":"'.$marker['mwms'].'",'.PHP_EOL;
					echo '"wms2":"'.$marker['mwms2'].'",'.PHP_EOL;
					echo '"wms3":"'.$marker['mwms3'].'",'.PHP_EOL;
					echo '"wms4":"'.$marker['mwms4'].'",'.PHP_EOL;
					echo '"wms5":"'.$marker['mwms5'].'",'.PHP_EOL;
					echo '"wms6":"'.$marker['mwms6'].'",'.PHP_EOL;
					echo '"wms7":"'.$marker['mwms7'].'",'.PHP_EOL;
					echo '"wms8":"'.$marker['mwms8'].'",'.PHP_EOL;
					echo '"wms9":"'.$marker['mwms9'].'",'.PHP_EOL;
					echo '"wms10":"'.$marker['mwms10'].'",'.PHP_EOL;
					echo '"kml_timestamp":"'.$marker['mkml_timestamp'].'",'.PHP_EOL;
					echo '"gpx_url":"'.esc_url($marker['mgpx_url']).'",'.PHP_EOL;
					echo '"gpx_panel":"'.$marker['mgpx_panel'].'",'.PHP_EOL;
					echo '"mlm_filter":"'.$marker['mlm_filter'].'",'.PHP_EOL;
					echo '"mlm_filter_details":"'.$marker['mlm_filter_details'].'"'.PHP_EOL;
				}
				echo '}}';
		  }
		} //info: end ($layer != NULL)
		echo ']}';
		//info: callback for JSONP - part 2
		if ($callback != NULL) { echo ');'; }
	} elseif (get_query_var('marker', false)) {
		$markerid_prepared = esc_sql(strtolower(get_query_var('marker')));
		$markerid = str_replace(array("b","c","d","e","f","g","h","i","j","k","m","n","o","p","q","r","s","t","u","v","w","x","y","z","$","%","#","-","_","'","\"","\\","(",")"), "", $markerid_prepared);
		if (($markerid_prepared == 'all') || ($markerid_prepared == '*')) {
			$q = '';
		} else {
			$markers = explode(',', $markerid);
			$checkedmarkers = array();
			foreach ($markers as $cmarker) {
				if (intval($cmarker) > 0) {
					$checkedmarkers[] = intval($cmarker);
				}
			}
			if (count($checkedmarkers) > 0) {
				$q = 'WHERE m.id IN ('.implode(',', $checkedmarkers).')';
			} else {
				die('Error: a marker with that ID does not exist!');
			}
		}
		//info: added left outer join to also show markers without a layer
		if ($full == 0) {
			$sql = 'SELECT m.id as mid, m.lat as mlat, m.lon as mlon, m.markername as mmarkername, m.icon as micon, m.popuptext as mpopuptext, m.address as maddress, m.zoom as mzoom FROM '.$table_name_markers.' AS m '.$q;
		} else {
			$sql = 'SELECT m.id as mid, m.markername as mmarkername, m.layer as mlayer, m.icon as micon, m.createdby as mcreatedby, m.createdon as mcreatedon, m.updatedby as mupdatedby, m.updatedon as mupdatedon,m.zoom as mzoom, m.basemap as mbasemap, m.lat as mlat, m.lon as mlon, m.openpopup as mopenpopup, m.popuptext as mpopuptext, m.mapwidth as mmapwidth, m.mapwidthunit as mmapwidthunit, m.mapheight as mmapheight, m.controlbox as mcontrolbox, m.overlays_custom as moverlays_custom, m.overlays_custom2 as moverlays_custom2, m.overlays_custom3 as moverlays_custom3, m.overlays_custom4 as moverlays_custom4, m.wms as mwms, m.wms2 as mwms2, m.wms3 as mwms3, m.wms4 as mwms4, m.wms5 as mwms5, m.wms6 as mwms6, m.wms7 as mwms7, m.wms8 as mwms8, m.wms9 as mwms9, m.wms10 as mwms10, m.kml_timestamp as mkml_timestamp, m.address as maddress, m.gpx_url as mgpx_url, m.gpx_panel as mgpx_panel, l.createdby as lcreatedby, l.createdon as lcreatedon, l.updatedby as lupdatedby, l.updatedon as lupdatedon, l.name AS lname FROM `'.$table_name_markers.'` AS m LEFT JOIN `'.$table_name_layers.'` AS l ON m.layer LIKE concat(\'%"\',l.id,\'"%\') '.$q;
		}
		$markers = $wpdb->get_results($sql, ARRAY_A);
		//info: prepare WPML supported strings
		if ($ml_checked = MMP_Globals::check_multilingual()) {
			foreach ($markers as $key => $marker) {
				$markers[$key]['mmarkername'] = MMP_Globals::translate_single_string($marker['mmarkername'], "Marker (ID {$marker['mid']}) name", $ml_checked);
				$markers[$key]['maddress'] = MMP_Globals::translate_single_string($marker['maddress'], "Marker (ID {$marker['mid']}) address", $ml_checked);
				$markers[$key]['mpopuptext'] = MMP_Globals::translate_single_string($marker['mpopuptext'], "Marker (ID {$marker['mid']}) popuptext", $ml_checked);
			}
		}

		$first = true;
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json; charset=utf-8');
		//info: callback for JSONP - part 1
		if ($callback != NULL) {
			echo $callback . '(';
		}
		echo '{"type":"FeatureCollection",'.PHP_EOL;
		echo '"features":['.PHP_EOL;
		foreach ($markers as $marker) {
			if ($first) $first = false;
			else echo ','.PHP_EOL;
			echo '{'.PHP_EOL;
			echo '"type":"Feature",'.PHP_EOL;
			echo '"geometry":'.PHP_EOL;
			echo '{'.PHP_EOL;
			echo '"type":"Point",'.PHP_EOL;
			echo '"coordinates":[' . $marker['mlon'] . ',' . $marker['mlat'] . ']'.PHP_EOL;
			echo '},'.PHP_EOL;
			echo '"properties":'.PHP_EOL;
			echo '{'.PHP_EOL;
				echo '"markerid":"'.$marker['mid'].'",'.PHP_EOL;
				echo '"markername":"' . wp_specialchars_decode(stripslashes(esc_js(preg_replace('/[\x00-\x1F\x7F]/', '', $marker['mmarkername'])))) . '",'.PHP_EOL;
			if ($full == 1) {
				echo '"basemap":"'.$marker['mbasemap'].'",'.PHP_EOL;
				echo '"lat":"'.$marker['mlat'].'",'.PHP_EOL;
				echo '"lon":"'.$marker['mlon'].'",'.PHP_EOL;
			}
			echo '"icon":"'.$marker['micon'].'",'.PHP_EOL;
			if ($full_icon_url == 'yes') {
				$marker_full_url = ($marker['micon'] == NULL) ? LEAFLET_PLUGIN_URL . "leaflet-dist/images/marker.png" : $defaults_marker_icon_url . "/" . $marker['micon'];
				echo '"iconUrl":"'.$marker_full_url.'",'.PHP_EOL;
			}
			$address_escaped = stripslashes(str_replace('"', '\'', preg_replace('/[\x00-\x1F\x7F]/', '', $marker['maddress'])));
			if ( ($full == 0) && ($lmm_options['directions_popuptext_panel'] == 'yes') ) {
				echo '"address":"'.$address_escaped.'",'.PHP_EOL;
			} else if ($full == 1) {
				echo '"address":"'.$address_escaped.'",'.PHP_EOL;
			}
			//info: remove control chars & sanitize output
			$mpopuptext_prepare = MMP_Globals::sanitize_popuptext($marker['mpopuptext'], true, true);
			//info: second run for do_shortcode() -> do not replace new lines/brs with <br/>!
			$mpopuptext = MMP_Globals::sanitize_popuptext(do_shortcode($mpopuptext_prepare), true);
			echo '"text":"' . $mpopuptext . '"';
			if ( ($lmm_options['directions_popuptext_panel'] == 'yes') || ($full == 1) ) {
					$mpopuptext_css = ($marker['mpopuptext'] != NULL) ? "border-top:1px solid #f0f0e7;padding-top:5px;margin-top:5px;" : "";
					if ($lmm_options['directions_provider'] == 'googlemaps') {
						if ( isset($lmm_options['google_maps_base_domain_custom']) && ($lmm_options['google_maps_base_domain_custom'] == NULL) ) { $gmaps_base_domain_directions = $lmm_options['google_maps_base_domain']; } else { $gmaps_base_domain_directions = urlencode($lmm_options['google_maps_base_domain_custom']); }
						if ( $marker['maddress'] != NULL ) { $google_from = urlencode($marker['maddress']); } else { $google_from = $marker['mlat'] . ',' . $marker['mlon']; }
						$avoidhighways = (isset($lmm_options[ 'directions_googlemaps_route_type_highways' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_highways' ] == 1 ) ? '&dirflg=h' : '';
						$avoidtolls = (isset($lmm_options[ 'directions_googlemaps_route_type_tolls' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_tolls' ] == 1 ) ? '&dirflg=t' : '';
						$publictransport = (isset($lmm_options[ 'directions_googlemaps_route_type_public_transport' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_public_transport' ] == 1 ) ? '&dirflg=r' : '';
						$walking = (isset($lmm_options[ 'directions_googlemaps_route_type_walking' ] ) == TRUE ) && ( $lmm_options[ 'directions_googlemaps_route_type_walking' ] == 1 ) ? '&dirflg=w' : '';
						$directionslink = "http://" . $gmaps_base_domain_directions . "/maps?daddr=" . $google_from . "&t=" . $lmm_options[ 'directions_googlemaps_map_type' ] . "&layer=" . $lmm_options[ 'directions_googlemaps_traffic' ] . "&doflg=" . $lmm_options[ 'directions_googlemaps_distance_units' ] . $avoidhighways . $avoidtolls . $publictransport . $walking . $google_language . "&om=" . $lmm_options[ 'directions_googlemaps_overview_map' ];
					} else if ($lmm_options['directions_provider'] == 'yours') {
						$directionslink = "http://www.yournavigation.org/?tlat=" . $marker['mlat'] . "&tlon=" . $marker['mlon'] . "&v=" . $lmm_options[ 'directions_yours_type_of_transport' ] . "&fast=" . $lmm_options[ 'directions_yours_route_type' ] . "&layer=" . $lmm_options[ 'directions_yours_layer' ];
					} else if ($lmm_options['directions_provider'] == 'ors') {
						$directionslink = "http://openrouteservice.org/?pos=" . $marker['mlon'] . "," . $marker['mlat'] . "&wp=" . $marker['mlon'] . "," . $marker['mlat'] . "&zoom=" . $marker['mzoom'] . "&routeWeigh=" . $lmm_options[ 'directions_ors_routeWeigh' ] . "&routeOpt=" . $lmm_options[ 'directions_ors_routeOpt' ] . "&layer=" . $lmm_options[ 'directions_ors_layer' ];
					} else if ($lmm_options['directions_provider'] == 'bingmaps') {
						if ( $marker['maddress'] != NULL ) { $bing_to = '_' . urlencode($marker['maddress']); } else { $bing_to = ''; }
						$directionslink = "http://www.bing.com/maps/default.aspx?v=2&rtp=pos___e_~pos." . $marker['mlat'] . "_" . $marker['mlon'] . $bing_to;
					}
					echo ','.PHP_EOL.'"dlink":"' . $directionslink . '"';
			}
			if ($full == 1) {
				echo ','.PHP_EOL.'"zoom":"' . $marker['mzoom'] . '",'.PHP_EOL;
				echo '"openpopup":"' . $marker['mopenpopup'] . '",'.PHP_EOL;
				echo '"mapwidth":"' . $marker['mmapwidth'] . '",'.PHP_EOL;
				echo '"mapwidthunit":"' . $marker['mmapwidthunit'] . '",'.PHP_EOL;
				echo '"mapheight":"' . $marker['mmapheight'] . '",'.PHP_EOL;
				echo '"marker-createdby":"' . stripslashes($marker['mcreatedby']) . '",'.PHP_EOL;
				echo '"marker-createdon":"' . $marker['mcreatedon'] . '",'.PHP_EOL;
				echo '"marker-updatedby":"' . stripslashes($marker['mupdatedby']) . '",'.PHP_EOL;
				echo '"marker-updatedon":"' . stripslashes($marker['mupdatedon']) . '",'.PHP_EOL;
				echo '"layerid":[';
				$assigned_layers = json_decode($marker['mlayer']);
				$assigned_layers_sanitized = array();
				foreach ($assigned_layers as $assigned_layer) {
					$assigned_layers_sanitized[] = '"' . $assigned_layer . '"';
				}
				echo implode( ', ', $assigned_layers_sanitized ) . '],'.PHP_EOL;
				echo '"layername":"' . stripslashes(preg_replace('/[\x00-\x1F\x7F]/', '', $marker['lname'])) . '",'.PHP_EOL;
				echo '"layer-createdby":"' . $marker['lcreatedby'] . '",'.PHP_EOL;
				echo '"layer-createdon":"' . $marker['lcreatedon'] . '",'.PHP_EOL;
				echo '"layer-updatedby":"' . stripslashes($marker['lupdatedby']) . '",'.PHP_EOL;
				echo '"layer-updatedon":"' . stripslashes($marker['lupdatedon']) . '",'.PHP_EOL;
				echo '"controlbox":"'.$marker['mcontrolbox'].'",'.PHP_EOL;
				echo '"overlays_custom":"'.$marker['moverlays_custom'].'",'.PHP_EOL;
				echo '"overlays_custom2":"'.$marker['moverlays_custom2'].'",'.PHP_EOL;
				echo '"overlays_custom3":"'.$marker['moverlays_custom3'].'",'.PHP_EOL;
				echo '"overlays_custom4":"'.$marker['moverlays_custom4'].'",'.PHP_EOL;
				echo '"wms":"'.$marker['mwms'].'",'.PHP_EOL;
				echo '"wms2":"'.$marker['mwms2'].'",'.PHP_EOL;
				echo '"wms3":"'.$marker['mwms3'].'",'.PHP_EOL;
				echo '"wms4":"'.$marker['mwms4'].'",'.PHP_EOL;
				echo '"wms5":"'.$marker['mwms5'].'",'.PHP_EOL;
				echo '"wms6":"'.$marker['mwms6'].'",'.PHP_EOL;
				echo '"wms7":"'.$marker['mwms7'].'",'.PHP_EOL;
				echo '"wms8":"'.$marker['mwms8'].'",'.PHP_EOL;
				echo '"wms9":"'.$marker['mwms9'].'",'.PHP_EOL;
				echo '"wms10":"'.$marker['mwms10'].'",'.PHP_EOL;
				echo '"kml_timestamp":"'.$marker['mkml_timestamp'].'",'.PHP_EOL;
				echo '"gpx_url":"'.esc_url($marker['mgpx_url']).'",'.PHP_EOL;
				echo '"gpx_panel":"'.$marker['mgpx_panel'].'"'.PHP_EOL;
			}
			echo '}}';
		}
		echo ']}';
		//info: callback for JSONP - part 2
		if ($callback != NULL) { echo ');'; }
	}
} //info: end plugin active check
