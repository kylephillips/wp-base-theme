<?php 

namespace Base;

class Login 
{

	public function __construct()
	{
		add_action('login_enqueue_scripts', array($this, 'styleLogin'));
	}

	/**
	* Style the Login Page
	*/
	public function styleLogin()
	{
		$styles = '
		<style type="text/css">
		body.login {
			background-color: #fcf9f6;
		}
        /**
        body.login div#login h1 a {
            background-image: url(' . get_stylesheet_directory_uri() . '/assets/images/logo.svg);
            padding-bottom: 30px;
            background-size: 100%;
            width: auto;
            padding-bottom: 0;
        }*/
        body.login input[type="submit"] {
        	background: transparent;
        	color: #f05a28;
        	box-shadow: none;
        	display: block;
        	width: 100%;
        	margin-top: 20px;
        	font-size: 18px;
        	padding: 8px 0 !important;
        	height: auto !important;
        	border: 2px solid #f05a28;
        	border-radius: 4px;
        }
        body.login input[type="submit"]:hover {
        	background-color: #f05a28;
        	border-color: #f05a28 !important;
        	color: #ffffff;
        	box-shadow: none !important;
        }
    	</style>';
    	echo $styles;
	}

}