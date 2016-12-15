<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

  <div class="row">
    <div class="col-xs-12 col-sm-8">
      
    <?php 
    $fields = get_fields();

      if( isset($fields) ) {
        foreach( $fields as $field_name => $value ) {
          
            // large image
            $size = 'medium';
            $thumb = $value['sizes'][ $size ];
            $width = $value['sizes'][ $size . '-width' ];
            $height = $value['sizes'][ $size . '-height' ];
            $url = $value['url'];
            $title = $value['title'];
            $alt = $value['alt'];
            $caption = $value['caption']; ?>
            
            <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
              <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="FullWidth" />
            </a>
          <?php 
        }
      } ?>
    </div>
  </div>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
