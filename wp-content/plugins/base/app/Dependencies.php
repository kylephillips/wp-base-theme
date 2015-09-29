<?php 

namespace Base;

class Dependencies 
{

	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array($this, 'jquery'));
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'));
		add_action( 'admin_enqueue_scripts', array($this, 'adminStyles'));
		add_action( 'admin_init', array($this, 'colorScheme'));
	}

	/**
	* Deregister the default jQuery and grab copy from Google CDN
	*/
	public function jquery()
	{
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false);
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
			'1.0',
			true
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
		    array( '#000000', '#e72234', '#ebecec', '#456a7f' )
		);
	}

}