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
		add_action('wp_print_styles', [$this, 'removeFrontEndStyles']);
		add_theme_support('align-wide');
		$this->addColorChoices();
		add_action('enqueue_block_editor_assets', [$this, 'editorScripts']);
	}

	/**
	* Add the editor styles for Gutenberg
	*/
	public function editorStyles()
	{
		 wp_enqueue_style(
		 	'gutenstyles', 
		 	get_theme_file_uri( '/gutenberg.css' ), 
		 	[], 
		 	THEME_VERSION, 
		 	'all'
		 );
	}

	/**
	* Add the editor scripts for customizing Gutenberg
	*/
	public function editorScripts()
	{
		global $base_plugin_directory;
		wp_enqueue_script(
			'theme-block-editor',
			$base_plugin_directory . '/assets/js/block-editor.js',
			['wp-blocks']
		);
		wp_enqueue_script(
			'theme-block-editor-styles',
			$base_plugin_directory . '/assets/js/block-editor-css-classes.js',
			['wp-blocks']
		);
		wp_localize_script(
			'theme-block-editor-styles',
			'editor_formats',
			[
				'config_url' => get_bloginfo('url') . '/config.json'
			]
		);
	}

	/**
	* Remove the front-end styles injected by Gutenberg. We'll handle these in our theme styles
	*/
	public function removeFrontEndStyles()
	{
		wp_dequeue_style('wp-core-blocks');
	}

	/**
	* Add the theme colors, disable the custom color selector
	*/
	public function addColorChoices()
	{
		add_theme_support('editor-color-palette', THEME_COLORS);
	}
}