<?php
// Elementor integration
include_once( ABSPATH . 'wp-admin/includes/plugin.php');
if(is_plugin_active('elementor/elementor.php') ) {
if(!defined('ABSPATH')) exit;



class gg_on_elementor {
	private $widgets_basepath = '';

	
	public function __construct() {
		/*** store common arrays into globals ***/
		
		// galleries array
		$args = array(
			'post_type' => 'gg_galleries',
			'numberposts' => -1,
			'post_status' => 'publish'
		);
		$galleries = get_posts($args);
		
		$galls_arr = array(); 
		foreach($galleries as $gallery) {
			$galls_arr[ $gallery->ID ] = $gallery->post_title;
		}
		$GLOBALS['gg_emtr_galls'] = $galls_arr;
		
		
		// GGOM - overlays array
		if(defined('GGOM_DIR')) {
			register_taxonomy_ggom(); // be sure tax are registered
			$overlays = get_terms('ggom_overlays', 'hide_empty=0');
			
			$ol_arr = array(
				'default' => __('default one', 'gg_ml')
			);
			foreach($overlays as $ol) {
				$ol_arr[ $ol->term_id ] = $ol->name;	
			}
			$GLOBALS['gg_emtr_overlays'] = $ol_arr;
		}
		
		
		/*** enqueue ***/
		$this->widgets_basepath = GG_DIR .'/builders_integration/elementor_elements';
		
		add_action('elementor/widgets/widgets_registered', array( $this, 'register_gg_gallery'));
		add_action('elementor/widgets/widgets_registered', array( $this, 'register_gg_itg'));
		add_action('elementor/widgets/widgets_registered', array( $this, 'register_gg_collection'));
		add_action('elementor/widgets/widgets_registered', array( $this, 'register_gg_slider'));
		add_action('elementor/widgets/widgets_registered', array( $this, 'register_gg_carousel'));
	}
		 
		 
	
	// gallery
	public function register_gg_gallery() {
		include_once($this->widgets_basepath .'/gallery.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new gg_gallery_on_elementor() );
	}
	
	// image-to-gallery
	public function register_gg_itg() {
		include_once($this->widgets_basepath .'/itg.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new gg_itg_on_elementor() );
	}
	
	// collection
	public function register_gg_collection() {
		include_once($this->widgets_basepath .'/collection.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new gg_collection_on_elementor() );
	}
	
	// slider
	public function register_gg_slider() {
		include_once($this->widgets_basepath .'/slider.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new gg_slider_on_elementor() );
	}
	
	// carousel
	public function register_gg_carousel() {
		include_once($this->widgets_basepath .'/carousel.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new gg_carousel_on_elementor() );
	}
}
add_action('wp_loaded', function() {
	new gg_on_elementor();
}, 1);




// add Global Gallery section
add_action('elementor/init', function() {
   \Elementor\Plugin::$instance->elements_manager->add_category( 
   	'global-gallery',
   	array(
   		'title' => 'Global Gallery',
   		'icon' => 'fa fa-plug',
   	),
	3
   );
});



// style needed for LCweb icons
add_action('elementor/editor/after_enqueue_styles', function() {
	wp_enqueue_style('lcweb-elementor-icon', GG_URL .'/builders_integration/elementor_elements/lcweb_icon.css');	
});




////
} // end elementor's existence check