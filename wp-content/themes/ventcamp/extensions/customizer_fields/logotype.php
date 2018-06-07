<?php

/* LOGOTYPE */
Kirki::add_section( 'logotype', array(
    'title'             => __( 'Logotype', 'ventcamp' ),
    'description'       => __( 'Site logo', 'ventcamp' ),
    'panel'             => 'theme_settings',
    'priority'          => 10,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'logotype_type',
    'label'             => __( 'Logo type', 'ventcamp' ),
    'section'           => 'logotype',
    'type'              => 'radio',
    'priority'          => 9,
    'default'           => 'image',
    'choices'           => array(
        'text'              => __( 'Text', 'ventcamp' ),
        'image'             => __( 'Image', 'ventcamp' ),
    ),
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'logotype_image',
    'label'             => __( 'Logo image', 'ventcamp' ),
    'description'       => __( 'Standart logo image', 'ventcamp' ),
    'section'           => 'logotype',
    'type'              => 'image',
    'priority'          => 10,
    'active_callback'   => 'ventcamp_logo_callback',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'logotype_image_retina',
    'label'             => __( 'Retina logo image', 'ventcamp' ),
    'description'       => __( 'Retina logo image', 'ventcamp' ),
    'section'           => 'logotype',
    'type'              => 'image',
    'priority'          => 11,
    'active_callback'   => 'ventcamp_logo_callback',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'logotype_text',
    'type'              => 'text',
    'label'             => __( 'Logo text', 'ventcamp' ),
    'section'           => 'logotype',
    'default'           => __( 'VentCamp', 'ventcamp' ),
    'priority'          => 19,
    'active_callback'   => 'ventcamp_logo_callback',
    'less_var'          => false
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'logotype_typography',
    'label'             => __( 'Logo typography', 'ventcamp' ),
    'section'           => 'logotype',
    'priority'          => 20,
    'default'           => array(
        'font-style'        => array( 'uppercase' ),
        'font-family'       => '"PT Sans Caption", Roboto',
        'font-size'         => '30px',
        'font-weight'       => '700',
        'letter-spacing'    => '0'
    ),
    'choices'           => array(
        'font-style'        => true,
        'font-family'       => true,
        'font-size'         => true,
        'font-weight'       => true,
        'letter-spacing'    => true
    ),
    'active_callback'   => 'ventcamp_logo_callback',
    'transport'         => 'postMessage',
    'less'              => 'logotype_typography'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'logotype_color',
    'label'             => __( 'Logotype color', 'ventcamp' ),
    'section'           => 'logotype',
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'priority'          => 25,
    'active_callback'   => 'ventcamp_logo_callback',
    'transport'         => 'postMessage',
    'less'              => 'logotype_color'
) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'type'     => 'select',
//     'settings'  => 'logotype_font_family',
//     'label'    => __( 'Logo font', 'ventcamp' ),
//     'section'  => 'logotype',
//     'priority' => 20,
//     'choices'  => Kirki_Fonts::get_font_choices(),
//     'active_callback'  => 'ventcamp_logo_callback',
//     'less_var' => array('type' => 'font', 'group' => 'logotype')
// ) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'type'     => 'slider',
//     'settings'  => 'logotype_font_weight',
//     'label'    => __( 'Logo font weight', 'ventcamp' ),
//     'section'  => 'logotype',
//     'default'  => 300,
//     'priority' => 24,
//     'choices'  => array(
//         'min'  => 100,
//         'max'  => 900,
//         'step' => 100,
//     ),
//     'active_callback'  => 'ventcamp_logo_callback'
// ) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'type'     => 'slider',
//     'settings'  => 'logotype_font_size',
//     'label'    => __( 'Logo font size', 'ventcamp' ),
//     'section'  => 'logotype',
//     'default'  => 14,
//     'priority' => 25,
//     'choices'  => array(
//         'min'  => 7,
//         'max'  => 48,
//         'step' => 1,
//     ),
//     'active_callback'  => 'ventcamp_logo_callback'
// ) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'type'     => 'slider',
//     'settings'  => 'logotype_font_letter_spacing',
//     'label'    => __( 'Logo letter spacing', 'ventcamp' ),
//     'section'  => 'logotype',
//     'default'  => 0,
//     'priority' => 25,
//     'choices'  => array(
//         'min'  => -2,
//         'max'  => 10,
//         'step' => 1,
//     ),
//     'active_callback'  => 'ventcamp_logo_callback'
// ) );

// Kirki::add_field( 'ventcamp_theme_config', array(
//     'settings' => 'logotype_font_style',
//     'label'    => __( 'Logo font style', 'ventcamp' ),
//     'section'  => 'logotype',
//     'type'     => 'buttoncheck',
//     'priority' => 26,
//     'default'  => '',
//     'choices'     => array(
//         'b' => __( '<b>B</b>', 'ventcamp' ),
//         'i' => __( '<i>I</i>', 'ventcamp' ),
//         'u' => __( '<u>U</u>', 'ventcamp' ),
//         'up' => __( 'TT', 'ventcamp' ),
//     ),
//     'active_callback'  => 'ventcamp_logo_callback'
// ) );