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
		add_filter('upload_mimes', [$this, 'allowSvgUploads']);
		add_action('admin_head', [$this, 'svgAdminDisplay']);
		add_action('template_include', [$this, 'headerType']);
	}

	/**
	* Disable Pingbacks - DoS Attack Prevention
	*/
	public function disablePingbacks($methods)
	{
		unset( $methods['pingback.ping'] );
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

	/**
	* Allow SVG Uploads
	*/
	public function allowSvgUploads($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	* Fixes SVG display in dashboard
	*/
	public function svgAdminDisplay()
	{
		echo '<style type="text/css">td.media-icon img[src$=".svg"], .np-thumbnail img[src$=".svg"], #postimagediv img[src$=".svg"] { width: 100% !important; height: auto !important; }</style>';
	}

	/**
	* Set the hero header type global
	*/
	public function headerType($template)
	{
		global $post;
		if ( !$post ) return;
		$has_hero = false;
		if ( has_blocks($post->post_content) ) :
			$blocks = parse_blocks( $post->post_content );
			if ( $blocks && $blocks[0]['blockName'] == 'core/cover' ) $has_hero = true;
			if ( $blocks && $blocks[0]['blockName'] == 'acf/hero' ) $has_hero = true;
		endif;
		if ( is_archive('albums') ) $has_hero = false;
		define('HAS_HERO_BLOCK', $has_hero);
		return $template;
	}
}