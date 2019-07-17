<?php
/**
 * Plugin Name: Sangar Slider Lite
 * Plugin URI: https://tonjoo.com/addons/sangar-slider-lite
 * Description: Lite version of Sangar Slider, the modern WordPress slideshow for your project.
 * Version: 1.3.2
 * Author: tonjoo
 * Author URI: http://www.tonjoo.com/
 * License: Sangar slider is available under dual license, GPLv2 and Tonjoo License
 * Contributor: Haris Ainur Rozak, Todi Adiyatmo Wijoyo
 */

require_once plugin_dir_path( __FILE__ ) . 'sangar-core/tonjoo_is_php3.php';
if ( defined( 'TONJOO_IS_PHP3' ) ) {
	require_once 'functions.php';
}
