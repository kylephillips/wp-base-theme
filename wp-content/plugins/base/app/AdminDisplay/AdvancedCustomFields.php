<?php
namespace Base\AdminDisplay;

class AdvancedCustomFields
{
	public function __construct()
	{
		add_action('admin_enqueue_scripts', [$this, 'addStyles']);
		add_action('acf/input/admin_enqueue_scripts', [$this, 'addScripts']);
	}

	/**
	* Adds the field name as a body class inside a wysiwyg ACF field
	*/
	public function addStyles()
	{
		wp_enqueue_script(
			'acf-wysiwyg-styles',
			THEME_PLUGIN_DIRECTORY . '/assets/js/acf-wysiwyg-editor.js'
		);
	}

	/**
	* Admin Advanced Custom Fields scripts
	*/
	public function addScripts()
	{
		wp_enqueue_script(
			'theme-acf-scripts',
			THEME_PLUGIN_DIRECTORY . '/assets/js/acf-color-palette.js'
		);
		$colors = THEME_COLORS;
		$localized_data = [
			'colors' => $colors
		];
		wp_localize_script(
			'theme-acf-scripts', 
			'theme_acf', 
			$localized_data
		);
	}
}