<?php

/*-----------------------------------------------------------------------------------*/
/*  Column VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map(array(
    'name' => __( 'Column', 'ventcamp' ),
    'base' => 'vc_column',
    'class' => '',
    'icon' => '',
    'wrapper_class' => '',
    'controls' => 'full',
    'content_element' => false,
    'is_container' => true,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'value' => '',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Column alignment', 'ventcamp' ),
            'param_name' => 'el_align',
            'value' => array(
                __( 'None', 'ventcamp' ) => '',
                __( 'Left', 'ventcamp' ) => 'align-left',
                __( 'Center', 'ventcamp' ) => 'align-center',
                __( 'Right', 'ventcamp' ) => 'align-right'
            )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Height', 'ventcamp' ),
            'param_name' => 'height',
            'value' => array(
                __( '100% container height', 'ventcamp' ) => 'full_height'
            )
        ),

        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'ventcamp' ),
            'param_name' => 'css',
            // 'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp'),
            'group' => __( 'Padding & Margins', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Width', 'ventcamp' ),
            'param_name' => 'width',
            'value' => array(
                __( '1 column - 1/12', 'ventcamp' ) => '1/12',
                __( '2 columns - 1/6', 'ventcamp' ) => '1/6',
                __( '3 columns - 1/4', 'ventcamp' ) => '1/4',
                __( '4 columns - 1/3', 'ventcamp' ) => '1/3',
                __( '5 columns - 5/12', 'ventcamp' ) => '5/12',
                __( '6 columns - 1/2', 'ventcamp' ) => '1/2',
                __( '7 columns - 7/12', 'ventcamp' ) => '7/12',
                __( '8 columns - 2/3', 'ventcamp' ) => '2/3',
                __( '9 columns - 3/4', 'ventcamp' ) => '3/4',
                __( '10 columns - 5/6', 'ventcamp' ) => '5/6',
                __( '11 columns - 11/12', 'ventcamp' ) => '11/12',
                __( '12 columns - 1/1', 'ventcamp' ) => '1/1'
            ),
            'group' => __( 'Width & Responsiveness', 'ventcamp' ),
            'description' => __( 'Select column width.', 'ventcamp' ),
            'std' => '1/1'
        ),

        array(
            'type' => 'column_offset',
            'heading' => __( 'Responsiveness', 'ventcamp' ),
            'param_name' => 'offset',
            'group' => __( 'Width & Responsiveness', 'ventcamp' ),
            'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'ventcamp' )
        )
    ),

    'js_view' => 'VcColumnView'
));
