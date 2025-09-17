<?php
namespace Base\Presenters;
/**
* Provides methods for outputting block settings such as custom CSS,
* Background Colors, Text Color, Padding, etc…
*/
class BlockPresenter
{
	private $block;

	public function __construct($block)
	{
		$this->block = $block;
	}

	/**
	* Add support for native classes
	* @param str - any custom css that needs to be included
	*/
	public function css($css = '')
	{
		$text_color = $this->textColor();
		$text_align = $this->textAlign();
		$background_color = $this->backgroundColorClassName();
			$css = '';
		$class_name = ( isset($this->block['className']) && isset($this->block['className']) !== '' )
			? $this->block['className'] : null;
		if ( $text_color ) $css .= ' has-' . $text_color . '-color';
		if ( $background_color ) $css .= ' has-' . $background_color . '-background-color has-background';
		if ( $class_name ) $css .= ' ' . $class_name;
		if ( $text_align ) $css .= ' align-' . $text_align;
		return $css;
	}

	/**
	* Background color (CSS Classname)
	*/
	public function backgroundColorClassName()
	{
		return ( isset($this->block['backgroundColor']) && $this->block['backgroundColor'] !== '' ) 
			? $this->block['backgroundColor'] : null;
	}

	/**
	* Background color (InlineStyle)
	* For colors chosen with the picker rather than selecting a predefined color
	*/
	public function backgroundColorInlineStyle()
	{
		$background_color = ( isset($this->block['style']['color']['background']) && $this->block['style']['color']['background'] !== '' ) 
			? $this->block['style']['color']['background'] : null;
		if ( !$background_color ) return;
		return 'background-color:' . $background_color;
	}

	/**
	* Text color
	*/
	public function textColor()
	{
		return ( isset($this->block['textColor']) && $this->block['textColor'] !== '' ) 
			? $this->block['textColor'] : null;
	}

	/**
	* Text align
	*/
	public function textAlign()
	{
		return ( isset($this->block['alignText']) && $this->block['alignText'] !== '' ) 
			? $this->block['alignText'] : null;
	}

	/**
	* Block Gap
	*/
	public function blockGap()
	{
		return ( isset($this->block['style']) && isset($this->block['style']['spacing']) && isset($this->block['style']['spacing']['blockGap']) && $this->block['style']['spacing']['blockGap'] !== '' ) 
			? $this->block['style']['spacing']['blockGap'] : null;
	}

	/**
	* Inline styles
	*/
	public function styles($custom_styles = null)
	{
		$out = 'style="';
		if ( $custom_styles ) $out .= $custom_styles;
		if ( !isset($this->block['style']) || empty($this->block['style']) ) {
			$out .= '"';
			return $out;
		}
		$styles = $this->block['style'];
		if ( isset($styles['spacing']) ) :
			foreach ( $styles['spacing'] as $type => $spacing_styles ) :
				foreach ( $spacing_styles as $key => $style ) :
					$out .= $type . '-' . $key . ':' . $style . ';';
				endforeach;
			endforeach;
		endif;
		$out .= $this->backgroundColorInlineStyle();
		$out .= '"';
		return $out;
	}
}