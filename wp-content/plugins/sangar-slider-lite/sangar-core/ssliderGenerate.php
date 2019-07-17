<?php 
/**
 * Class ssliderGenerate, parent of each addons ssliderGenerate
 * @author Haris
 */

Class ssliderGenerate
{
    function __construct() {
        // silent is a golden
    }

    protected function wp_enqueue_core()
    {
        $version = SANGAR_SLIDER_VERSION;

        // sangarSlider css
        wp_enqueue_style('sslider-css',SANGAR_CORE_DIR_URL."assets/bower_components/sangar-slider/dist/css/sangarSlider.css",array(),$version);  
        wp_enqueue_style('sslider-responsive-css',SANGAR_CORE_DIR_URL."assets/bower_components/sangar-slider/dist/css/responsive.css",array(),$version);          
        wp_enqueue_style('sslider-buttons-css',SANGAR_CORE_DIR_URL."assets/sangar-buttons.css",array(),$version);

        // jQuery
        wp_enqueue_script('jquery');

        // sangarSlider packaged js
        wp_enqueue_script('sslider-js',SANGAR_CORE_DIR_URL."assets/bower_components/sangar-slider/dist/js/sangarSlider-packaged.min.js",array(),$version);

        // sangar layer with mustache
        wp_enqueue_script('sslider-mustache-js',SANGAR_CORE_DIR_URL."assets/mustache.min.js",array(),$version);

        // sangar layer frontend
        wp_enqueue_script('sslider-layer-frontend-js',SANGAR_CORE_DIR_URL."assets/sangar-layer-frontend.js",array(),$version);        

        // fancybox
        wp_enqueue_style('sslider-fancybox-css',SANGAR_CORE_DIR_URL."assets/fancybox/jquery.fancybox-1.3.4.css",array(),$version);
        wp_enqueue_script('sslider-fancybox-js',SANGAR_CORE_DIR_URL."assets/fancybox/jquery.fancybox-1.3.4.js",array(),$version);

        // sangar icon
        wp_enqueue_style('sslider-sangarico-css',SANGAR_CORE_DIR_URL."assets/sangarico/style.css",array(),$version);
    }
}