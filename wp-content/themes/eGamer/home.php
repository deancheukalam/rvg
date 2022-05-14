<?php get_header(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43396840-1', 'remyvastgoed.com');
  ga('send', 'pageview');

</script>
<div id="container">
<div id="left-div">
    <?php if (get_option('egamer_blog_style') == 'on') { ?>
    <?php include(TEMPLATEPATH . '/includes/blogstylehome.php'); ?>
    <?php } else { include(TEMPLATEPATH . '/includes/default.php'); } ?>
    <?php 
      $url = $_SERVER['REQUEST_URI'];
      if (strpos($url, "maps")!==false){
        echo 'mapppppp';
      }
    ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>