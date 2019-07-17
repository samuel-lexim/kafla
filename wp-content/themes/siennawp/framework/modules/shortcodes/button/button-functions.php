<?php

if(!function_exists('sienna_mikado_get_button_html')) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function sienna_mikado_get_button_html($params) {
		$button_html = sienna_mikado_execute_shortcode('mkdf_button', $params);
		$button_html = str_replace("\n", '', $button_html);

		return $button_html;
	}
}

if(!function_exists('sienna_mikado_get_btn_hover_animation_types')) {
	/**
	 * @param bool $empty_val
	 *
	 * @return array
	 */
	function sienna_mikado_get_btn_hover_animation_types($empty_val = false) {
		$types = array(
			'disable'          => 'Disable Animation',
			'fill-from-top'    => 'Fill From Top',
			'fill-from-left'   => 'Fill From Left',
			'fill-from-right'  => 'Fill From Right',
			'fill-from-center' => 'Fill From Center'
		);

		if($empty_val) {
			$types = array_merge(array(
				'' => 'Default'
			), $types);
		}

		return $types;
	}
}

if(!function_exists('mkdf_get_btn_types')) {
	function sienna_mikado_get_btn_types($empty_val = false) {
		$types = array(
			'solid' => 'Solid',
			'white' => 'White',
			'black' => 'Black'
		);

		if($empty_val) {
			$types = array_merge(array(
				'' => 'Default'
			), $types);
		}

		return $types;
	}
}