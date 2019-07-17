<?php

if(!function_exists('sienna_mikado_load_elements_map')) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function sienna_mikado_load_elements_map() {

		sienna_mikado_add_admin_page(
			array(
				'slug'  => '_elements_page',
				'title' => 'Elements',
				'icon'  => 'fa fa-header'
			)
		);

		do_action('sienna_mikado_options_elements_map');

	}

	add_action('sienna_mikado_options_map', 'sienna_mikado_load_elements_map');

}