

<?php
//THE LOOP
if (have_posts()) :
	?>
	<h2>
		<?php 
		if(is_category()) {
			single_cat_title();
		} elseif (is_tag()) {
			single_tag_title();
		} elseif (is_author()) {
			the_post();
			echo 'Arkiv för författare ' . get_the_author();
		} elseif (is_day()) {
			echo 'Dagarkiv' . get_the_date();
		} elseif (is_month()) {
			echo 'Månadsarkiv' . get_the_date('F Y');
		} elseif (is_year()) {
			echo 'Årsarkiv' . get_the_date('Y');
		}else {
			echo 'Arkiv: ';
		}
		?>
	</h2>
	<?php
	while (have_posts()) : the_post();
	
		if ('image') {
			get_template_part('content', 'image');
		} else {
			get_template_part('content', get_post_format());
		}

	endwhile; ?>

<?php else : ?>
	<p><?php _e( 'Inga inlägg.' ); ?></p>
	<?php
endif;
?>

