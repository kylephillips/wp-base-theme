<?php
namespace Base\Activation;

class GoogleFonts
{
	/**
	* URL for Google Fonts
	*/
	private $url;

	public function __construct($url = null)
	{
		define('THEME_GOOGLE_FONTS', $url);
		if ( !$url ) return false;
		$this->url = $url;
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue']);
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue']);
	}

	public function enqueue()
	{
		wp_enqueue_style(
			'theme-google-fonts',
			$this->url,
			[],
			null
		);
	}
}