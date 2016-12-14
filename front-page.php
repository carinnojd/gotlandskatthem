<?php if ( in_array('contributor', $current_user->roles) ){
    $role = 'contributor';
  } else {
    $role = 'other';
  }
?>



<?php while (have_posts()) : the_post(); ?>
<?php if ($role == 'contributor'){
	echo 'contributor';
} else {
	echo 'annat';
	}?>

<div class="slider FullWidth">

	<?php 
$fields = get_fields();

	if( isset($fields) ) {
		foreach( $fields as $field_name => $value ) {
			 ?>
			
				<?php if(preg_match('/^slide/', $field_name)) {

					// large image
					$size = 'large';
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
				if(preg_match('/^text_till/', $field_name)) {
					echo'<h2>' . $value . '</h2>'; // You can access $value or create a new array based off these values
				} ?>
			
			
				
		<?php
		}
	}
?>
</div>
<?php endwhile; ?>
	



	


	<!-- site-content -->
	<div class="site-content clearfix">
		
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
				<?php if ( has_post_format( 'image' )) { ?>  
                	
					<div class="thumbnail">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<h3 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>
					</div>
            
                <?php }
			endwhile; 
		endif; 
		// Reset Post Data
		wp_reset_postdata(); ?>
	</div><!-- /site-content -->

 

