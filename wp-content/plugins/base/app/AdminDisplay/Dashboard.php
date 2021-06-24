<?php 
namespace Base\AdminDisplay;

/**
* Dashboard Edits
*/
class Dashboard 
{
	function __construct()
	{
		remove_action('wp_head', 'wp_generator');
		add_action('wp_dashboard_setup', [$this, 'cleanDashboard']);
		add_action('wp_before_admin_bar_render', [$this, 'adminBar']);
		add_action('init', [$this, 'cleanHead']);
		//add_action('admin_menu', array($this, 'removeMenus'));
	}

	/**
	* Clean up the dashboard landing
	*/
	public function cleanDashboard()
	{
		global $wp_meta_boxes, $current_user;
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_forms']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	}

	/**
	* Clean up the admin bar
	*/
	public function adminBar()
	{
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wporg');
		$wp_admin_bar->remove_menu('documentation');
		$wp_admin_bar->remove_menu('support-forums');
		$wp_admin_bar->remove_menu('feedback');
		$wp_admin_bar->remove_menu('themes');
		$wp_admin_bar->remove_menu('customize');
		$wp_admin_bar->remove_menu('menus');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('wpseo-menu');
	}

	/**
	* Clean up head
	*/
	public function cleanHead()
	{
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links_extra', 3 );
		remove_action('wp_head', 'feed_links', 2 );
		remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0 );
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action('wp_head', 'recent_comments_style');
	}

	/**
	* Remove Unnecessary Menu Items
	*/
	public function removeMenus()
	{
		global $menu;
		$restricted = [__('Comments')];
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
	}
}