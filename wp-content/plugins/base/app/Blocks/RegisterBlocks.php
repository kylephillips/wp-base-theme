<?php
namespace Base\Blocks;

class RegisterBlocks
{
	public function __construct()
	{
		add_action('init', [$this, 'registerBlocks']);
	}

	/**
	* Each Custom Block has a corresponding directory in the /blocks directory
	* We loop through all of these and register our block using the block.json in each
	*/
	public function registerBlocks()
	{
		$directory = get_template_directory() . '/blocks';
		$files = new \DirectoryIterator($directory);
		foreach ( $files as $file ){
			if ( $file->isDot() ) continue;
			if ( !$file->isDir() ) continue;
			$path = $file->getPathname();
			register_block_type( $path . '/block.json' );
		}
	}
}