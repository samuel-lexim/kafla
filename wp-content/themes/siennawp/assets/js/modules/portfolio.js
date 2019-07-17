(function($) {
	'use strict';

	var portfolio = {};
	mkdf.modules.portfolio = portfolio;

	portfolio.mkdfOnDocumentReady = mkdfOnDocumentReady;
	portfolio.mkdfOnWindowLoad = mkdfOnWindowLoad;
	portfolio.mkdfOnWindowResize = mkdfOnWindowResize;
	portfolio.mkdfOnWindowScroll = mkdfOnWindowScroll;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		portfolio.mkdfPortfolioSlider();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfPortfolioSingleFollow().init();
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdfOnWindowResize() {

	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdfOnWindowScroll() {

	}

	portfolio.mkdfPortfolioSlider = function() {
		var sliders = $('.mkdf-portfolio-slider-holder');

		var setPortfolioResponsiveOptions = function(slider, options) {
			var columns = slider.data('columns');
			if(typeof columns === 'number') {
				switch(columns) {
					case 1:
						options.singleItem = true;
						break;
					default:
						options.items = columns;
						options.itemsDesktop = false;
						break;
				}
			}
		};

		if(sliders.length) {
			sliders.each(function() {
				var sliderHolder = $(this).find('.mkdf-portfolio-slider-list');
				var options = {};

				options.pagination = typeof sliderHolder.data('enable-pagination') !== 'undefined' && sliderHolder.data('enable-pagination') === 'yes';

				setPortfolioResponsiveOptions(sliderHolder, options);

				sliderHolder.owlCarousel(options);
			});

		}
	};


	var mkdfPortfolioSingleFollow = function() {

		var info = $('.mkdf-follow-portfolio-info .small-images.mkdf-portfolio-single-holder .mkdf-portfolio-info-holder, ' +
			'.mkdf-follow-portfolio-info .small-slider.mkdf-portfolio-single-holder .mkdf-portfolio-info-holder');

		if(info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.mkdf-portfolio-media'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .mkdf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}

		var infoHolderPosition = function() {

			if(info.length) {

				if(mediaHolderHeight > infoHolderHeight) {
					if(mkdf.scroll > infoHolderOffset) {
						info.animate({
							marginTop: (mkdf.scroll - (infoHolderOffset) + mkdfGlobalVars.vars.mkdfAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
						});
					}
				}

			}
		};

		var recalculateInfoHolderPosition = function() {

			if(info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(mkdf.scroll > infoHolderOffset) {

						if(mkdf.scroll + headerHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + mediaHolderHeight) {    //20 px is for styling, spacing between header and info holder

							//Calculate header height if header appears
							if($('.header-appear, .mkdf-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .mkdf-fixed-wrapper').height();
							}
							info.stop().animate({
								marginTop: (mkdf.scroll - (infoHolderOffset) + mkdfGlobalVars.vars.mkdfAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
							});
							//Reset header height
							headerHeight = 0;
						}
						else {
							info.stop().animate({
								marginTop: mediaHolderHeight - infoHolderHeight
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		};

		return {

			init: function() {
				if(!mkdf.modules.common.mkdfIsTouchDevice()) {
					infoHolderPosition();
					$(window).scroll(function() {
						recalculateInfoHolderPosition();
					});
				}
			}

		};

	};

})(jQuery);