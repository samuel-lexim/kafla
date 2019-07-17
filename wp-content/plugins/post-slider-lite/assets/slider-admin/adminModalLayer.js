var adminModalLayer;

;(function($) {
	adminModalLayer = function(base)
	{
		var modalForm,
			modalSaveButton,
			modalDeleteButton;

		/**
	     * modal
	     */
	    base.addModalLayer.dialog({
	        autoOpen: false,
	        modal: true,
	        resizable: false,
	        draggable: false,
	        hide: false,
	        dialogClass: "fullscreen-ui-with-button-modal",
			buttons: {
		        'Save Slide': function() {
		            saveSlide();
		        }
		    },
		    create:function () {
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

	    
	    /**
	     * init modal form with ajaxForm
	     */
	    modalForm = base.addModalLayer.children('#sslider-modal-form');

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

            // insert array value of sangar_query_terms
            var $container = $('#sslider-query-editor-container');
            var terms = $container.find('select[name="sangar_query_terms"]').val();
			for (var i = 0; i < formData.length; i++) 
			{
				if(formData[i]['name'] == 'sangar_query_terms') {
					formData[i]['value'] = terms;
				}
			}

            // Query Data
            var data = {
                action: 'sslider_add_slide',
                serializedData: serializedData,
                formData: JSON.stringify(formData),
                isNewData: isNewData,
                slug: slug,
                type: 'layer',
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

                    // Save slideshow
		            base.ajaxOnProgress();

		            setTimeout(function() {
		            	$("input[type='submit'][id='publish']").trigger('click');
		            },250);
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
	    base.add_layer_slide = function()
	    {
	    	var slug = false;
	        modalForm.data('slug',false);
	        modal_slide(slug);
	    }

	    base.editSlideLayer = function(slug)
	    {
	    	modalForm.data('slug',slug);
	        modal_slide(slug);	        
	    }

	    function modal_slide(slug)
	    {
	        var button = $('[sslider-add-layer-slide]');
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

	                // background layer image
	                $('[add-layer-image] [media-upload-image]').attr('src',response.bg_image_default);
	                $('[add-layer-image] [media-remove-button]').attr('data-image-default',response.bg_image_default);

	                // background overlay
	                if(response.bg_overlay_img_url != '') {
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
	                
	                base.addModalLayer.dialog("open");
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
	                	if(typeof base.bgHTMLEditorLayer != 'undefined') 
	                		base.bgHTMLEditorLayer.setValue(value);
	                    break;

	                case 'tab-html-bg-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'tab-overlay-color':
	                    base.setMinicolors(name,value);
	                    break;

	                case 'slide-layer':
	                	// load layer
	                	if(value == '')
	                	{
	                		sangarLayer.reset('desktop');
	                		sangarLayer.reset('mobile');
	                		return;
	                	}

						// create layer
				        sangarLayer.createLayer(true,value);
	                    break;

	                case 'tab-preset':
	                	$('.sslider-preset-container')
	    					.children('.sslider-preset-items').
	    					removeClass('sslider-preset-active');

	                	$('.sslider-preset-container')
	                		.children('[data-id="'+ value +'"]')
	                		.addClass('sslider-preset-active');
	                	break;

	                case 'sangar_query_post_type':


	                	var $container = $('#sslider-query-editor-container');

                		// Reset first selection
                		$container
                			.find('select.sangar_query_terms').attr('data-number',0).val('').trigger('change')
                			.end()
                			.find('select.sangar_query_post_type').attr('data-number',0)
                			.end()
                			.find('select.sangar_query_order_by').attr('data-number',0).val('date')
                			.end()
                			.find('select.sangar_query_order').attr('data-number',0).val('DESC')
                			.end()
                			.find('input.sangar_query_limit').attr('data-number',0).val('10');

                		// for lite
                		for (var i = 0; i < value.length - 1; i++) 
		                {
		                	dataRow['sangar_query_post_type'][i] = 'post';
		                	value[i] = 'post';
		                }

                		// return if empty data
                		if(dataRow['sangar_query_post_type'] == '' || dataRow['sangar_query_post_type'].length <= 0) return;
	                	
	                	// because the first selection is displayed
		                base.querySelectNumber = 1;

		                // add selection		                
		                for (var i = 0; i < value.length - 1; i++) 
		                {
		                	var $container = $('#sslider-query-editor-container');
		                	var $toclone = $container.find(".toclone").last();

		                	$container.triggerHandler('clone_clone',[$toclone]);
		                };

		                // Query Data
			            $container.find('.sangar_query_post_type').each(function(index){
			            	var number = $(this).attr('data-number');
			            	var post_type = dataRow['sangar_query_post_type'][index];
							var enabled = $(this).children('option[value="' + post_type + '"]').length;

			            	// post type
			            	if(enabled > 0) {
			            		$(this).val(post_type).trigger('change');
			            	}

			            	// terms
			            	$container.find('.sangar_query_terms[data-number="'+ number +'"]')
			            		.val(dataRow['sangar_query_terms'][index])
			            		.trigger('change');

			            	// order by
			            	$container.find('.sangar_query_order_by[data-number="'+ number +'"]')
			            		.val(dataRow['sangar_query_order_by'][index]).trigger('change');

			            	// order
			            	$container.find('.sangar_query_order[data-number="'+ number +'"]')
			            		.val(dataRow['sangar_query_order'][index]).trigger('change');

			            	// order
			            	$container.find('.sangar_query_limit[data-number="'+ number +'"]')
			            		.val(dataRow['sangar_query_limit'][index]);
			            });
	                	
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
	    	$('.modal-sidetips#sidetips-query').show();
	    }
	    
	    function saveSlide()
	    {	        
	        // Execute if exist && if slider-title is filled
	        if(base.addModalLayer.find('[name="slide-title"]').val() != "")
	        {
	            if(typeof base.bgHTMLEditorLayer != 'undefined') base.bgHTMLEditorLayer.save(); // background html editor
	            if(typeof base.contentHTMLEditor != 'undefined') base.contentHTMLEditor.save();

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


	    /**
	     * presets
	     */
	    $('.sslider-preset-container').on('click','.sslider-preset-items',function(){

	    	if($(this).hasClass('sslider-preset-active')) return;

	    	var isChangePreset = confirm("This slide reset all layer to the selected preset.\r\nAre you sure?");

	    	if(isChangePreset == false) return;

	    	$('.sslider-preset-container')
	    		.children('.sslider-preset-items').removeClass('sslider-preset-active');

	    	$(this).addClass('sslider-preset-active');

	    	$('.sslider-preset-container')
	    		.children('[name="tab-preset"]').val($(this).data('id'));

	    	var preset = $(this).children('span').html();
	    		preset = base.base64Decode(preset);

	    	//layer
	        $('textarea[name="slide-layer"]').val(preset);
	    });

		/**
	     * animateStaggerPreview
	     */
	    function animateStaggerPreview(element)
		{
			var animation = $(element).find("select[name='tab-content-anim-type']").val();
			var stagger = $(element).find("input[name='tab-content-anim-stagger']").val();
			var duration = $(element).find("input[name='tab-content-anim-duration']").val();
		
			$(element).find(".container-layer-preview .layer-box")
			.velocity('stop')
			.velocity(animation, {
                duration: duration,
                stagger: stagger,
                visibility: 'visible'
            });
		}
		
		// action on change animation option
		$(".fullscreen-ui-with-button-modal").on('click',".do_anim_preview",function(){
			var element = $(this).closest('.table-content');
			animateStaggerPreview(element)
		})
	    
	}
})(jQuery);