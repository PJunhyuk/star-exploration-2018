<?php
defined('ABSPATH') or die('No direct access');

    if( function_exists('ventcamp_build_custom_posts_dropdown') ){
        $modals = array_flip(ventcamp_build_custom_posts_dropdown('vivaco-modals', __( 'No modals found', 'ventcamp' )));
    } else {
         $modals = ''; 
    }


    $icons_params = vc_map_integrate_shortcode( 'vc_icon', 'i_', '',
        array(
            'include_only_regex' => '/^(type|icon_\w*)/',
        ), array(
            'element' => 'add_icon',
            'value' => 'true',
        )
    );

    $btn_params = array_merge(
        array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Text', 'ventcamp' ),
                'param_name' => 'title',
                'value' => __( 'Text on the button', 'ventcamp' ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Link type', 'ventcamp' ),
                'param_name' => 'link_type',
                'value' => array(
                    __( 'Regular link', 'ventcamp' ) => 'url',
                    __( 'Product', 'ventcamp' ) => 'product',
                    __( 'Modal box', 'ventcamp') => 'modal'
                ),
            ),

            array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Link)', 'ventcamp' ),
                'param_name' => 'link',
                'description' => __( 'Add link to button.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'link_type',
                    'value' => array( 'url' ),
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Display modal box by ID", "ventcamp"),
                "param_name" => "modal_box_id",
                "value" => $modals,
                'dependency' => array(
                    'element' => 'link_type',
                    'value' => 'modal',
                    ),
                ),

            array(
                'type' => 'number',
                'heading' => __( 'Product', 'ventcamp' ),
                'param_name' => 'product_id',
                'description' => __( 'Product ID to buy by button ckick.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'link_type',
                    'value' => array( 'product' ),
                ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Style', 'ventcamp' ),
                'description' => __( 'Select button display style.', 'ventcamp' ),
                'param_name' => 'style',
                'value' => array(
                    __( 'Primary button', 'ventcamp' ) => 'default',
                    __( 'Secondary button', 'ventcamp' ) => 'alt',
                    __( 'Custom', 'ventcamp' ) => 'custom',
                ),
            ),

            // custom style
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Text', 'ventcamp' ),
                'param_name' => 'custom_text',
                'description' => __( 'Select custom text color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => '#666',
            ),

            array(
                'type' => 'colorpicker',
                'heading' => __( 'Background', 'ventcamp' ),
                'param_name' => 'custom_background',
                'description' => __( 'Select custom background color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => '#ededed',
            ),

            array(
                'type' => 'colorpicker',
                'heading' => __( 'Border color', 'ventcamp' ),
                'param_name' => 'custom_border_color',
                'description' => __( 'Select border color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'std' => '#666',
            ),

            array(
                'type' => 'number',
                'heading' => __( 'Border width', 'ventcamp' ),
                'param_name' => 'custom_border_width',
                'description' => __( 'Select border width for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'min' => 0,
                'max' => 10,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => 1,
            ),

            array(
                'type' => 'number',
                'heading' => __( 'Border radius', 'ventcamp' ),
                'param_name' => 'custom_border_radius',
                'description' => __( 'Select border radius for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'min' => 0,
                'max' => 10,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => 1,
            ),

            array(
                'type' => 'colorpicker',
                'heading' => __( 'Hover text', 'ventcamp' ),
                'param_name' => 'custom_hover_text',
                'description' => __( 'Select custom hover text color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => '#666',
            ),

            array(
                'type' => 'colorpicker',
                'heading' => __( 'Hover background', 'ventcamp' ),
                'param_name' => 'custom_hover_background',
                'description' => __( 'Select custom hover background color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => '#ededed',
            ),

            array(
                'type' => 'colorpicker',
                'heading' => __( 'Hover border color', 'ventcamp' ),
                'param_name' => 'custom_hover_border_color',
                'description' => __( 'Select border hover color for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'std' => '#666',
            ),

            array(
                'type' => 'number',
                'heading' => __( 'Hover border width', 'ventcamp' ),
                'param_name' => 'custom_hover_border_width',
                'description' => __( 'Select border hover width for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'min' => 0,
                'max' => 10,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => 1,
            ),

            array(
                'type' => 'number',
                'heading' => __( 'Hover border radius', 'ventcamp' ),
                'param_name' => 'custom_hover_border_radius',
                'description' => __( 'Select border hover radius for your element.', 'ventcamp' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'min' => 0,
                'max' => 10,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'std' => 1,
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Size', 'ventcamp' ),
                'param_name' => 'size',
                'description' => __( 'Select button display size.', 'ventcamp' ),
                'std' => 'md',
                'value' => array(
                        __( 'Big', 'ventcamp' ) => 'lg',
                        __( 'Medium', 'ventcamp' ) => 'md',
                        __( 'Small', 'ventcamp' ) => 'sm',
                    ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Alignment', 'ventcamp' ),
                'param_name' => 'align',
                'description' => __( 'Select button alignment.', 'ventcamp' ),
                'value' => array(
                    __( 'Inline', 'ventcamp' ) => 'inline',
                    __( 'Left', 'ventcamp' ) => 'left',
                    __( 'Right', 'ventcamp' ) => 'right',
                    __( 'Center', 'ventcamp' ) => 'center',
                ),
            ),

            array(
                'type' => 'checkbox',
                'heading' => __( 'Add icon?', 'ventcamp' ),
                'param_name' => 'add_icon',
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon Alignment', 'ventcamp' ),
                'description' => __( 'Select icon alignment.', 'ventcamp' ),
                'param_name' => 'i_align',
                'value' => array(
                    __( 'Left', 'ventcamp' ) => 'left',
                    __( 'Right', 'ventcamp' ) => 'right',
                ),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value' => 'true',
                ),
            ),
        ),

        $icons_params,

        array(
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'ventcamp' ),
                'param_name' => 'el_class',
                'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'ventcamp' ),
            ),

            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 'ventcamp' ),
                'param_name' => 'css',
                'group' => __( 'Design Options', 'ventcamp' ),
            ),
        )
    );

    vc_map(array(
            'name' => __( 'Ventcamp Button', 'ventcamp' ),
            'base' => 'ventcamp_button',
            'icon' => 'icon-wpb-ui-button',
            'category' => __( 'Ventcamp', 'ventcamp' ),
            'description' => __( 'Ventcamp Button', 'ventcamp' ),
            'params' => $btn_params,
			'weight' => 15,
            'js_view' => 'VentCampButton',
            'custom_markup' => '{{title}}<div class="ventcamp_button-container"><button class="vc_general ventcamp_button"></button></div>',
        )
    );



add_shortcode( 'ventcamp_button', 'ventcamp_button_render' );
function ventcamp_button_render( $atts ) {
    extract( shortcode_atts( array(
        'size'          => 'md',
        'link'          => '#',
        'link_type'     => 'url',
        'product_id'    => '',
        'title'         => 'Button title',
        'style'         => 'default',
        'align'         => 'inline',
        'add_icon'      => 'false',
        'i_align'       => 'left',
        'el_class'      => '',
        'css'           => '',
        'modal_box_id'  => '',

        'custom_background'     => '',
        'custom_border_color'   => '',
        'custom_border_width'   => '',
        'custom_border_radius'  => '',
        'custom_text'           => '',

        'custom_hover_background'       => '',
        'custom_hover_border_color'     => '',
        'custom_hover_border_width'     => '',
        'custom_hover_border_radius'    => '',
        'custom_hover_text'             => '',

        'i_type'                => 'fontawesome',
        'i_icon_fontawesome'    => 'fa fa-adjust',
        'i_icon_openiconic'     => 'vc-oi vc-oi-dial',
        'i_icon_typicons'       => 'typcn typcn-adjust-brightness',
        'i_icon_entypo'         => 'entypo-icon entypo-icon-note',
        'i_icon_linecons'       => 'vc_li vc_li-heart',
        'i_icon_lineicons'      => 'icon icon-alerts-01'

    ), $atts ) );

    $btn_link = '';

    if('url' === $link_type){
        $parsed_link = vc_build_link($link);
        $btn_link = $parsed_link['url'];
    }else if('product' == $link_type){
        $btn_link = site_url('?add-to-cart=' . $product_id);
    }

    $css_class = vc_shortcode_custom_css_class( $css );

    $append = '';

    if( $link_type == 'modal') {
        $data_modal =  'data-modal-link="vivaco-'.$modal_box_id.'"';
    } else {
        $data_modal = '';
    }

    if('custom' === $style){
        $css = "color: {$custom_text}; background-color: {$custom_background}; border-color: {$custom_border_color}; border-width: {$custom_border_width}px; border-radius: {$custom_border_radius}px;";

        $n_css = "this.style.color='{$custom_text}'; this.style.backgroundColor='{$custom_background}'; this.style.borderColor='{$custom_border_color}'; this.style.borderWidth={$custom_border_width}; this.style.borderRadius={$custom_border_radius};";
        $h_css = "this.style.color='{$custom_hover_text}'; this.style.backgroundColor='{$custom_hover_background}'; this.style.borderColor='{$custom_hover_border_color}'; this.style.borderWidth={$custom_hover_border_width}; this.style.borderRadius={$custom_hover_border_radius};";

        $append = " style='{$css}'  onMouseOver=\"{$h_css}\" onMouseOut=\"$n_css\" ";
    }

    $wrapperStart = $wrapperEnd = '';

    if ( $align != 'inline' ) {
        $wrapperStart = '<div class="btns-block btns-' . $align . '">';
        $wrapperEnd = '</div>';
    }

    if('true' === $add_icon && isset(${'i_icon_' . $i_type})){
        $icon_class = ${'i_icon_' . $i_type};
        vc_icon_element_fonts_enqueue($i_type);

        if('left' == $i_align){
            $title = "<i class='{$icon_class} left'></i>" . $title;
        }else{
            $title = $title . "<i class='{$icon_class} right'></i>";
        }
    }

return <<<BTN
{$wrapperStart}<a class='ventcamp_button btn btn-{$size} btn-{$style} {$css_class}' href='{$btn_link}'{$data_modal}{$append}>{$title}</a>{$wrapperEnd}
BTN;
}
