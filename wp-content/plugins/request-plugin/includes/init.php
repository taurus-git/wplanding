<?php
function request_init() {
    $labels = array(
                'name'               => 'Request',
                'singular_name'      => 'request',
                'add_new'            => 'Add request',
                'add_new_item'       => 'Add new request',
                'edit_item'          => 'Edit request',
                'new_item'           => 'New request',
                'view_item'          => 'Watch request',
                'search_items'       => 'Find request',
                'not_found'          => 'Requests didn\'t find',
                'not_found_in_trash' => 'No requests in trash',
                'parent_item_colon'  => '',
                'menu_name'          => 'Request',
            );
    $args = array(
            'labels'              => $labels,
            'description'         => 'A custom post type for Requests',
            'public'              => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'show_in_rest'        => null,
            'rest_base'           => null,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-format-chat',
            //'capability_type'   => 'post',
            //'capabilities'      => 'post',
            //'map_meta_cap'      => null,
            'hierarchical'        => false,
            'supports'            => array('title' ,'custom-fields'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => array(),
            'has_archive'         => true,
            'rewrite'             => true,
            'query_var'           => true,
    );

    register_post_type( 'request', $args );
}