<?php
/**
 * This Template is used for managing store locator.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/store-locator
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
		$google_maps_store_locator_delete_nonce = wp_create_nonce( 'store_locator_delete_nonce' );
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
						<?php echo esc_attr( $gm_manage_store ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-energy"></i>
							<?php echo esc_attr( $gm_manage_store ); ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_manage_store">
							<div class="form-body">
								<div class="table-top-margin">
									<select name="ux_ddl_manage_store" id="ux_ddl_manage_store" class="custom-bulk-width">
										<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
										<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' ) '; ?></option>
									</select>
									<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick="premium_edition_notification_google_maps_bank();" >
									<a href="admin.php?page=gmb_add_store" class="btn vivid-green" name="ux_btn_add_store" id="ux_btn_add_store"> <?php echo esc_attr( $gm_add_store ); ?></a>
								</div>
								<div class="line-separator"></div>
								<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_store">
									<thead>
										<tr>
											<th style="text-align: center;" class="chk-action" style="width:5%;">
												<input type="checkbox" name="ux_chk_all_manage_store" id="ux_chk_all_manage_store">
											</th>
											<th style="width:20%;">
												<label>
													<?php echo esc_attr( $gm_store_name ); ?>
												</label>
											</th>
											<th style="width:34%;">
												<label>
													<?php echo esc_attr( $gm_map_address ); ?>
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
										foreach ( $store_locator_unserialize_data as $data ) {
										?>
											<tr>
												<td class="chk-action" style="text-align:center;width: 5%;">
													<input type="checkbox" name="ux_check_manage_store_locator_<?php echo esc_attr( $data['meta_id'] ); ?>" value="<?php echo esc_attr( $data['meta_id'] ); ?>" id="ux_check_manage_store_locator_<?php echo esc_attr( $data['meta_id'] ); ?>" onclick="all_check_google_maps('#ux_chk_all_manage_store', oTable_store_locator);">
												</td>
												<td style="width:20%;">
													<?php echo isset( $data['store_locator_name'] ) ? esc_attr( $data['store_locator_name'] ) : ''; ?>
												</td>
												<td style="width:34%;">
													<?php echo isset( $data['store_locator_formatted_address'] ) ? esc_html( $data['store_locator_formatted_address'] ) : ''; ?>
												</td>
												<td style="width:13%;">
													<?php echo isset( $data['store_locator_latitude'] ) ? floatval( $data['store_locator_latitude'] ) : ''; ?>
												</td>
												<td style="width:13%;">
													<?php echo isset( $data['store_locator_longitude'] ) ? floatval( $data['store_locator_longitude'] ) : ''; ?>
												</td>
												<td style="text-align:center;width:8%;">
													<a href="admin.php?page=gmb_add_store&id=<?php echo esc_attr( $data['meta_id'] ); ?>" class="btn google-maps-bank-buttons" ><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
													<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick='delete_data_google_maps(<?php echo esc_attr( $data['meta_id'] ); ?>, "<?php echo esc_attr( $gm_data_deleted ); ?>", "admin.php?page=gmb_manage_store", "<?php echo esc_attr( $google_maps_store_locator_delete_nonce ); ?>", "delete_store_locator_google_maps");'><?php echo esc_attr( $gm_map_delete ); ?></a>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
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
						<?php echo esc_attr( $gm_manage_store ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-energy"></i>
							<?php echo esc_attr( $gm_manage_store ); ?>
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
