<div class="preset-upgrade-to-pro">
	<div>
		<img src="<?php echo SANGAR_SLIDER_DIR_URL; ?>sangar-core/assets/about/banner_logo.png" alt="">
		<p>Upgrade to Sangar Slider PRO and unlock all of these 12 predefined presets</p>
	</div>

	<div>
		<a href="https://tonjoostudio.com/product/sangar-slider-responsive-wordpress-slider-plugin/?utm_source=wp_dashboard&utm_medium=setting_preset&utm_campaign=upsell" class="btn">Upgrade to Unlock</a>
	</div>
</div>

<div class="sidebar-content widgets-sortables clearfix sslider-preset-container">
	<?php
	$preset_path = plugin_dir_path( __FILE__ ) . 'presets/';
	$preset_url  = plugin_dir_url( __FILE__ ) . 'presets/';

	$args['1_1'] = array(
		'cover'   => $preset_url . '1_1/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-1/',
	);
	$args['1_2'] = array(
		'cover'   => $preset_url . '1_2/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-2/',
	);
	$args['1_3'] = array(
		'cover'   => $preset_url . '1_3/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-3/',
	);
	$args['1_4'] = array(
		'cover'   => $preset_url . '1_4/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-4/',
	);
	$args['2_1'] = array(
		'cover'   => $preset_url . '2_1/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-5/',
	);
	$args['2_2'] = array(
		'cover'   => $preset_url . '2_2/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-6/',
	);
	$args['2_3'] = array(
		'cover'   => $preset_url . '2_3/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-7/',
	);
	$args['3_1'] = array(
		'cover'   => $preset_url . '3_1/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-8/',
	);
	$args['3_2'] = array(
		'cover'   => $preset_url . '3_2/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-9/',
	);
	$args['3_3'] = array(
		'cover'   => $preset_url . '3_3/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-10/',
	);
	$args['4_1'] = array(
		'cover'   => $preset_url . '4_1/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-11/',
	);
	$args['4_2'] = array(
		'cover'   => $preset_url . '4_2/cover.jpg',
		'preview' => 'http://sangarslider.com/preset/preset-12/',
	);

	$images_url = SANGAR_SLIDER_DIR_URL . 'images';
	foreach ( $args as $key => $value ) {
		echo <<<EOT
<div class="sslider-preset-items pro">
	<img src="{$value['cover']}" class="cover">
	<img src="{$images_url}/lock.png" alt="" class="lock">
	<a href="{$value['preview']}"><span>PREVIEW</span></a>
</div>
EOT;
	}
	?>
</div>
