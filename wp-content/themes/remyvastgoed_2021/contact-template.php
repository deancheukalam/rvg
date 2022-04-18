<?php
/*
Template Name: Contact Template
*/
?>

<?php get_header(); ?>

<div id="content">
<div class="col-md-3 sidebar contact">

<div id="contact">
    <h2>Contact</h2>
    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/mobile_icon_map_home.png" /> Albergastraat 29 </p>
    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/mobile_icon_blank.png" /> Paramaribo<br> <img
            src="<?php bloginfo( 'template_url' ); ?>/images/mobile_icon_blank.png" />&nbsp;Suriname</p>

    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/mobile_icon_time.png" /> Langskomen op kantoor? <a
            href="mailto:info@remyvastgoed.com"> Afspraak maken!</a></p>
    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/mobile_icon.png" /> +597 8508042 | +597 8696106</p>
    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/whatsapp_icon.png" /> +597 8989360</p>
    <p><img src="<?php bloginfo( 'template_url' ); ?>/images/mail_icon.png" /><a
            href="mailto:info@remyvastgoed.com"> info@remyvastgoed.com</a></p>

    <a href="kaart">
        <p class="kaart">Kaart</p>
    </a>
    <a href="recensies">
        <p class="kaart">Recensies</p>
    </a>
    <a href="contact">
        <p class="mail">Mail ons</p>
    </a>
</div>

<div id="facebook">
    <iframe
        src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FRemyVastgoedNV&amp;width=278&amp;height=266&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=true"
        scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:278px; height:220px;"
        allowTransparency="true"></iframe>
</div>

<div id="facebook_sm">
    <iframe
        src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FRemyVastgoedNV&amp;width=213&amp;height=270&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=true"
        scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:213px; height:220px;"
        allowTransparency="true"></iframe>
</div>

</div>
    <div class="col-md-9 objects page">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <div class="entry">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

            </div>

        </div>

        <?php endwhile; endif; ?>
    </div>

    

</div>
<div id="outer">

</div>
<a href="#" class="scrollToTop"></a>
<?php get_footer(); ?>