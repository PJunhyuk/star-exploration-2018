<?php

defined('ABSPATH') or die('No direct access');

if( !function_exists('ventcamp_enqueue_scripts') ) {
    /**
     * Load theme Main scripts
     */
    function ventcamp_enqueue_scripts() {

        // Load the Internet Explorer specific scripts
        wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/lib/html5shiv.js' );
        wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/lib/respond.min.js' );
        wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
        wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

        // Load main JS lib scripts
        wp_enqueue_script( 'plugin-helpers',   get_template_directory_uri() . "/js/lib/jquery.plugin.min.js", array('jquery'), false, true );
        wp_enqueue_script( 'bootstrap',        get_template_directory_uri() . "/js/lib/bootstrap.min.js", array('jquery'), false, true );
	    wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . "/js/lib/bootstrap-select.min.js", array('bootstrap'), '1.12.4', true );
        wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . "/js/lib/jquery.waypoints.min.js", array('jquery'), false, true );
        wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . "/js/lib/jquery.countdown.min.js", array('jquery', 'ventcamp-plugin'), false, true );

        // Load Main Theme Js script
        wp_enqueue_script( 'ventcamp-main',    get_template_directory_uri() . "/js/ventcamp.js", array('jquery'), false, true );
        // Get inline script from settings
	    $global_js = ventcamp_option( 'customcode_global_js', '' );
	    // Attach custom inline script to 'ventcamp-main'
	    if ( !empty( $global_js ) ) {
		    wp_add_inline_script( 'ventcamp-main', $global_js );
	    }

        // Load comment scripts if page has comments enabled
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'ventcamp_enqueue_scripts' );

if ( !function_exists('ventcamp_localize_scripts') ) {
    /**
     * Fix image url in js script.
     */
    function ventcamp_localize_scripts() {
        $image_url = get_template_directory_uri() . '/img/marker-46x46.png';
        $localizations = array( 'markerURL' => $image_url );

        wp_localize_script( 'ventcamp-main', 'localizedVars', $localizations );
    }

    add_action( 'wp_enqueue_scripts', 'ventcamp_localize_scripts' );
}

if ( !function_exists('ventcamp_footer_copyright') ) {
    /**
     * Generates copyright in the footer
     */
    function ventcamp_footer_copyright(){
        echo ventcamp_option( 'footer_text', __( 'All rights reserved 2017', 'ventcamp' ) );
    }
}

if ( !function_exists('ventcamp_footer_widgets') ) {
    /**
     * Depending on the amount of columns, generate required amount of div's for widgets with appropriate classes.
     */
    function ventcamp_footer_widgets() {
        if(ventcamp_option('footer_widgets_enable')): ?>
            <div class="container">
            <?php
                $ventcamp_footer_widgets_cols = ventcamp_option('footer_widgets_columns');
                $ventcamp_footer_widgets_class = array(
                    "col-sm-4",
                    "col-sm-4 col-lg-3 col-lg-offset-1",
                    "col-sm-4 col-lg-3 col-lg-offset-1"
                );

                switch ($ventcamp_footer_widgets_cols) {
                    case 2:
                        $ventcamp_footer_widgets_class = array(
                            "col-sm-6",
                            "col-sm-6"
                        );
                        break;

                    case 4:
                        $ventcamp_footer_widgets_class = array(
                            "col-md-3 col-sm-6",
                            "col-md-3 col-sm-6",
                            "col-md-3 col-sm-6",
                            "col-md-3 col-sm-6"
                        );
                        break;
                }
            ?>
                <div class="<?php echo esc_attr($ventcamp_footer_widgets_class[0]); ?>">
                    <?php dynamic_sidebar ( 'footer_widget_first' ); ?>
                </div>

                <div class="<?php echo esc_attr($ventcamp_footer_widgets_class[1]); ?>">
                    <?php dynamic_sidebar ( 'footer_widget_second' ); ?>
                </div>

                <?php if($ventcamp_footer_widgets_cols >= 3): ?>
                    <div class="<?php echo esc_attr($ventcamp_footer_widgets_class[2]); ?>">
                        <?php dynamic_sidebar ( 'footer_widget_third' ); ?>
                    </div>
                <?php endif; ?>

                <?php if($ventcamp_footer_widgets_cols == 4): ?>
                    <div class="<?php echo esc_attr($ventcamp_footer_widgets_class[3]); ?>">
                        <?php dynamic_sidebar ( 'footer_widget_fourth' ); ?>
                    </div>
                <?php endif; ?>

            </div>

        <?php endif;
    }
}

if ( !function_exists('ventcamp_footer_menu') ) {
    function ventcamp_footer_menu () {
        wp_nav_menu( array(
            'theme_location' => 'footer',
            'container' => false,
            'menu_class' => 'footer-nav',
            'echo' => true,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 1,
            'fallback_cb' => 'ventcamp_default_menu',
        ));
    }
}