<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderVCParamsInterface;

/**
 * Class TwitterVCParams
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter
 */
class TwitterVCParams implements ProviderVCParamsInterface {
	/**
	 * @var \MikadofTwitterApi
	 */
	private $api;

	/**
	 * @var bool
	 */
	private $userConnected;

	/**
	 * TwitterVCParams constructor.
	 */
	public function __construct() {
		$this->setApi();
		$this->setUserConnected();
	}

	public function setApi() {
		if(sienna_mikado_twitter_feed_installed()) {
			$this->api = \MikadofTwitterApi::getInstance();
		}
	}

	public function setUserConnected() {
		$this->userConnected = sienna_mikado_twitter_feed_installed() && $this->api->hasUserConnected();
	}

	/**
	 * @return array
	 */
	public function getVCParams() {
		$params = array();

		if($this->userConnected) {
			$params = array(
				array(
					'type'        => 'textfield',
					'heading'     => 'User ID',
					'param_name'  => 'twitter_user_id',
					'value'       => '',
					'group'       => 'Twitter',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Number of Tweets',
					'param_name'  => 'twitter_count',
					'value'       => '',
					'group'       => 'Twitter',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Transient Time',
					'param_name'  => 'twitter_transient_time',
					'value'       => '',
					'group'       => 'Twitter',
					'admin_label' => true
				)
			);
		} elseif(sienna_mikado_twitter_feed_installed()) {
			$params = array(
				array(
					'type'  => 'mkdf-vc-info-field',
					'param_name' => 'twitter_user_connect',
					'value' => 'Please connect with your Twitter account',
					'group' => 'Twitter'
				)
			);
		}

		return $params;
	}

	/**
	 * @return array
	 */
	public function getShortcodeParams() {
		return array(
			'twitter_user_id'        => '',
			'twitter_count'          => '',
			'twitter_transient_time' => ''
		);
	}
}