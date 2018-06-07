<?php

/* FOOTER */

Kirki::add_section( 'footer', array(
    'title'             => __( 'Layout and colors', 'ventcamp' ),
    'panel'             => 'footer',
    'priority'          => 10,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'footer_widgets_columns',
    'label'             => __( 'Widgets (columns) count', 'ventcamp' ),
    'section'           => 'footer',
    'default'           => 3,
    'priority'          => 2,
    'choices'           => array(
        'min'               => 2,
        'max'               => 4,
        'step'              => 1
    ),
    'active_callback'   => 'ventcamp_footer_widgets_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'checkbox',
    'settings'          => 'footer_widgets_enable',
    'label'             => __( 'Enable footer widgets', 'ventcamp' ),
    'section'           => 'footer',
    'default'           => 1,
    'priority'          => 1,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'footer_widgets_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'footer',
    'type'              => 'kirki-color',
    'default'           => '#262627',
    'choices'           => array(
        'alpha'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'footer_widgets_background_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'footer_heading_color',
    'label'             => __( 'Headings color', 'ventcamp' ),
    'section'           => 'footer',
    'type'              => 'kirki-color',
    'default'           => '#ffffff',
    'transport'         => 'postMessage',
    'less'              => 'footer_heading_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'footer_text_color',
    'label'             => __( 'Text color', 'ventcamp' ),
    'section'           => 'footer',
    'type'              => 'kirki-color',
    'default'           => '#8d93a0',
    'transport'         => 'postMessage',
    'less'              => 'footer_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'footer_link_color',
    'label'             => __( 'Links color', 'ventcamp' ),
    'section'           => 'footer',
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'transport'         => 'postMessage',
    'less'              => 'footer_link_color'
) );

Kirki::add_section( 'sub_footer', array(
    'title'             => __( 'Sub footer', 'ventcamp' ),
    'panel'             => 'footer',
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'footer_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'sub_footer',
    'type'              => 'kirki-color',
    'default'           => '#1f2125',
    'choices'           => array(
        'alpha'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'footer_background_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'code',
    'choices'           => array(
        'language'          => 'xml',
        'theme'             => 'material'
    ),
    'settings'          => 'footer_text',
    'label'             => __( 'Footer text', 'ventcamp' ),
    'description'       => __( 'Add your copyright here', 'ventcamp' ),
    'section'           => 'sub_footer',
    'default'           => 'All Rights Reserved 2016'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'repeater',
    'settings'          => 'footer_social',
    'label'             => __( 'Footer social links', 'ventcamp' ),
    'section'           => 'sub_footer',
    'default'           => array(
        array( 'type' => 'facebook',  'url' => 'http://facebook.com' ),
        array( 'type' => 'twitter',   'url' => 'http://twitter.com' ),
        array( 'type' => 'google',    'url' => 'http://google.com' ),
        array( 'type' => 'instagram', 'url' => 'http://instagram.com' )
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
    )
) );
