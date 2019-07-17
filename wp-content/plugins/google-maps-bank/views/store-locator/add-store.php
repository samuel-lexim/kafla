<?php
/**
 * This Template is used for adding overlays.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/overlays
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
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
	} elseif ( STORE_LOCATOR_GOOGLE_MAP === '1' ) {
		$store_locator_color_opacity        = isset( $serialize_store_locator_edit_data['store_locator_fill_style'] ) ? explode( ',', esc_attr( $serialize_store_locator_edit_data['store_locator_fill_style'] ) ) : '';
		$store_locator_stroke_color_opacity = isset( $serialize_store_locator_edit_data['store_locator_stroke_style'] ) ? explode( ',', esc_attr( $serialize_store_locator_edit_data['store_locator_stroke_style'] ) ) : '';
		?>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-custom-home"></i>
					<a href="admin.php?page=gmb_google_maps">
						<?php echo esc_attr( $google_maps_bank ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<a href="admin.php?page=gmb_manage_store">
						<?php echo esc_attr( $gm_store_locator ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo isset( $_REQUEST['id'] ) ? esc_attr( $gm_update_store ) : esc_attr( $gm_add_store ); // WPCS: CSRF ok,input var ok. ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-plus"></i>
							<?php echo isset( $_REQUEST['id'] ) ? esc_attr( $gm_update_store ) : esc_attr( $gm_add_store ); // WPCS: CSRF ok,input var ok. ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_store_locator">
							<div class="form-body">
								<div style="max-height:350px; margin-bottom: 4%;" id="ux_map_canvas">
									<div id="ux_div_map_canvas" class="map_canvas"></div>
									<div class="line-separator"></div>
								</div>
								<div id="ux_div_store_locator_settings">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_store_locator_title ); ?> :
											<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<input type="text" class="form-control" name="ux_txt_store_locator_title" id="ux_txt_store_locator_title" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_name'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_name'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_store_title_placeholder ); ?>" onblur="initialize_store_locator_google_maps();">
										<i class="controls-description"><?php echo esc_attr( $gm_add_store_title_tooltips ); ?></i>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_add_store_locator_description ); ?> :
											<span style="color:red;"><?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<textarea class="form-control" name="ux_txt_store_locator_desc" id="ux_txt_store_locator_desc" rows="4" onblur="initialize_store_locator_google_maps();" placeholder="<?php echo esc_attr( $gm_add_store_locator_description ); ?>"><?php echo isset( $serialize_store_locator_edit_data['store_locator_description'] ) ? esc_html( $serialize_store_locator_edit_data['store_locator_description'] ) : ''; ?></textarea>
										<i class="controls-description"><?php echo esc_attr( $gm_add_store_description_tooltips ); ?></i>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_marker_type ); ?> :
											<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<div class="row" style="margin-top:10px;margin-bottom:5px;">
											<div class="col-md-3">
												<input type="radio" name="ux_chk_map_formatted_address" id="ux_chk_formatted_address" value="formatted_address"  onclick="choose_address_type_google_maps('formatted_address', '#ux_div_map_address', '#ux_div_latitude_longitude');" <?php echo isset( $serialize_store_locator_edit_data['store_locator_address_type'] ) && esc_attr( $serialize_store_locator_edit_data['store_locator_address_type'] ) === 'formatted_address' ? 'checked = checked' : ( ! isset( $serialize_store_locator_edit_data['store_locator_address_type'] ) ? 'checked = checked' : '' ); ?>>
												<?php echo esc_attr( $gm_formatted_address ); ?>
											</div>
											<div class="col-md-3">
												<input type="radio" name="ux_chk_map_formatted_address" id="ux_chk_by_latitude_longitude" value="latitude_longitude" onclick="choose_address_type_google_maps('latitude_longitude', '#ux_div_map_address', '#ux_div_latitude_longitude');" <?php echo isset( $serialize_store_locator_edit_data['store_locator_address_type'] ) && esc_attr( $serialize_store_locator_edit_data['store_locator_address_type'] ) === 'latitude_longitude' ? 'checked = checked' : ''; ?>>
												<?php echo esc_attr( $gm_by_latitude_longitude ); ?>
											</div>
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_marker_type_tooltips ); ?></i>
									</div>
									<div id="ux_div_map_address">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_add_map_address ); ?> :
												<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
											</label>
											<input type="text" class="form-control" name="ux_txt_marker_address" id="ux_txt_marker_address" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_formatted_address'] ) ? esc_html( $serialize_store_locator_edit_data['store_locator_formatted_address'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_address_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_add_map_address_tooltips ); ?></i>
										</div>
									</div>
									<div id="ux_div_latitude_longitude" style="display:none;">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														<?php echo esc_attr( $gm_map_latitude ); ?> :
														<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
													</label>
													<input type="text" class="form-control" name="ux_txt_marker_latitude" id="ux_txt_marker_latitude" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_latitude'] ) ? floatval( $serialize_store_locator_edit_data['store_locator_latitude'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_latitude_placeholder ); ?>" onblur="initialize_store_locator_google_maps();">
													<i class="controls-description"><?php echo esc_attr( $gm_add_map_latitude_tooltips ); ?></i>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														<?php echo esc_attr( $gm_map_longitude ); ?> :
														<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
													</label>
													<input type="text" class="form-control" name="ux_txt_marker_longitude" id="ux_txt_marker_longitude" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_longitude'] ) ? floatval( $serialize_store_locator_edit_data['store_locator_longitude'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_longitude_placeholder ); ?>" onblur="initialize_store_locator_google_maps();">
													<i class="controls-description"><?php echo esc_attr( $gm_add_map_longitude_tooltips ); ?></i>
												</div>
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:15px !important;">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_phone_number ); ?> :
													<span style="color:red;"><?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
												</label>
												<input type="text" class="form-control" name="ux_txt_store_locator_phone_number" id="ux_txt_store_locator_phone_number" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_phone_number'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_phone_number'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_phone_number_placeholder ); ?>" onblur=initialize_store_locator_google_maps(); onkeypress="google_maps_validate_alphabets(event);" onfocus="paste_prevent_google_maps('ux_txt_store_locator_phone_number')">
												<i class="controls-description"><?php echo esc_attr( $gm_phone_number_tooltips ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_fax_number ); ?> :
													<span style="color:red;"><?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
												</label>
												<input type="text" class="form-control" name="ux_txt_store_locator_fax_number" id="ux_txt_store_locator_fax_number" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_fax_number'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_fax_number'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_fax_number_placeholder ); ?>" onblur="initialize_store_locator_google_maps();" onkeypress="google_maps_validate_alphabets(event);" onfocus="paste_prevent_google_maps('ux_txt_store_locator_fax_number')">
												<i class="controls-description"><?php echo esc_attr( $gm_fax_number_tooltips ); ?></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_website_url ); ?> :
										</label>
										<input type="text" class="form-control" name="ux_txt_store_locator_website_url" id="ux_txt_store_locator_website_url" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_website_url'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_website_url'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_website_url_placeholder ); ?>" onblur="initialize_store_locator_google_maps();">
										<i class="controls-description"><?php echo esc_attr( $gm_website_url_tooltips ); ?></i>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_marker_icon ); ?> :
											<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<select name="ux_ddl_store_locator_marker_icon" id="ux_ddl_store_locator_marker_icon" class="form-control" onchange="google_maps_upload_marker_icon('#ux_ddl_store_locator_marker_icon');">
											<option value="default_icon"><?php echo esc_attr( $gm_default_icon ); ?></option>
											<option value="choose_icon"><?php echo esc_attr( $gm_choose_icon ); ?></option>
											<option value="upload"><?php echo esc_attr( $gm_upload_icon ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_marker_icon_tooltips ); ?></i>
									</div>
									<div id="ux_div_marker_icon_ablity" style="display:none">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_marker_images ); ?> :
												<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
											</label>
											<div class="input-icon right">
												<input type="text" class="form-control custom-input-large input-inline" readonly="true" name="ux_txt_store_locator_marker_icon_path" id="ux_txt_store_locator_marker_icon_path" placeholder="<?php echo esc_attr( $gm_marker_upload_icon_placeholder ); ?>" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_marker_upload_image'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_marker_upload_image'] ) : ''; ?>">
												<input type="button" class="btn vivid-green custom-top" name="ux_upload_marker_icon" id="ux_upload_marker_icon" onclick="google_maps_upload_image('ux_txt_store_locator_marker_icon_path');" value="<?php echo esc_attr( $gm_upload ); ?>">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_marker_img_upload_tooltips ); ?></i>
										</div>
									</div>
									<p id="wp_media_upload_error" class="wp-media-error-message"><?php echo esc_attr( $gmb_media_error_settings_message ); ?></p>
									<div id="ux_div_marker_icon_choose" style="display:none">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_add_marker_category ); ?> :
												<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
											</label>
											<div class="layout-controls-location custom-layout-controls-map-location">
												<select class="form-control" name="ux_ddl_store_locator_marker_category" id="ux_ddl_store_locator_marker_category" onchange="marker_change_category('#ux_ddl_store_locator_marker_category');">
													<option value="0"><?php echo esc_attr( __( 'Select Marker Category', 'google-maps-bank' ) ); ?></option>
													<optgroup label="Culture & Entertainment">
														<option value="1"><?php echo esc_attr( __( 'Culture', 'google-maps-bank' ) ); ?></option>
														<option value="2"><?php echo esc_attr( __( 'Entertainment', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Events">
														<option value="3"><?php echo esc_attr( __( 'Crime', 'google-maps-bank' ) ); ?></option>
														<option value="4"><?php echo esc_attr( __( 'Natural Disasters', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Health And Education">
														<option value="5"><?php echo esc_attr( __( 'Education', 'google-maps-bank' ) ); ?></option>
														<option value="6"><?php echo esc_attr( __( 'Health', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Industry">
														<option value="7"><?php echo esc_attr( __( 'Electric Power', 'google-maps-bank' ) ); ?></option>
														<option value="8"><?php echo esc_attr( __( 'Military', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Miscellaneous">
														<option value="9"><?php echo esc_attr( __( 'Miscellaneous', 'google-maps-bank' ) ); ?></option>
														<option value="10"><?php echo esc_attr( __( 'Media', 'google-maps-bank' ) ); ?></option>
														<option value="11"><?php echo esc_attr( __( 'Days', 'google-maps-bank' ) ); ?></option>
														<option value="12"><?php echo esc_attr( __( 'Numbers', 'google-maps-bank' ) ); ?></option>
														<option value="13"><?php echo esc_attr( __( 'Letters', 'google-maps-bank' ) ); ?></option>
														<option value="14"><?php echo esc_attr( __( 'Special Characters', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Nature">
														<option value="15"><?php echo esc_attr( __( 'Agriculture', 'google-maps-bank' ) ); ?></option>
														<option value="16"><?php echo esc_attr( __( 'Animals', 'google-maps-bank' ) ); ?></option>
														<option value="17"><?php echo esc_attr( __( 'Natural Marvels', 'google-maps-bank' ) ); ?></option>
														<option value="18"><?php echo esc_attr( __( 'Weather', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Offices">
														<option value="19"><?php echo esc_attr( __( 'City Services', 'google-maps-bank' ) ); ?></option>
														<option value="20"><?php echo esc_attr( __( 'Interior', 'google-maps-bank' ) ); ?></option>
														<option value="21"><?php echo esc_attr( __( 'Real Estate', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="People">
														<option value="22"><?php echo esc_attr( __( 'Kids', 'google-maps-bank' ) ); ?></option>
														<option value="23"><?php echo esc_attr( __( 'People', 'google-maps-bank' ) ); ?></option>
														<option value="24"><?php echo esc_attr( __( 'Home', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Restaurants & Hotels">
														<option value="25"><?php echo esc_attr( __( 'Bars', 'google-maps-bank' ) ); ?></option>
														<option value="26"><?php echo esc_attr( __( 'Hotels', 'google-maps-bank' ) ); ?></option>
														<option value="27"><?php echo esc_attr( __( 'Restaurants', 'google-maps-bank' ) ); ?></option>
														<option value="28"><?php echo esc_attr( __( 'Takeaway', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Sports">
														<option value="29"><?php echo esc_attr( __( 'Sports', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Stores">
														<option value="30"><?php echo esc_attr( __( 'Apparel', 'google-maps-bank' ) ); ?></option>
														<option value="31"><?php echo esc_attr( __( 'Brands Chains', 'google-maps-bank' ) ); ?></option>
														<option value="32"><?php echo esc_attr( __( 'Computer Electronics', 'google-maps-bank' ) ); ?></option>
														<option value="33"><?php echo esc_attr( __( 'Food Drinks', 'google-maps-bank' ) ); ?></option>
														<option value="34"><?php echo esc_attr( __( 'General Merchandise', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Transportation">
														<option value="35"><?php echo esc_attr( __( 'Aerial Transportation', 'google-maps-bank' ) ); ?></option>
														<option value="36"><?php echo esc_attr( __( 'Directions', 'google-maps-bank' ) ); ?></option>
														<option value="37"><?php echo esc_attr( __( 'Other Transportation', 'google-maps-bank' ) ); ?></option>
														<option value="38"><?php echo esc_attr( __( 'Road Signs', 'google-maps-bank' ) ); ?></option>
														<option value="39"><?php echo esc_attr( __( 'Road Transportation', 'google-maps-bank' ) ); ?></option>
													</optgroup>
													<optgroup label="Tourism">
														<option value="40"><?php echo esc_attr( __( 'Religion', 'google-maps-bank' ) ); ?></option>
														<option value="41"><?php echo esc_attr( __( 'Tourism', 'google-maps-bank' ) ); ?></option>
													</optgroup>
												</select>
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_add_marker_category_tooltips ); ?></i>
										</div>
										<div id="ux_div_show_map_icons_ability" style="display:none;">
											<div class="form-group">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . '/includes/map-icons.php' ) ) {
													include_once GOOGLE_MAP_DIR_PATH . '/includes/map-icons.php';
												}
												?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_marker_animation ); ?> :
													<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
												</label>
												<select name="ux_ddl_store_locator_marker_animation" id="ux_ddl_store_locator_marker_animation" class="form-control" onchange="initialize_store_locator_google_maps();">
													<option value="none"><?php echo esc_attr( $gm_none ); ?></option>
													<option value="bounce"><?php echo esc_attr( $gm_bounce ); ?></option>
													<option value="drop"><?php echo esc_attr( $gm_drop ); ?></option>
												</select>
												<i class="controls-description"><?php echo esc_attr( $gm_marker_animation_tooltips ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_info_window ); ?> :
													<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
												</label>
												<select name="ux_ddl_info_window" id="ux_ddl_info_window" class="form-control" onchange='google_maps_info_window("#ux_ddl_info_window", "#store_locator_image", "#wp_media_upload_error_info"), show_hide_controls_google_maps("#ux_ddl_info_window", "#store_locator_image");initialize_store_locator_google_maps();'>
													<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
													<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
												</select>
												<i class="controls-description"><?php echo esc_attr( $gm_info_window_tooltips ); ?></i>
											</div>
										</div>
									</div>
									<div class="form-group" id="store_locator_image" style="display:none;">
										<label class="control-label">
											<?php echo esc_attr( $gm_image_url ); ?> :
											<span style="color:red;"><?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<div class="input-icon right">
											<input type="text" class="form-control custom-input-middle input-inline" readonly="true" name="ux_txt_store_locator_image_upload_path" id="ux_txt_store_locator_image_upload_path" placeholder="<?php echo esc_attr( $gm_info_window_images_upload_placeholder ); ?>" value="<?php echo isset( $serialize_store_locator_edit_data['store_locator_info_window_image_url'] ) ? esc_attr( $serialize_store_locator_edit_data['store_locator_info_window_image_url'] ) : ''; ?>">
											<input type="button" class="btn vivid-green custom-top" name="ux_upload_info_image" id="ux_upload_info_image" onclick="google_maps_upload_image('ux_txt_store_locator_image_upload_path');" value="<?php echo esc_attr( $gm_upload ); ?>">
											<input type="button" class="btn vivid-green custom-top" name="ux_clear_info_image" id="ux_clear_info_image" onclick='google_maps_clear_info_window_image("#ux_txt_store_locator_image_upload_path");' value="<?php echo esc_attr( $gm_clear ); ?>">
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_image_url_tooltips ); ?></i>
									</div>
									<p id="wp_media_upload_error_info" class="wp-media-error-message"><?php echo esc_attr( $gm_image_url_tooltips ); ?></p>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_additional_note ); ?> :
											<span style="color:red;"><?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<textarea class="form-control" name="ux_txt_store_locator_additional_note" id="ux_txt_store_locator_additional_note"  onblur="initialize_store_locator_google_maps();"   rows="4" placeholder="<?php echo esc_attr( $gm_additional_note_placeholder ); ?>"><?php echo isset( $serialize_store_locator_edit_data['store_locator_additional_note'] ) ? esc_html( $serialize_store_locator_edit_data['store_locator_additional_note'] ) : ''; ?></textarea>
										<i class="controls-description"><?php echo esc_attr( $gm_additional_note_tooltips ); ?></i>
									</div>
									<div class="line-separator"></div>
									<div class="form-actions">
										<div class="pull-right">
											<input type="submit" name="ux_btn_add_store" class="btn vivid-green" id="ux_btn_add_store" value="<?php echo isset( $_REQUEST['id'] ) ? esc_attr( $gm_update_store ) : esc_attr( $gm_add_store ); // WPCS:CSRF ok,input var ok. ?>">
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	} else {
		?>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-custom-home"></i>
					<a href="admin.php?page=gmb_google_maps">
						<?php echo esc_attr( $google_maps_bank ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<a href="admin.php?page=gmb_manage_store">
						<?php echo esc_attr( $gm_store_locator ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo esc_attr( $gm_add_store ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-plus"></i>
							<?php echo esc_attr( $gm_add_store ); ?>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<strong><?php echo esc_attr( $gm_user_access_message ); ?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
