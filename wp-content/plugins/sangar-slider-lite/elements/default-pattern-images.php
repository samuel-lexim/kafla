<?php

add_filter('sangar_slider_pattern_images','sangar_slider_pattern_images');
function sangar_slider_pattern_images($args)
{
	$pattern_url = plugin_dir_url( __FILE__ ) . "pattern-images/";
	
	$args['Brick'] = array(
		'name' => 'Brick pattern',
		'url' => $pattern_url . 'overlay_brick.png',
	);

	$args['Carbon'] = array(
		'name' => 'Carbon pattern',
		'url' => $pattern_url . 'overlay_carbon.png',
	);

	$args['Cross'] = array(
		'name' => 'Cross pattern',
		'url' => $pattern_url . 'overlay_cross.png',
	);

	$args['Diamond'] = array(
		'name' => 'Diamond pattern',
		'url' => $pattern_url . 'overlay_diamond.png',
	);

	$args['Dot'] = array(
		'name' => 'Dot pattern',
		'url' => $pattern_url . 'overlay_dot.png',
	);

	$args['Geometric'] = array(
		'name' => 'Geometric pattern',
		'url' => $pattern_url . 'overlay_geometric.png',
	);

	$args['Grid'] = array(
		'name' => 'Grid pattern',
		'url' => $pattern_url . 'overlay_grid.png',
	);

	$args['Hexabumb'] = array(
		'name' => 'Hexabumb pattern',
		'url' => $pattern_url . 'overlay_hexabumb.png',
	);

	$args['Nami'] = array(
		'name' => 'Nami pattern',
		'url' => $pattern_url . 'overlay_nami.png',
	);

	$args['Outlets'] = array(
		'name' => 'Outlets pattern',
		'url' => $pattern_url . 'overlay_outlets.png',
	);

	$args['Project Paper'] = array(
		'name' => 'Project Paper pattern',
		'url' => $pattern_url . 'overlay_project_paper.png',
	);

	return $args;
}