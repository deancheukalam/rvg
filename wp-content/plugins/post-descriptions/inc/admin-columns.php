<?php
/**
 * Populate the description column
 */
function postdescriptions_fill_description_column( $column, $post_id ) {
	if ( '_description' !== $column ) return;
	$description = get_post_meta( $post_id, 'post_description', true );
	$custom_color = get_option( 'important-color' );
	$important_color;
	if ( $custom_color ) {
		$important_color = $custom_color;
	} else {
		$important_color = '#cc0000';
	}
	$escaped_description = esc_html__( $description );
	$important = get_post_meta( $post_id, 'important', true );
	if ( '1' === $important ) {
		echo '<span class="important-state" style="color:' . $important_color . '; font-weight: bold;">' . $escaped_description . '</span>';
	} else {
		echo '<span>' . $escaped_description . '</span>';
	}
}
add_action( 'manage_posts_custom_column', 'postdescriptions_fill_description_column', 10, 2 );
add_action( 'manage_page_posts_custom_column', 'postdescriptions_fill_description_column', 10, 2 );