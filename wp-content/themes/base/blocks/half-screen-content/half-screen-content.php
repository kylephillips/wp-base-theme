<?php 
/**
* Provides a block that stretches across the full screen on desktop with interior columns 
* Allows a contained two-column block, with the outer edges of the columns to fill the screen width
* Mobile options included
*/
$presenter = new \Base\Presenters\HalfScreenBlockPresenter($block); ?>
<div class="block-half-screen-content <?php echo $presenter->css(); ?>" id="<?php echo $block['id']; ?>" <?php echo $presenter->styles(); ?>>
	<?php echo $presenter->mobileImages('top');	?>
	<div class="inner">
		<?php 
		echo $presenter->mobileBackgroundColor(); 
		echo $presenter->columns();
		?>
		<div class="content">
			<?php echo '<InnerBlocks />'; ?>
		</div><!-- .content -->
	</div><!-- .inner -->
	<?php echo $presenter->mobileImages('bottom');	?>
</div><!-- .block-half-screen-content -->