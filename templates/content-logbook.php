<?php 
$logbookArgs = array(
'post_type'        => 'logbook',
'name' => 'skriv-ny-logg'
);


// The Query
$logbookQuery = new WP_Query( $logbookArgs );

// The Loop
while ( $logbookQuery->have_posts() ) : $logbookQuery->the_post(); ?>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  </div>  
<?php endwhile; 

// Reset Post Data
wp_reset_postdata();

?>

<h3><a href="<?php echo get_post_type_archive_link( 'logbook' ); ?>">Tidigare loggar</a></h3>