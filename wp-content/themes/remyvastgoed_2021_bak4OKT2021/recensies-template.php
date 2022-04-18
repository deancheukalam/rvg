<?php
/*
Template Name: Recensies Page Template
*/
?>
<?php get_header(); ?>

<div class="col-xs-12" id="resensiespage">
  <h2>Recensies</h2>
  <?php the_content(); ?>
</div>
<!-- <div id="content">
    <div class="map page">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

          <div class="entry">
            <div class="se-pre-con"></div>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>

          </div>

        </div>

      <?php endwhile;
      endif; ?>
    </div>	
    
  </div> -->

<a href="#" class="scrollToTop"></a>

<?php get_footer(); ?>