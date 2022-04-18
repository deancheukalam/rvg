
<?php

    $wpfp_before = "";
//    echo "<div class='wpfp-span'>";
    if (!empty($user)) {
        if (wpfp_is_user_favlist_public($user)) {
            $wpfp_before = "$user's Favorite Posts.";
        } else {
            $wpfp_before = "$user's list is not public.";
        }
    }

    if ($wpfp_before):
        echo '<div class="wpfp-page-before">'.$wpfp_before.'</div>';
    endif;

    if ($favorite_post_ids) {
    echo '<p class="verwijder">'.wpfp_clear_list_link().'</p>';
		$favorite_post_ids = array_reverse($favorite_post_ids);
        $post_per_page = wpfp_get_option("post_per_page");
        $page = intval(get_query_var('paged'));

        $qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
        // custom post type support can easily be added with a line of code like below.
        // $qry['post_type'] = array('post','page');
        query_posts($qry);
		?>
<div id="objects_inner">


<?php
        while ( have_posts() ) : the_post(); ?>
	
      <?php if(in_category( 'In prijs verlaagd')) { ?>
      <div class="object col-md-4 verlaagd">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Tijdelijk niet beschikbaar')){ ?>
      <div class="object col-md-4 onhold">
		  <?php wpfp_link() ?>
		  <?php }elseif(in_category( 'Ajay Jilamsing')){ ?>
      <div class="object col-md-4 onhold">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Uitverkocht')){ ?>
      <div class="object col-md-4 uitverkocht">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Verhuurd')){ ?>
      <div class="object col-md-4 verhuurd">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Verkocht')){ ?>
      <div class="object col-md-4 verkocht">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Verkocht ovb')){ ?>
      <div class="object col-md-4 verkocht_ovb">
		  <?php wpfp_link() ?>
	  <?php }elseif(in_category( 'Interne financiering mogelijk')){ ?>
      <div class="object col-md-4 interne_fin">
		  <?php wpfp_link() ?>
      <?php }else{ ?>
      <div class="object col-md-4">
		  <?php wpfp_link() ?>
      <?php } ?>
<?php
          $custom_fields = get_post_custom(get_the_ID);
          $custom_fields = get_post_custom(get_the_ID);
          $fields = array_keys($custom_fields);

          if (in_array("Thumbnail", $fields)) {
            foreach($custom_fields['Thumbnail'] as $thumb){
              echo '<a href="' . get_permalink() . '" target="_blank"><img src="' . $thumb . '" class="object_img img-responsive" /></a>'; 
            }
          }
        ?>
		
		 <?php
			// GLIS stikkers
			glisStickers();
					
			// GLIS stikker
			
			?>

        <div class="object_inner">
          <?php
            echo '<span class="title">';
            the_title();
            echo '</span>';
            if (in_array("Prijs", $fields)) {              
              foreach($custom_fields['Prijs'] as $prijs){
                if($prijs == 'n.o.t.k.' || strpos($prijs, 'vanaf') !== false || strpos($prijs, 'v.a.') !== false || strpos($prijs, 'tot') !== false || strpos($prijs, 'Verhuurd') !== false || strpos($prijs, 'on hold') !== false || strpos($prijs, 't.e.a.b.') !== false || strpos($prijs, '$') !== false || strpos($prijs, 'Verkocht ovb') !== false || $prijs == 'notk'){
                  echo '<span class="prijs">' . $prijs . '</span>'; 
                }elseif(in_category('verkavelingsprojecten')) {
                  echo '<span class="prijs">v.a. € ' . number_format($prijs,0,",",".") . '</span>';
                }else{
                  echo '<span class="prijs">€ ' . number_format($prijs,0,",",".") . '</span>';
                }
              }
            }
            if (in_array("Locatie", $fields)) {
              foreach($custom_fields['Locatie'] as $locatie){
                echo '<span class="locatie">' . $locatie . '</span>'; 
              }
            }
            if (in_array("Objectnummer", $fields)) {
              foreach($custom_fields['Objectnummer'] as $objectnummer){
                echo '<span class="objectnummer">#' . $objectnummer . '</span>'; 
              }
            }
            echo '<div class="object_inner_bottom">';
              echo '<div class="object_inner_bottom_left">';
                if (in_array("Type", $fields)) {
                  foreach($custom_fields['Type'] as $type){
                    echo '<span class="type">' . $type . '</span><br />'; 
                  }
                }                
                if (in_array("Interieur", $fields)) {
                  foreach($custom_fields['Interieur'] as $interieur){
                    echo '<span class="interieur">'. $interieur .'</span><br />';
                  }
                }
                if (in_array("Titel", $fields)) {
                  foreach($custom_fields['Titel'] as $titel){
                    echo '<span class="titel">' . $titel . '</span><br />'; 
                  }
                }
                if (in_array("Perceel", $fields)) {
                  foreach($custom_fields['Perceel'] as $perceel){
                    if(in_category('verkavelingsprojecten')) {
                      echo '<span class="perceel">Vanaf ' . number_format($perceel,0,",",".") . ' m²</span>'; 
                    }else{
                      echo '<span class="perceel">' . number_format($perceel,0,",",".") . ' m²</span>'; 
                    }
                  }
                }
              echo '</div>';
              
              echo '<div class="object_inner_bottom_right">';

//				echo '<pre>';
//				echo end($custom_fields['Prijs per m2']);
//				echo '</pre>';

        		if (in_array("Prijs per m2", $fields)) {
          if(in_category('Verkavelingsprojecten')){
            echo '<span class="prijsperm">Vanaf € ' . number_format(end($custom_fields['Prijs per m2']),0,",",".") . ' p/m²</span>'; 
          }elseif(in_category('Percelen') || in_category('Zakelijke percelen') || in_category('In prijs verlaagd') && in_category('Percelen') || in_category('In prijs verlaagd') && in_category('Zakelijke percelen') || in_category('In prijs verlaagd') && in_category('Verkavelingsprojecten') || in_category('On hold') && in_category('Percelen') || in_category('On hold') && in_category('Zakelijke percelen') || in_category('On hold') && in_category('Verkavelingsprojecten') || in_category('Verkocht') && in_category('Percelen') || in_category('Verkocht') && in_category('Zakelijke percelen') || in_category('Verkocht') && in_category('Verkavelingsprojecten') || in_category('Verkocht ovb') && in_category('Percelen') || in_category('Verkocht ovb') && in_category('Zakelijke percelen') || in_category('Verkocht ovb') && in_category('Verkavelingsprojecten') || in_category('Uitverkocht') && in_category('Percelen') || in_category('Uitverkocht') && in_category('Zakelijke percelen') || in_category('Uitverkocht') && in_category('Verkavelingsprojecten')){
            echo '<span class="prijsperm">€ ' . number_format(end($custom_fields['Prijs per m2']),0,",",".") . ' p/m²</span>';
          }else{
            
          }
                }

                if (in_array("Kamers", $fields)) {
                  foreach($custom_fields['Kamers'] as $kamers){
                    echo '<span class="kamers">' . $kamers . ' kamers</span>'; 
                  }
                }
                if (in_array("Slaapkamers", $fields)) {
                  foreach($custom_fields['Slaapkamers'] as $slaapkamers){
                    echo '<span class="slaapkamers">' . $slaapkamers . ' slaapkamers</span>'; 
                  }
                }
                if (in_array("Oppervlakte", $fields)) {
                  foreach($custom_fields['Oppervlakte'] as $oppervlakte){
                    echo '<span class="oppervlakte">' . number_format($oppervlakte,0,",",".") . ' m² bvo</span>'; 
                  }
                }
              echo '</div>';
            echo '</div>';
          ?>
        </div>
        <div class="object_footer">
          <a href="<?php echo get_permalink(); ?>" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/images/marker_icon.png" class="marker_icon" />
          <span class="info_txt">Meer informatie</span>
          <span><img src="<?php bloginfo( 'template_url' ); ?>/images/info_icon.png" class="info_icon" /></span></a>
  		</div>
    </div>
		<?php	
        endwhile; ?>

</div>
		<?php
        echo '<div class="navigation">';
            if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
            <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
            <?php }
        echo '</div>';

        wp_reset_query();
    } else {
        $wpfp_options = wpfp_get_options();
        //======================================= fab fix
        echo '<div id="fav-empty"><span>'.$wpfp_options['favorites_empty'].'</span>
        <span id="fav-link-wrapper"><span> Klik op de</span><a href="'.get_site_url().'/bewaard/"><span id="bookmrk-logo"></span></a><span>om objecten te bewaren.</span></span></div>';
    }
    
//    echo "</div>";
    // wpfp_cookie_warning();