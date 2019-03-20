<?php
namespace Base\Display;

/**
* Removes Emoji Support (unnecessary http requests)
*/
class Emojis
{
	public function __construct()
	{
		$this->disable();
	}

	public function disable()
	{
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'wp_resource_hints', [$this, 'removeDnsPrefetch'], 10, 2 );
	}

	public function removeDnsPrefetch($urls, $relation_type)
	{
		if ( 'dns-prefetch' !== $relation_type ) return $urls;
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
		return $urls;
	}
}