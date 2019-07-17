<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib;

/**
 * Class ProvidersVCParams
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib
 */
class ProvidersVCParams {
	/**
	 * @var array
	 */
	private $providers;
	/**
	 * @var array
	 */
	private $VCParams;

	/**
	 * ProvidersVCParams constructor.
	 */
	public function __construct() {
		$this->providers = array();
		$this->VCParams = array();
	}

	/**
	 * Set array of ProverVCParamsInterface objects
	 * @param $providers
	 */
	public function setProviders($providers) {
		foreach($providers as $provider) {
			$this->setProvider($provider);
		}
	}

	/**
	 * @param ProviderVCParamsInterface $provider
	 */
	private function setProvider(ProviderVCParamsInterface $provider) {
		$this->providers[] = $provider;
	}

	/**
	 * @return array
	 */
	public function getVCParams() {
		foreach($this->providers as $provider) {
			$this->VCParams = array_merge($this->VCParams, $provider->getVCParams());
		}

		return $this->VCParams;
	}

	/**
	 * @return array
	 */
	public function getShortcodeParams() {
		$shortcodeParams = array();

		foreach($this->providers as $provider) {
			$shortcodeParams = array_merge($shortcodeParams, $provider->getShortcodeParams());
		}

		return $shortcodeParams;
	}
}