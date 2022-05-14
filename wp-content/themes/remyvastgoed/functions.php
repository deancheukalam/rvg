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
          'before_widget' => '<div class="widget_item">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2 class="rounded">',
          'after_title'   => '</h2>',
      ) );
    
      register_sidebar( array(
          'name'          => 'Sidebar sub',
          'id'            => 'sidebar_sub',
          'before_widget' => '<div class="sidebar_sub popup_content">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
      register_sidebar( array(
          'name'          => 'Sidebar aankoopbemiddeling',
          'id'            => 'sidebar_aankoopbemiddeling',
          'before_widget' => '<div class="sidebar_aankoopbemiddeling">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2 class="rounded">',
          'after_title'   => '</h2>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort koopwoningen',
          'id'            => 'sort_filter_koopwoningen',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort percelen',
          'id'            => 'sort_filter_percelen',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );

    register_sidebar( array(
          'name'          => 'Sort gated community percelen',
          'id'            => 'sort_filter_gatedcommunitypercelen',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );

    register_sidebar( array(
          'name'          => 'Sort gated community woningen',
          'id'            => 'sort_filter_gatedcommunitywoningen',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );

    register_sidebar( array(
          'name'          => 'Sort Bellegingspanden',
          'id'            => 'sort_filter_beleggingspanden',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort verkavelingsproj',
          'id'            => 'sort_filter_verkavelingsproj',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort huurwoningen',
          'id'            => 'sort_filter_huurwoningen',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort vakantieacc',
          'id'            => 'sort_filter_vakantieacc',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelperc',
          'id'            => 'sort_filter_commercieelperc',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelkoopp',
          'id'            => 'sort_filter_commercieelkoopp',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );
    
    register_sidebar( array(
          'name'          => 'Sort commercieelhuurp',
          'id'            => 'sort_filter_commercieelhuurp',
          'before_widget' => '<div class="sort_filter">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="rounded">',
          'after_title'   => '</p>',
      ) );

  }
  add_action( 'widgets_init', 'arphabet_widgets_init' );

/* Hide WP version strings from generator meta tag */
function wpmudev_remove_version() {
return '';
}
add_filter('the_generator', 'wpmudev_remove_version');


// START No category parents
add_filter("pre_post_link", "filter_category"); // will apply to post permalink
add_filter("user_trailingslashit", "myfilter_category");
add_filter("category_link", "filter_category_link"); // will apply to post permalink
add_filter('rewrite_rules_array', 'my_insert_rewrite_rules');
add_filter('query_vars', 'my_insert_query_vars');
add_action('wp_loaded', 'my_flush_rules');

// seems category filters are not working
add_action('created_category', 'my_flush_rules2');
add_action('edited_category', 'my_flush_rules2');
add_action('delete_category', 'my_flush_rules2');

// flush_rules() if our rules are not yet included
function my_flush_rules()
{
    update_option('category_base', '');
    $rules = get_option('rewrite_rules');
    //if ( ! isset( $rules['(.+?)-cat/?$'] ) ) { // have to comment this in order to refresh the rules
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
    //}
}

function my_flush_rules2()
{
    $rules = get_option('rewrite_rules');
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

// Adding a new rule
function my_insert_rewrite_rules($rules)
{
    global $wp_rewrite;
    $newrules = array();
    $newrules['(.+?)-cat/?$'] = 'index.php?category_name=$matches[1]';
    $newrules['(.+?)-cat/' . $wp_rewrite->pagination_base . '/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
    $categories = get_categories(array('hide_empty' => false));
    if ($categories) {
        foreach ($categories as $key => $val) {
            $posts = get_posts(array("name" => $val->slug));
            if (!$posts) {
                $newrules['(' . $val->category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
                $newrules['(' . $val->category_nicename . ')/' . $wp_rewrite->pagination_base . '/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
                $newrules['.+?/(' . $val->category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
                $newrules['.+?/(' . $val->category_nicename . ')/' . $wp_rewrite->pagination_base . '/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            }
        }
    }
    return $newrules + $rules;
}

function my_insert_query_vars($vars)
{
    array_push($vars, 'id');
    return $vars;
}

//add_filter('request', 'mycategory_rewrite_rules');
function mycategory_rewrite_rules()
{
    global $wp_rewrite;
    echo "<pre>";
    print_r($wp_rewrite);
    echo "</pre>";

//    [(.+?)/?$] => index.php?category_name=$matches[1]

}

function filter_category_link($termlink)
{
    if (preg_match("/\?cat=/", $termlink)) {
        return $termlink;
    }

    $str = explode("/", $termlink);
    $myslug = $slug = $str[count($str) - 2];
    // check if category slug exist in post
    $posts = get_posts(array("name" => $slug));
    preg_match("/category.*?" . $myslug . "/", $termlink, $result);
    if ($posts) {
        $slug .= "-cat";
    }
    $str = explode("/", $result[0]);
    if (count($str) > 3) {
        $link = $str[count($str) - 2] . "/" . $slug;
    } else {
        $link = $slug;
    }
    $termlink = preg_replace("/category.*?" . $myslug . "/", $link, $termlink);
    return $termlink;
}

function filter_category($permalink)
{
    $permalink = str_replace("%category%", "%mycategory%", $permalink);
    return $permalink;
}

function myfilter_category($string)
{
    if (preg_match("/%mycategory%/", $string)) {
        $str = explode("/", $string);
        $slug = $str[count($str) - 2];
        $posts = get_posts(array("name" => $slug));
        $cats = get_the_category($posts[0]->ID);
        if ($cats) {
            usort($cats, '_usort_terms_by_ID');
            $category = $cats[0]->slug;
            if ($parent = $cats[0]->parent) {
                $one = 1;
            }
        }
        $string = preg_replace("/%mycategory%/", $category, $string);
    }
    return $string;
}

// END No category parents


?>
<?php
// Set Featured Image Custom Plugin By Bob
function mytheme_post_thumbnails() {
  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mytheme_post_thumbnails' );
?>