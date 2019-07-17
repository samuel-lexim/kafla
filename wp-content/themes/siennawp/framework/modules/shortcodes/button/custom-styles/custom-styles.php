<?php

if(!function_exists('sienna_mikado_button_typography_styles')) {
	/**
	 * Typography styles for all button types
	 */
	function sienna_mikado_button_typography_styles() {
		$selector = '.mkdf-btn';
		$styles   = array();

		$font_family = sienna_mikado_options()->getOptionValue('button_font_family');
		if(sienna_mikado_is_font_option_valid($font_family)) {
			$styles['font-family'] = sienna_mikado_get_font_option_val($font_family);
		}

		$text_transform = sienna_mikado_options()->getOptionValue('button_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = sienna_mikado_options()->getOptionValue('button_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = sienna_mikado_options()->getOptionValue('button_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = sienna_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = sienna_mikado_options()->getOptionValue('button_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo sienna_mikado_dynamic_css($selector, $styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_button_typography_styles');
}

if(!function_exists('sienna_mikado_button_outline_styles')) {
	/**
	 * Generate styles for outline button
	 */
	function sienna_mikado_button_outline_styles() {
		//outline styles
		$outline_styles   = array();
		$outline_selector = '.mkdf-btn.mkdf-btn-outline';

		if(sienna_mikado_options()->getOptionValue('btn_outline_text_color')) {
			$outline_styles['color'] = sienna_mikado_options()->getOptionValue('btn_outline_text_color');
		}

		if(sienna_mikado_options()->getOptionValue('btn_outline_border_color')) {
			$outline_styles['border-color'] = sienna_mikado_options()->getOptionValue('btn_outline_border_color');
		}

		echo sienna_mikado_dynamic_css($outline_selector, $outline_styles);

		//outline hover styles
		if(sienna_mikado_options()->getOptionValue('btn_outline_hover_text_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-color):hover',
				array('color' => sienna_mikado_options()->getOptionValue('btn_outline_hover_text_color').'!important')
			);
		}

		if(sienna_mikado_options()->getOptionValue('btn_outline_hover_bg_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-bg):hover',
				array('background-color' => sienna_mikado_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
			);
		}

		if(sienna_mikado_options()->getOptionValue('btn_outline_hover_border_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-border-hover):hover',
				array('border-color' => sienna_mikado_options()->getOptionValue('btn_outline_hover_border_color').'!important')
			);
		}
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_button_outline_styles');
}

if(!function_exists('sienna_mikado_button_solid_styles')) {
	/**
	 * Generate styles for solid type buttons
	 */
	function sienna_mikado_button_solid_styles() {
		//solid styles
		$solid_selector = '.mkdf-btn.mkdf-btn-solid';
		$solid_styles   = array();

		if(sienna_mikado_options()->getOptionValue('btn_solid_text_color')) {
			$solid_styles['color'] = sienna_mikado_options()->getOptionValue('btn_solid_text_color');
		}

		if(sienna_mikado_options()->getOptionValue('btn_solid_border_color')) {
			$solid_styles['border-color'] = sienna_mikado_options()->getOptionValue('btn_solid_border_color');
		}

		if(sienna_mikado_options()->getOptionValue('btn_solid_bg_color')) {
			$solid_styles['background-color'] = sienna_mikado_options()->getOptionValue('btn_solid_bg_color');
		}

		echo sienna_mikado_dynamic_css($solid_selector, $solid_styles);

		//solid hover styles
		if(sienna_mikado_options()->getOptionValue('btn_solid_hover_text_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-color):hover',
				array('color' => sienna_mikado_options()->getOptionValue('btn_solid_hover_text_color').'!important')
			);
		}

		if(sienna_mikado_options()->getOptionValue('btn_solid_hover_bg_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-bg):hover',
				array('background-color' => sienna_mikado_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
			);
		}

		if(sienna_mikado_options()->getOptionValue('btn_solid_hover_border_color')) {
			echo sienna_mikado_dynamic_css(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-bg):hover',
				array('border-color' => sienna_mikado_options()->getOptionValue('btn_solid_hover_border_color').'!important')
			);
		}
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_button_solid_styles');
}