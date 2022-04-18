<?php if(in_category( 'In prijs verlaagd')) { ?>
<div class="object col-md-4 verlaagd">
	<?php wpfp_link() ?>
<?php }elseif(in_category( 'Tijdelijk niet beschikbaar')){ ?>
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

    $custom_fields = get_post_custom(the_ID);
    $fields = array_keys($custom_fields);

    $tags = wp_get_post_tags($post->ID);
//              echo '<pre>';
//              echo $tags[0]->slug;
//              var_dump($tags);
//              echo '</pre>';

    if (in_array("Thumbnail", $fields)) {
      foreach($custom_fields['Thumbnail'] as $thumb){
        echo '<a href="' . get_permalink() . '" target="_blank"><img src="' . $thumb . '" class="object_img img-responsive" /></a>'; 
      }
    }
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
                      echo '<span class="perceel">v.a. ' . number_format($perceel,0,",",".") . ' m² perceel</span>'; 
                    }else{
                      echo '<span class="perceel">' . number_format($perceel,0,",",".") . ' m² perceel</span>'; 
                    }
                  }
                }
              echo '</div>';
              
              echo '<div class="object_inner_bottom_right">';
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
                    echo '<span class="oppervlakte">' . number_format($oppervlakte,0,",",".") . ' m²</span>'; 
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
<?php if(in_category( 'In prijs verlaagd')) { ?>
<div id="verlaagd"></div>
<?php }elseif(in_category( 'Tijdelijk niet beschikbaar')){ ?>
'<div id="onhold"></div>
<?php }elseif(in_category( 'Uitverkocht')){ ?>
<div id="uitverkocht"></div>
<?php }elseif(in_category( 'Verhuurd')){ ?>
<div id="verhuurd"></div>
<?php }elseif(in_category( 'Verkocht')){ ?>
<div id="verkocht"></div>
<?php }elseif(in_category( 'Verkocht ov')){ ?>
<div id="verkocht_ovb"></div>
<?php }elseif(in_category( 'Interne financiering mogelijk')){ ?>
<div id="interne_fin"></div>
<?php }?>
</div>
