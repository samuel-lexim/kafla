<?php
namespace MikadoCore\CPT\Portfolio\Shortcodes;

use MikadoCore\Lib;
use MikadoCore\CPT\Portfolio\Lib as PortfolioLib;

/**
 * Class PortfolioList
 * @package MikadoCore\CPT\Portfolio\Shortcodes
 */
class PortfolioList implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * PortfolioList constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_portfolio_list';

		add_action('vc_before_init', array($this, 'vcMap'));

		add_action('wp_ajax_nopriv_mkd_core_portfolio_ajax_load_more', array($this, 'loadMorePortfolios'));
		add_action('wp_ajax_mkd_core_portfolio_ajax_load_more', array($this, 'loadMorePortfolios'));
	}


	/**
	 * Loads portfolios via AJAX
	 */
	public function loadMorePortfolios() {
		$shortcodeParams = $this->getShortcodeParamsFromPost();

		$html           = '';
		$portfolioQuery = PortfolioLib\PortfolioQuery::getInstance();
		$queryResults   = $portfolioQuery->buildQueryObject($shortcodeParams);

		if($shortcodeParams['type'] !== 'masonry') {
			$shortcodeParams['thumb_size']            = $this->getImageSize($shortcodeParams);
			$shortcodeParams['use_custom_image_size'] = false;
			if($shortcodeParams['thumb_size'] === 'custom' && !empty($shortcodeParams['custom_image_dimensions'])) {
				$shortcodeParams['use_custom_image_size'] = true;
				$shortcodeParams['custom_image_sizes']    = $this->getCustomImageSize($shortcodeParams['custom_image_dimensions']);
			}
		}

		if($queryResults->have_posts()) {
			while($queryResults->have_posts()) {
				$queryResults->the_post();

				$shortcodeParams['current_id'] = get_the_ID();

				if($shortcodeParams['type'] === 'masonry') {
					$shortcodeParams['thumb_size'] = $this->getImageSize($shortcodeParams);
				}

				$shortcodeParams['icon_html']            = $this->getPortfolioIconsHtml($shortcodeParams);
				$shortcodeParams['category_html']        = $this->getItemCategoriesHtml($shortcodeParams);
				$shortcodeParams['categories']           = $this->getItemCategories($shortcodeParams);
				$shortcodeParams['article_masonry_size'] = $this->getMasonrySize($shortcodeParams);
				$shortcodeParams['item_link']            = $this->getItemLink($shortcodeParams);

				$html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/'.$shortcodeParams['type'], 'portfolio', '', $shortcodeParams);
			}

			wp_reset_postdata();
		} else {
			$html .= '<p>'.__('Sorry, no posts matched your criteria.', 'mkd_core').'</p>';
		}

		$returnObj = array(
			'html' => $html,
		);

		echo json_encode($returnObj);
		exit;
	}

	/**
	 * Prepares shortcode params array from $_POST and returns it
	 *
	 * @return array
	 */
	private function getShortcodeParamsFromPost() {
		$shortcodeParams = array();

		if(!empty($_POST['type'])) {
			$shortcodeParams['type'] = $_POST['type'];
		}

		if(!empty($_POST['columns'])) {
			$shortcodeParams['columns'] = $_POST['columns'];
		}

		if(!empty($_POST['gridSize'])) {
			$shortcodeParams['grid_size'] = $_POST['gridSize'];
		}

		if(!empty($_POST['orderBy'])) {
			$shortcodeParams['order_by'] = $_POST['orderBy'];
		}

		if(!empty($_POST['order'])) {
			$shortcodeParams['order'] = $_POST['order'];
		}

		if(!empty($_POST['number'])) {
			$shortcodeParams['number'] = $_POST['number'];
		}
		if(!empty($_POST['imageSize'])) {
			$shortcodeParams['image_size'] = $_POST['imageSize'];
		}

		if(!empty($_POST['customImageDimensions'])) {
			$shortcodeParams['custom_image_dimensions'] = $_POST['customImageDimensions'];
		}

		if(!empty($_POST['filter'])) {
			$shortcodeParams['filter'] = $_POST['filter'];
		}

		if(!empty($_POST['filterOrderBy'])) {
			$shortcodeParams['filter_order_by'] = $_POST['filterOrderBy'];
		}

		if(!empty($_POST['category'])) {
			$shortcodeParams['category'] = $_POST['category'];
		}

		if(!empty($_POST['selectedProjectes'])) {
			$shortcodeParams['selected_projectes'] = $_POST['selectedProjectes'];
		}

		if(!empty($_POST['showLoadMore'])) {
			$shortcodeParams['show_load_more'] = $_POST['showLoadMore'];
		}

		if(!empty($_POST['titleTag'])) {
			$shortcodeParams['title_tag'] = $_POST['titleTag'];
		}

		if(!empty($_POST['nextPage'])) {
			$shortcodeParams['next_page'] = $_POST['nextPage'];
		}

		if(!empty($_POST['activeFilterCat'])) {
			$shortcodeParams['active_filter_cat'] = $_POST['activeFilterCat'];
		}

		if(!empty($_POST['showExcerpt'])) {
			$shortcodeParams['show_excerpt'] = $_POST['showExcerpt'];
		}

		if(!empty($_POST['space_between_portfolio_items'])) {
			$shortcodeParams['space_between_portfolio_items'] = $_POST['spaceBetweenPortfolioItems'];
		}

		return $shortcodeParams;
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(array(
					'name'                      => 'Portfolio List',
					'base'                      => $this->getBase(),
					'category'                  => 'by MIKADO',
					'icon'                      => 'icon-wpb-portfolio extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'dropdown',
								'heading'     => 'Portfolio List Template',
								'param_name'  => 'type',
								'value'       => array(
									'Standard'  => 'standard',
									'Gallery'   => 'gallery',
									'Masonry'   => 'masonry',
									'Pinterest' => 'pinterest'
								),
								'admin_label' => true,
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Title Tag',
								'param_name'  => 'title_tag',
								'value'       => array(
									''   => '',
									'h2' => 'h2',
									'h3' => 'h3',
									'h4' => 'h4',
									'h5' => 'h5',
									'h6' => 'h6',
								),
								'admin_label' => true,
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Image Proportions',
								'param_name'  => 'image_size',
								'value'       => array(
									'Original'  => 'full',
									'Square'    => 'square',
									'Landscape' => 'landscape',
									'Portrait'  => 'portrait',
									'Custom'    => 'custom'
								),
								'save_always' => true,
								'admin_label' => true,
								'description' => '',
								'dependency'  => array('element' => 'type', 'value' => array('standard', 'gallery')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'textfield',
								'admin_label' => true,
								'heading'     => 'Image Dimensions',
								'param_name'  => 'custom_image_dimensions',
								'value'       => '',
								'description' => 'Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)',
								'group'       => 'Layout Options',
								'dependency'  => array('element' => 'image_size', 'value' => 'custom')
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Show Load More',
								'param_name'  => 'show_load_more',
								'value'       => array(
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'save_always' => true,
								'admin_label' => true,
								'description' => 'Default value is Yes',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Number of Columns',
								'param_name'  => 'columns',
								'value'       => array(
									''      => '',
									'One'   => 'one',
									'Two'   => 'two',
									'Three' => 'three',
									'Four'  => 'four',
									'Five'  => 'five',
									'Six'   => 'six'
								),
								'admin_label' => true,
								'description' => 'Default value is Three',
								'dependency'  => array('element' => 'type', 'value' => array('standard', 'gallery')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Grid Size',
								'param_name'  => 'grid_size',
								'value'       => array(
									'Default'        => '',
									'3 Columns Grid' => 'three',
									'4 Columns Grid' => 'four',
									'5 Columns Grid' => 'five'
								),
								'admin_label' => true,
								'description' => 'This option is only for Full Width Page Template',
								'dependency'  => array('element' => 'type', 'value' => array('pinterest')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Enable Category Filter',
								'param_name'  => 'filter',
								'value'       => array(
									'No'  => 'no',
									'Yes' => 'yes'
								),
								'admin_label' => true,
								'save_always' => true,
								'description' => 'Default value is No',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Filter Order By',
								'param_name'  => 'filter_order_by',
								'value'       => array(
									'Name'  => 'name',
									'Count' => 'count',
									'Id'    => 'id',
									'Slug'  => 'slug'
								),
								'admin_label' => true,
								'save_always' => true,
								'description' => 'Default value is Name',
								'dependency'  => array('element' => 'filter', 'value' => array('yes')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Enable Circle Overlay Hover',
								'param_name'  => 'enable_circle_overlay_hover',
								'value'       => array(
									'No'  => 'no',
									'Yes' => 'yes'
								),
								'admin_label' => true,
								'save_always' => true,
								'description' => 'Default value is No',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Space Between Portfolio Items',
								'param_name'  => 'space_between_portfolio_items',
								'value'       => array(
									''    => '',
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'admin_label' => true,
								'save_always' => true,
								'dependency'  => array('element' => 'type', 'value' => array('gallery')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Show Excerpt?',
								'param_name'  => 'show_excerpt',
								'value'       => array(
									''    => '',
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'admin_label' => true,
								'save_always' => true,
								'dependency'  => array('element' => 'type', 'value' => array('standard')),
								'group'       => 'Layout Options'
							)
						),
						PortfolioLib\PortfolioQuery::getInstance()->queryVCParams()
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type'                          => 'standard',
			'columns'                       => 'three',
			'grid_size'                     => 'three',
			'image_size'                    => 'full',
			'filter'                        => 'no',
			'filter_order_by'               => 'name',
			'enable_circle_overlay_hover'   => '',
			'show_load_more'                => 'yes',
			'title_tag'                     => 'h5',
			'portfolio_slider'              => '',
			'portfolios_shown'              => '',
			'space_between_portfolio_items' => '',
			'show_excerpt'                  => 'yes',
			'custom_image_dimensions'       => ''
		);

		$portfolioQuery = PortfolioLib\PortfolioQuery::getInstance();

		$args   = array_merge($args, $portfolioQuery->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);

		extract($params);

		$queryResults            = $portfolioQuery->buildQueryObject($params);
		$params['query_results'] = $queryResults;

		$classes  = $this->getPortfolioClasses($params);
		$dataAtts = $this->getDataAtts($params);
		$dataAtts .= ' data-max-num-pages = '.$queryResults->max_num_pages;
		$params['masonry_filter'] = '';

		$html = '';

		if($filter == 'yes' && ($type == 'masonry' || $type == 'pinterest')) {
			$params['filter_categories'] = $this->getFilterCategories($params);
			$params['masonry_filter']    = 'mkdf-masonry-filter';
			$html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/portfolio-filter', 'portfolio', '', $params);
		}

		$html .= '<div class = "mkdf-portfolio-list-holder-outer '.$classes.'" '.$dataAtts.'>';

		if($filter == 'yes' && ($type == 'standard' || $type == 'gallery')) {
			$params['filter_categories'] = $this->getFilterCategories($params);
			$html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/portfolio-filter', 'portfolio', '', $params);
		}

		$html .= '<div class = "mkdf-portfolio-list-holder clearfix" >';
		if($type == 'masonry' || $type == 'pinterest') {
			$html .= '<div class="mkdf-portfolio-list-masonry-grid-sizer"></div>';
			$html .= '<div class="mkdf-portfolio-list-masonry-grid-gutter"></div>';
		}

		if($type !== 'masonry') {
			$params['thumb_size']            = $this->getImageSize($params);
			$params['use_custom_image_size'] = false;
			if($params['thumb_size'] === 'custom' && !empty($params['custom_image_dimensions'])) {
				$params['use_custom_image_size'] = true;
				$params['custom_image_sizes']    = $this->getCustomImageSize($params['custom_image_dimensions']);
			}
		}

		if($queryResults->have_posts()) {
			while($queryResults->have_posts()) {
				$queryResults->the_post();

				$params['current_id'] = get_the_ID();

				if($type === 'masonry') {
					$params['thumb_size'] = $this->getImageSize($params);
				}

				$params['icon_html']            = $this->getPortfolioIconsHtml($params);
				$params['category_html']        = $this->getItemCategoriesHtml($params);
				$params['categories']           = $this->getItemCategories($params);
				$params['article_masonry_size'] = $this->getMasonrySize($params);
				$params['item_link']            = $this->getItemLink($params);

				$html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/'.$type, 'portfolio', '', $params);
			}
		} else {
			$html .= '<p>'._e('Sorry, no posts matched your criteria.').'</p>';
		}

		$html .= '</div>'; //close mkdf-portfolio-list-holder

		if($show_load_more == 'yes') {
			$html .= mkd_core_get_shortcode_module_template_part('portfolio-list/templates/load-more-template', 'portfolio', '', $params);
		}

		wp_reset_postdata();

		$html .= '</div>'; // close mkdf-portfolio-list-holder-outer
		return $html;
	}

	/**
	 * Generates portfolio icons html
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getPortfolioIconsHtml($params) {

		$html       = '';
		$id         = $params['current_id'];
		$slug_list_ = 'pretty_photo_gallery';

		$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full'); //original size
		$large_image          = $featured_image_array[0];

		$html .= '<div class="mkdf-item-icons-holder">';

		$html .= '<a class="mkdf-portfolio-lightbox" title="'.get_the_title($id).'" href="'.$large_image.'" data-rel="prettyPhoto['.$slug_list_.']"></a>';


		if(function_exists('sienna_mikado_like_portfolio_list')) {
			$html .= sienna_mikado_like_portfolio_list($id);
		}

		$html .= '<a class="mkdf-preview" title="Go to Project" href="'.$this->getItemLink($params).'" data-type="portfolio_list"></a>';

		$html .= '</div>';

		return $html;

	}

	/**
	 * Generates portfolio classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getPortfolioClasses($params) {
		$classes   = array();
		$type      = $params['type'];
		$columns   = $params['columns'];
		$grid_size = $params['grid_size'];
		switch($type):
			case 'standard':
				$classes[] = 'mkdf-ptf-standard';
				$classes[] = 'mkdf-ptf-with-spaces';
				break;
			case 'gallery':
				$classes[] = 'mkdf-ptf-gallery';

				if($params['space_between_portfolio_items'] == 'yes') {
					$classes[] = 'mkdf-ptf-with-spaces';
				}

				$classes[] = 'mkdf-portfolio-gallery-hover';

				break;
			case 'masonry':
				$classes[] = 'mkdf-ptf-masonry';
				$classes[] = 'mkdf-portfolio-gallery-hover';

				break;
			case 'pinterest':
				$classes[] = 'mkdf-ptf-pinterest';

				$classes[] = 'mkdf-portfolio-gallery-hover';
				break;
		endswitch;

		if(empty($params['portfolio_slider'])) { // portfolio slider mustn't have this classes

			if($type == 'standard' || $type == 'gallery') {
				switch($columns):
					case 'one':
						$classes[] = 'mkdf-ptf-one-column';
						break;
					case 'two':
						$classes[] = 'mkdf-ptf-two-columns';
						break;
					case 'three':
						$classes[] = 'mkdf-ptf-three-columns';
						break;
					case 'four':
						$classes[] = 'mkdf-ptf-four-columns';
						break;
					case 'five':
						$classes[] = 'mkdf-ptf-five-columns';
						break;
					case 'six':
						$classes[] = 'mkdf-ptf-six-columns';
						break;
				endswitch;
			}
			if($params['show_load_more'] == 'yes') {
				$classes[] = 'mkdf-ptf-load-more';
			}

		}

		if($type == 'pinterest') {
			switch($grid_size):
				case 'three':
					$classes[] = 'mkdf-ptf-pinterest-three-columns';
					break;
				case 'four':
					$classes[] = 'mkdf-ptf-pinterest-four-columns';
					break;
				case 'five':
					$classes[] = 'mkdf-ptf-pinterest-five-columns';
					break;
			endswitch;
		}
		if($params['filter'] == 'yes') {
			$classes[] = 'mkdf-ptf-has-filter';
			if($params['type'] == 'masonry' || $params['type'] == 'pinterest') {
				if($params['filter'] == 'yes') {
					$classes[] = 'mkdf-ptf-masonry-filter';
				}
			}
		}

		if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes') {
			$classes[] = 'mkdf-portfolio-slider-holder';
		}

		if($params['enable_circle_overlay_hover'] === 'yes') {
			$classes[] = 'mkdf-portfolio-circle-overlay';
		}

		return implode(' ', $classes);

	}

	/**
	 * Generates portfolio image size
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getImageSize($params) {

		$thumb_size = 'full';
		$type       = $params['type'];

		if($type == 'standard' || $type == 'gallery') {
			if(!empty($params['image_size'])) {
				$image_size = $params['image_size'];

				switch($image_size) {
					case 'landscape':
						$thumb_size = 'sienna_mikado_landscape';
						break;
					case 'portrait':
						$thumb_size = 'sienna_mikado_portrait';
						break;
					case 'square':
						$thumb_size = 'sienna_mikado_square';
						break;
					case 'full':
						$thumb_size = 'full';
						break;
					case 'custom':
						$thumb_size = 'custom';
						break;
					default:
						$thumb_size = 'full';
						break;
				}
			}
		} elseif($type == 'masonry') {

			$id           = $params['current_id'];
			$masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions', true);

			switch($masonry_size):
				case 'default' :
					$thumb_size = 'sienna_mikado_square';
					break;
				case 'large_width' :
					$thumb_size = 'sienna_mikado_large_width';
					break;
				case 'large_height' :
					$thumb_size = 'sienna_mikado_large_height';
					break;
				case 'large_width_height' :
					$thumb_size = 'sienna_mikado_large_width_height';
					break;
			endswitch;
		}


		return $thumb_size;
	}

	/**
	 * Generates portfolio item categories ids.This function is used for filtering
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getItemCategories($params) {
		$id                    = $params['current_id'];
		$category_return_array = array();

		$categories = wp_get_post_terms($id, 'portfolio-category');

		foreach($categories as $cat) {
			$category_return_array[] = 'portfolio_category_'.$cat->term_id;
		}

		return implode(' ', $category_return_array);
	}

	/**
	 * Generates portfolio item categories html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemCategoriesHtml($params) {
		$id = $params['current_id'];

		$categories    = wp_get_post_terms($id, 'portfolio-category');
		$category_html = '<div class="mkdf-ptf-category-holder">';
		$k             = 1;
		foreach($categories as $cat) {
			$category_html .= '<span>'.$cat->name.'</span>';
			if(count($categories) != $k) {
				$category_html .= ' / ';
			}
			$k++;
		}
		$category_html .= '</div>';

		return $category_html;
	}

	/**
	 * Generates masonry size class for each article( based on id)
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getMasonrySize($params) {
		$masonry_size_class = '';

		if($params['type'] == 'masonry') {

			$id           = $params['current_id'];
			$masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions', true);
			switch($masonry_size):
				case 'default' :
					$masonry_size_class = 'mkdf-default-masonry-item';
					break;
				case 'large_width' :
					$masonry_size_class = 'mkdf-large-width-masonry-item';
					break;
				case 'large_height' :
					$masonry_size_class = 'mkdf-large-height-masonry-item';
					break;
				case 'large_width_height' :
					$masonry_size_class = 'mkdf-large-width-height-masonry-item';
					break;
			endswitch;
		}

		return $masonry_size_class;
	}

	/**
	 * Generates filter categories array
	 *
	 * @param $params
	 *
	 *
	 *
	 *
	 * * @return array
	 */
	public function getFilterCategories($params) {

		$cat_id       = 0;
		$top_category = '';

		if(!empty($params['category'])) {

			$top_category = get_term_by('slug', $params['category'], 'portfolio-category');
			if(isset($top_category->term_id)) {
				$cat_id = $top_category->term_id;
			}

		}

		$args = array(
			'child_of' => $cat_id,
			'order_by' => $params['filter_order_by']
		);

		$filter_categories = get_terms('portfolio-category', $args);

		return $filter_categories;

	}

	/**
	 * Generates datta attributes array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getDataAtts($params) {

		$data_attr          = array();
		$data_return_string = '';

		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		if(!empty($paged)) {
			$data_attr['data-next-page'] = $paged + 1;
		}

		if(!empty($params['type'])) {
			$data_attr['data-type'] = $params['type'];
		}

		if(!empty($params['columns'])) {
			$data_attr['data-columns'] = $params['columns'];
		}

		if(!empty($params['grid_size'])) {
			$data_attr['data-grid-size'] = $params['grid_size'];
		}

		if(!empty($params['order_by'])) {
			$data_attr['data-order-by'] = $params['order_by'];
		}

		if(!empty($params['order'])) {
			$data_attr['data-order'] = $params['order'];
		}

		if(!empty($params['number'])) {
			$data_attr['data-number'] = $params['number'];
		}

		if(!empty($params['image_size'])) {
			$data_attr['data-image-size'] = $params['image_size'];
		}

		if(!empty($params['custom_image_dimensions'])) {
			$data_attr['data-custom-image-dimensions'] = $params['custom_image_dimensions'];
		}

		if(!empty($params['filter'])) {
			$data_attr['data-filter'] = $params['filter'];
		}

		if(!empty($params['filter_order_by'])) {
			$data_attr['data-filter-order-by'] = $params['filter_order_by'];
		}

		if(!empty($params['category'])) {
			$data_attr['data-category'] = $params['category'];
		}

		if(!empty($params['selected_projectes'])) {
			$data_attr['data-selected-projects'] = $params['selected_projectes'];
		}

		if(!empty($params['show_load_more'])) {
			$data_attr['data-show-load-more'] = $params['show_load_more'];
		}

		if(!empty($params['title_tag'])) {
			$data_attr['data-title-tag'] = $params['title_tag'];
		}

		if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes') {
			$data_attr['data-items'] = $params['portfolios_shown'];
		}

		$data_attr['data-show-excerpt'] = empty($params['show_excerpt']) ? 'no' : $params['show_excerpt'];

		foreach($data_attr as $key => $value) {
			if($key !== '') {
				$data_return_string .= $key.'= '.esc_attr($value).' ';
			}
		}

		return $data_return_string;
	}


	/**
	 * Checks if portfolio has external link and returns it. Else returns link to portfolio single page
	 *
	 * @param $params
	 *
	 * @return false|mixed|string
	 */
	public function getItemLink($params) {

		$id             = $params['current_id'];
		$portfolio_link = get_permalink($id);
		if(get_post_meta($id, 'portfolio_external_link', true) !== '') {
			$portfolio_link = get_post_meta($id, 'portfolio_external_link', true);
		}

		return $portfolio_link;

	}

	private function getCustomImageSize($customImageSize) {
		$imageSize = trim($customImageSize);
		//Find digits
		preg_match_all('/\d+/', $imageSize, $matches);
		if(!empty($matches[0])) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		}

		return false;
	}
}