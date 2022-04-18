<?php 
  function setAjax() 
  {
    wp_enqueue_script( 'ajaxvalue.min.js', 
                        get_template_directory_uri().'/js/ajaxvalue.min.js', 
                       'jquery', 
                        true );
    wp_localize_script( 'ajaxvalue.min.js',
                        'use_ajax', 
                         array( 'ajaxurl'=>admin_url( 'admin-ajax.php' ) ) );  
  }  
  add_action( 'template_redirect','setAjax' ); 
  
  require_once( TEMPLATEPATH.'/object.php' );
  
  add_action( "wp_ajax_nopriv_getTitle","getTitle" );
  add_action( "wp_ajax_getTitle","getTitle" );  
  
require_once(TEMPLATEPATH . '/epanel/custom_functions.php'); 

require_once(TEMPLATEPATH . '/includes/functions/comments.php'); 

require_once(TEMPLATEPATH . '/includes/functions/sidebars.php'); 

load_theme_textdomain('eGamer',get_template_directory().'/lang');

require_once(TEMPLATEPATH . '/epanel/options_egamer.php');

require_once(TEMPLATEPATH . '/epanel/core_functions.php'); 

require_once(TEMPLATEPATH . '/epanel/post_thumbnails_egamer.php');

function MyAjaxFunction()
  {
    global $wpdb;  
  //get the data from ajax() call  
    $v = $_POST['v'];
    //$v = 10847;
    $t='';
    $query = "SELECT wp_posts.post_title
              FROM wp_posts
              LEFT OUTER JOIN wp_postmeta
              ON wp_posts.ID=wp_postmeta.post_id
              WHERE wp_postmeta.meta_value LIKE '".$v."'
              AND wp_posts.post_status='publish'
              AND wp_postmeta.meta_key='Objectnummer'
              ORDER BY wp_posts.post_date
              DESC"; 
    $rows = $wpdb->get_results( $query,ARRAY_N );
    if($rows)
    {
      foreach( $rows as $row ) 
      {  
       $t .= $row[ 0 ];
      } 
    }
    else
    {
     $t.='Anton Dragtenweg1';
    }
    echo $t;
   }
   add_action( 'wp_ajax_nopriv_ MyAjaxFunction', 'MyAjaxFunction' );  
   add_action( 'wp_ajax_ MyAjaxFunction', 'MyAjaxFunction' );  

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

$wp_ver = substr($GLOBALS['wp_version'],0,3);
if ($wp_ver >= 2.8) include(TEMPLATEPATH . '/includes/widgets.php'); ?>