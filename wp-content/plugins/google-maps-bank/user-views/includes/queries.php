<?php
/**
 * This File fetching data from database.
 *
 * @author  Tech Banker
 * @package google-maps-bank/user-views/includes
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//exit if accessed directly
if ( isset( $map_id ) ) {

	if ( ! function_exists( 'get_google_map_data_meta_value' ) ) {
		/**
		 * This function is used to get the meta_value from database.
		 *
		 * @param intval $map_id passes parameter as map id.
		 * @param string $meta_key passes parameter as meta key.
		 */
		function get_google_map_data_meta_value( $map_id, $meta_key ) {
			global $wpdb;
			$maps_settings_data    = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE old_map_id = %d AND meta_key = %s', $map_id, $meta_key
				)
			);// WPCS: db call ok, cache ok.
			$map_unserialized_data = maybe_unserialize( $maps_settings_data );
			return $map_unserialized_data;
		}
	}
	$map_unserialized_data            = get_google_map_data_meta_value( $map_id, 'maps_settings_data' );

	if ( ! function_exists( 'get_overlays_settings_data' ) ) {
		/**
		 * This function is used to fetch the all data according to the meta_id and meta_key.
		 *
		 * @param intval $map_id passes parameter as map id.
		 * @param string $meta_key passes parameter as meta key.
		 */
		function get_overlays_settings_data( $map_id, $meta_key ) {
			global $wpdb;
			$serialize_overlays_settings_data = $wpdb->get_results(
				$wpdb->prepare(
					'SELECT * FROM ' . $wpdb->prefix . 'google_maps_meta WHERE old_map_id = %d AND meta_key = %s', $map_id, $meta_key
				)
			);// WPCS: db call ok, cache ok.
			$overlays_settings_data           = array();
			foreach ( $serialize_overlays_settings_data as $value ) {
				$unserialize            = maybe_unserialize( $value->meta_value );
				$unserialize['id']      = $value->id;
				$unserialize['meta_id'] = $value->meta_id;
				array_push( $overlays_settings_data, $unserialize );
			}
			return $overlays_settings_data;
		}
	}
	$overlays_settings_marker_data    = get_overlays_settings_data( $map_id, 'marker_settings_data' );
	$overlays_settings_polygon_data   = get_overlays_settings_data( $map_id, 'polygon_settings_data' );
	$overlays_settings_polyline_data  = get_overlays_settings_data( $map_id, 'polyline_settings_data' );
	$overlays_settings_circle_data    = get_overlays_settings_data( $map_id, 'circle_data' );
}

if ( isset( $maps_id ) && '' !== $maps_id ) {
	if ( ! function_exists( 'get_google_map_meta_value' ) ) {
		/**
		 * This function is used to fetch the all data according to the $maps_id and meta_key.
		 *
		 * @param intval $maps_id passes parameter as maps id.
		 * @param string $meta_key passes parameter as meta key.
		 */
		function get_google_map_meta_value( $maps_id, $meta_key ) {
			global $wpdb;
			$maps_settings_data          = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_id = %d AND meta_key = %s', $maps_id, $meta_key
				)
			);// WPCS: db call ok, cache ok.
			$map_unserialized_data_array = maybe_unserialize( $maps_settings_data );
			return $map_unserialized_data_array;
		}
	}
	$map_unserialized_data            = get_google_map_meta_value( $maps_id, 'maps_settings_data' );

	if ( ! function_exists( 'get_overlays_maps_settings_data' ) ) {
		/**
		 * This function is used to fetch the all data according to the $maps_id and meta_key.
		 *
		 * @param intval $maps_id passes parameter as maps id.
		 * @param string $meta_key passes parameter as meta key.
		 */
		function get_overlays_maps_settings_data( $maps_id, $meta_key ) {
			global $wpdb;
			$serialize_overlays_settings_data = $wpdb->get_results(
				$wpdb->prepare(
					'SELECT * FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_id = %d AND meta_key = %s', $maps_id, $meta_key
				)
			);// WPCS: db call ok, cache ok.
			$overlays_settings_data           = array();
			foreach ( $serialize_overlays_settings_data as $value ) {
				$unserialize            = maybe_unserialize( $value->meta_value );
				$unserialize['id']      = $value->id;
				$unserialize['meta_id'] = $value->meta_id;
				array_push( $overlays_settings_data, $unserialize );
			}
			return $overlays_settings_data;
		}
	}
	$overlays_settings_marker_data    = get_overlays_maps_settings_data( $maps_id, 'marker_settings_data' );
	$overlays_settings_polygon_data   = get_overlays_maps_settings_data( $maps_id, 'polygon_settings_data' );
	$overlays_settings_polyline_data  = get_overlays_maps_settings_data( $maps_id, 'polyline_settings_data' );
	$overlays_settings_circle_data    = get_overlays_maps_settings_data( $maps_id, 'circle_data' );
}

if ( ! function_exists( 'get_layout_settings' ) ) {
	/**
	 * This function is used to fetch the data from database according to the meta_key.
	 *
	 * @param string $meta_key passes parameter as meta key.
	 */
	function get_layout_settings( $meta_key ) {
		global $wpdb;
		$layout_settings_data = $wpdb->get_var(
			$wpdb->prepare(
				'SELECT meta_value FROM ' . $wpdb->prefix . 'google_maps_meta WHERE meta_key = %s', $meta_key
			)
		);// WPCS: db call ok, cache ok.
		return maybe_unserialize( $layout_settings_data );
	}
}
$other_settings_unserialize             = get_layout_settings( 'other_settings' );
$layout_settings_info_window_settings   = get_layout_settings( 'info_window_settings' );
$map_customization_settings             = get_layout_settings( 'map_customization' );
$custom_css_data                        = get_layout_settings( 'custom_css' );
