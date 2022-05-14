<?php

function register_dp_custom_submenu_page() {
    add_submenu_page('options-general.php', 'Post With Featured Image Setting', 'Post With Featured Image Setting', 'manage_options', 'dp-post-with-image', 'dp_post_with_image_callback');
}
add_action('admin_menu', 'register_dp_custom_submenu_page');
/* Add menu in admin panel for upload_sports_icon end */

function dp_post_with_image_callback() {
    function load_custom_wp_admin_style() {
        wp_register_style('tabcontent.css', plugins_url("/css/tabcontent.css", __FILE__), false, '1.0.0');
        wp_enqueue_style('tabcontent.css');

        wp_register_style('main.css', plugins_url("/css/main.css", __FILE__), false, '1.0.0');
        wp_enqueue_style('main.css');

        wp_enqueue_script('zentabcontent.js', plugins_url('/js/zentabcontent.js', __FILE__), array(), '1.0.0', true);
    }
    add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
    do_action('admin_enqueue_scripts');
    if (isset($_POST['submit'])) {
        $max_width = $_POST['max_width'];
        $max_height = $_POST['max_height'];
        $width = $_POST['width'];
        $height = $_POST['height'];

        $final_data = array(
            "height" => $height,
            "width" => $width,
            "max_height" => $max_height,
            "max_width" => $max_width
        );
        update_option("post_with_image_dp_data", $final_data);
    }
    $final_data = get_option("post_with_image_dp_data");
    $max_width = "100px";
    $max_height = "100px";
    $width = "auto";
    $height = "auto";
    if (!empty($final_data)) {
        $max_width = intval($final_data['max_width']) . "px";
        $max_height = intval($final_data['max_height']) . "px";
        $width = $final_data['width'];
        $height = $final_data['height'];
    }
    ?>
    <h1>Post List With Featured Image Display Setting</h1>
    <div class="tab">
        <a href="javascript:void(0)" class="tablinks" onclick="openTab_dp(event, 'tab1')"  id="defaultOpen">Thumbnail Setting</a>
        <a href="javascript:void(0)" class="tablinks" onclick="openTab_dp(event, 'tab2')">Help</a>
        <a href="javascript:void(0)" class="tablinks" onclick="openTab_dp(event, 'tab3')">About us</a>
    </div>
    <div id="tab1" class="tabcontent">
        <h3>Thumbnail Setting</h3>
        <form id="form1" action="" method="post">
            <p>
                <label for="max_width">Max Width</label> <input type="text" name="max_width" id="max_width" required="" value="<?php echo $max_width; ?>">
                ex. 100px
            </p>
            <p>
                <label for="max_height">Max Height</label> <input type="text" name="max_height" id="max_height" required="" value="<?php echo $max_height; ?>">
                ex. 100px
            </p>
            <p>
                <label for="width">Width</label> <input type="text" name="width" id="width" required="" value="<?php echo $width; ?>">
                ex. 100px , auto
            </p>
            <p>
                <label for="height">Height</label> <input type="text" name="height" id="height" required="" value="<?php echo $height; ?>">
                ex. 100px , auto
            </p>
            <p>
                <input type="submit" name="submit" value="SAVE" class="button button-primary">
            </p>
        </form>
    </div>
    <div id="tab2" class="tabcontent">
        <h3>Help</h3>
        <Ol>
            <li>This is Free Plugin.</li>
            <li>Do not give height, width, max-height or max-width as negative value.</li>
            <li>On Plugin Activate Featured Image will show in Post list.</li>
            <li>You can Change Height, Width manually.</li>
        </ol>
    </div>
    <div id="tab3" class="tabcontent">
        <h3>About us</h3>
        <h5>Angel Web Solution</h5>
        <p>Visit : <a href="http://www.angelwebsolution.in" target="_blank">http://www.angelwebsolution.in</a></p>
    </div>
    <?php
}