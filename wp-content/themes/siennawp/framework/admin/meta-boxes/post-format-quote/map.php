<?php

if(!function_exists('sienna_mikado_quote_post_format_meta_box_map')) {
	/**
	 * Quote post format meta box map
	 */
	function sienna_mikado_quote_post_format_meta_box_map() {
		$quote_post_format_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => 'Quote Post Format',
				'name'  => 'post_format_quote_meta'
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => 'Quote Text',
				'description' => 'Enter Quote text',
				'parent'      => $quote_post_format_meta_box,

			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_quote_post_format_meta_box_map');
}
