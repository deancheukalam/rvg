<?php get_header();?>
<?php
$prev_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
?>
<div id="content">
    <div class="col-md-3 sidebar" style="position:relative;">    
    <h2>Filter</h2>
        <?php dynamic_sidebar('sidebar');?>

        <div id="facebook">
            <iframe
                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fremyvastgoed%2F&tabs=timeline&width=278&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=192711138031785"
                width="278" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
        <div id="facebook_sm">
            <iframe
                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fremyvastgoed%2F&tabs=timeline&width=278&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=192711138031785"
                width="278" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
    </div>
    <div class="col-md-6 objects single">
        <?php if (have_posts()): while (have_posts()): the_post();?>
        <!-- <div <?php post_class()?> id="post-<?php the_ID();?>">
		            <div class="entry">
		                <?php //the_content();?>
                        <?php if (in_array("Thumbnail", $fields)) {
                            foreach ($custom_fields['Thumbnail'] as $thumbnail) {
                                echo '<img src="' . $thumbnail . '" alt="">';
                            }
                        }
                        ?>
		                <h2 class="title"><?php the_title();?></h2>
		                <div id="basic-modal-content">
		                    <?php echo do_shortcode('[contact-form-7 id="25051" title="Doorsturen via e-mail"]'); ?>
		                </div>
		            </div>
		        </div> -->
        <div <?php post_class()?> id="post-<?php the_ID();?>">

            <?php if ( get_post_meta( get_the_ID(), 'Thumbnail', true ) ) : ?>
                <img class="thumb" src="<?php echo esc_url( get_post_meta( get_the_ID(), 'Thumbnail', true ) ); ?>"
                    alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>
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
                
            </div>
            <div id="bottom_section">
                <?php wpfp_link()?>
                <?php if (in_category('In prijs verlaagd')) {?>
                <div class="verlaagd">
                    <?php } elseif (in_category('Tijdelijk niet beschikbaar')) {?>
                    <div class="onhold">
                        <?php } elseif (in_category('Uitverkocht')) {?>
                        <div class="uitverkocht">
                            <?php } elseif (in_category('Verhuurd')) {?>
                            <div class="verhuurd">
                                <?php } elseif (in_category('Verkocht')) {?>
                                <div class="verkocht">
                                    <?php } elseif (in_category('Verkocht ovb')) {?>
                                    <div class="verkocht_ovb">
                                        <?php } elseif (in_category('Interne financiering mogelijk')) {?>
                                        <div class="interne_fin">
                                            <?php } else {?>
                                            <div class="">
                                                <?php }?>
                                            </div>
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
                                                                              <td>' . $slaapkamers . '</td>
                                                                            </tr>';
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
                                                        } else {
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="glis">
                                                <?php
                                                // GLIS stikkers
                                                glisStickers();
                                                
                                                // GLIS stikker
                                                ?>
                                            </div>
                                            <div class="desc">
                                                <h2>Omschrijving</h2>
                                                <?php
                                                the_content();
                                                ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <ul class="buttons">
                    <li><a href="#" class="small_btn noclick map"><img
                                src="<?php bloginfo('template_url');?>/images/location.png" title="Kaart" /></a></li>
                    <li><a href="#" class="small_btn noclick photos"><img
                                src="<?php bloginfo('template_url');?>/images/image.png" title="Foto's" /></a></li>
                    <li><a href="#" class="small_btn noclick mail"><img
                                src="<?php bloginfo('template_url');?>/images/e_mail.png" title="Mail ons" /></a></li>
                    <li>
                        <a href="#" class="small_btn noclick share"><img
                                    src="<?php bloginfo('template_url');?>/images/share.png" title="Delen" /></a>
                    </li>
                    <li><a href="wp-content/themes/remyvastgoed/print/index.php?objnr=<?php echo $objectnummer; ?>"
                            class="small_btn print" target="_blank"><img
                                src="<?php bloginfo('template_url');?>/images/print.png" title="Afdrukken" /></a></li>
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
                <div class="entry"> <?php
                                                the_content();
                                                ?>
                                            
                                                </div>
                                                    <!-- Popup social shares -->
                                            <div id="newdiv3">
                                            <div class="leform2">
                                                <h2 style="float: none;">Delen</h2>
                                                <div id="mail_form">
                                                    <input id="mailurl" type="text" />
                                                    <input id="mail_form_btn" type="button" value="E-mail" />
                                                </div>
                                                <?php dynamic_sidebar('sidebar_sub');?>
                                                </div>
                                            </div>
                                            <!-- Popup social shares -->

                                    <div class="leform">
                                        <h2 style="float: none;">Nog vragen? Neem contact met ons op!</h2>
                                        <?php echo do_shortcode('[contact-form-7 id="57648" title="Contact form 1_objecten"]'); ?>
                                    </div>
                                    <?php endwhile;endif;?>
                                </div>
                                <div class="col-md-3 sidebar-right">
                                    <!--
                                    <div class="banner">
                                    <a href="http://www.nvronantrading.com/" target="_blank"><img src="<?php //bloginfo( 'template_url' ); ?>/images/ronan_banner.jpg" class="img-responsive" /></a>
                                    </div>
                                    -->
                                    <div class="banner lont" style="margin-top: 14px;">
                                        <h2 class="ads">Advertenties</h2><br>
                                        <a href="http://lont-lalmahomed.nl/" target="_blank"><img
                                                src="<?php bloginfo('template_url');?>/images/lont.jpg"
                                                class="img-responsive" /></a>
                                    </div>
                                    <div class="banner">
                                        <a href="http://www.notariaatkalisingh.com/" target="_blank"><img
                                                src="<?php bloginfo('template_url');?>/images/kalisingh_logo.jpg"
                                                class="img-responsive" style="margin-bottom: -3px;" /></a>
                                    </div>
                                    <div class="banner">
                                        <a href="http://www.remyvastgoed.com/particulierefinanciering"
                                            target="_blank"><img
                                                src="<?php bloginfo('template_url');?>/images/banner_geldleningen.png"
                                                class="img-responsive" style="margin-bottom: -3px;" /></a>
                                    </div>
                                    <div class="sticky">
                                        <div class="banner">
                                            <a href="https://www.republicbanksr.com/" target="_blank"><img
                                                    src="<?php bloginfo('template_url');?>/images/rbc_banner.jpg"
                                                    class="img-responsive" /></a>
                                        </div>
                                    </div>
                                    <div id="outer">
                                    </div>
                                </div>
                                <div style="display:none;" id="_basic-modal-content">
                                    <?php echo do_shortcode('[contact-form-7 id="25051" title="Doorsturen via e-mail"]'); ?>
                                </div>
                            </div>
                            <?php get_footer();?>