 <span class="current-category">
<?php single_cat_title(__('Currently Browsing: ','eGamer'), 'display'); ?>
</span>



<?php
  //$array = array( array( 'value' => $v ) );
  $array = array();
  $args = array(
                  'posts_per_page'  => 3,
                  'cat'             => $cat,
                  'showposts'       => $egamer_catnum_posts,
                  /*'category__and' => array(1,3),*/
                  /*'cat'             => 3,*/
                  'orderby'         => 'title',
                  'order'           => 'DESC',
                  'meta_query'      => $array
                );    
  query_posts( $args );

<?php //query_posts("cat=$cat&showposts=$egamer_catnum_posts&paged=$paged"); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
<!--Begin Post-->
<span class="single-entry-titles" style="margin-top: 18px;"></span>
<div class="post-wrapper">
    <div style="clear: both;"></div>
	<?php if (get_option('egamer_thumbnails') == 'on') include(TEMPLATEPATH . '/includes/thumbnail.php'); ?>
	
    <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
        <?php the_title(); ?>
        </a></h2>
    
	<?php if (get_option('egamer_postinfo3') <> '') { ?>
		<div class="post-info"><?php _e('Posted','eGamer') ?> <?php if (in_array('author', get_option('egamer_postinfo3'))) { ?> <?php _e('by','eGamer') ?> <?php the_author() ?><?php }; ?><?php if (in_array('date', get_option('egamer_postinfo3'))) { ?> <?php _e('on','eGamer') ?> <?php the_time(get_option('egamer_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('egamer_postinfo3'))) { ?> <?php _e('in','eGamer') ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('egamer_postinfo3'))) { ?> | <?php comments_popup_link(__('0 comments','eGamer'), __('1 comment','eGamer'), '% '.__('comments','eGamer')); ?><?php }; ?>
		</div>
	<?php }; ?>
	
    <?php the_content(); ?>
</div>
<?php endwhile; ?>
<!--End Post-->
<div style="clear: both;"></div>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } 
else { ?>
<p class="pagination">
    <?php next_posts_link(__('&laquo; Previous Entries','eGamer')) ?>
	<?php previous_posts_link(__('Next Entries &raquo;','eGamer')) ?>
</p>
<?php } ?>
<?php else : ?>
<!--If no results are found-->
<h1><?php _e('No Results Found','eGamer') ?></h1>
<p><?php _e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','eGamer') ?></p>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>