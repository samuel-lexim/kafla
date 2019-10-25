<?php

if(!function_exists('sienna_mikado_footer_meta_box_map')) {
	/**
	 * Footer meta box map
	 */
	function sienna_mikado_footer_meta_box_map() {
		$footer_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('page', 'portfolio-item', 'post'),
				'title' => 'Footer',
				'name'  => 'footer_meta'
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_enable_footer_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => 'Disable Footer Image for this Page',
				'description'   => 'Enabling this option will hide footer image on this page',
				'parent'        => $footer_meta_box,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '#mkdf_mkdf_footer_background_image_meta',
					'dependence_show_on_yes' => ''
				)
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'            => 'mkdf_footer_background_image_meta',
				'type'            => 'image',
				'label'           => 'Background Image',
				'description'     => 'Choose Background Image for Footer Area on this page',
				'parent'          => $footer_meta_box,
				'hidden_property' => 'mkdf_enable_footer_background_image_meta',
				'hidden_value'    => 'yes'
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => 'Disable Footer for this Page',
				'description'   => 'Enabling this option will hide footer on this page',
				'parent'        => $footer_meta_box
			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_footer_meta_box_map');
}