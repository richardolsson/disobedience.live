<?php

add_action('init', 'disobedience_init');
function disobedience_init() {
    add_theme_support('post-thumbnails');

    disobedience_register_nav_menus();
    disobedience_register_post_types();
    disobedience_register_thumbnails();
    disobedience_register_strings();
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
    require('fields/options/home.php');
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
        'title' => __('Home settings', 'disobedience'),
        'menu_slug' => 'home',
        'parent' => 'disobedience'
    ));

    acf_add_options_sub_page(array(
        'title' => __('Misc settings', 'disobedience'),
        'menu_slug' => 'misc',
        'parent' => 'disobedience'
    ));
    endif;
}

function disobedience_register_strings() {
    if (function_exists('pll_register_string')) {
        // Home page strings
        pll_register_string('disobedience', 'home_intro_read_more', 'home');
        pll_register_string('disobedience', 'home_activists_header', 'home');
        pll_register_string('disobedience', 'home_voices_header', 'home');
        pll_register_string('disobedience', 'home_voices_intro', 'home');
        pll_register_string('disobedience', 'home_voices_button', 'home');
        pll_register_string('disobedience', 'home_events_header', 'home');
        pll_register_string('disobedience', 'home_events_intro', 'home', true);
        pll_register_string('disobedience', 'home_events_list_button', 'home');
        pll_register_string('disobedience', 'home_events_add_button', 'home');

        // Voices page strings
        pll_register_string('disobedience', 'voices_archive_intro', 'voices', true);

        // Activist page strings
        pll_register_string('disobedience', 'activists_single_share', 'activists', true);

        // Events page strings
        pll_register_string('disobedience', 'events_archive_table_city', 'events');
        pll_register_string('disobedience', 'events_archive_table_date', 'events');
        pll_register_string('disobedience', 'events_archive_table_time', 'events');
        pll_register_string('disobedience', 'events_archive_table_title', 'events');
        pll_register_string('disobedience', 'events_single_share', 'events');

        // Event form string
        pll_register_string('disobedience', 'events_form_title', 'events');
        pll_register_string('disobedience', 'events_form_organizer', 'events');
        pll_register_string('disobedience', 'events_form_startdate', 'events');
        pll_register_string('disobedience', 'events_form_starttime', 'events');
        pll_register_string('disobedience', 'events_form_enddate', 'events');
        pll_register_string('disobedience', 'events_form_endtime', 'events');
        pll_register_string('disobedience', 'events_form_city', 'events');
        pll_register_string('disobedience', 'events_form_country', 'events');
        pll_register_string('disobedience', 'events_form_info', 'events');
        pll_register_string('disobedience', 'events_form_contact', 'events');
        pll_register_string('disobedience', 'events_form_email', 'events');
        pll_register_string('disobedience', 'events_form_phone', 'events');
        pll_register_string('disobedience', 'events_form_link', 'events');
        pll_register_string('disobedience', 'events_form_image', 'events');
        pll_register_string('disobedience', 'events_form_image_caption', 'events');
        pll_register_string('disobedience', 'events_form_open', 'events');
        pll_register_string('disobedience', 'events_form_open_yes', 'events');
        pll_register_string('disobedience', 'events_form_open_no', 'events');
        pll_register_string('disobedience', 'events_form_closed', 'events');
        pll_register_string('disobedience', 'events_form_terms', 'events');
        pll_register_string('disobedience', 'events_form_terms_link', 'events');
        pll_register_string('disobedience', 'events_form_submit', 'events');
    }
}

function disobedience_str($id) {
    if (function_exists('pll__')) {
        return pll__($id);
    }
    else {
        return $id;
    }
}

function disobedience_pstr($id) {
    echo disobedience_str($id);
}

function disobedience_get_home_msg() {
    $msg = get_transient('disobedience_home_msg');

    if ($msg === false) {
        try {
            $tw_user = get_field('home_msg_tw_user', 'options');
            if (empty($tw_user)) {
                return null;
            }

            $url = 'https://twitrss.me/twitter_user_to_rss/?user='.$tw_user;
            $xml = new DOMDocument();
            $xml->load($url);
            $first_item = $xml->getElementsByTagName('item')[0];
            if ($first_item) {
                $title = $first_item->getElementsByTagName('title')[0];
                $msg = $title->nodeValue;

                // Store message in cache for five minutes
                set_transient('disobedience_home_msg', $msg, 30);
            }
        }
        catch (Exception $e) {
            return null;
        }
    }

    return $msg;
}

add_filter('acf/fields/google_map/api', 'disobedience_acf_google_map_api');
function disobedience_acf_google_map_api($api){
    $api['key'] = 'AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4';
    return $api;
}

add_action('wp_ajax_get_home_msg', 'disobedience_ajax_get_home_msg');
add_action('wp_ajax_nopriv_get_home_msg', 'disobedience_ajax_get_home_msg');
function disobedience_ajax_get_home_msg() {
    $msg = disobedience_get_home_msg();
    wp_send_json_success(array(
        'message' => $msg,
    ));
}

add_action('pre_get_posts', 'disobedience_event_archive_query', 1);
function disobedience_event_archive_query($query) {
    if ($query->is_post_type_archive && $query->query['post_type'] == 'event') {
        $query->query_vars['meta_key'] = 'start_date';
        $query->query_vars['orderby'] = 'meta_value';
        $query->query_vars['order'] = 'ASC';
    }
}

function disobedience_get_youtube_id($video_url) {
    if (strpos($video_url, '//youtu.be') !== false) {
        $fields = explode('/', $video_url);
        return $fields[count($fields) - 1];
    }
    else {
        $qs = parse_url($video_url, PHP_URL_QUERY);
        parse_str($qs, $params);
        return $params['v'];
    }
}

function disobedience_event_is_current($event = null) {
    $start_date = get_field('start_date', $event);
    $end_date = get_field('end_date', $event);
    $cur_date = date('Y-m-d');

    return ($start_date > $cur_date || $end_date > $cur_date);
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
