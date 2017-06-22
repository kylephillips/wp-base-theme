<?php
namespace Base\AdminDisplay;

/**
* Edits to Yoast Display & Functionality
*/
class Yoast
{
	public function __construct()
	{
		add_filter( 'wpseo_metabox_prio', array($this, 'yoastToBottom') );
		add_action( 'init', array($this, 'removeYoastNotifications'));
		$this->removeYoastColumns();
	}

	/**
	* Move Yoast Meta Box to Bottom
	*/
	public function yoastToBottom()
	{
		return 'low';
	}

	/**
	* Remove Yoast Columns
	*/
	public function removeYoastColumns()
	{
		add_filter ( 'manage_edit-page_columns', array($this, 'yoastColumns' ));
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
		remove_action( 'admin_notices', array( \Yoast_Notification_Center::get(), 'display_notifications' ) );
		remove_action( 'all_admin_notices', array( \Yoast_Notification_Center::get(), 'display_notifications' ) );
	}
}