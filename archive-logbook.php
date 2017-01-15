<?php

if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Ledsen, inget resultat kunde hittas.'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php

// Show all logbooks items exept the logbook form (id=21)
$allLogbooksArgs = array(
'post_type'        => 'logbook',
'post__not_in' => array(21),
'posts_per_page'=>-1
);

// The Query
$logbooksQuery = new WP_Query( $allLogbooksArgs ); ?>
<div class="wrapper">
	<div class="row"> <?php

		// The Loop
		while ( $logbooksQuery->have_posts() ) : $logbooksQuery->the_post(); ?>
		
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
			   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
		
		<?php endwhile;

		// Reset Post Data
		wp_reset_postdata(); ?>

	</div>
</div>

