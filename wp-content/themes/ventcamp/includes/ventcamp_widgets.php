<?php
defined('ABSPATH') or die('No direct access');
/*
* Custom Ventcamp Widgets
*/

if( !function_exists('ventcamp_widgets_init') ) {

    /**
     * Registering Main right sidebar widget area
     */
    function ventcamp_widgets_init() {
        register_sidebar( array(
            'name'          =>  esc_html__('Main Sidebar', 'ventcamp'),
            'id'            => 'main_sidebar',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-head">',
            'after_title'   => '</h5>',
        ) );
		
		// Registering footer widgets
		if( ventcamp_option( 'footer_widgets_enable', true ) ){

			register_sidebar( array(
				'name'          => esc_html__('Footer Widget 1', 'ventcamp'),
				'id'            => 'footer_widget_first',
				'before_widget' => '<div class="widget footer_widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="widget-head">',
				'after_title'   => '</h5>',
			) );

			register_sidebar( array(
				'name'          => esc_html__('Footer Widget 2', 'ventcamp'),
				'id'            => 'footer_widget_second',
				'before_widget' => '<div class="widget footer_widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="widget-head">',
				'after_title'   => '</h5>',
			) );

			if( ventcamp_option( 'footer_widgets_columns', 3 ) >= 3 ) {
				register_sidebar( array(
					'name'          => esc_html__('Footer Widget 3', 'ventcamp'),
					'id'            => 'footer_widget_third',
					'before_widget' => '<div class="widget footer_widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget-head">',
					'after_title'   => '</h5>',
				) );
			}

			if( ventcamp_option( 'footer_widgets_columns', 3 ) == 4 ) {
				register_sidebar( array(
					'name'          => esc_html__('Footer Widget 4', 'ventcamp'),
					'id'            => 'footer_widget_fourth',
					'before_widget' => '<div class="widget footer_widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget-head">',
					'after_title'   => '</h5>',
				) );
			}

		}

		//Register theme-specific widgets
		register_widget( 'ventcamp_Widget_Recent_Posts' );
		register_widget( 'ventcamp_Widget_Recent_Comments' );
		register_widget( 'ventcamp_Widget_About' );
	}
}
add_action( 'widgets_init', 'ventcamp_widgets_init' );
