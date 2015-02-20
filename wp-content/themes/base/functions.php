<?php
/**
* Theme Functions
* See theme plugin for additional functionality
*/

/**
* Theme Support & Editor Styles
*/
add_editor_style('editor-styles.css');

/**
* Image Sizes
*/
add_theme_support( 'post-thumbnails' );
//add_image_size( 'image-size', 100, 100, true );

/**
* Nav Menus
*/
register_nav_menus(array(
	'main_nav' => 'Main Nav',
));

/**
* Register ACF Options Page
*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'Site Options',
		'menu_title' => 'Options'
	));
}

/**
* Allow SVG Uploads
* @link http://css-tricks.com/snippets/wordpress/allow-svg-through-wordpress-media-uploader/
*/
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
?>