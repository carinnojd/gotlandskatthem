<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer' => __('Footer Meny')
  ]);

  register_nav_menu ('primary-mobile', __( 'Navigation Mobile' ));

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size('small-thumbnail', 200, 200, true);
  add_image_size('cat-thumbnail', 240, 240, array('center', 'center'));
  add_image_size('banner-image', 310, 210, array('left', 'center'));
  add_image_size('single-post-image', 600, 350, array('center', 'center'));
  add_image_size('slider-image', 2048, 650, array('center', 'center'));

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');


// Register sidebars
function widgets_init() {
  register_sidebar([
    'name'          => __('Primär sidmeny', 'gotlandskatthem'),
    'id'            => 'sidebar-primary',
    'description'   => __( 'Lägg till widgets här som ska lägga till i sidomenyn', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Andra sidmenyn', 'gotlandskatthem'),
    'id'            => 'sidebar-secondary',
    'description'   => __( 'Lägg till widgets här som ska lägga till i sidomenyn i andra sidmenyn', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);
  register_sidebar([
    'name'          => __('Loggbok', 'gotlandskatthem'),
    'id'            => 'sidebar-logbook',
    'description'   => __( 'Lägg till widgets här som ska lägga till i sidomenyn för loggboken', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);
  register_sidebar([
    'name'          => __('Nyheter', 'gotlandskatthem'),
    'id'            => 'sidebar-news',
    'description'   => __( 'Lägg till widgets här som ska lägga till i sidomenyn för nyhetssidan', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 1', 'gotlandskatthem'),
    'id'            => 'sidebar-footer-1',
    'description'   => __( 'Lägg till widgets här som ska lägga till i den första footern', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 2', 'gotlandskatthem'),
    'id'            => 'sidebar-footer-2',
    'description'   => __( 'Lägg till widgets här som ska lägga till i den andra footern', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 3', 'gotlandskatthem'),
    'id'            => 'sidebar-footer-3',
    'description'   => __( 'Lägg till widgets här som ska lägga till i den tredej footern', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer 4', 'gotlandskatthem'),
    'id'            => 'sidebar-footer-4',
    'description'   => __( 'Lägg till widgets här som ska lägga till i den fjärde footern', 'gotlandskatthem' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');



/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
    is_post_type_archive('cats'),
    is_single()
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {

  // Google Fonts
  $query_args = array(
    'family' => 'Montserrat:400,700|Lato:300,400,700',
    'subset' => 'latin,latin-ext',
  );
  wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

  // Styling
  wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  
  // jQuery, SLick slicder, JavaScripts files
  wp_enqueue_script('jquery/js', Assets\asset_path('scripts/jquery.js'), array('jquery'), null, true );
  wp_enqueue_script('slick/js', Assets\asset_path('scripts/slick.js'), ['jquery'], null, true);
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  wp_enqueue_script('custom/js', Assets\asset_path('scripts/customizer.js'), ['jquery'], null, true);

  // Google Maps
  wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAEm83dEwXPkWe4nkVC62OtTRNCdn0pc0A');
  wp_enqueue_script('google-jsapi','https://www.google.com/jsapi'); 
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);



