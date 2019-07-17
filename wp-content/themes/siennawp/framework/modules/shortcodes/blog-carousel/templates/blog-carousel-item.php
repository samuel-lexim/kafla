<div <?php post_class('mkdf-blog-carousel-item'); ?>>
	<div class="mkdf-blog-carousel-item-inner" <?php sienna_mikado_inline_style($item_style); ?>>
		<?php if(!$caller->featuredImageHidden($params)) : ?>
			<div class="mkdf-blog-carousel-item-image-holder">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('full'); ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="mkdf-blog-carousel-item-content-holder">
			<h5 class="mkdf-blog-carousel-item-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h5>

			<div class="mkdf-blog-carousel-item-excerpt">
				<?php if($text_length != '0') {
					$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
					<p><?php echo esc_html($excerpt) ?></p>
				<?php } ?>
			</div>

			<div class="mkdf-blog-carousel-item-info">
				<span class="mkdf-blog-carousel-info-item mkdf-blog-carousel-item-post-date">
					<?php the_time(get_option('date_format')); ?>
				</span>
				<span class="mkdf-blog-carousel-info-item mkdf-blog-carousel-item-comments-count">
					<span class="mkdf-blog-carousel-item-info-icon">
						<?php echo sienna_mikado_icon_collections()->renderIcon('icon_comment', 'font_elegant'); ?>
					</span>
					<?php comments_number('0 '.esc_html__('comments', 'sienna'), '1 '.esc_html__('comment', 'sienna'), '% '.esc_html__('comments', 'sienna')); ?>
				</span>
			</div>
		</div>
	</div>
</div>