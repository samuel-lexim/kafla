<?php

add_filter('sangar_slider_presets','sangar_slider_presets');
function sangar_slider_presets($args)
{
	$preset_path = plugin_dir_path( __FILE__ ) . "presets/";
	$preset_url = plugin_dir_url( __FILE__ ) . "presets/";
	
	$args['1_1'] = array(
		'name' => '1_1',
		'cover' => $preset_url . '1_1/cover.jpg',
		'preset' => $preset_path . '1_1/preset.txt'
	);

	$args['1_1_2'] = array(
		'name' => '1_1_2',
		'cover' => $preset_url . '1_1_2/cover.jpg',
		'preset' => $preset_path . '1_1_2/preset.txt'
	);

	$args['1_1_3'] = array(
		'name' => '1_1_3',
		'cover' => $preset_url . '1_1_3/cover.jpg',
		'preset' => $preset_path . '1_1_3/preset.txt'
	);

	return $args;
}