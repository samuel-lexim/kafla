<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

/**
 * Interface ProviderVCParamsInterface
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib
 */
interface ProviderVCParamsInterface {
	/**
	 * Get array of parameters ready for Visual Composer params property
	 * @return mixed
	 */
	public function getVCParams();

	/**
	 * Get array of shortcode parameters
	 * @return mixed
	 */
	public function getShortcodeParams();
}