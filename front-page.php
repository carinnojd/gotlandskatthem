
<?php while (have_posts()) : the_post(); ?>

<!-- Site content -->

<!-- The image slider -->
<div class="row">
	<div class="col-xs-12 slider slider-front">
		
	<?php 

	// Put all fields in an array
	$fields = get_fields();
		if( isset($fields) ) {
			$i=0;
			
			foreach( $fields as $field_name => $value ) {
				
				// Select all slide images
				if(preg_match('/^slide/', $field_name)) {

					// Put all page links in an array
					$links=array(get_field('link_to_slider_1'), get_field('link_to_slider_2'), get_field('link_to_slider_3'), get_field('link_to_slider_4'), get_field('link_to_slider_5'));

					// Use size slider-image
					$size = 'slider-image';
					$thumb = $value['sizes'][ $size ];
					$width = $value['sizes'][ $size . '-width' ];
					$height = $value['sizes'][ $size . '-height' ];
					$url = $value['url'];
					$title = $value['title'];
					$alt = $value['alt'];
					$caption = $value['caption']; 
					?>
					
					<a href="<?php echo $links[$i++]; ?>" title="<?php echo $title; ?>">
					
						<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
					</a>
				<?php 
				}

				// Select all text
				if(preg_match('/^text_till/', $field_name)) {
					echo'<h2 class="slider-title">' . $value . '</h2>';
				} 	
			}
		} ?>
	</div>
</div>
<?php endwhile; ?>

<!-- The three lastest blogposts -->
<div class="wrapper">	
	<div class="row">
		
		<?php
		$args = array( 
	        'order' => 'DESC', 
	        'orderby' => 'post_date', 
	        'posts_per_page' => 3, 
	        'tax_query' =>              
	        array(
	            array(
	            'taxonomy' => 'post_format',
	            'field' => 'slug',
	            'terms' => 'post-format-image', 
	    ))); 

			// The Query
			$recent_posts = new WP_Query( $args ); 

			if ( $recent_posts->have_posts() ) : ?>
				<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
						<div class="thumbnail col-xs-12 col-sm-4">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="entry-summary">
								<?php $content = get_the_content();
  								$trimmed_content = wp_trim_words( $content, 22, '...<a href="'. get_permalink() .'"> [Läs mer]</a>' ); ?>
  									<p><?php echo $trimmed_content; ?></p>
							</div>
						</div>
	                <?php 
				endwhile; 
			endif; 

			// Reset Post Data
			wp_reset_postdata(); ?>
	</div>
</div> <!--/wrapper>

 

