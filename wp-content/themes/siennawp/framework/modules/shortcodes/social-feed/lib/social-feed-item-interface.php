<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/3/2016
 * Time: 3:36 PM
 */
namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter;

/**
 * Interface SocialFeedItemInterface
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter
 */
/**
 * Interface SocialFeedItemInterface
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter
 */
interface SocialFeedItemInterface {

	/**
	 * @return string
	 */
	public function getExcerpt();

	/**
	 * @return string
	 */
	public function getDate();

	/**
	 * @return string
	 */
	public function getAuthorName();

	/**
	 * @return string
	 */
	public function getAuthorURL();

	/**
	 * @return string
	 */
	public function getPermalink();

	/**
	 * @return string
	 */
	public function getTarget();

	/**
	 * @return int
	 */
	public function getDateTimestamp();

	/**
	 * @return string
	 */
	public function getThumb();

	/**
	 * @return string
	 */
	public function getType();

	/**
	 * @return string
	 */
	public function getIcon();
}