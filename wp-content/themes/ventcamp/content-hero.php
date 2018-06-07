<?php

$hero_style = ventcamp_option( 'hero_style_presets', 'style-1' );

/*
 * Get current skin name and include a template
 */
switch ( $hero_style ) {
	// First style: text and two buttons
	case 'style-1' :
		get_template_part( 'templates/hero-style', '1' );
		break;

	// Second style: custom form on the right and text on the left
	case 'style-2' :
		get_template_part( 'templates/hero-style', '2' );
		break;

	// Third style: custom form and text
	case 'style-3' :
		get_template_part( 'templates/hero-style', '3' );
		break;

	// Forth style: text with picture
	case 'style-4' :
		get_template_part( 'templates/hero-style', '4' );
		break;

	// Use first hero style as default template
	default :
		get_template_part( 'templates/hero-style', '1' );
		break;
}
