<?php
defined('ABSPATH') or die('No direct access');

/**
 * Shortcode attributes
 * @var $atts
 * @var $name
 * @var $position
 * @var $photo
 * @var $photo_shape
 * @var $photo_size
 * @var $custom_photo_size
 * @var $content
 * @var $facebook_url
 * @var $twitter_url
 * @var $google_url
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Speaker_Bio
 */
$name = $position = $photo = $photo_url = $photo_shape = $photo_size = $custom_photo_size = $facebook_url = $twitter_url = $google_url = $photo_size_class = $photo_shape_class = $photo_shape_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($photo))
	$photo_url = wp_get_attachment_url($photo);

if(!empty($photo_size))
	$photo_size_class = ' photo-' . $photo_size;

if(!empty($photo_shape))
	$photo_shape_class = ' photo-' . $photo_shape . '-shape';

if(!empty($photo_shape))
	$photo_shape_class = ' photo-' . $photo_shape . '-shape';

$photo_style = ' style="';

if($photo_shape != 'none' && !empty($photo_url))
	$photo_style .= 'background-image: url(' . $photo_url . ');';

if($photo_size == 'custom' && !empty($custom_photo_size)) {
	$custom_photo_size_array = explode( 'x', $custom_photo_size );
	$custom_photo_width = intval($custom_photo_size_array[0]);

	if(count($custom_photo_size_array) == 2)
		$custom_photo_height = intval($custom_photo_size_array[1]);

		if(!empty($custom_photo_height))
			$photo_style .= ' max-height: ' . $custom_photo_height . 'px;';

	if(!empty($custom_photo_width))
		$photo_style .= ' max-width: ' . $custom_photo_width . 'px;';
}

$photo_style .= '"';

$output = "<div class='speaker-col'>";
$output .= "<div class='speaker'>";

if(!empty($photo)) {
	$output .= "<div class='photo-wrapper{$photo_size_class}{$photo_shape_class}'{$photo_style}>";

	if($photo_shape == 'none') {
		if (!empty($custom_photo_width) && !empty($custom_photo_height))
			$output .= wp_get_attachment_image($photo, array($custom_photo_width, $custom_photo_height));
		else
			$output .= wp_get_attachment_image($photo);
	}

	$output .= "</div>";
}

$output .= "<h3 class='name'>{$name}</h3>";
$output .= "<p class='text-alt'><small>{$position}</small></p>";
$output .= "<p class='about'>{$content}</p>";
$output .= "<ul class='speaker-socials'>";

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
if(!empty($custom_url1))
	$output .= "<li><a target='_blank' href='{$custom_url1}'><span class='fa fa-external-link'></span></a></li>";
if(!empty($custom_url2))
	$output .= "<li><a target='_blank' href='{$custom_url2}'><span class='fa fa-external-link'></span></a></li>";
if(!empty($custom_url3))
	$output .= "<li><a target='_blank' href='{$custom_url3}'><span class='fa fa-external-link'></span></a></li>";

$output .= "</ul>";
$output .= "</div>";
$output .= "</div>";

echo $output;
