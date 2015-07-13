<?php 

namespace Base;

/**
* Dashboard Edits
*/
class Dashboard 
{

	function __construct()
	{
		add_action('wp_dashboard_setup', array($this, 'clean_dashboard'));
		add_action('wp_before_admin_bar_render', array($this, 'admin_bar'));
		add_action('init', array($this, 'clean_head'));
		remove_action('wp_head', 'wp_generator');
		add_filter('admin_footer_text', array($this, 'dashboard_footer'));
		//add_action('admin_head', array($this, 'admin_logo'));
		//add_action('admin_menu', array($this, 'remove_menus'));
	}

	/**
	* Clean up the dashboard landing
	*/
	public function clean_dashboard()
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
	public function admin_bar()
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
	}

	/**
	* Clean up head
	*/
	public function clean_head()
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
    * Dashboard Footer Text
    */
	public function dashboard_footer()
	{
		echo '<i class="icon-logo"></i> Built in <a href="http://wordpress.org" target="_blank">Wordpress</a>. Crafted by <a href="http://object9.com" target="_blank">Object 9</a>.';
	}

	/**
	* Dashboard Logo
	*/
	public function admin_logo()
	{
		global $base_plugin_directory;
		$path = $base_plugin_directory;
		echo "
		<style>
			@font-face {
			    font-family: 'icons';
			    src: url('$path/assets/fonts/icomoon.eot');
			    src: url('$path/assets/fonts/icomoon.eot?#iefix') format('embedded-opentype'),
			         url('$path/assets/fonts/icomoon.woff') format('woff'),
			         url('$path/assets/fonts/icomoon/icons.ttf') format('truetype'),
			         url('$path/assets/fonts/icomoon.svg#myfontregular') format('svg');
			    font-weight: normal;
			    font-style: normal;

			}
			/*
			#wpadminbar #wp-toolbar #wp-admin-bar-root-default #wp-admin-bar-wp-logo .ab-icon:before {
				font-family: 'icons' !important;
				content:'\\e601';
			}*/
			.icon-logo:before {
				content: '\\e600';
				font-family: 'icons' !important;
				speak: none;
				font-style: normal;
				font-weight: normal;
				font-variant: normal;
				text-transform: none;
				line-height: 1;
				font-size:20px;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				position:relative;
				top:5px;
			}
		</style>
	    ";
	}

	/**
	* Remove Unneccessary Menu Items
	*/
	public function remove_menus()
	{
		global $menu;
		$restricted = array(__('Comments'));
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
	}

}