<?php
add_action( 'add_meta_boxes', 'sslider_add_custom_box' );
function sslider_add_custom_box() {
	global $post_type;

	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	if ( ! array_key_exists( $post_type, $sslider_addons ) ) {
		return;
	}

	$main_meta_title = $post_type == 'sangar_slider' ? 'Slide Management' : 'Slideshow Preview';

	// Core meta-box
	add_meta_box(
		'sslider_slide_core_meta',
		'Modal',
		'sslider_slide_core_meta_callback',
		$post_type,
		'normal',
		'high'
	);

	// Add slide
	add_meta_box(
		'sslider_slide_add',
		'Button',
		'sslider_slide_add_callback',
		$post_type,
		'normal',
		'default'
	);

	// Configuration
	add_meta_box(
		'sslider_configuration',
		'Configuration',
		'sslider_configuration_callback',
		$post_type,
		'side',
		'default'
	);

	// Slide Management
	add_meta_box(
		'sslider_slide_management',
		$main_meta_title,
		'sslider_slide_management_callback',
		$post_type,
		'normal',
		'default'
	);
}

add_action( 'save_post', 'sslider_save_postdata' );
function sslider_save_postdata( $post_id ) {
	// verify if this is an auto save routine
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// verify this came from the our screen and with proper authorization
	// because save_post can be triggered at other times
	$sslider_noncename = isset( $_POST['sslider_noncename'] ) ? $_POST['sslider_noncename'] : '';
	if ( ! wp_verify_nonce( $sslider_noncename, SANGAR_SLIDER ) ) {
		return;
	}

	// Check permissions
	if ( isset( $_POST['post_type'] ) ) {
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
	}

	// update_post_meta($post_id,'sslider_meta_box',$post_meta);
	update_post_meta( $post_id, 'sslider_data', $_POST['sslider_data'] );

	// data slides
	$sslider_slides = get_post_meta( $post_id, 'sslider_slides', true );

	if ( $sslider_slides && ! empty( $sslider_slides ) ) {
		$sslider_slides = unserialize( $sslider_slides );
	} else {
		$sslider_slides = array();
	}

	// add new slide
	if ( isset( $_POST['sslider_slides'] ) && is_array( $_POST['sslider_slides'] ) ) {
		foreach ( $_POST['sslider_slides'] as $key => $value ) {
			$slide_slug = get_slide_slug( $value );

			$sslider_slides[ $slide_slug ] = $_POST['sslider_slides'][ $key ];
		}
	}

	// save slider data
	if ( count( $sslider_slides ) > 0 ) {
		update_post_meta( $post_id, 'sslider_slides', serialize( $sslider_slides ) );
	}

	// save config
	if ( is_array( $_POST['config'] ) && count( $_POST['config'] ) > 0 ) {
		update_post_meta( $post_id, 'sslider_config', base64_encode( serialize( $_POST['config'] ) ) );
	}
}
