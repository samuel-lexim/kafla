<?php

if(!function_exists('sienna_mikado_blog_meta_box_map')) {
	/**
	 * Blog meta box map
	 */
	function sienna_mikado_blog_meta_box_map() {
		$mkd_blog_categories = array();
		$categories           = get_categories();

		foreach($categories as $category) {
			$mkd_blog_categories[$category->term_id] = $category->name;
		}

		$blog_meta_box = sienna_mikado_add_meta_box(
			array(
				'scope' => array('page'),
				'title' => 'Blog',
				'name'  => 'blog_meta'
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => 'Blog Category',
				'description' => 'Choose category of posts to display (leave empty to display all categories)',
				'parent'      => $blog_meta_box,
				'options'     => $mkd_blog_categories
			)
		);

		sienna_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => 'Number of Posts',
				'description' => 'Enter the number of posts to display',
				'parent'      => $blog_meta_box,
				'options'     => $mkd_blog_categories,
				'args'        => array("col_width" => 3)
			)
		);
	}

	add_action('sienna_mikado_meta_boxes_map', 'sienna_mikado_blog_meta_box_map');
}