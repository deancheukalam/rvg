<?php
/*
	Plugin Name: Post List With Featured Image
	Plugin URI: http://www.angelwebsolution.in/
	Version: 1.2
	Author: Dharmesh Patel
	Description: This plugin is use to Show new Column with Featured Image at Post list to admin side on "Edit.php" Page.
*/
if (!defined('ABSPATH')) {
	exit;
}
add_filter( 'plugin_row_meta', 'wk_plugin_row_meta', 10, 2 );
function wk_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'Invisible Baba'    => '<a href="' . esc_url( 'http://invisiblebaba.com/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Get More Exciting', 'domain' ) . '" style="color:green;">' . esc_html__( 'Invisible Baba', 'domain' ) . '</a>'
        );

        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}
include_once(plugin_dir_path(__FILE__)."post_image.php");
include_once(plugin_dir_path(__FILE__)."post_image_admin.php");