<?php
defined('ABSPATH') or die('No direct access');

$ventcamp_menu_data = array(  // rearrange this menu to new order

	array(
		'slug' => 'index.php', // Dashboard
	),
	array(
		'slug' => 'edit.php', // Posts
	),
	array(
		'slug' => 'upload.php', // Media
	),
	array(
		'slug' => 'edit.php?post_type=page', // Pages
	),
	array(
		'slug' => 'edit-comments.php', // Comments
	),
	array(
		'slug' => 'themes.php', // Appearance
	),
	array(
		'slug' => 'plugins.php', // Plugins
	),
	array(
		'slug' => 'users.php', // Users
	),

	// separator
	array(
		'slug' => 'separator2', // Second separator
	),
	// separator


	array(
		'slug' => 'tools.php', // Tools
	),
	array(
		'slug' => 'options-general.php', // Settings
	),
		// separator
	array(
		'slug' => 'separator1', // First separator
	),
	// separator

	array(
		'slug' => 'envato-wordpress-toolkit', // Evanto Toolkit
		'parent_slug' => 'options-framework'
	),

	array(
		'slug' => 'wpcf7', // Contact Form 7
		'name' =>  esc_html__('Forms', 'ventcamp')
	),
	array(
		'icon_url' => 'dashicons-admin-generic',
		'slug' => 'CF7DBPluginSubmissions',
		'name' => esc_html__('Forms Data', 'ventcamp')
	),

	// separator

	array(
		'slug' => 'separator-last', // Last separator
	),
);

function ventcamp_rename_dashboard_menu() {
	global $menu;
	global $ventcamp_menu_data;
	foreach ($ventcamp_menu_data as $item) {
		if( !empty($item['name'])) {
			foreach ($menu as $key => $value) { // $value = array ('menu title', 'capabilites', 'slug', 'page title', 'menu class', 'callback?', 'menu icon')
				if ( $value[2] == $item['slug'] ) {
					$menu[$key][0] = $item['name'];// menu title
					$menu[$key][3] = $item['name'];// page title
				}
			}
		}
	}
}
add_action( 'admin_menu', 'ventcamp_rename_dashboard_menu' );

//array function
if( ! function_exists( 'array_column' )) { // fallback for php < 5.5
	function array_column($array, $column) {
		$ret = array();
		foreach ($array as $row) {
			$ret[] = $row[$column];
		}
		return $ret;
	}
}



?>
