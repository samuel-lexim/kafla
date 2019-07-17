<?php // @codingStandardsIgnoreLine.
/**
 * Plugin Name: Google Maps Bank
 * Plugin URI: https://google-maps-bank.tech-banker.com/
 * Description: Google Maps provides directions, locations, markers, interactive maps, and satellite/aerial imagery of anything. It's more than just a Map.
 * Author: Tech Banker
 * Author URI: https://google-maps-bank.tech-banker.com/
 * Version: 2.0.17
 * License: GPLv3
 * Text Domain: google-maps-bank
 * Domain Path: /languages
 *
 * @package google-maps-bank
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}// Exit if accessed directly
/* Constant Declaration */
if ( ! defined( 'GOOGLE_MAP_FILE' ) ) {
	define( 'GOOGLE_MAP_FILE', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GOOGLE_MAP_DIR_PATH' ) ) {
	define( 'GOOGLE_MAP_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GOOGLE_MAP_PLUGIN_DIRNAME' ) ) {
	define( 'GOOGLE_MAP_PLUGIN_DIRNAME', plugin_basename( dirname( __FILE__ ) ) );
}

if ( ! defined( 'GOOGLE_MAP_CONTENT_DIR' ) ) {
	define( 'GOOGLE_MAP_CONTENT_DIR', dirname( dirname( GOOGLE_MAP_DIR_PATH ) ) );
}
if ( ! defined( 'GOOGLE_MAP_CUSTOM_MARKER_ICON' ) ) {
	define( 'GOOGLE_MAP_CUSTOM_MARKER_ICON', plugins_url( plugin_basename( dirname( __FILE__ ) ) . '/assets/images/map-icons' ) );
}
if ( ! defined( 'GOOGLE_MAP_DEFAULT_MARKER_ICON' ) ) {
	define( 'GOOGLE_MAP_DEFAULT_MARKER_ICON', plugins_url( plugin_basename( dirname( __FILE__ ) ) . '/assets/global/img/marker-logo.png' ) );
}
if ( is_ssl() ) {
	if ( ! defined( 'TECH_BANKER_URL' ) ) {
		define( 'TECH_BANKER_URL', 'https://tech-banker.com' );
	}
	if ( ! defined( 'TECH_BANKER_SITE_URL' ) ) {
		define( 'TECH_BANKER_SITE_URL', 'https://google-maps-bank.tech-banker.com/' );
	}
	if ( ! defined( 'TECH_BANKER_SERVICES_URL' ) ) {
		define( 'TECH_BANKER_SERVICES_URL', 'https://tech-banker-services.org' );
	}
} else {
	if ( ! defined( 'TECH_BANKER_URL' ) ) {
		define( 'TECH_BANKER_URL', 'http://tech-banker.com' );
	}
	if ( ! defined( 'TECH_BANKER_SITE_URL' ) ) {
		define( 'TECH_BANKER_SITE_URL', 'https://google-maps-bank.tech-banker.com/' );
	}
	if ( ! defined( 'TECH_BANKER_SERVICES_URL' ) ) {
		define( 'TECH_BANKER_SERVICES_URL', 'http://tech-banker-services.org' );
	}
}
if ( ! defined( 'TECH_BANKER_STATS_URL' ) ) {
	define( 'TECH_BANKER_STATS_URL', 'http://stats.tech-banker-services.org' );
}
if ( ! defined( 'GOOGLE_MAPS_VERSION_NUMBER' ) ) {
	define( 'GOOGLE_MAPS_VERSION_NUMBER', '2.0.17' );
}

$memory_limit_google_map = intval( ini_get( 'memory_limit' ) );
if ( ! extension_loaded( 'suhosin' ) && $memory_limit_google_map < 512 ) {
	@ini_set( 'memory_limit', '512M' );// @codingStandardsIgnoreLine.
}
@ini_set( 'max_execution_time', 6000 );// @codingStandardsIgnoreLine.

if ( ! function_exists( 'install_script_for_google_map' ) ) {
	/**
	 * This function is used to create Tables in Database.
	 */
	function install_script_for_google_map() {
		global $wpdb;
		if ( is_multisite() ) {
			$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );// WPCS: db call ok, no-cache ok.
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );// @codingStandardsIgnoreLine.
				$version = get_option( 'google-maps-bank-version-number' );
				if ( $version < '2.0.1' ) {
					if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-install-script-google-maps.php' ) ) {
						include GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-install-script-google-maps.php';
					}
				}
				restore_current_blog();
			}
		} else {
			$version = get_option( 'google-maps-bank-version-number' );
			if ( $version < '2.0.1' ) {
				if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-install-script-google-maps.php' ) ) {
					include_once GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-install-script-google-maps.php';
				}
			}
		}
	}
}

if ( ! function_exists( 'google_maps' ) ) {
	/**
	 * This function is used to return Parent Table name with prefix.
	 */
	function google_maps() {
		global $wpdb;
		return $wpdb->prefix . 'google_maps';
	}
}

if ( ! function_exists( 'google_maps_meta' ) ) {
	/**
	 * This function is used to return Meta Table name with prefix.
	 */
	function google_maps_meta() {
		global $wpdb;
		return $wpdb->prefix . 'google_maps_meta';
	}
}

if ( ! function_exists( 'get_others_capabilities_google_maps' ) ) {
	/**
	 * This function is used to get all the roles available in WordPress.
	 */
	function get_others_capabilities_google_maps() {
		$user_capabilities = array();
		if ( function_exists( 'get_editable_roles' ) ) {
			foreach ( get_editable_roles() as $role_name => $role_info ) {
				foreach ( $role_info['capabilities'] as $capability => $values ) {
					if ( ! in_array( $capability, $user_capabilities, true ) ) {
						array_push( $user_capabilities, $capability );
					}
				}
			}
		} else {
			$user_capabilities = array(
				'manage_options',
				'edit_plugins',
				'edit_posts',
				'publish_posts',
				'publish_pages',
				'edit_pages',
				'read',
			);
		}
		return $user_capabilities;
	}
}

/**
 * This function is used to create link for Pro Editions.
 *
 * @param array $plugin_link .
 */
function google_maps_bank_action_links( $plugin_link ) {
	$plugin_link[] = '<a href="https://google-maps-bank.tech-banker.com" style="color: red;font-weight: bold;" target="_blank">Go Pro!</a>';
	return $plugin_link;
}
if ( ! function_exists( 'google_maps_bank_settings_link' ) ) {
	/**
	 * This function is used to add settings link.
	 *
	 * @param array $action .
	 */
	function google_maps_bank_settings_link( $action ) {
		global $wpdb;
		$user_role_permission = get_others_capabilities_google_maps();
		$settings_link        = '<a href = "' . admin_url( 'admin.php?page=gmb_google_maps' ) . '"> Settings </a>';
		array_unshift( $action, $settings_link );
		return $action;
	}
}
$version = get_option( 'google-maps-bank-version-number' );
if ( $version >= '2.0.1' ) {

	if ( ! function_exists( 'check_user_roles_google_map' ) ) {
		/**
		 * This function is used for checking roles of different users.
		 */
		function check_user_roles_google_map() {
			global $current_user;
			$user = $current_user ? new WP_User( $current_user ) : wp_get_current_user();
			return $user->roles ? $user->roles[0] : false;
		}
	}

	if ( ! function_exists( 'get_users_capabilities_google_map' ) ) {
		/**
		 * This function is used to get users capabilities.
		 */
		function get_users_capabilities_google_map() {
			global $wpdb;
			$roles_and_capabilities_data = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key = %s', 'roles_and_capabilities'
				)
			);// WPCS: db call ok, no-cache ok.
			$unserialized_capabilities   = maybe_unserialize( $roles_and_capabilities_data );
			$core_roles                  = array(
				'manage_options',
				'edit_plugins',
				'edit_posts',
				'publish_posts',
				'publish_pages',
				'edit_pages',
				'read',
			);
			return isset( $unserialized_capabilities['capabilities'] ) ? $unserialized_capabilities['capabilities'] : $core_roles;
		}
	}

	if ( is_admin() ) {
		if ( ! function_exists( 'backend_js_css_for_google_map' ) ) {
			/**
			 * This function is used for including css and js files for backend.
			 *
			 * @param string $hook .
			 */
			function backend_js_css_for_google_map( $hook ) {
				$pages_map_bank = array(
					'gmb_wizard_google_map',
					'gmb_google_maps',
					'gmb_add_map',
					'gmb_manage_overlays',
					'gmb_add_overlays',
					'gmb_layers',
					'gmb_manage_store',
					'gmb_add_store',
					'gmb_info_window',
					'gmb_directions',
					'gmb_store_locator',
					'gmb_map_customization',
					'gmb_custom_css',
					'gmb_shortcode',
					'gmb_other_settings',
					'gmb_roles_and_capabilities',
					'gmb_system_information',
				);
				global $wpdb;
				$other_settings             = $wpdb->get_var(
					$wpdb->prepare(
						'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s', 'other_settings'
					)
				);// WPCS: db call ok, no-cache ok.
				$other_settings_unserialize = maybe_unserialize( $other_settings );
				if ( isset( $_REQUEST['page'] ) ) {// WPCS: Input var ok, CSRF ok.
					if ( in_array( wp_unslash( $_REQUEST['page'] ), $pages_map_bank, true ) ) {// WPCS: Input var ok, CSRF ok.
						wp_enqueue_script( 'jquery' );
						wp_enqueue_script( 'jquery-ui-datepicker' );
						wp_enqueue_script( 'google-map-bootstrap.js', plugins_url( 'assets/global/plugins/custom/js/custom.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-jquery.validate.js', plugins_url( 'assets/global/plugins/validation/jquery.validate.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-jquery.datatables.js', plugins_url( 'assets/global/plugins/datatables/media/js/jquery.datatables.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-jquery.fngetfilterednodes.js', plugins_url( 'assets/global/plugins/datatables/media/js/fngetfilterednodes.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-toastr.js', plugins_url( 'assets/global/plugins/toastr/toastr.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-clipboard.js', plugins_url( 'assets/global/plugins/clipboard/clipboard.js', __FILE__ ) );
						wp_enqueue_script( 'google-map-colpick.js', plugins_url( 'assets/global/plugins/colorpicker/colpick.js', __FILE__ ) );
						wp_enqueue_style( 'google-map-simple-line-icons.css', plugins_url( 'assets/global/plugins/icons/icons.css', __FILE__ ) );
						wp_enqueue_style( 'google-map-components.css', plugins_url( 'assets/global/css/components.css', __FILE__ ) );
						if ( is_ssl() ) {
							wp_enqueue_script( 'google-map-maps_script.js', 'https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry,places,visualization&key=' . esc_attr( $other_settings_unserialize['other_api_key'] ) . '&language=' . $other_settings_unserialize['other_settings_map_language'] );
						} else {
							wp_enqueue_script( 'google-map-maps_script.js', 'http://maps.googleapis.com/maps/api/js?v=3&libraries=geometry,places,visualization&key=' . esc_attr( $other_settings_unserialize['other_api_key'] ) . '&language=' . $other_settings_unserialize['other_settings_map_language'] );
						}
						wp_enqueue_style( 'google-map-custom.css', plugins_url( 'assets/admin/layout/css/google-map-custom.css', __FILE__ ) );
						if ( is_rtl() ) {
							wp_enqueue_style( 'google-map-bootstrap.css', plugins_url( 'assets/global/plugins/custom/css/custom-rtl.css', __FILE__ ) );
							wp_enqueue_style( 'google-map-layout.css', plugins_url( 'assets/admin/layout/css/layout-rtl.css', __FILE__ ) );
							wp_enqueue_style( 'google-map-tech-banker-custom.css', plugins_url( 'assets/admin/layout/css/tech-banker-custom-rtl.css', __FILE__ ) );
						} else {
							wp_enqueue_style( 'google-map-bootstrap.css', plugins_url( 'assets/global/plugins/custom/css/custom.css', __FILE__ ) );
							wp_enqueue_style( 'google-map-layout.css', plugins_url( 'assets/admin/layout/css/layout.css', __FILE__ ) );
							wp_enqueue_style( 'google-map-tech-banker-custom.css', plugins_url( 'assets/admin/layout/css/tech-banker-custom.css', __FILE__ ) );
						}
						wp_enqueue_style( 'google-map-default.css', plugins_url( 'assets/admin/layout/css/themes/default.css', __FILE__ ) );
						wp_enqueue_style( 'google-map-toastr.min.css', plugins_url( 'assets/global/plugins/toastr/toastr.css', __FILE__ ) );
						wp_enqueue_style( 'google-map-jquery-ui.css', plugins_url( 'assets/global/plugins/datepicker/jquery-ui.css', __FILE__ ), false, '2.0', false );
						wp_enqueue_style( 'google-map-datatables.foundation.css', plugins_url( 'assets/global/plugins/datatables/media/css/datatables.foundation.css', __FILE__ ) );
						wp_enqueue_style( 'google-map-colpick.css', plugins_url( 'assets/global/plugins/colorpicker/colpick.css', __FILE__ ) );
					}
				}
			}
		}
		add_action( 'admin_enqueue_scripts', 'backend_js_css_for_google_map' );
	}

	if ( ! function_exists( 'frontend_js_css_for_google_map' ) ) {
		/**
		 * This function is used for including css and js files for frontend.
		 */
		function frontend_js_css_for_google_map() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'google-map-bootstrap.js', plugins_url( 'assets/global/plugins/custom/js/custom.js', __FILE__ ) );
			wp_enqueue_script( 'google-map-jquery.validate.js', plugins_url( 'assets/global/plugins/validation/jquery.validate.js', __FILE__ ) );
			wp_enqueue_style( 'google-map-simple-line-icons.css', plugins_url( 'assets/global/plugins/icons/icons.css', __FILE__ ) );
			wp_enqueue_style( 'google-map-components.css', plugins_url( 'assets/global/css/components.css', __FILE__ ) );
			wp_enqueue_style( 'google-map-custom.css', plugins_url( 'assets/admin/layout/css/google-map-custom.css', __FILE__ ) );
			if ( is_rtl() ) {
				wp_enqueue_style( 'google-map-bootstrap.css', plugins_url( 'assets/global/plugins/custom/css/custom-rtl.css', __FILE__ ) );
				wp_enqueue_style( 'google-map-layout.css', plugins_url( 'assets/admin/layout/css/layout-rtl.css', __FILE__ ) );
				wp_enqueue_style( 'google-map-tech-banker-custom.css', plugins_url( 'assets/admin/layout/css/tech-banker-custom-rtl.css', __FILE__ ) );
			} else {
				wp_enqueue_style( 'google-map-bootstrap.css', plugins_url( 'assets/global/plugins/custom/css/custom.css', __FILE__ ) );
				wp_enqueue_style( 'google-map-layout.css', plugins_url( 'assets/admin/layout/css/layout.css', __FILE__ ) );
				wp_enqueue_style( 'google-map-tech-banker-custom.css', plugins_url( 'assets/admin/layout/css/tech-banker-custom.css', __FILE__ ) );
			}
			wp_enqueue_style( 'google-map-default.css', plugins_url( 'assets/admin/layout/css/themes/default.css', __FILE__ ) );
		}
	}

	if ( ! function_exists( 'helper_file_for_google_map' ) ) {
		/**
		 * This function is used to create Class and Function to perform operations.
		 */
		function helper_file_for_google_map() {
			global $wpdb;
			$user_role_permission = get_users_capabilities_google_map();
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-google-maps.php' ) ) {
				include_once GOOGLE_MAP_DIR_PATH . 'lib/class-dbhelper-google-maps.php';
			}
		}
	}

	if ( ! function_exists( 'sidebar_menu_for_google_map' ) ) {
		/**
		 * This function is used to create Admin sidebar menus.
		 */
		function sidebar_menu_for_google_map() {
			global $wpdb, $current_user, $wp_version;
			$user_role_permission = get_users_capabilities_google_map();
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/translations.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'includes/translations.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/sidebar-menu.php' ) ) {
				include_once GOOGLE_MAP_DIR_PATH . 'lib/sidebar-menu.php';
			}
		}
	}

	if ( ! function_exists( 'topbar_menu_for_google_map' ) ) {
		/**
		 * This function is used for creating Top bar menu.
		 */
		function topbar_menu_for_google_map() {
			global $wpdb, $current_user, $wp_admin_bar;
			$roles_and_capabilities_data = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key = %s', 'roles_and_capabilities'
				)
			);// WPCS: db call ok, no-cache ok.
			$unserialized_capabilities   = maybe_unserialize( $roles_and_capabilities_data );
			if ( 'enable' === $unserialized_capabilities['google_map_top_bar_menu'] ) {
				$user_role_permission = get_users_capabilities_google_map();
				if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/translations.php' ) ) {
					include GOOGLE_MAP_DIR_PATH . 'includes/translations.php';
				}
				if ( get_option( 'google-map-bank-wizard-set-up' ) ) {
					if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/admin-bar-menu.php' ) ) {
						include_once GOOGLE_MAP_DIR_PATH . 'lib/admin-bar-menu.php';
					}
				}
			}
		}
	}

	if ( ! function_exists( 'plugin_load_textdomain_google_map' ) ) {
		/**
		 * This function is used to load the plugin's translated strings.
		 */
		function plugin_load_textdomain_google_map() {
			if ( function_exists( 'load_plugin_textdomain' ) ) {
				load_plugin_textdomain( 'google-maps-bank', false, GOOGLE_MAP_PLUGIN_DIRNAME . '/languages' );
			}
		}
	}

	if ( ! function_exists( 'google_map_shortcode' ) ) {
		/**
		 * This function is used to set the shortcode attributes.
		 *
		 * @param array $attr .
		 */
		function google_map_shortcode( $attr ) {
			$shortcode = extract(// @codingStandardsIgnoreLine.
				shortcode_atts(
					array(
						'map_id'                  => '',
						'maps_id'                 => '',
						'map_title'               => '',
						'map_description'         => '',
						'map_height'              => '',
						'map_width'               => '',
						'map_themes'              => '',
						'directions_header_title' => '',
						'display_text_directions' => '',
						'store_locator_title'     => '',
					), $attr
				)
			);
			ob_start();
			$random = mt_rand( 100, 10000 );
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/includes/translations.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/includes/translations.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/includes/queries.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/includes/queries.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/styles/css-generator.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/styles/css-generator.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/views/google-map.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/views/google-map.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/includes/themes.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/includes/themes.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/includes/footer.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'user-views/includes/footer.php';
			}
			$google_maps_output = ob_get_clean();
			wp_reset_query();// @codingStandardsIgnoreLine.
			return $google_maps_output;
		}
	}

	if ( ! function_exists( 'deactivation_function_for_google_map' ) ) {
		/**
		 * This function is used for executing the code on deactivation.
		 */
		function deactivation_function_for_google_map() {
			delete_option( 'google-map-bank-wizard-set-up' );
		}
	}

	if ( ! function_exists( 'ajax_library_for_google_maps_backend' ) ) {
		/**
		 * This function is used to register Ajax for backend.
		 */
		function ajax_library_for_google_maps_backend() {
			global $wpdb;
			$user_role_permission = get_users_capabilities_google_map();
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/translations.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'includes/translations.php';
			}
			if ( file_exists( GOOGLE_MAP_DIR_PATH . 'lib/action-library.php' ) ) {
				include GOOGLE_MAP_DIR_PATH . 'lib/action-library.php';
			}
		}
	}

	/**
	 * This function is used for validating ip address.
	 */

	if ( ! function_exists( 'validate_ip_google_map' ) ) {
		/**
		 * This function is used for validating ip address.
		 *
		 * @param integer $ip .
		 */
		function validate_ip_google_map( $ip ) {
			if ( strtolower( $ip ) === 'unknown' ) {
				return false;
			}
			$ip = ip2long( $ip );

			if ( false !== $ip && -1 !== $ip ) {
				$ip = sprintf( '%u', $ip );

				if ( $ip >= 0 && $ip <= 50331647 ) {
					return false;
				}
				if ( $ip >= 167772160 && $ip <= 184549375 ) {
					return false;
				}
				if ( $ip >= 2130706432 && $ip <= 2147483647 ) {
					return false;
				}
				if ( $ip >= 2851995648 && $ip <= 2852061183 ) {
					return false;
				}
				if ( $ip >= 2886729728 && $ip <= 2887778303 ) {
					return false;
				}
				if ( $ip >= 3221225984 && $ip <= 3221226239 ) {
					return false;
				}
				if ( $ip >= 3232235520 && $ip <= 3232301055 ) {
					return false;
				}
				if ( $ip >= 4294967040 ) {
					return false;
				}
			}
			return true;
		}
	}

	if ( ! function_exists( 'get_ip_address_google_map' ) ) {
		/**
		 * This function is used for getIpAddress.
		 */
		function get_ip_address_google_map() {
			static $ip = null;
			if ( isset( $ip ) ) {
				return $ip;
			}
			global $wpdb;
			$data                = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s', 'other_settings'
				)
			);// WPCS: db call ok, no-cache ok.
			$other_settings_data = maybe_unserialize( $data );
			switch ( $other_settings_data['ip_address_fetching_method'] ) {
				case 'REMOTE_ADDR':
					if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {// @codingStandardsIgnoreLine.
						if ( validate_ip_google_map( $_SERVER['REMOTE_ADDR'] ) ) {// @codingStandardsIgnoreLine.
							$ip = wp_unslash( $_SERVER['REMOTE_ADDR'] );// @codingStandardsIgnoreLine.
							return $ip;
						}
					}
					break;

				case 'HTTP_X_FORWARDED_FOR':
					if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {// WPCS: Input var ok.
						if ( strpos( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ), ',' ) !== false ) {// WPCS: Input var ok, sanitization ok.
							$iplist = explode( ',', wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );// WPCS: Input var ok, sanitization ok.
							foreach ( $iplist as $ip_address ) {
								if ( validate_ip_google_map( $ip_address ) ) {
									$ip = $ip_address;
									return $ip;
								}
							}
						} else {
							if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {// WPCS: Input var ok, sanitization ok.
								$ip = wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] );// WPCS: Input var ok, sanitization ok.
								return $ip;
							}
						}
					}
					break;

				case 'HTTP_X_REAL_IP':
					if ( isset( $_SERVER['HTTP_X_REAL_IP'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_X_REAL_IP'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_X_REAL_IP'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					break;

				case 'HTTP_CF_CONNECTING_IP':
					if ( isset( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_CF_CONNECTING_IP'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					break;

				default:
					if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_CLIENT_IP'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {// WPCS: Input var ok.
						if ( strpos( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ), ',' ) !== false ) {// WPCS: Input var ok, sanitization ok.
							$iplist = explode( ',', wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );// WPCS: Input var ok, sanitization ok.
							foreach ( $iplist as $ip_address ) {
								if ( validate_ip_google_map( $ip_address ) ) {
									$ip = $ip_address;
									return $ip;
								}
							}
						} else {
							if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {// WPCS: Input var ok, sanitization ok.
								$ip = wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] );// WPCS: Input var ok, sanitization ok.
								return $ip;
							}
						}
					}
					if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_X_FORWARDED'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_X_FORWARDED'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					if ( isset( $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_FORWARDED_FOR'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_FORWARDED_FOR'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {// WPCS: Input var ok.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['HTTP_FORWARDED'] ) ) ) {// WPCS: Input var ok, sanitization ok.
							$ip = wp_unslash( $_SERVER['HTTP_FORWARDED'] );// WPCS: Input var ok, sanitization ok.
							return $ip;
						}
					}
					if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {// @codingStandardsIgnoreLine.
						if ( validate_ip_google_map( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) ) {// @codingStandardsIgnoreLine.
							$ip = wp_unslash( $_SERVER['REMOTE_ADDR'] );// @codingStandardsIgnoreLine.
							return $ip;
						}
					}
					break;
			}
			return '127.0.0.1';
		}
	}

	if ( ! function_exists( 'get_ip_location_google_map' ) ) {
		/**
		 * This function is used to get ip location.
		 *
		 * @param string $ip_address .
		 */
		function get_ip_location_google_map( $ip_address ) {
			$core_data = '{"ip":"0.0.0.0","country_code":"","country_name":"","region_code":"","region_name":"","city":"","latitude":0,"longitude":0}';
			$apicall   = TECH_BANKER_SERVICES_URL . '/api/getipaddress.php?ip_address=' . $ip_address;
			if ( ! function_exists( 'curl_init' ) ) {
				$jsondata = @file_get_contents( $apicall );// @codingStandardsIgnoreLine.
			} else {
				$ch = curl_init();// @codingStandardsIgnoreLine.
				curl_setopt( $ch, CURLOPT_URL, $apicall );// @codingStandardsIgnoreLine.
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Accept: application/json' ) );// @codingStandardsIgnoreLine.
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );// @codingStandardsIgnoreLine.
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );// @codingStandardsIgnoreLine.
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );// @codingStandardsIgnoreLine.
				$jsondata = curl_exec( $ch );// @codingStandardsIgnoreLine.
			}
			return false === json_decode( $jsondata ) ? json_decode( $core_data ) : json_decode( $jsondata );
		}
	}

	if ( ! function_exists( 'google_maps_urlencode' ) ) {
		/**
		 * This function is used to replace htmlentities.
		 *
		 * @param string $string .
		 */
		function google_maps_urlencode( $string ) {
			$entities     = array( '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D' );
			$replacements = array( '!', '*', "'", '(', ')', ';', ':', '@', '&', '=', '+', '$', ',', '/', '?', '%', '#', '[', ']' );
			return str_replace( $entities, $replacements, urlencode( $string ) );// @codingStandardsIgnoreLine.
		}
	}

	if ( ! function_exists( 'google_maps_url_get_contents' ) ) {
		/**
		 * This function is used to get all content of url.
		 *
		 * @param string $url .
		 */
		function google_maps_url_get_contents( $url ) {
			if ( ! function_exists( 'curl_init' ) ) {
				$output = @file_get_contents( $url );// @codingStandardsIgnoreLine.
			} else {
				$curlHandler = curl_init();// @codingStandardsIgnoreLine.
				curl_setopt( $curlHandler, CURLOPT_URL, $url );// @codingStandardsIgnoreLine.
				curl_setopt( $curlHandler, CURLOPT_RETURNTRANSFER, true );// @codingStandardsIgnoreLine.
				$output = curl_exec( $curlHandler );// @codingStandardsIgnoreLine.
				curl_close( $curlHandler );// @codingStandardsIgnoreLine.
			}
			return $output;
		}
	}

	if ( ! function_exists( 'admin_functions_for_google_map' ) ) {
		/**
		 * This function is used for calling admin_init functions.
		 */
		function admin_functions_for_google_map() {
			install_script_for_google_map();
			helper_file_for_google_map();
		}
	}

	if ( ! function_exists( 'user_functions_for_google_maps' ) ) {
		/**
		 * This function is used for calling init functions.
		 */
		function user_functions_for_google_maps() {
			global $wpdb;
			$other_settings             = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s', 'other_settings'
				)
			);// WPCS: db call ok, no-cache ok.
			$other_settings_unserialize = maybe_unserialize( $other_settings );
			frontend_js_css_for_google_map();
			plugin_load_textdomain_google_map();
		}
	}

	if ( ! function_exists( 'add_map_shortcode_button' ) ) {
		/**
		 * This function is used to create the button in pages and posts.
		 */
		function add_map_shortcode_button() {
			echo '<a href="admin.php?page=gmb_shortcode" target="_blank" id="insert-map-shortcode" class="button" >' . esc_attr( __( 'Add Google Maps Bank Shortcode', 'google-maps-bank' ) ) . '</a>';
		}
	}

	if ( ! class_exists( 'MapWidget' ) ) {
		/**
		 * This class is used to add widget.
		 */
		class MapWidget extends WP_Widget {
			/**
			 * Public Constructor
			 */
			public function __construct() {
				parent::__construct(
					'MapWidget', __( 'Google Maps Bank', 'google-maps-bank' ), array( 'description' => __( 'Display Google Map', 'google-maps-bank' ) )
				);
			}

			/**
			 * This function is used to add widget form.
			 *
			 * @param array $instance .
			 */
			public function form( $instance ) {
				global $wpdb;
				$user_role_permission = get_users_capabilities_google_map();
				if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/includes/translations.php' ) ) {
					include GOOGLE_MAP_DIR_PATH . 'user-views/includes/translations.php';
				}
				if ( file_exists( GOOGLE_MAP_DIR_PATH . 'user-views/views/widget-form.php' ) ) {
					include GOOGLE_MAP_DIR_PATH . 'user-views/views/widget-form.php';
				}
			}

			/**
			 * This function is used to add widget form.
			 *
			 * @param array $args .
			 * @param array $instance .
			 */
			public function widget( $args, $instance ) {
				extract( $args, EXTR_SKIP );// @codingStandardsIgnoreLine.
				echo $before_widget;// WPCS: XSS ok.
				if ( isset( $instance['map_id'] ) ) {
					$map_id          = $instance['map_id'];
					$map_title       = $instance['title'];
					$map_description = '';
					$map_height      = $instance['mapHeight'];
					$map_width       = $instance['mapWidth'];
					$old_shortcode   = "[map_bank map_id=\"$map_id\" map_title=\"$map_title\" map_description=\"$map_description\" map_height=\"$map_height\" map_width=\"$map_width\" map_themes=\"default\"]";
					echo do_shortcode( $old_shortcode );
				}
				$shortcode_data = empty( $instance['shortcode'] ) ? ' ' : apply_filters( 'widget_google_maps_bank_shortcode', $instance['shortcode'] );
				if ( ! empty( $shortcode_data ) ) {
					$shortcode = $shortcode_data;
				}
				echo do_shortcode( $shortcode );
				echo $after_widget;// WPCS: XSS ok.
			}

			/**
			 * This function is used to add widget form.
			 *
			 * @param array $new_instance .
			 * @param array $old_instance .
			 */
			public function update( $new_instance, $old_instance ) {
				$instance              = $old_instance;
				$instance['shortcode'] = $new_instance['ux_txt_map_shortcode'];
				return $instance;
			}
		}
	}

	/* Hooks */
	/**
	 * This hook contains all admin_init functions.
	 */
	add_action( 'admin_init', 'admin_functions_for_google_map' );

	/**
	 * This hook is used for calling the function of sidebar menu.
	 */
	add_action( 'admin_menu', 'sidebar_menu_for_google_map' );

	/**
	 * This hook is used for calling the function of sidebar menu in case of multisite.
	 */
	add_action( 'network_admin_menu', 'sidebar_menu_for_google_map' );

	/**
	 * This hook is used for calling the function of topbar menu.
	 */
	add_action( 'admin_bar_menu', 'topbar_menu_for_google_map', 100 );

	/**
	 * This hook is used to calling the function of ajax register for backend.
	 */
	add_action( 'wp_ajax_google_maps_backend', 'ajax_library_for_google_maps_backend' );

	/**
	 * This hook contains all init functions.
	 */
	add_action( 'init', 'user_functions_for_google_maps' );

	/**
	 * This hook is used for calling the function of shortcode handler.
	 */
	add_shortcode( 'map_bank', 'google_map_shortcode' );

	/**
	 * This hook is used for add google map button for shortcode popup.
	 */
	add_action( 'media_buttons', 'add_map_shortcode_button' );

	/**
	 * This hook is used for initiate Widget
	 */
	function add_widget_foo_google_maps_bank() {
		register_widget( 'MapWidget' );
	}
	add_action( 'widgets_init', 'add_widget_foo_google_maps_bank' );

	/**
	 * This hook is used for apply the shortcode for Widget.
	 */
	add_filter( 'widget_text', 'do_shortcode' );

	/**
	 * This Hook is used for calling the function of deactivation.
	 */
	register_deactivation_hook( __FILE__, 'deactivation_function_for_google_map' );
}

/**
 * This hook is used for calling the function of install script.
 */
register_activation_hook( __FILE__, 'install_script_for_google_map' );

/**
 * This hook used for calling the function of install script.
 */
add_action( 'admin_init', 'install_script_for_google_map' );

/**
 * This hook is used for create link for premium Editions.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'google_maps_bank_action_links' );
/**
 * This hook is used for calling the function of settings link.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'google_maps_bank_settings_link', 10, 2 );

if ( ! function_exists( 'plugin_activate_google_maps' ) ) {
	/**
	 * This function is used to add option on plugin activation.
	 */
	function plugin_activate_google_maps() {
		add_option( 'google_maps_do_activation_redirect', true );
	}
}

if ( ! function_exists( 'google_maps_redirect' ) ) {
	/**
	 * This function is used to redirect to manage maps menu.
	 */
	function google_maps_redirect() {
		if ( get_option( 'google_maps_do_activation_redirect', false ) ) {
			delete_option( 'google_maps_do_activation_redirect' );
			wp_safe_redirect( admin_url( 'admin.php?page=gmb_google_maps' ) );
			exit;
		}
	}
}
register_activation_hook( __FILE__, 'plugin_activate_google_maps' );
add_action( 'admin_init', 'google_maps_redirect' );

/**
 * This function is used to create the object of admin notices.
 */
function google_maps_bank_admin_notice_class() {
	global $wpdb;
	/**
	 * This class is used to add admin notices.
	 */
	class Google_Maps_Bank_Admin_Notices {// @codingStandardsIgnoreLine.
		/**
		 * The version of this plugin.
		 *
		 * @access   public
		 * @var      string    $config  .
		 */
		public $config;
		/**
		 * The version of this plugin.
		 *
		 * @access   public
		 * @var      integer    $notice_spam .
		 */
		public $notice_spam = 0;
		/**
		 * The version of this plugin.
		 *
		 * @access   public
		 * @var      integer    $notice_spam_max .
		 */
		public $notice_spam_max = 2;
		/**
		 * Public Constructor
		 *
		 * @param array $config .
		 */
		public function __construct( $config = array() ) {
			// Runs the admin notice ignore function incase a dismiss button has been clicked.
			add_action( 'admin_init', array( $this, 'gmb_admin_notice_ignore' ) );
			// Runs the admin notice temp ignore function incase a temp dismiss link has been clicked.
			add_action( 'admin_init', array( $this, 'gmb_admin_notice_temp_ignore' ) );
			add_action( 'admin_notices', array( $this, 'gmb_display_admin_notices' ) );
		}
		/**
		 * Checks to ensure notices aren't disabled and the user has the correct permissions.
		 */
		public function gmb_admin_notices() {
			$settings = get_option( 'gmb_admin_notice' );
			if ( ! isset( $settings['disable_admin_notices'] ) || ( isset( $settings['disable_admin_notices'] ) && 0 === $settings['disable_admin_notices'] ) ) {
				if ( current_user_can( 'manage_options' ) ) {
					return true;
				}
			}
			return false;
		}
		/**
		 * Primary notice function that can be called from an outside function sending necessary variables.
		 *
		 * @param string $admin_notices .
		 */
		public function change_admin_notice_google_maps_bank( $admin_notices ) {
			// Check options.
			if ( ! $this->gmb_admin_notices() ) {
				return false;
			}
			foreach ( $admin_notices as $slug => $admin_notice ) {
				// Call for spam protection.
				if ( $this->gmb_anti_notice_spam() ) {
					return false;
				}

				// Check for proper page to display on.
				if ( isset( $admin_notices[ $slug ]['pages'] ) && is_array( $admin_notices[ $slug ]['pages'] ) ) {
					if ( ! $this->gmb_admin_notice_pages( $admin_notices[ $slug ]['pages'] ) ) {
						return false;
					}
				}

				// Check for required fields.
				if ( ! $this->gmb_required_fields( $admin_notices[ $slug ] ) ) {

					// Get the current date then set start date to either passed value or current date value and add interval.
					$current_date = current_time( 'm/d/Y' );
					$start        = ( isset( $admin_notices[ $slug ]['start'] ) ? $admin_notices[ $slug ]['start'] : $current_date );
					$start        = date( 'm/d/Y' );
					$interval     = ( isset( $admin_notices[ $slug ]['int'] ) ? $admin_notices[ $slug ]['int'] : 0 );
					$date         = strtotime( '+' . $interval . ' days', strtotime( $start ) );
					$start        = date( 'm/d/Y', $date );

					// This is the main notices storage option.
					$admin_notices_option = get_option( 'gmb_admin_notice', array() );
					// Check if the message is already stored and if so just grab the key otherwise store the message and its associated date information.
					if ( ! array_key_exists( $slug, $admin_notices_option ) ) {
						$admin_notices_option[ $slug ]['start'] = date( 'm/d/Y' );
						$admin_notices_option[ $slug ]['int']   = $interval;
						update_option( 'gmb_admin_notice', $admin_notices_option );
					}

					// Sanity check to ensure we have accurate information.
					// New date information will not overwrite old date information.
					$admin_display_check    = ( isset( $admin_notices_option[ $slug ]['dismissed'] ) ? $admin_notices_option[ $slug ]['dismissed'] : 0 );
					$admin_display_start    = ( isset( $admin_notices_option[ $slug ]['start'] ) ? $admin_notices_option[ $slug ]['start'] : $start );
					$admin_display_interval = ( isset( $admin_notices_option[ $slug ]['int'] ) ? $admin_notices_option[ $slug ]['int'] : $interval );
					$admin_display_msg      = ( isset( $admin_notices[ $slug ]['msg'] ) ? $admin_notices[ $slug ]['msg'] : '' );
					$admin_display_title    = ( isset( $admin_notices[ $slug ]['title'] ) ? $admin_notices[ $slug ]['title'] : '' );
					$admin_display_link     = ( isset( $admin_notices[ $slug ]['link'] ) ? $admin_notices[ $slug ]['link'] : '' );
					$output_css             = false;

					// Ensure the notice hasn't been hidden and that the current date is after the start date.
					if ( 0 === $admin_display_check && strtotime( $admin_display_start ) <= strtotime( $current_date ) ) {

						// Get remaining query string.
						$query_str = ( isset( $admin_notices[ $slug ]['later_link'] ) ? $admin_notices[ $slug ]['later_link'] : esc_url( add_query_arg( 'gmb_admin_notice_ignore', $slug ) ) );
						if ( strpos( $slug, 'promo' ) === false ) {
							// Admin notice display output.
							echo '<div class="update-nag gmb-admin-notice" style="width:95%!important;">
															 <div></div>
																<strong><p>' . $admin_display_title . '</p></strong>
																<strong><p style="font-size:14px !important">' . $admin_display_msg . '</p></strong>
																<strong><ul>' . $admin_display_link . '</ul></strong>
															</div>';// WPCS: XSS ok.
						} else {
							echo '<div class="admin-notice-promo">';
							echo $admin_display_msg;// WPCS: XSS ok.
							echo '<ul class="notice-body-promo blue">
																		' . $admin_display_link . '
																	</ul>';// WPCS: XSS ok.
							echo '</div>';
						}
						$this->notice_spam += 1;
						$output_css         = true;
					}
				}
			}
		}
		/**
		 * Spam protection check
		 */
		public function gmb_anti_notice_spam() {
			if ( $this->notice_spam >= $this->notice_spam_max ) {
				return true;
			}
			return false;
		}
		/**
		 * Ignore function that gets ran at admin init to ensure any messages that were dismissed get marked
		 */
		public function gmb_admin_notice_ignore() {
			// If user clicks to ignore the notice, update the option to not show it again.
			if ( isset( $_GET['gmb_admin_notice_ignore'] ) ) {// WPCS: CSRF ok, input var ok.
				$admin_notices_option = get_option( 'gmb_admin_notice', array() );
				$admin_notices_option[ $_GET['gmb_admin_notice_ignore'] ]['dismissed'] = 1;// WPCS: CSRF ok, input var ok, sanitization ok.
				update_option( 'gmb_admin_notice', $admin_notices_option );
				$query_str = remove_query_arg( 'gmb_admin_notice_ignore' );
				wp_safe_redirect( $query_str );
				exit;
			}
		}
		/**
		 * Temp Ignore function that gets ran at admin init to ensure any messages that were temp dismissed get their start date changed.
		 */
		public function gmb_admin_notice_temp_ignore() {
			// If user clicks to temp ignore the notice, update the option to change the start date - default interval of 7 days.
			if ( isset( $_GET['gmb_admin_notice_temp_ignore'] ) ) {// WPCS: CSRF ok, input var ok.
				$admin_notices_option = get_option( 'gmb_admin_notice', array() );
				$current_date         = current_time( 'm/d/Y' );
				$interval             = ( isset( $_GET['int'] ) ? wp_unslash( $_GET['int'] ) : 7 );// WPCS: CSRF ok, input var ok, sanitization ok.
				$date                 = strtotime( '+' . $interval . ' days', strtotime( $current_date ) );
				$new_start            = date( 'm/d/Y', $date );

				$admin_notices_option[ $_GET['gmb_admin_notice_temp_ignore'] ]['start']     = $new_start;// WPCS: CSRF ok, input var ok, sanitization ok.
				$admin_notices_option[ $_GET['gmb_admin_notice_temp_ignore'] ]['dismissed'] = 0;// WPCS: CSRF ok, input var ok, sanitization ok.
				update_option( 'gmb_admin_notice', $admin_notices_option );
				$query_str = remove_query_arg( array( 'gmb_admin_notice_temp_ignore', 'gmb_int' ) );
				wp_safe_redirect( $query_str );
				exit;
			}
		}
		/**
		 * Display admin notice on pages.
		 *
		 * @param array $pages .
		 */
		public function gmb_admin_notice_pages( $pages ) {
			foreach ( $pages as $key => $page ) {
				if ( is_array( $page ) ) {
					if ( isset( $_GET['page'] ) && $_GET['page'] === $page[0] && isset( $_GET['tab'] ) && $_GET['tab'] === $page[1] ) {// WPCS: CSRF ok, input var ok.
						return true;
					}
				} else {
					if ( 'all' === $page ) {
						return true;
					}
					if ( get_current_screen()->id === $page ) {
						return true;
					}
					if ( isset( $_GET['page'] ) && $_GET['page'] === $page ) {// WPCS: CSRF ok, input var ok.
						return true;
					}
				}
				return false;
			}
		}
		/**
		 * Required fields check.
		 *
		 * @param array $fields .
		 */
		public function gmb_required_fields( $fields ) {
			if ( ! isset( $fields['msg'] ) || ( isset( $fields['msg'] ) && empty( $fields['msg'] ) ) ) {
				return true;
			}
			if ( ! isset( $fields['title'] ) || ( isset( $fields['title'] ) && empty( $fields['title'] ) ) ) {
				return true;
			}
			return false;
		}
		/**
		 * Display Content in admin notice.
		 */
		public function gmb_display_admin_notices() {
			$two_week_review_ignore = add_query_arg( array( 'gmb_admin_notice_ignore' => 'two_week_review' ) );
			$two_week_review_temp   = add_query_arg(
				array(
					'gmb_admin_notice_temp_ignore' => 'two_week_review',
					'int'                          => 7,
				)
			);

			$notices['two_week_review'] = array(
				'title'      => __( 'Leave A Google Maps Bank Review?', 'google-maps-bank' ),
				'msg'        => __( 'We love and care about you. Google Maps Bank Team is putting our maximum efforts to provide you the best functionalities.<br> We would really appreciate if you could spend a couple of seconds to give a Nice Review to the plugin for motivating us!', 'google-maps-bank' ),
				'link'       => '<span class="dashicons dashicons-external google-maps-bank-admin-notice"></span><span class="google-maps-bank-admin-notice"><a href="https://wordpress.org/support/plugin/google-maps-bank/reviews/?filter=5" target="_blank" class="google-maps-bank-admin-notice-link">' . __( 'Sure! I\'d love to!', 'google-maps-bank' ) . '</a></span>
												<span class="dashicons dashicons-smiley google-maps-bank-admin-notice"></span><span class="google-maps-bank-admin-notice"><a href="' . $two_week_review_ignore . '" class="google-maps-bank-admin-notice-link"> ' . __( 'I\'ve already left a review', 'google-maps-bank' ) . '</a></span>
												<span class="dashicons dashicons-calendar-alt google-maps-bank-admin-notice"></span><span class="google-maps-bank-admin-notice"><a href="' . $two_week_review_temp . '" class="google-maps-bank-admin-notice-link">' . __( 'Maybe Later', 'google-maps-bank' ) . '</a></span>',
				'later_link' => $two_week_review_temp,
				'int'        => 7,
			);

			$this->change_admin_notice_google_maps_bank( $notices );
		}
	}
	$plugin_info_google_maps_bank = new Google_Maps_Bank_Admin_Notices();
}
add_action( 'init', 'google_maps_bank_admin_notice_class' );
/**
 * Add Pop on deactivation.
 */
function add_popup_on_deactivation_google_maps_bank() {
	global $wpdb;
	/**
	 * This class is used to add Pop on deactivation.
	 */
	class Google_Maps_Bank_Deactivation_Form { // @codingStandardsIgnoreLine
		/**
		 * Public Constructor
		 */
		public function __construct() {
			add_action( 'wp_ajax_post_user_feedback_google_maps_bank', array( $this, 'post_user_feedback_google_maps_bank' ) );
			global $pagenow;
			if ( 'plugins.php' === $pagenow ) {
					add_action( 'admin_enqueue_scripts', array( $this, 'feedback_form_js_google_maps_bank' ) );
					add_action( 'admin_head', array( $this, 'add_form_layout_google_maps_bank' ) );
					add_action( 'admin_footer', array( $this, 'add_deactivation_dialog_form_google_maps_bank' ) );
			}
		}
		/**
		 * Add css and js files.
		 */
		function feedback_form_js_google_maps_bank() {
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_register_script( 'google-maps-bank-post-feedback', plugins_url( 'assets/global/plugins/deactivation/deactivate-popup.js', __FILE__ ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), false, true );
			wp_localize_script( 'google-maps-bank-post-feedback', 'post_feedback', array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) ) );
			wp_enqueue_script( 'google-maps-bank-post-feedback' );
		}
		/**
		 * This function is used to post user feedback.
		 */
		function post_user_feedback_google_maps_bank() {
			$google_maps_bank_deactivation_reason = isset( $_POST['reason'] ) ? esc_attr( wp_unslash( $_POST['reason'] ) ) : '';// WPCS: Input var ok, CSRF ok, sanitization ok.
			$plugin_info_google_maps_bank         = new Plugin_Info_Google_Maps_Bank();
			global $wp_version, $wpdb;
			$url              = TECH_BANKER_STATS_URL . '/wp-admin/admin-ajax.php';
			$type             = get_option( 'google-map-bank-wizard-set-up' );
			$user_admin_email = get_option( 'google-maps-bank-admin-email' );
			$theme_details    = array();
			if ( $wp_version >= 3.4 ) {
				$active_theme                   = wp_get_theme();
				$theme_details['theme_name']    = strip_tags( $active_theme->name );
				$theme_details['theme_version'] = strip_tags( $active_theme->version );
				$theme_details['author_url']    = strip_tags( $active_theme->{'Author URI'} );
			}
			$plugin_stat_data                     = array();
			$plugin_stat_data['plugin_slug']      = 'google-maps-bank';
			$plugin_stat_data['reason']           = $google_maps_bank_deactivation_reason;
			$plugin_stat_data['type']             = 'standard_edition';
			$plugin_stat_data['version_number']   = GOOGLE_MAPS_VERSION_NUMBER;
			$plugin_stat_data['status']           = $type;
			$plugin_stat_data['event']            = 'de-activate';
			$plugin_stat_data['domain_url']       = site_url();
			$plugin_stat_data['wp_language']      = defined( 'WPLANG' ) && WPLANG ? WPLANG : get_locale();
			$plugin_stat_data['email']            = false !== $user_admin_email ? $user_admin_email : get_option( 'admin_email' );
			$plugin_stat_data['wp_version']       = $wp_version;
			$plugin_stat_data['php_version']      = esc_html( phpversion() );
			$plugin_stat_data['mysql_version']    = $wpdb->db_version();
			$plugin_stat_data['max_input_vars']   = ini_get( 'max_input_vars' );
			$plugin_stat_data['operating_system'] = PHP_OS . '  (' . PHP_INT_SIZE * 8 . ') BIT';
			$plugin_stat_data['php_memory_limit'] = ini_get( 'memory_limit' ) ? ini_get( 'memory_limit' ) : 'N/A';
			$plugin_stat_data['extensions']       = get_loaded_extensions();
			$plugin_stat_data['plugins']          = $plugin_info_google_maps_bank->get_plugin_info_google_maps_bank();
			$plugin_stat_data['themes']           = $theme_details;
			$response                             = wp_safe_remote_post(
				$url, array(
					'method'      => 'POST',
					'timeout'     => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking'    => true,
					'headers'     => array(),
					'body'        => array(
						'data'    => maybe_serialize( $plugin_stat_data ),
						'site_id' => false !== get_option( 'gmb_tech_banker_site_id' ) ? get_option( 'gmb_tech_banker_site_id' ) : '',
						'action'  => 'plugin_analysis_data',
					),
				)
			);

			if ( ! is_wp_error( $response ) ) {
				false !== $response['body'] ? update_option( 'gmb_tech_banker_site_id', $response['body'] ) : '';
			}
				die( 'success' );
		}
		/**
		 * Add form layout of deactivation form.
		 */
		function add_form_layout_google_maps_bank() {
			?>
			<style type="text/css">
					.google-maps-bank-feedback-form .ui-dialog-buttonset {
						float: none !important;
					}
					#google-maps-bank-feedback-dialog-continue,#google-maps-bank-feedback-dialog-skip {
						float: right;
					}
					#google-maps-bank-feedback-cancel{
						float: left;
					}
					#google-maps-bank-feedback-content p {
						font-size: 1.1em;
					}
					.google-maps-bank-feedback-form .ui-icon {
						display: none;
					}
					#google-maps-bank-feedback-dialog-continue.google-maps-bank-ajax-progress .ui-icon {
						text-indent: inherit;
						display: inline-block !important;
						vertical-align: middle;
						animation: rotate 2s infinite linear;
					}
					#google-maps-bank-feedback-dialog-continue.google-maps-bank-ajax-progress .ui-button-text {
						vertical-align: middle;
					}
					@keyframes rotate {
						0%    { transform: rotate(0deg); }
						100%  { transform: rotate(360deg); }
					}
			</style>
			<?php
		}
		/**
		 * Add deactivation dialog form.
		 */
		function add_deactivation_dialog_form_google_maps_bank() {
			?>
			<div id="google-maps-bank-feedback-content" style="display: none;">
			<p style="margin-top:-5px"><?php echo esc_attr( __( 'We feel guilty when anyone stop using Google Maps Bank.', 'google-maps-bank' ) ); ?></p>
				<p><?php echo esc_attr( __( 'If Google Maps Bank isn\'t working for you, others also may not.', 'google-maps-bank' ) ); ?></p>
				<p><?php echo esc_attr( __( 'We would love to hear your feedback about what went wrong.', 'google-maps-bank' ) ); ?></p>
				<p><?php echo esc_attr( __( 'We would like to help you in fixing the issue.', 'google-maps-bank' ) ); ?></p>
				<p><?php echo esc_attr( __( 'If you click Continue, some data would be sent to our servers for Compatiblity Testing Purposes.', 'google-maps-bank' ) ); ?></p>
				<p><?php echo esc_attr( __( 'If you Skip, no data would be shared with our servers.', 'google-maps-bank' ) ); ?></p>
			<form>
				<?php wp_nonce_field(); ?>
				<ul id="google-maps-bank-deactivate-reasons">
					<li class="google-maps-bank-reason google-maps-bank-custom-input">
						<label>
							<span><input value="0" type="radio" name="reason" /></span>
							<span><?php echo esc_attr( __( 'The Plugin didn\'t work', 'google-maps-bank' ) ); ?></span>
						</label>
					</li>
					<li class="google-maps-bank-reason google-maps-bank-custom-input">
						<label>
							<span><input value="1" type="radio" name="reason" /></span>
							<span><?php echo esc_attr( __( 'I found a better Plugin', 'google-maps-bank' ) ); ?></span>
						</label>
					</li>
					<li class="google-maps-bank-reason">
						<label>
							<span><input value="2" type="radio" name="reason" checked /></span>
							<span><?php echo esc_attr( __( 'It\'s a temporary deactivation. I\'m just debugging an issue.', 'google-maps-bank' ) ); ?></span>
						</label>
					</li>
					<li class="google-maps-bank-reason google-maps-bank-custom-input">
						<label>
							<span><input value="3" type="radio" name="reason" /></span>
				<span><a href="https://wordpress.org/support/plugin/google-maps-bank" target="_blank"><?php echo esc_attr( __( 'Open a Support Ticket for me.', 'google-maps-bank' ) ); ?></a></span>
						</label>
					</li>
				</ul>
			</form>
		</div>
		<?php
		}
	}
	$plugin_deactivation_details = new Google_Maps_Bank_Deactivation_Form();
}
add_action( 'plugins_loaded', 'add_popup_on_deactivation_google_maps_bank' );
/**
 * This function is used to insert deactivation link.
 *
 * @param array $links .
 */
function insert_deactivate_link_id_google_maps_bank( $links ) {
	if ( ! is_multisite() ) {
		$links['deactivate'] = str_replace( '<a', '<a id="google-maps-bank-plugin-disable-link"', $links['deactivate'] );
	}
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'insert_deactivate_link_id_google_maps_bank', 10, 2 );
