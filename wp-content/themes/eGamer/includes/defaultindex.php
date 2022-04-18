<?php 
if (is_archive()) $post_number = get_option('egamer_archivenum_posts');
if (is_search()) $post_number = get_option('egamer_searchnum_posts');
if (is_tag()) $post_number = get_option('egamer_tagnum_posts');
global $query_string; query_posts($query_string . "&showposts=$post_number&paged=$paged"); 
?>


	
	
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	  if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<?php $width = get_option('egamer_thumbnail_width_index');
	  $height = get_option('egamer_thumbnail_height_index');
			  
	  $classtext = 'thumbnail';
	  $titletext = get_the_title();

	  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'image_value');
	  $thumb = $thumbnail["thumb"];  ?>

<div class="home-post-wrap2">
    <h2 class="single-entry-titles"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
        <?php the_title() ?>
        </a></h2>
    <div class="single-entry">
	
		<?php if (get_option('egamer_index_thumbnails') == 'on') { ?>			
			<?php if($thumb <> '') { ?>
				<a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
				</a>
			<?php }; ?>
		<?php }; ?>
		
        <?php if (get_option('egamer_postinfo3') <> '') { ?>
			<div class="post-info"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
			</div>
		<?php }; ?>
		
        <?php if (get_option('egamer_excerpt') == 'false') { ?>
        <?php truncate_post(310); ?>
        <?php } else { ?>
        <?php the_excerpt(); ?>
        <?php }; ?>
        <div style="clear: both;"></div>
        <a href="<?php the_permalink() ?>" rel="bookmark" style="float: right;" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>"><img src="<?php bloginfo('template_directory'); ?>/images/readmore.gif" alt="Read More of <?php the_title(); ?>" style="border: none;" /></a> </div>
</div>
<?php endwhile; ?>
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