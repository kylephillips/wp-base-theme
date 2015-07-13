<?php 

namespace Base;

/**
* General Theme Functions
*/
class Functions 
{

	function __construct()
	{
		add_filter('nav_menu_css_class', array($this, 'clean_menus'), 100, 1);
		add_filter('nav_menu_item_id', array($this, 'clean_menus'), 100, 1);
		add_filter( 'xmlrpc_methods', array($this, 'disable_pingback_methods'));
		add_filter('excerpt_more', array($this, 'excerpt_elipses'));
		add_filter('edit_post_link', array($this, 'edit_button'));
		add_filter( 'wpseo_metabox_prio', array($this, 'yoastToBottom') );
		$this->remove_yoast_columns();
	}

	/**
	* Disable Pingbacks - DoS Attack Prevention
	*/
	public function disable_pingback_methods($methods)
	{
		unsset( $methods['pingback.ping'] );
		return $methods;
	}

	/**
	* Clean up WP Generated menus
	*/
	public function clean_menus($var)
	{
	  return is_array($var) ? array_intersect($var, array('current-menu-item','contact')) : '';
	}

	/**
	* Yoast Columns to Remove
	*/
	public function yoast_columns($columns)
	{
		unset( $columns['wpseo-score'] );
		unset( $columns['wpseo-title'] );
		unset( $columns['wpseo-metadesc'] );
		unset( $columns['wpseo-focuskw'] );
		return $columns;
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
	public function remove_yoast_columns()
	{
		add_filter ( 'manage_edit-casestudy_columns', array($this, 'yoast_columns' ));
		add_filter ( 'manage_edit-staff_columns', array($this, 'yoast_columns' ));
		add_filter ( 'manage_edit-page_columns', array($this, 'yoast_columns' ));
	}

	/**
    * Replace Elipses in excerpt
    */
	public function excerpt_elipses($more)
	{
		return '...';
	}

	/**
	* Add class to edit button
	*/
	public function edit_button($output)
	{
		$output = str_replace('class="post-edit-link"', 'class="post-edit-link btn"', $output);
		return $output;
	}

}