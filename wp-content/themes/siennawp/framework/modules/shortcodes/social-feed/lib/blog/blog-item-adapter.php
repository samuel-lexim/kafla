<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/4/2016
 * Time: 12:04 PM
 */

namespace Sienna\Modules\Shortcodes\SocialFeed\Lib\Blog;


use Sienna\Modules\Shortcodes\SocialFeed\Lib\Twitter\SocialFeedItemInterface;

class BlogItemAdapter implements SocialFeedItemInterface {
	private $item;
	private $excerptLength;

	/**
	 * BlogItemAdapter constructor.
	 *
	 * @param $item
	 * @param $excerptLength
	 */
	public function __construct($item, $excerptLength = null) {
		$this->item = $item;
		$this->setExcerptLength($excerptLength);
	}

	/**
	 * @param int $excerptLength
	 */
	public function setExcerptLength($excerptLength) {
		$excerptLength       = $excerptLength === '' ? 30 : (int) $excerptLength;
		$this->excerptLength = $excerptLength;
	}


	public function getExcerpt() {
		$postExcerpt        = strip_shortcodes($this->item->post_excerpt);
		$postContent        = strip_shortcodes($this->item->post_content);
		$contentToSubstring = empty($postExcerpt) ? $postContent : $postExcerpt;

		return wp_trim_words($contentToSubstring, $this->excerptLength, apply_filters('excerpt_more', '...'));
	}

	public function getDate() {
		return get_the_time(get_option('date_format'), $this->item);
	}

	public function getDateTimestamp() {
		return get_post_time('U', true, $this->item);
	}

	public function getAuthorName() {
		return get_the_author_meta('display_name', $this->item->post_author);
	}

	public function getAuthorURL() {
		return get_the_author_meta('url', $this->item->post_author);
	}

	public function getPermalink() {
		return get_the_permalink($this->item);
	}

	public function getTarget() {
		return '_self';
	}

	public function getThumb() {
		return wp_get_attachment_image(get_post_thumbnail_id($this->item), 'full');
	}

	public function getType() {
		return 'blog';
	}


	public function getIcon() {
		return sienna_mikado_icon_collections()->renderIcon('icon_pencil', 'font_elegant');
	}
}