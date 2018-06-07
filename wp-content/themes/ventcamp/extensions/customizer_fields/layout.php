<?php

/* LAYOUT */

Kirki::add_section( 'layout', array(
    'title'             => __( 'Site layout', 'ventcamp' ),
    'description'       => __( 'Site layout settings', 'ventcamp' ),
    'panel'             => 'theme_settings',
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'layout_boxed',
    'label'             => __( 'Boxed layout', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'checkbox',
    'priority'          => 25,
    'transport'         => 'postMessage',
    'less'              => 'layout_boxed',
    'default'           => false
) );

/*
 * Boxed layout settings
 */
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'description'       => __( 'Background color for boxed layout', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'kirki-color',
    'priority'          => 26,
    'default'           => '#ffffff',
    'transport'         => 'postMessage',
    'less'              => 'website_background_color',
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_image',
    'label'             => __( 'Background image', 'ventcamp' ),
    'description'       => __( 'Background image for boxed layout', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'image',
    'priority'          => 27,
    'default'           => false,
    'transport'         => 'postMessage',
    'less'              => 'website_background_image',
    'less_quote'        => true,
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_fixed',
    'label'             => __( 'Use fixed background', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'checkbox',
    'priority'          => 28,
    'default'           => true,
    'transport'         => 'postMessage',
    'less'              => 'website_background_fixed',
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_size',
    'label'             => __( 'Background size', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'radio',
    'priority'          => 40,
    'default'           => 'cover',
    'choices'           => array(
        'auto'              => __( 'Auto', 'ventcamp' ),
        'cover'             => __( 'Cover', 'ventcamp' ),
        'contain'           => __( 'Contain', 'ventcamp' )
    ),
    'transport'         => 'postMessage',
    'less'              => 'website_background_size',
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_repeat',
    'label'             => __( 'Background repeat', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'radio',
    'priority'          => 50,
    'default'           => 'no-repeat',
    'choices'           => array(
        'no-repeat'         => __( 'No repeat', 'ventcamp' ),
        'repeat'            => __( 'Repeat', 'ventcamp' ),
        'repeat-x'          => __( 'Repeat X', 'ventcamp' ),
        'repeat-y'          => __( 'Repeat Y', 'ventcamp' )
    ),
    'transport'         => 'postMessage',
    'less'              => 'website_background_repeat',
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'website_background_position',
    'label'             => __( 'Background position', 'ventcamp' ),
    'section'           => 'layout',
    'type'              => 'radio',
    'priority'          => 60,
    'default'           => 'center',
    'choices'           => array(
        'left'              => __( 'Left', 'ventcamp' ),
        'center'            => __( 'Center', 'ventcamp' ),
        'right'             => __( 'Right', 'ventcamp' )
    ),
    'transport'         => 'postMessage',
    'less'              => 'website_background_position',
    'active_callback'   => 'ventcamp_boxed_background_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'layout_content_width',
    'label'             => __( 'Content width', 'ventcamp' ),
    'section'           => 'layout',
    'default'           => 1170,
    'priority'          => 21,
    'choices'           => array(
        'min'               => 740,
        'max'               => 1170,
        'step'              => 10,
    ),
    'transport'         => 'postMessage',
    'less'              => 'layout_content_width'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'layout_gutter_width',
    'label'             => __( 'Gutter width', 'ventcamp' ),
    'section'           => 'layout',
    'default'           => 30,
    'priority'          => 22,
    'choices'           => array(
        'min'               => 0,
        'max'               => 100,
        'step'              => 10,
    ),
    'transport'         => 'postMessage',
    'less'              => 'layout_gutter_width'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'layout_row_height',
    'label'             => __( 'Row height', 'ventcamp' ),
    'section'           => 'layout',
    'default'           => 45,
    'priority'          => 24,
    'choices'           => array(
        'min'               => 0,
        'max'               => 120,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'layout_row_height'
) );