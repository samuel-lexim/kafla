<?php

if(!function_exists('sienna_mikado_link_post_format_meta_box_map')) {
	/**
	 * Link post format meta box map
	 */
	function sienna_mikado_link_post_format_meta_box_map() {
	    $link_post_format_meta_box = sienna_mikado_add_meta_box(
		    array(
			    'scope' => array('post'),
			    'title' => 'Link Post Format',
			    'name'  => 'post_format_link_meta'
		    )
	    );

	    sienna_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_post_link_link_meta',
			    'type'        => 'text',
			    'label'       => 'Link',
			    'description' => 'Enter link',
			    'parent'      => $link_post_format_meta_box,

		    )
	    );
    }

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_link_post_format_meta_box_map');
}

