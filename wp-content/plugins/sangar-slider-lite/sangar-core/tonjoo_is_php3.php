<?php
/**
 * This plugin only work on PHP version 5.3 or higher
 */
if (! defined('TONJOO_IS_PHP3'))
{
	// PHP_VERSION_ID
	if (! defined('PHP_VERSION_ID')) {
	    $version = explode('.', PHP_VERSION);
	    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	}

	// Check Version
	if(PHP_VERSION_ID < 50300)
	{
		$str = '<h1><strong>PHP VERSION COMPATIBILITY</strong></h1>';
		$str.= '<p>Your PHP version is too old! (<i>' . PHP_VERSION . '</i>) <p>';
		$str.= '<p>To use this plugin, please upgrade your PHP at least to version <strong>5.3</strong></p>';
		$str.= '<p><a class="button button-primary" href='.admin_url('plugins.php').'>Back to Plugin Page</a></p>';
	    
	    wp_die($str);
	} 
	else {
		if (! defined('TONJOO_IS_PHP3')) define('TONJOO_IS_PHP3',true);
	}
}