<?php
namespace Base\Blocks;

/**
* Registers the ACF custom layout blocks
*/
class AcfBlocks
{
	public function __construct()
	{
		$this->registerBlocks();
	}

	/**
	* Loop through the relevant classes in this directory and create block types
	*/
	private function registerBlocks()
	{
		if ( !function_exists('acf_register_block_type') ) return;
		$directory = dirname(__FILE__);
		$files = new \DirectoryIterator(dirname(__FILE__));
		foreach ( $files as $file ){
			if ( $file->isDot() ) continue;
			$extension = $file->getExtension();
			if ( $extension !== 'php' ) continue;
			$classname = $file->getBasename('.php');
			if ( $classname == 'AcfBlocks' || $classname == 'AcfBlockBase' ) continue;
			$block_class = 'Base\Blocks\\' . $classname;
			$block = new $block_class;
		}
	}
}