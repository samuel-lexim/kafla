<div <?php sienna_mikado_class_attribute($holder_classes); ?>>
	<?php if(!empty($data)) : ?>

		<?php if($show_filter === 'yes') : ?>

			<div class="mkdf-social-feed-filter-holder">
				<ul>
					<li class="mkdf-social-feed-current-filter mkdf-social-feed-filter-item">
						<a href="#"><?php esc_html_e('All', 'sienna'); ?></a>
					</li>
					<?php foreach($feed_data_builder->getProviders() as $provider) : ?>
						<li class="mkdf-social-feed-filter-item" data-type="mkdf-social-feed-masonry-type-<?php echo esc_attr($provider->getType()); ?>">
							<a href="#">
								<?php echo esc_html($provider->getDisplayName()); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="mkdf-social-feed-masonry-holder">
			<?php foreach($data as $item) : ?>
				<div class="mkdf-social-feed-masonry-item-holder mkdf-social-feed-masonry-type-<?php echo esc_attr($item->getType()); ?>">
					<?php $caller->getItemTemplate($item); ?>
				</div>
			<?php endforeach; ?>
			
			<div class="mkdf-social-feed-masonry-grid-sizer"></div>
		</div>

	<?php endif; ?>
</div>

