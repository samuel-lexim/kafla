<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/4/2016
 * Time: 10:38 AM
 */

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Instagram;


use Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter\SocialFeedItemInterface;

class InstagramItemAdapter implements SocialFeedItemInterface {
	private $item;

	/**
	 * InstagramItemAdapter constructor.
	 *
	 * @param $item
	 */
	public function __construct($item) {
		$this->item = $item;
	}


	public function getExcerpt() {
		return $this->item['caption']['text'];
	}

	public function getDate() {
		return date(get_option('date_format'), $this->item['created_time']);
	}

	public function getAuthorName() {
		$user = $this->item['user'];

		return '#'.$user['full_name'];
	}

	public function getAuthorURL() {
		$user = $this->item['user'];

		return 'https://instagram.com/'.$user['username'];
	}

	public function getPermalink() {
		return $this->item['link'];
	}

	public function getTarget() {
		return '_blank';
	}

	public function getDateTimestamp() {
		return $this->item['created_time'];
	}

	public function getThumb() {
		if(!$this->item['type'] === 'image' || empty($this->item['images']['standard_resolution'])) {
			return;
		}

		$image = $this->item['images']['standard_resolution'];
		$alt   = empty($this->item['caption']['text']) ? $this->getType() : $this->item['caption']['text'];

		$imageHtml = '<img alt="'.esc_attr($alt).'" src="'.esc_url($image['url']).'" height="'.$image['height'].'" width="'.esc_attr($image['width']).'" />';

		return $imageHtml;
	}

	public function getType() {
		return 'instagram';
	}

	public function getIcon() {
		return sienna_mikado_icon_collections()->renderIcon('social_instagram', 'font_elegant');
	}
}