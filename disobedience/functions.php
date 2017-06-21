<?php

add_action('init', 'disobedience_init');
function disobedience_init() {
    add_theme_support('post-thumbnails');

    disobedience_register_nav_menus();
    disobedience_register_post_types();
    disobedience_register_fields();
}

function disobedience_register_nav_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header menu', 'disobedience'),
    ));
}

function disobedience_register_post_types() {
    register_post_type('activist', array(
        'labels' => array(
            'name' => __('Activists', 'disobedience'),
            'singular_name' => __('Activist', 'disobedience'),
        ),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'public' => true,
        'has_archive' => false,
    ));

    register_post_type('voice', array(
        'labels' => array(
            'name' => __('Voices', 'disobedience'),
            'singular_name' => __('Voice', 'disobedience'),
        ),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'public' => true,
        'has_archive' => false,
    ));
}

function disobedience_register_fields() {
    require('fields/facts.php');
}
