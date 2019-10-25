<?php
namespace Sienna\Modules\Shortcodes\InfoCardCarousel;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class InfoCardSliderItem
 * @package Sienna\Modules\Shortcodes\InfoCardSlider
 */
class InfoCardCarouselItem implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * InfoCardSliderItem constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_info_card_carousel_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 */
	public function vcMap() {
		vc_map(array(
			'name'                    => 'Info Card Carousel Item',
			'base'                    => $this->base,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-info-card-slider-item extended-custom-icon',
			'as_parent'               => array('except' => 'vc_row'),
			'as_child'                => array('only' => 'mkdf_info_card_carousel'),
			'is_container'            => true,
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'heading'     => 'Number',
					'param_name'  => 'number',
					'admin_label' => true
				),
				array(
					'type'        => 'attach_image',
					'holder'      => 'div',
					'heading'     => 'Front Side Image',
					'param_name'  => 'front_side_image',
					'admin_label' => true,
					'group'       => 'Front Side'
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'admin_label' => true,
					'group'       => 'Front Side'
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Front Side Content',
					'description' => 'Insert text for card front side',
					'param_name'  => 'front_side_content',
					'admin_label' => true,
					'group'       => 'Front Side'
				),
				array(
					'type'        => 'attach_image',
					'holder'      => 'div',
					'heading'     => 'Back Side Image',
					'param_name'  => 'back_side_image',
					'admin_label' => true,
					'group'       => 'Back Side'
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Back Side Content',
					'description' => 'Insert text for card back side',
					'param_name'  => 'back_side_content',
					'admin_label' => true,
					'group'       => 'Back Side'
				),
				array(
					'type'         => 'textfield',
					'heading'      => 'Link',
					'descripition' => 'Insert card link',
					'param_name'   => 'link',
					'admin_label'  => true,
					'group'        => 'Back Side'
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Link Text',
					'param_name'  => 'link_text',
					'dependency'  => array('element' => 'link', 'not_empty' => true),
					'admin_label' => true,
					'group'       => 'Back Side'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Link Target',
					'param_name'  => 'link_target',
					'value'       => array(
						'Self'  => '_self',
						'Blank' => '_blank'
					),
					'save_always' => true,
					'dependency'  => array('element' => 'link', 'not_empty' => true),
					'admin_label' => true,
					'group'       => 'Back Side'
				)
			)
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return \html
	 */
	public function render($atts, $content = null) {
		$default_atts = array(
			'title'              => '',
			'number'             => '',
			'front_side_image'   => '',
			'front_side_content' => '',
			'back_side_content'  => '',
			'back_side_image'    => '',
			'link'               => '',
			'link_text'          => '',
			'link_target'        => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['button_params'] = $this->getButtonParams($params);
		$params['show_btn']      = count($params['button_params']);

		$params['holder_classes'] = array('mkdf-info-card-carousel-item');

		if(!empty($params['back_side_content'])) {
			$params['holder_classes'][] = 'mkdf-info-card-carousel-item-has-hover';
		}

		return sienna_mikado_get_shortcode_module_template_part('templates/info-card-carousel-item', 'info-card-carousel', '', $params);
	}

	/**
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonParams($params) {
		$btn_params = array();

		if($params['link'] !== '' && $params['link_text'] !== '') {
			$btn_params['link']      = $params['link'];
			$btn_params['text']      = $params['link_text'];
			$btn_params['target']    = $params['link_target'];
			$btn_params['icon_pack'] = 'font_elegant';
			$btn_params['fe_icon']   = 'arrow_right';
			$btn_params['type']      = 'solid';
		}

		return $btn_params;
	}

}