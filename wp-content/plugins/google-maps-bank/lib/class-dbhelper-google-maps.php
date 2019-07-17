<?php
/**
 * This file is used for creating dbHelper class.
 *
 * @author Tech Banker
 * @package google-maps-bank/lib
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}// Exit if accessed directly
if ( ! is_user_logged_in() ) {
	return;
} else {
	$access_granted = false;
	foreach ( $user_role_permission as $permission ) {
		if ( current_user_can( $permission ) ) {
			$access_granted = true;
			break;
		}
	}
	if ( ! $access_granted ) {
		return;
	} else {

		if ( ! class_exists( 'Dbhelper_Google_Maps' ) ) {
			/**
			 * Class Name: Dbhelper_Google_Maps
			 * Parameter: No
			 * Description: This class is user for insert,update and delete operations.
			 * Created On: 7-11-2016 18:11
			 * Created By: Tech Banker Team
			 */
			class Dbhelper_Google_Maps {
				/**
				 * This Function is used for Insert data in database.
				 *
				 * @param string $table_name passes parameter as table name.
				 * @param string $data passes parameter as data.
				 */
				public function insert_command( $table_name, $data ) {
					global $wpdb;
					$wpdb->insert( $table_name, $data );// WPCS: db call ok.
					return $wpdb->insert_id;
				}
				/**
				 * This function is used for Update data in database.
				 *
				 * @param string $table_name passes parameter as table name.
				 * @param string $data passes parameter as data.
				 * @param string $where passes parameter as where.
				 */
				public function update_command( $table_name, $data, $where ) {
					global $wpdb;
					$wpdb->update( $table_name, $data, $where );// WPCS: db call ok, cache ok.
				}
				/**
				 * This function is used for delete data from database.
				 *
				 * @param string $table_name passes parameter as table name.
				 * @param string $where passes parameter as where.
				 */
				public function delete_command( $table_name, $where ) {
					global $wpdb;
					$wpdb->delete( $table_name, $where );// WPCS: db call ok, cache ok.
				}
			}
		}
		if ( ! class_exists( 'Plugin_Info_Google_Maps_Bank' ) ) {
			/**
			 * This Class is used for Get Plugin Information.
			 *
			 * @package    google-maps-bank
			 * @subpackage lib
			 *
			 * @author  Tech Banker
			 */
			class Plugin_Info_Google_Maps_Bank {// @codingStandardsIgnoreLine
				/**
				 * Function Name: get_plugin_info_google_maps_bank
				 * Parameters: No
				 * Decription: This function is used to return the information about plugins.
				 * Created On: 13-06-2017 10:07
				 * Created By: Tech Banker Team
				 */
				public function get_plugin_info_google_maps_bank() {
					$active_plugins = (array) get_option( 'active_plugins', array() );
					if ( is_multisite() ) {
						$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
					}
					$plugins = array();
					if ( count( $active_plugins ) > 0 ) {
						$get_plugins = array();
						foreach ( $active_plugins as $plugin ) {
							$plugin_data = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );// @codingStandardsIgnoreLine

							$get_plugins['plugin_name']    = strip_tags( $plugin_data['Name'] );
							$get_plugins['plugin_author']  = strip_tags( $plugin_data['Author'] );
							$get_plugins['plugin_version'] = strip_tags( $plugin_data['Version'] );
							array_push( $plugins, $get_plugins );
						}
						return $plugins;
					}
				}
			}
		}
	}
}
