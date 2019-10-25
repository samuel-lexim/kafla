<?php
if(!function_exists('sienna_mikado_layerslider_overrides')) {
	/**
	 * Disables Layer Slider auto update box
	 */
	function sienna_mikado_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'sienna_mikado_layerslider_overrides');
}
?>