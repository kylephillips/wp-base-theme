<?php
namespace Base\Activation;

class CloudTypography
{
	/**
	* URL for Typography.com fonts
	*/
	private $url;

	public function __construct($url = null)
	{
		define('THEME_CLOUD_TYPOGRAPHY', $url);
		if ( !$url ) return false;
		$this->url = $url;
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue']);
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue']);
	}

	public function enqueue()
	{
		wp_enqueue_style(
			'theme-cloud-typography',
			$this->url,
			[],
			null
		);
	}
}