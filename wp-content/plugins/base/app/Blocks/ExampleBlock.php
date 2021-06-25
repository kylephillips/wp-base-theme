<?php
namespace Base\Blocks;

class ExampleBlock extends BlockBase
{
	public function __construct()
	{
		acf_register_block_type([
			'name' => 'example-block',
			'title' => __('Example Block', 'base'),
			'category' => 'base', 
			'icon' => 'menu-alt3',
			'keywords' => ['block'],
			'align' => 'full',
			'mode' => 'preview',
			'supports' => [
				'align' => ['full']
			],
			'render_template' => $this->template_directory . 'example-block.php',
			'description' => __('An example ACF block.', 'base')
		]);
	}
}