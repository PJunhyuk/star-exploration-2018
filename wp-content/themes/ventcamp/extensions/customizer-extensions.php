<?php

defined('ABSPATH') or die('No direct access');

require( THEME_DIR . '/includes/ventcamp_customizer_callbacks.php' );
require( THEME_DIR . '/includes/ventcamp_customizer_helpers.php' );

require_once "customizer.class.php";

if( !function_exists('ventcamp_adjust_customizer_sections') ) {
    /**
     * Customizer does include a few build-in sections,
     * but we don't really need 'colors' section, so remove it from customizer
     */
    function ventcamp_adjust_customizer_sections () {
        // It's a global variable
        global $wp_customize;
        // Remove colors section
        $wp_customize->remove_section( 'colors' );
    }

    add_action('customize_register', 'ventcamp_adjust_customizer_sections');
}

/*
 * Check if Kirki class exists, because if plugin with core functionality isn't activated, it'll cause an error.
 */
if( !function_exists('ventcamp_register_customizer_fields') && class_exists('Kirki') ) {
    /**
     * Add fields to customizer during customize_register
     */
    function ventcamp_register_customizer_fields () {

        Kirki::add_config( 'ventcamp_theme_config', array(
            'capability'        => 'edit_theme_options',
            'option_type'       => 'option',
            'option_name'       => 'ventcamp_customizer',
        ) );

        /* Customizer panels */

        /* GENERAL SETTINGS */
        Kirki::add_panel( 'theme_settings', array(
            'priority'          => 200,
            'title'             => __('+ General settings', 'ventcamp' ),
            'description'       => __( 'General site settings', 'ventcamp' ),
        ) );

        require( 'customizer_fields/logotype.php' );

        require( 'customizer_fields/color.php' );

        require( 'customizer_fields/layout.php' );

        require( 'customizer_fields/typography.php' );

        /* HEADER and NAVIGATION */
        Kirki::add_panel( 'header_navigation', array(
            'priority'          => 230,
            'title'             => __( '+ Navigation', 'ventcamp' ),
            'capability'        => 'edit_theme_options'
        ) );

        require( 'customizer_fields/menu_bar.php' );


        /* Hero */
        Kirki::add_panel( 'hero', array(
            'priority'          => 220,
            'title'             => __( '+ Hero header', 'ventcamp' ),
            // 'description'       => __( 'Hero block settings', 'ventcamp' )
        ) );

        /*
         * Hero style presets, style can be chosen from drop-down list.
         *
         * Every style has a specific set of settings.
         */
        require( 'customizer_fields/hero_style_presets.php' );

        require( 'customizer_fields/hero_layout_and_background.php' );

        require( 'customizer_fields/hero_main_heading.php' );

        require( 'customizer_fields/hero_upper_and_bottom.php' );

        require( 'customizer_fields/hero_top.php' );

        require( 'customizer_fields/hero_countdown.php' );

        /*
         * Customize footer settings, such as footer background color, footer text and so on.
         */
        Kirki::add_panel( 'footer', array(
            'priority'          => 250,
            'title'             => __( '+ Footer', 'ventcamp' ),
            'description'       => __( 'Footer settings', 'ventcamp' ),
        ) );

        require( 'customizer_fields/footer.php' );

        /*
         * Global buttons settings
         */
        Kirki::add_panel( 'buttons', array(
            'priority'          => 240,
            'title'             => __( '+ Buttons', 'ventcamp' ),
            'description'       => __( 'Global buttons settings', 'ventcamp' ),
        ) );

        require( 'customizer_fields/button_primary.php' );

        require( 'customizer_fields/button_secondary.php' );

        /*
         * Add mobile panel (custom styles for mobile devices, such as phones, tables)
         */
        Kirki::add_panel( 'mobile', array(
            'priority'          => 260,
            'title'             => __( '+ Responsiveness', 'ventcamp' ),
            'description'       => __( 'Styles for mobile mode', 'ventcamp' )
        ) );

        require( 'customizer_fields/mobile.php' );
    }

    add_action( 'init', 'ventcamp_register_customizer_fields' );
}
