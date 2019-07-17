<?php

/*** Audio Post Format ***/

if(!function_exists('sienna_mikado_audio_post_format_meta_box_map')) {
	/**
	 * Audio post format meta box map
	 */
	function sienna_mikado_audio_post_format_meta_box_map() {
	    $audio_post_format_meta_box = sienna_mikado_add_meta_box(
		    array(
			    'scope' => array('post'),
			    'title' => 'Audio Post Format',
			    'name'  => 'post_format_audio_meta'
		    )
	    );

	    sienna_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_post_audio_link_meta',
			    'type'        => 'text',
			    'label'       => 'Link',
			    'description' => 'Enter audion link',
			    'parent'      => $audio_post_format_meta_box,

		    )
	    );
    }

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_audio_post_format_meta_box_map');
}
