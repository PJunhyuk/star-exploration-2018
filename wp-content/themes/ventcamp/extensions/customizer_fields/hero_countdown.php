<?php

/* HERO UPPER and BOTTOM HEADINGS */
Kirki::add_section( 'hero_countdown', array(
    'title'             => __( 'Countdown timer', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 15,
    'capability'        => 'edit_theme_options'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_onoff',
    'label'             => __( 'Countdown block', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'radio',
    'priority'          => 16,
    'default'           => 'on',
    'choices'           => array(
        'on'            => __( 'On', 'ventcamp' ),
        'off'             => __( 'Off', 'ventcamp' )
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_date',
    'label'             => __( 'Countdown timer date', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'text',
    'priority'          => 20,
    'default'           => 'July 15 2017',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_format',
    'label'             => __( 'Countdown timer format', 'ventcamp' ),
     'description'      => __( 'The format for the countdown display. Use the following characters (in order) to indicate which periods you want to display: "Y" for years, "O" for months, "W" for weeks, "D" for days, "H" for hours, "M" for minutes, "S" for seconds.', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'text',
    'priority'          => 30,
    'default'           => 'DHMS',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );
/*
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_position',
    'label'             => __( 'Countdown position', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'radio',
    'priority'          => 40,
    'default'           => 'after',
    'choices'           => array(
        'before'            => __( 'Top', 'ventcamp' ),
        'after'             => __( 'Bottom', 'ventcamp' )
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );
*/

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_value_size',
    'label'             => __( 'Countdown numbers size', 'ventcamp' ),
     'description'      => __( 'Numbers size in px', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'text',
    'priority'          => 50,
    'default'           => '',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_text_size',
    'label'             => __( 'Countdown text size', 'ventcamp' ),
     'description'      => __( 'Text size in px', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'text',
    'priority'          => 60,
    'default'           => '',
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'ventcamp_hero_countdown_number_color',
    'label'             => __( 'Countdown number color', 'ventcamp' ),
    'description'      => __( 'Number color', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'kirki-color',
    'priority'          => 70,
    'default'           => '#ffffff',
    'transport'         => 'postMessage',
    'less'              => 'ventcamp_hero_countdown_number_color'
) );
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'ventcamp_hero_countdown_text_color',
    'label'             => __( 'Countdown text color', 'ventcamp' ),
    'description'      => __( 'Text color', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'kirki-color',
    'priority'          => 80,
    'default'           => '#ffffff',
    'transport'         => 'postMessage',
    'less'              => 'ventcamp_hero_countdown_text_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_countdown_direction',
    'label'             => __( 'Countdown direction (Up/Down)', 'ventcamp' ),
    'section'           => 'hero_countdown',
    'type'              => 'radio',
    'priority'          => 90,
    'default'           => 'down',
    'choices'           => array(
        'down'            => __( 'Down', 'ventcamp' ),
        'up'             => __( 'Up', 'ventcamp' )
    ),
    //'active_callback'   => 'ventcamp_hero_enable_callback'
) );