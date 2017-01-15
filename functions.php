<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',               // Scripts and stylesheets
  'lib/extras.php',               // Custom functions
  'lib/setup.php',                // Theme setup
  'lib/titles.php',               // Page titles
  'lib/post_type_logbook.php',    // Custom post type for Logbook
  'lib/post_type_cats.php',       // Custom post type for Cats
  'lib/wrapper.php',              // Theme wrapper class
  'lib/customizer.php',           // Theme customizer
  'lib/bootstrap-nav-walker.php'  // Bootstrap Nav Walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
  //is there a user to check?
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    //check for admins
    if ( in_array( 'author', $user->roles ) ) {
      // redirect them to the logbook
      return home_url('/logg');
      
    } else {
      return $redirect_to;
    }
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

// Google Maps
function my_acf_google_map_api( $api ){
  
  $api['key'] = 'AIzaSyBmAxjtT0bUQ4MfbrutpATcYpZ9l-Q-D6A';
  
  return $api;
  
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
