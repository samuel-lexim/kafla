<div class="mkdf-progress-bar">
	<h6 class="mkdf-progress-title-holder clearfix">
		<span class="mkdf-progress-title" <?php sienna_mikado_inline_style($title_color); ?>><?php echo esc_attr($title) ?></span>
		<span class="mkdf-progress-number-wrapper <?php echo esc_attr($percentage_classes) ?> ">
			<span class="mkdf-progress-number">
				<span class="mkdf-percent" <?php sienna_mikado_inline_style($percentage_color); ?>>0</span>
			</span>
		</span>
	</h6>

	<div class="mkdf-progress-content-outer" <?php sienna_mikado_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent) ?> class="mkdf-progress-content" <?php sienna_mikado_inline_style($bar_styles); ?>></div>
	</div>
</div>	