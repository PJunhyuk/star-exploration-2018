<?php
defined('ABSPATH') or die('No direct access');

// Register 'container' content element. It will hold all your inner (child) content elements

$speakers_list = get_posts(array(
    'post_type' => 'speakers',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));

$speakers_array = array();
foreach ($speakers_list as $speakers_item) {
	$speakers_array[$speakers_item->post_title] = $speakers_item->ID;
}

$speaker_type_array = array();
$customPostTaxonomies = get_object_taxonomies('speaker_type', 'name');
$terms = get_terms( array('taxonomy' => 'speaker_type', ));
//$term->term_id;
//$term->term_slug;
foreach($terms as $term) {
	$speaker_type_array[$term->name] = $term->term_id;
}

vc_map( array(
    'name' => __( 'Speakers v2', 'ventcamp' ),
    'base' => 'vncp_speakers_cpt_box',
    'category' => __( 'Ventcamp', 'ventcamp' ),
    'description' => __( 'Ventcamp speakers list', 'ventcamp' ),
    'params' => array(  
        /*
        array(
            'type' => 'checkbox',
            'param_name' => 'masonry_mode',
            'description' => __( 'Enable Masonry mode for speakers box', 'ventcamp' ),
            'value' => array(
                __( 'Add Masonry?', 'ventcamp' ) => 'masonry_mode',
            )
        ),   
        */       
        array(
            'type' => 'checkbox',
            'param_name' => 'hide_socials',
            'description' => __( 'Hide social networks under speaker bio and show on hover', 'ventcamp' ),
            'value' => array(
                __( 'Hide socials?', 'ventcamp' ) => 'hide-socials',
            )
        ),  
        array(
            'type' => 'checkbox',
            'param_name' => 'show_links',
            'description' => __( 'Opens speaker info on a separate page', 'ventcamp' ),
            'value' => array(
                __( 'Add links on speaker names?', 'ventcamp' ) => 'show_links',
            )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'avatar_links',
            'value' => array(
                __( 'Make speaker avatars clickable?', 'ventcamp' ) => 'avatar_links',
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
                __( '4 columns', 'ventcamp' ) => '4'
            ),
            'std' => '4'
        ),

	    array(
		    'type' => 'dropdown',
		    'heading' => __( 'Order by', 'ventcamp' ),
		    'description' => __( 'Order retrieved speakers by parameter.', 'ventcamp' ),
		    'param_name' => 'orderby',
		    'value' => array(
			    __( 'Last modified date', 'ventcamp' ) => 'modified',
			    __( 'Date', 'ventcamp' ) => 'date',
			    __( 'Random order', 'ventcamp' ) => 'rand',
			    __( 'Name', 'ventcamp' ) => 'title'
		    ),
		    'std' => 'date'
	    ),

	    array(
		    'type' => 'dropdown',
		    'heading' => __( 'Order', 'ventcamp' ),
		    'param_name' => 'order',
		    'value' => array(
			    __( 'Ascending', 'ventcamp' ) => 'ASC',
			    __( 'Descending', 'ventcamp' ) => 'DESC'
		    ),
		    'std' => 'ASC'
	    ),

		array(
            'type' => 'dropdown',
            'heading' => __( 'Photo shape', 'ventcamp' ),
            'param_name' => 'photo_shape',
            'value' => array( 
                __( 'Round', 'ventcamp' ) => 'round',
                __( 'Rounded square', 'ventcamp' ) => 'rounded-square',
                __( 'Square', 'ventcamp' ) => 'square',
                __( 'None', 'ventcamp' ) => 'none'
            ),
            'std' => 'round'
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Photo size', 'ventcamp' ),
            'param_name' => 'photo_size',
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
            'param_name' => 'custom_photo_size',
            'description' => __( 'Select custom photo size e.g.: "350x150"', 'ventcamp' ),
            'dependency' => array(
                'element' => 'photo_size',
                'value' => 'custom'
            )
        ),         

        array(
            'type' => 'dropdown',
            "heading" => __("Show speakers by:", "vivaco"),
            'param_name' => 'speakers_type_tax',
            'description' => __( 'Select which speaker types to show', 'ventcamp' ),
            'value' => array( 
                __( 'Show all', 'ventcamp' ) => 'all',
                __( 'Show by name', 'ventcamp' ) => 'sort_by_name',
                __( 'Show by speaker type', 'ventcamp' ) => 'sort_by_tax',
            ),
        ),    
         array(
            'type' => 'checkbox',
            'param_name' => 'speaker_taxonomies',
            'description' => __( 'Choose speaker types to show in this box', 'ventcamp' ),
            'value' => $speaker_type_array,
            'dependency' => array(
                'element' => 'speakers_type_tax',
                'value' => 'sort_by_tax'
            )
        ),

        array(
            'type' => 'checkbox',
            "heading" => __("Select speakers", "vivaco"),
            'param_name' => 'speakers_cpt',
            'description' => __( 'Select which speakers to show', 'ventcamp' ),
            'value' => $speakers_array,
            'dependency' => array(
                'element' => 'speakers_type_tax',
                'value' => 'sort_by_name'
            )
        ),            

        array(
            'type' => 'textfield',
            "heading" => __("How many speakers to show?", "vivaco"),
            'param_name' => 'speakers_num',
            'description' => __( '', 'ventcamp' ),
            'value' => 6,
            'dependency' => array(
                'element' => 'speakers_type_tax',
                'value' => 'all'
            )
        ),    

        array(
            'type' => 'textfield',
            'heading' => __( 'Trim speaker bio text to this character count', 'ventcamp' ),
            'param_name' => 'trim_count',
            'description' => __( 'Restrict chcracter count for Speaker Short Bio text, set -1 to display full text', 'ventcamp' ),
            'std' => '125'
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'ventcamp' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ventcamp' )
        ),  

       
    ), 

));

function vncp_speakers_cpt_box_render( $atts ) {
 
    $masonry_mode = $name = $photo = $position = $hide_socials =$show_links = $avatar_links = $speaker_url = $columns = $photo_shape = $photo_size = $speakers_cpt = $trim_count = $speakers_num = $el_class = '';

    extract(shortcode_atts(array(
        'masonry_mode'       => '',
        'hide_socials'       => '',
        'columns'            => '4',
	    'orderby'            => 'date',
        'order'              => 'ASC',
        'photo_shape'        => 'round',
        'photo_size'         => 'md',
        'speakers_cpt'       => '',
        'speakers_type_tax'  => '',
        'speaker_taxonomies' => '',
        'avatar_links'       => '',
        'show_links'         => '',
        'trim_count'         => '125',
        'speakers_num'       => '6',
        'el_class'           => ''
    ), $atts));

        //Get all speakers limit by number
        if ($speakers_type_tax == 'all' || $speakers_type_tax == ''){
            $pages = get_posts(array(
              'post_type'   => 'speakers',
              'numberposts' => $speakers_num,
              'post_status' => 'publish',
              'orderby'     => $orderby,
              'order'       => $order,
            ));
            foreach ($pages as $page){
                $speakers_cpt .= ",".$page->ID;
            }
        }

        //Get all speakers of custom type
        if ($speakers_type_tax == 'sort_by_tax'){
            $taxonomy_list = explode(',', $speaker_taxonomies);
 
            $pages = get_posts(array(
              'post_type'   => 'speakers',
              'numberposts' => -1,
              'post_status' => 'publish',
              'tax_query'   => array(
                array(
                  'taxonomy'         => 'speaker_type',
                  'field'            => 'id',
                  'terms'            => $taxonomy_list, // Where term_id of Term 1 is "1".
                  'include_children' => false
                )
              )
            ));
            foreach ($pages as $page){
                $speakers_cpt .= ",".$page->ID;
            }
        }
        
        $speakers_list = explode(',', $speakers_cpt);

        if(!empty($photo_size)){
            $photo_size_class = ' photo-' . $photo_size;
        }
        if(!empty($photo_shape)){
            $photo_shape_class = ' photo-' . $photo_shape . '-shape';
        }
        
        $content = "";

    foreach ($speakers_list as $key => $speaker_key){
        if($speaker_key != ''){
            $photo_style = ' style="';
            
            $photo = get_post_thumbnail_id( $speaker_key ); 
            $photo_url = wp_get_attachment_url($photo, $speaker_key);

            $name = get_the_title($speaker_key);
            $position = get_field('speaker_position', $speaker_key);
            $about = get_field('speaker_short_bio', $speaker_key);

            $website_url= (get_field('speaker_website', $speaker_key) != '') ? get_field('speaker_website', $speaker_key) : '';
            $email = (get_field('speaker_email', $speaker_key) != '') ? get_field('speaker_email', $speaker_key) : '';
            $facebook_url = (get_field('speaker_facebook', $speaker_key) != '') ? get_field('speaker_facebook', $speaker_key) : '';
            $twitter_url = (get_field('speaker_twitter', $speaker_key) != '') ? get_field('speaker_twitter', $speaker_key) : '';
            $google_url = (get_field('speaker_google_plus', $speaker_key) != '') ? get_field('speaker_google_plus', $speaker_key) : '';
            $linkedin_url = (get_field('speaker_linkedin', $speaker_key) != '') ? get_field('speaker_linkedin', $speaker_key) : '';
            $skype_url = (get_field('speaker_skype', $speaker_key) != '') ? get_field('speaker_skype', $speaker_key) : '';
            $instagram_url = (get_field('speaker_instagram', $speaker_key) != '') ? get_field('speaker_instagram', $speaker_key) : '';
            $dribbble_url = (get_field('speaker_dribbble', $speaker_key) != '') ? get_field('speaker_dribbble', $speaker_key) : '';
            $behance_url = (get_field('speaker_behance', $speaker_key) != '') ? get_field('speaker_behance', $speaker_key) : '';
            $pinterest_url = (get_field('speaker_pinterest', $speaker_key) != '') ? get_field('speaker_pinterest', $speaker_key) : '';
            $youtube_url = (get_field('speaker_youtube', $speaker_key) != '') ? get_field('speaker_youtube', $speaker_key) : '';
            $soundcloud_url = (get_field('speaker_soundcloud', $speaker_key) != '') ? get_field('speaker_soundcloud', $speaker_key) : '';
            $slack_url = (get_field('speaker_slack', $speaker_key) != '') ? get_field('speaker_slack', $speaker_key) : '';
            $vkontakte_url = (get_field('speaker_vkontakte', $speaker_key) != '') ? get_field('speaker_vkontakte', $speaker_key) : '';
            $custom_1_url = (get_field('speaker_custom_1', $speaker_key) != '') ? get_field('speaker_custom_1', $speaker_key) : '';
            $custom_2_url = (get_field('speaker_custom_2', $speaker_key) != '') ? get_field('speaker_custom_2', $speaker_key) : '';
            $custom_3_url = (get_field('speaker_custom_3', $speaker_key) != '') ? get_field('speaker_custom_3', $speaker_key) : '';
     

            if ($trim_count != '-1'){
                $about = substr($about, 0, $trim_count);
            }

            if($photo_shape != 'none' && !empty($photo_url)){
                $photo_style .= 'background-image: url(' . $photo_url . ');';
            }

            if($photo_size == 'custom' && !empty($custom_photo_size)) {
                $custom_photo_size_array = explode( 'x', $custom_photo_size );
                $custom_photo_width = intval($custom_photo_size_array[0]);

                if(count($custom_photo_size_array) == 2){
                    $custom_photo_height = intval($custom_photo_size_array[1]);
                }
                
                if(!empty($custom_photo_height)){
                    $photo_style .= ' max-height: ' . $custom_photo_height . 'px;';
                }

                if(!empty($custom_photo_width)){
                    $photo_style .= ' max-width: ' . $custom_photo_width . 'px;';
                }
            }

            $content .= "<div class='speaker-col'>";
            $content .= "<div class='speaker'>";

            //$speaker_url = get_permalink($speaker_key); //TO REFACTOR, THIS IS NOT WORKING!!
            $speaker_url = get_home_url().'/speakers/'. get_post_field( 'post_name', $speaker_key);

            if(!empty($photo)) {

                if ($avatar_links != ''){
                    $content .= '<a href="'. $speaker_url.'" target="_blank">';
                }

                $content .= "<div class='photo-wrapper{$photo_size_class}{$photo_shape_class}' {$photo_style}\">";

                if($photo_shape == 'none') {
                    if (!empty($custom_photo_width) && !empty($custom_photo_height)){
                        $content .= wp_get_attachment_image($photo, array($custom_photo_width, $custom_photo_height), $speaker_key);
                    }
                    else {
                        $content .= wp_get_attachment_image($photo, $speaker_key);
                    }
                }

                $content .= "</div>";

                if ($avatar_links != ''){
                    $content .= '</a>';
                }
            }

            if ($show_links != ''){
                    $content .= "<h3 class='name'>";
                    $content .= '<a href="'. $speaker_url.'" target="_blank">';
                    $content .= $name;
                    $content .= "</a>";
                    $content .= "</h3>";
                } else {
                    $content .= "<h3 class='name'>{$name}</h3>";
                }
            
            $content .= "<p class='text-alt'><small>{$position}</small></p>";
            $content .= "<div class='about'>{$about}</div>";
            $content .= "<ul class='speaker-socials'>";

            if(!empty($website_url))
                $content .= "<li><a target='_blank' href='{$website_url}'><span class='fa fa-external-link'></span></a></li>";
            if(!empty($email))
                $content .= "<li><a target='_blank' href='{$email}'><span class='fa fa-envelope-o'></span></a></li>";
            if(!empty($facebook_url))
                $content .= "<li><a target='_blank' href='{$facebook_url}'><span class='fa fa-facebook'></span></a></li>";
            if(!empty($twitter_url))
                $content .= "<li><a target='_blank' href='{$twitter_url}'><span class='fa fa-twitter'></span></a></li>";
            if(!empty($google_url))
                $content .= "<li><a target='_blank' href='{$google_url}'><span class='fa fa-google-plus'></span></a></li>";
            if(!empty($linkedin_url))
                $content .= "<li><a target='_blank' href='{$linkedin_url}'><span class='fa fa-linkedin'></span></a></li>";
            if(!empty($skype_url))
                $content .= "<li><a target='_blank' href='{$skype_url}'><span class='fa fa-skype'></span></a></li>";
            if(!empty($instagram_url))
                $content .= "<li><a target='_blank' href='{$instagram_url}'><span class='fa fa-instagram'></span></a></li>";
            if(!empty($dribbble_url))
                $content .= "<li><a target='_blank' href='{$dribbble_url}'><span class='fa fa-dribbble'></span></a></li>";
            if(!empty($behance_url))
                $content .= "<li><a target='_blank' href='{$behance_url}'><span class='fa fa-behance'></span></a></li>";
            if(!empty($pinterest_url))
                $content .= "<li><a target='_blank' href='{$pinterest_url}'><span class='fa fa-pinterest'></span></a></li>";
            if(!empty($youtube_url))
                $content .= "<li><a target='_blank' href='{$youtube_url}'><span class='fa fa-youtube'></span></a></li>";
            if(!empty($soundcloud_url))
                $content .= "<li><a target='_blank' href='{$soundcloud_url}'><span class='fa fa-soundcloud'></span></a></li>";
            if(!empty($slack_url))
                $content .= "<li><a target='_blank' href='{$slack_url}'><span class='fa fa-slack'></span></a></li>";
            if(!empty($vkontakte_url))
                $content .= "<li><a target='_blank' href='{$vkontakte_url}'><span class='fa fa-vk'></span></a></li>";
            if(!empty($custom_url1))
                $content .= "<li><a target='_blank' href='{$custom_url1}'><span class='fa fa-external-link'></span></a></li>";
            if(!empty($custom_url2))
                $content .= "<li><a target='_blank' href='{$custom_url2}'><span class='fa fa-external-link'></span></a></li>";
            if(!empty($custom_url3))
                $content .= "<li><a target='_blank' href='{$custom_url3}'><span class='fa fa-external-link'></span></a></li>";

            $content .= "</ul>";
            $content .= "</div>";
            $content .= "</div>"; 
        }
    }

    $output = 
    '<div data-columns="'. $columns . '" class="speakers speakers-full speakers-' . $columns .'-columns '. $photo_shape_class . $photo_size_class . ' ' . $hide_socials . '">' .  $content . '</div>';

    return $output;

}
add_shortcode( 'vncp_speakers_cpt_box', 'vncp_speakers_cpt_box_render' );
