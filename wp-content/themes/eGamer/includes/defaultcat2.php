<?php
  global $wpdb;
  $t='';
  $query = '';
  _e( '<h1 class="post-title" 
             style="margin-top: 27px; 
                    line-height: 29px; 
                    font-size: 10px; 
                    font-family: verdana,geneva; 
                    font-weight: bold; 
                    text-decoration: none;"><a href="' )._e( the_permalink().'" 
                                               rel="bookmark" 
                                               title="' ).printf(__('Permanent Link to %s','eGamer'), get_the_title())._e( ' ">' );
  $array = array();
  if( $_POST[ 's' ] )
  {
    $query = "SELECT wp_posts.ID
              FROM wp_posts
              LEFT OUTER JOIN wp_postmeta
              ON wp_posts.ID=wp_postmeta.post_id
              WHERE wp_postmeta.meta_value LIKE '%".$_POST[ 's' ]."%'
              AND wp_posts.post_status='publish'
              AND wp_postmeta.meta_key='Objectnummer'
              ORDER BY wp_posts.post_date
              DESC";
    _e( 'Zoekresultaten' );
    //_e( 'Zoekresultaten voor objectnummer: '.$_POST[ 's' ] );
  }
  if( $_GET[ 's' ] )
  {
    $query = "SELECT wp_posts.ID
              FROM wp_posts
              LEFT OUTER JOIN wp_postmeta
              ON wp_posts.ID=wp_postmeta.post_id
              WHERE wp_posts.post_title LIKE '%".$_GET[ 's' ]."%'
              AND wp_posts.post_status='publish'
              AND wp_postmeta.meta_key='Objectnummer'
              ORDER BY wp_posts.post_date
              DESC";
    //_e( 'Zoekresultaten voor straatnaam: '.$_GET[ 's' ] );
    _e( 'Zoekresultaten' ); 
  }
   _e( '</a><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streep.gif" border="0">' );
  _e( '</h1>' );
  
  $rows = $wpdb->get_results( $query,ARRAY_N );
  if( $rows )
  {
    foreach( $rows as $row ) 
    { 
      $t .= $row[ 0 ].',';
    } 
  }
  else
  {
   $t.='';
  } 
  //die();
     
  $args = array(
                  'posts_per_page'  => 15,
                  'cat'             => $cat,
                  'paged'           => $paged,
                  'post__in'        => explode( ',',rtrim( $t,',' ) ),
                  'orderby'         => 'title',
                  'order'           => 'DESC',
                  'meta_query'      => $array
                );    
  query_posts( $args );  ?>
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
<h1><?php _e('Geen resultaten gevonden','eGamer') ?></h1>
<p><?php _e('De door u opgevraagde pagina kon niet worden gevonden. Probeer uw zoekopdracht te verfijnen of gebruik de navigatie hierboven om het bericht te vinden.','eGamer') ?></p>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>