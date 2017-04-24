<?php

add_action('init', 'disobedience_init');
function disobedience_init() {
    add_theme_support('post-thumbnails');

    disobedience_register_nav_menus();
}

function disobedience_register_nav_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header menu', 'disobedience'),
    ));
}
