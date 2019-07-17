<div class="mkdf-social-item-carousel-box mkdf-social-item-<?php echo esc_attr($item->getType()); ?>-type">
	<?php if($item->getThumb() !== '') : ?>
		<div class="mkdf-social-item-carousel-image-holder">
			<a href="<?php echo esc_url($item->getPermalink()); ?>" target="<?php echo esc_attr($item->getTarget()); ?>">
				<?php echo sienna_mikado_kses_img($item->getThumb()); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="mkdf-social-item-carousel-content">
		<div class="mkdf-social-item-carousel-top-content">
			<div class="mkdf-social-feed-item-carousel-icon">
				<?php print $item->getIcon(); ?>
			</div>

			<div class="mkdf-social-item-carousel-excerpt">
				<p><?php echo wp_kses_post($item->getExcerpt()); ?></p>
			</div>

			<div class="mkdf-social-item-carousel-date">
				<p><?php echo esc_html($item->getDate()); ?></p>
			</div>
		</div>

		<div class="mkdf-social-item-carousel-bottom-content">
			<div class="mkdf-social-item-carousel-author">
				<a target="<?php echo esc_attr($item->getTarget()); ?>" href="<?php echo esc_url($item->getAuthorURL()); ?>">
					<?php echo esc_html($item->getAuthorName()); ?>
				</a>
			</div>
		</div>


	</div>
</div>