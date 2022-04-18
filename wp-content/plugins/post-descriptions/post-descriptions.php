<?php
/**
 * Plugin Name: Post Descriptions
 * Description: A very lightweight plugin to add short descriptions and to-do's to your posts and pages. A nice way to remind yourself and others of small tasks or post purposes.
 * Version: 1.2.1
 * Author: Tom de Visser
 * Author URI: https://profiles.wordpress.org/tomjdevisser/
 * License: GPLv2
 * Text Domain: post-descriptions
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die;

add_action('plugins_loaded', function() {
	load_plugin_textdomain( 'post-descriptions', false, __DIR__ );
});

// Add a settings link
function postdescriptions_settings_link( $links ) {
	$url = get_admin_url() . 'options-general.php?page=postdescriptions';
	$settings_link = '<a href="' . $url . '">' . __( 'Settings', 'post-descriptions' ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}
 
function postdescriptions_after_setup_theme() {
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'postdescriptions_settings_link' );
}
add_action ( 'after_setup_theme', 'postdescriptions_after_setup_theme' );

// Register the color picker from jQuery to choose your own important color
function postdescriptions_enqueue_color_picker( $hook_suffix ) {
	if ( 'settings_page_postdescriptions' !== $hook_suffix ) {
		return;
	}
	// first check that $hook_suffix is appropriate for your admin page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'color-picker-script', plugins_url('/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'postdescriptions_enqueue_color_picker' );

/**
 * Load all necessary files.
 */
include 'inc/settings.php';
include 'inc/add-post-states.php';
include 'inc/register-admin-columns.php';
include 'inc/admin-columns.php';
include 'inc/add-quick-edit.php';

if ( get_option( 'description-states' ) ) {
	include 'inc/update-post-states.php';
}