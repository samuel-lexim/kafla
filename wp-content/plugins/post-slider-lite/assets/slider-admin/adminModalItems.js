var adminModalItems;

;(function($) {
    adminModalItems = function(base)
    {
	    /**
	     * Bacground selection
	     */
	    $('.tab-bg.tab-bg-selection').on('change','select[name="tab-bg-selection"]',function(){
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