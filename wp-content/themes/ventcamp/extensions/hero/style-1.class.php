<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Require base Hero class
require_once THEME_DIR . "/extensions/hero.class.php";

// Don't duplicate this class
if ( !class_exists( 'Hero_Style_1' ) ) :
    class Hero_Style_1 extends Hero {
        /**
         * Show buttons depending on settings, could be 2, 1 or 0 buttons
         */
        public function buttons () {
            // Get amount of buttons from settings (could be 2, 1 or 0 buttons)
            $amount = intval( ventcamp_option( 'hero_style_1_buttons', '2' ) );
            // Set button size,
            $class  = $amount == 2 ? 'btn-md' : 'btn-lg';

            if ( $amount == 1 || $amount == 2 ) : ?>
                <div class="btns-container">
                    <?php
                    // Show the main button
                    $this->main_button( $class );

                    // If two buttons set, show the second one
                    if( $amount == 2) {
                        $this->alt_button( $class );
                    }
                    ?>
                </div>
            <?php endif;
        }

        /**
         * Helper function, returns required link:
         *
         * $action:
         *      'link' - link to an external website
         *      'popup' - open popup box on click
         *
         * @param string $action Link action, it could open an external website or show a popup
         * @param string $target_url Option name that keeps target url
         * @param string $target_popup Option name that keeps popup ID
         * @param string $blank Option name that keeps target="_blank" setting
         *
         * @return string Resulted link
         */
        protected function link ( $action, $target_url, $target_popup, $blank ) {
            // Declare our link
            $link = '';

            // Type of the link: external website/page or popup box
            switch ( $action ) {
                // External website
                case 'link' :
                    // Get the value of target=_blank setting (disabled by default)
                    $target = ventcamp_option( $blank, 0 ) ? 'target="_blank"' : '';
                    $link = 'href="' . esc_url( ventcamp_option( $target_url, '#' ) ) . '" ' . $target;
                    break;

                // Popup box
                case 'popup' :
                    // Pass popup ID to data-modal-link attribute
                    $link = 'href="#" ' . 'data-modal-link="vivaco-' . esc_attr( ventcamp_option( $target_popup, '' ) ) . '"';
                    break;
            }

            // Return the result
            return $link;
        }

        /**
         * Render the main button with specified settings
         *
         * @param string $class Additional button class (if needed)
         */
        public function main_button ( $class = '' ) {
            // Get button action (could be whether link or popup)
            $action = ventcamp_option( 'hero_style_1_button_action', 'link' );

            // Make button link
            $link = $this->link(
                $action,                           // Button action (link or popup)
                'hero_style_1_button_link',        // Button link URL (if link)
                'hero_style_1_button_popup',       // Button link to popup (if popup)
                'hero_style_1_button_target_blank' // Open button link in another tab?
            );
            // Get the text of the button
            $text = ventcamp_option( 'hero_style_1_button_text', 'Watch trailer' ); ?>

            <a <?php echo $link; ?> class="btn <?php echo $class; ?>">
                <?php esc_html_e( $text ); ?>
            </a>

            <?php
        }

        /**
         * Render the alt button with specified settings
         *
         * @param string $class Additional class (if needed)
         */
        public function alt_button ( $class = '' ) {
            // Get button action (could be whether link or popup)
            $action = ventcamp_option( 'hero_style_1_alt_button_action', 'link' );

            // Make button link
            $link = $this->link(
                $action,                               // Button action (link or popup)
                'hero_style_1_button_alt_link',        // Button link URL (if link)
                'hero_style_1_button_alt_popup',       // Button link to popup (if popup)
                'hero_style_1_button_alt_target_blank' // Open button link in another tab?
            );
            // Get the text of the button
            $text = ventcamp_option( 'hero_style_1_button_alt_text', 'Get Tickets' ); ?>

            <a <?php echo $link; ?> class="btn btn-alt <?php echo $class; ?>">
                <?php esc_html_e( $text ); ?>
            </a>

            <?php
        }
    }
endif;