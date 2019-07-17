<?php
/**
 * This file is used for fetching data from database.
 *
 * @author  Tech Banker
 * @package google-maps-bank/includes
 * @version  2.0.0
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
		if ( ! function_exists( 'get_google_map_meta_data' ) ) {
			/**
			 * This function is used to get meta data.
			 *
			 * @param string $meta_key passes parameter as meta key.
			 */
			function get_google_map_meta_data( $meta_key ) {
				global $wpdb;
				$data = $wpdb->get_var(
					$wpdb->prepare(
						'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s', $meta_key
					)
				);// WPCS: db call ok, cache ok.
				return maybe_unserialize( $data );
			}
		}
		if ( ! function_exists( 'get_google_map_settings' ) ) {
			/**
			 * This function is used to get meta data.
			 *
			 * @param string $mapid passes parameter as meta id.
			 * @param string $meta_key passes parameter as meta key.
			 */
			function get_google_map_settings( $mapid, $meta_key ) {
				global $wpdb;
				$maps_settings = $wpdb->get_var(
					$wpdb->prepare(
						'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_id = %d AND meta_key = %s', $mapid, $meta_key
					)
				);// WPCS: db call ok, cache ok.
				return maybe_unserialize( $maps_settings );
			}
		}
		if ( ! function_exists( 'get_google_maps_unserialize_data' ) ) {
			/**
			 * This function is used to get meta data.
			 *
			 * @param string $meta_key passes parameter as meta key.
			 */
			function get_google_maps_unserialize_data( $meta_key ) {
				global $wpdb;
				$unserialize_data = $wpdb->get_results(
					$wpdb->prepare(
						'SELECT meta_id,meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key=%s ORDER BY meta_id DESC', $meta_key
					)
				);// WPCS: db call ok, cache ok.
				$serialize_data   = array();
				foreach ( $unserialize_data as $value ) {
					$unserialize            = maybe_unserialize( $value->meta_value );
					$unserialize['meta_id'] = $value->meta_id;
					array_push( $serialize_data, $unserialize );
				}
				return $serialize_data;
			}
		}
		/**
		 * This function is used for font families.
		 *
		 * @param string $font_families passes parameter as font families.
		 */
		function font_families_google_map( $font_families ) {
			foreach ( $font_families as $font_family ) {
				if ( 'inherit' !== $font_family ) {
					if ( strpos( $font_family, ':' ) !== false ) {
						$position           = strpos( $font_family, ':' );
						$font_style         = ( substr( $font_family, $position + 4, 6 ) === 'italic' ) ? "\r\n\tfont-style: italic !important;" : '';
						$font_family_name[] = "'" . substr( $font_family, 0, $position ) . "' !important;\r\n\tfont-weight: " . substr( $font_family, $position + 1, 3 ) . ' !important;' . $font_style;
					} else {
						$font_family_name[] = ( strpos( $font_family, '&' ) !== false ) ? "'" . strstr( $font_family, '&', 1 ) . "' !important;" : "'" . $font_family . "' !important;";
					}
				} else {
					$font_family_name[] = 'inherit';
				}
			}
			return $font_family_name;
		}

		/**
		 * This function is used for font families.
		 *
		 * @param string $unique_font_families passes parameter as unique font families.
		 */
		function unique_font_families_google_maps_bank( $unique_font_families ) {
			$import_font_family = '';
			foreach ( $unique_font_families as $font_family ) {
				if ( 'inherit' !== $font_family ) {
					$font_family = urlencode( $font_family ); // @codingStandardsIgnoreLine.
					if ( is_ssl() ) {
						$import_font_family .= "@import url('https://fonts.googleapis.com/css?family=" . $font_family . "');\r\n";
					} else {
						$import_font_family .= "@import url('http://fonts.googleapis.com/css?family=" . $font_family . "');\r\n";
					}
				}
			}
			return $import_font_family;
		}

		if ( ! function_exists( 'get_google_maps_info_window' ) ) {
			/**
			 * This function is used to get info window details.
			 *
			 * @param string $details_info_window passes parameter as details info window.
			 * @param string $custom_css_data passes parameter as unique custom css data.
			 */
			function get_google_maps_info_window( $details_info_window, $custom_css_data ) {
				$fonts_family_array      = array( $details_info_window['info_window_title_font_family'], $details_info_window['info_window_desc_font_family'] );
				$font_array              = array_unique( $fonts_family_array );
				$import_font_family      = unique_font_families_google_maps_bank( $font_array );
				$font_family_name_layout = font_families_google_map( $fonts_family_array );

				$infowindow_border_style       = isset( $details_info_window['info_window_border_style'] ) ? explode( ',', $details_info_window['info_window_border_style'] ) : '0,none,#000000';
				$info_window_image_padding     = isset( $details_info_window['info_windows_image_padding'] ) ? explode( ',', $details_info_window['info_windows_image_padding'] ) : '10,10,0,10';
				$info_window_text_padding      = isset( $details_info_window['info_windows_text_padding'] ) ? explode( ',', $details_info_window['info_windows_text_padding'] ) : '10,0,0,10';
				$info_window_description_style = isset( $details_info_window['info_window_desc_style'] ) ? explode( ',', $details_info_window['info_window_desc_style'] ) : '12,#000000';
				$info_window_title_style       = isset( $details_info_window['info_window_title_style'] ) ? explode( ',', $details_info_window['info_window_title_style'] ) : '15,#000000';
				?>
				<style type="text/css">
					[class^="icon-custom"]::before, [class*=" icon-custom"]::before
					{
						margin-left: 0px !important;
						margin-right: 0.5em !important;
					}
					.gmb-style-infowindow
					{
						line-height: 1.35;
						overflow: hidden;
						word-wrap: break-word;
						border: <?php echo intval( $infowindow_border_style[0] ); ?>px <?php echo esc_attr( $infowindow_border_style[1] ); ?> <?php echo esc_attr( $infowindow_border_style[2] ); ?>;
						border-radius: <?php echo intval( $details_info_window['info_window_border_radius'] ); ?>px !important;
						width: <?php echo intval( $details_info_window['info_window_width'] ); ?>px;
					}
					.store-locator-style
					{
						line-height: 1.35 !important;
						margin-top: -2px !important;
						padding: <?php echo intval( $info_window_text_padding[0] ); ?>px <?php echo intval( $info_window_text_padding[1] ); ?>px <?php echo intval( $info_window_text_padding[2] ); ?>px <?php echo intval( $info_window_text_padding[3] ); ?>px;
					}
					.store-description-style
					{
						word-break: break-word;
						font-size : <?php echo intval( $info_window_description_style[0] ); ?>px;
						color: <?php echo esc_attr( $info_window_description_style[1] ); ?>;
						font-family:<?php echo isset( $font_family_name_layout[1] ) ? htmlspecialchars_decode( $font_family_name_layout[1] ) : 'Roboto Condensed';// WPCS: XSS ok. ?>
					}
					.gmb-image-padding-position
					{
						padding: <?php echo intval( $info_window_image_padding[0] ); ?>px <?php echo intval( $info_window_image_padding[1] ); ?>px <?php echo intval( $info_window_image_padding[2] ); ?>px <?php echo intval( $info_window_image_padding[3] ); ?>px;
						float: <?php echo esc_attr( $details_info_window['info_window_image_position'] ); ?>;
					}
					.store-title-style
					{
						font-size: <?php echo intval( $info_window_title_style[0] ); ?>px;
						color: <?php echo esc_attr( $info_window_title_style[1] ); ?>;
						font-family:<?php echo isset( $font_family_name_layout[0] ) ? htmlspecialchars_decode( $font_family_name_layout[0] ) : 'Roboto Condensed';// WPCS: XSS ok. ?>
					}
				<?php echo htmlspecialchars_decode( $custom_css_data['custom_css'] );// WPCS: XSS ok. ?>
				</style>
				<?php
			}
		}
		if ( ! function_exists( 'get_google_maps_overlays_data' ) ) {
			/**
			 * This function is used to get overlay data.
			 *
			 * @param string $meta_key passes parameter as meta key.
			 * @param string $mapid passes parameter as mapid.
			 */
			function get_google_maps_overlays_data( $meta_key, $mapid ) {
				global $wpdb;
				$unserialize_map_data = $wpdb->get_results(
					$wpdb->prepare(
						'SELECT * FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_id=%d AND meta_key=%s ORDER BY id DESC', $mapid, $meta_key
					)
				);// WPCS: db call ok, cache ok.
				$serialize_map_data   = array();
				foreach ( $unserialize_map_data as $value ) {
					$unserialize            = maybe_unserialize( $value->meta_value );
					$unserialize['id']      = $value->id;
					$unserialize['meta_id'] = $value->meta_id;
					array_push( $serialize_map_data, $unserialize );
				}
				return $serialize_map_data;
			}
		}
		if ( ! function_exists( 'google_maps_edit_data' ) ) {
			/**
			 * This function is google_maps_edit_data.
			 *
			 * @param string $markerid passes parameter as markerid.
			 * @param string $meta_key passes parameter as meta key.
			 * @param string $mapid passes parameter as mapid.
			 */
			function google_maps_edit_data( $markerid, $meta_key, $mapid ) {
				global $wpdb;
				$unserialize_edit_data = $wpdb->get_var(
					$wpdb->prepare(
						'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE id = %d AND meta_key = %s AND meta_id = %d', $markerid, $meta_key, $mapid
					)
				);// WPCS: db call ok, cache ok.
				return maybe_unserialize( $unserialize_edit_data );
			}
		}
		global $wpdb;
		if ( isset( $_GET['page'] ) ) {
			$page = sanitize_text_field( wp_unslash( $_GET['page'] ) );// WPCS: CSRF ok,WPCS: input var ok.
		}
		$check_google_map_wizard = get_option( 'google-map-bank-wizard-set-up' );
		$page_url                = false === $check_google_map_wizard ? 'gmb_wizard_google_map' : $page;
		if ( isset( $_GET['page'] ) ) {// WPCS: CSRF ok, input var ok.
			switch ( $page_url ) {
				case 'gmb_google_maps':
					$google_maps_unserialize_data = get_google_maps_unserialize_data( 'maps_settings_data' );
					break;

				case 'gmb_add_map':
					$details_info_window       = get_google_map_meta_data( 'info_window_settings' );
					$custom_css_serialize_data = get_google_map_meta_data( 'custom_css' );
					$google_maps_info_window   = get_google_maps_info_window( $details_info_window, $custom_css_serialize_data );
					if ( isset( $_REQUEST['google_map_id'] ) ) {// WPCS: CSRF ok, input var ok.
						$mapid                            = intval( $_REQUEST['google_map_id'] );// WPCS: input var ok.
						$serialized_map_data              = get_google_map_settings( $mapid, 'maps_settings_data' );
						$google_maps_marker_data          = get_google_maps_overlays_data( 'marker_settings_data', $mapid );
						$google_polyline_unserialize_data = get_google_maps_overlays_data( 'polyline_settings_data', $mapid );
						$google_maps_polygon_data         = get_google_maps_overlays_data( 'polygon_settings_data', $mapid );
						$google_map_circle_data           = get_google_maps_overlays_data( 'circle_data', $mapid );
						$google_map_rectangle_data        = get_google_maps_overlays_data( 'rectangle_data', $mapid );
						$google_map_layers_data           = get_google_map_settings( $mapid, 'layers_settings_data' );
						if ( isset( $_REQUEST['edit'] ) ) {// WPCS: CSRF ok, input var ok.
							$editid                        = intval( $_REQUEST['edit'] );// WPCS: input var ok.
							$serialize_edit_data           = google_maps_edit_data( $editid, 'marker_settings_data', $mapid );
							$serialize_circle_edit_data    = google_maps_edit_data( $editid, 'circle_data', $mapid );
							$serialize_rectangle_edit_data = google_maps_edit_data( $editid, 'rectangle_data', $mapid );
							$serialize_polygon_edit_data   = google_maps_edit_data( $editid, 'polygon_settings_data', $mapid );
							$serialize_polyline_edit_data  = google_maps_edit_data( $editid, 'polyline_settings_data', $mapid );
						}
					}
					break;

				case 'gmb_manage_overlays':
					$details_info_window       = get_google_map_meta_data( 'info_window_settings' );
					$custom_css_serialize_data = get_google_map_meta_data( 'custom_css' );
					$google_maps_info_window   = get_google_maps_info_window( $details_info_window, $custom_css_serialize_data );
					$choose_map_data           = get_google_maps_unserialize_data( 'maps_settings_data', $custom_css_serialize_data );
					if ( isset( $_REQUEST['google_map_id'] ) ) {// WPCS: CSRF ok, input var ok.
						$id                               = intval( $_REQUEST['google_map_id'] );// WPCS: input var ok.
						$serialized_map_data              = get_google_map_settings( $id, 'maps_settings_data' );
						$google_maps_marker_data          = get_google_maps_overlays_data( 'marker_settings_data', $id );
						$google_maps_polygon_data         = get_google_maps_overlays_data( 'polygon_settings_data', $id );
						$google_polyline_unserialize_data = get_google_maps_overlays_data( 'polyline_settings_data', $id );
						$google_map_circle_data           = get_google_maps_overlays_data( 'circle_data', $id );
						$google_map_rectangle_data        = get_google_maps_overlays_data( 'rectangle_data', $id );
					}
					break;

				case 'gmb_add_overlays':
					$details_info_window       = get_google_map_meta_data( 'info_window_settings' );
					$custom_css_serialize_data = get_google_map_meta_data( 'custom_css' );
					$google_maps_info_window   = get_google_maps_info_window( $details_info_window, $custom_css_serialize_data );
					$choose_map_data           = get_google_maps_unserialize_data( 'maps_settings_data' );
					if ( isset( $_REQUEST['google_map_id'] ) ) {// WPCS: CSRF ok, input var ok.
						$mapid               = intval( $_REQUEST['google_map_id'] );// WPCS: input var ok.
						$serialized_map_data = get_google_map_settings( $mapid, 'maps_settings_data' );
						if ( isset( $_REQUEST['edit'] ) ) {// WPCS: CSRF ok.
							$editid                                = intval( $_REQUEST['edit'] );// WPCS: input var ok.
							$serialize_overlay_edit_data           = google_maps_edit_data( $editid, 'marker_settings_data', $mapid );
							$serialize_overlay_polygon_edit_data   = google_maps_edit_data( $editid, 'polygon_settings_data', $mapid );
							$polyline_overlays_edit_data           = google_maps_edit_data( $editid, 'polyline_settings_data', $mapid );
							$serialize_circle_overlay_edit_data    = google_maps_edit_data( $editid, 'circle_data', $mapid );
							$serialize_rectangle_overlay_edit_data = google_maps_edit_data( $editid, 'rectangle_data', $mapid );
						}
					}
					break;

				case 'gmb_layers':
					$details_info_window       = get_google_map_meta_data( 'info_window_settings' );
					$custom_css_serialize_data = get_google_map_meta_data( 'custom_css' );
					$google_maps_info_window   = get_google_maps_info_window( $details_info_window, $custom_css_serialize_data );
					$choose_map_data           = get_google_maps_unserialize_data( 'maps_settings_data' );
					if ( isset( $_REQUEST['google_map_id'] ) ) {// WPCS: CSRF ok, input var ok.
						$mapid                            = intval( $_REQUEST['google_map_id'] );// WPCS: input var ok.
						$serialized_map_data              = get_google_map_settings( $mapid, 'maps_settings_data' );
						$layers_data_unserialized         = get_google_map_settings( $mapid, 'layers_settings_data' );
						$google_maps_marker_data          = get_google_maps_overlays_data( 'marker_settings_data', $mapid );
						$google_maps_polygon_data         = get_google_maps_overlays_data( 'polygon_settings_data', $mapid );
						$google_polyline_unserialize_data = get_google_maps_overlays_data( 'polyline_settings_data', $mapid );
						$google_map_circle_data           = get_google_maps_overlays_data( 'circle_data', $mapid );
						$google_map_rectangle_data        = get_google_maps_overlays_data( 'rectangle_data', $mapid );
					}
					break;

				case 'gmb_manage_store':
					$google_maps_unserialize_data   = get_google_maps_unserialize_data( 'maps_settings_data' );
					$store_locator_unserialize_data = get_google_maps_unserialize_data( 'store_locator_data' );
					break;

				case 'gmb_add_store':
					$details_info_window       = get_google_map_meta_data( 'info_window_settings' );
					$custom_css_serialize_data = get_google_map_meta_data( 'custom_css' );
					$google_maps_info_window   = get_google_maps_info_window( $details_info_window, $custom_css_serialize_data );
					$choose_map_data           = get_google_maps_unserialize_data( 'maps_settings_data' );
					if ( isset( $_REQUEST['id'] ) ) {// WPCS: CSRF ok, input var ok.
						$edit_id                           = intval( $_REQUEST['id'] );// WPCS: input var ok.
						$serialize_store_locator_edit_data = get_google_map_settings( $edit_id, 'store_locator_data' );
					}
					break;

				case 'gmb_info_window':
					$details_info_window = get_google_map_meta_data( 'info_window_settings' );
					break;

				case 'gmb_directions':
					$details_directions = get_google_map_meta_data( 'directions_settings' );
					break;

				case 'gmb_store_locator':
					$details_store_locator = get_google_map_meta_data( 'store_locator_settings' );
					break;

				case 'gmb_map_customization':
					$details_map_customization = get_google_map_meta_data( 'map_customization' );
					break;

				case 'gmb_custom_css':
					$details_custom_css = get_google_map_meta_data( 'custom_css' );
					break;

				case 'gmb_shortcode':
					$choose_map_data = get_google_maps_unserialize_data( 'maps_settings_data' );
					break;

				case 'gmb_other_settings':
					$details_other_settings = get_google_map_meta_data( 'other_settings' );
					break;

				case 'gmb_roles_and_capabilities':
					$details_roles_capabilities   = get_google_map_meta_data( 'roles_and_capabilities' );
					$gmb_other_roles_access_array = array(
						'manage_options',
						'edit_plugins',
						'edit_posts',
						'publish_posts',
						'publish_pages',
						'edit_pages',
						'read',
					);
					$other_roles_array            = isset( $details_roles_capabilities['capabilities'] ) && '' !== $details_roles_capabilities['capabilities'] ? $details_roles_capabilities['capabilities'] : $gmb_other_roles_access_array;
					break;
			}
		}
	}
}
