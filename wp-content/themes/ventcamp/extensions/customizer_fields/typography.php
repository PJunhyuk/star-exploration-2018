<?php

/* TYPOGRAPHY */

Kirki::add_section( 'typography', array(
    'title'             => __( 'Typography', 'ventcamp' ),
    'description'       => __( 'Typography settings', 'ventcamp' ),
    'panel'             => 'theme_settings',
    'priority'          => 30,
    'capability'        => 'edit_theme_options',
) );


Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'typography_heading',
    'label'             => __( 'Header font', 'ventcamp' ),
    'section'           => 'typography',
    'priority'          => 20,
    'default'           => array(
        'font-size'         => '70px',
        'font-family'       => '"Roboto"',
        'font-weight'       => '400',
        'line-height'       => '1.1',
        'letter-spacing'    => '-0.05em'
    ),
    'choices'           => array(
        'font-style'        => true,
        'font-family'       => true,
        'font-size'         => true,
        'font-weight'       => true,
        'line-height'       => true,
        'letter-spacing'    => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'typography_heading'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'typography_body',
    'label'             => __( 'Body font', 'ventcamp' ),
    'section'           => 'typography',
    'priority'          => 21,
    'default'           => array(
        'font-family'       => 'Roboto',
        'font-size'         => '15px',
        'font-weight'       => '400',
        'line-height'       => '1.93333',
        'letter-spacing'    => '0'
    ),
    'choices'           => array(
        'font-style'        => true,
        'font-family'       => true,
        'font-size'         => true,
        'font-weight'       => true,
        'line-height'       => true,
        'letter-spacing'    => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'typography_body'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'typography_menu',
    'label'             => __( 'Menu font', 'ventcamp' ),
    'section'           => 'typography',
    'type'              => 'typography',
    'priority'          => 22,
    'default'           => array(
        'font-style'        => array( 'uppercase' ),
        'font-family'       => '"PT Sans Caption", Roboto',
        'font-weight'       => '700',
        'font-size'         => '11px',
        'line-height'       => '1.1',
        'letter-spacing'    => '0.26em'
    ),
    'choices'           => array(
        'font-style'        => true,
        'font-family'       => true,
        'font-size'         => true,
        'font-weight'       => true,
        'line-height'       => true,
        'letter-spacing'    => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'typography_menu'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'multicheck',
    'settings'          => 'typography_fonts_subsets',
    'label'             => __( 'Subsets', 'ventcamp' ),
    'description'       => __( 'Font subsets for sitewide usage', 'ventcamp' ),
    'section'           => 'typography',
    'default'           => 'all',
    'priority'          => 22,
    'choices'           => Kirki_Fonts::get_google_font_subsets(),
) );