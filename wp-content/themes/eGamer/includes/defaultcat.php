<h1 class="post-title" style="margin-top: 27px; line-height: 29px; font-size: 10px; font-family: verdana,geneva; font-weight: bold; text-decoration: none;"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eGamer'), get_the_title()) ?>">
                <?php single_cat_title(); ?></a><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" border="0">
                </h1>
<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

if (false !== strpos($url,'archives/category/koopwoningen')) {
    echo '<div style="clear: both; font-family: verdana,geneva; font-size: small;"><p>Wilt u een huis kopen in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van huizen in Suriname.</p>
<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" alt=""><br /><br />
</div>';
} elseif(false !== strpos($url,'archives/category/huurwoningen')) {
    echo '<div style="clear: both; font-family: verdana,geneva; font-size: small;"><p>Wilt u een woning huren in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van huurwoningen in Suriname.</p>
<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" alt=""><br /><br />
</div>';
}elseif(false !== strpos($url,'archives/category/commercieel')){
  echo '<div style="clear: both; font-family: verdana,geneva; font-size: small;"><p>Bent u op zoek naar een zakenpand of een perceel dat geschikt is voor zakelijke doeleinden<br /> in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van commercieel onroerend goed in Suriname.</p>
<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" alt=""><br /><br />
</div>';
}

?>

<!--<div style="clear: both; font-family: verdana,geneva; font-size: small;"><p>Wilt u een huis kopen in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van huizen in Suriname.<br />
Wilt u een woning huren in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van huurwoningen in Suriname.
Bent u op zoek naar een zakenpand of een perceel dat geschikt is voor zakelijke doeleinden in Suriname? Op deze pagina staat een overzicht van ons actuele aanbod van commercieel onroerend goed in Suriname.</p>
<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" alt=""><br /><br />
</div>-->

<?php #query_posts("cat=$cat&showposts=$egamer_catnum_posts&paged=$paged"); ?>
<?php query_posts("cat=$cat&showposts=48&paged=$paged"); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

	<?php $width = 182;
		  $height = 129;
				  
		  $classtext = 'thumbnail';
		  $titletext = get_the_title();

		  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'image_value');
		  $thumb = $thumbnail["thumb"]; ?>

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
		<p align="center" style="font-size: 12px; font-family: Verdana!important;">
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
<h1><?php _e('No Results Found','eGamer') ?></h1>
<p><?php _e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','eGamer') ?></p>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>