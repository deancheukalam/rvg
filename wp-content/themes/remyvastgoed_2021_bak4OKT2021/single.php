<?php get_header();?>
<?php
$prev_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
?>

<div class="col-xs-12" id="object_mobile_title"></div>

<div class="col-xs-12" id="object_mobile_tabs">
        
    <!-- Nav tabs -->
    <ul class="mobilenav nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tabinfo" aria-controls="tabinfo" role="tab" data-toggle="tab">Info</a></li>
        <li id="btn_tabfotos" role="presentation"><a href="#tabfotos" aria-controls="tabfotos" role="tab" data-toggle="tab">Foto's</a></li>
        <li role="presentation"><a href="#tablocatie" aria-controls="tablocatie" role="tab" data-toggle="tab">Locatie</a></li>
        <li role="presentation"><a href="#tabdelen" aria-controls="tabdelen" role="tab" data-toggle="tab">Delen</a></li>
        <li role="presentation"><a href="#tabreageren" aria-controls="tabreageren" role="tab" data-toggle="tab">Reageren</a></li>
        <li class="small_btn terug" role="presentation"><a href="#tabterug" aria-controls="tabterug" role="tab" data-toggle="tab">Terug</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tabinfo"></div>
        <div role="tabpanel" class="tab-pane" id="tabfotos"></div>
        <div role="tabpanel" class="tab-pane" id="tablocatie"></div>
        <div role="tabpanel" class="tab-pane" id="tabdelen"></div>
        <div role="tabpanel" class="tab-pane" id="tabreageren"></div>
    </div>

</div>

<div id="content">
    <div class="col-md-5 objects single sidebar" style="position:relative;" id="left_sidebar">    
    <!-- <h2>Filter</h2>
        <?php //dynamic_sidebar('sidebar');?> -->
        <div id="top_section">
                <h2 class="title"><?php the_title();?></h2>
                <?php
        $custom_fields = get_post_custom(the_ID);
        $fields = array_keys($custom_fields);
        if (in_array("Prijs", $fields)) {
            foreach ($custom_fields['Prijs'] as $prijs) {
                if ($prijs == 'n.o.t.k.' || strpos($prijs, 'vanaf') !== false || strpos($prijs, 'v.a.') !== false || strpos($prijs, 'tot') !== false || strpos($prijs, 'Verhuurd') !== false || strpos($prijs, 'on hold') !== false || strpos($prijs, 't.e.a.b.') !== false || strpos($prijs, '$') !== false || strpos($prijs, 'Verkocht ovb') !== false || $prijs == 'notk') {
                    echo '<h2 class="prijs">' . $prijs . '</h2>';
                } elseif (in_category('verkavelingsprojecten')) {
                echo '<h2 class="prijs">Vanaf € ' . number_format($prijs, 0, ",", ".") . '</h2>';
            } else {
                echo '<h2 class="prijs">€ ' . number_format($prijs, 0, ",", ".") . '</h2>';
            }
        }
    }
    if (in_array("Locatie", $fields)) {
        foreach ($custom_fields['Locatie'] as $locatie) {
            echo '<span class="locatie">' . $locatie . '</span>';
        }
    }
    if (in_array("Objectnummer", $fields)) {
        foreach ($custom_fields['Objectnummer'] as $objectnummer) {
            echo '<span class="objectnummer">#' . $objectnummer . '</span>';
        }
    }
    ?>
                <?php wpfp_link()?>
            </div>
            <div id="bottom_section">
                <?php wpfp_link()?>
                <div
                <?php if (in_category('In prijs verlaagd')){?>
               class="verlaagd"
               <?php } elseif (in_category('In bewoonde staat')) {?>
                    class="bewoond"
                    <?php } elseif (in_category('Tijdelijk niet beschikbaar')) {?>
                    class="onhold"
                        <?php } elseif (in_category('Uitverkocht')) {?>
                        class="uitverkocht"
                            <?php } elseif (in_category('Verhuurd')) {?>
                            class="verhuurd"
                                <?php } elseif (in_category('Verkocht')) {?>
                                class="verkocht"
                                    <?php } elseif (in_category('Verkocht ovb')) {?>
                                    class="verkocht_ovb"
                                        <?php } elseif (in_category('Interne financiering mogelijk')) {?>
                                        class="interne_fin"
                                            <?php } else {?>
                                            class=""
                                                <?php }?>
                                                >
                                            
                                            <div class="kenmerken">
                                                <h2>Kenmerken</h2>
                                                <table class="table">
                                                    <?php
                                                    //                echo '<pre>';
                                                    //                var_dump($fields);
                                                    //                echo '</pre>';
                                                    if (in_array("Type", $fields)) {
                                                        foreach ($custom_fields['Type'] as $type) {
                                                            echo '<tr>
                                                                              <td>Type</td>
                                                                              <td>' . $type . '</td>
                                                                            </tr>';
                                                        }
                                                    }
                                                    if (in_array("Interieur", $fields)) {
                                                        foreach ($custom_fields['Interieur'] as $interieur) {
                                                            echo '<tr>
                                                                              <td>Interieur</td>
                                                                              <td>' . $interieur . '</td>
                                                                            </tr>';
                                                        }
                                                    }
                                                    if (in_array("Titel", $fields)) {
                                                        foreach ($custom_fields['Titel'] as $titel) {
                                                            echo '<tr>
                                                                              <td>Titel</td>
                                                                              <td>' . $titel . '</td>
                                                                            </tr>';
                                                        }
                                                    }
                                                    if (in_array("Perceel", $fields)) {
                                                        foreach ($custom_fields['Perceel'] as $perceel) {
                                                            if (in_array("Perceel", $fields)) {
                                                                foreach ($custom_fields['Perceel'] as $perceel) {
                                                                    if (in_category('verkavelingsprojecten')) {
                                                                        echo '<tr>
                                                                                    <td>Perceeloppervlakte</td>
                                                                                    <td>Vanaf ' . number_format($perceel, 0, ",", ".") . ' m²</td>
                                                                                  </tr>';
                                                                    } else {
                                                                        echo '<tr>
                                                                                    <td>Perceeloppervlakte</td>
                                                                                    <td>' . number_format($perceel, 0, ",", ".") . ' m²</td>
                                                                                  </tr>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (in_array("Oppervlakte", $fields)) {
                                                        foreach ($custom_fields['Oppervlakte'] as $oppervlakte) {
                                                            echo '<tr>
                                                                              <td>Bouwoppervlakte</td>
                                                                              <td>' . number_format($oppervlakte, 0, ",", ".") . ' m²</td>
                                                                            </tr>';
                                                        }
                                                    }
                                                    if (in_array("Kamers", $fields)) {
                                                        foreach ($custom_fields['Kamers'] as $kamers) {
                                                            echo '<tr>
                                                                              <td>Aantal kamers</td>
                                                                              <td>' . $kamers . '</td>
                                                                            </tr>';
                                                        }
                                                    }
                                                    if (in_array("Slaapkamers", $fields)) {
                                                        foreach ($custom_fields['Slaapkamers'] as $slaapkamers) {
                                                            echo '<tr>
                                                                              <td>Aantal slaapkamers</td>
                                                                              <td>' . $slaapkamers . ' </td>
                                                                        
                                                                            </tr>';


                                                                            // koopwoningen
                                                                            // echo '<span class="toegekend"></span>';
                                                        }
                                                    }
                                                    if (in_array("Prijs per m2", $fields)) {
                                                        if (in_category('verkavelingsprojecten')) {
                                                            echo '<tr class="prijsperm">
                                                                              <td>Prijs per m²</td>
                                                                              <td>Vanaf € ' . number_format(end($custom_fields['Prijs per m2']), 0, ",", ".") . '</td>
                                                                            </tr>';
                                                        } elseif (in_category('percelen') || in_category('zakelijkepercelen')) {
                                                            echo '<tr class="prijsperm">
                                                                              <td>Prijs per m²</td>
                                                                              <td>€ ' . number_format(end($custom_fields['Prijs per m2']), 0, ",", ".") . '</td>
                                                                            </tr>';


                                                                            // Percelen
                                                                            
                                                        } else {
                                                        }
                                                    }
                                                    ?>
                                                </table>

                                                <div class="glis">
                                                    <?php
                                                        glisStickers();
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            <div class="desc">
                                                <h2>Omschrijving</h2>
                                                <?php
                                                the_content();
                                                ?>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>

      

    </div>
    <div class="col-md-7 objects single">
        <?php if (have_posts()): while (have_posts()): the_post();?>
        
        <!-- Set Featured Image While Loop By Bob  -->
        <div class="hide_image">
        <?php 
        if( has_post_thumbnail() ):
            echo get_the_post_thumbnail();
        endif; 
        ?>
        </div>

        <div <?php post_class()?> id="post-<?php the_ID();?>">



                                    <ul class="buttons">
                    <!-- <li style="width: 152.5px;"><a href="#" class="small_btn noclick photos">Foto's</a></li>
                    <li style="width: 159.5px;"><a href="#" class="small_btn noclick map">Locatie</a></li>
                    <li style="width: 149.5px;"><a href="#" class="small_btn noclick share">Delen</a></li>
                    <li style="width: 170.5px;"><a href="#" class="small_btn noclick mail">Reageren</a></li> -->
                    <li style="width: 20%;"><a href="#" class="small_btn noclick photos">Foto's</a></li>
                    <li style="width: 20%;"><a href="#" class="small_btn noclick map">Locatie</a></li>
                    <li style="width: 20%;"><a href="#" class="small_btn noclick share">Delen</a></li>
                    <li style="width: 20%;"><a href="#" class="small_btn noclick mail">Reageren</a></li>
                    
                   
                    <li><a href="#" onclick="goBack()" class="small_btn noclick terug">Terug</a></li>
                    <?php
    if (in_category('percelen') && ($prev_url != 'http://www.remyvastgoed.com')) {
        ?>
                    <li><a href="percelen" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
    } elseif (in_category('verkavelingsprojecten') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="verkavelingsprojecten" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('koopwoningen') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="koopwoningen" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('huurwoningen') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="huurwoningen" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('vakantieaccomodaties') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="vakantieaccomodaties" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('zakelijkepercelen') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="zakelijkepercelen" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('zakelijkekooppanden') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="zakelijkekooppanden" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif (in_category('zakelijkehuurpanden') && ($prev_url != 'http://www.remyvastgoed.com')) {
    ?>
                    <li><a href="zakelijkehuurpanden" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif ($prev_url == 'http://www.remyvastgoed.com') {
    ?>
                    <li><a href="http://www.remyvastgoed.com" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
} elseif ($prev_url == 'http://www.remyvastgoed.com/snel-zoeken?query=snel_zoeken') {
    ?>
                    <li><a href="http://www.remyvastgoed.com" class="small_btn back"><img
                                src="<?php bloginfo('template_url');?>/images/back.png" title="Terug" /></a></li>
                    <?php
}
?>
                </ul>
                
                <div class="entry"> <?php the_content(); ?>
                                            
                                            <!-- Bob Custom -->
                                            <!-- <div <?php post_class()?> id="post-<?php the_ID();?>"> -->
                                            <!-- <button onclick="copyClipboard()">Copy to clipboard</button> -->
                                            <!-- </div> -->
                                                </div>
                                                    <!-- Popup social shares -->
                                            <div id="newdiv3">
                                            <div class="leform2">
                                                <div class="delen_spacing">
                                                <h2 style="float: none;">Delen</h2>
                                                <div id="mail_form">
                                                    <input id="mailurl" type="text" />
                                                    <input id="mail_form_btn" type="button" value="E-mail" />
                                                </div>
                                            
                                                </div>
                                                <?php dynamic_sidebar('sidebar_sub');?>
                                                </div>
                                                <button id="buttonCopy" onclick="copyClipboard()" title="Link kopiëren"><i class="fa fa-link fa-3x"></i></button>
                                            </div>
                                            <!-- Popup social shares -->

                                    <div class="leform">
                                        <div class="contact-form">
                                        <!-- <h2 style="float: none;">Nog vragen? Neem contact met ons op!</h2> -->
                                        <?php echo do_shortcode('[contact-form-7 id="57648" title="Contact form 1_objecten"]'); ?>
                                        </div>
                                           
                                            <?php endwhile;endif;?>
                                    </div>
                                    <!-- newsletter code by Bob -->
                                    
                                </div>
                               
                       
                            </div>
                            </div>
                            </div>
                            <a href="#" class="scrollToTop"></a>
                            <?php get_footer();?>