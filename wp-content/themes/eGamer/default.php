<?php if (get_option('egamer_featured') == 'on') { ?>
<div style="position: relative;">
    <div class="prev"></div>
    <div class="next"></div>
</div>
<div id="sections">
    <ul>
<?php get_catId(get_option('egamer_feat_cat')) ?>
<?php $ids = array();
query_posts("showposts=".get_option('egamer_homepage_featured')."&cat=".get_catId(get_option('egamer_feat_cat')));
while (have_posts()) : the_post(); $loopcounter++; ?>



	<?php $width = 619;
		  $height = 253;
				  
		  $classtext = '';
		  $titletext = get_the_title();

		  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'image_value');
		  $thumb = $thumbnail["thumb"]; ?>

        <li class="thumbnail-div-featured" style="background-image: url('<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, '', true, true); ?>');">
            <div class="featured-inside"> <span class="post-info"><?php _e('Posted by','eGamer') ?>
                <?php the_author() ?>
                <?php _e('on','eGamer') ?>
                <?php the_time('F j, Y') ?>
                |
                <?php comments_popup_link(__('No Comments','eGamer'), __('1 Comment','eGamer'), __('% Comments','eGamer')); ?>
                </span> <a href="<?php the_permalink() ?>" rel="bookmark" class="titles-featured" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
                <?php truncate_title(36); ?>
                </a>
                <?php truncate_post(220); ?>
            </div>
        </li>
        <?php $ids[]= $post->ID; endwhile; ?>
    </ul>
</div>
<?php }; ?>

<?php if (get_option('egamer_video') == 'false') { ?>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/video.php'); } ?>
<?php if (get_option('egamer_rating') == 'false') { ?>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/rating.php'); } ?>

 <div style="clear: both;"></div><br>
 
 <h1 class="post-title" style="margin-top: 17px; line-height: 29px; font-size: 19px; font-family: verdana,geneva; font-weight: bold; text-decoration: none; margin-left: 8px;">
                Welkom!</a><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" border="0">
                </h1>
 

<IFRAME SRC="?page_id=2&content-only=1" WIDTH="617" HEIGHT="150" frameborder="0" SCROLLING="no" ALLOWTRANSPARENCY="true">Sorry, je browser ondersteunt geen frames...</IFRAME> 

<p>&nbsp;</p>

<h1 style="margin-top: 39px; line-height: 29px; font-size: 19px; font-family: verdana,geneva; font-weight: bold; text-decoration: none; margin-left: 8px;">Een greep uit het aanbod<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" border="0">
                </h1><br>

<?php
if (get_option('egamer_duplicate') == 'false') {
	$args=array(
	   'showposts'=>get_option('egamer_homepage_posts'),
	   'post__not_in' => $ids,
	   'paged'=> $paged,
	   'category__not_in' => get_option('egamer_exlcats_recent'),
	);
} else {
	$args=array(
	   'showposts'=>get_option('egamer_homepage_posts'),
	   'paged'=> $paged,
	   'category__not_in' => get_option('egamer_exlcats_recent'),
	);
};
query_posts(cat=80);
if (have_posts()) : while (have_posts()) : the_post(); ?>




<?php $width = 182;
	  $height = 129;
			  
	  $classtext = 'thumbnail';
	  $titletext = get_the_title();

	  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'image_value');
	  $thumb = $thumbnail["thumb"];  ?>

<div class="home-post-wrap"> 
    <div class="home-post-titles">
    
    	<?php echo c2c_get_custom('Maps', '<a class="tlink" href="', '" target="_blanc"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/maps.png" border="0"></a>',''); ?>
    	
    
        
        
		<?php if (get_option('egamer_postinfo2') <> '') { ?>
			<?php if (in_array('comments', get_option('egamer_postinfo2'))) { ?>
				<span class="comments-bubble"></span>
			<?php }; ?>
		<?php }; ?>
	</div>
    <div class="post-inside" align="center"> 
    	
    	<?php if($thumb <> '') { ?>
			<a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
			</a>
	
		<?php if (get_option('egamer_postinfo2') <> '') { ?>
			<?php if (in_array('author', get_option('egamer_postinfo2')) || in_array('date', get_option('egamer_postinfo2'))) { ?>
				<h2><center><a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
            <b><?php truncate_title(36); ?></b>
            </a></center></h2>
			<?php }; ?>
		<?php }; ?>
        
		<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein1.gif" border="0">
        <?php }; ?>
		<p align="center">
        <?php echo c2c_get_custom('Type', '<center> ', '', ''); ?><br><?php echo c2c_get_custom('Locatie', '', '', ''); ?><br>
        	<?php echo c2c_get_custom('Oppervlakte', '', '', ''); ?><?php echo c2c_get_custom('Perceel', ' - ', '', ''); ?><?php echo c2c_get_custom('Kamers', ' - ', '', ''); ?><br>
          <?php echo c2c_get_custom('Locatie', '<font size="3"><b>', '</b></font></center>', ''); ?>
        	
        	</p>
        <div style="clear: both;"></div><br>
        </center></a> </div>
</div>
<?php endwhile; ?>
        <div style="clear: both;"></div>
<?php if (get_option('egamer_home_navi') == 'on') { ?>  
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } 
else { ?>
<p class="pagination">
    <?php next_posts_link(__('&laquo; Previous Entries','eGamer')) ?>
	<?php previous_posts_link(__('Next Entries &raquo;','eGamer')) ?>
</p>
<div style="clear: both;"></div>
<?php } ?>
<?php } ?>
<?php if (get_option('egamer_popular_display') == 'on') { ?>
<!--Begind Popular Articles-->
<div class="home-post-wrap-2"> <span class="home-post-titles"> <span style="float: left;"><?php _e('Popular Articles','eGamer') ?></span> </span>
    <div class="post-inside-small">
<ul class="list2">
<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 ,".get_option('egamer_popular_count')."");
foreach ($result as $post) {
#setup_postdata($post);
$postid = $post->ID;
$title = $post->post_title;
$commentcount = $post->comment_count;
if ($commentcount != 0) { ?>
<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>">
<?php echo $title ?></a> (<?php echo $commentcount ?>)</li>
<?php } } ?>
</ul>
    </div>
</div>
<!--end Popular Articles-->
<?php }; ?>
<?php if (get_option('egamer_random_display') == 'on') { ?>
<!--Begind Random Articles-->
<div class="home-post-wrap-2"> <span class="home-post-titles"> <span style="float: left;"><?php _e('Random Articles','eGamer') ?></span> </span>
    <div class="post-inside-small">
        <ul>
        <?php $my_query = new WP_Query('orderby=rand&showposts='.get_option('egamer_random_count').'');
while ($my_query->have_posts()) : $my_query->the_post();
?>
            <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
                <?php the_title() ?>
                </a></li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<!--end Random Articles-->
<?php }; ?>
<?php else : ?>
<!--If no results are found-->
<h1><?php _e('No Results Found','eGamer') ?></h1>
<p><?php _e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','eGamer') ?></p>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>