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

$title = $featured = $price = $currency_sign = $currency_sign_position = $features_available = $features_unavailable = $button_text = $button_link = $button_link_type = $custom_button_code = $product_id = $tickera_ticket_id = $tickera_class = $attr = $el_class = "";

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$box_classes = array('package-column');

if($featured)
	$box_classes[] = 'special-column';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', $box_classes), $this->settings['base'], $atts );

$output = "<div class='pricetable-col'><div class='{$css_class}'>";

if($featured)
	$output .= "<span class='sale-label uppercase'>Hot!</span>";

$output .= "<h6 class='package-title'>{$title}</h6>";
$output .= "<div class='package-price'>";
if("left" === $currency_sign_position)
	$output .= "<span class='currency'>{$currency_sign}</span>";
$output .= $price;
if("right" === $currency_sign_position)
	$output .= "<span class='currency'>{$currency_sign}</span>";
$output .= "</div>";
$output .= "<div class='package-detail'><ul>";
$features_available_arr = explode(',', $features_available);
foreach ($features_available_arr as $fa) {
	if(empty($fa))
		continue;
	$output .= "<li><span class='fa fa-check check-icon'></span>{$fa}</li>";
}
$features_unavailable_arr = explode(',', $features_unavailable);
foreach ($features_unavailable_arr as $fua) {
	if(empty($fua))
		continue;
	$output .= "<li class='disabled'><span class='fa fa-times absent-icon'></span>{$fua}</li>";
}
$output .= "</ul></div>";
$btn_link = '';
if ('url' == $button_link_type) {
	$button_link_arr = vc_build_link($button_link);
	$btn_link = $button_link_arr['url'];
} else if ('product' == $button_link_type) {
	$btn_link = site_url( '?add-to-cart=' . $product_id );
} else if ('tickera_ticket' == $button_link_type) {
	$btn_link = '#';
	$tickera_class = "add_to_cart";
	$attr = 'data-button-type="cart" data-open-method="regular" id="ticket_' . $tickera_ticket_id . '"';
	$button_text = '<span class="title">Add to Cart</span>';
}

if ('tickera_ticket' == $button_link_type) {
	$output .= '<form class="cart_form"><a href="#" class="add_to_cart" data-button-type="cart" data-open-method="regular" id="ticket_' . $tickera_ticket_id . '"><span class="title">Add to Cart</span></a><input type="hidden" name="ticket_id" class="ticket_id" value="' . $tickera_ticket_id . '"></form>';
} else if ('custom' == $button_link_type) {
	$output .= do_shortcode( $custom_button_code );
} else {
	$output .= "<a href='{$btn_link}' class='btn btn-lg'>{$button_text}</a>";
}

$output .= "</div>";

$output .= "</div>";

echo $output;
