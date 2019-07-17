<?php // This line is needed for mixItUp gutter ?>
	<article class="mkdf-portfolio-item mix <?php echo esc_attr($categories) ?>">
		<div class="mkdf-portfolio-item-holder">
			<a class="mkdf-portfolio-link" href="<?php echo esc_url($item_link); ?>"></a>

			<div class="mkdf-ptf-item-image-holder">
				<?php if($use_custom_image_size && (is_array($custom_image_sizes) && count($custom_image_sizes))) : ?>
					<?php echo sienna_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_image_sizes[0], $custom_image_sizes[1]); ?>
				<?php else: ?>
					<?php the_post_thumbnail($thumb_size); ?>
				<?php endif; ?>
			</div>
			<div class="mkdf-ptf-item-text-overlay">
				<div class="mkdf-ptf-item-text-overlay-inner">
					<div class="mkdf-ptf-item-text-holder">
						<div class="mkdf-ptf-item-text-holder-inner">
							<<?php echo esc_attr($title_tag) ?> class="mkdf-ptf-item-title">
								<a href="<?php echo esc_url($item_link) ?>">
									<?php echo esc_attr(get_the_title()); ?>
								</a>
							</<?php echo esc_attr($title_tag) ?>>

							<div class="mkdf-ptf-item-lightbox">
								<a href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-rel="prettyPhoto[portfolio-gallery]">
									<?php echo sienna_mikado_icon_collections()->renderIcon('fa-plus', 'font_awesome'); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mkdf-ptf-portfolio-overlay-bg"></div>
			</div>
		</div>
	</article>
<?php // This line is needed for mixItUp gutter ?>