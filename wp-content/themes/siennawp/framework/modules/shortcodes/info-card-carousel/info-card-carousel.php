<?php
namespace Sienna\Modules\Shortcodes\InfoCardCarousel;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class InfoCardCarousel implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_info_card_carousel';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => 'Info Card Carousel',
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkdf_info_card_carousel_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-info-card-slider extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        ));
    }

    public function render($atts, $content = null) {
        $params = array(
            'content' => $content
        );

        return sienna_mikado_get_shortcode_module_template_part('templates/info-card-carousel-holder', 'info-card-carousel', '', $params);
    }

}