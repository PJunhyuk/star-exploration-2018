<?php

/*-----------------------------------------------------------------------------------*/
/*  Row Inner VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map( array(
    'name' => __( 'Row', 'ventcamp' ), //Inner Row
    'base' => 'vc_row_inner',
    'content_element' => false,
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'weight' => 1000,
    'show_settings_on_create' => false,
    'description' => __( 'Place content elements inside the row', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background color', 'ventcamp' ),
            'param_name' => 'vsc_bg_color',
            'description' => __( 'Background color overlay can be placed on top of background image or used separately', 'ventcamp' )
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Background image', 'ventcamp' ),
            'param_name' => 'vsc_bg_image',
            'description' => __( 'Select rows backgound image', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Background repeat', 'ventcamp' ),
            'param_name' => 'vsc_bg_repeat',
            'value' => array(
                __( 'No Repeat', 'ventcamp' ) => 'no-repeat',
                __( 'Repeat', 'ventcamp' ) => 'repeat',
                __( 'Repeat-X', 'ventcamp' ) => 'repeat-x',
                __( 'Repeat-Y', 'ventcamp' ) => 'repeat-y'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Background position', 'ventcamp' ),
            'param_name' => 'vsc_bg_position',
            'value' => array(
                __( 'Center Center', 'ventcamp' ) => 'center center',
                __( 'Center Left', 'ventcamp' ) => 'center left',
                __( 'Center Right', 'ventcamp' ) => 'center right',
                __( 'Top Center', 'ventcamp' ) => 'top center',
                __( 'Top Left', 'ventcamp' ) => 'top left',
                __( 'Top Right', 'ventcamp' ) => 'top right',
                __( 'Bottom Center', 'ventcamp' ) => 'bottom center',
                __( 'Bottom Left', 'ventcamp' ) => 'bottom left',
                __( 'Bottom Right', 'ventcamp' ) => 'bottom right'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Background size', 'ventcamp' ),
            'param_name' => 'vsc_bg_size',
            'value' => array(
                __( 'Cover', 'ventcamp' ) => 'cover',
                __( 'Default', 'ventcamp' ) => 'auto',
                __( 'Contain', 'ventcamp' ) => 'contain'
            )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Height', 'ventcamp' ),
            'param_name' => 'height',
            'value' => array(
                __( '100% container height', 'ventcamp' ) => 'window_height'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'vsc_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        ),

        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'ventcamp' ),
            'param_name' => 'css',
            // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' ),
            'group' => __( 'Padding & Margins', 'ventcamp' )
        )
    ),

    'js_view' => 'VcRowView'
) );
