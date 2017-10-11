<?php 
namespace Base\Display;

/**
* General Theme Display Functions
*/
class Display 
{
	function __construct()
	{
		add_filter('xmlrpc_methods', [$this, 'disablePingbacks']);
		add_filter('nav_menu_css_class', [$this, 'cleanMenus'], 100, 1);
		add_filter('nav_menu_item_id', [$this, 'cleanMenus'], 100, 1);
		add_filter('excerpt_more', [$this, 'excerptElipses']);
	}

	/**
	* Disable Pingbacks - DoS Attack Prevention
	*/
	public function disablePingbacks($methods)
	{
		unsset( $methods['pingback.ping'] );
		return $methods;
	}

	/**
	* Clean up WP Generated menus
	*/
	public function cleanMenus($var)
	{
	  return is_array($var) ? array_intersect($var, ['current-menu-item','contact']) : '';
	}

	/**
    * Replace Elipses in excerpt
    */
	public function excerptElipses($more)
	{
		return '...';
	}
}