<?php
/**
 * This File contains frontend css.
 *
 * @author  Tech Banker
 * @package google-maps-bank/user-views/styles
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//exit if accessed directly

$fonts_family_array = array(
	isset( $layout_settings_directions_settings['directions_header_font_family'] ) ? $layout_settings_directions_settings['directions_header_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_directions_settings['directions_label_font_family'] ) ? $layout_settings_directions_settings['directions_label_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_directions_settings['directions_input_field_font_family'] ) ? $layout_settings_directions_settings['directions_input_field_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_directions_settings['directions_button_font_family'] ) ? $layout_settings_directions_settings['directions_button_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_directions_settings['directions_display_text_font_family'] ) ? $layout_settings_directions_settings['directions_display_text_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_info_window_settings['info_window_title_font_family'] ) ? $layout_settings_info_window_settings['info_window_title_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_info_window_settings['info_window_desc_font_family'] ) ? $layout_settings_info_window_settings['info_window_desc_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_header_title_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_header_title_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_label_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_label_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_button_text_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_button_text_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_input_field_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_input_field_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_input_field_placeholder_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_input_field_placeholder_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_directions_settings['directions_placeholder_font_family'] ) ? $layout_settings_directions_settings['directions_placeholder_font_family'] : 'Roboto Condensed',
	isset( $map_customization_settings['map_title_font_family'] ) ? $map_customization_settings['map_title_font_family'] : 'Roboto Condensed',
	isset( $map_customization_settings['map_description_font_family'] ) ? $map_customization_settings['map_description_font_family'] : 'Roboto Condensed',
	isset( $layout_settings_store_locator_settings['store_locator_table_text_font_family'] ) ? $layout_settings_store_locator_settings['store_locator_table_text_font_family'] : 'Roboto Condensed',
);

if ( ! function_exists( 'font_families_google_map' ) ) {
	/**
	 * This function is used for font-family.
	 *
	 * @param array $font_families .
	 */
	function font_families_google_map( $font_families ) {
		foreach ( $font_families as $font_family ) {
			if ( 'inherit' !== $font_family ) {
				if ( false !== strpos( $font_family, ':' ) ) {
					$position           = strpos( $font_family, ':' );
					$font_style         = ( 'italic' === substr( $font_family, $position + 4, 6 ) ) ? "\r\n\tfont-style: italic !important;" : '';
					$font_family_name[] = "'" . substr( $font_family, 0, $position ) . "' !important;\r\n\tfont-weight: " . substr( $font_family, $position + 1, 3 ) . ' !important;' . $font_style;
				} else {
					$font_family_name[] = ( false !== strpos( $font_family, '&' ) ) ? "'" . strstr( $font_family, '&', 1 ) . "' !important;" : "'" . $font_family . "' !important;";
				}
			} else {
				$font_family_name[] = 'inherit';
			}
		}
		return $font_family_name;
	}
}

if ( ! function_exists( 'unique_font_families_google_maps_bank' ) ) {
	/**
	 * This function is used for font-family.
	 *
	 * @param array $unique_font_families .
	 */
	function unique_font_families_google_maps_bank( $unique_font_families ) {
		$import_font_family = '';
		foreach ( $unique_font_families as $font_family ) {
			if ( 'inherit' !== $font_family ) {
				$font_family = urlencode( $font_family );// @codingStandardsIgnoreLine.
				if ( is_ssl() ) {
					$import_font_family .= "@import url('https://fonts.googleapis.com/css?family=" . $font_family . "');\r\n";
				} else {
					$import_font_family .= "@import url('http://fonts.googleapis.com/css?family=" . $font_family . "');\r\n";
				}
			}
		}
		return $import_font_family;
	}
}


$font_array              = array_unique( $fonts_family_array );
$import_font_family      = unique_font_families_google_maps_bank( $font_array );
$font_family_name_layout = font_families_google_map( $fonts_family_array );

if ( ! function_exists( 'convert_hex_rgb_google_maps' ) ) {
	/**
	 * This function is used convert color from hex to rgb.
	 *
	 * @param string $color .
	 */
	function convert_hex_rgb_google_maps( $color ) {
		$hex = str_replace( '#', '', $color );
		if ( strlen( $hex ) === 3 ) {
			$rgb_array[0] = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$rgb_array[1] = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$rgb_array[2] = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$rgb_array[0] = hexdec( substr( $hex, 0, 2 ) );
			$rgb_array[1] = hexdec( substr( $hex, 2, 2 ) );
			$rgb_array[2] = hexdec( substr( $hex, 4, 2 ) );
		}
		return $rgb_array;
	}
}

// Directions.
$directions_header_title_style            = isset( $layout_settings_directions_settings['directions_header_title_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_header_title_style'] ) : array( '30', '#000000' );
$directions_label_style                   = isset( $layout_settings_directions_settings['directions_label_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_label_style'] ) : array( '17', '#000000' );
$directions_input_field_text_style        = isset( $layout_settings_directions_settings['directions_input_field_text_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_input_field_text_style'] ) : array( '15', '#000000' );
$directions_button_text_style             = isset( $layout_settings_directions_settings['directions_button_text_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_button_text_style'] ) : array( '15', '#ffffff' );
$directions_display_text_style            = isset( $layout_settings_directions_settings['directions_display_text_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_display_text_style'] ) : array( '14', '#000000' );
$directions_display_border_style          = isset( $layout_settings_directions_settings['directions_display_border_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_display_border_style'] ) : array( '0', 'none', '#a4cd39' );
$directions_input_field_placeholder_style = isset( $layout_settings_directions_settings['directions_input_field_placeholder_style'] ) ? explode( ',', $layout_settings_directions_settings['directions_input_field_placeholder_style'] ) : array( '14', '#000000' );

$directions_input_field_margin      = isset( $layout_settings_directions_settings['directions_input_field_margin'] ) ? explode( ',', $layout_settings_directions_settings['directions_input_field_margin'] ) : array( '0', '0', '10', '0' );
$directions_input_field_padding     = isset( $layout_settings_directions_settings['directions_input_field_padding'] ) ? explode( ',', $layout_settings_directions_settings['directions_input_field_padding'] ) : array( '6', '6', '8', '8' );
$directions_button_height_and_width = isset( $layout_settings_directions_settings['directions_button_height_and_width'] ) ? explode( ',', $layout_settings_directions_settings['directions_button_height_and_width'] ) : array( '50', '100' );

$directions_general_color_code     = convert_hex_rgb_google_maps( isset( $layout_settings_directions_settings['directions_general_background_color'] ) ? esc_attr( $layout_settings_directions_settings['directions_general_background_color'] ) : 'transparent' );
$directions_header_color_code      = convert_hex_rgb_google_maps( isset( $layout_settings_directions_settings['directions_background_color'] ) ? esc_attr( $layout_settings_directions_settings['directions_background_color'] ) : '#ffffff' );
$directions_input_field_color_code = convert_hex_rgb_google_maps( isset( $layout_settings_directions_settings['directions_input_field_background_color'] ) ? esc_attr( $layout_settings_directions_settings['directions_input_field_background_color'] ) : '#ffffff' );
$directions_button_color_code      = convert_hex_rgb_google_maps( isset( $layout_settings_directions_settings['directions_button_background_color'] ) ? esc_attr( $layout_settings_directions_settings['directions_button_background_color'] ) : '#a4cd39' );
$directions_color_code             = convert_hex_rgb_google_maps( isset( $layout_settings_directions_settings['directions_display_background_color'] ) ? esc_attr( $layout_settings_directions_settings['directions_display_background_color'] ) : '#ffffff' );

// InfoWindow.
$info_window_title_style       = isset( $layout_settings_info_window_settings['info_window_title_style'] ) ? explode( ',', $layout_settings_info_window_settings['info_window_title_style'] ) : array( '15', '#000000' );
$info_window_description_style = isset( $layout_settings_info_window_settings['info_window_desc_style'] ) ? explode( ',', $layout_settings_info_window_settings['info_window_desc_style'] ) : array( '12', '#000000' );
$infowindow_border_style       = isset( $layout_settings_info_window_settings['info_window_border_style'] ) ? explode( ',', $layout_settings_info_window_settings['info_window_border_style'] ) : array( '0', 'none', '#000000' );
$info_window_image_padding     = isset( $layout_settings_info_window_settings['info_windows_image_padding'] ) ? explode( ',', $layout_settings_info_window_settings['info_windows_image_padding'] ) : array( '10', '10', '0', '10' );
$info_window_text_padding      = isset( $layout_settings_info_window_settings['info_windows_text_padding'] ) ? explode( ',', $layout_settings_info_window_settings['info_windows_text_padding'] ) : array( '10', '0', '0', '10' );

// Store Locator.
$store_locator_header_style           = isset( $layout_settings_store_locator_settings['store_locator_header_title_style'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_header_title_style'] ) : array( '30', '#000000' );
$store_locator_label_style            = isset( $layout_settings_store_locator_settings['store_locator_label_style'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_label_style'] ) : array( '17', '#000000' );
$store_locator_button_text_style      = isset( $layout_settings_store_locator_settings['store_locator_button_text_style'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_button_text_style'] ) : array( '15', '#ffffff' );
$store_locator_input_field_text_style = isset( $layout_settings_store_locator_settings['store_locator_input_field_text_style'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_input_field_text_style'] ) : array( '15', '#000000' );
$store_locator_placeholder_style      = isset( $layout_settings_store_locator_settings['store_locator_input_field_placeholder_style'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_input_field_placeholder_style'] ) : array( '15,#000000' );

$store_locator_button_height_width = isset( $layout_settings_store_locator_settings['store_locator_button_height_and_width'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_button_height_and_width'] ) : array( '50', '100' );
$store_locator_input_field_margin  = isset( $layout_settings_store_locator_settings['store_locator_input_field_margin'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_input_field_margin'] ) : array( '0', '0', '10', '0' );
$store_locator_input_field_padding = isset( $layout_settings_store_locator_settings['store_locator_input_field_padding'] ) ? explode( ',', $layout_settings_store_locator_settings['store_locator_input_field_padding'] ) : array( '6', '6', '8', '8' );

$store_locator_general_color_code     = convert_hex_rgb_google_maps( isset( $layout_settings_store_locator_settings['store_locator_general_background_color'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_general_background_color'] ) : 'transparent' );
$store_locator_header_color_code      = convert_hex_rgb_google_maps( isset( $layout_settings_store_locator_settings['store_locator_background_color'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_background_color'] ) : '#ffffff' );
$store_locator_input_field_color_code = convert_hex_rgb_google_maps( isset( $layout_settings_store_locator_settings['store_locator_input_field_background_color'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_input_field_background_color'] ) : '#ffffff' );
$store_locator_button_color_code      = convert_hex_rgb_google_maps( isset( $layout_settings_store_locator_settings['store_locator_button_background_color'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_button_background_color'] ) : '#a4cd39' );

$store_locator_table_style                = isset( $layout_settings_store_locator_settings['store_locator_table_text_style'] ) ? explode( ',', esc_attr( $layout_settings_store_locator_settings['store_locator_table_text_style'] ) ) : '14,#ffffff';
$store_locator_table_display_border_style = isset( $layout_settings_store_locator_settings['store_locator_table_border_style'] ) ? explode( ',', esc_attr( $layout_settings_store_locator_settings['store_locator_table_border_style'] ) ) : '0,none,#a4cd39';
$store_locator_table_background_color     = convert_hex_rgb_google_maps( isset( $layout_settings_store_locator_settings['store_locator_table_background_color'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_table_background_color'] ) : '#a4cd39' );

// Map Customization.
$map_customization_title_margin           = isset( $map_customization_settings['map_title_margin'] ) ? explode( ',', $map_customization_settings['map_title_margin'] ) : array( '0', '0', '0', '5' );
$map_customization_title_padding          = isset( $map_customization_settings['map_title_padding'] ) ? explode( ',', $map_customization_settings['map_title_padding'] ) : array( '5', '5', '5', '5' );
$map_customization_desc_margin            = isset( $map_customization_settings['map_description_margin'] ) ? explode( ',', $map_customization_settings['map_description_margin'] ) : array( '0', '0', '0', '5' );
$map_customization_desc_padding           = isset( $map_customization_settings['map_description_padding'] ) ? explode( ',', $map_customization_settings['map_description_padding'] ) : array( '5', '5', '5', '5' );
$map_customization_text_title_style       = isset( $map_customization_settings['map_title_font_style'] ) ? explode( ',', $map_customization_settings['map_title_font_style'] ) : array( '15', '#000000' );
$map_customization_text_description_style = isset( $map_customization_settings['map_description_font_style'] ) ? explode( ',', $map_customization_settings['map_description_font_style'] ) : array( '15', '#000000' );
?>
<style type="text/css">
<?php echo $import_font_family; // WPCS: XSS ok. ?>
	.site-content img
	{
		opacity:1 !important;
	}
	@media only screen and (max-width: 500px)
	{
		.gmb-style-infowindow
		{
			width: 100% !important;
		}
	}
	.table_style
	{
		border: none !important;
		border-collapse: none !important;
	}
	#store_locator_results_data_<?php echo intval( $random ); ?> img
	{
		width: auto !important;
		border: 0px !important;
		border-radius: 0px !important;
		text-indent: 0px !important;
	}
	.form_div > select + div
	{
		display: none !important;
	}
	.gmb-image-padding-position
	{
		max-width: none !important;
		height: auto;
		border:none !important;
	}
	.store_locator_label_style span
	{
		display: inline !important;
		font-family:<?php echo isset( $font_family_name_layout[8] ) ? htmlspecialchars_decode( $font_family_name_layout[8] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.pull-right
	{
		border-top: 0px !important;
		width: 100% !important;
		text-align: right !important;
	}
	.select_input_field
	{
		display: block !important;
		max-width: 100% !important;
		text-transform: none !important;
		-webkit-appearance: menulist !important ;
		-moz-appearance: menulist !important ;
	}
	.front-end-line-separator
	{
		height: 1px !important;
		border-bottom: 1px solid #a4cd39 !important;
		margin: 20px 0 20px 0 !important;
		clear: both !important;
	}
	.gmnoprint img
	{
		max-width: none !important;
	}
	#ux_div_map_canvas_front_end_<?php echo intval( $random ); ?>
	{
		width: <?php echo isset( $map_width ) && '' !== $map_width && $map_width > 0 && $map_width <= 100 ? $map_width : '100'; // WPCS: XSS ok. ?>% !important;
		height: <?php echo isset( $map_height ) && '' !== $map_height ? $map_height : '350'; // WPCS: XSS ok. ?>px !important;
		border: 1px solid #000000 !important;
		float: left !important;
		margin: 0px !important;
		display: block !important;
		margin-bottom: 5% !important;
	}
	.required
	{
		color: #ff0000 !important;
		display: inline !important;
	}
	.front-end-button
	{
		display: inline-block !important;
		padding: 6px 12px !important;
		line-height: 1.42857143 !important;
		white-space: nowrap !important;
		vertical-align: middle !important;
		-ms-touch-action: manipulation !important;
		touch-action: manipulation !important;
		cursor: pointer !important;
		float:none !important;
	}
	.front-end-button::after
	{
		content: initial !important;
	}
	.front-end-button:hover
	{
		opacity: 1 !important;
	}
	.form_div
	{
		margin-bottom: 15px !important;
	}
	img.adp-marker
	{
		max-width: none !important;
		margin-left: 10% !important;
	}
	.adp-step, .adp-text
	{
		width: 96% !important;
	}
	.adp-placemark
	{
		width: <?php echo isset( $layout_settings_directions_settings['text_direction_width'] ) ? intval( $layout_settings_directions_settings['text_direction_width'] ) : '100'; ?>% !important;
		background: rgba(<?php echo esc_attr( $directions_color_code[0] ); ?>,<?php echo esc_attr( $directions_color_code[1] ); ?>,<?php echo esc_attr( $directions_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_display_background_color_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_display_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		table-layout: initial !important;
	}
	.adp-legal
	{
		color: <?php echo isset( $directions_display_text_style[1] ) ? esc_attr( $directions_display_text_style[1] ) : '#000000'; ?> !important;
	}
	.directions-display-text-style .adp, .adp table
	{
		margin-top: 0px !important;
		font-family:<?php echo isset( $font_family_name_layout[4] ) ? htmlspecialchars_decode( $font_family_name_layout[4] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	#ux_div_frm_body
	{
		padding:0px !important;
	}

	.has-error .store_locator_label_style, .has-error .directions-label-style
	{
		color: #a94442 !important;
	}
	.has-error .store_locator_input_field_style:focus, .has-error .directions-input-field-style:focus, .has-error .store_locator_input_field_style, .has-error .directions-input-field-style
	{
		border-color: #843534 !important;
		opacity: 1 !important;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #a94442 !important;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #a94442 !important;
	}
	[class^="icon-custom"]::before, [class*=" icon-custom"]::before
	{
		margin-left: 0px !important;
		margin-right: 0.5em !important;
	}
	.store-locator-style
	{
		text-align: left !important;
		line-height: 1.35 !important;
		margin-top: -2px !important;
		padding: <?php echo isset( $info_window_text_padding[0] ) ? intval( $info_window_text_padding[0] ) : '10'; ?>px <?php echo isset( $info_window_text_padding[1] ) ? intval( $info_window_text_padding[1] ) : '0'; ?>px <?php echo isset( $info_window_text_padding[2] ) ? intval( $info_window_text_padding[2] ) : '0'; ?>px <?php echo isset( $info_window_text_padding[3] ) ? intval( $info_window_text_padding[3] ) : '0'; ?>px !important;
	}
	.store-description-style
	{
		word-break: break-word !important;
		font-size : <?php echo intval( $info_window_description_style[0] ); ?>px !important;
		color: <?php echo esc_attr( $info_window_description_style[1] ); ?> !important;
		font-family:<?php echo isset( $font_family_name_layout[6] ) ? htmlspecialchars_decode( $font_family_name_layout[6] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store-title-style
	{
		font-size: <?php echo intval( $info_window_title_style[0] ); ?>px !important;
		color: <?php echo esc_attr( $info_window_title_style[1] ); ?> !important;
		font-family:<?php echo isset( $font_family_name_layout[5] ) ? htmlspecialchars_decode( $font_family_name_layout[5] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.gmb-style-infowindow
	{
		line-height: 1.35 !important;
		overflow: hidden !important;
		word-wrap: break-word !important;
		border: <?php echo intval( $infowindow_border_style[0] ); ?>px <?php echo esc_attr( $infowindow_border_style[1] ); ?> <?php echo esc_attr( $infowindow_border_style[2] ); ?> !important;
		border-radius: <?php echo intval( $layout_settings_info_window_settings['info_window_border_radius'] ); ?>px !important;
		width: <?php echo intval( $layout_settings_info_window_settings['info_window_width'] ); ?>px;
	}
	.gmb-style-infowindow p
	{
		margin: 0 0 1em !important;
	}
	.gmb-image-padding-position
	{
		-webkit-box-shadow: 0 0px 0px 0px rgba(0,0,0,0.3) !important;
		box-shadow: 0 0px 0px 0px rgba(0,0,0,0.3) !important;
		margin: 0px !important;
		width: 120px !important;
		display: inline !important;
		padding: <?php echo isset( $info_window_image_padding[0] ) ? intval( $info_window_image_padding[0] ) : '10'; ?>px <?php echo isset( $info_window_image_padding[1] ) ? intval( $info_window_image_padding[1] ) : '10'; ?>px <?php echo isset( $info_window_image_padding[2] ) ? intval( $info_window_image_padding[2] ) : '0'; ?>px <?php echo isset( $info_window_image_padding[3] ) ? intval( $info_window_image_padding[3] ) : '10'; ?>px !important;
		float: <?php echo isset( $layout_settings_info_window_settings['info_window_image_position'] ) ? esc_attr( $layout_settings_info_window_settings['info_window_image_position'] ) : 'left'; ?> !important;
		border:none !important;
	}


	.directions-input-field-placeholder-style::-moz-input-placeholder
	{
		text-transform: none !important;
		font-family:<?php echo isset( $font_family_name_layout[12] ) ? htmlspecialchars_decode( $font_family_name_layout[12] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
			color: <?php echo isset( $directions_input_field_placeholder_style[1] ) ? esc_attr( $directions_input_field_placeholder_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $directions_input_field_placeholder_style[0] ) ? intval( $directions_input_field_placeholder_style[0] ) : '15'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[2] ) ? htmlspecialchars_decode( $font_family_name_layout[2] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-input-field-placeholder-style::-webkit-input-placeholder
	{
		text-transform: none !important;
		font-family:<?php echo isset( $font_family_name_layout[12] ) ? htmlspecialchars_decode( $font_family_name_layout[12] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
			color: <?php echo isset( $directions_input_field_placeholder_style[1] ) ? esc_attr( $directions_input_field_placeholder_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $directions_input_field_placeholder_style[0] ) ? intval( $directions_input_field_placeholder_style[0] ) : '15'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[2] ) ? htmlspecialchars_decode( $font_family_name_layout[2] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-header-style
	{
		text-transform: none !important;
		clear:both !important;
		line-height: 1.4 !important;
		padding: 5px 5px 5px 0px !important;
		margin: 0px !important;
		font-size: <?php echo isset( $directions_header_title_style[0] ) ? intval( $directions_header_title_style[0] ) : '25'; ?>px !important;
		color: <?php echo isset( $directions_header_title_style[1] ) ? esc_attr( $directions_header_title_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_header_color_code[0] ); ?>,<?php echo esc_attr( $directions_header_color_code[1] ); ?>,<?php echo esc_attr( $directions_header_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_background_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_background_opacity'] / 100 ) : '1'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[0] ) ? htmlspecialchars_decode( $font_family_name_layout[0] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-header-style:hover
	{
		text-transform: none !important;
		clear:both !important;
		line-height: 1.4 !important;
		padding: 5px 5px 5px 0px !important;
		margin: 0px !important;
		font-size: <?php echo isset( $directions_header_title_style[0] ) ? intval( $directions_header_title_style[0] ) : '25'; ?>px !important;
		color: <?php echo isset( $directions_header_title_style[1] ) ? esc_attr( $directions_header_title_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_header_color_code[0] ); ?>,<?php echo esc_attr( $directions_header_color_code[1] ); ?>,<?php echo esc_attr( $directions_header_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_background_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_background_opacity'] / 100 ) : '1'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[0] ) ? htmlspecialchars_decode( $font_family_name_layout[0] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-label-style
	{
		text-transform: none !important;
		float: left !important;
		font-size: <?php echo isset( $directions_label_style[0] ) ? intval( $directions_label_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_label_style[1] ) ? esc_attr( $directions_label_style[1] ) : '#000000'; ?> !important;
		margin: 1% 1% 1% 0 !important;
		display: -webkit-box !important;
		font-family:<?php echo isset( $font_family_name_layout[1] ) ? htmlspecialchars_decode( $font_family_name_layout[1] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-checkbox-label-style
	{
		text-transform: none !important;
		font-size: <?php echo isset( $directions_label_style[0] ) ? intval( $directions_label_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_label_style[1] ) ? esc_attr( $directions_label_style[1] ) : '#000000'; ?> !important;
		margin: -1% 1% 1% 1% !important;
		vertical-align: top !important;
	}
	.directions-input-field-style
	{
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		outline: none !important;
		border: 1px solid rgba(158, 158, 158, 0.51) !important;
		max-width: 100% !important;
		display: block !important;
		text-indent: 10px !important;
		float: none !important;
		padding: <?php echo intval( $directions_input_field_padding[0] ) . 'px ' . intval( $directions_input_field_padding[1] ) . 'px ' . intval( $directions_input_field_padding[2] ) . 'px ' . intval( $directions_input_field_padding[3] ) . 'px '; ?> !important;
		margin: <?php echo intval( $directions_input_field_margin[0] ) . 'px ' . intval( $directions_input_field_margin[1] ) . 'px ' . intval( $directions_input_field_margin[2] ) . 'px ' . intval( $directions_input_field_margin[3] ) . 'px '; ?> !important;
		height: <?php echo isset( $layout_settings_directions_settings['directions_input_field_height'] ) ? intval( $layout_settings_directions_settings['directions_input_field_height'] ) : '40'; ?>px !important;
		width: <?php echo isset( $layout_settings_directions_settings['directions_input_field_width'] ) ? intval( $layout_settings_directions_settings['directions_input_field_width'] ) : '100'; ?>% !important;
		line-height: 1.42857143 !important;
		font-size: <?php echo isset( $directions_input_field_text_style[0] ) ? intval( $directions_input_field_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_input_field_text_style[1] ) ? esc_attr( $directions_input_field_text_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_input_field_color_code[0] ); ?>,<?php echo esc_attr( $directions_input_field_color_code[1] ); ?>,<?php echo esc_attr( $directions_input_field_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_input_field_background_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_input_field_background_opacity'] / 100 ) : '0.75'; ?>) !important;
		box-shadow: 0px 0px 0px #eeeeee !important;
		font-family:<?php echo isset( $font_family_name_layout[2] ) ? htmlspecialchars_decode( $font_family_name_layout[2] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-checkbox-input-field-style
	{
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		outline: none !important;
		border: 1px solid rgba(158, 158, 158, 0.51) !important;
		max-width: 100% !important;
		text-indent: 10px !important;
		float: none !important;
		padding: <?php echo intval( $directions_input_field_padding[0] ) . 'px ' . intval( $directions_input_field_padding[1] ) . 'px ' . intval( $directions_input_field_padding[2] ) . 'px ' . intval( $directions_input_field_padding[3] ) . 'px '; ?> !important;
		margin: <?php echo intval( $directions_input_field_margin[0] ) . 'px ' . intval( $directions_input_field_margin[1] ) . 'px ' . intval( $directions_input_field_margin[2] ) . 'px ' . intval( $directions_input_field_margin[3] ) . 'px '; ?> !important;
		height:20px !important;
		width: 20px !important;
		line-height: 1.42857143 !important;
		font-size: <?php echo isset( $directions_input_field_text_style[0] ) ? intval( $directions_input_field_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_input_field_text_style[1] ) ? esc_attr( $directions_input_field_text_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_input_field_color_code[0] ); ?>,<?php echo esc_attr( $directions_input_field_color_code[1] ); ?>,<?php echo esc_attr( $directions_input_field_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_input_field_background_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_input_field_background_opacity'] / 100 ) : '0.75'; ?>) !important;
		box-shadow: 0px 0px 0px #eeeeee !important;
	}
	.adp-directions
	{
		width: <?php echo isset( $layout_settings_directions_settings['text_direction_width'] ) ? intval( $layout_settings_directions_settings['text_direction_width'] ) : '100'; ?>% !important;
	}
	.directions-display-text-style
	{
		display: none;
		float: left !important;
		margin-top: 20px !important;
		width: <?php echo isset( $layout_settings_directions_settings['text_direction_width'] ) ? intval( $layout_settings_directions_settings['text_direction_width'] ) : '100'; ?>% !important;
		font-size: <?php echo isset( $directions_display_text_style[0] ) ? intval( $directions_display_text_style[0] ) : '14'; ?>px !important;
		background: rgba(<?php echo esc_attr( $directions_color_code[0] ); ?>,<?php echo esc_attr( $directions_color_code[1] ); ?>,<?php echo esc_attr( $directions_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_display_background_color_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_display_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		border: <?php echo isset( $directions_display_border_style[0] ) ? intval( $directions_display_border_style[0] ) : '0'; ?>px <?php echo isset( $directions_display_border_style[1] ) ? esc_attr( $directions_display_border_style[1] ) : 'none'; ?> <?php echo isset( $directions_display_border_style[2] ) ? esc_attr( $directions_display_border_style[2] ) : '#000000'; ?> !important;
		border-radius: <?php echo isset( $layout_settings_directions_settings['directions_display_border_radius'] ) ? intval( $layout_settings_directions_settings['directions_display_border_radius'] ) : '0'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[4] ) ? htmlspecialchars_decode( $font_family_name_layout[4] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-display-text-style .adp, .adp table,.directions-display-text-style .adp, .adp table td
	{
		color: <?php echo isset( $directions_display_text_style[1] ) ? esc_attr( $directions_display_text_style[1] ) : '#000000'; ?> !important;
		word-break: break-all !important;
		background: rgba(<?php echo esc_attr( $directions_color_code[0] ); ?>,<?php echo esc_attr( $directions_color_code[1] ); ?>,<?php echo esc_attr( $directions_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_display_background_color_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_display_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[4] ) ? htmlspecialchars_decode( $font_family_name_layout[4] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-button-style
	{
		box-shadow:none !important;
		font-size: <?php echo isset( $directions_button_text_style[0] ) ? intval( $directions_button_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_button_text_style[1] ) ? esc_attr( $directions_button_text_style[1] ) : '#ffffff'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_button_color_code[0] ); ?>,<?php echo esc_attr( $directions_button_color_code[1] ); ?>,<?php echo esc_attr( $directions_button_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_button_background_color_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_button_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		height: <?php echo isset( $directions_button_height_and_width[0] ) ? intval( $directions_button_height_and_width[0] ) : '50'; ?>px !important;
		width: <?php echo isset( $directions_button_height_and_width[1] ) ? intval( $directions_button_height_and_width[1] ) : '100'; ?>px !important;
		text-align: <?php echo isset( $layout_settings_directions_settings['directions_button_alignment'] ) ? esc_attr( $layout_settings_directions_settings['directions_button_alignment'] ) : 'center'; ?> !important;
		text-transform: capitalize !important;
		background-image: none !important;
		overflow: hidden !important;
		border: 0px none !important;
		outline: none !important;
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		letter-spacing: 0px !important;
		font-family:<?php echo isset( $font_family_name_layout[3] ) ? htmlspecialchars_decode( $font_family_name_layout[3] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.directions-button-style:hover
	{
		box-shadow:none !important;
		font-size: <?php echo isset( $directions_button_text_style[0] ) ? intval( $directions_button_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $directions_button_text_style[1] ) ? esc_attr( $directions_button_text_style[1] ) : '#ffffff'; ?> !important;
		background: rgba(<?php echo esc_attr( $directions_button_color_code[0] ); ?>,<?php echo esc_attr( $directions_button_color_code[1] ); ?>,<?php echo esc_attr( $directions_button_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_button_background_color_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_button_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		height: <?php echo isset( $directions_button_height_and_width[0] ) ? intval( $directions_button_height_and_width[0] ) : '50'; ?>px !important;
		width: <?php echo isset( $directions_button_height_and_width[1] ) ? intval( $directions_button_height_and_width[1] ) : '100'; ?>px !important;
		text-align: <?php echo isset( $layout_settings_directions_settings['directions_button_alignment'] ) ? esc_attr( $layout_settings_directions_settings['directions_button_alignment'] ) : 'center'; ?> !important;
		text-transform: capitalize !important;
		background-image: none !important;
		overflow: hidden !important;
		border: 0px none !important;
		outline: none !important;
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		letter-spacing: 0px !important;
		font-family:<?php echo isset( $font_family_name_layout[3] ) ? htmlspecialchars_decode( $font_family_name_layout[3] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.direction-general-div
	{
		clear: both !important;
		background: rgba(<?php echo esc_attr( $directions_general_color_code[0] ); ?>,<?php echo esc_attr( $directions_general_color_code[1] ); ?>,<?php echo esc_attr( $directions_general_color_code[2] ); ?>,<?php echo isset( $layout_settings_directions_settings['directions_general_background_opacity'] ) ? floatval( $layout_settings_directions_settings['directions_general_background_opacity'] / 100 ) : '1'; ?>) !important;
		border-top: none !important;
	}
	#ux_frm_direction_frontend_<?php echo intval( $random ); ?>
	{
		height: auto !important;
	}
	.store_locator_header_style
	{
		text-transform: none !important;
		clear:both !important;
		font-style: normal !important;
		line-height: 1.4 !important;
		padding: 5px 5px 5px 0px !important;
		margin: 0px !important;
		font-size: <?php echo isset( $store_locator_header_style[0] ) ? intval( $store_locator_header_style[0] ) : '25'; ?>px !important;
		color: <?php echo isset( $store_locator_header_style[1] ) ? esc_attr( $store_locator_header_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $store_locator_header_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_header_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_header_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_background_color_opacity'] / 100 ) : '1'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[7] ) ? htmlspecialchars_decode( $font_family_name_layout[7] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store_locator_header_style:hover
	{
		text-transform: none !important;
		clear:both !important;
		font-style: normal !important;
		line-height: 1.4 !important;
		padding: 5px 5px 5px 0px !important;
		margin: 0px !important;
		font-size: <?php echo isset( $store_locator_header_style[0] ) ? intval( $store_locator_header_style[0] ) : '25'; ?>px !important;
		color: <?php echo isset( $store_locator_header_style[1] ) ? esc_attr( $store_locator_header_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $store_locator_header_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_header_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_header_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_background_color_opacity'] / 100 ) : '1'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[7] ) ? htmlspecialchars_decode( $font_family_name_layout[7] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>

	}
	.store_locator_label_style
	{
		text-transform: none !important;
		float:left !important;
		font-size: <?php echo isset( $store_locator_label_style[0] ) ? intval( $store_locator_label_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $store_locator_label_style[1] ) ? esc_attr( $store_locator_label_style[1] ) : '#000000'; ?> !important;
		margin: 1% 1% 1% 0 !important;
		display: -webkit-box !important;
		font-family:<?php echo isset( $font_family_name_layout[8] ) ? htmlspecialchars_decode( $font_family_name_layout[8] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store_locator_input_field_style
	{
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		outline: none !important;
		border: 1px solid rgba(158, 158, 158, 0.51) !important;
		max-width: 100% !important;
		float: none !important;
		text-indent: 10px !important;
		height: <?php echo isset( $layout_settings_store_locator_settings['store_locator_input_field_height'] ) ? intval( $layout_settings_store_locator_settings['store_locator_input_field_height'] ) : '40'; ?>px !important;
		width: <?php echo isset( $layout_settings_store_locator_settings['store_locator_input_field_width'] ) ? intval( $layout_settings_store_locator_settings['store_locator_input_field_width'] ) : '100'; ?>% !important;
		line-height: 1.42857143 !important;
		font-size: <?php echo isset( $store_locator_input_field_text_style[0] ) ? intval( $store_locator_input_field_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $store_locator_input_field_text_style[1] ) ? esc_attr( $store_locator_input_field_text_style[1] ) : '#000000'; ?> !important;
		background: rgba(<?php echo esc_attr( $store_locator_input_field_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_input_field_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_input_field_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_input_field_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_input_field_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		margin: <?php echo isset( $store_locator_input_field_margin[0] ) ? intval( $store_locator_input_field_margin[0] ) : '0'; ?>px <?php echo isset( $store_locator_input_field_margin[1] ) ? intval( $store_locator_input_field_margin[1] ) : '0'; ?>px <?php echo isset( $store_locator_input_field_margin[2] ) ? intval( $store_locator_input_field_margin[2] ) : '10'; ?>px <?php echo isset( $store_locator_input_field_margin[3] ) ? intval( $store_locator_input_field_margin[3] ) : '0'; ?>px !important;
		padding: <?php echo isset( $store_locator_input_field_padding[0] ) ? intval( $store_locator_input_field_padding[0] ) : '10'; ?>px <?php echo isset( $store_locator_input_field_padding[1] ) ? intval( $store_locator_input_field_padding[1] ) : '0'; ?>px <?php echo isset( $store_locator_input_field_padding[2] ) ? intval( $store_locator_input_field_padding[2] ) : '0'; ?>px <?php echo isset( $store_locator_input_field_padding[3] ) ? intval( $store_locator_input_field_padding[3] ) : '0'; ?>px !important;
		box-shadow: 0px 0px 0px #eeeeee !important;
		font-family:<?php echo isset( $font_family_name_layout[10] ) ? htmlspecialchars_decode( $font_family_name_layout[10] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store_locator_input_field_style::-moz-input-placeholder
	{
		text-transform: none !important;
		color: <?php echo isset( $store_locator_placeholder_style[1] ) ? esc_attr( $store_locator_placeholder_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $store_locator_placeholder_style[0] ) ? intval( $store_locator_placeholder_style[0] ) : '15'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[11] ) ? htmlspecialchars_decode( $font_family_name_layout[11] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store_locator_input_field_style::-webkit-input-placeholder
	{
		text-transform: none !important;
		color: <?php echo isset( $store_locator_placeholder_style[1] ) ? esc_attr( $store_locator_placeholder_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $store_locator_placeholder_style[0] ) ? intval( $store_locator_placeholder_style[0] ) : '15'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[11] ) ? htmlspecialchars_decode( $font_family_name_layout[11] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.form_main_div_store_locator
	{
		clear: both !important;
		background: rgba(<?php echo esc_attr( $store_locator_general_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_general_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_general_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_general_background_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_general_background_opacity'] / 100 ) : '1'; ?>) !important;
		border-top: none !important;
	}
	.store_locator_button_style
	{
		outline: none !important;
		box-shadow: none !important;
		font-size: <?php echo isset( $store_locator_button_text_style[0] ) ? intval( $store_locator_button_text_style[0] ) : '15'; ?>px !important;
		color: <?php echo isset( $store_locator_button_text_style[1] ) ? esc_attr( $store_locator_button_text_style[1] ) : '#ffffff'; ?> !important;
		background: rgba(<?php echo esc_attr( $store_locator_button_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_button_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_button_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_button_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_button_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		height: <?php echo isset( $store_locator_button_height_width[0] ) ? intval( $store_locator_button_height_width[0] ) : '50'; ?>px !important;
		width: <?php echo isset( $store_locator_button_height_width[1] ) ? intval( $store_locator_button_height_width[1] ) : '100'; ?>px !important;
		text-align: <?php echo isset( $layout_settings_store_locator_settings['store_locator_button_alignment'] ) ? esc_attr( $layout_settings_store_locator_settings['store_locator_button_alignment'] ) : 'center'; ?> !important;
		text-transform: capitalize !important;
		background-image: none !important;
		overflow: hidden !important;
		border: 0px none !important;
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		letter-spacing: 0px !important;
		font-family:<?php echo isset( $font_family_name_layout[9] ) ? htmlspecialchars_decode( $font_family_name_layout[9] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.store_locator_button_style:hover
	{
		outline: none !important;
		color: <?php echo isset( $store_locator_button_text_style[1] ) ? esc_attr( $store_locator_button_text_style[1] ) : '#ffffff'; ?> !important;
		background: rgba(<?php echo esc_attr( $store_locator_button_color_code[0] ); ?>,<?php echo esc_attr( $store_locator_button_color_code[1] ); ?>,<?php echo esc_attr( $store_locator_button_color_code[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_button_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_button_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		text-transform: capitalize !important;
		background-image: none !important;
		overflow: hidden !important;
		border: 0px none !important;
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
		letter-spacing: 0px !important;
		font-family:<?php echo isset( $font_family_name_layout[9] ) ? htmlspecialchars_decode( $font_family_name_layout[9] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	#ux_tbl_store_locator_<?php echo intval( $random ); ?>
	{
		display: none;
		border-collapse: separate !important;
		border-spacing: 0 !important;
		margin-top: 2% !important;
		overflow: hidden !important;
		width: <?php echo isset( $layout_settings_store_locator_settings['store_locator_table_width'] ) ? intval( $layout_settings_store_locator_settings['store_locator_table_width'] ) : '100'; ?>% !important;
		font-size: <?php echo isset( $store_locator_table_style[0] ) ? intval( $store_locator_table_style[0] ) : '14'; ?>px !important;
		color: <?php echo isset( $store_locator_table_style[1] ) ? esc_attr( $store_locator_table_style[1] ) : '#ffffff'; ?> !important;
		border: <?php echo intval( $store_locator_table_display_border_style[0] ) . 'px ' . esc_attr( $store_locator_table_display_border_style[1] ) . ' ' . esc_attr( $store_locator_table_display_border_style[2] ); ?> !important;
		border-radius: <?php echo isset( $layout_settings_store_locator_settings['store_locator_table_border_radius'] ) ? intval( $layout_settings_store_locator_settings['store_locator_table_border_radius'] ) : '0'; ?>px !important;
		background: rgba(<?php echo esc_attr( $store_locator_table_background_color[0] ); ?>,<?php echo esc_attr( $store_locator_table_background_color[1] ); ?>,<?php echo esc_attr( $store_locator_table_background_color[2] ); ?>,<?php echo isset( $layout_settings_store_locator_settings['store_locator_table_background_color_opacity'] ) ? floatval( $layout_settings_store_locator_settings['store_locator_table_background_color_opacity'] / 100 ) : '0.75'; ?>) !important;
		font-family:<?php echo isset( $font_family_name_layout[15] ) ? htmlspecialchars_decode( $font_family_name_layout[15] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	#ux_tbl_store_locator_<?php echo intval( $random ); ?> thead tr th,#ux_tbl_store_locator_<?php echo intval( $random ); ?> tbody tr td
	{
		border: <?php echo intval( $store_locator_table_display_border_style[0] ) . 'px ' . esc_attr( $store_locator_table_display_border_style[1] ) . ' ' . esc_attr( $store_locator_table_display_border_style[2] ); ?> !important;
		padding:10px !important;
		text-align:center !important;
		font-family:<?php echo isset( $font_family_name_layout[15] ) ? htmlspecialchars_decode( $font_family_name_layout[15] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	#ux_div_text_directions_<?php echo intval( $random ); ?> table
	{
		width: 100% !important;
		display: table !important;
	}

	/* Map Customization Styling*/
	.map_customization_title
	{
		text-transform: none !important;
		color: <?php echo isset( $map_customization_text_title_style[1] ) ? esc_attr( $map_customization_text_title_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $map_customization_text_title_style[0] ) ? intval( $map_customization_text_title_style[0] ) : '15'; ?>px !important;
		display: <?php echo isset( $map_title ) && 'hide' === $map_title ? 'none' : 'block'; ?>;
		text-align: <?php echo isset( $map_customization_settings['map_title_text_alignment'] ) ? esc_attr( $map_customization_settings['map_title_text_alignment'] ) : 'left'; ?>!important;
		margin: <?php echo isset( $map_customization_title_margin[0] ) ? intval( $map_customization_title_margin[0] ) : '0'; ?>px <?php echo isset( $map_customization_title_margin[1] ) ? intval( $map_customization_title_margin[1] ) : '0'; ?>px <?php echo isset( $map_customization_title_margin[2] ) ? intval( $map_customization_title_margin[2] ) : '0'; ?>px <?php echo isset( $map_customization_title_margin[3] ) ? intval( $map_customization_title_margin[3] ) : '5'; ?>px !important;
		padding: <?php echo isset( $map_customization_title_padding[0] ) ? intval( $map_customization_title_padding[0] ) : '5'; ?>px <?php echo isset( $map_customization_title_padding[1] ) ? intval( $map_customization_title_padding[1] ) : '5'; ?>px <?php echo isset( $map_customization_title_padding[2] ) ? intval( $map_customization_title_padding[2] ) : '5'; ?>px <?php echo isset( $map_customization_title_padding[3] ) ? intval( $map_customization_title_padding[3] ) : '5'; ?>px !important;
		font-family:<?php echo isset( $font_family_name_layout[13] ) ? htmlspecialchars_decode( $font_family_name_layout[13] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}
	.map_customization_description
	{
		color: <?php echo isset( $map_customization_text_description_style[1] ) ? esc_attr( $map_customization_text_description_style[1] ) : '#000000'; ?> !important;
		font-size: <?php echo isset( $map_customization_text_description_style[0] ) ? intval( $map_customization_text_description_style[0] ) : '15'; ?>px !important;
		display: <?php echo isset( $map_description ) && 'hide' === $map_description ? 'none' : 'block'; ?> !important;
		text-align: <?php echo isset( $map_customization_settings['map_description_text_alignment'] ) ? esc_attr( $map_customization_settings['map_description_text_alignment'] ) : 'left'; ?> !important;
		margin: <?php echo isset( $map_customization_desc_margin[0] ) ? intval( $map_customization_desc_margin[0] ) : '0'; ?>px <?php echo isset( $map_customization_desc_margin[1] ) ? intval( $map_customization_desc_margin[1] ) : '0'; ?>px <?php echo isset( $map_customization_desc_margin[2] ) ? intval( $map_customization_desc_margin[2] ) : '0'; ?>px <?php echo isset( $map_customization_desc_margin[3] ) ? intval( $map_customization_desc_margin[3] ) : '5'; ?>px !important;
		padding: <?php echo isset( $map_customization_desc_padding[0] ) ? intval( $map_customization_desc_padding[0] ) : '5'; ?>px <?php echo isset( $map_customization_desc_padding[1] ) ? intval( $map_customization_desc_padding[1] ) : '5'; ?>px <?php echo isset( $map_customization_desc_padding[2] ) ? intval( $map_customization_desc_padding[2] ) : '5'; ?>px <?php echo isset( $map_customization_desc_padding[3] ) ? intval( $map_customization_desc_padding[3] ) : '5'; ?>px !important;
		line-height: 1.3 !important;
		font-family:<?php echo isset( $font_family_name_layout[14] ) ? htmlspecialchars_decode( $font_family_name_layout[14] ) : 'Roboto Condensed'; // WPCS: XSS ok. ?>
	}

	/* Custom Css */
<?php echo htmlspecialchars_decode( $custom_css_data['custom_css'] ); // WPCS: XSS ok. ?>
</style>
