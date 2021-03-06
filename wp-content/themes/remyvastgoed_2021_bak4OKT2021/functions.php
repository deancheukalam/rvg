<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

  /**
   * Register our sidebars and widgetized areas.
   *
   */
  function arphabet_widgets_init() {

      register_sidebar( array(
          'name'          => 'Sidebar',
          'id'            => 'sidebar',
          'before_widget' => '<div id="%1$s" class="widget_item %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2 class="rounded">',
          'after_title'   => '</h2>',
      ) );

      register_sidebar( array(
        'name'          => 'Header Search',
        'id'            => 'header_search',
        'before_widget' => '<div id="%1$s" class="header-search %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
    
      register_sidebar( array(
          'name'          => 'Sidebar sub',
          'id'            => 'sidebar_sub',
          'before_widget' => '<div id="%1$s" class="sidebar_sub popup_content %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
      register_sidebar( array(
          'name'          => 'Sidebar aankoopbemiddeling',
          'id'            => 'sidebar_aankoopbemiddeling',
          'before_widget' => '<div id="%1$s" class="sidebar_aankoopbemiddeling %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2 class="rounded">',
          'after_title'   => '</h2>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort koopwoningen',
          'id'            => 'sort_filter_koopwoningen',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort percelen',
          'id'            => 'sort_filter_percelen',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort verkavelingsproj',
          'id'            => 'sort_filter_verkavelingsproj',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort huurwoningen',
          'id'            => 'sort_filter_huurwoningen',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort vakantieacc',
          'id'            => 'sort_filter_vakantieacc',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelperc',
          'id'            => 'sort_filter_commercieelperc',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelkoopp',
          'id'            => 'sort_filter_commercieelkoopp',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelhuurp',
          'id'            => 'sort_filter_commercieelhuurp',
          'before_widget' => '<div id="%1$s" class="sort_filter %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );

    register_sidebar( array(
        'name'          => 'Mobile search',
        'id'            => 'mobilesearch',
        'before_widget' => '<div id="mobilesearch">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

  }
  add_action( 'widgets_init', 'arphabet_widgets_init' );

/* Hide WP version strings from generator meta tag */
function wpmudev_remove_version() {
return '';
}
add_filter('the_generator', 'wpmudev_remove_version');

function register_remy_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'sub-menu' => __( 'Sub Menu' )
    )
  );
}
add_action( 'init', 'register_remy_menus' );


// Set Featured Image Custom Plugin By Bob
function mytheme_post_thumbnails() {
  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mytheme_post_thumbnails' );


function glisStickers(){
  if (in_category('PerceelsID toegekend')) {
      echo '<span class="toegekend glis_icon"></span>';
  } else if (in_category('PerceelsID aangevraagd')) {
      echo '<span class="aangevraagd glis_icon"></span>';
  } else if (in_category('Stichtingovername mogelijk')) {
      echo '<span class="stgovername glis_icon"></span>';
  }
}

?>