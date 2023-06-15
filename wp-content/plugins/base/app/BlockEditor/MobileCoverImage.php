<?php
namespace Base\BlockEditor;

class MobileCoverImage
{
	public function __construct()
	{
		add_filter('render_block_core/cover', [$this, 'outputImage'], 10, 2);
	}

	/**
	* Output our custom image for mobile display
	*/
	public function outputImage($content, $block)
	{
		if ( !isset($block['attrs']['mobileImageURL']) ) return $content;
		$image = $block['attrs']['mobileImageURL'];

		preg_match('/<div role="img"/', $content, $is_fixed);

	    // If fixed background, add CSS variable
	    if ($is_fixed) {
	    	$content = preg_replace(
	    		'/(<div role="img".+style=".+)(">)/Ui',
	    		"$1;--mobileImageURL:url({$image});$2",
	    		$content
	    	);
	    }

	    // If not fixed, wrap in <picture>
	    else {
	    	$content = preg_replace(
	    		'/<img class="wp-block-cover__image.+\/>/Ui',
	    		"<picture><source srcset='{$image}' media='(max-width:767px)'>$0</picture>",
	    		$content
	    	);
	    }

	    return $content;
	}
}