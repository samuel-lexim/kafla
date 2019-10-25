<?php

if(!function_exists('sienna_mikado_general_meta_box_map')) {
	/**
	 * General meta box map
	 */
	function sienna_mikado_general_meta_box_map() {
		$general_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('page', 'portfolio-item', 'post'),
				'title' => 'General',
				'name'  => 'general_meta'
			)
		);


		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_background_color_meta',
				'type'          => 'color',
				'default_value' => '',
				'label'         => 'Page Background Color',
				'description'   => 'Choose background color for page content',
				'parent'        => $general_meta_box
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_padding_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Page Padding',
				'description'   => 'Insert padding in format 10px 10px 10px 10px',
				'parent'        => $general_meta_box
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => 'Always put content behind header',
				'description'   => 'Enabling this option will put page content behind page header',
				'parent'        => $general_meta_box,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_slider_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Slider Shortcode',
				'description'   => 'Paste your slider shortcode here',
				'parent'        => $general_meta_box
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_transition_type',
				'type'          => 'selectblank',
				'label'         => 'Page Transition',
				'description'   => 'Choose the type of transition to this page',
				'parent'        => $general_meta_box,
				'default_value' => '',
				'options'       => array(
					'no-animation' => 'No animation',
					'fade'         => 'Fade'
				)
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'selectblank',
				'label'       => 'Show Comments',
				'description' => 'Enabling this option will show comments on your page',
				'parent'      => $general_meta_box,
				'options'     => array(
					'yes' => 'Yes',
					'no'  => 'No',
				)
			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_general_meta_box_map');
}