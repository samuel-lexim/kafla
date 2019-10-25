<?php

namespace Sienna\Modules\Shortcodes\ZoomingSlider;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class ZoomingSliderItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_zooming_slider_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Zooming Slider Item',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-zooming-slider-item extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_zooming_slider'),
			'params'                    => array(
				array(
					'type'        => 'attach_image',
					'heading'     => 'Image',
					'param_name'  => 'image',
					'description' => 'Choose image from media library',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Link',
					'param_name'  => 'link',
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Link Target',
					'param_name'  => 'link_target',
					'admin_label' => true,
					'value'       => array(
						'Same Window' => '_self',
						'New Window'  => '_blank'
					),
					'dependency'  => array('element' => 'link', 'not_empty' => true)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'image'       => '',
			'link'        => '',
			'link_target' => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		return sienna_mikado_get_shortcode_module_template_part('templates/zooming-slider-item-template', 'zooming-slider', '', $params);
	}
}