<?php
defined('ABSPATH') or die('No direct access');

if( function_exists('ventcamp_build_custom_posts_dropdown') ){
    $woo_products = array_flip(ventcamp_build_custom_posts_dropdown('product', __( 'No Woocommerce products found', 'ventcamp' )));
    $tickera_products = array_flip(ventcamp_build_custom_posts_dropdown('tc_tickets', __( 'No Tickera tickets found', 'ventcamp' )));
} else {
     $woo_products = '';
     $tickera_products = '';
}

$available_ticketing = array(
	__( 'Regular link', 'ventcamp' ) => 'url',
	__( 'Custom code', 'ventcamp' ) => 'custom'
);
                

//Add Woocommerce ticketing option for pricetable
if ( class_exists( 'WooCommerce' ) ) {
    $available_ticketing[__( 'Woocommerce Product', 'ventcamp' )] = 'product';
}


//Add Tickera ticketing option for pricetable
if ( class_exists( 'TC' ) ) {
    $available_ticketing[__( 'Tickera ticket', 'ventcamp' )] = 'tickera_ticket';
}

//Add EventEspresso ticketing option for pricetable
if ( class_exists( 'EE_Base' ) ) {
           
}
       

vc_map( array(
    'name' => __( 'Pricetable Box', 'ventcamp' ),
    'base' => 'vncp_pricetable_box',
    'as_parent' => array('only' => 'vncp_pricetable'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Style', 'ventcamp' ),
            'description' => __( 'Select style of element.', 'ventcamp' ),
            'param_name' => 'style',
            'value' => array(
                __( 'Default', 'ventcamp' ) => 'standart',
                __( 'Alt', 'ventcamp' ) => 'alt',
            ),
            'std' => 'standart'
        ),

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
    ),

    'js_view' => 'VcColumnView'
) );

vc_map( array(
    'name' => __( 'Pricetable Item', 'ventcamp' ),
    'base' => 'vncp_pricetable',
    'content_element' => true,
    'as_child' => array('only' => 'vncp_pricetable_box'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Title', 'ventcamp' ),
            'param_name' => 'title',
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Featured (hot)', 'ventcamp' ),
            'param_name' => 'featured',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Price', 'ventcamp' ),
            'param_name' => 'price',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Currency sign', 'ventcamp' ),
            'param_name' => 'currency_sign',
            'std' => '$'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Currency sign position', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'currency_sign_position',
            'value' => array(
                __( 'Left', 'ventcamp' ) => 'left',
                __( 'Right', 'ventcamp' ) => 'right',
            ),
            'std' => 'left'
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Features available', 'ventcamp' ),
            'param_name' => 'features_available',
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Features unavailable', 'ventcamp' ),
            'param_name' => 'features_unavailable',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Button text', 'ventcamp' ),
            'param_name' => 'button_text',
            'std' => __( 'Buy now', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Link type', 'ventcamp' ),
            'param_name' => 'button_link_type',
            'value' => $available_ticketing,
        ),
        array(
            'type' => 'vc_link',
            'heading' => __( 'Button link', 'ventcamp' ),
            'param_name' => 'button_link',
            'description' => __( 'Add link to button.', 'ventcamp' ),
            'dependency' => array(
                'element' => 'button_link_type',
                'value' => array( 'url' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'WooCommerce Product', 'ventcamp' ),
            'param_name' => 'product_id',
            'value' => $woo_products,
            'description' => __( 'WooCommerce Product ID to buy by button click.', 'ventcamp' ),
            'dependency' => array(
                'element' => 'button_link_type',
                'value' => array( 'product' ),
            ),
        ),        

        array(
            'type' => 'dropdown',
            'heading' => __( 'Tickera Ticket', 'ventcamp' ),
            'param_name' => 'tickera_ticket_id',
            'value' => $tickera_products,
            'description' => __( 'Tickera Product to buy by button click.', 'ventcamp' ),
            'dependency' => array(
                'element' => 'button_link_type',
                'value' => array( 'tickera_ticket' ),
            ),
        ),

	    array(
		    'type' => 'textarea',
		    'heading' => __( 'Custom button code', 'ventcamp' ),
		    'param_name' => 'custom_button_code',
		    'description' => __( 'Paste an HTML code or shortcode here.', 'ventcamp' ),
		    'dependency' => array(
			    'element' => 'button_link_type',
			    'value' => array( 'custom' ),
		    ),
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
    'admin_enqueue_js' => preg_replace( '/\s/', '%20', plugins_url( 'javascripts/pricetable_view.js', __FILE__ ) ),
    'custom_markup' => '<div class="vc_pricetable-element-container"><strong>{{ params.title }}</strong><br><i>{{ params.price }} {{ params.currency_sign }}</i></div>',
    'js_view' => 'VcPricetableView'
) );

vc_map( array(
    'name' => __( 'Tiled Pricetable Box', 'ventcamp' ),
    'base' => 'vncp_tiled_pricetable_box',
    'as_parent' => array('only' => 'vncp_tiled_pricetable'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Columns', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'columns',
            'value' => array(
                __( '1 column', 'ventcamp' ) => '1',
                __( '2 columns', 'ventcamp' ) => '2',
            ),
            'std' => '2'
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        )
    ),

    'js_view' => 'VcColumnView'
) );

vc_map( array(
    'name' => __( 'Tiled Pricetable Item', 'ventcamp' ),
    'base' => 'vncp_tiled_pricetable',
    'content_element' => true,
    'as_child' => array('only' => 'vncp_tiled_pricetable_box'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Title', 'ventcamp' ),
            'param_name' => 'title',
        ),

        // array(
        //     'type' => 'checkbox',
        //     'heading' => __( 'Featured (hot)', 'ventcamp' ),
        //     'param_name' => 'featured',
        // ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Price', 'ventcamp' ),
            'param_name' => 'price',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Currency sign', 'ventcamp' ),
            'param_name' => 'currency_sign',
            'std' => '$'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Currency sign position', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'currency_sign_position',
            'value' => array(
                __( 'Left', 'ventcamp' ) => 'left',
                __( 'Right', 'ventcamp' ) => 'right',
            ),
            'std' => 'left'
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Features available', 'ventcamp' ),
            'param_name' => 'features_available',
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Features unavailable', 'ventcamp' ),
            'param_name' => 'features_unavailable',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Button text', 'ventcamp' ),
            'param_name' => 'button_text',
            'std' => __( 'Buy now', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Link type', 'ventcamp' ),
            'param_name' => 'button_link_type',
            'value' => array(
                __( 'Regular link', 'ventcamp' ) => 'url',
                __( 'Product', 'ventcamp' ) => 'product'
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __( 'Button link', 'ventcamp' ),
            'param_name' => 'button_link',
            'description' => __( 'Add link to button.', 'ventcamp' ),
            'dependency' => array(
                'element' => 'button_link_type',
                'value' => array( 'url' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Product', 'ventcamp' ),
            'param_name' => 'product_id',
            'description' => __( 'Product ID to buy by button click.', 'ventcamp' ),
            'value' => $woo_products,
            'dependency' => array(
                'element' => 'button_link_type',
                'value' => array( 'product' ),
            ),
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
    'admin_enqueue_js' => preg_replace( '/\s/', '%20', plugins_url( 'javascripts/pricetable_view.js', __FILE__ ) ),
    'custom_markup' => '<div class="vc_pricetable-element-container"><strong>{{ params.title }}</strong><br><i>{{ params.price }} {{ params.currency_sign }}</i></div>',
    'js_view' => 'VcPricetableView'
) );



if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vncp_Pricetable_Box extends WPBakeryShortCodesContainer {

    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vncp_Pricetable extends WPBakeryShortCode {

    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vncp_Tiled_Pricetable_Box extends WPBakeryShortCodesContainer {

    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vncp_Tiled_Pricetable extends WPBakeryShortCode {
    }
}
