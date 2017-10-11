<?php 
namespace Base\AdminDisplay;

class Login 
{
	public function __construct()
	{
		add_action('login_enqueue_scripts', [$this, 'styleLogin'], 10);
	}

	/**
	* Style the Login Page
	*/
	public function styleLogin()
	{
        global $base_plugin_directory;
        wp_enqueue_style(
            'custom-login',
            $base_plugin_directory . '/assets/css/login.css',
            false
        );
	}
}