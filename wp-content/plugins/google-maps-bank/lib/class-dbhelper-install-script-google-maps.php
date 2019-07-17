<?php
/**
 * This file is used to create tables.
 *
 * @author Tech Banker
 * @package google-maps-bank/lib
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//Exit if accessed directly
if ( ! is_user_logged_in() ) {
	return;
} else {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	} else {
		if ( ! class_exists( 'Dbhelper_Install_Script_Google_Maps' ) ) {
			/**
			 * This class is used to perform operations.
			 */
			class Dbhelper_Install_Script_Google_Maps {
				/**
				 * This function is used for insert data in the database.
				 *
				 * @param string $table_name .
				 * @param string $data .
				 */
				public function insert_command( $table_name, $data ) {
					global $wpdb;
					$wpdb->insert( $table_name, $data ); // WPCS: db call ok, no-cache ok.
					return $wpdb->insert_id;
				}
				/**
				 * This function is used for Update data.
				 *
				 * @param string $table_name .
				 * @param string $data .
				 * @param string $where .
				 */
				public function update_command( $table_name, $data, $where ) {
					global $wpdb;
					$wpdb->update( $table_name, $data, $where ); // WPCS: db call ok, no-cache ok.
				}
			}
		}
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$google_map_version_number = get_option( 'google-maps-bank-version-number' );

		if ( ! function_exists( 'google_maps_parent_table' ) ) {
			/**
			 * This function is used for creating a parent table.
			 */
			function google_maps_parent_table() {
				global $wpdb;
				$collate                  = $wpdb->get_charset_collate();
				$obj_dbhelper_google_maps = new Dbhelper_Install_Script_Google_Maps();
				$sql                      = 'CREATE TABLE IF NOT EXISTS ' . google_maps() . '
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`type` longtext NOT NULL,
					`parent_id` int(10) DEFAULT NULL,
					 PRIMARY KEY (`id`)
				)' . $collate;
				dbDelta( $sql );

				$data = 'INSERT INTO ' . google_maps() . " (`type`, `parent_id`) VALUES
				('maps','0'),
				('store_locator','0'),
				('layout_settings', 0),
				('custom_css', 0),
				('collation_type', 0),
				('other_settings', 0),
				('roles_and_capabilities_settings', 0);";
				dbDelta( $data );

				$parent_table_data = $wpdb->get_results( 'SELECT id,type FROM ' . $wpdb->prefix . 'google_maps' ); // WPCS: db call ok, no-cache ok.
				foreach ( $parent_table_data as $row ) {
					switch ( $row->type ) {
						case 'layout_settings':
							$gmb_layout_settings_serialize                      = array();
							$gmb_layout_settings_serialize['info_window']       = $row->id;
							$gmb_layout_settings_serialize['directions']        = $row->id;
							$gmb_layout_settings_serialize['store_locator']     = $row->id;
							$gmb_layout_settings_serialize['map_customization'] = $row->id;
							foreach ( $gmb_layout_settings_serialize as $keys => $value ) {
								$gmb_layout_settings_data              = array();
								$gmb_layout_settings_data['type']      = $keys;
								$gmb_layout_settings_data['parent_id'] = $value;
								$obj_dbhelper_google_maps->insert_command( google_maps(), $gmb_layout_settings_data );
							}
							break;
					}
				}
			}
		}

		if ( ! function_exists( 'google_maps_meta_table' ) ) {
			/**
			 * This function is used used for creating a meta table.
			 */
			function google_maps_meta_table() {
				global $wpdb;
				$collate                  = $wpdb->get_charset_collate();
				$obj_dbhelper_google_maps = new Dbhelper_Install_Script_Google_Maps();
				$sql                      = 'CREATE TABLE IF NOT EXISTS ' . google_maps_meta() . '
				(
					`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`meta_id` int(10) NOT NULL,
					`meta_key` varchar(100) NOT NULL,
					`meta_value` longtext NOT NULL,
					`old_map_id` int(10) NOT NULL,
					PRIMARY KEY (`id`)
				)' . $collate;
				dbDelta( $sql );

				$parent_table_data = $wpdb->get_results( 'SELECT id,type FROM ' . $wpdb->prefix . 'google_maps' ); // WPCS: db call ok, no-cache ok.
				foreach ( $parent_table_data as $row ) {
					switch ( $row->type ) {
						case 'info_window':
							$gmb_info_window_settings                                  = array();
							$gmb_info_window_settings['info_window_width']             = '300';
							$gmb_info_window_settings['info_window_open_event']        = 'click';
							$gmb_info_window_settings['info_window_title_style']       = '15,#000000';
							$gmb_info_window_settings['info_window_title_font_family'] = 'Roboto Condensed';
							$gmb_info_window_settings['info_window_desc_style']        = '12,#000000';
							$gmb_info_window_settings['info_window_desc_font_family']  = 'Roboto Condensed';
							$gmb_info_window_settings['info_window_border_style']      = '0,none,#000000';
							$gmb_info_window_settings['info_window_border_radius']     = '0';
							$gmb_info_window_settings['info_windows_image_padding']    = '0,10,0,0';
							$gmb_info_window_settings['info_windows_text_padding']     = '0,0,0,0';
							$gmb_info_window_settings['info_window_image_position']    = 'left';

							$gmb_info_window_settings_array               = array();
							$gmb_info_window_settings_array['meta_id']    = $row->id;
							$gmb_info_window_settings_array['meta_key']   = 'info_window_settings'; // WPCS: slow query ok.
							$gmb_info_window_settings_array['meta_value'] = maybe_serialize( $gmb_info_window_settings ); // WPCS: slow query ok.
							$gmb_info_window_settings_array['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_info_window_settings_array );
							break;

						case 'directions':
							$gmb_directions_settings                                        = array();
							$gmb_directions_settings['directions_general_background_color'] = '#ffffff';
							$gmb_directions_settings['directions_general_background_opacity'] = '100';

							$gmb_directions_settings['directions_header_title_style'] = '20,#000000';
							$gmb_directions_settings['directions_header_font_family'] = 'Roboto Condensed';
							$gmb_directions_settings['directions_background_color']   = '#ffffff';
							$gmb_directions_settings['directions_background_opacity'] = '100';

							$gmb_directions_settings['directions_label_style']                    = '15,#000000';
							$gmb_directions_settings['directions_label_font_family']              = 'Roboto Condensed';
							$gmb_directions_settings['input_field_placeholder_from']              = 'Please enter Starting Point';
							$gmb_directions_settings['input_field_placeholder_to']                = 'Please enter Destination Point';
							$gmb_directions_settings['directions_input_field_default_mode']       = 'driving';
							$gmb_directions_settings['directions_input_field_placeholder_style']  = '15,#000000';
							$gmb_directions_settings['directions_placeholder_font_family']        = 'Roboto Condensed';
							$gmb_directions_settings['directions_input_field_margin']             = '0,0,10,0';
							$gmb_directions_settings['directions_input_field_padding']            = '0,0,0,0';
							$gmb_directions_settings['directions_input_field_height']             = '40';
							$gmb_directions_settings['directions_input_field_width']              = '100';
							$gmb_directions_settings['directions_input_field_text_style']         = '15,#000000';
							$gmb_directions_settings['directions_input_field_font_family']        = 'Roboto Condensed';
							$gmb_directions_settings['directions_input_field_background_color']   = '#ffffff';
							$gmb_directions_settings['directions_input_field_background_opacity'] = '75';
							$gmb_directions_settings['directions_line_color']                     = '#000000';
							$gmb_directions_settings['directions_line_color_opacity']             = '75';

							$gmb_directions_settings['directions_button_text_style']               = '15,#ffffff';
							$gmb_directions_settings['directions_button_font_family']              = 'Roboto Condensed';
							$gmb_directions_settings['directions_button_background_color']         = '#a4cd39';
							$gmb_directions_settings['directions_button_background_color_opacity'] = '75';
							$gmb_directions_settings['directions_button_height_and_width']         = '50,100';
							$gmb_directions_settings['directions_button_alignment']                = 'center';

							$gmb_directions_settings['text_direction_width']                        = '100';
							$gmb_directions_settings['directions_display_text_style']               = '14,#000000';
							$gmb_directions_settings['directions_display_text_font_family']         = 'Roboto Condensed';
							$gmb_directions_settings['directions_display_background_color']         = '#ffffff';
							$gmb_directions_settings['directions_display_background_color_opacity'] = '100';
							$gmb_directions_settings['directions_display_border_style']             = '0,none,#a4cd39';
							$gmb_directions_settings['directions_display_border_radius']            = '0';

							$gmb_directions_settings['direction_type']            = 'disable';
							$gmb_directions_settings['direction_address_type']    = 'formatted_address';
							$gmb_directions_settings['direction_address']         = '';
							$gmb_directions_settings['direction_latitude']        = '';
							$gmb_directions_settings['direction_longitude']       = '';
							$gmb_directions_settings['directions_type_to']        = 'disable';
							$gmb_directions_settings['direction_address_type_to'] = 'formatted_address';
							$gmb_directions_settings['direction_address_to']      = '';
							$gmb_directions_settings['direction_latitude_to']     = '';
							$gmb_directions_settings['direction_longitude_to']    = '';

							$gmb_directions_settings_array               = array();
							$gmb_directions_settings_array['meta_id']    = $row->id;
							$gmb_directions_settings_array['meta_key']   = 'directions_settings'; // WPCS: slow query ok.
							$gmb_directions_settings_array['meta_value'] = maybe_serialize( $gmb_directions_settings ); // WPCS: slow query ok.
							$gmb_directions_settings_array['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_directions_settings_array );
							break;

						case 'store_locator':
							$gmb_store_locator_settings = array();
							$gmb_store_locator_settings['store_locator_general_background_color']   = '#ffffff';
							$gmb_store_locator_settings['store_locator_general_background_opacity'] = '100';

							$gmb_store_locator_settings['store_locator_header_title_style']       = '20,#000000';
							$gmb_store_locator_settings['store_locator_header_title_font_family'] = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_background_color']         = '#ffffff';
							$gmb_store_locator_settings['store_locator_background_color_opacity'] = '100';

							$gmb_store_locator_settings['store_locator_label_style']                          = '15,#000000';
							$gmb_store_locator_settings['store_locator_label_font_family']                    = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_input_field_placeholder_form']         = 'Please enter location address';
							$gmb_store_locator_settings['store_locator_input_field_placeholder_style']        = '15,#000000';
							$gmb_store_locator_settings['store_locator_input_field_placeholder_font_family']  = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_input_field_text_style']               = '15,#000000';
							$gmb_store_locator_settings['store_locator_input_field_font_family']              = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_input_field_background_color']         = '#ffffff';
							$gmb_store_locator_settings['store_locator_input_field_background_color_opacity'] = '75';
							$gmb_store_locator_settings['store_locator_input_field_margin']                   = '0,0,10,0';
							$gmb_store_locator_settings['store_locator_input_field_padding']                  = '0,0,0,0';
							$gmb_store_locator_settings['store_locator_input_field_width']                    = '100';
							$gmb_store_locator_settings['store_locator_input_field_height']                   = '40';
							$gmb_store_locator_settings['store_locator_input_field_show_default_location']    = 'disable';
							$gmb_store_locator_settings['store_locator_input_field_default_location']         = 'formatted_address';
							$gmb_store_locator_settings['store_locator_input_field_formatted']                = '';
							$gmb_store_locator_settings['store_locator_input_field_latitude']                 = '';
							$gmb_store_locator_settings['store_locator_input_field_longitude']                = '';

							$gmb_store_locator_settings['store_locator_button_text_style']               = '15,#ffffff';
							$gmb_store_locator_settings['store_locator_button_text_font_family']         = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_button_background_color']         = '#a4cd39';
							$gmb_store_locator_settings['store_locator_button_background_color_opacity'] = '75';
							$gmb_store_locator_settings['store_locator_button_height_and_width']         = '50,100';
							$gmb_store_locator_settings['store_locator_button_alignment']                = 'center';

							$gmb_store_locator_settings['store_locator_distance_measurement']      = 'kilometers';
							$gmb_store_locator_settings['store_locator_circle_line_width']         = '3';
							$gmb_store_locator_settings['store_locator_circle_line_color']         = '#000000';
							$gmb_store_locator_settings['store_locator_circle_line_color_opacity'] = '75';
							$gmb_store_locator_settings['store_locator_circle_fill_color']         = '#e37be3';
							$gmb_store_locator_settings['store_locator_circle_fill_color_opacity'] = '75';

							$gmb_store_locator_settings['store_locator_table_width']                    = '100';
							$gmb_store_locator_settings['store_locator_table_text_style']               = '14,#000000';
							$gmb_store_locator_settings['store_locator_table_text_font_family']         = 'Roboto Condensed';
							$gmb_store_locator_settings['store_locator_table_background_color']         = '#ffffff';
							$gmb_store_locator_settings['store_locator_table_background_color_opacity'] = '75';
							$gmb_store_locator_settings['store_locator_table_border_style']             = '0,none,#a4cd39';
							$gmb_store_locator_settings['store_locator_table_border_radius']            = '0';

							$gmb_store_locator_settings_array               = array();
							$gmb_store_locator_settings_array['meta_id']    = $row->id;
							$gmb_store_locator_settings_array['meta_key']   = 'store_locator_settings'; // WPCS: slow query ok.
							$gmb_store_locator_settings_array['meta_value'] = maybe_serialize( $gmb_store_locator_settings ); // WPCS: slow query ok.
							$gmb_store_locator_settings_array['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_store_locator_settings_array );
							break;

						case 'map_customization':
							$gmb_map_customization_settings                             = array();
							$gmb_map_customization_settings['map_title_html_tag']       = 'h1';
							$gmb_map_customization_settings['map_title_text_alignment'] = 'left';
							$gmb_map_customization_settings['map_title_font_style']     = '18,#000000';
							$gmb_map_customization_settings['map_title_font_family']    = 'Roboto Condensed';
							$gmb_map_customization_settings['map_title_margin']         = '0,0,0,0';
							$gmb_map_customization_settings['map_title_padding']        = '0,0,0,0';

							$gmb_map_customization_settings['map_description_html_tag']       = 'p';
							$gmb_map_customization_settings['map_description_text_alignment'] = 'left';
							$gmb_map_customization_settings['map_description_font_style']     = '15,#000000';
							$gmb_map_customization_settings['map_description_font_family']    = 'Roboto Condensed';
							$gmb_map_customization_settings['map_description_margin']         = '0,0,0,0';
							$gmb_map_customization_settings['map_description_padding']        = '0,0,0,0';

							$gmb_map_customization_settings['map_draggable']                = 'enable';
							$gmb_map_customization_settings['map_type']                     = 'show';
							$gmb_map_customization_settings['map_type_control_position']    = 'top_left';
							$gmb_map_customization_settings['map_type_control_style']       = 'none';
							$gmb_map_customization_settings['map_double_click_zoom']        = 'enable';
							$gmb_map_customization_settings['mouse_wheel_scrolling']        = 'enable';
							$gmb_map_customization_settings['full_screen_control']          = 'hide';
							$gmb_map_customization_settings['full_screen_control_position'] = 'top_right';
							$gmb_map_customization_settings['street_view_control']          = 'hide';
							$gmb_map_customization_settings['street_view_control_position'] = 'right_bottom';
							$gmb_map_customization_settings['rotate_control']               = 'show';
							$gmb_map_customization_settings['scale_control']                = 'show';
							$gmb_map_customization_settings['map_zoom_control']             = 'hide';
							$gmb_map_customization_settings['map_zoom_control_alignment']   = 'right_bottom';

							$gmb_map_customization_settings_array               = array();
							$gmb_map_customization_settings_array['meta_id']    = $row->id;
							$gmb_map_customization_settings_array['meta_key']   = 'map_customization'; // WPCS: slow query ok.
							$gmb_map_customization_settings_array['meta_value'] = maybe_serialize( $gmb_map_customization_settings ); // WPCS: slow query ok.
							$gmb_map_customization_settings_array['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_map_customization_settings_array );
							break;

						case 'custom_css':
							$gmb_custom_css_data               = array();
							$gmb_custom_css_data['custom_css'] = '';

							$gmb_custom_css_array               = array();
							$gmb_custom_css_array['meta_id']    = $row->id;
							$gmb_custom_css_array['meta_key']   = 'custom_css'; // WPCS: slow query ok.
							$gmb_custom_css_array['meta_value'] = maybe_serialize( $gmb_custom_css_data ); // WPCS: slow query ok.
							$gmb_custom_css_array['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_custom_css_array );
							break;

						case 'other_settings':
							$gmb_other_settings_data['automatic_plugin_updates']    = 'disable';
							$gmb_other_settings_data['remove_tables_at_uninstall']  = 'disable';
							$gmb_other_settings_data['other_api_key']               = 'AIzaSyC4rVG7IsNk9pKUO_uOZuxQO4FmF6z03Ks';
							$gmb_other_settings_data['other_settings_map_language'] = 'en';
							$gmb_other_settings_data['ip_address_fetching_method']  = '';

							$gmb_other_settings_serialize               = array();
							$gmb_other_settings_serialize['meta_id']    = $row->id;
							$gmb_other_settings_serialize['meta_key']   = 'other_settings'; // WPCS: slow query ok.
							$gmb_other_settings_serialize['meta_value'] = maybe_serialize( $gmb_other_settings_data ); // WPCS: slow query ok.
							$gmb_other_settings_serialize['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $gmb_other_settings_serialize );
							break;

						case 'roles_and_capabilities_settings':
							$roles_capabilities_data_array                                   = array();
							$roles_capabilities_data_array['roles_and_capabilities']         = '1,1,1,0,0,0';
							$roles_capabilities_data_array['google_map_top_bar_menu']        = 'enable';
							$roles_capabilities_data_array['others_full_control_capability'] = '0';
							$roles_capabilities_data_array['administrator_privileges']       = '1,1,1,1,1,1,1,1,1,1,1,1,1';
							$roles_capabilities_data_array['author_privileges']              = '0,0,1,0,1,0,0,1,0,0,0,0,0';
							$roles_capabilities_data_array['editor_privileges']              = '0,0,0,0,1,1,0,0,1,0,0,0,0';
							$roles_capabilities_data_array['contributor_privileges']         = '0,0,0,0,1,1,0,0,0,0,1,0,0';
							$roles_capabilities_data_array['subscriber_privileges']          = '0,0,0,0,0,0,0,0,0,0,0,0,0';
							$roles_capabilities_data_array['other_roles_privileges']         = '0,0,0,0,0,0,0,0,0,0,0,0,0';
							$user_capabilities            = get_others_capabilities_google_maps();
							$other_roles_array            = array();
							$gmb_other_roles_access_array = array(
								'manage_options',
								'edit_plugins',
								'edit_posts',
								'publish_posts',
								'publish_pages',
								'edit_pages',
								'read',
							);
							foreach ( $gmb_other_roles_access_array as $role ) {
								if ( in_array( $role, $user_capabilities, true ) ) {
									array_push( $other_roles_array, $role );
								}
							}
							$roles_capabilities_data_array['capabilities'] = $other_roles_array;

							$roles_capabilities_data               = array();
							$roles_capabilities_data['meta_id']    = $row->id;
							$roles_capabilities_data['meta_key']   = 'roles_and_capabilities'; // WPCS: slow query ok.
							$roles_capabilities_data['meta_value'] = maybe_serialize( $roles_capabilities_data_array ); // WPCS: slow query ok.
							$roles_capabilities_data['old_map_id'] = 0;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $roles_capabilities_data );
							break;
					}
				}
			}
		}

		$obj_dbhelper_google_maps = new Dbhelper_Install_Script_Google_Maps();
		switch ( $google_map_version_number ) {
			case '':
				$google_maps_bank_admin_notices_array = array();
				$gmb_start_date                       = date( 'm/d/Y' );
				$gmb_start_date                       = strtotime( $gmb_start_date );
				$gmb_start_date                       = strtotime( '+7 day', $gmb_start_date );
				$gmb_start_date                       = date( 'm/d/Y', $gmb_start_date );
				$google_maps_bank_admin_notices_array['two_week_review'] = array( 'start' => $gmb_start_date, 'int' => 7, 'dismissed' => 0 ); // @codingStandardsIgnoreLine.
				update_option( 'gmb_admin_notice', $google_maps_bank_admin_notices_array );
				google_maps_parent_table();
				google_maps_meta_table();
				break;

			default:
				// Unschedule Schedulers .
				if ( wp_next_scheduled( 'google_maps_bank_auto_update' ) ) {
					wp_clear_scheduled_hook( 'google_maps_bank_auto_update' );
				}
				if ( wp_next_scheduled( 'google_maps_optimizer_scheduler' ) ) {
					wp_clear_scheduled_hook( 'google_maps_optimizer_scheduler' );
				}
				if ( wp_next_scheduled( 'check_plugin_updates-google-maps-bank-pro-edition' ) ) {
					wp_clear_scheduled_hook( 'check_plugin_updates-google-maps-bank-pro-edition' );
				}
				global $wpdb;
				if ( $wpdb->query( "SHOW TABLES LIKE '" . $wpdb->prefix . 'google_maps' . "'" ) === 0 ) {
					google_maps_parent_table(); // WPCS: db call ok, no-cache ok.
				}
				if ( $wpdb->query( "SHOW TABLES LIKE '" . $wpdb->prefix . 'google_maps_meta' . "'" ) === 0 ) {
					google_maps_meta_table(); // WPCS: db call ok, no-cache ok.
				}

				$gmb_other_settings_data          = $wpdb->get_var(
					$wpdb->prepare(
						'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s', 'other_settings'
					)
				); // WPCS: db call ok, no-cache ok.
				$other_settings_unserialized_data = maybe_unserialize( $gmb_other_settings_data );
				if ( ! array_key_exists( 'automatic_plugin_updates', $other_settings_unserialized_data ) ) {
					$other_settings_unserialized_data['automatic_plugin_updates'] = 'disable';
				}
				$other_settings_serialized_data               = array();
				$where                                        = array();
				$where['meta_key']                            = 'other_settings'; // WPCS: slow query ok.
				$other_settings_serialized_data['meta_value'] = maybe_serialize( $other_settings_unserialized_data ); // WPCS: slow query ok.
				$obj_dbhelper_google_maps->update_command( google_maps_meta(), $other_settings_serialized_data, $where );

				// Drop Tables.
				$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gmb_marker_category' ); // @codingStandardsIgnoreLine.
				$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gmb_marker_themes' ); // @codingStandardsIgnoreLine.
				$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gmb_plugin_settings' ); // @codingStandardsIgnoreLine.

				if ( $wpdb->query( "SHOW TABLES LIKE '" . $wpdb->prefix . "gmb_maps'" ) !== 0 && $wpdb->query( "SHOW TABLES LIKE '" . $wpdb->prefix . "gmb_maps_meta'" ) !== 0 ) { // @codingStandardsIgnoreLine.
					if ( ! function_exists( 'get_maps_overlays_data' ) ) {
						/**
						 * This function is used used to get map overlyay.
						 *
						 * @param string $overlay_id .
						 */
						function get_maps_overlays_data( $overlay_id ) {
							global $wpdb;
							$overlaydata = $wpdb->get_results(
								$wpdb->prepare(
									'SELECT * FROM ' . $wpdb->prefix . 'gmb_maps_meta
									WHERE map_id = %d', $overlay_id
								)
							); // WPCS: db call ok, no-cache ok.
							foreach ( $overlaydata as $value ) {
								$maps_settings_array                 = array();
								$unserialize[ $value->map_meta_key ] = $value->map_meta_value;
								array_push( $maps_settings_array, $unserialize );
							}
							return $maps_settings_array;
						}
					}
					$get_map_parent_table_id = $wpdb->get_var(
						$wpdb->prepare(
							'SELECT id FROM ' . $wpdb->prefix . 'google_maps WHERE type = %s', 'maps'
						)
					); // WPCS: db call ok, no-cache ok.
					$get_map_id              = $wpdb->get_results(
						$wpdb->prepare(
							'SELECT id FROM ' . $wpdb->prefix . 'gmb_maps
							WHERE map_type = %s', 'map'
						)
					); // WPCS: db call ok, no-cache ok.
					if ( count( $get_map_id ) > 0 ) {
						foreach ( $get_map_id as $map_id ) {
							$mapid              = $map_id->id;
							$mapdata            = $wpdb->get_results(
								$wpdb->prepare(
									'SELECT * FROM ' . $wpdb->prefix . 'gmb_maps_meta
									WHERE map_id = %d', $mapid
								)
							); // WPCS: db call ok, no-cache ok.
							$maps_settings_data = array();
							foreach ( $mapdata as $data ) {
								$maps_settings_data[ $data->map_meta_key ] = $data->map_meta_value;
							}

							$old_maps_data_array                      = array();
							$old_maps_data_array['map_title']         = esc_attr( $maps_settings_data['map_title'] );
							$old_maps_data_array['map_description']   = '';
							$old_maps_data_array['map_address_type']  = 'formatted_address';
							$old_maps_data_array['formatted_address'] = esc_html( $maps_settings_data['location_title'] );
							$old_maps_data_array['map_latitude']      = floatval( $maps_settings_data['latitude'] );
							$old_maps_data_array['map_longitude']     = floatval( $maps_settings_data['longitude'] );
							$map_type                                 = 1;
							switch ( intval( $maps_settings_data['map_type'] ) ) {
								case 1:
									$map_type = 'roadmap';
									break;
								case 2:
									$map_type = 'terrain';
									break;
								case 3:
									$map_type = 'hybrid';
									break;
								case 4:
									$map_type = 'satellite';
									break;
							}
							$old_maps_data_array['map_type']       = $map_type;
							$old_maps_data_array['map_zoom_level'] = 18;

							$insert_old_map_data              = array();
							$insert_old_map_data['type']      = 'maps_settings';
							$insert_old_map_data['parent_id'] = $get_map_parent_table_id;
							$parent_last_id                   = $obj_dbhelper_google_maps->insert_command( google_maps(), $insert_old_map_data );

							$add_old_maps_meta_data               = array();
							$add_old_maps_meta_data['meta_id']    = $parent_last_id;
							$add_old_maps_meta_data['meta_key']   = 'maps_settings_data'; // WPCS: slow query ok.
							$add_old_maps_meta_data['meta_value'] = maybe_serialize( $old_maps_data_array ); // WPCS: slow query ok.
							$add_old_maps_meta_data['old_map_id'] = $mapid;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $add_old_maps_meta_data );
							$get_maps_overlay_type = $wpdb->get_results(
								$wpdb->prepare(
									'SELECT map_type,id FROM ' . $wpdb->prefix . 'gmb_maps
									WHERE parent_id = %d', $mapid
								)
							); // WPCS: db call ok, no-cache ok.
							/* Bind Overlays Data */
							foreach ( $get_maps_overlay_type as $overlay_type ) {
								switch ( $overlay_type->map_type ) {
									case 'marker':
										$marker_data_array = get_maps_overlays_data( $overlay_type->id ); // WPCS: db call ok, no-cache ok.
										foreach ( $marker_data_array as $value ) {
											$old_map_marker_data_array                         = array();
											$old_map_marker_data_array['marker_title']         = esc_attr( $value['marker_name'] );
											$old_map_marker_data_array['marker_description']   = isset( $value['description'] ) ? esc_html( $value['description'] ) : '';
											$old_map_marker_data_array['marker_type']          = 'formatted_address';
											$old_map_marker_data_array['marker_address']       = esc_html( $value['marker_location'] );
											$old_map_marker_data_array['marker_latitude']      = floatval( $value['marker_latitude'] );
											$old_map_marker_data_array['marker_longitude']     = floatval( $value['marker_longitude'] );
											$old_map_marker_data_array['marker_icon_type']     = 'choose_icon';
											$old_map_marker_data_array['marker_icon_category'] = intval( $value['marker_category'] );
											$old_map_marker_data_array['marker_icon_url']      = isset( $value['map_marker'] ) ? esc_attr( $value['map_marker'] ) : '';
											$old_map_marker_data_array['marker_icon_id']       = '';
											$old_map_marker_data_array['marker_icon_upload']   = isset( $value['map_marker'] ) ? esc_attr( $value['map_marker'] ) : '';
											$marker_animation                                  = 'none';
											switch ( intval( $value['animation'] ) ) {
												case 0:
													$marker_animation = 'drop';
													break;
												case 1:
													$marker_animation = 'bounce';
													break;
											}
											$old_map_marker_data_array['marker_animation'] = $marker_animation;
											$marker_infowindow                             = 'disable';
											switch ( intval( $value['info_window'] ) ) {
												case 0:
													$marker_infowindow = 'disable';
													break;
												case 1:
													$marker_infowindow = 'enable';
													break;
											}
											$old_map_marker_data_array['marker_info_window_show_hide']   = $marker_infowindow;
											$old_map_marker_data_array['marker_info_window_upload_path'] = isset( $value['info_window_image_url'] ) ? esc_attr( $value['info_window_image_url'] ) : '';

											$insert_old_marker_meta_data               = array();
											$insert_old_marker_meta_data['meta_id']    = $parent_last_id;
											$insert_old_marker_meta_data['meta_key']   = 'marker_settings_data'; // WPCS: slow query ok.
											$insert_old_marker_meta_data['meta_value'] = maybe_serialize( $old_map_marker_data_array ); // WPCS: slow query ok.
											$insert_old_marker_meta_data['old_map_id'] = $mapid;
											$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $insert_old_marker_meta_data );
										}
										break;
									case 'polygon':
										$polygon_data_array = get_maps_overlays_data( $overlay_type->id );
										foreach ( $polygon_data_array as $value ) {
											$old_map_polygon_data_array                               = array();
											$old_map_polygon_data_array['polygon_title']              = 'Untitled Polygon';
											$old_map_polygon_data_array['polygon_description']        = '';
											$old_map_polygon_data_array['polygon_stroke_weight']      = '2';
											$old_map_polygon_data_array['polygon_stroke_color_style'] = $value['polygon_line_color'] . ',' . intval( floatval( $value['polygon_line_opacity'] ) * 100 );
											$polygon_coordinates                                      = explode( "\n", $value['polygon_data'] );
											$corrdinates_data = array_filter( array_map( 'trim', $polygon_coordinates ), 'strlen' );
											$coordinates      = '';
											$flag             = 0;
											foreach ( $corrdinates_data as $data ) {
												if ( $flag <= count( $corrdinates_data ) - 1 ) {
													$coordinates .= '[' . $data . "]\n";
												}
												$polygon_corrdinates_data = $coordinates;
											}
											$old_map_polygon_data_array['polygon_coordinates']       = $polygon_corrdinates_data;
											$old_map_polygon_data_array['polygon_fill_color_style']  = $value['polygon_color'] . ',' . intval( floatval( $value['polygon_opacity'] ) * 100 );
											$old_map_polygon_data_array['polygon_info_window']       = 'disable';
											$old_map_polygon_data_array['polygon_image_upload_path'] = '';

											$insert_old_polygon_meta_data               = array();
											$insert_old_polygon_meta_data['meta_id']    = $parent_last_id;
											$insert_old_polygon_meta_data['meta_key']   = 'polygon_settings_data'; // WPCS: slow query ok.
											$insert_old_polygon_meta_data['meta_value'] = maybe_serialize( $old_map_polygon_data_array ); // WPCS: slow query ok.
											$insert_old_polygon_meta_data['old_map_id'] = $mapid;
											$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $insert_old_polygon_meta_data );
										}
										break;
									case 'polyline':
										$polyline_data_array = get_maps_overlays_data( $overlay_type->id );
										foreach ( $polyline_data_array as $value ) {
											$old_map_polyline_data_array                                  = array();
											$old_map_polyline_data_array['polyline_title']                = 'Untitled Polyline';
											$old_map_polyline_data_array['polyline_description']          = '';
											$old_map_polyline_data_array['polyline_stroke_width']         = isset( $value['polyline_thickness'] ) ? intval( $value['polyline_thickness'] ) : '';
											$old_map_polyline_data_array['polyline_stroke_color_opacity'] = $value['polyline_color'] . ',' . intval( floatval( $value['polyline_opacity'] ) * 100 );
											$polyline_type = 'solid';
											switch ( intval( $value['polyline_type'] ) ) {
												case 0:
													$polyline_type = 'solid';
													break;
												case 1:
													$polyline_type = 'dotted';
													break;
												case 2:
													$polyline_type = 'dashed';
													break;
											}
											$old_map_polyline_data_array['polyline_type'] = $polyline_type;
											$polyline_coordinates                         = explode( "\n", $value['polyline_data'] );
											$corrdinates_data                             = array_filter( array_map( 'trim', $polyline_coordinates ), 'strlen' );
											$coordinates                                  = '';
											$flag = 0;
											foreach ( $corrdinates_data as $value ) {
												if ( $flag <= count( $corrdinates_data ) - 1 ) {
													$coordinates .= '[' . $value . "]\n";
												}
												$polyline_corrdinates_data = $coordinates;
											}
											$old_map_polyline_data_array['polyline_cordinates']        = $polyline_corrdinates_data;
											$old_map_polyline_data_array['polyline_info_window']       = 'disable';
											$old_map_polyline_data_array['image_upload_polyline_path'] = '';

											$insert_old_polyline_meta_data               = array();
											$insert_old_polyline_meta_data['meta_id']    = $parent_last_id;
											$insert_old_polyline_meta_data['meta_key']   = 'polyline_settings_data'; // WPCS: slow query ok.
											$insert_old_polyline_meta_data['meta_value'] = maybe_serialize( $old_map_polyline_data_array ); // WPCS: slow query ok.
											$insert_old_polyline_meta_data['old_map_id'] = $mapid;
											$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $insert_old_polyline_meta_data );
										}
										break;
								}
							}
							$old_maps_layers_data                           = array();
							$old_maps_layers_data['bicycling_layer']        = isset( $maps_settings_data['bicycling_layer'] ) && intval( $maps_settings_data['bicycling_layer'] ) === 1 ? 'show' : 'hide';
							$old_maps_layers_data['traffic_layer']          = isset( $maps_settings_data['traffic_layer'] ) && intval( $maps_settings_data['traffic_layer'] ) === 1 ? 'show' : 'hide';
							$old_maps_layers_data['transit_layer']          = isset( $maps_settings_data['transit_layer'] ) && intval( $maps_settings_data['transit_layer'] ) === 1 ? 'show' : 'hide';
							$old_maps_layers_data['heatmap_layer']          = 'hide';
							$old_maps_layers_data['heatmap_gradient_color'] = 'hide';
							$old_maps_layers_data['heatmap_coordinates']    = '';
							$old_maps_layers_data['heatmap_opacity']        = '75';
							$old_maps_layers_data['heatmap_radius']         = '20';
							$old_maps_layers_data['fusion_table_layer']     = isset( $maps_settings_data['fussion_table_layer'] ) && intval( $maps_settings_data['fussion_table_layer'] ) === 1 ? 'show' : 'hide';
							$old_maps_layers_data['fusion_table_id']        = isset( $maps_settings_data['fussion_layer_table_name'] ) ? esc_attr( $maps_settings_data['fussion_layer_table_name'] ) : '';
							$old_maps_layers_data['kml_layer']              = isset( $maps_settings_data['kml_layer'] ) && intval( $maps_settings_data['kml_layer'] ) === 1 ? 'show' : 'hide';
							$old_maps_layers_data['kml_url']                = isset( $maps_settings_data['kml_layer_link'] ) ? esc_attr( $maps_settings_data['kml_layer_link'] ) : '';

							$insert_maps_layers_data_array               = array();
							$insert_maps_layers_data_array['meta_id']    = $parent_last_id;
							$insert_maps_layers_data_array['meta_key']   = 'layers_settings_data'; // WPCS: slow query ok.
							$insert_maps_layers_data_array['meta_value'] = maybe_serialize( $old_maps_layers_data ); // WPCS: slow query ok.
							$insert_maps_layers_data_array['old_map_id'] = $mapid;
							$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $insert_maps_layers_data_array );

							if ( isset( $maps_settings_data['circle_overlay'] ) && 1 === $maps_settings_data['circle_overlay'] ) {
								$old_map_circle_data_array                             = array();
								$old_map_circle_data_array['circle_title']             = esc_attr( $maps_settings_data['map_title'] );
								$old_map_circle_data_array['circle_description']       = '';
								$old_map_circle_data_array['circle_stroke_weight']     = intval( $maps_settings_data['circle_weight'] );
								$old_map_circle_data_array['circle_stroke_color']      = esc_attr( $maps_settings_data['stroke_color'] ) . ',' . intval( floatval( $maps_settings_data['circle_opacity'] ) * 100 );
								$old_map_circle_data_array['circle_fill_color']        = esc_attr( $maps_settings_data['fill_color'] ) . ',75';
								$old_map_circle_data_array['circle_radius_type']       = 'miles';
								$old_map_circle_data_array['circle_radius_value']      = intval( $maps_settings_data['circle_radius'] );
								$old_map_circle_data_array['circle_coordinates']       = 'Latitude : ' . floatval( $maps_settings_data['latitude'] ) . "\nLongitude : " . floatval( $maps_settings_data['longitude'] );
								$old_map_circle_data_array['circle_info_window']       = 'disable';
								$old_map_circle_data_array['image_upload_circle_path'] = '';

								$insert_old_circle_data               = array();
								$insert_old_circle_data['meta_id']    = $parent_last_id;
								$insert_old_circle_data['meta_key']   = 'circle_data'; // WPCS: slow query ok.
								$insert_old_circle_data['meta_value'] = maybe_serialize( $old_map_circle_data_array ); // WPCS: slow query ok.
								$insert_old_circle_data['old_map_id'] = $mapid;
								$obj_dbhelper_google_maps->insert_command( google_maps_meta(), $insert_old_circle_data );
							}
						}
					}
					$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gmb_maps' ); // @codingStandardsIgnoreLine.
					$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gmb_maps_meta' ); // @codingStandardsIgnoreLine.
				}
				$get_collate_status_data = $wpdb->query(
					$wpdb->prepare(
						'SELECT type FROM ' . $wpdb->prefix . 'google_maps WHERE type=%s', 'collation_type'
					)
				);// db call ok; no-cache ok.
				$charset_collate         = '';
				if ( ! empty( $wpdb->charset ) ) {
					$charset_collate .= 'CONVERT TO CHARACTER SET ' . $wpdb->charset;
				}
				if ( ! empty( $wpdb->collate ) ) {
					$charset_collate .= ' COLLATE ' . $wpdb->collate;
				}
				if ( 0 === $get_collate_status_data ) {
					if ( ! empty( $charset_collate ) ) {
						$change_collate_main_table = $wpdb->query(
							'ALTER TABLE ' . $wpdb->prefix . 'google_maps ' . $charset_collate // @codingStandardsIgnoreLine.
						);// WPCS: db call ok, no-cache ok.
						$change_collate_meta_table = $wpdb->query(
							'ALTER TABLE ' . $wpdb->prefix . 'google_maps_meta ' . $charset_collate // @codingStandardsIgnoreLine.
						);// WPCS: db call ok, no-cache ok.

						$collation_data_array              = array();
						$collation_data_array['type']      = 'collation_type';
						$collation_data_array['parent_id'] = '0';
						$obj_dbhelper_google_maps->insert_command( google_maps(), $collation_data_array );
					}
				}
				break;
		}
		update_option( 'google-maps-bank-version-number', '2.0.1' );
	}
}
