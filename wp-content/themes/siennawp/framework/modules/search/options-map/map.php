<?php

if(!function_exists('sienna_mikado_search_options_map')) {

	function sienna_mikado_search_options_map() {

		sienna_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => 'Search',
				'icon'  => 'fa fa-search'
			)
		);

		$search_panel = sienna_mikado_add_admin_panel(
			array(
				'title' => 'Search',
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen-search',
				'label'         => 'Select Search Type',
				'description'   => "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with transparent header)",
				'options'       => array(
					'fullscreen-search'                => 'Fullscreen Search'
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'search-slides-from-header-bottom' => '#mkdf_search_animation_container',
						'search-covers-header'             => '#mkdf_search_height_container, #mkdf_search_animation_container',
						'fullscreen-search'                => '#mkdf_search_height_container',
						'search-slides-from-window-top'    => '#mkdf_search_height_container, #mkdf_search_animation_container'
					),
					'show'       => array(
						'search-slides-from-header-bottom' => '#mkdf_search_height_container',
						'search-covers-header'             => '',
						'fullscreen-search'                => '#mkdf_search_animation_container',
						'search-slides-from-window-top'    => ''
					)
				)
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_awesome',
				'label'         => 'Search Icon Pack',
				'description'   => 'Choose icon pack for search icon',
				'options'       => sienna_mikado_icon_collections()->getIconCollectionsExclude(array(
					'linea_icons',
					'simple_line_icons',
					'dripicons'
				))
			)
		);

		$fullscreen_background_image_container = sienna_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'fullscreen_background_image_container',
				'hidden_property' => 'search_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'search-covers-header',
					'search-slides-from-header-bottom',
					'search-slides-from-window-top'
				)
			)
		);

		sienna_mikado_add_admin_field(array(
			'name' => 'fullscreen_search_background_image',
			'type' => 'image',
			'parent' => $fullscreen_background_image_container,
			'label' => 'Full Screen Search Background Image',
			'description' => 'Choose full screen search background image'
		));

		sienna_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => 'Initial Search Icon in Header'
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => 'Icon Size',
				'description'   => 'Set size for icon',
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$search_icon_color_group = sienna_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => 'Icon Colors',
				'description' => 'Define color style for icon',
				'name'        => 'search_icon_color_group'
			)
		);

		$search_icon_color_row = sienna_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => 'Color'
			)
		);
		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => 'Hover Color'
			)
		);
		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_color',
				'label'  => 'Light Header Icon Color'
			)
		);
		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_hover_color',
				'label'  => 'Light Header Icon Hover Color'
			)
		);

		$search_icon_color_row2 = sienna_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row2',
				'next'   => true
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_color',
				'label'  => 'Dark Header Icon Color'
			)
		);
		sienna_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_hover_color',
				'label'  => 'Dark Header Icon Hover Color'
			)
		);


		$search_icon_background_group = sienna_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => 'Icon Background Style',
				'description' => 'Define background style for icon',
				'name'        => 'search_icon_background_group'
			)
		);

		$search_icon_background_row = sienna_mikado_add_admin_row(
			array(
				'parent' => $search_icon_background_group,
				'name'   => 'search_icon_background_row'
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_color',
				'default_value' => '',
				'label'         => 'Background Color',
			)
		);

		sienna_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_hover_color',
				'default_value' => '',
				'label'         => 'Background Hover Color',
			)
		);
	}

	add_action('sienna_mikado_options_map', 'sienna_mikado_search_options_map', 6);

}