<?php
namespace Base\AdminDisplay;

/**
* Edits to Yoast Display & Functionality
*/
class Yoast
{
	public function __construct()
	{
		add_filter('wpseo_metabox_prio', [$this, 'yoastToBottom']);
		add_filter ('manage_edit-page_columns', [$this, 'yoastColumns']);
		add_action('init', [$this, 'removeYoastNotifications']);
	}

	/**
	* Move Yoast Meta Box to Bottom
	*/
	public function yoastToBottom()
	{
		return 'low';
	}

	/**
	* Yoast Columns to Remove
	*/
	public function yoastColumns($columns)
	{
		unset( $columns['wpseo-score'] );
		unset( $columns['wpseo-title'] );
		unset( $columns['wpseo-metadesc'] );
		unset( $columns['wpseo-focuskw'] );
		return $columns;
	}

	/**
 	* Remove Yoast Notifications
 	*/
	public function removeYoastNotifications()
	{
		if ( ! class_exists( 'Yoast_Notification_Center' ) ) return;		
		remove_action( 'admin_notices', [\Yoast_Notification_Center::get(), 'display_notifications']);
		remove_action( 'all_admin_notices', [\Yoast_Notification_Center::get(), 'display_notifications']);
	}
}