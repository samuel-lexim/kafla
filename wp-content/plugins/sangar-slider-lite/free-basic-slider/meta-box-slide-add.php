<?php
/**
 * Prints the box content
 */
function sslider_slide_add_callback( $post ) {
	?>

	<style type="text/css">
		.media-menu.sslider-tabs > .switch {
			height: 15px;
		}

		.media-menu.sslider-tabs > .switch > a {
			display: none !important;
		}
	</style>

	<a href="javascript:;" sslider-add-slide class="button button-primary">Add New Slide</a>
	<a href="javascript:;" sslider-add-youtube-slide class="button">Add Youtube / Vimeo Slide</a>
	<a href="javascript:;" sslider-custom-css class="button">Custom CSS</a>
	<a href="<?php echo esc_url( admin_url( 'admin.php?page=sslider_about_page#opt-upgrade' ) ); ?>" class="button button-primary upgrade-pro">Upgrade to Pro</a>

	<?php
}
