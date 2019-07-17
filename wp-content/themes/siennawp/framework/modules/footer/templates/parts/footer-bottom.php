

<div class="mkdf-footer-bottom-holder">
	<?php if($footer_in_grid) : ?>
		<div class="mkdf-container">
			<div class="mkdf-container-inner">

			<?php endif; ?>

			<div class="mkdf-footer-bottom-holder-inner">

			<?php switch($footer_bottom_columns) {
				case 3:
					sienna_mikado_get_footer_bottom_sidebar_three_columns();
					break;
				case 2:
					sienna_mikado_get_footer_bottom_sidebar_two_columns();
					break;
				case 1:
					sienna_mikado_get_footer_bottom_sidebar_one_column();
					break;
			} ?>

			</div>

	<?php if($footer_in_grid) : ?>
			</div>
		</div>
	<?php endif; ?>
</div>