var adminModalYoutube;

;(function($) {
	adminModalYoutube = function(base)
	{
		var modalSaveButton,
			modalDeleteButton;

		/**
		 * Modal Youtube / Vimeo Slide
		 */
		base.addModalYoutube.dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Add / Edit Youtube or Vimeo Slide",
	        dialogClass: "modal-without-tab",
	        width: 700,
	        height: 530,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Save Slide': function(){
		            saveSlide();
		        }
		    },
		    create:function () {
		        modalDeleteButton = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:first");
		        modalSaveButton = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:last");
		        
		        modalSaveButton.addClass("button-primary button");
		        modalDeleteButton.addClass("button");
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

	    base.add_youtube_slide = function()
	    {
	    	var slug = false;

	        base.addModalYoutube.data('slug',false);

	        modal_slide(slug);
	        modalDeleteButton.hide();
	    }

	    function modal_slide(slug)
	    {
	        var serializedData = $('#edited-sslider-data').val();
	        var theme = $('select[name="config[themeClass]"]').val();

	        base.ajaxOnProgress();

	        var data = {
	            action:'sslider_show_modal',
	            slug: slug,
	            serializedData: serializedData,
	            theme: theme,
	            defaultSlideOptions: defaultSlideOptions
	        }

	        $.post(ajaxurl, data,function(response){        

	        	base.ajaxOnProgress('hide');

	            var response = $.parseJSON(response);

	            if(response.success)
	            {
	                fillModalFields(response.dataRow); // fill all modal fields
	                // reinitModalItems();

	                base.addModalYoutube.dialog("open");
	            }
	            else alert('Error: connection to your server is lost, please try again.');
	        })
	    }

	    function fillModalFields(dataRow)
	    {
	        var serializedData = $('#edited-sslider-data').val();

	        $.each(dataRow, function( name, value ) {	        	
	            base.addModalYoutube.find('[name="'+ name +'"]').val(value); // set the value
	        });

	        // preview
	        var $preview = base.addModalYoutube.find('#video-iframe-preview');

	        $preview.html('');
	        
	        if(dataRow['tab-bg-video-iframe'] == '') return;
	        $preview.html(convertEmbedMedia(dataRow['tab-bg-video-iframe']));
	    }

	    function saveSlide()
	    {
	    	var serializedData = $('#edited-sslider-data').val();
            var isNewData = base.addModalYoutube.data('slug') ? 'false' : 'true';
            var slug = base.addModalYoutube.data('slug') ? base.addModalYoutube.data('slug') : 'false';

            var formData = {
            	'slide-title' : $('#sslider-add-youtube-slide-modal input[name="slide-title"]').val(),
            	'tab-bg-video-iframe' : $('#sslider-add-youtube-slide-modal input[name="tab-bg-video-iframe"]').val()
            }

            base.ajaxOnProgress();

            var data = {
                action: 'sslider_add_youtube_slide',
                serializedData: serializedData,
                formData: JSON.stringify(formData),
                isNewData: isNewData,
                slug: slug,
                type: 'static',
	            defaultSlideOptions: defaultSlideOptions
            }

            $.post(ajaxurl, data, function(response){

            	base.ajaxOnProgress('hide');

                var response = $.parseJSON(response);

                if(response.success)
                {
                    $('#edited-sslider-data').val(response.serialized);base.showSaveNotif();
                    $('#sslider-slides-list').children('.slide_item').remove();
                    $('#sslider-slides-list').prepend(response.rows);

                    base.addModalYoutube.dialog("close");
                }
                else alert('Error: connection to your server is lost, please try again.');

            });
	    }

	    base.editSlideYoutube = function(slug)
	    {
	    	base.addModalYoutube.data('slug',slug);

	        modal_slide(slug);
	        modalDeleteButton.show();	     
	    }

	    /**
	     * Convert youtube and vimeo link to embed iframe
	     */
	    function convertEmbedMedia(html,fullscreen,isAutoplay)
	    {
	    	var wordCount = html.trim().replace(/\s+/gi, ' ').split(' ').length;

	    	// if word are > 1

	    	if(wordCount > 1) return "Cannot parse the embed source!, please check your input.";

	    	// else:

	    	if(fullscreen == true)
	    	{
	    		var dimension = 'style="width:100%;height:100%;"';
	    	}
	    	else if($.isArray(fullscreen))
	    	{
	    		var dimension = 'width="'+ fullscreen[0] +'" height="'+ fullscreen[1] +'"';						
	    	}
	    	else
	    	{
	    		var dimension = 'width="490" height="240"';
	    	}

	    	var origin = html;
	        var pattern1 = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/(?:.*\/)?(.+)/g;
	        var pattern2 = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g;
	        
	        if(pattern1.test(html))
	        {
	        	var autoplay = isAutoplay ? "?autoplay=1" : '';
	           	var replacement = '<iframe '+ dimension +' src="//player.vimeo.com/video/$1'+ autoplay +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';	           
	           	var html = html.replace(pattern1, replacement);
	        }
	        
	        if(pattern2.test(html))
	        {
	        	var autoplay = isAutoplay ? "?autoplay=1" : '';
	            var replacement = '<iframe '+ dimension +' src="http://www.youtube.com/embed/$1'+ autoplay +'" frameborder="0" allowfullscreen></iframe>';
	            var html = html.replace(pattern2, replacement);
	        }

	        if(html == origin)
	        {
	        	html = "Cannot parse the embed source!, please check your input.";
	        }
	        
	        return html;
		}
		
		base.addModalYoutube.find('input[name="tab-bg-video-iframe"]').keyup(function(){
			var value = $(this).val();
			var $preview = base.addModalYoutube.find('#video-iframe-preview');

			if(value == '')
			{
				$preview.html('');

				return;
			}

			$preview.html('Loading preview..');

			setTimeout(function(){
			    $preview.html(convertEmbedMedia(value,false));
			},2000);
		})


		// Add youtube video on layer
		$('#layer-modal-youtube').find('#add-layer-youtube-source').keyup(function(){
			var value = $(this).val();
			var $preview = $('#layer-modal-youtube').find('#video-iframe-preview');

			if(value == '')
			{
				$preview.html('');

				return;
			}

			$preview.html('Loading preview..');

			setTimeout(function(){
			    $preview.html(convertEmbedMedia(value,true));
			},2000);
		})

		// Add popup youtube video on add image layer
		$('#layer-modal-image').find('#add-layer-image-youtube-source').keyup(function(){
			var value = $(this).val();
			var $preview = $('#layer-modal-image').find('#add-layer-image-video-iframe-preview');

			if(value == '')
			{
				$preview.html('');

				return;
			}

			$preview.html('Loading preview..');

			setTimeout(function(){
			    $preview.html(convertEmbedMedia(value,true));
			},2000);
		})

		// Add popup youtube video on add button layer
		$('#layer-modal-button').find('#add-layer-button-youtube-source').keyup(function(){
			var value = $(this).val();
			var $preview = $('#layer-modal-button').find('#add-layer-button-video-iframe-preview');

			if(value == '')
			{
				$preview.html('');

				return;
			}

			$preview.html('Loading preview..');

			setTimeout(function(){
			    $preview.html(convertEmbedMedia(value,true));
			},2000);
		})
	}
})(jQuery);