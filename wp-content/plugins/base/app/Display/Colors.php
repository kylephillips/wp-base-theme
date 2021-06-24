<?php
namespace Base\Display;

/**
* Theme Colors
*/
class Colors
{
	/**
	* Theme colors also saved as a constant THEME_COLORS in Bootstrap
	*/
	public function getColors()
	{
		$file_path = rtrim(ABSPATH, '/') . '/colors.json';
		$file = file_get_contents($file_path);
		return json_decode($file, true);
	}

	public function getColorFromSlug($slug)
	{
		$colors = $this->getColors();
		foreach ( $colors as $color ){
			if ( $color['slug'] == $slug ) return $color['color'];
		}
	}
	
}