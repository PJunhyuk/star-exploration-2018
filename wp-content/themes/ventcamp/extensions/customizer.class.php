<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate this class
if ( !class_exists( 'Customizer' ) ) :
    class Customizer {
        // Holds an instance of Customizer class
        private static $instance = null;
        // Holds an instance of WP_Customize_Manager class
        private $wp_customize;

        /**
         * Instantiate or return the one Customizer instance.
         *
         * @return null|Customizer Customizer instance
         */
        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Customizer constructor.
         */
        private function __construct() {
            // Add get_customizer_instance() function to customize_register hook
            add_action( 'customize_register', array( $this, 'get_customizer_instance' ) );
            // Enqueue custom scripts
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            // Enqueue custom styles
            add_action( 'customize_controls_print_styles', array( $this, 'enqueue_styles' ) );
            // Add our custom JS scripts to previewer
            add_action( 'customize_preview_init', array( $this, 'enqueue_previewer_scripts' ) );
            // Add handler for ajax reset request
            add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
        }

        /**
         * This function is triggered only on the initialization of the previewer in customizer
         * It adds our custom previewer script to the 'wp_enqueue_scripts' queue
         */
        public function enqueue_previewer_scripts() {
            // Enqueue previewer scripts and styles
            add_action( 'wp_enqueue_scripts', array( $this, 'previewer_scripts' ) );
        }

        /**
         * Enqueue our custom previewer script. The whole point of that script is that previewer must
         * trigger a 'ready' event so that customizer will know that previewer is ready.
         *
         * It's a communication module between customizer and previewer
         */
        public function previewer_scripts() {
            /* Customizer script, depends on the Customizer Preview Widgets script (part of Wordpress) */
            wp_enqueue_script( 'customizer-previewer', THEME_URI . '/js/ventcamp-customizer-previewer.js', array( 'customize-preview-widgets' ) );

            /*
             * Here is the place where a custom data can be passed directly to the previewer script
             */
            wp_localize_script( 'customizer-previewer', 'customizerCustomData', array() );
        }

        /**
         * Get an instance of $wp_customize and store in local variable
         *
         * @param WP_Customize_Manager $wp_customize An instance of WP_Customize_Manager class
         */
        public function get_customizer_instance( $wp_customize ) {
            $this->wp_customize = $wp_customize;
        }

        /**
         * Enqueue customizer styles
         */
        public function enqueue_styles() {
            wp_enqueue_style( 'customizer', THEME_URI . '/stylesheets/ventcamp-customizer.css', array(), strval(filemtime(THEME_DIR . '/stylesheets/ventcamp-customizer.css')));
        }

        /**
         * Enqueue customizer scripts
         */
        public function enqueue_scripts () {
            wp_enqueue_script( 'customizer', THEME_URI . '/js/ventcamp-customizer.js', array( 'jquery', 'customize-controls' ), strval(filemtime(THEME_DIR . '/js/ventcamp-customizer.js')) );
            // Localize text for reset button
            wp_localize_script( 'customizer', '_VCCustomizer', array(
                'reset'   => __( 'Reset', 'ventcamp' ),
                'confirm' => __( "Attention! This will remove all customizations ever made via customizer!\n\nThis action is irreversible!", 'ventcamp' ),
                'nonce'   => array(
                    'reset' => wp_create_nonce( 'customizer-reset' ),
                )
            ) );
        }

        /**
         * Handles ajax reset requests
         */
        public function ajax_customizer_reset() {
            // Check if it's a theme preview
            if ( ! $this->wp_customize->is_preview() ) {
                wp_send_json_error( 'not_preview' );
            }

            // Check nonce
            if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
                wp_send_json_error( 'invalid_nonce' );
            }

            /*
             * Reset customizer settings and notify JS script that resetting finished successfully
             */
            $this->reset_customizer();
            wp_send_json_success();
        }

        /**
         * Delete all theme_mod settings
         */
        public function reset_customizer() {
            // Get current customizer settings
            $settings = $this->wp_customize->settings();
            // Foreach through the all settings and remove all theme_mod settings from customizer
            foreach ( $settings as $setting ) {
                if ( 'theme_mod' == $setting->type ) {
                    remove_theme_mod( $setting->id );
                }
            }

            delete_option('ventcamp_customizer');
        }
    }

    Customizer::get_instance();
endif;
