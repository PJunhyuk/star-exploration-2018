<?php if ( ! defined( 'ABSPATH' ) ) exit;
/*
 * Plugin Name: Ventcamp core
 * Description: Main core and misc helpers for Ventcamp WP theme
 * Version: 2.4.4
 * Author: Vivaco.com
 * Author URI: http://vivaco.com/
 * Developer: Vivaco
 * Developer URI: http://vivaco.com/
 * Text Domain: ventcamp-core
 */

define('VENTCAMP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//Init WP filesystem
require_once(ABSPATH . 'wp-admin/includes/file.php');
$access_type = get_filesystem_method();
if($access_type === 'direct')
{
	/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
	$creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

	/* initialize the API */
	if ( ! WP_Filesystem($creds) ) {
		return false;
	}
	global $wp_filesystem;
}

// Add pagination class
require VENTCAMP_PLUGIN_DIR . '/includes/pagination.class.php';

// Add Contact 7 extender with Mailchimp
require VENTCAMP_PLUGIN_DIR . '/includes/ventcamp_contact7_handler.php';

// Add Customizer Kirki Class
require VENTCAMP_PLUGIN_DIR . '/includes/lib/kirki/kirki.php';
if( !function_exists('ventcamp_kirki_update_url') ) {
    function ventcamp_kirki_update_url( $config ) {
        $config['url_path'] = plugins_url() . '/ventcamp-core/includes/lib/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'ventcamp_kirki_update_url' );

// Add Ventcamp Admin Dashboard Menu functions
//require VENTCAMP_PLUGIN_DIR . '/includes/ventcamp_dashboard_menus.php';

// WP Mailchimp Class
require VENTCAMP_PLUGIN_DIR . '/includes/lib/mailchimp/inc/MCAPI.class.php';

// WP LESS parser
require VENTCAMP_PLUGIN_DIR . '/includes/lib/Less/Autoloader.php';
Less_Autoloader::register();

// Add ventcamp demodata importer
require VENTCAMP_PLUGIN_DIR . '/includes/lib/ventcamp-importer/ajax.php';

// Add duplicate posts plugin
require VENTCAMP_PLUGIN_DIR . '/includes/lib/clone-post/clone-post.php';

// Iinit ACF Pro
if( !function_exists('vivaco_acf_path') ) {
	function vivaco_acf_path( $path ) {
		$path = VENTCAMP_PLUGIN_DIR . '/includes/lib/advanced-custom-fields-pro/';
		return $path;
	}
}
add_filter('acf/settings/path', 'vivaco_acf_path');

if( !function_exists('vivaco_acf_dir') ) {
	function vivaco_acf_dir( $dir ) {
		$dir = plugins_url() . '/ventcamp-core/includes/lib/advanced-custom-fields-pro/';
		return $dir;
	}
}
add_filter('acf/settings/dir', 'vivaco_acf_dir');

//Enabling/Disabling ACF field manager
$ventcamp_enable_acf_fields = get_option('ventcamp_enable_acf_fields');
if ($ventcamp_enable_acf_fields != 1 || $ventcamp_enable_acf_fields == ''){
	add_filter('acf/settings/show_admin', '__return_false');
}

// Include ACF Pro
require VENTCAMP_PLUGIN_DIR . '/includes/lib/advanced-custom-fields-pro/acf.php';

 // Load speaker custom post type
require_once ( VENTCAMP_PLUGIN_DIR . '/includes/custom_post_types/custom-post-type-speakers.php');

// Load speaker custom post type ACF fields
require_once ( VENTCAMP_PLUGIN_DIR . '/includes/custom_post_types/custom-post-type-speakers-acf-fields.php');

// Load sponsors custom post type
require_once ( VENTCAMP_PLUGIN_DIR . '/includes/custom_post_types/custom-post-type-sponsors.php');

// Load sponsors custom post type ACF fields
require_once ( VENTCAMP_PLUGIN_DIR . '/includes/custom_post_types/custom-post-type-sponsors-acf-fields.php');

// Load custom post type helpers
require_once ( VENTCAMP_PLUGIN_DIR . '/includes/custom_post_types/custom-post-type-helpers.php');


if ( !function_exists( 'write_permissions_error' ) ) {
    /**
     * Check if theme has enough permisssions to write /cache files
     */
    function write_permissions_error() {
        ?>
        <div class="notice error write_permissions_error is-dismissible" >
            <p><?php esc_html__( 'Error, files stylesheets/css/theme-style.css, stylesheets/css/admin-style.css or stylesheets/css/ventcamp-fonts.css could not be written! Please make sure there are enough permissions for a theme to create these files in stylesheets/css directory ', 'ventcamp' ); ?><a href="#">How to fix it & details</a></p>
        </div>
        <?php
    }
}

if( !function_exists('ventcamp_less_compile') ) {
	/**
	 * Compile Ventcamp LESS files
	 */
	function ventcamp_less_compile(){
		// Start WP File operations
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;

		// Start LESSPHP parser
		$parser = new Less_Parser('cache_dir', get_temp_dir());

		$parser->SetImportDirs( array(get_template_directory() . '/stylesheets/less/' => get_template_directory_uri() ) );

		$parser->parseFile( get_template_directory() . '/stylesheets/less/style.less', get_template_directory_uri() );

		// $fields_for_dump = array();
		$less_vars = array();
		$tmp_fonts_to_load = array();
		$fonts_weights_to_load = array();
		foreach (Kirki::$fields as $field_key => $field) {
			// $fields_for_dump[] = "// " . $field['label'] . " (" . $field['type'] .  ")\n@" . $field['settings']." = " . Kirki::get_option( 'ventcamp_theme_config' , $field['settings'] ) . ";" ;
			// echo $field['settings'] . "<br>\n";
			$field_value = Kirki::get_option( 'ventcamp_theme_config' , $field['settings'] );
			if(isset($field['less'])){
				if(is_string($field['less'])){

					$quote = ((is_string($field_value) || is_bool($field_value) || is_int($field_value))
						&& isset($field['less_quote']) && $field['less_quote'] == true);

					$append = isset($field['less_append']) ? $field['less_append'] : '';


					if(is_string($field_value) || is_bool($field_value)){
						$less_vars[$field['less']] = ($quote ? "'":"") . $field_value . $append . ($quote ? "'":"");
					}else if(is_int($field_value)){

						$less_vars[$field['less']] = ($quote ? "'":"") . $field_value . 'px' . $append . ($quote ? "'":"");
					}

					if($field['type'] == 'typography' && is_array($field_value)){
						if(isset($field_value['font-family'])){
							$tmp_fonts_to_load[] = $field_value['font-family'];
						}
						if(isset($field_value['font-weight'])){
							if(!in_array($field_value['font-weight'], $fonts_weights_to_load)){
								$fonts_weights_to_load[] = $field_value['font-weight'];
							}
						}

						foreach ($field_value as $key => $value) {
							if(is_string($value)){
								$less_vars[$field['less'] . "_" . str_replace('-', '_', $key)] = $value;
							}else if (is_bool($value)) {
								$less_vars[$field['less'] . "_" . str_replace('-', '_', $key)] = ( $value ? 1 : 0);
							}else if(is_array($value)){
								foreach ($value as $val) {
									$less_vars[$field['less'] . "_" . str_replace('-', '_', $key) . "_" . $val] = true;
								}
							}
						}
					}
				}

			}
		}

		$fonts_to_load = array_unique($tmp_fonts_to_load);
		$google_fonts_import = "@import url(" . Kirki_Fonts::get_google_font_uri($fonts_to_load, $fonts_weights_to_load, ventcamp_option('typography_fonts_subsets')) . ");";

		// Writing theme fonts
		if ( ! $wp_filesystem->put_contents( get_template_directory() . '/stylesheets/css/ventcamp-fonts.css', $google_fonts_import, 0644) ) {
			add_action( 'admin_notices', 'write_permissions_error' );
			return false;
		}

		if(isset($_GET['show-less']) && $_GET['show-less'] == '1'){
			var_dump($less_vars); die;
		}

		$parser->ModifyVars($less_vars);
		// $parser->parseFile( STYLES_DIR . 'animations.less',  get_template_directory_uri() );
		$css = $parser->getCss();

		// Writing main theme styles
		if ( ! $wp_filesystem->put_contents( get_template_directory() . '/stylesheets/css/theme-style.css', $css, 0644) ) {
			add_action( 'admin_notices', 'write_permissions_error' );
			return false;
		}

		$admin_parser = new Less_Parser('cache_dir', get_temp_dir());
		$admin_parser->SetImportDirs( array(get_template_directory() . '/stylesheets/less/' => get_template_directory_uri() ) );
		$admin_parser->parseFile( get_template_directory() . '/stylesheets/less/admin-style.less', get_template_directory_uri() );
		$admin_parser->ModifyVars($less_vars);
		$admin_css = $admin_parser->getCss();

		// Writing admin styles
		if ( ! $wp_filesystem->put_contents( get_template_directory() . '/stylesheets/css/admin-style.css', $admin_css, 0644) ) {
			add_action( 'admin_notices', 'write_permissions_error' );
			return false;
		}
	}
}

if( !function_exists( 'ventcamp_js_variables_compile' ) ) {
	/**
	 * Pass JS variables from customizer to main script
	 */
	function ventcamp_js_variables_compile () {
		// Declare a new array to pass to wp_localize_script function
		$js_variables = array();

		// Loop through the all settings
		foreach (Kirki::$fields as $field_key => $field) {
			// Only if "to_js" key is set
			if ( isset($field[ 'to_js' ] ) ) {
				// Get field value
				$value = Kirki::get_option( 'ventcamp_theme_config' , $field[ 'settings' ] );
				// Make an array jsVariableName => value
				$js_variables[ $field[ 'to_js' ] ] = $value;
			}
		}

		// Don't enqueue script on admin page
		if ( !( is_admin() ) && !empty( $js_variables ) ) {
			// Script handle
			$handle = 'ventcamp-main';
			$list = 'registered';

			// Check current status of the script
			if ( !wp_script_is( $handle, $list ) ) {
				// Script is not registered, register it now
				wp_register_script( $handle, get_template_directory_uri() . "/js/ventcamp.js", array('jquery'), false, true);
			}

			// Pass variables and enqueue it
			wp_localize_script( $handle, 'ventcampThemeOptions', $js_variables );
			wp_enqueue_script( $handle );
		}
	}
}

if ( !function_exists('enqueue_less_styles') ) {
    /**
     * Load all LESS source files
     *
     * @param string $tag Link tag to the stylesheet
     * @param string $handle Handle of the stylesheet
     *
     * @return string Link to the less stylesheet
     */
	function enqueue_less_styles($tag, $handle) {
		global $wp_styles;
		$match_pattern = '/\.less$/U';

        // Get stylesheet registered with handle
        $stylesheet = $wp_styles->registered[$handle];

		if ( preg_match( $match_pattern, $stylesheet->src ) ) {
			$handle = $stylesheet->handle;
			$media = $stylesheet->args;
			$href = $stylesheet->src . '?ver=' . $stylesheet->ver;
			$rel = isset($stylesheet->extra['alt']) && $stylesheet->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
			$title = isset($stylesheet->extra['title']) ? "title='" . esc_attr( $stylesheet->extra['title'] ) . "'" : '';

			$tag = "<link rel='stylesheet/less' id='$handle' $title href='$href' type='text/css' media='$media' />";
		}

		return $tag;
	}
	add_filter( 'style_loader_tag', 'enqueue_less_styles', 99, 2);
}

//Add LESS scripts for Customizer instant preview
if ( !function_exists('ventcamp_enqueue_less_js') ) {
	function ventcamp_enqueue_less_js() {
		global $enqueue_less;
		$enqueue_less = true;
		wp_enqueue_script( 'ventcamp-less-script', get_template_directory_uri() . '/js/less.min.js');
	}
}

if ( !function_exists('ventcamp_enqueue_less_styles') ) {
	function ventcamp_enqueue_less_styles() {
		global $enqueue_less;
		if ( $enqueue_less ) {
			wp_enqueue_style( 'less-styles', get_template_directory_uri() . '/stylesheets/less/style.less' );
		}
	}
}

if ( !function_exists('ventcamp_disable_core_plugins') ) {
    add_action('switch_theme', 'ventcamp_disable_core_plugins');

    /**
     * To prevent conflicts with other themes, ventcamp-core and ventcamp-vc-shortcodes
     * should be deactivated after theme switch.
     */
    function ventcamp_disable_core_plugins () {
		require_once VENTCAMP_PLUGIN_DIR . '/includes/plugin-manager.php';

		// Deactivate plugins, but not if switched theme is the main theme/child themes
    	if ( ! ( defined( 'THEME_NAME' ) && THEME_NAME == 'ventcamp' ) ) {
			// Init new Plugin Manager
			$plugins = new Plugin_Manager();
			// Disable them
			$plugins->deactivate_core_plugins();
		}
    }
}

function ventcamp_build_custom_posts_dropdown ( $post_type, $not_found_message ) {
    // Get all posts by post type and sort them by date (descending order, newest first)
    $posts = get_posts( 'post_type="' . $post_type . '"&posts_per_page=-1&orderby=date&order=DESC' );
    // Set default value
    $list = array(
        '' => __( '(Not set)', 'ventcamp' )
    );

    // If at least one custom post is found
    if ( $posts ) {
        // Loop through the all posts and build a list
        foreach ( $posts as $post ) {
            $list[ $post->ID ] = $post->post_title;
        }
    } else {
        $list[ 0 ] = $not_found_message;
    }

    return $list;
}


add_action( 'wp_enqueue_scripts', 'ventcamp_js_variables_compile' );
add_action( 'customize_preview_init', 'ventcamp_js_variables_compile' );
add_action( 'customize_preview_init', 'ventcamp_enqueue_less_js', 0 );
add_action( 'wp_enqueue_scripts', 'ventcamp_enqueue_less_styles', 99 );
// Re-compile stylesheets after upgrade
add_action( 'upgrader_process_complete', 'ventcamp_less_compile', 10, 1 );
