<div class="mkdf-message  <?php echo esc_attr($message_classes) ?>" <?php echo sienna_mikado_get_inline_style($message_styles) ?>>
	<div class="mkdf-message-inner">
		<?php
		if($type == 'with_icon') {
			$icon_html = sienna_mikado_get_shortcode_module_template_part('templates/'.$type, 'message', '', $params);
			print $icon_html;
		}
		?>
		<a href="#" class="mkdf-close">
			<i class="mkdf_font_elegant_icon icon_close" <?php sienna_mikado_inline_style($close_icon_style); ?>></i>
		</a>

		<div class="mkdf-message-text-holder">
			<div class="mkdf-message-text">
				<div class="mkdf-message-text-inner">
					<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
				</div>
			</div>
		</div>
	</div>
</div>
