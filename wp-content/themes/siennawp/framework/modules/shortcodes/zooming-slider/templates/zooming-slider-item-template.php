<div class="mkdf-zooming-slider-item-holder">
	<div class="mkdf-zooming-slider-item-content">
		<?php if($link !== '') : ?>
			<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link); ?>">
		<?php endif; ?>

		<?php echo wp_get_attachment_image($image, 'full'); ?>

		<?php if($link !== '') : ?>
			</a>
		<?php endif; ?>

	</div>
</div>