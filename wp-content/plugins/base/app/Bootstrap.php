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
		$post_types = new PostTypes;
		$taxonomies = new Taxonomies;
		$tinymce = new TinyMce;
		$typekit = new Typekit(null); // Add Kit ID to enable typekit in the visual editor/TinyMCE
	}

	/**
	* General Theme Functions
	*/
	public function pluginInit()
	{
		new Login;
		new Functions;
		new Dashboard;
		new Dependencies;
	}
}