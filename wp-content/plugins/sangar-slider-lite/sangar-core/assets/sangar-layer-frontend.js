
// Run this function on sangarTextbox.js > base.resizeEmContent
function ssliderRunSangarLayer(el,id,numberSlides) {
	var sangarLayerSelector = jQuery(el).find('.sangar-content .sangar-html-content.sangar-layer');
	var orientation = jQuery(el).data('orientation');
	var sslider_id = jQuery(el).attr('sslider-id');

	if(sangarLayerSelector.length == 0) return;
	if(typeof(sangarLayerFrontend.data) == 'undefined') sangarLayerFrontend.data = new Array();

	if(typeof(sangarLayerFrontend.data[id]) === 'undefined') {
		if(typeof(sslider_layer_data) !== 'undefined' && typeof(sslider_layer_data[sslider_id]) !== 'undefined') {
			var layerData = sangarLayerFrontend.assignLayerData(sslider_layer_data, sslider_id, sangarLayerSelector.length);

			jQuery.each(sangarLayerSelector,function(index){
				var htmlData = layerData[index];

				if(typeof(htmlData) !== 'undefined') {
					sangarLayerFrontend.setData(jQuery(this),htmlData,id,index,numberSlides);
				}
			});
		}
		else {
			jQuery.each(sangarLayerSelector,function(index){
				var htmlData = jQuery(this).html();

				sangarLayerFrontend.setData(jQuery(this),htmlData,id,index,numberSlides);
			});
		}
	}

	// render
	jQuery.each(sangarLayerSelector,function(index) {
		var treshold = jQuery(this).data('treshold');
		var issetType = jQuery(this).data('type');
		var isMobile = jQuery(this).data('is-mobile');
		var windowWidth = jQuery(window).width();

		// by orientation
		var layerType = orientation;

		// by treshold
		if(windowWidth <= treshold) layerType = 'mobile';
		
		// force always desktop mode
		if(! isMobile) layerType = 'desktop';

		// render layer
		if(issetType != layerType) {
			jQuery(this).data('type',layerType);				
			sangarLayerFrontend.create(jQuery(this),layerType,id,index);
		}
	});
}

var sangarLayerFrontend = {
	setData : function(el,htmlData,id,index,numberSlides) {
		el.empty();

		if(typeof(this.data[id]) == 'undefined') this.data[id] = new Array();

		if(htmlData == '') {
			this.data[id][index] = false;
		}
		else {
			var data = sSlider_base64_decode(htmlData);

			// replacing total page shortcode
			data = this.replaceAll(data,'[sslider-total-page]',numberSlides);

			this.data[id][index] = JSON.parse(data);
		}
	},
	create : function(el,type,id,index) {
		el.empty();

		var data = this.data[id][index];

		if(! data) return;

		for (var i = 0; i < data[type].content.length; i++){
			this.render(data[type].content[i],type,el)
		}
	},
	render : function(object,type,el) {
		if(typeof(object) === 'undefined') return;

		var html = object.html ? object.html : '';
			html = object.hyperlink ? "<a href='"+ object.hyperlink +"' target='"+ object.hyperlinkTarget +"' >"+ html + "</a>" : html;
		var animation = object.animation ? object.animation : 'enable';

		var css = 'position:absolute;';
			css+= 'overflow:hidden;';
			css+= 'left:' + object.x + ';';
			css+= 'top:' + object.y + ';';
			css+= 'height:' + object.height + ';';
			css+= 'width:' + object.width + ';';
			css+= 'z-index:' + object.z_index + ';';
			css+= 'background:' + object.background + ';';
			css+= 'text-align:' + object.align + ';';

		var template = "<div style=" + css + " class='layer' data-animation='" + animation + "' id='sangar-layer-{{type}}-{{id}}' data-id='{{id}}' data-type='{{type}}'>"+ html +"</div>";
		
		Mustache.parse(template);
		
		rendered = Mustache.render(template, {id: object.id,number:object.id+1,type:type });

		el.append(rendered);
	},
	replaceAll : function(str, find, replace) {
		function escapeRegExp(str) {
		    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
		}

		return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
	},
	assignLayerData : function(data, sslider_id, slideCount) {
		var data = data[sslider_id];
		var cleanedData = this.cleaningData(data);
		var last_i = data.length - 1;

		if(slideCount == cleanedData.length) {
			return cleanedData;
		}
		else {
			if(cleanedData.length <= 1) {
				data.push(data[0]);
				data.unshift(data[0]);
			}
			else {
				data.push(data[0], data[1]);
				data.unshift(data[last_i - 1], data[last_i]);	
			}
			
			return this.cleaningData(data);
		}
	},
	cleaningData : function(data) {
		var cleanedData = [];
		var j = 0;

		for (var i = 0; i < data.length; i++) {
			if(data[i] !== false) {
				cleanedData[j] = data[i];
				j++;
			}
		}

		return cleanedData;
	}
}

function sSlider_base64_decode(data) {
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