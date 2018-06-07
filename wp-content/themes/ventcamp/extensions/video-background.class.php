<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Require core Tags class
require_once get_template_directory() . "/extensions/core/tag_generator.class.php";

// Don't duplicate this class
if ( !class_exists( 'Video_Background' ) ) :
    /**
     * Helper class, adds data-* properties to container and enqueue scripts to play video in background.
     */
    class Video_Background {
        // Array of properties to pass to jquery.mb.ytplayer
        public $ytplayer_properties = array();
        // Array of background attributes, such as controls, autoplay, mute and so on
        public $bg_attributes = array();
        // Variable to store video settings
        protected $video_settings = array();
        // Set default video settings
        protected $default_args = array(
            "controls"    => "none",  // Add controls?
            "mute"        => false, // Mute video by default?
            "autoplay"    => false, // Play video automatically?
	        "loop"        => false  // Play video in loop
        );

        /**
         * Video_Background constructor.
         *
         * @param array $args An array of arguments for class constructor.
         */
        public function __construct( array $args = array() ) {
            // Only if URL and containment are set
            if ( ( isset( $args['url'] ) && !empty( $args['url'] ) ) &&
                 ( isset( $args['containment'] ) && !empty( $args['containment'] ) ) ) {
                // Default params for ytplayer, can be overridden later
                $this->ytplayer_properties = array(
	                "fitToBackground"   => true,
                    "realfullscreen"    => true,
                    "stopMovieOnBlur"   => false,
                    "addRaster"         => true,
                    "showControls"      => false, // Don't show controls
                    "startAt"           => 0,     // Start video from the beginning
                    "opacity"           => 1,     // No transparency at all
                    "gaTrack"           => false
                );

                // Merge new args with default video settings
                $this->video_settings = array_replace_recursive( $this->default_args, $args );

                $this->set_data_tags();
            }
        }

        /**
         * If controls are set to true, then enqueue ui-slider
         */
        public function enqueue_slider_for_controls () {
            // If checkbox 'Add video controls' is set
            if ( $this->video_settings['controls'] != 'none' ) {
                $this->enqueue_slider();
            }
        }

        /**
         * Generate JSON-formatted list of properties that will be assigned to 'data-property' attribute
         * and used by YTPlayer
         */
        protected function generate_ytplayer_data_property () {
            // Assign values to ytplayer properties array
            $this->ytplayer_properties['containment'] = $this->video_settings['containment'];
            $this->ytplayer_properties['videoURL']    = $this->video_settings['url'];
            $this->ytplayer_properties['mute']        = $this->video_settings['mute'];
            $this->ytplayer_properties['autoPlay']    = $this->video_settings['autoplay'];
	        $this->ytplayer_properties['loop']        = $this->video_settings['loop'];

            /*
             * Generate JSON-formatted list of properties with unescaped slashes
             *
             * For example:
             * {
             *   videoURL: 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
             *   realfullscreen: true,
             *   showControls: false,
             * }
             *
             */
            $data = json_encode( $this->ytplayer_properties, JSON_UNESCAPED_SLASHES );

            // Assign generated data to bg_attributes array
            $this->bg_attributes['data-property'] = $data;
        }

        /**
         * Generate resulted data-* tags
         */
        protected function set_data_tags () {
            // Get video background settings and set all the variables
            $this->enqueue_slider_for_controls();
            $this->generate_ytplayer_data_property();

            // Assign generated data to bg_attributes array
            $this->bg_attributes['data-video-url']  = $this->video_settings['url'];
            $this->bg_attributes['data-controls']   = $this->video_settings['controls'];
            $this->bg_attributes['data-mute']       = var_export( $this->video_settings['mute'], true ); // Convert bool to string
            $this->bg_attributes['data-autoplay']   = var_export( $this->video_settings['autoplay'], true ); // Convert bool to string

            $this->enqueue_video_background_scripts();
        }

        /**
         * Convert array of tags to string and return the result
         *
         * @return string Data tags in string format
         */
        public function get_data_tags () {
            return Tags::generate_tag_attributes( $this->bg_attributes );
        }

        /**
         * Enqueue UI-slider script.
         */
        protected function enqueue_slider () {
            wp_enqueue_script( 'ui-slider', SCRIPTSPATH_URI . '/lib/jquery-ui-slider.min.js', array('jquery'), false, true);
        }

        /**
         * Enqueue our custom script with video settings and YTPlayer script,
         * an open source jQuery component to play youtube video in background.
         */
        protected function enqueue_video_background_scripts () {
            // Enqueue ytplayer's script
            wp_enqueue_script( 'youtube-video-bg', SCRIPTSPATH_URI . '/lib/jquery.mb.YTPlayer.min.js', array('jquery'), false, true );
            wp_enqueue_script( 'ventcamp-video-background', SCRIPTSPATH_URI . '/ventcamp-video-background.js', array( 'jquery' ), false, true);
        }
    }
endif;