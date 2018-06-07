<?php
/* 
*
* Custom post types for Sponsors
*
*/


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
* Creating Sponsors custom post type
*/
if( !function_exists('ventcamp_sponsor_custom_post_type') ) {
    function ventcamp_sponsor_custom_post_type() {

    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Sponsors', 'Post Type General Name', 'ventcamp' ),
            'singular_name'       => _x( 'Sponsor', 'Post Type Singular Name', 'ventcamp' ),
            'menu_name'           => __( 'Sponsors', 'ventcamp' ),
            //'parent_item_colon'   => __( 'Parent Movie', 'ventcamp' ),
            'all_items'           => __( 'All Sponsors', 'ventcamp' ),
            'view_item'           => __( 'View Sponsor', 'ventcamp' ),
            'add_new_item'        => __( 'Add New Sponsor', 'ventcamp' ),
            'add_new'             => __( 'Add New', 'ventcamp' ),
            'edit_item'           => __( 'Edit Sponsor', 'ventcamp' ),
            'update_item'         => __( 'Update Sponsor', 'ventcamp' ),
            'search_items'        => __( 'Search Sponsor', 'ventcamp' ),
            'not_found'           => __( 'Not Found', 'ventcamp' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'ventcamp' ),
        );
        
    // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'sponsors', 'ventcamp' ),
            'description'         => __( 'Manage event sponsors', 'ventcamp' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'thumbnail'),
            'taxonomies'          => array('sponsor_type'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 45,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            /*'rewrite' => array('slug' => 'sponsors/%sponsor_type%','with_front' => FALSE),*/
        );
        register_post_type( 'sponsors', $args );
    }
}
add_action( 'init', 'ventcamp_sponsor_custom_post_type', 0 );
 
/*
* Creating custom taxonomies to Sponsors
*/

if( !function_exists('ventcamp_sponsors_taxonomy') ) {
    function ventcamp_sponsors_taxonomy() {  
        register_taxonomy(  
            'sponsor_type',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
            'sponsors',        //post type name
            array(  
                'hierarchical' => true,  
                'label' => 'Types',  //Display name
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'sponsors', // This controls the base slug that will display before each term
                    'with_front' => false // Don't display the category base before 
                )
            )  
        );  
    }  
}  
add_action( 'init', 'ventcamp_sponsors_taxonomy');
 
// Add filtering for sponsors in admin
if( !function_exists('ventcamp_sponsors_add_taxonomy_filters') ) {
    function ventcamp_sponsors_add_taxonomy_filters() {
        global $typenow;
     
        // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
        $taxonomies = array('sponsor_type');
     
        // must set this to the post type you want the filter(s) displayed on
        if( $typenow == 'sponsors' ){
     
            foreach ($taxonomies as $tax_slug) {
                $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                $tax_obj = get_taxonomy($tax_slug);
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                if(count($terms) > 0) {
                    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                    echo "<option value=''>Show All Sponsors $tax_name</option>";
                    foreach ($terms as $term) {
                        echo '<option value='. $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
                    }
                    echo "</select>";
                }
            }
        }
    } 
} 
add_action( 'restrict_manage_posts', 'ventcamp_sponsors_add_taxonomy_filters', 10 );


/***** SERVICE FUNCTIONS ******/
