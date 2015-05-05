<?php namespace Base;

class Dependencies {


	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array($this, 'jquery'));
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'));
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

}