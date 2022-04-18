<?php
/*
Template Name: Regular Page Template
*/
?>

<?php get_header(); ?>

<div id="content" class="regularpage">

    <div class="col-md-9 objects page">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <div class="contact_spacing">
                        <div class="entry">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>

                        </div>
                    </div>
                </div>
               
        <?php endwhile;
        endif; ?>
    </div>

    <div class="col-md-3 sidebar ">
        <!-- Bob custom -->

        <!-- <div class="stick"> -->
            
            <div class="banner">
                <a href="#">
                    <img src="<?php echo site_url(); ?>/wp-content/themes/remyvastgoed/images/rbc_banner.jpg" />
                </a>
            </div>

            <div class="banner">
                <a href="#">
                    <img src="<?php echo site_url(); ?>/wp-content/themes/remyvastgoed/images/lont.jpg" />
                </a>
            </div>

            <div class="banner">
                <a href="#">
                    <img src="<?php echo site_url(); ?>/wp-content/themes/remyvastgoed/images/banner_geldleningen.png" />
                </a>
            </div>

            <div class="banner">

                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fremyvastgoed%2F&tabs=timeline&width=278&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=192711138031785" 
        width="277" height="130" style="border:none;overflow:hidden" 
        scrolling="no" frameborder="0" allowTransparency="true" 
        allow="encrypted-media"></iframe>
            </div>

        <!-- </div> -->

    </div>
    <!-- end contact-margin -->
    
</div>
<div id="outer">

</div>
<a href="#" class="scrollToTop"></a>
<?php get_footer(); ?>