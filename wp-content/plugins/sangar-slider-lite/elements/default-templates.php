<?php

add_filter('sangar_slider_templates','sangar_slider_default_templates');
function sangar_slider_default_templates($args)
{
	$themes = array('default');

	// Horizontal No Pagination
	$args['horizontal-no-pagination'] = array(
		'name' => 'Horizontal No Pagination',
		'themesAvailable' => $themes,
		'config' => array(
			'animation' => 'horizontal-slide',
			'pagination' => 'none'
		)
	);

	// Horizontal Bullet Pagination
	$args['horizontal-bullet-pagination'] = array(
		'name' => 'Horizontal Bullet Pagination',
		'themesAvailable' => $themes,
		'config' => array(
			'animation' => 'horizontal-slide',
			'pagination' => 'bullet'
		)
	);

	// Horizontal Number Pagination
	$args['horizontal-number-pagination'] = array(
		'name' => 'Horizontal Number Pagination',
		'themesAvailable' => $themes,
		'config' => array(
			'animation' => 'horizontal-slide',
			'pagination' => 'bullet',
			'paginationBulletNumber' => 'true'
		)
	);

	return $args;
}