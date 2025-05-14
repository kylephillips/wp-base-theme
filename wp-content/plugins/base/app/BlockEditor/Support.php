<?php
namespace Base\BlockEditor;

/**
* Adds Block Editor Support
*/
class Support
{
	public function __construct()
	{
		add_action('enqueue_block_editor_assets', [$this, 'editorStyles']);
		add_theme_support('align-wide');
		add_action('enqueue_block_editor_assets', [$this, 'editorScripts']);
		add_action('enqueue_block_editor_assets', [$this, 'responsiveCoverBlock']);
	}

	/**
	* Add the editor styles
	*/
	public function editorStyles()
	{
		$deps = [];
		if ( THEME_GOOGLE_FONTS ) $deps[] = 'theme-google-fonts';
		if ( THEME_CLOUD_TYPOGRAPHY ) $deps[] = 'theme-cloud-typography';
		 wp_enqueue_style(
		 	'block-editor-styles', 
		 	get_theme_file_uri( '/block-editor.css' ), 
		 	$deps, 
		 	THEME_VERSION, 
		 	'all'
		 );
	}

	/**
	* Add the editor scripts for customizing the block editor
	*/
	public function editorScripts()
	{
		wp_enqueue_script(
			'theme-block-editor',
			THEME_PLUGIN_DIRECTORY . '/assets/js/block-editor.js',
			['wp-blocks']
		);
		wp_enqueue_script(
			'theme-block-editor-styles',
			THEME_PLUGIN_DIRECTORY . '/assets/js/block-editor-css-classes.js',
			['wp-blocks']
		);
		wp_localize_script(
			'theme-block-editor-styles',
			'editor_formats',
			[
				'config_url' => get_template_directory_uri() . '/config.json'
			]
		);
	}

	/**
	* Add the mobile cover image
	*/
	public function responsiveCoverBlock()
	{
		wp_enqueue_script(
			'responsive-cover-block',
			THEME_PLUGIN_DIRECTORY . '/assets/js/block-editor-responsive-cover.js',
			['wp-blocks',  'wp-dom']
		);
	}
}