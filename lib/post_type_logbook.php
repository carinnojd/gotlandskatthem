<?php

/* Logbooks page */
function post_type_logbook_init(){
    $labels = array(
        'name'                  => "Loggbok",
        'singular_name'         => "loggbok",
        'menu_name'             => "Loggbok",
        'name_admin_bar'        => "Loggbok",
        'add_new'               => __( 'Lägg till ny', 'textdomain' ),
        'add_new_item'          => __( 'Lägga till ny loggbok', 'textdomain' ),
        'new_item'              => __( 'Ny loggbok', 'textdomain' ),
        'edit_item'             => __( 'Redigera loggbok', 'textdomain' ),
        'view_item'             => __( 'Förhandsgranska loggbok', 'textdomain' ),
        'all_items'             => __( 'Alla loggböcker', 'textdomain' ),
        'search_items'          => __( 'Sök loggbok', 'textdomain' ),
        'parent_item_colon'     => __( 'Huvudloggbok:', 'textdomain' ),
        'not_found'             => __( 'Ingen loggbok hittad.', 'textdomain' ),
        'not_found_in_trash'    => __( 'Ingen loggbok hittad i papperskorgen.', 'textdomain' ),
        'featured_image'        => _x( 'loggbokens omslagbild', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Välj omslagsbild', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Ta bort omslagsbild', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Använd som omslagsbild', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Loggbok', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => 'Placera loggbok',
        'uploaded_to_this_item' => _x( 'Ladda upp denna loggbok', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filtrera loggbokslista', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'loggboksnavigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'loggbokslista', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'taxonomies'            => array( 'post_tag' ),
        'rewrite'            => array( 'slug' => 'loggbok' ),
        'capability_type'    => 'page',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array( 'title', 'editor')
    );
    register_post_type('logbook', $args);
    
}
add_action('init', 'post_type_logbook_init');

// Category for logbook
function create_logbook_taxonomy() {
  register_taxonomy('logbook_tag', 'logbook', array(
      'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Rum', 'taxonomy general name' ),
      'singular_name' => _x( 'rum', 'taxonomy singular name' ),
      'search_items' =>  __( 'Sök rum' ),
      'all_items' => __( 'Alla rum' ),
      'parent_item' => __( 'Rum' ),
      'parent_item_colon' => __( 'Rum:' ),
      'edit_item' => __( 'Uppdatera rum' ),
      'add_new_item' => __( 'Lägg till nytt rum' ),
      'new_item_name' => __( 'Nytt rumsnamn' ),
      'menu_name' => __( 'Rum' ),
    ),
    // Control the slugs used for this taxonomy
      'rewrite' => array(
          'slug' => 'rum',
          'with_front' => false,
          'hierarchical' => true
    ),
  ));
}
add_action( 'init', 'create_logbook_taxonomy' );

add_shortcode( 'front_end_post_form', 'front_end_post_form' );

function front_end_post_form( $atts ) {
    ob_start();?>
 <script type="text/javascript">
jQuery(document).ready(function($) {
  $('#success').hide();
  $('#author').hide();
  $('#time').hide();
});
</script>
<?php
$postTitleError = '';
$postcontentError = '';
$id = get_current_user_id();
if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
  if (trim($_POST['postTitle']) === '' || $_POST['postContent'] === '' ) {
      if(trim($_POST['postTitle']) === '') {
          $postTitleError = 'Fyll i en titel';
      }
      if(trim($_POST['postContent']) === '') {
          $postcontentError = 'Fyll i innehåll';
      }
      if(trim($_POST['postArrangements']) === '') {
          $postcontentError = 'Fyll i beskrivning';
      }
  }else{
      $post_information = array(
          'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
          'post_content' => esc_attr(strip_tags($_POST['postContent'])),
          'post_status' => 'publish',
          'post_type' => 'logbook',
          'post_author' => get_the_author_meta('ID', $id),
          'post_date' => date(''.esc_attr(strip_tags($_POST['postDate'])).' H:i:s'),
          'meta_input' => array(
            'arrangements' => esc_attr(strip_tags($_POST['postArrangements'])),
            'section' => esc_attr(strip_tags($_POST['postSection']))
          )
      );
          
      $post_id = wp_insert_post($post_information);
     // $link = get_permalink( $post_id );
      ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('#logbookPostForm').hide();
        $('#entry-title').hide();
        $('#success').show();
      });
    </script>
    <?php
  }
} 

// Front end logbook form ?>
<form action="" id="logbookPostForm" method="POST" enctype="multipart/form-data">
  <fieldset>
      <label for="postTitle"><?php _e('Titel *', 'framework') ?></label>
      <input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" placeholder="Titel" class="required" required />
  </fieldset>
  <fieldset>
    <label for="postDate"><?php _e('Datum *', 'framework') ?></label>
    <input type="date" name="postDate" id="postDate" value="<?php echo date('Y-m-d'); ?>" class="required" />
  </fieldset>
  <?php if($postTitleError != '') { ?>
      <span class="error"><?php echo $postTitleError; ?></span>
      <div class="clearfix"></div>
  <?php } ?>
  <fieldset>  
    <label for="postSection"><?php _e('Avdelning/stall: *', 'framework') ?></label>
      <select name="postSection" id="postSection">
       <option value = "Kurran">Kurran</option>
       <option value = "Karantän">Karantän</option>
       <option value = "Loftet">Loftet</option>
       <option value = "Maimees">Maimees</option>
       <option value = "Spinnhuset">Spinnhuset</option>
    </select>
  </fieldset>
  <fieldset>  
    <label for="postContent"><?php _e('Hur gick dagens pass? *', 'framework') ?></label>
    <textarea name="postContent"> </textarea>
  </fieldset>
  <fieldset>  
    <label for="postArrangements"><?php _e('Behöver något åtgärdas?', 'framework') ?></label>
    <textarea name="postArrangements"> </textarea>
  </fieldset>
  <?php if($postcontentError != '') { ?>
      <span class="error"><?php echo $postcontentError; ?></span>
      <div class="clearfix"></div>
  <?php } ?>
  <fieldset>
    <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
    <input type="hidden" name="submitted" id="submitted" value="true" />
    <button type="submit"><?php _e('Spara', 'framework') ?></button>
  </fieldset>
</form>

<div id="success">
  <h3 class="brandColor">Tack för din logg!</h3>
  <h4><?php if(isset($_POST['postTitle'])) echo $_POST['postTitle']; ?> den <?php echo date('Y-m-d'); ?></h4>
  <h5>Avdelning: <?php echo ($_POST['postSection']); ?></h5>
  <h5>Dagens pass:</h5>
  <p><?php echo $_POST['postContent']; ?></p>
  <?php if(isset($_POST['postArrangements'])) { ?>
    <h5>Åtgärder:</h5>
    <p><?php echo $_POST['postArrangements'] ?></p><?php 
  } ?>
</div>
  
<?php $myvariable = ob_get_clean();
    return $myvariable;
    } 
