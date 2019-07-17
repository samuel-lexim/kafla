var adminSlideManagement;

;(function($) {
    adminSlideManagement = function(base)
    {
    	/**
	     * Confirm delete dialog
	     */    	
		$('#sslider-slideshow-delete-dialog').dialog({
			autoOpen: false,
			resizable: false,
		    width: 420,
		    height: 200,
		    modal: true,
		    dialogClass: "ssliderConfirmDialog",
		    buttons: {
		        Cancel: function() {
		          	$(this).dialog("close");
		        },
		        "Yes, delete this item": function() {
		        	var slug = $(this).data('delete').slug;
		        	var isModal = $(this).data('delete').isModal;

		          	base.deleteSlide(slug,isModal);
		          	$(this).dialog("close");
		        }
		    },
		    create: function () {
		        var btn = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane');
		        	btn.find(".ui-button:last").css('color','#a00');
		    }
		}).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');


		/**
	     * Confirm dialog
	     */    	
		$('#sslider-slideshow-confirm-dialog').dialog({
			autoOpen: false,
			resizable: false,
		    width: 420,
		    height: 200,
		    modal: true,
		    dialogClass: "ssliderConfirmDialog",
		    buttons: {
		        Cancel: function() {
		          	$(this).dialog("close");
		        },
		        "Yes, delete this item": function() {
		        	var slug = $(this).data('delete').slug;
		        	var isModal = $(this).data('delete').isModal;

		          	base.deleteSlide(slug,isModal);
		          	$(this).dialog("close");
		        }
		    },
		    create: function () {
		        var btn = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane');
		        	btn.find(".ui-button:last").css('color','#a00');
		    }
		}).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');


		/**
	     * Delete slide
	     */
	    $('#sslider_slide_management').on('click','[sslider-delete-slide]',function(){
	        $('#sslider-slideshow-delete-dialog').dialog('open')
	        	.data('delete',{
	        		slug: $(this).data('slug'),
	        		isModal: false
	        	});
	    });

	    base.deleteSlide = function(slug,isModal)
	    {
	    	console.log(isModal);

            var serializedData = $('#edited-sslider-data').val();

            base.ajaxOnProgress();

            var data = {
                action: 'sslider_delete_slide',
                serializedData: serializedData,
                slug: slug,
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

                    if(isModal)
                    {
                    	base.addModal.dialog("close");
                    	base.addModalLayer.dialog("close");
                    }
                }
                else alert('Error: connection to your server is lost, please try again.');
            });
	    }


	    /**
	     * Add preview button
	     */
	    if($('#publishing-action').length > 0) {
	    	if($('#sslider-slides-list').children('li.slide_item').length > 0) 
	    	{
	    		var str = '<a href="javascript:;" id="sslider-preview-slide" class="button">Preview</a>';

	    		$(str).insertBefore("input[id='publish']");
	    	}
	    	else
	    	{
	    		$("input[id='publish']").val('Save');
	    	}
	    }


	    /**
	     * Duplicate slide
	     */
	    $('#sslider_slide_management').on('click','[sslider-duplicate-slide]',function(){
	        var slug = $(this).data('slug');

	        duplicate_slide(slug);
	    });

	    function duplicate_slide(slug)
	    {
	        var serializedData = $('#edited-sslider-data').val();

	        base.ajaxOnProgress();

	        var data = {
	            action: 'sslider_duplicate_slide',
	            serializedData: serializedData,
	            slug: slug,
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
	    }


	    /**
	     * Sortable
	     */
	    ssliderSortable();

	    function ssliderSortable(){
	        $('ul#sslider-slides-list').sortable({
	            items: '.list_item:not(#add-new-slide):not(.not-a-sangar-data)',
	            opacity: 0.5,
	            cursor: 'pointer',
	            distance: 5,
	            placeholder: "sslider-management-placeholder",
	            update: function() {
	                
	                var serializedData = $('#edited-sslider-data').val();

	                base.ajaxOnProgress();

	                var data = {
	                    action: 'sslider_sort_slides',
	                    serializedData: serializedData,
	                    order: $(this).sortable('toArray'),
	            		defaultSlideOptions: defaultSlideOptions
	                }

	                $.post(ajaxurl, data, function(response){

	                	base.ajaxOnProgress('hide');

	                    var response = $.parseJSON(response);

	                    if(response.success)
	                    {
	                        $('#edited-sslider-data').val(response.serialized);base.showSaveNotif();
	                    }
	                    else alert('Error: connection to your server is lost, please try again.');
	                });

	                // order number
	                $(this).children('li').each(function(index){
	                	var number = index + 1;

	                	$(this).find('.sslider_slide_order').html(number);
	                });
	            },
	            helper: function(e, tr){
	                
	                var originals = tr.children();
	                var helper = tr.clone();
	                helper.children().each(function(index)
	                {
	                    // Set helper cell sizes to match the original sizes
	                    $(this).width(originals.eq(index).width());
	            
	                });
	                
	                return helper;
	            }
	        });
	    }


	    /**
	     * Slides list on hover
	     */
	    $('#sslider-slides-list').on('mouseenter','.list_item:not(#add-new-slide):not(.not-a-sangar-data)', function(){
	        $(this).children('.sslider_td_container').children('.sslider_slide_edit').show();
	        $(this).css({
	            '-webkit-box-shadow': '0 0 7px rgba(0,0,0,0.2)',
	            '-moz-box-shadow': '0 0 7px rgba(0,0,0,0.2)',
	            'box-shadow': '0 0 7px rgba(0,0,0,0.2)',
	            'border-color': '#ccc',
	            'background': 'rgb(255, 255, 255)'
	        });

	    }).on('mouseleave','.list_item:not(#add-new-slide):not(.not-a-sangar-data)', function(){
	        $(this).children('.sslider_td_container').children('.sslider_slide_edit').hide();

	        $(this).css({
	            '-webkit-box-shadow': '0 0 7px rgba(0,0,0,0)',
	            '-moz-box-shadow': '0 0 7px rgba(0,0,0,0)',
	            'box-shadow': '0 0 7px rgba(0,0,0,0)',
	            'border-color': '#E5E5E5',
	            'background-color': '#F9F9F9'
	        });
	    });


	    /**
	     * Load theme on select template dropdown
	     */
	    var template_opt = $('#sslider_configuration').find('select[name="config[template]"]');
	    var theme_opt = $('#sslider_configuration').find('select[name="config[themeClass]"]');
	    var selected_theme = $('span#onloaded_slider_theme').html();


	    reinit_dropdown_theme(template_opt,selected_theme,true); // run on load

	    /**
         * Thumbnail template
         */
        $('#sslider-thumb-templates .sslider-template').on('click','a',function(){
        	var template = $(this).data('template');

        	var replace = replace_all_config(template); // if return true, will execute all script below

        	if(! replace) return;

        	$("select[name='config[template]']").val(template);

        	var selected_theme = $('select[name="config[themeClass]"]').val();

        	// set active
        	$('#sslider-thumb-templates .sslider-template').removeClass('active');
        	$(this).parent('.sslider-template').addClass('active');
	    	
	    	// reinit_dropdown_theme
	    	var template_opt = $('#sslider_configuration').find('select[name="config[template]"]');
	    	reinit_dropdown_theme(template_opt,selected_theme,false);
        });

	    function replace_all_config(template)
	    {
	    	var change = confirm("Do you want to change the template?. This will reset all options. Are you sure?");
			if (! change) return false;

	    	var allConfig = $('span#sslider-default-config').html();
	    		allConfig = $.parseJSON(allConfig);

	    	var config = allConfig['default'];

	    	// unset
	    	delete config['template'];
	    	delete config['themeClass'];
	    	delete config['custom_css'];

	    	// replace some default with template's config
	    	$.each(config,function(index, value){
	    		var templateConfig = allConfig['templates'][template]['config'];

	    		if(typeof templateConfig[index] !== 'undefined')
	    		{
	    			config[index] = templateConfig[index];
	    		}

	    		// fill the fields
	    		$('#sslider_configuration').find('[name="config['+ index +']"]').val(config[index]);
	    	});

	    	return true;
	    }

	    function reinit_dropdown_theme(el,selected_theme,firstInit)
	    {
	    	var theme = $(el).find('option:selected').data('theme');	    	
	    	var new_theme_opt;

	    	$.each(theme,function(key,value) {
			  	var label = value;
		  		
		  		label = label.replace(/\_/g, ' '); // replace "_" to space
		  		label = label.replace(/\-/g, ' '); // replace "-" to space

		  		// uppercase every first word
		  		label = label.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			    	return letter.toUpperCase();
				});

		  		// set selected
		  		var selected = value == selected_theme ? 'selected' : '';

	    		new_theme_opt += "<option value='"+ value +"' "+ selected +" >"+ label +"</option>";
			});

	    	// change theme opt html
	    	var theme_opt = $('#sslider_configuration').find('select[name="config[themeClass]"]');	    	
	    	theme_opt.html(new_theme_opt);

	    	// load custom css to editor
	    	if(firstInit && $('textarea[name="config[custom_css]"]').val() != '') return;
	    	setCustomCSSTheme(theme_opt.val(),true,firstInit);
	    }


        /**
	     * Custom CSS get file
	     */
        $('#sslider_configuration').on('change','select[name="config[themeClass]"]',function(){        	

	    	setCustomCSSTheme($(this).val(),false,false);
	    });

        function setCustomCSSTheme(themeVal,isChangeTemplate,firstInit)
        {
        	var selectedTheme = $('span#onloaded_slider_theme');

        	if(! firstInit && selectedTheme.html() == themeVal) return; // if theme is same

        	selectedTheme.html(themeVal);

        	var isChange = false;
        	var templateVal = $('select[name="config[template]"]').val();

        	base.ajaxOnProgress();

        	var data = {
                action: 'sslider_get_theme_file',
                template: templateVal,
                theme: themeVal,
	            defaultSlideOptions: defaultSlideOptions
            }

            $.post(ajaxurl, data, function(response){

            	base.ajaxOnProgress('hide');

                var response = $.parseJSON(response);

                if(response.success)
                {
                	var oldCustomCSS = base.customCSS.getDoc().getValue();

                	// Cleaning, because "file_get_contents" is adding some unexpected char
                	var cleaningResponse = $('#temp_custom_css').val(response.textfile);
					var cleanedTextfile = cleaningResponse.val()

					if(! firstInit)
					{
						if(oldCustomCSS != cleanedTextfile)
	                	{
	                		var change = confirm("Do you want to change the template/themes. This will reset all options and css. Are you sure?");
							if (change == true) 
							{
							    isChange = true;
							} 
							else 
							{
							    isChange = false;
							}
	                	}
	                	else isChange = true;
					}
					else isChange = true;

                	// change the Custom CSS
                	if(isChange == true)
                	{
                		$('textarea[name="config[custom_css]"]').val(cleanedTextfile);

                    	base.customCSS.getDoc().setValue(cleanedTextfile);

                    	// template select
            			var template = $('select[name="config[template]"]');
            			template.data('old',template.val());

            			// theme select
            			var themeClass = $('select[name="config[themeClass]"]');  
            			themeClass.data('old',themeClass.val());
                	}
                	else
                	{
                		var themeClass = $('select[name="config[themeClass]"]');                		

                		if(isChangeTemplate)
                		{
                			// template select
                			var template = $('select[name="config[template]"]');
                			template.val(template.data('old'));

                			// reload theme select
	    					reinit_dropdown_theme(template,themeClass.data('old'),false);

                			// template thumbnail
                			var templateThumb = $('#sslider-thumb-templates .sslider-template');
				        	templateThumb.removeClass('active');
				        	templateThumb.find('a[data-template="'+template.data('old')+'"]').parent('.sslider-template').addClass('active');
                		}

                		// theme select
                		themeClass.val(themeClass.data('old'));
                	}
                }
                else alert('Error: connection to your server is lost, please try again.');
            });
        }


        /**
	     * Custom CSS modal
	     */
        base.cssModal.dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            draggable: false,
            hide: false,
            dialogClass: "fullscreen-ui-with-button-modal",
            buttons: {
		        'Save Custom CSS': function() {
		        	$('textarea[name="config[custom_css]"]').val(base.customCSS.getDoc().getValue());
		            
		            base.ajaxOnProgress();

		            setTimeout(function() {
		            	$("input[type='submit'][id='publish']").trigger('click');
		            },250);
		        }
		    },
		    create:function(){
		        modalSaveButton = $(this).closest(".ui-dialog").children('.ui-dialog-buttonpane').find(".ui-button:last");		        
		        modalSaveButton.addClass("button-primary button");
		    },
		    open: function (event, ui) {
		    	base.customCSS.getDoc().setValue($('textarea[name="config[custom_css]"]').val())

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

        $("[sslider-custom-css]").click(function(){
            base.cssModal.dialog("open");

            setTimeout(function() {
                base.customCSS.refresh();
            },1);
        });


        /**
         * Navigation options
         */
        nav_autohide();
        $('select[name="config[directionalNav]"]').change(function(){
        	nav_autohide();
        });

        function nav_autohide(){
        	var value = $('select[name="config[directionalNav]"]').val();

        	if(value == 'autohide'){
        		$('.nav-autohide-attr').show();
        	}
        	else
        	{
        		$('.nav-autohide-attr').hide();
        	}
        }

        
        /**
	     * Advanced Configuration modal
	     */
        base.configModal.dialog({
           	autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        dialogClass: "modal-add-layer",
	        hide: false,
	        width: 800,
	        height: 500,
	        appendTo: '#sslider-conf-settings-container',
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

        $("[sslider-advanced-config]").click(function(){
            base.configModal.dialog("open");
        });


        /**
		 * Actions
		 */
		$('#sslider_slide_management').on('click','[sslider-edit-slide]',function(){
			var co = $(this).parents('.sslider_td_container');

			if(co.data('type') == 'static')
			{
				base.editSlideStatic(co.data('slug'));
			}
			else if(co.data('type') == 'layer')
			{
				base.editSlideLayer(co.data('slug'));
			}
			else if(co.data('type') == 'iframe')
			{
				base.editSlideYoutube(co.data('slug'));
			}
		})

	}
})(jQuery);