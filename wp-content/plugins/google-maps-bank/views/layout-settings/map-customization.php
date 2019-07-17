<?php
/**
 * This Template is used for managing Map Customization.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/layout-settings
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
	} elseif ( LAYOUT_SETTINGS_GOOGLE_MAP === '1' ) {
		$google_map_customization_nonce = wp_create_nonce( 'google_map_customization_nonce' );
		$map_title_size_color           = isset( $details_map_customization['map_title_font_style'] ) ? explode( ',', esc_attr( $details_map_customization['map_title_font_style'] ) ) : '';
		$map_title_margin               = isset( $details_map_customization['map_title_margin'] ) ? explode( ',', esc_attr( $details_map_customization['map_title_margin'] ) ) : '';
		$map_title_padding              = isset( $details_map_customization['map_title_padding'] ) ? explode( ',', esc_attr( $details_map_customization['map_title_padding'] ) ) : '';

		$map_description_size_color = isset( $details_map_customization['map_description_font_style'] ) ? explode( ',', esc_attr( $details_map_customization['map_description_font_style'] ) ) : '';
		$map_description_margin     = isset( $details_map_customization['map_description_margin'] ) ? explode( ',', esc_attr( $details_map_customization['map_description_margin'] ) ) : '';
		$map_description_padding    = isset( $details_map_customization['map_description_padding'] ) ? explode( ',', esc_attr( $details_map_customization['map_description_padding'] ) ) : '';
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
					<?php echo esc_attr( $gm_map_customization ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-paper-plane"></i>
						<?php echo esc_attr( $gm_map_customization ); ?>
					</div>
					<p class="premium-editions">
						<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
					</p>
				</div>
				<div class="portlet-body form">
					<form id="ux_frm_map_customization">
						<div class="form-body">
						<div class="form-actions">
							<div class="pull-right">
								<input type="submit" class="btn vivid-green" name="ux_btn_map_settings" id="ux_btn_map_settings" value="<?php echo esc_attr( $gm_save_changes ); ?>">
							</div>
						</div>
						<div class="line-separator"></div>
						<div class="tabbable-custom">
							<ul class="nav nav-tabs ">
								<li class="active">
									<a aria-expanded="true" href="#map_control_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_map_controls_settings ); ?>
								</a>
								</li>
								<li>
									<a aria-expanded="false" href="#title_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_title ); ?>
								</a>
								</li>
								<li>
									<a aria-expanded="false" href="#description_settings" data-toggle="tab">
									<?php echo esc_attr( $gm_map_description_settings ); ?>
								</a>
								</li>

							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="map_control_settings">
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_draggable ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_draggable" id="ux_ddl_map_draggable" class="form-control">
												<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
												<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_draggable_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_double_click_zoom ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_double_click_zoom" id="ux_ddl_map_double_click_zoom" class="form-control">
												<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
												<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_double_click_zoom_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_type ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_type" id="ux_ddl_map_type" class="form-control"  onchange='show_hide_controls_google_maps("#ux_ddl_map_type", "#ux_div_map_type_control");'>
												<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
												<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_map_type_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_mouse_wheel_scrolling ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_mouse_wheel_scrolling" id="ux_ddl_mouse_wheel_scrolling" class="form-control">
												<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
												<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_mouse_wheel_scrolling_tooltip ); ?></i>
										</div>
									</div>
								</div>
								<div id="ux_div_map_type_control">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_map_type_control_position ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_type_control_position" id="ux_ddl_map_type_control_position" class="form-control">
												<option value="top_left" selected="selected"><?php echo esc_attr( $gm_map_customization_top_left ); ?></option>
												<option value="top_center"><?php echo esc_attr( $gm_map_customization_top_center ); ?></option>
												<option value="top_right"><?php echo esc_attr( $gm_map_customization_top_right ); ?></option>
												<option value="left_center"><?php echo esc_attr( $gm_map_customization_left_center ); ?></option>
												<option value="left_top"><?php echo esc_attr( $gm_map_customization_left_top ); ?></option>
												<option value="left_bottom"><?php echo esc_attr( $gm_map_customization_left_bottom ); ?></option>
												<option value="right_top"><?php echo esc_attr( $gm_map_customization_right_top ); ?></option>
												<option value="right_center"><?php echo esc_attr( $gm_map_customization_right_center ); ?></option>
												<option value="right_bottom"><?php echo esc_attr( $gm_map_customization_right_bottom ); ?></option>
												<option value="bottom_left"><?php echo esc_attr( $gm_map_customization_bottom_left ); ?></option>
												<option value="bottom_center"><?php echo esc_attr( $gm_map_customization_bottom_center ); ?></option>
												<option value="bottom_right"><?php echo esc_attr( $gm_map_customization_bottom_right ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_map_type_control_position_tooltips ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_map_type_control_style ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_type_control_style" id="ux_ddl_map_type_control_style" class="form-control">
												<option value="none"><?php echo esc_attr( $gm_none ); ?></option>
												<option value="horizontal_bar"><?php echo esc_attr( $gm_map_customization_horizontal_bar ); ?></option>
												<option value="dropdown_menu"><?php echo esc_attr( $gm_map_customization_drop_down_menu ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_map_type_control_style_tooltip ); ?></i>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_map_customization_full_screen_control ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<select name="ux_ddl_full_screen_control" id="ux_ddl_full_screen_control" class="form-control" onchange="show_hide_controls_google_maps('#ux_ddl_full_screen_control', '#ux_full_screen_control_position');">
										<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_map_customization_full_screen_control_tooltip ); ?></i>
								</div>
								<div id="ux_full_screen_control_position" style="display:none !important;">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_map_customization_full_screen_control_position ); ?> :
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_full_screen_control_position" id="ux_ddl_full_screen_control_position" class="form-control">
											<option value="top_left"><?php echo esc_attr( $gm_map_customization_top_left ); ?></option>
											<option value="top_center"><?php echo esc_attr( $gm_map_customization_top_center ); ?></option>
											<option value="top_right" selected="selected"><?php echo esc_attr( $gm_map_customization_top_right ); ?></option>
											<option value="left_center"><?php echo esc_attr( $gm_map_customization_left_center ); ?></option>
											<option value="left_top"><?php echo esc_attr( $gm_map_customization_left_top ); ?></option>
											<option value="left_bottom"><?php echo esc_attr( $gm_map_customization_left_bottom ); ?></option>
											<option value="right_top"><?php echo esc_attr( $gm_map_customization_right_top ); ?></option>
											<option value="right_center"><?php echo esc_attr( $gm_map_customization_right_center ); ?></option>
											<option value="right_bottom" selected="selected"><?php echo esc_attr( $gm_map_customization_right_bottom ); ?></option>
											<option value="bottom_left"><?php echo esc_attr( $gm_map_customization_bottom_left ); ?></option>
											<option value="bottom_center"><?php echo esc_attr( $gm_map_customization_bottom_center ); ?></option>
											<option value="bottom_right"><?php echo esc_attr( $gm_map_customization_bottom_right ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_map_customization_full_screen_control_position_tooltips ); ?></i>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_street_view_control ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_street_view_control" id="ux_ddl_street_view_control" class="form-control" onchange="show_hide_controls_google_maps('#ux_ddl_street_view_control', '#ux_street_view_control_position');">
												<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
												<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_street_view_control_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_rotate_control ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_rotate_control" id="ux_ddl_rotate_control" class="form-control">
												<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
												<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_rotate_control_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div id="ux_street_view_control_position" style="display:none !important;">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_map_customization_street_view_control_position ); ?> :
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_street_view_control_position" id="ux_ddl_street_view_control_position" class="form-control">
											<option value="top_left"><?php echo esc_attr( $gm_map_customization_top_left ); ?></option>
											<option value="top_center"><?php echo esc_attr( $gm_map_customization_top_center ); ?></option>
											<option value="top_right"><?php echo esc_attr( $gm_map_customization_top_right ); ?></option>
											<option value="left_center"><?php echo esc_attr( $gm_map_customization_left_center ); ?></option>
											<option value="left_top"><?php echo esc_attr( $gm_map_customization_left_top ); ?></option>
											<option value="left_bottom"><?php echo esc_attr( $gm_map_customization_left_bottom ); ?></option>
											<option value="right_top"><?php echo esc_attr( $gm_map_customization_right_top ); ?></option>
											<option value="right_center"><?php echo esc_attr( $gm_map_customization_right_center ); ?></option>
											<option value="right_bottom" selected="selected"><?php echo esc_attr( $gm_map_customization_right_bottom ); ?></option>
											<option value="bottom_left"><?php echo esc_attr( $gm_map_customization_bottom_left ); ?></option>
											<option value="bottom_center"><?php echo esc_attr( $gm_map_customization_bottom_center ); ?></option>
											<option value="bottom_right"><?php echo esc_attr( $gm_map_customization_bottom_right ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_map_customization_street_view_control_position_tooltip ); ?></i>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_scale_control ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_scale_control" id="ux_ddl_scale_control" class="form-control">
												<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
												<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_scale_control_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_customization_zoom_control ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_map_zoom_control" id="ux_ddl_map_zoom_control" class="form-control" onchange="show_hide_controls_google_maps('#ux_ddl_map_zoom_control', '#ux_map_zoom_control_alignment');">
												<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
												<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_customization_zoom_control_tooltip ); ?></i>
										</div>
									</div>
								</div>
								<div id="ux_map_zoom_control_alignment" style="display:none !important;">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_map_customization_zoom_control_alignment ); ?> :
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_map_zoom_control_alignment" id="ux_ddl_map_zoom_control_alignment" class="form-control">
											<option value="top_left"><?php echo esc_attr( $gm_map_customization_top_left ); ?></option>
											<option value="top_center"><?php echo esc_attr( $gm_map_customization_top_center ); ?></option>
											<option value="top_right"><?php echo esc_attr( $gm_map_customization_top_right ); ?></option>
											<option value="left_center"><?php echo esc_attr( $gm_map_customization_left_center ); ?></option>
											<option value="left_top"><?php echo esc_attr( $gm_map_customization_left_top ); ?></option>
											<option value="left_bottom"><?php echo esc_attr( $gm_map_customization_left_bottom ); ?></option>
											<option value="right_top"><?php echo esc_attr( $gm_map_customization_right_top ); ?></option>
											<option value="right_center"><?php echo esc_attr( $gm_map_customization_right_center ); ?></option>
											<option value="right_bottom" selected="selected"><?php echo esc_attr( $gm_map_customization_right_bottom ); ?></option>
											<option value="bottom_left"><?php echo esc_attr( $gm_map_customization_bottom_left ); ?></option>
											<option value="bottom_center"><?php echo esc_attr( $gm_map_customization_bottom_center ); ?></option>
											<option value="bottom_right"><?php echo esc_attr( $gm_map_customization_bottom_right ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_map_customization_zoom_control_alignment_tooltip ); ?></i>
									</div>
								</div>
								</div>
								<div class="tab-pane" id="title_settings">
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_html_tag ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control" name="ux_ddl_map_title_html_tag" id="ux_ddl_map_title_html_tag">
												<option value="h1"><?php echo esc_attr( $gm_map_h1_tag ); ?></option>
												<option value="h2"><?php echo esc_attr( $gm_map_h2_tag ); ?></option>
												<option value="h3"><?php echo esc_attr( $gm_map_h3_tag ); ?></option>
												<option value="h4"><?php echo esc_attr( $gm_map_h4_tag ); ?></option>
												<option value="h5"><?php echo esc_attr( $gm_map_h5_tag ); ?></option>
												<option value="h6"><?php echo esc_attr( $gm_map_h6_tag ); ?></option>
												<option value="p"><?php echo esc_attr( $gm_map_paragraph_tag ); ?></option>
												<option value="span"><?php echo esc_attr( $gm_map_span_tag ); ?></option>
												<option value="blockquote"><?php echo esc_attr( $gm_map_blockquote_tag ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_html_tag_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_alignment ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control" name="ux_ddl_map_title_alignment" id="ux_ddl_map_title_alignment">
												<option value="left"><?php echo esc_attr( $gm_left ); ?></option>
												<option value="center"><?php echo esc_attr( $gm_center ); ?></option>
												<option value="right"><?php echo esc_attr( $gm_right ); ?></option>
												<option value="justify"><?php echo esc_attr( $gm_map_justify_alignment ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_alignment_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_title_style ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<select name="ux_txt_map_title_style[]" id="ux_ddl_map_title_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
												</select>
												<input type="text" class="form-control custom-input-medium" name="ux_txt_map_title_style[]" id="ux_txt_map_title_color" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" onblur="default_value_google_maps('#ux_txt_map_title_color', '#000000');" onfocus="google_map_color_picker('#ux_txt_map_title_color', this.value);" value="<?php echo isset( $map_title_size_color[1] ) ? esc_attr( $map_title_size_color[1] ) : '#000000'; ?>">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_font_style_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_map_title_font_family" id="ux_ddl_map_title_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_font_family_tooltips ); ?></i>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_margin ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_margin[]" id="ux_txt_map_title_top_margin" placeholder="<?php echo esc_attr( $gm_top ); ?>" value="<?php echo isset( $map_title_margin[0] ) ? intval( $map_title_margin[0] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_title_top_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_margin[]" id="ux_txt_map_title_right_margin" placeholder="<?php echo esc_attr( $gm_right ); ?>" value="<?php echo isset( $map_title_margin[1] ) ? intval( $map_title_margin[1] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_title_right_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_margin[]" id="ux_txt_map_title_bottom_margin" placeholder="<?php echo esc_attr( $gm_bottom ); ?>" value="<?php echo isset( $map_title_margin[2] ) ? intval( $map_title_margin[2] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_title_bottom_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_margin[]" id="ux_txt_map_title_left_margin" placeholder="<?php echo esc_attr( $gm_left ); ?>" value="<?php echo isset( $map_title_margin[3] ) ? intval( $map_title_margin[3] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_title_left_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_margin_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_padding ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_padding[]" id="ux_txt_map_title_top_padding" placeholder="<?php echo esc_attr( $gm_top ); ?>" value="<?php echo isset( $map_title_padding[0] ) ? intval( $map_title_padding[0] ) : '0'; ?>" onblur="default_value_google_maps('#ux_txt_map_title_top_padding', '0');" maxlength="3" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_padding[]" id="ux_txt_map_title_right_padding" placeholder="<?php echo esc_attr( $gm_right ); ?>" value="<?php echo isset( $map_title_padding[1] ) ? intval( $map_title_padding[1] ) : '0'; ?>" onblur="default_value_google_maps('#ux_txt_map_title_right_padding', '0');" maxlength="3" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_padding[]" id="ux_txt_map_title_bottom_padding" placeholder="<?php echo esc_attr( $gm_bottom ); ?>" value="<?php echo isset( $map_title_padding[2] ) ? intval( $map_title_padding[2] ) : '0'; ?>" onblur="default_value_google_maps('#ux_txt_map_title_bottom_padding', '0');" maxlength="3" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_title_padding[]" id="ux_txt_map_title_left_padding" placeholder="<?php echo esc_attr( $gm_left ); ?>" value="<?php echo isset( $map_title_padding[3] ) ? intval( $map_title_padding[3] ) : '0'; ?>" onblur="default_value_google_maps('#ux_txt_map_title_left_padding', '0');" maxlength="3" onfocus="paste_prevent_google_maps(this.id);">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_map_title_padding_tooltips ); ?></i>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="description_settings">
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_html_tag ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control" name="ux_ddl_description_html_tag" id="ux_ddl_description_html_tag">
												<option value="h1"><?php echo esc_attr( $gm_map_h1_tag ); ?></option>
												<option value="h2"><?php echo esc_attr( $gm_map_h2_tag ); ?></option>
												<option value="h3"><?php echo esc_attr( $gm_map_h3_tag ); ?></option>
												<option value="h4"><?php echo esc_attr( $gm_map_h4_tag ); ?></option>
												<option value="h5"><?php echo esc_attr( $gm_map_h5_tag ); ?></option>
												<option value="h6"><?php echo esc_attr( $gm_map_h6_tag ); ?></option>
												<option value="p"><?php echo esc_attr( $gm_map_paragraph_tag ); ?></option>
												<option value="span"><?php echo esc_attr( $gm_map_span_tag ); ?></option>
												<option value="blockquote"><?php echo esc_attr( $gm_map_blockquote_tag ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_description_html_tag_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_alignment ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control" name="ux_ddl_map_description_alignment" id="ux_ddl_map_description_alignment">
												<option value="left"><?php echo esc_attr( $gm_left ); ?></option>
												<option value="center"><?php echo esc_attr( $gm_center ); ?></option>
												<option value="right"><?php echo esc_attr( $gm_right ); ?></option>
												<option value="justify"><?php echo esc_attr( $gm_map_justify_alignment ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_description_alignment_tooltips ); ?></i>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_dsecription_font_style ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<select name="ux_txt_map_description_style[]" id="ux_ddl_map_description_size" class="form-control custom-input-medium">
												<?php
												for ( $font_size = 1; $font_size <= 200; $font_size++ ) {
													?>
													<option value="<?php echo intval( $font_size ); ?>"><?php echo esc_attr( $font_size ) . 'px'; ?></option>
													<?php
												}
												?>
												</select>
												<input type="text" class="form-control custom-input-medium" name="ux_txt_map_description_style[]" id="ux_txt_map_description_color" placeholder="<?php echo esc_attr( $gm_marker_font_color_placeholder ); ?>" onblur="default_value_google_maps('#ux_txt_map_description_color', '#000000');" onfocus="google_map_color_picker('#ux_txt_map_description_color', this.value);" value="<?php echo isset( $map_description_size_color[1] ) ? esc_attr( $map_description_size_color[1] ) : '#000000'; ?>">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_map_dsecription_font_style_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_font_family ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<select name="ux_ddl_map_description_font_family" id="ux_ddl_map_description_font_family" class="form-control">
												<?php
												if ( file_exists( GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php' ) ) {
													include GOOGLE_MAP_DIR_PATH . 'includes/web-fonts.php';
												}
												?>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_map_dsecription_font_family_tooltips ); ?></i>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_margin ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_margin[]" id="ux_txt_map_description_top_margin" placeholder="<?php echo esc_attr( $gm_top ); ?>" value="<?php echo isset( $map_description_margin[0] ) ? intval( $map_description_margin[0] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_top_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_margin[]" id="ux_txt_map_description_right_margin" placeholder="<?php echo esc_attr( $gm_right ); ?>" value="<?php echo isset( $map_description_margin[1] ) ? intval( $map_description_margin[1] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_right_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_margin[]" id="ux_txt_map_description_bottom_margin" placeholder="<?php echo esc_attr( $gm_bottom ); ?>" value="<?php echo isset( $map_description_margin[2] ) ? intval( $map_description_margin[2] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_bottom_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_margin[]" id="ux_txt_map_description_left_margin" placeholder="<?php echo esc_attr( $gm_left ); ?>" value="<?php echo isset( $map_description_margin[3] ) ? intval( $map_description_margin[3] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_left_margin', '0');" onfocus="paste_prevent_google_maps(this.id);">
											</div>
											<i class="controls-description">"<?php echo esc_attr( $gm_map_description_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_map_padding ); ?> :
												<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
											</label>
											<div>
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_padding[]" id="ux_txt_map_description_top_padding" placeholder="<?php echo esc_attr( $gm_top ); ?>" value="<?php echo isset( $map_description_padding[0] ) ? intval( $map_description_padding[0] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_top_padding', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_padding[]" id="ux_txt_map_description_right_padding" placeholder="<?php echo esc_attr( $gm_right ); ?>" value="<?php echo isset( $map_description_padding[1] ) ? intval( $map_description_padding[1] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_right_padding', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_padding[]" id="ux_txt_map_description_padding_bottom" placeholder="<?php echo esc_attr( $gm_bottom ); ?>" value="<?php echo isset( $map_description_padding[2] ) ? intval( $map_description_padding[2] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_padding_bottom', '0');" onfocus="paste_prevent_google_maps(this.id);">
												<input type="text" disabled="disabled" class="form-control custom-input-xsmall input-inline valid" name="ux_txt_map_description_padding[]" id="ux_txt_map_description_padding_left" placeholder="<?php echo esc_attr( $gm_left ); ?>" value="<?php echo isset( $map_description_padding[3] ) ? intval( $map_description_padding[3] ) : '0'; ?>" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_description_padding_left', '0');" onfocus="paste_prevent_google_maps(this.id);">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_map_description_padding_tooltips ); ?></i>
										</div>
									</div>
									</div>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
										<input type="submit" class="btn vivid-green" name="ux_btn_map_settings" id="ux_btn_map_settings" value="<?php echo esc_attr( $gm_save_changes ); ?>">
									</div>
								</div>
							</div>
							</form>
						</div>
						</div>
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
					<?php echo esc_attr( $gm_map_customization ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-paper-plane"></i>
						<?php echo esc_attr( $gm_map_customization ); ?>
					</div>
					<p class="premium-editions">
						<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
					</p>
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
