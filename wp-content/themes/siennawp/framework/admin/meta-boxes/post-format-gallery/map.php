<?php

if(!function_exists('sienna_mikado_gallery_post_format_meta_box_map')) {
	/**
	 * Gallery meta box post format map
	 */
	function sienna_mikado_gallery_post_format_meta_box_map() {
		$gallery_post_format_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Gallery Post Format',
				'name'  => 'post_format_gallery_meta'
			)
		);

		sienna_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => 'Gallery Images',
				'description' => 'Choose your gallery images',
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_gallery_post_format_meta_box_map');
}
