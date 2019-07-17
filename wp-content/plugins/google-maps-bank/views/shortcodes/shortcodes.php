<?php
/**
 * This Template is used for manage shortcode.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/shortcode
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
	} elseif ( SHORTCODES_GOOGLE_MAP === '1' ) {
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
						<?php echo esc_attr( $gm_shortcode ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-rocket"></i>
							<?php echo esc_attr( $gm_shortcode ); ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_shortcode">
							<div class="form-body">
								<div class="form-actions">
									<div class="pull-right">
										<input type="submit" class="btn vivid-green" name="ux_btn_generate_shortcode" id="ux_btn_generate_shortcode" value="<?php echo esc_attr( $gm_generate_shortcode ); ?>">
									</div>
								</div>
								<div class="line-separator"></div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gmb_display_type ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<select class="form-control" name="ux_ddl_display_type" id="ux_ddl_display_type" onchange="get_shortcode_google_maps()">
										<option value="map"><?php echo esc_attr( $gmb_map ); ?></option>
										<option value="store_locator" style="color:red;"><?php echo esc_attr( $gm_store_locator ); ?> ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</option>
										<option value="directions" style="color:red;"><?php echo esc_attr( $gm_directions ); ?> ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gmb_display_type_tooltips ); ?></i>
								</div>
								<div id="ux_div_map_shortcode_settings">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_choose_map ); ?> :
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_select_map" id="ux_ddl_select_map" class="form-control">
											<option value=""><?php echo esc_attr( $gm_choose_map ); ?></option>
											<?php
											foreach ( $choose_map_data as $key => $value ) {
												?>
												<option value="<?php echo intval( $value['meta_id'] ); ?>"><?php echo esc_attr( $value['map_title'] ); ?></option>
												<?php
											}
											?>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_choose_map_shortcodes_tooltips ); ?></i>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_map_title ); ?> :
													<span class="required" aria-required="true">*</span>
												</label>
												<select name="ux_ddl_map_title" id="ux_ddl_map_title" class="form-control">
													<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
													<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
												</select>
												<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_title_tooltips ); ?></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo esc_attr( $gm_add_map_description ); ?> :
													<span class="required" aria-required="true">*</span>
												</label>
												<select name="ux_ddl_map_description" id="ux_ddl_map_description" class="form-control" >
													<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
													<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
												</select>
												<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_description_tooltips ); ?></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_shortcode_map_themes ); ?> :
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_map_themes" id="ux_ddl_map_themes" class="form-control">
											<option value="a_dark_world"><?php echo esc_attr( $gm_shortcode_theme_style_a_dark_world ); ?></option>
											<option value="apple_maps_esque"><?php echo esc_attr( $gm_shortcode_theme_style_apple_maps_esque ); ?></option>
											<option value="Aqua"><?php echo esc_attr( $gm_shortcode_theme_style_aqua ); ?></option>
											<option value="avocado_world"><?php echo esc_attr( $gm_shortcode_theme_style_avocado_world ); ?></option>
											<option value="bates_green"><?php echo esc_attr( $gm_shortcode_theme_style_bates_green ); ?></option>
											<option value="becomeadinosaur"><?php echo esc_attr( $gm_shortcode_theme_style_becomeadinosaur ); ?></option>
											<option value="beige_white_and_blue"><?php echo esc_attr( $gm_shortcode_theme_style_beige_white_and_blue ); ?></option>
											<option value="bentley"><?php echo esc_attr( $gm_shortcode_theme_style_bentley ); ?></option>
											<option value="black_and_white"><?php echo esc_attr( $gm_shortcode_theme_style_black_and_white ); ?></option>
											<option value="blueish"><?php echo esc_attr( $gm_shortcode_theme_style_blueish ); ?></option>
											<option value="blueprint"><?php echo esc_attr( $gm_shortcode_theme_style_blueprint ); ?></option>
											<option value="bluish"><?php echo esc_attr( $gm_shortcode_theme_style_bluish ); ?></option>
											<option value="blue_cyan"><?php echo esc_attr( $gm_shortcode_theme_style_blue_cyan ); ?></option>
											<option value="blue_essence"><?php echo esc_attr( $gm_shortcode_theme_style_blue_essence ); ?></option>
											<option value="blue_gray"><?php echo esc_attr( $gm_shortcode_theme_style_blue_gray ); ?></option>
											<option value="blue_water"><?php echo esc_attr( $gm_shortcode_theme_style_blue_water ); ?></option>
											<option value="bobbys_world"><?php echo esc_attr( $gm_shortcode_theme_style_bobbys_world ); ?></option>
											<option value="bright_bubbly"><?php echo esc_attr( $gm_shortcode_theme_style_bright_bubbly ); ?></option>
											<option value="bright_dessert"><?php echo esc_attr( $gm_shortcode_theme_style_bright_dessert ); ?></option>
											<option value="brownie"><?php echo esc_attr( $gm_shortcode_theme_style_brownie ); ?></option>
											<option value="candy_colours"><?php echo esc_attr( $gm_shortcode_theme_style_candy_colours ); ?></option>
											<option value="caribbean_mountain"><?php echo esc_attr( $gm_shortcode_theme_style_caribbean_mountain ); ?></option>
											<option value="chilled"><?php echo esc_attr( $gm_shortcode_theme_style_chilled ); ?></option>
											<option value="clean_cut"><?php echo esc_attr( $gm_shortcode_theme_style_clean_cut ); ?></option>
											<option value="clean_grey"><?php echo esc_attr( $gm_shortcode_theme_style_clean_grey ); ?></option>
											<option value="cobalt"><?php echo esc_attr( $gm_shortcode_theme_style_cobalt ); ?></option>
											<option value="colorblind_friendly"><?php echo esc_attr( $gm_shortcode_theme_style_colorblind_friendly ); ?></option>
											<option value="cool_grey"><?php echo esc_attr( $gm_shortcode_theme_style_cool_grey ); ?></option>
											<option value="countries"><?php echo esc_attr( $gm_shortcode_theme_style_countries ); ?></option>
											<option value="deep_green"><?php echo esc_attr( $gm_shortcode_theme_style_deep_green ); ?></option>
											<option value="default1" selected="selected"><?php echo esc_attr( $gm_shortcode_theme_style_default ); ?></option>
											<option value="dark_grey_on_light_grey"><?php echo esc_attr( $gm_shortcode_theme_style_dark_grey_on_light_grey ); ?></option>
											<option value="esperanto"><?php echo esc_attr( $gm_shortcode_theme_style_esperanto ); ?></option>
											<option value="flat_green"><?php echo esc_attr( $gm_shortcode_theme_style_flat_green ); ?></option>
											<option value="flat_map"><?php echo esc_attr( $gm_shortcode_theme_style_flat_map ); ?></option>
											<option value="golden_crown"><?php echo esc_attr( $gm_shortcode_theme_style_golden_crown ); ?></option>
											<option value="gowalla"><?php echo esc_attr( $gm_shortcode_theme_style_gowalla ); ?></option>
											<option value="grass_is_greener_Water_is_bluer"><?php echo esc_attr( $gm_shortcode_theme_style_grass_is_greener_water_is_bluer ); ?></option>
											<option value="greyscale"><?php echo esc_attr( $gm_shortcode_theme_style_greyscale ); ?></option>
											<option value="hard_edges"><?php echo esc_attr( $gm_shortcode_theme_style_hard_edges ); ?></option>
											<option value="hashtagnineninenine"><?php echo esc_attr( $gm_shortcode_theme_style_hashtagnineninenine ); ?></option>
											<option value="hints_of_gold"><?php echo esc_attr( $gm_shortcode_theme_style_hints_of_gold ); ?></option>
											<option value="holiday"><?php echo esc_attr( $gm_shortcode_theme_style_holiday ); ?></option>
											<option value="homage_to_toner"><?php echo esc_attr( $gm_shortcode_theme_style_homage_to_toner ); ?></option>
											<option value="hopper"><?php echo esc_attr( $gm_shortcode_theme_style_hopper ); ?></option>
											<option value="hot_pink"><?php echo esc_attr( $gm_shortcode_theme_style_hot_pink ); ?></option>
											<option value="ilustracao"><?php echo esc_attr( $gm_shortcode_theme_style_ilustracao ); ?></option>
											<option value="icy_blue"><?php echo esc_attr( $gm_shortcode_theme_style_icy_blue ); ?></option>
											<option value="jane_iredale"><?php echo esc_attr( $gm_shortcode_theme_style_jane_iredale ); ?></option>
											<option value="jazzygreen"><?php echo esc_attr( $gm_shortcode_theme_style_jazzygreen ); ?></option>
											<option value="just_places"><?php echo esc_attr( $gm_shortcode_theme_style_just_places ); ?></option>
											<option value="lemon_tree"><?php echo esc_attr( $gm_shortcode_theme_style_lemon_tree ); ?></option>
											<option value="light_blue_water"><?php echo esc_attr( $gm_shortcode_theme_style_light_blue_water ); ?></option>
											<option value="light_green"><?php echo esc_attr( $gm_shortcode_theme_style_light_green ); ?></option>
											<option value="light_monochrome"><?php echo esc_attr( $gm_shortcode_theme_style_light_monochrome ); ?></option>
											<option value="lost_in_the_desert"><?php echo esc_attr( $gm_shortcode_theme_style_lost_in_the_desert ); ?></option>
											<option value="lunar_landscape"><?php echo esc_attr( $gm_shortcode_theme_style_lunar_landscape ); ?></option>
											<option value="manushka"><?php echo esc_attr( $gm_shortcode_theme_style_manushka ); ?></option>
											<option value="mapbox"><?php echo esc_attr( $gm_shortcode_theme_style_mapbox ); ?></option>
											<option value="midnight_commander"><?php echo esc_attr( $gm_shortcode_theme_style_midnight_commander ); ?></option>
											<option value="mikiwat"><?php echo esc_attr( $gm_shortcode_theme_style_mikiwat ); ?></option>
											<option value="military_flat"><?php echo esc_attr( $gm_shortcode_theme_style_military_flat ); ?></option>
											<option value="mixed"><?php echo esc_attr( $gm_shortcode_theme_style_mixed ); ?></option>
											<option value="muted_blue"><?php echo esc_attr( $gm_shortcode_theme_style_muted_blue ); ?></option>
											<option value="muted_monotone"><?php echo esc_attr( $gm_shortcode_theme_style_muted_monotone ); ?></option>
											<option value="nature"><?php echo esc_attr( $gm_shortcode_theme_style_nature ); ?></option>
											<option value="nature_highlight"><?php echo esc_attr( $gm_shortcode_theme_style_nature_highlight ); ?></option>
											<option value="neon_world"><?php echo esc_attr( $gm_shortcode_theme_style_neon_world ); ?></option>
											<option value="neutral_blue"><?php echo esc_attr( $gm_shortcode_theme_style_neutral_blue ); ?></option>
											<option value="night_vision"><?php echo esc_attr( $gm_shortcode_theme_style_night_vision ); ?></option>
											<option value="old_dry_mud"><?php echo esc_attr( $gm_shortcode_theme_style_old_dry_mud ); ?></option>
											<option value="old_map"><?php echo esc_attr( $gm_shortcode_theme_style_old_map ); ?></option>
											<option value="old_timey"><?php echo esc_attr( $gm_shortcode_theme_style_old_timey ); ?></option>
											<option value="overseas"><?php echo esc_attr( $gm_shortcode_theme_style_overseas ); ?></option>
											<option value="pale_dawn"><?php echo esc_attr( $gm_shortcode_theme_style_pale_dawn ); ?></option>
											<option value="paper"><?php echo esc_attr( $gm_shortcode_theme_style_light_paper ); ?></option>
											<option value="pastel_tones"><?php echo esc_attr( $gm_shortcode_theme_style_pastel_tones ); ?></option>
											<option value="pink_blue"><?php echo esc_attr( $gm_shortcode_theme_style_pink_blue ); ?></option>
											<option value="purple_rain"><?php echo esc_attr( $gm_shortcode_theme_style_purple_rain ); ?></option>
											<option value="red_alert"><?php echo esc_attr( $gm_shortcode_theme_style_red_alert ); ?></option>
											<option value="red_green"><?php echo esc_attr( $gm_shortcode_theme_style_red_green ); ?></option>
											<option value="red_hues"><?php echo esc_attr( $gm_shortcode_theme_style_red_hues ); ?></option>
											<option value="retro"><?php echo esc_attr( $gm_shortcode_theme_style_retro ); ?></option>
											<option value="roadie"><?php echo esc_attr( $gm_shortcode_theme_style_roadie ); ?></option>
											<option value="roadtrip_at_night"><?php echo esc_attr( $gm_shortcode_theme_style_roadtrip_at_night ); ?></option>
											<option value="routeXL"><?php echo esc_attr( $gm_shortcode_theme_style_routexl ); ?></option>
											<option value="san_andreas"><?php echo esc_attr( $gm_shortcode_theme_style_san_andreas ); ?></option>
											<option value="shade_of_green"><?php echo esc_attr( $gm_shortcode_theme_style_shade_of_green ); ?></option>
											<option value="shades_of_grey"><?php echo esc_attr( $gm_shortcode_theme_style_shades_of_grey ); ?></option>
											<option value="shift_worker"><?php echo esc_attr( $gm_shortcode_theme_style_shift_worker ); ?></option>
											<option value="simple_labels"><?php echo esc_attr( $gm_shortcode_theme_style_simple_labels ); ?></option>
											<option value="snazzy_maps"><?php echo esc_attr( $gm_shortcode_theme_style_snazzy_maps ); ?></option>
											<option value="souldisco"><?php echo esc_attr( $gm_shortcode_theme_style_souldisco ); ?></option>
											<option value="swiss_cheese"><?php echo esc_attr( $gm_shortcode_theme_style_swiss_cheese ); ?></option>
											<option value="subtle"><?php echo esc_attr( $gm_shortcode_theme_style_subtle ); ?></option>
											<option value="subtle_green"><?php echo esc_attr( $gm_shortcode_theme_style_subtle_green ); ?></option>
											<option value="subtle_grayscale"><?php echo esc_attr( $gm_shortcode_theme_style_subtle_grayscale ); ?></option>
											<option value="subtle_greyscale_map"><?php echo esc_attr( $gm_shortcode_theme_style_subtle_greyscale_map ); ?></option>
											<option value="the_endless_atlas"><?php echo esc_attr( $gm_shortcode_theme_style_the_endless_atlas ); ?></option>
											<option value="the_Propia_effect"><?php echo esc_attr( $gm_shortcode_theme_style_the_propia_effect ); ?></option>
											<option value="totally_pink"><?php echo esc_attr( $gm_shortcode_theme_style_totally_pink ); ?></option>
											<option value="towalk"><?php echo esc_attr( $gm_shortcode_theme_style_towalk ); ?></option>
											<option value="transport_for_london"><?php echo esc_attr( $gm_shortcode_theme_style_transport_for_london ); ?></option>
											<option value="tripitty"><?php echo esc_attr( $gm_shortcode_theme_style_tripitty ); ?></option>
											<option value="turquoise_water"><?php echo esc_attr( $gm_shortcode_theme_style_turquoise_water ); ?></option>
											<option value="unimposed_topography"><?php echo esc_attr( $gm_shortcode_theme_style_unimposed_topography ); ?></option>
											<option value="unsaturated_browns"><?php echo esc_attr( $gm_shortcode_theme_style_unsaturated_browns ); ?></option>
											<option value="vintage"><?php echo esc_attr( $gm_shortcode_theme_style_vintage ); ?></option>
											<option value="vintage_blue"><?php echo esc_attr( $gm_shortcode_theme_style_vintage_blue ); ?></option>
											<option value="vitamin_c"><?php echo esc_attr( $gm_shortcode_theme_style_vitamin_c ); ?></option>
											<option value="veins"><?php echo esc_attr( $gm_shortcode_theme_style_veins ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_themes_tooltips ); ?></i>
									</div>
								</div>
								<div id="ux_div_store_locator_shortcode_settings" style="display:none !important;">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_shortcode_store_locator_header_title ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<input type="text" class="form-control" name="ux_txt_store_locator_header_title" id="ux_txt_store_locator_header_title" value="" placeholder="<?php echo esc_attr( $gm_store_locator_header_title_placeholder ); ?>">
										<i class="controls-description"><?php echo esc_attr( $gm_shortcode_store_locator_header_title_tooltip ); ?></i>
									</div>
								</div>
								<div id="ux_div_directions_shortcode_settings" style="display:none !important;">
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_shortcode_directions_header_title ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<input type="text" class="form-control" name="ux_txt_directions_header_title" id="ux_txt_directions_header_title" value="" placeholder="<?php echo esc_attr( $gm_directions_header_title_placeholder ); ?>">
										<i class="controls-description"><?php echo esc_attr( $gm_shortcode_directions_header_title_tooltip ); ?></i>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo esc_attr( $gm_shortcode_display_text_directions ); ?> :
											<span class="required" aria-required="true">* ( <?php echo esc_attr( $gm_premium_edition_label ); ?> )</span>
										</label>
										<select name="ux_ddl_display_text_directions" id="ux_ddl_display_text_directions" class="form-control">
											<option value="show"><?php echo esc_attr( $gm_show ); ?></option>
											<option value="hide"><?php echo esc_attr( $gm_hide ); ?></option>
										</select>
										<i class="controls-description"><?php echo esc_attr( $gm_shortcode_display_text_directions_tooltip ); ?></i>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_map_height ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<input type="text" class="form-control" name="ux_txt_map_height_and_width" id="ux_txt_map_height" placeholder="<?php echo esc_attr( $gm_map_height_placeholder ); ?>" value="350" onkeypress="only_digits_google_maps(event)" maxlength="4" onblur="default_value_google_maps('#ux_txt_map_height', '350');">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_height_tooltips ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_map_width ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<input type="text" class="form-control" name="ux_txt_map_height_and_width" id="ux_txt_map_width" placeholder="<?php echo esc_attr( $gm_map_width_placeholder ); ?>" value="100" onkeypress="only_digits_google_maps(event)" maxlength="3" onblur="default_value_google_maps('#ux_txt_map_width', '100', 'width');">
											</div>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_width_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="form-group" id="ux_div_generate_shortcode" style="display:none;">
									<label class="control-label">
										<?php echo esc_attr( $gm_shortcodes ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<div class="icon-custom-docs tooltips pull-right" style="font-size:15px;" data-original-title="<?php echo esc_attr( $gmb_copy_to_clipboard ); ?>" data-placement="left" data-clipboard-action="copy" data-clipboard-target="#ux_txt_shortcodes"></div>
									<textarea class="form-control" name="ux_txt_shortcodes" id="ux_txt_shortcodes" rows="4" placeholder="<?php echo esc_attr( $gm_shortcodes_placeholder ); ?>" readonly></textarea>
									<i class="controls-description"><?php echo esc_attr( $gm_shortcodes_tooltips ); ?></i>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
										<input type="submit" class="btn vivid-green" name="ux_btn_generate_shortcode" id="ux_btn_generate_shortcode" value="<?php echo esc_attr( $gm_generate_shortcode ); ?>">
									</div>
								</div>
							</form>
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
					<span>
						<?php echo esc_attr( $gm_shortcode ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-rocket"></i>
							<?php echo esc_attr( $gm_shortcode ); ?>
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
