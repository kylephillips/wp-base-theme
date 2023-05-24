<?php
$presenter = new \Base\Presenters\BlockPresenter($block);
?>
<div class="block-example <?php echo $presenter->css(); ?>" id="<?php echo $block['id']; ?>" <?php echo $presenter->styles(); ?>>
	
</div><!-- .block-example -->