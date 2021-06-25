<?php
namespace Base\Display;

/**
* Theme Colors
*/
class Config
{
	/**
	* Theme colors also saved as a constant THEME_COLORS in Bootstrap
	*/
	public function getColors()
	{
		$file_path = rtrim(ABSPATH, '/') . '/config.json';
		$file = json_decode(file_get_contents($file_path), true);
		$colors = (array) $file['colors'];
		return $colors;
	}

	public function getColorFromSlug($slug)
	{
		$colors = $this->getColors();
		foreach ( $colors as $color ){
			if ( $color['slug'] == $slug ) return $color['color'];
		}
	}
	
}