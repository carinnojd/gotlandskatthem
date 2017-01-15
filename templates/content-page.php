<article class="wrapper">
	<div class="row ">
		<div class="col-xs-12 col-md-10 col-lg-9 col-centered">
			<?php the_content(); ?>

			<?php 
			// Show map if page has a Google map
			$location = get_field('map');
			if( !empty($location) ):
			?>
			<h4><?php echo $location['address']; ?></h4>
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					<p class="address"><?php echo $location['address']; ?></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</article>
