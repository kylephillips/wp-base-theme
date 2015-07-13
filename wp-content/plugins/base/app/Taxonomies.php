<?php 

namespace Base;

/**
* Register Taxonomies
* Add a method for each taxonomy required and call in the constructor
*/
class Taxonomies 
{

	public function __construct()
	{
		//$this->exampleCategory();
	}

	/**
	* Case Study Types
	*/
	private function exampleCategory()
	{
		$labels = array(
			'name'				=>	__( 'Example Categories'),
			'singular_name'		=>	__( 'Example Category'),
			'search_items'		=>	__( 'Search Example Categories' ),
			'all_items'			=>	__( 'All Example Categories' ),
			'parent_item'		=>	__( 'Parent Example Category' ),
			'parent_item_colon'	=>	__( 'Parent Example Category:' ),
			'edit_item'			=>	__( 'Edit Example Category' ),
			'update_item'		=>	__( 'Update Example Category' ),
			'add_new_item'		=>	__( 'Add New Example Category' ),
			'new_item_name'		=>	__( 'New Example Category' ),
			'menu_name'			=>	__( 'Example Categories' ),
		);
		register_taxonomy(
			"example-categories", 
			array("post"), 
			array(
				"hierarchical" => true, 
				"labels"	=>	$labels,
				'has_archive' => true,
				'rewrite' => array('slug' => 'example-categories', 'with_front' => false)
			)
		);
	}

}