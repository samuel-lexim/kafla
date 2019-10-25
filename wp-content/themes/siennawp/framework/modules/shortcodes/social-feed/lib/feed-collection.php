<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter\SocialFeedItemInterface;

/**
 * Class FeedCollection
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib
 */
class FeedCollection {
	/**
	 * Collection of SocialFeedItemInterface objects
	 * @var
	 */
	private $objects = array();

	/**
	 * @param SocialFeedItemInterface $item
	 */
	public function addItem(SocialFeedItemInterface $item) {
		$this->objects[$item->getDateTimestamp().'item'] = $item;
	}

	/**
	 * @return array
	 */
	public function getCollection() {
		return $this->objects;
	}

	public function sortCollection() {
		krsort($this->objects);
	}
}