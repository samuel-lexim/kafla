<?php

if(!function_exists('sienna_mikado_parallax_options_map')) {
	/**
	 * Parallax options page
	 */
	function sienna_mikado_parallax_options_map() {

		$panel_parallax = sienna_mikado_add_admin_panel(
			array(
				'title' => 'Parallax',
				'name'  => 'panel_parallax',
				'page'  => '_elements_page'
			)
		);

		sienna_mikado_add_admin_field(array(
			'type'          => 'onoff',
			'name'          => 'parallax_on_off',
			'default_value' => 'off',
			'label'         => 'Parallax on touch devices',
			'description'   => 'Enabling this option will allow parallax on touch devices',
			'parent'        => $panel_parallax
		));

		sienna_mikado_add_admin_field(array(
			'type'          => 'text',
			'name'          => 'parallax_min_height',
			'default_value' => '400',
			'label'         => 'Parallax Min Height',
			'description'   => 'Set a minimum height for parallax images on small displays (phones, tablets, etc.)',
			'args'          => array(
				'col_width' => 3,
				'suffix'    => 'px'
			),
			'parent'        => $panel_parallax
		));

	}

	add_action('sienna_mikado_options_map', 'sienna_mikado_parallax_options_map', 17);

}