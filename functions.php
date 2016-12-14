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
    if ( in_array( 'administrator', $user->roles ) ) {
      // redirect them to the default place
      return $redirect_to;
    } else {
      return home_url();
    }
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



// Login from front end
function my_login_form( $args = array() ) {
  $defaults = array(
    'echo'           => true,
    'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), // Default redirect is back to the current page
    'form_id'        => 'loginform',
    'label_username' => __( 'Username' ),
    'label_password' => __( 'Password' ),
    'label_remember' => __( 'Remember Me' ),
    'label_log_in'   => __( 'Log In' ),
    'id_username'    => 'user_login',
    'id_password'    => 'user_pass',
    'id_remember'    => 'rememberme',
    'id_submit'      => 'wp-submit',
    'remember'       => false,
    'value_username' => '',
    'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
  );
  $args     = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
  $form = '<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . site_url( 'wp-login.php', 'login' ) . '" method="post">
' . apply_filters( 'login_form_top', '' ) . '
<p class="login-form">
<label for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>' . my_dropdown_users() .
'<label for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="10" tabindex="20" />

' . apply_filters( 'login_form_middle', '' ) . '

<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary" value="' . esc_attr( $args['label_log_in'] ) . '" tabindex="100" />
<input type="hidden" name="redirect_to" value="' . esc_attr( $args['redirect'] ) . '" />
</p>
' . apply_filters( 'login_form_bottom', '' ) . '
</form>';

  if ( $args['echo'] ) {
    echo $form;
  } else {
    return $form;
  }
}

function my_dropdown_users() {
  $users = get_users();
  $dropdown = '<select name="log" id="user_login">';
  foreach( $users as $user ) {
    $dropdown .= '<option value="' . $user->user_login . '">' . $user->user_login . '</option>';
  }
  $dropdown .= '</select>';
  return $dropdown;
}

my_login_form (array( 'redirect' => admin_url() ) );



