<?php
namespace Sienna\Modules\Header\Types;

use Sienna\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType1
 */
class HeaderType1 extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-type1';

		if(!is_admin()) {
			$logoAreaHeight       = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('logo_area_height_header_type1'));
			$this->logoAreaHeight = $logoAreaHeight !== '' ? sienna_mikado_filter_px($logoAreaHeight) : 220;

			$menuAreaHeight       = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('menu_area_height_header_type1'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 60;

			add_action('wp', array($this, 'setHeaderHeightProps'));
		}
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate($parameters = array()) {

		$parameters['logo_area_in_grid'] = sienna_mikado_options()->getOptionValue('logo_area_in_grid_header_type1') == 'yes' ? true : false;
		$parameters['menu_area_in_grid'] = sienna_mikado_options()->getOptionValue('menu_area_in_grid_header_type1') == 'yes' ? true : false;

		$parameters = apply_filters('sienna_mikado_header_type1_parameters', $parameters);

		sienna_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$transparencyHeight = 0;

		if(sienna_mikado_options()->getOptionValue('logo_area_background_color_header_type1') == '') {
			$logoAreaTransparent = sienna_mikado_options()->getOptionValue('logo_area_grid_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('logo_area_grid_background_transparency_header_type1') !== '1';
		} else {
			$logoAreaTransparent = sienna_mikado_options()->getOptionValue('logo_area_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('logo_area_background_transparency_header_type1') !== '1';
		}

		if(sienna_mikado_options()->getOptionValue('menu_area_background_color_header_type1') == '') {
			$menuAreaTransparent = sienna_mikado_options()->getOptionValue('menu_area_grid_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_type1') !== '1';
		} else {
			$menuAreaTransparent = sienna_mikado_options()->getOptionValue('menu_area_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('menu_area_background_transparency_header_type1') !== '1';
		}

		if($logoAreaTransparent || $menuAreaTransparent) {
			if($logoAreaTransparent) {
				$transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

				if(sienna_mikado_is_top_bar_enabled() && sienna_mikado_is_top_bar_transparent()) {
					$transparencyHeight += sienna_mikado_get_top_bar_height();
				}
			}

			if(!$logoAreaTransparent && $menuAreaTransparent) {
				$transparencyHeight = $this->menuAreaHeight;
			}
		}

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$transparencyHeight = 0;

		if(sienna_mikado_options()->getOptionValue('logo_area_background_color_header_type1') == '') {
			$logoAreaTransparent = sienna_mikado_options()->getOptionValue('logo_area_grid_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('logo_area_grid_background_transparency_header_type1') === '0';
		} else {
			$logoAreaTransparent = sienna_mikado_options()->getOptionValue('logo_area_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('logo_area_background_transparency_header_type1') === '0';
		}

		if(sienna_mikado_options()->getOptionValue('menu_area_background_color_header_type1') == '') {
			$menuAreaTransparent = sienna_mikado_options()->getOptionValue('menu_area_grid_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_type1') === '0';
		} else {
			$menuAreaTransparent = sienna_mikado_options()->getOptionValue('menu_area_background_color_header_type1') !== '' &&
			                       sienna_mikado_options()->getOptionValue('menu_area_background_transparency_header_type1') === '0';
		}

		if($logoAreaTransparent || $menuAreaTransparent) {
			if($logoAreaTransparent) {
				$transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

				if(sienna_mikado_is_top_bar_enabled() && sienna_mikado_is_top_bar_completely_transparent()) {
					$transparencyHeight += sienna_mikado_get_top_bar_height();
				}
			}

			if(!$logoAreaTransparent && $menuAreaTransparent) {
				$transparencyHeight = $this->menuAreaHeight;
			}
		}

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;
		if(sienna_mikado_is_top_bar_enabled()) {
			$headerHeight += sienna_mikado_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables($globalVariables) {

		$global_variables['mkdfLogoAreaHeight'] = $this->logoAreaHeight;
		$global_variables['mkdfMenuAreaHeight'] = $this->menuAreaHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables($perPageVars) {
		return $perPageVars;
	}
}