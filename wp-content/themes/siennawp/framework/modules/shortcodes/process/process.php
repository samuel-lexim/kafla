<?php
namespace Sienna\Modules\Shortcodes\Process;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class Process implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
				'name'                      => 'Process',
				'base'                      => $this->base,
				'category'                  => 'by MIKADO',
				'icon'                      => 'icon-wpb-process extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'textfield',
						'heading'     => 'Digit',
						'param_name'  => 'digit',
						'admin_label' => true
					),
					array(
						'type'       => 'textfield',
						'heading'    => 'Title',
						'param_name' => 'title'
					),
					array(
						'type'       => 'textfield',
						'heading'    => 'Text',
						'param_name' => 'text'
					),
				)
			)
		);
	}

	/**
	 * Renders HTML for button shortcode
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'digit'    => '',
			'title'    => '',
			'subtitle' => '',
			'text'     => ''
		);

		$params = shortcode_atts($args, $atts);

		$html = sienna_mikado_get_shortcode_module_template_part('templates/process-template', 'process', '', $params);

		return $html;

	}
}