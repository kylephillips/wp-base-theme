<?php
$presenter = new \Base\Presenters\BlockPresenter($block);
$id = get_field('id');
$title = get_field('title');
$content = get_field('content');
$include_close = get_field('include_close_button');
$close_button_text = get_field('close_button_text');
$size = get_field('size');
$css = 'modal fade ' . $id;
?>
<div class="modal-backdrop" data-modal="<?php echo $id; ?>" data-modal-backdrop></div>
<div class="modal-content <?php echo $size; ?>" data-modal="<?php echo $id; ?>" role="dialog" id="<?php echo $block['id']; ?>">
	<div class="modal-content-body" role="document">
		<div class="modal-header">
			<?php if ( $title ) : ?>
			<h5 class="modal-title"><?php echo $title; ?></h5>
			<?php endif; ?>
			<button type="button" class="btn-close" data-modal-close aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<?php echo apply_filters('the_content', $content); ?>
		</div>
		<?php if ( $include_close ) : ?>
		<div class="modal-footer">
			<button type="button" class="btn btn-small" data-modal-close><?php echo $close_button_text; ?></button>
		</div>
	<?php endif; ?>
	</div>
	</div>
</div>