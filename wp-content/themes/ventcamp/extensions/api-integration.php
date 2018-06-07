<?php

defined('ABSPATH') or die('No direct access');

if( !function_exists('register_ventcamp_api_page') ) {
    /**
     * Add API config page
     */
    function register_ventcamp_api_page(){
        // Add sub-menu page in the appearance menu
        add_theme_page(
            __('Ventcamp settings', 'ventcamp'), // Page title
            __( 'Ventcamp settings', 'ventcamp' ), // Menu title
            'manage_options', // Capability to manage options
            'edit_theme_options', // Menu slug
            'ventcamp_api_integrations' // Function hook
        );
    }
}
add_action( 'admin_menu', 'register_ventcamp_api_page' );

if( !function_exists('ventcamp_api_integrations') ) {
    /**
     * Add API Integrations page
     */
    function ventcamp_api_integrations(){
        // If user is trying to save options
        if('POST' === $_SERVER['REQUEST_METHOD']){
            if ( !wp_verify_nonce($_POST['_wpnonce'])) {
                wp_die( 'Nonce is invalid', 'Error');
            } else {
                update_option( 'ventcamp_mailchimp_api_key', $_POST['ventcamp_mailchimp_api_key'] );
                update_option( 'ventcamp_gmaps_api_key', $_POST['ventcamp_gmaps_api_key'] );

                //update_option( 'ventcamp_disable_preloader', $_POST['ventcamp_disable_preloader'] );
                update_option( 'ventcamp_enable_acf_fields', $_POST['ventcamp_enable_acf_fields'] );
                update_option( 'ventcamp_modals_on', $_POST['ventcamp_modals_on'] );
                //update_option( 'ventcamp_google_analytics_key', $_POST['ventcamp_google_analytics_key'] );
                //update_option( 'ventcamp_options_custom_js', $_POST['ventcamp_options_custom_js'] );
                ?>
                <div class="updated">
                    <p>
                        <strong><?php _e('Options saved.', 'ventcamp' ); ?></strong>
                    </p>
                </div>
                <?php
            }
        }

        $ventcamp_enable_acf_fields = $ventcamp_mailchimp_api_key = $ventcamp_gmaps_api_key = $ventcamp_modals_on = '';
        // Get ACF Fields setting
        $ventcamp_enable_acf_fields = get_option('ventcamp_enable_acf_fields');

        // Get mailchimp api key
        $ventcamp_mailchimp_api_key = get_option('ventcamp_mailchimp_api_key');

        // Get google maps api key
        $ventcamp_gmaps_api_key = get_option('ventcamp_gmaps_api_key');

        // Get google maps api key
        $ventcamp_modals_on = get_option('ventcamp_modals_on');

        ?>
        <div class='wrap'>
            <h2><?php esc_html_e( 'Ventcamp Settings', 'ventcamp' ); ?></h2>

            <form method="post" action="<?php echo str_replace('%7E', '~', esc_url($_SERVER['REQUEST_URI']));?>">
                <?php wp_nonce_field(); ?>

                <table class="form-table">
                    <tbody>
   
                        <tr valign="top">
                            <th scope="row">
                                <label for="ventcamp_enable_acf_fields"><?php _e( 'Disable Vivaco Modals', 'ventcamp' ) ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name='ventcamp_modals_on' id="ventcamp_modals_on" value='1' <?php checked( $ventcamp_modals_on, '1' ); ?>>
                                 <p class="description">
                                     <?php _e( '', 'ventcamp') ?>
                                     <?php printf( __( 'Check to disable Vivaco Modals plugin in case it conflicts with your other options <a target="_blank" href="%s">Vivaco Modals</a>.', 'ventcamp' ), 'http://ventcampwp.com/docs/#document-5' ) ?>
                                 </p>
                            </td>
                        </tr>                          

                        <tr valign="top">
                            <th scope="row">
                                <label for="ventcamp_enable_acf_fields"><?php _e( 'Enable ACF Fields Admin', 'ventcamp' ) ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name='ventcamp_enable_acf_fields' id="ventcamp_enable_acf_fields" value='1' <?php checked( $ventcamp_enable_acf_fields, '1' ); ?>>
                                 <p class="description">
                                     <?php _e( '', 'ventcamp') ?>
                                     <?php printf( __( 'Check to enable ACF Pro Admin interface where you can add Custom Post Types or edit current ones like Speakers/Sponsors/Schedule <a target="_blank" href="%s">Enabling ACF Pro Admin</a>.', 'ventcamp' ), 'http://ventcampwp.com/docs/#document-5' ) ?>
                                 </p>
                            </td>
                        </tr>                        

                        <tr valign="top">
                            <th scope="row">
                                <label for="ventcamp_mailchimp_api_key"><?php _e( 'Mailchimp API key', 'ventcamp' ) ?></label>
                            </th>
                            <td>
                                 <input type="text" name='ventcamp_mailchimp_api_key' id="ventcamp_mailchimp_api_key" value='<?php echo $ventcamp_mailchimp_api_key;?>' size='45'>
                                 <p class="description"><?php printf( __( 'This API key grant full access to your MailChimp account, read more about API keys in <a target="_blank" href="%s">MailChimp official documentation</a>.', 'ventcamp' ), 'http://kb.mailchimp.com/integrations/api-integrations/about-api-keys' ) ?></p>
                            </td>
                        </tr>                         

                          <tr valign="top">
                            <th scope="row">
                                <label for="ventcamp_gmaps_api_key"><?php _e( 'Google Maps API key', 'ventcamp' ) ?></label>
                            </th>
                            <td>
                                 <input type="text" name='ventcamp_gmaps_api_key' id="ventcamp_gmaps_api_key" value='<?php echo $ventcamp_gmaps_api_key;?>' size='45'>
                                 <p class="description"><?php printf( __( 'Google don\'t support keyless access, read more about how to obtain this key in <a target="_blank" href="%s">our documentation</a>.', 'ventcamp' ), 'http://ventcampwp.com/docs/#document-5' ) ?></p>
                            </td>
                        </tr>         

                    </tbody>
                </table>

                <input type="submit" class='button-primary' value="<?php _e( 'Save options', 'ventcamp' ); ?>">
            </form>

        </div>
        <?php
    }
}
