var adminModal;

;(function($) {
	adminModal = function(base)
	{
		var modalForm,
			modalSaveButton,
			modalDeleteButton;

		/**
	     * modal
	     */
	    base.addModal.dialog({
	        autoOpen: false,
	        modal: true,
	        resizable: false,
	        draggable: false,
	        hide: false,
	        dialogClass: "fullscreen-ui-with-button-modal",
			buttons: {
		        'Delete Slide': function(){
		            $('#sslider-slideshow-delete-dialog').dialog('open')
			        	.data('delete',{
			        		slug: modalForm.data('slug'),
			        		isModal: true
			        	});
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
		    	// var modal_background_html = $('#sslider-modal-background').html();
		    	// $('#sslider-modal-background-static').html(modal_background_html);

		    	// disable scroll on body
			    $('body').addClass('stop-scrolling');
			    $('body').bind('touchmove', function(e){e.preventDefault()});
			},
		    close: function (event, ui) {

		    	tonjooWpEditor.modalClose('tab-content-text');

		    	// re-enable scroll on body
			    $('body').removeClass('stop-scrolling');
			    $('body').unbind('touchmove', function(e){e.preventDefault()});
			}
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

	    
	    /**
	     * init modal form with ajaxForm
	     */
	    modalForm = base.addModal.children('#sslider-modal-form');

        var options = {
            type: 'post',
            beforeSubmit: ajaxSendData 
        };

        modalForm.ajaxForm(options);

	    function ajaxSendData(formData, $form, options) 
	    {
            var serializedData = $('#edited-sslider-data').val();
            var isNewData = modalForm.data('slug') ? 'false' : 'true';
            var slug = modalForm.data('slug') ? modalForm.data('slug') : 'false';

            base.ajaxOnProgress();

            var data = {
                action: 'sslider_add_slide',
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

                    base.addModal.dialog("close");
                }
                else alert('Error: connection to your server is lost, please try again.');

            });
             
            return false;
	    }


	    /**
	     * sidebar modal tips
	     */
	    $('.sslider-tabs').on('click','.media-menu-item',function(){
	    	var id = $(this).attr('id');
	    		id = id.slice(4);
	    		id = id.slice(0,-4);

	    	$('.modal-sidetips').hide();
	    	$('.modal-sidetips#sidetips-' + id).show();
	    });


	    /**
	     * add slide
	     */	
	    base.add_standart_slide = function()
	    {
	    	var slug = false;

	        modalForm.data('slug',false);

	        modal_slide(slug);
	        modalDeleteButton.hide();
	    }

	    base.editSlideStatic = function(slug)
	    {
	    	modalForm.data('slug',slug);

	        modal_slide(slug);
	        modalDeleteButton.show();	        
	    };

	    function modal_slide(slug)
	    {
	        var button = $('[sslider-add-slide]');
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
	                reinitModalItems();	     
	                base.select2trigger(modalForm);           

	                // background image
	                $('[tab-bg-image] [media-upload-image]').attr('src',response.bg_type_img);
	                $('[tab-bg-image] [media-upload-image-url]').val(response.bg_type_img_url);
	                $('[tab-bg-image] [media-remove-button]').attr('data-image-default',response.bg_image_default);

	                // background overlay
	                if(response.bg_overlay_img_url != '')
	                {
	                	$('[tab-overlay-upload-image] [media-upload-title]').html("<b>File Selected: </b>" + response.bg_overlay_img_url);
	                }

	                // background HTML5 video
	                var html5video = response.bg_type_video_html5;

	                if(response.bg_video_isset == 'true')
	                {
	                    html5video = '<video controls width="450px" >';
	                    html5video+= '<source src="'+ response.bg_type_video_html5 +'" type="video/mp4">';
	                    html5video+= 'Your browser does not support HTML5 video.';
	                    html5video+= '</video>';
	                }                

	                $('[tab-bg-video-html5] [media-upload-video]').html(html5video);
	                $('[tab-bg-video-html5] [media-remove-button]').attr('data-image-default',response.bg_video_default);

	                // HTML5 video poster
	                $('[tab-bg-video-html5-poster] [media-upload-image]').attr('src',response.bg_video_poster);
	                $('[tab-bg-video-html5-poster] [media-upload-image-url]').val(response.bg_video_poster_url);
	                $('[tab-bg-video-html5-poster] [media-remove-button]').attr('data-image-default',response.bg_image_default);

	                base.addModal.dialog("open");
	                base.addModal.find('.sslider-tabs a.media-menu-item:first').trigger('click');
	            }
	            else alert('Error: connection to your server is lost, please try again.');
	        })
	    }

	    function fillModalFields(dataRow)
	    {
	        var serializedData = $('#edited-sslider-data').val();

	        $.each(dataRow, function( name, value ) {
	            
	            // switch by name
	            switch(name)
	            {
	                case 'tab-bg-selection':
	                    // base.tab_bg_selection(value);
	                    break;

	                case 'tab-bg-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-bg-html':
	                	if(typeof base.bgHTMLEditorStatic != 'undefined') 
	                		base.bgHTMLEditorStatic.setValue(value);
	                    break;

	                case 'tab-content-selection':
	                    base.tab_content_selection(value);
	                    break;

	                case 'tab-content-text':                
	                	// it was tinymce
	                	tonjooWpEditor.modalOpen('tab-content-text');
	                    break;

	                case 'tab-content-html':                
	                    if(typeof base.contentHTMLEditor != 'undefined') 
	                    	base.contentHTMLEditor.setValue(value);
	                    break;

	                case 'tab-content-bg-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-content-title-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-content-description-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-html-bg-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-overlay-color':
	                    base.setMinicolors(name,value);
	                    break;	                

	                default:
	                    // silent is golden
	                    break;
	            }

	            // set the value
	            modalForm.find('[name="'+ name +'"]').val(value);
	        });
	    }

	    function reinitModalItems()
	    {
	    	$('.modal-sidetips').hide();
	    	$('.modal-sidetips#sidetips-background').show();
	    	
	        base.textboxPreviewPosition();
	        
	        // button skin ddslick UGLY usage workaround, tapi piye neh, kesuwen nek arep pindah
	        $buttonSkin = $('input[name="tab-content-btn-skin"]');
	        var selectedIndex = $('#tab-content-btn-skin ul.dd-options li:has(input[value="'+ $buttonSkin.val() +'"])').index();
	        
	        $('#tab-content-btn-skin').ddslick('select', {index: parseInt(selectedIndex)});

	        base.colorChangerReset();
	        base.paddingChangerReset();
	        base.htmlBgSelect();
	        base.htmlBgTransSelect();
	    }	    
	    
	    function saveSlide()
	    {	        
	        // Execute if exist && if slider-title is filled
	        if(base.addModal.find('[name="slide-title"]').val() != "")
	        {
	            if(typeof base.bgHTMLEditorStatic != 'undefined') base.bgHTMLEditorStatic.save(); // background html editor
	            if(typeof base.contentHTMLEditor != 'undefined') base.contentHTMLEditor.save();

	            var content = tonjooWpEditor.getContent('tab-content-text');
	            	content = content.replace(/<p.*?>/g, '<p>'); // remove all 'p' attributes
	            	content = content.replace(/<span.*?>/g, '<span>'); // remove all 'span' attributes

	            $('#tab-content-text').val(content); // content text

	            modalForm.submit();
	        }
	        else alert('Please fill the slider title.');
	    };


	    /**
	     * reset default theme slide
	     */
	    $('#sslider_slide_add').parent().on('click','[sslider-slide-config-theme-replace]',function(){
	    	sslider_slide_config_theme_replace();
	    })

	    function sslider_slide_config_theme_replace() 
	    {
            var serializedData = $('#edited-sslider-data').val();
            var theme = $('select[name="config[themeClass]"]').val();

            base.ajaxOnProgress();

            var data = {
                action: 'sslider_slide_config_theme_replace',
                serializedData: serializedData,
                theme: theme,
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
                }
                else alert('Error: connection to your server is lost, please try again.');
            });
             
            return false;
	    }
	}
})(jQuery);