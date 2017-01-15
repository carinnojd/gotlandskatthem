<?php get_template_part('templates/page', 'header'); ?>
<div class="wrapper">
	<div class="alert alert-warning">
	  <?php _e('Ledsen, men sidan du sökte på finns inte.', 'sage'); ?>
	</div>

	<?php get_search_form(); ?>
</div>
