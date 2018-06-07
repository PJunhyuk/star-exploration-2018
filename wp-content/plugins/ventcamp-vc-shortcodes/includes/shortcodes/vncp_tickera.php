<?php
/*
Plugin Name: Ventcamp Tickera Shortcodes for Visual Composer
Plugin URI: http://www.vivaco.com
Description: A Visual Composer Plugin for Tickera
Version: 1.0
Author: Vivaco
Author URI: http://www.vivaco.com
License: GPL2
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//Remove this one later since we already have the same function in customizer-extension
function ventcamp_build_custom_posts_dropdown_tmp ( $post_type, $not_found_message ) {
    // Get all posts by post type and sort them by date (descending order, newest first)
    $posts = get_posts( 'post_type="' . $post_type . '"&posts_per_page=-1&orderby=date&order=DESC' );
    $list = array();

    // If at least one custom post is found
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $list[ $post->ID ] = $post->post_title;
        }
    } else {
        $list[ 0 ] = $not_found_message;
    }

    return $list;
}

function vc_tcr_parseshortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'tcr_shortcode_type' => 'tc_ticket',

        /* set default values from downloads shortcode in VC */
        'tc_ticket_id' => '',
        'tc_ticket_title' => '',
        'tc_ticket_soldout_message' => '',
        'tc_ticket_show_price' => '',
        'tc_ticket_price_position' => '',
        'tc_ticket_type' => '',

        'tc_event_id' => '',
        'tc_event_title' => '',
        'tc_event_ticket_type_title' => '',
        'tc_event_price_title' => '',
        'tc_event_cart_title' => '',
        'tc_event_quantity_title' => '',
        'tc_event_soldout_message' => '',
        'tc_event_quantity' => '',
        'tc_event_type' => '',

        'tc_event_date' => '',
        'tc_event_location' => '',
        'tc_event_sponsors_logo' => '',
        'event_tickets_sold' => '',
        'event_tickets_left' => '',
        'tickets_sold' => '',
        'tickets_left' => '',
        'tc_order_history' => '',

        'tc_event_date_id' => '',
        'tc_event_location_id' => '',
        'tc_event_sponsors_logo_id' => '',
        'event_tickets_sold_id' => '',
        'event_tickets_left_id' => '',
        'tickets_sold_id' => '',
        'tickets_left_id' => '',
        'tc_order_history_id' => '',
        

    ), $atts);
    return do_shortcode(prepareShortcode($atts));
}

function prepareShortcode($atts) {
    if($atts['tcr_shortcode_type'] === 'tc_ticket') {
        $shortcode = '[tc_ticket ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_ticket_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_ticket_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }
    elseif($atts['tcr_shortcode_type'] === 'tc_event') {
        $shortcode = '[tc_event ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_event_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_event_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }   
    // TO REFACTOR LATER  
    elseif($atts['tcr_shortcode_type'] === 'event_tickets_sold') {
        $shortcode = '[event_tickets_sold ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'event_tickets_sold_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('event_tickets_sold_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }   
    elseif($atts['tcr_shortcode_type'] === 'tc_event_date') {
        $shortcode = '[tc_event_date ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_event_date_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_event_date_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }       
    elseif($atts['tcr_shortcode_type'] === 'tc_event_location') {
        $shortcode = '[tc_event_location ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_event_location_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_event_location_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }       
    elseif($atts['tcr_shortcode_type'] === 'tc_event_sponsors_logo') {
        $shortcode = '[tc_event_sponsors_logo ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_event_sponsors_logo_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_event_sponsors_logo_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }       
    elseif($atts['tcr_shortcode_type'] === 'event_tickets_sold') {
        $shortcode = '[event_tickets_sold ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'event_tickets_sold_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('event_tickets_sold_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }       
    elseif($atts['tcr_shortcode_type'] === 'event_tickets_left') {
        $shortcode = '[event_tickets_left ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'event_tickets_left_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('event_tickets_left_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }       
    elseif($atts['tcr_shortcode_type'] === 'tickets_left') {
        $shortcode = '[tickets_left ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tickets_left_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tickets_left_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    } 
    elseif($atts['tcr_shortcode_type'] === 'tickets_sold') {
        $shortcode = '[tickets_sold ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tickets_sold_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tickets_sold_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }  
    elseif($atts['tcr_shortcode_type'] === 'tc_order_history') {
        $shortcode = '[tc_order_history ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'tc_order_history_') !== false) && $key != 'tcr_shortcode_type' && $param != ''){
                $shortcode .= str_replace('tc_order_history_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }    
}

    $tickets_list = $events_list = '';
    $tickets_list = array_flip(ventcamp_build_custom_posts_dropdown_tmp('tc_tickets', 'No Tickera Tickets Found'));
    $events_list = array_flip(ventcamp_build_custom_posts_dropdown_tmp('tc_events', 'No Tickera Tickets Found'));
  vc_map(array(
            "name" => __("Ventcamp Tickera Shortcodes", 'vivaco'),
            // "admin_enqueue_css" => array(
            //     TCRVC_URL . '/css/custom_vc.css'
            // ),
            "base" => "vncp_tickera",
            'category' => __( 'Ventcamp', 'ventcamp' ),
            "icon" => "icon-vc-tickera",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Select the shortcode", 'vivaco'),
                    "param_name" => "tcr_shortcode_type",
                    "value" => array(
                        __('Ticket / Add to cart button – [tc_ticket]', 'vivaco') => 'tc_ticket',
                        __('Event Tickets – [tc_event]', 'vivaco') => 'tc_event',
                        __('Event Date & Time – [tc_event_date]', 'vivaco') => 'tc_event_date',
                        __('Event Location – [tc_event_location]', 'vivaco') => 'tc_event_location',
                        __('Event Terms & Conditions – [tc_event_terms]', 'vivaco') => 'tc_event_terms',
                        __('Event Logo – [tc_event_logo]', 'vivaco') => 'tc_event_logo',
                        __('Event Sponsors Logo – [tc_event_sponsors_logo]', 'vivaco') => 'tc_event_sponsors_logo',
                        __('Number of tickets sold for an event – [event_tickets_sold]', 'vivaco') => 'event_tickets_sold',
                        __('Number of tickets left for an event – [event_tickets_left]', 'vivaco') => 'event_tickets_left',
                        __('Number of sold tickets – [tickets_sold]', 'vivaco') => 'tickets_sold',
                        __('Number of available tickets – [tickets_left]', 'vivaco') => 'tickets_left',
                        __('Display order history for a user – [tc_order_history]', 'vivaco') => 'tc_order_history',
                    ),
                    "description" => __("Select the shortcode you want to use.", 'vivaco')
                ),

// [tc_ticket] VC params
                 array(
                    "type" => "dropdown",
                    "heading" => __("Ticket Type", 'vivaco'),
                    "param_name" => "tc_ticket_id",
                     "value" => $tickets_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),  
                array(
                    "type" => "textfield",
                    "heading" => __("Link Title", 'vivaco'),
                    "param_name" => "tc_ticket_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Soldout Message", 'vivaco'),
                    "param_name" => "tc_ticket_soldout_message",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),    
                array(
                    "type" => "dropdown",
                    "heading" => __("Show Price", 'vivaco'),
                    "param_name" => "tc_ticket_show_price",
                    "value" => array(
                                'No' => '',
                                'Yes' => 'true',
                                ),
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),  
                array(
                    "type" => "dropdown",
                    "heading" => __("Price Position", 'vivaco'),
                    "param_name" => "tc_ticket_price_position",
                    "value" => array(
                                'Before' => 'before',
                                'After' => '',
                                ),
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),  
                array(
                    "type" => "dropdown",
                    "heading" => __("Link Type", 'vivaco'),
                    "param_name" => "tc_ticket_type",
                     "value" => array(
                                'Cart' => '',
                                'Buy Now' => 'buynow',
                                ),
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_ticket',
                        )
                    )
                ),          


// [tc_events] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),       
                array(
                    "type" => "textfield",
                    "heading" => __("Link Title", 'vivaco'),
                    "param_name" => "tc_event_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),                  
                array(
                    "type" => "textfield",
                    "heading" => __("Ticket Type Column Title", 'vivaco'),
                    "param_name" => "tc_event_ticket_type_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),                  
                array(
                    "type" => "textfield",
                    "heading" => __("Price Column Title", 'vivaco'),
                    "param_name" => "tc_event_price_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),                  
                array(
                    "type" => "textfield",
                    "heading" => __("Cart Column Title", 'vivaco'),
                    "param_name" => "tc_event_cart_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),                  
                array(
                    "type" => "textfield",
                    "heading" => __("Quantity Column Title", 'vivaco'),
                    "param_name" => "tc_event_quantity_title",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ), 
                array(
                    "type" => "textfield",
                    "heading" => __("Soldout Message", 'vivaco'),
                    "param_name" => "tc_event_soldout_message",
                    "value" => '',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ), 
                array(
                    "type" => "dropdown",
                    "heading" => __("Show Quantity Selector", 'vivaco'),
                    "param_name" => "tc_event_quantity",
                    "value" => array(
                                'No' => '',
                                'Yes' => 'true',
                                ),
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Link Type", 'vivaco'),
                    "param_name" => "tc_event_type",
                     "value" => array(
                                'Cart' => '',
                                'Buy Now' => 'buynow',
                                ),
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event',
                        )
                    )
                ),    

// [tc_event_date] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_date_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event_date',
                        )
                    )
                ),
// [tc_event_location] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_location_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event_location',
                        )
                    )
                ), 
// [tc_event_terms] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_terms_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event_terms',
                        )
                    )
                ),  
// [tc_event_logo] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_logo_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event_logo',
                        )
                    )
                ),  
// [tc_event_sponsors_logo] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tc_event_sponsors_logo_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_event_sponsors_logo',
                        )
                    )
                ), 
// [event_tickets_sold] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "event_tickets_sold_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'event_tickets_sold',
                        )
                    )
                ),  
// [event_tickets_left] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "event_tickets_left_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'event_tickets_left',
                        )
                    )
                ),  
// [tickets_sold] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tickets_sold_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tickets_sold',
                        )
                    )
                ),
// [tickets_left] VC params
                array(
                    "type" => "dropdown",
                    "heading" => __("Event", 'vivaco'),
                    "param_name" => "tickets_left_id",
                     "value" => $events_list,
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tickets_left',
                        )
                    )
                ),
// [tc_order_history] VC params
                array(
                    "type" => "textfield",
                    "heading" => __("Current logged in user", 'vivaco'),
                    "param_name" => "tc_order_history",
                    "value" => '',
                    "class" => 'hidden',
                    "description" => __("", 'vivaco'),
                    "dependency" => array(
                        'element' => "tcr_shortcode_type",
                        'value' => array(
                            'tc_order_history',
                        )
                    )
                ),
            )
        ));


add_shortcode('vncp_tickera', 'vc_tcr_parseshortcode');