<?php

/* HERO MAIN HEADING */
Kirki::add_section( 'hero_main_section', array(
    'title'             => __( 'Main heading', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 10,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_type',
    'label'             => __( 'Hero main heading type', 'ventcamp' ),
    'section'           => 'hero_main_section',
    'type'              => 'radio',
    'priority'          => 14,
    'default'           => 'text',
    'choices'           => array(
        'text'              => __( 'Text', 'ventcamp' ),
        'image'             => __( 'Image', 'ventcamp' )
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_image',
    'label'             => __( 'Hero image', 'ventcamp' ),
    'section'           => 'hero_main_section',
    'type'              => 'image',
    'priority'          => 15,
    'active_callback'   => 'ventcamp_hero_heading_type_callback',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_image_retina',
    'label'             => __( 'Hero image retina', 'ventcamp' ),
    'section'           => 'hero_main_section',
    'type'              => 'image',
    'priority'          => 16,
    'active_callback'   => 'ventcamp_hero_heading_type_callback',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_text',
    'label'             => __( 'Hero heading text', 'ventcamp' ),
    'section'           => 'hero_main_section',
    'type'              => 'text',
    'priority'          => 17,
    'default'           => 'VENTCAMP',
    'active_callback'   => 'ventcamp_hero_heading_type_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_heading_typography',
    'label'             => __( 'Hero heading font', 'ventcamp' ),
    'section'           => 'hero_main_section',
    'type'              => 'typography',
    'priority'          => 18,
    'default'           => array(
        'font-family'       => '"PT Sans Caption", Roboto',
        'font-size'         => '7.5vw',
        'font-weight'       => '700',
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
    'less'              => 'hero_heading_typography',
    'active_callback'   => 'ventcamp_hero_heading_type_callback'
) );
