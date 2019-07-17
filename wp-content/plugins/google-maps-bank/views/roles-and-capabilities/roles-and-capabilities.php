<?php
/**
 * This Template is used for manage roles and capabilities.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/roles-and-capabilities
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
	} elseif ( ROLES_AND_CAPABILITIES_GOOGLE_MAP === '1' ) {
		$roles_and_capabilities = isset( $details_roles_capabilities['roles_and_capabilities'] ) ? explode( ',', $details_roles_capabilities['roles_and_capabilities'] ) : '';
		$administrator          = isset( $details_roles_capabilities['administrator_privileges'] ) ? explode( ',', $details_roles_capabilities['administrator_privileges'] ) : '';
		$author                 = isset( $details_roles_capabilities['author_privileges'] ) ? explode( ',', $details_roles_capabilities['author_privileges'] ) : '';
		$editor                 = isset( $details_roles_capabilities['editor_privileges'] ) ? explode( ',', $details_roles_capabilities['editor_privileges'] ) : '';
		$contributor            = isset( $details_roles_capabilities['contributor_privileges'] ) ? explode( ',', $details_roles_capabilities['contributor_privileges'] ) : '';
		$subscriber             = isset( $details_roles_capabilities['subscriber_privileges'] ) ? explode( ',', $details_roles_capabilities['subscriber_privileges'] ) : '';
		$other                  = isset( $details_roles_capabilities['other_roles_privileges'] ) ? explode( ',', $details_roles_capabilities['other_roles_privileges'] ) : '';
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
						<?php echo esc_attr( $gm_roles_and_capabilities_label ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-users"></i>
							<?php echo esc_attr( $gm_roles_and_capabilities_label ); ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_roles_and_capabilities">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_and_capabilities_show_google_maps_menu_label ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<table class="table table-striped table-bordered table-margin-top" id="ux_tbl_plugin_settings">
										<thead>
											<tr>
												<th>
													<input type="checkbox" name="ux_chk_administrator" id="ux_chk_administrator" checked="checked" disabled="disabled" value="1" <?php echo '1' === $roles_and_capabilities[0] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_administrator_label ); ?>
												</th>
												<th>
													<input type="checkbox" name="ux_chk_author" id="ux_chk_author" value="1" onclick="show_roles_capabilities_google_maps(this, 'ux_div_author_roles');" <?php echo '1' === $roles_and_capabilities[1] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_author_label ); ?>
												</th>
												<th>
													<input type="checkbox" name="ux_chk_editor" id="ux_chk_editor" value="1" onclick="show_roles_capabilities_google_maps(this, 'ux_div_editor_roles');" <?php echo '1' === $roles_and_capabilities[2] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_editor_label ); ?>
												</th>
												<th>
													<input type="checkbox" name="ux_chk_contributor" id="ux_chk_contributor" value="1" onclick="show_roles_capabilities_google_maps(this, 'ux_div_contributor_roles');" <?php echo '1' === $roles_and_capabilities[3] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_contributor_label ); ?>
												</th>
												<th>
													<input type="checkbox" name="ux_chk_subscriber" id="ux_chk_subscriber" value="1" onclick="show_roles_capabilities_google_maps(this, 'ux_div_subscriber_roles');" <?php echo '1' === $roles_and_capabilities[4] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_subscriber_label ); ?>
												</th>
												<th>
													<input type="checkbox" name="ux_chk_other" id="ux_chk_other" value="1" onclick="show_roles_capabilities_google_maps(this, 'ux_div_other_roles');" <?php echo '1' === $roles_and_capabilities[5] ? 'checked = checked' : ''; ?>>
													<?php echo esc_attr( $gm_roles_and_capabilities_other_label ); ?>
												</th>
											</tr>
										</thead>
									</table>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_sidebar_menu_tooltip ); ?></i>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_and_capabilities_show_google_maps_top_menu_label ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<div class="input-icon right">
										<select id="ux_ddl_top_bar" name="ux_ddl_top_bar" class="form-control">
											<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
											<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
										</select>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_top_bar_menu_tooltip ); ?></i>
								</div>
								<div class="line-separator"></div>
								<div class="form-group">
									<div id="ux_div_administrator_roles">
										<label class="control-label">
											<?php echo esc_attr( $gm_roles_and_capabilities_administrator_role_label ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<div class="table-margin-top">
											<table class="table table-striped table-bordered table-hover" id="ux_tbl_administrator">
												<thead>
													<tr>
														<th style="width: 40% !important;">
															<input type="checkbox" name="ux_chk_full_control_administrator" id="ux_chk_full_control_administrator" checked="checked" disabled="disabled" value="1">
															<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_manage_maps_admin" disabled="disabled" checked="checked" id="ux_chk_manage_maps_admin" value="1">
															<?php echo esc_attr( $gm_google_maps ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_overlays_admin" disabled="disabled" checked="checked" id="ux_chk_overlays_admin" value="1">
															<?php echo esc_attr( $gm_overlays ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_layers_admin" disabled="disabled" checked="checked" id="ux_chk_layers_admin" value="1">
															<?php echo esc_attr( $gm_layers ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_store_locator_admin" disabled="disabled" checked="checked" id="ux_chk_store_locator_admin" value="1">
															<?php echo esc_attr( $gm_store_locator ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_layout_settings_admin" disabled="disabled" checked="checked" id="ux_chk_layout_settings_admin" value="1">
															<?php echo esc_attr( $gm_layout_settings ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_custom_css_admin" disabled="disabled" checked="checked" id="ux_chk_custom_css_admin" value="1">
															<?php echo esc_attr( $gm_custom_css ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_shortcode_admin" disabled="disabled" checked="checked" id="ux_chk_shortcode_admin" value="1">
															<?php echo esc_attr( $gm_shortcode ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_other_settings_admin" disabled="disabled" checked="checked" id="ux_chk_other_settings_admin" value="1">
															<?php echo esc_attr( $gm_other_settings ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_roles_and_capabilities_admin" disabled="disabled" checked="checked" id="ux_chk_roles_and_capabilities_admin" value="1">
															<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_system_information_admin" disabled="disabled" checked="checked" id="ux_chk_system_information_admin" value="1">
															<?php echo esc_attr( $gm_system_information ); ?>
														</td>
														<td>
														</td>
														<td>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_admin_access_tooltip ); ?></i>
										<div class="line-separator"></div>
									</div>
								</div>
								<div class="form-group">
									<div id="ux_div_author_roles">
										<label class="control-label">
											<?php echo esc_attr( $gm_roles_and_capabilities_author_role_label ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<div class="table-margin-top">
											<table class="table table-striped table-bordered table-hover" id="ux_tbl_author">
												<thead>
													<tr>
														<th style="width: 40% !important;">
															<input type="checkbox" name="ux_chk_full_control_author" id="ux_chk_full_control_author" value="1" onclick="full_control_function_google_maps(this, 'ux_div_author_roles');" <?php echo isset( $author ) && '1' === $author[0] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_manage_maps_author" id="ux_chk_manage_maps_author" value="1" <?php echo isset( $author ) && '1' === $author[1] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_google_maps ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_overlays_author" id="ux_chk_overlays_author" value="1" <?php echo isset( $author ) && '1' === $author[2] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_overlays ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_layers_author" id="ux_chk_layers_author" value="1" <?php echo isset( $author ) && '1' === $author[3] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_layers ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_store_locator_author" id="ux_chk_store_locator_author" value="1" <?php echo isset( $author ) && '1' === $author[4] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_store_locator ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_layout_settings_author" id="ux_chk_layout_settings_author" value="1" <?php echo isset( $author ) && '1' === $author[5] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_layout_settings ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_custom_css_author" id="ux_chk_custom_css_author" value="1" <?php echo isset( $author ) && '1' === $author[6] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_custom_css ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_shortcode_author" id="ux_chk_shortcode_author" value="1" <?php echo isset( $author ) && '1' === $author[7] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_shortcode ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_other_settings_author" id="ux_chk_other_settings_author" value="1" <?php echo isset( $author ) && '1' === $author[8] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_other_settings ); ?>
														</td>
														<td>
															<input type="checkbox" name="ux_chk_roles_and_capabilities_author" id="ux_chk_roles_and_capabilities_author" value="1" <?php echo isset( $author ) && '1' === $author[9] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
														</td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" name="ux_chk_system_information_author" id="ux_chk_system_information_author" value="1" <?php echo isset( $author ) && '1' === $author[10] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_system_information ); ?>
														</td>
														<td>
														</td>
														<td>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_author_access_tooltip ); ?></i>
										<div class="line-separator"></div>
									</div>
								</div>
								<div class="form-group">
									<div id="ux_div_editor_roles">
										<label class="control-label">
											<?php echo esc_attr( $gm_roles_and_capabilities_editor_role_label ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<div class="table-margin-top">
											<table class="table table-striped table-bordered table-hover" id="ux_tbl_editor">
												<thead>
													<tr>
														<th style="width: 40% !important;">
															<input type="checkbox" name="ux_chk_full_control_editor" id="ux_chk_full_control_editor" value="1" onclick="full_control_function_google_maps(this, 'ux_div_editor_roles');" <?php echo isset( $editor ) && '1' === $editor[0] ? 'checked = checked' : ''; ?>>
															<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
														</th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_manage_maps_editor" id="ux_chk_manage_maps_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[1] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_google_maps ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_overlays_editor" id="ux_chk_overlays_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[2] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_overlays ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layers_editor" id="ux_chk_layers_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[3] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layers ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_store_locator_editor" id="ux_chk_store_locator_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[4] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_store_locator ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layout_settings_editor" id="ux_chk_layout_settings_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[5] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layout_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_custom_css_editor" id="ux_chk_custom_css_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[6] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_custom_css ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_shortcode_editor" id="ux_chk_shortcode_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[7] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_shortcode ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_other_settings_editor" id="ux_chk_other_settings_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[8] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_other_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_roles_and_capabilities_editor" id="ux_chk_roles_and_capabilities_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[9] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
													</td>
												</tr>
												<tr>
													<td>
													<input type="checkbox" name="ux_chk_system_information_editor" id="ux_chk_system_information_editor" value="1" <?php echo isset( $editor ) && '1' === $editor[10] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_system_information ); ?>
													</td>
													<td>
													</td>
													<td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_editor_access_tooltip ); ?></i>
									<div class="line-separator"></div>
								</div>
							</div>
							<div class="form-group">
								<div id="ux_div_contributor_roles">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_and_capabilities_contributor_role_label ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<div class="table-margin-top">
										<table class="table table-striped table-bordered table-hover" id="ux_tbl_contributor">
											<thead>
												<tr>
													<th style="width: 40% !important;">
														<input type="checkbox" name="ux_chk_full_control_contributor" id="ux_chk_full_control_contributor" value="1" onclick="full_control_function_google_maps(this, 'ux_div_contributor_roles');" <?php echo isset( $contributor ) && '1' === $contributor[0] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_manage_maps_contributor" id="ux_chk_manage_maps_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[1] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_google_maps ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_overlays_contributor" id="ux_chk_overlays_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[2] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_overlays ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layers_contributor" id="ux_chk_layers_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[3] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layers ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_store_locator_contributor" id="ux_chk_store_locator_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[4] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_store_locator ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layout_settings_contributor" id="ux_chk_layout_settings_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[5] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layout_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_custom_css_contributor" id="ux_chk_custom_css_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[6] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_custom_css ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_shortcode_contributor" id="ux_chk_shortcode_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[7] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_shortcode ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_other_settings_contributor" id="ux_chk_other_settings_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[8] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_other_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_roles_and_capabilities_contributor" id="ux_chk_roles_and_capabilities_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[9] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_system_information_contributor" id="ux_chk_system_information_contributor" value="1" <?php echo isset( $contributor ) && '1' === $contributor[10] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_system_information ); ?>
													</td>
													<td>
													</td>
													<td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_contributor_access_tooltip ); ?></i>
									<div class="line-separator"></div>
								</div>
							</div>
							<div class="form-group">
								<div id="ux_div_subscriber_roles">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_and_capabilities_subscriber_role_label ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<div class="table-margin-top">
										<table class="table table-striped table-bordered table-hover" id="ux_tbl_subscriber">
											<thead>
												<tr>
													<th style="width: 40% !important;">
														<input type="checkbox" name="ux_chk_full_control_subscriber" id="ux_chk_full_control_subscriber" value="1" onclick="full_control_function_google_maps(this, 'ux_div_subscriber_roles');" <?php echo isset( $subscriber ) && '1' === $subscriber[0] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_manage_maps_subscriber" id="ux_chk_manage_maps_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[1] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_google_maps ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_overlays_subscriber" id="ux_chk_overlays_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[2] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_overlays ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layers_subscriber" id="ux_chk_layers_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[3] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layers ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_store_locator_subscriber" id="ux_chk_store_locator_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[4] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_store_locator ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layout_settings_subscriber" id="ux_chk_layout_settings_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[5] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layout_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_custom_css_subscriber" id="ux_chk_custom_css_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[6] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_custom_css ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_shortcode_subscriber" id="ux_chk_shortcode_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[7] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_shortcode ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_other_settings_subscriber" id="ux_chk_other_settings_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[8] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_other_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_roles_and_capabilities_subscriber" id="ux_chk_roles_and_capabilities_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[9] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_system_information_subscriber" id="ux_chk_system_information_subscriber" value="1" <?php echo isset( $subscriber ) && '1' === $subscriber[10] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_system_information ); ?>
													</td>
													<td>
													</td>
													<td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_subscriber_access_tooltip ); ?></i>
									<div class="line-separator"></div>
								</div>
							</div>
							<div class="form-group">
								<div id="ux_div_other_roles">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_capabilities_other_role ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<div class="table-margin-top">
										<table class="table table-striped table-bordered table-hover" id="ux_tbl_other">
											<thead>
												<tr>
													<th style="width: 40% !important;">
														<input type="checkbox" name="ux_chk_full_control_other" id="ux_chk_full_control_other" value="1" onclick="full_control_function_google_maps(this, 'ux_div_other_roles');" <?php echo isset( $other ) && '1' === $other[0] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_manage_maps_other" id="ux_chk_manage_maps_other" value="1" <?php echo isset( $other ) && '1' === $other[1] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_google_maps ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_overlays_other" id="ux_chk_overlays_other" value="1" <?php echo isset( $other ) && '1' === $other[2] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_overlays ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layers_other" id="ux_chk_layers_other" value="1" <?php echo isset( $other ) && '1' === $other[3] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layers ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_store_locator_other" id="ux_chk_store_locator_other" value="1" <?php echo isset( $other ) && '1' === $other[4] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_store_locator ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_layout_settings_other" id="ux_chk_layout_settings_other" value="1" <?php echo isset( $other ) && '1' === $other[5] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_layout_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_custom_css_other" id="ux_chk_custom_css_other" value="1" <?php echo isset( $other ) && '1' === $other[6] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_custom_css ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_shortcode_other" id="ux_chk_shortcode_other" value="1" <?php echo isset( $other ) && '1' === $other[7] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_shortcode ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_other_settings_other" id="ux_chk_other_settings_other" value="1" <?php echo isset( $other ) && '1' === $other[8] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_other_settings ); ?>
													</td>
													<td>
														<input type="checkbox" name="ux_chk_roles_and_capabilities_other" id="ux_chk_roles_and_capabilities_other" value="1" <?php echo isset( $other ) && '1' === $other[9] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_roles_and_capabilities ); ?>
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" name="ux_chk_system_information_other" id="ux_chk_system_information_other" value="1" <?php echo isset( $other ) && '1' === $other[10] ? 'checked = checked' : ''; ?>>
														<?php echo esc_attr( $gm_system_information ); ?>
													</td>
													<td>
													</td>
													<td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_capabilities_other_role_tooltip ); ?></i>
									<div class="line-separator"></div>
								</div>
							</div>
							<div class="form-group">
								<div id="ux_div_other_roles_capabilities">
									<label class="control-label">
										<?php echo esc_attr( $gm_roles_and_capabilities_other_roles_capabilities ); ?> :
										<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
									</label>
									<div class="table-margin-top">
										<table class="table table-striped table-bordered table-hover" id="ux_tbl_other_roles">
											<thead>
												<tr>
													<th style="width: 40% !important;">
														<input type="checkbox" name="ux_chk_full_control_other_roles" id="ux_chk_full_control_other_roles" value="1" onclick="full_control_function_google_maps(this, 'ux_div_other_roles_capabilities')">
														<?php echo esc_attr( $gm_roles_and_capabilities_full_control_label ); ?>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$flag              = 0;
												$user_capabilities = get_others_capabilities_google_maps();
												if ( isset( $user_capabilities ) && count( $user_capabilities ) > 0 ) {
													foreach ( $user_capabilities as $key => $value ) {
														$other_roles = in_array( $value, $other_roles_array, true ) ? 'checked=checked' : '';
														$flag++;
														if ( 0 === $key % 3 ) {
															?>
															<tr>
															<?php
														}
														?>
														<td>
															<input type="checkbox" name="ux_chk_other_capabilities_<?php echo esc_attr( $value ); ?>" id="ux_chk_other_capabilities_<?php echo esc_attr( $value ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo esc_attr( $other_roles ); ?>>
															<?php echo esc_attr( $value ); ?>
														</td>
														<?php
														if ( count( $user_capabilities ) === $flag && 1 === $flag % 3 ) {
															?>
															<td>
															</td>
															<td>
															</td>
															<?php
														}
														?>
														<?php
														if ( count( $user_capabilities ) === $flag && 2 === $flag % 3 ) {
															?>
															<td>
															</td>
															<?php
														}
														?>
														<?php
														if ( 0 === $flag % 3 ) {
															?>
														</tr>
														<?php
														}
													}
												}
												?>
											</tbody>
										</table>
									</div>
									<i class="controls-description"><?php echo esc_attr( $gm_roles_and_capabilities_other_roles_capabilities_tooltip ); ?></i>
									<div class="line-separator"></div>
								</div>
							</div>
							<div class="form-actions">
								<div class="pull-right">
									<input type="submit" class="btn vivid-green" id="btn_save_roles_capabilities" name="btn_save_roles_capabilities" value="<?php echo esc_attr( $gm_save_changes ); ?>">
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
						<?php echo esc_attr( $gm_roles_and_capabilities_label ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-user"></i>
							<?php echo esc_attr( $gm_roles_and_capabilities_label ); ?>
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
