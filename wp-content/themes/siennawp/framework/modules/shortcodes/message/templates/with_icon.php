<?php
$icon_html = sienna_mikado_icon_collections()->renderIcon($icon, $icon_pack);
?>

<div class="mkdf-message-icon-holder">
	<div class="mkdf-message-icon" <?php sienna_mikado_inline_style($icon_attributes); ?>>
		<div class="mkdf-message-icon-inner">
			<?php
			print $icon_html;
			?>
		</div>
	</div>
</div>

