<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\FeedCollection;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ParametrizedProviderInterface;
use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderInterface;

/**
 * Class TwitterProvider
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter
 */
class TwitterProvider implements ProviderInterface, ParametrizedProviderInterface {

	/**
	 * Array of parameters from which to generate feed
	 * @var array
	 */
	private $feedParams;

	/**
	 * @var FeedCollection
	 */
	private $feed;

	/**
	 * Instance of MikadofTwitterApi class
	 * @var
	 */
	private $api;

	/**
	 * @var bool
	 */
	private $userConnected;

	/**
	 * Data fetched from Twitter
	 * @var array
	 */
	private $rawData;
	/**
	 * @var string
	 */
	private $type;
	/**
	 * @var string|void
	 */
	private $displayName;

	/**
	 * TwitterProvider constructor.
	 *
	 * @param array $feedParams
	 */
	public function __construct($feedParams = array()) {
		$this->setFeedParams($feedParams);
		$this->feed = new FeedCollection();
		$this->setApi();
		$this->setUserConnected();

		$this->displayName = esc_html__('Twitter', 'sienna');
		$this->type        = 'twitter';
	}

	/**
	 * @return array
	 */
	public function getFeedParams() {
		return $this->feedParams;
	}

	/**
	 * Check if Twitter plugin is installed and get instance
	 */
	public function setApi() {
		if(sienna_mikado_twitter_feed_installed()) {
			$this->api = \MikadofTwitterApi::getInstance();
		}
	}

	/**
	 *
	 */
	public function setUserConnected() {
		$this->userConnected = sienna_mikado_twitter_feed_installed() && $this->api->hasUserConnected();
	}

	/**
	 * @return \MikadofTwitterApi
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
	 * @param array $feedParams
	 */
	public function setFeedParams($feedParams = array()) {
		$this->feedParams['user_id'] = !empty($feedParams['twitter_user_id']) ? $feedParams['twitter_user_id'] : '';
		$this->feedParams['count']   = !empty($feedParams['twitter_count']) ? $feedParams['twitter_count'] : '';

		$this->feedParams['transient']['transient_time'] = isset($feedParams['twitter_transient_time']) && $feedParams['twitter_transient_time'] !== '' ? $feedParams['twitter_transient_time'] : '';
		$this->feedParams['transient']['transient_id']   = isset($feedParams['twitter_transient_id']) && $feedParams['twitter_transient_id'] !== '' ? $feedParams['twitter_transient_id'] : '';
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string|void
	 */
	public function getDisplayName() {
		return $this->displayName;
	}

	/**
	 *
	 */
	public function fetchFeed() {
		if(!$this->userConnected) {
			return;
		}

		$response = $this->api->fetchTweets(
			$this->feedParams['user_id'],
			$this->feedParams['count'],
			$this->feedParams['transient']
		);

		if(!$response->status || empty($response->data)) {
			return;
		}

		$this->rawData = $response->data;
	}

	/**
	 * Go through raw data and build an array of TwitterItemAdapter objects
	 */
	public function populateCollection() {
		if(empty($this->rawData)) {
			return;
		}

		foreach($this->rawData as $item) {
			$feedItem = new TwitterItemAdapter($item);
			$this->feed->addItem($feedItem);
		}
	}


	/**
	 * Fetches feed from Twitter, formats it and returns array of TwitterItemAdapter instances
	 * @return array
	 */
	public function getFeed() {
		$this->fetchFeed();
		$this->populateCollection();

		return $this->feed->getCollection();
	}
}