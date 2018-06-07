<?php
/* 
*
* ACF Fields for Speakers Custom Post Type
*
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( function_exists('acf_add_local_field_group') ){
    function ventcamp_acf_add_speakers_field_groups() {

        //Add custom field group
        acf_add_local_field_group(array(
            'key' => 'speaker_cpt_fields',
            'title' => 'Speaker data',
            'fields' => array (),
            'style' => 'seamless',
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'speakers',
                    ),
                ),
            ),
        ));

        //Add fields to the group
        acf_add_local_field(array(
            'key' => 'speaker_position',
            'label' => 'Position',
            'name' => 'speaker_position',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_short_bio',
            'label' => 'Short bio',
            'name' => 'speaker_short_bio',
            'instructions' => 'This text is shown when you list speakers through Visual Composer shortcode within some page',
            'type' => 'textarea',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_bio',
            'label' => 'Bio',
            'name' => 'speaker_bio',
            'instructions' => 'This text is shown when you visit individual speakers page',
            'type' => 'wysiwyg',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_website',
            'label' => 'Website',
            'name' => 'speaker_website',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_email',
            'label' => 'Email',
            'name' => 'speaker_email',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_facebook',
            'label' => 'Facebook',
            'name' => 'speaker_facebook',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_twitter',
            'label' => 'Twitter',
            'name' => 'speaker_twitter',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_google_plus',
            'label' => 'Google+',
            'name' => 'speaker_google_plus',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_linkedin',
            'label' => 'LinkedIn',
            'name' => 'speaker_linkedin',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_skype',
            'label' => 'Skype',
            'name' => 'speaker_skype',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_instagram',
            'label' => 'Instagram',
            'name' => 'speaker_instagram',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_dribbble',
            'label' => 'Dribbble',
            'name' => 'speaker_dribbble',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_behance',
            'label' => 'Behance',
            'name' => 'speaker_behance',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_youtube',
            'label' => 'YouTube',
            'name' => 'speaker_youtube',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_vkontakte',
            'label' => 'Vkontakte',
            'name' => 'speaker_vkontakte',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_custom_link_1',
            'label' => 'Custom link 1',
            'name' => 'speaker_custom_link_1',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_custom_link_2',
            'label' => 'Custom link 2',
            'name' => 'speaker_custom_link_2',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        acf_add_local_field(array(
            'key' => 'speaker_custom_link_3',
            'label' => 'Custom link 3',
            'name' => 'speaker_custom_link_3',
            'type' => 'text',
            'parent' => 'speaker_cpt_fields',
            'wrapper' => array (
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ));
        
    }

    add_action('acf/init', 'ventcamp_acf_add_speakers_field_groups');

}