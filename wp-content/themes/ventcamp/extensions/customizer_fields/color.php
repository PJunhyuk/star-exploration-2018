<?php

/* COLOR SETTINGS */
Kirki::add_section( 'color_settings', array(
    'priority'          => 210,
    'title'             => __( '+ Colors and skin', 'ventcamp' ),
    'description'       => __( 'General site settings', 'ventcamp' ),
    'capability'        => 'edit_theme_options',
) );

/* SKIN */
/*Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'color_settings',
    'label'             => __( 'Preset', 'ventcamp' ),
    'description'       => __( 'Select skin preset', 'ventcamp' ),
    'section'           => 'skin',
    'type'              => 'select',
    'priority'          => 11,
    'default'           => '',
    'section'           => 'color_settings',
    'choices'           => array(
        ''                  => __( '', 'ventcamp' ),
        'preset-1'          => __( 'Preset 1', 'ventcamp' ),
        'preset-2'          => __( 'Preset 2', 'ventcamp' ),
        'preset-3'          => __( 'Preset 3', 'ventcamp' ),
    ),
) );*/

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'skin_accent_color',
    'label'             => __( 'Accent color', 'ventcamp' ),
    'description'       => __( 'Theme accent color', 'ventcamp' ),
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'section'           => 'color_settings',
    'priority'          => 12,
    'transport'         => 'postMessage',
    'less'              => 'skin_accent_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'skin_text_color',
    'label'             => __( 'Text color', 'ventcamp' ),
    'type'              => 'kirki-color',
    'default'           => '#333333',
    'section'           => 'color_settings',
    'priority'          => 13,
    'transport'         => 'postMessage',
    'less'              => 'skin_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'skin_heading_color',
    'label'             => __( 'Heading color', 'ventcamp' ),
    'type'              => 'kirki-color',
    'default'           => '#333333',
    'section'           => 'color_settings',
    'priority'          => 14,
    'transport'         => 'postMessage',
    'less'              => 'skin_heading_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'skin_link_color',
    'label'             => __( 'Link color', 'ventcamp' ),
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'section'           => 'color_settings',
    'priority'          => 15,
    'transport'         => 'postMessage',
    'less'              => 'skin_link_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'skin_link_hover_color',
    'label'             => __( 'Link hover color', 'ventcamp' ),
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'section'           => 'color_settings',
    'priority'          => 16,
    'transport'         => 'postMessage',
    'less'              => 'skin_link_hover_color'
) );