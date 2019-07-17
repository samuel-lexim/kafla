<?php

if(!function_exists('sienna_mikado_search_body_class')) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function sienna_mikado_search_body_class($classes) {

		if(is_active_widget(false, false, 'mkd_search_opener')) {

			$classes[] = 'mkdf-'.sienna_mikado_options()->getOptionValue('search_type');

			if(sienna_mikado_options()->getOptionValue('search_type') == 'fullscreen-search') {
				$is_fullscreen_bg_image_set = sienna_mikado_options()->getOptionValue('fullscreen_search_background_image') !== '';

				if($is_fullscreen_bg_image_set) {
					$classes[] = 'mkdf-fullscreen-search-with-bg-image';
				}

				$classes[] = 'mkdf-search-fade';

			}

		}

		return $classes;

	}

	add_filter('body_class', 'sienna_mikado_search_body_class');
}

if(!function_exists('sienna_mikado_get_search')) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function sienna_mikado_get_search() {

		if(sienna_mikado_active_widget(false, false, 'mkd_search_opener')) {

			$search_type = sienna_mikado_options()->getOptionValue('search_type');

			if($search_type == 'search-covers-header') {
				sienna_mikado_set_position_for_covering_search();

				return;
			} else if($search_type == 'search-slides-from-window-top' || $search_type == 'search-slides-from-header-bottom') {
				sienna_mikado_set_search_position_in_menu($search_type);
				if(sienna_mikado_is_responsive_on()) {
					sienna_mikado_set_search_position_mobile();
				}

				return;
			} elseif($search_type === 'search-dropdown') {
				sienna_mikado_set_dropdown_search_position();

				return;
			}

			sienna_mikado_load_search_template();

		}
	}

}

if(!function_exists('sienna_mikado_set_position_for_covering_search')) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function sienna_mikado_set_position_for_covering_search() {

		$containing_sidebar = sienna_mikado_active_widget(false, false, 'mkd_search_opener');

		foreach($containing_sidebar as $sidebar) {

			if(strpos($sidebar, 'top-bar') !== false) {
				add_action('sienna_mikado_after_header_top_html_open', 'sienna_mikado_load_search_template');
			} else if(strpos($sidebar, 'main-menu') !== false) {
				add_action('sienna_mikado_after_header_menu_area_html_open', 'sienna_mikado_load_search_template');
			} else if(strpos($sidebar, 'mobile-logo') !== false) {
				add_action('sienna_mikado_after_mobile_header_html_open', 'sienna_mikado_load_search_template');
			} else if(strpos($sidebar, 'logo') !== false) {
				add_action('sienna_mikado_after_header_logo_area_html_open', 'sienna_mikado_load_search_template');
			} else if(strpos($sidebar, 'sticky') !== false) {
				add_action('sienna_mikado_after_sticky_menu_html_open', 'sienna_mikado_load_search_template');
			}

		}

	}

}

if(!function_exists('sienna_mikado_set_search_position_in_menu')) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function sienna_mikado_set_search_position_in_menu($type) {

		add_action('sienna_mikado_after_header_menu_area_html_open', 'sienna_mikado_load_search_template');
		if($type == 'search-slides-from-header-bottom') {
			add_action('sienna_mikado_after_sticky_menu_html_open', 'sienna_mikado_load_search_template');
		}

	}
}

if(!function_exists('sienna_mikado_set_search_position_mobile')) {
	/**
	 * Hooks search template to mobile header
	 */
	function sienna_mikado_set_search_position_mobile() {

		add_action('sienna_mikado_after_mobile_header_html_open', 'sienna_mikado_load_search_template');

	}

}

if(!function_exists('sienna_mikado_load_search_template')) {
	/**
	 * Loads HTML template with parameters
	 */
	function sienna_mikado_load_search_template() {
		global $sienna_mikado_IconCollections;

		$search_type = sienna_mikado_options()->getOptionValue('search_type');

		$search_icon       = '';
		$search_icon_close = '';
		if(sienna_mikado_options()->getOptionValue('search_icon_pack') !== '') {
			$search_icon       = $sienna_mikado_IconCollections->getSearchIcon(sienna_mikado_options()->getOptionValue('search_icon_pack'), true);
			$search_icon_close = $sienna_mikado_IconCollections->getSearchClose(sienna_mikado_options()->getOptionValue('search_icon_pack'), true);
		}

		$parameters = array(
			'search_in_grid'    => sienna_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'       => $search_icon,
			'search_icon_close' => $search_icon_close
		);

		sienna_mikado_get_module_template_part('templates/types/'.$search_type, 'search', '', $parameters);

	}

}

if(!function_exists('sienna_mikado_set_dropdown_search_position')) {
	function sienna_mikado_set_dropdown_search_position() {
		add_action('sienna_mikado_after_search_opener', 'sienna_mikado_load_search_template');
	}
}