<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog;


use Sienna\Modules\Shortcodes\SocialFeed\Lib\FeedCollection;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ParametrizedProviderInterface;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderInterface;

/**
 * Class BlogProvider
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog
 */
class BlogProvider implements ProviderInterface, ParametrizedProviderInterface {
	/**
	 * @var array
	 */
	private $feedParams = array();

	/**
	 * @var array
	 */
	private $rawData = array();

	/**
	 * @var FeedCollection
	 */
	private $feed;

	/**
	 * @var string
	 */
	private $displayName;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * BlogProvider constructor.
	 *
	 * @param array $feedParams
	 */
	public function __construct($feedParams = array()) {
		$this->setFeedParams($feedParams);

		$this->feed = new FeedCollection();

		$this->displayName = esc_html__('Blog', 'sienna');
		$this->type = 'blog';
	}

	/**
	 * @return string
	 */
	public function getDisplayName() {
		return $this->displayName;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param array $feedParams
	 */
	public function setFeedParams($feedParams = array()) {
		$this->feedParams['posts_per_page'] = !empty($feedParams['posts_per_page']) ? $feedParams['posts_per_page'] : '';
		$this->feedParams['orderby'] = !empty($feedParams['posts_per_page']) ? $feedParams['posts_per_page'] : '';
		$this->feedParams['order'] = !empty($feedParams['order']) ? $feedParams['order'] : '';
		$this->feedParams['category_name'] = !empty($feedParams['category_name']) ? $feedParams['category_name'] : '';
		$this->feedParams['excerpt_length'] = isset($feedParams['excerpt_length']) && $feedParams['excerpt_length'] !== '' ? $feedParams['excerpt_length'] : '';
	}

	/**
	 * @return array
	 */
	public function getFeedParams() {
		return $this->feedParams;
	}

	/**
	 * Fetch feed from provider
	 */
	public function fetchFeed() {
		$this->rawData = new \WP_Query($this->feedParams);
	}

	public function populateCollection() {
		if($this->rawData->have_posts()) {
			while($this->rawData->have_posts()) {
				$this->rawData->the_post();

				$this->feed->addItem(new BlogItemAdapter(get_post(), $this->feedParams['excerpt_length']));
			}

			wp_reset_postdata();
		}
	}

	/**
	 * @return array
	 */
	public function getFeed() {
		$this->fetchFeed();
		$this->populateCollection();

		return $this->feed->getCollection();
	}
}