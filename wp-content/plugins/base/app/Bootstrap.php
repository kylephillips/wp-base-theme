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
		add_action('init', [$this, 'wordpressInit']);
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
		$color_scheme = __('Theme Colors');
		$colors = (new Display\Config)->getColors();
		define('THEME_COLORS', $colors);
	}

	/**
	* Initialize the Plugin
	*/
	public function wordpressInit()
	{
		new WPData\PostTypes;
		new WPData\Taxonomies;
		new AdminDisplay\TinyMce;
		new BlockEditor\Support;
		new Display\Emojis;
		new Activation\Typekit(null); // Add Kit ID to enable typekit in the visual editor/TinyMCE
	}

	/**
	* General Theme Functions
	*/
	public function pluginInit()
	{
		new Blocks\AcfBlocks;
		new AdminDisplay\Login;
		new AdminDisplay\Yoast;
		new Display\Display;
		new Display\ImageSizes;
		new AdminDisplay\Dashboard;
		new Activation\Dependencies;
		new AdminDisplay\AdvancedCustomFields;
		new User\ProfileSettings;
		new BlockEditor\InlineFormats;
	}
}