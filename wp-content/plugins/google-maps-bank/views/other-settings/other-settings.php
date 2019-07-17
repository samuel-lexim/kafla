<?php
/**
 * This Template is used for manage other settings.
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/other-settings
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
	} elseif ( OTHER_SETTINGS_GOOGLE_MAP === '1' ) {
		$other_settings_nonce = wp_create_nonce( 'other_settings_nonce' );
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
						<?php echo esc_attr( $gm_other_settings ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-wrench"></i>
							<?php echo esc_attr( $gm_other_settings ); ?>
						</div>
						<p class="premium-editions">
							<?php echo esc_attr( $gm_upgrade_kanow_about ); ?> <a href="https://google-maps-bank.tech-banker.com" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_full_features ); ?></a> <?php echo esc_attr( $gm_chek_our ); ?><a href="https://google-maps-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"> <?php echo esc_attr( $gm_online_demos ); ?></a>
						</p>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_other_settings">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_other_settings_remove_tables_uninstall ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_remove_tables" id="ux_ddl_remove_tables" class="form-control">
												<option value="enable"><?php echo esc_attr( $gm_enable ); ?></option>
												<option value="disable"><?php echo esc_attr( $gm_disable ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_other_settings_remove_tables_uninstall_tooltip ); ?></i>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo esc_attr( $gm_shortcode_map_language ); ?> :
												<span class="required" aria-required="true">*</span>
											</label>
											<select id="ux_ddl_map_language" name="ux_ddl_map_language" class="form-control" onchange="">
												<option value="af"><?php echo esc_attr( 'Afrikaans' ); ?></option>
												<option value="sq"><?php echo esc_attr( 'Albanian' ); ?></option>
												<option value="ar"><?php echo esc_attr( 'Arabic' ); ?></option>
												<option value="eu"><?php echo esc_attr( 'Basque' ); ?></option>
												<option value="be"><?php echo esc_attr( 'Belarusian' ); ?></option>
												<option value="bn"><?php echo esc_attr( 'Bengali' ); ?></option>
												<option value="bg"><?php echo esc_attr( 'Bulgarian' ); ?></option>
												<option value="ca"><?php echo esc_attr( 'Catalan' ); ?></option>
												<option value="zh-cn"><?php echo esc_attr( 'Chinese (Simplified)' ); ?></option>
												<option value="zh-tw"><?php echo esc_attr( 'Chinese (Traditional)' ); ?></option>
												<option value="hr"><?php echo esc_attr( 'Croatian' ); ?></option>
												<option value="cs"><?php echo esc_attr( 'Czech' ); ?></option>
												<option value="da"><?php echo esc_attr( 'Danish' ); ?></option>
												<option value="nl"><?php echo esc_attr( 'Dutch' ); ?></option>
												<option value="nl-be"><?php echo esc_attr( 'Dutch (Belgium)' ); ?></option>
												<option value="nl-nl"><?php echo esc_attr( 'Dutch (Netherlands)' ); ?></option>
												<option value="en"><?php echo esc_attr( 'English' ); ?></option>
												<option value="en-au"><?php echo esc_attr( 'English (Australia)' ); ?></option>
												<option value="en-bz"><?php echo esc_attr( 'English (Belize)' ); ?></option>
												<option value="en-ca"><?php echo esc_attr( 'English (Canada)' ); ?></option>
												<option value="en-ie"><?php echo esc_attr( 'English (Ireland)' ); ?></option>
												<option value="en-jm"><?php echo esc_attr( 'English (Jamaica)' ); ?></option>
												<option value="en-nz"><?php echo esc_attr( 'English (New Zealand)' ); ?></option>
												<option value="en-ph"><?php echo esc_attr( 'English (Phillipines)' ); ?></option>
												<option value="en-za"><?php echo esc_attr( 'English (South Africa)' ); ?></option>
												<option value="en-tt"><?php echo esc_attr( 'English (Trinidad)' ); ?></option>
												<option value="en-gb"><?php echo esc_attr( 'English (United Kingdom)' ); ?></option>
												<option value="en-us"><?php echo esc_attr( 'English (United States)' ); ?></option>
												<option value="en-zw"><?php echo esc_attr( 'English (Zimbabwe)' ); ?></option>
												<option value="et"><?php echo esc_attr( 'Estonian' ); ?></option>
												<option value="fo"><?php echo esc_attr( 'Faeroese' ); ?></option>
												<option value="fa"><?php echo esc_attr( 'Farsi' ); ?></option>
												<option value="fi"><?php echo esc_attr( 'Finnish' ); ?></option>
												<option value="fil"><?php echo esc_attr( 'Filipino' ); ?></option>
												<option value="fr"><?php echo esc_attr( 'French' ); ?></option>
												<option value="fr-be"><?php echo esc_attr( 'French (Belgium)' ); ?></option>
												<option value="fr-ca"><?php echo esc_attr( 'French (Canada)' ); ?></option>
												<option value="fr-fr"><?php echo esc_attr( 'French (France)' ); ?></option>
												<option value="fr-lu"><?php echo esc_attr( 'French (Luxembourg)' ); ?></option>
												<option value="fr-mc"><?php echo esc_attr( 'French (Monaco)' ); ?></option>
												<option value="fr-ch"><?php echo esc_attr( 'French (Switzerland)' ); ?></option>
												<option value="gl"><?php echo esc_attr( 'Galician' ); ?></option>
												<option value="gd"><?php echo esc_attr( 'Gaelic' ); ?></option>
												<option value="de"><?php echo esc_attr( 'German' ); ?></option>
												<option value="de-at"><?php echo esc_attr( 'German (Austria)' ); ?></option>
												<option value="de-de"><?php echo esc_attr( 'German (Germany)' ); ?></option>
												<option value="de-li"><?php echo esc_attr( 'German (Liechtenstein)' ); ?></option>
												<option value="de-lu"><?php echo esc_attr( 'German (Luxembourg)' ); ?></option>
												<option value="de-ch"><?php echo esc_attr( 'German (Switzerland)' ); ?></option>
												<option value="el"><?php echo esc_attr( 'Greek' ); ?></option>
												<option value="gu"><?php echo esc_attr( 'Gujarati' ); ?></option>
												<option value="hi"><?php echo esc_attr( 'Hindi' ); ?></option>
												<option value="haw"><?php echo esc_attr( 'Hawaiian' ); ?></option>
												<option value="iw"><?php echo esc_attr( 'Hebrew' ); ?></option>
												<option value="hu"><?php echo esc_attr( 'Hungarian' ); ?></option>
												<option value="is"><?php echo esc_attr( 'Icelandic' ); ?></option>
												<option value="in"><?php echo esc_attr( 'Indonesian' ); ?></option>
												<option value="ga"><?php echo esc_attr( 'Irish' ); ?></option>
												<option value="it"><?php echo esc_attr( 'Italian' ); ?></option>
												<option value="it-it"><?php echo esc_attr( 'Italian (Italy)' ); ?></option>
												<option value="it-ch"><?php echo esc_attr( 'Italian (Switzerland)' ); ?></option>
												<option value="ja"><?php echo esc_attr( 'Japanese' ); ?></option>
												<option value="kn"><?php echo esc_attr( 'Kannada' ); ?></option>
												<option value="ko"><?php echo esc_attr( 'Korean' ); ?></option>
												<option value="lt"><?php echo esc_attr( 'Lithuanian' ); ?></option>
												<option value="lv"><?php echo esc_attr( 'Latvian' ); ?></option>
												<option value="mk"><?php echo esc_attr( 'Macedonian' ); ?></option>
												<option value="ml"><?php echo esc_attr( 'Malayalam' ); ?></option>
												<option value="mr"><?php echo esc_attr( 'Marathi' ); ?></option>
												<option value="no"><?php echo esc_attr( 'Norwegian' ); ?></option>
												<option value="pl"><?php echo esc_attr( 'Polish' ); ?></option>
												<option value="pt"><?php echo esc_attr( 'Portuguese' ); ?></option>
												<option value="pt-br"><?php echo esc_attr( 'Portuguese (Brazil)' ); ?></option>
												<option value="pt-pt"><?php echo esc_attr( 'Portuguese (Portugal)' ); ?></option>
												<option value="ro"><?php echo esc_attr( 'Romanian' ); ?></option>
												<option value="ro-mo"><?php echo esc_attr( 'Romanian (Moldova)' ); ?></option>
												<option value="ro-ro"><?php echo esc_attr( 'Romanian (Romania)' ); ?></option>
												<option value="ru"><?php echo esc_attr( 'Russian' ); ?></option>
												<option value="ru-mo"><?php echo esc_attr( 'Russian (Moldova)' ); ?></option>
												<option value="ru-ru"><?php echo esc_attr( 'Russian (Russia)' ); ?></option>
												<option value="sr"><?php echo esc_attr( 'Serbian' ); ?></option>
												<option value="sk"><?php echo esc_attr( 'Slovak' ); ?></option>
												<option value="sl"><?php echo esc_attr( 'Slovenian' ); ?></option>
												<option value="es"><?php echo esc_attr( 'Spanish' ); ?></option>
												<option value="es-ar"><?php echo esc_attr( 'Spanish (Argentina)' ); ?></option>
												<option value="es-bo"><?php echo esc_attr( 'Spanish (Bolivia)' ); ?></option>
												<option value="es-cl"><?php echo esc_attr( 'Spanish (Chile)' ); ?></option>
												<option value="es-co"><?php echo esc_attr( 'Spanish (Colombia)' ); ?></option>
												<option value="es-cr"><?php echo esc_attr( 'Spanish (Costa Rica)' ); ?></option>
												<option value="es-do"><?php echo esc_attr( 'Spanish (Dominican Republic)' ); ?></option>
												<option value="es-ec"><?php echo esc_attr( 'Spanish (Ecuador)' ); ?></option>
												<option value="es-sv"><?php echo esc_attr( 'Spanish (El Salvador)' ); ?></option>
												<option value="es-gt"><?php echo esc_attr( 'Spanish (Guatemala)' ); ?></option>
												<option value="es-hn"><?php echo esc_attr( 'Spanish (Honduras)' ); ?></option>
												<option value="es-mx"><?php echo esc_attr( 'Spanish (Mexico)' ); ?></option>
												<option value="es-ni"><?php echo esc_attr( 'Spanish (Nicaragua)' ); ?></option>
												<option value="es-pa"><?php echo esc_attr( 'Spanish (Panama)' ); ?></option>
												<option value="es-py"><?php echo esc_attr( 'Spanish (Paraguay)' ); ?></option>
												<option value="es-pe"><?php echo esc_attr( 'Spanish (Peru)' ); ?></option>
												<option value="es-pr"><?php echo esc_attr( 'Spanish (Puerto Rico)' ); ?></option>
												<option value="es-es"><?php echo esc_attr( 'Spanish (Spain)' ); ?></option>
												<option value="es-uy"><?php echo esc_attr( 'Spanish (Uruguay)' ); ?></option>
												<option value="es-ve"><?php echo esc_attr( 'Spanish (Venezuela)' ); ?></option>
												<option value="sv"><?php echo esc_attr( 'Swedish' ); ?></option>
												<option value="sv-fi"><?php echo esc_attr( 'Swedish (Finland)' ); ?></option>
												<option value="sv-se"><?php echo esc_attr( 'Swedish (Sweden)' ); ?></option>
												<option value="tl"><?php echo esc_attr( 'Tagalog' ); ?></option>
												<option value="ta"><?php echo esc_attr( 'Tamil' ); ?></option>
												<option value="te"><?php echo esc_attr( 'Telugu' ); ?></option>
												<option value="th"><?php echo esc_attr( 'Thai' ); ?></option>
												<option value="tr"><?php echo esc_attr( 'Turkish' ); ?></option>
												<option value="uk"><?php echo esc_attr( 'Ukranian' ); ?></option>
												<option value="vi"><?php echo esc_attr( 'Vietnamese' ); ?></option>
											</select>
											<i class="controls-description"><?php echo esc_attr( $gm_shortcode_map_language_tooltips ); ?></i>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_api_key ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<input class="form-control" name="ux_txt_other_api_key" id="ux_txt_other_api_key" placeholder="<?php echo esc_attr( $gm_other_api_key_placeholder ); ?>" value="<?php echo isset( $details_other_settings['other_api_key'] ) ? esc_attr( $details_other_settings['other_api_key'] ) : 'AIzaSyDKiOeLPhYwOiJ8fvtwE3a0nKZBeiSJ8gQ'; ?>">
									<i class="controls-description"><?php echo esc_attr( $gm_other_api_key_tooltip ); ?></i>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo esc_attr( $gm_other_settings_ip_address_fetching_method ); ?> :
										<span class="required" aria-required="true">*</span>
									</label>
									<select name="ux_ddl_fetching_method" id="ux_ddl_fetching_method" class="form-control">
										<option value=""><?php echo esc_attr( $gm_other_settings_ip_address_fetching_option1 ); ?></option>
										<option value="REMOTE_ADDR"><?php echo esc_attr( $gm_other_settings_ip_address_fetching_option2 ); ?></option>
										<option value="HTTP_X_FORWADED_FOR"><?php echo esc_attr( $gm_other_settings_ip_address_fetching_option3 ); ?></option>
										<option value="HTTP_X_REAL_IP"><?php echo esc_attr( $gm_other_settings_ip_address_fetching_option4 ); ?></option>
										<option value="HTTP_CF_CONNECTING_IP"><?php echo esc_attr( $gm_other_settings_ip_address_fetching_option5 ); ?></option>
									</select>
									<i class="controls-description"><?php echo esc_attr( $gm_other_settings_ip_address_tooltips ); ?></i>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
										<input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo esc_attr( $gm_save_changes ); ?>">
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
						<?php echo esc_attr( $gm_other_settings ); ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-wrench"></i>
							<?php echo esc_attr( $gm_other_settings ); ?>
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
