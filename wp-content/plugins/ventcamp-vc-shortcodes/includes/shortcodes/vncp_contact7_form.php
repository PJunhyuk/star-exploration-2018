<?php

    /*-----------------------------------------------------------------------------------*/
    /*  Contact Form 7 Wrapper VC Mapping (Backend)
    /*-----------------------------------------------------------------------------------*/
    //if ( shortcode_exists( 'contact-form-7' ) ) {
    // add new own contact form 7
    // Update Contact forms, for number forms > 5
    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&posts_per_page=-1&orderby=title&order=ASC' );
    $contact_forms = array();
    if ( $cf7 ) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->ID;
        }
    } else {
        $contact_forms[__('No contact forms found', 'ventcamp')] = 0;
    }

    $params = array(
        /*
        array(
            'type' => 'textfield',
            'heading' => __( 'Form title', 'ventcamp' ),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => __( 'What text use as form title. Leave blank if no title is needed.', 'ventcamp' )
        ),*/

        array(
            'type' => 'dropdown',
            'heading' => __( 'Select contact form', 'ventcamp' ),
            'param_name' => 'id',
            'value' => $contact_forms,
            'description' => __( 'Choose previously created contact form from the drop down list.', 'ventcamp' )
        ),

        array(
            "type" => "checkbox",
            "heading" => __("Show/Hide", "ventcamp"),
            "param_name" => "_wpcf7_vsc_hide_after_send",
            "value" => array(
                __("Hide form on successful submit", "ventcamp") => "yes"
            )
        ),

        array(
            "type" => "checkbox",
            "heading" => __("Redirect/Idle", "ventcamp"),
            "param_name" => "_wpcf7_vsc_redirect_after_send",
            "value" => array(
                __("Redirect to another page on successful submit", "ventcamp") => "yes"
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Redirect url", "ventcamp"),
            "param_name" => "_wpcf7_vsc_redirect_url",
            "admin_label" => true,
            "dependency" => array(
                "element" => "_wpcf7_vsc_redirect_after_send",
                "value" => "yes"
            ),
            "description" => __("Please enter full page url with http://", "ventcamp"),
        ),
    );

    // Check if mailchimp functionality is enabled in settings or not
    $api_key = get_option('ventcamp_mailchimp_api_key', '');

    if( !$api_key ) {
        // Show an alert that user must enable Mailchimp functionality in settings
        $params[] = array(
            'param_name' => 'custom_warning1', // all params must have a unique name
            'type' => 'custom_markup', // this param type
            'heading' => __( 'MailChimp Settings', 'ventcamp' ),
            "dependency" => array(
                "element" => "_wpcf7_vsc_use_mailchimp",
                "value" => "yes"
            ),
            'value' => __( '<div class="alert alert-info">Please set "Mailchimp Api key" in Ventcamp options to use MailChimp shortcode functionality <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">Where can i find my API key?</a></div>', 'ventcamp' ), // your custom markup
        );
    } else {
        $params[] = array(
            "type" => "checkbox",
            "heading" => __("Mailchimp API", "ventcamp"),
            "param_name" => "_wpcf7_vsc_use_mailchimp",
            "value" => array(
                __("Enable Mailchimp for this form", "ventcamp") => "yes"
            )
        );

        $params[] = array(
            "type" => "textfield",
            "heading" => __("MailChimp List ID", "ventcamp"),
            "param_name" => "_wpcf7_vsc_mailchimp_list_id",
            "admin_label" => true,
            "dependency" => array(
                "element" => "_wpcf7_vsc_use_mailchimp",
                "value" => "yes"
            ),
            "description" => __("Enter MailChimp List ID here. <a href=\"http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id\" target=\"_blank\">Where can i find my List ID?</a>", "ventcamp"),
        );

        $params[] = array(
            "type" => "checkbox",
            "heading" => __("Double opt-in", "ventcamp"),
            "param_name" => "_wpcf7_vsc_double_opt",
            "dependency" => array(
                "element" => "_wpcf7_vsc_use_mailchimp",
                "value" => "yes"
            ),
            "value" => array(
                __("Enable Mailchimp Double Opt-in", "ventcamp") => "yes"
            ),
            "description" => __("What is <a href=\"http://kb.mailchimp.com/lists/signup-forms/the-double-opt-in-process\" target=\"_blank\">Double Opt-in</a> used for?", "ventcamp"),
        );
    }

    vc_map( array(
        'base' => 'contact-form-7-wrapper',
        'name' => __( 'Form Manager', 'ventcamp' ),
        'icon' => 'icon-wpb-contactform7',
        'category' => __( 'Ventcamp', 'ventcamp' ),
        'description' => __( 'Contact 7 form controls', 'ventcamp' ),
        'params' => $params
    ) );

if ( !class_exists( 'Form_Settings' ) ) {
    /**
     * Class for setting form parameters, such as integration with MailChimp, form redirect and so on.
     */
    class Form_Settings {
        // Holds shortcode attributes
        protected $options = array();
        // An array with form data
        protected $form_data = array();
        // Form token
        protected $token;

        /**
         * Form_Settings constructor.
         *
         * @param array $options An array of settings for form
         */
        function __construct( $options = array() ) {
            // Assign options
            $this->options = $options;
            // Generate token
            $this->token = wp_generate_password( 5, false, false );

            // Make an array with data
            $this->make_data();
            // Enqueue scripts and pass data to it
            $this->enqueue_scripts();
        }

        /**
         * Make an array with formatted data to pass to JS script.
         */
        protected function make_data() {
            // Get array keys
            $keys = array_keys( $this->options );
            // Generate an array with settings
            $this->form_data = array_combine(
                $keys,
                // Attach process_setting handler for each property
                array_map( array( $this, 'process_setting' ), $keys )
            );
        }

        /**
         * Format an array with setting values for our JS-script
         *
         * @param $property string Property name
         * @return bool|string Formatted value
         */
        protected function process_setting( $property ) {
            // If list ID was passed
            if ( $property == '_wpcf7_vsc_mailchimp_list_id' ) {
                return $this->options[$property];
            }

            // Encode redirect URL
            if ( $property == '_wpcf7_vsc_redirect_url' ) { // For backward compatibility
                return empty( $this->options[$property] ) ? '' : base64_encode( $this->options[$property] );
            }

            // Return true if property equals "yes" or true or "1"
            return $this->options[$property] === 'yes' ||
                   $this->options[$property] === true ||
                   $this->options[$property] === '1';
        }

        /**
         * Enqueue our custom JS-script for contact7 forms and pass settings to it
         */
        protected function enqueue_scripts () {
            // Enqueue our custom CF7 script
            wp_enqueue_script( 'ventcamp-cf7-custom', get_template_directory_uri() . '/js/ventcamp-custom-contact-form7.js', array('jquery'), false, true );
            // Pass data to script
            wp_localize_script( 'ventcamp-cf7-custom', 'vsc_custom_contact_form_7_' . $this->token, $this->form_data );
        }

        /**
         * Getter for form token
         *
         * @return string Form token
         */
        public function get_token() {
            return $this->token;
        }
    }
}

if ( !class_exists( 'Contact_Form_7_Wrapper' ) ) {
    /**
     * Class for Contact_Form_7_Wrapper
     */
    class Contact_Form_7_Wrapper {
        // Shortcode tag
        public $shortcode_tag = 'contact-form-7-wrapper';
        // Holds shortcode attributes
        public $attr = array();
        // Form token
        protected $token;

        /**
         * Contact_Form_7_Wrapper constructor.
         *
         * @param array $args Shortcode arguments
         */
        function __construct( $args = array() ) {
            // Add shortcode
            add_shortcode( $this->shortcode_tag, array( $this, 'shortcode_handler' ) );
        }

        /**
         * Handling of attributes
         *
         * @param array $attributes Array of attributes passed to shortcode
         * @param string $content Shortcode content
         *
         * @return string Result
         */
        function shortcode_handler ( $attributes , $content = null ) {
            /*
             * Get shortcode attributes
             */
            $this->attr = shortcode_atts(
                array(
                    'title'                          => '',      // Form title
                    'id'                             => '',      // Form ID
                    '_wpcf7_vsc_use_mailchimp'       => 'false', // Enable MailChimp integration?
                    '_wpcf7_vsc_mailchimp_list_id'   => '',      // MailChimp list ID
                    '_wpcf7_vsc_double_opt'          => 'false', // Enable double opt-in? (signup form + confirmation)
                    '_wpcf7_vsc_redirect_after_send' => 'false', // Redirect to another page after submit?
                    '_wpcf7_vsc_redirect_url'        => '',      // Redirect to another page after submit?
                    '_wpcf7_vsc_hide_after_send'     => 'false'  // Hide form after submit?
                ),
                $attributes
            );

            // Inject our custom title
            add_filter( 'wpcf7_form_elements', array( $this, 'title_inject' ) );
            // Generate form HTML code
            $result = $this->form();
            // Remove filter
            remove_filter( 'wpcf7_form_elements', array( $this, 'title_inject' ) );

            return $result;
        }

        /**
         * Injects our custom form title into Contact Form 7 form
         *
         * @param string $form Form code
         *
         * @return string Modified form with injected title
         */
        public function title_inject ( $form ) {
            // Wrap form into our custom wrapper
            $form = '<div class="form-content">' .
                        $this->attr['title'] . $form .
                    '</div>';

            return do_shortcode( $form );
        }

        /**
         * Select only necessary options and ignore other settings, such as title
         *
         * @return array An array with settings
         */
        protected function select_settings() {
            // Select form-specific parameters
            $form_params = array();

            // Loop through the all attributes and select only those, which we need
            foreach( $this->attr as $key => $val ) {
                // If option key starts with "_wpcf7_vsc_"
                if ( substr( $key, 0, 11 ) == '_wpcf7_vsc_' ) {
                    $form_params[$key] = $val;
                }
            }

            return $form_params;
        }

        /**
         * Wrap form into our custom wrapper and pass parameters to form.
         *
         * @return string Resulted form HTML code
         */
        public function form () {
            // Init form settings class
            $form = new Form_Settings( $this->select_settings() );

            // Wrap contact form 7 shortcode into our custom wrapper
            $output = "<div class='contact-form-7-data' data-token='{$form->get_token()}'>" .
                          "[contact-form-7 id='{$this->attr['id']}']" .
                      "</div>";

            // Execute contact form 7 shortcode
            return do_shortcode($output);
        }
    }

    // Init our class
    new Contact_Form_7_Wrapper();
}