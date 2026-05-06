<?php
namespace Base\Activation;

class Dev
{
    public function __construct()
    {
        add_action('wp_footer', [$this, 'livereload']);
    }

    public function livereload()
    {
        if ( !defined('WP_DEBUG') ) return;
        if ( !WP_DEBUG ) return;
        echo '<script src="http://' . $_SERVER['HTTP_HOST'] . ':35729/livereload.js?snipver=1"></script>';
    }
}