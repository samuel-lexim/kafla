<?php

add_shortcode( 'sangar-slider', 'sangar_slider_shortcode' );
function sangar_slider_shortcode( $attr ) {
	$id              = $attr['id'];
	$post_type       = get_post_type( $id );
	$args['preview'] = isset( $attr['preview'] ) ? true : false;

	// data
	$data = get_post_meta( $id, 'sslider_data', true );
	$data = unserialize( base64_decode( $data ) );

	// config
	$config = get_post_meta( $id, 'sslider_config', true );
	$config = unserialize( base64_decode( $config ) );

	// shortcode template
	if ( isset( $attr['template'] ) ) {
		$config['template'] = $attr['template'];
	}

	// shortcode theme
	if ( isset( $attr['theme'] ) ) {
		$theme_url = plugin_dir_path( __FILE__ ) . "elements/themes/{$attr['theme']}.css";

		if ( file_exists( $theme_url ) ) {
			$textfile             = file_get_contents( $theme_url, FILE_USE_INCLUDE_PATH );
			$config['custom_css'] = $textfile;
		}
	}

	ob_start();
	sangar_slider_print( $id, $data, $config, $args );
	$slider = ob_get_clean();

	return $slider;
}

function sangar_slider_print( $id, $data, $config, $args ) {
	$post_type = get_post_type( $id );
	$config    = ssliderDefault::config( $config, $post_type );

	// return false means the current slider addon is not exist
	if ( ! $config ) {
		return;
	}
	if ( empty( $config['template'] ) ) {
		return;
	}

	$templates = apply_filters( 'sangar_slider_templates', array() );
	$template  = $templates[ $config['template'] ];

	// override config
	if ( ! empty( $template['config'] ) ) {
		$config = array_replace( $config, $template['config'] );
	}

	// if hideTextbox
	if ( ! empty( $template['hideTextbox'] ) ) {
		$args['hideTextbox'] = true;
	}

	// printing slide or custom template
	if ( ! empty( $template['location'] ) ) {
		include $template['location'];
	} else {
		$sslider_addons = apply_filters( 'sangar_slider_addons', array() );
		$class          = $sslider_addons[ $post_type ]['class-name'];

		// load class slider
		$slider = new $class( $id, $data, $config, $args, $post_type );

		echo $slider->css();
		echo $slider->html();
		echo $slider->javascript();

	}
}
