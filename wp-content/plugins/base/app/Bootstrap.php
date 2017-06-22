<?php 
namespace Base;

/**
* Primary Plugin class
*/
class Bootstrap 
{
	function __construct()
	{
		$this->defineGlobals();
		add_action('init', array($this, 'wordpressInit'));
		$this->pluginInit();
	}

	/**
	* Define Globals
	*/
	public function defineGlobals()
	{
		global $base_plugin_directory;
		$base_plugin_directory = plugins_url() . '/' . basename(dirname(dirname(__FILE__)));
		global $color_scheme;
		$color_scheme = __('Color Scheme Name');
		global $plugin_short_name;
		$plugin_short_name = __('base-plugin');
	}

	/**
	* Initialize the Plugin
	*/
	public function wordpressInit()
	{
		$post_types = new WPData\PostTypes;
		$taxonomies = new WPData\Taxonomies;
		$tinymce = new AdminDisplay\TinyMce;
		$typekit = new Activation\Typekit(null); // Add Kit ID to enable typekit in the visual editor/TinyMCE
	}

	/**
	* General Theme Functions
	*/
	public function pluginInit()
	{
		new AdminDisplay\Login;
		new AdminDisplay\Yoast;
		new Display\Display;
		new AdminDisplay\Dashboard;
		new Activation\Dependencies;
	}
}