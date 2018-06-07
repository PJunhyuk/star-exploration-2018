<?php

/* SECONDARY BUTTON */

Kirki::add_section( 'buttons_alt_style', array(
    'title'             => __( 'Secondary button', 'ventcamp' ),
    'panel'             => 'buttons',
    'priority'          => 20,
    'capability'        => 'edit_theme_options'
) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'type'     => 'typography',
//     'settings'  => 'button_alt_font',
//     'label'    => __( 'Button font', 'ventcamp' ),
//     'section'  => 'buttons_alt_style',
//     'priority' => 1,
//     'default'     => array(
//         'font-family'    => '"PT Sans Caption", Arial, "Helvetica Neue", Helvetica, sans-serif',
//         'font-size'      => '14',
//         'font-weight'    => '700',
//         'line-height'    => '1',
//         'letter-spacing' => '0.4em',
//     ),
//     'choices' => array(
//             'font-style' => true,
//             'font-family' => true,
//             'font-size' => true,
//             'font-weight' => true,
//             'line-height' => true,
//             'letter-spacing' => true
//     ),
//     'transport' => 'postMessage',
//     'less' => 'button_alt_font',
// ) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_text_color',
    'label'             => __( 'Text color', 'ventcamp' ),
    'section'           => 'buttons_alt_style',
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'priority'          => 2,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'buttons_alt_style',
    'type'              => 'kirki-color',
    'default'           => 'rgba(255, 255, 255, 0)',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 3,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_background_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'button_alt_border_width',
    'label'             => __( 'Border width', 'ventcamp' ),
    'section'           => 'buttons_alt_style',
    'default'           => 1,
    'priority'          => 4,
    'choices'           => array(
        'min'               => 0,
        'max'               => 10,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'button_alt_border_width'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_border_color',
    'label'             => __( 'Border color', 'ventcamp' ),
    'section'           => 'buttons_alt_style',
    'type'              => 'kirki-color',
    'default'           => '#ff6135',
    'priority'          => 5,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_border_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'button_alt_border_radius',
    'label'             => __( 'Border radius', 'ventcamp' ),
    'section'           => 'buttons_alt_style',
    'default'           => 4,
    'priority'          => 6,
    'choices'           => array(
        'min'               => 0,
        'max'               => 50,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'button_alt_border_radius'
) );

/* SECONDARY BUTTON ON HOVER */

Kirki::add_section( 'buttons_alt_hover_style', array(
    'title'             => __( 'Secondary button hover', 'ventcamp' ),
    'panel'             => 'buttons',
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_hov_text_color',
    'label'             => __( 'Text color', 'ventcamp' ),
    'section'           => 'buttons_alt_hover_style',
    'type'              => 'kirki-color',
    'default'           => '#ffffff',
    'priority'          => 2,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_hov_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_hov_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'buttons_alt_hover_style',
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 3,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_hov_background_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'button_alt_hov_border_width',
    'label'             => __( 'Border width', 'ventcamp' ),
    'section'           => 'buttons_alt_hover_style',
    'default'           => 1,
    'priority'          => 4,
    'choices'           => array(
        'min'               => 0,
        'max'               => 10,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'button_alt_hov_border_width'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'button_alt_hov_border_color',
    'label'             => __( 'Border color', 'ventcamp' ),
    'section'           => 'buttons_alt_hover_style',
    'type'              => 'kirki-color',
    'default'           => '#ff6135',
    'priority'          => 5,
    'transport'         => 'postMessage',
    'less'              => 'button_alt_hov_border_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'button_alt_hov_border_radius',
    'label'             => __( 'Border radius', 'ventcamp' ),
    'section'           => 'buttons_alt_hover_style',
    'default'           => 4,
    'priority'          => 6,
    'choices'           => array(
        'min'               => 0,
        'max'               => 50,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'button_alt_hov_border_radius'
) );