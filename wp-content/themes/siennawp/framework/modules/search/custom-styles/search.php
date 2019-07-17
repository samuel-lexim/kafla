<?php

if(!function_exists('sienna_mikado_search_covers_header_style')) {

	function sienna_mikado_search_covers_header_style() {

		if(sienna_mikado_options()->getOptionValue('search_height') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-animated .mkdf-form-holder-outer, .mkdf-search-slide-header-bottom .mkdf-form-holder-outer, .mkdf-search-slide-header-bottom', array(
				'height' => sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_height')).'px'
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_covers_header_style');

}

if(!function_exists('sienna_mikado_search_opener_icon_size')) {

	function sienna_mikado_search_opener_icon_size() {

		if(sienna_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener', array(
				'font-size' => sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('header_search_icon_size')).'px'
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_opener_icon_size');

}

if(!function_exists('sienna_mikado_search_opener_icon_colors')) {

	function sienna_mikado_search_opener_icon_colors() {

		if(sienna_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener', array(
				'color' => sienna_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if(sienna_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if(sienna_mikado_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => sienna_mikado_options()->getOptionValue('header_light_search_icon_color').' !important'
			));
		}

		if(sienna_mikado_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('header_light_search_icon_hover_color').' !important'
			));
		}

		if(sienna_mikado_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => sienna_mikado_options()->getOptionValue('header_dark_search_icon_color').' !important'
			));
		}
		if(sienna_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('header_dark_search_icon_hover_color').' !important'
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_opener_icon_colors');

}

if(!function_exists('sienna_mikado_search_opener_icon_background_colors')) {

	function sienna_mikado_search_opener_icon_background_colors() {

		if(sienna_mikado_options()->getOptionValue('search_icon_background_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener', array(
				'background-color' => sienna_mikado_options()->getOptionValue('search_icon_background_color')
			));
		}

		if(sienna_mikado_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'background-color' => sienna_mikado_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_opener_icon_background_colors');
}

if(!function_exists('sienna_mikado_search_opener_text_styles')) {

	function sienna_mikado_search_opener_text_styles() {
		$text_styles = array();

		if(sienna_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = sienna_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_icon_text_fontsize')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_icon_text_lineheight')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = sienna_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('search_icon_text_google_fonts')).', sans-serif';
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = sienna_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = sienna_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if(!empty($text_styles)) {
			echo sienna_mikado_dynamic_css('.mkdf-search-icon-text', $text_styles);
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => sienna_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_opener_text_styles');
}

if(!function_exists('sienna_mikado_search_opener_spacing')) {

	function sienna_mikado_search_opener_spacing() {
		$spacing_styles = array();

		if(sienna_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_padding_left')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_padding_right')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_margin_left')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_margin_right')).'px';
		}

		if(!empty($spacing_styles)) {
			echo sienna_mikado_dynamic_css('.mkdf-search-opener', $spacing_styles);
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_opener_spacing');
}

if(!function_exists('sienna_mikado_search_bar_background')) {

	function sienna_mikado_search_bar_background() {

		if(sienna_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-header-bottom, .mkdf-search-cover, .mkdf-search-fade .mkdf-fullscreen-search-holder .mkdf-fullscreen-search-table, .mkdf-fullscreen-search-overlay, .mkdf-search-slide-window-top, .mkdf-search-slide-window-top input[type="text"]', array(
				'background-color' => sienna_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_bar_background');
}

if(!function_exists('sienna_mikado_search_text_styles')) {

	function sienna_mikado_search_text_styles() {
		$text_styles = array();

		if(sienna_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = sienna_mikado_options()->getOptionValue('search_text_color');
		}
		if(sienna_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_text_fontsize')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = sienna_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if(sienna_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('search_text_google_fonts')).', sans-serif';
		}
		if(sienna_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = sienna_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if(sienna_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = sienna_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if(sienna_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-header-bottom input[type="text"], .mkdf-search-cover input[type="text"], .mkdf-fullscreen-search-holder .mkdf-search-field, .mkdf-search-slide-window-top input[type="text"]', $text_styles);
		}
		if(sienna_mikado_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-disabled input[type="text"]::-webkit-input-placeholder, .mkdf-search-slide-header-bottom.mkdf-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => sienna_mikado_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_text_styles');
}

if(!function_exists('sienna_mikado_search_label_styles')) {

	function sienna_mikado_search_label_styles() {
		$text_styles = array();

		if(sienna_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = sienna_mikado_options()->getOptionValue('search_label_text_color');
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_label_text_fontsize')).'px';
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = sienna_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('search_label_text_google_fonts')).', sans-serif';
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = sienna_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = sienna_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if(sienna_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_label_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo sienna_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-label', $text_styles);
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_label_styles');
}

if(!function_exists('sienna_mikado_search_icon_styles')) {

	function sienna_mikado_search_icon_styles() {

		if(sienna_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top > i, .mkdf-search-slide-header-bottom .mkdf-search-submit i, .mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'color' => sienna_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top > i:hover, .mkdf-search-slide-header-bottom .mkdf-search-submit i:hover, .mkdf-fullscreen-search-holder .mkdf-search-submit:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-disabled .mkdf-search-submit i, .mkdf-search-slide-header-bottom.mkdf-disabled .mkdf-search-submit i:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if(sienna_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top > i, .mkdf-search-slide-header-bottom .mkdf-search-submit i, .mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'font-size' => sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_icon_size')).'px'
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_icon_styles');
}

if(!function_exists('sienna_mikado_search_close_icon_styles')) {

	function sienna_mikado_search_close_icon_styles() {

		if(sienna_mikado_options()->getOptionValue('search_close_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i, .mkdf-search-cover .mkdf-search-close i, .mkdf-fullscreen-search-close i', array(
				'color' => sienna_mikado_options()->getOptionValue('search_close_color')
			));
		}
		if(sienna_mikado_options()->getOptionValue('search_close_hover_color') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i:hover, .mkdf-search-cover .mkdf-search-close i:hover, .mkdf-fullscreen-search-close i:hover', array(
				'color' => sienna_mikado_options()->getOptionValue('search_close_hover_color')
			));
		}
		if(sienna_mikado_options()->getOptionValue('search_close_size') !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i, .mkdf-search-cover .mkdf-search-close i, .mkdf-fullscreen-search-close i', array(
				'font-size' => sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('search_close_size')).'px'
			));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_search_close_icon_styles');
}

if(!function_exists('sienna_mikado_fullscreen_search_styles')) {
	function sienna_mikado_fullscreen_search_styles() {
		$bg_image = sienna_mikado_options()->getOptionValue('fullscreen_search_background_image');
		$selector = '.mkdf-search-fade .mkdf-fullscreen-search-holder';
		$styles   = array();

		if(!$bg_image) {
			return;
		}

		$styles['background-image'] = 'url('.$bg_image.')';

		echo sienna_mikado_dynamic_css($selector, $styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_fullscreen_search_styles');
}
