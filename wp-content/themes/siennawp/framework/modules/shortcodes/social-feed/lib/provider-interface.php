<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

/**
 * Interface ProviderInterface
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib
 */
interface ProviderInterface {

	/**
	 * Fetches social feed
	 * @return mixed
	 */
	public function fetchFeed();

	/**
	 * Sorts feed by date in descending order
	 * @return mixed
	 */
	public function populateCollection();

	/**
	 * Returns feed array
	 * @return mixed
	 */
	public function getFeed();

	/**
	 * Returns name of the provider that can be displayed publicly
	 *
	 * @return mixed
	 */
	public function getDisplayName();

	/**
	 * Returns slug of the provider
	 *
	 * @return mixed
	 */
	public function getType();
}