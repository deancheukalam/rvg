﻿
<?php query_posts("cat=$cat&showposts=48&paged=$paged"); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

	<?php $width = 166;
		  $height = 129;
				  
		  $classtext = 'thumbnail';
		  $titletext = get_the_title();

		  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'image_value');
		  $thumb = $thumbnail["thumb"]; ?>
<style type="text/css">
    #left-div {
        padding-left: 0;

    }
</style>
<div class="home-post-wrap">
    <div class="home-post-titles">
    
    	<?php echo c2c_get_custom('Maps', '<a class="tlink" href="', '" target="_blanc"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/maps.png" border="0"></a>',''); ?>
    	
    
        
        
		<?php if (get_option('egamer_postinfo2') <> '') { ?>
			<?php if (in_array('comments', get_option('egamer_postinfo2'))) { ?>
				<span class="comments-bubble"></span>
			<?php }; ?>
		<?php }; ?>
	</div>
    <div class="post-inside1" align="center"> 
    	
    	<?php if($thumb <> '') { ?>
			<a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>" target="_parent">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
			</a>
	
		<?php if (get_option('egamer_postinfo2') <> '') { ?>
			<?php if (in_array('author', get_option('egamer_postinfo2')) || in_array('date', get_option('egamer_postinfo2'))) { ?>
				<h2><center><a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>" target="_parent">
            <b><?php truncate_title(36); ?></b>
            </a></center></h2>
			<?php }; ?>
		<?php }; ?>
        
		<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein2.gif" border="0">
        <?php }; ?>
		<p align="center">
        <?php echo c2c_get_custom('Type', '<center> ', '', ''); ?><br><?php echo c2c_get_custom('Locatie', '', '', ''); ?><br>
        	<?php echo c2c_get_custom('Oppervlakte', '', '', ''); ?><?php echo c2c_get_custom('Perceel', ' - ', '', ''); ?><?php echo c2c_get_custom('Kamers', ' - ', '', ''); ?><br>
           #<?php echo c2c_get_custom('Objectnummer', '', '', ''); ?><br><?php echo c2c_get_custom('Prijs', '<font size="3"><b>', '</b></font></center>', ''); ?>
        	
        	</p>
        <div style="clear: both;"></div><br>
        </center></a> </div>
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
<h1><?php _e('Er zijn geen resultaten','eGamer') ?></h1>
<p><?php _e('Deze categorie bevat op dit moment geen items. Probeer het later nogmaals.','eGamer') ?></p>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>