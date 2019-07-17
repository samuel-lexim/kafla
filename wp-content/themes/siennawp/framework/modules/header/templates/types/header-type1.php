<?php do_action('sienna_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
	<div class="mkdf-logo-area">
		<?php if($logo_area_in_grid) : ?>
		<div class="mkdf-grid">
			<?php endif; ?>
			<?php do_action('sienna_mikado_after_header_logo_area_html_open') ?>
			<div class="mkdf-vertical-align-containers mkdf-50-50">
				<div class="mkdf-position-left">
					<div class="mkdf-position-left-inner">
						<?php if(!$hide_logo) {
							sienna_mikado_get_logo();
						} ?>
					</div>
				</div>

				<div class="mkdf-position-right">
					<div class="mkdf-position-right-inner">
						<?php if(is_active_sidebar('mkdf-right-from-logo')) : ?>
							<?php dynamic_sidebar('mkdf-right-from-logo'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if($logo_area_in_grid) : ?>
		</div>
	<?php endif; ?>
	</div>
	<?php if($show_fixed_wrapper) : ?>
	<div class="mkdf-fixed-wrapper">
		<?php endif; ?>
		<div class="mkdf-menu-area">
			<?php if($menu_area_in_grid) : ?>
			<div class="mkdf-grid">
				<?php endif; ?>
				<?php do_action('sienna_mikado_after_header_menu_area_html_open') ?>
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-left">
						<div class="mkdf-position-left-inner">
							<?php sienna_mikado_get_main_menu(); ?>
						</div>
					</div>
					<?php if(is_active_sidebar('mkdf-right-from-main-menu')) :
						$widget_class = 'mkdf-has-widget'; ?>
						<div class="mkdf-position-right <?php echo esc_attr($widget_class) ?>">
							<div class="mkdf-position-right-inner">
								<?php dynamic_sidebar('mkdf-right-from-main-menu'); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if($show_fixed_wrapper) : ?>
	</div>
<?php endif; ?>
	<?php if($show_sticky) {
		sienna_mikado_get_sticky_header();
	} ?>
</header>

<?php do_action('sienna_mikado_after_page_header'); ?>

