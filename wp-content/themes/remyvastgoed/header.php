<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="description" content="De site met het grootste vastgoedaanbod van Suriname" />
	<meta property="og:image" content="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/og-image.png" />
    <meta name="keywords" content="vastgoed, suriname, remy, percelen, woningen, verkaveling, project, bouw, bemiddeling, onroerend goed" />
<meta name="google-site-verification" content="PmmJQcbD-p4rd53spjdv9HNwD14xrj8ttQAN64DgRPc" />
<link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon.png" rel="apple-touch-icon" />
<link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-152.png" rel="apple-touch-icon" sizes="152x152" />
<link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-167.png" rel="apple-touch-icon" sizes="167x167" />
<link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon-180.png" rel="apple-touch-icon" sizes="180x180" />
<link href="https://remyvastgoed.com/wp-content/themes/remyvastgoed/images/apple-touch-icon.png" rel="icon" sizes="180x180" />
<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />

	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
       <?php
          if (function_exists('is_tag') && is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif (is_search()) {
             echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
          elseif (!(is_404()) && (is_single()) || (is_page())) {
             wp_title(''); echo ' - '; }
          elseif (is_404()) {
             echo 'Not Found - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
              bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; }
       ?>
	</title>
	

  


    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo( 'template_url' ); ?>/css/print.css" rel="stylesheet">
  
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=202001241521" type="text/css" />  
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?3i903pu8Ey5Q1q9Rylf8Zkz3XlO2K4Vi";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
	<!--End of Zopim Live Chat Script-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-43396840-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-43396840-1');
</script>

	
</head>

<body <?php body_class(); ?>>
  <div class="test"><?php wpfp_list_favorite_posts(); ?></div>
  <div id="header_outer">
    <div id="header" class="container">
      <div class="row">
  
        <div class="col-md-9 menu">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          
          <div id="navbar" class="collapse navbar-collapse">
            <?php wp_nav_menu(); ?>  
          </div>

          <div id="date_time">
            <h1>Het grootste vastgoedaanbod van Suriname</h1>
          </div>
        </div>
        <div class="col-md-3 logo">
          <a href="http://www.remyvastgoed.com"><img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" title="Remy Vastgoed - Onroerend goed in Suriname" alt="Remy Vastgoed logo" /></a>
        </div>        
      </div>
    </div>

  </div> 
  <div class="container">