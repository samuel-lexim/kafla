<?php

namespace Sienna\Modules\Shortcodes\HorizontalTimeline;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class HorizontalTimeline implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_horizontal_timeline';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Horizontal Timeline',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-horizontal-timeline extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'as_parent'                 => array('only' => 'mkdf_horizontal_timeline_item'),
			'js_view'                   => 'VcColumnView',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => 'Timeline displays?',
					'param_name'  => 'timeline_format',
					'value'       => array(
						'Only Years'             => 'Y',
						'Years and Months'       => 'M Y',
						'Years, Months and Days' => 'M d, \'y',
						'Months and Days'        => 'M d'
					),
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Minimal Distance Between Dates?',
					'param_name'  => 'distance',
					'value'       => '',
					'description' => 'Default value is 60',
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'timeline_format' => 'Y',
			'distance'        => '60'
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;

		$params['dates'] = $this->getDates($content);

		return sienna_mikado_get_shortcode_module_template_part('templates/horizontal-timeline-template', 'horizontal-timeline', '', $params);
	}

	private function getDates($content) {
		$datesArray = '';

		preg_match_all('/date="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

		if(isset($matches[0])) {
			$dates = $matches[0];

			if(is_array($dates) && count($dates)) {
				foreach($dates as $date) {
					preg_match('/date="([^\"]+)"/i', $date[0], $dateMatches, PREG_OFFSET_CAPTURE);
					$date = new \DateTime($dateMatches[1][0]);

					$currentDate = array(
						'formatted' => $date->format('d/m/Y'),
						'timestamp' => $date->getTimestamp()
					);

					$datesArray[] = $currentDate;
				}
			}
		}

		return $datesArray;
	}
}