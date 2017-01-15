<?php

if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Ledsen, inget resultat kunde hittas.'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

	<?php 

    // Put all fields in an array
    $fields = get_fields();
    
    $i = 0;
      if( isset($fields) ) {

        // Loop out the fields into HTML
        foreach( $fields as $field_name => $value ) {
          if($i == 0) {

            // Use cat-thumbnail size on image
            $size = 'cat-thumbnail';
            $thumb = $value['sizes'][ $size ];
            $width = $value['sizes'][ $size . '-width' ];
            $height = $value['sizes'][ $size . '-height' ];
            $url = $value['url'];
            $title = $value['title'];
            $alt = $value['alt'];
            $caption = $value['caption']; ?>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 cat-info">
      			<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="cat_thumbnail"/>
                <h3 class="cat-name" width="<?php echo $width; ?>"><?php the_title(); ?></h3></a>
			 </div>
       
            <?php 
            }

            // To only loop out the first image of each items
            $i++;
        }
      } 
    ?>
<?php endwhile; ?>




