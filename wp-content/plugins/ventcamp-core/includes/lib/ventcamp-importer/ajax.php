<?php

// Require parent class
require_once "importer.php";

// Import state machine class
require_once "state.php";

// Don't duplicate this class
if ( !class_exists( 'Ajaxified_Importer' ) ) :
    /**
     * An extension over importer that adds communication
     * with front-end through AJAX requests.
     */
    class Ajaxified_Importer extends Demo_Importer {
        // Holds an instance of importer
        private static $instance;
        // Namespace for the variables
        protected $namespace = 'ajaxified';
        // Holds an instance of state machine
        protected $state;

        /**
         * Access the single instance of this class
         * @return Ajaxified_Importer
         */
        public static function get_instance() {
            if ( null == self::$instance ) {
                self::$instance = new Ajaxified_Importer();
            }
            return self::$instance;
        }

        /**
         * Importer_Ajax constructor.
         */
        public function __construct () {
            // Call parent's constructor
            parent::__construct();

            // Init our state machine
            $this->state = Importer_Stats::get_instance();

            // Enable ajax only if it makes sense
            if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                // Add ajax support, only for logged in users
                add_action( "wp_ajax_{$this->namespace}_notifications", array( $this, 'ajax_notifications' ) );
            }

            // Enqueue required script
            add_action( 'admin_enqueue_scripts', array( $this, 'frontend_assets' ) );
        }

        /**
         * Enqueue the core functionality on front-end
         *
         * @param string $hook Current admin page
         */
        public function frontend_assets ( $hook ) {
            // Load only on ?page=mypluginname
            if( $hook != 'appearance_page_ventcamp_import' ) {
                return;
            }

            // Enqueue style
            wp_enqueue_style( "{$this->namespace}-css", plugins_url( 'assets/stylesheets/ajax.css', __FILE__ ), false, '', 'all');

            // Enqueue handlebar scripts
            wp_enqueue_script( "{$this->namespace}-handlebars", plugins_url( 'assets/javascripts/lib/handlebars-1.0.0.beta.6.js', __FILE__ ), array('jquery'), '', true);
            // Enqueue our ajax functionality
            wp_enqueue_script( "{$this->namespace}-js", plugins_url( 'assets/javascripts/ajax.js', __FILE__ ), array("jquery", "importer-core"), '', true);

            // Localize import script to pass ajax data
            $this->ajax_script_localize();
        }

        /**
         * Pass all the necessary variables to the script
         */
        public function ajax_script_localize () {
            // Create a new nonce
            $nonce = wp_create_nonce( "{$this->namespace}_notifications" );

            wp_localize_script( "{$this->namespace}-js", "{$this->namespace}Object", array(
                'ajaxurl'     => admin_url( 'admin-ajax.php' ),
                '_ajax_nonce' => $nonce,
                'action'      => "{$this->namespace}_notifications"
                # etc.
            ) );
        }

        /**
         * Check if all necessary libraries are loaded
         */
        public function check_libraries() {
            try {
                // Call parent's method
                parent::check_libraries();
                // Set state of libraries to 'success'
                $this->state->set_state( 'libraries', __( 'Checking importer libraries...', 'ventcamp' ), 'success' );
            } catch ( ErrorImporterException $e ) {
                // Finish import
                $this->abort_import( 'libraries', $e->getMessage() );
            }
        }

        /**
         * Depending on user input, set demo content file.
         *
         * @param string $content_type Type of the content to import
         */
        protected function set_demo_file( $content_type ) {
            try {
                // Call parent's function
                parent::set_demo_file( $content_type );
                // Set state of demofile to 'success'
                $this->state->set_state( 'demofile', __( 'Checking demo content type...', 'ventcamp' ), 'success' );
            } catch ( ErrorImporterException $e ) {
                // Finish import
                $this->abort_import( 'demofile', $e->getMessage() );
            }
        }

        /**
         * Fix for menu location: get's an id of main menu and set appropriate location
         *
         * @param array $menus Array of menus in the following format: "Menu name" => "Location"
         */
        protected function set_menu_locations( $menus = array() ) {
            try {
                // Call parent's function
                parent::set_menu_locations( $menus );
                // Set status that menus were configured
                $this->state->set_state( 'menus', __( 'Setting up demo menus...', 'ventcamp' ), 'success' );
            } catch ( WarningImporterException $e ) {
                // Set state of menus to 'failed'
                $this->state->set_state( 'menus', $e->getMessage(), 'failed' );
            }
        }

        /**
         * Set blog and home pages
         */
        protected function set_blog_and_home_pages() {
            try {
                // Call parent's function
                parent::set_blog_and_home_pages();
                // Set pages state to 'success'
                $this->state->set_state( 'pages', 'Setting up home and blog pages...', 'success' );
            } catch ( WarningImporterException $e ) {
                // Set pages state to 'failed'
                $this->state->set_state( 'pages', $e->getMessage(), 'failed' );
            }
        }

        /**
         * Import demo data from specified file
         *
         * @param string $file Path to file with demo data
         */
        public function process_import_file( $file = '' ) {
            try {
                // Call parent's method
                parent::process_import_file( $file );
                // Set state of the content to 'success'
                $this->state->set_state( 'content', __( 'Importing the main content...', 'ventcamp' ), 'success' );
            } catch ( ErrorImporterException $e ) {
                // Finish import
                $this->abort_import( 'content', $e->getMessage() );
            }
        }

        /**
         * Import theme options data from specified file
         *
         * @param string $file Path to file with theme options
         */
        public function process_theme_options_file( $file = '' ) {
            try {
                // Call parent's method
                parent::process_theme_options_file( $file );
                // Set state that options were imported successfully
                $this->state->set_state( 'options', __( 'Importing theme options...' ), 'success' );
            } catch ( ErrorImporterException $e ) {
                // Finish import
                $this->abort_import( 'options', $e->getMessage() );
            }
        }

        /**
         * Fatal error happened, finish import and stop executing code
         *
         * @param string $name Name of the state
         * @param string $message Message to the user
         */
        protected function abort_import( $name, $message ) {
            // Set state of options to failed
            $this->state->set_state( $name, $message, 'failed' );
            // Switch state to 'finished'
            $this->state->finish_state();
            // Stop executing php code
            wp_die();
        }

        /**
         * Import pre-set customizer settings
         */
        public function import_theme_style() {
            try {
                // Call parent's method
                parent::import_theme_style();
                // Set state that options were imported successfully
                $this->state->set_state( 'theme', __( 'Importing pre-set theme styles...' ), 'success' );
            } catch ( ErrorImporterException $e ) {
                // Finish import
                $this->abort_import( 'theme', $e->getMessage() );
            }
        }

        /**
         * Import demo widgets
         */
        public function import_widgets() {
            // Call parent's method
            parent::import_widgets();
            // Set state that widgets were imported successfully
            $this->state->set_state( 'widgets', __( 'Importing widgets...', 'ventcamp' ), 'success' );
        }

        /**
         * Import demo data and adjust settings
         */
        public function import() {
            // Initial state
            $this->state->start_state();
            // Call parent's import method
            parent::import();
            // Switch state to 'finished'
            $this->state->finish_state();

            // Set imported flag to true
            self::$imported = true;
            // Update stats
            update_option( 'ventcamp_demodata_imported', self::$imported );
        }

        /**
         * Reset wordpress installation
         */
        public function reset() {
            // Call parent's function
            parent::reset();
            // Reset current state
            $this->state->reset_stats();
        }

        /**
         * Send an ajax notification in json format to the page
         */
        public function ajax_notifications () {
            // Apply esc_attr filter to every param
            $data = array_map( 'esc_attr', $_POST );

            // If nonce is incorrect, send json error
            ! check_ajax_referer( $data['action'], "_ajax_nonce", false )
                AND wp_send_json_error();

            // Check if form data was passed or not
            if ( isset( $_POST['formdata'] ) && !empty( $_POST['formdata'] ) ) {
                // Decode special characters and turn &amp; into &
                $decoded = htmlspecialchars_decode( $_POST['formdata'] );
                // Parse query string
                parse_str( $decoded, $form_array );

                // Set $_post variables like it was just a normal call
                $_POST['content_type']   = $form_array['content_type'];
                $_POST['style_selector'] = $form_array['style_selector'];

                // Start import process
                $this->import();
            }
            // Process request and send json with state
            wp_send_json_success(
                array(
                    'statuses' => $this->state->get_stats(), // Get stats
                    'current'  => $this->state->get_current_state() // Get current state
                )
            );
        }

        /**
         * Override of parent template.
         */
        protected function form_intro_text() { ?>
            <div id="importer-intro">
                <?php parent::form_intro_text(); ?>
            </div>

            <div id="importer-status">
                <?php $this->status_table_template(); ?>
            </div>
            <?php
        }

        /**
         * Just a table with names of stats and result (completed/failed)
         */
        protected function status_table_template() { ?>
            <div class="card-cap">
                <h3><?php _e( 'Import Status', 'ventcamp' ); ?></h3>
            </div>

            <div class="card-body">
                <div class="statuses">
                    <div class="loading-wrapper">
                        <div class="loading">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>

                    <script id="template" type="text/x-handlebars-template">
                        {{#if statuses}}
                            <div class="status-header">
                                <div class="col-sml header"></div>
                                <div class="col-lg header"><?php _e( 'Name of the task', 'ventcamp' ); ?></div>
                                <div class="col-med header"><?php _e( 'Duration', 'ventcamp' ); ?></div>
                                <div class="col-med header"><?php _e( 'Progress', 'ventcamp' ); ?></div>
                            </div>

                            {{#each statuses}}
                            <div class="status-container">
                                <div class="col-sml status">
                                    <span class="import-status" data-import-status="{{status}}"></span>
                                </div>
                                <div class="col-lg name">{{message}}</div>
                                <div class="col-med duration">{{duration}}</div>
                                <div class="col-med current-task">{{{statusfull}}}</div>
                            </div>
                            {{/each}}
                        {{else}}
                            <div class="loading-wrapper">
                                <div class="loading">
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        {{/if}}
                    </script>
                </div>
            </div>
            <?php
        }
    }

    // Init new Ajaxified Importer
    Ajaxified_Importer::get_instance();
endif;


