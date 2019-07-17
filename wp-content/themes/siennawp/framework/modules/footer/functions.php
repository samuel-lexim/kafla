<?php

if(!function_exists('sienna_mikado_get_footer_classes')) {
	/**
	 * Return all footer classes
	 *
	 * @param $page_id
	 *
	 * @return string|void
	 */
	function sienna_mikado_get_footer_classes($page_id) {

		$footer_classes       = '';
		$footer_classes_array = array('mkdf-page-footer');

		//is uncovering footer option set in theme options?
		if(sienna_mikado_options()->getOptionValue('uncovering_footer') == 'yes') {
			$footer_classes_array[] = 'mkdf-footer-uncover';
		}

		if(get_post_meta($page_id, 'mkdf_disable_footer_meta', true) == 'yes') {
			$footer_classes_array[] = 'mkdf-disable-footer';
		}

		//is some class added to footer classes array?
		if(is_array($footer_classes_array) && count($footer_classes_array)) {
			//concat all classes and prefix it with class attribute
			$footer_classes = esc_attr(implode(' ', $footer_classes_array));
		}

		return $footer_classes;

	}

}

if(!function_exists('sienna_mikado_footer_top_classes')) {
	/**
	 * Return classes for footer top
	 *
	 * @return string
	 */
	function sienna_mikado_footer_top_classes() {

		$footer_top_classes = array();

		if(sienna_mikado_options()->getOptionValue('footer_in_grid') != 'yes') {
			$footer_top_classes[] = 'mkdf-footer-top-full';
		}

		//footer aligment
		if(sienna_mikado_options()->getOptionValue('footer_top_columns_alignment') != '') {
			$footer_top_classes[] = 'mkdf-footer-top-aligment-'.sienna_mikado_options()->getOptionValue('footer_top_columns_alignment');
		}


		return implode(' ', $footer_top_classes);
	}
}

if(!function_exists('sienna_mikado_footer_body_classes')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function sienna_mikado_footer_body_classes($classes) {
		$background_image             = sienna_mikado_get_meta_field_intersect('footer_background_image', sienna_mikado_get_page_id());
		$enable_image_on_page         = get_post_meta(sienna_mikado_get_page_id(), 'mkdf_enable_footer_image_meta', true);
		$footer_bottom_border_enabled = sienna_mikado_options()->getOptionValue('enable_footer_bottom_border') === 'yes';
		$is_footer_full_width         = sienna_mikado_options()->getOptionValue('footer_in_grid') !== 'yes';

		if($background_image !== '' && $enable_image_on_page !== 'yes') {
			$classes[] = 'mkdf-footer-with-bg-image';
		}

		if($footer_bottom_border_enabled) {
			$classes[] = 'mkdf-footer-bottom-border-enabled';
		}

		if($is_footer_full_width) {
			$classes[] = 'mkdf-fullwidth-footer';
		}

		return $classes;
	}

	add_filter('body_class', 'sienna_mikado_footer_body_classes');
}

if(!function_exists('sienna_mikado_footer_page_styles')) {
	/**
	 * @param $style
	 *
	 * @return array
	 */
	function sienna_mikado_footer_page_styles($style) {
		$background_image = get_post_meta(sienna_mikado_get_page_id(), 'mkdf_footer_background_image_meta', true);
		$page_prefix      = sienna_mikado_get_unique_page_class();

		if($background_image !== '') {
			$footer_bg_image_style_array['background-image'] = 'url('.$background_image.')';

			$style[] = sienna_mikado_dynamic_css('body.mkdf-footer-with-bg-image'.$page_prefix.' .mkdf-page-footer', $footer_bg_image_style_array);
		}

		return $style;
	}

	add_filter('sienna_mikado_add_page_custom_style', 'sienna_mikado_footer_page_styles');
}