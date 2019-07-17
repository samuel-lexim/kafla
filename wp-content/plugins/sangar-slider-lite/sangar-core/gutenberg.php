<?php
/**
 * Gutenberg functions
 *
 * @package Sangar Slider
 */

/**
 * Enqueue the block's assets for the editor.
 */
function sslider_sangar_editor_assets() {
	wp_enqueue_style( 'sslider-sangar', SANGAR_CORE_DIR_URL . 'assets/block.css' );
	wp_register_script(
		'sslider-sangar',
		SANGAR_CORE_DIR_URL . 'assets/block.js',
		array( 'wp-blocks', 'wp-element' )
	);

	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	$arr_data = array();
	foreach ( $sslider_addons as $key => $value ) {
		$args = array(
			'post_type'      => $key,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$the_query    = new WP_Query( $args );
		$total_number = $the_query->found_posts;

		if ( $total_number > 0 ) {
			$posts = $the_query->posts;

			foreach ( $posts as $post ) {
				$arr_data[ $post->ID ] = '' === $post->post_title ? '(no title)' : $post->post_title;
			}

			wp_reset_postdata();
		}
	}

	$data = array(
		'slider' => $arr_data,
	);
	wp_localize_script( 'sslider-sangar', 'sangar', $data );
	wp_enqueue_script( 'sslider-sangar' );
}
add_action( 'enqueue_block_editor_assets', 'sslider_sangar_editor_assets' );
