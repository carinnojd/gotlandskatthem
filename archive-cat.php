

<?php

if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <a href="<?php the_permalink(); ?>"><div class=""><?php the_post_thumbnail('small-thumbnail'); ?></div></a>
   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>



<?php endwhile; ?>

<?php the_posts_navigation(); ?>



<?php while (have_posts()) : the_post(); ?>
	<a href="<?php the_permalink(); ?>"><div class=""><?php the_post_thumbnail('small-thumbnail'); ?></div></a>
  <?php get_template_part('templates/content', get_post_type() != 'cat' ? get_post_type() : get_post_format()); ?>


<?php endwhile; ?>



