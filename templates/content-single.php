<?php while (have_posts()) : the_post(); ?>
  <article class="wrapper">
  <div class="row">
    <div class="blogpost-image col-xs-12 col-sm-10"><?php the_post_thumbnail(); ?></div>
    <div class="col-xs-12">
      <header>
        <h1 class="entry-title" id="entry-title"><?php the_title(); ?></h1>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</article>
<?php endwhile; ?>
