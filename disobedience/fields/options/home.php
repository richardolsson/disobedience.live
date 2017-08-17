<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'home_misc',
    'title' => 'Home page misc',
    'fields' => array (
        array (
            'key' => 'home_hero_image',
            'label' => 'Home hero picture',
            'name' => 'home_hero_image',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
        array (
            'key' => 'home_message',
            'label' => 'Home message',
            'name' => 'home_message',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'multiline' => 1,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'home',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));

acf_add_local_field_group(array (
    'key' => 'home_stream',
    'title' => 'Video',
    'fields' => array (
        array (
            'key' => 'home_stream_uri',
            'label' => 'Stream resource URI',
            'name' => 'home_stream_uri',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
        array (
            'key' => 'home_live',
            'label' => 'Stream is live',
            'name' => 'home_stream_live',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'multiline' => 1,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'home',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));

endif;
