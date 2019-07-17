<div class="mkdf-horizontal-timeline" data-distance="<?php echo esc_attr($distance); ?>">
	<div class="mkdf-timeline">
		<?php if(is_array($dates) && count($dates)) : ?>
			<div class="mkdf-horizontal-timeline-events-wrapper">
				<div class="mkdf-horizontal-timeline-events">
					<ol>
						<?php foreach($dates as $date) : ?>
							<li>
								<a href="#" data-date="<?php echo esc_attr($date['formatted']); ?>"><?php echo esc_html(date_i18n($timeline_format, $date['timestamp'])); ?></a>
							</li>
						<?php endforeach; ?>
					</ol>
					<span class="mkdf-horizontal-timeline-filling-line" aria-hidden="true"></span>
				</div> <!-- .events -->
			</div> <!-- .events-wrapper -->

			<ul class="mkdf-timeline-navigation">
				<li>
					<a href="#0" class="prev inactive">
						<?php echo sienna_mikado_icon_collections()->renderIcon('arrow_carrot-left_alt2', 'font_elegant'); ?>
					</a>
				</li>
				<li>
					<a href="#0" class="next">
						<?php echo sienna_mikado_icon_collections()->renderIcon('arrow_carrot-right_alt2', 'font_elegant'); ?>
					</a>
				</li>
			</ul> <!-- .mkdf-timeline-navigation -->
		</div> <!-- .timeline -->

		<div class="mkdf-horizontal-timeline-events-content">
			<ol>
				<?php echo do_shortcode($content); ?>
			</ol>
		</div> <!-- .mkdf-horizontal-timeline-events-content -->
	<?php else: ?>
		<p><?php esc_html_e('Please add some events to timeline', 'sienna'); ?></p>
	<?php endif; ?>
</div>