<?php 
namespace Base\Activation;

/**
* Enables Typekit in Visual Editor
*/
class Typekit 
{
	/**
	* Kit ID
	*/
	private $kit_id;

	public function __construct($kit_id = null)
	{
		$this->kit_id = $kit_id;
		if ( !$kit_id ) return;
		add_filter('mce_external_plugins', [$this, 'addTypekit']);
		add_action('admin_head', [$this, 'adminHeadGlobals']);
		add_action('wp_enqueue_scripts', [$this, 'publicStyles']);
	}

	/**
	* Add Typekit TinyMCE plugin
	*/
	public function addTypekit($plugins)
	{
		global $base_plugin_directory;
		$plugins['typekit'] = $base_plugin_directory . '/assets/js/typekit.js';
		return $plugins;
	}

	/**
	* Admin Head Script Globals
	*/
	public function adminHeadGlobals()
	{
		if ( !$this->kit_id ) return;
		echo '<script>var typekit_id = "' . $this->kit_id . '";</script>';
	}

	/**
	* Enqueue the Front End Style
	*/
	public function publicStyles()
	{
		wp_enqueue_style(
			'typekit',
			'https://use.typekit.net/' . $this->kit_id . '.css',
			[],
			'',
			'all'
		);
	}
}