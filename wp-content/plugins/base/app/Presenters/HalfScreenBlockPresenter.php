<?php
namespace Base\Presenters;

class HalfScreenBlockPresenter extends BlockPresenter
{
	/**
	* The Two Columns
	* @var array of ACF groups
	*/
	public $columns;

	/**
	* The Mobile Background Color
	* @var str
	*/
	public $mobile_background_color;

	/**
	* The Mobile Images
	* @var str
	*/
	public $mobile_images;

	public function __construct($block)
	{
		parent::__construct($block);
		$this->setData();
	}

	/**
	* Set the ACF field data
	*/
	private function setData()
	{
		$column_one = get_field('column_one');
		$column_two = get_field('column_two');
		$this->columns = [$column_one, $column_two];

		$this->mobile_background_color = get_field('mobile_background_color');
		$mobile_image_one = get_field('mobile_image_one');
		$mobile_image_two = get_field('mobile_image_two');
		$this->mobile_images = [$mobile_image_one, $mobile_image_two];
	}

	/**
	* Output the mobile image(s)
	* @param str - top|bottom
	* @return str
	*/
	public function mobileImages($position = 'top')
	{
		$out = '';
		foreach ( $this->mobile_images as $image ) :
			if ( !$image['image'] ) continue;
			if ( $image['position'] !== $position ) continue;
			$out .= '<img src="' . $image['image']['url'] . '" alt="' . $image['image']['alt'] . '" class="mobile-image">';
		endforeach;
		return $out;
	}

	/**
	* Output the mobile background color div
	*/
	public function mobileBackgroundColor()
	{
		if ( !$this->mobile_background_color ) return;
		return '<div class="mobile-background-color" style="background-color:'. $this->mobile_background_color . ';"></div>';
	}

	/**
	* Output the column divs
	*/
	public function columns()
	{
		$out = '<div class="background-columns">';
		foreach ( $this->columns as $key => $column ) :
			$out .= '<div class="column column-' . ($key + 1) . '" style="';
			if ( $column['background_type'] == 'color' && $column['background_color'] ) :
				$out .= 'background-color:' . $column['background_color'] . ';';
			endif;
			if ( $column['background_type'] == 'image' && $column['background_image'] ) :
				$out .= 'background:url(' . $column['background_image']['url'] . ');background-size:cover;';
			endif;
			$out .= '"></div>';
		endforeach;
		$out .= '</div><!-- .background-columns -->';
		return $out;
	}
}