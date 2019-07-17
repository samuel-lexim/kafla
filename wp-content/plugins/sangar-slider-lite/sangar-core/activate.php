<?php

register_activation_hook( plugin_dir_path( __DIR__ ) . 'sangar-slider.php', 'sslider_activate');

if(! function_exists('sslider_activate'))
{
	define('SANGAR_SLIDER_ACTIVATED',$sangar_slider_version);

    function sslider_activate() { /* silent is golden */ }

    add_action('plugins_loaded','sangar_slider_plugins_loaded_on_activated');
    function sangar_slider_plugins_loaded_on_activated() {
    	require_once( plugin_dir_path( __FILE__ ) . 'functions.php');
    }
}
else
{
    deactivate_plugins( plugin_dir_path( __DIR__ ) . 'sangar-slider.php' );

    $str = '<p><strong>Sangar Slider '.SANGAR_SLIDER_ACTIVATED.'</strong> is still active! <br>';
    $str.= 'Please <strong>Deactivate</strong> it first before activate this '.$sangar_slider_version.' version.</p>';
    $str.= '<p><a class="button button-primary" href='.admin_url('plugins.php').'>Back to Plugin Page</a></p>';
    
    wp_die($str);
}