<?php

if( !function_exists('ventcamp_logo_callback') ) {
    function ventcamp_logo_callback( $control ) {

        // $mngr = $control->manager->get_setting('');

        $radio_setting = Kirki::get_option( 'ventcamp_theme_config', 'logotype_type' );

        // = $control->manager->get_setting('logotype_type')->value();

        $images_controls = array('logotype_image','logotype_image_retina');
        $text_controls = array(
            'logotype_text',
            'logotype_typography',
            'logotype_font_family',
            'logotype_font_weight',
            'logotype_font_size',
            'logotype_font_letter_spacing',
            'logotype_font_style',
            'logotype_color'
        );

        if ( in_array($control->id, $text_controls) && $radio_setting == 'text' ) return true;
        if ( in_array($control->id, $images_controls) && $radio_setting == 'image' ) return true;

        return false;
    }
}

if( !function_exists('ventcamp_button_icon_callback') ) {
    function ventcamp_button_icon_callback($control){
        return Kirki::get_option( 'ventcamp_theme_config', 'buttons_style_add_icon' );
    }
}

if( !function_exists('ventcamp_boxed_background_callback') ) {
    function ventcamp_boxed_background_callback( $control ) {
        return Kirki::get_option( 'ventcamp_theme_config', 'layout_boxed' );
    }
}

if( !function_exists('ventcamp_footer_widgets_callback') ) {
    function ventcamp_footer_widgets_callback($control){
        return Kirki::get_option( 'ventcamp_theme_config', 'footer_widgets_enable' );
    }
}

if( !function_exists('ventcamp_hero_enable_callback') ) {
    function ventcamp_hero_enable_callback($control){
        return intval(Kirki::get_option( 'ventcamp_theme_config', 'hero_display' )) > 0;
    }
}

if( !function_exists('ventcamp_hero_style_callback') ) {
    /**
     * Show controls depending on which hero style is chosen.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_callback($control){
        // Get hero skin setting
        $style_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_presets' );

        // All hero style 1 settings
        $style1_settings = array(
            'hero_style_1_buttons',
            'hero_style_1_button_text',
            'hero_style_1_button_action',
            'hero_style_1_button_link',
            'hero_style_1_button_target_blank',
            'hero_style_1_button_popup',
            'hero_style_1_alt_button_action',
            'hero_style_1_button_alt_text',
            'hero_style_1_button_alt_link',
            'hero_style_1_button_alt_target_blank',
            'hero_style_1_button_alt_popup'
        );

        // All hero style 2 settings
        $style2_settings = array(
            'hero_style_2_enable_form_header',
            'hero_style_2_use_contactform7_header',
            'hero_style_2_use_mailchimp',
            'hero_style_2_form_hide_on_submit',
            'hero_style_2_form_redirect',
            'hero_style_2_form_redirect_url',
            'hero_style_2_mailchimp_list_id',
            'hero_style_2_mailchimp_double_opt_in',
            'hero_style_2_form_header_text',
            'hero_style_2_form_heading',
            'hero_style_2_form_background',
            'hero_style_2_form_heading_color',
            'hero_style_2_form_label_color',
            'hero_style_2_form_select'
        );

        // All hero style 3 settings
        $style3_settings = array(
            'hero_style_3_form_select',
            'hero_style_3_form_width',
            'hero_style_3_form_offset',
            'hero_style_3_use_mailchimp',
            'hero_style_3_form_hide_on_submit',
            'hero_style_3_form_redirect',
            'hero_style_3_form_redirect_url',
            'hero_style_3_mailchimp_list_id',
            'hero_style_3_mailchimp_double_opt_in',
        );

        // All hero style 4 settings
        $style4_settings = array(
            'hero_style_4_left_image',
            'hero_style_4_left_image_action',
            'hero_style_4_left_image_link',
            'hero_style_4_left_image_target_blank',
            'hero_style_4_left_image_popup',
            'hero_style_4_show_icon',
            'hero_style_4_icon_image',
            'hero_style_4_buttons',
            'hero_style_4_button_text',
            'hero_style_4_button_action',
            'hero_style_4_button_link',
            'hero_style_4_button_target_blank',
            'hero_style_4_button_popup',
            'hero_style_4_button_alt_text',
            'hero_style_4_alt_button_action',
            'hero_style_4_button_alt_link',
            'hero_style_4_button_alt_target_blank',
            'hero_style_4_button_alt_popup'
        );

        // If default skin or first style was chosen
        if ( in_array( $control->id, $style1_settings ) && ( $style_setting == 'style-1' ) ){
            return true;
        }

        // If second style was chosen
        if ( in_array( $control->id, $style2_settings ) &&  ( $style_setting == 'style-2' ) ){
            return true;
        }

        // If third style was chosen
        if ( in_array( $control->id, $style3_settings ) &&  ( $style_setting == 'style-3' ) ){
            return true;
        }

        // If forth style was chosen
        if ( in_array( $control->id, $style4_settings ) && ( $style_setting == 'style-4' ) ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_1_buttons_callback') ) {
    /**
     * Show button-related controls depending on the amount of buttons from settings.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_1_buttons_callback($control){
        if( !ventcamp_hero_style_callback( $control ) ){
            return false;
        }

        // Get amount of buttons from settings
        $buttons = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_1_buttons' );

        // All main button-related settings
        $main_button_controls = array(
            'hero_style_1_button_text',
            'hero_style_1_button_action',
            'hero_style_1_button_link',
            'hero_style_1_button_target_blank',
            'hero_style_1_button_popup'
        );

        // All alt button-related settings
        $alt_button_controls = array(
            'hero_style_1_button_alt_text',
            'hero_style_1_alt_button_action',
            'hero_style_1_button_alt_link',
            'hero_style_1_button_alt_target_blank',
            'hero_style_1_button_alt_popup'
        );

        // Hide all controls if 0 buttons are set in settings
        if ( ( in_array( $control->id, $main_button_controls ) ||
               in_array( $control->id, $alt_button_controls ) ) && $buttons == '0' ) {
            return false;
        }

        // If only one button, show main button controls
        if ( in_array( $control->id, $main_button_controls ) && $buttons == '1' ) {
            return true;
        }

        // If two buttons, show controls for both main and alt buttons
        if ( ( in_array( $control->id, $main_button_controls ) ||
               in_array( $control->id, $alt_button_controls ) ) && $buttons == '2' ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_1_buttons_action') ) {
    /**
     * Show target settings depending on what action was chosen.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_1_buttons_action($control){
        if( !ventcamp_hero_style_1_buttons_callback( $control ) ){
            return false;
        }

        // Get button actions
        $main_button_action = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_1_button_action' );
        $alt_button_action = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_1_alt_button_action' );

        // MAIN BUTTON:
        // If link was chosen, show link setting
        // If popup was chosen, show popup setting
        if ( ( $control->id == 'hero_style_1_button_link' && $main_button_action == 'link' ) ||
             ( $control->id == 'hero_style_1_button_target_blank' && $main_button_action == 'link' ) ||
             ( $control->id == 'hero_style_1_button_popup' && $main_button_action == 'popup' ) ) {
            return true;
        }

        // ALT BUTTON:
        // If link was chosen, show link setting
        // If popup was chosen, show popup setting
        if ( ( $control->id == 'hero_style_1_button_alt_link' && $alt_button_action == 'link' ) ||
             ( $control->id == 'hero_style_1_button_alt_target_blank' && $alt_button_action == 'link' ) ||
             ( $control->id == 'hero_style_1_button_alt_popup' && $alt_button_action == 'popup' ) ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_2_title_enable') ) {
    /**
     * Show title-related settings if title is enabled.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_2_title_enable($control){
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Is header enabled?
        $enable_header = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_2_enable_form_header' );
        // Header-related settings
        $header_settings = array(
            'hero_style_2_use_contactform7_header',
            'hero_style_2_form_header_text',
            'hero_style_2_form_heading',
            'hero_style_2_form_heading_color'
        );

        // If yes, show header-related settings
        if ( in_array( $control->id, $header_settings ) && $enable_header == 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_2_mailchimp_enable') ) {
    /**
     * Show MailChimp-related settings if MailChimp is enabled.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_2_mailchimp_enable($control){
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Is MailChimp enabled?
        $enable_mailchimp = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_2_use_mailchimp' );
        // MailChimp settings
        $mailchimp_settings = array(
            'hero_style_2_mailchimp_list_id',
            'hero_style_2_mailchimp_double_opt_in'
        );

        // If yes, show MailChimp-related settings
        if ( in_array( $control->id, $mailchimp_settings ) && $enable_mailchimp == 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_2_form_redirect') ) {
    /**
     * Show form redirect to URL field if redirect is enabled.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_2_form_redirect($control){
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Is redirect enabled?
        $enable_redirect = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_2_form_redirect' );

        // If redirect is enabled, show redirect to URL field
        if ( $control->id == 'hero_style_2_form_redirect_url' && $enable_redirect == 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_2_title') ) {
    /**
     * Show custom header text field if needed.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_2_title($control){
        if( !ventcamp_hero_style_2_title_enable( $control ) ){
            return false;
        }

        // Is default contact form 7 used?
        $custom_title = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_2_use_contactform7_header' );

        // If not, show custom setting text field
        if ( $control->id == 'hero_style_2_form_header_text' && $custom_title != 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_3_mailchimp_enable') ) {
    /**
     * Show MailChimp-related settings if MailChimp is enabled.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_3_mailchimp_enable($control){
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Is MailChimp enabled?
        $enable_mailchimp = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_3_use_mailchimp' );
        // MailChimp settings
        $mailchimp_settings = array(
            'hero_style_3_mailchimp_list_id',
            'hero_style_3_mailchimp_double_opt_in'
        );

        // If yes, show MailChimp-related settings
        if ( in_array( $control->id, $mailchimp_settings ) && $enable_mailchimp == 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_3_form_redirect') ) {
    /**
     * Show form redirect to URL field if redirect is enabled.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_3_form_redirect($control){
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Is redirect enabled?
        $enable_redirect = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_3_form_redirect' );

        // If redirect is enabled, show redirect to URL field
        if ( $control->id == 'hero_style_3_form_redirect_url' && $enable_redirect == 1 ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_4_buttons_callback') ) {
    /**
     * Show button-related controls depending on the amount of buttons from settings.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_4_buttons_callback($control){
        if(!ventcamp_hero_style_callback($control)){
            return false;
        }

        // Get amount of buttons from settings
        $buttons = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_4_buttons' );

        // All main button related settings
        $main_button_controls = array(
            'hero_style_4_button_text',
            'hero_style_4_button_action',
            'hero_style_4_button_link',
            'hero_style_4_button_target_blank',
            'hero_style_4_button_popup'
        );

        // All alt button related settings
        $alt_button_controls = array(
            'hero_style_4_button_alt_text',
            'hero_style_4_alt_button_action',
            'hero_style_4_button_alt_link',
            'hero_style_4_button_alt_target_blank',
            'hero_style_4_button_alt_popup'
        );

        // Hide all controls if 0 buttons are set in settings
        if ( ( in_array( $control->id, $main_button_controls ) ||
               in_array( $control->id, $alt_button_controls ) ) && $buttons == '0' ) {
            return false;
        }

        // If only one button, show main button controls
        if ( in_array( $control->id, $main_button_controls ) && $buttons == '1' ) {
            return true;
        }

        // If two buttons, show controls for both main and alt buttons
        if ( ( in_array( $control->id, $main_button_controls ) ||
               in_array( $control->id, $alt_button_controls ) ) && $buttons == '2' ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_4_buttons_action') ) {
    /**
     * Show target settings depending on what action was chosen.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_4_buttons_action($control){
        if ( !ventcamp_hero_style_4_buttons_callback( $control ) ){
            return false;
        }

        // Get button actions
        $main_button_action = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_4_button_action' );
        $alt_button_action = Kirki::get_option( 'ventcamp_theme_config', 'hero_style_4_alt_button_action' );

        // MAIN BUTTON:
        // If link was chosen, show link setting
        // If popup was chosen, show popup setting
        if ( ( $control->id == 'hero_style_4_button_link' && $main_button_action == 'link' ) ||
             ( $control->id == 'hero_style_4_button_target_blank' && $main_button_action == 'link' ) ||
             ( $control->id == 'hero_style_4_button_popup' && $main_button_action == 'popup' ) ) {
            return true;
        }

        // ALT BUTTON:
        // If link was chosen, show link setting
        // If popup was chosen, show popup setting
        if ( ( $control->id == 'hero_style_4_button_alt_link' && $alt_button_action == 'link' ) ||
             ( $control->id == 'hero_style_4_button_alt_target_blank' && $alt_button_action == 'link' ) ||
             ( $control->id == 'hero_style_4_button_alt_popup' && $alt_button_action == 'popup' ) ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_4_image_callback') ) {
    /**
     * Show target settings depending on what action was chosen.
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_4_image_callback($control)
    {
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Get image action
        $left_image_action = Kirki::get_option('ventcamp_theme_config', 'hero_style_4_left_image_action');

        // IMAGE:
        // If link was chosen, show link setting
        // If popup was chosen, show popup setting
        if ( ( $control->id == 'hero_style_4_left_image_link' && $left_image_action == 'link' ) ||
             ( $control->id == 'hero_style_4_left_image_target_blank' && $left_image_action == 'link' ) ||
             ( $control->id == 'hero_style_4_left_image_popup' && $left_image_action == 'popup' ) ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_style_4_icon_callback') ) {
    /**
     * Show icon settings if icon is enabled
     *
     * @param object $control Current control
     *
     * @return bool True if control needs to be showed
     */
    function ventcamp_hero_style_4_icon_callback($control)
    {
        if ( !ventcamp_hero_style_callback( $control ) ) {
            return false;
        }

        // Get button actions
        $show_icon = Kirki::get_option('ventcamp_theme_config', 'hero_style_4_show_icon');

        if ( ($control->id == 'hero_style_4_icon_image' && $show_icon == 'on') ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_menu_button_enable_callback') ) {
    /**
     * Check if menu button is enabled in settings
     *
     * @param $control
     * @return bool
     */
    function ventcamp_menu_button_enable_callback($control){
        $header_format_setting = Kirki::get_option( 'ventcamp_theme_config', 'header_format_style' );

        if ( $control->id == 'header_button_text' && ( $header_format_setting == 'menu_button' || $header_format_setting == 'logo_menu_button' ) ){
            return true;
        } else if ( $control->id == 'header_button_link' && ( $header_format_setting == 'menu_button' || $header_format_setting == 'logo_menu_button' ) ){
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_background_type_callback') ) {
    function ventcamp_hero_background_type_callback($control){
        if(!ventcamp_hero_enable_callback(null)){
            return false;
        }

        $background_type_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_background_type' );
        $video_background_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_background_video_settings' );

        $control_id = $control->id;

        if($control_id == 'hero_background_color' && $background_type_setting == 'color'){
            return true;
        }else if($control_id == 'hero_background_image' && $background_type_setting == 'image'){
            return true;
        }else if($background_type_setting == 'video'){
            if ($control_id == 'hero_background_video' || $control_id == 'hero_background_video_settings'){
                return true;
            } else if ($control_id == 'hero_background_video_controls' && is_array($video_background_setting) && in_array('controls', $video_background_setting)){
                return true;
            }
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_buttons_callback') ) {
    function ventcamp_hero_buttons_callback($control){
        if(!ventcamp_hero_enable_callback(null)){
            return false;
        }

        $control_id = $control->id;

        $hero_buttons_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_buttons' );

        if(intval($hero_buttons_setting) == 0){
            return false;
        }else if(intval($hero_buttons_setting) == 2){
            return true;
        }else if(intval($hero_buttons_setting) == 1 &&
            ($control_id == 'hero_button_text' || $control_id == 'hero_button_link') ){
            return true;
        }

    }
}

if( !function_exists('ventcamp_hero_top_line_callback') ) {
    function ventcamp_hero_top_line_callback($control){
        if(!ventcamp_hero_enable_callback(null)){
            return false;
        }

        $control_id = $control->id;

        $hero_top_line_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_top_line_type' );

        if($control_id == 'hero_social' && $hero_top_line_setting == 'social'){
            return true;
        }else if($control_id == 'hero_top_line_text' && $hero_top_line_setting == 'text'){
            return true;
        }else{
            return false;
        }

    }
}

if( !function_exists('ventcamp_hero_overlay_callback') ) {
    function ventcamp_hero_overlay_callback($control){
        if(!ventcamp_hero_enable_callback(null)){
            return false;
        }

        $overlay_type_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_overlay_type' );

        $control_id = $control->id;

        if($control_id == 'hero_overlay_color' && $overlay_type_setting == 'color'){
            return true;
        }else if($control_id == 'hero_overlay_gradient' && $overlay_type_setting == 'gradient'){
            return true;
        }

        return false;
    }
}

if( !function_exists('ventcamp_hero_heading_type_callback') ) {
    function ventcamp_hero_heading_type_callback($control){
        if(!ventcamp_hero_enable_callback(null)){
            return false;
        }

        $radio_setting = Kirki::get_option( 'ventcamp_theme_config', 'hero_heading_type' );

        // = $control->manager->get_setting('logotype_type')->value();
        $control_id = $control->id;

        $images_controls = array('hero_heading_image','hero_heading_image_retina');
        $text_controls = array('hero_heading_text','hero_heading_typography');

        if ( in_array($control_id, $text_controls) && $radio_setting == 'text' ) return true;
        if ( in_array($control_id, $images_controls) && $radio_setting == 'image' ) return true;

        return false;
    }
}

if( !function_exists('ventcamp_unfiltered_callback') ) {
    /**
     * Helper function, just returns the value that was passed in.
     *
     * @param string $value String that should not be sanitized
     *
     * @return string Original string
     */
    function ventcamp_unfiltered_callback( $value = '' ) {
        return $value;
    }
}