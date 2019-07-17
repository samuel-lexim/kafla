<?php

namespace Sienna\Modules\Shortcodes\HorizontalTimeline;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class HorizontalTimelineItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_horizontal_timeline_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Horizontal Timeline Item',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-horizontal-timeline-item extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_horizontal_timeline'),
			'params'                    => array(
				array(
					'type'        => 'attach_image',
					'heading'     => 'Image',
					'param_name'  => 'image',
					'value'       => '',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Date',
					'param_name'  => 'date',
					'value'       => '',
					'admin_label' => true,
					'description' => 'Enter date in dd-mm-yyyy format'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'value'       => '',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Subtitle',
					'param_name'  => 'subtitle',
					'value'       => '',
					'admin_label' => true
				),
				array(
					'type'        => 'textarea_html',
					'heading'     => 'Description',
					'param_name'  => 'content',
					'value'       => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'    => '',
			'subtitle' => '',
			'image'    => '',
			'date'     => ''
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;

		$date = new \DateTime($params['date']);

		$params['date'] = $date->format('d/m/Y');

		return sienna_mikado_get_shortcode_module_template_part('templates/horizontal-timeline-item', 'horizontal-timeline', '', $params);
	}
}