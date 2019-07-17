var adminModalItems;

;(function($) {
    adminModalItems = function(base)
    {
		/**
	     * Textbox Preview
	     */

	    // Preview Position 
	    $("#opt-content-options").on('change','select[name="tab-content-position"]',function(){
	        base.textboxPreviewPosition();
	    });

	    $("#opt-content-options").on('change','select[name="tab-content-width"]',function(){
	        base.textboxPreviewPosition();
	    });

	    base.textboxPreviewPosition = function(){
	        var position = $('select[name="tab-content-position"]').val();
	        var width = $('select[name="tab-content-width"]').val();

	        obj = $('#sslider-position-preview-obj');

	        obj.removeAttr('style');

	        // width
	        obj.css({
	            "width": (450 * width / 12) + 'px'
	        })

	        // position
	        switch (position)
	        {
	            case 'left': 
	                obj.css({
	                    "margin-top": '65px'
	                }).html('Content<br/><span>( Left )</span>')
	                break;
	            case 'top-left': 
	                obj.css({
	                    "margin-right": 'auto'
	                }).html('Content<br/><span>( Top Left )</span>')
	                break;
	            case 'top': 
	                obj.css({
	                    "margin-left": 'auto',
	                    "margin-right": 'auto'
	                }).html('Content<br/><span>( Top )</span>')
	                break;
	            case 'top-right': 
	                obj.css({
	                    "margin-left": 'auto'
	                }).html('Content<br/><span>( Top Right )</span>')
	                break;
	            case 'right': 
	                obj.css({
	                    "margin-left": 'auto',
	                    "margin-top": '65px'
	                }).html('Content<br/><span>( Right )</span>')
	                break;
	            case 'bottom-right': 
	                obj.css({
	                    "margin-left": 'auto',
	                    "margin-top": '135px'
	                }).html('Content<br/><span>( Bottom Right )</span>')
	                break;
	            case 'bottom': 
	                obj.css({
	                    "margin-left": 'auto',
	                    "margin-right": 'auto',
	                    "margin-top": '135px'
	                }).html('Content<br/><span>( Bottom )</span>')
	                break;
	            case 'bottom-left': 
	                obj.css({
	                    "margin-right": 'auto',
	                    "margin-top": '135px'
	                }).html('Content<br/><span>( Bottom Left )</span>')
	                break;
	            case 'center': 
	                obj.css({
	                    "margin-left": 'auto',
	                    "margin-right": 'auto',
	                    "margin-top": '65px'
	                }).html('Content<br/><span>( Center )</span>')
	                break;
	            case 'sticky-top': 
	                obj.css({
	                    "margin-left": '-40px',
	                    "margin-top": '-8px',
	                    "width": '100%',
	                    "position": 'absolute'
	                }).html('Content<br/><span>( Sticky Top )</span>')
	                break;
	            case 'sticky-bottom': 
	                obj.css({
	                    "margin-left": '-40px',
	                    "margin-top": '143px',
	                    "width": '100%',
	                    "position": 'absolute'
	                }).html('Content<br/><span>( Sticky Bottom )</span>')
	                break;
	            default: // no action
	        }       
	    }


	    /**
	     * Color changer
	     */
	    $(".sslider-color-changer .sslider-color-select").on('change','select',function(){
	        var value = $(this).attr('value');
	        var parent = $(this).parent().parent('.sslider-color-changer');

	        parent.children('.sslider-color-transparent').hide();
	        parent.children('.sslider-color-color').hide();

	        if(value != 'none') parent.children('.sslider-color-' + value).show();
	    });

	    $(".sslider-color-changer .sslider-color-transparent").on('change','select',function(){
	        var value = $(this).attr('value');

	        $(this).parent().children('.transparent_bg_prev').css('background-image',"url('" + core_url + 'assets/images/transparent/' + value + ".png')");
	    });

	    base.colorChangerReset = function()
	    {
	    	$(".sslider-color-changer .sslider-color-select select").trigger('change');
	    	$(".sslider-color-changer .sslider-color-transparent select").trigger('change');
	    }


	    /**
	     * Padding changer
	     */
	    $(".sslider-padding-changer .sslider-padding-select").on('change','select',function(){
	        var value = $(this).attr('value');
	        var parent = $(this).parent().parent('.sslider-padding-changer');

	        if(value == 'custom')
	        {
	        	parent.children('.sslider-padding-custom').show();
	        }
	        else
	        {
	        	parent.children('.sslider-padding-custom').hide();
	        }
	    });

	    base.paddingChangerReset = function()
	    {
	    	$(".sslider-padding-changer .sslider-padding-select select").trigger('change');
	    }


	    /**
	     * HTML background type
	     */
	    $("#opt-content-options").on('change','select[name="tab-html-bg-type"]',function(){
	        base.htmlBgSelect();
	    });
	    base.htmlBgSelect = function()
	    {
	        var value = $('select[name="tab-html-bg-type"]').attr('value');
	        
	        $('#tr_html_trans_bg').hide();
	        $('#tr_html_color_bg').hide();

	        switch(value)
	        {
	            case 'transparent':
	                $('#tr_html_trans_bg').show();
	                break;

	            case 'color':
	                $('#tr_html_color_bg').show();
	                break;

	            default:
	                // silent
	                break;
	        }
	    }


	    /**
	     * HTML Transparent background
	     */
	    $("#opt-content-options").on('change','select[name="tab-html-bg-transparent"]',function(){
	        base.htmlBgTransSelect();
	    });
	    base.htmlBgTransSelect = function()
	    {
	        var value = $('select[name="tab-html-bg-transparent"]').attr('value');
	        
	        $("#tr_html_trans_bg .transparent_bg_prev").css('background-image',"url('" + core_url + 'assets/images/transparent/' + value + ".png')");
	    }


	    /**
	     * Bacground selection
	     */
	    $('.tab-bg.tab-bg-selection').on('change','select',function(){
	        var type = $(this).parents('.fullscreen-modal-content').attr('id');
	        var value = $(this).val();

	        base.tab_bg_selection(type,value);
	    });
	    $('.opt-background-tab').on('click',function(){
	    	var type = $(this).parents('.fullscreen-modal-content').attr('id');
	    	var value = $('#' + type).find('select[name="tab-bg-selection"]').val();

	    	base.tab_bg_selection(type,value);
	    });
	    base.tab_bg_selection = function(type,value)
	    {
	        $('#' + type + ' .tab-bg').hide();
	        $('#' + type + ' #tab-bg-selection').show();
	        $('#' + type + ' #tab-bg-' + value).show();

	        // display overlay
	        if(value == 'image' || value == 'video')
	        {
	        	$('#' + type + ' .tab-overlay-selection').show();
	        }
	        else
	        {
	        	$('#' + type + ' .tab-overlay-selection').hide();
	        }

	        if(value != 'html') return;

	        if(type == 'sslider-add-slide-modal')
	        {
	        	setTimeout(function() {
	                if(typeof base.bgHTMLEditorStatic != 'undefined') base.bgHTMLEditorStatic.refresh();
	            },1);
	        }
	        else if(type == 'sslider-add-layer-slide-modal')
	        {
	        	setTimeout(function() {
	                if(typeof base.bgHTMLEditorLayer != 'undefined') base.bgHTMLEditorLayer.refresh();
	            },1);
	        }	        
	    }


	    /**
	     * Overlay selection
	     */
	    $('select[name="tab-overlay-selection"]').on('change',function(){
	        var type = $(this).parents('.fullscreen-modal-content').attr('id');
	        var value = $(this).val();

	        base.tab_overlay_selection(type,value);
	    });
	    $('.opt-background-tab').on('click',function(){
	    	var type = $(this).parents('.fullscreen-modal-content').attr('id');
	    	var value = $('#' + type).find('select[name="tab-overlay-selection"]').val();

	    	base.tab_overlay_selection(type,value);
	    });
	    base.tab_overlay_selection = function(type,value)
	    {
	    	$('#' + type + ' .tab-overlay').hide();
	        $('#' + type + ' #tab-overlay-' + value).show();
	    }



	    /**
	     * Content selection
	     */
	    $('#opt-content #tab-content-selection').on('change','select',function(){
	        var value = $(this).val();

	        base.tab_content_selection(value);
	    });
	    base.tab_content_selection = function(value)
	    {
	        $('#opt-content .tab-content').hide();
	        $('#opt-content #tab-content-selection').show();        

	        switch(value)
	        {
	            case 'text':
	                $('#opt-content #tab-content-sel-' + value).show();	                
	                $('#opt-content-options .content-options-html').hide();
	                $('#opt-content-options .content-options-textbox').show();
	                $('#opt-content-style .content-style-textbox').show();
	                $('#opt-content-style .content-style-button').hide();
	                $('#opt-content-style-tab').show();
	                $('#opt-content-options-tab').show();
	                $('#opt-content-animation-tab').show();
	                break;

	            case 'text-and-button':
	                $('#opt-content #tab-content-sel-text').show();	                
	                $('#opt-content #tab-content-sel-button').show();	                
	                $('#opt-content-options .content-options-html').hide();
	                $('#opt-content-options .content-options-textbox').show();
	                $('#opt-content-style .content-style-textbox').show();
	                $('#opt-content-style .content-style-button').show();
	                $('#opt-content-style-tab').show();
	                $('#opt-content-options-tab').show();
	                $('#opt-content-animation-tab').show();
	                break;

	            case 'html':
	            	setTimeout(function() {
	                    if(typeof base.contentHTMLEditor != 'undefined') base.contentHTMLEditor.refresh();
	                },1);
	                
	                $('#opt-content #tab-content-sel-' + value).show();	                
	                $('#opt-content-options .content-options-html').show();
	                $('#opt-content-options .content-options-textbox').hide();
	                $('#opt-content-style .content-style-textbox').hide();
	                $('#opt-content-style .content-style-button').hide();
	                $('#opt-content-style-tab').hide();
	                $('#opt-content-options-tab').show();
	                $('#opt-content-animation-tab').hide();
	                break;

	            default:
	                $('#opt-content-style-tab').hide();
	                $('#opt-content-options-tab').hide();
	                $('#opt-content-animation-tab').hide();
	                break;
	        }
	    }


	    /**
	     * Dimension changer
	     */
	    $(".mobileDimensionSelection").on('change','select',function(){
	        var value = $(this).val();

	        if(value == 'true')
	        {
	        	$("#sslider_configuration .custom-mobile-size").show();
	        }
	        else
	        {
	        	$("#sslider_configuration .custom-mobile-size").hide();
	        }
	    });

	    if($(".mobileDimensionSelection select").length > 0)
	    {
	    	$(".mobileDimensionSelection select").trigger('change');
	    }
	    
	}
	
})(jQuery);