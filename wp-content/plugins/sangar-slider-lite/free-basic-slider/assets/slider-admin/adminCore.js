var adminCore;

;(function($) {
	adminCore = function(base)
	{
		/**
		 * Tooltip
		 */
		$( document ).tooltip();

		/**
		 * wpAccordion
		 */
		$('.accordion-config-one').wpAccordion();
		$('.accordion-config-two').wpAccordion();


		/**
		 * Minicolor
		 */
		$('.minicolors').minicolors();
		$('.config_minicolors').minicolors({
		    inline: false,
		    position: 'bottom right'
		});
		$('.minicolors_opacify').minicolors({
		    opacity: true,
		    format: 'rgb',
		    keywords: 'keyword'
		});

		base.setMinicolors = function(name,value)
		{
		    $('[name="'+ name +'"]').minicolors('value',value);
		}


		/**
	     * Navigation alert
	     */
	    $('select.select2').select2({
	    	'width': '230px'
	    });

	    base.select2trigger = function(el)
	    {
	    	var select2 = el.find('select.select2');

	    	if(select2.length > 0)
	    	{
	    		select2.trigger('change');
	    	}
	    }


	    /**
	     * Navigation alert
	     */
	    var isDoPulish = false;

	    $("form[name='post']").submit(function(){
	    	isDoPulish = true;
	    });

	    window.addEventListener("beforeunload", function(event) {
	    	var original = $('#original-sslider-data').val();
	        var edited = $('#edited-sslider-data').val();
	        
	        if(! isDoPulish && original != edited)
	        {
	            event.returnValue = "The changes you made will lost if you navigate away from this page.";
	        }
		});		


	    /**
         * Codemirror background HTML on static
         */
        if($('#sslider-add-slide-modal').find("#bg-html-editor").length > 0)
        {
	    	base.bgHTMLEditorStatic = CodeMirror.fromTextArea($('#sslider-add-slide-modal').find("#bg-html-editor")[0], {
	            lineNumbers: true,
	            mode: "text/html"
	        });
	    }


	    /**
         * Codemirror background HTML on layered
         */
	    if($('#sslider-add-layer-slide-modal').find("#bg-html-editor").length > 0)
        {
	        base.bgHTMLEditorLayer = CodeMirror.fromTextArea($('#sslider-add-layer-slide-modal').find("#bg-html-editor")[0], {
	            lineNumbers: true,
	            mode: "text/html"
	        });
	    }
        

        /**
         * Codemirror content HTML
         */
        if($("#content-html-editor").length > 0)
        {
        	base.contentHTMLEditor = CodeMirror.fromTextArea(document.getElementById("content-html-editor"), {
	            lineNumbers: true,
	            mode: "text/html"
	        });    
        }
        

        /**
         * Codemirror custom CSS
         */
        if($("#sslider-custom-css-field").length > 0)
        {
	        base.customCSS = CodeMirror.fromTextArea(document.getElementById("sslider-custom-css-field"), {
	            lineNumbers: true,
	            mode: "text/html"
	        });    
	    }

	    /**
         * button skin ddslick
         */
	    $("#tab-content-btn-skin").ddslick({
        	width: 320,
        	selectText: "Select your favorite social network",
        	onSelected: function(data){
        		$('input[name="tab-content-btn-skin"]').val(data.selectedData.value);
        	}
        });


		/**
		 * Colorize modal button
		 */
		base.setModalButtonColor = function(el)
		{
			modalDeleteButton = $(el).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:first");
	        modalSaveButton = $(el).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:last");
	        
	        modalSaveButton.addClass("button-primary button");
	        modalDeleteButton.addClass("button");		        
		}


		/**
		 * Ajax Loading Notification
		 */
		base.base64Decode = function(data) 
		{
			//  discuss at: http://phpjs.org/functions/base64_decode/
			// original by: Tyler Akins (http://rumkin.com)
			// improved by: Thunder.m
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			//    input by: Aman Gupta
			//    input by: Brett Zamir (http://brett-zamir.me)
			// bugfixed by: Onno Marsman
			// bugfixed by: Pellentesque Malesuada
			// bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			//   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
			//   returns 1: 'Kevin van Zonneveld'
			//   example 2: base64_decode('YQ===');
			//   returns 2: 'a'
			//   example 3: base64_decode('4pyTIMOgIGxhIG1vZGU=');
			//   returns 3: '✓ à la mode'

		  	var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
		  	var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
			    ac = 0,
			    dec = '',
			    tmp_arr = [];

		  	if (!data) {
		  		return data;
		  	}

		  	data += '';

		  	do {
			    // unpack four hexets into three octets using index points in b64
			    h1 = b64.indexOf(data.charAt(i++));
			    h2 = b64.indexOf(data.charAt(i++));
			    h3 = b64.indexOf(data.charAt(i++));
			    h4 = b64.indexOf(data.charAt(i++));

			    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

			    o1 = bits >> 16 & 0xff;
			    o2 = bits >> 8 & 0xff;
			    o3 = bits & 0xff;

			    if (h3 == 64) {
			      	tmp_arr[ac++] = String.fromCharCode(o1);
			    } else if (h4 == 64) {
			      	tmp_arr[ac++] = String.fromCharCode(o1, o2);
			    } else {
			      	tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
			    }
		  	} while (i < data.length);

		  	dec = tmp_arr.join('');

		  	return decodeURIComponent(escape(dec.replace(/\0+$/, '')));
		}


		/**
		 * Ajax Loading Notification
		 */
		base.ajaxOnProgress = function(action){
			if(action == 'hide')
			{
				$('#sangar_ajax_on_progress').css({
					'background': 'none',
					'display': 'none'
				})
			}
			else
			{
				$('#sangar_ajax_on_progress').css({
					'background': '',
					'display': 'block'
				})
			}
		}

		// hide
		base.ajaxOnProgress('hide');


		/**
		 * show save notification
		 */
		base.showSaveNotif = function(){
			var original = $('#original-sslider-data').val();
	        var edited = $('#edited-sslider-data').val();

	        if(original != edited)
	        {
	        	$('.sangar-slider-notice').show();
	        }
	        else
	        {
	        	$('.sangar-slider-notice').hide();
	        }
		}


		/**
		 * Add New Slide
		 */
		$('#sslider_slide_add').parent().on('click','[sslider-add-slide]',function(){
	        base.add_standart_slide();
	    });

		$('#sslider_slide_add').parent().on('click','[sslider-add-layer-slide]',function(){
	        base.add_layer_slide();
	    });

	    $('#sslider_slide_add').parent().on('click','[sslider-add-youtube-slide]',function(){
	        base.add_youtube_slide();
	    });	    

	    $('#show-data-layer-json').on('click',function(){
	    	console.log(sangarLayer.saveLayer());
	    })
	}
})(jQuery);