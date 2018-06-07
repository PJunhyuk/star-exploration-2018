<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Deactivate annoying Visual Composer windows
 */
add_action('vc_before_init', function(){
    if(defined('WPB_VC_VERSION')){
        $_COOKIE['vchideactivationmsg_vc11'] = WPB_VC_VERSION;
    }
});

require get_template_directory() . '/includes/lib/tgm-plugin-activation/class-tgm-plugin-activation.php';

if( !function_exists('ventcamp_theme_register_required_plugins') ) {
    /**
     * Add the TGM_Plugin_Activation class.
     */
    function ventcamp_theme_register_required_plugins() {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            array(
                'name'               => 'Ventcamp Core',
                'slug'               => 'ventcamp-core',
                'source'             => 'http://vivaco.com/ext/ventcamp-core-2.4.zip',
                'required'           => true,
                'version'            => '2.4',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),

            array(
                'name'               => 'Ventcamp Visual Composer Shortcodes',
                'slug'               => 'ventcamp-vc-shortcodes',
                'source'             => 'http://vivaco.com/ext/ventcamp-vc-shortcodes-2.4.zip',
                'required'           => true,
                'version'            => '2.4',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),

            array(
                'name'               => 'WPBakery Page Builder', // The plugin name.
                'slug'               => 'js_composer', // The plugin slug (typically the folder name).
                'source'             => 'http://vivaco.com/ext/js_composer_5.4.5.zip', // The plugin source.
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                'version'            => '5.4.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            ),
            array(
                'name'               => 'Envato Market',
                'slug'               => 'envato-market',
                'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
                'required'           => false,
                'version'            => '1.0.0-RC2',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'Contact Form 7',
                'slug'               => 'contact-form-7',
                'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.4.7.zip',
                'required'           => false,
                'version'            => '4.7',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'Flamingo',
                'slug'               => 'flamingo',
                'source'             => 'https://downloads.wordpress.org/plugin/flamingo.1.5.zip',
                'required'           => false,
                'version'            => '1.5',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'WooCommerce',
                'slug'               => 'woocommerce',
                'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.zip',
                'version'            => '3.0',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'WooCommerce FooEvents',
                'slug'               => 'fooevents',
                'source'             => 'http://vivaco.com/ext/fooevents-1.7.1.zip',
                'required'           => false,
                'version'            => '1.7.1',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      =>  esc_html__( 'Install Required Plugins', 'ventcamp' ),
                'menu_title'                      => esc_html__( 'Install Plugins', 'ventcamp' ),
                'installing'                      => esc_html__( 'Installing Plugin: %s', 'ventcamp' ), // %s = plugin name.
                'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'ventcamp' ),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ventcamp' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ventcamp' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ventcamp' ),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'ventcamp' ),
                'return'                          => esc_html__( 'Return to Required Plugins Installer', 'ventcamp' ),
                'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'ventcamp' ),
                'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'ventcamp' ), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa( $plugins, $config );
    }
}
add_action( 'tgmpa_register', 'ventcamp_theme_register_required_plugins' );
