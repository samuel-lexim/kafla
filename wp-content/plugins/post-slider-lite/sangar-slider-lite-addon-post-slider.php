<?php
/**
 * Plugin Name: Sangar Slider Lite - Addon Post Slider
 * Plugin URI: https://tonjoo.com/addons/sangar-slider
 * Description: Addon post slideshow for Sangar Slider Lite.
 * Version: 1.3
 * Author: tonjoo
 * Author URI: http://www.tonjoo.com/
 * License: Sangar slider is available under dual license, GPLv2 and Tonjoo License
 * Contributor: Haris Ainur Rozak, Todi Adiyatmo Wijoyo
 */

define('SSLIDER_POST_SLIDER_VERSION','1.3');

// Sangar Slider Addons	
function sangar_slider_lite_addons_post($args)
{ 
	$args['sangar_slider_post'] = array(
		'name' => 'Post Slider',
		'description' => 'Convert your posts into slider in 4 easy step !',
		'class-name' => 'ssliderGenerateAddonPost',
		'directory' => plugin_dir_path(__FILE__) . 'functions.php',
		'default-options' => plugin_dir_path(__FILE__) . 'default.php'
	);

	return $args; 
}
add_filter('sangar_slider_addons', 'sangar_slider_lite_addons_post');

// activation hook
register_activation_hook(__FILE__, 'sangar_slider_post_activate');
function sangar_slider_post_activate()
{
	if(! defined('SANGAR_SLIDER_ACTIVATED') || constant('SANGAR_SLIDER_ACTIVATED') != 'Lite')
	{
		deactivate_plugins(__FILE__);

	    $str = '<p><strong>Sangar Slider Lite is required to activate this plugin</strong></p>';
	    $str.= '<p>Download the Sangar Slider Lite from <a href="https://wordpress.org/plugins/sangar-slider-lite" target="_blank">WordPress Site</a></p>';
	    $str.= '<p><a class="button button-primary" href='.admin_url('plugins.php').'>Back to Plugin Page</a></p>';
	    
	    wp_die($str);
	}
}
