<?php
/*
Template Name: Kaart Template
*/
?>
<?php get_header(); ?>

<div id="kaartenpage" class="">
    <div class="col-xs-3 sidecol">
        <h2>Objecten op de kaart</h2>
        <ul class="kaartenmenu">
            <li class="alleobjecten"><a href="<?php echo  get_site_url(); ?>/kaart" class="<?php if($post->ID == 8454){ echo 'active'; } ?>">Alle objecten</a></li>
            <li class="percelen"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-percelen" class="<?php if($post->ID == 81774){ echo 'active'; } ?>">Percelen</a></li>
            <li class="koopwoningen"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-koopwoningen" class="<?php if($post->ID == 81790){ echo 'active'; } ?>">Koopwoningen</a></li>
            <li class="huurwoningen"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-huurwoningen" class="<?php if($post->ID == 81779){ echo 'active'; } ?>">Huurwoningen</a></li>
            <li class="btnbelegginspaden"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-beleggingspanden" class="<?php if($post->ID == 81781){ echo 'active'; } ?>">Beleggingspanden</a></li>
            <li class="zakelijkekooppanden"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-zakelijkekooppanden" class="<?php if($post->ID == 81783){ echo 'active'; } ?>">Zakelijke kooppanden</a></li>
            <li class="zakelijkehuurpanden"><a href="<?php echo  get_site_url(); ?>/kaart/kaart-zakelijkehuurpanden" class="<?php if($post->ID == 81788){ echo 'active'; } ?>">Zakelijke huurpanden</a></li>
        </ul>
    </div>
    <div class="col-xs-9 maincol">
        <!-- <h2><?php the_title();?></h2> -->
        <?php the_content(); ?>
    </div>
</div>

<a href="#" class="scrollToTop"></a>

<?php get_footer(); ?>