<div <?php sienna_mikado_inline_style($holder_styles); ?> <?php sienna_mikado_class_attribute($holder_classes); ?>>
	<div class="mkdf-icon-list-icon-holder">
		<div class="mkdf-icon-list-icon-holder-inner clearfix">
			<?php echo sienna_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params);
			?>
		</div>
	</div>
	<p class="mkdf-icon-list-text" <?php echo sienna_mikado_get_inline_style($title_style) ?> > <?php echo esc_attr($title) ?></p>
</div>