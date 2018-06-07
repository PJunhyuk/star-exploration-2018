<?php if ( ! defined( 'ABSPATH' ) ) exit;
/*
 * Plugin Name: Ventcamp Visual Composer Shortcodes
 * Description: Shortcodes and misc helpers for Ventcamp WP theme
 * Version: 2.4.4
 * Author: Vivaco.com
 * Author URI: http://vivaco.com/
 * Developer: Vivaco
 * Developer URI: http://vivaco.com/
 * Text Domain: ventcamp-vc-shortcodes
 */

// Ventcamp random ID function
if (!function_exists('ventcamp_random_id')) {
	function ventcamp_random_id($id_length) {
		$random_id_length = $id_length;
		$rnd_id = crypt(uniqid(rand(), 1), 'DlbkWT*ZQ*_jpORJ*PwokopPlY+NR|frcgz%+WCx|RZPkq*IbO56hQ1o9*b2'); // on php 5.6 crypt without or with simple salt parameter generate E_NOTICE
		$rnd_id = strip_tags(stripslashes($rnd_id));
		$rnd_id = str_replace(".", "", $rnd_id);
		$rnd_id = strrev(str_replace("/", "", $rnd_id));
		$rnd_id = str_replace(range(0, 9), "", $rnd_id);
		$rnd_id = substr($rnd_id, 0, $random_id_length);
		$rnd_id = strtolower($rnd_id);

		return $rnd_id;
	}
}

// Check if Visual Composer is loaded
if (function_exists('vc_map')) {

		//Update main Dir for Ventcamp VC shortcode overrides
		vc_set_shortcodes_templates_dir( WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vc_templates');

		//Add Ventcamp VC helpers
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/ventcamp_composer.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/ventcamp_composer_extend.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/ventcamp_vc_page_templates.php';

	function ventcamp_add_vc_shortcodes(){

		// Add Ventcamp VC Shortcodes
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_button.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_contact7_form.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_countdown.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_counter.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_sponsors.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_speakers.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_speakers_v2.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_testimonials.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_schedule.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_contact_map.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_text_with_icon.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_pricetable.php';

		//Add EventEspresso shortcodes for Visual Composer
		if ( class_exists( 'EE_Base' ) ) {
			require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_event_espresso.php';
		}
		//Add Tickera shortcodes for Visual Composer
		if ( class_exists( 'TC' ) ) {
			require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vncp_tickera.php';
		}

		//Update main Visual Composer shortcodes overrides
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vc_row.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vc_row_inner.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vc_column.php';
		require WP_PLUGIN_DIR . '/ventcamp-vc-shortcodes/includes/shortcodes/vc_column_inner.php';
	}
}

add_action( 'init', 'ventcamp_add_vc_shortcodes', 200);
