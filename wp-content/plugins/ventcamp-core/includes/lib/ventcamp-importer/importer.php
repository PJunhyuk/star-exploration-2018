<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if(!defined('VENTCAMP_IMPORT_DIR')) {
    define('VENTCAMP_IMPORT_DIR', trailingslashit(dirname(__FILE__)));
}

// Require class for resetting DB
require_once "reset.php";

// Declare custom exceptions
class ErrorImporterException extends Exception {}
class WarningImporterException extends Exception {}

// Don't duplicate this class
if ( !class_exists( 'Demo_Importer' ) ) :
    class Demo_Importer {
        // Namespace for the variables
        public $name = 'importer';
        // Slug for the demo importer page
        public $page_slug = '';

        // Array of menus to assign
        protected $menus = array();
        // Is demo data imported or not?
        protected static $imported;
        // Path to the demo files
        public $demo_files_path;
        // Path to the content demo file
        public $content_demo;
        // Path to the file with theme options
        public $theme_options;

        /**
         * Demo_Importer constructor.
         */
        public function __construct() {
            $this->demo_files_path = apply_filters('ventcamp_importer_demo_files_path', VENTCAMP_IMPORT_DIR . 'demodata/');
            $this->content_demo    = apply_filters('ventcamp_importer_content_demo_file', $this->demo_files_path . 'content/startuply_demo_all.xml');
            $this->theme_options   = apply_filters('ventcamp_importer_theme_options_file', $this->demo_files_path . 'content/ventcamp-event-schedule.json');

            // Array of our menus
            $this->menus = array(
                // Main menu
                __( 'Theme main', 'ventcamp' ) => 'primary',
                // Footer menu
                __( 'Footer', 'ventcamp' ) => 'footer',
            );
            // Get saved state
            self::$imported = get_option( 'ventcamp_demodata_imported' );

            // Add 'Demo Data' menu item to admin menu
            add_action( "admin_menu", array( $this, 'add_admin_page' ) );
            // Enqueue all the necessary styles/scripts
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
        }

        /**
         * Text for demo data import form.
         */
        protected function form_intro_text() {
            // Messages for the user
            $this->show_form_notifications(); ?>

            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

            <p><strong>*NOTE: using this importer more then once can result in duplicate content! Works best on clean WP install*</strong></p>

            <ul>
                <li>- Before starting the import, you need to install all required theme plugins first</li>
                <li>- Import process will take time needed to download all attachments from demo web site, it can take several minutes. Closing Browser will stop the import process</li>
                <li>- Please make sure that your server able to do outbound request, we need to download some image that used on demo</li>
            </ul>
            <?php
        }

        /**
         * Show different messages depending on current state
         */
        protected function show_form_notifications() {
            // If demo content already imported
            if ( self::$imported ) {
                $this->show_alert( __('Demo data already imported', 'ventcamp') );
            }

            // Check if wordpress-importer plugin is activated
            if ( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) {
                $this->show_alert( __('We found an active plugin "wordpress-importer". Our theme already
                comes with wordpress-importer on board and to prevent conflicts, we recommend to temporarily disable
                this plugin, otherwise it may cause an errors during import or reset. Also, your version of 
                wordpress-importer may be incompatible with our demodata (formats differ from version to version).
                Proceed with caution.', 'ventcamp'), 'warning' );
            }
        }

        /**
         * Radio buttons with theme style selection
         */
        protected function theme_style_selector() { ?>
            <!-- Start of style selector -->
            <h2><?php _e( 'Theme Style', 'ventcamp' ); ?></h2>

            <div class="style-selector-wrapper clearfix">
                <?php
                // Array of available styles
                $styles = array(
                    'default',
                    'innovato',
                    'latitude',
                    'flower_lovers',
                    'no_style'
                );

                // Loop through the all styles
                foreach ( $styles as $style ) {
                    // Default style should be selected by default
                    $checked = ( $style == "default" ) ? 'checked="checked"' : ''; ?>

                    <div class="radio-horizontal">
                        <input id="<?php echo $style ?>"
                               type="radio"
                               name="style_selector"
                               value="<?php echo $style; ?>"
                               <?php echo $checked; ?> />
                        <label class="<?php echo $style; ?> style-selector"
                               for="<?php echo $style; ?>"></label>
                    </div>

                <?php } ?>
            </div>
        <?php
        }

        /**
         * Radio buttons with demo content selection
         */
        protected function content_selector() { ?>
            <!-- Start of content import radio buttons -->
            <h2><?php _e( 'Choose Content to Import', 'ventcamp' ); ?></h2>

            <div class="radio-group clearfix">
                <?php
                // Array of available content types
                $contents = array(
                    'all_content'   => __('All content - Pages, Posts, Menus, Forms, Event Schedule, WooCommerce Products', 'ventcamp'),
                    'event_schedule' => __('Additional content - Event schedule', 'ventcamp'),
                    'woo_events'     => __('Additional content - WooCommerce Products', 'ventcamp'),
                    'all_pages'      => __('Pages only', 'ventcamp'),
                    'all_posts'      => __('Posts only', 'ventcamp'),
                    'all_forms'      => __('Forms only', 'ventcamp')
                );

                // Loop through the all content types
                foreach ( $contents as $key => $value ) {
                    // Default content type should be selected by default
                    $checked = ( $key == "all_content" ) ? 'checked="checked"' : ''; ?>

                    <div class="radio">
                        <input id="<?php echo $key ?>"
                               type="radio"
                               name="content_type"
                               value="<?php echo $key; ?>"
                               <?php echo $checked; ?> />
                        <label for="<?php echo $key; ?>">
                               <?php echo $value; ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        <?php
        }

        /**
         * Display an html form with import and reset buttons on admin page.
         */
        public function import_form() {
            // Process submit action
            $this->handle_submit();

            // If demo content already imported
            $content_button = self::$imported ?
                __('Import again', 'ventcamp') : // Demo data already imported
                __('Start import', 'ventcamp'); // The first import
            ?>

            <div id="ventcamp-wrapper" class="wrap">
                <?php $this->form_intro_text(); // Default introductory text ?>

                <form class="ventcamp-import" name="importer" method="post">
                    <input type="hidden" name="<?php echo $this->name; ?>_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
                    <input type="hidden" name="action" value="demo-importer" />

                    <div class="row clearfix">
                        <div class="col-half">
                            <?php
                            // Theme Style selection
                            $this->theme_style_selector();
                            // Demo Content selection
                            $this->content_selector();
                            ?>
                        </div>
                    </div>

                    <button type="submit" name="import" class="button button-primary">
                        <?php echo $content_button; ?>
                    </button>

                    <button type="submit" name="reset" class="button">
                        <?php _e('Reset current data', 'ventcamp'); ?>
                    </button>
                </form>

            </div>

            <?php
        }

        /**
         * Check if user submitted a form, then call an appropriate function.
         */
        protected function handle_submit() {
            $import = isset($_POST['import']) ? true : false;
            $reset  = isset($_POST['reset']) ? true : false;
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

            if ( $this->check_nonce() && $action == 'demo-importer' ) {
                if ( $import ) {
                    $this->run_import();
                } elseif ( $reset ) {
                    $this->reset();
                }
            }
        }

        /**
         * Depending on user input, set demo content file.
         *
         * @param string $content_type Type of the content to import
         * @throws ErrorImporterException If invalid type specified
         */
        protected function set_demo_file( $content_type ) {

            switch ( $content_type ) {
                // All content - Pages, Posts, Menus, Forms, Event Schedule, WooCommerce Products
                case 'all_content' :
                    $file = 'ventcamp_demo_all_content.xml';
                    break;

                // Additional content - WooCommerce Products
                case 'woo_events' :
                    $file = 'ventcamp_demo_woo_products.xml';
                    break;

                // Pages only
                case 'all_pages' :
                    $file = 'ventcamp_demo_all_pages.xml';
                    break;

                // Posts only
                case 'all_posts' :
                    $file = 'ventcamp_demo_all_posts.xml';
                    break;

                // Forms only
                case 'all_forms' :
                    $file = 'ventcamp_demo_all_forms.xml';
                    break;

                default :
                    throw new ErrorImporterException( "Invalid content type: " . $content_type, 100 );
            }

            $this->content_demo = $this->demo_files_path . 'content/' . $file;
        }

        /**
         * Show an alert with required type, it can be an info message, error or warning.
         *
         * @param string $message Message to be showed
         * @param string $type Type of the alert: info, error or warning
         */
        protected function show_alert( $message, $type = 'success' ) {
            // Allowed types of alert
            $alert_types = array( 'info', 'success', 'error', 'warning' );
            // Set alert class depending on alert type
            $alert_class = in_array( $type, $alert_types ) ? 'notice-' . $type : '';

            if( !empty( $message ) ) : ?>
                <div class="<?php echo $alert_class ?> notice is-dismissible">
                    <p><strong><?php echo $message; ?></strong></p>
                </div>
            <?php endif;
        }

        /**
         * Fix for menu location: get's an id of main menu and set appropriate location
         *
         * @param array $menus Array of menus in the following format: "Menu name" => "Location"
         * @throws WarningImporterException If menu with specified name does not exist
         */
        protected function set_menu_locations( $menus = array() ) {
            // Check if user passed a custom array of menus
            $menus = empty( $menus ) ? $this->menus : $menus;
            // Get an array of locations
            $locations = get_nav_menu_locations();

            // Loop through the all menus and assign appropriate location
            foreach ($menus as $name => $location) {
                // Get id of our primary menu by menu name
                $term = get_term_by('name', $name, 'nav_menu');
                // If nav menu does not exist, show warning
                if ( $term != false ) {
                    // Get menu id
                    $menu_id = $term->term_id;
                    // Set menu location
                    $locations[ $location ] = $menu_id;
                } else {
                    throw new WarningImporterException( "Nav menu with name \"" . $name . "\" does not exist", 99 );
                }
            }

            set_theme_mod( 'nav_menu_locations', $locations );
        }

        /**
         * Set blog and home pages
         */
        protected function set_blog_and_home_pages() {
            // Get home page
            $home = get_page_by_title( 'Home page: theme default' );
            // Get blog page
            $blog = get_page_by_title( 'Blog' );

            update_option('show_on_front', 'page');

            // If home page exist, update page_on_front option
            if( isset( $home ) && $home->ID ) {
                update_option('page_on_front', $home->ID); // Front Page
            } else {
                throw new WarningImporterException( "Home page does not exist", 96 );
            }

            // If blog page exist, update page_for_posts option
            if( isset( $blog ) && $blog->ID ) {
                update_option('page_for_posts', $blog->ID); // Blog Page
            } else {
                throw new WarningImporterException( "Blog page does not exist", 97 );
            }
        }

        /**
         * Import demo data and adjust settings
         */
        public function import() {
            $this->check_libraries();
            // Get user's choice or set to 'all_content' by default
            // if $_POST is not set (ajax request is used for example)
            $content_type = isset($_POST['content_type']) ? $_POST['content_type'] : 'all_content';
            // Except for event schedule
            if ( $content_type != 'event_schedule' ) {
                $this->set_demo_file( $content_type );
                $this->process_import_file();
            }
            // If all content needs to be imported
            if ( $content_type == 'all_content' ) {
                $this->set_blog_and_home_pages();
                $this->set_menu_locations();
                $this->import_widgets();
            }
            // Additional content - event schedule
            if ( $content_type == 'event_schedule' || $content_type == 'all_content' ) {
                $this->process_theme_options_file();
            }

            // Import customizer settings
            $this->import_theme_style();
        }

        /**
         * Import pre-set theme style
         */
        public function import_theme_style() {
            // Get user's choice of theme style
            $header_style = isset($_POST['style_selector']) ? $_POST['style_selector'] : 'default';
            // Don't import anything
            if ( $header_style == 'no_style' ) {
                return;
            }

            // Make the path to file
            $path = $this->demo_files_path . 'customizer/' . $header_style . '.json';
            // Import pre-set customizer settings
            $this->import_customizer_settings( $path );
        }

        /**
         * Import pre-set customizer settings
         *
         * @param string $path Path to the file with customizer settings
         * @throws WarningImporterException If file doesn't exist or contain dummy data
         */
        public function import_customizer_settings( $path ) {
            // Check if file with settings exist
            if ( !file_exists( $path ) ) {
                throw new WarningImporterException(
                    "JSON file with customizer settings does not exist, path: \"" . $path . "\"", 98
                );
            } elseif ( !is_file( $path ) ) {
                // Most likely it's a directory, throw an exception
                throw new WarningImporterException(
                    "Specified path \"" . $path . "\" is not a file (customizer settings can't be imported)", 99
                );
            }

            // Get file contents
            $file_contents = file_get_contents( $path );
            // Decode JSON file
            $options = json_decode( $file_contents, true );

            // Check if we have any options
            if ( empty( $options['options'] ) ) {
                throw new WarningImporterException( "No customizer settings to import", 120 );
            }

            $options_to_import = array_keys( $options['options'] );

            // Loop through the all options
            foreach ( (array) $options_to_import as $option_name ) {
                // If option with this name is in the array
                if ( isset( $options['options'][ $option_name ] ) ) {
                    // Unserialize value if it was serialized
                    $option_value = maybe_unserialize( $options['options'][ $option_name ] );
                    // If option needs to be recreated or not?
                    if ( in_array( $option_name, $options['no_autoload'] ) ) {
                        delete_option( $option_name );
                        add_option( $option_name, $option_value, '', 'no' );
                    } else {
                        update_option( $option_name, $option_value );
                    }
                }
            }

            $this->recompile_styles();
        }

        /**
         * After importing of customizer settings, need to recompile all of our styles
         */
        public function recompile_styles() {
            // Call external function
            if ( function_exists('ventcamp_less_compile') ) {
                ventcamp_less_compile();
            }
        }

        /**
         * Wrapper method for import, handles all the exceptions and saves the status
         */
        public function run_import() {
            try {
                // Import all the content
                $this->import();
            } catch ( WarningImporterException $e ) {
                // Show a warning with message
                $this->show_alert( $e->getMessage(), 'warning' );
            } catch ( ErrorImporterException $e ) {
                // Show an error with message
                $this->show_alert( $e->getMessage(), 'error' );
                // Stop executing php code
                wp_die();
            }

            // Import finished successfully, show an alert
            $this->show_alert( __('Demo data imported successfully. Have fun!', 'ventcamp') );
            // Set imported flag to true
            self::$imported = true;
            // Update stats
            update_option( 'ventcamp_demodata_imported', self::$imported );
        }

        /**
         * Reset wordpress installation
         */
        public function reset() {
            // Init new DB Resetter
            $resetter = new DB_Resetter();
            // Reset DB
            $resetter->reset();
            // Delete demodata imported option
            delete_option( 'ventcamp_demodata_imported' );
            // Set imported flag to false
            self::$imported = false;
            // Show an alert
            $this->show_alert( __('All posts, pages and forms has been successfully reset', 'ventcamp') );
        }

        /**
         * Check if nonce is correct
         *
         * @return boolean True is nonce verified, false otherwise
         */
        protected function check_nonce() {
            if ( key_exists( "{$this->name}_nonce", $_POST ) ) {
                if ( wp_verify_nonce( $_POST["{$this->name}_nonce"], basename(__FILE__) ) ) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Check if all necessary libraries are loaded
         */
        public function check_libraries() {
            if ( !defined( 'WP_LOAD_IMPORTERS' ) ) {
                define( 'WP_LOAD_IMPORTERS', true );
            }

            /* Check presence of WP_Importer */
            if ( !class_exists( 'WP_Importer' ) ) {
                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if ( file_exists( $class_wp_importer ) ) {
                    require_once( $class_wp_importer );
                } else {
                    throw new ErrorImporterException(
                        "Can't find WP_Importer file, path: " . $class_wp_importer, 101
                    );
                }
            }

            /* Check presence of WP_Import */
            if ( !class_exists( 'WP_Import' ) ) {
                $class_wp_import = dirname( __FILE__ ) .'/vendor/wordpress-importer.php';
                if ( file_exists( $class_wp_import ) ) {
                    require_once( $class_wp_import );
                } else {
                    throw new ErrorImporterException(
                        "Can't find WP_Import file, path: " . $class_wp_import, 102
                    );
                }
            }

            /* Check presence of WP_Options_Importer */
            if ( !class_exists( 'WP_Options_Importer' ) ) {
                $class_wp_options_importer = dirname( __FILE__ ) .'/vendor/wordpress-options-importer.php';
                if ( file_exists( $class_wp_options_importer ) ) {
                    require_once( $class_wp_options_importer );
                } else {
                    throw new ErrorImporterException(
                        "Can't find WP_Options_Importer file, path: " . $class_wp_options_importer, 103
                    );
                }
            }
        }

        /**
         * Import demo data from specified file
         *
         * @param string $file Path to file with demo data
         * @throws ErrorImporterException If file name is not specified or file contains dummy data
         */
        public function process_import_file( $file = '' ) {
            // Check if user passed a custom file
            $file = empty( $file ) ? $this->content_demo : $file;

            if( !is_file( $file ) ) {
                throw new ErrorImporterException(
                    __('File with demo data containing dummy data or could not be read, check file permissions', 'ventcamp'), 104
                );
            } elseif ( empty( $file ) ) {
                throw new ErrorImporterException(
                    __('Demo data file is not specified', 'ventcamp'), 105
                );
            }

            $wp_import = new WP_Import();
            $wp_import->fetch_attachments = true;
            ob_start();
            $wp_import->import( $file );
            ob_end_clean();
        }

        /**
         * Import theme options data from specified file
         *
         * @param string $file Path to file with theme options
         * @throws ErrorImporterException If file name is not specified or file contains dummy data
         */
        public function process_theme_options_file( $file = '' ) {
            global $wp_filesystem;

            // Check if user passed a custom file
            $file = empty( $file ) ? $this->theme_options : $file;

            if( !is_file( $file ) ) {
                throw new ErrorImporterException(
                    __('File with theme options containing dummy data or could not be read, check file permissions', 'ventcamp'), 106
                );
            } elseif ( empty( $file ) ) {
                throw new ErrorImporterException(
                    __('Theme options file is not specified', 'ventcamp'), 107
                );
            }

            $wp_import = WP_Options_Importer::instance();
            $_POST['settings']['which_options'] = 'all';
            $file_contents = $wp_filesystem->get_contents( $file );
            $wp_import->import_data = json_decode( $file_contents, true );

            ob_start();
            $wp_import->import();
            ob_end_clean();
        }

        /**
         * Import demo widgets
         */
        public function import_widgets() {
            $params = array(
                array(
                    'sidebar' => 'sidebar_footer_1',
                    'widgets' => array(
                        array(
                            'name' => 'about_sply_widget',
                            'widget_opt_name' => 'widget_about_sply_widget',
                            'args' => array(
                                'title' => '',
                                'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco. Qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                                'author' => 'John Doeson, Founder.',
                                'bg_image' => '',
                            )
                        )
                    )
                ),
                array(
                    'sidebar' => 'sidebar_footer_2',
                    'widgets' => array(
                        array(
                            'name' => 'socials_sply_widget',
                            'widget_opt_name' => 'widget_socials_sply_widget',
                            'args' => array(
                                'title' => 'Social Networks',
                                'fb_opt' => 'http://your-social-link-here.com',
                                'twitter_opt' => 'http://your-social-link-here.com',
                                'google_opt' => 'http://your-social-link-here.com',
                                'linkedin_opt' => 'http://your-social-link-here.com',
                                'instagram_opt' => 'http://your-social-link-here.com',
                                'skype_opt' => 'http://your-social-link-here.com',
                                'pinterest_opt' => 'http://your-social-link-here.com',
                                'youtube_opt' => 'http://your-social-link-here.com',
                                'soundcloud_opt' => '',
                                'rss_opt' => '',
                            )
                        )
                    )
                ),
                array(
                    'sidebar' => 'sidebar_footer_3',
                    'widgets' => array(
                        array(
                            'name' => 'contacts_sply_widget',
                            'widget_opt_name' => 'widget_contacts_sply_widget',
                            'args' => array(
                                'title' => __( 'Our Contacts', 'ventcamp' ),
                                'our_email' => 'office@example.com',
                                'our_address' => '2901 Marmora road, Glassgow,<br> Seattle, WA 98122-1090',
                                'our_telephone' => '+9 500 750',
                            )
                        )
                    )
                ),
            );

            $active_widgets = get_option( 'sidebars_widgets' );

            $magick_id = 77;

            foreach ($params as $sidebar) {
                foreach ($sidebar['widgets'] as $widget) {
                    $active_widgets[$sidebar['sidebar']][] = $widget['name'].'-'.$magick_id;

                    $widget_options = get_option( $widget['widget_opt_name'] );
                    $widget_options[$magick_id] = $widget['args'];

                    update_option( $widget['widget_opt_name'], $widget_options );
                }
            }

            update_option( 'sidebars_widgets', $active_widgets );
        }

        /**
         * Add 'Demo Data' menu item to admin menu
         */
        public function add_admin_page() {
            // Save slug to use later
            $this->page_slug = add_theme_page (
                'Ventcamp demo data', // Page title
                'Ventcamp demo data', // Menu title
                'manage_options', // Capability
                'ventcamp_import', // Menu slug
                array( $this, 'import_form'), // Callback
                'dashicons-download', // Dashicons helper class to use a font icon
                120 // Menu position
            );
        }

        /**
         * Enqueue admin css stylesheets/js scripts
         *
         * @param string $hook Current admin page
         */
        public function admin_enqueue_assets( $hook ) {
            // Load only on ?page=mypluginname
            if( $hook != 'appearance_page_ventcamp_import' ) {
                return;
            }

            wp_enqueue_style( "{$this->name}-css", plugins_url( 'assets/stylesheets/core.css', __FILE__ ), false, '', 'all');
            // Register script for enqueuing as dependency
	        wp_register_script( "{$this->name}-core", plugins_url( 'assets/javascripts/core.js', __FILE__ ), array('jquery'), '', true );
            wp_enqueue_script( "{$this->name}-core" );
        }
    }
endif;