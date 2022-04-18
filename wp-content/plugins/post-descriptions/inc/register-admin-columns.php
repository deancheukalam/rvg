<?php
/** 
* Adds a description column in the page and post overview
*/
function postdescriptions_add_description_column( $columns ) {
	$new_columns = array(
		'_description' => esc_html__('Description', 'postdescriptions'),
	);
	return array_merge( $columns, $new_columns );
}
add_filter( 'manage_post_posts_columns',  'postdescriptions_add_description_column' );
add_filter( 'manage_page_posts_columns',  'postdescriptions_add_description_column' );