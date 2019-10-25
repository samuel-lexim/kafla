<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/3/2016
 * Time: 1:05 PM
 */
namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

interface ParametrizedProviderInterface {
	/**
	 * @param array $feedParams
	 */
	public function setFeedParams($feedParams = array());

	/**
	 * @return array
	 */
	public function getFeedParams();
}