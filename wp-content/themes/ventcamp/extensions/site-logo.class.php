<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate this class
if ( !class_exists( 'Site_Logo' ) ) :
    class Site_Logo {

        // Stores current logo attributes
        public $logo = array();
        // URL to the retina image
        private $retina;
        // Type of the logo: image or text
        private $logo_type;

        /**
         * Site_Logo constructor.
         */
        public function __construct() {
            /*
             * A workaround for empty() function to prevent fatal error:
             * Can't use function return value in write context
             *
             * Read more: http://stackoverflow.com/questions/1075534/cant-use-method-return-value-in-write-context
             */
            $type = ventcamp_option('logotype_type');

            // Set logo type (trim empty strings)
            $this->logo_type = !empty( $type ) ? $type : 'image';

            /* If logotype is an image, prepare img src and other attributes */
            if ( $this->logo_type == 'image' ) {
                $this->set_logo_sources();
                $this->generate_attr();
            }
        }

        /**
         * Set image src for normal logo and for retina version
         */
        private function set_logo_sources() {
            // Get link to the image
            $image  = ventcamp_option('logotype_image');
            // Get link to retina image
            $retina = ventcamp_option('logotype_image_retina');

            // Use the same logo for main menu and sticky menu, if sticky logo is not set
            if ( !empty($image) && empty($retina) ) {
                $this->retina = $this->logo['src'] = $image;
            } else {
                $this->logo['src'] = !empty($image) ? $image : IMAGESPATH_URI . 'ventcamp_logo.png';
                $this->retina = !empty($retina) ? $retina : IMAGESPATH_URI . 'ventcamp_logo@2x.png';
            }
        }

        /**
         * Generate srcset attribute to make logo responsive, multiplier 2x used by default for retina displays
         */
        private function generate_srcset() {
            // Default multiplier for retina displays
            $multiplier = 2;
            // If retina image exist
            if ( $this->retina !== false ) {
                $this->logo['srcset'] = sprintf( '%s %dx', $this->retina, $multiplier );
            }
        }

        /**
         * Add width and height attributes for logo image
         */
        private function generate_width_and_height() {
            if( ini_get('allow_url_fopen') ) {
                // Lucky me, URL fopen is enabled
                @list($this->logo['width'], $this->logo['height']) = getimagesize( $this->logo['src'] );
            } else if ( in_array( 'curl', get_loaded_extensions() ) &&
                        in_array( 'gd',   get_loaded_extensions() ) ) {
                // URL fopen is disabled, use curl instead
                $raw = $this->ranger( $this->logo['src'] );
                $image = imagecreatefromstring( $raw );

                // Get image width and height
                $this->logo['width'] = imagesx( $image );
                $this->logo['height'] = imagesy( $image );
            }

            // Don't add any sizes if we can't get the image
        }

        /**
         * Helper function to get image header using curl
         *
         * @param string $url URL to the image
         *
         * @return mixed The first 32kb of image
         */
        private function ranger( $url ) {
            // Load only the first 32kb
            $headers = array(
                "Range: bytes=0-32768"
            );

            // Init curl and set base settings
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);
            curl_close($curl);

            return $data;
        }

        /**
         * Generate alt tag for img tag
         */
        private function generate_alt_tag() {
            $this->logo['alt'] = get_bloginfo('name');
        }

        /**
         * Generate attributes for img tag, such as src, width, height and srcset
         */
        private function generate_attr() {
            $this->generate_srcset();
            $this->generate_width_and_height();
            $this->generate_alt_tag();
        }

        /**
         * Echo the resulting img tag
         */
        public function img() {
            // Only if image is set
            if ( !empty( $this->logo['src'] ) ) {
                // Begin of img tag
                $tag = '<img ';

                /*
                 * Loop through the all attributes and assign a value
                 *
                 * For example:
                 * src="http://example.com/path/to/image.png"
                 * width="600"
                 * height="500"
                 *
                 */
                foreach ( $this->logo as $key => $value ) {
                    $tag .= $key . '="' . $value . '" ';
                }

                // End of img tag
                $tag .= "/>";

                echo $tag;

                // Add polyfill support for srcset
                $this->enqueue_scripts();
            }
        }

        /**
         * Enqueue polyfill script.
         */
        public function enqueue_scripts() {
            wp_enqueue_script( 'picturefill', SCRIPTSPATH_URI . 'lib/picturefill.min.js', false, false, true );
        }

        /**
         * Echo the text instead of image
         */
        public function text() {
            echo esc_attr( ventcamp_option('logotype_text') );
        }

        /**
         * Render the logo, depending on user settings
         */
        public function render() {
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php
                /* If logotype is a text */
                if ( $this->logo_type == 'text' ) {
                    $this->text();
                /* If logotype is an image */
                } elseif ( $this->logo_type == 'image' ) {
                    $this->img();
                }
                ?>
            </a>
            <?php
        }
    }
endif;