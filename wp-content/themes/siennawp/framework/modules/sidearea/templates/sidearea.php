<section class="mkdf-side-menu right">
	<?php if($show_side_area_title) {
		sienna_mikado_get_side_area_title();
	} ?>
	<div class="mkdf-close-side-menu-holder">
		<a href="#" target="_self" class="mkdf-close-side-menu">
			<span aria-hidden="true" class="icon_close"></span>
		</a>
	</div>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>