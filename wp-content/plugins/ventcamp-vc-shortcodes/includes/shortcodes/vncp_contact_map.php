<?php

/*-----------------------------------------------------------------------------------*/
/*  Contact Map VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/

defined('ABSPATH') or die('No direct access');


vc_map( array(
    'base' => 'vncp_contact_map',
    'name' => __( 'Advanced Google Map', 'ventcamp' ),
    'category' => __( 'Ventcamp', 'vivaco' ),
    'description' => __( 'Google map with markers & balloons', 'ventcamp' ),
    'show_settings_on_create' => true,
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Address type', 'ventcamp' ),
            'param_name' => 'marker_type',
            'value' => array(
                __( 'Address/street name', 'ventcamp' ) => 'address',
                __( 'Lat/Long coordinates', 'ventcamp' ) => 'coordinates',
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Latitude', 'ventcamp' ),
            'param_name' => 'latitude',
            'dependency' => array(
                'element' => 'marker_type',
                'value' => 'coordinates'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Longitude', 'ventcamp' ),
            'param_name' => 'longitude',
            'dependency' => array(
                'element' => 'marker_type',
                'value' => 'coordinates'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Map address', 'ventcamp' ),
            'param_name' => 'address',
            'dependency' => array(
                'element' => 'marker_type',
                'value' => 'address'
            )
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Remove adaptive row fullwidth/fullheight?', 'ventcamp' ),
            'description' => __( 'By default maps will take all the space or parent Row container, but you can disable this and set custom width/height instead', 'ventcamp' ),
            'param_name' => 'relative_size'
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Map width', 'ventcamp' ),
            'param_name' => 'width',
            'dependency' => array(
                'element' => 'relative_size',
                'value' => 'true',
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Map height', 'ventcamp' ),
            'param_name' => 'height',
            'dependency' => array(
                'element' => 'relative_size',
                'value' => 'true',
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Map default zoom', 'ventcamp' ),
            'param_name' => 'zoom',
            'value' => '15'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Offset type', 'ventcamp' ),
            'param_name' => 'offset_type',
            'value' => array(
                __( 'Pixels', 'ventcamp' ) => 'absolute',
                __( 'Percentage', 'ventcamp' ) => 'relative'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Horizontal offset', 'ventcamp' ),
            'param_name' => 'offset_x'
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Vertical offset', 'ventcamp' ),
            'param_name' => 'offset_y'
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Custom marker image', 'vivaco' ),
            'param_name' => 'icon'
        ),

        array(
            'type' => 'textarea',
            'heading' => __( 'Balloons addresses', 'ventcamp' ),
            'param_name' => 'balloons'
        ),
    ),

    'js_view' => 'VCTemplateView'
) );


function cleanString($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


function vncp_contact_map_handler($atts, $content = null) {
    $output = $width = $height = $zoom = $add_marker = $icon = $offset_type = '';
    $marker_type = $latitude = $longitude = $longitude = $balloons = $offset_x = $offset_y = '';
    $api_key = get_option('ventcamp_gmaps_api_key', '');

    $error = false;

	wp_enqueue_script( 'googleMaps' , "https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=" . $api_key, null, false, true );

    extract(shortcode_atts(array(
        'marker_type' => 'address',
        'latitude' => '',
        'longitude' => '',
        'address' => '',
        'relative_size' => '',
        'width' => '',
        'height' => '',
        'zoom' => '15',
        'offset_type' => 'absolute',
        'offset_x' => '',
        'offset_y' => '',
        'icon' => '',
        'balloons' => ''
    ), $atts));

    $latitude = floatval($latitude);
    $longitude = floatval($longitude);
    $address = str_replace('"', '\'', $address);
    $width = intval($width);
    $height = intval($height);
    $offset_x = floatval($offset_x);
    $offset_y = floatval($offset_y);
    $zoom = intval($zoom);
    $balloons = str_replace('<br />', '|', $balloons);
    $balloons = str_replace('\n', '|', $balloons);
    $balloons = str_replace('"', '\'', $balloons);

    $output = '<div class="vncp-map"';

    if ( $marker_type == 'address' && !empty($address) ) {
        $output .= ' data-address="' . $address . '"';

    }else if ( !empty($latitude) && !empty($longitude) ) {
        $output .= ' data-latitude="' . $latitude . '" data-longitude="' . $longitude . '"';

    }else {
        return 'Settings error';

    }

    if ( !empty($zoom) ) {
        $output .= ' data-zoom="' . $zoom . '"';
    }

    if ( !empty($offset_x) || !empty($offset_y) ) {
        if ( $offset_type == 'relative' ) {
            $output .= ' data-relative-offset="true"';

        }

        if ( !empty($offset_x) ) {
            $output .= ' data-offset-x="' . $offset_x . '"';

        }

        if ( !empty($offset_y) ) {
            $output .= ' data-offset-y="' . $offset_y . '"';

        }
    }

    if ( !empty($icon) ) {
        $icon = wp_get_attachment_url($icon);
        $output .= ' data-icon="' . $icon . '"';
    }

    if ( !empty($balloons) ) {
        $output .= ' data-balloons="' . $balloons . '"';
    }

    if ( empty($relative_size) ) {
        $output .= ' data-fill-row="true"';

    }else if ( !empty($width) || !empty($height) ) {
        $output .= ' style="';

        if ( !empty($width) ) $output .= 'max-width: ' . $width . 'px;';
        if ( !empty($height) ) $output .= 'height: ' . $height . 'px;';

        $output .= '"';
    }

    $output .= "></div>";

    return $output;

}

add_shortcode('vncp_contact_map', 'vncp_contact_map_handler');
