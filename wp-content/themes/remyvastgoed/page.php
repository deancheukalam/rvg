<?php get_header(); ?>

  <div id="content">
    <div class="col-md-9 objects page">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

          <div class="entry">
            <div class="se-pre-con"></div>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>

          </div>

        </div>

      <?php endwhile; endif; ?>
    </div>	
    <?php get_sidebar(); ?>
  </div>

<a href="#" class="scrollToTop"></a>

<?php get_footer(); ?>