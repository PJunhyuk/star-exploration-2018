<?php

/* MENU BAR */
Kirki::add_section( 'menu_bar', array(
    'title'             => __( 'Main menu', 'ventcamp' ),
    'panel'             => 'header_navigation',
    'priority'          => 20,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_format_style',
    'label'             => __( 'Menu template', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'radio',
    'priority'          => 10,
    'default'           => 'logo_menu_button',
    'choices'           => array(
        'menu_button'       => __( 'Menu and button', 'ventcamp' ),
        'logo_menu'         => __( 'Logo and menu', 'ventcamp' ),
        'logo_menu_button'  => __( 'Logo, menu and button', 'ventcamp' )
    )
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_button_text',
    'label'             => __( 'Button text', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'text',
    'priority'          => 10,
    'default'           => __( 'Buy Tickets', 'ventcamp' ),
    'active_callback'   => 'ventcamp_menu_button_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_button_link',
    'label'             => __( 'Button link', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'text',
    'priority'          => 10,
    'default'           => '#',
    'active_callback'   => 'ventcamp_menu_button_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_menu_position',
    'label'             => __( 'Menu position', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'radio',
    'priority'          => 11,
    'default'           => 'after',
    'choices'           => array(
        'before'            => __( 'Before hero block', 'ventcamp' ),
        'after'             => __( 'After hero block', 'ventcamp' )
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'disable_sticky_menu',
    'label'             => __( 'Disable fixed/sticky menu', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'checkbox',
    'priority'          => 11,
    'default'           => false,
    'to_js'             => 'disableStickyMenu'
) );

/*
* This should be refactored, add proper "Hide until X pixels from top scroll" with dependent input field
*
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_hide_until_scroll',
    'label'             => __( 'Hide header until scroll', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'checkbox',
    'priority'          => 11,
    'default'           => false,
    'to_js'             => 'headerRelativePosition',
    'transport'         => 'postMessage',
    'less'              => 'header_hide_until_scroll'
) );
*/

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'menu_bar_menu_height',
    'label'             => __( 'Menu/logo height', 'ventcamp' ),
    'section'           => 'menu_bar',
    'default'           => 100,
    'priority'          => 11,
    'choices'           => array(
        'min'               => 50,
        'max'               => 300,
        'step'              => 1,
    ),
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_menu_height'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'menu_bar_text_color',
    'label'             => __( 'Link color', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'kirki-color',
    'default'           => '#ffffff',
    'priority'          => 22,
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'menu_bar_active_link_color',
    'label'             => __( 'Active link color', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'kirki-color',
    'default'           => '#fe4918',
    'priority'          => 23,
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_active_link_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'menu_bar_background_color',
    'label'             => __( 'Background color', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'kirki-color',
    'default'           => '#262627',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 32,
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_background_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_one_page_nav',
    'label'             => __( 'Add smooth scroll to all anchor links on page?', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'checkbox',
    'priority'          => 40,
    'default'           => true,
    'to_js'             => 'onePageNav'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'header_one_page_nav_hash_change',
    'label'             => __( 'Enable One page navigation changing hash in url?', 'ventcamp' ),
    'section'           => 'menu_bar',
    'type'              => 'checkbox',
    'priority'          => 41,
    'default'           => false,
'transport'         => 'postMessage',
    'to_js'             => 'onePageNavHashChange'
) );

/* DROPDOWN MENU */
Kirki::add_section( 'dropdown_menu', array(
    'title'             => __( 'Dropdown menu', 'ventcamp' ),
    'panel'             => 'header_navigation',
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'menu_bar_dropdown_background_color',
    'label'             => __( 'Dropdown menu background color', 'ventcamp' ),
    'section'           => 'dropdown_menu',
    'type'              => 'kirki-color',
    'default'           => '#262627',
    'choices'           => array(
        'alpha'         => true
    ),
    'priority'          => 33,
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_dropdown_background_color'
) );


Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'menu_bar_dropdown_text_color',
    'label'             => __( 'Dropdown menu text color', 'ventcamp' ),
    'section'           => 'dropdown_menu',
    'type'              => 'kirki-color',
    'default'           => '#ffffff',
    'priority'          => 39,
    'transport'         => 'postMessage',
    'less'              => 'menu_bar_dropdown_text_color'
) );
