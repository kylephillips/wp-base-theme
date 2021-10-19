<?php
/**
* Theme Functions
* See theme plugin for additional functionality
*
* Image sizes defined in site config.json, output in Display\ImageSizes
* Theme colors defined in site config.json
*/
define('THEME_VERSION', '1.0');

/**
* Adds Editor Styles
*/
add_editor_style('editor-styles.css');

/**
* Registers Nav Menus
*/
register_nav_menus([
	'main_nav' => 'Main Nav',
]);

/**
* Register ACF Options Page
*/
if( function_exists('acf_add_options_page') ){
	acf_add_options_page([
		'page_title' => 'Site Options',
		'menu_title' => 'Options'
	]);
}