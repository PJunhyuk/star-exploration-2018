<?php

/* HERO UPPER and BOTTOM HEADINGS */
Kirki::add_section( 'hero_content', array(
    'title'             => __( 'Upper and Bottom subheadings', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 15,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_upper_text_date',
    'label'             => __( 'Hero upper text city', 'ventcamp' ),
    'section'           => 'hero_content',
    'type'              => 'text',
    'priority'          => 116,
    'default'           => '28.NOV',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_upper_text_location',
    'label'             => __( 'Hero upper text location', 'ventcamp' ),
    'section'           => 'hero_content',
    'type'              => 'text',
    'priority'          => 116,
    'default'           => 'NEW YORK, NY',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_upper_typography',
    'label'             => __( 'Hero upper font', 'ventcamp' ),
    'section'           => 'hero_content',
    'type'              => 'typography',
    'priority'          => 117,
    'default'           => array(
        'font-family'       => 'Roboto',
        'font-size'         => '1.2vw',
        'font-weight'       => '600',
        'line-height'       => '1.7',
        'letter-spacing'    => '0.85em'
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
    'less'              => 'hero_upper_typography',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_lower_text',
    'label'             => __( 'Hero lower text', 'ventcamp' ),
    'section'           => 'hero_content',
    'type'              => 'code',
    'priority'          => 118,
    'default'           => __( 'Massive conference about web development', 'ventcamp' ),
    'choices'           => array(
        'language'          => 'xml',
        'theme'             => 'material'
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_lower_typography',
    'label'             => __( 'Hero lower font', 'ventcamp' ),
    'section'           => 'hero_content',
    'type'              => 'typography',
    'priority'          => 119,
    'default'           => array(
        'font-family'       => 'Roboto',
        'font-size'         => '1.3vw',
        'font-weight'       => '300',
        'line-height'       => '1.1',
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
    'less'              => 'hero_lower_typography',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );