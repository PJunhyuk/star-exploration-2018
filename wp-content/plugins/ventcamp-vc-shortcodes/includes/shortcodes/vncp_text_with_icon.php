<?php

/*-----------------------------------------------------------------------------------*/
/*  Text with Icon VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map(array(
    'name' => __( 'Text with Icon', 'vivaco' ),
    'base' => 'vnp-text-icon',
    'icon' => 'icon-for-twi',
    'description' => 'Text block with eye-catching icon',
    'class' => 'twi_extended',
    'category' => __( 'Ventcamp', 'vivaco' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => __( 'Title', 'vivaco' ),
            'param_name' => 'title'
        ),

        array(
            'type' => 'textarea_html',
            'heading' => __( 'Text', 'vivaco' ),
            'param_name' => 'content'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Media Type', 'vivaco' ),
            'param_name' => 'media_type',
            'value' => array(
                __( 'Font Icon', 'vivaco' ) => 'icon-type',
                __( 'Standard Image', 'vivaco' ) => 'img-type'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon and text align', 'vivaco' ),
            'param_name' => 'align',
            'value' => array(
                __( 'Top', 'vivaco' ) => 'top',
                __( 'Left', 'vivaco' ) => 'left',
                __( 'Right', 'vivaco' ) => 'right',
                __( 'Bottom', 'vivaco' ) => 'bottom'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Type', 'vivaco' ),
            'param_name' => 'icon_type',
            'dependency' => array(
                'element' => 'media_type',
                'value' => 'icon-type'
            ),
            'value' => array(
                __( 'Single Icon', 'vivaco' ) => 'single_icon',
                __( 'Solid Shape', 'vivaco' ) => 'solid_icon',
                __( 'Border Shape', 'vivaco' ) => 'border_icon'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Shape', 'vivaco' ),
            'param_name' => 'icon_shape',
            'dependency' => array(
                'element' => 'icon_type',
                'value' => array('solid_icon', 'border_icon')
            ),
            'value' => array(
                __( 'Round', 'vivaco' ) => 'round_shape',
                __( 'Square', 'vivaco' ) => 'square_shape',
                __( 'Round corner Square', 'vivaco' ) => 'rounded_square_shape'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Border Style', 'vivaco' ),
            'param_name' => 'icon_border',
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'border_icon'
            ),
            'value' => array(
                __( 'Solid', 'vivaco' ) => 'solid_border',
                __( 'Dashed', 'vivaco' ) => 'dashed_border',
                __( 'Dotted', 'vivaco' ) => 'dotted_border'
            )
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'icon_library',
            'heading' => __( 'Icon library', 'js_composer' ),
            'value' => array(
                __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                __( 'Typicons', 'js_composer' ) => 'typicons',
                __( 'Entypo', 'js_composer' ) => 'entypo',
                __( 'Linecons', 'js_composer' ) => 'linecons',
                __( 'Line Icons', 'vivaco' ) => 'lineicons'
            ),
            'dependency' => array(
                'element' => 'media_type',
                'value' => 'icon-type'
            ),
            'admin_label' => true,
            'description' => __( 'Select icon library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust',
            'settings' => array(
                'emptyIcon' => false,
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'fontawesome'
            ),
            'description' => __( 'Select icon from library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'openiconic',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'openiconic'
            ),
            'description' => __( 'Select icon from library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'typicons',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'typicons'
            ),
            'description' => __( 'Select icon from library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'entypo',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'entypo'
            ),
            'description' => __( 'Select icon from library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'linecons',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'linecons'
            ),
            'description' => __( 'Select icon from library.', 'js_composer' )
        ),

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'ventcamp'),
            'param_name' => 'icon_lineicons',
            'value' => 'icon icon-alerts-01',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'lineicons',
                'iconsPerPage' => 4000
            ),
            'dependency' => array(
                'element' => 'icon_library',
                'value' => 'lineicons'
            ),
            'description' => __( 'Select icon from library.', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Custom icon size', 'vivaco' ),
            'param_name' => 'icon_size',
            'value' => '',
            'dependency' => array(
                'element' => 'media_type',
                'value' => 'icon-type'
            ),
            'description' => __( 'Font-size of icon', 'vivaco' )
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Image', 'vivaco' ),
            'param_name' => 'img',
            'dependency' => array(
                'element' => 'media_type',
                'value' => 'img-type'
            ),
            'description' => __( 'Upload an image for the widget', 'vivaco' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Title Color', 'vivaco' ),
            'param_name' => 'title_color',
            'group' => __( 'Change color', 'vivaco' ),
            'dependency' => array(
                'element' => 'title',
                'not_empty' => true
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Text Color', 'vivaco' ),
            'param_name' => 'text_color',
            'group' => __( 'Change color', 'vivaco' ),
            'dependency' => array(
                'element' => 'content',
                'not_empty' => true
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Icon Background Color', 'vivaco' ),
            'param_name' => 'icon_bg_color',
            'group' => __( 'Change color', 'vivaco' ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'solid_icon'
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Icon Border Color', 'vivaco' ),
            'param_name' => 'icon_bd_color',
            'group' => __( 'Change color', 'vivaco' ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => array( 'solid_icon', 'border_icon' )
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Icon Color', 'vivaco' ),
            'param_name' => 'icon_color',
            'group' => __( 'Change color', 'vivaco' ),
            'dependency' => array(
                'element' => 'media_type',
                'value' => 'icon-type'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'vivaco' ),
            'param_name' => 'el_class'
        )
    )
));





/*-----------------------------------------------------------------------------------*/
/*  Text with Icon VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vnp_text_with_icon($atts, $content = null) {
    $icon_library = $icon_ventcampli = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

    extract(shortcode_atts(array(
        'title' => '',
        'media_type' => 'icon-type',
        'align' => 'top',
        'icon_type' => 'single_icon',
        'icon_shape' => 'round_shape',
        'icon_border' => 'solid_border',
        'icon_library' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'icon_lineicons' => 'icon icon-alerts-01',
        'icon_size' => '',
        'img' => '',
        'title_color' => '',
        'text_color' => '',
        'icon_bg_color' => '',
        'icon_bd_color' => '',
        'icon_color' => '',
        'el_class' => ''
    ), $atts));

    $ialign = '';
    if ($align == 'top') {
        $ialign = 'icon-top';
    } else if ($align == 'left') {
        $ialign = 'icon-left';
    } else if ($align == 'right') {
        $ialign = 'icon-right';
    } else if ($align == 'bottom') {
        $ialign = 'icon-bottom';
    }

    $itype = '';
    if ($icon_type == 'single_icon') {
        $itype = 'icon-single';
    } else if ($icon_type == 'solid_icon') {
        $itype = 'icon-solid';
    } else if ($icon_type == 'border_icon') {
        $itype = 'icon-border';
    }

    $ishape = '';
    if ($icon_shape == 'round_shape') {
        $ishape = 'icon-round';
    } else if ($icon_shape == 'square_shape') {
        $ishape = 'icon-square';
    } else if ($icon_shape == 'rounded_square_shape') {
        $ishape = 'icon-round-square';
    }

    $iborder = '';
    if ($icon_border == 'solid_border') {
        $iborder = 'icon-border-solid';
    } else if ($icon_border == 'dashed_border') {
        $iborder = 'icon-border-dashed';
    } else if ($icon_border == 'dotted_border') {
        $iborder = 'icon-border-dotted';
    }

    $container_style = '';
    if ( $icon_size != '' ) {
        $icon_size = intval($icon_size);

        $padding = $icon_size;

        if ( $icon_type != 'single_icon' ) {
            $icon_size = $icon_size / 2;

            if ( $icon_size < 16 ) {
                $icon_size = 16;
                $padding = 32;
            }
        }

        if ($align == 'top') {
            $container_style = 'padding-top: ' . ($padding + 10) . 'px;';
        } else if ($align == 'left') {
            $container_style = 'padding-left: ' . ($padding + 15) . 'px;';
        } else if ($align == 'right') {
            $container_style = 'padding-right: ' . ($padding + 15) . 'px;';
        } else if ($align == 'bottom') {
            $container_style = 'padding-bottom: ' . ($padding) . 'px;';
        }
    }

    $istyle = '';
    if ($icon_type == 'solid_icon' && $icon_bg_color != '') {
        $istyle .= 'background-color: ' . $icon_bg_color . '; ';
    }
    if ($icon_type != 'single_icon' && $icon_bd_color != '') {
        $istyle .= 'border-color: ' . $icon_bd_color . '; ';
    }
    if ($icon_color != '') {
        $istyle .= 'color: ' . $icon_color . ';';
    }

    if ( $icon_size != '' ) {
        $istyle .= ' font-size: ' . $icon_size . 'px;';
    }

    $title_style = '';
    if ( $title_color != '' ) {
        $title_style = 'style="color: ' . $title_color . ';"';
    }

    $text_style = '';
    if ( $text_color != '' ) {
        $text_style = 'style="color: ' . $text_color . ';"';
    }

    $output = '';
    $output .= '<article style="' . $container_style . '" class="vnp-service-elem vnp-text-icon ' . $el_class . ' ' . $ialign . ' ' . $itype . ' ' . $ishape . ' ' . $iborder . '">';
    $output .= '<div class="vnp-service-icon">';

    if ( isset(${'icon_' . $icon_library}) ) {
        $icon = ${'icon_' . $icon_library};

        vc_icon_element_fonts_enqueue( $icon_library );
    }

    // base_clr_bg
    if ($media_type == 'icon-type') {
        $output .= '<span class="' . $icon . ( ($icon_type == 'solid_icon') ? ' base_clr_brd base_clr_bg' : '' ) . ( ($icon_type == 'border_icon') ? ' base_clr_brd' : '' ) . '" style="' . $istyle . '"></span>';
    } else if ($media_type == 'img-type') {
        $img_val = '';
        if (function_exists('wpb_getImageBySize')) {
            $img_val = wpb_getImageBySize(array(
                'attach_id' => (int) $img,
                'thumb_size' => 'full'
            ));
        }

        $output .= $img_val['thumbnail'];
    }

    $output .= '</div>';

    $output .= '<div class="vnp-service-content">';
    if ($title != '') {
        $output .= '<h6 class="heading-alt" ' . $title_style . '>' . $title . '</h6>';
    }

    if (!empty($content)) {
        $output .= '<p ' . $text_style . '>' . do_shortcode($content) . '</p>';
    }
    $output .= '</div>';

    $output .= '</article>';
    return $output;

}

add_shortcode('vnp-text-icon', 'vnp_text_with_icon');
