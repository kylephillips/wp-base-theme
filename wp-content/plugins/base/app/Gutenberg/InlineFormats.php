<?php
namespace Base\Gutenberg;

/**
* Adds custom inline formats to the block editor
*/
class InlineFormats
{
	public function __construct()
	{
		add_action('init', [$this, 'registerScripts']);
		add_action('enqueue_block_editor_assets', [$this, 'enqueueAssets']);
	}

	public function registerScripts()
	{
		global $base_plugin_directory;
	    wp_register_script(
	        'block-editor-inline-formats',
	        $base_plugin_directory . '/assets/js/block-editor-inline-formats.js',
	        ['wp-rich-text', 'wp-element', 'wp-editor']
	    );
	}

	public function enqueueAssets()
	{
		wp_enqueue_script('block-editor-inline-formats');
	}
}