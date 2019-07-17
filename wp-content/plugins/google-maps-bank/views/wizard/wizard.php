<?php
/**
 * This Template is used for Wizard
 *
 * @author  Tech Banker
 * @package google-maps-bank/views/wizard
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
	} else {
		$google_maps_check_status = wp_create_nonce( 'google_maps_check_status' );
		?>
		<html>
			<body>
			<div><div><div>
				<div class="page-container header-wizard">
					<div class="page-content">
						<div class="row row-custom row-bg">
							<div class="col-md-1"></div>
							<div class="col-md-4 center">
								<b>
									<i class="dashicons dashicons-wordpress gm-dashicons-wordpress"></i>
								</b>
							</div>
							<div class="col-md-2 center">
								<i class="dashicons dashicons-plus gm-dashicons-plus"></i>
							</div>
							<div class="col-md-4 center">
								<img src="<?php echo esc_attr( plugins_url( 'assets/global/img/google-map-icon.png', dirname( dirname( __FILE__ ) ) ) ); ?>" height="110" width="110">
							</div>
							<div class="col-md-1"></div>
						</div>
						<div class="row row-custom">
							<div class="col-md-12 textalign">
								<p><?php echo esc_attr( __( 'Hi there!', 'google-maps-bank' ) ); ?></p>
								<p><?php echo esc_attr( __( "Don't ever miss an opportunity to opt in for Email Notifications / Announcements about exciting New Features and Update Releases.", 'google-maps-bank' ) ); ?></p>
								<p><?php echo esc_attr( __( 'Contribute in helping us making our plugin compatible with most plugins and themes by allowing to share non-sensitive information about your website.', 'google-maps-bank' ) ); ?></p>
								<p><?php echo esc_attr( __( 'If you opt in, some data about your usage of Google Maps Bank Plugin will be sent to our servers for Compatiblity Testing Purposes and email notifications.', 'google-maps-bank' ) ); ?></p>
							</div>
						</div>
						<div class="row row-custom">
							<div class="col-md-12">
								<div style="padding-left: 40px;">
									<label style="font-size:16px;" class="control-label">
										<?php echo esc_attr( __( 'Email Address for Notifications', 'google-maps-bank' ) ); ?> :
									</label>
									<span id="ux_txt_validation_gdpr_google_maps_bank" style="display:none;vertical-align:middle;">*</span>
									<input type="text" style="width: 90%;" class="form-control" name="ux_txt_email_address_notifications" id="ux_txt_email_address_notifications" value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>">
								</div>
								<div class="textalign">
									<p><?php echo esc_attr( __( "If you're not ready to Opt-In, that's ok too!", 'google-maps-bank' ) ); ?></p>
									<p><strong><?php echo esc_attr( __( 'Google Maps Bank will still work fine.', 'google-maps-bank' ) ); ?></strong></p>
								</div>
							</div>
							<div class="col-md-12">
								<a class="permissions" onclick="show_hide_details_google_maps();"><?php echo esc_attr( __( 'What permissions are being granted? ', 'google-maps-bank' ) ); ?></a>
							</div>
							<div class="col-md-12" style="display:none;" id="ux_div_wizard_set_up">
								<div class="col-md-6">
									<ul>
										<li>
											<i class="dashicons dashicons-admin-users gm-dashicons-admin-users"></i>
											<div class="admin">
												<span><strong><?php echo esc_attr( __( 'User Details', 'google-maps-bank' ) ); ?></strong></span>
												<p><?php echo esc_attr( __( 'Name and Email Address', 'google-maps-bank' ) ); ?></p>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-md-6 align align2">
									<ul>
										<li>
											<i class="dashicons dashicons-admin-plugins gm-dashicons-admin-plugins"></i>
											<div class="admin-plugins">
												<span><strong><?php echo esc_attr( __( 'Current Plugin Status ', 'google-maps-bank' ) ); ?></strong></span>
												<p><?php echo esc_attr( __( 'Activation, Deactivation and Uninstall ', 'google-maps-bank' ) ); ?></p>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<ul>
										<li>
											<i class="dashicons dashicons-testimonial gm-dashicons-testimonial"></i>
											<div class="testimonial">
												<span><strong><?php echo esc_attr( __( 'Notifications ', 'google-maps-bank' ) ); ?></strong></span>
												<p><?php echo esc_attr( __( 'Updates &amp; Announcements ', 'google-maps-bank' ) ); ?></p>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-md-6 align2">
									<ul>
										<li>
											<i class="dashicons dashicons-welcome-view-site gm-dashicons-welcome-view-site"></i>
											<div class="settings">
												<span><strong><?php echo esc_attr( __( 'Website Overview ', 'google-maps-bank' ) ); ?></strong></span>
												<p><?php echo esc_attr( __( 'Site URL, WP Version, PHP Info, Plugins &amp; Themes Info ', 'google-maps-bank' ) ); ?></p>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-12 allow">
								<div class="tech-banker-actions">
									<a onclick="plugin_stats_google_maps('opt_in');" class="button button-primary-wizard">
										<strong><?php echo esc_attr( __( 'Opt-In &amp; Continue', 'google-maps-bank' ) ); ?> </strong>
										<i class="dashicons dashicons-arrow-right-alt gm-dashicons-arrow-right-alt"></i>
									</a>
									<a onclick="plugin_stats_google_maps('skip');" class="button button-secondary-wizard" tabindex="2">
										<strong><?php echo esc_attr( __( 'Skip &amp; Continue', 'google-maps-bank' ) ); ?></strong>
										<i class="dashicons dashicons-arrow-right-alt gm-dashicons-arrow-right-alt"></i>
									</a>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="col-md-12 terms">
								<a href="<?php echo esc_attr( TECH_BANKER_SITE_URL ); ?>privacy-policy/" target="_blank"><?php echo esc_attr( __( 'Privacy Policy', 'google-maps-bank' ) ); ?></a>
								<span> - </span>
								<a href="<?php echo esc_attr( TECH_BANKER_SITE_URL ); ?>terms-conditions/" target="_blank"><?php echo esc_attr( __( 'Terms &amp; Conditions', 'google-maps-bank' ) ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</body>
		</html>
	<?php
	}
}
