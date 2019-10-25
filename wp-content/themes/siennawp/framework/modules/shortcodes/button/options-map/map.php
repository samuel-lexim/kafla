<?php

if(!function_exists('sienna_mikado_button_map')) {
	function sienna_mikado_button_map() {
		$panel = sienna_mikado_add_admin_panel(array(
			'title' => 'Button',
			'name'  => 'panel_button',
			'page'  => '_elements_page'
		));

		sienna_mikado_add_admin_field(array(
			'name'        => 'button_hover_animation',
			'type'        => 'select',
			'label'       => 'Hover Animation',
			'description' => 'Choose default hover animation type',
			'parent'      => $panel,
			'options'     => sienna_mikado_get_btn_hover_animation_types()
		));

		//Typography options
		sienna_mikado_add_admin_section_title(array(
			'name'   => 'typography_section_title',
			'title'  => 'Typography',
			'parent' => $panel
		));

		$typography_group = sienna_mikado_add_admin_group(array(
			'name'        => 'typography_group',
			'title'       => 'Typography',
			'description' => 'Setup typography for all button types',
			'parent'      => $panel
		));

		$typography_row = sienna_mikado_add_admin_row(array(
			'name'   => 'typography_row',
			'next'   => true,
			'parent' => $typography_group
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'fontsimple',
			'name'          => 'button_font_family',
			'default_value' => '',
			'label'         => 'Font Family',
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_text_transform',
			'default_value' => '',
			'label'         => 'Text Transform',
			'options'       => sienna_mikado_get_text_transform_array()
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_font_style',
			'default_value' => '',
			'label'         => 'Font Style',
			'options'       => sienna_mikado_get_font_style_array()
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'textsimple',
			'name'          => 'button_letter_spacing',
			'default_value' => '',
			'label'         => 'Letter Spacing',
			'args'          => array(
				'suffix' => 'px'
			)
		));

		$typography_row2 = sienna_mikado_add_admin_row(array(
			'name'   => 'typography_row2',
			'next'   => true,
			'parent' => $typography_group
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $typography_row2,
			'type'          => 'selectsimple',
			'name'          => 'button_font_weight',
			'default_value' => '',
			'label'         => 'Font Weight',
			'options'       => sienna_mikado_get_font_weight_array()
		));

		//Solid type options
		$solid_group = sienna_mikado_add_admin_group(array(
			'name'        => 'solid_group',
			'title'       => 'Solid Type',
			'description' => 'Setup solid button type',
			'parent'      => $panel
		));

		$solid_row = sienna_mikado_add_admin_row(array(
			'name'   => 'solid_row',
			'next'   => true,
			'parent' => $solid_group
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_text_color',
			'default_value' => '',
			'label'         => 'Text Color',
			'description'   => ''
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_text_color',
			'default_value' => '',
			'label'         => 'Text Hover Color',
			'description'   => ''
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_bg_color',
			'default_value' => '',
			'label'         => 'Background Color',
			'description'   => ''
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_bg_color',
			'default_value' => '',
			'label'         => 'Hover Background Color',
			'description'   => ''
		));

		$solid_row2 = sienna_mikado_add_admin_row(array(
			'name'   => 'solid_row2',
			'next'   => true,
			'parent' => $solid_group
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_border_color',
			'default_value' => '',
			'label'         => 'Border Color',
			'description'   => ''
		));

		sienna_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_border_color',
			'default_value' => '',
			'label'         => 'Hover Border Color',
			'description'   => ''
		));
	}

	add_action('sienna_mikado_options_elements_map', 'sienna_mikado_button_map');
}