<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

/**
 * Class SocialFeedDataBuilder
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib
 */
class SocialFeedDataBuilder {
	/**
	 * @var array
	 */
	private $providers;
	/**
	 * @var array
	 */
	private $feed;

	/**
	 * SocialFeedDataBuilder constructor.
	 *
	 * @param string $orderBy
	 */
	public function __construct($orderBy = 'date') {
		$this->providers = array();
		$this->feed = array();
		$this->orderBy = $orderBy;
	}

	/**
	 * Set array of ProviderInterface objects
	 * @param $providers
	 */
	public function setProviders($providers) {
		foreach($providers as $provider) {
			$this->setProvider($provider);
		}
	}

	/**
	 * @param ProviderInterface $provider
	 */
	private function setProvider(ProviderInterface $provider) {
		$this->providers[] = $provider;
	}

	/**
	 * @return array
	 */
	public function getFeed() {
		foreach($this->providers as $provider) {
			$this->feed = array_merge($this->feed, $provider->getFeed());
		}

		$this->sortFeed();

		return $this->feed;
	}

	/**
	 * @return array
	 */
	public function getProviders() {
		return $this->providers;
	}

	private function sortFeed() {
		switch($this->orderBy) {
			case 'date':
				krsort($this->feed);
				break;
			case 'random':
				shuffle($this->feed);
				break;
			default:
				krsort($this->feed);
				break;
		}
	}
}