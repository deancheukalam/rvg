<?php 
/*
Plugin Name: custom color Popup
Plugin URI: http://bdtheme.net
Description: This is a wordpress popup that you can change the background color, background opacity, popup box color, border color, border width, font color, header font color. All over you can create as you want a custom popup in yourself.
Version: 1.0.1
Author: kamal Hossain
Author URI: http://www.bdtheme.net
*/

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define('BDCOLOR_POPUP_WORDPRESS' , WP_PLUGIN_URL .'/' . plugin_basename(dirname(__FILE__)) . '/');

// Adding css and jquery files
function bd_custom_popup_files(){
	wp_enqueue_script('' , BDCOLOR_POPUP_WORDPRESS .'js/popup.js' );		
}
add_action('wp_enqueue_scripts' , 'bd_custom_popup_files',99);

$bdtheme='';

/* This function is used to include js bdtheme for the popup.
  Call Latest jQuery From wordpress library */
function bd_latest_jquery(){
	wp_enqueue_script('jquery');
}
add_action('init' , 'bd_latest_jquery');

// Adding Admin files
function bdtheme_color_pickr_function( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/color-pickr.js', __FILE__ ), array( 'wp-color-picker' ), false, true );   

	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'bdtheme_color_pickr_function' );

register_activation_hook(__FILE__, 'bdtheme_popup_activate');
register_uninstall_hook(__FILE__, 'bdtheme_popup_uninstall');


/* This function is called when the plugin is activated. */
function bdtheme_popup_activate() {	
		global $bdtheme;
	$default_value = array(
			'title' => 'This is the title',
			'content' => 'This is the default content',
			'bg_opacity'			=> '0.5',
			'background_color'	=> '#eeeeee',
			'header_color'		=> '#000000',
			'color'				=> '#555555',
			'width'				=> '400px',
			'border_color'		=> '#999999',
			'border_width'		=> '5'
			);

	add_option('bdtheme_popup_settings',$default_value);
}


/* This function is called when the plugin is uninstalled.*/
function bdtheme_popup_uninstall()
{
	delete_option('bdtheme_popup_settings',$default_value);
}



/* This function is used to get the options value from the database */
function get_bdtheme_popup_setting($key= '')
{
	if($key != '')
	{
		$current_option = get_option('bdtheme_popup_settings');
		if(isset($current_option[$key])) {
			return $current_option[$key];
		}
		else
			return '';
	}
	else
	return '';
}


/* This function is used to update the option value pair to the database.*/
function update_dbtheme_all_settings($key= '', $value = '')
{
	$msg = 0;
	if($key != '')
	{
		update_option('bdtheme_popup_settings',$value);
		$msg = 1;
	}
	else
	return true;
	return $msg;
}


/*This function is use to add the submenu & settings page to the setting menu.
 */
function bdtheme_popup_admin_menu() {
	add_options_page('Bdtheme Popup Settings Page', 'Custom Color Popup', 'manage_options', 'bdtheme_popup_page', 'bdtheme_popup_options_page');
}
add_action('admin_menu', 'bdtheme_popup_admin_menu');

function bd_custom_popup_plugin_actions( $links ) {

		$settings_link = '<a href="' . admin_url( 'options-general.php?page=bdtheme_popup_page' ) . '">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link ); 
		// before other links

	return $links;
}
add_filter( 'plugin_action_links', 'bd_custom_popup_plugin_actions', 10, 2 );

/*This function is use to make the html page for the settings page.
 */
function bdtheme_popup_options_page() {
	global $msg_box;
	if(isset($_POST['bdtheme_popup_submit'])) {

		$changed_value = array(
				'title'             => $_POST['title'],
				'content'           => $_POST['content'],
				'background_color'	=> $_POST['background_color'],
				'bg_opacity'	    => $_POST['bg_opacity'],
				'bgbox_color'	    => $_POST['bgbox_color'],
				'header_color'		=> $_POST['header_color'],
				'color'				=> $_POST['color'],
				'width'				=> $_POST['width'],
				'border_color'		=> $_POST['border_color'],
				'border_width'		=> $_POST['border_width']
		);
		$msg_box = update_dbtheme_all_settings('bdtheme_popup_settings', $changed_value);
	}

?>
<div class="wrap">
	<h2>
		Custom Color popup settings page
	</h2>
	<?php 
	if($msg_box) 
	{
		?>
	<div class="updated">
		<p>
			<strong><?php _e('Settings Saved');?></strong>
		</p>
	</div>
	<?php 
	}
	?>
	<form method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Title:','bdtheme_popup');?></th>
					<td><input name="title" type="text" id="title" class="regular-text" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'title' ));?>" /></td>

				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Content:','bdtheme_popup');?></th>
					<td>
					<?php 
					wp_editor(
						stripslashes(get_bdtheme_popup_setting( 'content' )), 
						'popup_content', 
						array(
							'media_buttons' => true,
							'quicktags'     => array("buttons"=>"strong,em,link,b-quote,del,ins,img,ul,ol,li,code,close"),
							'textarea_name' => 'content',
							'textarea_rows' => 4,
							'tinymce'	=> true,
						) 
					);
					?>
					</td>
				</tr>
		     <tr valign="top">
					<th scope="row" for="bdtheme-background-color"><?php _e('Background color:','bdtheme_popup');?></th>
					<td class="bdtheme-border-width">
					<input id="bdtheme-background-color" name="background_color" type="text" id="title" class="my-color-field" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'background_color' ));?>" />
				
			   </td>

					<th scope="row" for="bdtheme-bgbox-color"><?php _e('Popupbox Background color:','bdtheme_popup');?></th>
					<td class="bdtheme-border-width">
				<input id="bdtheme-bgbox-color" name="bgbox_color" type="text" class="my-color-field" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'bgbox_color' ));?>" />
			</td>
				
				</tr>
					<tr valign="top">
					<th scope="row"><?php _e('Background Opacity:','bdtheme_popup');?></th>
					<td><input name="bg_opacity" min="0" step="0.1" max="1" type="number" id="bg_opacity" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'bg_opacity' ));?>" /></td>
					<th scope="row"><?php _e('Popup Box Width:','bdtheme_popup');?></th>
					<td><input name="width" type="text" id="width" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'width' ));?>" /></td>
				</tr>
				  <tr valign="top">
					<th scope="row" for="bdtheme-header-color"><?php _e('Header Text Color:','bdtheme_popup');?></th>
					<td class="bdtheme-border-width">
				<input id="bdtheme-header-color" name="header_color" type="text" class="my-color-field" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'header_color' ));?>" />
			</td>
				<th scope="row" for="bdtheme-bgbox-color"><?php _e('PopUp Box Border color:','bdtheme_popup');?></th>
					<td class="bdtheme-border-width">
				<input id="bdtheme-bgbox-color" name="border_color" type="text" class="my-color-field" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'border_color' ));?>" />
			</td>
				</tr>
				<tr valign="top">
					<th scope="row" for="bdtheme-color"><?php _e('Container Text Color:','bdtheme_popup');?></th>
					<td><input id="bdtheme-color" name="color" type="text" class="my-color-field" value="<?php echo esc_attr(get_bdtheme_popup_setting('color')); ?>" /></td>
					<th scope="row"><?php _e('Popup Box Border Width:','bdtheme_popup');?></th>
					<td><input name="border_width" type="number" id="border_width" min="0" max="20" value="<?php echo esc_attr(get_bdtheme_popup_setting( 'border_width' ));?>" />px</td>
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td>
						<p class="submit">
							<input type="submit" name="bdtheme_popup_submit" id="bdtheme_popup_submit" class="button button-primary" value="Save Changes">
						</p>
					</td>
				</tr>
		
				
			</tbody>
		</table>
		
			
	</form>
</div>
<?php 
}


/**
 *  This function is use to set the cookie on certain conditions.
 */
function bdtheme_popup_set_cookie() {
	global $post,$bdtheme,$flag;
	$flag = 0;
	$post->ID;

	$url_css = plugin_dir_url($bdtheme) . dirname(plugin_basename(__FILE__)) .'/css/popup.css';
	wp_register_style( 'plugin_css', $url_css );
	wp_enqueue_style( 'plugin_css' );
	$flag = 1;
		if (!isset($_COOKIE['visit'])) 
		{
			ob_start();
			setcookie('visit', 'set', time()+60,COOKIEPATH, COOKIE_DOMAIN, false);
			ob_flush();
		}
}
add_action( 'wp', 'bdtheme_popup_set_cookie' );


/**
 *  This function is used to show popup on the front side on certain conditions.
 */
function get_bdtheme_popup() {
	global $flag;
		if (isset($_COOKIE['visit']))
		{
			/* echo "dontshowpopup"; */
		}
		else
		{
			if(!isset($_COOKIE['popup'])){

				$popup_title = get_bdtheme_popup_setting( 'title' );
				$content = stripslashes(get_bdtheme_popup_setting( 'content' ));
				$popup_content = apply_filters('the_content', $content);
				$popup_bg_opacity = get_bdtheme_popup_setting( 'bg_opacity' );
				$popup_background_color = get_bdtheme_popup_setting( 'background_color' );
				$popup_bgbox_color = get_bdtheme_popup_setting( 'bgbox_color' );
				$popup_header_color = get_bdtheme_popup_setting( 'header_color' );
				$popup_color = get_bdtheme_popup_setting( 'color' );
				$popup_width = get_bdtheme_popup_setting( 'width' );
				$popup_border_color = get_bdtheme_popup_setting( 'border_color' );
				$popup_border_width = get_bdtheme_popup_setting( 'border_width' );
			

				if($popup_title == '') {
					$output = '<div class="bdpopup_bg">
					<div class="popup_block">
					<div class="innerbox" style="background-color:'.$popup_bgbox_color.'; width:'.$popup_width.'; border:'.$popup_border_width.'px solid '.$popup_border_color.'">
					<a href="#" class="btn_close" title="'.__("Close","bdtheme_popup").'">'.__("Close","bdtheme_popup").'</a>
					<div class="content_box blank" style="color:'.$popup_color.'">
					<p>'.$popup_content.'</p>';
				}
				
				else {
					$output = '<div class="bdpopup_bg">
					<div class="popup_block">
					<div class="innerbox" style="background-color:'.$popup_bgbox_color.'; width:'.$popup_width.'; border:'.$popup_border_width.'px solid '.$popup_border_color.'">
					<a href="#" class="btn_close" title="'.__("Close","bdtheme_popup").'">'.__("Close","bdtheme_popup").'</a>
					<div class="heading_block">
					<div class="heading01" style="color:'.$popup_header_color.'">'.$popup_title.'</div>
					</div>
					<div class="content_box" style="color:'.$popup_color.'">
					<p>'.$popup_content.'</p>';
				}


				$output = $output.'</div></div></div></div><div id="overlay" style="display: block; background-color:'.$popup_background_color.'; opacity:'.$popup_bg_opacity.'"></div>';

				if($flag == 1) {
					echo $output;
					$flag=0;
				}
			}
			else {
				/* echo "cookie set for not display"; */
			}
		}

}

add_action('wp_head', 'get_bdtheme_popup');?>
