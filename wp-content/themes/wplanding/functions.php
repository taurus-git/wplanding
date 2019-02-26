<?php
add_action( 'wp_enqueue_scripts', 'wp_landing_styles_and_scripts' );

function wp_landing_styles_and_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min');
    wp_enqueue_script('jquery_main', get_template_directory_uri() . '/assets/js/jquery.main.js', array('jquery'), null);
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), null);
}