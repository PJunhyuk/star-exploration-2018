<?php
/* 
*
* Custom post type helper functions
*
*/


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if( !function_exists('ventcamp_filter_sponsor_post_type_link') ) {
    function ventcamp_filter_sponsor_post_type_link($link, $post) {
        global $typenow;
            
        if ( $typenow == 'speakers' ) {
            if ( $post->post_type != 'speakers' )
                return $link;

            if ( $cats = get_the_terms( $post->ID, 'speaker_type' ) )
                $link = str_replace('%speaker_type%', array_pop($cats)->slug, $link);

            return $link;

        } elseif ( $typenow == 'sponsors' ) {
            if ( $post->post_type != 'sponsors' )
                return $link;

            if ( $cats = get_the_terms( $post->ID, 'sponsor_type' ) )
                $link = str_replace('%sponsor_type%', array_pop($cats)->slug, $link);

            return $link;

        }
    }
}
//add_filter('post_type_link', 'ventcamp_filter_sponsor_post_type_link', 10, 2);


// Add speaker type + photo column
if( !function_exists('ventcamp_speakers_columns_head') ) {
    function ventcamp_speakers_columns_head($defaults) {
        global $typenow;
        $speakerPhoto = array('featured_image' => 'Photo');

        if ($typenow == 'speakers') {
            $date = array('date' => 'Date');
            unset( $defaults['date'] );
            $speakerType = array('speaker_type' => 'Type');
            return $speakerPhoto  + $defaults + $speakerType + $date;
        } elseif($typenow == 'sponsors') {
            $date = array('date' => 'Date');
            unset( $defaults['date'] );
            $sponsorType = array('sponsor_type' => 'Type');
            return $speakerPhoto  + $defaults + $sponsorType + $date;
        }

        return $defaults;
    }
}

// Show speaker type in admin
if( !function_exists('ventcamp_speakers_columns_content') ) {
    function ventcamp_speakers_columns_content($column_name, $post_ID) {
        if ($column_name == 'featured_image') {
            $post_featured_image = ventcamp_speakers_get_featured_image($post_ID);
            if ($post_featured_image) {
                echo '<img width="150" height="auto" src="' . $post_featured_image . '" />';
            } else {
                echo '<img src="' .  esc_url( get_template_directory_uri()) . '/images/default.jpg" />';
            }
        }

        if ($column_name == 'speaker_type') {
            $speaker_type = get_the_term_list( $post_ID, 'speaker_type', '', ', ', '' );

            if ( !empty( $speaker_type ) ) {
                echo "<p>". strip_tags($speaker_type) . "</p>";
            }
        }

        if ($column_name == 'sponsor_type') {
            $sponsor_type = get_the_term_list( $post_ID, 'sponsor_type', '', ', ', '' );

            if ( !empty( $sponsor_type ) ) {
                echo "<p>". strip_tags($sponsor_type) . "</p>";
            }
        }
    }
}
add_filter('manage_posts_columns', 'ventcamp_speakers_columns_head', 0);
add_action('manage_posts_custom_column', 'ventcamp_speakers_columns_content', 10, 2);

//Small fix for collumn width
if( !function_exists('ventcamp_speakers_admin_column_width') ) {
    function ventcamp_speakers_admin_column_width() {
        echo '<style type="text/css">
            .column-featured_image { text-align: center; width:200px !important; overflow:hidden }
 
        </style>';
    }
}
add_action('admin_head', 'ventcamp_speakers_admin_column_width');