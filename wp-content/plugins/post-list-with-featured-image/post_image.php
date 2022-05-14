<?php
/* Display custom column in Post List Page */
function display_posts_featured_image_dp($column, $post_id) {
    $final_data = get_option("post_with_image_dp_data");
    $max_width = "100px"; // default 100px
    $max_height = "100px"; // default 100px
    $width = "auto"; // default auto
    $height = "auto"; // default auto
    if (!empty($final_data)) {
        $max_width = intval($final_data['max_width'])."px";
        $max_height = intval($final_data['max_height'])."px";
        $width = $final_data['width'];
        $height = $final_data['height'];
    }
    if ($column == 'image') {
        $image = get_the_post_thumbnail_url($post_id, "thumbnail");
        if ($image == "") {
            $image = plugins_url("/images/dummy-150x150.png", __FILE__);  //dummy image 
        }
        echo '<img src=' . $image . ' style="max-height:' . $max_height . ';max-width:' . $max_width . '; height:' . $height . '; width:' . $width . '">';
    }
}
add_action('manage_posts_custom_column', 'display_posts_featured_image_dp', 10, 2);
/* Display custom column in Post List Page */
function add_image_column_to_post_dp($columns) {
    return array_merge($columns, array('image' => __('Image', 'Image of the post')));
}
add_filter('manage_posts_columns', 'add_image_column_to_post_dp');