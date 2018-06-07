<?php

/* HERO LAYOUT and BACKGROUND */
Kirki::add_section( 'hero_general', array(
    'title'             => __( 'Layout and Background', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 5,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_display',
    'label'             => __( 'Enable hero block', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'radio',
    'priority'          => 10,
    'default'           => '1',
    'choices'           => array(
        '2'                 => __( "Show on all pages", 'ventcamp' ),
        '1'                 => __( "Show on Homepage only", 'ventcamp' ),
        '0'                 => __( "Don't show", 'ventcamp' )
    )
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_fullheight',
    'label'             => __( 'Full height', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'checkbox',
    'priority'          => 11,
    'default'           => 1,
    'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_verticalcentring',
    'label'             => __( 'Vertical centering', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'checkbox',
    'priority'          => 12,
    'default'           => true,
    'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_background_type',
    'label'             => __( 'Background type', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'radio',
    'priority'          => 14,
    'default'           => 'color',
    'choices'           => array(
        'color'             => __( 'Solid color', 'ventcamp' ),
        'image'             => __( 'Image', 'ventcamp' ),
        'video'             => __( 'Video', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'kirki-color',
    'priority'          => 15,
    'default'           => '#252323',
    'choices'           => array(
        'alpha'         => true
    ),
    'active_callback'   => 'ventcamp_hero_background_type_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_background_image',
    'label'             => __( 'Hero background image', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'image',
    'priority'          => 16,
    'active_callback'   => 'ventcamp_hero_background_type_callback',
    // 'default'           => '' // TODO: add default image ???
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_background_video',
    'label'             => __( 'Youtube video url', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'text',
    'priority'          => 17,
    'active_callback'   => 'ventcamp_hero_background_type_callback',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'multicheck',
    'settings'          => 'hero_background_video_settings',
    'label'             => __( 'Background video settings', 'ventcamp' ),
    'section'           => 'hero_general',
    'default'           => 'all',
    'priority'          => 18,
    'choices'           => array(
        'controls'          => __( 'Add video controls', 'ventcamp' ),
        'mute'              => __( 'Mute video by default', 'ventcamp' ),
        'autoplay'          => __( 'Play video automatically', 'ventcamp' ),
	    'loop'              => __( 'Play video in loop?', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_background_type_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_background_video_controls',
    'label'             => __( 'Background video controls', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'radio',
    'priority'          => 19,
    'default'           => 'left',
    'choices'           => array(
        'left'              => __( 'Left', 'ventcamp' ),
        'center'            => __( 'Center', 'ventcamp' ),
        'right'             => __( 'Right', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_background_type_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_overlay_type',
    'label'             => __( 'Overlay type', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'radio',
    'priority'          => 20,
    'default'           => 'none',
    'choices'           => array(
        'none'              => __( 'None', 'ventcamp' ),
        'color'             => __( 'Solid color', 'ventcamp' ),
        'gradient'          => __( 'Gradient', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_overlay_color',
    'label'             => __( 'Overlay color', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'kirki-color',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 21,
    'default'           => '',
    'active_callback'   => 'ventcamp_hero_overlay_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_overlay_gradient',
    'label'             => __( 'Gradient css code', 'ventcamp' ),
    'section'           => 'hero_general',
    'type'              => 'code',
    'priority'          => 22,
    'default'           => '',
    'choices'           => array(
        'language'          => 'css',
        'theme'             => 'material',
    ),
    'active_callback'   => 'ventcamp_hero_overlay_callback',
    'sanitize_callback' => 'ventcamp_unfiltered_callback'
) );
