<?php

/* MOBILE */

Kirki::add_section( 'mobile_phone', array(
    'title'             => __( 'Phone', 'ventcamp' ),
    'panel'             => 'mobile',
    'priority'          => 10,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'phone_row_padding',
    'label'             => __( 'Row height', 'ventcamp' ),
    'section'           => 'mobile_phone',
    'default'           => 30,
    'priority'          => 10,
    'choices'           => array(
        'min'               => 0,
        'max'               => 250,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'phone_row_padding'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'phone_body_text',
    'label'             => __( 'Body text', 'ventcamp' ),
    'section'           => 'mobile_phone',
    'priority'          => 20,
    'default'           => array(
        'font-size'         => '16px'
    ),
    'choices'           => array(
        'font-size'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'phone_body_text'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'phone_heading_text',
    'label'             => __( 'Header text', 'ventcamp' ),
    'section'           => 'mobile_phone',
    'priority'          => 30,
    'default'           => array(
        'font-size'         => '4em'
    ),
    'choices'           => array(
        'font-size'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'phone_heading_text'
) );


Kirki::add_section( 'mobile_tablet', array(
    'title'             => __( 'Tablet', 'ventcamp' ),
    'panel'             => 'mobile',
    'priority'          => 20,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'tablet_row_padding',
    'label'             => __( 'Row height', 'ventcamp' ),
    'section'           => 'mobile_tablet',
    'default'           => 30,
    'priority'          => 10,
    'choices'           => array(
        'min'               => 0,
        'max'               => 120,
        'step'              => 1
    ),
    'transport'         => 'postMessage',
    'less'              => 'tablet_row_padding'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'tablet_body_text',
    'label'             => __( 'Body text', 'ventcamp' ),
    'section'           => 'mobile_tablet',
    'priority'          => 20,
    'default'           => array(
        'font-size'         => '16px'
    ),
    'choices'           => array(
        'font-size'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'tablet_body_text'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'tablet_heading_text',
    'label'             => __( 'Header text', 'ventcamp' ),
    'section'           => 'mobile_tablet',
    'priority'          => 30,
    'default'           => array(
        'font-size'         => '4em'
    ),
    'choices'           => array(
        'font-size'         => true
    ),
    'transport'         => 'postMessage',
    'less'              => 'tablet_heading_text'
) );

Kirki::add_section( 'mobile_menu', array(
    'title'             => __( 'Mobile menu', 'ventcamp' ),
    'panel'             => 'mobile',
    'priority'          => 30,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
	'type'              => 'slider',
	'settings'          => 'mobile_menu_height',
	'label'             => __( 'Menu height', 'ventcamp' ),
	'section'           => 'mobile_menu',
	'default'           => 60,
	'priority'          => 1,
	'choices'           => array(
		'min'               => 0,
		'max'               => 250,
		'step'              => 1
	),
	'transport'         => 'postMessage',
	'less'              => 'mobile_menu_height'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'checkbox',
    'settings'          => 'mobile_menu_hide_logo',
    'label'             => __( 'Hide logo', 'ventcamp' ),
    'section'           => 'mobile_menu',
    'default'           => 0,
    'priority'          => 2,
    'transport'         => 'postMessage',
    'less'              => 'mobile_menu_hide_logo'
) );


Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'mobile_menu_text_color',
    'label'             => __( 'Text color', 'ventcamp' ),
    'section'           => 'mobile_menu',
    'type'              => 'kirki-color',
    'default'           => '#262627',
    'priority'          => 3,
    'transport'         => 'postMessage',
    'less'              => 'mobile_menu_text_color'
) );


Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'mobile_menu_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'mobile_menu',
    'type'              => 'kirki-color',
    'default'           => '#262627',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 4,
    'transport'         => 'postMessage',
    'less'              => 'mobile_menu_background_color'
) );

/* CUSTOM CODE */
Kirki::add_panel( 'customcode', array(
    'priority'          => 270,
    'title'             => __( '+ Custom code', 'ventcamp' ),
    'description'       => __( 'Styles for mobile mode', 'ventcamp' )
) );

Kirki::add_section( 'customcode_global', array(
    'title'             => __( 'Global', 'ventcamp' ),
    'panel'             => 'customcode',
    'priority'          => 10,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'customcode_global_css',
    'label'             => __( 'CSS', 'ventcamp' ),
    'section'           => 'customcode_global',
    'type'              => 'code',
    'priority'          => 10,
    'default'           => '',
    'choices'           => array(
        'language'          => 'css',
        'theme'             => 'material'
    ),
    // Don't sanitize this field
    'sanitize_callback' => 'ventcamp_unfiltered_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'customcode_global_js',
    'label'             => __( 'JavaScript', 'ventcamp' ),
    'section'           => 'customcode_global',
    'type'              => 'code',
    'priority'          => 20,
    'default'           => '',
    'choices'           => array(
        'language'          => 'javascript',
        'theme'             => 'material'
    ),
    // Don't sanitize this field
    'sanitize_callback' => 'ventcamp_unfiltered_callback'
) );

Kirki::add_section( 'customcode_tablet', array(
    'title'             => __( 'Tablet', 'ventcamp' ),
    'panel'             => 'customcode',
    'priority'          => 20,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'customcode_tablet_css',
    'label'             => __( 'CSS', 'ventcamp' ),
    'section'           => 'customcode_tablet',
    'type'              => 'code',
    'priority'          => 10,
    'default'           => '',
    'choices'           => array(
        'language'          => 'css',
        'theme'             => 'material'
    ),
    // Don't sanitize this field
    'sanitize_callback' => 'ventcamp_unfiltered_callback'
) );

Kirki::add_section( 'customcode_phone', array(
    'title'             => __( 'Phone', 'ventcamp' ),
    'panel'             => 'customcode',
    'priority'          => 30,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'customcode_phone_css',
    'label'             => __( 'CSS', 'ventcamp' ),
    'section'           => 'customcode_phone',
    'type'              => 'code',
    'priority'          => 10,
    'default'           => '',
    'choices'           => array(
        'language'          => 'css',
        'theme'             => 'material'
    ),
    // Don't sanitize this field
    'sanitize_callback' => 'ventcamp_unfiltered_callback'
) );