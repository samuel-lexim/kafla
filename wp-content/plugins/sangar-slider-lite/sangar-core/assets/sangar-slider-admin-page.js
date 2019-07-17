jQuery(function($){
	$('#sslider-slideshow-add-dialog').dialog({
		autoOpen: false,
		resizable: false,	
		width:'auto',    
	    modal: true
	}).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

	// delete slideshow
	$('#sslider-slideshow-add-dialog-button').click(function(){
    	$('#sslider-slideshow-add-dialog').dialog('open');
	});

	// select addons
	$('#sslider-slide-addons-selection-button').click(function(){
		var addon = $('#sslider-slide-addons-selection').val();
		
		if(addon == '') {
			var href = admin_url;
		} else {
			var href = admin_url + "&addon=" + addon;
		}

		window.location.href = href;
	});

	// promo lite modal
	if(typeof($("#sslider-button-promo")) !== 'undefined')
	{
		$('#sslider-modal-promo').dialog({
	       	autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        dialogClass: "sslider-modal-promo-container",
	        hide: false,
	        width: 800,
	        height: 500,
		    create:function(){
		        modalSaveButton = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:last");		        
		        modalSaveButton.addClass("button-primary button");
		    },
		    open: function (event, ui) {
		    	// disable scroll on body
			    $('body').addClass('stop-scrolling');
			    $('body').bind('touchmove', function(e){e.preventDefault()});
			},
		    close: function (event, ui) {
		    	// re-enable scroll on body
			    $('body').removeClass('stop-scrolling');
			    $('body').unbind('touchmove', function(e){e.preventDefault()});
			}
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

	    $("#sslider-button-promo").click(function(){
	        $('#sslider-modal-promo').dialog("open");
	    });
	}    
});