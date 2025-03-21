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
		add_action( 'after_setup_theme', [$this, 'htmlVersion']);
	}

	/**
	* Deregister the default jQuery and grab copy from Google CDN
	*/
	public function jquery()
	{
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"), false);
		wp_enqueue_script('jquery');
	}
	
	/**
	* Add HTML 5 support
	* Removes script type="text/javascript"
	*/
	public function htmlVersion()
	{
		 add_theme_support( 'html5', [ 'script', 'style' ] );
	}

	/**
	* Theme Scripts – enqueue any unminified scripts needed here
	*/
	public function scripts()
	{
		wp_enqueue_script(
			'scripts',
			get_template_directory_uri() . '/assets/js/scripts.min.js',
			[],
			THEME_VERSION,
			true
		);
	}

	/**
	* Theme Styles – enqueue any unminified styles needed here
	*/
	public function styles()
	{
		$deps = [];
		if ( THEME_GOOGLE_FONTS ) $deps[] = 'theme-google-fonts';
		wp_enqueue_style(
			'theme-styles',
			get_stylesheet_uri(),
			$deps,
			THEME_VERSION
		);
	}

	/**
	* Custom Admin Styles
	*/
	public function adminStyles()
	{
		$deps = [];
		if ( THEME_GOOGLE_FONTS ) $deps[] = 'theme-google-fonts';
		wp_enqueue_style(
			'custom-admin',
			THEME_PLUGIN_DIRECTORY . '/assets/css/admin_style.css',
			$deps
		);
	}

	/**
	* Custom Admin Color Scheme
	*/
	public function colorScheme()
	{	
		wp_admin_css_color(
		    'custom-scheme', THEME_COLOR_SCHEME,
		   	THEME_PLUGIN_DIRECTORY . '/assets/css/colors.css',
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
		if ( function_exists('get_field') ) :
			$scripts = get_field('footer_scripts', 'option');
			if ( $scripts ) echo $scripts;
		endif; 

		// Dev - Livereload
		if ( str_contains($_SERVER['SERVER_NAME'], '.test') ) :
			wp_enqueue_script(
				'livereload',
				get_template_directory_uri() . '/node_modules/livereload-js/dist/livereload.js?snipver=1',
				[],
				THEME_VERSION,
				true
			);
		endif;
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