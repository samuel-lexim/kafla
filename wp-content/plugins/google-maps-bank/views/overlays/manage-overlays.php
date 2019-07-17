<?php
/**
 * This Template is used for managing overlays.
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
	} elseif ( OVERLAYS_GOOGLE_MAP === '1' ) {
		$mapid                    = isset( $_REQUEST['google_map_id'] ) ? '&google_map_id=' . intval( $_REQUEST['google_map_id'] ) : ''; // WPCS: CSRF ok,input var ok.
		$google_maps_delete_nonce = wp_create_nonce( 'google_maps_delete_nonce' );
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
					<a href="admin.php?page=gmb_manage_overlays">
						<?php echo esc_attr( $gm_overlays ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo esc_attr( $gm_manage_overlays ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-book-open"></i>
							<?php echo esc_attr( $gm_manage_overlays ); ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_manage_overlays">
							<div class="form-body">
								<div style="max-height:350px;display:none; margin-bottom:4%;" id="ux_div_map_canvas_custom">
									<div id="ux_div_map_canvas" class="map_canvas"></div>
									<div class="line-separator"></div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_choose_map ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<select name="ux_ddl_choose_map" id="ux_ddl_choose_map" class="form-control" onchange="get_url_google_maps('#ux_ddl_choose_map', '', 'gmb_manage_overlays');">
										<option value=""><?php echo esc_attr( $gm_choose_map ); ?></option>
										<?php
										foreach ( $choose_map_data as $key => $value ) {
											?>
											<option value="<?php echo intval( $value['meta_id'] ); ?>"><?php echo esc_attr( $value['map_title'] ); ?></option>
											<?php
										}
										?>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_choose_map_tooltips ); ?></i>
								</div>
								<div class="line-separator"></div>
								<div class="tabbable-custom">
									<ul class="nav nav-tabs ">
										<li class="active">
											<a aria-expanded="true" href="#marker_data" data-toggle="tab">
												<?php echo esc_attr( $gm_markers ); ?>
											</a>
										</li>
										<li>
											<a aria-expanded="false" href="#polygon_data" data-toggle="tab">
												<?php echo esc_attr( $gm_polygons ); ?>
											</a>
										</li>
										<li>
											<a aria-expanded="false" href="#polyline_data" data-toggle="tab">
												<?php echo esc_attr( $gm_polylines ); ?>
											</a>
										</li>
										<li>
											<a aria-expanded="false" href="#circle_data" data-toggle="tab">
												<?php echo esc_attr( $gm_circles ); ?>
											</a>
										</li>
										<li>
											<a aria-expanded="false" href="#rectangle_data" data-toggle="tab">
												<?php echo esc_attr( $gm_rectangles ); ?>
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="marker_data">
											<div class="table-top-margin">
												<select name="ux_ddl_manage_overlays" id="ux_ddl_manage_overlays" class="custom-bulk-width">
													<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
													<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
												</select>
												<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
												<a <?php echo isset( $_REQUEST['google_map_id'] ) ? 'href="admin.php?page=gmb_add_overlays' . esc_attr( $mapid ) . '&overlay=marker"' : 'onclick="check_google_map_exists();"'; // WPCS:CSRF ok,input var ok. ?> class="btn vivid-green" name="ux_btn_add_overlays" id="ux_btn_add_overlays"> <?php echo esc_attr( $gm_add_marker ); ?></a>
											</div>
											<div class="line-separator"></div>
											<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_marker_overlays">
												<thead>
													<tr>
														<th style="text-align: center;" class="chk-action" style="width:5%;">
															<input type="checkbox" name="ux_chk_all_maps_marker" id="ux_chk_all_maps_marker">
														</th>
														<th style="width:7%;">
															<label>
																<?php echo esc_attr( $gm_icons ); ?>
															</label>
														</th>
														<th style="width:20%;">
															<label>
																<?php echo esc_attr( $gm_title ); ?>
															</label>
														</th>
														<th style="width:34%;">
															<label>
																<?php echo esc_attr( $gm_add_map_address ); ?>
															</label>
														</th>
														<th style="width:13%;">
															<label>
																<?php echo esc_attr( $gm_map_latitude ); ?>
															</label>
														</th>
														<th style="width:13%;">
															<label>
																<?php echo esc_attr( $gm_map_longitude ); ?>
															</label>
														</th>
														<th style="width:8%;" class="chk-action">
															<label>
																<?php echo esc_attr( $gm_action ); ?>
															</label>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if ( isset( $google_maps_marker_data ) && count( $google_maps_marker_data ) > 0 ) {
														foreach ( $google_maps_marker_data as $data ) {
														?>
															<tr>
																<td class="chk-action" style="text-align:center;width:5%;">
																	<input type="checkbox" name="ux_chk_manage_marker_<?php echo intval( $data['id'] ); ?>" id="ux_chk_manage_marker_<?php echo intval( $data['id'] ); ?>" onclick="all_check_google_maps('#ux_chk_all_maps_marker', oTable_marker)" value="<?php echo isset( $data['id'] ) ? intval( $data['id'] ) : ''; ?>">
																</td>
																<td style="text-align:left; width:7%;">
																	<?php
																	if ( 'choose_icon' === $data['marker_icon_type'] ) {
																		$url = isset( $data['marker_icon_url'] ) && '' !== $data['marker_icon_url'] ? esc_attr( $data['marker_icon_url'] ) : GOOGLE_MAP_DEFAULT_MARKER_ICON;
																		?>
																		<img src="<?php echo esc_attr( GOOGLE_MAP_CUSTOM_MARKER_ICON ) . esc_attr( $url ); ?>">
																		<?php
																	} elseif ( 'upload' === $data['marker_icon_type'] ) {
																		?>
																		<img src="<?php echo esc_attr( $data['marker_icon_upload'] ); ?>" style="height:30px;width:30px">
																		<?php
																	} else {
																		?>
																		<img src="<?php echo esc_attr( plugins_url( 'assets/global/img/marker-logo.png', dirname( dirname( __FILE__ ) ) ) ); ?>";
																		<?php
																	}
																	?>
																</td>
																<td style="width:20%;">
																	<?php echo isset( $data['marker_title'] ) ? esc_attr( $data['marker_title'] ) : ''; ?>
																</td>
																<td style="width:34%;">
																	<?php echo isset( $data['marker_address'] ) ? esc_html( $data['marker_address'] ) : ''; ?>
																</td>
																<td style="width:13%;">
																	<?php echo isset( $data['marker_latitude'] ) ? floatval( $data['marker_latitude'] ) : ''; ?>
																</td>
																<td style="width:13%;">
																	<?php echo isset( $data['marker_longitude'] ) ? floatval( $data['marker_longitude'] ) : ''; ?>
																</td>
																<td style="text-align:center;width:10% !important;">
																	<a href="admin.php?page=gmb_add_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=marker&edit=<?php echo intval( $data['id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
																	<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick="delete_data_google_maps(<?php echo intval( $data['id'] ); ?>, '<?php echo esc_attr( $gm_data_deleted ); ?>', 'admin.php?page=gmb_manage_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=marker', '<?php echo esc_attr( $google_maps_delete_nonce ); ?>', 'delete_data_google_maps');"><?php echo esc_attr( $gm_map_delete ); ?></a>
																</td>
															</tr>
														<?php
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="polygon_data">
										<div class="table-top-margin">
											<select name="ux_ddl_manage_polygon" id="ux_ddl_manage_polygon" class="custom-bulk-width">
												<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
												<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
											</select>
											<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
											<a <?php echo isset( $_REQUEST['google_map_id'] ) ? 'href="admin.php?page=gmb_add_overlays' . esc_attr( $mapid ) . '&overlay=polygon"' : 'onclick="check_google_map_exists();"'; // WPCS:CSRF ok,input var ok. ?> class="btn vivid-green" name="ux_btn_add_polygon_settings" id="ux_btn_add_polygon_settings"> <?php echo esc_attr( $gm_add_polygon ); ?></a>
										</div>
										<div class="line-separator"></div>
										<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_polygon_overlays">
											<thead>
												<tr>
													<th style="text-align: center;" class="chk-action" style="width:5%;">
														<input type="checkbox" name="ux_chk_all_maps_polygon" id="ux_chk_all_maps_polygon">
													</th>
													<th style="width:20%;">
														<label>
															<?php echo esc_attr( $gm_title ); ?>
														</label>
													</th>
													<th style="width:60%;">
														<label>
															<?php echo esc_attr( $gm_coordinates ); ?>
														</label>
													</th>
													<th style="width:5%;" class="chk-action">
														<label>
															<?php echo esc_attr( $gm_action ); ?>
														</label>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ( isset( $google_maps_polygon_data ) && count( $google_maps_polygon_data ) > 0 ) {
													foreach ( $google_maps_polygon_data as $data ) {
														?>
														<tr>
															<td class="chk-action" style="text-align:center;width: 5%;">
																<input type="checkbox" name="ux_chk_polygon_maps_<?php echo intval( $data['id'] ); ?>" id="ux_chk_polygon_maps_<?php echo intval( $data['id'] ); ?>" value="<?php echo isset( $data['id'] ) ? intval( $data['id'] ) : ''; ?>"  onclick="all_check_google_maps('#ux_chk_all_maps_polygon', oTable_polygon);">
															</td>
															<td style="width:27%;">
																<?php echo esc_attr( $data['polygon_title'] ); ?>
															</td>
															<td style="width:60%;">
																<?php
																$polygon_coordinates = explode( "\n", $data['polygon_coordinates'] );
																foreach ( $polygon_coordinates as $coordinates ) {
																	echo $coordinates . '<br>'; // XSS ok.
																}
																?>
															</td>
															<td style="text-align:center;width:8% !important;">
																<a href="admin.php?page=gmb_add_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=polygon&edit=<?php echo intval( $data['id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
																<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick="delete_data_google_maps(<?php echo intval( $data['id'] ); ?>, '<?php echo esc_attr( $gm_data_deleted ); ?>', 'admin.php?page=gmb_manage_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=polygon', '<?php echo esc_attr( $google_maps_delete_nonce ); ?>', 'delete_data_google_maps');"><?php echo esc_attr( $gm_map_delete ); ?></a>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="polyline_data">
										<div class="table-top-margin">
											<select name="ux_ddl_manage_polyline" id="ux_ddl_manage_polyline" class="custom-bulk-width">
												<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
												<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
											</select>
											<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
											<a <?php echo isset( $_REQUEST['google_map_id'] ) ? 'href="admin.php?page=gmb_add_overlays' . esc_attr( $mapid ) . '&overlay=polyline"' : 'onclick="check_google_map_exists();"'; // WPCS:CSRF ok, input var ok. ?> class="btn vivid-green" name="ux_btn_add_polyline_setting" id="ux_btn_add_polyline_setting"> <?php echo esc_attr( $gm_add_polyline ); ?></a>
										</div>
										<div class="line-separator"></div>
										<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_polyline_overlays">
											<thead>
												<tr>
													<th style="text-align: center;" class="chk-action" style="width:5%";>
														<input type="checkbox" name="ux_chk_all_maps_polyline" id="ux_chk_all_maps_polyline">
													</th>
													<th style="width:20%;">
														<label>
															<?php echo esc_attr( $gm_title ); ?>
														</label>
													</th>
													<th style="width:60%;">
														<label>
															<?php echo esc_attr( $gm_coordinates ); ?>
														</label>
													</th>
													<th style="width:15%;" class="chk-action">
														<label>
															<?php echo esc_attr( $gm_action ); ?>
														</label>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ( isset( $google_polyline_unserialize_data ) && count( $google_polyline_unserialize_data ) > 0 ) {
													foreach ( $google_polyline_unserialize_data as $key => $value ) {
														?>
														<tr>
															<td class="chk-action" style="text-align:center;width: 5%;">
																<input type="checkbox" name="ux_chk_polyline_data_<?php echo intval( $value['id'] ); ?>" id="ux_chk_polyline_data_<?php echo intval( $value['id'] ); ?>" value="<?php echo isset( $value['id'] ) ? intval( $value['id'] ) : ''; ?>" onclick="all_check_google_maps('#ux_chk_all_maps_polyline', oTable_polyline);">
															</td>
															<td style="width:27%;">
																<?php echo esc_attr( $value['polyline_title'] ); ?>
															</td>
															<td style="width:60%;">
																<?php
																$polyline_coordinates = explode( "\n", $value['polyline_cordinates'] );
																foreach ( $polyline_coordinates as $coordinates ) {
																	echo $coordinates . '<br>'; // XSS ok.
																}
																?>
															</td>
															<td style="text-align:center;width:8% !important;">
																<a href="admin.php?page=gmb_add_overlays&google_map_id=<?php echo intval( $value['meta_id'] ); ?>&overlay=polyline&edit=<?php echo intval( $value['id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
																<a href="javascript:void(0);" class="btn google-maps-bank-buttons"  onclick="delete_data_google_maps(<?php echo intval( $value['id'] ); ?>, '<?php echo esc_attr( $gm_data_deleted ); ?>', 'admin.php?page=gmb_manage_overlays&google_map_id=<?php echo intval( $value['meta_id'] ); ?>&overlay=polyline', '<?php echo esc_attr( $google_maps_delete_nonce ); ?>', 'delete_data_google_maps');"><?php echo esc_attr( $gm_map_delete ); ?></a>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="circle_data">
										<div class="table-top-margin">
											<select name="ux_ddl_manage_circle" id="ux_ddl_manage_circle" class="custom-bulk-width">
												<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
												<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
											</select>
											<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
											<a <?php echo isset( $_REQUEST['google_map_id'] ) ? 'href="admin.php?page=gmb_add_overlays' . esc_attr( $mapid ) . '&overlay=circle"' : 'onclick="check_google_map_exists();"'; // WPCS:CSRF ok, input var ok. ?> class="btn vivid-green" name="ux_btn_add_circle_settings" id="ux_btn_add_circle_settings"> <?php echo esc_attr( $gm_add_circle ); ?></a>
										</div>
										<div class="line-separator"></div>
										<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_circle_overlays">
											<thead>
												<tr>
													<th style="text-align: center;" class="chk-action" style="width:5%;">
														<input type="checkbox" name="ux_chk_all_maps_circle" id="ux_chk_all_maps_circle">
													</th>
													<th style="width:20%;">
														<label>
															<?php echo esc_attr( $gm_title ); ?>
														</label>
													</th>
													<th style="width:60%;">
														<label>
															<?php echo esc_attr( $gm_coordinates ); ?>
														</label>
													</th>
													<th style="width:15%;" class="chk-action">
														<label>
															<?php echo esc_attr( $gm_action ); ?>
														</label>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ( isset( $google_map_circle_data ) && count( $google_map_circle_data ) > 0 ) {
													foreach ( $google_map_circle_data as $data ) {
														?>
														<tr>
															<td class="chk-action" style="text-align:center;width: 5%;">
																<input type="checkbox" name="ux_chk_manage_circle_data_<?php echo intval( $data['id'] ); ?>" id="ux_chk_manage_circle_data_<?php echo intval( $data['id'] ); ?>" value="<?php echo isset( $data['id'] ) ? intval( $data['id'] ) : ''; ?>" onclick="all_check_google_maps('#ux_chk_all_maps_circle', oTable_circle);">
															</td>
															<td style="width:27%;">
																<?php echo esc_attr( $data['circle_title'] ); ?>
															</td>
															<td style="width:60%;">
																<?php
																$circle_coordinate = explode( "\n", $data['circle_coordinates'] );
																foreach ( $circle_coordinate as $coordinate ) {
																	echo $coordinate . '<br>'; // XSS ok.
																}
																?>
															</td>
															<td style="text-align:center;width:8% !important;">
																<a href="admin.php?page=gmb_add_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=circle&edit=<?php echo intval( $data['id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
																<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick="delete_data_google_maps(<?php echo intval( $data['id'] ); ?>, '<?php echo esc_attr( $gm_data_deleted ); ?>', 'admin.php?page=gmb_manage_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=circle', '<?php echo esc_attr( $google_maps_delete_nonce ); ?>', 'delete_data_google_maps');"><?php echo esc_attr( $gm_map_delete ); ?></a>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="rectangle_data">
										<div class="table-top-margin">
											<select name="ux_ddl_manage_rectangle" id="ux_ddl_manage_rectangle" class="custom-bulk-width">
												<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
												<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
											</select>
											<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
											<a <?php echo isset( $_REQUEST['google_map_id'] ) ? 'href="admin.php?page=gmb_add_overlays' . esc_attr( $mapid ) . '&overlay=rectangle"' : 'onclick="check_google_map_exists();"'; // WPCS:CSRF ok,input var ok. ?> class="btn vivid-green" name="ux_btn_add_rectangle_settings" id="ux_btn_add_rectangle_settings"> <?php echo esc_attr( $gm_add_rectangle ); ?></a>
										</div>
										<div class="line-separator"></div>
										<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_rectangle_overlays">
											<thead>
												<tr>
													<th style="text-align: center;" class="chk-action" style="width:5%;">
														<input type="checkbox" name="ux_chk_all_maps_rectangle" id="ux_chk_all_maps_rectangle">
													</th>
													<th style="width:30% !important;">
														<label>
															<?php echo esc_attr( $gm_title ); ?>
														</label>
													</th>
													<th style="width:60%;">
														<label>
															<?php echo esc_attr( $gm_coordinates ); ?>
														</label>
													</th>
													<th style="width:15%;" class="chk-action">
														<label>
															<?php echo esc_attr( $gm_action ); ?>
														</label>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ( isset( $google_map_rectangle_data ) && count( $google_map_rectangle_data ) > 0 ) {
													foreach ( $google_map_rectangle_data as $data ) {
														?>
														<tr>
															<td class="chk-action" style="text-align:center;width:5%;">
																<input type="checkbox" name="ux_chk_rectangle_data_<?php echo intval( $data['id'] ); ?>" id="ux_chk_rectangle_data_<?php echo intval( $data['id'] ); ?>" onclick="all_check_google_maps('#ux_chk_all_maps_rectangle', oTable_rectangle);" value="<?php echo isset( $data['id'] ) ? intval( $data['id'] ) : ''; ?>">
															</td>
															<td style="width:27%;">
																<?php echo esc_attr( $data['rectangle_title'] ); ?>
															</td>
															<td style="width:60%;">
																<?php
																$rectangle_coordinate = explode( "\n", $data['coordinates'] );
																foreach ( $rectangle_coordinate as $coordinate ) {
																	echo $coordinate . '<br>'; // XSS ok.
																}
																?>
															</td>
															<td style="text-align:center;width:8% !important;">
																<a href="admin.php?page=gmb_add_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=rectangle&edit=<?php echo intval( $data['id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
																<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick="delete_data_google_maps(<?php echo intval( $data['id'] ); ?>, '<?php echo esc_attr( $gm_data_deleted ); ?>', 'admin.php?page=gmb_manage_overlays&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>&overlay=rectangle', '<?php echo esc_attr( $google_maps_delete_nonce ); ?>', 'delete_data_google_maps');"><?php echo esc_attr( $gm_map_delete ); ?></a>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
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
					<a href="admin.php?page=gmb_manage_overlays">
						<?php echo esc_attr( $gm_overlays ); ?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo esc_attr( $gm_manage_overlays ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-book-open"></i>
							<?php echo esc_attr( $gm_manage_overlays ); ?>
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
