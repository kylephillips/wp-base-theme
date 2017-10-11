<?php 
namespace Base\WPData;

/**
* Post Types
*/
class PostTypes 
{
	function __construct()
	{
		//$this->news();
	}

	/**
	* Post Types
	*/
	private function news()
	{
		$labels = [
			'name' => __('News'),  
			'singular_name' => __('News Item'),
			'add_new_item'=> 'Add News Item',
			'edit_item' => 'Edit News Item',
			'view_item' => 'View News Item'
		];
		$args = [
			'labels' => $labels,
			'public' => true,  
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'has_archive' => true,
			'publicly_queryable' => true,
			'query_var' => true,
			'supports' => ['title','thumbnail','editor','excerpt'],
			'rewrite' => ['slug' => 'news', 'with_front' => false]
		];
		register_post_type( 'news' , $args );
	}
}