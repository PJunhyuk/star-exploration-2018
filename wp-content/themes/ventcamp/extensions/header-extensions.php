<?php

defined('ABSPATH') or die('No direct access');

// Require Site_Logo class
require_once "site-logo.class.php";

// Check if LESS Debug is on, to instantly regenerate styles from LESS on each page reload
if ( VENTCAMP_LESS_COMPILE_DEBUG == true ){
    add_action( 'after_setup_theme', 'ventcamp_less_compile' );
} else {
    add_action( 'customize_save_after', 'ventcamp_less_compile', 99 );
}

if( !function_exists('ventcamp_custom_inline_styles') ) {
	/**
	 * Return a custom CSS code, defined in theme options.
	 *
	 * @return string Returns a custom CSS defined by user
	 */
	function ventcamp_custom_inline_styles() {
		$global_css = ventcamp_option( 'customcode_global_css', '' );
		$tablet_css = ventcamp_option( 'customcode_tablet_css', '' );
		$phone_css  = ventcamp_option( 'customcode_phone_css', '' );

		// If no custom code is defined, return
		if ( empty( $global_css ) && empty( $tablet_css ) && empty( $phone_css ) ) {
			return '';
		}

		// Add global CSS to output
		$output = $global_css;

		// If we have custom CSS code for tablets
		if( !empty( $tablet_css ) ) {
			$output .= '@media (max-width: 992px) {';
			$output .=     $tablet_css;
			$output .= '}';
		}

		// If we have custom CSS code for phones
		if( !empty( $phone_css ) ) {
			$output .= '@media (max-width: 767px) {';
			$output .=     $phone_css;
			$output .= '}';
		}

		return $output;
	}
}

if( !function_exists('ventcamp_enqueue_styles') ) {
    /**
     * Enqueue Ventcamp styles
     */
    function ventcamp_enqueue_styles() {
        // Register our styles
        wp_register_style( 'font-awesome',  THEME_URI . '/stylesheets/lib/font-awesome.min.css' );
        wp_register_style( 'bootstrap',     THEME_URI . '/stylesheets/lib/bootstrap.min.css', array( 'font-awesome' ) );
        wp_register_style( 'font-lineicons',THEME_URI . '/stylesheets/lib/font-lineicons.css' );
        wp_register_style( 'toastr',        THEME_URI . '/stylesheets/lib/toastr.min.css' );

        // Relative path to the theme style file
        $style_path = "/stylesheets/css/theme-style.css";
        // Add last modification date as version to bypass caching
        $last_modification = date( "ymd-Gis", filemtime( THEME_DIR . $style_path ) );

        // Set bootstrap and other styles as dependencies
        wp_register_style( 'ventcamp-style',THEME_URI . $style_path, array ( 'bootstrap', 'font-lineicons', 'toastr' ), $last_modification );
        wp_enqueue_style( 'ventcamp-style' );

        // Add an inline CSS to 'ventcamp-style'
	    wp_add_inline_style( 'ventcamp-style', ventcamp_custom_inline_styles() );
    }

    add_action('wp_enqueue_scripts', 'ventcamp_enqueue_styles', 50);
}

if( !function_exists('ventcamp_check_if_less_compiled') ) {
    /**
     * Check if needed CSS files exist, create them if not
     */
    function ventcamp_check_if_less_compiled(){
        // If one of the files does not exist
        if( !file_exists( get_template_directory() . '/stylesheets/css/theme-style.css' ) ||
            !file_exists( get_template_directory() . '/stylesheets/css/admin-style.css' ) ||
            !file_exists( get_template_directory() . '/stylesheets/css/ventcamp-fonts.css' ) ) {
            ventcamp_less_compile(); //re-create new LESS files
        }
    }
}
add_action( 'wp_enqueue_scripts', 'ventcamp_check_if_less_compiled', 100, 0);

if( !function_exists('ventcamp_hero_block') ) {
    /**
     * Show hero block before or after menu
     *
     * @param string $position Position of the hero block - before or after menu
     */
    function ventcamp_hero_block( $position = 'after' ){
        // Default hero_display option
        $default = '1';

        // Is hero block enabled in settings?
        $show_hero = (intval(ventcamp_option('hero_display', $default)) == 1 && is_front_page()) ||
                      intval(ventcamp_option('hero_display', $default)) == 2;

	    if( $show_hero && ventcamp_option('hero_menu_position', 'after') == $position ) {
	        get_template_part( 'content', 'hero' );
	    }
    }
}

if ( !function_exists('ventcamp_link_to_menu_editor') ) {
    /**
     * Menu fallback. Link to the menu editor if that is useful.
     *
     * @param array $args Array of arguments
     * @see wp-includes/nav-menu-template.php for available arguments
     *
     * @return string|bool Link to the editor
     */
    function ventcamp_link_to_menu_editor ( $args ) {
        // Only privileged users can see 'add a menu' link
        if ( !current_user_can( 'manage_options' ) ) {
            return false;
        }

        // Extract all arguments into variables
        extract( $args );

        // Link to menu editor
        $link = $link_before . '<a href="' . admin_url( 'nav-menus.php' ) . '">' . $before . __( 'Add a menu', 'ventcamp' ) . $after . '</a>' . $link_after;
        // Wrap link in <li> tag
        $link = "<li>$link</li>";

        // Make a formatted string, wrapper in specified tag with menu id and menu class
        $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );

        // Only if container is not empty
        if ( !empty( $container ) ) {
            $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
        }

        // If echo flag is set
        if ( $args['echo'] ) {
            echo $output;
        }

        return $output;
    }
}

if ( !function_exists('ventcamp_header_menu') ) {
    /**
     * Show menu in header, if menu is enabled in settings
     */
    function ventcamp_header_menu () {
        // Default value for header_format_style
        $default = 'logo_menu_button';
        $header_format = explode("_", ventcamp_option( 'header_format_style', $default ));

        if( in_array('menu', $header_format) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'navigation-list pull-left',
                'echo' => true,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 2,
                'fallback_cb' => 'ventcamp_link_to_menu_editor',
            ));
        }
    }
}

if ( !function_exists('ventcamp_header_logo') ) {
    /**
     * Check type of the logotype (text or image) and if a custom image is set, use it
     */
    function ventcamp_header_logo () {
        $logo = new Site_Logo();
        $logo->render();
    }
}

if ( !function_exists( 'ventcamp_header_button' ) ) {
    function ventcamp_header_button () {
        $header_format = explode( "_", ventcamp_option( 'header_format_style', 'logo_menu_button' ) );
        $button_text   = ventcamp_option( 'header_button_text', 'Buy Tickets' );
        $button_link   = ventcamp_option( 'header_button_link', '#' );

        if( in_array('button', $header_format) ): ?>
            <a href="<?php echo $button_link; ?>" class="pull-right btn-alt btn-sm buy-btn">
                <?php echo $button_text; ?>
            </a>
        <?php endif;
    }
}

if ( !function_exists('ventcamp_enqueue_admin_scripts') ) {
    /**
     * Load theme Admin scripts
     */
    function ventcamp_enqueue_admin_scripts() {
        // Load Theme admin scripts
        wp_enqueue_style( 'ventcamp-admin-style',        THEME_URI . '/stylesheets/css/admin-style.css');
        wp_enqueue_style( 'ventcamp-admin-woocommerce',  THEME_URI . '/stylesheets/ventcamp-admin.css');
    }
}

add_action('admin_enqueue_scripts', 'ventcamp_enqueue_admin_scripts');