<?php
/* 
*
* Custom post types for Speakers
*
*/


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
* Creating Speakers custom post type
*/
if( !function_exists('ventcamp_speaker_custom_post_type') ) {
    function ventcamp_speaker_custom_post_type() {

    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Speakers', 'Post Type General Name', 'ventcamp' ),
            'singular_name'       => _x( 'Speaker', 'Post Type Singular Name', 'ventcamp' ),
            'menu_name'           => __( 'Speakers', 'ventcamp' ),
            //'parent_item_colon'   => __( 'Parent Movie', 'ventcamp' ),
            'all_items'           => __( 'All Speakers', 'ventcamp' ),
            'view_item'           => __( 'View Speaker', 'ventcamp' ),
            'add_new_item'        => __( 'Add New Speaker', 'ventcamp' ),
            'add_new'             => __( 'Add New', 'ventcamp' ),
            'edit_item'           => __( 'Edit Speaker', 'ventcamp' ),
            'update_item'         => __( 'Update Speaker', 'ventcamp' ),
            'search_items'        => __( 'Search Speaker', 'ventcamp' ),
            'not_found'           => __( 'Not Found', 'ventcamp' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'ventcamp' ),
        );
        
    // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'speakers', 'ventcamp' ),
            'description'         => __( 'Manage event speakers', 'ventcamp' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'thumbnail'),
            'taxonomies'          => array('speaker_type'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 40,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            /*'rewrite' => array('slug' => 'speakers/%speaker_type%','with_front' => FALSE),*/
        );
        register_post_type( 'speakers', $args );
    }
}
add_action( 'init', 'ventcamp_speaker_custom_post_type', 0 );
 
/*
* Creating custom taxonomies to Speakers
*/

if( !function_exists('ventcamp_speakers_taxonomy') ) {
    function ventcamp_speakers_taxonomy() {  
        register_taxonomy(  
            'speaker_type',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
            'speakers',        //post type name
            array(  
                'hierarchical' => true,  
                'label' => 'Types',  //Display name
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'speakers', // This controls the base slug that will display before each term
                    'with_front' => false // Don't display the category base before 
                )
            )  
        );  
    }  
}  
add_action( 'init', 'ventcamp_speakers_taxonomy');


if( !function_exists('ventcamp_default_taxonomy_term') ) {
    function ventcamp_default_taxonomy_term( $post_id, $post ) {
        if ( 'publish' === $post->post_status ) {
            $defaults = array(
                'speaker_type' => array( 'other'),   //
                );
            $taxonomies = get_object_taxonomies( $post->post_type );
            foreach ( (array) $taxonomies as $taxonomy ) {
                $terms = wp_get_post_terms( $post_id, $taxonomy );
                if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                    wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                }
            }
        }
    }
}
add_action( 'save_post', 'ventcamp_default_taxonomy_term', 100, 2 );

// Get speaker photo
if( !function_exists('ventcamp_speakers_get_featured_image') ) {
    function ventcamp_speakers_get_featured_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
            return $post_thumbnail_img[0];
        }
    }
}

// Add filtering for Speakers in admin
if( !function_exists('ventcamp_speakers_add_taxonomy_filters') ) {
    function ventcamp_speakers_add_taxonomy_filters() {
        global $typenow;
     
        // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
        $taxonomies = array('speaker_type');
     
        // must set this to the post type you want the filter(s) displayed on
        if( $typenow == 'speakers' ){
     
            foreach ($taxonomies as $tax_slug) {
                $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                $tax_obj = get_taxonomy($tax_slug);
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                if(count($terms) > 0) {
                    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                    echo "<option value=''>Show All Speaker $tax_name</option>";
                    foreach ($terms as $term) {
                        echo '<option value='. $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
                    }
                    echo "</select>";
                }
            }
        }
    } 
} 
add_action( 'restrict_manage_posts', 'ventcamp_speakers_add_taxonomy_filters' );


/***** SERVICE FUNCTIONS ******/

// Get speaker social links
if( !function_exists('ventcamp_speakers_links') ) {
    function ventcamp_speakers_links($postID) {
        $output = '';
        $output .= "<ul class='speaker-socials'>";

        $website_url= (get_field('speaker_website', $postID) != '') ? get_field('speaker_website', $postID) : '';
        $email = (get_field('speaker_email', $postID) != '') ? get_field('speaker_email', $postID) : '';
        $facebook_url = (get_field('speaker_facebook', $postID) != '') ? get_field('speaker_facebook', $postID) : '';
        $twitter_url = (get_field('speaker_twitter', $postID) != '') ? get_field('speaker_twitter', $postID) : '';
        $google_url = (get_field('speaker_google_plus', $postID) != '') ? get_field('speaker_google_plus', $postID) : '';
        $linkedin_url = (get_field('speaker_linkedin', $postID) != '') ? get_field('speaker_linkedin', $postID) : '';
        $skype_url = (get_field('speaker_skype', $postID) != '') ? get_field('speaker_skype', $postID) : '';
        $instagram_url = (get_field('speaker_instagram', $postID) != '') ? get_field('speaker_instagram', $postID) : '';
        $dribbble_url = (get_field('speaker_dribbble', $postID) != '') ? get_field('speaker_dribbble', $postID) : '';
        $behance_url = (get_field('speaker_behance', $postID) != '') ? get_field('speaker_behance', $postID) : '';
        $pinterest_url = (get_field('speaker_pinterest', $postID) != '') ? get_field('speaker_pinterest', $postID) : '';
        $youtube_url = (get_field('speaker_youtube', $postID) != '') ? get_field('speaker_youtube', $postID) : '';
        $soundcloud_url = (get_field('speaker_soundcloud', $postID) != '') ? get_field('speaker_soundcloud', $postID) : '';
        $slack_url = (get_field('speaker_slack', $postID) != '') ? get_field('speaker_slack', $postID) : '';
        $vkontakte_url = (get_field('speaker_vkontakte', $postID) != '') ? get_field('speaker_vkontakte', $postID) : '';
        $custom_1_url = (get_field('speaker_custom_link_1', $postID) != '') ? get_field('speaker_custom_link_1', $postID) : '';
        $custom_2_url = (get_field('speaker_custom_link_2', $postID) != '') ? get_field('speaker_custom_link_2', $postID) : '';
        $custom_3_url = (get_field('speaker_custom_link_3', $postID) != '') ? get_field('speaker_custom_link_3', $postID) : '';
 
        if(!empty($website_url))
            $output .= "<li><a target='_blank' href='{$website_url}'><span class='fa fa-external-link'></span></a></li>";
        if(!empty($email))
            $output .= "<li><a target='_blank' href='{$email}'><span class='fa fa-envelope-o'></span></a></li>";
        if(!empty($facebook_url))
            $output .= "<li><a target='_blank' href='{$facebook_url}'><span class='fa fa-facebook'></span></a></li>";
        if(!empty($twitter_url))
            $output .= "<li><a target='_blank' href='{$twitter_url}'><span class='fa fa-twitter'></span></a></li>";
        if(!empty($google_url))
            $output .= "<li><a target='_blank' href='{$google_url}'><span class='fa fa-google-plus'></span></a></li>";
        if(!empty($linkedin_url))
            $output .= "<li><a target='_blank' href='{$linkedin_url}'><span class='fa fa-linkedin'></span></a></li>";
        if(!empty($skype_url))
            $output .= "<li><a target='_blank' href='{$skype_url}'><span class='fa fa-skype'></span></a></li>";
        if(!empty($instagram_url))
            $output .= "<li><a target='_blank' href='{$instagram_url}'><span class='fa fa-instagram'></span></a></li>";
        if(!empty($dribbble_url))
            $output .= "<li><a target='_blank' href='{$dribbble_url}'><span class='fa fa-dribbble'></span></a></li>";
        if(!empty($behance_url))
            $output .= "<li><a target='_blank' href='{$behance_url}'><span class='fa fa-behance'></span></a></li>";
        if(!empty($pinterest_url))
            $output .= "<li><a target='_blank' href='{$pinterest_url}'><span class='fa fa-pinterest'></span></a></li>";
        if(!empty($youtube_url))
            $output .= "<li><a target='_blank' href='{$youtube_url}'><span class='fa fa-youtube'></span></a></li>";
        if(!empty($soundcloud_url))
            $output .= "<li><a target='_blank' href='{$soundcloud_url}'><span class='fa fa-soundcloud'></span></a></li>";
        if(!empty($slack_url))
            $output .= "<li><a target='_blank' href='{$slack_url}'><span class='fa fa-slack'></span></a></li>";
        if(!empty($vkontakte_url))
            $output .= "<li><a target='_blank' href='{$vkontakte_url}'><span class='fa fa-vk'></span></a></li>";
        if(!empty($custom_1_url))
            $output .= "<li><a target='_blank' href='{$custom_1_url}'><span class='fa fa-external-link'></span></a></li>";
        if(!empty($custom_2_url))
            $output .= "<li><a target='_blank' href='{$custom_2_url}'><span class='fa fa-external-link'></span></a></li>";
        if(!empty($custom_3_url))
            $output .= "<li><a target='_blank' href='{$custom_3_url}'><span class='fa fa-external-link'></span></a></li>";
            
        $output .= "</ul>";

        echo $output;

    }
}