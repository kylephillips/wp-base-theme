<?php
namespace Base\User;

class ProfileSettings
{
	public function __construct()
	{
		add_action('user_register', [$this, 'updateColorScheme']);
	}

	/**
	* Update new users to use the custom color scheme
	*/
	public function updateColorScheme($user_id)
	{
		update_user_meta($user_id, 'admin_color', 'custom-scheme');
	}
}