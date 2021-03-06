<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>

<head profile="http://gmpg.org/xfn/11">
    <!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>" />
    <meta name="description" content="De site met het grootste vastgoedaanbod van Suriname" />
    <meta property="og:image" content="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/og-image.png" />
    <meta name="keywords"
        content="vastgoed, suriname, remy, percelen, woningen, verkaveling, project, bouw, bemiddeling, onroerend goed" />
    <meta name="google-site-verification" content="PmmJQcbD-p4rd53spjdv9HNwD14xrj8ttQAN64DgRPc" />

    <link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon.png"
        rel="apple-touch-icon" />
    <link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-152.png"
        rel="apple-touch-icon" sizes="152x152" />
    <link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-167.png"
        rel="apple-touch-icon" sizes="167x167" />
    <link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-180.png"
        rel="apple-touch-icon" sizes="180x180" />
    <link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon.png" rel="icon"
        sizes="180x180" />
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico" type="image/x-icon" />


    <?php if (is_search()) {?>
    <meta name="robots" content="noindex, nofollow" />
    <?php }?>

    <title>
        <?php
if (function_exists('is_tag') && is_tag()) {
    single_tag_title("Tag Archive for &quot;");
    echo '&quot; - ';} elseif (is_archive()) {
    wp_title('');
    echo ' Archive - ';} elseif (is_search()) {
    echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';} elseif (!(is_404()) && (is_single()) || (is_page())) {
    wp_title('');
    echo ' - ';} elseif (is_404()) {
    echo 'Not Found - ';}
if (is_home()) {
    bloginfo('name');
    echo ' - ';
    bloginfo('description');} else {
    bloginfo('name');}
if ($paged > 1) {
    echo ' - page ' . $paged;}
?>
    </title>




    <!-- SHN    <?php bloginfo('template_url');?> -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all"
        href="<?php bloginfo('template_url');?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url');?>/css/magnific-popup.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_url');?>/print/css/print.css"
        rel="stylesheet">
    <?php $path_style = get_template_directory().'/style.css'; ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>?v=<?php echo filemtime($path_style); ?>" type="text/css" />

    <link rel="pingback" href="<?php bloginfo('pingback_url');?>" />

    <?php if (is_singular()) {
    wp_enqueue_script('comment-reply');
}
?>

    <?php wp_head();?>

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim || (function(d, s) {
        var z = $zopim = function(c) {
                z._.push(c)
            },
            $ = z.s =
            d.createElement(s),
            e = d.getElementsByTagName(s)[0];
        z.set = function(o) {
            z.set.
            _.push(o)
        };
        z._ = [];
        z.set._ = [];
        $.async = !0;
        $.setAttribute("charset", "utf-8");
        $.src = "//v2.zopim.com/?3i903pu8Ey5Q1q9Rylf8Zkz3XlO2K4Vi";
        z.t = +new Date;
        $.
        type = "text/javascript";
        e.parentNode.insertBefore($, e)
    })(document, "script");
    </script>
    <!--End of Zopim Live Chat Script-->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-43396840-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-43396840-1');
    </script>


</head>

<body <?php body_class();?>>
<div id="main-wrapper"><!--start main wrapper-->
    <div class="test"><?php wpfp_list_favorite_posts(); ?></div>
    <?php dynamic_sidebar('mobilesearch'); ?>
    <div id="header_outer">
        <div id="header">
        <div class="bg-first">
            <div class="container first">
                <div class="row first">
                    <div class="col-md-3 logo">
                        <a href="<?php echo get_site_url(); ?>"><img
                                src="<?php bloginfo('template_url');?>/images/logo-remy-vastgoed.png"
                                title="Remy Vastgoed - Onroerend goed in Suriname" alt="Remy Vastgoed logo" /></a>
                    </div>
                    <div class="col-md-9 slogan">
                        De site met het grootste vastgoedaanbod van Suriname
                    </div>
                </div>
            </div>
            </div>
            <div class="bg-second">
            <div class="container second">
                <div class="row second">
                    <div class="col-md-9 menu">
                        <div class="navbar-header">
                            <a href="#" class="mobile_menubtn">
                                <i class="mob-icon-menu mob-menu-icon closed"></i>
                                <i class="mob-icon-cancel mob-menu-icon open" style="display: none"></i>
                            </a>
                            <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button> -->
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

                        </div>

                        <div id="date_time">
                            <!-- <h1>Het grootste vastgoedaanbod van Suriname</h1> -->
                            <div class="breadcrumbs">
                                <a href="<?php echo get_site_url(); ?>">Remy Vastgoed</a><span>&nbsp???&nbsp</span>

                                <?php 
                                if (in_category('Alle percelen') || in_category('Verkavelingsprojecten') || in_category('Gated community percelen')){
                                    echo 'Percelen<span>&nbsp???&nbsp</span>';
                                    // if(in_category('Alle percelen') && is_single()){
                                    //      echo ' <a href="' . get_site_url() .'/percelen">Alle percelen</a><span>&nbsp???&nbsp</span>';
                                    // }
                                    // if(in_category('Verkavelingsprojecten') && is_single()){
                                    //      echo ' <a href="' . get_site_url() .'/verkavelingsprojecten">Verkavelingsprojecten</a><span>&nbsp???&nbsp</span>';
                                    // }
                                    // if(in_category('Gated community percelen') && is_single()){
                                    //      echo ' <a href="' . get_site_url() .'/gatedcommunitypercelen">Gated community percelen</a><span>&nbsp???&nbsp</span>';
                                    // }
                                }

                                if (in_category('Alle koopwoningen') || in_category('Nieuwbouwwoningen') || in_category('Nog af te bouwen woningen') || in_category('Gated community woningen') || in_category('Huurwoningen')){
                                    echo 'Woningen<span>&nbsp???&nbsp</span>';
                                }
                                if (in_category('Beleggingspanden') || in_category('Zakelijke kooppanden') || in_category('Zakelijke huurpanden')){
                                    echo 'Zakelijk o.g.<span>&nbsp???&nbsp</span>';
                                }
                                ?>
                                
                                <?php
                                // global $wp_query;
                                // $postid = $wp_query->post->ID;
                                // echo get_post_meta($postid, 'Type', true);
                                // wp_reset_query();
                                ?>


                                <?php if (is_page( array('58811', '58813', '58815', '20828', '58782', '20827') )): ?>
                                Financieringen<span>&nbsp???&nbsp</span>
                                <?php elseif (is_page( array('6660', '6749', '20523') )): ?>
                                Bemiddelingen<span>&nbsp???&nbsp</span>
                                <?php elseif (is_page( array('24895', '24897') )): ?>
                                Adverteren<span>&nbsp???&nbsp</span>
                                <?php elseif (is_page( array('58066', '58152', '58112', '52306') )): ?>
                                Overige<span>&nbsp???&nbsp</span>
                                <?php endif; ?>

                                <?php 
                        
                                    if ( is_category() ) {
                                        $title = single_cat_title( '', false );
                                    } elseif ( is_post_type_archive() ) {
                                        $title = post_type_archive_title( '', false );
                                    } elseif ( is_tax() ) {
                                        $title = single_term_title( '', false );
                                    } else {
                                        $title = get_the_title( '', false );
                                    }
                                  
                                    echo $title;
                                ?>

                            </div>

                            <!-- <div class="header-search">
                        <?php //get_search_form(); ?>
                        <?php //echo do_shortcode("[search-form id='alles_zoeken' target='19922']"); ?>
                        </div> -->
                        </div>
                    </div>
                    <div class="col-md-3 menu sub">
                        <?php wp_nav_menu( array( 'theme_location' => 'sub-menu' ) ); ?>
                        <?php dynamic_sidebar( 'header_search' ); ?>
                    </div>

                </div>
            </div>
            </div>
        </div>

    </div>
    <div class="nav-spacer" style="display: none;"></div>

    
<div id="content-wrapper"><!--start content wrapper-->
    <div class="container page">