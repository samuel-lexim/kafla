<?php
$error_text = sienna_mikado_options()->getOptionValue('404_text');

if(empty($error_text)) {
	$error_text = esc_html__('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'sienna');
}

$error_title = sienna_mikado_options()->getOptionValue('404_title');

if(empty($error_title)) {
	$error_title = esc_html__('Page you are looking for is not found', 'sienna');
}

$button_text = sienna_mikado_options()->getOptionValue('404_back_to_home');

if(empty($button_text)) {
	$button_text = esc_html__('Go Back', 'sienna');
}

$button_params = array(
	'link' => home_url('/'),
	'text' => $button_text
);

?>
<?php get_header(); ?>

	<?php sienna_mikado_get_title(); ?>

	<div class="mkdf-container">
	<?php do_action('sienna_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner mkdf-404-page">
			<div class="mkdf-page-not-found">
				<div class="mkdf-404-image">
					<img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/404.png') ?>" alt="<?php esc_attr_e('404', 'sienna'); ?>" />
				</div>
				<h1><?php echo esc_html($error_title); ?></h1>
				<div class="mkdf-section-subtitle-holder mkdf-section-subtitle-center">
					<p class="mkdf-section-subtitle"><?php echo esc_html($error_text); ?></p>
				</div>
				<?php echo sienna_mikado_execute_shortcode('mkdf_button',$button_params); ?>
			</div>
		</div>
		<?php do_action('sienna_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>