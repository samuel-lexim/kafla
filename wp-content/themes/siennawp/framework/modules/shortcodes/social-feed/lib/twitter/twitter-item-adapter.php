<?php

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter;

/**
 * Class TwitterItemAdapter
 * @package Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter
 */
class TwitterItemAdapter implements SocialFeedItemInterface {
	/**
	 * @var Twitter Feed item array
	 */
	private $item;

	/**
	 * TwitterItemAdapter constructor.
	 *
	 * @param array $item
	 */
	public function __construct($item) {
		$this->item = $item;
	}

	/**
	 * @return string
	 */
	public function getExcerpt() {
		$protocol = is_ssl() ? 'https' : 'http';

		if(empty($this->item['text'])) {
			return '';
		}

		$text = preg_replace('/(https?)\:\/\/([a-z0-9\/\.\&\#\?\-\+\~\_\,]+)/i', '<a target="_blank" href="'.('$1://$2').'">$1://$2</a>', $this->item['text']);
		$text = preg_replace('/\@([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="'.esc_url($protocol.'://twitter.com/$1').'">@$1</a>', $text);

		return $text;
	}

	/**
	 * @return bool|string
	 */
	public function getDate() {
		return date(get_option('date_format'), strtotime($this->item['created_at']));
	}

	/**
	 * @return string
	 */
	public function getAuthorName() {
		$user = $this->item['user'];

		return '@'.$user['name'];
	}

	/**
	 * @return string
	 */
	public function getAuthorURL() {
		return 'https://twitter.com/'.$this->item['user']['screen_name'];
	}

	/**
	 * @return string
	 */
	public function getPermalink() {
		return 'https://twitter.com/statuses/'.$this->item['id_str'];
	}

	/**
	 * @return string
	 */
	public function getTarget() {
		return '_blank';
	}

	/**
	 * @return int
	 */
	public function getDateTimestamp() {
		return strtotime($this->item['created_at']);
	}

	/**
	 * @return string
	 */
	public function getThumb() {
		return '';
	}

	public function getType() {
		return 'twitter';
	}

	public function getIcon() {
		return sienna_mikado_icon_collections()->renderIcon('social_twitter', 'font_elegant');
	}
}