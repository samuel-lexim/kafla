<?php

namespace MikadoCore\CPT\Testimonials\Shortcodes;


use MikadoCore\Lib;

/**
 * Class Testimonials
 * @package MikadoCore\CPT\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_testimonials';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(array(
                'name'                      => 'Testimonials',
                'base'                      => $this->base,
                'category'                  => 'by MIKADO',
                'icon'                      => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params'                    => array(
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => 'Choose Testimonial Type',
                        'param_name'  => 'testimonial_type',
                        'value'       => array(
                            'Testimonials Grid'   => 'testimonials-grid',
                            'Testimonials Slider' => 'testimonials-slider',
                            'Testimonials Simple' => 'testimonials-simple'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Set Dark/Light type',
                        'param_name'  => 'dark_light_type',
                        'value'       => array(
                            'Dark'  => 'dark',
                            'Light' => 'light',
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'class'       => '',
                        'heading'     => 'Number of Columns',
                        'param_name'  => 'number_of_columns',
                        'value'       => array(
                            'Two'   => '2',
                            'Three' => '3',
                            'Four'  => '4'
                        ),
                        'description' => '',
                        'dependency'  => Array('element' => 'testimonial_type', 'value' => 'testimonials-grid'),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => 'Category',
                        'param_name'  => 'category',
                        'value'       => '',
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => 'Number',
                        'param_name'  => 'number',
                        'value'       => '',
                        'description' => 'Number of Testimonials'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => 'Show Title',
                        'param_name'  => 'show_title',
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no'
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => 'Show Author',
                        'param_name'  => 'show_author',
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no'
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => 'Show Author Job Position',
                        'param_name'  => 'show_position',
                        'value'       => array(
                            'Yes' => 'yes',
                            'No'  => 'no',
                        ),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => 'Animation speed',
                        'param_name'  => 'animation_speed',
                        'value'       => '',
                        'description' => __('Speed of slide animation in miliseconds')
                    )
                )
            ));
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'testimonial_type'  => 'testimonials-grid',
            'number'            => '-1',
            'category'          => '',
            'show_title'        => 'yes',
            'show_author'       => 'yes',
            'show_position'     => 'yes',
            'animation_speed'   => '',
            'dark_light_type'   => '',
            'number_of_columns' => ''
        );

        $params = shortcode_atts($args, $atts);

        //Extract params for use in method
        extract($params);

        $data_attr  = $this->getDataParams($params);
        $query_args = $this->getQueryParams($params);

        $html = '';
        $html .= '<div class="mkdf-testimonials-holder clearfix '.$dark_light_type.'">';

        $slider_variable = '';
        if($params['testimonial_type'] === 'testimonials-slider' || $params['testimonial_type'] === 'testimonials-simple') {
            $slider_variable .= 'mkdf-slider ';
        }
        $html .= '<div class="mkdf-testimonials '.$slider_variable.$testimonial_type.$data_attr.'">';

        $query = new \WP_Query($query_args);
        if($query->have_posts()) :
            while($query->have_posts()) : $query->the_post();
                $author = get_post_meta(get_the_ID(), 'mkdf_testimonial_author', true);
                $text   = get_post_meta(get_the_ID(), 'mkdf_testimonial_text', true);
                $title  = get_post_meta(get_the_ID(), 'mkdf_testimonial_title', true);
                $job    = get_post_meta(get_the_ID(), 'mkdf_testimonial_author_position', true);

                $counter_classes = '';

                if($params['dark_light_type'] == 'light') {
                    $counter_classes .= 'light';
                }

                $params['light_class'] = $counter_classes;


                $params['columns_number'] = $this->getColumnNumberClass($params);

                $params['author']     = $author;
                $params['text']       = $text;
                $params['title']      = $title;
                $params['job']        = $job;
                $params['current_id'] = get_the_ID();

                $html .= mkd_core_get_shortcode_module_template_part('templates/'.$params['testimonial_type'], 'testimonials', '', $params);

            endwhile;
        else:
            $html .= __('Sorry, no posts matched your criteria.', 'mkd_core');
        endif;

        wp_reset_postdata();
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Generates testimonial data attribute array
     *
     * @param $params
     *
     * @return string
     */
    private function getDataParams($params) {
        $data_attr = '';

        if(!empty($params['animation_speed'])) {
            $data_attr .= ' data-animation-speed ="'.$params['animation_speed'].'"';
        }

        return $data_attr;
    }

    /**
     * Generates testimonials query attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function getQueryParams($params) {

        $args = array(
            'post_type'      => 'testimonials',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'posts_per_page' => $params['number']
        );

        if($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }

        return $args;
    }

    private function getColumnNumberClass($params) {

        $columnsNumber = '';
        $columns       = $params['number_of_columns'];

        switch($columns) {
            case 2:
                $columnsNumber = ' mkdf-two-columns';
                break;
            case 3:
                $columnsNumber = ' mkdf-three-columns';
                break;
            case 4:
                $columnsNumber = ' mkdf-four-columns';
                break;
            default:
                $columnsNumber = ' mkdf-three-column';
                break;
        }

        return $columnsNumber;
    }

}