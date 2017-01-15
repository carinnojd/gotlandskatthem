<?php
if ( is_active_sidebar( 'sidebar-footer-1' ) ||
	 is_active_sidebar( 'sidebar-footer-2' ) || 
	 is_active_sidebar( 'sidebar-footer-3' ) ||
	 is_active_sidebar( 'sidebar-footer-4' ) ) :
?>
	<footer class="footer-content">
	  <div class="row">
			<?php
			if ( is_active_sidebar( 'sidebar-footer-1' ) ) { ?>
				<div class="col-xs-12 col-sm-3 widget-column footer-widget-1">
					<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-footer-2' ) ) { ?>
				<div class="col-xs-12 col-sm-3 widget-column footer-widget-2">
					<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-footer-3' ) ) { ?>
				<div class="col-xs-12 col-sm-3 widget-column footer-widget-3">
					<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-footer-4' ) ) { ?>
				<div class="col-xs-12 col-sm-3 widget-column footer-widget-4">
					<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
				</div>
			<?php } ?>
			
		</div>
	</footer>
<?php endif; ?>