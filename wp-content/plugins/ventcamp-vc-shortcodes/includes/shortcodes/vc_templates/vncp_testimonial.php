<?php
defined('ABSPATH') or die('No direct access');

/**
 * Shortcode attributes
 * @var $atts
 * @var $name
 * @var $company
 * @var $content
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Speaker_Bio
 */
$name = $company = $photo =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($photo))
	$photo_url = wp_get_attachment_url($photo);

$output = "<div class='testimonial-col'>";
$output .= "<div class='testimonial'>";
$output .= "<article class='text-box'>{$content}</article>";
$output .= "<div class='author-block'>";
if(!empty($photo))
	$output .= "<div class='photo-container' style=\"background-image: url('{$photo_url}')\"></div>";
$output .= "<strong class='name'>{$name}</strong>";
$output .= "<small class='text-alt'>{$company}</small>";
$output .= "</div>";
$output .= "</div>";
$output .= "</div>";

echo $output;
