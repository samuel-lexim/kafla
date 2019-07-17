<div <?php sienna_mikado_class_attribute($holder_classes); ?>>
	<div class="mkdf-iwt-content-holder <?php echo esc_attr($added_line) ?>">
		<?php if($params['line_param'] === 'yes') : ?>
			<span class="mkdf-line-between-icons"></span>
		<?php endif; ?>
		<div class="mkdf-iwt-icon-title-holder">
			<div class="mkdf-iwt-icon-holder">
				<?php echo sienna_mikado_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
			</div>
			<div class="mkdf-iwt-title-holder">
				<<?php echo esc_attr($title_tag); ?> <?php sienna_mikado_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		</div>
	</div>
	<div class="mkdf-iwt-text-holder">
		<p <?php sienna_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

		<?php if(!empty($link) && !empty($link_text)) : ?>
			<a class="mkdf-iwt-link" href="<?php echo esc_attr($link); ?>" <?php sienna_mikado_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></a>
		<?php endif; ?>
	</div>
</div>
</div>