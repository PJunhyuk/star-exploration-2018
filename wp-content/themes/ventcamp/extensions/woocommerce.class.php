<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate this class
if ( !class_exists( 'Woocommerce_Support' ) && class_exists( 'Woocommerce' ) ) :
    /**
     * Helper class to add custom wrappers/remove unnecessary functions
     */
    class Woocommerce_Support {
        // If product page has active sidebar
        protected $has_sidebar = false;

        /**
         * Woocommerce_Support constructor.
         */
        public function __construct () {
            // Check if main sidebar is active
            if ( is_active_sidebar( 'main_sidebar' ) ) {
                $this->has_sidebar = true;
            }

            // Add custom wrappers
            $this->add_custom_content_wrappers();

            // Remove unnecessary functionality
            $this->remove_sorting_and_counter();

            // Redirect to shopping cart after clicking on "add to cart"
            $this->redirect_right_to_cart();

            // Remove unnecessary product types
            add_filter( 'product_type_selector', array( $this, 'remove_other_product_types' ), 10, 2 );

            // Fix conflict with ACF
            add_action( 'acf/init', array( $this, 'fix_conflict_with_acf' ) );

            // Fix dropdown menus
            add_action( 'wp_enqueue_scripts', array( $this, 'fix_duplicated_dropdown_menus' ), 100 );

            // Add Woocommerce support
            add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
        }

        /**
         * Remove default woocommerce wrappers and add our own
         */
        public function add_custom_content_wrappers () {
            // Remove default woocommerce filters
            remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
            remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

            // Add our own custom filters
            add_action( 'woocommerce_before_main_content', array( $this, 'output_content_wrapper' ), 10 );
            add_action( 'woocommerce_after_main_content', array( $this, 'output_content_wrapper_end' ), 10 );
        }

        /**
         * Open the Ventcamp wrapper.
         */
        public function output_content_wrapper () {
            // Set offset class if need
            $col = $this->has_sidebar ? 'col-md-8 col-sm-12' : 'col-md-12'; ?>

            <div class="container">
                <div class="content <?php echo $col; ?>">
                    <main id="main" class="site-main">
            <?php
        }

        /**
	     * Close the Ventcamp wrapper.
	     */
	    public function output_content_wrapper_end () { ?>
				    </main>
			    </div>

                <?php $this->sidebar(); ?>
		    </div>
		    <?php
	    }

        /**
         * Remove default WooCommerce sidebar behaviour and output our custom sidebar.
         */
	    public function sidebar () {
	        // If we have a sidebar
	        if ( $this->has_sidebar) :
                // Remove default sidebar
                remove_all_actions( 'woocommerce_sidebar', 10 ); ?>

                <div class="col-md-offset-1 col-md-3 col-sm-12 sidebar">
                    <?php get_sidebar(); ?>
                </div>

                <?php
            endif;
        }

        /**
         * Redirect to shopping cart page after click on add to cart button.
         */
	    public function redirect_right_to_cart () {
            // Redirect users after add to cart
            add_filter ( 'woocommerce_add_to_cart_redirect', array( $this, 'get_cart_url' ), 20 );
        }

        /**
         * Gets the URL to the cart page.
         *
         * @return string URL to cart page
         */
        public function get_cart_url () {
            return wc_get_cart_url();
        }

        /**
         * Remove unused product types
         *
         * @param array $product_types Array of types with ID and title
         *
         * @return array Modified array of types
         */
        public function remove_other_product_types ( array $product_types ) {
            // Only if GOD DAMN plugin FooEvents is active
            if ( is_plugin_active( 'fooevents/fooevents.php' ) ) {
                // Rename simple product type into "Ticket"
                $product_types[ 'simple' ] =  __( 'Ticket', 'ventcamp' );
            }

            return $product_types;
        }

        /**
         * Remove standard Woocommerce functionality: product sorting dropdown and product counter
         */
	    public function remove_sorting_and_counter () {
            // Remove result count from Shop loop
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

            // Remove product sorting dropdown from Shop loop
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
        }

        /**
         * Fix duplicated dropdown menus at checkout page.
         * This was caused by WooCommerce's enhanced dropdown boxes at checkout.
         *
         * @see https://20milesnorth.com/blog/removing-enhanced-dropdown-boxes-in-woocommerce-checkout/
         */
        public function fix_duplicated_dropdown_menus () {
            // Deregister and dequeue select2 styles
            wp_dequeue_style( 'select2' );
            wp_deregister_style( 'select2' );

            // Deregister and dequeue select2 scripts
            wp_dequeue_script( 'select2' );
            wp_deregister_script( 'select2' );
        }

        /**
         * Fix bug in WooCommerce 3.0 caused by duplicated select2 library, which is
         * included in ACF too. Because of that, Linked Products and other settings are not working.
         *
         * @see https://wordpress.org/support/topic/select2-js-error-after-updating-to-woocommerce-3-0/
         */
        public function fix_conflict_with_acf () {
            acf_update_setting( 'select2_version', 4 );
        }

        /**
         * Declare Woocommerce support
         */
        public function add_theme_support () {
            /*
             * Theme should declare it in the code
             * to hide the “Your theme does not declare WooCommerce support” message
             */
            add_theme_support( 'woocommerce' );
        }
    }

    // Init our class
    new Woocommerce_Support();
endif;
