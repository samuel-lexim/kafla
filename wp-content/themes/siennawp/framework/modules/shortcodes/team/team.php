<?php
namespace Sienna\Modules\Team;

use Sienna\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Team
 */
class Team implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Team constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_team';

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
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        $team_social_icons_array = array();
        for($x = 1; $x < 6; $x++) {
            $teamIconCollections = sienna_mikado_icon_collections()->getCollectionsWithSocialIcons();
            foreach($teamIconCollections as $collection_key => $collection) {

                $team_social_icons_array[] = array(
                    'type'       => 'dropdown',
                    'heading'    => 'Social Icon '.$x,
                    'param_name' => 'team_social_'.$collection->param.'_'.$x,
                    'value'      => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
                );

            }

            $team_social_icons_array[] = array(
                'type'       => 'textfield',
                'heading'    => 'Social Icon '.$x.' Link',
                'param_name' => 'team_social_icon_'.$x.'_link',
                'dependency' => array(
                    'element' => 'team_social_icon_pack',
                    'value'   => sienna_mikado_icon_collections()->getIconCollectionsKeys()
                )
            );

            $team_social_icons_array[] = array(
                'type'       => 'dropdown',
                'heading'    => 'Social Icon '.$x.' Target',
                'param_name' => 'team_social_icon_'.$x.'_target',
                'value'      => array(
                    ''      => '',
                    'Self'  => '_self',
                    'Blank' => '_blank'
                ),
                'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
            );

        }

        vc_map(array(
            'name'                      => 'Team',
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-team extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Image',
                        'param_name' => 'team_image'
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Name',
                        'admin_label' => true,
                        'param_name'  => 'team_name'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => 'Name Tag',
                        'param_name' => 'team_name_tag',
                        'value'      => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'team_name', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Position',
                        'admin_label' => true,
                        'param_name'  => 'team_position'
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => 'Description',
                        'admin_label' => true,
                        'param_name'  => 'team_description'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Disable Box Border?',
                        'admin_label' => true,
                        'param_name'  => 'disable_box_border',
                        'value'       => array(
                            'No'  => 'no',
                            'Yes' => 'yes'
                        )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Set Background Color for Team Box',
                        'admin_label' => true,
                        'param_name'  => 'background_color',
                        'value'       => array(
                            'White' => 'white',
                            'Grey'  => 'grey'
                        )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Social Icon Pack',
                        'param_name'  => 'team_social_icon_pack',
                        'admin_label' => true,
                        'value'       => array_merge(array('' => ''), sienna_mikado_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Social Icons Type',
                        'param_name'  => 'team_social_icon_type',
                        'value'       => array(
                            'Normal' => 'normal',
                            'Circle' => 'circle',
                            'Square' => 'square'
                        ),
                        'save_always' => true,
                        'dependency'  => array(
                            'element' => 'team_social_icon_pack',
                            'value'   => sienna_mikado_icon_collections()->getIconCollectionsKeys()
                        )
                    ),
                ),
                $team_social_icons_array
            )
        ));

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
            'team_image'            => '',
            'team_name'             => '',
            'team_name_tag'         => 'h5',
            'team_position'         => '',
            'team_description'      => '',
            'team_social_icon_pack' => '',
            'background_color'      => '',
            'team_social_icon_type' => 'normal_social',
            'disable_box_border'    => ''
        );

        $team_social_icons_form_fields = array();
        $number_of_social_icons        = 5;

        for($x = 1; $x <= $number_of_social_icons; $x++) {
            foreach(sienna_mikado_icon_collections()->iconCollections as $collection_key => $collection) {
                $team_social_icons_form_fields['team_social_'.$collection->param.'_'.$x] = '';
            }

            $team_social_icons_form_fields['team_social_icon_'.$x.'_link']   = '';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';
        }

        $args = array_merge($args, $team_social_icons_form_fields);

        $params = shortcode_atts($args, $atts);

        $params['number_of_social_icons'] = 5;
        $params['team_name_tag']          = $this->getTeamNameTag($params, $args);
        $params['team_image_src']         = $this->getTeamImage($params);
        $params['team_social_icons']      = $this->getTeamSocialIcons($params);
        $params['holder_classes']         = $this->getHolderClasses($params);

        //Get HTML from template based on type of team
        return sienna_mikado_get_shortcode_module_template_part('templates/main-info-bellow-image', 'team', '', $params);
    }

    /**
     * Return correct heading value. If provided heading isn't valid get the default one
     *
     * @param $params
     * @param $args
     *
     * @return mixed
     */
    private function getTeamNameTag($params, $args) {

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

    }

    /**
     * Return Team image
     *
     * @param $params
     *
     * @return false|string
     */
    private function getTeamImage($params) {

        if(is_numeric($params['team_image'])) {
            $team_image_src = wp_get_attachment_url($params['team_image']);
        } else {
            $team_image_src = $params['team_image'];
        }

        return $team_image_src;

    }

    /**
     * @param $params
     *
     * @return array
     */
    private function getTeamSocialIcons($params) {

        extract($params);
        $social_icons = array();

        if($team_social_icon_pack !== '') {

            $icon_pack                    = sienna_mikado_icon_collections()->getIconCollection($team_social_icon_pack);
            $team_social_icon_type_label  = 'team_social_'.$icon_pack->param;
            $team_social_icon_param_label = $icon_pack->param;

            for($i = 1; $i <= $number_of_social_icons; $i++) {

                $team_social_icon   = ${$team_social_icon_type_label.'_'.$i};
                $team_social_link   = ${'team_social_icon_'.$i.'_link'};
                $team_social_target = ${'team_social_icon_'.$i.'_target'};

                if($team_social_icon !== '') {

                    $team_icon_params                                = array();
                    $team_icon_params['icon_pack']                   = $team_social_icon_pack;
                    $team_icon_params[$team_social_icon_param_label] = $team_social_icon;
                    $team_icon_params['link']                        = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target']                      = ($team_social_target !== '') ? $team_social_target : '';
                    $team_icon_params['type']                        = ($team_social_icon_type !== '') ? $team_social_icon_type : '';

                    $social_icons[] = sienna_mikado_execute_shortcode('mkdf_icon', $team_icon_params);
                }

            }

        }

        return $social_icons;
    }

    /**
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array(
            'mkdf-team',
            'mkdf-team-main-info-bellow-image'
        );

        if($params['disable_box_border'] === 'yes') {
            $classes[] = 'mkdf-team-main-info-disable-border';
        }

        if($params['background_color'] === 'grey') {
            $classes[] = 'mkdf-grey';
        }

        return $classes;
    }
}