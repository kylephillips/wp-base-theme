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

/**
 * Begin required plugins
 */
 
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'mytheme_require_plugins' );
 
function mytheme_require_plugins() {
 
    $plugins = array(
		   // Commenting out these two since they require license keys
		    /*array(
		        'name'               => 'Advanced Custom Fields Pro',
		        'slug'               => 'advanced-custom-fields-pro',
		        'source'             => get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields-pro.zip', // The "internal" source of the plugin
		        'required'           => true, // this plugin is required
		        'external_url'       => 'https://wordpress.org/plugins/advanced-custom-fields/', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    ),
		    array(
		        'name'               => 'Gravity Forms',
		        'slug'               => 'gravity-forms',
		        'source'             => get_stylesheet_directory() . '/lib/plugins/gravityforms_1.9.15.18.zip', // The "internal" source of the plugin
		        'required'           => true, // this plugin is required
		        'external_url'       => 'http://www.gravityforms.com//', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    ),*/
		    array(
		        'name'               => 'Nested Pages',
		        'slug'               => 'wp-nested-pages',
		        'source'             => 'http://downloads.wordpress.org/plugin/wp-nested-pages.1.5.4.zip',
		        'required'           => true, // this plugin is required
		        'external_url'       => 'https://wordpress.org/plugins/wp-nested-pages/', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    ),
		    array(
		        'name'               => 'Google Analytics',
		        'slug'               => 'googleanalytics',
		        'source'             => 'http://downloads.wordpress.org/plugin/googleanalytics.zip',
		        'required'           => true, // this plugin is required
		        'external_url'       => 'https://wordpress.org/plugins/googleanalytics/', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    ),
		    array(
		        'name'               => 'Post Thumbnail Editor',
		        'slug'               => 'post-thumbnail-editor',
		        'source'             => 'http://downloads.wordpress.org/plugin/post-thumbnail-editor.zip',
		        'required'           => true, // this plugin is required
		        'external_url'       => 'https://wordpress.org/plugins/post-thumbnail-editor/', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    ),
		    array(
		        'name'               => 'Yoast SEO',
		        'slug'               => 'wordpress-seo',
		        'source'             => 'http://downloads.wordpress.org/plugin/wordpress-seo.3.0.7.zip',
		        'required'           => true, // this plugin is required
		        'external_url'       => 'https://wordpress.org/plugins/wordpress-seo/', // page of my plugin
		        'force_deactivation' => false, // deactivate this plugin when the user switches to another theme
		    )
		);
    $config = array(
        'id'           => 'tgmpa', // your unique TGMPA ID
        'default_path' => '', // default absolute path
        'menu'         => 'tgmpa-install-required-plugins', // menu slug
        'has_notices'  => true, // Show admin notices
        'dismissable'  => false, // the notices are NOT dismissable
        'dismiss_msg'  => 'Please install these recommended plugins', // this message will be output at top of nag
        'is_automatic' => true, // automatically activate plugins after installation
        'message'      => '<!--Hey there.-->'// message to output right before the plugins table
    );
 
    tgmpa( $plugins, $config );
 
}
?>