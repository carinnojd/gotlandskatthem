<?php

if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <div class=""><?php the_post_thumbnail('small-thumbnail'); ?></div>
    <?php the_title( '<h3 class="page-title">', '</h3>' ); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>