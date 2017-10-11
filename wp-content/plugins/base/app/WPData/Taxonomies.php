<?php 
namespace Base\WPData;

/**
* Register Taxonomies
*/
class Taxonomies 
{
	public function __construct()
	{
		//$this->exampleTaxonomy();
	}

	/**
	* Taxonomy Example
	*/
	private function exampleTaxonomy()
	{
		$labels = [
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
		];
		register_taxonomy(
			"example-categories", 
			["post"], 
			[
				"hierarchical" => true, 
				"labels"	=>	$labels,
				'has_archive' => true,
				'rewrite' => ['slug' => 'example-categories', 'with_front' => false]
			]
		);
	}
}