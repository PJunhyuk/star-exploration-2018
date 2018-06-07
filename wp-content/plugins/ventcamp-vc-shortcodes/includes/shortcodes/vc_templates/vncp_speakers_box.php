<?php
defined('ABSPATH') or die('No direct access');

/**
 * Shortcode attributes
 * @var $atts
 * @var $columns
 * @var $photo_shape
 * @var $photo_size
 * @var $hide_socials
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Speakers_Box
 */
$columns = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$container_classes = array('speakers', 'speakers-full');
$container_classes[] = 'speakers-' . $columns . '-columns';
$container_classes[] = 'photo-' . $photo_shape . '-shape';
$container_classes[] = 'photo-' . $photo_size;
$container_classes[] = $hide_socials;

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', $container_classes), $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		' . ( ( '' === trim( $content ) ) ? __( 'Empty. Edit page to add content here.', 'ventcamp' ) : wpb_js_remove_wpautop( $content ) ) . '
	</div>
';

echo $output;
