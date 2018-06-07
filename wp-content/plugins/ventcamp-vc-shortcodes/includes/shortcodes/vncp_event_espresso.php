<?php
/*
Plugin Name: Ventcamp EventEspresso Shortcodes for Visual Composer
Plugin URI: http://www.vivaco.com
Description: A Visual Composer Plugin for EventEspresso
Version: 1.0
Author: Vivaco
Author URI: http://www.vivaco.com
License: GPL2
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
 
    $events_list = ''; 
    $events_list = array_flip(ventcamp_build_custom_posts_dropdown('espresso_events', 'No EventEspresso events Found'));

    vc_map(array(
            "name" => __("Ventcamp EventEspresso Shortcodes", 'vivaco'),
            "base" => "vncp_event_espresso",
            "category" => __('Ventcamp', 'vivaco'), 
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Select the shortcode", 'vivaco'),
                    "param_name" => "eespresso_shortcode_type",
                    "value" => array(
                        __('List Events – [ESPRESSO_EVENTS]', 'vivaco') => 'eespresso_events',
                        __('Ticket Selector – [ESPRESSO_TICKET_SELECTOR]', 'vivaco') => 'eespresso_tickets',
                    ),
                    "description" => __("Select the shortcode you want to use.", 'vivaco')
                ),

 
                 array(
                    "type" => "checkbox",
                    "heading" => __("Show expired?", 'vivaco'),
                    "param_name" => "eespresso_events_expired",
                    'value' => array(
                        __( 'Show expired tickets', 'ventcamp' ) => 'show',
                    ),
                    "description" => __("Show your events including expired events", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_events',
                        )
                    )
                ),
                /*  
                array(
                    "type" => "textfield",
                    "heading" => __("Custom event list title", 'vivaco'),
                    "param_name" => "eespresso_events_title",
                    "value" => '',
                    "description" => __("Set a custom title for the event list", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_events',
                        )
                    )
                ),
                */
                array(  
                    "type" => "textfield",
                    "heading" => __("Limit events shown", 'vivaco'),
                    "param_name" => "eespresso_events_limit",
                    "value" => '',
                    "description" => __("Limit the number of events that are shown in the event list", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_events',
                        )
                    )
                ),                  
                array(  
                    "type" => "textfield",
                    "heading" => __("Filter events", 'vivaco'),
                    "param_name" => "eespresso_events_filter",
                    "value" => '',
                    "description" => __("Filter the event list by month and year e.g. \"December 2017\"", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_events',
                        )
                    )
                ),                    
                array(  
                    "type" => "dropdown",
                    "heading" => __("Sort events", 'vivaco'),
                    "param_name" => "eespresso_events_sort",
                    "value" => array(
                                'Ascending' => 'ASC',
                                'Descending' => 'DESC',
                                ),
                    "description" => __("Sorts the event list in ascending order", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_events',
                        )
                    )
                ),    

                array(
                    "type" => "dropdown",
                    "heading" => __("Select event", 'vivaco'),
                    "param_name" => "eespresso_tickets_id",
                    "value" => $events_list,
                    "description" => __("Select an Event to show tickets for", 'vivaco'),
                    "dependency" => array(
                        'element' => "eespresso_shortcode_type",
                        'value' => array(
                            'eespresso_tickets',
                        )
                    )
                ),   
            )
        ));
function vc_eespresso_parseshortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'eespresso_shortcode_type' => 'eespresso_events',
        'eespresso_events_expired' => '',
        'eespresso_events_title' => ' ',
        'eespresso_events_limit' => '',
        'eespresso_events_filter' => '',
        'eespresso_events_sort' => '',
        'eespresso_tickets_id' => '',

    ), $atts); 
    return do_shortcode(prepareEspressoShortcode($atts));
}

function prepareEspressoShortcode($atts) {
    if($atts['eespresso_shortcode_type'] === 'eespresso_events') {
        $shortcode = '[vc_row vsc_class="vc-events-list"][vc_column][ESPRESSO_EVENTS ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'eespresso_events_') !== false) && $key != 'eespresso_shortcode_type' && $param != ''){
                $shortcode .= str_replace('eespresso_events_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= '][/vc_column][/vc_row]';
        return $shortcode;
    }
    elseif($atts['eespresso_shortcode_type'] === 'eespresso_tickets') {
        $shortcode = '[vc_row vsc_class="vc-ticket-selector"][vc_column][ESPRESSO_TICKET_SELECTOR  ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'eespresso_tickets_') !== false) && $key != 'eespresso_shortcode_type' && $param != ''){
                $shortcode .= str_replace('eespresso_tickets_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= '][/vc_column][/vc_row]';
        return $shortcode;
    } 
}

add_shortcode('vncp_event_espresso', 'vc_eespresso_parseshortcode');