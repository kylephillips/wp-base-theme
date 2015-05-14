<?php namespace Base;

use Base\TinyMce;
use Base\PostTypes;
use Base\Taxonomies;
use Base\Dashboard;
use Base\Functions;
use Base\Dependencies;
use Base\Login;
use Base\Typekit;

/**
* Primary Plugin class
*/
class Bootstrap {

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