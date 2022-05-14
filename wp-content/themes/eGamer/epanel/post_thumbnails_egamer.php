<?php 

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
	
	add_theme_support( 'post-thumbnails' );
		
	//default.php, blogstylehome.php
	add_image_size( 'featuredimage', 619, 253, true );
	
	//default.php
	add_image_size( 'homeimage', 90, 90, true );
		
	//page.php
	add_image_size( 'thumbpage', get_option($shortname.'_thumbnail_width_pages'), get_option($shortname.'_thumbnail_height_pages'), true );
	
	//thumbnail.php
	add_image_size( 'globalimage', get_option($shortname.'_thumbnail_width_posts'), get_option($shortname.'_thumbnail_height_posts'), true );
	
	//defaultcat.php, defaultindex.php
	add_image_size( 'defaultimage', get_option($shortname.'_thumbnail_width_index'), get_option($shortname.'_thumbnail_height_index'), true );
	
	//rating.php
	add_image_size( 'ratingimage', 43, 43, true );
	
};
/* --------------------------------------------- */

?>