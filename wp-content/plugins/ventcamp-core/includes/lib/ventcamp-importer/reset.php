<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate this class
if ( !class_exists( 'DB_Resetter' ) ) :
    class DB_Resetter {

        private $blog_data;
        private $user;
        private $user_data;
        // It's an array, not a string
        private $wp_tables = array();
        private $tables_to_drop;

        /*
         * Initialization
         */

        /**
         * DB_Resetter constructor. Init tables and set user.
         */
        public function __construct() {
            // Default set of tables to drop, options, users and usermeta are not included
            $this->tables_to_drop = 'commentmeta, comments, links, postmeta, posts, terms, term_relationships, term_taxonomy';

            $this->set_user();
        }

        /**
         * Prepare our tables for dropping, exclude users and their info.
         * Tables can be overridden by passing a custom array.
         *
         * @param string $tables A custom list of tables
         */
        public function select_wp_tables( $tables = '' ) {
            global $wpdb;

            // If user passed a custom list of tables, otherwise use our default list
            $tables = ! empty( $tables ) ? $tables : $this->tables_to_drop;

            // Sanitize input and convert to array
            $tables = explode( ',', preg_replace( '/\s+/', '', $tables ) );
            $tables = array_flip( $tables );
            // Add a prefix to every table
            foreach ( $tables as $key => $value ) {
                array_push( $this->wp_tables, $wpdb->prefix.$key);
            }
        }

        /**
         * Set admin user
         */
        private function set_user() {
            global $current_user;

            // If admin user have a different name, get this name
            if ( $current_user->user_login != 'admin' ) {
                $this->user = get_user_by( 'login', 'admin' );
            }

            if ( empty( $this->user->user_level ) || $this->user->user_level < 10 ) {
                $this->user = $current_user;
            }
        }

        /**
         * Reset the Wordpress database back to default.
         *
         * @param string $tables Optional parameter, a list of tables to be dropped
         */
        public function reset( $tables = '' ) {
            // Select tables to preserve
            $this->select_wp_tables( $tables );
            $this->set_backup();
            $this->reinstall();
            $this->restore_backup();
        }

        /**
         * Backup everything
         */
        private function set_backup() {
            $this->set_user_session_tokens();
            $this->set_blog_data();
        }

        /**
         * Save current user session token
         */
        private function set_user_session_tokens() {
            if ( get_user_meta( $this->user->ID, 'session_tokens' ) ) {
                $this->user_data = array(
                    'session_tokens' => get_user_meta( $this->user->ID, 'session_tokens', true )
                );
            }
        }

        /**
         * Save current blog data, such as blog name, site url etc.
         */
        private function set_blog_data() {
            $this->blog_data = array(
                'blogname' => get_option( 'blogname' ),
                'blog_public' => get_option( 'blog_public' ),
                'siteurl' => get_option( 'siteurl' ),
                'active_plugins' => get_option( 'active_plugins' ),
                'current_theme' => get_option( 'current_theme' ),
                'stylesheet' => get_option( 'stylesheet' ),
                'template' => get_option( 'template' )
            );
        }

        /**
         * Drop current database, populate with initial data and restore user settings after this
         */
        private function reinstall() {
            $this->drop_wp_tables();
            $this->delete_options();
            $this->install_wp();
            $this->update_user_settings();
        }

        /**
         * Loop through the tables and drop them all
         */
        private function drop_wp_tables() {
            global $wpdb;

            foreach ( $this->wp_tables as $wp_table ) {
                $wpdb->query( "DROP TABLE {$wp_table}" );
            }
        }

        /**
         * Not all options should be deleted, only some of them
         */
        private function delete_options() {
            // Delete link to the old page
            delete_option("show_on_front");
            // Reset page for posts
            delete_option("page_for_posts");
            // Reset page on front
            delete_option("page_on_front");
            // Reset sidebar widgets
            delete_option("sidebars_widgets");
        }

        /**
         * Populate the database with initial data
         *
         * @return mixed
         */
        private function install_wp() {
            // Import wp_install() function
            require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

            return wp_install(
                $this->blog_data[ 'blogname' ],
                $this->user->user_login,
                $this->user->user_email,
                $this->blog_data[ 'blog_public' ]
            );
        }

        /**
         * Update user password and user activation key
         */
        private function update_user_settings() {
            global $wpdb;

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE $wpdb->users
          		 	 SET user_pass = '%s', user_activation_key = ''
          		 	 WHERE ID = '%d'",
                    $this->user->user_pass, $this->user->ID
                )
            );
        }

        /**
         *	Restore table rows, user session tokens and blog data
         */
        private function restore_backup() {
            $this->restore_user_session_tokens();
            $this->restore_theme_data();
        }

        /**
         * Restore user session tokens
         */
        private function restore_user_session_tokens() {
            add_user_meta( $this->user->ID, 'session_tokens', $this->user_data['session_tokens'] );
        }

        /**
         * Restore blog name, blog visibility to search engines, site url, template etc.
         */
        private function restore_theme_data() {
            foreach ( $this->blog_data as $key => $value ) {
                $this->restore_option($key);
            }
        }

        /**
         * Checks if backed up option is not empty and update current option
         *
         * @param string $option Option to be updated
         */
        private function restore_option( $option ) {
            if ( ! empty( $this->blog_data[$option] ) ) {
                update_option( $option, $this->blog_data[$option] );
            }
        }
    }
endif;
