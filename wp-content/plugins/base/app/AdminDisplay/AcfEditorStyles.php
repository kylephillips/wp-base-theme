<?php
namespace Base\AdminDisplay;

/**
* Adds the field name as a body class inside a wysiwyg ACF field
*/
class AcfEditorStyles
{
	public function __construct()
	{
		add_action('admin_enqueue_scripts', [$this, 'addStyles']);
	}

	public function addStyles()
	{
		global $base_plugin_directory;
		wp_enqueue_script(
			'acf-wysiwyg-styles',
			$base_plugin_directory . '/assets/js/acf-wysiwyg.js'
		);
	}
}