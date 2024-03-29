<div <?php sienna_mikado_class_attribute($holder_classes); ?>>
	<div class="mkdf-wh-holder-inner">
		<?php if(is_array($working_hours) && count($working_hours)) : ?>
			<?php if($title !== '') : ?>
				<div class="mkdf-wh-title-holder">
					<h2 class="mkdf-wh-title <?php echo esc_attr($icon_title);?>"><?php echo esc_html($title); ?></h2>
				</div>
			<?php endif; ?>

			<?php if($text !== '') : ?>
				<div class="mkdf-wh-text-holder">
					<p><?php echo esc_html($text); ?></p>
				</div>
			<?php endif; ?>

			<?php foreach($working_hours as $working_hour) : ?>
				<div class="mkdf-wh-item clearfix">
					<span class="mkdf-wh-day">
						<span class="mkdf-wh-icon">
							<span class="icon_clock_alt"></span>
						</span>
						<?php echo esc_html($working_hour['label']); ?>
					</span>
					<span class="mkdf-wh-dots"><span class="mkdf-wh-dots-inner"></span></span>
					<span class="mkdf-wh-hours">
						<?php if(isset($working_hour['time']) && $working_hour['time'] !== '') : ?>
							<span class="mkdf-wh-from"><?php echo esc_html($working_hour['time']); ?></span>
						<?php endif; ?>
					</span>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p><?php esc_html_e('Working hours hadn\'t been set', 'sienna'); ?></p>
		<?php endif; ?>
	</div>
</div>