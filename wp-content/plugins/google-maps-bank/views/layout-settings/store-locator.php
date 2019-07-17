<?php
/**
 * This Template is used for managing Store Locator settings.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/layout-settings
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
	} elseif ( LAYOUT_SETTINGS_GOOGLE_MAP === '1' ) {
		$store_locator_header_title_style            = isset( $details_store_locator['store_locator_header_title_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_header_title_style'] ) ) : '';
		$store_locator_label_style                   = isset( $details_store_locator['store_locator_label_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_label_style'] ) ) : '';
		$store_locator_button_text_style             = isset( $details_store_locator['store_locator_button_text_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_button_text_style'] ) ) : '';
		$store_locator_height_width                  = isset( $details_store_locator['store_locator_button_height_and_width'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_button_height_and_width'] ) ) : '';
		$store_locator_input_field_text_style        = isset( $details_store_locator['store_locator_input_field_text_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_input_field_text_style'] ) ) : '';
		$store_locator_input_field_margin            = isset( $details_store_locator['store_locator_input_field_margin'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_input_field_margin'] ) ) : '';
		$store_locator_input_field_padding           = isset( $details_store_locator['store_locator_input_field_padding'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_input_field_padding'] ) ) : '';
		$store_locator_input_field_placeholder_style = isset( $details_store_locator['store_locator_input_field_placeholder_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_input_field_placeholder_style'] ) ) : '';
		$store_locator_table_style                   = isset( $details_store_locator['store_locator_table_text_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_table_text_style'] ) ) : '';
		$store_locator_table_display_border_style    = isset( $details_store_locator['store_locator_table_border_style'] ) ? explode( ',', esc_attr( $details_store_locator['store_locator_table_border_style'] ) ) : '';
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
				<a href="admin.php?page=gmb_info_window">
					<?php echo esc_attr( $gm_layout_settings ); ?>
				</a>
				<span>></span>
			</li>
			<li>
				<span>
					<?php echo esc_attr( $gm_store_locator ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-tag"></i>
						<?php echo esc_attr( $gm_store_locator ); ?>
					</div>
					<p class="premium-editions">
						<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
					</p>
				</div>
				<div class="portlet-body form">
					<form id="ux_frm_store_locator">
						<div class="form-body">
						<div class="form-actions">
							<div class="pull-right">
								<input type="submit" class="btn vivid-green" name="ux_btn_store_locator_settings" id="ux_btn_store_locator_settings" value="<?php echo esc_attr( $gm_save_changes ); ?>">
							</div>
						</div>
						<div class="line-separator"></div>
						<div class="tabbable-custom">
							<ul class="nav nav-tabs ">
								<li class="active">
									<a aria-expanded="true" href="#general_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_general_settings ); ?>
								</a>
							</li>
							<li>
								<a aria-expanded="true" href="#header_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_header_settings ); ?>
								</a>
							</li>
							<li>
								<a aria-expanded="false" href="#controls_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_control ); ?>
								</a>
							</li>
							<li>
								<a aria-expanded="false" href="#button_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_button_settings ); ?>
								</a>
							</li>
							<li>
								<a aria-expanded="false" href="#circle_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_circle ); ?>
								</a>
							</li>
							<li>
								<a aria-expanded="false" href="#store_locator_table_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_map_store_locator_table ); ?>
								</a>
							</li>
						</ul>
						<div id="store_locator_map_canvas" style="display:none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="general_settings">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_color ); ?>
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" name="ux_txt_background_color" id= "ux_txt_background_color" placeholder="<?php echo esc_attr( $gm_background_color_placeholder ); ?>" class="form-control" onfocus="google_map_color_picker('#ux_txt_background_color', this.value);" onblur="default_value_google_maps('#ux_txt_background_color', '#ffffff');" value="<?php echo isset( $details_store_locator['store_locator_general_background_color'] ) ? esc_attr( $details_store_locator['store_locator_general_background_color'] ) : '#ffffff'; ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_background_color_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" name="ux_txt_background_color_opacity" id= "ux_txt_background_color_opacity" placeholder="<?php echo esc_attr( $gm_background_color_opacity_placeholder ); ?>" class="form-control" maxlength="3" onblur="default_value_google_maps('#ux_txt_background_color_opacity', '100', 'width');" onkeypress="only_digits_google_maps(event);" onfocus="paste_prevent_google_maps(this.id);" value="<?php echo isset( $details_store_locator['store_locator_general_background_opacity'] ) ? intval( $details_store_locator['store_locator_general_background_opacity'] ) : 100; ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_background_opacity_tooltips ); ?></i>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="header_settings">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_title_style ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div class="input-icon right">
												<select name="ux_txt_store_locator_header_title_style[]" id="ux_ddl_store_locator_header_title_style_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
											</select>
											<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_header_title_style[]" id="ux_txt_store_locator_header_title_style_color" onblur="default_value_google_maps('#ux_txt_store_locator_header_title_style_color', '#000000');" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" value="<?php echo isset( $store_locator_header_title_style[1] ) ? esc_attr( $store_locator_header_title_style[1] ) : '#000000'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_header_title_style_color', this.value);">
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_store_locator_header_style_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_store_locator_header_font_family" id="ux_ddl_store_locator_header_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_header_font_family_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-esc_attrlabel ">
												<?php echo esc_attr( $gm_background_color ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_background_color" id="ux_txt_store_locator_background_color" onblur="default_value_google_maps('#ux_txt_store_locator_background_color', '#ffffff');" value="<?php echo isset( $details_store_locator['store_locator_background_color'] ) ? esc_attr( $details_store_locator['store_locator_background_color'] ) : '#ffffff'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_background_color', this.value);" placeholder="<?php echo esc_attr( $gm_background_color_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_background_color_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_color_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_background_color_opacity" id="ux_txt_store_locator_background_color_opacity"  onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_store_locator_background_color_opacity', '100', 'width');" value="<?php echo isset( $details_store_locator['store_locator_background_color_opacity'] ) ? intval( $details_store_locator['store_locator_background_color_opacity'] ) : 100; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_background_color_opacity_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_background_color_opacity_tooltip ); ?></i>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="controls_settings">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_title_style ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div class="input-icon right">
												<select name="ux_txt_store_locator_label_style[]" id="ux_ddl_store_locator_label_style_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
											</select>
											<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_label_style[]" id="ux_txt_store_locator_label_style_color"  onblur="default_value_google_maps('#ux_txt_store_locator_label_style_color', '#000000');" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" value="<?php echo isset( $store_locator_label_style[1] ) ? esc_attr( $store_locator_label_style[1] ) : '#000000'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_label_style_color', this.value);">
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_label_style_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_store_locator_label_font_family" id="ux_ddl_store_locator_label_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_label_font_family_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_height ); ?>
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" name="ux_txt_input_field_height" id="ux_txt_input_field_height" class="form-control" maxlength="3" onblur="default_value_google_maps('#ux_txt_input_field_height', '40');" onfocus="paste_prevent_google_maps(this.id);" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_input_field_height ); ?>" value="<?php echo isset( $details_store_locator['store_locator_input_field_height'] ) ? intval( $details_store_locator['store_locator_input_field_height'] ) : 40; ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_input_field_height_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_width ); ?>
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" name="ux_txt_input_field_width" id="ux_txt_input_field_width" class="form-control" maxlength="3" onblur="default_value_google_maps('#ux_txt_input_field_width', '100', 'width');" onfocus="paste_prevent_google_maps(this.id);" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_input_field_width ); ?>" value="<?php echo isset( $details_store_locator['store_locator_input_field_width'] ) ? intval( $details_store_locator['store_locator_input_field_width'] ) : 100; ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_input_field_width_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_text_style ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div class="input-icon right">
												<select name="ux_ddl_store_locator_input_field_text_style[]" id="ux_ddl_store_locator_input_field_text_style_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
											</select>
											<input type="text" class="form-control custom-input-medium" name="ux_ddl_store_locator_input_field_text_style[]" id="ux_txt_store_locator_input_field_text_style_color" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" value="<?php echo isset( $store_locator_input_field_text_style[1] ) ? esc_attr( $store_locator_input_field_text_style[1] ) : '#000000'; ?>" onblur="default_value_google_maps('#ux_txt_store_locator_input_field_text_style_color', '#000000');" onfocus="google_map_color_picker('#ux_txt_store_locator_input_field_text_style_color', this.value);">
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_input_field_style_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_store_locator_input_field_font_family" id="ux_ddl_store_locator_input_field_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_input_field_font_family_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_background_color ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_input_field_background_color" id="ux_txt_store_locator_input_field_background_color" onblur="default_value_google_maps('#ux_txt_store_locator_input_field_background_color', '#ffffff');" value="<?php echo isset( $details_store_locator['store_locator_input_field_background_color'] ) ? esc_attr( $details_store_locator['store_locator_input_field_background_color'] ) : '#ffffff'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_input_field_background_color', this.value);" placeholder="<?php echo esc_attr( $gm_background_color_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_direction_input_field_background_color_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_input_field_background_color_opacity" id="ux_txt_store_locator_input_field_background_color_opacity"  onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_store_locator_input_field_background_color_opacity', '75', 'width');" value="<?php echo isset( $details_store_locator['store_locator_input_field_background_color_opacity'] ) ? intval( $details_store_locator['store_locator_input_field_background_color_opacity'] ) : 75; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_background_color_opacity_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_direction_input_field_background_opacity_tooltip ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_margin ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" name="ux_txt_store_locator_input_field_margin[]" id="ux_txt_input_field_top_margin" placeholder="<?php echo esc_attr( $gm_top ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_top_margin', '0');" value="<?php echo isset( $store_locator_input_field_margin[0] ) ? esc_attr( $store_locator_input_field_margin[0] ) : 0; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_margin[]" id="ux_txt_input_field_right_margin"  placeholder="<?php echo esc_attr( $gm_right ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_right_margin', '0');" value="<?php echo isset( $store_locator_input_field_margin[1] ) ? esc_attr( $store_locator_input_field_margin[1] ) : 0; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_margin[]" id="ux_txt_input_field_bottom_margin" placeholder="<?php echo esc_attr( $gm_bottom ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_bottom_margin', '10');" value="<?php echo isset( $store_locator_input_field_margin[2] ) ? esc_attr( $store_locator_input_field_margin[2] ) : 10; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_margin[]" id="ux_txt_input_field_left_margin" placeholder="<?php echo esc_attr( $gm_left ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_left_margin', '0');" value="<?php echo isset( $store_locator_input_field_margin[3] ) ? esc_attr( $store_locator_input_field_margin[3] ) : 0; ?>" maxlength="3" aria-invalid="false">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_input_field_margin_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_padding ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" name="ux_txt_store_locator_input_field_padding[]" id="ux_txt_input_field_top_padding"  placeholder="<?php echo esc_attr( $gm_top ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_top_padding', '0');" value="<?php echo isset( $store_locator_input_field_padding[0] ) ? esc_attr( $store_locator_input_field_padding[0] ) : 0; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_padding[]" id="ux_txt_input_field_right_padding" placeholder="<?php echo esc_attr( $gm_right ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_right_padding', '0');" value="<?php echo isset( $store_locator_input_field_padding[1] ) ? esc_attr( $store_locator_input_field_padding[1] ) : 0; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_padding[]" id="ux_txt_input_field_bottom_padding" placeholder="<?php echo esc_attr( $gm_bottom ); ?>"  class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_bottom_padding', '0');" value="<?php echo isset( $store_locator_input_field_padding[2] ) ? esc_attr( $store_locator_input_field_padding[2] ) : 0; ?>" maxlength="3" aria-invalid="false">
												<input type="text" name="ux_txt_store_locator_input_field_padding[]" id="ux_txt_input_field_left_padding" placeholder="<?php echo esc_attr( $gm_left ); ?>" class="form-control custom-input-xsmall input-inline valid" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_input_field_left_padding', '0');" value="<?php echo isset( $store_locator_input_field_padding[3] ) ? esc_attr( $store_locator_input_field_padding[3] ) : 0; ?>" maxlength="3" aria-invalid="false">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_store_locator_input_field_padding_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_directions_input_field_from ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<input type="text" name="ux_txt_directions_from" id="ux_txt_directions_from" class="form-control" placeholder="<?php echo esc_attr( $gm_directions_input_field_from_placeholder ); ?>" value="<?php echo isset( $details_store_locator['store_locator_input_field_placeholder_form'] ) ? esc_attr( $details_store_locator['store_locator_input_field_placeholder_form'] ) : 'Please enter loction address'; ?>">
									<i class="controls-description"><?php echo esc_attr( $gm_directions_input_field_from_tooltips ); ?></i>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_style ); ?>
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<select class="form-control custom-input-medium" name="ux_txt_input_field_placeholder_style[]" id="ux_ddl_input_field_placeholder_size" value="<?php isset( $store_locator_input_field_placeholder_style[0] ) ? esc_attr( $store_locator_input_field_placeholder_style[0] ) : ''; ?>">
													<?php
													for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
														?>
														<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
														<?php
													}
													?>
												</select>
												<input type="text" class="form-control custom-input-medium" name="ux_txt_input_field_placeholder_style[]" id="ux_txt_input_placeholder_style_color" onblur="default_value_google_maps('#ux_txt_input_placeholder_style_color', '#000000');" onfocus="google_map_color_picker('#ux_txt_input_placeholder_style_color', this.value);" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" aria-invalid="false" value="<?php echo isset( $store_locator_input_field_placeholder_style[1] ) ? esc_attr( $store_locator_input_field_placeholder_style[1] ) : '#000000'; ?>">
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_input_field_style_tooltips ); ?></i>

										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_input_field_style_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_input_field_placeholder_font_family" id="ux_ddl_store_locator_input_field_placeholder_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_input_field_font_family_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_show_default_location ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_default_location" id="ux_ddl_default_location" class="form-control" onchange="enable_disable_controls_google_maps('#ux_ddl_default_location', '#ux_div_default_location');">
												<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
												<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_show_default_location_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div id="ux_div_default_location">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_default_location ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<div class="row" style="margin-top:10px;margin-bottom:5px;">
											<div class="col-md-3">
												<input type="radio" name="ux_chk_map_formatted_address" id="ux_chk_formatted_address" value="formatted_address"  <?php echo isset( $details_store_locator['store_locator_input_field_default_location'] ) && esc_attr( $details_store_locator['store_locator_input_field_default_location'] ) === 'formatted_address' ? 'checked = checked' : ( ! isset( $details_store_locator['store_locator_input_field_default_location'] ) ? 'checked = checked' : '' ); ?> onclick="choose_address_type_google_maps('formatted_address', '#ux_div_map_address', '#ux_div_latitude_longitude');">
												<?php echo esc_attr( $gm_formatted_address ); ?>
											</div>
											<div class="col-md-3">
												<input type="radio" name="ux_chk_map_formatted_address" id="ux_chk_by_latitude_longitude" value="latitude_longitude" <?php echo isset( $details_store_locator['store_locator_input_field_default_location'] ) && esc_attr( $details_store_locator['store_locator_input_field_default_location'] ) === 'latitude_longitude' ? 'checked = checked' : ''; ?> onclick="choose_address_type_google_maps('latitude_longitude', '#ux_div_map_address', '#ux_div_latitude_longitude');" >
												<?php echo esc_attr( $gm_by_latitude_longitude ); ?>
											</div>
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_default_location_tooltips ); ?></i>
									</div>
									<div id="ux_div_map_address">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_add_map_address ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_address" id="ux_txt_address" value="<?php echo isset( $details_store_locator['store_locator_input_field_formatted'] ) ? esc_html( $details_store_locator['store_locator_input_field_formatted'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_address_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_formatted_store_locator_tooltips ); ?></i>
										</div>
									</div>
									<div id="ux_div_latitude_longitude" style="display:none;">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_map_latitude ); ?> :
													<i class="controls-description"><?php echo esc_attr( $gm_latitude_store_locator_tooltips ); ?></i>
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<input type="text" class="form-control ux_txt_latitude" name="ux_txt_latitude" id="ux_txt_latitude" value="<?php echo isset( $details_store_locator['store_locator_input_field_latitude'] ) ? floatval( $details_store_locator['store_locator_input_field_latitude'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_latitude_placeholder ); ?>" onblur="store_locator_get_address_google_maps();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_map_longitude ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<input type="text" class="form-control ux_txt_longitude" name="ux_txt_longitude" id="ux_txt_longitude" value="<?php echo isset( $details_store_locator['store_locator_input_field_longitude'] ) ? floatval( $details_store_locator['store_locator_input_field_longitude'] ) : ''; ?>" placeholder="<?php echo esc_attr( $gm_add_map_longitude_placeholder ); ?>" onblur="store_locator_get_address_google_maps();">
												<i class="controls-description"><?php echo esc_attr( $gm_longitude_store_locator_tooltips ); ?></i>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="button_settings">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_height_and_width ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div class="input-icon right">
												<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_button_height_width[]" id="ux_txt_store_locator_button_height" onblur="default_value_google_maps('#ux_txt_store_locator_button_height', '50', '');" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_height ); ?>" value="<?php echo isset( $store_locator_height_width[0] ) ? intval( $store_locator_height_width[0] ) : 50; ?>" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_button_height_width[]" id="ux_txt_store_locator_button_width" onblur="default_value_google_maps('#ux_txt_store_locator_button_width', '100', '');" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_width ); ?>" value="<?php echo isset( $store_locator_height_width[1] ) ? intval( $store_locator_height_width[1] ) : 100; ?>" onfocus="paste_prevent_google_maps(this.id);">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_height_and_width_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
												<label class="control-label">
												<?php echo esc_attr( $gm_map_alignment ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select id="ux_ddl_store_locator_button_alignment" name="ux_txt_store_locator_button_alignment" class="form-control">
												<option value="left"><?php echo esc_attr( $gm_left ); ?></option>
												<option value="center"><?php echo esc_attr( $gm_center ); ?></option>
												<option value="right"><?php echo esc_attr( $gm_right ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_alignment_tooltips ); ?></i>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_style ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div class="input-icon right">
												<select name="ux_txt_store_locator_button_text_style[]" id="ux_ddl_store_locator_button_text_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
												</select>
												<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_button_text_style[]" id="ux_txt_store_locator_button_text_style_color" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" onblur="default_value_google_maps('#ux_txt_store_locator_button_text_style_color', '#ffffff');" value="<?php echo isset( $store_locator_button_text_style[1] ) ? esc_attr( $store_locator_button_text_style[1] ) : '#ffffff'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_button_text_style_color', this.value);">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_textstyle_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_store_locator_button_font_family" id="ux_ddl_store_locator_button_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_font_family_tooltip ); ?></i>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_color ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_button_background_color" id="ux_txt_store_locator_button_background_color"  onblur="default_value_google_maps('#ux_txt_store_locator_button_background_color', '#a4cd39');" value="<?php echo isset( $details_store_locator['store_locator_button_background_color'] ) ? esc_attr( $details_store_locator['store_locator_button_background_color'] ) : '#a4cd39'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_button_background_color', this.value);" placeholder="<?php echo esc_attr( $gm_background_color_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_background_color_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_background_color_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_button_background_color_opacity" id="ux_txt_store_locator_button_background_color_opacity"  onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_store_locator_button_background_color_opacity', '75', 'width');" value="<?php echo isset( $details_store_locator['store_locator_button_background_color_opacity'] ) ? intval( $details_store_locator['store_locator_button_background_color_opacity'] ) : 75; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_background_color_opacity_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_button_background_color_opacity_tooltip ); ?></i>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="circle_settings">
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_store_locator_distance ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_store_locator_distance" id="ux_ddl_store_locator_distance" class="form-control">
												<option value="kilometers"><?php echo esc_attr( $gm_kilometers ); ?></option>
												<option value="miles"><?php echo esc_attr( $gm_miles ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_distance_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_store_locator_circle_line_width ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_circle_line_width" id="ux_txt_store_locator_circle_line_width"  onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_store_locator_circle_line_width', '3', 'width');" value="<?php echo isset( $details_store_locator['store_locator_circle_line_width'] ) ? intval( $details_store_locator['store_locator_circle_line_width'] ) : ''; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_circle_line_width_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_circle_line_width_tooltips ); ?></i>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_line_color ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_line_color" id="ux_txt_store_locator_line_color" onblur="default_value_google_maps('#ux_txt_store_locator_line_color', '#000000');" value="<?php echo isset( $details_store_locator['store_locator_circle_line_color'] ) ? esc_attr( $details_store_locator['store_locator_circle_line_color'] ) : '#000000'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_line_color', this.value);" placeholder="<?php echo esc_attr( $gm_line_color_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_line_color_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_store_locator_circle_line_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_circle_line_opacity" id="ux_txt_store_locator_circle_line_opacity" onfocus="paste_prevent_google_maps(this.id);"  onblur="default_value_google_maps('#ux_txt_store_locator_circle_line_opacity', '75', 'width');" value="<?php echo isset( $details_store_locator['store_locator_circle_line_color_opacity'] ) ? intval( $details_store_locator['store_locator_circle_line_color_opacity'] ) : 75; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_line_color_opacity_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_circle_line_opacity_tooltip ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_fill_color ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_circle_fill_color" id="ux_txt_store_locator_circle_fill_color"  onblur="default_value_google_maps('#ux_txt_store_locator_circle_fill_color', '#fafafa');" value="<?php echo isset( $details_store_locator['store_locator_circle_fill_color'] ) ? esc_attr( $details_store_locator['store_locator_circle_fill_color'] ) : '#000000'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_circle_fill_color', this.value);" placeholder="<?php echo esc_attr( $gm_store_locator_circle_fill_color_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_circle_fill_color_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_fill_opacity ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<input type="text" class="form-control" name="ux_txt_store_locator_circle_fill_color_opacity" id="ux_txt_store_locator_circle_fill_color_opacity" onfocus="paste_prevent_google_maps(this.id);" onblur="default_value_google_maps('#ux_txt_store_locator_circle_fill_color_opacity', '75', 'width');" value="<?php echo isset( $details_store_locator['store_locator_circle_fill_color_opacity'] ) ? intval( $details_store_locator['store_locator_circle_fill_color_opacity'] ) : 75; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" placeholder="<?php echo esc_attr( $gm_store_locator_circle_fill_color_opacity_placeholder ); ?>">
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_circle_fill_color_opacity_tooltip ); ?></i>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="store_locator_table_settings">
									<div class="form-group">
										<label class="control-label">
										<?php echo esc_attr( $gm_map_store_table_width ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<input type="text" name="ux_txt_store_locator_table_width" id="ux_txt_store_locator_table_width" class="form-control" maxlength="3" onblur="default_value_google_maps('#ux_txt_store_locator_table_width', 100, 'width');"  placeholder="<?php echo esc_attr( $gm_map_store_table_width_placeholder ); ?>" value="<?php echo isset( $details_store_locator['store_locator_table_width'] ) ? intval( $details_store_locator['store_locator_table_width'] ) : 100; ?>" onkeypress="only_digits_google_maps(event);">
									<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_width_tootltips ); ?></i>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_style ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<div class="input-icon right">
													<select name="ux_txt_store_locator_table_style[]" id="ux_txt_store_locator_table_font_size" class="form-control custom-input-medium">
														<?php
														for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
															?>
															<option value="<?php echo esc_attr( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
															<?php
														}
														?>
													</select>
													<input type="text" class="form-control custom-input-medium" name="ux_txt_store_locator_table_style[]" id="ux_txt_store_locator_table_font_color" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" value="<?php echo isset( $store_locator_table_style[1] ) ? esc_attr( $store_locator_table_style[1] ) : '#000000'; ?>" onblur="default_value_google_maps('#ux_txt_store_locator_table_font_color', '#000000');" 	onfocus="google_map_color_picker('#ux_txt_store_locator_table_font_color', this.value);">
												</div>
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_style_tooltips ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_text_font_family ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<select name="ux_ddl_store_locator_table_font_family" id="ux_ddl_store_locator_table_font_family" class="form-control">
													<?php
													if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
														include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
													}
													?>
												</select>
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_font_family_tooltips ); ?></i>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_background_color ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<input type="text" class="form-control" name="ux_txt_store_locator_table_bg_color" id="ux_txt_store_locator_table_bg_color" value="<?php echo isset( $details_store_locator['store_locator_table_background_color'] ) ? esc_attr( $details_store_locator['store_locator_table_background_color'] ) : '#ffffff'; ?>" onblur="default_value_google_maps('#ux_txt_store_locator_table_bg_color', '#ffffff');" onfocus="google_map_color_picker('#ux_txt_store_locator_table_bg_color', this.value);" placeholder="<?php echo esc_attr( $gm_background_color_placeholder ); ?>">
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_bg_color_tooltip ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_background_opacity ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<input type="text" class="form-control" name="ux_txt_store_locator_table_bg_opacity" id="ux_txt_store_locator_table_bg_opacity"  onfocus="paste_prevent_google_maps(this.id);" value='<?php echo isset( $details_store_locator['store_locator_table_background_color_opacity'] ) ? intval( $details_store_locator['store_locator_table_background_color_opacity'] ) : 75; ?>' maxlength="3" onkeypress="only_digits_google_maps(event);" onblur="default_value_google_maps('#ux_txt_store_locator_table_bg_opacity', '100', 'width');" placeholder="<?php echo esc_attr( $gm_background_color_opacity_placeholder ); ?>">
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_bg_opacity_tooltip ); ?></i>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_border_style ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<div class="input-icon right">
													<input type="text" class="form-control input-width-25 input-inline" name="ux_txt_store_locator_table_border_style[]" id="ux_txt_store_locator_table_border_style_size" onfocus="paste_prevent_google_maps(this.id);" placeholder="<?php echo esc_attr( $gm_width ); ?>"  maxlength="3" onkeypress="only_digits_google_maps(event);" onblur="default_value_google_maps('#ux_txt_store_locator_table_border_style_size', '0');" value="<?php echo isset( $store_locator_table_display_border_style[0] ) ? intval( $store_locator_table_display_border_style[0] ) : 0; ?>">
													<select id="ux_ddl_store_locator_table_border_style_type" name="ux_txt_store_locator_table_border_style[]" class="form-control input-width-25 input-inline">
														<option value="none"><?php echo esc_attr( $gm_none ); ?></option>
														<option value="solid"><?php echo esc_attr( $gm_solid ); ?></option>
														<option value="dotted"><?php echo esc_attr( $gm_dotted ); ?></option>
														<option value="dashed"><?php echo esc_attr( $gm_dashed ); ?></option>
													</select>
													<input type="text" class="form-control input-normal input-inline" name="ux_txt_store_locator_table_border_style[]" id="ux_txt_store_locator_table_border_style_color" placeholder="<?php echo esc_attr( $gm_border_radius_color_tooltips ); ?>" value="<?php echo isset( $direction_display_border_style[2] ) ? esc_attr( $direction_display_border_style[2] ) : '#a4cd39'; ?>" onfocus="google_map_color_picker('#ux_txt_store_locator_table_border_style_color', this.value);" onblur="default_value_google_maps('#ux_txt_store_locator_table_border_style_color', '#a4cd39');">
												</div>
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_border_style_tooltip ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_border_radius ); ?> :
													<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
												</label>
												<input type="text" class="form-control" name="ux_txt_store_locator_table_border_radius" id="ux_txt_store_locator_table_border_radius" onfocus="paste_prevent_google_maps(this.id);" value="<?php echo isset( $details_store_locator['store_locator_table_border_radius'] ) ? intval( $details_store_locator['store_locator_table_border_radius'] ) : 0; ?>" maxlength="3" onkeypress="only_digits_google_maps(event);" onblur="default_value_google_maps('#ux_txt_store_locator_table_border_radius', '0');" placeholder="<?php echo esc_attr( $gm_border_radius ); ?>">
												<i class="controls-description"><?php echo esc_attr( $gm_map_store_table_border_radius_tooltip ); ?></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="line-separator"></div>
						<div class="form-actions">
							<div class="pull-right">
								<input type="submit" class="btn vivid-green" name="ux_btn_store_locator_settings" id="ux_btn_store_locator_settings" value="<?php echo esc_attr( $gm_save_changes ); ?>">
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
				<a href="admin.php?page=gmb_info_window">
					<?php echo esc_attr( $gm_layout_settings ); ?>
				</a>
				<span>></span>
			</li>
			<li>
				<span>
					<?php echo esc_attr( $gm_store_locator ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-tag"></i>
						<?php echo esc_attr( $gm_store_locator ); ?>
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
