<?php
namespace Sienna\Modules\VideoButton;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class VideoButton
 */
class VideoButton implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkdf_video_button';

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
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => 'Video Button',
			'base'                      => $this->getBase(),
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-video-button extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					"type"       => "textfield",
					"heading"    => "Video Link",
					"param_name" => "video_link",
					"value"      => ""
				),
				array(
					"type"       => "textfield",
					"heading"    => "Play Button Size (px)",
					"param_name" => "button_size",
					"value"      => "",
					"dependency" => array('element' => 'video_link', 'not_empty' => true),
				),
				array(
					"type"       => "textfield",
					"heading"    => "Title",
					"param_name" => "title",
					"value"      => "",
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Alignment',
					'param_name'  => 'alignment',
					'value'       => array(
						'Left'   => 'left',
						'Right'  => 'right',
						'Center' => 'center'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => 'Video Button Style',
					'param_name'  => 'title_style',
					'value'       => array(
						'Dark'  => 'dark',
						'Light' => 'light'
					),
					'description' => '',
					'save_always' => true
				),
				array(
					"type"       => "dropdown",
					"heading"    => "Title Tag",
					"param_name" => "title_tag",
					"value"      => array(
						"h1" => "h1",
						"h2" => "h2",
						"h3" => "h3",
						"h4" => "h4",
						"h5" => "h5",
						"h6" => "h6",
					),
					"dependency" => array('element' => 'title', 'not_empty' => true),
				),
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'video_link'  => '#',
			'button_size' => '',
			'title'       => '',
			'alignment'   => '',
			'title_style' => 'dark',
			'title_tag'   => 'h1',
		);

		$params = shortcode_atts($args, $atts);

		$title_class = '';

		if($params['title_style'] === 'light') {
			$title_class .= 'mkdf-light ';
		}

		$title_class .= $params['alignment'];

		$params['button_light'] = $title_class;

		$params['button_style']    = $this->getButtonStyle($params);
		$params['video_title_tag'] = $this->getVideoButtonTitleTag($params, $args);

		//Get HTML from template
		$html = sienna_mikado_get_shortcode_module_template_part('templates/video-button-template', 'videobutton', '', $params);

		return $html;

	}

	/**
	 * Return Style for Button
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getButtonStyle($params) {
		$button_style = array();

		if($params['button_size'] !== '') {
			$button_size    = strstr($params['button_size'], 'px') ? $params['button_size'] : $params['button_size'].'px';
			$button_style[] = 'width: '.$button_size;
			$button_style[] = 'height: '.$button_size;
			$button_style[] = 'font-size: '.sienna_mikado_filter_px($button_size).'px';
		}

		return implode(';', $button_style);
	}

	/**
	 * Return Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getVideoButtonTitleTag($params, $args) {
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}
}