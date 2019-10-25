<?php

if(!function_exists('sienna_mikado_testimonials_meta_box_map')) {
	/**
	 * Testimonials meta box map
	 */
	function sienna_mikado_testimonials_meta_box_map() {
		$testimonial_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('testimonials'),
				'title' => 'Testimonial',
				'name'  => 'testimonial_meta'
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => 'Title',
				'description' => 'Enter testimonial title',
				'parent'      => $testimonial_meta_box,
			)
		);


		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => 'Author',
				'description' => 'Enter author name',
				'parent'      => $testimonial_meta_box,
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => 'Job Position',
				'description' => 'Enter job position',
				'parent'      => $testimonial_meta_box,
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => 'Text',
				'description' => 'Enter testimonial text',
				'parent'      => $testimonial_meta_box,
			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_testimonials_meta_box_map');
}