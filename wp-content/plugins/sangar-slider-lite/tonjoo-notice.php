<?php
/**
 * Rating notice
 *
 * @package Sangar Slider
 */

/**
 * Enqueue notice script & style
 */
function sslider_notice_admin_enqueue() {
	wp_enqueue_style( 'sslider-notice-css', plugin_dir_url( __FILE__ ) . 'assets/notice/notice.css', array(), SANGAR_SLIDER_VERSION );
}
add_action( 'admin_enqueue_scripts', 'sslider_notice_admin_enqueue' );

/**
 * Notice action
 */
function sslider_notice_action() {
	if ( ! isset( $_GET['sslider_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['sslider_nonce'] ), 'notice_action' ) ) { // input var ok.
		return;
	} else {
		$action = isset( $_GET['sslider_notice_action'] ) ? sanitize_key( $_GET['sslider_notice_action'] ) : ''; // input var ok.
	}

	if ( 'ok' === $action ) {
		update_option( 'sslider_ignore_notice', true );
		wp_redirect( 'https://wordpress.org/support/plugin/sangar-slider-lite/reviews/#new-post' );
		exit();
	} elseif ( 'later' === $action ) {
		update_option( 'sslider_later_date', date( 'Y-m-d H:i:s' ) );
		$location = admin_url( 'admin.php?page=sangar_slider_admin' ) . '&settings-updated=true';
		wp_safe_redirect( $location );
		exit();
	} elseif ( 'done' === $action ) {
		update_option( 'sslider_ignore_notice', true );
		$location = admin_url( 'admin.php?page=sangar_slider_admin' ) . '&settings-updated=true';
		wp_safe_redirect( $location );
		exit();
	}
}
add_action( 'admin_init', 'sslider_notice_action' );

/**
 * Display notice
 */
function sslider_rating_notice() {
	$ignore_notice = get_option( 'sslider_ignore_notice' );

	if ( $ignore_notice ) {
		return;
	}

	$sslider_start_date = get_option( 'sslider_start_date' );
	$sslider_later_date = get_option( 'sslider_later_date' );
	$now                = date( 'Y-m-d H:i:s' );

	if ( ! $sslider_start_date ) {
		add_option( 'sslider_start_date', $now );
		return;
	}

	$time        = WEEK_IN_SECONDS;
	$check_date  = $sslider_start_date;
	$week_number = 1;

	if ( $sslider_later_date ) {
		$check_date  = $sslider_later_date;
		$diff        = strtotime( $now ) - strtotime( $sslider_start_date );
		$week_number = floor( $diff / WEEK_IN_SECONDS );
		if ( empty( $week_number ) ) {
			$week_number = 1;
		}
	}

	/* Translators: %s: Number of weeks */
	$week_text = sprintf( _n( '%s week', '%s weeks', $week_number, 'sangar-slider' ), $week_number );

	if ( strtotime( $now ) - strtotime( $check_date ) < $time ) {
		return;
	}

	$ok_url    = wp_nonce_url( admin_url( 'admin.php?page=sangar_slider_admin&sslider_notice_action=ok' ), 'notice_action', 'sslider_nonce' );
	$later_url = wp_nonce_url( admin_url( 'admin.php?page=sangar_slider_admin&sslider_notice_action=later' ), 'notice_action', 'sslider_nonce' );
	$done_url  = wp_nonce_url( admin_url( 'admin.php?page=sangar_slider_admin&sslider_notice_action=done' ), 'notice_action', 'sslider_nonce' );
	?>

	<div class="tonjoo-notice updated">
		<div class="tonjoo-notice-img">
			<img src="<?php echo esc_url( SANGAR_SLIDER_DIR_URL ); ?>/assets/notice/sslider_logo.png">
			<img src="<?php echo esc_url( SANGAR_SLIDER_DIR_URL ); ?>/assets/notice/stars.png">
		</div>

		<p>
			<?php
			/* Translators: %s: Number of weeks */
			printf( esc_html__( "Hey, we noticed you've been using Sangar Slider for %s - that's awesome!", 'sangar-slider' ), $week_text );
			?>
			<br>
			<?php esc_html_e( 'Could you please do us a BIG favor and give it 5-star rating on WordPress? Just to help us spread the word and boost our motivation.', 'sangar-slider' ); ?>
		</p>

		<p>
			<a class="button-primary" href="<?php echo esc_url( $ok_url ); ?>"><?php esc_html_e( 'Ok, you deserve it', 'sangar-slider' ); ?></a>

			<a class="button" href="<?php echo esc_url( $later_url ); ?>"><?php esc_html_e( 'Nope, maybe later', 'sangar-slider' ); ?></a>

			<a class="button" href="<?php echo esc_url( $done_url ); ?>"><?php esc_html_e( 'I already did', 'sangar-slider' ); ?></a>
		</p>
	</div>

	<?php
}
add_action( 'admin_notices', 'sslider_rating_notice' );
