<?php

namespace Sienna\Modules\Shortcodes\ZoomingSlider;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ZoomingSlider
 * @package Sienna\Modules\Shortcodes\ZoomingSlider
 */
class ZoomingSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * ZoomingSlider constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_zooming_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                    => 'Zooming Slider',
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkdf_zooming_slider_item'),
			'content_element'         => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-zooming-slider extended-custom-icon',
			'js_view'                 => 'VcColumnView',
			'params'                  => array()
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_attrs = array();
		$params        = shortcode_atts($default_attrs, $atts);

		$params['content'] = $content;

		return sienna_mikado_get_shortcode_module_template_part('templates/zooming-slider-holder', 'zooming-slider', '', $params);
	}
}