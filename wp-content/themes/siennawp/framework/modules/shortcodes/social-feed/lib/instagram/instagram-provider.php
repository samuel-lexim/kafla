<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\FeedCollection;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ParametrizedProviderInterface;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderInterface;

/**
 * Class InstagramProvider
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram
 */
class InstagramProvider implements ProviderInterface, ParametrizedProviderInterface {
	/**
	 * Array of parameters for fetching feed
	 *
	 * @var array
	 */
	private $feedParams;

	/**
	 * Collection of social feed items
	 *
	 * @var FeedCollection
	 */
	private $feed;

	/**
	 * @var \MikadofInstagramApi
	 */
	private $api;

	/**
	 * @var bool
	 */
	private $userConnected;

	/**
	 * Array of raw data fetched from provider
	 *
	 * @var array
	 */
	private $rawData;

	/**
	 * @var string
	 */
	private $displayName;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * InstagramProvider constructor.
	 *
	 * @param array $feedParams
	 */
	public function __construct($feedParams = array()) {
		$this->setFeedParams($feedParams);
		$this->setApi();
		$this->setUserConnected();

		$this->feed = new FeedCollection();

		$this->displayName = esc_html__('Instagram', 'sienna');
		$this->type        = 'instagram';
	}

	/**
	 * Returns name that can be displayed publicly
	 */
	public function getDisplayName() {
		return $this->displayName;
	}

	/**
	 * Returns provider's slug
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets api object if instagram plugin is installed
	 */
	public function setApi() {
		if(sienna_mikado_instagram_feed_installed()) {
			$this->api = \MikadofInstagramApi::getInstance();
		}
	}

	public function setUserConnected() {
		$this->userConnected = sienna_mikado_instagram_feed_installed() && $this->api->hasUserConnected();
	}

	/**
	 * @return \MikadofInstagramApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * @return bool
	 */
	public function getUserConnected() {
		return $this->userConnected;
	}

	/**
	 * Filters provided array for valid feed query parameters
	 *
	 * @param array $feedParams
	 */
	public function setFeedParams($feedParams = array()) {
		$this->feedParams['tag']             = !empty($feedParams['instagram_tag']) ? $feedParams['instagram_tag'] : '';
		$this->feedParams['number_of_posts'] = !empty($feedParams['instagram_number_of_posts']) ? $feedParams['instagram_number_of_posts'] : '';

		$this->feedParams['transient'] = array();

		if(isset($feedParams['instagram_transient_time']) && $feedParams['instagram_transient_time'] !== '') {
			$this->feedParams['transient']['transient_time'] = $feedParams['instagram_transient_time'];

			if(!empty($feedParams['instagram_transient_id'])) {
				$this->feedParams['transient']['transient_name'] = $feedParams['instagram_transient_id'];
				$this->feedParams['transient']['use_transients'] = true;
			}
		}
	}

	/**
	 * @return array
	 */
	public function getFeedParams() {
		return $this->feedParams;
	}

	/**
	 * Fetches feed based on previously set feed params
	 */
	public function fetchFeed() {
		if(!$this->userConnected) {
			return;
		}

		$response = $this->api->fetchData(
			$this->feedParams['number_of_posts'],
			$this->feedParams['tag'],
			$this->feedParams['transient']
		);

		if($response->status !== 'ok' || empty($response->data)) {
			return;
		}

		$this->rawData = $response->data;
	}

	/**
	 * Goes through feed data and populate feed collection
	 * with proper adapter objects
	 */
	public function populateCollection() {
		if(empty($this->rawData)) {
			return;
		}

		foreach($this->rawData as $item) {
			$feedItem = new InstagramItemAdapter($item);
			$this->feed->addItem($feedItem);
		}
	}

	/**
	 * Returns collection of feed items
	 *
	 * @return array
	 */
	public function getFeed() {
		$this->fetchFeed();
		$this->populateCollection();

		return $this->feed->getCollection();
	}
}