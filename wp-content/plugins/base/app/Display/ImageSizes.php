<?php
namespace Base\Display;

use Base\Display\Config;

/**
* Defines Image Sizes and Makes available in the block editor
*/
class ImageSizes
{
	public function __construct()
	{
		add_action('after_setup_theme', [$this, 'registerSizes']);
		add_filter('image_size_names_choose', [$this, 'sizeChoices']);
	}

	public function registerSizes()
	{
		$sizes = (new Config)->getConfigArray('image_sizes');
		if ( !$sizes || empty($sizes) ) return;
		foreach ( $sizes as $key => $size ) :
			add_image_size( $key, $size['width'], $size['height'], $size['crop'] );
		endforeach;
	}

	public function sizeChoices($sizes)
	{
		$custom_sizes = [];
		$size_array = (new Config)->getConfigArray('image_sizes');
		if ( !$size_array || empty($size_array) ) return;
		foreach ( $size_array as $key => $size ) :
			if ( !$size['block_editor'] ) continue;
			$custom_sizes[$key] = $size['label'];
		endforeach;
    	$new_sizes = array_merge($sizes, $custom_sizes);
    	return $new_sizes;
	}
}