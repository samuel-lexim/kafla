<?php
namespace Sienna\Modules\IconListItem;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */
class IconListItem implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_icon_list_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */

	public function vcMap() {
		vc_map(array(
			'name'     => 'Icon List Item',
			'base'     => $this->base,
			'icon'     => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => 'by MIKADO',
			'params'   => array_merge(
				\SiennaMikadoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => 'Icon Size (px)',
						'param_name'  => 'icon_size',
						'description' => ''
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Icon Color',
						'param_name'  => 'icon_color',
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Title',
						'param_name'  => 'title',
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Title size (px)',
						'param_name'  => 'title_size',
						'description' => '',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Title Color',
						'param_name'  => 'title_color',
						'description' => '',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Title Font Weight',
						'param_name'  => 'title_font_weight',
						'value'       => array_flip(sienna_mikado_get_font_weight_array(true)),
						'description' => '',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Title Font Family',
						'param_name'  => 'title_font_family',
						'value'       => array(
							'Default'              => 'default-font-family',
							'Headings Font Family' => 'headings-font-family'
						),
						'save_always' => true,
						'description' => '',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Spacing between Title and Icon (px)',
						'param_name'  => 'space_title_and_icon',
						'description' => '',
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Margin Bottom (px)',
						'param_name'  => 'margin_bottom',
						'description' => '',
						'save_always' => true
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'icon_size'            => '',
			'icon_color'           => '',
			'title'                => '',
			'title_color'          => '',
			'title_size'           => '',
			'title_font_weight'    => '',
			'title_font_family'    => 'headings-font-family',
			'space_title_and_icon' => '',
			'margin_bottom'        => ''
		);

		$args = array_merge($args, sienna_mikado_icon_collections()->getShortcodeParams());

		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);
		$iconPackName = sienna_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses  = '';

		//generate icon holder classes
		$iconClasses .= 'mkdf-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];

		$params['icon_classes']             = $iconClasses;
		$params['icon']                     = $params[$iconPackName];
		$params['icon_attributes']['style'] = $this->getIconStyle($params);
		$params['title_style']              = $this->getTitleStyle($params);

		$params['holder_classes'] = array('mkdf-icon-list-item');
		$params['holder_styles']  = array();

		if($params['margin_bottom'] !== '') {
			$params['holder_styles'][] = 'margin-bottom: '.sienna_mikado_filter_px($params['margin_bottom']).'px';
		}

		if($params['title_font_family'] !== '') {
			$params['holder_classes'][] = 'mkdf-icon-list-item-'.$params['title_font_family'];
		}

		//Get HTML from template
		$html = sienna_mikado_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);

		return $html;
	}

	/**
	 * Generates icon styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconStyle($params) {

		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:'.$params['icon_color'];
		}

		if(!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:'.sienna_mikado_filter_px($params['icon_size']).'px';
		}

		return implode(';', $iconStylesArray);
	}

	/**
	 * Generates title styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyle($params) {
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:'.$params['title_color'];
		}

		if(!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:'.sienna_mikado_filter_px($params['title_size']).'px';
		}

		if(!empty($params['title_font_weight'])) {
			$titleStylesArray[] = 'font-weight: '.$params['title_font_weight'];
		}

		if(!empty($params['space_title_and_icon'])) {
			$titleStylesArray[] = 'padding-left: '.sienna_mikado_filter_px($params['space_title_and_icon']).'px';
		}

		return implode(';', $titleStylesArray);
	}

}