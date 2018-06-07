<?php

defined('ABSPATH') or die('No direct access');

if ( !function_exists('ventcamp_page_wrapper_start') ) {
    /**
     * Start of the page wrapper
     */
    function ventcamp_page_wrapper_start() {
        // Only for Tickera plugin pages
        if ( ventcamp_is_tickera_page() ) {
            $container = 'container tickera-container';
        // Only for EventEspresso plugin pages
        } elseif ( ventcamp_is_eespresso_page() ) {
            $container = 'container eespresso-container';
        // Only if woocommerce plugin is active
        } elseif ( class_exists( 'WooCommerce' ) ) {
            if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
                $container = 'container';
            } else {
                $container = 'container-fluid';
            }
        } else {
            $container = 'container-fluid';
        } ?>

        <div class="<?php printf( $container ); ?>">
	        <div class="content" role="main">
        <?php
    }
}

if ( !function_exists('ventcamp_page_wrapper_end') ) {
    /**
     * End of the page wrapper
     */
    function ventcamp_page_wrapper_end() {
        ?>
		    </div>
        </div>
        <?php
    }
}

if( !function_exists('ventcamp_social_links') ) {
    /**
     * Add social links.
     *
     * @return mixed HTML code for social links.
     */
    function ventcamp_social_links() {
        // Default links, used as fallback
        $default =  array(
            array( 'type' => 'facebook',  'url' => 'http://facebook.com' ),
            array( 'type' => 'twitter',   'url' => 'http://twitter.com' ),
            array( 'type' => 'google',    'url' => 'http://google.com' ),
            array( 'type' => 'instagram', 'url' => 'http://instagram.com' )
        );

        // Get the list of social links
        $social_links = (array) ventcamp_option( 'footer_social', $default );

        // Get the list of social links
        if ( isset( $social_links ) && !empty( $social_links ) ) : ?>
            <ul class="socials-nav align-right">
                <?php foreach ( $social_links as $social_link ) { ?>
                    <li class="socials-nav-item">
                        <a href="<?php echo esc_url( $social_link['url'] ); ?>" target="_blank">
                            <span class="fa fa-<?php echo esc_attr( $social_link['type'] ); ?>"></span>
                        </a>
                    </li>
                <?php }; ?>
            </ul>
        <?php endif;
    }
}

if ( !function_exists('ventcamp_short_title') ) {
    /**
     * Ventcamp title shortening function
     *
     * @param string $text Title string
     * @param int $chars_limit Maximum amount of characters
     *
     * @return string Shortened title
     */
    function ventcamp_short_title($text, $chars_limit = 30) {
        // Text is not specified, return false
        if ( empty($text) ) {
            return false;
        }

        // Change to the number of characters you want to display
        $chars_text = strlen($text);
        $text = $text . " ";
        $text = substr($text, 0, $chars_limit);
        $text = substr($text, 0, strrpos($text, ' '));

        // If current amount of characters is bigger than allowed amount,
        // Add "..." to the end
        if ($chars_text > $chars_limit){
            $text = $text . "...";
        }

        return $text;
    }
}

if ( !function_exists('ventcamp_get_post_title') ) {
    /**
     * Return the post title if post exist and limit the title to $max_chars
     *
     * @param WP_Post $post Post object
     * @param int $max_chars Maximum amount of characters
     *
     * @return bool False if $post isn't specified
     */
    function ventcamp_get_post_title ( $post, $max_chars = 50 ) {
        // Return false if $post isn't set
        if ( empty($post) ) {
            return false;
        }

        // Check if title is set
        if ( !$post_title = get_the_title($post) ) {
            // Title is not set, set title to (Untitled)
            $post_title = _x('(Untitled)', 'Default title for untitled posts', 'ventcamp');
        }

        return ventcamp_short_title( $post_title, $max_chars );
    }
}

if ( !function_exists('ventcamp_post_navigation') ) {
    /**
     * This function is used only inside the post loop.
     * It displays the link to the next post and to the previous post.
     */
    function ventcamp_post_navigation () {
        // Get the previous post
        $prev_post = get_previous_post();
        // Get the next post
        $next_post = get_next_post();

        // Get post title of the previous post
        $prev_post_title = ventcamp_get_post_title( $prev_post );
        // Get post title of the next post
        $next_post_title = ventcamp_get_post_title( $next_post );
        ?>
        <!--navigation start-->
            <div class="entry-navigation clearfix">
				<?php
					previous_post_link('<div class="prev-post"><i class="icon icon-arrows-03"></i>%link</div>', $prev_post_title);
					next_post_link('<div class="next-post">%link<i class="icon icon-arrows-04"></i></div>', $next_post_title);
				?>
            </div>
        <!--end navigation-->
        <?php
    }
}

if ( !function_exists('ventcamp_excerpt_more') ) {
    /**
     * Add custom button to Read more
     *
     * @param string $more A custom 'read more' text
     *
     * @return string Resulted link to the full article
     */
    function ventcamp_excerpt_more( $more ) {
        return '<a class="btn btn-alt btn-sm read-more" href="'. get_permalink() . '">' . __( 'Read more', 'ventcamp' ) . '</a>';
    }

    add_filter( 'the_content_more_link', 'ventcamp_excerpt_more' );
}

if ( !function_exists('ventcamp_is_tickera_page') ) {
    /**
     * Checks if current page is Tickera page
     *
     * @return boolean
     */
    function ventcamp_is_tickera_page() {
        if ( class_exists( 'TC' ) ) {
            $postType = get_post_type();
            $postSlug = get_post_field( 'post_name', get_post() );
            $tickeraSlugs = array(
                'tc_events',
                'tickets-cart',
                'tickets-payment',
                'tickets-order-confirmation',
                'tickets-order-details'
            );
            return ( ($postType == 'tc_events') || in_array($postSlug, $tickeraSlugs) );
        } else {
            return false;
        }
    }
}

if ( !function_exists('ventcamp_is_eespresso_page') ) {
    /**
     * Checks if current page is EventEspresso page
     *
     * @return boolean
     */
    function ventcamp_is_eespresso_page() {
        if ( class_exists( 'EE_Base' ) ) {
            $postType = get_post_type();
            $postSlug = get_post_field( 'post_name', get_post() );
 
            $tickeraSlugs = array(
                'registration-checkout', 
                'thank-you', 
            );
            return ( ($postType == 'espresso_events') || in_array($postSlug, $tickeraSlugs) );
        } else {
            return false;
        }
    }
}

if ( !function_exists('ventcamp_post_thumbnail') ) {
    /**
     * Get post thumbnail by ID and resize with required width and height.
     * If aq_resize() fails to create an image, use post thumbnail
     *
     * @param int $post_id ID of the post
     * @param int $width Width of the thumbnail
     * @param int $height Height of the thumbnail
     * @param bool $crop Will image be cropped or not
     */
    function ventcamp_post_thumbnail( $post_id, $width = VENTCAMP_BLOG_IMAGE_LARGE_W, $height = VENTCAMP_BLOG_IMAGE_LARGE_H, $crop = true ) {
        $thumb = get_post_thumbnail_id( $post_id );
        // Get full URL to image
        $img_url = wp_get_attachment_url( $thumb );

        // If post has thumbnail
        if ( $img_url ) {
            // Resize & crop the image if needed
            $aq_image = aq_resize( $img_url, $width, $height, $crop );
            // Check if Aqua Resizer failed, then use our thumbnail url instead
            // If image was not created, it's probably too small
            $image    = $aq_image ? $aq_image : $img_url;
            ?>
            <div class="thumb-wrapper post-thumbnail">
                <img src="<?php echo esc_url( $image ); ?>" alt="" />
            </div>
            <?php
        }
    }
}

if( !function_exists('ventcamp_check_css_directory_permission') ) {
    /**
     * Show an error on admin page that theme has no permission to write to cache folder
     */
    function ventcamp_check_css_directory_permission()
    {
        // Check if it's dir and it's writable
        if ( !is_dir( THEME_DIR . '/stylesheets/css' ) || !is_writable(THEME_DIR . '/stylesheets/css') ) {
            if (function_exists('add_settings_error')) {
                add_settings_error(
                    'ventcamp-notices', // slug title of the setting
                    'error_write_permissions', // suffix-id for the error message box
                    sprintf(__('Cache directory %s is not writable. Please check folder permissions', 'ventcamp'), THEME_DIR . '/stylesheets/css'), // Error message
                    'error' // error type, either 'error' or 'updated'
                );
            }
        }
    }

    add_action('admin_menu', 'ventcamp_check_css_directory_permission');
}

if( !function_exists('ventcamp_check_image_libraries') ) {
    /**
     * Image libraries are required for aq_resizer to work properly,
     * check if they're installed and show error to the user, if they are not installed.
     */
    function ventcamp_check_image_libraries() {
        // Check if at least one of the image libraries (ImageMagick or GD) are installed
        if ( !( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) && !extension_loaded( 'imagick' ) ) {
            if ( function_exists( 'add_settings_error' ) ) {
                add_settings_error(
                    'ventcamp-notices', // slug title of the setting
                    'error_no_image_library', // suffix-id for the error message box
                    __( 'Can\'t find image library! Please install GD or ImageMagick', 'ventcamp' ), // the error message
                    'error' // error type, either 'error' or 'updated'
                );
            }
        }
    }

    add_action( 'admin_menu', 'ventcamp_check_image_libraries');
}

if( !function_exists('ventcamp_check_memory') ) {
	/**
	 * For proper theme functioning, Ventcamp require at least 80mb of memory.
	 */
	function ventcamp_check_memory() {
        // Get memory limit
		$memory_limit = ini_get( 'memory_limit' );
		// Parse memory_limit string
		if ( preg_match('/^(\d+)(.)$/', $memory_limit, $matches ) ) {
		    // Check if memory is in megabytes or in kilobytes and convert accordingly
			if ( $matches[2] == 'M' ) {
				$memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
			} else if ( $matches[2] == 'K' ) {
				$memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
			}
		}

		// At least 80M?
		$ok = ( $memory_limit >= 80 * 1024 * 1024 );
        // If there is not enough memory
        if ( !$ok ) {
            add_settings_error(
                'ventcamp-notices', // slug title of the setting
                'error_not_enough_memory', // suffix-id for the error message box
                __( 'Not enough memory on hosting, need at least 80mb of memory (optimal 128mb), otherwise theme options will not work.', 'ventcamp' ), // the error message
                'error' // error type, either 'error' or 'updated'
            );
        }
	}

	add_action( 'admin_menu', 'ventcamp_check_memory');
}

if( !function_exists('ventcamp_change_default_template') ) {
    /**
     * Change default page template to Fullwidth
     *
     * @return mixed Modified default page template title
     */
    function ventcamp_change_default_template() {
        return esc_html__( 'Full width', 'ventcamp' );
    }
}
add_filter( 'default_page_template_title', 'ventcamp_change_default_template', 10, 2 );