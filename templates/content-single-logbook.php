<?php while (have_posts()) : the_post(); ?>
  <article class="wrapper">
    <div class="row">
      <div class="col-xs-12 col-sm-8">
        <header>
          <h1 class="entry-title" id="entry-title"><?php the_title(); ?></h1>
          <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </div>
        <div class="col-xs-12 col-sm-4">
          <div class="wrapper-sidebar">
            <?php dynamic_sidebar('sidebar-logbook'); ?>
          </div>
        </div>
    </div>
  </article>
<?php endwhile; ?>
