<?php
defined('ABSPATH') or die('No direct access');

//Register 'container' content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __( 'Testimonials', 'ventcamp' ),
    'base' => 'vncp_testimonials_box',
    'as_parent' => array('only' => 'vncp_testimonial'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Columns', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'columns',
            'value' => array(
                __( '2 columns', 'ventcamp' ) => '2',
                __( '3 columns', 'ventcamp' ) => '3',
                __( '4 columns', 'ventcamp' ) => '4',
            ),
            'std' => '4'
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        )
    )
) );


vc_map( array(
    'name' => __( 'Testimonial', 'ventcamp' ),
    'base' => 'vncp_testimonial',
    'content_element' => true,
    'as_child' => array('only' => 'vncp_testimonials_box'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Name', 'ventcamp' ),
            'param_name' => 'name',
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Photo', 'ventcamp' ),
            'param_name' => 'photo',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Company', 'ventcamp' ),
            'param_name' => 'company',
        ),

        array(
            'type' => 'textarea',
            'heading' => __( 'Text', 'ventcamp' ),
            'param_name' => 'content',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        )
    ),

	// This will load extra js file in backend (when you edit page with VC)
	// use preg replace to be sure that "space" will not break logic
    'admin_enqueue_js' => preg_replace( '/\s/', '%20', plugins_url( 'javascripts/testimonial_view.js', __FILE__ ) ),
    'custom_markup' => '<div class="vc_testimonial-element-container"><strong>{{ params.name }}</strong><br><i>{{ params.company }}</i></div>',
    'js_view' => 'VcTestimonialView'
) );


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vncp_Testimonials_Box extends WPBakeryShortCodesContainer {

    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vncp_Testimonial extends WPBakeryShortCode {

    }
}
