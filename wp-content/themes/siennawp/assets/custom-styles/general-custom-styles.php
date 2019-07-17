<?php
if(!function_exists('sienna_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function sienna_mikado_design_styles() {

        $preload_background_styles = array();

        if(sienna_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.sienna_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo sienna_mikado_dynamic_css('.mkdf-preload-background', $preload_background_styles);

        if(sienna_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = sienna_mikado_options()->getOptionValue('google_fonts');
            if(sienna_mikado_is_font_option_valid($font_family)) {
                echo sienna_mikado_dynamic_css('body', array('font-family' => sienna_mikado_get_font_option_val($font_family)));
            }
        }

        if(sienna_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.mkdf-comment-holder .mkdf-comment-reply-holder a:hover',
                '.mkdf-pagination li.active span',
                '.mkdf-pagination li a:hover',
                '.mkdf-pagination li span:hover',
                '.mkdf-like.liked ',
                'aside.mkdf-sidebar .widget ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_categories ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu .current-menu-item > a',
                '.mkdf-main-menu ul li:hover a',
                '.mkdf-main-menu ul li.mkdf-active-item a',
                '.mkdf-main-menu ul .mkdf-menu-featured-icon',
                '.mkdf-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
                '.mkdf-drop-down .wide .second ul li .flexslider ul li a:hover',
                '.mkdf-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
                '.mkdf-header-vertical .mkdf-vertical-dropdown-float .second .inner ul li a:hover',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav h4:hover',
                '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li > a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li.mkdf-active-item > a:hover',
                'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li > a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-side-menu-button-opener:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-search-opener:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li:hover > a',
                'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li:hover > a',
                '.mkdf-page-header .mkdf-search-opener:hover',
                '.mkdf-page-footer .mkdf-footer-top-holder .widget.widget_categories ul li a:hover',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-side-menu-button-opener:hover',
                'nav.mkdf-fullscreen-menu ul li a:hover',
                'nav.mkdf-fullscreen-menu ul li ul li a',
                '.mkdf-search-cover .mkdf-search-close a:hover',
                '.mkdf-search-slide-header-bottom .mkdf-search-submit:hover',
                '.mkdf-portfolio-single-holder .mkdf-portfolio-info-item h6',
                '.mkdf-portfolio-single-holder .mkdf-portfolio-single-likes .mkdf-like',
                '.mkdf-portfolio-single-holder .mkdf-portfolio-single-nav .mkdf-single-nav-content-holder .mkdf-single-nav-label-holder:hover',
                '.mkdf-team.mkdf-team-main-info-bellow-image .mkdf-team-position',
                '.mkdf-team.mkdf-team-main-info-bellow-image .mkdf-team-social a:hover',
                '.mkdf-counter-holder .mkdf-counter',
                '.countdown-amount',
                '.mkdf-message .mkdf-message-inner a.mkdf-close i:hover',
                '.mkdf-ordered-list ol > li:before',
                '.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner i',
                '.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner .font_elegant',
                '.mkdf-blog-slider-holder .mkdf-bs-item-date',
                '.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-author a:hover',
                '.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-categories a:hover',
                '.mkdf-blog-slider-holder .owl-prev:hover',
                '.mkdf-blog-slider-holder .owl-next:hover',
                '.mkdf-working-hours-holder h2.mkdf-wh-title.mkdf-icon-title:before',
                '.mkdf-testimonials .mkdf-testimonials-job',
                '.mkdf-testimonials-holder-inner .testimonials-grid .mkdf-testimonials-job.light',
                '.mkdf-testimonial-content.testimonials-slider .mkdf-testimonials-job.light',
                '.mkdf-price-table li.mkdf-table-icon',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active .mkdf-accordion-mark',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover .mkdf-accordion-mark',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active .mkdf-accordion-mark',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover .mkdf-accordion-mark',
                '.mkdf-blog-list-holder .mkdf-item-info-section > div > a:hover',
                '.mkdf-blog-list-holder.mkdf-grid-type-2 .mkdf-post-item-author-holder a:hover',
                '.mkdf-blog-list-holder.mkdf-masonry .mkdf-post-item-author-holder a:hover',
                '.mkdf-blog-list-holder.mkdf-image-in-box .mkdf-item-title a:hover',
                '.mkdf-video-button-play .mkdf-video-button-wrapper',
                '.mkdf-dropcaps',
                '.mkdf-social-share-holder ul a:hover',
                '.mkdf-process-holder:hover .mkdf-process-digit',
                '.mkdf-process-holder:hover .mkdf-process-title',
                '.mkdf-icon-progress-bar .mkdf-ipb-active',
                '.mkdf-info-card-carousel .mkdf-info-card-front-side .mkdf-info-card-icon-holder',
                '.no-touch .mkdf-horizontal-timeline .mkdf-timeline-navigation a:hover',
                '.mkdf-social-item-carousel-box .mkdf-social-feed-item-carousel-icon',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.mkdf-woocommerce-page .select2-results .select2-highlighted',
                '.mkdf-woocommerce-page ul.products .product .added_to_cart',
                '.woocommerce ul.products .product .added_to_cart',
                '.mkdf-woocommerce-page ul.products .product .added_to_cart:hover',
                '.woocommerce ul.products .product .added_to_cart:hover',
                '.mkdf-woocommerce-page ul.products .add_to_cart_button',
                '.woocommerce ul.products .add_to_cart_button',
                '.mkdf-woocommerce-page .price',
                '.woocommerce .price',
                '.mkdf-woocommerce-page .mkdf-onsale',
                '.mkdf-woocommerce-page .mkdf-out-of-stock',
                '.woocommerce .mkdf-onsale',
                '.woocommerce .mkdf-out-of-stock',
                '.single-product .mkdf-single-product-summary .price ins',
                '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_layered_nav a:hover',
                '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product-categories a:hover',
                '.mkdf-shopping-cart-dropdown span.mkdf-total span',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
                '.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .woocommerce-shipping-calculator > p a:hover',
                '.mkdf-blog-holder.mkdf-blog-type-masonry .format-quote .mkdf-post-mark',
                '.mkdf-blog-holder.mkdf-blog-type-masonry .format-quote .mkdf-post-mark',
                '.mkdf-blog-holder.mkdf-blog-type-split-column article.format-link h3.mkdf-post-title a:hover',
                '.mkdf-blog-holder.mkdf-blog-type-split-column article.format-link .mkdf-post-mark',
                '.mkdf-blog-holder.mkdf-blog-type-split-column article.format-quote .mkdf-post-title h3 a:hover',
                '.mkdf-blog-holder.mkdf-blog-type-split-column article.format-quote .mkdf-post-mark',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-filter-blog-holder li.mkdf-active',
                'article .mkdf-category span.icon_tags',
                '.mejs-controls .mejs-button button:hover'
            );

            $color_important_selector = array(
                '.mkdf-btn.mkdf-btn-hover-white:not(.mkdf-btn-custom-hover-color):hover',
                '.woocommerce .mkdf-btn-hover-white.button:not(.mkdf-btn-custom-hover-color):hover',
                '.post-password-form input.mkdf-btn-hover-white[type="submit"]:not(.mkdf-btn-custom-hover-color):hover',
                'input.mkdf-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover'
            );

            $background_color_selector = array(
                '.mkdf-st-loader .pulse',
                '.mkdf-st-loader .double_pulse .double-bounce1',
                '.mkdf-st-loader .double_pulse .double-bounce2',
                '.mkdf-st-loader .cube',
                '.mkdf-st-loader .rotating_cubes .cube1',
                '.mkdf-st-loader .rotating_cubes .cube2',
                '.mkdf-st-loader .stripes > div',
                '.mkdf-st-loader .wave > div',
                '.mkdf-st-loader .two_rotating_circles .dot1',
                '.mkdf-st-loader .two_rotating_circles .dot2',
                '.mkdf-st-loader .five_rotating_circles .container1 > div',
                '.mkdf-st-loader .five_rotating_circles .container2 > div',
                '.mkdf-st-loader .five_rotating_circles .container3 > div',
                '.mkdf-st-loader .atom .ball-1:before',
                '.mkdf-st-loader .atom .ball-2:before',
                '.mkdf-st-loader .atom .ball-3:before',
                '.mkdf-st-loader .atom .ball-4:before',
                '.mkdf-st-loader .clock .ball:before',
                '.mkdf-st-loader .mitosis .ball',
                '.mkdf-st-loader .lines .line1',
                '.mkdf-st-loader .lines .line2',
                '.mkdf-st-loader .lines .line3',
                '.mkdf-st-loader .lines .line4',
                '.mkdf-st-loader .fussion .ball',
                '.mkdf-st-loader .fussion .ball-1',
                '.mkdf-st-loader .fussion .ball-2',
                '.mkdf-st-loader .fussion .ball-3',
                '.mkdf-st-loader .fussion .ball-4',
                '.mkdf-st-loader .wave_circles .ball',
                '.mkdf-st-loader .pulse_circles .ball',
                '.mkdf-carousel-pagination .owl-page.active span',
                '#mkdf-back-to-top',
                'aside.mkdf-sidebar .widget .searchform input[type=submit]',
                'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
                'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-main-menu > ul > li > a > span.item_outer:before',
                '.mkdf-top-bar .mkdf-top-bar-widget-inner .mkdf-search-opener',
                '.mkdf-header-vertical .mkdf-vertical-menu > ul > li > a:before',
                '.mkdf-header-vertical .mkdf-vertical-menu > ul > li > a:after',
                '.mkdf-page-footer .mkdf-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a',
                '.mkdf-page-footer .mkdf-footer-top-holder .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-side-menu .widget .searchform input[type=submit]',
                '.mkdf-fullscreen-menu-opener:hover .mkdf-line',
                '.mkdf-fullscreen-menu-opener.opened:hover .mkdf-line:after',
                '.mkdf-fullscreen-menu-opener.opened:hover .mkdf-line:before',
                '.mkdf-icon-shortcode.circle, .mkdf-icon-shortcode.square',
                '.mkdf-progress-bar .mkdf-progress-content-outer .mkdf-progress-content',
                '.mkdf-testimonials.owl-carousel .owl-pagination .owl-page.active span',
                '.mkdf-price-table.mkdf-pt-active .mkdf-price-table-inner',
                '.mkdf-pie-chart-doughnut-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-pie-chart-pie-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-blog-list-holder.mkdf-date-on-side .mkdf-date',
                '.mkdf-btn.mkdf-btn-solid, .woocommerce .button',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.mkdf-dropcaps.mkdf-square, .mkdf-dropcaps.mkdf-circle',
                '.mkdf-comparision-pricing-tables-holder .mkdf-cpt-table .mkdf-cpt-table-btn a',
                '.mkdf-vertical-progress-bar-holder .mkdf-vpb-active-bar',
                '.mkdf-zooming-slider-holder .slick-dots .slick-active button',
                '.mkdf-zooming-slider-holder .slick-dots li:hover button',
                '.mkdf-team-slider-holder .mkdf-team-slider-prev:hover',
                '.mkdf-team-slider-holder .mkdf-team-slider-next:hover',
                '.mkdf-info-card-carousel .mkdf-info-card-number',
                '.no-touch .mkdf-horizontal-timeline .mkdf-horizontal-timeline-events a:hover:after',
                '.mkdf-horizontal-timeline .mkdf-horizontal-timeline-events a.selected:after',
                '.mkdf-horizontal-timeline .mkdf-horizontal-timeline-filling-line',
                '.widget_mkdf_call_to_action_button .mkdf-call-to-action-button',
                '.mkdf-shopping-cart-outer .mkdf-shopping-cart-header .mkdf-cart-count',
                '.mkdf-blog-holder.mkdf-blog-type-standard .format-quote .mkdf-post-content .mkdf-post-text',
                '.mkdf-blog-holder.mkdf-blog-type-standard .format-link .mkdf-post-content .mkdf-post-text',
                '.mkdf-blog-date-on-side .mkdf-date-format',
                '.mkdf-blog-date-on-side .format-link .mkdf-post-mark',
                '.mkdf-blog-date-on-side .format-quote .mkdf-post-mark',
                '.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard article.format-quote .mkdf-post-content .mkdf-post-text',
                '.mkdf-blog-holder.mkdf-blog-single.mkdf-blog-standard article.format-link .mkdf-post-content .mkdf-post-text',
                '.single .mkdf-blog-date-on-side .mkdf-post-content .mkdf-category-on-image a:hover',
                '.single .mkdf-single-tags-holder .mkdf-tags a'
            );

            $background_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-hover-solid:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                '.woocommerce .mkdf-btn-hover-solid.button:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"]:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                '.mkdf-btn.mkdf-btn-hover-solid .mkdf-btn-helper, .woocommerce .mkdf-btn-hover-solid.button .mkdf-btn-helper',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"] .mkdf-btn-helper',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit .mkdf-btn-helper',
                '.mkdf-woocommerce-page .price_slider_amount button.button',
                '.woocommerce .price_slider_amount button.button'
            );

            $border_color_selector = array(
                '.mkdf-st-loader .pulse_circles .ball',
                'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
                'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-page-footer .mkdf-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a',
                '.mkdf-page-footer .mkdf-footer-top-holder .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover',
                '.no-touch .mkdf-horizontal-timeline .mkdf-horizontal-timeline-events a:hover:after',
                '.mkdf-horizontal-timeline .mkdf-horizontal-timeline-events a.selected:after',
                '.mkdf-horizontal-timeline .mkdf-horizontal-timeline-events a.older-event:after',
                '.mkdf-woocommerce-page .price_slider_amount button.button',
                '.woocommerce .price_slider_amount button.button',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus',
                '.single .mkdf-single-tags-holder .mkdf-tags a'
            );

            $border_color_border_top_selector = array(
                '.mkdf-progress-bar .mkdf-progress-number-wrapper.mkdf-floating .mkdf-down-arrow'
            );

            $border_color_border_bottom_selector = array(
                '.mkdf-tabs .mkdf-tabs-nav li.ui-state-active a'
            );

            $border_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-hover-solid:not(.mkdf-btn-custom-border-hover):hover',
                '.woocommerce .mkdf-btn-hover-solid.button:not(.mkdf-btn-custom-border-hover):hover',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"]:not(.mkdf-btn-custom-border-hover):hover',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover'
            );
            echo sienna_mikado_dynamic_css($color_selector, array('color' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css($color_important_selector, array('color' => sienna_mikado_options()->getOptionValue('first_color').'!important'));
            echo sienna_mikado_dynamic_css('::selection', array('background' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css('::-moz-selection', array('background' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css($background_color_selector, array('background-color' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css($background_color_important_selector, array('background-color' => sienna_mikado_options()->getOptionValue('first_color').'!important'));
            echo sienna_mikado_dynamic_css($border_color_selector, array('border-color' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css($border_color_important_selector, array('border-color' => sienna_mikado_options()->getOptionValue('first_color').'!important'));
            echo sienna_mikado_dynamic_css($border_color_border_top_selector, array('border-top-color' => sienna_mikado_options()->getOptionValue('first_color')));
            echo sienna_mikado_dynamic_css($border_color_border_bottom_selector, array('border-bottom-color' => sienna_mikado_options()->getOptionValue('first_color')));
        }

        if(sienna_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkdf-wrapper-inner',
                '.mkdf-content'
            );
            echo sienna_mikado_dynamic_css($background_color_selector, array('background-color' => sienna_mikado_options()->getOptionValue('page_background_color')));
        }

        if(sienna_mikado_options()->getOptionValue('selection_color')) {
            echo sienna_mikado_dynamic_css('::selection', array('background' => sienna_mikado_options()->getOptionValue('selection_color')));
            echo sienna_mikado_dynamic_css('::-moz-selection', array('background' => sienna_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if(sienna_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = sienna_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(sienna_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(sienna_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(sienna_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(sienna_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(sienna_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (sienna_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

        echo sienna_mikado_dynamic_css('.mkdf-boxed .mkdf-wrapper', $boxed_background_style);
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_design_styles');
}

if(!function_exists('sienna_mikado_h1_styles')) {

    function sienna_mikado_h1_styles() {

        $h1_styles = array();

        if(sienna_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = sienna_mikado_options()->getOptionValue('h1_color');
        }
        if(sienna_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = sienna_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if(!empty($h1_styles)) {
            echo sienna_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h1_styles');
}

if(!function_exists('sienna_mikado_h2_styles')) {

    function sienna_mikado_h2_styles() {

        $h2_styles = array();

        if(sienna_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = sienna_mikado_options()->getOptionValue('h2_color');
        }
        if(sienna_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = sienna_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if(!empty($h2_styles)) {
            echo sienna_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h2_styles');
}

if(!function_exists('sienna_mikado_h3_styles')) {

    function sienna_mikado_h3_styles() {

        $h3_styles = array();

        if(sienna_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = sienna_mikado_options()->getOptionValue('h3_color');
        }
        if(sienna_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = sienna_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if(!empty($h3_styles)) {
            echo sienna_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h3_styles');
}

if(!function_exists('sienna_mikado_h4_styles')) {

    function sienna_mikado_h4_styles() {

        $h4_styles = array();

        if(sienna_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = sienna_mikado_options()->getOptionValue('h4_color');
        }
        if(sienna_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = sienna_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if(!empty($h4_styles)) {
            echo sienna_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h4_styles');
}

if(!function_exists('sienna_mikado_h5_styles')) {

    function sienna_mikado_h5_styles() {

        $h5_styles = array();

        if(sienna_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = sienna_mikado_options()->getOptionValue('h5_color');
        }
        if(sienna_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = sienna_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if(!empty($h5_styles)) {
            echo sienna_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h5_styles');
}

if(!function_exists('sienna_mikado_h6_styles')) {

    function sienna_mikado_h6_styles() {

        $h6_styles = array();

        if(sienna_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = sienna_mikado_options()->getOptionValue('h6_color');
        }
        if(sienna_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = sienna_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = sienna_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = sienna_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if(!empty($h6_styles)) {
            echo sienna_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_h6_styles');
}

if(!function_exists('sienna_mikado_text_styles')) {

    function sienna_mikado_text_styles() {

        $text_styles = array();

        if(sienna_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = sienna_mikado_options()->getOptionValue('text_color');
        }
        if(sienna_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = sienna_mikado_get_formatted_font_family(sienna_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(sienna_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(sienna_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = sienna_mikado_options()->getOptionValue('text_texttransform');
        }
        if(sienna_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = sienna_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = sienna_mikado_options()->getOptionValue('text_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = sienna_mikado_filter_px(sienna_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if(!empty($text_styles)) {
            echo sienna_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_text_styles');
}

if(!function_exists('sienna_mikado_link_styles')) {

    function sienna_mikado_link_styles() {

        $link_styles = array();

        if(sienna_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = sienna_mikado_options()->getOptionValue('link_color');
        }
        if(sienna_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = sienna_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(sienna_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = sienna_mikado_options()->getOptionValue('link_fontweight');
        }
        if(sienna_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = sienna_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if(!empty($link_styles)) {
            echo sienna_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_link_styles');
}

if(!function_exists('sienna_mikado_link_hover_styles')) {

    function sienna_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(sienna_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = sienna_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(sienna_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = sienna_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if(!empty($link_hover_styles)) {
            echo sienna_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(sienna_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = sienna_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if(!empty($link_heading_hover_styles)) {
            echo sienna_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_link_hover_styles');
}

if(!function_exists('sienna_mikado_smooth_page_transition_styles')) {

    function sienna_mikado_smooth_page_transition_styles() {

        $loader_style = array();

        if(sienna_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = sienna_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkdf-smooth-transition-loader');

        if(!empty($loader_style)) {
            echo sienna_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(sienna_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = sienna_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkdf-st-loader .pulse',
            '.mkdf-st-loader .double_pulse .double-bounce1',
            '.mkdf-st-loader .double_pulse .double-bounce2',
            '.mkdf-st-loader .cube',
            '.mkdf-st-loader .rotating_cubes .cube1',
            '.mkdf-st-loader .rotating_cubes .cube2',
            '.mkdf-st-loader .stripes > div',
            '.mkdf-st-loader .wave > div',
            '.mkdf-st-loader .two_rotating_circles .dot1',
            '.mkdf-st-loader .two_rotating_circles .dot2',
            '.mkdf-st-loader .five_rotating_circles .container1 > div',
            '.mkdf-st-loader .five_rotating_circles .container2 > div',
            '.mkdf-st-loader .five_rotating_circles .container3 > div',
            '.mkdf-st-loader .atom .ball-1:before',
            '.mkdf-st-loader .atom .ball-2:before',
            '.mkdf-st-loader .atom .ball-3:before',
            '.mkdf-st-loader .atom .ball-4:before',
            '.mkdf-st-loader .clock .ball:before',
            '.mkdf-st-loader .mitosis .ball',
            '.mkdf-st-loader .lines .line1',
            '.mkdf-st-loader .lines .line2',
            '.mkdf-st-loader .lines .line3',
            '.mkdf-st-loader .lines .line4',
            '.mkdf-st-loader .fussion .ball',
            '.mkdf-st-loader .fussion .ball-1',
            '.mkdf-st-loader .fussion .ball-2',
            '.mkdf-st-loader .fussion .ball-3',
            '.mkdf-st-loader .fussion .ball-4',
            '.mkdf-st-loader .wave_circles .ball',
            '.mkdf-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            echo sienna_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }
    }

    add_action('sienna_mikado_style_dynamic', 'sienna_mikado_smooth_page_transition_styles');
}