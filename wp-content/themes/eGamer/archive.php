<?php get_header(); ?>

<div id="container">
<div id="left-div">
    <?php if (get_option('egamer_blog_style') == 'Blog Style') { ?>
    <?php include(TEMPLATEPATH . '/includes/blogstyle.php'); ?>
    <?php } else { include(TEMPLATEPATH . '/includes/defaultindex.php'); } ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>
