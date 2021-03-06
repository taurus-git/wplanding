<?php
add_action( 'wp_enqueue_scripts', 'wp_landing_styles_and_scripts' );

function wp_landing_styles_and_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min');
    wp_enqueue_script('jquery_main', get_template_directory_uri() . '/assets/js/jquery.main.js', array('jquery'), null);
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), null, 'in_footer');
}

add_action( 'after_setup_theme', function () {
    register_nav_menus( [
            'header-menu' => 'Menu in header',
    ] );
} );

//Change parameters header-menu
add_filter( 'wp_nav_menu_args', 'filter_wp_menu_args' );
function filter_wp_menu_args( $args ){
    if( $args['theme_location'] === 'header-menu' ){
        $args['container'] = 'div';
        $args['container_class'] = 'header-list-drop';
        $args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
        $args['menu_class'] = 'header-list anchor-list';
    }

    return $args;
}
//Delete id attribute in all li's in header-menu
add_filter( 'nav_menu_item_id', 'change_nav_menu_item_id', 10, 4 );
function change_nav_menu_item_id( $menu_id, $item, $args, $depth ) {
    return $args->theme_location === 'header-menu' ? '' : $menu_id;
}
//Add my style to all li's in header-menu
add_filter( 'nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4 );
function filter_nav_menu_css_classes( $classes, $item, $args, $depth ) {
    if( $args->theme_location === 'header-menu' ){
        $classes = [
            'header-list-item',
        ];
    }

    return $classes;
}
//Add my style to all links in header-menu
add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4 );
function filter_nav_menu_link_attributes( $atts, $item, $args, $depth ){
    if( $args->theme_location === 'header-menu' ){
        $atts['class'] = 'header-list-link';
    }

    return $atts;
}

//Register custom post types
//Speakers
add_action('init', 'register_speakers_post_type');
function register_speakers_post_type(){
    register_post_type('speaker', array(
        'labels'             => array(
            'name'               => 'Speaker',
            'singular_name'      => 'speaker',
            'add_new'            => 'Add new',
            'add_new_item'       => 'Add new speaker',
            'edit_item'          => 'Edit speaker',
            'new_item'           => 'New speaker',
            'view_item'          => 'Watch speaker',
            'search_items'       => 'Find speaker',
            'not_found'          =>  'Speaker didn\'t find',
            'not_found_in_trash' => 'No speakers in trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Speakers'

        ),
        'menu_icon'           => 'dashicons-smiley',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            =>  array('slug'=>'speakers/%speakerscat%','with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'custom-fields'),
    ) );
}

//Timeline
add_action('init', 'register_timeline_post_type');
function register_timeline_post_type(){
    register_post_type('timeline', array(
        'labels'             => array(
            'name'               => 'Timeline',
            'singular_name'      => 'timeline',
            'add_new'            => 'Add new',
            'add_new_item'       => 'Add new timeline',
            'edit_item'          => 'Edit timeline',
            'new_item'           => 'New timeline',
            'view_item'          => 'Watch timeline',
            'search_items'       => 'Find timeline',
            'not_found'          =>  'Timeline didn\'t find',
            'not_found_in_trash' => 'No timeline in trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Timeline'

        ),
        'menu_icon'           => 'dashicons-editor-ol',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            =>  array('slug'=>'timeline/%timelinecat%','with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'custom-fields'),
    ) );
}