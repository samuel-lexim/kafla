<?php

if(!function_exists('sienna_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function sienna_mikado_is_responsive_on() {
		return sienna_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}