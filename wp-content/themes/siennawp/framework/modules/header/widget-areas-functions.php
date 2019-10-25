<?php

if(!function_exists('sienna_mikado_register_top_header_areas')) {
	/**
	 * Registers widget areas for top header bar when it is enabled
	 */
	function sienna_mikado_register_top_header_areas() {
		$top_bar_layout = sienna_mikado_options()->getOptionValue('top_bar_layout');

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Left', 'sienna'),
			'id'            => 'mkdf-top-bar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget"><div class="mkdf-top-bar-widget-inner">',
			'after_widget'  => '</div></div>'
		));

		//register this widget area only if top bar layout is three columns
		if($top_bar_layout === 'three-columns') {
			register_sidebar(array(
				'name'          => esc_html__('Top Bar Center', 'sienna'),
				'id'            => 'mkdf-top-bar-center',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget"><div class="mkdf-top-bar-widget-inner">',
				'after_widget'  => '</div></div>'
			));
		}

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Right', 'sienna'),
			'id'            => 'mkdf-top-bar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget"><div class="mkdf-top-bar-widget-inner">',
			'after_widget'  => '</div></div>'
		));
	}

	add_action('widgets_init', 'sienna_mikado_register_top_header_areas');
}

if(!function_exists('sienna_mikado_header_standard_widget_areas')) {
	/**
	 * Registers widget areas for standard header type
	 */
	function sienna_mikado_header_standard_widget_areas() {
		if(sienna_mikado_options()->getOptionValue('header_type') == 'header-standard') {
			register_sidebar(array(
				'name'          => esc_html__('Right From Main Menu', 'sienna'),
				'id'            => 'mkdf-right-from-main-menu',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-main-menu-widget"><div class="mkdf-right-from-main-menu-widget-inner">',
				'after_widget'  => '</div></div>',
				'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'sienna')
			));
		}
	}

	add_action('widgets_init', 'sienna_mikado_header_standard_widget_areas');
}

if(!function_exists('sienna_mikado_register_mobile_header_areas')) {
	/**
	 * Registers widget areas for mobile header
	 */
	function sienna_mikado_register_mobile_header_areas() {
		if(sienna_mikado_is_responsive_on()) {
			register_sidebar(array(
				'name'          => esc_html__('Right From Mobile Logo', 'sienna'),
				'id'            => 'mkdf-right-from-mobile-logo',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-mobile-logo">',
				'after_widget'  => '</div>',
				'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'sienna')
			));
		}
	}

	add_action('widgets_init', 'sienna_mikado_register_mobile_header_areas');
}

if(!function_exists('sienna_mikado_register_sticky_header_areas')) {
	/**
	 * Registers widget area for sticky header
	 */
	function sienna_mikado_register_sticky_header_areas() {
		if(in_array(sienna_mikado_options()->getOptionValue('header_behaviour'), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		))) {
			register_sidebar(array(
				'name'          => esc_html__('Sticky Right', 'sienna'),
				'id'            => 'mkdf-sticky-right',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-sticky-right-widget"><div class="mkdf-sticky-right-widget-inner">',
				'after_widget'  => '</div></div>',
				'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'sienna')
			));
		}
	}

	add_action('widgets_init', 'sienna_mikado_register_sticky_header_areas');
}