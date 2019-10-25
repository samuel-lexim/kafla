<?php
namespace Sienna\Modules\Shortcodes\ItemShowcaseListItem;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

class ItemShowcaseListItem implements ShortcodeInterface{
    private $base;

    function __construct() {
        $this->base = 'mkdf_item_showcase_list_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')){
            vc_map(
                array(
                    'name' => esc_html__('Mikado Item Showcase List Item', 'sienna'),
                    'base' => $this->base,
                    'as_child' => array('only' => 'mkdf_item_showcase'),
                    'as_parent' => array('only' => 'mkdf_icon_with_text'),
                    'content_element' => true,
                    'category' => 'by MIKADO',
                    'icon' => 'icon-wpb-item-showcase-list-item extended-custom-icon',
                    'show_settings_on_create' => true,
                    'js_view' => 'VcColumnView',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'admin_label' => true,
                            'heading' => 'Item Position',
                            'param_name' => 'item_position',
                            'value' => array(
                                'Left'     => 'left',
                                'Right'  => 'right'
                            ),
                            'save_always' => true
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'item_position' => '',
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['item_showcase_list_item_class'] = $this->getItemShowcaseListItemClass($params);

        $params['content'] = $content;


        $html = sienna_mikado_get_shortcode_module_template_part('templates/item-showcase-list-item-template', 'item-showcase', '', $params);

        return $html;
    }


    /**
     * Return Item Showcase List Item Classes
     *
     * @param $params
     * @return array
     */
    private function getItemShowcaseListItemClass($params) {

        $item_showcase_list_item_class = array();

        if ($params['item_position'] !== '') {
            $item_showcase_list_item_class[] = 'mkdf-item-'. $params['item_position'];
        }

        return implode(' ', $item_showcase_list_item_class);

    }

}
