<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Require base Hero class
require_once THEME_DIR . "/extensions/hero.class.php";

// Don't duplicate this class
if ( !class_exists( 'Hero_Style_4' ) ) :
    class Hero_Style_4 extends Hero {
        /**
         * Override parent's method and remove centering of the content
         *
         * @param string $classes Additional classes to be used
         *
         * @return string Section attributes
         */
        public function get_section_attr( $classes = '' ) {
            // Set base section class
            $this->section_attr['class'][] = 'hero-section';
            $this->section_attr['class'][] = $classes;

            // Get params from settings
            $fullheight = ventcamp_option( 'hero_fullheight', true );
            $centering  = ventcamp_option( 'hero_verticalcentring', true );

            // Full height is set?
            if ( $fullheight ) {
                $this->section_attr['class'][] = "window-height";
            }

            // Vertical centering is set?
            if ( $centering ) {
                $this->section_attr['class'][] = "center-content";
            }

            // Set hero block background
            $this->set_background();

            return Tags::generate_tag_attributes( $this->section_attr );
        }

        /**
         * Show buttons depending on settings, could be 2, 1 or 0 buttons
         */
        public function buttons () {
            // Get amount of buttons from settings (could be 2, 1 or 0 buttons)
            $amount = intval( ventcamp_option( 'hero_style_4_buttons', '2' ) );
            $class  = $amount == 2 ? 'btn-md' : 'btn-lg';

            if ( $amount == 1 || $amount == 2 ) : ?>
                <div class="btns-container">
                    <?php
                    $this->main_button( $class );

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
            $action = ventcamp_option( 'hero_style_4_button_action', 'link' );
            // Make button link
            $link = $this->link(
                $action,                           // Button action (link or popup)
                'hero_style_4_button_link',        // Button link URL (if link)
                'hero_style_4_button_popup',       // Button link to popup (if popup)
                'hero_style_4_button_target_blank' // Open button link in another tab?
            ); ?>

            <a <?php echo $link; ?> class="btn <?php echo $class; ?>">
                <?php esc_html_e( ventcamp_option( 'hero_style_4_button_text', 'Watch trailer' ) ); ?>
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
            $action = ventcamp_option( 'hero_style_4_alt_button_action', 'link' );
            // Make button link
            $link = $this->link(
                $action,                               // Button action (link or popup)
                'hero_style_4_button_alt_link',        // Button link URL (if link)
                'hero_style_4_button_alt_popup',       // Button link to popup (if popup)
                'hero_style_4_button_alt_target_blank' // Open button link in another tab?
            ); ?>

            <a <?php echo $link; ?> class="btn btn-alt <?php echo $class; ?>">
                <?php esc_html_e( ventcamp_option( 'hero_style_4_button_alt_text', 'Get Tickets' ) ); ?>
            </a>

            <?php
        }

        /**
         * Get image src from settings and
         */
        public function img () {
            // Get img src from settings
            $src = ventcamp_option( 'hero_style_4_left_image', IMAGESPATH_URI . 'speaker.jpg' );
            // Get image action
            $action = ventcamp_option( 'hero_style_4_left_image_action', 'link' );
            // Image link
            $link = $this->link(
                $action,                               // Image action (link or popup)
                'hero_style_4_left_image_link',        // Image link URL (if link)
                'hero_style_4_left_image_popup',       // Image link to popup (if popup)
                'hero_style_4_left_image_target_blank' // Open image link in another tab?
            );

            // Only if image is set
            if ( !empty( $src ) ) : ?>

                <div class="hero-img">
                    <a <?php echo $link; ?>>
                        <img src="<?php echo $src ?>" alt="" />
                        <?php $this->icon(); ?>
                    </a>
                </div>

            <?php
            endif;
        }

        /**
         * Show an icon if it's enabled in settings
         */
        public function icon () {
            // If icon is enabled
            if ( ventcamp_option( 'hero_style_4_show_icon', 'off' ) == 'on' ) {
                // Init array with icon attributes
                $icon_attr = array();
                // Set base icon class
                $icon_attr['class'] = 'icon';
                // Get icon src from settings
                $src = ventcamp_option( 'hero_style_4_icon_image', IMAGESPATH_URI . 'playbutton.png' );

                // Set background image
                $icon_attr['style']['background-image'] = 'url(' . $src . ')';

                // Get icon size
                @list($width, $height) = getimagesize( $src );
                // Set adjusted top position for the icon
                $icon_attr['style']['left'] = 'calc(50% - ' . round( $width / 2 ) . 'px)';
                // Set adjusted left position for the icon
                $icon_attr['style']['top'] = 'calc(50% - ' . round( $height / 2 ) . 'px)';

                // Echo the result
                echo '<span ' . Tags::generate_tag_attributes( $icon_attr ) . '></span>';
            }
        }
    }
endif;