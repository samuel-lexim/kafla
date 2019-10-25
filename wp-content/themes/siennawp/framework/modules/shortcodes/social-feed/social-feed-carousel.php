<?php

namespace Sienna\Modules\Shortcodes\SocialFeed;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog\BlogProvider;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog\BlogVCParams;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram\InstagramProvider;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram\InstagramVCParams;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProvidersVCParams;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\SocialFeedDataBuilder;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter\TwitterProvider;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter\TwitterVCParams;

/**
 * Class SocialFeedCarousel
 * @package Sienna\Modules\Shortcodes\SocialFeed
 */
class SocialFeedCarousel implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	private $providersVCParams;

	/**
	 * SocialFeedCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_social_feed_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));

		$this->setProvidersVCParams(new ProvidersVCParams());
	}

	/**
	 * @param mixed $providersVCParams
	 */
	public function setProvidersVCParams(ProvidersVCParams $providersVCParams) {
		$this->providersVCParams = $providersVCParams;

		$this->providersVCParams->setProviders(array(
			new BlogVCParams(),
			new TwitterVCParams(),
			new InstagramVCParams()
		));
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
			'name'                      => 'Social Feed Carousel',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-social-feed-carousel extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Show Filter?',
						'param_name'  => 'show_filter',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Disable Box Border?',
						'param_name'  => 'disable_border',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Box Background',
						'param_name'  => 'box_background',
						'value'       => array(
							'White' => 'white',
							'Grey'  => 'grey'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Order By',
						'param_name'  => 'order_by',
						'value'       => array(
							'Date'   => 'date',
							'Random' => 'random'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'mkdf-vc-unique-id',
						'prefix'      => 'sfc',
						'heading'     => 'Unique ID',
						'param_name'  => 'unique_id',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true
					)
				),
				$this->providersVCParams->getVCParams()
			)
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_params = array(
			'show_filter'    => '',
			'unique_id'      => '',
			'disable_border' => '',
			'order_by'       => '',
			'box_background' => 'white'
		);

		$default_params = array_merge($default_params, $this->providersVCParams->getShortcodeParams());

		$params = shortcode_atts($default_params, $atts);

		$feedDataBuilder = new SocialFeedDataBuilder($params['order_by']);

		$params['twitter_transient_id']   = 'sfc_twitter'.$params['unique_id'];
		$params['instagram_transient_id'] = 'sfc_instagram'.$params['unique_id'];

		$feedDataBuilder->setProviders(array(
			new TwitterProvider($params),
			new InstagramProvider($params),
			new BlogProvider($params)
		));

		$params['data']              = $feedDataBuilder->getFeed();
		$params['caller']            = $this;
		$params['holder_classes']    = array('mkdf-social-feed-carousel');
		$params['feed_data_builder'] = $feedDataBuilder;

		if($params['disable_border'] === 'yes') {
			$params['holder_classes'][] = 'mkdf-social-feed-carousel-no-border';
		}

		$params['holder_classes'][] = 'mkdf-social-feed-carousel-'.$params['box_background'].'-box-item';

		return sienna_mikado_get_shortcode_module_template_part('templates/social-feed-carousel-holder', 'social-feed', '', $params);
	}

	public function getItemTemplate($item) {
		$params['item'] = $item;

		echo sienna_mikado_get_shortcode_module_template_part('templates/item/box', 'social-feed', '', $params);
	}
}