<?php
/**
* Theme Functions
* See theme plugin for additional functionality
*/
define('THEME_VERSION', '1.0');

/**
* Adds Editor Styles
*/
add_editor_style('editor-styles.css');

/**
* Registers Image Sizes
*/
add_theme_support( 'post-thumbnails' );
//add_image_size( 'image-size', 100, 100, true );

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