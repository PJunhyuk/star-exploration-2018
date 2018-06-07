<?php
/* 
*
* ACF Fields for Sponsors Custom Post Type
*
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( function_exists('acf_add_local_field_group') ){
    function ventcamp_acf_add_sponsors_field_groups() {

        //Add custom field group
        acf_add_local_field_group(array(
            'key' => 'sponsor_cpt_fields',
            'title' => 'Sponsor data',
            'fields' => array (),
            'style' => 'seamless',
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'sponsors',
                    ),
                ),
            ),
        ));

        //Add fields to the group
        acf_add_local_field(array(
            'key' => 'sponsor_website',
            'label' => 'Website',
            'name' => 'sponsor_website',
            'instructions' => 'This URL will be displayed on sponsors individual page',
            'type' => 'text',
            'parent' => 'sponsor_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'sponsor_description',
            'label' => 'Description',
            'name' => 'sponsor_description',
            'type' => 'wysiwyg',
            'parent' => 'sponsor_cpt_fields',
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        )); 
    }

    add_action('acf/init', 'ventcamp_acf_add_sponsors_field_groups');

}