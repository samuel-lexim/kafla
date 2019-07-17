<?php do_action('sienna_mikado_before_page_header'); ?>

	<header class="mkdf-page-header">
		<div class="mkdf-logo-area">
			<?php if($logo_area_in_grid) : ?>
			<div class="mkdf-grid">
				<?php endif; ?>
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-center">
						<div class="mkdf-position-center-inner">
							<?php if(!$hide_logo) {
								sienna_mikado_get_logo();
							} ?>
						</div>
					</div>
				</div>
				<?php if($logo_area_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if($show_sticky) {
			sienna_mikado_get_sticky_header();
		} ?>
	</header>

<?php do_action('sienna_mikado_after_page_header'); ?>