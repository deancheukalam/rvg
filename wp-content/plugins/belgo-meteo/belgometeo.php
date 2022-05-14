<?php
/*
Plugin Name: BelgoMeteo
Plugin URI: http://www.wordpress.org/extend/plugins/belgo-meteo/
Description: Displays belgian weather info in a widget
Version: 1.0.2
Author: <a href="http://www.worldinmyeyes.be/about/">Benoit De Boeck</a>
Author URI: http://www.worldinmyeyes.be
License: GPL2

    Copyright 2013  Benoit De Boeck  (email : ben [a t ] worldinmyeyes DOT be)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
            // Style //
            function belgometeo_style() {
            wp_register_style('belgometeo', content_url().'/plugins/belgo-meteo/belgometeo.css');
            wp_enqueue_style('belgometeo');
            }
            add_action('wp_print_styles','belgometeo_style');

	// Start class belgo_meteo //

	class belgo_meteo extends WP_Widget {

	// Constructor //

		function belgo_meteo() {
			$widget_ops = array( 'classname' => 'belgo_meteo', 'description' => 'Displays belgian weather in a widget' ); // Widget Settings
			$control_ops = array( 'id_base' => 'belgo_meteo' ); // Widget Control Settings
			$this->WP_Widget( 'belgo_meteo', 'Belgo Meteo', $widget_ops, $control_ops ); // Create the widget                      
		}

	// Extract Args //

		function widget($args, $instance) {
			extract( $args );
			$title 		= apply_filters('widget_title', $instance['title']); // widget title
			$type 	= $instance['type']; // type of weather info to show (prev_irm for IRM forecast, obs_irm for IRM observations, met_bel for Meteo Belgique forecast, bui_rad for buienradar rain info)
			$postcode 	= $instance['postcode']; // post code of location to display
                        $region = $instance['region']; // region for IRM forecast
                        $language = $instance['language']; // language to use: fr/nl/de/en
                        $translations = array(
                            'fr' => array('titlePrevIRM' => 'Prévisions IRM', 'titleObsIRM' => 'Observations IRM'),
                            'nl' => array('titlePrevIRM' => 'Verwachtingen KMI', 'titleObsIRM' => 'Waarnemingen KMI'),
                            'de' => array('titlePrevIRM' => 'Vorhersage KMI', 'titleObsIRM' => 'Messwerte KMI'),
                            'en' => array('titlePrevIRM' => 'Forecast RMI', 'titleObsIRM' => 'Observations RMI')
                        );

	// Before widget //

			echo $before_widget;

	// Title of widget //

			if ( $title ) { echo $before_title . $title . $after_title; }

	// Widget output //

if($type == 'prev_irm' || $type == 'both_irm') { ?>
<div class="belgo_meteo_center">
<?php if($type == 'both_irm') {
    echo '<h3>'.$translations[$language]['titlePrevIRM'].'</h3>';
 } ?>
<script src="http://www.meteo.be/meteo/view/<?php echo $language; ?>/1370090?filter=<?php echo $region; ?>" type="text/javascript"></script>
</div>
<?php
}
if($type == 'obs_irm' || $type == 'both_irm') { ?>
<div class="belgo_meteo_center">
<?php if($type == 'both_irm') {
    echo '<h3>'.$translations[$language]['titleObsIRM'].'</h3>';
 } ?>
<script src='http://www.meteo.be/meteo/view/<?php echo $language; ?>/1370090?postalcode=<?php echo $postcode; ?>' type='text/javascript' > </script>
</div>
<?php
}
if($type == 'met_bel') { ?>
<div class="belgo_meteo_center belgo_meteo_metbel">
    <iframe src="http://www.meteobelgium.be/service/<?php echo (($language == 'fr' || $language == 'nl') ? $language : 'fr'); ?>/code3day/index.php?code=<?php echo $postcode; ?>&type=ville" 
    allowtransparency="false" align="center" frameborder="0" width="225" height="150" 
    scrolling="no" marginwidth="0" marginheight="0">
    </iframe>
</div>
<?php
}
if($type == 'bui_rad') { ?>
<div class="belgo_meteo_center">
<a href="http://www.meteox.be" target=_blank><img border=0 src="http://www.meteox.be/images.aspx?jaar=-3&bliksem=0&voor=&soort=loop1uur1x1kln250"></a>
     </div>
 <?php
 }

 // After widget //

			echo $after_widget;
		}

	// Update Settings //

		function update($new_instance, $old_instance) {
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['type'] = strip_tags($new_instance['type']);
			$instance['postcode'] = strip_tags($new_instance['postcode']);
                        $instance['region'] = strip_tags($new_instance['region']);
			$instance['language'] = strip_tags($new_instance['language']);
			return $instance;
		}

	// Widget Control Panel //

                                
		function form($instance) {

		$defaults = array (
                        'title' => 'Weather in Belgium', 'type' => 'obs_irm', 'postcode' => '0', 'region' => '6447', 'language' => 'en'
                    );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
                
                <p>
			<label for="<?php echo $this->get_field_id('language'); ?>">Language for display:</label>
			<select id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>" class="widefat" style="width:100%;">
				<option value="fr" <?php selected('fr', $instance['language']); ?>>Français</option>
				<option value="nl" <?php selected('nl', $instance['language']); ?>>Nederlands</option>
				<option value="de" <?php selected('de', $instance['language']); ?>>Deutsch</option>
				<option value="en" <?php selected('en', $instance['language']); ?>>English</option>
			</select>
		</p>                
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>">Type of info:</label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat" style="width:100%;">
				<option value="prev_irm" <?php selected('prev_irm', $instance['type']); ?>>IRM forecast</option>
				<option value="obs_irm" <?php selected('obs_irm', $instance['type']); ?>>IRM observations</option>
                                <option value="both_irm" <?php selected('both_irm', $instance['type']); ?>>IRM observations & forecast</option>
				<option value="met_bel" <?php selected('met_bel', $instance['type']); ?>>Meteo Belgique forecast</option>
				<option value="bui_rad" <?php selected('bui_rad', $instance['type']); ?>>Buien Radar rain observations</option>
			</select>
		</p>
                <?php
                $xml_file = plugin_dir_path(__FILE__).'postcodes.xml';
                $xml = simplexml_load_file($xml_file);
                $towns = $xml->xpath('//town');
                echo '<p>';
		echo '<label for="'. $this->get_field_id('postcode').'">';
                        _e('Location post code');
                        echo '</label>	<select id="'. $this->get_field_id('postcode').'" name="'. $this->get_field_name('postcode'). '" class="widefat" style="width:100%;">';
                        foreach($towns as $town) { ?>
                       <option value="<?php echo $town->postcode; ?>" <?php selected($town->postcode, $instance['postcode']); ?>><?php echo $town->fullname; ?></option><?php }?>
                        </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('region'); ?>">Region for IRM forecast:</label>
			<select id="<?php echo $this->get_field_id('region'); ?>" name="<?php echo $this->get_field_name('region'); ?>" class="widefat" style="width:100%;">
				<option value="6407" <?php selected('6407', $instance['region']); ?>>Coast</option>
				<option value="6447" <?php selected('6447', $instance['region']); ?>>Center</option>
                                <option value="6479" <?php selected('6479', $instance['region']); ?>>Kempen/Campine (N)</option>
				<option value="6476" <?php selected('6476', $instance['region']); ?>>Ardenne (SE)</option>
				<option value="6480" <?php selected('6480', $instance['region']); ?>>Belgian Lorraine (Extreme SE)</option>
			</select>

        <?php }
}

// End class belgo_meteo

add_action('widgets_init', create_function('', 'return register_widget("belgo_meteo");'));
?>