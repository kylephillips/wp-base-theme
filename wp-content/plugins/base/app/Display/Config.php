<?php
namespace Base\Display;

/**
* Theme Colors
*/
class Config
{
	public function getThemeJsonArray($key)
	{
		$file_path = get_template_directory() . '/theme.json';
		$file = json_decode(file_get_contents($file_path), true);
		if ( $key == 'colors' && isset($file['settings']['color']['palette'])) {
			return $file['settings']['color']['palette'];
		}
		return [];
	}

	public function getConfigArray($key)
	{
		$array = [];
		$file_path = get_template_directory() . '/config.json';
		if ( !file_exists($file_path) ) return $array;
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
		return $this->getThemeJsonArray('colors');
	}

	/**
	* Editor Formats
	*/
	public function editorFormats()
	{
		return $this->getConfigArray('editor_formats');
	}
}