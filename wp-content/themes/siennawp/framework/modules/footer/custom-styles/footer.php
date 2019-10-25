<?php

if(!function_exists('sienna_mikado_footer_bg_image_styles')) {
	/**
	 * Outputs background image styles for footer
	 */
	function sienna_mikado_footer_bg_image_styles() {
		$background_image = sienna_mikado_options()->getOptionValue('footer_background_image');

	    if($background_image !== '') {
			$footer_bg_image_styles['background-image'] = 'url('.$background_image.')';

		    echo sienna_mikado_dynamic_css('body.mkdf-footer-with-bg-image .mkdf-page-footer', $footer_bg_image_styles);
	    }
    }

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_footer_bg_image_styles');
}

if(!function_exists('sienna_mikado_footer_bottom_border_styles')) {
	/**
	 * Outputs custom styles for bottom footer border
	 */
	function sienna_mikado_footer_bottom_border_styles() {
		$border_styles = array();

		$border_enabled = sienna_mikado_options()->getOptionValue('enable_footer_bottom_border') === 'yes';

		if(!$border_enabled) {
			return;
		}

		$border_width = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('footer_bottom_border_width'));

		if($border_width === '') {
			return;
		}

		$border_styles['border-top-width'] = $border_width.'px';
		$selector = 'body.mkdf-footer-bottom-border-enabled .mkdf-footer-bottom-holder .mkdf-footer-bottom-holder-inner';
		echo sienna_mikado_dynamic_css($selector, $border_styles);
    }

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_footer_bottom_border_styles');
}