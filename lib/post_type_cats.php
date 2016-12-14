<?php

/* cats page */
function post_type_cat_init(){
	$labels = array(
        'name'                  => "Katter",
        'singular_name'         => "katt",
        'menu_name'             => "Katter",
        'name_admin_bar'        => "Katter",
        'add_new'               => __( 'Lägg till ny', 'textdomain' ),
        'add_new_item'          => __( 'Lägga till ny katt', 'textdomain' ),
        'new_item'              => __( 'Ny katt', 'textdomain' ),
        'edit_item'             => __( 'Redigera katt', 'textdomain' ),
        'view_item'             => __( 'Förhandsgranska katt', 'textdomain' ),
        'all_items'             => __( 'Alla katter', 'textdomain' ),
        'search_items'          => __( 'Sök katt', 'textdomain' ),
        'parent_item_colon'     => __( 'Huvudkatt:', 'textdomain' ),
        'not_found'             => __( 'Ingen katt hittad.', 'textdomain' ),
        'not_found_in_trash'    => __( 'Ingen katt hittad i papperskorgen.', 'textdomain' ),
        'featured_image'        => _x( 'Kattens omslagbild', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Välj omslagsbild', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Ta bort omslagsbild', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Använd som omslagsbild', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Katter', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => 'Placera katt',
        'uploaded_to_this_item' => _x( 'Ladda upp denna katt', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filtrera kattlista', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'kattnavigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'kattlista', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
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
        'taxonomies'            => array( 'category', 'gallery' ),
        'rewrite'            => array( 'slug' => 'katter' ),
        'capability_type'    => 'page',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-heart',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'post-formats')
    );
	register_post_type('cat', $args);
	
}
add_action('init', 'post_type_cat_init');


// Meta box for Cat's slogan
function cat_add_meta_box() {
    add_meta_box('slogan_cat', 'Slogan för katt', 'cats_slogan_cat_callback', 'cat', 'normal', 'high');
}

function cats_slogan_cat_callback($post) {
    wp_nonce_field('cat_save_slogan_data', 'cat_meta_box_nonce');

    $value = get_post_meta($post->ID, '_slogan_value_key', true);

    echo '<label for="cat_slogan_field">Slogan: </label>';
    echo '<input type="text" id="cat_slogan_field" name="cat_slogan_field" value="' . esc_attr($value) . '" size="30"/>';
}

add_action( 'add_meta_boxes', 'cat_add_meta_box');


function cat_save_slogan_data($post_id) {

    // Check if meta box is empty
    if( !isset($_POST['cat_meta_box_nonce']) ) {
        return;
    }

    // Check for bosh
    if( !wp_verify_nonce($_POST['cat_meta_box_nonce'], 'cat_save_slogan_data') ) {
        return;
    }

    // Do not autosave the meta box
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Check if user has the authority to edit posts
    if( !current_user_can('edit_post', $post_id) ) {
        return;
    }

    // Check for a value
    if( !isset($_POST['cat_slogan_field']) ){
        return;
    }

    $data = sanitize_text_field($_POST['cat_slogan_field']);

    update_post_meta($post_id, '_slogan_value_key', $data);
}

add_action('save_post', 'cat_save_slogan_data');


// Meta box for Cat's gender
function cat_gender_add_meta_box() {
    add_meta_box('gender_cat', 'Kön', 'cats_gender_cat_callback', 'cat', 'normal', 'high');
}

function cats_gender_cat_callback($post) {
    wp_nonce_field('cat_save_gender_data', 'cat_gender_meta_box_nonce');

    $value = get_post_meta($post->ID, '_gender_value_key', true);
?>
    <label for="cat_gender_female_field">Hona: </label>
    <input type="radio" name="cat_gender" id="cat_gender_female" value="hona" <?php checked( $value, 'hona' ); ?> >
    <label for="cat_gender_male_field">Hane: </label>
    <input type="radio" name="cat_gender" id="cat_gender_male" value="hane" <?php checked( $value, 'hane' ); ?> >
<?php
}

add_action( 'add_meta_boxes', 'cat_gender_add_meta_box');


function cat_save_gender_data($post_id) {

    // Check if meta box is empty
    if( !isset($_POST['cat_gender_meta_box_nonce']) ) {
        return;
    }

    // Check for bosh
    if( !wp_verify_nonce($_POST['cat_gender_meta_box_nonce'], 'cat_save_gender_data') ) {
        return;
    }

    // Do not autosave the meta box
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Check if user has the authority to edit posts
    if( !current_user_can('edit_post', $post_id) ) {
        return;
    }

    // Sanitize user input.
    $gender_data = ( isset( $_POST['cat_gender'] ) ? sanitize_html_class( $_POST['cat_gender'] ) : '' );

    update_post_meta($post_id, '_gender_value_key', $gender_data);
}

add_action('save_post', 'cat_save_gender_data');





