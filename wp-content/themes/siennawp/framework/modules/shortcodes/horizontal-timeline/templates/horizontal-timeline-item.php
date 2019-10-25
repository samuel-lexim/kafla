<li data-date="<?php echo esc_attr($date); ?>">
	<div class="mkdf-grid-row">
		<div class="mkdf-grid-col-6 mkdf-grid-col-push-6">
			<div class="mkdf-horizontal-timeline-item-image">
				<?php echo wp_get_attachment_image($image, 'full'); ?>
			</div>

		</div>

		<div class="mkdf-grid-col-6 mkdf-grid-col-pull-6">
			<?php if(!empty($title)) : ?>
				<h2 class="mkdf-horizontal-timeline-item-title"><?php echo esc_html($title); ?></h2>
			<?php endif; ?>

			<?php if(!empty($subtitle)) : ?>
				<div class="mkdf-horizontal-timeline-item-subtitle">
					<p><?php echo esc_html($subtitle); ?></p>
				</div>
			<?php endif; ?>

			<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
		</div>
	</div>
</li>