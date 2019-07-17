var adminSlideManagement;

;(function($) {
    adminSlideManagement = function(base)
    {
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

	    	// save and reload slider
	    	setTimeout(function() {
	    		base.ajaxOnProgress();
            	$("input[type='submit'][id='publish']").trigger('click');
            },250);
        });

	    // $('#sslider_configuration').on('change','select[name="config[template]"]',function(){
	    	
	    // });

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

            console.log(data);

            $.post(ajaxurl, data, function(response){

            	console.log(response);

            	// return;

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

            			// save and reload slider
            			if(! firstInit)
						{
					    	setTimeout(function() {
					    		base.ajaxOnProgress();
				            	$("input[type='submit'][id='publish']").trigger('click');
				            },250);
					    }
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
		$('[sslider-config-post-slider]').on('click',function(){
			var slug = $(this).data('slug');

			base.editSlideLayer(slug);
		})

	}
})(jQuery);