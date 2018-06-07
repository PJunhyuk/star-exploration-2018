<?php

/**
 * Return an array of custom posts, such as contact forms or modals
 *
 * @param string $post_type Type of the post
 * @param string $not_found_message Message in case if none posts found
 *
 * @return array A list of custom posts with IDs
 */


if (function_exists('ventcamp_build_custom_posts_dropdown')){
    // Get all contact forms
    $contact_forms = ventcamp_build_custom_posts_dropdown( 'wpcf7_contact_form', __( 'No contact forms found', 'ventcamp' ) );
    // Get all modals
    $modals = ventcamp_build_custom_posts_dropdown( 'vivaco-modals', __( 'No modals found', 'ventcamp' ) );
} else {
    $contact_forms = $modals = '';
}

/* HERO STYLE */
Kirki::add_section( 'hero_style_section', array(
    'title'             => __( 'Style', 'ventcamp' ),
    'panel'             => 'hero',
    'priority'          => 4,
    'capability'        => 'edit_theme_options',
) );

// Hero style presets
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_presets',
    'label'             => __( 'Preset', 'ventcamp' ),
    'description'       => __( 'Select hero style preset', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'priority'          => 5,
    'default'           => 'style-1',
    'choices'           => array(
        'style-1'          => __( 'Style 1 (default)', 'ventcamp' ),
        'style-2'          => __( 'Style 2', 'ventcamp' ),
        'style-3'          => __( 'Style 3', 'ventcamp' ),
        'style-4'          => __( 'Style 4', 'ventcamp' ),
    ),
) );

/* STYLE 1 */
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_buttons',
    'label'             => __( 'Hero buttons', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 5,
    'default'           => '2',
    'choices'           => array(
        '0'                 => __( 'no buttons', 'ventcamp' ),
        '1'                 => __( '1 button', 'ventcamp' ),
        '2'                 => __( '2 buttons', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_text',
    'label'             => __( 'Hero main button text', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 6,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_callback',
    'default'           => 'Watch trailer',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_action',
    'label'             => __( 'Hero main button action', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 7,
    'default'           => 'link',
    'choices'           => array(
        'link'                => __( 'External link', 'ventcamp' ),
        'popup'               => __( 'Popup box', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_1_buttons_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_link',
    'label'             => __( 'Main button external link', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 8,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => '#'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_target_blank',
    'label'             => __( 'Open main button link in another tab?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 9,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => 0
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_popup',
    'label'             => __( 'Main button popup box', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'choices'           => $modals,
    'priority'          => 10,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_alt_text',
    'label'             => __( 'Hero button ALT text', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 11,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_callback',
    'default'           => __( 'Get tickets', 'ventcamp' )
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_alt_button_action',
    'label'             => __( 'Hero alt button action', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 12,
    'default'           => 'link',
    'choices'           => array(
        'link'                 => __( 'External link', 'ventcamp' ),
        'popup'                => __( 'Popup box', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_1_buttons_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_alt_link',
    'label'             => __( 'ALT button external link', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 13,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => '#'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_alt_target_blank',
    'label'             => __( 'Open ALT button link in another tab?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 14,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => 0
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_1_button_alt_popup',
    'label'             => __( 'ALT button popup box', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'choices'           => $modals,
    'priority'          => 15,
    'active_callback'   => 'ventcamp_hero_style_1_buttons_action',
    'default'           => ''
) );
/* END STYLE 1 */

/* STYLE 2 */
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_select',
    'label'             => __( 'Form', 'ventcamp' ),
    'description'       => __( 'Select form to use', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'priority'          => 5,
    'default'           => '',
    'choices'           => $contact_forms,
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

// Get Mailchimp API key from settings
$api_key = get_option( 'ventcamp_mailchimp_api_key', '' );
// Check if mailchimp API key is set or not
$mailchimp_message = empty( $api_key ) ? __( 'Enable Mailchimp? (API key is not set! Please set it in theme settings, go to Admin dashboard > Appearance > Ventcamp Settings)', 'ventcamp' ) :
                                         __( 'Enable Mailchimp?', 'ventcamp' );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_use_mailchimp',
    'label'             => $mailchimp_message,
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 6,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_mailchimp_list_id',
    'label'             => __( 'MailChimp List ID', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 8,
    'active_callback'   => 'ventcamp_hero_style_2_mailchimp_enable',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_mailchimp_double_opt_in',
    'label'             => __( 'Double opt-in', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 9,
    'active_callback'   => 'ventcamp_hero_style_2_mailchimp_enable',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_hide_on_submit',
    'label'             => __( 'Hide form on successful submit', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 10,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_redirect',
    'label'             => __( 'Redirect to another page on successful submit', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 11,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_redirect_url',
    'label'             => __( 'Please enter full page url with http://', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 12,
    'active_callback'   => 'ventcamp_hero_style_2_form_redirect',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_enable_form_header',
    'label'             => __( 'Enable form title?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 13,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 1,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_use_contactform7_header',
    'label'             => __( 'Use contact form 7 title as the form title', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 14,
    'active_callback'   => 'ventcamp_hero_style_2_title_enable',
    'default'           => 1,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_header_text',
    'label'             => __( 'Form header text', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 15,
    'active_callback'   => 'ventcamp_hero_style_2_title',
    'default'           => __( 'Event Registration', 'ventcamp' ),
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'typography',
    'settings'          => 'hero_style_2_form_heading',
    'label'             => __( 'Header font', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'priority'          => 16,
    'default'           => array(
        'font-size'         => '24px',
        'font-family'       => 'Roboto',
        'font-weight'       => '400',
        'line-height'       => '1.1',
        'letter-spacing'    => '-0.03em'
    ),
    'choices'           => array(
        'font-style'        => true,
        'font-family'       => true,
        'font-size'         => true,
        'font-weight'       => true,
        'line-height'       => true,
        'letter-spacing'    => true
    ),
    'active_callback'   => 'ventcamp_hero_style_2_title_enable',
    'transport'         => 'postMessage',
    'less'              => 'hero_style_2_form_heading'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_heading_color',
    'label'             => __( 'Form header color', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'kirki-color',
    'priority'          => 17,
    'default'           => '#ff7854',
    'active_callback'   => 'ventcamp_hero_style_2_title_enable',
    'transport'         => 'postMessage',
    'less'              => 'hero_style_2_form_heading_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_label_color',
    'label'             => __( 'Form label color', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'kirki-color',
    'priority'          => 18,
    'default'           => '#51545b',
    'active_callback'   => 'ventcamp_hero_style_callback',
    'transport'         => 'postMessage',
    'less'              => 'hero_style_2_form_label_color'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_2_form_background',
    'label'             => __( 'Form background', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'kirki-color',
    'priority'          => 19,
    'default'           => '#ffffff',
    'choices'           => array(
        'alpha'         => true
    ),
    'active_callback'   => 'ventcamp_hero_style_callback',
    'transport'         => 'postMessage',
    'less'              => 'hero_style_2_form_background'
) );
/* END STYLE 2 */

/* STYLE 3 */
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_form_select',
    'label'             => __( 'Form', 'ventcamp' ),
    'description'       => __( 'Select form to use', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'priority'          => 8,
    'default'           => '',
    'choices'           => $contact_forms,
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_use_mailchimp',
    'label'             => $mailchimp_message,
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 9,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_mailchimp_list_id',
    'label'             => __( 'MailChimp List ID', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 10,
    'active_callback'   => 'ventcamp_hero_style_3_mailchimp_enable',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_mailchimp_double_opt_in',
    'label'             => __( 'Double opt-in', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 11,
    'active_callback'   => 'ventcamp_hero_style_3_mailchimp_enable',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'hero_style_3_form_width',
    'label'             => __( 'Form width', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'default'           => 6,
    'priority'          => 12,
    'choices'           => array(
        'min'           => 1,
        'max'           => 12,
        'step'          => 1,
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'type'              => 'slider',
    'settings'          => 'hero_style_3_form_offset',
    'label'             => __( 'Form offset', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'default'           => 3,
    'priority'          => 13,
    'choices'           => array(
        'min'           => 0,
        'max'           => 12,
        'step'          => 1,
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_form_hide_on_submit',
    'label'             => __( 'Hide form on successful submit', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 14,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_form_redirect',
    'label'             => __( 'Redirect to another page on successful submit', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 15,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 0,
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_form_redirect_url',
    'label'             => __( 'Please enter full page url with http://', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 16,
    'active_callback'   => 'ventcamp_hero_style_3_form_redirect',
    'default'           => '',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_3_enable_form_header',
    'label'             => __( 'Enable form title?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 17,
    'active_callback'   => 'ventcamp_hero_style_callback',
    'default'           => 1,
) );
/* END STYLE 3 */

/* STYLE 4 */
Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_left_image',
    'label'             => __( 'Hero left image', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'image',
    'priority'          => 6,
    'default'           => IMAGESPATH_URI . 'speaker.jpg',
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_left_image_action',
    'label'             => __( 'Hero left image action', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 8,
    'default'           => 'link',
    'choices'           => array(
        'link'                 => __( 'External link', 'ventcamp' ),
        'popup'                => __( 'Popup box', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_left_image_link',
    'label'             => __( 'External link', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 9,
    'active_callback'   => 'ventcamp_hero_style_4_image_callback',
    'default'           => '#'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_left_image_target_blank',
    'label'             => __( 'Open image link in another tab?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 10,
    'active_callback'   => 'ventcamp_hero_style_4_image_callback',
    'default'           => 0
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_left_image_popup',
    'label'             => __( 'Popup box', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'choices'           => $modals,
    'priority'          => 11,
    'active_callback'   => 'ventcamp_hero_style_4_image_callback',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_show_icon',
    'label'             => __( 'Show icon on top of image', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 12,
    'default'           => 'off',
    'choices'           => array(
        'on'            => __( 'On', 'ventcamp' ),
        'off'           => __( 'Off', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_icon_image',
    'label'             => __( 'Icon image', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'image',
    'priority'          => 13,
    'active_callback'   => 'ventcamp_hero_style_4_icon_callback',
    'default'           => IMAGESPATH_URI . 'playbutton.png'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_buttons',
    'label'             => __( 'Hero buttons', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 14,
    'default'           => '2',
    'choices'           => array(
        '0'                 => __( 'no buttons', 'ventcamp' ),
        '1'                 => __( '1 button', 'ventcamp' ),
        '2'                 => __( '2 buttons', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_text',
    'label'             => __( 'Hero main button text', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 15,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_callback',
    'default'           => 'Watch trailer',
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_action',
    'label'             => __( 'Hero main button action', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 16,
    'default'           => 'link',
    'choices'           => array(
        'link'                 => __( 'External link', 'ventcamp' ),
        'popup'                => __( 'Popup box', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_4_buttons_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_link',
    'label'             => __( 'Main button external link', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 17,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => '#'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_target_blank',
    'label'             => __( 'Open main button link in another tab?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 18,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => 0
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_popup',
    'label'             => __( 'Main button popup box', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'choices'           => $modals,
    'priority'          => 19,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => ''
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_alt_text',
    'label'             => __( 'Hero button ALT text', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 20,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_callback',
    'default'           => 'Get tickets'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_alt_button_action',
    'label'             => __( 'Hero alt button action', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'radio',
    'priority'          => 21,
    'default'           => 'link',
    'choices'           => array(
        'link'                 => __( 'External link', 'ventcamp' ),
        'popup'                => __( 'Popup box', 'ventcamp' )
    ),
    'active_callback'   => 'ventcamp_hero_style_4_buttons_callback'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_alt_link',
    'label'             => __( 'ALT button external link', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'text',
    'priority'          => 22,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => '#'
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_alt_target_blank',
    'label'             => __( 'Open ALT button link in another tab?', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'checkbox',
    'priority'          => 23,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => 0
) );

Kirki::add_field( 'ventcamp_theme_config', array(
    'settings'          => 'hero_style_4_button_alt_popup',
    'label'             => __( 'ALT button popup box', 'ventcamp' ),
    'section'           => 'hero_style_section',
    'type'              => 'select',
    'choices'           => $modals,
    'priority'          => 24,
    'active_callback'   => 'ventcamp_hero_style_4_buttons_action',
    'default'           => ''
) );

/* END STYLE 4 */