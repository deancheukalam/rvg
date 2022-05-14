<?php get_header(); ?>
<div id="container">
<div id="left-div">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <span class="single-entry-titles" style="margin-top: 18px;">
    
	<?php if (get_option('egamer_postinfo1') <> '') { ?>
		<?php if (in_array('author', get_option('egamer_postinfo1')) || in_array('date', get_option('egamer_postinfo1'))) { ?>
			&nbsp; 
		<?php }; ?>	
	<?php }; ?>	
		
    </span>
    <div class="post-wrapper">
          <?php if (get_option('egamer_integration_single_top') <> '' && get_option('egamer_integrate_singletop_enable') == 'on') { ?>	
                  <div style="clear: both;"></div>
		  <?php echo(get_option('egamer_integration_single_top')); ?>
          <?php }; ?>
          <?php $rating = get_post_meta($post->ID, 'rating_value', $single = true);
$rating2 = get_post_meta($post->ID, 'rating', $single = true); ?>
       <div style="clear: both;"></div>
        <?php if (get_option('egamer_thumbnails') == 'false') { ?>
        <?php { echo ''; } ?>
        <?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
        <h1 class="posti-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
            <?php the_title(); ?>
            </a></h1>
       
	    <?php if (get_option('egamer_postinfo1') <> '') { ?>
			<?php if (in_array('categories', get_option('egamer_postinfo1')) || in_array('comments', get_option('egamer_postinfo1'))) { ?>
				<div class="post-info"><?php echo c2c_get_custom('Maps', '<a class="tlink" href="', '" target="_blanc"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/maps2.png" border="0"></a>',''); ?></div>
			<?php }; ?>
		<?php }; ?>	
			
        <?php $rating = get_post_meta($post->ID, 'rating_value', $single = true); ?>
        <?php if($rating <> '') { ?>
        <img src="<?php bloginfo('template_directory'); ?>/images/star-large-<?php if($rating2 <> '') { ?><?php echo get_post_meta($post->ID, "rating", true); ?><?php } else { ?><?php echo $rating ?><?php }; ?>.gif" alt="Post Rating" />
        <?php } else { echo ''; } ?>
        
        <p>
        <table>
        <?php echo c2c_get_custom('Type', '<tr><td><b><font size="2">type:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
        <?php echo c2c_get_custom('Locatie', '<tr><td><b><font size="2">locatie:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
        <?php echo c2c_get_custom('Oppervlakte', '<tr><td><b><font size="2">bouwoppervlakte:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
        <?php echo c2c_get_custom('Perceel', '<tr><td><b><font size="2">perceeloppervlakte:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
        <?php echo c2c_get_custom('Kamers', '<tr><td><b><font size="2">aantal kamers:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
		<?php echo c2c_get_custom('Objectnummer', '<tr><td><b><font size="2">objectnummer:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
        <?php echo c2c_get_custom('Prijs', '<tr><td></td></tr><tr><td><b><font size="2">prijs:</font></b></td><td><i><font size="2">', '</font></i></td></tr>', ''); ?>
      </table></p>
        
        <p>&nbsp;</p><br>
        
        
        
        <?php the_content(); ?>
        <p>&nbsp;</p>        
        
        		<p align="center"><center><a class='iframe fancybox.iframe' href="http://www.remyvastgoed.com/informatie-aanvragen" id="my_iframe"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/info_btn.png" style="border: none;" /></a></center></p>
        
        		<p align="center"><center><a href="http://www.remyvastgoed.com/financiering" target="_blank"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/fin_mog_btn.png" style="border: none;" /></a></center></p>
                
                <p align="center"><center><a href="javascript:javascript:history.go(-1)"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/back_btn.png" style="border: none;"  /></a></center></p>     
                
                <div style="clear: both;"></div>
               
                <script type="text/javascript">
					$(document).ready(function() {
						$(".iframe").fancybox({
							fitToView	: true,
							width		: '40%',
							height		: '90%',
							autoSize	: false,
							closeClick	: false,
							openEffect	: 'none',
							closeEffect	: 'none'
						});
											
					});
					
					//$("div",$("iframe").contents());
//    
//					$("#MyButtonDiv").click(function () {
//				  
//					 $("#ContentArea",$("#myFrame").contents()).append("<p>Lorem Ipsum</p>");
//				 
//					});
				</script>

               
          <?php if (get_option('egamer_integration_single_bottom') <> '' && get_option('egamer_integrate_singlebottom_enable') == 'on') echo(get_option('egamer_integration_single_bottom')); ?>	
       
    </div>
    

    
    <?php $video = get_post_meta($post->ID, 'Video', $single = true); ?>
    <?php 
if($video <> '') { ?>
    <span class="single-entry-titles" style="margin-top: 18px;"><?php _e('Play Video','eGamer') ?></span>
    <div class="post-wrapper" style="padding-top: 14px;"> <?php echo $video; ?> </div>
    <?php }
else { echo ''; } ?>



        <?php if (get_option('egamer_show_postcomments') == 'off') { ?>
    <span class="single-entry-titles" style="margin-top: 18px; text-align: center;" align="center"></span>
    <div class="post-wrapper">
        <div style="clear: both;"></div>

        <?php comments_template(); ?>
    </div>
    <?php }; ?>
    <?php endwhile; ?>
    <?php endif; ?>
</div>
<!--Begin Sidebar-->
<?php get_sidebar(); ?>
<!--End Sidebar-->
<!--Begin Footer-->
<?php get_footer(); ?>
<!--End Footer-->
</body>
</html>
