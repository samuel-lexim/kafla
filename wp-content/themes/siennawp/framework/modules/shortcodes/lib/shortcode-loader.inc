<?php

namespace Sienna\Modules\Shortcodes\Lib;

use Sienna\Modules\CallToAction\CallToAction;
use Sienna\Modules\Counter\Countdown;
use Sienna\Modules\Counter\Counter;
use Sienna\Modules\ElementsHolder\ElementsHolder;
use Sienna\Modules\ElementsHolderItem\ElementsHolderItem;
use Sienna\Modules\GoogleMap\GoogleMap;
use Sienna\Modules\Separator\Separator;
use Sienna\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Sienna\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Sienna\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Sienna\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Sienna\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use Sienna\Modules\Shortcodes\BLogCarousel\BlogCarousel;
use Sienna\Modules\Shortcodes\BlogSlider\BlogSlider;
use Sienna\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use Sienna\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use Sienna\Modules\Shortcodes\HorizontalTimeline\HorizontalTimeline;
use Sienna\Modules\Shortcodes\HorizontalTimeline\HorizontalTimelineItem;
use Sienna\Modules\Shortcodes\Icon\Icon;
use Sienna\Modules\Shortcodes\IconProgressBar;
use Sienna\Modules\Shortcodes\ImageGallery\ImageGallery;
use Sienna\Modules\Shortcodes\InfoCardCarousel\InfoCardCarousel;
use Sienna\Modules\Shortcodes\InfoCardCarousel\InfoCardCarouselItem;
use Sienna\Modules\Shortcodes\ItemShowcase\ItemShowcase;
use Sienna\Modules\Shortcodes\ItemShowcaseListItem\ItemShowcaseListItem;
use Sienna\Modules\Shortcodes\Process\Process;
use Sienna\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use Sienna\Modules\Shortcodes\SectionTitle\SectionTitle;
use Sienna\Modules\Shortcodes\SocialFeed\SocialFeedCarousel;
use Sienna\Modules\Shortcodes\SocialFeed\SocialFeedMasonry;
use Sienna\Modules\Shortcodes\TeamSlider\TeamSlider;
use Sienna\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use Sienna\Modules\Shortcodes\VideoBanner\VideoBanner;
use Sienna\Modules\Shortcodes\WorkingHours\WorkingHours;
use Sienna\Modules\Shortcodes\ZoomingSlider\ZoomingSlider;
use Sienna\Modules\Shortcodes\ZoomingSlider\ZoomingSliderItem;
use Sienna\Modules\SocialShare\SocialShare;
use Sienna\Modules\Team\Team;
use Sienna\Modules\OrderedList\OrderedList;
use Sienna\Modules\UnorderedList\UnorderedList;
use Sienna\Modules\Message\Message;
use Sienna\Modules\ProgressBar\ProgressBar;
use Sienna\Modules\IconListItem\IconListItem;
use Sienna\Modules\Tabs\Tabs;
use Sienna\Modules\Tab\Tab;
use Sienna\Modules\PricingTables\PricingTables;
use Sienna\Modules\PricingTable\PricingTable;
use Sienna\Modules\Accordion\Accordion;
use Sienna\Modules\AccordionTab\AccordionTab;
use Sienna\Modules\BlogList\BlogList;
use Sienna\Modules\Shortcodes\Button\Button;
use Sienna\Modules\Blockquote\Blockquote;
use Sienna\Modules\CustomFont\CustomFont;
use Sienna\Modules\Highlight\Highlight;
use Sienna\Modules\VideoButton\VideoButton;
use Sienna\Modules\Dropcaps\Dropcaps;
use Sienna\Modules\Shortcodes\IconWithText\IconWithText;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new Team());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Message());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new VideoBanner());
		$this->addShortcode(new AnimationsHolder());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new SectionSubtitle());
		$this->addShortcode(new Process());
		$this->addShortcode(new ComparisonPricingTablesHolder());
		$this->addShortcode(new ComparisonPricingTable());
		$this->addShortcode(new VerticalProgressBar());
		$this->addShortcode(new IconProgressBar());
		$this->addShortcode(new WorkingHours());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new BlogCarousel());
		$this->addShortcode(new ZoomingSlider());
		$this->addShortcode(new ZoomingSliderItem());
		$this->addShortcode(new TeamSlider());
		$this->addShortcode(new InfoCardCarousel());
		$this->addShortcode(new InfoCardCarouselItem());
		$this->addShortcode(new HorizontalTimeline());
		$this->addShortcode(new HorizontalTimelineItem());
		$this->addShortcode(new SocialFeedCarousel());
		$this->addShortcode(new SocialFeedMasonry());
		$this->addShortcode(new ItemShowcase());
		$this->addShortcode(new ItemShowcaseListItem());
	}

	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();