<?php
/**
 * Custom options and settings
 */
function postdescriptions_settings_init() {
	// Register settings
	register_setting( 'postdescriptions', 'description-states' );
	register_setting( 'postdescriptions', 'important-color' );
	// Adds settings sections
	add_settings_section(
		'postdescriptions_general',
		__( 'General', 'post-descriptions' ), 'postdescriptions_general_cb',
		'postdescriptions'
	);
	// Adds settings fields
	add_settings_field(
		'postdescriptions_show_state',
		__( 'Show States', 'post-descriptions' ),
		'postdescriptions_show_state_cb',
		'postdescriptions',
		'postdescriptions_general',
		array(
			'label_for'											=> 'postdescriptions_show_state',
			'class'													=> 'postdescriptions_row',
			'postdescriptions_custom_data'	=> 'custom',
		)
	);
	add_settings_field(
		'postdescriptions_important_color',
		__( 'Important Color', 'post-descriptions' ),
		'postdescriptions_important_color_cb',
		'postdescriptions',
		'postdescriptions_general',
		array(
			'label_for'											=> 'postdescriptions_important_color',
			'class'													=> 'postdescriptions_row',
			'postdescriptions_custom_data'	=> 'custom',
		)
	);
}
add_action( 'admin_init', 'postdescriptions_settings_init' );

// A description for the settings section.
function postdescriptions_general_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Customize the way you want to display post descriptions.', 'post-descriptions' ); ?></p>
	<?php
}

// Callback for the state option
function postdescriptions_show_state_cb( $args ) {
	?>
	<label for="postdescriptions_show_state">
	<input type="checkbox" name="description-states" value="1" id="postdescriptions_show_state" <?php checked(1, get_option('description-states'), true); ?>>
	<?php _e( 'If this box is checked, the post description will show up in a bold font behind the page or post title.', 'post-descriptions' ); ?>
	</label>
	<?php
}

// Callback for the important color option
function postdescriptions_important_color_cb( $args ) {
	$color = get_option( 'important-color' );
	?>
	<input id="postdescriptions_important_color" class="color-picker" name="important-color" type="text" value="<?php if ( $color ) echo $color; ?>" />
	<?php
}
 
// Add the menu page as a submenu to Settings
function postdescriptions_options_page() {
	add_submenu_page(
		'options-general.php',
		__('Post Descriptions', 'post-descriptions'),
		__('Post Descriptions', 'post-descriptions'),
		'manage_options',
		'postdescriptions',
		'postdescriptions_options_page_html'
	);
}
add_action( 'admin_menu', 'postdescriptions_options_page' );

// Top level menu callback function
function postdescriptions_options_page_html() {
	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	// Show error/update messages
	settings_errors( 'postdescriptions_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'postdescriptions' );
			do_settings_sections( 'postdescriptions' );
			submit_button( __( 'Save', 'post-descriptions' ) );
			?>
		</form>
	</div>
	<?php 
}