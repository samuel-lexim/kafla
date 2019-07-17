/**
 * Sangar Slider WordPress Plugin
 * Copyright 2014, Tonjoo
 */

jQuery(document).ready(function($) {

    $.sangarSliderAdmin = function(opt) {

        var base = this;

        base.addModalLayer = $(opt.addModalLayer);
        base.cssModal = $(opt.cssModal);
        base.configModal = $(opt.configModal);

        adminCore.call($.sangarSliderAdmin.prototype,base);
        adminTabs.call($.sangarSliderAdmin.prototype,base);
        adminModalItems.call($.sangarSliderAdmin.prototype,base);
        adminModalLayer.call($.sangarSliderAdmin.prototype,base);        
        adminSlideManagement.call($.sangarSliderAdmin.prototype,base);
        // adminLayer.call($.sangarSliderAdmin.prototype,base);
        adminQuery.call($.sangarSliderAdmin.prototype,base);
    }

    var options = {
        addModalLayer : '#sslider-add-layer-slide-modal',
        cssModal : '#sslider-custom-css',
        configModal : '#sslider-conf-settings'
    }

    var plugin = new $.sangarSliderAdmin(options);
});