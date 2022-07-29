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
        wp_enqueue_style(
            'custom-login',
            THEME_PLUGIN_DIRECTORY . '/assets/css/login.css',
            false
        );
	}
}