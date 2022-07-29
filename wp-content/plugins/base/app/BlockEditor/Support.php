<?php
namespace Base\BlockEditor;

/**
* Adds Gutenberg Support
*/
class Support
{
	public function __construct()
	{
		add_action('enqueue_block_editor_assets', [$this, 'editorStyles']);
		add_theme_support('align-wide');
		add_action('enqueue_block_editor_assets', [$this, 'editorScripts']);
	}

	/**
	* Add the editor styles
	*/
	public function editorStyles()
	{
		$deps = [];
		if ( THEME_GOOGLE_FONTS ) $deps[] = 'theme-google-fonts';
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
}