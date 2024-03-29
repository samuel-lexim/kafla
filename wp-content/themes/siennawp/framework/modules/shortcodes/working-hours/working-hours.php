<?php
namespace Sienna\Modules\Shortcodes\WorkingHours;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class WorkingHours implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_working_hours';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Mikado Working Hours',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-working-hours extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Enable Icon',
					'param_name'  => 'icon_title',
					'admin_label' => true,
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Text',
					'param_name'  => 'text',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Working Hours Style',
					'param_name'  => 'style',
					'admin_label' => true,
					'value'       => array(
						'Dark'  => 'dark',
						'Light' => 'light'
					),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Use Shortened Version?',
					'param_name'  => 'use_shortened_version',
					'admin_label' => true,
					'value'       => array(
						'Yes' => 'yes',
						'No'  => 'no'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Monday To Friday',
					'param_name'  => 'monday_to_friday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Weekend',
					'param_name'  => 'weekend',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Monday',
					'param_name'  => 'monday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Tuesday',
					'param_name'  => 'tuesday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Wednesday',
					'param_name'  => 'wednesday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Thursday',
					'param_name'  => 'thursday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Friday',
					'param_name'  => 'friday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Saturday',
					'param_name'  => 'saturday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Sunday',
					'param_name'  => 'sunday',
					'admin_label' => true,
					'value'       => '',
					'save_always' => true,
					'group'       => 'Settings',
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'                 => '',
			'icon_title'            => 'yes',
			'text'                  => '',
			'style'                 => '',
			'use_shortened_version' => '',
			'monday_to_friday'      => '',
			'weekend'               => '',
			'monday'                => '',
			'tuesday'               => '',
			'wednesday'             => '',
			'thursday'              => '',
			'friday'                => '',
			'saturday'              => '',
			'sunday'                => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$icon_class = '';

		if($params['icon_title'] === 'yes') {
			$icon_class .= 'mkdf-icon-title';
		}

		$params['icon_title'] = $icon_class;

		$params['working_hours']  = $this->getWorkingHours($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

		return sienna_mikado_get_shortcode_module_template_part('templates/working-hours-template', 'working-hours', '', $params);
	}

	private function getWorkingHours($params) {
		$workingHours = array();

		if(!empty($params['use_shortened_version']) && $params['use_shortened_version'] === 'yes') {
			if(!empty($params['monday_to_friday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Monday - Friday', 'sienna'),
					'time'  => $params['monday_to_friday']
				);
			}

			if(!empty($params['weekend'])) {
				$workingHours[] = array(
					'label' => esc_html__('Saturday - Sunday', 'sienna'),
					'time'  => $params['weekend']
				);
			}
		} else {
			if(!empty($params['monday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Monday', 'sienna'),
					'time'  => $params['monday']
				);
			}

			if(!empty($params['tuesday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Tuesday', 'sienna'),
					'time'  => $params['tuesday']
				);
			}

			if(!empty($params['wednesday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Wednesday', 'sienna'),
					'time'  => $params['wednesday']
				);
			}

			if(!empty($params['thursday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Thursday', 'sienna'),
					'time'  => $params['thursday']
				);
			}

			if(!empty($params['friday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Friday', 'sienna'),
					'time'  => $params['friday']
				);
			}

			if(!empty($params['saturday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Saturday', 'sienna'),
					'time'  => $params['saturday']
				);
			}

			if(!empty($params['sunday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Sunday', 'sienna'),
					'time'  => $params['sunday']
				);
			}
		}

		return $workingHours;
	}

	private function getHolderClasses($params) {
		$classes = array(
			'mkdf-working-hours-holder',
			'mkdf-working-hours-'.$params['style']
		);

		return $classes;
	}

}
