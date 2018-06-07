<?php
defined('ABSPATH') or die('No direct access');

/**
 * Shortcode attributes
 * @var $atts
 * @var $columns
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Speakers_Box
 */
$columns = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$container_classes = array('speakers', 'masonry');
$container_classes[] = 'masonry-' . $columns . '-columns';

wp_enqueue_script( 'masonry', get_template_directory_uri() . "/js/lib/masonry.pkgd.min.js", array('jquery'), false, true );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', $container_classes), $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '" data-columns="' . $columns . '">
		' . ( ( '' === trim( $content ) ) ? __( 'Empty. Edit page to add content here.', 'ventcamp' ) : wpb_js_remove_wpautop( $content ) ) . '
	</div>
';

echo $output;
