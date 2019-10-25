<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Mikado_Search_Opener
 */
class SiennaMikadoSearchOpener extends SiennaMikadoWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'mkd_search_opener', // Base ID
			'Mikado Search Opener' // Name
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'name'        => 'search_icon_size',
				'type'        => 'textfield',
				'title'       => 'Search Icon Size (px)',
				'description' => 'Define size for Search icon'
			),
			array(
				'name'        => 'search_icon_color',
				'type'        => 'textfield',
				'title'       => 'Search Icon Color',
				'description' => 'Define color for Search icon'
			),
			array(
				'name'        => 'search_icon_hover_color',
				'type'        => 'textfield',
				'title'       => 'Search Icon Hover Color',
				'description' => 'Define hover color for Search icon'
			),
			array(
				'name'        => 'show_label',
				'type'        => 'dropdown',
				'title'       => 'Enable Search Icon Text',
				'description' => 'Enable this option to show \'Search\' text next to search icon in header',
				'options'     => array(
					''    => '',
					'yes' => 'Yes',
					'no'  => 'No'
				)
			),
			array(
				'name'        => 'close_icon_position',
				'type'        => 'dropdown',
				'title'       => 'Close icon stays on opener place',
				'description' => 'Enable this option to set close icon on same position like opener icon',
				'options'     => array(
					'yes' => 'Yes',
					'no'  => 'No'
				)
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {
		global $sienna_mikado_options, $sienna_mikado_IconCollections;

		$search_type_class           = 'mkdf-search-opener';
		$search_opener_styles        = array();
		$show_search_text            = $instance['show_label'] == 'yes' || $sienna_mikado_options['enable_search_icon_text'] == 'yes' ? true : false;
		$close_icon_on_same_position = $instance['close_icon_position'] == 'yes' ? true : false;

		if(isset($sienna_mikado_options['search_type']) && $sienna_mikado_options['search_type'] == 'search_covers_header') {
			if(isset($sienna_mikado_options['search_cover_only_bottom_yesno']) && $sienna_mikado_options['search_cover_only_bottom_yesno'] == 'yes') {
				$search_type_class .= ' search_covers_only_bottom';
			}
		}

		if(!empty($instance['search_icon_size'])) {
			$search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
		}

		if(!empty($instance['search_icon_color'])) {
			$search_opener_styles[] = 'color: '.$instance['search_icon_color'];
		}

		print $args['before_widget'];

		?>

		<a <?php echo sienna_mikado_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
			<?php if($close_icon_on_same_position) {
				echo sienna_mikado_get_inline_attr('yes', 'data-icon-close-same-position');
			} ?>
			<?php sienna_mikado_inline_style($search_opener_styles); ?>
			<?php sienna_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
			<?php if(isset($sienna_mikado_options['search_icon_pack'])) {
				$sienna_mikado_IconCollections->getSearchIcon($sienna_mikado_options['search_icon_pack'], false);
			} ?>
			<?php if($show_search_text) { ?>
				<span class="mkdf-search-icon-text"><?php esc_html_e('Search', 'sienna'); ?></span>
			<?php } ?>
		</a>

		<?php do_action('sienna_mikado_after_search_opener'); ?>

		<?php print $args['after_widget']; ?>
	<?php }
}