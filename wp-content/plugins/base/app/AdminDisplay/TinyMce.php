<?php 
namespace Base\AdminDisplay;

use Base\Display\Config;

/**
* Edit TinyMCE/Add formats
*/
class TinyMce 
{
	public function __construct()
	{
		add_filter('mce_buttons', [$this, 'buttonsOne']);
		add_filter('mce_buttons_2', [$this, 'buttonsTwo']);
		add_filter( 'tiny_mce_before_init', [$this, 'addFormats']);
	}

	/**
	* Editor buttons row one
	*/
	public function buttonsOne($buttons)
	{
		// Remove the defaults
		$remove = ['formatselect', 'strikethrough', 'wp_more', 'aligncenter','bold', 'italic', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'alignright', 'link', 'unlink', 'wp_adv'];
		$buttons = $this->removeButtons($remove, $buttons);

		// Add buttons
		$new_buttons = ['formatselect', 'styleselect', 'aligncenter', 'alignleft', 'bold', 'italic', 'bullist', 'numlist', 'indent', 'outdent', 'link', 'unlink', 'blockquote', 'hr', 'subscript', 'superscript', 'tablecontrols', 'wp_adv'];
		$buttons = $this->addButtons($new_buttons, $buttons);

		return $buttons;
	}

	/**
	* Editor buttons Row Two
	*/
	public function buttonsTwo($buttons)
	{
		$remove = ['forecolor', 'underline', 'alignjustify','formatselect','undo','redo', 'indent', 'outdent'];
		$buttons = $this->removeButtons($remove, $buttons);
		return $buttons;
	}

	/**
	* Loop through buttons to remove
	* @return array of buttons
	*/
	private function removeButtons($buttons_to_remove, $all_buttons)
	{
		foreach ( $buttons_to_remove as $remove )
		{
			if ( ( $key = array_search($remove, $all_buttons) ) !== false )
			unset($all_buttons[$key]);
		}
		return $all_buttons;
	}

	/**
	* Add Buttons to row
	* @return array of buttons
	*/
	private function addButtons($new_buttons, $all_buttons)
	{
		$new_buttons = array_reverse($new_buttons);
		foreach ( $new_buttons as $button )
		{
			array_unshift($all_buttons, $button);
		}
		return $all_buttons;
	}

	/**
	* Add custom formats
	*/
	public function addFormats($init_array)
	{
		$formats = (new Config)->editorFormats();
		$style_formats = [];
		foreach ( $formats as $key => $format ) :
			if ( !isset($format['tinymce']) ) continue;
			$tinymce = $format['tinymce'];
			$new_format = [];
			$new_format['title'] = $format['label'];
			if ( isset($tinymce['inline']) && $tinymce['inline'] ) $new_format['inline'] = $tinymce['inline'];
			if ( isset($tinymce['selector']) && $tinymce['selector'] ) $new_format['selector'] = $tinymce['selector'];
			$new_format['wrapper'] = ( isset($tinymce['wrapper']) && $tinymce['wrapper'] ) ? true : false;
			$new_format['classes'] = 'is-style-' . $key;
			$style_formats[] = $new_format;
		endforeach;
		$init_array['style_formats'] = json_encode( $style_formats );
		$init_array['wordpress_adv_hidden'] = false;
		return $init_array;
	}
}