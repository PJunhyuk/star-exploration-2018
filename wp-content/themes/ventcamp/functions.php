<?php
/**
 *
 * Ventcamp WP Theme functions
 *
 * @author Vivaco
 * @license Commercial License
 * @link http://vivaco.com
 * @copyright 2017 Vivaco
 * @package Ventcamp
 * @version 2.4.4
 *
 */
defined('ABSPATH') or die('No direct access');

// Name of the theme
define('THEME_NAME', 'ventcamp');

// Path constants
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

define('IMAGESPATH_URI', THEME_URI . '/img/');
define('SCRIPTSPATH_URI', THEME_URI . '/js/');

/*
*   By default LESS files are compiled only after you hit "Save in WP -> Customize"
*   This setting will override this option and compile LESS on each webpage load *   refresh. Help to debug a lot
*/
define('VENTCAMP_LESS_COMPILE_DEBUG', false);

// Theme main variables
define('VENTCAMP_BLOG_IMAGE_LARGE_W', 860);
define('VENTCAMP_BLOG_IMAGE_LARGE_H', 340);

define('VENTCAMP_FOOTER_RECENTCOMMENTS_LENGTH', 25); // Recent comments title length in footer
define('VENTCAMP_FOOTER_RECENTPOSTS_LENGTH', 25);	// Recent posts title length in footer

if( !function_exists('ventcamp_theme_setup') ) {
	function ventcamp_theme_setup() {
		load_theme_textdomain( 'ventcamp', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'caption' );

		if ( ! isset( $content_width ) ) $content_width = 960;

		add_editor_style();
		
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		add_theme_support( 'custom_css' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Add slider and lightbox functionality to WooCommerce
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_image_size( '70x70', 70, 70, false );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'ventcamp' ),
			'footer'  => esc_html__( 'Footer Menu', 'ventcamp' ),
		) );
	}
}

if( !function_exists('fix_customizer_custom_css_priority' ) ) {
	function fix_customizer_custom_css_priority(\WP_Customize_Manager $wp_customize){
		$wp_customize->get_section ('custom_css')->priority = '999';
	}
}

add_action( 'after_setup_theme', 'ventcamp_theme_setup' );
add_action( 'customize_register', 'fix_customizer_custom_css_priority');

if( !function_exists('ventcamp_option' ) ) {
    /**
     * Helper function to return option value.
     * If the value is not set, returns $default
     *
     * @param string $name Name of the option
     * @param mixed $default Default value for option
     *
     * @return bool Result
     */
    function ventcamp_option( $name = '', $default = false ){
        if ( class_exists( 'Kirki' ) ) {
            $value = Kirki::get_option( 'ventcamp_theme_config', $name );

            if ( isset( $value ) ) {
                return $value;
            }
        }

        return $default;
    }
}

/**
 * Displays all messages registered to 'options-framework'
 */
function ventcamp_admin_notices_action() {
    settings_errors( 'ventcamp-notices' );
}
add_action( 'admin_notices', 'ventcamp_admin_notices_action' );

// Include Theme libraries and dependencies
if ( function_exists( 'is_plugin_active' ) ){

    // If plugin with core functionality is active, require file with customizer settings
    if ( is_plugin_active( 'ventcamp-core/ventcamp-core.php' ) ) {
        require_once THEME_DIR . '/extensions/customizer-extensions.php';
    }

    // Only if WooCommerce plugin is active, require custom woocommerce functionality
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        require_once THEME_DIR . '/extensions/woocommerce.class.php';
    }

}

// Add ventcamp widgets
require_once ( THEME_DIR . '/includes/ventcamp_widgets.php' );

// Add Event schedule
require_once ( THEME_DIR . '/includes/ventcamp_event.php' );

// Add misc template overrides
require_once ( THEME_DIR . '/includes/ventcamp_template_tags.php' );

// Add aqua thumbnail resizer
require_once ( THEME_DIR . '/includes/lib/aqua-resizer/aqua-resizer.php' );

// Adding theme specific widget overrides
require_once ( THEME_DIR . '/includes/widgets/ventcamp_widget_Recent_Posts.php' );
require_once ( THEME_DIR . '/includes/widgets/ventcamp_widget_Recent_Comments.php' );
require_once ( THEME_DIR . '/includes/widgets/ventcamp_widget_About.php' );

// Load custom footer helpers
require_once ( THEME_DIR . '/extensions/footer-extensions.php');

// Load custom header helpers
require_once ( THEME_DIR . '/extensions/header-extensions.php' );

// Load custom hero block helpers
require_once ( THEME_DIR . '/extensions/hero.class.php' );

// Load comment section helpers
require_once ( THEME_DIR . '/extensions/discussion-extensions.php');

// Install and activate required plugins
require_once ( THEME_DIR . '/extensions/plugin-activation.php' );

// Add Mailchimp API integration page
require_once ( THEME_DIR . '/extensions/api-integration.php');

// Add custom post type: modals
$ventcamp_modals_on = get_option('ventcamp_modals_on');
if ($ventcamp_modals_on != 1 || $ventcamp_modals_on == ''){
	require_once ( THEME_DIR . '/extensions/modals-menu.php' );
}

if ( is_admin() ) {
    require_once ( THEME_DIR . '/extensions/modals-settings.php' );
}

if ( !class_exists( 'Kirki' ) ){
	/**
	 * Fallback functions if core plugin is disabled
	 */
	function ventcamp_pagination() {
		echo paginate_links(array(
			'prev_text'          => esc_html__('&larr;', 'ventcamp'),
			'next_text'          => esc_html__('&rarr;', 'ventcamp'),
		));
	}
};

add_filter( 'lostpassword_url', 'remove_all_lostpassword_filters', PHP_INT_MAX, 2 );
/**
 * Bugfix: remove woocommerce filter for 'lostpassword_url', because it gives 404 error
 */
if ( !function_exists( 'remove_all_lostpassword_filters' ) ){
	function remove_all_lostpassword_filters( $url, $redirect ) {
	    remove_all_filters( 'lostpassword_url' );

	    return wp_lostpassword_url( $redirect );
	}
}

// Load custom content helpers
require_once ( THEME_DIR . '/extensions/content-extensions.php' );