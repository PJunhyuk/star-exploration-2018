<?php
defined('ABSPATH') or die('No direct access');

//Register 'container' content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __( 'Speakers box (deprecated)', 'ventcamp' ),
    'base' => 'vncp_speakers_box',
    'as_parent' => array('only' => 'vncp_speaker_bio'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'params' => array(
        array(
            'type' => 'notice',
            'param_name' => 'deprecated_notice', 
            'value' =>  __( 'This shortcode is outdated, you can still used it but it is going to be deleted in the future theme versions. We highly suggest to update your speakers list like so: <a href="ventcampwp.com/docs#document-3">read more about it in our docs</a>', 'ventcamp' ),
        ),         
        array(
            'type' => 'dropdown',
            'heading' => __( 'Columns', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'columns',
            'value' => array(
                __( '2 columns', 'ventcamp' ) => '2',
                __( '3 columns', 'ventcamp' ) => '3',
                __( '4 columns', 'ventcamp' ) => '4'
            ),
            'std' => '4'
        ),		
		array(
            'type' => 'dropdown',
            'heading' => __( 'Photo shape', 'ventcamp' ),
            'param_name' => 'photo_shape',
            'value' => array(
                __( 'Round', 'ventcamp' ) => 'round',
                __( 'Rounded square', 'ventcamp' ) => 'rounded-square',
                __( 'Square', 'ventcamp' ) => 'square'
            ),
            'std' => 'round'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Photo size', 'ventcamp' ),
            'param_name' => 'photo_size',
            'value' => array(
                __( 'Small', 'ventcamp' ) => 'sm',
                __( 'Medium', 'ventcamp' ) => 'md',
                __( 'Large', 'ventcamp' ) => 'lg'
            ),
            'std' => 'sm'
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'hide_socials',
            'description' => __( 'Hide social networks under speaker bio and show on hover', 'ventcamp' ),
            'value' => array(
                __( 'Hide socials?', 'ventcamp' ) => 'hide-socials',
            )
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
    'name' => __( 'Speaker Bio', 'ventcamp' ),
    'base' => 'vncp_speaker_bio',
    'content_element' => true,
    'as_child' => array('only' => 'vncp_speakers_box'),
    'params' => array( 
         array(
            'type' => 'notice',
            'param_name' => 'deprecated_notice', 
            'value' =>  __( 'This shortcode is outdated, you can still used it but it is going to be deleted in the future theme versions. We highly suggest to update your speakers list like so: <a href="ventcampwp.com/docs#document-3">read more about it in our docs</a>', 'ventcamp' ),
        ),    
        array(
            'type' => 'textfield',
            'heading' => __( 'Name', 'ventcamp' ),
            'param_name' => 'name',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Position', 'ventcamp' ),
            'param_name' => 'position',
        ),
		
		array(
            'type' => 'textarea',
            'heading' => __( 'About', 'ventcamp' ),
            'param_name' => 'content',
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Photo', 'ventcamp' ),
            'param_name' => 'photo',
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Photo shape', 'ventcamp' ),
            'param_name' => 'photo_shape',
            'value' => array(
                __( 'Default', 'ventcamp' ) => '',
                __( 'Round', 'ventcamp' ) => 'round',
                __( 'Rounded square', 'ventcamp' ) => 'rounded-square',
                __( 'Square', 'ventcamp' ) => 'square',
                __( 'None', 'ventcamp' ) => 'none'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Photo size', 'ventcamp' ),
            'param_name' => 'photo_size',
            'value' => array(
                __( 'Default', 'ventcamp' ) => '',
                __( 'Small', 'ventcamp' ) => 'sm',
                __( 'Medium', 'ventcamp' ) => 'md',
                __( 'Large', 'ventcamp' ) => 'lg',
                __( 'Custom', 'ventcamp' ) => 'custom',
            )
        ),

        array(
            'type' => 'textfield',
            'param_name' => 'custom_photo_size',
            'description' => __( 'Select custom photo size.', 'ventcamp' ),
            'dependency' => array(
                'element' => 'photo_size',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Website', 'ventcamp' ),
            'param_name' => 'website_url',
			'group' => __( 'Links', 'ventcamp' )
        ),            
		array(
            'type' => 'textfield',
            'heading' => __( 'Email', 'ventcamp' ),
            'param_name' => 'email',
			'group' => __( 'Links', 'ventcamp' )
        ),       
		array(
            'type' => 'textfield',
            'heading' => __( 'Facebook', 'ventcamp' ),
            'param_name' => 'facebook_url',
			'group' => __( 'Links', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Twitter', 'ventcamp' ),
            'param_name' => 'twitter_url',
			'group' => __( 'Links', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Google+', 'ventcamp' ),
            'param_name' => 'google_url',
			'group' => __( 'Links', 'ventcamp' )
        ), 
		
		array(
            'type' => 'textfield',
            'heading' => __( 'Linkedin', 'ventcamp' ),
            'param_name' => 'linkedin_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Skype', 'ventcamp' ),
            'param_name' => 'skype_url',
			'group' => __( 'Links', 'ventcamp' )
        ),	
		array(
            'type' => 'textfield',
            'heading' => __( 'Instagram', 'ventcamp' ),
            'param_name' => 'instagram_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Dribbble', 'ventcamp' ),
            'param_name' => 'dribbble_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Behance', 'ventcamp' ),
            'param_name' => 'behance_url',
			'group' => __( 'Links', 'ventcamp' )
        ),
		array(
            'type' => 'textfield',
            'heading' => __( 'Pinterest', 'ventcamp' ),
            'param_name' => 'pinterest_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Youtube', 'ventcamp' ),
            'param_name' => 'youtube_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Soundcloud', 'ventcamp' ),
            'param_name' => 'soundcloud_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Slack', 'ventcamp' ),
            'param_name' => 'slack_url',
			'group' => __( 'Links', 'ventcamp' )
        ),				
		array(
            'type' => 'textfield',
            'heading' => __( 'VKontakte', 'ventcamp' ),
            'param_name' => 'vkontakte_url',
			'group' => __( 'Links', 'ventcamp' )
        ),			
		array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 1', 'ventcamp' ),
            'param_name' => 'custom_url1',
			'group' => __( 'Links', 'ventcamp' )
        ),	
		array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 2', 'ventcamp' ),
            'param_name' => 'custom_url2',
			'group' => __( 'Links', 'ventcamp' )
        ),	array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 3', 'ventcamp' ),
            'param_name' => 'custom_url3',
			'group' => __( 'Links', 'ventcamp' )
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
    'admin_enqueue_js' => preg_replace( '/\s/', '%20', plugins_url( 'javascripts/speaker_view.js', __FILE__ ) ),
    'custom_markup' => '<div class="vc_speaker-element-container"><strong>{{ params.name }}</strong><br><i>{{ params.position }}</i></div>',
    'js_view' => 'VcSpeakerView'
) );


vc_map( array(
    'name' => __( 'Masonry speakers box', 'ventcamp' ),
    'base' => 'vncp_masonry_speakers_box',
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'as_parent' => array('only' => 'vncp_masonry_speaker_bio'),
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
                __( '2 columns', 'ventcamp' ) => '2',
                __( '3 columns', 'ventcamp' ) => '3',
                __( '4 columns', 'ventcamp' ) => '4',
                __( '5 columns', 'ventcamp' ) => '5',
                __( '6 columns', 'ventcamp' ) => '6',
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
    'name' => __( 'Speaker Bio', 'ventcamp' ),
    'base' => 'vncp_masonry_speaker_bio',
    'content_element' => true,
    'as_child' => array('only' => 'vncp_masonry_speakers_box'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Name', 'ventcamp' ),
            'param_name' => 'name',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Position', 'ventcamp' ),
            'param_name' => 'position',
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Photo', 'ventcamp' ),
            'param_name' => 'photo',
        ),

        array(
            'type' => 'textarea',
            'heading' => __( 'About', 'ventcamp' ),
            'param_name' => 'content',
        ),

       array(
            'type' => 'textfield',
            'heading' => __( 'Website', 'ventcamp' ),
            'param_name' => 'website_url',
			'group' => __( 'Links', 'ventcamp' )
        ),            
		array(
            'type' => 'textfield',
            'heading' => __( 'Email', 'ventcamp' ),
            'param_name' => 'email',
			'group' => __( 'Links', 'ventcamp' )
        ),       
		array(
            'type' => 'textfield',
            'heading' => __( 'Facebook', 'ventcamp' ),
            'param_name' => 'facebook_url',
			'group' => __( 'Links', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Twitter', 'ventcamp' ),
            'param_name' => 'twitter_url',
			'group' => __( 'Links', 'ventcamp' )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Google+', 'ventcamp' ),
            'param_name' => 'google_url',
			'group' => __( 'Links', 'ventcamp' )
        ), 
		
		array(
            'type' => 'textfield',
            'heading' => __( 'Linkedin', 'ventcamp' ),
            'param_name' => 'linkedin_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Skype', 'ventcamp' ),
            'param_name' => 'skype_url',
			'group' => __( 'Links', 'ventcamp' )
        ),	
		array(
            'type' => 'textfield',
            'heading' => __( 'Instagram', 'ventcamp' ),
            'param_name' => 'instagram_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Dribbble', 'ventcamp' ),
            'param_name' => 'dribbble_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Behance', 'ventcamp' ),
            'param_name' => 'behance_url',
			'group' => __( 'Links', 'ventcamp' )
        ),
		array(
            'type' => 'textfield',
            'heading' => __( 'Pinterest', 'ventcamp' ),
            'param_name' => 'pinterest_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Youtube', 'ventcamp' ),
            'param_name' => 'youtube_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Soundcloud', 'ventcamp' ),
            'param_name' => 'soundcloud_url',
			'group' => __( 'Links', 'ventcamp' )
        ),		
		array(
            'type' => 'textfield',
            'heading' => __( 'Slack', 'ventcamp' ),
            'param_name' => 'slack_url',
			'group' => __( 'Links', 'ventcamp' )
        ),				
		array(
            'type' => 'textfield',
            'heading' => __( 'VKontakte', 'ventcamp' ),
            'param_name' => 'vkontakte_url',
			'group' => __( 'Links', 'ventcamp' )
        ),			
		array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 1', 'ventcamp' ),
            'param_name' => 'custom_url1',
			'group' => __( 'Links', 'ventcamp' )
        ),	
		array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 2', 'ventcamp' ),
            'param_name' => 'custom_url2',
			'group' => __( 'Links', 'ventcamp' )
        ),	array(
            'type' => 'textfield',
            'heading' => __( 'Custom link 3', 'ventcamp' ),
            'param_name' => 'custom_url3',
			'group' => __( 'Links', 'ventcamp' )
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
    'admin_enqueue_js' => preg_replace( '/\s/', '%20', plugins_url( 'javascripts/speaker_view.js', __FILE__ ) ),
    'custom_markup' => '<div class="vc_speaker-element-container"><strong>{{ params.name }}</strong><br><i>{{ params.position }}</i></div>',
    'js_view' => 'VcSpeakerView'
) );


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vncp_Speakers_Box extends WPBakeryShortCodesContainer {

    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vncp_Speaker_Bio extends WPBakeryShortCode {

    }
}


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vncp_Masonry_Speakers_Box extends WPBakeryShortCodesContainer {

    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vncp_Masonry_Speaker_Bio extends WPBakeryShortCode {

    }
}

