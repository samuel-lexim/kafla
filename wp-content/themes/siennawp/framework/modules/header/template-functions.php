<?php

use Sienna\Modules\Header\Lib\HeaderFactory;

if(!function_exists('sienna_mikado_get_header')) {
	/**
	 * Loads header HTML based on header type option. Sets all necessary parameters for header
	 * and defines sienna_mikado_header_type_parameters filter
	 */
	function sienna_mikado_get_header() {

		//will be read from options
		$header_type     = sienna_mikado_options()->getOptionValue('header_type');
		$header_behavior = sienna_mikado_options()->getOptionValue('header_behaviour');

		extract(sienna_mikado_get_page_options());

		if(HeaderFactory::getInstance()->validHeaderObject()) {
			$parameters = array(
				'hide_logo'                        => sienna_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
				'show_sticky'                      => in_array($header_behavior, array(
					'sticky-header-on-scroll-up',
					'sticky-header-on-scroll-down-up'
				)) ? true : false,
				'show_fixed_wrapper'               => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
				'menu_area_background_color'       => $menu_area_background_color,
				'vertical_header_background_color' => $vertical_header_background_color,
				'vertical_header_opacity'          => $vertical_header_opacity,
				'vertical_background_image'        => $vertical_background_image
			);

			$parameters = apply_filters('sienna_mikado_header_type_parameters', $parameters, $header_type);

			HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
		}
	}
}

if(!function_exists('sienna_mikado_get_header_top')) {
	/**
	 * Loads header top HTML and sets parameters for it
	 */
	function sienna_mikado_get_header_top() {

		//generate column width class
		switch(sienna_mikado_options()->getOptionValue('top_bar_layout')) {
			case ('two-columns'):
				$column_widht_class = 'mkdf-'.sienna_mikado_options()->getOptionValue('top_bar_two_column_widths');
				break;
			case ('three-columns'):
				$column_widht_class = 'mkdf-'.sienna_mikado_options()->getOptionValue('top_bar_column_widths');
				break;
		}

		$params = array(
			'column_widths'      => $column_widht_class,
			'show_widget_center' => sienna_mikado_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
			'show_header_top'    => sienna_mikado_is_top_bar_enabled(),
			'top_bar_in_grid'    => sienna_mikado_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
		);

		$params = apply_filters('sienna_mikado_header_top_params', $params);

		sienna_mikado_get_module_template_part('templates/parts/header-top', 'header', '', $params);
	}
}

if(!function_exists('sienna_mikado_get_logo')) {
	/**
	 * Loads logo HTML
	 *
	 * @param $slug
	 */
	function sienna_mikado_get_logo($slug = '') {

		$slug = $slug !== '' ? $slug : sienna_mikado_options()->getOptionValue('header_type');

		if($slug == 'sticky') {
			$logo_image = sienna_mikado_options()->getOptionValue('logo_image_sticky');
		} else {
			$logo_image = sienna_mikado_options()->getOptionValue('logo_image');
		}

		$logo_image_dark  = sienna_mikado_options()->getOptionValue('logo_image_dark');
		$logo_image_light = sienna_mikado_options()->getOptionValue('logo_image_light');


		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = sienna_mikado_get_image_dimensions($logo_image);

		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		$params = array(
			'logo_image'           => $logo_image,
			'logo_image_dark'      => $logo_image_dark,
			'logo_image_light'     => $logo_image_light,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		sienna_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
	}
}

if(!function_exists('sienna_mikado_get_main_menu')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function sienna_mikado_get_main_menu($additional_class = 'mkdf-default-nav') {
		sienna_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('sienna_mikado_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function sienna_mikado_get_sticky_menu($additional_class = 'mkdf-default-nav') {
		sienna_mikado_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}


if(!function_exists('sienna_mikado_get_vertical_main_menu')) {
	/**
	 * Loads vertical menu HTML
	 */
	function sienna_mikado_get_vertical_main_menu() {
		sienna_mikado_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
	}
}


if(!function_exists('sienna_mikado_get_sticky_header')) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function sienna_mikado_get_sticky_header() {

		$parameters = array(
			'hide_logo'             => sienna_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
			'sticky_header_in_grid' => sienna_mikado_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
		);

		sienna_mikado_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
	}
}

if(!function_exists('sienna_mikado_get_mobile_header')) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function sienna_mikado_get_mobile_header() {
		if(sienna_mikado_is_responsive_on()) {
			$header_type = sienna_mikado_options()->getOptionValue('header_type');

			//this could be read from theme options
			$mobile_header_type = 'mobile-header';

			$parameters = array(
				'show_logo'              => sienna_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
				'menu_opener_icon'       => sienna_mikado_icon_collections()->getMobileMenuIcon(sienna_mikado_options()->getOptionValue('mobile_icon_pack'), true),
				'show_navigation_opener' => has_nav_menu('main-navigation')
			);

			sienna_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
		}
	}
}

if(!function_exists('sienna_mikado_get_mobile_logo')) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 *
	 * @param string $slug
	 */
	function sienna_mikado_get_mobile_logo($slug = '') {

		$slug = $slug !== '' ? $slug : sienna_mikado_options()->getOptionValue('header_type');

		//check if mobile logo has been set and use that, else use normal logo
		if(sienna_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
			$logo_image = sienna_mikado_options()->getOptionValue('logo_image_mobile');
		} else {
			$logo_image = sienna_mikado_options()->getOptionValue('logo_image');
		}

		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = sienna_mikado_get_image_dimensions($logo_image);

		$logo_height          = '';
		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		//set parameters for logo
		$parameters = array(
			'logo_image'           => $logo_image,
			'logo_dimensions'      => $logo_dimensions,
			'logo_height'          => $logo_height,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		sienna_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
	}
}

if(!function_exists('sienna_mikado_get_mobile_nav')) {
	/**
	 * Loads mobile navigation HTML
	 */
	function sienna_mikado_get_mobile_nav() {

		$slug = sienna_mikado_options()->getOptionValue('header_type');

		sienna_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
	}
}

if(!function_exists('sienna_mikado_get_page_options')) {
	/**
	 * Gets options from page
	 */
	function sienna_mikado_get_page_options() {
		$id                                = sienna_mikado_get_page_id();
		$page_options                      = array();
		$menu_area_background_color_rgba   = '';
		$menu_area_background_color        = '';
		$menu_area_background_transparency = '';
		$vertical_header_background_color  = '';
		$vertical_header_opacity           = '';
		$vertical_background_image         = '';

		$header_type = sienna_mikado_options()->getOptionValue('header_type');
		switch($header_type) {
			case 'header-standard':

				if(($meta_temp = get_post_meta($id, 'mkdf_menu_area_background_color_header_standard_meta', true)) != '') {
					$menu_area_background_color = $meta_temp;
				}

				if(($meta_temp = get_post_meta($id, 'mkdf_menu_area_background_transparency_header_standard_meta', true)) != '') {
					$menu_area_background_transparency = $meta_temp;
				}

				if(sienna_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
					$menu_area_background_color_rgba = 'background-color:'.sienna_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
				}

				break;
		}

		$page_options['menu_area_background_color']       = $menu_area_background_color_rgba;
		$page_options['vertical_header_background_color'] = $vertical_header_background_color;
		$page_options['vertical_header_opacity']          = $vertical_header_opacity;
		$page_options['vertical_background_image']        = $vertical_background_image;

		return $page_options;
	}
}