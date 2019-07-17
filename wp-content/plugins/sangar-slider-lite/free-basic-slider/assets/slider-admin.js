/**
 * Sangar Slider WordPress Plugin
 * Copyright 2014, Tonjoo
 */

jQuery(document).ready(function($) {

    $.sangarSliderAdmin = function(opt) {

        var base = this;

        base.addModal = $(opt.addModal);
        base.addModalLayer = $(opt.addModalLayer);
        base.addModalYoutube = $(opt.addModalYoutube);
        base.previewModal = $(opt.previewModal);
        base.cssModal = $(opt.cssModal);
        base.configModal = $(opt.configModal);

        adminCore.call($.sangarSliderAdmin.prototype,base);
        adminTabs.call($.sangarSliderAdmin.prototype,base);
        adminModal.call($.sangarSliderAdmin.prototype,base);
        adminModalItems.call($.sangarSliderAdmin.prototype,base);
        adminModalLayer.call($.sangarSliderAdmin.prototype,base);        
        adminModalYoutube.call($.sangarSliderAdmin.prototype,base);        
        adminPreview.call($.sangarSliderAdmin.prototype,base);        
        adminSlideManagement.call($.sangarSliderAdmin.prototype,base);
        adminLayer.call($.sangarSliderAdmin.prototype,base);
    }

    var options = {
        addModal : '#sslider-add-slide-modal',
        addModalLayer : '#sslider-add-layer-slide-modal',
        addModalYoutube : '#sslider-add-youtube-slide-modal',
        previewModal : '#sslider-preview-slide',
        cssModal : '#sslider-custom-css',
        configModal : '#sslider-conf-settings',        
    }

    var plugin = new $.sangarSliderAdmin(options);
});