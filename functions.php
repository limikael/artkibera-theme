<?php

/**
 * Load scripts.
 * When this is registered for wp_enqueue_scripts, we make sure that
 * it is loaded before the parent style. This is apperantly needed,
 * although I don't understand exactly why.
 */
add_action( 'wp_enqueue_scripts', 'artkibera_enqueue_scripts');
function artkibera_enqueue_scripts() {
    wp_enqueue_style('nisarg-style',
    	get_template_directory_uri().'/style.css',
    	array("bootstrap"));

    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri().'/style.css',
        array('nisarg-style'),
        wp_get_theme()->get('Version')
    );
}

/**
 * For WooCommerce.
 */
add_action('after_setup_theme','artkibera_support');
function artkibera_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * User meta-box to tie a user to each product (painting).
 */
add_action('rwmb_meta_boxes','artkibera_meta_boxes');
function artkibera_meta_boxes($meta_boxes) {
    $meta_boxes[]=array(
        'title'=>'Creator',
        'post_types' => 'product',
        'context' => 'side',
        "fields"=>array(
            array(
                "id"=>"creator",
                "name"=>"Creator",
                "type"=>"user",
                "desc"=>"The artwork will appear on this users profile page"
            )
        )
    );

    return $meta_boxes;
}