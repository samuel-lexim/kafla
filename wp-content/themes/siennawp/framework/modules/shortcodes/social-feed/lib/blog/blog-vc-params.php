<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderVCParamsInterface;

class BlogVCParams implements ProviderVCParamsInterface {

	public function getVCParams() {
		return array(
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => 'Number of Posts',
				'param_name'  => 'posts_per_page',
				'description' => '',
				'group'       => 'Blog',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => 'Order By',
				'param_name'  => 'orderby',
				'value'       => array(
					'Date'  => 'date',
					'Title' => 'title'
				),
				'save_always' => true,
				'description' => '',
				'group'       => 'Blog',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => 'Order',
				'param_name'  => 'order',
				'value'       => array(
					'DESC' => 'DESC',
					'ASC'  => 'ASC'
				),
				'save_always' => true,
				'description' => '',
				'group'       => 'Blog',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => 'Category Slug',
				'param_name'  => 'category_name',
				'description' => 'Leave empty for all or use comma for list',
				'group'       => 'Blog',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => 'Excerpt Length',
				'param_name'  => 'excerpt_length',
				'description' => '',
				'group'       => 'Blog',
				'admin_label' => true,
			    'description' => 'Enter number of words for post\'s excerpt'
			)
		);
	}

	public function getShortcodeParams() {
		return array(
			'posts_per_page' => '',
			'orderby'        => 'ASC',
			'order'          => '-1',
			'category_name'  => '',
			'excerpt_length' => ''
		);
	}
}