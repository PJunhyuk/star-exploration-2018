<?php
defined('ABSPATH') or die('No direct access');

if( !function_exists('vc_jscomposer_before_init') ) {
	function vc_jscomposer_before_init() {
		vc_set_as_theme(true);

		remove_action( 'admin_enqueue_scripts', 'vc_pointer_load' );

		vc_remove_param( 'vc_masonry_media_grid',  'item'); // Remove templates select frome Masonry Media Grid shortcode

		vc_add_param( 'vc_masonry_media_grid', array(
			'type' => 'hidden',
			'param_name' => 'item',
			'value' => 'masonryMedia_Default'
		) );
	}
}
add_action( 'vc_before_init', 'vc_jscomposer_before_init' );

if( !function_exists('vc_jscomposer_after_init') ) {
	function vc_jscomposer_after_init(){

		$shortcodes_to_add_accent_color = array(
			'vc_masonry_media_grid' => array(
				'btn_color' => true,
			),
			'vc_masonry_grid' => array(
				'btn_color' => true,
			),
			'vc_media_grid' => array(
				'paging_color' => true,
				'btn_color' => true,
			),
			'vc_basic_grid' => array(
				'filter_color' => true,
				'paging_color' => true,
			),
			'vc_cta' => array(
				'color' => true,
				'btn_color' => false,
				'i_color' => false,
				'i_background_color' => false
			),
			'vc_btn' => array(
				'color' => true,
			),
			'vc_round_chart' => array(
				'stroke_color' => true,
			),
			'vc_pie' => array(
				'color' => true,
			),
			'vc_progress_bar' => array(
				'bgcolor' => true,
			),
			'vc_tta_pageable' => array(
				'pagination_color' => true,
			),
			'vc_tta_accordion' => array(
				'color' => true,
			),
			'vc_tta_tour' => array(
				'color' => true,
				'pagination_color' => false
			),
			'vc_tta_tabs' => array(
				'color' => true,
				'pagination_color' => false
			),
			'vc_toggle' => array(
				'color' => true,
			),
			'vc_message' => array(
				'message_box_color' => true,
			),
			'vc_text_separator' => array(
				'color' => true,
				'i_color' => false,
				'i_background_color' => false,
			),
			'vc_icon' => array(
				'color' => true,
				'background_color' => false,
			),
			'vc_separator' => array(
				'color' => true
			)
		);

		foreach ($shortcodes_to_add_accent_color as $shortcode => $params_to_add_accent_color) {

			foreach ($params_to_add_accent_color as $param_name => $set_as_default) {
				$shorcode_param = WPBMap::getParam($shortcode, $param_name);
				$shorcode_param['value'] = array_merge(
					array(  esc_html__('Accent Color', 'ventcamp') => 'accent-color'),
					$shorcode_param['value']
				);
				if($set_as_default){
					$shorcode_param['std'] = 'accent-color';
				}
				vc_update_shortcode_param($shortcode, $shorcode_param);
			}

		}

		$vc_progress_bar_value = WPBMap::getParam('vc_progress_bar', 'values');

		$vc_progress_bar_value['params'][2]['value'] = array_merge(
			$vc_progress_bar_value['params'][2]['value'],
			array(  esc_html__('Accent Color', 'ventcamp') => 'accent-color')
		);

		vc_update_shortcode_param('vc_progress_bar', $vc_progress_bar_value);

		// Remove default font, so theme don't load any extra fonts until they are needed
		//$custom_heading_clear_default_font_param = WPBMap::getParam('vc_custom_heading', 'google_fonts');
		//$custom_heading_clear_default_font_param['value'] = ' ';
		//vc_update_shortcode_param('vc_custom_heading', $custom_heading_clear_default_font_param);

		// By default custom heading uses theme fonts
		$custom_heading_use_theme_fonts_param = WPBMap::getParam('vc_custom_heading', 'use_theme_fonts');
		$custom_heading_use_theme_fonts_param['std'] = 'yes';
		vc_update_shortcode_param('vc_custom_heading', $custom_heading_use_theme_fonts_param);

		// Tabs
		$tabs_style_param = WPBMap::getParam('vc_tta_tabs', 'style');
		unset($tabs_style_param['value']['Modern']);
		unset($tabs_style_param['value']['Flat']);
		vc_update_shortcode_param('vc_tta_tabs', $tabs_style_param);
		vc_remove_param('vc_tta_tabs', 'shape');

		//Single Image
		$single_image_style_param = WPBMap::getParam('vc_single_image', 'style');
		unset($single_image_style_param['value']['Rounded']);
		unset($single_image_style_param['value']['Outline']);
		unset($single_image_style_param['value']['Shadow']);
		unset($single_image_style_param['value']['Bordered shadow']);
		unset($single_image_style_param['value']['3D Shadow']);
		unset($single_image_style_param['value']['Round']);
		unset($single_image_style_param['value']['Round Border']);
		unset($single_image_style_param['value']['Round Outline']);
		unset($single_image_style_param['value']['Round Shadow']);
		unset($single_image_style_param['value']['Round Border Shadow']);
		unset($single_image_style_param['value']['Circle']);
		unset($single_image_style_param['value']['Circle Border']);
		unset($single_image_style_param['value']['Circle Outline']);
		unset($single_image_style_param['value']['Circle Shadow']);
		unset($single_image_style_param['value']['Circle Border Shadow']);
		vc_update_shortcode_param('vc_single_image', $single_image_style_param);

		// Tour
		vc_remove_param('vc_tta_tour', 'style');
		vc_remove_param('vc_tta_tour', 'shape');

		// Accordion
		vc_remove_param('vc_tta_accordion', 'style');
		vc_remove_param('vc_tta_accordion', 'shape');

		// Icon
		$icon_type_param = WPBMap::getParam('vc_icon', 'type');
		$icon_type_param['value']['Line Icons'] = 'lineicons';
		$icon_type_param['weight'] = 1;
		// vc_remove_param('vc_icon', 'type');
		vc_update_shortcode_param('vc_icon', $icon_type_param);
		$lineicons_font_param = array(
			'type' => 'iconpicker',
			'heading' =>  esc_html__( 'Icon', 'ventcamp'),
			'param_name' => 'icon_lineicons',
			'value' => 'icon icon-alerts-01',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'lineicons',
				'iconsPerPage' => 4000
				),
			'dependency' => array(
				'element' => 'type',
				'value' => 'lineicons'
				),
			'description' =>  esc_html__( 'Select icon from library.', 'ventcamp' ),
			'weight' => 1
			);
		vc_add_param('vc_icon', $lineicons_font_param);

		$single_image_style_param = WPBMap::getParam('vc_masonry_media_grid', 'style');
		unset($single_image_style_param['value']['Rounded']);
		unset($single_image_style_param['value']['Outline']);
		unset($single_image_style_param['value']['Shadow']);
		unset($single_image_style_param['value']['Bordered shadow']);
		unset($single_image_style_param['value']['3D Shadow']);
		unset($single_image_style_param['value']['Round']);
		unset($single_image_style_param['value']['Round Border']);
		unset($single_image_style_param['value']['Round Outline']);
		unset($single_image_style_param['value']['Round Shadow']);
		unset($single_image_style_param['value']['Round Border Shadow']);
		unset($single_image_style_param['value']['Circle']);
		unset($single_image_style_param['value']['Circle Border']);
		unset($single_image_style_param['value']['Circle Outline']);
		unset($single_image_style_param['value']['Circle Shadow']);
		unset($single_image_style_param['value']['Circle Border Shadow']);
		vc_update_shortcode_param('vc_single_image', $single_image_style_param);

		/* Line Icons for Section shortcode */
		$section_icon_types = WPBMap::getParam('vc_tta_section', 'i_type');
		$section_icon_types['value']['Line Icons'] = 'lineicons';
		vc_update_shortcode_param('vc_tta_section', $section_icon_types);

		$lineicons_font_param['param_name'] = 'i_icon_lineicons';
		$lineicons_font_param['dependency']['element'] = 'i_type';
		$lineicons_font_param['integrated_shortcode'] = 'vc_icon';
		$lineicons_font_param['integrated_shortcode_field'] = 'i_';
		unset($lineicons_font_param['weight']);
		$el_class_param = WPBMap::getParam('vc_tta_section', 'el_class');
		vc_remove_param('vc_tta_section', 'el_class');
		vc_add_param('vc_tta_section', $lineicons_font_param);
		vc_add_param('vc_tta_section', $el_class_param);

	}
}
add_action( 'vc_after_init', 'vc_jscomposer_after_init');

if( !function_exists('ventcamp_lineicons_css') ) {
	function ventcamp_lineicons_css(){
		wp_enqueue_style( 'font-lineicons', get_template_directory_uri() . '/css/lib/font-lineicons.css' );
		wp_enqueue_script( 'ventcamp-extend-composer-views', get_template_directory_uri() . '/js/ventcamp-composer.js', array(), null,  true);
	}
}
add_action( 'vc_backend_editor_enqueue_js_css', 'ventcamp_lineicons_css' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'ventcamp_lineicons_css' );



if( !function_exists('ventcamp_enqueue_font_icon') ) {
	function ventcamp_enqueue_font_icon($font){
		if('lineicons' === $font){
			wp_enqueue_style( 'font-lineicons', get_template_directory_uri() . '/css/lib/font-lineicons.css' );
		}
	}
}
add_action( 'vc_enqueue_font_icon_element', 'ventcamp_enqueue_font_icon');



if( !function_exists('ventcamp_icons_lineicons') ) {
	function ventcamp_icons_lineicons(){
		$lineicons_icons = array(
	array('icon icon-alerts-01' =>  esc_html__('icon icon-alerts-01', 'ventcamp')),
	array('icon icon-alerts-02' =>  esc_html__('icon icon-alerts-02', 'ventcamp')),
	array('icon icon-alerts-03' =>  esc_html__('icon icon-alerts-03', 'ventcamp')),
	array('icon icon-alerts-04' =>  esc_html__('icon icon-alerts-04', 'ventcamp')),
	array('icon icon-alerts-05' =>  esc_html__('icon icon-alerts-05', 'ventcamp')),
	array('icon icon-alerts-06' =>  esc_html__('icon icon-alerts-06', 'ventcamp')),
	array('icon icon-alerts-07' =>  esc_html__('icon icon-alerts-07', 'ventcamp')),
	array('icon icon-alerts-08' =>  esc_html__('icon icon-alerts-08', 'ventcamp')),
	array('icon icon-alerts-09' =>  esc_html__('icon icon-alerts-09', 'ventcamp')),
	array('icon icon-alerts-10' =>  esc_html__('icon icon-alerts-10', 'ventcamp')),
	array('icon icon-alerts-11' =>  esc_html__('icon icon-alerts-11', 'ventcamp')),
	array('icon icon-alerts-12' =>  esc_html__('icon icon-alerts-12', 'ventcamp')),
	array('icon icon-alerts-13' =>  esc_html__('icon icon-alerts-13', 'ventcamp')),
	array('icon icon-arrows-08' =>  esc_html__('icon icon-arrows-08', 'ventcamp')),
	array('icon icon-arrows-07' =>  esc_html__('icon icon-arrows-07', 'ventcamp')),
	array('icon icon-arrows-06' =>  esc_html__('icon icon-arrows-06', 'ventcamp')),
	array('icon icon-arrows-05' =>  esc_html__('icon icon-arrows-05', 'ventcamp')),
	array('icon icon-arrows-03' =>  esc_html__('icon icon-arrows-03', 'ventcamp')),
	array('icon icon-arrows-04' =>  esc_html__('icon icon-arrows-04', 'ventcamp')),
	array('icon icon-arrows-02' =>  esc_html__('icon icon-arrows-02', 'ventcamp')),
	array('icon icon-arrows-01' =>  esc_html__('icon icon-arrows-01', 'ventcamp')),
	array('icon icon-alerts-18' =>  esc_html__('icon icon-alerts-18', 'ventcamp')),
	array('icon icon-alerts-17' =>  esc_html__('icon icon-alerts-17', 'ventcamp')),
	array('icon icon-alerts-16' =>  esc_html__('icon icon-alerts-16', 'ventcamp')),
	array('icon icon-alerts-15' =>  esc_html__('icon icon-alerts-15', 'ventcamp')),
	array('icon icon-alerts-14' =>  esc_html__('icon icon-alerts-14', 'ventcamp')),
	array('icon icon-arrows-09' =>  esc_html__('icon icon-arrows-09', 'ventcamp')),
	array('icon icon-arrows-10' =>  esc_html__('icon icon-arrows-10', 'ventcamp')),
	array('icon icon-arrows-11' =>  esc_html__('icon icon-arrows-11', 'ventcamp')),
	array('icon icon-arrows-12' =>  esc_html__('icon icon-arrows-12', 'ventcamp')),
	array('icon icon-arrows-13' =>  esc_html__('icon icon-arrows-13', 'ventcamp')),
	array('icon icon-arrows-14' =>  esc_html__('icon icon-arrows-14', 'ventcamp')),
	array('icon icon-arrows-15' =>  esc_html__('icon icon-arrows-15', 'ventcamp')),
	array('icon icon-arrows-16' =>  esc_html__('icon icon-arrows-16', 'ventcamp')),
	array('icon icon-arrows-22' =>  esc_html__('icon icon-arrows-22', 'ventcamp')),
	array('icon icon-arrows-17' =>  esc_html__('icon icon-arrows-17', 'ventcamp')),
	array('icon icon-arrows-18' =>  esc_html__('icon icon-arrows-18', 'ventcamp')),
	array('icon icon-arrows-19' =>  esc_html__('icon icon-arrows-19', 'ventcamp')),
	array('icon icon-arrows-20' =>  esc_html__('icon icon-arrows-20', 'ventcamp')),
	array('icon icon-arrows-21' =>  esc_html__('icon icon-arrows-21', 'ventcamp')),
	array('icon icon-arrows-30' =>  esc_html__('icon icon-arrows-30', 'ventcamp')),
	array('icon icon-arrows-31' =>  esc_html__('icon icon-arrows-31', 'ventcamp')),
	array('icon icon-arrows-32' =>  esc_html__('icon icon-arrows-32', 'ventcamp')),
	array('icon icon-arrows-33' =>  esc_html__('icon icon-arrows-33', 'ventcamp')),
	array('icon icon-arrows-34' =>  esc_html__('icon icon-arrows-34', 'ventcamp')),
	array('icon icon-arrows-23' =>  esc_html__('icon icon-arrows-23', 'ventcamp')),
	array('icon icon-arrows-24' =>  esc_html__('icon icon-arrows-24', 'ventcamp')),
	array('icon icon-arrows-25' =>  esc_html__('icon icon-arrows-25', 'ventcamp')),
	array('icon icon-arrows-26' =>  esc_html__('icon icon-arrows-26', 'ventcamp')),
	array('icon icon-arrows-27' =>  esc_html__('icon icon-arrows-27', 'ventcamp')),
	array('icon icon-arrows-28' =>  esc_html__('icon icon-arrows-28', 'ventcamp')),
	array('icon icon-arrows-29' =>  esc_html__('icon icon-arrows-29', 'ventcamp')),
	array('icon icon-arrows-36' =>  esc_html__('icon icon-arrows-36', 'ventcamp')),
	array('icon icon-arrows-37' =>  esc_html__('icon icon-arrows-37', 'ventcamp')),
	array('icon icon-arrows-38' =>  esc_html__('icon icon-arrows-38', 'ventcamp')),
	array('icon icon-arrows-39' =>  esc_html__('icon icon-arrows-39', 'ventcamp')),
	array('icon icon-arrows-40' =>  esc_html__('icon icon-arrows-40', 'ventcamp')),
	array('icon icon-arrows-41' =>  esc_html__('icon icon-arrows-41', 'ventcamp')),
	array('icon icon-badges-votes-01' =>  esc_html__('icon icon-badges-votes-01', 'ventcamp')),
	array('icon icon-badges-votes-02' =>  esc_html__('icon icon-badges-votes-02', 'ventcamp')),
	array('icon icon-arrows-30' =>  esc_html__('icon icon-arrows-30', 'ventcamp')),
	array('icon icon-badges-votes-03' =>  esc_html__('icon icon-badges-votes-03', 'ventcamp')),
	array('icon icon-badges-votes-04' =>  esc_html__('icon icon-badges-votes-04', 'ventcamp')),
	array('icon icon-badges-votes-05' =>  esc_html__('icon icon-badges-votes-05', 'ventcamp')),
	array('icon icon-badges-votes-06' =>  esc_html__('icon icon-badges-votes-06', 'ventcamp')),
	array('icon icon-arrows-35' =>  esc_html__('icon icon-arrows-35', 'ventcamp')),
	array('icon icon-badges-votes-07' =>  esc_html__('icon icon-badges-votes-07', 'ventcamp')),
	array('icon icon-badges-votes-08' =>  esc_html__('icon icon-badges-votes-08', 'ventcamp')),
	array('icon icon-badges-votes-09' =>  esc_html__('icon icon-badges-votes-09', 'ventcamp')),
	array('icon icon-badges-votes-10' =>  esc_html__('icon icon-badges-votes-10', 'ventcamp')),
	array('icon icon-badges-votes-11' =>  esc_html__('icon icon-badges-votes-11', 'ventcamp')),
	array('icon icon-badges-votes-12' =>  esc_html__('icon icon-badges-votes-12', 'ventcamp')),
	array('icon icon-badges-votes-13' =>  esc_html__('icon icon-badges-votes-13', 'ventcamp')),
	array('icon icon-badges-votes-14' =>  esc_html__('icon icon-badges-votes-14', 'ventcamp')),
	array('icon icon-badges-votes-15' =>  esc_html__('icon icon-badges-votes-15', 'ventcamp')),
	array('icon icon-badges-votes-16' =>  esc_html__('icon icon-badges-votes-16', 'ventcamp')),
	array('icon icon-chat-messages-01' =>  esc_html__('icon icon-chat-messages-01', 'ventcamp')),
	array('icon icon-chat-messages-02' =>  esc_html__('icon icon-chat-messages-02', 'ventcamp')),
	array('icon icon-chat-messages-03' =>  esc_html__('icon icon-chat-messages-03', 'ventcamp')),
	array('icon icon-chat-messages-04' =>  esc_html__('icon icon-chat-messages-04', 'ventcamp')),
	array('icon icon-chat-messages-05' =>  esc_html__('icon icon-chat-messages-05', 'ventcamp')),
	array('icon icon-chat-messages-06' =>  esc_html__('icon icon-chat-messages-06', 'ventcamp')),
	array('icon icon-chat-messages-07' =>  esc_html__('icon icon-chat-messages-07', 'ventcamp')),
	array('icon icon-chat-messages-08' =>  esc_html__('icon icon-chat-messages-08', 'ventcamp')),
	array('icon icon-chat-messages-09' =>  esc_html__('icon icon-chat-messages-09', 'ventcamp')),
	array('icon icon-chat-messages-10' =>  esc_html__('icon icon-chat-messages-10', 'ventcamp')),
	array('icon icon-chat-messages-11' =>  esc_html__('icon icon-chat-messages-11', 'ventcamp')),
	array('icon icon-chat-messages-12' =>  esc_html__('icon icon-chat-messages-12', 'ventcamp')),
	array('icon icon-chat-messages-13' =>  esc_html__('icon icon-chat-messages-13', 'ventcamp')),
	array('icon icon-chat-messages-14' =>  esc_html__('icon icon-chat-messages-14', 'ventcamp')),
	array('icon icon-chat-messages-15' =>  esc_html__('icon icon-chat-messages-15', 'ventcamp')),
	array('icon icon-chat-messages-16' =>  esc_html__('icon icon-chat-messages-16', 'ventcamp')),
	array('icon icon-documents-bookmarks-01' =>  esc_html__('icon icon-documents-bookmarks-01', 'ventcamp')),
	array('icon icon-documents-bookmarks-02' =>  esc_html__('icon icon-documents-bookmarks-02', 'ventcamp')),
	array('icon icon-documents-bookmarks-03' =>  esc_html__('icon icon-documents-bookmarks-03', 'ventcamp')),
	array('icon icon-documents-bookmarks-04' =>  esc_html__('icon icon-documents-bookmarks-04', 'ventcamp')),
	array('icon icon-documents-bookmarks-05' =>  esc_html__('icon icon-documents-bookmarks-05', 'ventcamp')),
	array('icon icon-documents-bookmarks-06' =>  esc_html__('icon icon-documents-bookmarks-06', 'ventcamp')),
	array('icon icon-documents-bookmarks-07' =>  esc_html__('icon icon-documents-bookmarks-07', 'ventcamp')),
	array('icon icon-documents-bookmarks-08' =>  esc_html__('icon icon-documents-bookmarks-08', 'ventcamp')),
	array('icon icon-documents-bookmarks-09' =>  esc_html__('icon icon-documents-bookmarks-09', 'ventcamp')),
	array('icon icon-documents-bookmarks-10' =>  esc_html__('icon icon-documents-bookmarks-10', 'ventcamp')),
	array('icon icon-documents-bookmarks-11' =>  esc_html__('icon icon-documents-bookmarks-11', 'ventcamp')),
	array('icon icon-documents-bookmarks-12' =>  esc_html__('icon icon-documents-bookmarks-12', 'ventcamp')),
	array('icon icon-documents-bookmarks-13' =>  esc_html__('icon icon-documents-bookmarks-13', 'ventcamp')),
	array('icon icon-documents-bookmarks-14' =>  esc_html__('icon icon-documents-bookmarks-14', 'ventcamp')),
	array('icon icon-documents-bookmarks-15' =>  esc_html__('icon icon-documents-bookmarks-15', 'ventcamp')),
	array('icon icon-documents-bookmarks-16' =>  esc_html__('icon icon-documents-bookmarks-16', 'ventcamp')),
	array('icon icon-ecology-01' =>  esc_html__('icon icon-ecology-01', 'ventcamp')),
	array('icon icon-ecology-02' =>  esc_html__('icon icon-ecology-02', 'ventcamp')),
	array('icon icon-ecology-03' =>  esc_html__('icon icon-ecology-03', 'ventcamp')),
	array('icon icon-ecology-04' =>  esc_html__('icon icon-ecology-04', 'ventcamp')),
	array('icon icon-ecology-05' =>  esc_html__('icon icon-ecology-05', 'ventcamp')),
	array('icon icon-ecology-06' =>  esc_html__('icon icon-ecology-06', 'ventcamp')),
	array('icon icon-ecology-07' =>  esc_html__('icon icon-ecology-07', 'ventcamp')),
	array('icon icon-ecology-08' =>  esc_html__('icon icon-ecology-08', 'ventcamp')),
	array('icon icon-ecology-09' =>  esc_html__('icon icon-ecology-09', 'ventcamp')),
	array('icon icon-ecology-10' =>  esc_html__('icon icon-ecology-10', 'ventcamp')),
	array('icon icon-ecology-11' =>  esc_html__('icon icon-ecology-11', 'ventcamp')),
	array('icon icon-ecology-12' =>  esc_html__('icon icon-ecology-12', 'ventcamp')),
	array('icon icon-ecology-13' =>  esc_html__('icon icon-ecology-13', 'ventcamp')),
	array('icon icon-ecology-14' =>  esc_html__('icon icon-ecology-14', 'ventcamp')),
	array('icon icon-ecology-15' =>  esc_html__('icon icon-ecology-15', 'ventcamp')),
	array('icon icon-ecology-16' =>  esc_html__('icon icon-ecology-16', 'ventcamp')),
	array('icon icon-education-science-01' =>  esc_html__('icon icon-education-science-01', 'ventcamp')),
	array('icon icon-education-science-02' =>  esc_html__('icon icon-education-science-02', 'ventcamp')),
	array('icon icon-education-science-03' =>  esc_html__('icon icon-education-science-03', 'ventcamp')),
	array('icon icon-education-science-04' =>  esc_html__('icon icon-education-science-04', 'ventcamp')),
	array('icon icon-education-science-05' =>  esc_html__('icon icon-education-science-05', 'ventcamp')),
	array('icon icon-education-science-06' =>  esc_html__('icon icon-education-science-06', 'ventcamp')),
	array('icon icon-education-science-07' =>  esc_html__('icon icon-education-science-07', 'ventcamp')),
	array('icon icon-education-science-08' =>  esc_html__('icon icon-education-science-08', 'ventcamp')),
	array('icon icon-education-science-09' =>  esc_html__('icon icon-education-science-09', 'ventcamp')),
	array('icon icon-education-science-10' =>  esc_html__('icon icon-education-science-10', 'ventcamp')),
	array('icon icon-education-science-11' =>  esc_html__('icon icon-education-science-11', 'ventcamp')),
	array('icon icon-education-science-12' =>  esc_html__('icon icon-education-science-12', 'ventcamp')),
	array('icon icon-education-science-13' =>  esc_html__('icon icon-education-science-13', 'ventcamp')),
	array('icon icon-education-science-14' =>  esc_html__('icon icon-education-science-14', 'ventcamp')),
	array('icon icon-education-science-15' =>  esc_html__('icon icon-education-science-15', 'ventcamp')),
	array('icon icon-education-science-16' =>  esc_html__('icon icon-education-science-16', 'ventcamp')),
	array('icon icon-education-science-17' =>  esc_html__('icon icon-education-science-17', 'ventcamp')),
	array('icon icon-education-science-18' =>  esc_html__('icon icon-education-science-18', 'ventcamp')),
	array('icon icon-education-science-19' =>  esc_html__('icon icon-education-science-19', 'ventcamp')),
	array('icon icon-education-science-20' =>  esc_html__('icon icon-education-science-20', 'ventcamp')),
	array('icon icon-emoticons-01' =>  esc_html__('icon icon-emoticons-01', 'ventcamp')),
	array('icon icon-emoticons-02' =>  esc_html__('icon icon-emoticons-02', 'ventcamp')),
	array('icon icon-emoticons-03' =>  esc_html__('icon icon-emoticons-03', 'ventcamp')),
	array('icon icon-emoticons-04' =>  esc_html__('icon icon-emoticons-04', 'ventcamp')),
	array('icon icon-emoticons-05' =>  esc_html__('icon icon-emoticons-05', 'ventcamp')),
	array('icon icon-emoticons-06' =>  esc_html__('icon icon-emoticons-06', 'ventcamp')),
	array('icon icon-emoticons-07' =>  esc_html__('icon icon-emoticons-07', 'ventcamp')),
	array('icon icon-emoticons-08' =>  esc_html__('icon icon-emoticons-08', 'ventcamp')),
	array('icon icon-emoticons-09' =>  esc_html__('icon icon-emoticons-09', 'ventcamp')),
	array('icon icon-emoticons-10' =>  esc_html__('icon icon-emoticons-10', 'ventcamp')),
	array('icon icon-emoticons-11' =>  esc_html__('icon icon-emoticons-11', 'ventcamp')),
	array('icon icon-emoticons-12' =>  esc_html__('icon icon-emoticons-12', 'ventcamp')),
	array('icon icon-emoticons-13' =>  esc_html__('icon icon-emoticons-13', 'ventcamp')),
	array('icon icon-emoticons-14' =>  esc_html__('icon icon-emoticons-14', 'ventcamp')),
	array('icon icon-emoticons-15' =>  esc_html__('icon icon-emoticons-15', 'ventcamp')),
	array('icon icon-emoticons-16' =>  esc_html__('icon icon-emoticons-16', 'ventcamp')),
	array('icon icon-emoticons-17' =>  esc_html__('icon icon-emoticons-17', 'ventcamp')),
	array('icon icon-emoticons-18' =>  esc_html__('icon icon-emoticons-18', 'ventcamp')),
	array('icon icon-emoticons-19' =>  esc_html__('icon icon-emoticons-19', 'ventcamp')),
	array('icon icon-emoticons-20' =>  esc_html__('icon icon-emoticons-20', 'ventcamp')),
	array('icon icon-emoticons-21' =>  esc_html__('icon icon-emoticons-21', 'ventcamp')),
	array('icon icon-emoticons-22' =>  esc_html__('icon icon-emoticons-22', 'ventcamp')),
	array('icon icon-emoticons-23' =>  esc_html__('icon icon-emoticons-23', 'ventcamp')),
	array('icon icon-emoticons-24' =>  esc_html__('icon icon-emoticons-24', 'ventcamp')),
	array('icon icon-emoticons-25' =>  esc_html__('icon icon-emoticons-25', 'ventcamp')),
	array('icon icon-emoticons-26' =>  esc_html__('icon icon-emoticons-26', 'ventcamp')),
	array('icon icon-emoticons-27' =>  esc_html__('icon icon-emoticons-27', 'ventcamp')),
	array('icon icon-emoticons-28' =>  esc_html__('icon icon-emoticons-28', 'ventcamp')),
	array('icon icon-emoticons-29' =>  esc_html__('icon icon-emoticons-29', 'ventcamp')),
	array('icon icon-emoticons-30' =>  esc_html__('icon icon-emoticons-30', 'ventcamp')),
	array('icon icon-emoticons-31' =>  esc_html__('icon icon-emoticons-31', 'ventcamp')),
	array('icon icon-emoticons-32' =>  esc_html__('icon icon-emoticons-32', 'ventcamp')),
	array('icon icon-emoticons-33' =>  esc_html__('icon icon-emoticons-33', 'ventcamp')),
	array('icon icon-emoticons-34' =>  esc_html__('icon icon-emoticons-34', 'ventcamp')),
	array('icon icon-emoticons-35' =>  esc_html__('icon icon-emoticons-35', 'ventcamp')),
	array('icon icon-emoticons-artboard-80' =>  esc_html__('icon icon-emoticons-artboard-80', 'ventcamp')),
	array('icon icon-faces-users-01' =>  esc_html__('icon icon-faces-users-01', 'ventcamp')),
	array('icon icon-faces-users-02' =>  esc_html__('icon icon-faces-users-02', 'ventcamp')),
	array('icon icon-faces-users-03' =>  esc_html__('icon icon-faces-users-03', 'ventcamp')),
	array('icon icon-faces-users-04' =>  esc_html__('icon icon-faces-users-04', 'ventcamp')),
	array('icon icon-faces-users-05' =>  esc_html__('icon icon-faces-users-05', 'ventcamp')),
	array('icon icon-faces-users-06' =>  esc_html__('icon icon-faces-users-06', 'ventcamp')),
	array('icon icon-faces-users-07' =>  esc_html__('icon icon-faces-users-07', 'ventcamp')),
	array('icon icon-filetypes-01' =>  esc_html__('icon icon-filetypes-01', 'ventcamp')),
	array('icon icon-filetypes-02' =>  esc_html__('icon icon-filetypes-02', 'ventcamp')),
	array('icon icon-filetypes-03' =>  esc_html__('icon icon-filetypes-03', 'ventcamp')),
	array('icon icon-filetypes-04' =>  esc_html__('icon icon-filetypes-04', 'ventcamp')),
	array('icon icon-filetypes-05' =>  esc_html__('icon icon-filetypes-05', 'ventcamp')),
	array('icon icon-filetypes-06' =>  esc_html__('icon icon-filetypes-06', 'ventcamp')),
	array('icon icon-filetypes-07' =>  esc_html__('icon icon-filetypes-07', 'ventcamp')),
	array('icon icon-filetypes-08' =>  esc_html__('icon icon-filetypes-08', 'ventcamp')),
	array('icon icon-filetypes-09' =>  esc_html__('icon icon-filetypes-09', 'ventcamp')),
	array('icon icon-filetypes-10' =>  esc_html__('icon icon-filetypes-10', 'ventcamp')),
	array('icon icon-filetypes-11' =>  esc_html__('icon icon-filetypes-11', 'ventcamp')),
	array('icon icon-filetypes-12' =>  esc_html__('icon icon-filetypes-12', 'ventcamp')),
	array('icon icon-filetypes-13' =>  esc_html__('icon icon-filetypes-13', 'ventcamp')),
	array('icon icon-filetypes-14' =>  esc_html__('icon icon-filetypes-14', 'ventcamp')),
	array('icon icon-filetypes-15' =>  esc_html__('icon icon-filetypes-15', 'ventcamp')),
	array('icon icon-filetypes-16' =>  esc_html__('icon icon-filetypes-16', 'ventcamp')),
	array('icon icon-filetypes-17' =>  esc_html__('icon icon-filetypes-17', 'ventcamp')),
	array('icon icon-food-01' =>  esc_html__('icon icon-food-01', 'ventcamp')),
	array('icon icon-food-02' =>  esc_html__('icon icon-food-02', 'ventcamp')),
	array('icon icon-food-03' =>  esc_html__('icon icon-food-03', 'ventcamp')),
	array('icon icon-food-04' =>  esc_html__('icon icon-food-04', 'ventcamp')),
	array('icon icon-food-05' =>  esc_html__('icon icon-food-05', 'ventcamp')),
	array('icon icon-food-06' =>  esc_html__('icon icon-food-06', 'ventcamp')),
	array('icon icon-food-07' =>  esc_html__('icon icon-food-07', 'ventcamp')),
	array('icon icon-food-08' =>  esc_html__('icon icon-food-08', 'ventcamp')),
	array('icon icon-food-09' =>  esc_html__('icon icon-food-09', 'ventcamp')),
	array('icon icon-food-10' =>  esc_html__('icon icon-food-10', 'ventcamp')),
	array('icon icon-food-11' =>  esc_html__('icon icon-food-11', 'ventcamp')),
	array('icon icon-food-12' =>  esc_html__('icon icon-food-12', 'ventcamp')),
	array('icon icon-food-13' =>  esc_html__('icon icon-food-13', 'ventcamp')),
	array('icon icon-food-14' =>  esc_html__('icon icon-food-14', 'ventcamp')),
	array('icon icon-food-15' =>  esc_html__('icon icon-food-15', 'ventcamp')),
	array('icon icon-food-16' =>  esc_html__('icon icon-food-16', 'ventcamp')),
	array('icon icon-food-17' =>  esc_html__('icon icon-food-17', 'ventcamp')),
	array('icon icon-food-18' =>  esc_html__('icon icon-food-18', 'ventcamp')),
	array('icon icon-graphic-design-01' =>  esc_html__('icon icon-graphic-design-01', 'ventcamp')),
	array('icon icon-graphic-design-02' =>  esc_html__('icon icon-graphic-design-02', 'ventcamp')),
	array('icon icon-graphic-design-03' =>  esc_html__('icon icon-graphic-design-03', 'ventcamp')),
	array('icon icon-graphic-design-04' =>  esc_html__('icon icon-graphic-design-04', 'ventcamp')),
	array('icon icon-graphic-design-05' =>  esc_html__('icon icon-graphic-design-05', 'ventcamp')),
	array('icon icon-graphic-design-06' =>  esc_html__('icon icon-graphic-design-06', 'ventcamp')),
	array('icon icon-graphic-design-07' =>  esc_html__('icon icon-graphic-design-07', 'ventcamp')),
	array('icon icon-graphic-design-08' =>  esc_html__('icon icon-graphic-design-08', 'ventcamp')),
	array('icon icon-graphic-design-09' =>  esc_html__('icon icon-graphic-design-09', 'ventcamp')),
	array('icon icon-graphic-design-10' =>  esc_html__('icon icon-graphic-design-10', 'ventcamp')),
	array('icon icon-graphic-design-11' =>  esc_html__('icon icon-graphic-design-11', 'ventcamp')),
	array('icon icon-graphic-design-12' =>  esc_html__('icon icon-graphic-design-12', 'ventcamp')),
	array('icon icon-graphic-design-13' =>  esc_html__('icon icon-graphic-design-13', 'ventcamp')),
	array('icon icon-graphic-design-14' =>  esc_html__('icon icon-graphic-design-14', 'ventcamp')),
	array('icon icon-graphic-design-15' =>  esc_html__('icon icon-graphic-design-15', 'ventcamp')),
	array('icon icon-graphic-design-16' =>  esc_html__('icon icon-graphic-design-16', 'ventcamp')),
	array('icon icon-graphic-design-17' =>  esc_html__('icon icon-graphic-design-17', 'ventcamp')),
	array('icon icon-graphic-design-18' =>  esc_html__('icon icon-graphic-design-18', 'ventcamp')),
	array('icon icon-graphic-design-19' =>  esc_html__('icon icon-graphic-design-19', 'ventcamp')),
	array('icon icon-graphic-design-20' =>  esc_html__('icon icon-graphic-design-20', 'ventcamp')),
	array('icon icon-graphic-design-21' =>  esc_html__('icon icon-graphic-design-21', 'ventcamp')),
	array('icon icon-graphic-design-22' =>  esc_html__('icon icon-graphic-design-22', 'ventcamp')),
	array('icon icon-graphic-design-23' =>  esc_html__('icon icon-graphic-design-23', 'ventcamp')),
	array('icon icon-graphic-design-24' =>  esc_html__('icon icon-graphic-design-24', 'ventcamp')),
	array('icon icon-graphic-design-25' =>  esc_html__('icon icon-graphic-design-25', 'ventcamp')),
	array('icon icon-graphic-design-26' =>  esc_html__('icon icon-graphic-design-26', 'ventcamp')),
	array('icon icon-graphic-design-27' =>  esc_html__('icon icon-graphic-design-27', 'ventcamp')),
	array('icon icon-graphic-design-28' =>  esc_html__('icon icon-graphic-design-28', 'ventcamp')),
	array('icon icon-graphic-design-29' =>  esc_html__('icon icon-graphic-design-29', 'ventcamp')),
	array('icon icon-graphic-design-30' =>  esc_html__('icon icon-graphic-design-30', 'ventcamp')),
	array('icon icon-graphic-design-31' =>  esc_html__('icon icon-graphic-design-31', 'ventcamp')),
	array('icon icon-graphic-design-32' =>  esc_html__('icon icon-graphic-design-32', 'ventcamp')),
	array('icon icon-graphic-design-33' =>  esc_html__('icon icon-graphic-design-33', 'ventcamp')),
	array('icon icon-graphic-design-34' =>  esc_html__('icon icon-graphic-design-34', 'ventcamp')),
	array('icon icon-medical-01' =>  esc_html__('icon icon-medical-01', 'ventcamp')),
	array('icon icon-medical-02' =>  esc_html__('icon icon-medical-02', 'ventcamp')),
	array('icon icon-medical-03' =>  esc_html__('icon icon-medical-03', 'ventcamp')),
	array('icon icon-medical-04' =>  esc_html__('icon icon-medical-04', 'ventcamp')),
	array('icon icon-medical-05' =>  esc_html__('icon icon-medical-05', 'ventcamp')),
	array('icon icon-medical-06' =>  esc_html__('icon icon-medical-06', 'ventcamp')),
	array('icon icon-medical-07' =>  esc_html__('icon icon-medical-07', 'ventcamp')),
	array('icon icon-medical-08' =>  esc_html__('icon icon-medical-08', 'ventcamp')),
	array('icon icon-medical-09' =>  esc_html__('icon icon-medical-09', 'ventcamp')),
	array('icon icon-medical-10' =>  esc_html__('icon icon-medical-10', 'ventcamp')),
	array('icon icon-medical-11' =>  esc_html__('icon icon-medical-11', 'ventcamp')),
	array('icon icon-medical-12' =>  esc_html__('icon icon-medical-12', 'ventcamp')),
	array('icon icon-medical-13' =>  esc_html__('icon icon-medical-13', 'ventcamp')),
	array('icon icon-medical-14' =>  esc_html__('icon icon-medical-14', 'ventcamp')),
	array('icon icon-medical-15' =>  esc_html__('icon icon-medical-15', 'ventcamp')),
	array('icon icon-medical-16' =>  esc_html__('icon icon-medical-16', 'ventcamp')),
	array('icon icon-medical-17' =>  esc_html__('icon icon-medical-17', 'ventcamp')),
	array('icon icon-medical-18' =>  esc_html__('icon icon-medical-18', 'ventcamp')),
	array('icon icon-medical-19' =>  esc_html__('icon icon-medical-19', 'ventcamp')),
	array('icon icon-medical-20' =>  esc_html__('icon icon-medical-20', 'ventcamp')),
	array('icon icon-medical-21' =>  esc_html__('icon icon-medical-21', 'ventcamp')),
	array('icon icon-medical-22' =>  esc_html__('icon icon-medical-22', 'ventcamp')),
	array('icon icon-medical-23' =>  esc_html__('icon icon-medical-23', 'ventcamp')),
	array('icon icon-medical-24' =>  esc_html__('icon icon-medical-24', 'ventcamp')),
	array('icon icon-medical-25' =>  esc_html__('icon icon-medical-25', 'ventcamp')),
	array('icon icon-medical-26' =>  esc_html__('icon icon-medical-26', 'ventcamp')),
	array('icon icon-medical-27' =>  esc_html__('icon icon-medical-27', 'ventcamp')),
	array('icon icon-medical-28' =>  esc_html__('icon icon-medical-28', 'ventcamp')),
	array('icon icon-multimedia-01' =>  esc_html__('icon icon-multimedia-01', 'ventcamp')),
	array('icon icon-multimedia-02' =>  esc_html__('icon icon-multimedia-02', 'ventcamp')),
	array('icon icon-multimedia-03' =>  esc_html__('icon icon-multimedia-03', 'ventcamp')),
	array('icon icon-multimedia-04' =>  esc_html__('icon icon-multimedia-04', 'ventcamp')),
	array('icon icon-multimedia-05' =>  esc_html__('icon icon-multimedia-05', 'ventcamp')),
	array('icon icon-multimedia-06' =>  esc_html__('icon icon-multimedia-06', 'ventcamp')),
	array('icon icon-multimedia-07' =>  esc_html__('icon icon-multimedia-07', 'ventcamp')),
	array('icon icon-multimedia-08' =>  esc_html__('icon icon-multimedia-08', 'ventcamp')),
	array('icon icon-multimedia-09' =>  esc_html__('icon icon-multimedia-09', 'ventcamp')),
	array('icon icon-multimedia-10' =>  esc_html__('icon icon-multimedia-10', 'ventcamp')),
	array('icon icon-multimedia-11' =>  esc_html__('icon icon-multimedia-11', 'ventcamp')),
	array('icon icon-multimedia-12' =>  esc_html__('icon icon-multimedia-12', 'ventcamp')),
	array('icon icon-multimedia-13' =>  esc_html__('icon icon-multimedia-13', 'ventcamp')),
	array('icon icon-multimedia-14' =>  esc_html__('icon icon-multimedia-14', 'ventcamp')),
	array('icon icon-multimedia-15' =>  esc_html__('icon icon-multimedia-15', 'ventcamp')),
	array('icon icon-multimedia-16' =>  esc_html__('icon icon-multimedia-16', 'ventcamp')),
	array('icon icon-multimedia-17' =>  esc_html__('icon icon-multimedia-17', 'ventcamp')),
	array('icon icon-multimedia-18' =>  esc_html__('icon icon-multimedia-18', 'ventcamp')),
	array('icon icon-multimedia-19' =>  esc_html__('icon icon-multimedia-19', 'ventcamp')),
	array('icon icon-multimedia-20' =>  esc_html__('icon icon-multimedia-20', 'ventcamp')),
	array('icon icon-multimedia-21' =>  esc_html__('icon icon-multimedia-21', 'ventcamp')),
	array('icon icon-multimedia-22' =>  esc_html__('icon icon-multimedia-22', 'ventcamp')),
	array('icon icon-multimedia-23' =>  esc_html__('icon icon-multimedia-23', 'ventcamp')),
	array('icon icon-multimedia-24' =>  esc_html__('icon icon-multimedia-24', 'ventcamp')),
	array('icon icon-multimedia-25' =>  esc_html__('icon icon-multimedia-25', 'ventcamp')),
	array('icon icon-multimedia-26' =>  esc_html__('icon icon-multimedia-26', 'ventcamp')),
	array('icon icon-multimedia-27' =>  esc_html__('icon icon-multimedia-27', 'ventcamp')),
	array('icon icon-multimedia-28' =>  esc_html__('icon icon-multimedia-28', 'ventcamp')),
	array('icon icon-multimedia-29' =>  esc_html__('icon icon-multimedia-29', 'ventcamp')),
	array('icon icon-multimedia-30' =>  esc_html__('icon icon-multimedia-30', 'ventcamp')),
	array('icon icon-multimedia-31' =>  esc_html__('icon icon-multimedia-31', 'ventcamp')),
	array('icon icon-multimedia-32' =>  esc_html__('icon icon-multimedia-32', 'ventcamp')),
	array('icon icon-multimedia-33' =>  esc_html__('icon icon-multimedia-33', 'ventcamp')),
	array('icon icon-multimedia-34' =>  esc_html__('icon icon-multimedia-34', 'ventcamp')),
	array('icon icon-multimedia-35' =>  esc_html__('icon icon-multimedia-35', 'ventcamp')),
	array('icon icon-multimedia-36' =>  esc_html__('icon icon-multimedia-36', 'ventcamp')),
	array('icon icon-multimedia-37' =>  esc_html__('icon icon-multimedia-37', 'ventcamp')),
	array('icon icon-multimedia-38' =>  esc_html__('icon icon-multimedia-38', 'ventcamp')),
	array('icon icon-multimedia-39' =>  esc_html__('icon icon-multimedia-39', 'ventcamp')),
	array('icon icon-multimedia-40' =>  esc_html__('icon icon-multimedia-40', 'ventcamp')),
	array('icon icon-nature-01' =>  esc_html__('icon icon-nature-01', 'ventcamp')),
	array('icon icon-nature-02' =>  esc_html__('icon icon-nature-02', 'ventcamp')),
	array('icon icon-nature-03' =>  esc_html__('icon icon-nature-03', 'ventcamp')),
	array('icon icon-nature-04' =>  esc_html__('icon icon-nature-04', 'ventcamp')),
	array('icon icon-nature-05' =>  esc_html__('icon icon-nature-05', 'ventcamp')),
	array('icon icon-nature-06' =>  esc_html__('icon icon-nature-06', 'ventcamp')),
	array('icon icon-nature-07' =>  esc_html__('icon icon-nature-07', 'ventcamp')),
	array('icon icon-nature-08' =>  esc_html__('icon icon-nature-08', 'ventcamp')),
	array('icon icon-nature-09' =>  esc_html__('icon icon-nature-09', 'ventcamp')),
	array('icon icon-nature-10' =>  esc_html__('icon icon-nature-10', 'ventcamp')),
	array('icon icon-nature-11' =>  esc_html__('icon icon-nature-11', 'ventcamp')),
	array('icon icon-nature-12' =>  esc_html__('icon icon-nature-12', 'ventcamp')),
	array('icon icon-nature-13' =>  esc_html__('icon icon-nature-13', 'ventcamp')),
	array('icon icon-nature-14' =>  esc_html__('icon icon-nature-14', 'ventcamp')),
	array('icon icon-office-01' =>  esc_html__('icon icon-office-01', 'ventcamp')),
	array('icon icon-office-01' =>  esc_html__('icon icon-office-01', 'ventcamp')),
	array('icon icon-shopping-15' =>  esc_html__('icon icon-shopping-15', 'ventcamp')),
	array('icon icon-shopping-16' =>  esc_html__('icon icon-shopping-16', 'ventcamp')),
	array('icon icon-shopping-17' =>  esc_html__('icon icon-shopping-17', 'ventcamp')),
	array('icon icon-shopping-18' =>  esc_html__('icon icon-shopping-18', 'ventcamp')),
	array('icon icon-shopping-19' =>  esc_html__('icon icon-shopping-19', 'ventcamp')),
	array('icon icon-shopping-20' =>  esc_html__('icon icon-shopping-20', 'ventcamp')),
	array('icon icon-shopping-21' =>  esc_html__('icon icon-shopping-21', 'ventcamp')),
	array('icon icon-shopping-22' =>  esc_html__('icon icon-shopping-22', 'ventcamp')),
	array('icon icon-shopping-23' =>  esc_html__('icon icon-shopping-23', 'ventcamp')),
	array('icon icon-shopping-24' =>  esc_html__('icon icon-shopping-24', 'ventcamp')),
	array('icon icon-shopping-25' =>  esc_html__('icon icon-shopping-25', 'ventcamp')),
	array('icon icon-shopping-26' =>  esc_html__('icon icon-shopping-26', 'ventcamp')),
	array('icon icon-shopping-27' =>  esc_html__('icon icon-shopping-27', 'ventcamp')),
	array('icon icon-socialmedia-01' =>  esc_html__('icon icon-socialmedia-01', 'ventcamp')),
	array('icon icon-socialmedia-02' =>  esc_html__('icon icon-socialmedia-02', 'ventcamp')),
	array('icon icon-socialmedia-03' =>  esc_html__('icon icon-socialmedia-03', 'ventcamp')),
	array('icon icon-socialmedia-04' =>  esc_html__('icon icon-socialmedia-04', 'ventcamp')),
	array('icon icon-socialmedia-05' =>  esc_html__('icon icon-socialmedia-05', 'ventcamp')),
	array('icon icon-socialmedia-06' =>  esc_html__('icon icon-socialmedia-06', 'ventcamp')),
	array('icon icon-socialmedia-07' =>  esc_html__('icon icon-socialmedia-07', 'ventcamp')),
	array('icon icon-socialmedia-08' =>  esc_html__('icon icon-socialmedia-08', 'ventcamp')),
	array('icon icon-socialmedia-09' =>  esc_html__('icon icon-socialmedia-09', 'ventcamp')),
	array('icon icon-socialmedia-10' =>  esc_html__('icon icon-socialmedia-10', 'ventcamp')),
	array('icon icon-socialmedia-11' =>  esc_html__('icon icon-socialmedia-11', 'ventcamp')),
	array('icon icon-socialmedia-12' =>  esc_html__('icon icon-socialmedia-12', 'ventcamp')),
	array('icon icon-socialmedia-13' =>  esc_html__('icon icon-socialmedia-13', 'ventcamp')),
	array('icon icon-socialmedia-14' =>  esc_html__('icon icon-socialmedia-14', 'ventcamp')),
	array('icon icon-socialmedia-15' =>  esc_html__('icon icon-socialmedia-15', 'ventcamp')),
	array('icon icon-socialmedia-16' =>  esc_html__('icon icon-socialmedia-16', 'ventcamp')),
	array('icon icon-socialmedia-17' =>  esc_html__('icon icon-socialmedia-17', 'ventcamp')),
	array('icon icon-socialmedia-18' =>  esc_html__('icon icon-socialmedia-18', 'ventcamp')),
	array('icon icon-socialmedia-19' =>  esc_html__('icon icon-socialmedia-19', 'ventcamp')),
	array('icon icon-socialmedia-20' =>  esc_html__('icon icon-socialmedia-20', 'ventcamp')),
	array('icon icon-socialmedia-21' =>  esc_html__('icon icon-socialmedia-21', 'ventcamp')),
	array('icon icon-socialmedia-22' =>  esc_html__('icon icon-socialmedia-22', 'ventcamp')),
	array('icon icon-socialmedia-23' =>  esc_html__('icon icon-socialmedia-23', 'ventcamp')),
	array('icon icon-socialmedia-24' =>  esc_html__('icon icon-socialmedia-24', 'ventcamp')),
	array('icon icon-socialmedia-25' =>  esc_html__('icon icon-socialmedia-25', 'ventcamp')),
	array('icon icon-socialmedia-26' =>  esc_html__('icon icon-socialmedia-26', 'ventcamp')),
	array('icon icon-socialmedia-27' =>  esc_html__('icon icon-socialmedia-27', 'ventcamp')),
	array('icon icon-socialmedia-28' =>  esc_html__('icon icon-socialmedia-28', 'ventcamp')),
	array('icon icon-socialmedia-29' =>  esc_html__('icon icon-socialmedia-29', 'ventcamp')),
	array('icon icon-sport-01' =>  esc_html__('icon icon-sport-01', 'ventcamp')),
	array('icon icon-sport-02' =>  esc_html__('icon icon-sport-02', 'ventcamp')),
	array('icon icon-sport-03' =>  esc_html__('icon icon-sport-03', 'ventcamp')),
	array('icon icon-sport-04' =>  esc_html__('icon icon-sport-04', 'ventcamp')),
	array('icon icon-sport-05' =>  esc_html__('icon icon-sport-05', 'ventcamp')),
	array('icon icon-sport-06' =>  esc_html__('icon icon-sport-06', 'ventcamp')),
	array('icon icon-sport-07' =>  esc_html__('icon icon-sport-07', 'ventcamp')),
	array('icon icon-sport-08' =>  esc_html__('icon icon-sport-08', 'ventcamp')),
	array('icon icon-sport-09' =>  esc_html__('icon icon-sport-09', 'ventcamp')),
	array('icon icon-sport-10' =>  esc_html__('icon icon-sport-10', 'ventcamp')),
	array('icon icon-sport-11' =>  esc_html__('icon icon-sport-11', 'ventcamp')),
	array('icon icon-sport-12' =>  esc_html__('icon icon-sport-12', 'ventcamp')),
	array('icon icon-sport-13' =>  esc_html__('icon icon-sport-13', 'ventcamp')),
	array('icon icon-sport-14' =>  esc_html__('icon icon-sport-14', 'ventcamp')),
	array('icon icon-sport-15' =>  esc_html__('icon icon-sport-15', 'ventcamp')),
	array('icon icon-sport-16' =>  esc_html__('icon icon-sport-16', 'ventcamp')),
	array('icon icon-sport-17' =>  esc_html__('icon icon-sport-17', 'ventcamp')),
	array('icon icon-sport-18' =>  esc_html__('icon icon-sport-18', 'ventcamp')),
	array('icon icon-text-hierarchy-01' =>  esc_html__('icon icon-text-hierarchy-01', 'ventcamp')),
	array('icon icon-text-hierarchy-02' =>  esc_html__('icon icon-text-hierarchy-02', 'ventcamp')),
	array('icon icon-text-hierarchy-03' =>  esc_html__('icon icon-text-hierarchy-03', 'ventcamp')),
	array('icon icon-text-hierarchy-04' =>  esc_html__('icon icon-text-hierarchy-04', 'ventcamp')),
	array('icon icon-text-hierarchy-05' =>  esc_html__('icon icon-text-hierarchy-05', 'ventcamp')),
	array('icon icon-text-hierarchy-06' =>  esc_html__('icon icon-text-hierarchy-06', 'ventcamp')),
	array('icon icon-text-hierarchy-07' =>  esc_html__('icon icon-text-hierarchy-07', 'ventcamp')),
	array('icon icon-text-hierarchy-08' =>  esc_html__('icon icon-text-hierarchy-08', 'ventcamp')),
	array('icon icon-text-hierarchy-09' =>  esc_html__('icon icon-text-hierarchy-09', 'ventcamp')),
	array('icon icon-text-hierarchy-10' =>  esc_html__('icon icon-text-hierarchy-10', 'ventcamp')),
	array('icon icon-touch-gestures-01' =>  esc_html__('icon icon-touch-gestures-01', 'ventcamp')),
	array('icon icon-touch-gestures-02' =>  esc_html__('icon icon-touch-gestures-02', 'ventcamp')),
	array('icon icon-touch-gestures-03' =>  esc_html__('icon icon-touch-gestures-03', 'ventcamp')),
	array('icon icon-touch-gestures-04' =>  esc_html__('icon icon-touch-gestures-04', 'ventcamp')),
	array('icon icon-touch-gestures-05' =>  esc_html__('icon icon-touch-gestures-05', 'ventcamp')),
	array('icon icon-touch-gestures-06' =>  esc_html__('icon icon-touch-gestures-06', 'ventcamp')),
	array('icon icon-touch-gestures-07' =>  esc_html__('icon icon-touch-gestures-07', 'ventcamp')),
	array('icon icon-touch-gestures-08' =>  esc_html__('icon icon-touch-gestures-08', 'ventcamp')),
	array('icon icon-touch-gestures-09' =>  esc_html__('icon icon-touch-gestures-09', 'ventcamp')),
	array('icon icon-touch-gestures-10' =>  esc_html__('icon icon-touch-gestures-10', 'ventcamp')),
	array('icon icon-touch-gestures-11' =>  esc_html__('icon icon-touch-gestures-11', 'ventcamp')),
	array('icon icon-touch-gestures-12' =>  esc_html__('icon icon-touch-gestures-12', 'ventcamp')),
	array('icon icon-touch-gestures-13' =>  esc_html__('icon icon-touch-gestures-13', 'ventcamp')),
	array('icon icon-touch-gestures-14' =>  esc_html__('icon icon-touch-gestures-14', 'ventcamp')),
	array('icon icon-touch-gestures-15' =>  esc_html__('icon icon-touch-gestures-15', 'ventcamp')),
	array('icon icon-touch-gestures-16' =>  esc_html__('icon icon-touch-gestures-16', 'ventcamp')),
	array('icon icon-touch-gestures-17' =>  esc_html__('icon icon-touch-gestures-17', 'ventcamp')),
	array('icon icon-touch-gestures-18' =>  esc_html__('icon icon-touch-gestures-18', 'ventcamp')),
	array('icon icon-touch-gestures-19' =>  esc_html__('icon icon-touch-gestures-19', 'ventcamp')),
	array('icon icon-touch-gestures-20' =>  esc_html__('icon icon-touch-gestures-20', 'ventcamp')),
	array('icon icon-touch-gestures-21' =>  esc_html__('icon icon-touch-gestures-21', 'ventcamp')),
	array('icon icon-touch-gestures-22' =>  esc_html__('icon icon-touch-gestures-22', 'ventcamp')),
	array('icon icon-touch-gestures-23' =>  esc_html__('icon icon-touch-gestures-23', 'ventcamp')),
	array('icon icon-touch-gestures-24' =>  esc_html__('icon icon-touch-gestures-24', 'ventcamp')),
	array('icon icon-travel-transportation-01' =>  esc_html__('icon icon-travel-transportation-01', 'ventcamp')),
	array('icon icon-travel-transportation-02' =>  esc_html__('icon icon-travel-transportation-02', 'ventcamp')),
	array('icon icon-travel-transportation-03' =>  esc_html__('icon icon-travel-transportation-03', 'ventcamp')),
	array('icon icon-travel-transportation-04' =>  esc_html__('icon icon-travel-transportation-04', 'ventcamp')),
	array('icon icon-travel-transportation-05' =>  esc_html__('icon icon-travel-transportation-05', 'ventcamp')),
	array('icon icon-travel-transportation-06' =>  esc_html__('icon icon-travel-transportation-06', 'ventcamp')),
	array('icon icon-travel-transportation-07' =>  esc_html__('icon icon-travel-transportation-07', 'ventcamp')),
	array('icon icon-travel-transportation-08' =>  esc_html__('icon icon-travel-transportation-08', 'ventcamp')),
	array('icon icon-travel-transportation-09' =>  esc_html__('icon icon-travel-transportation-09', 'ventcamp')),
	array('icon icon-travel-transportation-10' =>  esc_html__('icon icon-travel-transportation-10', 'ventcamp')),
	array('icon icon-travel-transportation-11' =>  esc_html__('icon icon-travel-transportation-11', 'ventcamp')),
	array('icon icon-travel-transportation-12' =>  esc_html__('icon icon-travel-transportation-12', 'ventcamp')),
	array('icon icon-travel-transportation-13' =>  esc_html__('icon icon-travel-transportation-13', 'ventcamp')),
	array('icon icon-travel-transportation-14' =>  esc_html__('icon icon-travel-transportation-14', 'ventcamp')),
	array('icon icon-travel-transportation-15' =>  esc_html__('icon icon-travel-transportation-15', 'ventcamp')),
	array('icon icon-travel-transportation-16' =>  esc_html__('icon icon-travel-transportation-16', 'ventcamp')),
	array('icon icon-travel-transportation-17' =>  esc_html__('icon icon-travel-transportation-17', 'ventcamp')),
	array('icon icon-travel-transportation-18' =>  esc_html__('icon icon-travel-transportation-18', 'ventcamp')),
	array('icon icon-travel-transportation-19' =>  esc_html__('icon icon-travel-transportation-19', 'ventcamp')),
	array('icon icon-travel-transportation-20' =>  esc_html__('icon icon-travel-transportation-20', 'ventcamp')),
	array('icon icon-weather-01' =>  esc_html__('icon icon-weather-01', 'ventcamp')),
	array('icon icon-weather-02' =>  esc_html__('icon icon-weather-02', 'ventcamp')),
	array('icon icon-weather-03' =>  esc_html__('icon icon-weather-03', 'ventcamp')),
	array('icon icon-weather-04' =>  esc_html__('icon icon-weather-04', 'ventcamp')),
	array('icon icon-weather-05' =>  esc_html__('icon icon-weather-05', 'ventcamp')),
	array('icon icon-weather-06' =>  esc_html__('icon icon-weather-06', 'ventcamp')),
	array('icon icon-weather-07' =>  esc_html__('icon icon-weather-07', 'ventcamp')),
	array('icon icon-weather-08' =>  esc_html__('icon icon-weather-08', 'ventcamp')),
	array('icon icon-weather-09' =>  esc_html__('icon icon-weather-09', 'ventcamp')),
	array('icon icon-weather-10' =>  esc_html__('icon icon-weather-10', 'ventcamp')),
	array('icon icon-weather-11' =>  esc_html__('icon icon-weather-11', 'ventcamp')),
	array('icon icon-weather-12' =>  esc_html__('icon icon-weather-12', 'ventcamp')),
	array('icon icon-weather-13' =>  esc_html__('icon icon-weather-13', 'ventcamp')),
	array('icon icon-weather-14' =>  esc_html__('icon icon-weather-14', 'ventcamp')),
	array('icon icon-office-02' =>  esc_html__('icon icon-office-02', 'ventcamp')),
	array('icon icon-office-03' =>  esc_html__('icon icon-office-03', 'ventcamp')),
	array('icon icon-office-04' =>  esc_html__('icon icon-office-04', 'ventcamp')),
	array('icon icon-office-05' =>  esc_html__('icon icon-office-05', 'ventcamp')),
	array('icon icon-office-06' =>  esc_html__('icon icon-office-06', 'ventcamp')),
	array('icon icon-office-07' =>  esc_html__('icon icon-office-07', 'ventcamp')),
	array('icon icon-office-08' =>  esc_html__('icon icon-office-08', 'ventcamp')),
	array('icon icon-office-09' =>  esc_html__('icon icon-office-09', 'ventcamp')),
	array('icon icon-office-10' =>  esc_html__('icon icon-office-10', 'ventcamp')),
	array('icon icon-office-11' =>  esc_html__('icon icon-office-11', 'ventcamp')),
	array('icon icon-office-12' =>  esc_html__('icon icon-office-12', 'ventcamp')),
	array('icon icon-office-13' =>  esc_html__('icon icon-office-13', 'ventcamp')),
	array('icon icon-office-14' =>  esc_html__('icon icon-office-14', 'ventcamp')),
	array('icon icon-office-15' =>  esc_html__('icon icon-office-15', 'ventcamp')),
	array('icon icon-office-16' =>  esc_html__('icon icon-office-16', 'ventcamp')),
	array('icon icon-office-17' =>  esc_html__('icon icon-office-17', 'ventcamp')),
	array('icon icon-office-18' =>  esc_html__('icon icon-office-18', 'ventcamp')),
	array('icon icon-office-19' =>  esc_html__('icon icon-office-19', 'ventcamp')),
	array('icon icon-office-20' =>  esc_html__('icon icon-office-20', 'ventcamp')),
	array('icon icon-office-21' =>  esc_html__('icon icon-office-21', 'ventcamp')),
	array('icon icon-office-22' =>  esc_html__('icon icon-office-22', 'ventcamp')),
	array('icon icon-office-23' =>  esc_html__('icon icon-office-23', 'ventcamp')),
	array('icon icon-office-24' =>  esc_html__('icon icon-office-24', 'ventcamp')),
	array('icon icon-office-25' =>  esc_html__('icon icon-office-25', 'ventcamp')),
	array('icon icon-office-26' =>  esc_html__('icon icon-office-26', 'ventcamp')),
	array('icon icon-office-27' =>  esc_html__('icon icon-office-27', 'ventcamp')),
	array('icon icon-office-28' =>  esc_html__('icon icon-office-28', 'ventcamp')),
	array('icon icon-office-29' =>  esc_html__('icon icon-office-29', 'ventcamp')),
	array('icon icon-office-30' =>  esc_html__('icon icon-office-30', 'ventcamp')),
	array('icon icon-office-31' =>  esc_html__('icon icon-office-31', 'ventcamp')),
	array('icon icon-office-32' =>  esc_html__('icon icon-office-32', 'ventcamp')),
	array('icon icon-office-33' =>  esc_html__('icon icon-office-33', 'ventcamp')),
	array('icon icon-office-34' =>  esc_html__('icon icon-office-34', 'ventcamp')),
	array('icon icon-office-35' =>  esc_html__('icon icon-office-35', 'ventcamp')),
	array('icon icon-office-36' =>  esc_html__('icon icon-office-36', 'ventcamp')),
	array('icon icon-office-37' =>  esc_html__('icon icon-office-37', 'ventcamp')),
	array('icon icon-office-38' =>  esc_html__('icon icon-office-38', 'ventcamp')),
	array('icon icon-office-39' =>  esc_html__('icon icon-office-39', 'ventcamp')),
	array('icon icon-office-40' =>  esc_html__('icon icon-office-40', 'ventcamp')),
	array('icon icon-office-41' =>  esc_html__('icon icon-office-41', 'ventcamp')),
	array('icon icon-office-42' =>  esc_html__('icon icon-office-42', 'ventcamp')),
	array('icon icon-office-43' =>  esc_html__('icon icon-office-43', 'ventcamp')),
	array('icon icon-office-44' =>  esc_html__('icon icon-office-44', 'ventcamp')),
	array('icon icon-office-45' =>  esc_html__('icon icon-office-45', 'ventcamp')),
	array('icon icon-office-46' =>  esc_html__('icon icon-office-46', 'ventcamp')),
	array('icon icon-office-47' =>  esc_html__('icon icon-office-47', 'ventcamp')),
	array('icon icon-office-48' =>  esc_html__('icon icon-office-48', 'ventcamp')),
	array('icon icon-office-49' =>  esc_html__('icon icon-office-49', 'ventcamp')),
	array('icon icon-office-50' =>  esc_html__('icon icon-office-50', 'ventcamp')),
	array('icon icon-office-51' =>  esc_html__('icon icon-office-51', 'ventcamp')),
	array('icon icon-office-52' =>  esc_html__('icon icon-office-52', 'ventcamp')),
	array('icon icon-office-53' =>  esc_html__('icon icon-office-53', 'ventcamp')),
	array('icon icon-office-54' =>  esc_html__('icon icon-office-54', 'ventcamp')),
	array('icon icon-office-55' =>  esc_html__('icon icon-office-55', 'ventcamp')),
	array('icon icon-office-56' =>  esc_html__('icon icon-office-56', 'ventcamp')),
	array('icon icon-office-57' =>  esc_html__('icon icon-office-57', 'ventcamp')),
	array('icon icon-office-58' =>  esc_html__('icon icon-office-58', 'ventcamp')),
	array('icon icon-office-59' =>  esc_html__('icon icon-office-59', 'ventcamp')),
	array('icon icon-office-60' =>  esc_html__('icon icon-office-60', 'ventcamp')),
	array('icon icon-office-61' =>  esc_html__('icon icon-office-61', 'ventcamp')),
	array('icon icon-party-01' =>  esc_html__('icon icon-party-01', 'ventcamp')),
	array('icon icon-party-02' =>  esc_html__('icon icon-party-02', 'ventcamp')),
	array('icon icon-party-03' =>  esc_html__('icon icon-party-03', 'ventcamp')),
	array('icon icon-party-04' =>  esc_html__('icon icon-party-04', 'ventcamp')),
	array('icon icon-party-05' =>  esc_html__('icon icon-party-05', 'ventcamp')),
	array('icon icon-party-06' =>  esc_html__('icon icon-party-06', 'ventcamp')),
	array('icon icon-party-07' =>  esc_html__('icon icon-party-07', 'ventcamp')),
	array('icon icon-party-08' =>  esc_html__('icon icon-party-08', 'ventcamp')),
	array('icon icon-party-09' =>  esc_html__('icon icon-party-09', 'ventcamp')),
	array('icon icon-party-10' =>  esc_html__('icon icon-party-10', 'ventcamp')),
	array('icon icon-party-11' =>  esc_html__('icon icon-party-11', 'ventcamp')),
	array('icon icon-realestate-living-01' =>  esc_html__('icon icon-realestate-living-01', 'ventcamp')),
	array('icon icon-realestate-living-02' =>  esc_html__('icon icon-realestate-living-02', 'ventcamp')),
	array('icon icon-realestate-living-03' =>  esc_html__('icon icon-realestate-living-03', 'ventcamp')),
	array('icon icon-realestate-living-04' =>  esc_html__('icon icon-realestate-living-04', 'ventcamp')),
	array('icon icon-realestate-living-05' =>  esc_html__('icon icon-realestate-living-05', 'ventcamp')),
	array('icon icon-realestate-living-06' =>  esc_html__('icon icon-realestate-living-06', 'ventcamp')),
	array('icon icon-realestate-living-07' =>  esc_html__('icon icon-realestate-living-07', 'ventcamp')),
	array('icon icon-realestate-living-08' =>  esc_html__('icon icon-realestate-living-08', 'ventcamp')),
	array('icon icon-realestate-living-09' =>  esc_html__('icon icon-realestate-living-09', 'ventcamp')),
	array('icon icon-realestate-living-10' =>  esc_html__('icon icon-realestate-living-10', 'ventcamp')),
	array('icon icon-realestate-living-11' =>  esc_html__('icon icon-realestate-living-11', 'ventcamp')),
	array('icon icon-realestate-living-12' =>  esc_html__('icon icon-realestate-living-12', 'ventcamp')),
	array('icon icon-realestate-living-13' =>  esc_html__('icon icon-realestate-living-13', 'ventcamp')),
	array('icon icon-realestate-living-14' =>  esc_html__('icon icon-realestate-living-14', 'ventcamp')),
	array('icon icon-realestate-living-15' =>  esc_html__('icon icon-realestate-living-15', 'ventcamp')),
	array('icon icon-realestate-living-16' =>  esc_html__('icon icon-realestate-living-16', 'ventcamp')),
	array('icon icon-seo-icons-01' =>  esc_html__('icon icon-seo-icons-01', 'ventcamp')),
	array('icon icon-seo-icons-02' =>  esc_html__('icon icon-seo-icons-02', 'ventcamp')),
	array('icon icon-seo-icons-03' =>  esc_html__('icon icon-seo-icons-03', 'ventcamp')),
	array('icon icon-seo-icons-04' =>  esc_html__('icon icon-seo-icons-04', 'ventcamp')),
	array('icon icon-seo-icons-05' =>  esc_html__('icon icon-seo-icons-05', 'ventcamp')),
	array('icon icon-seo-icons-06' =>  esc_html__('icon icon-seo-icons-06', 'ventcamp')),
	array('icon icon-seo-icons-07' =>  esc_html__('icon icon-seo-icons-07', 'ventcamp')),
	array('icon icon-seo-icons-08' =>  esc_html__('icon icon-seo-icons-08', 'ventcamp')),
	array('icon icon-seo-icons-09' =>  esc_html__('icon icon-seo-icons-09', 'ventcamp')),
	array('icon icon-seo-icons-10' =>  esc_html__('icon icon-seo-icons-10', 'ventcamp')),
	array('icon icon-seo-icons-11' =>  esc_html__('icon icon-seo-icons-11', 'ventcamp')),
	array('icon icon-seo-icons-12' =>  esc_html__('icon icon-seo-icons-12', 'ventcamp')),
	array('icon icon-seo-icons-13' =>  esc_html__('icon icon-seo-icons-13', 'ventcamp')),
	array('icon icon-seo-icons-14' =>  esc_html__('icon icon-seo-icons-14', 'ventcamp')),
	array('icon icon-seo-icons-15' =>  esc_html__('icon icon-seo-icons-15', 'ventcamp')),
	array('icon icon-seo-icons-16' =>  esc_html__('icon icon-seo-icons-16', 'ventcamp')),
	array('icon icon-seo-icons-17' =>  esc_html__('icon icon-seo-icons-17', 'ventcamp')),
	array('icon icon-seo-icons-18' =>  esc_html__('icon icon-seo-icons-18', 'ventcamp')),
	array('icon icon-seo-icons-19' =>  esc_html__('icon icon-seo-icons-19', 'ventcamp')),
	array('icon icon-seo-icons-20' =>  esc_html__('icon icon-seo-icons-20', 'ventcamp')),
	array('icon icon-seo-icons-21' =>  esc_html__('icon icon-seo-icons-21', 'ventcamp')),
	array('icon icon-seo-icons-22' =>  esc_html__('icon icon-seo-icons-22', 'ventcamp')),
	array('icon icon-seo-icons-23' =>  esc_html__('icon icon-seo-icons-23', 'ventcamp')),
	array('icon icon-seo-icons-24' =>  esc_html__('icon icon-seo-icons-24', 'ventcamp')),
	array('icon icon-seo-icons-25' =>  esc_html__('icon icon-seo-icons-25', 'ventcamp')),
	array('icon icon-seo-icons-26' =>  esc_html__('icon icon-seo-icons-26', 'ventcamp')),
	array('icon icon-seo-icons-27' =>  esc_html__('icon icon-seo-icons-27', 'ventcamp')),
	array('icon icon-seo-icons-28' =>  esc_html__('icon icon-seo-icons-28', 'ventcamp')),
	array('icon icon-seo-icons-29' =>  esc_html__('icon icon-seo-icons-29', 'ventcamp')),
	array('icon icon-seo-icons-30' =>  esc_html__('icon icon-seo-icons-30', 'ventcamp')),
	array('icon icon-seo-icons-31' =>  esc_html__('icon icon-seo-icons-31', 'ventcamp')),
	array('icon icon-seo-icons-32' =>  esc_html__('icon icon-seo-icons-32', 'ventcamp')),
	array('icon icon-seo-icons-33' =>  esc_html__('icon icon-seo-icons-33', 'ventcamp')),
	array('icon icon-seo-icons-34' =>  esc_html__('icon icon-seo-icons-34', 'ventcamp')),
	array('icon icon-seo-icons-35' =>  esc_html__('icon icon-seo-icons-35', 'ventcamp')),
	array('icon icon-seo-icons-36' =>  esc_html__('icon icon-seo-icons-36', 'ventcamp')),
	array('icon icon-seo-icons-37' =>  esc_html__('icon icon-seo-icons-37', 'ventcamp')),
	array('icon icon-seo-icons-38' =>  esc_html__('icon icon-seo-icons-38', 'ventcamp')),
	array('icon icon-seo-icons-39' =>  esc_html__('icon icon-seo-icons-39', 'ventcamp')),
	array('icon icon-seo-icons-40' =>  esc_html__('icon icon-seo-icons-40', 'ventcamp')),
	array('icon icon-seo-icons-41' =>  esc_html__('icon icon-seo-icons-41', 'ventcamp')),
	array('icon icon-seo-icons-42' =>  esc_html__('icon icon-seo-icons-42', 'ventcamp')),
	array('icon icon-shopping-01' =>  esc_html__('icon icon-shopping-01', 'ventcamp')),
	array('icon icon-shopping-02' =>  esc_html__('icon icon-shopping-02', 'ventcamp')),
	array('icon icon-shopping-03' =>  esc_html__('icon icon-shopping-03', 'ventcamp')),
	array('icon icon-shopping-04' =>  esc_html__('icon icon-shopping-04', 'ventcamp')),
	array('icon icon-shopping-05' =>  esc_html__('icon icon-shopping-05', 'ventcamp')),
	array('icon icon-shopping-06' =>  esc_html__('icon icon-shopping-06', 'ventcamp')),
	array('icon icon-shopping-07' =>  esc_html__('icon icon-shopping-07', 'ventcamp')),
	array('icon icon-shopping-08' =>  esc_html__('icon icon-shopping-08', 'ventcamp')),
	array('icon icon-shopping-09' =>  esc_html__('icon icon-shopping-09', 'ventcamp')),
	array('icon icon-shopping-10' =>  esc_html__('icon icon-shopping-10', 'ventcamp')),
	array('icon icon-shopping-11' =>  esc_html__('icon icon-shopping-11', 'ventcamp')),
	array('icon icon-shopping-12' =>  esc_html__('icon icon-shopping-12', 'ventcamp')),
	array('icon icon-shopping-13' =>  esc_html__('icon icon-shopping-13', 'ventcamp')),
	array('icon icon-shopping-14' =>  esc_html__('icon icon-shopping-14', 'ventcamp'))
		);
		return $lineicons_icons;
	}
}
add_filter( 'vc_iconpicker-type-lineicons', 'ventcamp_icons_lineicons');




