<?php
/**
* This function will update the post states
*/

function postdescriptions_update_states( $post_states, $post ) {
	$post_description = get_post_meta( $post->ID, 'post_description', true );
	$is_important = get_post_meta( $post->ID, 'important', true );
	$custom_color = get_option( 'important-color' );
	$important_color;
	if ( $custom_color ) {
		$important_color = $custom_color;
	} else {
		$important_color = '#cc0000';
	}
	if ( "1" === $is_important ) {
		if ( $post_description ) {
			// Add the important-state class, which lets JavaScript see if it's important when populating the Quick Edit fields
			$post_states['description'] = '<span class="important-state" style="color:' . $important_color . ';">' . $post_description . '</span>';
		} 
	} else {
		if ( $post_description ) {
			$post_states['description'] = '<span class="normal-state">' . $post_description . '</span>';
		}
	}
	return $post_states;
}
add_filter( 'display_post_states', 'postdescriptions_update_states', 10, 2 );