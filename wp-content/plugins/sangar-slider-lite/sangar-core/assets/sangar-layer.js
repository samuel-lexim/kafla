jQuery(function($) {
	
	sangarLayer.createLayer(false);
	
    /**
     * Increase Z-Index
     */
  	$('.sangar-layer').on('click','.layer-add-z',function() {
		id = $(this).parents('.layer').data('id');		
		type = $(this).parents('.canvas-container').data('type');
		
		z_index = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+id).css('z-index');		
		z_index = parseInt(z_index) +1;

		$(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+id).css('z-index',z_index);
		sangarLayer.getLayer()[type].content[id].z_index = z_index;	
  	});

    /**
     * Decrease Z-Index
     */
  	$('.sangar-layer').on('click','.layer-decrease-z',function(){
		id = $(this).parents('.layer').data('id');		
		type = $(this).parents('.canvas-container').data('type');

		z_index = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+id).css('z-index');		
		z_index = parseInt(z_index) - 1;

		if(z_index<0) z_index=0

		$(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+id).css('z-index',z_index);
		sangarLayer.getLayer()[type].content[id].z_index = z_index;
  	});

  	/**
     * Duplicate layer
     */
  	$('.sangar-layer').on('click','.layer-duplicate',function(){
		id = $(this).parents('.layer').data('id');		
		type = $(this).parents('.canvas-container').data('type');

		sangarCanvas.duplicateBox(type,id);
  	});

	/**
	 * Re sorting layer
	 */
	$('.sangar-layer').on('click','.layer-sort',function(){
		/**
		 * Ih kamu berulang-ulang, dijadikan fungsi dong :D
		 */
		id = $(this).parents('.layer').data('id');
	
		type = $(this).parents('.canvas-container').data('type');

		var newId = prompt("Please enter new order number", id);

		if (newId > 0) {
			sangarLayer.reIndex(newId,id,type);
		}
	});

	/**
	 * Remove Layer
	 */
	$('.sangar-layer').on('click','.layer-delete',function(){
		id = $(this).parents('.layer').data('id');

		type = $(this).parents('.canvas-container').data('type');

		sangarLayer.reIndexRemove(id,type);
	});

});


var sangarCanvas, 
	sangarLayer,
	sangarIsSnap = {
		'desktop' : false,
		'mobile' : false
	};

;(function($){

	// object sangarLayer
	sangarLayer = 
	{
		reIndex : function(newId,oldId,type)
		{
			layer = sangarLayer.getLayer()[type].content[oldId];
			
			/**
			 * If newId is not exist
			 */
			if(sangarLayer.getLayer()[type].content[newId] === undefined)
			{
				// Remove old position				 
				sangarLayer.getLayer()[type].content.splice(oldId,1);
				
				// Reindex and reindex id !				
				sangarLayer.getLayer()[type].content.splice(newId,0,layer)
			}
			else
			{
				sangarLayer.getLayer()[type].content.splice(oldId,1);
				sangarLayer.getLayer()[type].content.splice(newId-1,0,layer)
			}
					
			// Reindex			
			for (var i = 0; i < this.sangarLayerData[type].content.length; i++) {
				this.sangarLayerData[type].content[i].id = i
			}
			
			// Render !			
			sangarLayer.renderLayer(type)

		},
		reIndexRemove : function(id,type)
		{
			// Remove			
			sangarLayer.getLayer()[type].content.splice(id,1);

			/**
			 * Reindex
			 */
			var i = 0;
			var contents = this.sangarLayerData[type].content;
			var newContents = contents;

			$.each(contents,function(index){
				if(typeof(contents[index]) !== 'undefined')
				{
					newContents[i] = contents[index];
					newContents[i].id = i;

					i++;
				}
			});

			this.sangarLayerData[type].content = newContents;
			this.sangarLayerData[type].number--;

			// Render !			
			sangarLayer.renderLayer(type)
		},
		getSnap : function(type)
		{
			return sangarIsSnap[type];
		},
		renderLayer : function(type)
		{
			$('.sangar-layer .canvas-container.canvas-'+type).empty();

			// render !
			for (var i = 0; i < this.sangarLayerData[type].content.length; i++) 
			{
				sangarCanvas.renderLayer(this.sangarLayerData[type].content[i],type,false)
			}
		},
		refreshGrid : function(type)
		{
			var canvas = $('.sangar-layer').children('.canvas-' + type);

			for (var i = 0; i < this.sangarLayerData[type].content.length; i++) 
			{
				var object = this.sangarLayerData[type].content[i];
				var height = object.height

				// width
				var width = sangarCanvas.emToPixel(object.width,type);
					width = width.slice(0,-2);
					width = Math.round(width/10) * 10;

				// height
				var height = sangarCanvas.emToPixel(object.height,type);
					height = height.slice(0,-2);
					height = Math.round(height/10) * 10;

				// X
				var posX = object.x.slice(0,-1);
					posX = posX * canvas.width() / 100;
					posX = Math.round(posX/10) * 10;

				// Y
				var posY = object.y.slice(0,-1);
					posY = posY * canvas.height() / 100;
					posY = Math.round(posY/10) * 10;

				// edit the screen
				$(".canvas-container.canvas-"+type+" #sangar-layer-" + type + "-" + object.id).css({
					'width': width,
					'height': height,
					'left': posX,
					'top': posY
				});

				// edit the object
				var x =  ( posX / canvas.width() ) * 100;
				var y =  ( posY / canvas.height() ) * 100;

				this.sangarLayerData[type].content[object.id].x = x+"%"
				this.sangarLayerData[type].content[object.id].y = y+"%"

				this.sangarLayerData[type].content[object.id].width  = sangarCanvas.pixelToEM(width,type);
				this.sangarLayerData[type].content[object.id].height = sangarCanvas.pixelToEM(height,type);				
			}
		},
		toggleSnap : function(type)
		{
			for (var i = 0; i < this.sangarLayerData[type].content.length; i++) 
			{
				var layerId = this.sangarLayerData[type].content[i].id;
				var el = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+layerId);				
				var snap = el.draggable( "option", "snap" );

				if(snap) 
				{
					el.draggable("option", "snap", false);
					el.draggable("option", "grid", false);
					el.resizable("option", "grid", false);

					sangarIsSnap[type] = false;
				}
				else 
				{					
					el.draggable("option", "snap", '.canvas-container, .layer');
					el.draggable("option", "grid", [10,10]);
					el.resizable("option", "grid", [10,10]);

					sangarIsSnap[type] = true;
				}
			}
		},
		createLayer : function(database,data)
		{
			if(database==true)
			{
				this.sangarLayerData = JSON.parse(data);
				
				return;
			}

			this.sangarLayerData = {};

			this.sangarLayerData['desktop'] = {
				number : 0,
				options : {},
				content : []
			};

			this.sangarLayerData['mobile'] = {
				number : 0,
				options : {},
				content : []
			};
		},
		getLayer : function() 
		{
			return this.sangarLayerData		
		},
		saveLayer : function()
		{
			var container = $('.sangar-layer').children('.canvas-container');	
			var base = this;

			return JSON.stringify(this.sangarLayerData);
		},
		reset : function(type)
		{
			$('.sangar-layer .canvas-container.canvas-'+type).empty();

			this.createLayer(false)
		}
	}

	// object sangarCanvas
	sangarCanvas  = 
	{
		addBox : function(type,width)
		{
			layerId = sangarLayer.getLayer()[type].number;

			sangarLayer.getLayer()[type].number += 1;

			var width = width ? width : 313;
			var height = 90;

			var newDesktopObject = {
				x : '0',
				y : '0',
				width : width + "px",
				height : height + "px",
				id : layerId,
				z_index : 100,
				html : false,
				hyperlink : '',
				hyperlinkTarget : '_self',
				background : 'none',
				align : 'left',
				others : false
			}

			sangarLayer.getLayer()[type].content[layerId] = newDesktopObject;
			this.renderLayer(newDesktopObject,type,true)
		},
		duplicateBox : function(type,layerId)
		{
			var newDesktopObject = jQuery.extend(true, {}, sangarLayer.getLayer()[type].content[layerId]);
			var newLayerId = sangarLayer.getLayer()[type].number;

			sangarLayer.getLayer()[type].number += 1;
			newDesktopObject.id = newLayerId;

			sangarLayer.getLayer()[type].content[newLayerId] = newDesktopObject;
			this.renderLayer(newDesktopObject,type);
		},
		renderLayer : function(object,type,isNew)
		{
			if(typeof(object) === 'undefined') return;

			if(isNew)
			{
				var renderHeight = object.height;
				var renderWidth = object.width;
			}
			else
			{
				var renderHeight = this.emToPixel(object.height,type);
				var renderWidth = this.emToPixel(object.width,type);
			}

			var template = $('.sangar-layer .template .layer-template').html();

			Mustache.parse(template);

			rendered = Mustache.render(template, {id: object.id,number:object.id+1,type:type });

			$('.sangar-layer').children('.canvas-' + type).append(rendered);
			
			// render content html
			if(object.html)
			{
				var container = $(".canvas-container.canvas-"+type+" #sangar-layer-" + type + "-" + object.id);

				container.removeClass('new-layer');
				container.children('.layer-container').children('.layer-content').html(object.html);
			}
			else
			{
				renderHeight = object.height;
				renderWidth = object.width;
			}

			// render content css
			$(".canvas-container.canvas-"+type+" #sangar-layer-" + type + "-" + object.id).css({
				'left': object.x,
				'top': object.y,
				'height': renderHeight,
				'width': renderWidth,
				'z-index': object.z_index
			});

			var layerContainer = $(".canvas-container.canvas-"+type+" #sangar-layer-" + type + "-" + object.id).find('.layer-container');

			// set content type
			layerContainer
				.children('.layer-edit')
				.data('type',object.contentType);

			// layer content
			layerContainer
				.children('.layer-content')
				.css({
					'text-align': object.align
				})

			this.setBoxDimension(object.id,type);
			this.makeDraggableResizable(object.id,type);
		},
		makeDraggableResizable : function(layerId,type)
		{
			var base = this;
			var grid = [10,10];
			var snap = '.canvas-container, .layer';
			var el = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+layerId);

			if(! sangarIsSnap[type])
			{
				grid = false;
				snap = false;
			}

			el.draggable({ 
				containment: ".sangar-layer .canvas-"+type, 
				distance: 5,
				grid: grid,
				snap: snap,
				snapMode: "inner",
				snapTolerance: 10,
				scroll: false,
				stop: function() {

					var el = $(this);
					var parent = $(this).parent();

					var x = $(this).position().left;
					var y = $(this).position().top;

					// if not on the out of the border
					if(parent.width() > (el.width() + x) && parent.height() > (el.height() + y) && sangarIsSnap[type])
					{
						// fix the position to grid 10
						x = Math.round(x/10) * 10;
						y = Math.round(y/10) * 10;

						$(this).css({
							'left': x,
							'top' : y
						});
					}

					// sticky left
					if(x < 5) {
						x = 0;
						$(this).css('left',x);
					}

					// sticky top
					if(y < 5) {
						y = 0;
						$(this).css('top',y);
					}

					/**
					 * Calculate new position on drag stop
					 */
					canvasWidth =  $('.sangar-layer .canvas-'+type).width();
					canvasHeight =  $('.sangar-layer .canvas-'+type).height();

					x =  ( x / canvasWidth ) * 100;
					y =  ( y / canvasHeight ) * 100;

					sangarLayer.getLayer()[type].content[layerId].x = x+"%"
					sangarLayer.getLayer()[type].content[layerId].y = y+"%"
				}
			})
	
			el.resizable({
				containment: ".sangar-layer .canvas-"+type,
				grid: grid,
				resize : function()
				{
					var content = $(this).children('.layer-container').children(".layer-content");
					var parent = $(this).parent('.canvas-mobile');

					var width = $(this).width() < parent.width() ? $(this).width() : parent.width();
					var height = $(this).height() < parent.height() ? $(this).height() : parent.height();

					// this
					$(this).css({
						'width': width + 'px',
						'height': height + 'px'
					});

					// content
					content.css({
						'width': width + 'px',
						'height': height + 'px'
					});
				},
				stop : function()
				{
					base.setBoxDimension(layerId,type);
				}
			})

			// if new dialog
			if(! sangarLayer.getLayer()[type].content[layerId].html)
			{
				el.resizable("disable");
			}
		},
		setBoxDimension : function(layerId,type)
		{
			var height = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+layerId).height();
			var width = $(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+layerId).width();

			sangarLayer.getLayer()[type].content[layerId].height = this.pixelToEM(height,type);
			sangarLayer.getLayer()[type].content[layerId].width  = this.pixelToEM(width,type);
		},
		saveContentHtml : function(layerId,type,data)
		{
			if(data.html && typeof(data.html) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].html = data.html;

			if(data.hyperlink && typeof(data.hyperlink) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].hyperlink = data.hyperlink;

			if(data.hyperlinkTarget && typeof(data.hyperlinkTarget) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].hyperlinkTarget = data.hyperlinkTarget;
			
			if(data.background && typeof(data.background) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].background = data.background;

			if(data.contentType && typeof(data.contentType) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].contentType = data.contentType;

			if(data.align && typeof(data.align) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].align = data.align;

			if(data.animation && typeof(data.animation) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].animation = data.animation;

			if(data.others && typeof(data.others) != 'undefined')
			sangarLayer.getLayer()[type].content[layerId].others = data.others;

			// set background
			$(".canvas-container.canvas-"+type+" #sangar-layer-" + type + "-" + layerId).find('.layer-control-border').css('background','none');

			// remove class new-layer
			$(".canvas-container.canvas-"+type+" #sangar-layer-"+type+"-"+layerId).removeClass('new-layer');
		},
		pixelToEM : function(pixel,type)
		{
			if(typeof(pixel) === 'undefined') return;

			var pixel = pixel.toString();
			
			if(pixel.slice(-2) == 'px')
			{
				pixel = pixel.slice(0,-2);	
			}

			var percent = $('.sangar-layer').children('.canvas-' + type).data('percent');
			var defaultPercent = 62.5;
			var defaultEM = 10;

	    	var minusResize = defaultPercent - percent;
            var percentMinus = (minusResize / defaultPercent) * 100;

            var newEM = defaultEM - (defaultEM * percentMinus / 100);

	        return (parseFloat(pixel) / newEM) + 'em';
		},
		emToPixel : function(em,type)
		{
			if(typeof(em) === 'undefined') return;

			em = em.slice(0,-2);

			var percent = $('.sangar-layer').children('.canvas-' + type).data('percent');
			var defaultPercent = 62.5;
			var defaultEM = 10;

			// live to default
	    	var minusResize = defaultPercent - percent;
            var percentMinus = (minusResize / defaultPercent) * 100;
            var newEM = defaultEM - (defaultEM * percentMinus / 100);

			return (parseFloat(em) * newEM) + 'px';
		}
	}
})(jQuery)


/**
 * JSON Data
 
	Layer : {
		[desktop] : 
			options : {}
			lenght : 4,
			content : [
				{
					id:1,
					x:40%,
					y:40%,
					z_index : 100,
					content : {
						title : ,
						description :
					}
				}
				
			],
		[mobile] : [
			
		]
	}
 
 *
 */
