<?php

/*-----------------------------------------------------------------------------------*/
/*  Row VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map(array(
    'name' => __( 'Row', 'ventcamp' ),
    'base' => 'vc_row',
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'weight' => 100,
    'show_settings_on_create' => true,
    'category' => __( 'Content', 'ventcamp' ),
    'description' => __( 'Main content wrapper', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Anchor ID', 'ventcamp' ),
            'param_name' => 'vsc_id',
            'description' => __( 'Set an ID if you want to link this section with one page scrolling navigation e.g.: team', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'ventcamp' ),
            'param_name' => 'width',
            'value' => array(
                __( 'Default (Boxed)','ventcamp' ) => '',
                __( 'Stretch row (100% width)','ventcamp' ) => 'stretch_row',
                __( 'Stretch row and content','ventcamp' ) => 'stretch_row_content',
                __( 'Stretch row and content without spaces','ventcamp' ) => 'stretch_row_content_no_spaces',
            ),
            'description' => __( 'This controls the width of the row and contents. Fullscreen rows are only allowed in Fullscreen page template <a target="_blank" class="help" href="https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=3604483">?</a>', 'ventcamp' )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Height options', 'ventcamp' ),
            'param_name' => 'options',
            'value' => array(
                __( '100% window height', 'ventcamp' ) => 'window_height',
                __( 'Vertical centering', 'ventcamp' ) => 'centered',
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Text color', 'ventcamp' ),
            'param_name' => 'vsc_text_color',
            'description' => __( 'Base text color', 'ventcamp' )
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Background image', 'ventcamp' ),
            'param_name' => 'vsc_bg_image',
            'description' => __( 'Select rows backgound image', 'ventcamp' )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Use parallax?', 'ventcamp' ),
            'param_name' => 'vsc_parallax',
            'value' => array(
                __( 'Yes, please', 'ventcamp' ) => 'yes'
            )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background overlay color', 'ventcamp' ),
            'param_name' => 'vsc_bg_color',
            'description' => __( 'Background color overlay can be placed on top of background image or used separately', 'ventcamp' )
        )
        ,
        array(
            'type' => 'textarea',
            'heading' => __( 'Background overlay gradient', 'ventcamp' ),
            'param_name' => 'vsc_bg_gradient',
            'value' => '',
            'description' => __( 'Put awesome gradient as an overlay, generate yours at <a target="blank" href="http://www.cssmatic.com/gradient-generator">CSSMatic</a> and just copy-paste the code here!', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Background repeat', 'ventcamp' ),
            'param_name' => 'vsc_bg_repeat',
            'dependency' => array(
                'element' => 'vsc_bg_image',
                'not_empty' => true
            ),
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
            'dependency' => array(
                'element' => 'vsc_bg_image',
                'not_empty' => true
            ),
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
            'dependency' => array(
                'element' => 'vsc_bg_image',
                'not_empty' => true
            ),
            'value' => array(
                __( 'Cover', 'ventcamp' ) => 'cover',
                __( 'Default', 'ventcamp' ) => 'auto',
                __( 'Contain', 'ventcamp' ) => 'contain'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'vsc_class',
            'description' => __( 'Additional class that you can add custom styles to', 'ventcamp' )
        ),

        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'ventcamp' ),
            'param_name' => 'css',
            'group' => __( 'Padding & Margins', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'YouTube video background URL', 'ventcamp' ),
            'param_name' => 'vsc_youtube_url',
            'description' => __( 'Don\'t forget to add an \'Anchor ID\' above and a \'Background image\'. The background image will be used as a cover, for devices that doesn`t play videos automatically (mobile and tablets)', 'ventcamp' ),
            'group' => __( 'Video background', 'ventcamp' )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Video Options', 'ventcamp' ),
            'param_name' => 'vsc_youtube_options',
            'value' => array(
                __( 'Disable autoplay', 'ventcamp' ) => 'autoplay',
                __( 'Disable sound on load', 'ventcamp' ) => 'sound',
                __( 'Play video in loop?', 'ventcamp' ) => 'loop'
            ),
            'dependency' => array(
                'element' => 'vsc_youtube_url',
                'not_empty' => true
            ),
            'group' => __( 'Video background', 'ventcamp' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'YouTube video controls position', 'ventcamp' ),
            'param_name' => 'vsc_youtube_controls',
            'description' => __( 'Video controls position.', 'ventcamp' ),
            'value' => array(
                __( 'Left', 'ventcamp' ) => 'left',
                __( 'Center', 'ventcamp' ) => 'center',
                __( 'Right', 'ventcamp' ) => 'right',
                __( 'Disabled', 'ventcamp' ) => 'none',
            ),
            'dependency' => array(
                'element' => 'vsc_youtube_url',
                'not_empty' => true
            ),
            'group' => __( 'Video background', 'ventcamp' )
        )
    ),

    'js_view' => 'VcRowView'
));
