<?php
namespace Base\Gutenberg;

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
		// $this->addColorChoices();
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
			'theme-gutenberg',
			$base_plugin_directory . '/assets/js/gutenberg.js',
			['wp-blocks']
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
		add_theme_support('disable-custom-colors');
		add_theme_support('editor-color-palette',
			[
		        'name' => 'Blue',
		        'color' => '#082a68',
		    ],[
		        'name' => 'Red',
		        'color' => '#c4133b',
		    ],[
		        'name' => 'Green',
		        'color' => '#5cb85c',
		    ],[
		        'name' => 'Black',
		        'color' => '#444444',
		    ]
		);
	}
}