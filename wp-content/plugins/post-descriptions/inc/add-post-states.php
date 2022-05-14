<?php
/**
* This function will add the post states
*/
function postdescriptions_add_states() {
	add_post_type_support( 'post', 'custom-fields' );
	add_post_type_support( 'page', 'custom-fields' );
}
add_action( 'init', 'postdescriptions_add_states' );

// Add custom post meta
function postdescriptions_add_states_post_meta() {
	add_meta_box( 
		'post-description', 
		__('Post Description', 'post-descriptions'), 
		'postdescriptions_post_description_meta_callback', 
		['post', 'page'], 
		'side', 
		'default', 
		null 
	);
}
add_action( 'add_meta_boxes', 'postdescriptions_add_states_post_meta' );

// Custom post meta callbacks
function postdescriptions_post_description_meta_callback( $post ) {
	wp_nonce_field( 'post_description_save_data', 'post_description_nonce' );
	$desc_value = get_post_meta( $post->ID, 'post_description', true );
	$important_value = get_post_meta( $post->ID, 'important', true );
	$html_output = '<textarea rows="5" class="components-form-token-field__input-container" name="post_description" style="margin-top: 16px;" placeholder="' . __('Your post description', 'post-descriptions') . '">' . esc_attr( $desc_value ) . '</textarea>';
	$html_output .= '<label for="important"><input type="checkbox" id="important" class="components-form-token-field__input-container" name="important-desc" value="1" ' . checked( 1, $important_value, false ) . ' />' . __( 'Make your description important', 'postdescriptions' ) . '</label>';
	echo $html_output;
}

// Save custom post description
function postdescriptions_save_postdescription( $post_id ) {
	// Checks the nonce for extra security
	if ( ! isset( $_POST['post_description_nonce'] ) ) return; 
	if ( ! wp_verify_nonce( $_POST['post_description_nonce'], 'post_description_save_data' ) ) return;

	// Doesn't save on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 

	// Checks if user has the right capability to edit the page or post
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return; 
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return; 
	}

	// Checks if there is input
	if ( isset( $_POST['post_description'] ) ) { 
		// Sanitizes the input and saves it to the post meta
		$post_description = sanitize_text_field( $_POST['post_description'] );
		update_post_meta( $post_id, 'post_description', $post_description );
	}

	if ( isset( $_POST['important-desc'] ) ) { 
		// Saves the important checkbox value
		update_post_meta( $post_id, 'important', $_POST['important-desc'] );
	} else {
		update_post_meta( $post_id, 'important', 0 );
	}
}
add_action( 'save_post', 'postdescriptions_save_postdescription');