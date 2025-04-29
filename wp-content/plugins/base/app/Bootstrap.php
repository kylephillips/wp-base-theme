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
		$plugin_directory = plugins_url() . '/' . basename(dirname(dirname(__FILE__)));
		define('THEME_PLUGIN_DIRECTORY', $plugin_directory);
		define('THEME_COLOR_SCHEME', __('Theme Colors'));
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
		new Activation\GoogleFonts('//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap'); // Set to null if not using Google Fonts
		new Activation\CloudTypography(null); // example: //cloud.typography.com/id/od/css/fonts.css
		new Blocks\RegisterBlocks;
		new AdminDisplay\Login;
		new AdminDisplay\Yoast;
		new Display\Display;
		new Display\ImageSizes;
		new AdminDisplay\Dashboard;
		new Activation\Dependencies;
		new AdminDisplay\AdvancedCustomFields;
		new User\ProfileSettings;
		new BlockEditor\InlineFormats;
		new BlockEditor\MobileCoverImage;
	}
}