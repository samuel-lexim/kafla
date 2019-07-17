<?php
if(!function_exists('sienna_mikado_tabs_typography_styles')) {
	function sienna_mikado_tabs_typography_styles() {
		$selector              = '.mkdf-tabs .mkdf-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family           = sienna_mikado_options()->getOptionValue('tabs_font_family');

		if(sienna_mikado_is_font_option_valid($font_family)) {
			$tabs_tipography_array['font-family'] = sienna_mikado_is_font_option_valid($font_family);
		}

		$text_transform = sienna_mikado_options()->getOptionValue('tabs_text_transform');
		if(!empty($text_transform)) {
			$tabs_tipography_array['text-transform'] = $text_transform;
		}

		$font_style = sienna_mikado_options()->getOptionValue('tabs_font_style');
		if(!empty($font_style)) {
			$tabs_tipography_array['font-style'] = $font_style;
		}

		$letter_spacing = sienna_mikado_options()->getOptionValue('tabs_letter_spacing');
		if($letter_spacing !== '') {
			$tabs_tipography_array['letter-spacing'] = sienna_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = sienna_mikado_options()->getOptionValue('tabs_font_weight');
		if(!empty($font_weight)) {
			$tabs_tipography_array['font-weight'] = $font_weight;
		}

		echo sienna_mikado_dynamic_css($selector, $tabs_tipography_array);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_tabs_typography_styles');
}

if(!function_exists('sienna_mikado_tabs_inital_color_styles')) {
	function sienna_mikado_tabs_inital_color_styles() {
		$selector = '.mkdf-tabs .mkdf-tabs-nav li a';
		$styles   = array();

		if(sienna_mikado_options()->getOptionValue('tabs_color')) {
			$styles['color'] = sienna_mikado_options()->getOptionValue('tabs_color');
		}
		if(sienna_mikado_options()->getOptionValue('tabs_back_color')) {
			$styles['background-color'] = sienna_mikado_options()->getOptionValue('tabs_back_color');
		}
		if(sienna_mikado_options()->getOptionValue('tabs_border_color')) {
			$styles['border-color'] = sienna_mikado_options()->getOptionValue('tabs_border_color');
		}

		echo sienna_mikado_dynamic_css($selector, $styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_tabs_inital_color_styles');
}
if(!function_exists('sienna_mikado_tabs_active_color_styles')) {
	function sienna_mikado_tabs_active_color_styles() {
		$selector = '.mkdf-tabs .mkdf-tabs-nav li.ui-state-active a, .mkdf-tabs .mkdf-tabs-nav li.ui-state-hover a';
		$styles   = array();

		if(sienna_mikado_options()->getOptionValue('tabs_color_active')) {
			$styles['color'] = sienna_mikado_options()->getOptionValue('tabs_color_active');
		}
		if(sienna_mikado_options()->getOptionValue('tabs_back_color_active')) {
			$styles['background-color'] = sienna_mikado_options()->getOptionValue('tabs_back_color_active');
		}
		if(sienna_mikado_options()->getOptionValue('tabs_border_color_active')) {
			$styles['border-color'] = sienna_mikado_options()->getOptionValue('tabs_border_color_active');
		}

		echo sienna_mikado_dynamic_css($selector, $styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_tabs_active_color_styles');
}