var adminLayer;

;(function($) {
	adminLayer = function(base)
	{
		var desktopWidth = 0, mobileWidth = 0,
			desktopOriWidth = 0;

	    base.resizeLayerContainer = function(type)
	    {
	    	var conf = $('#sslider_configuration');	    	
	    	var mobileDimension = conf.find('select[name="config[mobileDimension]"]').val()
	    	
	    	var slider = {
	    		width: conf.find('input[name="config[width]"]').val(),
	    		height: conf.find('input[name="config[height]"]').val()
	    	}

	    	desktopOriWidth = slider.width;

	    	// type mobile
	    	if(type == 'mobile' && mobileDimension == 'true')
	    	{
		    	var slider = {
		    		width: conf.find('input[name="config[mobileWidth]"]').val(),
	    			height: conf.find('input[name="config[mobileHeight]"]').val()
		    	}

		    	var mobileHeight = $('#opt-'+ type).height() - 32;

		    	var minusResize = slider.height - mobileHeight;
	            var percentMinus = (minusResize / slider.height) * 100;

	            var mobileWidth = slider.width - (slider.width * percentMinus / 100);

		    	$('#opt-'+ type +' .sangar-layer').css('width', mobileWidth + 'px');
	    	}

	    	var layerElement = $('#sslider-add-layer-slide-modal').find('.sangar-layer');

	    	if(layerElement.length <= 0) return;

	    	if(typeof(type) === 'undefined')
	    	{
	    		$.each(layerElement,function(){
		    		var type = $(this).children('.canvas-container').data('type');

		    		resize(type);
		    	});
	    	}
	    	else resize(type);
	    	
            function resize(type)
            {
            	var layer = $('#opt-'+ type +' .sangar-layer');
		    	var width = layer.width();

		    	var minusResize = slider.width - width;
	            var percentMinus = (minusResize / slider.width) * 100;

	            var height = slider.height - (slider.height * percentMinus / 100);

	            layer.children('.canvas-container').css('height', height + 'px');

	            /**
	             * RE - Resize to avoid scroll
	             */
	            var layer = $('#opt-'+ type +' .sangar-layer');
		    	var width = layer.width();

		    	var minusResize = slider.width - width;
	            var percentMinus = (minusResize / slider.width) * 100;

	            var height = slider.height - (slider.height * percentMinus / 100);

	            layer.children('.canvas-container').css({
	            	'width': width + 'px',
	            	'height': height + 'px'
	            });

	            // percent
	            var defaultPercent = 62.5;
	            var newPercent = (width / slider.width) * defaultPercent;
	            var realPercent = (width / slider.width) * 100;
	            var canvasPercentHTML = 'Original size: ' + slider.width + ' &times; ' + slider.height + '<br>';
	            	canvasPercentHTML+= 'Resize scale: ' + realPercent.toFixed(2) + '%';

	            layer
	            	.children('.canvas-container')
	            	.data('percent',newPercent)
	            	.css('font-size',newPercent + '%');

	            layer
	            	.children('.canvas-percent')
	            	.html(canvasPercentHTML);
            }
	    }

	    /**
		 * Layer modal tab binding
		 */
		$('.fullscreen-ui-with-button-modal a.media-menu-item').on('click',function(){

			switch($(this).attr('id'))
			{
				case 'opt-desktop-tab':
					var element = $(this).closest('#sslider-modal-form');

					var width = $('#opt-desktop .sangar-layer').width();
					var selection = $(element).find('#opt-background [name="tab-bg-selection"]').val();
					var bg = $(element).find('#opt-background [tab-bg-image] input[media-upload-image-url]').val();
					var video_bg = $(element).find('#opt-background [tab-bg-video-html5-poster] input[media-upload-image-url]').val();
					var color = $(element).find('#opt-background input[name="tab-bg-color"]').val();	

					if(selection == 'image' && bg != '')
					{
						$('#opt-desktop .sangar-layer').css({
							'background':'url(' + bg + ')',
							'background-repeat':'no-repeat',
							'background-position':'center',
							'background-size':'cover'
						});
					}
					else if(selection == 'video' && video_bg != '')
					{
						$('#opt-desktop .sangar-layer').css({
							'background':'url(' + video_bg + ')',
							'background-repeat':'no-repeat',
							'background-position':'center',
							'background-size':'cover'
						});
					}
					else if(selection == 'color')
					{
						$('#opt-desktop .sangar-layer').css('background',color);
					}
					else
					{
						$('#opt-desktop .sangar-layer').css('background','');
					}
					
					// if(width != desktopWidth)
					// {
						desktopWidth = $('#opt-desktop .sangar-layer').width();
						base.resizeLayerContainer('desktop');
						sangarLayer.renderLayer('desktop');			
					// }

					// on load
					if(sangarLayer.getSnap('desktop') == false)
					{
						$('.sangar-layer .canvas-container.canvas-desktop').css({
			    			'background': 'none'
			    		}).find('#sslider-toggle-snap').addClass('toggle-off');
					}
					else
					{
						$('.sangar-layer .canvas-container.canvas-desktop').css({
			    			'background': ''
			    		}).find('#sslider-toggle-snap').addClass('toggle-on');
					}	

					break;

				case 'opt-mobile-tab':
					var element = $(this).closest('#sslider-modal-form');

					var width = $('#opt-mobile .sangar-layer').width();
					var selection = $(element).find('#opt-background [name="tab-bg-selection"]').val();
					var bg = $(element).find('#opt-background [tab-bg-image] input[media-upload-image-url]').val();
					var video_bg = $(element).find('#opt-background [tab-bg-video-html5-poster] input[media-upload-image-url]').val();
					var color = $(element).find('#opt-background input[name="tab-bg-color"]').val();					

					if(selection == 'image' && bg != '')
					{
						$('#opt-mobile .sangar-layer').css({
							'background':'url(' + bg + ')',
							'background-repeat':'no-repeat',
							'background-position':'center',
							'background-size':'cover'
						});
					}
					else if(selection == 'video' && video_bg != '')
					{
						$('#opt-mobile .sangar-layer').css({
							'background':'url(' + video_bg + ')',
							'background-repeat':'no-repeat',
							'background-position':'center',
							'background-size':'cover'
						});
					}
					else if(selection == 'color')
					{
						$('#opt-mobile .sangar-layer').css('background',color);
					}
					else
					{
						$('#opt-mobile .sangar-layer').css('background','');
					}

					// if(width != mobileWidth)
					// {
						mobileWidth = $('#opt-mobile .sangar-layer').width();
						base.resizeLayerContainer('mobile');
						sangarLayer.renderLayer('mobile');
					// }

					toggleMobileActive(null);

					// on load
					if(sangarLayer.getSnap('mobile') == false)
					{
						$('.sangar-layer .canvas-container.canvas-mobile').css({
			    			'background': 'none'
			    		}).find('#sslider-toggle-snap').addClass('toggle-off');
					}
					else
					{
						$('.sangar-layer .canvas-container.canvas-mobile').css({
			    			'background': ''
			    		}).find('#sslider-toggle-snap').addClass('toggle-on');
					}					

					break;

				default:
					// silent is golden
			}
		})

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

		// desktop		
		$('#opt-desktop').on('click','#sslider-layer-add',function(){
			sangarCanvas.addBox('desktop');
		})
		$('#opt-desktop').on('click','#sslider-layer-reset',function(){		
			var isReset = confirm("This action will delete all layers permanently.\r\nAre you sure?");
		
	    	if(isReset) sangarLayer.reset('desktop');			
		})
		$('#opt-desktop').on('click','#sslider-toggle-snap',function(){
	    	sangarLayer.toggleSnap('desktop');

	    	if($(this).hasClass('toggle-on'))
	    	{
	    		$(this).removeClass('toggle-on').addClass('toggle-off');

	    		$('.sangar-layer .canvas-container.canvas-desktop').css({
	    			'background': 'none'
	    		});
	    	}
	    	else
	    	{
	    		$(this).removeClass('toggle-off').addClass('toggle-on');

	    		$('.sangar-layer .canvas-container.canvas-desktop').css({
	    			'background': ''
	    		});
	    	}
		})
		$('#opt-desktop').on('click','#sslider-refresh-grid',function(){
			var isReset = confirm("This action will re-set all width and position to the newest grid.\r\nAre you sure?");

	    	if(isReset) sangarLayer.refreshGrid('desktop');
		})
		$('#opt-desktop').on('click','#sslider-play-animation',function(){
	    	playAnimation('desktop');
		})

		// mobile
		$('#opt-mobile').on('click','#sslider-layer-add',function(){
			sangarCanvas.addBox('mobile');
		})		
		$('#opt-mobile').on('click','#sslider-layer-reset',function(){		
			var isReset = confirm("This action will delete all layers permanently.\r\nAre you sure?");

	    	if(isReset) sangarLayer.reset('mobile');			
		})
		$('#opt-mobile').on('click','#sslider-toggle-snap',function(){
	    	sangarLayer.toggleSnap('mobile');

	    	if($(this).hasClass('toggle-on'))
	    	{
	    		$(this).removeClass('toggle-on').addClass('toggle-off');

	    		$('.sangar-layer .canvas-container.canvas-mobile').css({
	    			'background': 'none'
	    		});
	    	}
	    	else
	    	{
	    		$(this).removeClass('toggle-off').addClass('toggle-on');

	    		$('.sangar-layer .canvas-container.canvas-mobile').css({
	    			'background': ''
	    		});
	    	}
		})
		$('#opt-mobile').on('click','#sslider-refresh-grid',function(){
			var isReset = confirm("This action will re-set all width and position to the newest grid.\r\nAre you sure?");
			
	    	if(isReset) sangarLayer.refreshGrid('mobile');
		})
		$('#opt-mobile').on('click','#sslider-play-animation',function(){
	    	playAnimation('mobile');
		})

		$('.media-frame-menu .media-menu .switch').on('click','a',function(){
			var action = $(this).attr('class');
			var slug = $(this).parents('#sslider-modal-form').data('slug');
			var isSwitch = confirm("This action will reset all slide data, both of standard and layered mode, and then switch the slide mode to what mode you desire.\r\nAre you sure?");

			if(! isSwitch) return;

			// close previous modal
			if(action == 'switch-on')
			{
				base.addModalLayer.dialog("close");
			}
			else if(action == 'switch-off')
			{
				base.addModal.dialog("close");				
			}

			// show new modal
			if(slug)
			{
				var serializedData = $('#edited-sslider-data').val();

				base.ajaxOnProgress();

	            var data = {
	                action: 'sslider_switch_type',
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

	                    $('#sslider-slides-list').children('#' + slug).find('.sslider-btn-edit').trigger('click');
	                }
	                else alert('Error: connection to your server is lost, please try again.');

	            });				
			}
			else
			{				
				if(action == 'switch-on')
				{
					base.add_standart_slide();
				}
				else if(action == 'switch-off')
				{
					base.add_layer_slide();
				}
			}
		})

		$('#opt-mobile').on('click','#sslider-toggle-active',function(){

	    	var action = $('#opt-mobile').find('input[name="slide-layer-is-mobile"]').val();

	    	if(action == 'true') toggleMobileActive('false');
	    	else toggleMobileActive('true');
		})

		function toggleMobileActive(action)
		{
			if(action == null)
			{
				var action = $('#opt-mobile').find('input[name="slide-layer-is-mobile"]').val();

				toggleMobileActive(action);
				return;
			}

			$('#opt-mobile').find('input[name="slide-layer-is-mobile"]').val(action);

			if(action == 'false')
			{
				$('#opt-mobile .sangar-layer-button a').hide();
				$('#opt-mobile .sangar-layer-button #sslider-toggle-active')
					.show().removeClass('toggle-on').addClass('toggle-off')
					.html('Mobile Mode Off');
			}
			else if(action == 'true')
			{
				$('#opt-mobile .sangar-layer-button a').show();
				$('#opt-mobile .sangar-layer-button #sslider-toggle-active')
					.removeClass('toggle-off').addClass('toggle-on')
					.html('');
			}
		}

		// layer hover
		$('.sangar-layer').on('hover','.layer',function(e) {
		    if (e.type == "mouseenter") {
		        $(this).addClass('show-toolbox');
		    }
		    else {
		        $(this).removeClass('show-toolbox');
		    }
		})


		// show all toolbox
		$('.sangar-layer-button .sslider-toggle-toolbox').click(function(){
			if($(this).hasClass('toggle-on'))
			{
				$(this).removeClass('toggle-on').addClass('toggle-off');
				$(this).parents('.sangar-layer').removeClass('show-toolbox');
			}	
			else
			{
				$(this).removeClass('toggle-off').addClass('toggle-on');
				$(this).parents('.sangar-layer').addClass('show-toolbox');
			}
		})


		/**
		 * Play Animation
		 */
		function playAnimation(type)
		{
			var layerModal = $('#sslider-add-layer-slide-modal');
			var animation = layerModal.find('select[name="tab-content-anim-type"]').val();
			var duration = layerModal.find('input[name="tab-content-anim-duration"]').val();
			var stagger = layerModal.find('input[name="tab-content-anim-stagger"]').val();

			$('.sangar-layer .canvas-container.canvas-' + type + ' .layer')
			.velocity('stop')
			.velocity(animation, {
                duration: duration,
                stagger: stagger,
                visibility: 'visible'
            });
		}


		/**
		 * Prevent link to click
		 */
		$('.sangar-layer .canvas-container').on('click','.layer .layer-content a',function(){
			alert('All hyperlink is disable to click on layer editor');

			return false;
		});

		
		/**
		 * Modal Add Image
		 */
		$('#layer-modal-image').dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Layer Image",
	        dialogClass: "modal-add-layer",
	        width: 665,
	        height: 475,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Apply': function(){
		            var id = $(this).data('id');
					var type = $(this).data('type');
					var img_id = $(this).find('input[name="add-layer-image"]').val();
					var selected = $(this).find('#add-layer-image-size select option:selected');
					var image = selected.attr('url');					
					var content = $('.sangar-layer .canvas-' + type).find('#sangar-layer-' + type + '-' + id);
					
					var img_size_option = $(this).find('#add-layer-image-size').html();
					var img_src = $(this).find('[add-layer-image] [media-upload-image]').attr('src');

					var hyperlink = $(this).find('#add-layer-image-hyperlink');
						hyperlink = hyperlink.val();

					var hyperlinkTarget = $(this).find('#add-layer-image-hyperlink-target');
						hyperlinkTarget = hyperlinkTarget.val();

					var youtube_popup = $(this).find('#add-layer-image-youtube-popup')[0].checked;
					var youtube_source = $(this).find('#add-layer-image-youtube-source').val();

					if(img_src == '') return;

					// html
					var html = '<img src="'+ image +'" >';

					if(hyperlink != '')
					{
						var html = '<a href="'+ hyperlink +'" target="'+ hyperlinkTarget +'"><img src="'+ image +'" ></a>';
					}

					if(youtube_popup)
					{
						var html = '<a href="javascript:;" class="sangar-slider-video-modal" data-video="'+ youtube_source +'"><img src="'+ image +'" ></a>';
					}

					content.children('.layer-container').children('.layer-content').html(html);
		        	
		        	// dimension
		        	var width = selected.attr('width');
					var height = selected.attr('height');
		        	var modWidth = width % 10;
		        	var modHeight = height % 10;

		        	width = modWidth > 0 ? width - modWidth + 10 : width;
		        	height = modHeight > 0 ? height - modHeight + 10 : height;

		        	var canvasContainer = $('.sangar-layer .canvas-' + type);
		        	height = height > canvasContainer.height() ? canvasContainer.height() : height;
		        	width = width > canvasContainer.width() ? canvasContainer.width() : width;

		        	content.css({
		        		'height': height + 'px',
		        		'width': width + 'px'
		        	})

		        	/** comment this because image width is 100% */
		        	// content.find('.layer-content').css({
		        	// 	'height': height + 'px',
		        	// 	'width': width + 'px'
		        	// })
		        	
		        	// save dimension
		        	sangarCanvas.setBoxDimension(id,type);

		        	// background
		        	var background = 'none';
		        	
		        	// save content html
		        	var data = {
		        		html: html,		        		
		        		background: background,
		        		contentType: 'image',
		        		others: {
		        			img_size_option: img_size_option,
		        			img_size: selected.val(),
		        			img_src: img_src,
		        			hyperlink: hyperlink,
		        			hyperlinkTarget: hyperlinkTarget,
		        			youtube_popup: youtube_popup,
		        			youtube_source: youtube_source,
		        		}
		        	}

		        	sangarCanvas.saveContentHtml(id,type,data);

		        	// set enable resizeable
		        	content.resizable("enable");

		        	// add class edit-layer-image
		        	content.find('.layer-edit').data('type','image');

		        	// close modal
		        	$(this).dialog('close');
		        }
		    },
		    create:function () {
		        base.setModalButtonColor(this);
		    },
		    open:function () {
		    	var id = $(this).data('id');
		    	var type = $(this).data('type');
		        var data = sangarLayer.getLayer()[type].content[id];

		        // cleaning form
		        $(this).find('[add-layer-image] [media-remove-button]').trigger('click');
		        $(this).find('input[type="text"]').val('');
		        $(this).find('select').prop('selectedIndex',0);
		        $(this).find('#add-layer-image-video-iframe-preview').html('');

		        if(! data.html) return;

		        var others = data.others;

		        // fill form
		        $(this).find('[add-layer-image] [media-upload-image]').attr('src',others.img_src);
		        $(this).find('#add-layer-image-size').html(others.img_size_option);
		        $(this).find('#add-layer-image-size select').val(others.img_size);  

            	$(this).find('#add-layer-image-hyperlink').val(others.hyperlink);
            	$(this).find('#add-layer-image-hyperlink-target').val(others.hyperlinkTarget);       

            	$(this).find('#add-layer-image-youtube-popup')[0].checked = others.youtube_popup;
				$(this).find('#add-layer-image-youtube-source').val(others.youtube_source);

				// load iframe video
				if(others.youtube_source != '')
				{
					$(this).find('#add-layer-image-youtube-source').trigger('keyup');
				}

            	base.select2trigger($(this));     	
		    }		    
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

		$('.sangar-layer').on('click','.add-image',function(){
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-image');

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})

		/**
		 * Modal Add Text
		 */
		$('#layer-modal-text').dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Layer Text",
	        dialogClass: "modal-without-tab",
	        width: 665,
	        height: 475,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Apply': function(){
		            var id = $(this).data('id');
					var type = $(this).data('type');
					var content = $('.sangar-layer .canvas-' + type).find('#sangar-layer-' + type + '-' + id);

					var padding = $(this).find('select[name = add-layer-text-padding]').val();
					var padding_custom = $(this).find('#add-layer-text-padding-custom').val();
					var padding_select = {
						'small': '0.5em 0.75em',
						'medium': '0.75em 1em',
						'large': '1.0em 1.25em',
						'x-large': '1.25em 1.5em',
						'custom': padding_custom
					}

					var others = {
						text: $(this).find('#add-layer-text').val(),
						align: $(this).find('select[name = add-layer-text-align]').val(),
						size: $(this).find('#add-layer-text-size').val(),
						color: $(this).find('#add-layer-text-color').val(),
	        			line_height: $(this).find('#add-layer-text-line-height').val(),
	        			font_type: $(this).find('select[name = add-layer-text-font-type]').val(),
	        			
	        			font_weight: $(this).find('select[name = add-layer-text-font-weight]').val(),
	        			text_transform: $(this).find('select[name = add-layer-text-transform]').val(),
	        			letter_spacing: $(this).find('#add-layer-text-letter-spacing').val(),
	        			text_shadow: $(this).find('#add-layer-text-shadow').val(),
	        			
	        			background: $(this).find('#add-layer-text-background-color').val(),

	        			border_size: $(this).find('#add-layer-text-border-size').val(),
	        			border_color: $(this).find('#add-layer-text-border-color').val(),
	        			border_radius: $(this).find('#add-layer-text-border-radius').val(),
	        			
	        			padding: padding,
	        			padding_custom: padding_custom
	        		}

	        		if(others.text == '') return;

	        		var background = 'none';

	        		// CONTAINER CSS
	        		var css = "position:absolute;top:0;right:0;bottom:0;left:0;overflow:hidden;";
	        			css+= "text-align: " + others.align + ';';
	        			css+= "padding: " + padding_select[padding] + ";";

	        		if(others.background != '')
	        			css+= "background: " + others.background + ';';

	        		if(others.border_size != '')
	        			css+= "border: " + others.border_size + 'px solid ' + others.border_color + ';';

	        		if(others.border_radius != '')
	        		{
	        			css+= "-webkit-border-radius: " + others.border_radius + 'px;';
	        			css+= "-moz-border-radius: " + others.border_radius + 'px;';
	        			css+= "border-radius: " + others.border_radius + 'px;';
	        		}

	        		if(others.font_type != '')
	        			css+= 'font-family: "' + others.font_type + '";';

	        		// TEXT CSS
	        		var p_css = "margin: 0px;";

	        		if(others.line_height != '')
	        			p_css+= "line-height: " + others.line_height + ';';
	        		else
	        			p_css+= "line-height: 1.5;";

	        		if(others.size != '')
	        			p_css+= "font-size: " + others.size + "em;";

	        		if(others.color != '')
	        			p_css+= "color: " + others.color + ";";

	        		if(others.font_weight != '')
						p_css+= "font-weight: " + others.font_weight + ";";

					if(others.text_transform != '')
						p_css+= "text-transform: " + others.text_transform + ";";

					if(others.letter_spacing != '')
						p_css+= "letter-spacing: " + others.letter_spacing + "em;";

					if(others.text_shadow != '')
						p_css+= "text-shadow: 0.02em 0.03em 0.07em " + others.text_shadow + ";";


	        		// old value
					var layerContent = content.children('.layer-container').children('.layer-content');
					var oldWidth = layerContent.outerWidth(true);
					var oldHeight = layerContent.outerHeight(true);

					// webfont
					var strfont = tonjooGoogleFonts[others.font_type];
					if(typeof(strfont) !== 'undefined')
					{
						WebFont.load({
						    google: {
						      	families: [strfont]
						    }
						});
					}					

	        		// print html
					var html = "<div style='" + css + "' ><p style='" + p_css + "'>" + others.text + "</p></div>";
					
					// html
					content.children('.layer-container').children('.layer-content').html(html);
		        	
					// dimension
					if(content.hasClass('new-layer'))
					{
						var width = 300;
						var height = 150;

			        	// height
		        		content.css('height', height + 'px');
		        		content.find('.layer-content').css('height', height + 'px');

			        	// width
		        		content.css('width', width + 'px');
		        		content.find('.layer-content').css('width', width + 'px');
					}		        	

		        	var hyperlink = $(this).find('#add-layer-text-hyperlink');
						hyperlink = hyperlink.val();

					var hyperlinkTarget = $(this).find('#add-layer-text-hyperlink-target');
						hyperlinkTarget = hyperlinkTarget.val();
		        	
		        	// save dimension
		        	sangarCanvas.setBoxDimension(id,type);
		        	
		        	// save content html
		        	var data = {
		        		html: html,
		        		background: background,
		        		hyperlink: hyperlink,
		        		hyperlinkTarget: hyperlinkTarget,
		        		contentType: 'text',
		        		others: others
		        	}

		        	sangarCanvas.saveContentHtml(id,type,data);

		        	// set enable resizeable
		        	content.resizable("enable");

		        	// add class edit-layer-image
		        	content.find('.layer-edit').data('type','text');

		        	// close modal
		        	$(this).dialog('close');
		        }
		    },
		    create:function () {
		        base.setModalButtonColor(this);
		    },
		    open:function () {
		    	var id = $(this).data('id');
		    	var type = $(this).data('type');
		        var data = sangarLayer.getLayer()[type].content[id];

		        // cleaning form
		        $(this).find('input[type="text"]').val('');
		        $(this).find('input[type="number"]').val('');
		        $(this).find('select').prop('selectedIndex',0);

		        // reset value
		        $(this).find('#add-layer-text').val('');
		        $(this).find('#add-layer-text-padding-custom').val("2.5em 2.5em 2.5em 2.5em");
		        $(this).find('#add-layer-text-color').minicolors('value','');
		        $(this).find('#add-layer-text-background-color').minicolors('value','');
		        $(this).find('#add-layer-text-shadow').minicolors('value','');

		        $(this).find('#opt-layer-text-2').scrollTop(0);

		        // default font size
		        if(type == 'desktop')
		        {
		        	var textSize = desktopOriWidth / 300;
		        		textSize = textSize.toFixed(2);

		        	$(this).find('#add-layer-text-size').val(textSize);
		        }
		        else
		        {
		        	$(this).find('#add-layer-text-size').val(3.5);
		        }		        

		        if(! data.html) return;

		        var others = data.others;

		        // fill form
		        $(this).find('#add-layer-text').val(others.text);
		        $(this).find('select[name = add-layer-text-align]').val(others.align);
		        $(this).find('#add-layer-text-size').val(others.size);
		        $(this).find('#add-layer-text-color').minicolors('value',others.color);		        
		        $(this).find('#add-layer-text-line-height').val(others.line_height);
		        $(this).find('select[name = add-layer-text-font-type]').val(others.font_type);

		        $(this).find('#add-layer-text-background-color').minicolors('value',others.background);

		        $(this).find('#add-layer-text-border-size').val(others.border_size);
		        $(this).find('#add-layer-text-border-color').val(others.border_color);
		        $(this).find('#add-layer-text-border-radius').val(others.border_radius);

		        $(this).find('select[name = add-layer-text-font-weight]').val(others.font_weight);
		        $(this).find('select[name = add-layer-text-transform]').val(others.text_transform);
		        $(this).find('#add-layer-text-letter-spacing').val(others.letter_spacing);
		        $(this).find('#add-layer-text-shadow').minicolors('value',others.text_shadow);

		        $(this).find('select[name = add-layer-text-padding]').val(others.padding);
		        $(this).find('#add-layer-text-padding-custom').val(others.padding_custom);

		        // data
            	$(this).find('#add-layer-text-hyperlink').val(data.hyperlink);
            	$(this).find('#add-layer-text-hyperlink-target').val(data.hyperlinkTarget);    

            	base.select2trigger($(this));
		    }		    
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

		$('.sangar-layer').on('click','.add-text',function(){
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-text');

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})

		if($("#add-layer-html").length > 0)
		{
			var layerHtmlCode = CodeMirror.fromTextArea(document.getElementById("add-layer-html"), {
	            lineNumbers: true,
	            mode: "text/html"
	        });
		}


		/**
		 * Modal Add HTML
		 */
		$('#layer-modal-html').dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Layer HTML",
	        dialogClass: "modal-add-layer",
	        width: 665,
	        height: 475,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Apply': function(){
		            var id = $(this).data('id');
					var type = $(this).data('type');
					var content = $('.sangar-layer .canvas-' + type).find('#sangar-layer-' + type + '-' + id);

					var padding = $(this).find('select[name = add-layer-html-padding]').val();
					var padding_custom = $(this).find('#add-layer-html-padding-custom').val();
					var padding_select = {
						'small': '0.5em 0.75em',
						'medium': '0.75em 1em',
						'large': '1.0em 1.25em',
						'x-large': '1.25em 1.5em',
						'custom': padding_custom
					}

					layerHtmlCode.save();

					var others = {
						html: $(this).find('#add-layer-html').val(),
	        			
	        			background: $(this).find('#add-layer-html-background-color').val(),
	        			
	        			padding: padding,
	        			padding_custom: padding_custom
	        		}

	        		if(others.html == '') return;

	        		var background = 'none';

	        		// CONTAINER CSS
	        		var css = "position:absolute;top:0;right:0;bottom:0;left:0;overflow:hidden;";
	        			css+= "padding: " + padding_select[padding] + ";";

	        		if(others.background != '')
	        			css+= "background: " + others.background + ';';

	        		// old value
	        		var layerContent = content.children('.layer-container').children('.layer-content');
					var oldWidth = layerContent.outerWidth(true);
					var oldHeight = layerContent.outerHeight(true);

	        		// print html
					var html = others.html;
						html = "<div style='" + css + "' >" + html + "</div>";
					
					// html
					content.children('.layer-container').children('.layer-content').html(html);
		        	
		        	// dimension
		        	if(content.hasClass('new-layer'))
					{
			        	var width = 300;
						var height = 150;

			        	// height
		        		content.css('height', height + 'px');
		        		content.find('.layer-content').css('height', height + 'px');

			        	// width
		        		content.css('width', width + 'px');
		        		content.find('.layer-content').css('width', width + 'px');
			        }

		        	var hyperlink = $(this).find('#add-layer-html-hyperlink');
						hyperlink = hyperlink.val();

					var hyperlinkTarget = $(this).find('#add-layer-html-hyperlink-target');
						hyperlinkTarget = hyperlinkTarget.val();
		        	
		        	// save dimension
		        	sangarCanvas.setBoxDimension(id,type);
		        	
		        	// save content html
		        	var data = {
		        		html: html,
		        		background: background,
		        		hyperlink: hyperlink,
		        		hyperlinkTarget: hyperlinkTarget,
		        		contentType: 'html',
		        		others: others
		        	}

		        	sangarCanvas.saveContentHtml(id,type,data);

		        	// set enable resizeable
		        	content.resizable("enable");

		        	// add class edit-layer-image
		        	content.find('.layer-edit').data('type','html');

		        	// close modal
		        	$(this).dialog('close');
		        }
		    },
		    create:function () {
		        base.setModalButtonColor(this);
		    },
		    open:function () {
		    	var id = $(this).data('id');
		    	var type = $(this).data('type');
		        var data = sangarLayer.getLayer()[type].content[id];

		        setTimeout(function() {
	                layerHtmlCode.refresh();
	            },1);

		        // cleaning form
		        $(this).find('input[type="text"]').val('');
		        $(this).find('input[type="number"]').val('');
		        $(this).find('select').prop('selectedIndex',0);

		        // reset value
		        $(this).find('#add-layer-html').val('');
		        layerHtmlCode.setValue('');
		        $(this).find('#add-layer-html-padding-custom').val("2.5em 2.5em 2.5em 2.5em");
		        $(this).find('#add-layer-html-background-color').minicolors('value','');

		        $(this).find('#opt-layer-html-2').scrollTop(0);

		        if(! data.html) return;

		        var others = data.others;

		        // fill form
		        layerHtmlCode.setValue(others.html);

		        $(this).find('#add-layer-html-background-color').minicolors('value',others.background);

		        $(this).find('select[name = add-layer-html-padding]').val(others.padding);
		        $(this).find('#add-layer-html-padding-custom').val(others.padding_custom);

		        // data
            	$(this).find('#add-layer-html-hyperlink').val(data.hyperlink);
            	$(this).find('#add-layer-html-hyperlink-target').val(data.hyperlinkTarget);   

            	base.select2trigger($(this));         	
		    }		    
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

		$('.sangar-layer').on('click','.add-html',function(){
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-html');

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})


		/**
		 * Modal Add Youtube and Vimeo
		 */
		$('#layer-modal-youtube').dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Layer Youtube and Vimeo",
	        dialogClass: "modal-add-layer",
	        width: 700,
	        height: 470,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Apply': function(){
		            var id = $(this).data('id');
					var type = $(this).data('type');
					var content = $('.sangar-layer .canvas-' + type).find('#sangar-layer-' + type + '-' + id);

					var padding = $(this).find('select[name = add-layer-html-padding]').val();
					var padding_custom = $(this).find('#add-layer-html-padding-custom').val();
					var padding_select = {
						'small': '0.5em 0.75em',
						'medium': '0.75em 1em',
						'large': '1.0em 1.25em',
						'x-large': '1.25em 1.5em',
						'custom': padding_custom
					}

					var others = {
						source: $(this).find('#add-layer-youtube-source').val(),
						width: $(this).find('#add-layer-youtube-width').val(),
						height: $(this).find('#add-layer-youtube-height').val()
	        		}

	        		var html = $(this).find('#video-iframe-preview').html();	        		 

	        		if(others.source == '' || html == '' || html == 'Loading preview..' || html == 'Cannot parse the embed source!, please check your input.')
	        		{
	        			alert('Please fill the video source and wait until it loaded.');

	        			return;
	        		}

	        		// old value
	        		var layerContent = content.children('.layer-container').children('.layer-content');
					var oldWidth = layerContent.outerWidth(true);
					var oldHeight = layerContent.outerHeight(true);

	        		// print html
					content.children('.layer-container').children('.layer-content').html(html);

					// dimension
		        	var width = others.width;
					var height = others.height;
		        	
		        	content.css({
		        		'height': height + 'px',
		        		'width': width + 'px'
		        	});
		        	
		        	content.find('.layer-content').css({
		        		'height': height + 'px',
		        		'width': width + 'px'
		        	});
					
		        	// save dimension
		        	sangarCanvas.setBoxDimension(id,type);
		        	
		        	// save content html
		        	var data = {
		        		html: html,
		        		background: 'none',
		        		contentType: 'youtube',
		        		others: others
		        	}

		        	sangarCanvas.saveContentHtml(id,type,data);

		        	// set enable resizeable
		        	content.resizable("enable");

		        	// add class edit-layer-image
		        	content.find('.layer-edit').data('type','youtube');

		        	// close modal
		        	$(this).dialog('close');
		        }
		    },
		    create:function () {
		        base.setModalButtonColor(this);
		    },
		    open:function () {
		    	var id = $(this).data('id');
		    	var type = $(this).data('type');
		        var data = sangarLayer.getLayer()[type].content[id];

		        // cleaning form
		        $(this).find('input[type="text"]').val('');
		        
		        // reset
		        $(this).find('#video-iframe-preview').html('');
		        $(this).find('#add-layer-youtube-width').val('400');
            	$(this).find('#add-layer-youtube-height').val('250');

		        if(! data.html) return;

		        var others = data.others;

		        // others
            	$(this).find('#add-layer-youtube-source').val(others.source).trigger('keyup');
            	$(this).find('#add-layer-youtube-width').val(others.width);
            	$(this).find('#add-layer-youtube-height').val(others.height);
		    }		    
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

		$('.sangar-layer').on('click','.add-youtube',function(){
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-youtube');

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})


		/**
		 * Modal Add Button
		 */
		$('#layer-modal-button').dialog({
	        autoOpen: false,
	        modal: true,
	        draggable: false,
	        resizable: false,
	        hide: false,
	        title: "Layer Button",
	        dialogClass: "modal-add-layer",
	        width: 755,
	        height: 475,
			buttons: {
		        'Cancel': function(){
		            $(this).dialog('close');
		        },
		        'Apply': function(){
		            var id = $(this).data('id');
					var type = $(this).data('type');
					var content = $('.sangar-layer .canvas-' + type).find('#sangar-layer-' + type + '-' + id);

					var padding = $(this).find('select[name = add-layer-button-padding]').val();
					var padding_custom = $(this).find('#add-layer-button-padding-custom').val();
					var padding_select = {
						'small': '1.0em 2.5em',
						'medium': '1.5em 4.0em',
						'large': '2.5em 6.0em',
						'custom': padding_custom
					}

					var others = {
						button_class: $(this).find('select[name = add-layer-button-class]').val(),
						text: $(this).find('#add-layer-button-text').val(),						
						hyperlink: $(this).find('#add-layer-button-hyperlink').val(),
						hyperlinkTarget: $(this).find('#add-layer-button-hyperlink-target').val(),

						text_size: $(this).find('#add-layer-button-text-size').val(),
						text_color: $(this).find('#add-layer-button-text-color').val(),
						text_font: $(this).find('select[name = add-layer-button-font-type]').val(),
						text_weight: $(this).find('select[name = add-layer-button-text-weight]').val(),
	        			
	        			background: $(this).find('#add-layer-button-background-color').val(),
	        			
	        			hover_text_color: $(this).find('#add-layer-button-text-color-hover').val(),
	        			hover_background: $(this).find('#add-layer-button-background-color-hover').val(),

	        			border_color: $(this).find('#add-layer-button-border-color').val(),

	        			padding: padding,
	        			padding_custom: padding_custom
	        		}

	        		if(others.text == '') return;

	        		var background = others.background;
	        		var hover_background = others.hover_background;

	        		// CSS
	        		var css = "white-space: nowrap; padding: " + padding_select[padding] + ";";

	        		if(others.background != '')
	        			css+= "background: " + others.background + ';';

	        		if(others.border_color != '')
	        			css+= "border-color: " + others.border_color + ';';

	        		var span_css = '';

	        		if(others.text_size != '')
	        			span_css+= "font-size: " + others.text_size + "em;";
	        		else
	        			span_css+= "font-size: 1.4em;";

	        		if(others.text_color != '')
	        			span_css+= "color: " + others.text_color + ";";

	        		if(others.text_font != '')
	        			span_css+= 'font-family: "' + others.text_font + '";';

	        		if(others.text_weight != '')
	        			span_css+= 'font-weight: "' + others.text_weight + '";';

	        		var otherAttr = 'onMouseOver="';

	        		if(others.hover_text_color != '')
	        			otherAttr+= "this.getElementsByTagName('span')[0].style.color='"+ others.hover_text_color +"';";

	        		if(others.hover_background != '')
	        			otherAttr+= "this.style.background='"+ hover_background +"';";
	        			otherAttr+= '" onMouseOut="';

	        		if(others.text_color != '')
	        			otherAttr+= "this.getElementsByTagName('span')[0].style.color='"+ others.text_color +"';";

	        		if(others.background != '')
	        			otherAttr+= "this.style.background='"+ background +"';";
	        			otherAttr+= '"';

	        		// youtube popup
	        		var youtube_popup = $(this).find('#add-layer-button-youtube-popup')[0].checked;
					var youtube_source = $(this).find('#add-layer-button-youtube-source').val();

					others.youtube_popup = youtube_popup;
					others.youtube_source = youtube_source;

	        		// webfont
					var strfont = tonjooGoogleFonts[others.text_font];
					if(typeof(strfont) !== 'undefined')
					{
						WebFont.load({
						    google: {
						      	families: [strfont]
						    }
						});
					}

	        		// print button
					var span = "<span style='" + span_css + "'>" + others.text + "</span>";
					
					var button = "<a href='" + others.hyperlink + "' class='" + others.button_class + "' target='" + others.hyperlinkTarget + "' style='" + css + "' " + otherAttr + ">" + span + "</a>";
					
					if(youtube_popup)
					{
						var button = '<a href="javascript:;" class="sangar-slider-video-modal ' + others.button_class + '" data-video="'+ youtube_source +'" style="' + css + '" ' + otherAttr + '>' + span + '</a>';
					}

					// old value
					var layerContent = content.children('.layer-container').children('.layer-content');
					var oldWidth = layerContent.outerWidth(true);
					var oldHeight = layerContent.outerHeight(true);
					
					// button
					content.children('.layer-container').children('.layer-content').html(button);
		        	
		        	// dimension
		        	var htmlButton = content.children('.layer-container').children('.layer-content').children('a.' + others.button_class);
		        	var height = htmlButton.outerHeight(true);
		        	var width = htmlButton.outerWidth(true);
		        	var modWidth = width % 10;
		        	var modHeight = height % 10;
		        	
		        	var button_align = $(this).find('select[name = add-layer-button-align]').val();
		        	
		        	width = modWidth > 0 ? width - modWidth + 10 : width;
		        	height = modHeight > 0 ? height - modHeight + 10 : height;
		        	
		        	// height
		        	if(oldHeight < height)
		        	{
		        		content.css('height', height + 'px');
		        		content.find('.layer-content').css('height', height + 'px');
		        	}

		        	// width
		        	if(oldWidth < width)
		        	{
		        		content.css('width', width + 'px');
		        		content.find('.layer-content').css('width', width + 'px');
		        	}

		        	content.find('.layer-content').css({
		        		'text-align': button_align
		        	})
		        	
		        	// save dimension
		        	sangarCanvas.setBoxDimension(id,type);
		        	
		        	// save content button
		        	var data = {
		        		html: button,
		        		align: button_align,
		        		contentType: 'button',
		        		others: others
		        	}

		        	sangarCanvas.saveContentHtml(id,type,data);

		        	// set enable resizeable
		        	content.resizable("enable");

		        	// add class edit-layer-image
		        	content.find('.layer-edit').data('type','button');

		        	// close modal
		        	$(this).dialog('close');
		        }
		    },
		    create:function () {
		        base.setModalButtonColor(this);
		    },
		    open:function () {
		    	var id = $(this).data('id');
		    	var type = $(this).data('type');
		        var data = sangarLayer.getLayer()[type].content[id];

		        // cleaning form
		        $(this).find('input[type="text"]').val('');
		        $(this).find('input[type="number"]').val('');
		        $(this).find('select').prop('selectedIndex',0);

		        // reset value
		        $(this).find('#add-layer-button').val('');
		        $(this).find('#add-layer-button-padding-custom').val("1.5em 4em 1.5em 4em");
		        $(this).find('#add-layer-button-background-color').minicolors('value','');
		        $(this).find('select[name = add-layer-button-text-weight]').val('regular');
		        $(this).find('select[name = add-layer-button-padding]').val('small');

		        $(this).find('#opt-layer-button-2').scrollTop(0);

		        // default font size
		        if(type == 'desktop')
		        {
		        	var textSize = desktopOriWidth / 450;
		        		textSize = textSize.toFixed(2);

		        	$(this).find('#add-layer-button-text-size').val(textSize);
		        }
		        else
		        {
		        	$(this).find('#add-layer-button-text-size').val(2);
		        }	

		        // default text value
		        $(this).find('#add-layer-button-text').val('BUTTON HERE');

		        // set empty youtube/vimeo video preview
		        $(this).find('#add-layer-button-video-iframe-preview').html('');

		        if(! data.html) return;

		        var others = data.others;

		        // fill form
		        $(this).find('select[name = add-layer-button-class]').val(others.button_class)
		        $(this).find('#add-layer-button-text').val(others.text);
		        $(this).find('#add-layer-button-hyperlink').val(others.hyperlink);
            	$(this).find('#add-layer-button-hyperlink-target').val(others.hyperlinkTarget);

            	$(this).find('#add-layer-button-text-size').val(others.text_size);
            	$(this).find('#add-layer-button-text-color').minicolors('value',others.text_color);
            	$(this).find('select[name = add-layer-button-font-type]').val(others.text_font);
            	$(this).find('select[name = add-layer-button-text-weight]').val(others.text_weight)
            	
		        $(this).find('#add-layer-button-background-color').minicolors('value',others.background);

		        $(this).find('#add-layer-button-text-color-hover').minicolors('value',others.hover_text_color);

		        $(this).find('#add-layer-button-background-color-hover').minicolors('value',others.hover_background);

		        $(this).find('#add-layer-button-border-color').minicolors('value',others.border_color);

		        $(this).find('select[name = add-layer-button-padding]').val(others.padding);
		        $(this).find('#add-layer-button-padding-custom').val(others.padding_custom);

		        $(this).find('.' + others.button_class).parent('.add-layer-button-preview').addClass('active');

		        $(this).find('#add-layer-button-youtube-popup')[0].checked = others.youtube_popup;
				$(this).find('#add-layer-button-youtube-source').val(others.youtube_source);

				// load iframe video
				if(others.youtube_source != '')
				{
					$(this).find('#add-layer-button-youtube-source').trigger('keyup');
				}

		        // data
		        $(this).find('select[name = add-layer-button-align]').val(data.align);

		        base.select2trigger($(this));
		    }		    
	    }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

		$('.sangar-layer').on('click','.add-button',function(){
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-button');

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})

		$('#layer-modal-button').on('click','.add-layer-button-preview',function(){
        	var template = $(this).children('a').attr('class');

        	$('#layer-modal-button').find('select[name="add-layer-button-class"]').val(template);

        	// set active
        	$('#layer-modal-button .add-layer-button-preview').removeClass('active');
        	$(this).addClass('active');
        });


		/**
		 * Modal Edit All Type Of Layer
		 */
		$('.sangar-layer').on('click','.layer-edit',function(){
			var editType = $(this).data('type');
			var layer = $(this).parents('.layer');
			var id = layer.data('id');
			var type = layer.data('type');

			var modal = $('#layer-modal-' + editType);

			modal.data('id',id);
			modal.data('type',type);
			modal.dialog('open');
			modal.find('.sslider-layer-tabs a:first').trigger('click');
		})
		
	}
})(jQuery);