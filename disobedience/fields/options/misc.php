<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'group_594e33e09025a',
    'title' => 'Misc options',
    'fields' => array (
        array (
            'key' => 'field_59631eaa615a4',
            'label' => 'Event submitted page',
            'name' => 'event_submitted_page',
            'type' => 'post_object',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array (
                0 => 'page',
            ),
            'taxonomy' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'object',
            'ui' => 1,
        ),
        array (
            'key' => 'options_event_terms_page',
            'label' => 'Event terms page',
            'name' => 'event_terms_page',
            'type' => 'post_object',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array (
                0 => 'page',
            ),
            'taxonomy' => array (
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'object',
            'ui' => 1,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'misc',
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
    'key' => 'misc_social',
    'title' => 'Social media options',
    'fields' => array (
        array (
            'key' => 'misc_social_fb',
            'label' => 'Facebook page URL',
            'name' => 'misc_social_fb',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
        array (
            'key' => 'misc_social_ig',
            'label' => 'Instagram URL',
            'name' => 'misc_social_ig',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
        ),
        array (
            'key' => 'misc_social_tw',
            'label' => 'Twitter URL',
            'name' => 'misc_social_tw',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
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
                'value' => 'misc',
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
