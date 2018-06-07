<?php
defined('ABSPATH') or die('No direct access');

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $featured
 * @var $price
 * @var $currency_sign
 * @var $currency_sign_position
 * @var $features_available
 * @var $features_unavailable
 * @var $button_text
 * @var $button_link
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Pricetable
 */

$title = $price = $currency_sign = $currency_sign_position = $features_available = $features_unavailable = $button_text = $button_link = $button_link_type = $product_id = $el_class = "";

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$box_classes = array('package-panel');
if(!empty($el_class))
	$box_classes[] = $el_class;

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', $box_classes), $this->settings['base'], $atts );

$output = "<div class='pricetable-col'><div class='{$css_class}'>";
$output .= "<h6 class='package-title'>{$title}</h6>";

$output .= "<div class='package-detail'>";

$list1 = '<ul>';
$list2 = '<ul>';
$index = 1;

$features_available_arr = explode(',', $features_available);
foreach ($features_available_arr as $fa) {
	if(empty($fa))
		continue;

	if($index % 2 == 0) {
		$list2 .= "<li><span class='fa fa-check check-icon'></span>{$fa}</li>\t";
	}else {
		$list1 .= "<li><span class='fa fa-check check-icon'></span>{$fa}</li>\t";
	}

	$index++;
}

$features_unavailable_arr = explode(',', $features_unavailable);
foreach ($features_unavailable_arr as $fua) {
	if(empty($fua))
		continue;

	if($index % 2 == 0) {
		$list2 .= "<li class='disabled'><span class='fa fa-times absent-icon'></span>{$fua}</li>\t";
	}else {
		$list1 .= "<li class='disabled'><span class='fa fa-times absent-icon'></span>{$fua}</li>\t";
	}

	$index++;
}

$list1 .= '</ul>';
$list2 .= '</ul>';

$output .= $list1 . $list2 . "</div>";


$btn_link = '';
if('url' == $button_link_type){
	$button_link_arr = vc_build_link($button_link);
	$btn_link = $button_link_arr['url'];
}else if('product' == $button_link_type){
	$btn_link = site_url( '?add-to-cart=' . $product_id );
}

$output .= "<a href='{$btn_link}' class='buy-btn'>";
$output .= "<div class='centered'>";
$output .= "<div class='price'>";
if("left" === $currency_sign_position)
	$output .= "<span class='currency'>{$currency_sign}</span>";
$output .= $price;
if("right" === $currency_sign_position)
	$output .= "<span class='currency'>{$currency_sign}</span>";
$output .= "</div>";
$output .= "<h6 class='heading-alt'>{$button_text}</h6>";

$output .= "</div>";
$output .= "</a>";

$output .= "</div>";
$output .= "</div>";

echo $output;
