<?php
namespace Sienna\Modules\Shortcodes\ItemShowcase;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ItemShowcase
 */
class ItemShowcase implements ShortcodeInterface	{
    private $base;

    function __construct() {
        $this->base = 'mkdf_item_showcase';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map( array(
            'name' => esc_html__('Mikado Item Showcase', 'sienna'),
            'base' => $this->base,
            'category' => 'by MIKADO',
            'icon' => 'icon-wpb-item-showcase extended-custom-icon',
            'as_parent' => array('only' => 'mkdf_item_showcase_list_item'),
            'js_view' => 'VcColumnView',
            'params' =>	array(
                array(
                    'type' => 'attach_image',
                    'heading' => 'Image',
                    'param_name' => 'item_image'
                ),
            )
        ) );

    }

    public function render($atts, $content = null) {

        $args = array(
            'item_image'    => '',
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

        $html = '';

        $item_showcase_classes = array();
        $item_showcase_classes[] = 'clearfix mkdf-item-showcase';
        $item_showcase_class = implode(' ', $item_showcase_classes);

        $html .= '<div '. sienna_mikado_get_class_attribute($item_showcase_class) . '>';
        $html .= '<div class="mkdf-item-image">';
        if ($item_image != '') {
            $html .= wp_get_attachment_image($item_image,'full');
        }
        $html .= '</div>';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;

    }

}