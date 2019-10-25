<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram;

use Sienna\Modules\Shortcodes\SocialFeed\Lib\ProviderVCParamsInterface;

class InstagramVCParams implements ProviderVCParamsInterface {
	private $api;
	private $userConnected;

	/**
	 * InstagramVCParams constructor.
	 */
	public function __construct() {
		$this->setApi();
		$this->setUserConnected();
	}

	/**
	 * Sets api param
	 */
	public function setApi() {
		if(sienna_mikado_instagram_feed_installed()) {
			$this->api = \MikadofInstagramApi::getInstance();
		}
	}

	/**
	 * Sets user connected param
	 */
	public function setUserConnected() {
		$this->userConnected = sienna_mikado_instagram_feed_installed() && $this->api->hasUserConnected();
	}

	public function getVCParams() {
		$params = array();

		if($this->userConnected) {
			$params = array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Tag',
					'param_name'  => 'instagram_tag',
					'value'       => '',
					'group'       => 'Instagram',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Number of Posts',
					'param_name'  => 'instagram_number_of_posts',
					'value'       => '',
					'group'       => 'Instagram',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Transient Time',
					'param_name'  => 'instagram_transient_time',
					'value'       => '',
					'group'       => 'Instagram',
					'admin_label' => true
				)
			);
		} elseif(sienna_mikado_instagram_feed_installed()) {
			$params = array(
				array(
					'type'       => 'mkdf-vc-info-field',
					'param_name' => 'instagram_user_connect',
					'value'      => 'Please connect with your Instagram account',
					'group'      => 'Instagram'
				)
			);
		}

		return $params;
	}

	public function getShortcodeParams() {
		return array(
			'instagram_tag'             => '',
			'instagram_number_of_posts' => '',
			'instagram_transient_time'  => ''
		);
	}
}