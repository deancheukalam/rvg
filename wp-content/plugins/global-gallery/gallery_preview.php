<?php
// overwrite the page content to display gallery/collection preview

add_filter('the_content', 'gg_manage_preview', 9999);

function gg_manage_preview($the_content) {
	$target_page = (int)get_option('gg_preview_pag');
	$curr_page_id = (int)get_the_ID();
	
	if($target_page == $curr_page_id && is_user_logged_in() && (isset($_REQUEST['gg_gid']) || isset($_REQUEST['gg_cid']))) {
			
		// gallery preview	
		if(isset($_REQUEST['gg_gid'])) {			
			$content = do_shortcode('[g-gallery gid="'.(int)$_REQUEST['gg_gid'].'" random="0"]');
		}
		
		// collection
		else {
			$content = do_shortcode('[g-collection cid="'. (int)$_REQUEST['gg_cid'] .'" filter="1" random="0"]');
		}
		
		
		return $content;
	}	
	else {return $the_content;}
}
