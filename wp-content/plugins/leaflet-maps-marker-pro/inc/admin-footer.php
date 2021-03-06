<?php
/*
    Admin footer - Maps Marker Pro
*/
//info prevent file from being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'admin-footer.php') { die ("Please do not access this file directly. Thanks!<br/><a href='https://www.mapsmarker.com/go'>www.mapsmarker.com</a>"); }

$lmm_options = get_option( 'leafletmapsmarker_options' );
if ($lmm_options['misc_whitelabel_backend'] == 'disabled') { ?>
	<table cellpadding="5" cellspacing="0" style="margin-top:20px;border:1px solid #ccc;width:100%;background:#F9F9F9;border-radius:5px;">
	  <tr>
		<td valign="center">
		<p style="margin:0;">
				<a style="text-decoration:none;" href="https://www.mapsmarker.com" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-website-home.png" width="16" height="16" alt="mapsmarker.com"> MapsMarker.com</a>&nbsp;
				<a style="text-decoration:none;" title="<?php esc_attr_e('MapsMarker affiliate program - sign up now and receive commissions up to 50%!','lmm'); ?>" href="https://affiliates.mapsmarker.com/" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-affiliates.png" width="16" height="16" alt="<?php esc_attr_e('MapsMarker affiliate program - sign up now and receive commissions up to 50%!','lmm'); ?>"> <?php _e('Affiliates','lmm'); ?></a>&nbsp;
				<a style="text-decoration:none;" title="<?php esc_attr_e('MapsMarker reseller program - re-sell with a 20% discount!','lmm'); ?>" href="https://www.mapsmarker.com/reseller" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-resellers.png" width="16" height="16" alt="<?php esc_attr_e('MapsMarker reseller program - re-sell with a 20% discount!','lmm'); ?>"> <?php _e('Resellers','lmm'); ?></a>&nbsp;
				<a style="text-decoration:none;" href="https://www.mapsmarker.com/reviews" target="_blank" title="<?php esc_attr_e('please review this plugin on wordpress.org','lmm') ?>"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-star.png" width="16" height="16" alt="<?php esc_attr_e('please review this plugin on wordpress.org','lmm') ?>"> <?php _e('Rate plugin','lmm') ?></a>&nbsp;
				<a style="text-decoration:none;" href="https://translate.mapsmarker.com/projects/lmm" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-translations.png" width="16" height="16" alt="translations"> <?php echo __('translations','lmm'); ?></a>&nbsp;
				<a style="text-decoration:none;" href="https://www.mapsmarker.com/hackerone" target="_blank" title="<?php esc_attr_e('Bounty Hunters wanted! Find security bugs to earn cash and licenses','lmm') ?>"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-hackerone.png" width="16" height="16" alt="<?php esc_attr_e('Bounty Hunters wanted! Find security bugs to earn cash and licenses','lmm') ?>"> hackerone</a>&nbsp;
				<a style="text-decoration:none;" href="https://twitter.com/mapsmarker" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-twitter.png" width="16" height="16" alt="<?php esc_attr_e('Follow @MapsMarker on Twitter','lmm'); ?>"> Twitter</a>&nbsp;
				<a style="text-decoration:none;" href="https://facebook.com/mapsmarker" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-facebook.png" width="16" height="16" alt="<?php esc_attr_e('Follow MapsMarker on Facebook','lmm'); ?>"> Facebook</a>&nbsp;
				<a style="text-decoration:none;" href="https://www.mapsmarker.com/+" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-google-plus.png" width="16" height="16" alt="<?php esc_attr_e('Follow MapsMarker on Google+','lmm'); ?>"> Google+</a>&nbsp;
				<a style="text-decoration:none;" href="https://www.mapsmarker.com/changelog/pro" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-changelog-header.png" width="16" height="16" alt="<?php esc_attr_e('Changelog','lmm'); ?>"> <?php _e('Changelog','lmm') ?></a>&nbsp;
				<a style="text-decoration:none;" href="http://feeds.feedburner.com/MapsMarker" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-rss.png" width="16" height="16" alt="news via rss"> RSS</a>&nbsp;
				<a style="text-decoration:none;" href="http://feedburner.google.com/fb/a/mailverify?uri=MapsMarker" target="_blank"><img src="<?php echo LEAFLET_PLUGIN_URL; ?>inc/img/icon-rss-email.png" width="16" height="16" alt="rss via email"> <?php echo __('RSS via E-Mail','lmm'); ?></a>
				</p></td>
	  </tr>
	</table>
<?php } ?>
<script type="text/javascript">
//info: toggle advanced menu items
jQuery('#show-advanced-menu-items-link, #hide-advanced-menu-items-link').click(function(e) {
	jQuery('#show-advanced-menu-items-link').toggle();
	jQuery('#hide-advanced-menu-items-link').toggle();
	jQuery('#advanced-menu-items').toggle();
});
</script>
</div><!--end wrap-->