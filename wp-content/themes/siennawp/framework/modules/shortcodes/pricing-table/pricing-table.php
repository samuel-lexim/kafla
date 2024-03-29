<?php
namespace Sienna\Modules\PricingTable;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Pricing Table',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_pricing_tables'),
			'params'                    => array_merge(
				\SiennaMikadoIconCollections::get_instance()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Title',
						'param_name'  => 'title',
						'value'       => 'Basic Plan',
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Title Size (px)',
						'param_name'  => 'title_size',
						'value'       => '',
						'description' => '',
						'dependency'  => array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Subtitle',
						'param_name'  => 'subtitle',
						'value'       => '',
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Price',
						'param_name'  => 'price'
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Currency',
						'param_name'  => 'currency'
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Price Period',
						'param_name'  => 'price_period',
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Label',
						'param_name'  => 'label',
						'save_always' => ''
					),
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading'     => 'Show Button',
						'param_name'  => 'show_button',
						'value'       => array(
							'Default' => '',
							'Yes'     => 'yes',
							'No'      => 'no'
						),
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Button Text',
						'param_name'  => 'button_text',
						'dependency'  => array('element' => 'show_button', 'value' => 'yes')
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Button Link',
						'param_name'  => 'link',
						'dependency'  => array('element' => 'show_button', 'value' => 'yes')
					),
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading'     => 'Active',
						'param_name'  => 'active',
						'value'       => array(
							'No'  => 'no',
							'Yes' => 'yes'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => 'Content',
						'param_name'  => 'content',
						'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
						'description' => ''
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {

		$default_atts = array(
			'title'        => 'Basic Plan',
			'title_size'   => '',
			'subtitle'     => '',
			'price'        => '',
			'currency'     => '',
			'price_period' => '',
			'label'        => '',
			'active'       => 'no',
			'show_button'  => 'yes',
			'link'         => '',
			'button_text'  => 'button'
		);
		$default_atts = array_merge($default_atts, sienna_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$iconPackName = sienna_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $iconPackName ? $params[$iconPackName] : '';

		extract($params);

		$html                  = '';
		$pricing_table_clasess = 'mkdf-price-table';

		if($active == 'yes') {
			$pricing_table_clasess .= ' mkdf-pt-active';
		}

		if(!empty($params['icon'])) {
			$params['icon'] = $params[$iconPackName];
		}

		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content']               = $content;
		$params['button_params']         = $this->getButtonParams($params);

		$params['title_styles'] = array();

		if(!empty($params['title_size'])) {
			$params['title_styles'][] = 'font-size: '.sienna_mikado_filter_px($params['title_size']).'px';
		}

		$html .= sienna_mikado_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

		return $html;

	}

	private function getButtonParams($params) {
		$buttonParams = array();

		if($params['show_button'] === 'yes' && $params['button_text'] !== '') {
			$buttonParams = array(
				'link' => $params['link'],
				'text' => $params['button_text'],
				'size' => 'medium'
			);

			$buttonParams['type']       = $params['active'] === 'yes' ? 'white' : 'solid';
			$buttonParams['hover_type'] = $params['active'] === 'yes' ? 'white' : 'black';
		}

		return $buttonParams;
	}

}
