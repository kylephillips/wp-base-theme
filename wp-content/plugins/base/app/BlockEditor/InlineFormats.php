<?php
namespace Base\BlockEditor;

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
	    wp_register_script(
	        'block-editor-inline-formats',
	        THEME_PLUGIN_DIRECTORY . '/assets/js/block-editor-inline-formats.js',
	        ['wp-rich-text', 'wp-element', 'wp-editor']
	    );
	}

	public function enqueueAssets()
	{
		wp_enqueue_script('block-editor-inline-formats');
	}
}