<?php

namespace Sienna\Modules\Shortcodes\TeamSlider;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class TeamSlider implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_team_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'         => 'Team Slider',
			'base'         => $this->base,
			'category'     => 'by MIKADO',
			'icon'         => 'icon-wpb-zooming-slider extended-custom-icon',
			'is_container' => true,
			'js_view'      => 'VcColumnView',
			'as_parent'    => array('only' => 'mkdf_team'),
			'params'       => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Description',
					'param_name'  => 'description',
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'       => 'title',
			'description' => 'description'
		);

		$params = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;

		return sienna_mikado_get_shortcode_module_template_part('templates/team-slider-template', 'team-slider', '', $params);
	}
}