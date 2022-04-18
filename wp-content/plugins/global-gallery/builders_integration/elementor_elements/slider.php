<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if(!defined('ABSPATH')) exit;



class gg_slider_on_elementor extends Widget_Base {
	
	 public function get_icon() {
      return 'emtr_lcweb_icon';
   }
	
	public function get_name() {
		return 'g-slider';
	}

	public function get_categories() {
		return array('global-gallery');
	}

   public function get_title() {
      return 'GG - '. __('Slider', 'gg_ml');
   }



   protected function _register_controls() {

		$this->start_controls_section(
			'main',
			array(
				'label' => 'Global Gallery - '. __('Slider details', 'gg_ml'),
			)
		);
  
  
		$this->add_control(
		   'gid',
		   array(
			  'label' 	=> __('Images source', 'gg_ml'),
			  'type' 	=> Controls_Manager::SELECT,
			  'default' => current(array_keys($GLOBALS['gg_emtr_galls'])),
			  'options' => $GLOBALS['gg_emtr_galls']
		   )
		);
		
		$this->add_control(
		   'width',
		   array(
			  	'label' => __("Slider's width", 'gg_ml'),
			  	'type' => Controls_Manager::SLIDER,
				'size_units' => array('%', 'px'),
				'default' => array(
					'unit' => '%',
					'size' => 100,
				),
				'range' => array(
					'%' => array(
						'max' => 100,
						'min' => 10,
						'step' => 1,
					),
					'px' => array(
						'max' => 2000,
						'min' => 300,
						'step' => 10,
					),
				),
		   )
		);
		
		$this->add_control(
		   'height',
		   array(
			  	'label' => __("Slider's height", 'gg_ml'),
				'description' => __('Using % value, height is proportional to width', 'gg_ml'),
			  	'type' => Controls_Manager::SLIDER,
				'size_units' => array('%', 'px'),
				'default' => array(
					'unit' => '%',
					'size' => 55,
				),
				'range' => array(
					'%' => array(
						'max' => 100,
						'min' => 10,
						'step' => 1,
					),
					'px' => array(
						'max' => 1500,
						'min' => 100,
						'step' => 10,
					),
				),
		   )
		);
		
		$this->add_control(
		   'random',
		   array(
			  'label' 		=> __('Random images?', 'gg_ml'),
			  'description'	=> __('Displays images randomly', 'gg_ml'),
			  'type' 		=> Controls_Manager::SWITCHER,
			  'default' 	=> '',
			  'label_on' 	=> __('Yes'),
			  'label_off' 	=> __('No'),
			  'return_value' => '1',
		   )
		);
		
		$this->add_control(
		   'watermark',
		   array(
			  'label' 		=> __('Use Watermark?', 'gg_ml'),
			  'description'	=> __('Applies watermark to images (where available)', 'gg_ml'),
			  'type' 		=> Controls_Manager::SWITCHER,
			  'default' 	=> '',
			  'label_on' 	=> __('Yes'),
			  'label_off' 	=> __('No'),
			  'return_value' => '1',
		   )
		);
		
		$this->add_control(
		   'autoplay',
		   array(
			  'label' 	=> __('Autoplay slider?', 'gg_ml'),
			  'type' 	=> Controls_Manager::SELECT,
			  'default' => 'auto',
			  'options' => array(
			  	'auto' => __('(as default)', 'gg_ml'),
				1 => __('Yes', 'gg_ml'),
				0 => __('No', 'gg_ml')
			  )
		   )
		);
		
		$this->end_controls_section();
   }


	
	////////////////////////


	protected function render() {
     	$vals = $this->get_settings();
		//var_dump($vals);

		// create strings for height and width
		$vals['width'] = $vals['width']['size'].$vals['width']['unit'];
		$vals['height'] = $vals['height']['size'].$vals['height']['unit'];


		$parts = array('gid', 'width', 'height', 'random', 'watermark', 'autoplay');
		$params = '';
		
		foreach($parts as $part) {
			$params .= $part.'="';

			if(!isset($vals[$part])) {$vals[$part] = '';}
			$params .= $vals[$part].'" ';	
		}
		
		echo do_shortcode('[g-slider '. $params .']');
	}


	protected function _content_template() {}
}
