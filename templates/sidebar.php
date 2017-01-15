<div class="wrapper-sidebar">
	<?php 
	// Use sidebar-logbook on logbook page
	if ( is_post_type_archive('logbook') || is_page('logg')) {
		dynamic_sidebar('sidebar-logbook'); } 

		// Use sidebar-news on blog archive page
		elseif ( is_home() ) {
			dynamic_sidebar('sidebar-news'); } 
		else { ?>
	<?php dynamic_sidebar('sidebar-primary'); ?>
	<?php dynamic_sidebar('sidebar-secondary'); 
	 }?>
	
</div>
