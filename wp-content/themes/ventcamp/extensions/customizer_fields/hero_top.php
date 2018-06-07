<?php

/* HERO COUNTDOWN */
Kirki::add_section( 'hero_countdown', array(
    'title'             => __( 'Countdown', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 16,
    'capability'        => 'edit_theme_options'
) );

/* HERO TOP ZONE */
Kirki::add_section( 'hero_top_section', array(
    'title'             => __( 'Top text and socials', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 7,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_top_line_type',
    'label'             => __( 'Hero top line type', 'ventcamp' ),
    'section'           => 'hero_top_section',
    'type'              => 'radio',
    'priority'          => 125,
    'default'           => 'social',
    'choices'           => array(
        'disable'           => __( 'Disable', 'ventcamp' ),
        'social'            => __( 'Social', 'ventcamp' ),
        'text'              => __( 'Text', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'repeater',
    'settings'          => 'hero_social',
    'label'             => __( 'Hero social links', 'ventcamp' ),
    'section'           => 'hero_top_section',
    'priority'          => 126,
    'default'           => array(
        array( 'url' => 'http://facebook.com',  'type' => 'facebook' ),
        array( 'url' => 'http://twitter.com',   'type' => 'twitter' ),
        array( 'url' => 'http://google.com',    'type' => 'google' ),
        array( 'url' => 'http://instagram.com', 'type' => 'instagram' )
    ),
    'fields'            => array(
        'type'              => array(
            'type'              => 'select',
            'label'             => __( 'Site', 'ventcamp' ),
            'default'           => '',
            'choices'           => ventcamp_get_socials()
        ),
        'url'               => array(
            'type'              => 'text',
            'label'             => __( 'Link', 'ventcamp' ),
            'default'           => ''
        )
    ),
    'active_callback'   => 'ventcamp_hero_top_line_callback'
) );


Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_top_line_text',
    'label'             => __( 'Hero top line text', 'ventcamp' ),
    'section'           => 'hero_top_section',
    'type'              => 'code',
    'priority'          => 127,
    'choices'           => array(
        'language'          => 'xml',
        'theme'             => 'material'
    ),
    'active_callback'   => 'ventcamp_hero_top_line_callback'
) );