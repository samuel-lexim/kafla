<?php
/**
 * This Template is used for adding layers.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/layers
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
	} elseif ( LAYERS_GOOGLE_MAP === '1' ) {
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
				<span>
					<?php echo esc_attr( $gm_layers ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-layers"></i>
						<?php echo esc_attr( $gm_layers ); ?>
					</div>
					<p class="premium-editions">
						<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
					</p>
				</div>
				<div class="portlet-body form">
					<form id="ux_frm_add_layers">
						<div class="form-body">
						<div style="max-height:350px; display:none; margin-bottom: 4%;" id="ux_map_canvas">
							<div id="ux_div_map_canvas" class="map_canvas"></div>
							<div class="line-separator"></div>
						</div>
						<div class="form-group">
							<label class="control-label">
								<?php echo esc_attr( $gm_choose_map ); ?> :
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="ux_ddl_choose_map" id="ux_ddl_choose_map" class="form-control" onchange="get_url_google_maps('#ux_ddl_choose_map', '', 'gmb_layers');">
								<option value=""><?php echo esc_attr( $gm_choose_map ); ?></option>
								<?php
								foreach ( $choose_map_data as $key => $value ) {
									?>
									<option value="<?php echo esc_attr( $value['meta_id'] ); ?>"><?php echo esc_attr( $value['map_title'] ); ?></option>
									<?php
								}
								?>
							</select>
							<i class="controls-description"><?php echo esc_attr( $gm_choose_add_layers_tooltips ); ?></i>
						</div>
						<div id="ux_div_ddl_choose_map" style="display:none;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_enable_bicycling_layer ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<select name="ux_ddl_enable_bicycling_layer" id="ux_ddl_enable_bicycling_layer" class="form-control" onChange="change_layers_settings_google_maps();">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_enable_bicycling_layer_tooltips ); ?></i>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_enable_traffic_layer ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<select name="ux_ddl_enable_traffic_layer" id="ux_ddl_enable_traffic_layer" class="form-control" onChange="change_layers_settings_google_maps();">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_enable_traffic_layer_tooltips ); ?></i>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_enable_transit_layer ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<select name="ux_ddl_enable_transit_layer" id="ux_ddl_enable_transit_layer" class="form-control" onChange="change_layers_settings_google_maps();">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_enable_transit_layer_tooltips ); ?></i>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_enable_heatmap_layer ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<select name="ux_ddl_enable_heatmap_layer" id="ux_ddl_enable_heatmap_layer" class="form-control" onchange="show_hide_controls_google_maps('#ux_ddl_enable_heatmap_layer', '#ux_div_enable_heatmap_layer'), change_layers_settings_google_maps();">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_enable_heatmap_layer_tooltips ); ?></i>
								</div>
							</div>
							</div>
							<div id="ux_div_enable_heatmap_layer" style="display:none;">
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_heatmap_gradient_color ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<select name="ux_ddl_enable_gradient_heatmap" id="ux_ddl_enable_gradient_heatmap" class="form-control" onChange="change_layers_settings_google_maps();">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_heatmap_gradient_color_tooltips ); ?></i>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_heatmap_coordinates ); ?> :
										<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
									</label>
									<textarea class="form-control" name="ux_txt_coordinates" id="ux_txt_coordinates" rows="4"  placeholder="<?php echo esc_attr( $gm_heatmap_coordinates_placeholder ); ?>" onChange="change_layers_settings_google_maps();" ><?php echo isset( $layers_data_unserialized['heatmap_coordinates'] ) ? esc_attr( $layers_data_unserialized['heatmap_coordinates'] ) : ''; ?></textarea>
									<i class="controls-description"><?php echo esc_attr( $gm_heatmap_coordinates_tooltips ); ?></i>
								</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_heatmap_opacity ); ?> :
											<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<input type="text" class="form-control" name="ux_txt_heatmap_opacity" id="ux_txt_heatmap_opacity" maxlength="3" value="<?php echo isset( $layers_data_unserialized['heatmap_opacity'] ) ? intval( $layers_data_unserialized['heatmap_opacity'] ) : 75; ?>" placeholder="<?php echo esc_attr( $gm_heatmap_opacity_placeholder ); ?>" onblur="default_value_google_maps('#ux_txt_heatmap_opacity', '75', 'width'), change_layers_settings_google_maps();" onkeypress="only_digits_google_maps(event);">
										<i class="controls-description"><?php echo esc_attr( $gm_heatmap_opacity_tooltips ); ?></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_heatmap_radius ); ?> :
											<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
										</label>
										<input type="text" class="form-control" name="ux_txt_heatmap_radius" id="ux_txt_heatmap_radius" maxlength="3" value="<?php echo isset( $layers_data_unserialized['heatmap_radius'] ) ? intval( $layers_data_unserialized['heatmap_radius'] ) : 20; ?>" placeholder="<?php echo esc_attr( $gm_heatmap_radius_placeholder ); ?>" onblur="default_value_google_maps('#ux_txt_heatmap_radius', '20', 'width'), change_layers_settings_google_maps();" onkeypress="only_digits_google_maps(event)" onfocus="paste_prevent_google_maps(this.id);">
										<i class="controls-description"><?php echo esc_attr( $gm_heatmap_radius_tooltips ); ?></i>
									</div>
								</div>
							</div>
							</div>
							<div class="form-group">
								<label class="control-label">
									<?php echo esc_attr( $gm_enable_fusion_table_layer ); ?> :
									<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
								</label>
								<select name="ux_ddl_enable_fusion_table_layer" id="ux_ddl_enable_fusion_table_layer" class="form-control" onChange="show_hide_controls_google_maps('#ux_ddl_enable_fusion_table_layer', '#ux_div_enable_fusion_table_layer'), change_layers_settings_google_maps();">
									<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
									<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
								</select>
								<i class="controls-description"><?php echo esc_attr( $gm_enable_fusion_table_tooltips ); ?></i>
							</div>
							<div class="form-group" id="ux_div_enable_fusion_table_layer">
								<label class="control-label">
									<?php echo esc_attr( $gm_fusion_table_id ); ?> :
									<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
								</label>
								<input type="text" class="form-control" name="ux_txt_fusion_table_id" id="ux_txt_fusion_table_id" value="<?php echo isset( $layers_data_unserialized['fusion_table_id'] ) ? esc_attr( $layers_data_unserialized['fusion_table_id'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_fusion_table_id_placeholder ); ?>" onChange="change_layers_settings_google_maps();">
								<i class="controls-description"><?php echo esc_attr( $gm_fusion_table_id_tooltips ); ?></i>
							</div>
							<div class="form-group">
								<label class="control-label">
									<?php echo esc_attr( $gm_enable_kml_layer ); ?> :
									<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
								</label>
								<select name="ux_ddl_enable_kml_layer" id="ux_ddl_enable_kml_layer" class="form-control" onchange="show_hide_controls_google_maps('#ux_ddl_enable_kml_layer', '#ux_div_enable_kml_layer'), change_layers_settings_google_maps();">
									<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
									<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
								</select>
								<i class="controls-description"><?php echo esc_attr( $gm_enable_kml_layer_tooltips ); ?></i>
							</div>
							<div id="ux_div_enable_kml_layer" style="display:none;">
								<div class="form-group">
									<label class="control-label">
									<?php echo esc_attr( $gm_kml_url ); ?> :
									<span class="required" aria-required="true">*<?php echo ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></span>
								</label>
								<input type="text" class="form-control" name="ux_txt_kml_url" id="ux_txt_kml_url" value="<?php echo isset( $layers_data_unserialized['kml_url'] ) ? esc_attr( $layers_data_unserialized['kml_url'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_kml_url_placeholder ); ?>" onChange="change_layers_settings_google_maps();">
								<i class="controls-description"><?php echo esc_attr( $gm_kml_url_tooltips ); ?></i>
							</div>
							</div>
						</div>
						<div class="line-separator"></div>
						<div class="form-actions">
							<div class="pull-right">
								<input type="submit" class="btn vivid-green" name="ux_btn_add_layer" id="ux_btn_add_layer" value="<?php echo esc_attr( $gm_save_changes ); ?>">
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
				<span>
					<?php echo esc_attr( $gm_layers ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-layers"></i>
						<?php echo esc_attr( $gm_layers ); ?>
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
