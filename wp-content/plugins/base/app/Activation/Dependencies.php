<?php 
namespace Base\Activation;

class Dependencies 
{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', [$this, 'jquery']);
		add_action( 'wp_enqueue_scripts', [$this, 'scripts']);
		add_action( 'wp_enqueue_scripts', [$this, 'styles']);
		add_action( 'admin_enqueue_scripts', [$this, 'adminStyles']);
		add_action( 'admin_init', [$this, 'colorScheme']);
		add_action( 'wp_head', [$this, 'headScripts']);
		add_action( 'wp_footer', [$this, 'footerScripts']);
		add_action( 'wp_body_opening', [$this, 'bodyScripts']);
	}

	/**
	* Deregister the default jQuery and grab copy from Google CDN
	*/
	public function jquery()
	{
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false);
		wp_enqueue_script('jquery');
	}

	/**
	* Theme Scripts – enqueue any unminified scripts needed here
	*/
	public function scripts()
	{
		wp_enqueue_script(
			'scripts',
			get_template_directory_uri() . '/assets/js/scripts.min.js',
			array(),
			THEME_VERSION,
			true
		);
	}

	/**
	* Theme Styles – enqueue any unminified styles needed here
	*/
	public function styles()
	{
		wp_enqueue_style(
			'theme-styles',
			get_stylesheet_uri(),
			array(),
			THEME_VERSION
		);
	}

	/**
	* Custom Admin Styles
	*/
	public function adminStyles()
	{
		global $base_plugin_directory;
		wp_enqueue_style(
			'custom-admin',
			$base_plugin_directory . '/assets/css/admin_style.css'
		);
	}

	/**
	* Custom Admin Color Scheme
	*/
	public function colorScheme()
	{
		global $color_scheme;
		global $base_plugin_directory;
		wp_admin_css_color(
		    'custom-scheme', $color_scheme,
		   	$base_plugin_directory . '/assets/css/colors.css',
		    [ '#000000', '#e72234', '#ebecec', '#456a7f' ]
		);
	}

	/**
	* Head Scripts
	*/
	public function headScripts()
	{
		if ( !function_exists('get_field') ) return;
		$scripts = get_field('head_scripts', 'option');
		if ( $scripts ) echo $scripts;
	}

	/**
	* Footer Scripts
	*/
	public function footerScripts()
	{
		if ( !function_exists('get_field') ) return;
		$scripts = get_field('footer_scripts', 'option');
		if ( $scripts ) echo $scripts;
	}

	/**
	* Body Scripts
	*/
	public function bodyScripts()
	{
		if ( !function_exists('get_field') ) return;
		$scripts = get_field('body_scripts', 'option');
		if ( $scripts ) echo $scripts;
	}
}