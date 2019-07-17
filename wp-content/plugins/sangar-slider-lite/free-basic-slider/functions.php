<?php

define('SSLIDER_CURRENT_ADDON','sangar_slider');

/**
 * Admin head
 */
add_action('admin_head','sslider_admin_head');
function sslider_admin_head()
{
    global $post_type;

    if($post_type != SSLIDER_CURRENT_ADDON) return;
    
    require_once( plugin_dir_path( __FILE__ ) . 'default.php');    
    require_once( plugin_dir_path( __FILE__ ) . 'meta-box-slide-add.php');
    require_once( plugin_dir_path( __FILE__ ) . 'meta-box-slide-management.php');
    require_once( plugin_dir_path( __FILE__ ) . 'meta-box-configuration.php');

    // write default slide options to js
    echo "<script type='text/javascript'>";
    echo "var defaultSlideOptions = ". json_encode(ssliderDefault::slide()) .";";
    echo "</script>";
}


/**
 * Admin footer
 * !IMPORTANT! IF JQUERY TOOLTIP ERROR: 
 * - If its happen, the required once php file(s) in this admin footer must be error
 * - To solve that error, inspect element browser, and then search for "error"
 */
add_action('admin_footer', 'sslider_admin_footer');
function sslider_admin_footer()
{
    global $post_type;

    if($post_type != SSLIDER_CURRENT_ADDON) return;
    
    require_once( plugin_dir_path( __FILE__ ) . 'modal.php');
}


/**
 * admin_enqueue_scripts - equeue on plugin page only
 */
add_action('admin_enqueue_scripts', 'sslider_admin_enqueue_scripts', 10, 1);
function sslider_admin_enqueue_scripts($hook)
{
    global $post_type;
        
    if($post_type != SSLIDER_CURRENT_ADDON) return;

    // add and edit page only
    if($hook == 'post-new.php' || $hook == 'post.php')
    {
        // all post-type admin page
        wp_enqueue_style('sslider-admin-css',plugin_dir_url( __FILE__ )."assets/slider-admin.css",array(),SANGAR_SLIDER_VERSION);        

        // core        
        wp_enqueue_script('sslider-admin-core-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminCore.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-tabs-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminTabs.js",array(),SANGAR_SLIDER_VERSION);        
        wp_enqueue_script('sslider-admin-modal-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminModal.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-modal-items-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminModalItems.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-modal-layer-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminModalLayer.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-modal-youtube-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminModalYoutube.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-preview-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminPreview.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-slide-management-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminSlideManagement.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-layer-js',plugin_dir_url( __FILE__ )."assets/slider-admin/adminLayer.js",array(),SANGAR_SLIDER_VERSION);
        wp_enqueue_script('sslider-admin-js',plugin_dir_url( __FILE__ )."assets/slider-admin.js",array(),SANGAR_SLIDER_VERSION);
    }
}