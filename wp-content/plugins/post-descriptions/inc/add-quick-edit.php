<?php
/**
* Add post descriptions to the quick edit menu
*/
function postdescriptions_add_quick_edit( $column_name, $post_type ) {
	if ( '_description' !== $column_name ) {
		return;
	} else {
		wp_nonce_field('post_description_quick_edit', 'post_description_nonce');
		echo '<fieldset class="inline-edit-col-left">
					<legend class="inline-edit-legend">' . __('Post Descriptions', 'post-descriptions') . '</legend>
					<div class="inline-edit-col">
					<label class="alignleft" style="width: 100%;">
					<span class="title">' . __('Description', 'post-descriptions') . '</span>
					<span class="input-text-wrap"><input type="text" name="' . $column_name . '" value="" style="width: 100%;"></span>
					</label>
					<label class="align-left">
					<input type="checkbox" id="important" name="important" value="1"/>' . __( 'Make your description important', 'postdescriptions' ) . '
					</label></div></fieldset>';
	}
}
add_action( 'quick_edit_custom_box', 'postdescriptions_add_quick_edit', 10, 2 );

// Save the custom field value from the quick edit box 
function postdescriptions_quick_edit_save( $post_id ) {
	// Checks the nonce for extra security
	if ( ! isset( $_POST['post_description_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['post_description_nonce'], 'post_description_quick_edit' ) ) return;
	// Doesn't save on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
	// Checks if user has the right capability to edit the page or post
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return; 
	}

	// Checks if there is input
	if ( isset( $_POST['_description'] ) ) {
		// Sanitizes the input and saves it to the post meta
		$post_description = sanitize_text_field( $_POST['_description'] );
		update_post_meta( $post_id, 'post_description', $post_description );
	}
	if ( isset( $_POST['important'] ) ) {
		update_post_meta( $post_id, 'important', $_POST['important'] );
	} else {
		update_post_meta( $post_id, 'important', 0 );
	}
}
add_action( 'save_post_post', 'postdescriptions_quick_edit_save' );
add_action( 'save_post_page', 'postdescriptions_quick_edit_save' );

// Populate the custom field values at the quick edit box using Javascript
function postdescriptions_populate_quick_edit() {
	$current_screen = get_current_screen();
	if ( 'edit-post' !== $current_screen->id && 'edit-page' !== $current_screen->id ) return;
	wp_enqueue_script( 'jquery' );
	?>
	<script type="text/javascript">
		jQuery( function( $ ) {
			let $postdescriptions_inline_editor = inlineEditPost.edit;
			inlineEditPost.edit = function( id ) {
				$postdescriptions_inline_editor.apply( this, arguments );
				let $post_id = 0;
				if ( 'object' == typeof( id ) ) {
					$post_id = parseInt( this.getId( id ) );
				}
				if ( 0 != $post_id ) {
					let $edit_row = $( '#edit-' + $post_id );
					let $post_row = $( '#post-' + $post_id );
					let $post_state = $( '.post-state', $post_row )[0];
					let $description = $( 'td.column-_description' );
					console.log( $description[0].children[0] );
					console.log( typeof $description );
					let $descriptionText = $('.column-_description', $post_row ).text();
					$( ':input[name="_description"]', $edit_row ).val( $descriptionText );
					// Check if there is a post state, and if the post state contains a span with the 'important-state' class, or if the post states are disabled if the description has an 'important-state' class
					if ( ( $description[0].children[0].classList.contains( 'important-state' ) || 'undefined' !== typeof $post_state && $post_state.children[0].classList.contains( 'important-state') ) ) {
						$( ':input[name="important"]', $edit_row ).attr( 'checked', true );
					}
				}
			}
		} );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts-edit.php', 'postdescriptions_populate_quick_edit' );