<?php

/*-----------------------------------------------------------------------------------*/
/*  Counter VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map( array(
    'name' => __( 'Counter', 'ventcamp' ),
    'base' => 'vsc-counter',
    'icon' => 'icon-counter',
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'description' => __( 'Animated counter with title', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Counter number', 'ventcamp' ),
            'param_name' => 'value',
            'description' => __( 'Input value here.', 'ventcamp' ),
            'value' => '0',
            'admin_label' => true
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Counter text', 'ventcamp' ),
            'param_name' => 'title',
            'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'ventcamp' ),
            'admin_label' => true
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Counter layout', 'ventcamp' ),
            'value' => array(
                __( 'Icon on top', 'ventcamp' ) => 'icon_top',
                __( 'Value on top', 'ventcamp' ) => 'value_top'
            ),
            'param_name' => 'box_layout',
            'description' => __( 'Select counter layout.', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Counter box style', 'ventcamp' ),
            'value' => array(
                __( 'Solid color', 'ventcamp' ) => 'solid',
                __( 'Colored border', 'ventcamp' ) => 'border_color',
                __( 'Border', 'ventcamp' ) => 'border',
                __( 'No border', 'ventcamp' ) => 'no_border'
            ),
            'param_name' => 'box_style',
            'description' => __( 'Select counter box style.', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'ventcamp' ),
            'value' => array(
                __( 'Font Awesome', 'ventcamp' ) => 'fontawesome',
                __( 'Open Iconic', 'ventcamp' ) => 'openiconic',
                __( 'Typicons', 'ventcamp' ) => 'typicons',
                __( 'Entypo', 'ventcamp' ) => 'entypo',
                __( 'Linecons', 'ventcamp' ) => 'linecons'
            ),
            'admin_label' => true,
            'dependency' => array(
                'element' => 'box_layout',
                'value' => 'icon_top'
            ),
            'param_name' => 'icon_type',
            'description' => __( 'Select icon library.', 'ventcamp' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust',
            'settings' => array(
                'emptyIcon' => false,
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'ventcamp' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'openiconic',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'openiconic'
            ),
            'description' => __( 'Select icon from library.', 'ventcamp' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'typicons',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'typicons'
            ),
            'description' => __( 'Select icon from library.', 'ventcamp' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'entypo',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'entypo'
            ),
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'linecons',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons'
            ),
            'description' => __( 'Select icon from library.', 'ventcamp' )
        ),

        array(
            'type' => 'checkbox',
            'param_name' => 'options',
            'value' => array(
                __( 'Remove animation?', 'ventcamp' ) => 'no_animation',
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Text color', 'ventcamp' ),
            'param_name' => 'title_color',
            'description' => __( 'Select title color.', 'ventcamp' ),
            'group' => __('Change color', 'ventcamp')
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Number color', 'ventcamp' ),
            'param_name' => 'value_color',
            'description' => __( 'Select value color.', 'ventcamp' ),
            'group' => __('Change color', 'ventcamp'),
            'dependency' => array(
                'element' => 'box_layout',
                'value' => 'value_top'
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Icon color', 'ventcamp' ),
            'param_name' => 'icon_color',
            'description' => __( 'Select icon color.', 'ventcamp' ),
            'group' => __('Change color', 'ventcamp'),
            'dependency' => array(
                'element' => 'box_layout',
                'value' => 'icon_top'
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background color', 'ventcamp' ),
            'param_name' => 'bg_color',
            'description' => __( 'Select background color.', 'ventcamp' ),
            'group' => __('Change color', 'ventcamp'),
            'dependency' => array(
                'element' => 'box_style',
                'value' => array('solid', 'border', 'border_color')
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Border color', 'ventcamp' ),
            'param_name' => 'bd_color',
            'description' => __( 'Select border color.', 'ventcamp' ),
            'group' => __('Change color', 'ventcamp'),
            'dependency' => array(
                'element' => 'box_style',
                'value' => array('border', 'border_color')
            )
        ),
    )
) );



/*-----------------------------------------------------------------------------------*/
/*  Counter VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_counter($atts, $content = null) {
    $value = $title = $box_layout = $box_style = $icon_type = $icon_fontawesome = $icon_openiconic =
    $icon_typicons = $icon_entypo = $icon_linecons = $options = $el_class = $title_color =
    $value_color = $icon_color = $bg_color = $bd_color = $box_style_class = '';

    extract(shortcode_atts(array(
        'icon_type'         => 'fontawesome',
        'icon_fontawesome'  => 'fa fa-adjust',
        'icon_openiconic'   => 'vc-oi vc-oi-dial',
        'icon_typicons'     => 'typcn typcn-adjust-brightness',
        'icon_linecons'     => 'vc_li vc_li-heart',
        'icon_entypo'       => 'entypo-icon entypo-icon-note',

        'value'             => '0',
        'title'             => '',
        'box_layout'        => 'icon_top',
        'box_style'         => '',
        'options'           => '',
        'el_class'          => '',
        'title_color'       => '',
        'value_color'       => '',
        'icon_color'        => '',
        'bg_color'          => '',
        'bd_color'          => ''
    ), $atts));

	wp_enqueue_script( 'appear' , get_template_directory_uri().'/js/lib/jquery.appear.js', array('jquery'), false, true);
	wp_enqueue_script( 'countTo' , get_template_directory_uri().'/js/lib/jquery.countTo.js', array('jquery'), false, true);

    // Params
    //----------------------------------------------------------
    $options = explode(',', $options);
    $value = intval($value);


    if ( in_array('no_animation', $options) ) {
        $animation_class = ' no-animation';
        $animation = false;

    }else {
        $animation_class = '';
        $animation = true;

    }


    if ( $box_style == 'solid' ) {
        $box_style_class = ' counter-block-solid';

    }else if ( $box_style == 'border_color' ) {
        $box_style_class = ' counter-block-border';

    }else if ( $box_style == 'border' ) {
        $box_style_class = '';

    }else if ( $box_style == 'no_border' ) {
        $box_style_class = ' counter-block-no-border';

    }

    if ( !empty($icon_type) && $box_layout == 'icon_top' ) {
        vc_icon_element_fonts_enqueue( $icon_type );

        if ( isset( ${'icon_' . $icon_type} ) ) {
            $icon_class = ${'icon_' . $icon_type};

        } else {
            $icon_class = 'fa fa-adjust';

        }

    } else {
        $icon = null;

    }

    $css_class = ' class= "counter-block' . $box_style_class . $animation_class . ' ' . $el_class . '"';

    $tstyle = ' style="'. ( ( $title_color != '' ) ? 'color: ' . $title_color . ';' : '' ) . '"';

    if ( $title_color != '' ) {
        $tstyle = ' style="color: ' . $title_color . ';"';

    }else {
        $tstyle = '';

    }

    if ( $icon_color != '' ) {
        $istyle = ' style="color: ' . $icon_color . ';"';

    }else {
        $istyle = '';

    }

    if ( $value_color != '' ) {
        $vstyle = ' style="color: ' . $value_color . ';"';

    }else {
        $vstyle = '';

    }

    // Output
    //----------------------------------------------------------
    $output = "\n" . '<div' . $css_class . ' data-counter-value="' . $value . '"' . '>';
    $output .= "\n\t\t" . '<div class="counter-box">';
    $output .= "\n\t\t\t\t" . '<div class="counter-content">';

    if ( $box_layout == 'icon_top' && !empty($icon_class) ) {
        $output .= "\n\t\t\t\t\t\t" . '<span class="fa icon ' . esc_attr( $icon_class ) . '"' . $istyle . '></span>';
        $output .= "\n\t\t\t\t\t\t" . '<p class="title"' . $tstyle . '><span class="count">' . $value . '</span>' . $title . '</p>';

    }else {
        $output .= "\n\t\t\t\t\t\t" . '<span class="count"' . $vstyle . ' data-to="' . $value . '">' . (!$animation ? $value : '') . '</span>';
        $output .= "\n\t\t\t\t\t\t" . '<p class="title"' . $tstyle . '>' . $title . '</p>';

    }

    $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t" . '</div>';
    $output .= "\n" . '</div>';

    return $output;
}

add_shortcode('vsc-counter', 'vsc_counter');
