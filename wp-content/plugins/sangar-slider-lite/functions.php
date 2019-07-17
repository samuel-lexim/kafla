<?php
/**
 * Sangar slider functions
 * this will run after pass the PHP version check
 */

if ( ! defined( 'SANGAR_SLIDER_VERSION' ) ) {
	define( 'SANGAR_SLIDER_VERSION', '1.3.1' );
	define( 'SANGAR_SLIDER_DIR_NAME', str_replace( '/sangar-slider.php', '', plugin_basename( __FILE__ ) ) );
	define( 'SANGAR_SLIDER_DIR_PATH', plugin_dir_path( __FILE__ ) );
	define( 'SANGAR_SLIDER_DIR_URL', plugin_dir_url( __FILE__ ) );

	// Sangar Slider Addons
	add_filter(
		'sangar_slider_addons', function( $args ) {

			$args['sangar_slider'] = array(
				'name'            => 'Basic Slider',
				'description'     => 'Create stuning slider using build in WYSIWYG editor',
				'class-name'      => 'ssliderGenerateAddonBasic',
				'directory'       => plugin_dir_path( __FILE__ ) . 'free-basic-slider/functions.php',
				'default-options' => plugin_dir_path( __FILE__ ) . 'free-basic-slider/default.php',
			);

			return $args;
		}
	);
}

$sangar_slider_version = 'Lite';

require_once plugin_dir_path( __FILE__ ) . 'sangar-core/activate.php';
require_once plugin_dir_path( __FILE__ ) . 'elements/default-buttons.php';
require_once plugin_dir_path( __FILE__ ) . 'elements/default-templates.php';
require_once plugin_dir_path( __FILE__ ) . 'elements/default-pattern-images.php';
require_once plugin_dir_path( __FILE__ ) . 'tonjoo-notice.php';

/**
 * Display a notice that can be dismissed
 */
add_action( 'admin_notices', 'sslider_lite_notice' );
function sslider_lite_notice() {
	global $current_user;

	$user_id             = $current_user->ID;
	$ignore_notice       = get_user_meta( $user_id, 'sslider_lite_ignore_notice', true );
	$ignore_count_notice = get_user_meta( $user_id, 'sslider_lite_ignore_count_notice', true );
	$max_count_notice    = 15;

	// if usermeta(ignore_count_notice) is not exist
	if ( $ignore_count_notice == '' ) {
		add_user_meta( $user_id, 'sslider_lite_ignore_count_notice', $max_count_notice, true );

		$ignore_count_notice = 0;
	}

	// display the notice or not
	if ( $ignore_notice == 'forever' ) {
		$is_ignore_notice = true;
	} elseif ( $ignore_notice == 'later' && $ignore_count_notice < $max_count_notice ) {
		$is_ignore_notice = true;

		update_user_meta( $user_id, 'sslider_lite_ignore_count_notice', intval( $ignore_count_notice ) + 1 );
	} else {
		$is_ignore_notice = false;
	}

	/* Check that the user hasn't already clicked to ignore the message & if premium not installed */
	if ( ! $is_ignore_notice && ! function_exists( 'is_sslider_lite_exist' ) ) {
		echo '<div class="updated"><p>';

		printf(
			__( 'Unlock more preset , themes and layer editor. %1$s Get all features of Sangar Slider Pro ! %2$s Do not bug me again %3$s Not Now %4$s', SANGAR_SLIDER_VERSION ),
			'<a href="http://sangarslider.com/wordpress-pro" target="_blank">',
			'</a><span style="float:right;"><a href="?sslider_lite_nag_ignore=forever" style="color:#a00;">',
			'</a> <a href="?sslider_lite_nag_ignore=later" class="button button-primary" style="margin:-5px -5px 0 5px;vertical-align:baseline;">',
			'</a></span>'
		);

		echo '</p></div>';
	}
}

add_action( 'admin_init', 'sslider_lite_nag_ignore' );
function sslider_lite_nag_ignore() {
	global $current_user;
	$user_id = $current_user->ID;

	// If user clicks to ignore the notice, add that to their user meta
	if ( isset( $_GET['sslider_lite_nag_ignore'] ) && $_GET['sslider_lite_nag_ignore'] == 'forever' ) {
		update_user_meta( $user_id, 'sslider_lite_ignore_notice', 'forever' );

		/**
		 * Redirect
		 */
		$location = admin_url( 'admin.php?page=sangar_slider_admin' ) . '&settings-updated=true';
		echo "<meta http-equiv='refresh' content='0;url=$location' />";
		echo '<h2>Loading...</h2>';
		exit();
	} elseif ( isset( $_GET['sslider_lite_nag_ignore'] ) && $_GET['sslider_lite_nag_ignore'] == 'later' ) {
		update_user_meta( $user_id, 'sslider_lite_ignore_notice', 'later' );
		update_user_meta( $user_id, 'sslider_lite_ignore_count_notice', 0 );

		$total_ignore_notice = get_user_meta( $user_id, 'sslider_lite_ignore_count_notice_total', true );

		if ( $total_ignore_notice == '' ) {
			$total_ignore_notice = 0;
		}

		update_user_meta( $user_id, 'sslider_lite_ignore_count_notice_total', intval( $total_ignore_notice ) + 1 );

		if ( intval( $total_ignore_notice ) >= 5 ) {
			update_user_meta( $user_id, 'sslider_lite_ignore_notice', 'forever' );
		}

		/**
		 * Redirect
		 */
		$location = admin_url( 'admin.php?page=sangar_slider_admin' ) . '&settings-updated=true';
		echo "<meta http-equiv='refresh' content='0;url=$location' />";
		echo '<h2>Loading...</h2>';
		exit();
	}
}
