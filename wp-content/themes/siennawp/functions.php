<?php
include_once get_template_directory() . '/theme-includes.php';

if (!function_exists('sienna_mikado_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function sienna_mikado_styles()
    {
        wp_register_style('sienna_mikado_blog', MIKADO_ASSETS_ROOT . '/css/blog.min.css');

        //include theme's core styles
        wp_enqueue_style('sienna_mikado_default_style', MIKADO_ROOT . '/style.css');
        wp_enqueue_style('sienna_mikado_modules_plugins', MIKADO_ASSETS_ROOT . '/css/plugins.min.css');

        if (sienna_mikado_load_blog_assets() || is_singular('portfolio-item')) {
            wp_enqueue_style('wp-mediaelement');
        }

        wp_enqueue_style('sienna_mikado_modules', MIKADO_ASSETS_ROOT . '/css/modules.min.css');

        sienna_mikado_icon_collections()->enqueueStyles();

        if (sienna_mikado_load_blog_assets()) {
            wp_enqueue_style('sienna_mikado_blog');
        }


        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if (sienna_mikado_load_woo_assets() || sienna_mikado_is_ajax_enabled()) {
            $style_dynamic_deps_array = array('mkd_woocommerce', 'mkd_woocommerce_responsive');
        }

        if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css') && sienna_mikado_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('sienna_mikado_style_dynamic', MIKADO_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if (sienna_mikado_is_responsive_on()) {
            wp_enqueue_style('sienna_mikado_modules_responsive', MIKADO_ASSETS_ROOT . '/css/modules-responsive.min.css');
            wp_enqueue_style('sienna_mikado_blog_responsive', MIKADO_ASSETS_ROOT . '/css/blog-responsive.min.css');

            //include proper styles
            if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css') && sienna_mikado_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('sienna_mikado_style_dynamic_responsive', MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css'));
            }
        }

        //include Visual Composer styles
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_styles');
	

	
	
}

if (!function_exists('sienna_mikado_google_fonts_styles')) {
    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function sienna_mikado_google_fonts_styles()
    {
        $font_simple_field_array = sienna_mikado_options()->getOptionsByType('fontsimple');
        if (!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = sienna_mikado_options()->getOptionsByType('font');
        if (!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach ($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = sienna_mikado_options()->getOptionValue($font_option);
            if (sienna_mikado_is_font_option_valid($font_option_value) && !sienna_mikado_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value . ':' . $font_weight_str;
                if (!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array = array_diff($fonts_array, array('-1:' . $font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Hind:' . $font_weight_str . '|Hind:' . $font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $sienna_mikado_fonts = add_query_arg($fonts_full_list_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('sienna_mikado_google_fonts', esc_url_raw($sienna_mikado_fonts), array(), '1.0.0');

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $sienna_mikado_fonts = add_query_arg($default_fonts_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('sienna_mikado_google_fonts', esc_url_raw($sienna_mikado_fonts), array(), '1.0.0');
        }

    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_google_fonts_styles');
}

if (!function_exists('sienna_mikado_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function sienna_mikado_scripts()
    {
        global $wp_scripts;

        //init theme core scripts
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('wp-mediaelement');

        wp_enqueue_script('sienna_mikado_third_party', MIKADO_ASSETS_ROOT . '/js/third-party.min.js', array('jquery'), false, true);
        wp_enqueue_script('isotope', MIKADO_ASSETS_ROOT . '/js/jquery.isotope.min.js', array('jquery'), false, true);

        if (sienna_mikado_is_smoth_scroll_enabled()) {
            wp_enqueue_script("smoothPageScroll", MIKADO_ASSETS_ROOT . "/js/smoothPageScroll.js", array(), false, true);
        }

        //include google map api script
        wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js', array(), false, true);

        wp_enqueue_script('auto-play-video_api', '//cdnjs.cloudflare.com/ajax/libs/vissense/0.9.0/vissense.js', array(), false, true);

        wp_enqueue_script('sienna_mikado_modules', MIKADO_ASSETS_ROOT . '/js/modules.min.js', array('jquery'), false, true);

        wp_enqueue_script('slick', MIKADO_ASSETS_ROOT . '/js/slick.min.js', array('jquery'), false, true);

        wp_enqueue_script('hoa-custom_modules', MIKADO_ASSETS_ROOT . '/js/hoa-custom.js', array('jquery'), false, true);

        wp_enqueue_script('pagination-custom_modules', MIKADO_ASSETS_ROOT . '/js/jquery.easyPaginate.js', array('jquery'), false, true);

        if (sienna_mikado_load_blog_assets()) {
            wp_enqueue_script('sienna_mikado_blog', MIKADO_ASSETS_ROOT . '/js/blog.min.js', array('jquery'), false, true);
        }

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if (is_singular()) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_scripts');
}

if (!function_exists('sienna_mikado_is_ajax_enabled')) {
    /**
     * Function that checks if ajax is enabled
     */
    function sienna_mikado_is_ajax_enabled()
    {

        return sienna_mikado_options()->getOptionValue('smooth_page_transitions') === 'yes' && sienna_mikado_options()->getOptionValue('smooth_pt_true_ajax') != 'no';

    }
}

if (!function_exists('sienna_mikado_ajax_meta')) {
    /**
     * Function that echoes meta data for ajax
     *
     * @since 4.3
     * @version 0.2
     */
    function sienna_mikado_ajax_meta()
    {

        $id = sienna_mikado_get_page_id();

        $page_transition = get_post_meta($id, "mkdf_page_transition_type", true);
        ?>

        <div class="mkdf-seo-title"><?php echo wp_get_document_title(); ?></div>

        <?php if ($page_transition !== '') { ?>
        <div class="mkdf-page-transition"><?php echo esc_html($page_transition); ?></div>
    <?php } else if (sienna_mikado_options()->getOptionValue('default_page_transition')) { ?>
        <div class="mkdf-page-transition"><?php echo esc_html(sienna_mikado_options()->getOptionValue('default_page_transition')); ?></div>
    <?php }
    }

    add_action('sienna_mikado_ajax_meta', 'sienna_mikado_ajax_meta');
}

if (!function_exists('sienna_mikado_no_ajax_pages')) {
    /**
     * Function that echoes pages on which ajax should not be applied
     *
     * @since 4.3
     * @version 0.2
     */
    function sienna_mikado_no_ajax_pages($global_variables)
    {

        //is ajax enabled?
        if (sienna_mikado_is_ajax_enabled()) {
            $no_ajax_pages = array();

            //get posts that have ajax disabled and merge with main array
            $no_ajax_pages = array_merge($no_ajax_pages, sienna_mikado_get_objects_without_ajax());

            //is wpml installed?
            if (sienna_mikado_is_wpml_installed()) {
                //get translation pages for current page and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, sienna_mikado_get_wpml_pages_for_current_page());
            }

            //is woocommerce installed?
            if (sienna_mikado_is_woocommerce_installed()) {
                //get all woocommerce pages and products and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, sienna_mikado_get_woocommerce_pages());
            }
            //do we have some internal pages that want to be without ajax?
            if (sienna_mikado_options()->getOptionValue('internal_no_ajax_links') !== '') {
                //get array of those pages
                $options_no_ajax_pages_array = explode(',', sienna_mikado_options()->getOptionValue('internal_no_ajax_links'));

                if (is_array($options_no_ajax_pages_array) && count($options_no_ajax_pages_array)) {
                    $no_ajax_pages = array_merge($no_ajax_pages, $options_no_ajax_pages_array);
                }
            }

            //add logout url to main array
            $no_ajax_pages[] = htmlspecialchars_decode(wp_logout_url());

            $global_variables['no_ajax_pages'] = $no_ajax_pages;
        }

        return $global_variables;
    }

    add_filter('sienna_mikado_js_global_variables', 'sienna_mikado_no_ajax_pages');
}

if (!function_exists('sienna_mikado_get_objects_without_ajax')) {
    /**
     * Function that returns urls of objects that have ajax disabled.
     * Works for posts, pages and portfolio pages.
     * @return array array of urls of posts that have ajax disabled
     *
     * @version 0.1
     */
    function sienna_mikado_get_objects_without_ajax()
    {
        $posts_without_ajax = array();

        $posts_args = array(
            'post_type' => array('post', 'portfolio-item', 'page'),
            'post_status' => 'publish',
            'meta_key' => 'mkdf_page_transition_type',
            'meta_value' => 'no-animation'
        );

        $posts_query = new WP_Query($posts_args);

        if ($posts_query->have_posts()) {
            while ($posts_query->have_posts()) {
                $posts_query->the_post();
                $posts_without_ajax[] = get_permalink(get_the_ID());
            }
        }

        wp_reset_postdata();

        return $posts_without_ajax;
    }
}


//defined content width variable
if (!isset($content_width)) {
    $content_width = 1060;
}

if (!function_exists('sienna_mikado_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function sienna_mikado_theme_setup()
    {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        if (function_exists('_wp_render_title_tag')) {
            add_theme_support('title-tag');
        }

        //define thumbnail sizes
        add_image_size('sienna_mikado_square', 550, 550, true);
        add_image_size('sienna_mikado_landscape', 800, 600, true);
        add_image_size('sienna_mikado_portrait', 600, 800, true);
        add_image_size('sienna_mikado_large_width', 1125, 550, true);
        add_image_size('sienna_mikado_large_height', 550, 1125, true);
        add_image_size('sienna_mikado_large_width_height', 1125, 1125, true);

        load_theme_textdomain('sienna', get_template_directory() . '/languages');
    }

    add_action('after_setup_theme', 'sienna_mikado_theme_setup');
}


if (!function_exists('sienna_mikado_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function sienna_mikado_rgba_color($color, $transparency)
    {
        if ($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = sienna_mikado_hex2rgb($color);
            $rgba_color .= 'rgba(' . implode(', ', $rgb_color_array) . ', ' . $transparency . ')';

            return $rgba_color;
        }
        return '';
    }
}

if (!function_exists('sienna_mikado_wp_title_text')) {
    /**
     * Function that sets page's title. Hooks to wp_title filter
     *
     * @param $title string current page title
     * @param $sep string title separator
     *
     * @return string changed title text if SEO plugins aren't installed
     */
    function sienna_mikado_wp_title_text($title, $sep)
    {

        //is SEO plugin installed?
        if (sienna_mikado_seo_plugin_installed()) {
            //don't do anything, seo plugin will take care of it
        } else {
            //get current post id
            $id = sienna_mikado_get_page_id();
            $sep = ' | ';
            $title_prefix = get_bloginfo('name');
            $title_suffix = '';

            //is WooCommerce installed and is current page shop page?
            if (sienna_mikado_is_woocommerce_installed() && sienna_mikado_is_woocommerce_shop()) {
                //get shop page id
                $id = sienna_mikado_get_woo_shop_page_id();
            }

            //is WP 4.1 at least?
            if (function_exists('_wp_render_title_tag')) {
                //set unchanged title variable so we can use it later
                $title_array = explode($sep, $title);
                $unchanged_title = array_shift($title_array);
            } //pre 4.1 version of WP
            else {
                //set unchanged title variable so we can use it later
                $unchanged_title = $title;
            }

            //title suffix is empty, which means that it wasn't set by mkd seo
            if (empty($title_suffix)) {
                //if current page is front page append site description, else take original title string
                $title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
            }

            //concatenate title string
            $title = $title_prefix . $sep . $title_suffix;

            //return generated title string
            return $title;
        }
    }

    add_filter('wp_title', 'sienna_mikado_wp_title_text', 10, 2);
}

if (!function_exists('sienna_mikado_wp_title')) {
    /**
     * Function that outputs title tag. It checks if _wp_render_title_tag function exists
     * and if it does'nt it generates output. Compatible with versions of WP prior to 4.1
     */
    function sienna_mikado_wp_title()
    {
        if (!function_exists('_wp_render_title_tag')) { ?>
            <title><?php wp_title(''); ?></title>
        <?php }
    }
}

if (!function_exists('sienna_mikado_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function sienna_mikado_header_meta()
    { ?>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php }

    add_action('sienna_mikado_header_meta', 'sienna_mikado_header_meta');
}

if (!function_exists('sienna_mikado_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to sienna_mikado_header_meta action
     */
    function sienna_mikado_user_scalable_meta()
    {
        //is responsiveness option is chosen?
        if (sienna_mikado_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=no">
        <?php }
    }

    add_action('sienna_mikado_header_meta', 'sienna_mikado_user_scalable_meta');
}

if (!function_exists('sienna_mikado_get_page_id')) {
    /**
     * Function that returns current page / post id.
     * Checks if current page is woocommerce page and returns that id if it is.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     * @see sienna_mikado_is_woocommerce_installed()
     * @see sienna_mikado_is_woocommerce_shop()
     */
    function sienna_mikado_get_page_id()
    {
        if (sienna_mikado_is_woocommerce_installed() && sienna_mikado_is_woocommerce_shop()) {
            return sienna_mikado_get_woo_shop_page_id();
        }

        if (is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
            return -1;
        }

        return get_queried_object_id();
    }
}


if (!function_exists('sienna_mikado_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function sienna_mikado_is_default_wp_template()
    {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if (!function_exists('sienna_mikado_get_page_template_name')) {
    /**
     * Returns current template file name without extension
     * @return string name of current template file
     */
    function sienna_mikado_get_page_template_name()
    {
        $file_name = '';

        if (!sienna_mikado_is_default_wp_template()) {
            $file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

            if ($file_name_without_ext !== '') {
                $file_name = $file_name_without_ext;
            }
        }

        return $file_name;
    }
}

if (!function_exists('sienna_mikado_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function sienna_mikado_has_shortcode($shortcode, $content = '')
    {
        $has_shortcode = false;

        if ($shortcode) {
            //if content variable isn't past
            if ($content == '') {
                //take content from current post
                $page_id = sienna_mikado_get_page_id();
                if (!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if (is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if (stripos($content, '[' . $shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if (!function_exists('sienna_mikado_rewrite_rules_on_theme_activation')) {
    /**
     * Function that flushes rewrite rules on deactivation
     */
    function sienna_mikado_rewrite_rules_on_theme_activation()
    {
        flush_rewrite_rules();
    }

    add_action('after_switch_theme', 'sienna_mikado_rewrite_rules_on_theme_activation');
}

if (!function_exists('sienna_mikado_get_dynamic_sidebar')) {
    /**
     * Return Custom Widget Area content
     *
     * @return string
     */
    function sienna_mikado_get_dynamic_sidebar($index = 1)
    {
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();

        return $sidebar_contents;
    }
}

if (!function_exists('sienna_mikado_get_sidebar')) {
    /**
     * Return Sidebar
     *
     * @return string
     */
    function sienna_mikado_get_sidebar()
    {

        $id = sienna_mikado_get_page_id();

        $sidebar = "sidebar";

        if (get_post_meta($id, 'mkdf_custom_sidebar_meta', true) != '') {
            $sidebar = get_post_meta($id, 'mkdf_custom_sidebar_meta', true);
        } else {
            if (is_single() && sienna_mikado_options()->getOptionValue('blog_single_custom_sidebar') != '') {
                $sidebar = esc_attr(sienna_mikado_options()->getOptionValue('blog_single_custom_sidebar'));
            } elseif ((is_archive() || (is_home() && is_front_page())) && sienna_mikado_options()->getOptionValue('blog_custom_sidebar') != '') {
                $sidebar = esc_attr(sienna_mikado_options()->getOptionValue('blog_custom_sidebar'));
            } elseif (is_page() && sienna_mikado_options()->getOptionValue('page_custom_sidebar') != '') {
                $sidebar = esc_attr(sienna_mikado_options()->getOptionValue('page_custom_sidebar'));
            }
        }

        return apply_filters('sienna_mikado_sidebar', $sidebar);
    }
}


if (!function_exists('sienna_mikado_sidebar_columns_class')) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */

    function sienna_mikado_sidebar_columns_class()
    {

        $sidebar_class = array();
        $sidebar_layout = sienna_mikado_sidebar_layout();

        switch ($sidebar_layout):
            case 'sidebar-33-right':
                $sidebar_class[] = 'mkdf-two-columns-66-33';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'mkdf-two-columns-75-25';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'mkdf-two-columns-33-66';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'mkdf-two-columns-25-75';
                break;

        endswitch;

        $sidebar_class[] = 'clearfix';

        return sienna_mikado_class_attribute($sidebar_class);

    }
}

if (!function_exists('sienna_mikado_get_content_sidebar_class')) {
    /**
     * @return string
     */
    function sienna_mikado_get_content_sidebar_class()
    {
        $sidebar_layout = sienna_mikado_sidebar_layout();
        $content_class = array('mkdf-page-content-holder');

        switch ($sidebar_layout) {
            case 'sidebar-33-right':
                $content_class[] = 'mkdf-grid-col-8';
                break;
            case 'sidebar-25-right':
                $content_class[] = 'mkdf-grid-col-9';
                break;
            case 'sidebar-33-left':
                $content_class[] = 'mkdf-grid-col-8';
                $content_class[] = 'mkdf-grid-col-push-4';
                break;
            case 'sidebar-25-left':
                $content_class[] = 'mkdf-grid-col-9';
                $content_class[] = 'mkdf-grid-col-push-3';
                break;
            default:
                $content_class[] = 'mkdf-grid-col-12';
                break;
        }

        return sienna_mikado_get_class_attribute($content_class);
    }
}

if (!function_exists('sienna_mikado_get_sidebar_holder_class')) {
    /**
     * @return string
     */
    function sienna_mikado_get_sidebar_holder_class()
    {
        $sidebar_layout = sienna_mikado_sidebar_layout();
        $sidebar_class = array('mkdf-sidebar-holder');

        switch ($sidebar_layout) {
            case 'sidebar-33-right':
                $sidebar_class[] = 'mkdf-grid-col-4';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'mkdf-grid-col-3';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'mkdf-grid-col-4';
                $sidebar_class[] = 'mkdf-grid-col-pull-8';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'mkdf-grid-col-3';
                $sidebar_class[] = 'mkdf-grid-col-pull-9';
                break;
        }

        return sienna_mikado_get_class_attribute($sidebar_class);
    }
}


if (!function_exists('sienna_mikado_sidebar_layout')) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */

    function sienna_mikado_sidebar_layout()
    {

        $sidebar_layout = '';
        $page_id = sienna_mikado_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'mkdf_sidebar_meta', true);

        if (($page_sidebar_meta !== '') && $page_id !== -1) {
            $sidebar_layout = $page_sidebar_meta !== 'no-sidebar' ? $page_sidebar_meta : '';
        } else {
            if (is_single() && sienna_mikado_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(sienna_mikado_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif ((is_archive() || (is_home() && is_front_page())) && sienna_mikado_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(sienna_mikado_options()->getOptionValue('archive_sidebar_layout'));
            } elseif (is_page() && sienna_mikado_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(sienna_mikado_options()->getOptionValue('page_sidebar_layout'));
            }
        }

        return apply_filters('sienna_mikado_sidebar_layout', $sidebar_layout);
    }

}


if (!function_exists('sienna_mikado_page_custom_style')) {

    /**
     * Function that print custom page style
     */

    function sienna_mikado_page_custom_style()
    {
        $style = '';
        $html = '';
        $style = apply_filters('sienna_mikado_add_page_custom_style', $style);
        if (is_array($style) && count($style)) {
            $html .= '<style type="text/css">';
            $html .= implode(' ', $style);
            $html .= '</style>';
        }

        print $html;
    }
}

if (!function_exists('sienna_mikado_register_page_custom_style')) {

    /**
     * Function that print custom page style
     */

    function sienna_mikado_register_page_custom_style()
    {
        add_action((sienna_mikado_is_ajax_enabled() && sienna_mikado_is_ajax_request()) ? 'sienna_mikado_ajax_meta' : 'wp_head', 'sienna_mikado_page_custom_style');
    }

    add_action('sienna_mikado_after_options_map', 'sienna_mikado_register_page_custom_style');
}


if (!function_exists('sienna_mikado_vc_custom_style')) {

    /**
     * Function that print custom page style
     */

    function sienna_mikado_vc_custom_style()
    {
        if (sienna_mikado_visual_composer_installed()) {
            $id = sienna_mikado_get_page_id();
            if (is_page() || is_single() || is_singular('portfolio-item')) {

                $shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
                if (!empty($shortcodes_custom_css)) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css-' . esc_attr($id) . '">';
                    echo get_post_meta($id, '_wpb_shortcodes_custom_css', true);
                    echo '</style>';
                }

                $post_custom_css = get_post_meta($id, '_wpb_post_custom_css', true);
                if (!empty($post_custom_css)) {
                    echo '<style type="text/css" data-type="vc_custom-css-' . esc_attr($id) . '">';
                    echo get_post_meta($id, '_wpb_post_custom_css', true);
                    echo '</style>';
                }
            }
        }
    }

}


if (!function_exists('sienna_mikado_register_vc_custom_style')) {

    /**
     * Function that print custom page style
     */

    function sienna_mikado_register_vc_custom_style()
    {
        if (sienna_mikado_is_ajax_enabled() && sienna_mikado_is_ajax_request()) {
            add_action('sienna_mikado_ajax_meta', 'sienna_mikado_vc_custom_style');
        }

    }

    add_action('sienna_mikado_after_options_map', 'sienna_mikado_register_vc_custom_style');
}

if (!function_exists('sienna_mikado_container_style')) {

    /**
     * Function that return container style
     */

    function sienna_mikado_container_style($style)
    {
        $id = sienna_mikado_get_page_id();
        $class_prefix = sienna_mikado_get_unique_page_class();

        $container_selector = array(
            $class_prefix . ' .mkdf-content .mkdf-content-inner > .mkdf-container',
            $class_prefix . ' .mkdf-content .mkdf-content-inner > .mkdf-full-width',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "mkdf_page_background_color_meta", true);

        if ($page_backgorund_color) {
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = sienna_mikado_dynamic_css($container_selector, $container_class);
        $style = array();
        $style[] = $current_style;

        return $style;
    }

    add_filter('sienna_mikado_add_page_custom_style', 'sienna_mikado_container_style');
}

if (!function_exists('sienna_mikado_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function sienna_mikado_get_unique_page_class()
    {
        $id = sienna_mikado_get_page_id();
        $page_class = '';

        if (is_single()) {
            $page_class = '.postid-' . $id;
        } elseif ($id === sienna_mikado_get_woo_shop_page_id()) {
            $page_class = '.archive';
        } else {
            $page_class .= '.page-id-' . $id;
        }

        return $page_class;
    }
}

if (!function_exists('sienna_mikado_page_padding')) {

    /**
     * Function that return container style
     */

    function sienna_mikado_page_padding($style)
    {

        $id = sienna_mikado_get_page_id();

        $page_selector = array(
            '.page-id-' . $id . ' .mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
            '.page-id-' . $id . ' .mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner'
        );
        $page_css = array();

        $page_padding = get_post_meta($id, 'mkdf_page_padding_meta', true);

        if ($page_padding !== '') {
            $page_css['padding'] = $page_padding;
        }

        $current_style = sienna_mikado_dynamic_css($page_selector, $page_css);

        $style[] = $current_style;

        return $style;

    }

    add_filter('sienna_mikado_add_page_custom_style', 'sienna_mikado_page_padding');
}

if (!function_exists('sienna_mikado_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function sienna_mikado_print_custom_css()
    {
        $custom_css = sienna_mikado_options()->getOptionValue('custom_css');

        if ($custom_css !== '') {
            wp_add_inline_style('sienna_mikado_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_print_custom_css');
}

if (!function_exists('sienna_mikado_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function sienna_mikado_print_custom_js()
    {
        $custom_js = sienna_mikado_options()->getOptionValue('custom_js');
        $output = '';

        if ($custom_js !== '') {
            $output .= '<script type="text/javascript" id="sienna_mikado-custom-js">';
            $output .= '(function($) {';
            $output .= $custom_js;
            $output .= '})(jQuery)';
            $output .= '</script>';
        }

        print $output;
    }

    add_action('wp_footer', 'sienna_mikado_print_custom_js', 1000);
}


if (!function_exists('sienna_mikado_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function sienna_mikado_get_global_variables()
    {

        $global_variables = array();
        $element_appear_amount = -150;

        $global_variables['mkdfAddForAdminBar'] = is_admin_bar_showing() ? 0 : 0;
        $global_variables['mkdfElementAppearAmount'] = sienna_mikado_options()->getOptionValue('element_appear_amount') !== '' ? sienna_mikado_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
        $global_variables['mkdfFinishedMessage'] = esc_html__('No more posts', 'sienna');
        $global_variables['mkdfMessage'] = esc_html__('Loading new posts...', 'sienna');

        $global_variables = apply_filters('sienna_mikado_js_global_variables', $global_variables);

        wp_localize_script('sienna_mikado_modules', 'mkdfGlobalVars', array(
            'vars' => $global_variables
        ));

    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_get_global_variables');
	
	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}
	add_action('get_header', 'remove_admin_login_header');
	
	
}

if (!function_exists('sienna_mikado_per_page_js_variables')) {
    /**
     * Outputs global JS variable that holds page settings
     */
    function sienna_mikado_per_page_js_variables()
    {
        $per_page_js_vars = apply_filters('sienna_mikado_per_page_js_vars', array());

        wp_localize_script('sienna_mikado_modules', 'mkdfPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'sienna_mikado_per_page_js_variables');
}

if (!function_exists('sienna_mikado_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function sienna_mikado_content_elem_style_attr()
    {
        $styles = apply_filters('sienna_mikado_content_elem_style_attr', array());

        sienna_mikado_inline_style($styles);
    }
}

if (!function_exists('sienna_mikado_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function sienna_mikado_is_woocommerce_installed()
    {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('sienna_mikado_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function sienna_mikado_visual_composer_installed()
    {
        //is Visual Composer installed?
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('sienna_mikado_seo_plugin_installed')) {
    /**
     * Function that checks if popular seo plugins are installed
     * @return bool
     */
    function sienna_mikado_seo_plugin_installed()
    {
        //is 'YOAST' or 'All in One SEO' installed?
        if (defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('sienna_mikado_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function sienna_mikado_contact_form_7_installed()
    {
        //is Contact Form 7 installed?
        if (defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('sienna_mikado_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function sienna_mikado_is_wpml_installed()
    {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('sienna_mikado_twitter_feed_installed')) {
    /**
     * Checks if Twitter Feed plugin is installed
     * @return bool
     */
    function sienna_mikado_twitter_feed_installed()
    {
        return defined('MIKADOF_TWITTER_FEED_VERSION');
    }
}

if (!function_exists('sienna_mikado_instagram_feed_installed')) {
    /**
     * Checks if Instagram Feed plugin is installed
     * @return bool
     */
    function sienna_mikado_instagram_feed_installed()
    {
        return defined('MIKADOF_INSTAGRAM_FEED_VERSION');
    }
}

if (!function_exists('sienna_mikado_get_first_main_color')) {
    /**
     * Returns first main color from options if set, else returns default first main color
     *
     * @return bool|string|void
     */
    function sienna_mikado_get_first_main_color()
    {
        return sienna_mikado_options()->getOptionValue('first_color') ? sienna_mikado_options()->getOptionValue('first_color') : '#a8a8a8';
    }
}


if (!function_exists('sienna_mikado_max_image_width_srcset')) {
    /**
     * Set max width for srcset to 1920
     *
     * @return int
     */
    function sienna_mikado_max_image_width_srcset()
    {
        return 1920;
    }

    add_filter('max_srcset_image_width', 'sienna_mikado_max_image_width_srcset');
}

if (!function_exists('sienna_mikado_is_ajax_request')) {
    /**
     * Function that checks if the incoming request is made by ajax function
     */
    function sienna_mikado_is_ajax_request()
    {

        return isset($_POST['ajaxReq']) && $_POST['ajaxReq'] == 'yes';

    }
}


function wp_include_css()
{
    wp_enqueue_style('bootstrap-min-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('custom_staticsite-css', get_template_directory_uri() . '/assets/css/custom_staticsite.css', array(), false, 'all');
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), false, 'all');
    wp_enqueue_style('stylelexim-css', get_template_directory_uri() . '/assets/css/stylelexim.css', array(), false, 'all');
}

add_action('wp_enqueue_scripts', 'wp_include_css');

function my_scripts_method()
{
    wp_enqueue_script(
        'jslexim',
        get_stylesheet_directory_uri() . '/assets/js/jslexim.js',
        array('jquery')
    );
}

add_action('wp_enqueue_scripts', 'my_scripts_method');