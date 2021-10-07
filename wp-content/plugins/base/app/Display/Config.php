<?php
namespace Base\Display;

/**
* Theme Colors
*/
class Config
{
	public function getConfigArray($key)
	{
		$array = [];
		$file_path = rtrim(ABSPATH, '/') . '/config.json';
		$file = json_decode(file_get_contents($file_path), true);
		if ( isset($file[$key]) ) {
			$array = (array) $file[$key];
		}
		return $array;
	}

	/**
	* Theme colors also saved as a constant THEME_COLORS in Bootstrap
	*/
	public function getColors()
	{
		$colors = $this->getConfigArray('colors');
		foreach ( $colors as $key => $color ){
			$colors[$key]['slug'] = $key;
		}
		return $colors;
	}

	public function getColorFromSlug($slug)
	{
		$colors = $this->getColors();
		foreach ( $colors as $color ){
			if ( $color['slug'] == $slug ) return $color['color'];
		}
	}

	/**
	* Editor Formats
	*/
	public function editorFormats()
	{
		return $this->getConfigArray('editor_formats');
	}
}