<?php do_action('sienna_mikado_before_page_header'); ?>
	<aside class="mkdf-vertical-menu-area">
		<div class="mkdf-vertical-menu-area-inner">
			<div class="mkdf-vertical-area-background" <?php sienna_mikado_inline_style(array(
				$vertical_header_background_color,
				$vertical_header_opacity,
				$vertical_background_image
			)); ?>></div>
			<?php if(!$hide_logo) {
				sienna_mikado_get_logo();
			} ?>
			<?php sienna_mikado_get_vertical_main_menu(); ?>
			<div class="mkdf-vertical-area-widget-holder">
				<?php if(is_active_sidebar('mkdf-vertical-area')) : ?>
					<?php dynamic_sidebar('mkdf-vertical-area'); ?>
				<?php endif; ?>
			</div>
		</div>
	</aside>

<?php do_action('sienna_mikado_after_page_header'); ?>