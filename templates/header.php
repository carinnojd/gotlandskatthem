<header class="banner navbar navbar-default navbar-static-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>" id="top"><img alt="Gotlands Katthem logo" class="logo" src="<?php echo (get_template_directory_uri() . '/dist/images/logo_svart.png');?>" /></a>
        </div>

        <nav class="collapse navbar-collapse navbar-right" id="navbar-collapse" role="navigation">
            <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu([
                    'theme_location' => 'primary_navigation', 
                    'walker' => new wp_bootstrap_navwalker(), 
                    'menu_class' => 'pull-md-right nav navbar-nav']);
            endif;
            ?>
        </nav>
    </div>
</header>
