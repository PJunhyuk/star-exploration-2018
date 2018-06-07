<?php
defined('ABSPATH') or die('No direct access');

//Register 'container' content element. It will hold all your inner (child) content elements

$sponsors_list = get_posts(array(
    'post_type' => 'sponsors',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));

 
$sponsors_array = array();
    foreach ($sponsors_list as $sponsors_item) {
        $sponsors_array[$sponsors_item->post_title] = $sponsors_item->ID;
}

$sponsor_type_array = array();
$customPostTaxonomies = get_object_taxonomies('sponsor_type', 'name');
    $terms = get_terms( array('taxonomy' => 'sponsor_type', ));
    //$term->term_id;
    //$term->term_slug;
    foreach($terms as $term){ 
        $sponsor_type_array[$term->name] = $term->term_id;
     }

vc_map( array(
    'name' => __( 'Sponsors v2', 'ventcamp' ),
    'base' => 'vncp_sponsors_cpt_box',
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'description' => __( 'Ventcamp sponsors list', 'ventcamp' ),
    'params' => array(  
        /*
        array(
            'type' => 'checkbox',
            'param_name' => 'masonry_mode',
            'description' => __( 'Enable Masonry mode for sponsors box', 'ventcamp' ),
            'value' => array(
                __( 'Add Masonry?', 'ventcamp' ) => 'masonry_mode',
            )
        ),   
        */       
        array(
            'type' => 'checkbox',
            'param_name' => 'show_links',
            'description' => __( 'Opens sponsor info on a separate page', 'ventcamp' ),
            'value' => array(
                __( 'Add links on logos?', 'ventcamp' ) => 'hide-socials',
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Sponsor link points to', 'ventcamp' ),
            'description' => __( 'You can choose whether sponsor logo will be pointing to sponsor website or to sponsor page', 'ventcamp' ),
            'param_name' => 'link_target',
            'value' => array(
                __( 'The sponsor website (external link)', 'ventcamp' ) => 'website',
                __( 'The sponsor page', 'ventcamp' ) => 'page'
            ),
            'dependency' => array(
                'element' => 'show_links',
                'value' => 'hide-socials'
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Columns', 'ventcamp' ),
            'description' => __( 'Select number of columns for your element.', 'ventcamp' ),
            'param_name' => 'columns',
            'value' => array(
                __( '2 columns', 'ventcamp' ) => '2',
                __( '3 columns', 'ventcamp' ) => '3',
                __( '4 columns', 'ventcamp' ) => '4',
                __( '6 columns', 'ventcamp' ) => '6', 
                __( '12 columns', 'ventcamp' ) => '12'
            ),
            'std' => '6'
        ),      
        array(
            'type' => 'dropdown',
            'heading' => __( 'Logo size', 'ventcamp' ),
            'param_name' => 'logo_size',
            'value' => array( 
                __( 'Default', 'ventcamp' ) => '',
                __( 'Small', 'ventcamp' ) => 'sm',
                __( 'Medium', 'ventcamp' ) => 'md',
                __( 'Large', 'ventcamp' ) => 'lg',
                __( 'Custom', 'ventcamp' ) => 'custom',
            ),
            'std' => 'md'
        ),

        array(
            'type' => 'textfield',
            'param_name' => 'custom_logo_size',
            'description' => __( 'Select custom logo size e.g.: "350x150"', 'ventcamp' ),
            'dependency' => array(
                'element' => 'logo_size',
                'value' => 'custom'
            )
        ),         

        array(
            'type' => 'dropdown',
            "heading" => __("Show sponsors by:", "vivaco"),
            'param_name' => 'sponsors_type_tax',
            'description' => __( 'Select which sponsor types to show', 'ventcamp' ),
            'value' => array( 
                __( 'Show all', 'ventcamp' ) => 'all',
                __( 'Show by sponsor type', 'ventcamp' ) => 'sort_by_tax',
            ),
        ),
         array(
            'type' => 'checkbox',
            'param_name' => 'sponsor_taxonomies',
            'description' => __( 'Choose sponsor types to show in this box', 'ventcamp' ),
            'value' => $sponsor_type_array,
            'dependency' => array(
                'element' => 'sponsors_type_tax',
                'value' => 'sort_by_tax'
            )
        ),

        array(
            'type' => 'checkbox',
            "heading" => __("Select sponsors", "vivaco"),
            'param_name' => 'sponsors_cpt',
            'description' => __( 'Select which sponsors to show', 'ventcamp' ),
            'value' => $sponsors_array,
            'dependency' => array(
                'element' => 'sponsors_type_tax',
                'value' => 'all'
            )
        ),    

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        ),  

       
    ), 

) );

function vncp_sponsors_cpt_box_render( $atts ) {

    $masonry_mode = $name = $logo = $position = $show_links = $link_target = $columns = $logo_shape = $logo_size = $sponsors_cpt = $trim_count = $el_class = '';

    extract(shortcode_atts(array(
        'masonry_mode'      => '',
        'show_links'      => '',
        'link_target'       => 'website',
        'columns'           => '6', 
        'logo_size'        => 'md',
        'sponsors_cpt'      => '',
        'sponsors_type_tax' => '',
        'sponsor_taxonomies' => '', 
        'el_class'          => ''
    ), $atts));

        //Get all sponsors of custom type
        if ($sponsors_type_tax == 'sort_by_tax'){
            $taxonomy_list = explode(',', $sponsor_taxonomies);
 
            $pages = get_posts(array(
              'post_type' => 'sponsors',
              'numberposts' => -1,
              'post_status' => 'publish',
              'tax_query' => array(
                array(
                  'taxonomy' => 'sponsor_type',
                  'field' => 'id',
                  'terms' => $taxonomy_list, // Where term_id of Term 1 is "1".
                  'include_children' => false
                )
              )
            ));
            foreach ($pages as $page){
                $sponsors_cpt .= ",".$page->ID;
            }
        }
        
        $sponsors_list = explode(',', $sponsors_cpt);

        if(!empty($logo_size)){
            $logo_size_class = ' logo-' . $logo_size;
        }
        if(!empty($logo_shape)){
            $logo_shape_class = ' logo-' . $logo_shape . '-shape';
        }
        
        $content = $output = "";
    $i = 0;
    $content .= '<div class="sponsors-column-wrap">';
    foreach ($sponsors_list as $key => $sponsor_key){
        if($sponsor_key != ''){
            $logo_style = ' style="';
            if ($i == $columns){$content .= '</div><div class="sponsors-column-wrap">'; $i =0 ;}
            $logo = get_post_thumbnail_id( $sponsor_key ); 
            $logo_url = wp_get_attachment_url($logo, $sponsor_key);
            $single_column = 12 / $columns;

            //$website_url = get_permalink($sponsor_key); //TO REFACTOR, THIS IS NOT WORKING!!

            // Check settings, whether link target is sponsor page or external website
            if ( $link_target == 'page' ) {
                $website_url = get_home_url() . '/sponsors/' . get_post_field( 'post_name', $sponsor_key );
            } elseif ( $link_target == 'website' ) {
                // Get sponsor website URL
                $website_option = get_field('sponsor_website', $sponsor_key);
                $website_url = !empty( $website_option ) ? $website_option : '';
            }

            $name = get_the_title($sponsor_key);

            if($logo_size == 'custom' && !empty($custom_logo_size)) {
                $custom_logo_size_array = explode( 'x', $custom_logo_size );
                $custom_logo_width = intval($custom_logo_size_array[0]);

                if(count($custom_logo_size_array) == 2){
                    $custom_logo_height = intval($custom_logo_size_array[1]);
                }
                
                if(!empty($custom_logo_height)){
                    $logo_style .= ' max-height: ' . $custom_logo_height . 'px;';
                }

                if(!empty($custom_logo_width)){
                    $logo_style .= ' max-width: ' . $custom_logo_width . 'px;';
                }
            }

            $content .= "<div class='vc_col-sm-{$single_column} wpb_column column_container'>";
            $content .= "<div class='wpb_wrapper'>";
            $content .= "<div class='wpb_single_image wpb_content_element vc_align_center'>";

            $content .= "<figure class=\"wpb_wrapper vc_figure\">";
           
            if(!empty($logo)) {
                if ($show_links != ''){
                    $content .= '<a href="'.$website_url.'" target="_blank" class="vc_single_image-wrapper">';
                    $content .= wp_get_attachment_image($logo, $sponsor_key);
                    $content .= "</a>";
                } else {
                    $content .= wp_get_attachment_image($logo, $sponsor_key);
                }
               

            }
          

            $content .= "</figure>";

            $content .= "</div>";
            $content .= "</div>"; 
            $content .= "</div>"; 
            
            //if ($i == $columns){$content .= '</div>';}
        $i++;
        }
    }
    $content .= "</div>"; // close sponsors-column-wrap
    $output .= "<div class='vc_row vc_inner vc_row-fluid container'>";
    $output .=   $content;
    $output .= "</div>"; 

    return $output;

}
add_shortcode( 'vncp_sponsors_cpt_box', 'vncp_sponsors_cpt_box_render' );