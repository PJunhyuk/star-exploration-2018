<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Require base Hero class
require_once THEME_DIR . "/extensions/hero.class.php";

// Don't duplicate this class
if ( !class_exists( 'Hero_Style_3' ) ) :
    /**
     * Just a simple class, it doesn't do anything. The only setting is a custom form.
     */
    class Hero_Style_3 extends Hero {
        // Holds an instance of contact form
        protected $form_instance;
        // Holds form wrapper attributes
        protected $wrapper_attr = array();

        /**
         * Get form id and echo the form
         */
        public function form () {
            // Check if Contact Form 7 plugin is enabled
            if ( class_exists( 'WPCF7_ContactForm' ) ) {
                // Get form ID
                $id = intval( ventcamp_option( 'hero_style_3_form_select', '' ) );

                // Check if form with specified ID exist
                if ( !( $this->form_instance = wpcf7_contact_form( $id ) ) ) {
                    // Get form by title
                    $this->form_instance = wpcf7_get_contact_form_by_title( "Fast signup 1" );

                    // Something goes wrong, no forms found, return false
                    if ( !$this->form_instance ) {
                        return;
                    }
                }

                // Form shortcode
                $form = '[contact-form-7-wrapper ' .
                    'id="'                             . $this->form_instance->id() . '" ' .
                    '_wpcf7_vsc_hide_after_send="'     . ventcamp_option( 'hero_style_3_form_hide_on_submit', 0 ) . '" ' .
                    '_wpcf7_vsc_redirect_after_send="' . ventcamp_option( 'hero_style_3_form_redirect', 0 ) . '" ' .
                    '_wpcf7_vsc_redirect_url="'        . ventcamp_option( 'hero_style_3_form_redirect_url', '' ) . '" ' .
                    '_wpcf7_vsc_use_mailchimp="'       . ventcamp_option( 'hero_style_3_use_mailchimp', 0 ) . '" ' .
                    '_wpcf7_vsc_double_opt="'          . ventcamp_option( 'hero_style_3_mailchimp_double_opt_in', 0 ) . '" ' .
                    '_wpcf7_vsc_mailchimp_list_id="'   . ventcamp_option( 'hero_style_3_mailchimp_list_id', '' ) . '"' .
                    ']';

                // Echo the resulted HTML code
                echo do_shortcode( $form );
            }
        }

        /**
         * Wrap form in bootstrap columns (can be set in settings)
         */
        public function form_wrapper_attr () {
            // Take the width of the form from settings
            $form_width = intval( ventcamp_option( 'hero_style_3_form_width', 6 ) );
            // If it's a valid form width
            if ( $form_width >= 1 && $form_width <= 12 ) {
                // Set column class for wrapper
                $this->wrapper_attr['class'][] = 'col-sm-' . $form_width;
            }

            // Take the form offset from settings
            $form_offset = intval( ventcamp_option( 'hero_style_3_form_offset', 3 ) );
            // If it's a valid offset
            if ( $form_offset >= 1 && $form_offset <= 12 ) {
                // Set column offset class for wrapper
                $this->wrapper_attr['class'][] = 'col-sm-offset-' . $form_offset;
            }

            return Tags::generate_tag_attributes( $this->wrapper_attr );
        }
    }
endif;