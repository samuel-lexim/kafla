<?php
/**
 * This Template is used for managing maps.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/maps
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
	} elseif ( MAP_SETTINGS_GOOGLE_MAP === '1' ) {
		$google_maps_delete_nonce = wp_create_nonce( 'google_maps_data_delete_nonce' );
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
				<a href="admin.php?page=gmb_google_maps">
					<?php echo esc_attr( $gm_google_maps ); ?>
				</a>
				<span>></span>
			</li>
			<li>
				<span>
					<?php echo esc_attr( $gm_manage_map ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-grid"></i>
						<?php echo esc_attr( $gm_manage_map ); ?>
					</div>
					<p class="premium-editions">
						<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
					</p>
				</div>
				<div class="portlet-body form">
					<form id="ux_frm_manage_maps">
						<div class="form-body">
						<div class="table-top-margin">
							<select name="ux_ddl_manage_maps" id="ux_ddl_manage_maps" class="custom-bulk-width">
								<option value=""><?php echo esc_attr( $gm_bulk_action ); ?></option>
								<option value="delete" style="color:red;"><?php echo esc_attr( $gm_map_delete ) . ' ( ' . esc_attr( $gm_premium_edition_label ) . ' )'; ?></option>
							</select>
							<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo esc_attr( $gm_manage_map_apply ); ?>" onclick='premium_edition_notification_google_maps_bank();'>
							<a href="admin.php?page=gmb_add_map" class="btn vivid-green" name="ux_btn_add_map" id="ux_btn_add_map"> <?php echo esc_attr( $gm_add_map ); ?></a>
						</div>
						<div class="line-separator"></div>
						<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_maps">
							<thead>
								<tr>
									<th style="text-align: center;" class="chk-action" style="width:5%;">
									<input type="checkbox" name="ux_chk_all_manage_maps" id="ux_chk_all_manage_maps">
								</th>
								<th style="width:20%;">
									<label>
										<?php echo esc_attr( $gm_map_title ); ?>
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
								foreach ( $google_maps_unserialize_data as $data ) {
									?>
									<tr>
									<td class="chk-action" style="text-align:center;width: 5%;">
										<input type="checkbox" name="ux_chk_manage_maps_<?php echo esc_attr( $data['meta_id'] ); ?>" id="ux_chk_manage_maps<?php echo esc_attr( $data['meta_id'] ); ?>" onclick="all_check_google_maps('#ux_chk_all_manage_maps', oTable);" value="<?php echo isset( $data['meta_id'] ) ? intval( $data['meta_id'] ) : ''; ?>">
									</td>
									<td style="width:20%;">
										<?php echo isset( $data['map_title'] ) ? esc_attr( $data['map_title'] ) : ''; ?>
									</td>
									<td style="width:34%;">
										<?php echo isset( $data['formatted_address'] ) ? esc_html( $data['formatted_address'] ) : ''; ?>
									</td>
									<td style="width:13%;">
										<?php echo isset( $data['map_latitude'] ) ? floatval( $data['map_latitude'] ) : 0; ?>
									</td>
									<td style="width:13%;">
										<?php echo isset( $data['map_longitude'] ) ? floatval( $data['map_longitude'] ) : 0; ?>
									</td>
									<td style="text-align:center;width:8%;">
										<a href="admin.php?page=gmb_add_map&google_map_id=<?php echo esc_attr( $data['meta_id'] ); ?>" class="btn google-maps-bank-buttons"><?php echo esc_attr( $gmb_edit_tooltip ); ?></a>
										<a href="javascript:void(0);" class="btn google-maps-bank-buttons" onclick='delete_data_google_maps(<?php echo esc_attr( $data['meta_id'] ); ?>, "<?php echo esc_attr( $gm_data_deleted ); ?>", "admin.php?page=gmb_google_maps", "<?php echo esc_attr( $google_maps_delete_nonce ); ?>", "delete_maps_data_google_maps");'><?php echo esc_attr( $gm_map_delete ); ?></a>
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
				<a href="admin.php?page=gmb_google_maps">
					<?php echo esc_attr( $gm_google_maps ); ?>
				</a>
				<span>></span>
			</li>
			<li>
				<span>
					<?php echo esc_attr( $gm_manage_map ); ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-grid"></i>
						<?php echo esc_attr( $gm_manage_map ); ?>
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
