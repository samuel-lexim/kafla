<?php

add_filter('sangar_slider_buttons','sangar_slider_default_buttons');
function sangar_slider_default_buttons($args)
{
	$buttons_url = plugin_dir_url( __FILE__ ) . "buttons/";
	$init_name = 'sslider-buttonskin-';
	
	$args[$init_name . 'none'] = array(
		'name' => 'None',
		'url' => $buttons_url . $init_name . 'none.png'
	);

	$args[$init_name . 'black'] = array(
		'name' => 'Black',
		'url' => $buttons_url . $init_name . 'black.png'
	);

	$args[$init_name . 'white'] = array(
		'name' => 'White',
		'url' => $buttons_url . $init_name . 'white.png'
	);

	return $args;
}