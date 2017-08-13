<?php

add_action('init', 'disobedience_init');
function disobedience_init() {
    add_theme_support('post-thumbnails');

    disobedience_register_nav_menus();
    disobedience_register_post_types();
    disobedience_register_thumbnails();
    disobedience_register_fields();
    disobedience_config_admin();
}

function disobedience_register_thumbnails() {
    add_image_size('activist-thumbnail', 315, 360, true);
    add_image_size('voice-thumbnail', 600, 340, true);
}

function disobedience_register_nav_menus() {
    register_nav_menus(array(
        'lang-menu' => __('Language menu', 'disobedience'),
    ));

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
        'has_archive' => true,
    ));

    register_post_type('event', array(
        'labels' => array(
            'name' => __('Events', 'disobedience'),
            'singular_name' => __('Event', 'disobedience'),
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => __('events', 'disobedience'),
        ),
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
        'has_archive' => true,
        'rewrite' => array(
            'slug' => __('voices', 'disobedience'),
        ),
    ));
}

function disobedience_register_fields() {
    require('fields/event.php');
    require('fields/facts.php');
    require('fields/video.php');
    require('fields/options/misc.php');
}

function disobedience_config_admin() {
    if( function_exists('acf_add_local_field_group') ):
    acf_add_options_page(array(
        'page_title' => __('Disobedience options', 'disobedience'),
        'menu_title' => __('Disobedience', 'disobedience'),
        'menu_slug' => 'disobedience',
        'capability' => 'edit_posts',
        'position' => 5,
        'redirect' => true,
    ));

    acf_add_options_sub_page(array(
        'title' => __('Misc settings', 'disobedience'),
        'menu_slug' => 'misc',
        'parent' => 'disobedience'
    ));
    endif;
}

add_filter('acf/fields/google_map/api', 'disobedience_acf_google_map_api');
function disobedience_acf_google_map_api($api){
    $api['key'] = 'AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4';
    return $api;
}

function get_excerpt_by_id($post_id){
    $post = get_post($post_id);
    $excerpt = $post->post_excerpt;

    if (empty($excerpt)) {
        $excerpt = $post->post_content;
        $excerpt_length = 30;
        $excerpt = strip_tags(strip_shortcodes($excerpt));
        $words = explode(' ', $excerpt, $excerpt_length + 1);

        if(count($words) > $excerpt_length) {
            array_pop($words);
            $excerpt = implode(' ', $words) . '…';
        }
    }

    return $excerpt;
}
