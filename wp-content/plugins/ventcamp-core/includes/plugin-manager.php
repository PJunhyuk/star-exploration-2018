<?php

if ( !class_exists( 'Plugin_Manager' ) ) :
    class Plugin_Manager {

        private $core_plugins;
        private $deactivated_plugins;

        /*
         * Initialization
         */

        /**
         * Plugin_Manager constructor. Init our variables.
         */
        public function __construct() {
            // It's an array, not a string
            $this->deactivated_plugins = array();

            // Exclude these plugins, because they're the part of out theme
            $this->core_plugins = array(
                __( 'Ventcamp core', 'ventcamp'),
                __( 'Ventcamp Visual Composer Shortcodes', 'ventcamp' )
            );
        }

        /**
         * Deactivates all active plugins, except for ventcamp-core and ventcamp-vc-shortcodes,
         * because it's the part of out theme.
         *
         * @param array $plugins Array of plugins to disable
         */
        public function deactivate_plugins( $plugins = array() ) {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

            // Check our access
            if ( ! current_user_can( 'activate_plugins' ) )
                return;

            /* Use array of plugins that were passed or get all plugins */
            $plugins = empty( $plugins ) ? get_plugins() : $plugins;

            /* Foreach them and check the name */
            foreach ( $plugins as $plugin_file => $plugin_info ) {
                if ( ! in_array( $plugin_info['Name'], $this->core_plugins ) && is_plugin_active( $plugin_file ) ) {
                    // Add plugin to the list
                    array_push( $this->deactivated_plugins, $plugin_file );
                }
            }

            // Deactive all active plugins, except for excluded plugins
            deactivate_plugins( $this->deactivated_plugins );
        }

        /**
         * Deactivates core plugins.
         */
        public function deactivate_core_plugins() {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

            // Get all plugins
            $plugins = get_plugins();

            /* Foreach them and check the name */
            foreach ( $plugins as $plugin_file => $plugin_info ) {
                if ( in_array( $plugin_info['Name'], $this->core_plugins ) && is_plugin_active( $plugin_file ) ) {
                    // Add plugin to the list
                    array_push( $this->deactivated_plugins, $plugin_file );
                }
            }

            // Deactive core plugins
            deactivate_plugins( $this->deactivated_plugins );
        }

        /**
         * Reactivate all the plugins that were deactivated earlier.
         */
        public function reactivate_plugins() {
            // If we have disabled plugins, reactivate them one by one
            if ( ! empty( $this->deactivated_plugins ) ) {
                foreach ( $this->deactivated_plugins as $plugin ) {
                    $plugin = plugin_basename( $plugin );
                    if ( ! is_wp_error( validate_plugin( $plugin ) ) )
                        @activate_plugin( $plugin );
                }
            }
        }
    }
endif;
