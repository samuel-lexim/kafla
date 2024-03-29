(function($) {
	'use strict';

	var shortcodes = {};

	mkdf.modules.shortcodes = shortcodes;

	shortcodes.mkdfInitCounter = mkdfInitCounter;
	shortcodes.mkdfInitProgressBars = mkdfInitProgressBars;
	shortcodes.mkdfInitCountdown = mkdfInitCountdown;
	shortcodes.mkdfInitMessages = mkdfInitMessages;
	shortcodes.mkdfInitMessageHeight = mkdfInitMessageHeight;
	shortcodes.mkdfInitTestimonials = mkdfInitTestimonials;
	shortcodes.mkdfInitCarousels = mkdfInitCarousels;
	shortcodes.mkdfInitImageCarousel = mkdfInitImageCarousel;
	shortcodes.mkdfInitPieChart = mkdfInitPieChart;
	shortcodes.mkdfInitPieChartDoughnut = mkdfInitPieChartDoughnut;
	shortcodes.mkdfInitTabs = mkdfInitTabs;
	shortcodes.mkdfInitTabIcons = mkdfInitTabIcons;
	shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
	shortcodes.mkdfInitImageGallery = mkdfInitImageGallery;
	shortcodes.mkdfInitAccordions = mkdfInitAccordions;
	shortcodes.mkdfShowGoogleMap = mkdfShowGoogleMap;
	shortcodes.mkdfInitPortfolioListMasonry = mkdfInitPortfolioListMasonry;
	shortcodes.mkdfInitPortfolioListPinterest = mkdfInitPortfolioListPinterest;
	shortcodes.mkdfInitPortfolio = mkdfInitPortfolio;
	shortcodes.mkdfInitPortfolioMasonryFilter = mkdfInitPortfolioMasonryFilter;
	shortcodes.mkdfInitPortfolioLoadMore = mkdfInitPortfolioLoadMore;
	shortcodes.mkdfCheckSliderForHeaderStyle = mkdfCheckSliderForHeaderStyle;
	shortcodes.mkdfProcess = mkdfProcess;
	shortcodes.mkdfIconWithText = mkdfIconWithText;
	shortcodes.mkdfComparisonPricingTables = mkdfComparisonPricingTables;
	shortcodes.mkdfProgressBarVertical = mkdfProgressBarVertical;
	shortcodes.mkdfIconProgressBar = mkdfIconProgressBar;
	shortcodes.mkdfBlogSlider = mkdfBlogSlider;
	shortcodes.mkdfOnDocumentReady = mkdfOnDocumentReady;
	shortcodes.mkdfOnWindowLoad = mkdfOnWindowLoad;
	shortcodes.mkdfOnWindowResize = mkdfOnWindowResize;
	shortcodes.mkdfOnWindowScroll = mkdfOnWindowScroll;
	shortcodes.emptySpaceResponsive = emptySpaceResponsive;
	shortcodes.blogCarousel = blogCarousel;
	shortcodes.zoomingSlider = zoomingSlider;
	shortcodes.teamSlider = teamSlider;
	shortcodes.mkdfInfoCardSlider = infoCardSlider;
	shortcodes.horizontalTimeline = horizontalTimeline;
	shortcodes.socialFeedCarousel = socialFeedCarousel;
	shortcodes.socialFeedMasonry = socialFeedMasonry;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCounter();
		mkdfInitProgressBars();
		mkdfInitCountdown();
		mkdfIcon().init();
		mkdfInitMessages();
		mkdfInitMessageHeight();
		mkdfInitTestimonials();
		mkdfInitCarousels();
		mkdfInitImageCarousel();
		mkdfInitPieChart();
		mkdfInitPieChartDoughnut();
		mkdfInitTabs();
		mkdfInitTabIcons();
		mkdfButton().init();
		mkdfCustomFontResize();
		mkdfInitImageGallery();
		mkdfBlogSlider();
		mkdfInitAccordions();
		mkdfShowGoogleMap();
		mkdfInitPortfolioListMasonry();
		mkdfInitPortfolioListPinterest();
		mkdfInitPortfolio();
		mkdfInitPortfolioMasonryFilter();
		mkdfInitPortfolioLoadMore();
		mkdfSlider().init();
		mkdfSocialIconWidget().init();
		mkdfProcess().init();
		mkdfIconWithText();
		mkdfComparisonPricingTables().init();
		mkdfProgressBarVertical().init();
		mkdfIconProgressBar().init();
		emptySpaceResponsive().init();
		blogCarousel();
		zoomingSlider();
		teamSlider();
		infoCardSlider();
		horizontalTimeline().init();
		socialFeedCarousel().init();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		socialFeedMasonry().init();
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdfOnWindowResize() {
		mkdfCustomFontResize();
		mkdfInitPortfolioListMasonry();
		mkdfInitPortfolioListPinterest();
	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdfOnWindowScroll() {

	}


	/**
	 * Counter Shortcode
	 */
	function mkdfInitCounter() {

		var counters = $('.mkdf-counter');


		if(counters.length) {
			counters.each(function() {
				var counter = $(this);
				counter.appear(function() {
					counter.parent().addClass('mkdf-counter-holder-show');

					//Counter zero type
					if(counter.hasClass('zero')) {
						var max = parseFloat(counter.text());
						counter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						counter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}

				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}

	}

	/**
	 * Icon With Text Shortcode
	 */
	function mkdfIconWithText() {

		var iconWithText = $('.mkdf-iwt.mkdf-has-line-between-icons');

		if(iconWithText.length) {

			iconWithText.each(function() {

				var thisIcon = $(this);

				var iconWidth = thisIcon.find('.mkdf-iwt-icon-holder').width();

				thisIcon.find('.mkdf-line-between-icons').css('width', iconWidth);
			});

		}

	}


	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfInitProgressBars() {

		var progressBar = $('.mkdf-progress-bar');

		if(progressBar.length) {

			progressBar.each(function() {

				var thisBar = $(this);

				thisBar.appear(function() {
					mkdfInitToCounterProgressBar(thisBar);
					if(thisBar.find('.mkdf-floating.mkdf-floating-inside') !== 0) {
						var floatingInsideMargin = thisBar.find('.mkdf-progress-content').height();
						floatingInsideMargin += parseFloat(thisBar.find('.mkdf-progress-title-holder').css('padding-bottom'));
						floatingInsideMargin += parseFloat(thisBar.find('.mkdf-progress-title-holder').css('margin-bottom'));
						thisBar.find('.mkdf-floating-inside').css('margin-bottom', -(floatingInsideMargin) + 'px');
					}
					var percentage = thisBar.find('.mkdf-progress-content').data('percentage'),
						progressContent = thisBar.find('.mkdf-progress-content'),
						progressNumber = thisBar.find('.mkdf-progress-number');

					progressContent.css('width', '0%');
					progressContent.animate({'width': percentage + '%'}, 1500);
					progressNumber.css('left', '0%');
					progressNumber.animate({'left': percentage + '%'}, 1500);

				});
			});
		}
	}

	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdfInitToCounterProgressBar(progressBar) {
		var percentage = parseFloat(progressBar.find('.mkdf-progress-content').data('percentage'));
		var percent = progressBar.find('.mkdf-progress-number .mkdf-percent');
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.parents('.mkdf-progress-number-wrapper').css('opacity', '1');
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 1500,
					refreshInterval: 50
				});
			});
		}
	}

	/*
	 **	Function to close message shortcode
	 */
	function mkdfInitMessages() {
		var message = $('.mkdf-message');
		if(message.length) {
			message.each(function() {
				var thisMessage = $(this);
				thisMessage.find('.mkdf-close').click(function(e) {
					e.preventDefault();
					$(this).parent().parent().fadeOut(500);
				});
			});
		}
	}

	/*
	 **	Init message height
	 */
	function mkdfInitMessageHeight() {
		var message = $('.mkdf-message.mkdf-with-icon');
		if(message.length) {
			message.each(function() {
				var thisMessage = $(this);
				var textHolderHeight = thisMessage.find('.mkdf-message-text-holder').height();
				var iconHolderHeight = thisMessage.find('.mkdf-message-icon-holder').height();

				if(textHolderHeight > iconHolderHeight) {
					thisMessage.find('.mkdf-message-icon-holder').height(textHolderHeight);
				} else {
					thisMessage.find('.mkdf-message-text-holder').height(iconHolderHeight);
				}
			});
		}
	}

	/**
	 * Countdown Shortcode
	 */
	function mkdfInitCountdown() {

		var countdowns = $('.mkdf-countdown'),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;

		if(countdowns.length) {

			countdowns.each(function() {

				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#' + countdownId),
					digitFontSize,
					labelFontSize,
					labelFontWeight;

				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');
				labelFontWeight = countdown.data('label-weight');


				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});

				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size': digitFontSize + 'px',
						'line-height': digitFontSize + 'px'
					});
					countdown.find('.countdown-period').css({
						'font-size': labelFontSize + 'px',
						'font-weight': labelFontWeight
					});
				}

			});

		}

	}

	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function() {
		//get all icons on page
		var icons = $('.mkdf-icon-shortcode');

		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('mkdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			}
		};

		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};

				var iconElement = icon.find('.mkdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');

				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};

		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};

				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');

				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};

		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};

				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');

				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};

		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});

				}
			}
		};
	};

	/**
	 * Object that represents social icon widget
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function() {
		//get all social icons on page
		var icons = $('.mkdf-social-icon-widget-holder');

		/**
		 * Function that triggers icon hover color functionality
		 */
		var socialIconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};

				var iconElement = icon;
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');

				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};

		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						socialIconHoverColor($(this));
					});

				}
			}
		};
	};

	/**
	 * Init testimonials shortcode
	 */
	function mkdfInitTestimonials() {

		var testimonial = $('.mkdf-testimonials.mkdf-slider');
		if(testimonial.length) {
			testimonial.each(function() {

				var thisTestimonial = $(this);

				thisTestimonial.appear(function() {
					thisTestimonial.css('visibility', 'visible');
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

				var interval = 5000;
				var directionNav = true;
				var animationSpeed = 600;
				if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
					animationSpeed = thisTestimonial.data('animation-speed');
				}

				//var iconClasses = getIconClassesForNavigation(directionNavArrowsTestimonials); TODO

				thisTestimonial.owlCarousel({
					singleItem: true,
					autoPlay: interval,
					navigation: false,
					transitionStyle: 'fade', //fade, fadeUp, backSlide, goDown
					autoHeight: true,
					slideSpeed: animationSpeed,
				});

			});

		}

	}

	/**
	 * Init Carousel shortcode
	 */
	function mkdfInitCarousels() {

		var carouselHolders = $('.mkdf-carousel-holder'),
			carousel,
			numberOfItems;

		if(carouselHolders.length) {
			carouselHolders.each(function() {
				carousel = $(this).children('.mkdf-carousel');
				numberOfItems = carousel.data('items');

				//Responsive breakpoints
				var items = [
					[0, 1],
					[480, 2],
					[768, 3],
					[1024, numberOfItems]
				];

				var showNav = carousel.data('navigation');

				if(typeof showNav !== 'undefined') {
					showNav = showNav === 'yes';
				} else {
					showNav = false;
				}

				carousel.owlCarousel({
					autoPlay: 3000,
					items: numberOfItems,
					itemsCustom: items,
					pagination: showNav,
					slideSpeed: 600
				});

			});
		}

	}

	/**
	 * Init Pie Chart and Pie Chart With Icon shortcode
	 */
	function mkdfInitPieChart() {

		var pieCharts = $('.mkdf-pie-chart-holder, .mkdf-pie-chart-with-icon-holder');

		if(pieCharts.length) {

			pieCharts.each(function() {

				var pieChart = $(this),
					percentageHolder = pieChart.children('.mkdf-percentage, .mkdf-percentage-with-icon'),
					barColor,
					trackColor,
					lineWidth,
					size = 155;

				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}

				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}

				percentageHolder.appear(function() {
					initToCounterPieChart(pieChart);
					percentageHolder.css('opacity', '1');

					percentageHolder.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 6,
						animate: 1500,
						size: size
					});
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

			});

		}

	}

	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart) {

		pieChart.css('opacity', '1');
		var counter = pieChart.find('.mkdf-to-counter'),
			max = parseFloat(counter.text());
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});

	}

	/**
	 * Init Pie Chart shortcode
	 */
	function mkdfInitPieChartDoughnut() {

		var pieCharts = $('.mkdf-pie-chart-doughnut-holder, .mkdf-pie-chart-pie-holder');

		pieCharts.each(function() {

			var pieChart = $(this),
				canvas = pieChart.find('canvas'),
				chartID = canvas.attr('id'),
				chart = document.getElementById(chartID).getContext('2d'),
				data = [],
				jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

			for(var i = 1; i <= 10; i++) {

				var chartItem,
					value = jqChart.data('value-' + i),
					color = jqChart.data('color-' + i);

				if(typeof value !== 'undefined' && typeof color !== 'undefined') {
					chartItem = {
						value: value,
						color: color
					};
					data.push(chartItem);
				}

			}

			if(canvas.hasClass('mkdf-pie')) {
				new Chart(chart).Pie(data,
					{segmentStrokeColor: 'transparent'}
				);
			} else {
				new Chart(chart).Doughnut(data,
					{segmentStrokeColor: 'transparent'}
				);
			}

		});

	}

	/*
	 **	Init tabs shortcode
	 */
	function mkdfInitTabs() {

		var tabs = $('.mkdf-tabs');
		if(tabs.length) {
			tabs.each(function() {
				var thisTabs = $(this);

				thisTabs.children('.mkdf-tab-container').each(function(index) {
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a'),
						navLink = navItem.attr('href');

					link = '#' + link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href', link);
					}
				});

				if(thisTabs.hasClass('mkdf-horizontal')) {
					thisTabs.tabs();
				}
				else if(thisTabs.hasClass('mkdf-vertical')) {
					thisTabs.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
					thisTabs.find('.mkdf-tabs-nav > ul >li').removeClass('ui-corner-top').addClass('ui-corner-left');
				}
			});
		}
	}

	/*
	 **	Generate icons in tabs navigation
	 */
	function mkdfInitTabIcons() {

		var tabContent = $('.mkdf-tab-container');
		if(tabContent.length) {

			tabContent.each(function() {
				var thisTabContent = $(this);

				var id = thisTabContent.attr('id');
				var icon = '';
				if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
					icon = thisTabContent.data('icon-html');
				}

				var tabNav = thisTabContent.parents('.mkdf-tabs').find('.mkdf-tabs-nav > li > a[href="#' + id + '"]');

				if(typeof(tabNav) !== 'undefined') {
					tabNav.children('.mkdf-icon-frame').append(icon);
				}
			});
		}
	}

	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function() {
		//all buttons on the page
		var buttons = $('.mkdf-btn');

		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};

				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');

				button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
				button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
			}
		};


		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};

				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');

				button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
				button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
			}
		};

		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};

				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');

				button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
				button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
			}
		};

		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};

	/*
	 **	Custom Font resizing
	 */
	function mkdfCustomFontResize() {
		var customFont = $('.mkdf-custom-font-holder');
		if(customFont.length) {
			customFont.each(function() {
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if(mkdf.windowWidth < 1200) {
					coef1 = 0.8;
				}

				if(mkdf.windowWidth < 1000) {
					coef1 = 0.7;
				}

				if(mkdf.windowWidth < 768) {
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if(mkdf.windowWidth < 600) {
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if(mkdf.windowWidth < 480) {
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if(typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if(fontSize > 70) {
						fontSize = Math.round(fontSize * coef1);
					}
					else if(fontSize > 35) {
						fontSize = Math.round(fontSize * coef2);
					}

					thisCustomFont.css('font-size', fontSize + 'px');
				}

				if(typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if(lineHeight > 70 && mkdf.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if(lineHeight > 35 && mkdf.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else {
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

	/*
	 **	Show Google Map
	 */
	function mkdfShowGoogleMap() {

		if($('.mkdf-google-map').length) {
			$('.mkdf-google-map').each(function() {

				var element = $(this);

				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}

				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}

				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}

				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}

				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}

				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}

				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}

				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}

				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}

				var map = "map_" + uniqueId;
				var geocoder = "geocoder_" + uniqueId;
				var holderId = "mkdf-map-" + uniqueId;

				mkdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
			});
		}

	}

	/*
	 **	Init Google Map
	 */
	function mkdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

		var mapStyles = [
			{
				stylers: [
					{hue: color},
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];

		var googleMapStyleId;

		if(customMapStyle) {
			googleMapStyleId = 'mkdf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}

		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Mikado Google Map"});

		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);

		if(!isNaN(height)) {
			height = height + 'px';
		}

		var myOptions = {

			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};

		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('mkdf-style', qoogleMapType);

		var index;

		for(index = 0; index < data.length; ++index) {
			mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}

		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}

	/*
	 **	Init Google Map Addresses
	 */
	function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
		if(data === '')
			return;
		var contentString = '<div id="content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<div id="bodyContent">' +
			'<p>' + data + '</p>' +
			'</div>' +
			'</div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		geocoder.geocode({'address': data}, function(results, status) {
			if(status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon: pin,
					title: data['store_title']
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});

				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});

			}
		});
	}

	function mkdfInitAccordions() {
		var accordion = $('.mkdf-accordion-holder');
		if(accordion.length) {
			accordion.each(function() {

				var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkdf-accordion')) {

					thisAccordion.accordion({
						animate: "swing",
						collapsible: false,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkdf-toggle')) {

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.mkdf-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function() {
						var thisTitle = $(this);
						thisTitle.hover(function() {
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click', function() {
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

	function mkdfInitImageGallery() {

		var galleries = $('.mkdf-image-gallery');

		if(galleries.length) {
			galleries.each(function() {
				var gallery = $(this).children('.mkdf-image-gallery-slider'),
					autoplay = gallery.data('autoplay'),
					animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
					navigation = (gallery.data('navigation') == 'yes'),
					pagination = (gallery.data('pagination') == 'yes');

				gallery.owlCarousel({
					singleItem: true,
					autoPlay: autoplay * 1000,
					navigation: navigation,
					transitionStyle: animation, //fade, fadeUp, backSlide, goDown
					autoHeight: true,
					pagination: pagination,
					slideSpeed: 600,
					navigationText: [
						'<span class="mkdf-prev-icon"><i class="arrow_carrot-left"></i></span>',
						'<span class="mkdf-next-icon"><i class="arrow_carrot-right"></i></span>'
					]
				});
			});
		}

	}

	/**
	 * Init Image Carousel shortcode
	 */
	function mkdfInitImageCarousel() {

		var carouselHolders = $('.mkdf-image-gallery'),
			carousel,
			numberOfItems;

		if(carouselHolders.length) {
			carouselHolders.each(function() {
				carousel = $(this).children('.mkdf-image-gallery-carousel');
				numberOfItems = carousel.data('items');

				//Responsive breakpoints
				var items = [
					[0, 1],
					[480, 2],
					[768, 3],
					[1024, numberOfItems]
				];

				carousel.owlCarousel({
					autoPlay: 3000,
					navigation: false,
					pagination: false,
					items: numberOfItems,
					itemsCustom: items,
					slideSpeed: 600
				});

			});
		}

	}

	/**
	 * Initializes portfolio list
	 */
	function mkdfInitPortfolio() {
		var portList = $('.mkdf-portfolio-list-holder-outer.mkdf-ptf-standard, .mkdf-portfolio-list-holder-outer.mkdf-ptf-gallery');
		if(portList.length) {
			portList.each(function() {
				var thisPortList = $(this);
				thisPortList.appear(function() {
					mkdfInitPortMixItUp(thisPortList);
				});
			});
		}
	}

	/**
	 * Initializes mixItUp function for specific container
	 */
	function mkdfInitPortMixItUp(container) {
		var filterClass = '';
		if(container.hasClass('mkdf-ptf-has-filter')) {
			filterClass = container.find('.mkdf-portfolio-filter-holder-inner ul li').data('class');
			filterClass = '.' + filterClass;
		}

		var holderInner = container.find('.mkdf-portfolio-list-holder');
		holderInner.mixItUp({
			callbacks: {
				onMixLoad: function() {
					holderInner.find('article').css('visibility', 'visible');
				},
				onMixStart: function() {
					holderInner.find('article').css('visibility', 'visible');
				},
				onMixBusy: function() {
					holderInner.find('article').css('visibility', 'visible');
				}
			},
			selectors: {
				filter: filterClass
			},
			animation: {
				effects: 'fade',
				duration: 400
			}
		});

	}

	/*
	 **	Init portfolio list masonry type
	 */
	function mkdfInitPortfolioListMasonry() {
		var portList = $('.mkdf-portfolio-list-holder-outer.mkdf-ptf-masonry');
		if(portList.length) {
			portList.each(function() {
				var thisPortList = $(this).children('.mkdf-portfolio-list-holder');
				var size = thisPortList.find('.mkdf-portfolio-list-masonry-grid-sizer').width();
				mkdfResizeMasonry(size, thisPortList);

				thisPortList.waitForImages(function() {
					mkdfInitMasonry(thisPortList);
				});

				$(window).resize(function() {
					mkdfResizeMasonry(size, thisPortList);
					mkdfInitMasonry(thisPortList);
				});
			});
		}
	}

	function mkdfInitMasonry(container) {
		container.animate({opacity: 1});
		container.isotope({
			itemSelector: '.mkdf-portfolio-item',
			masonry: {
				columnWidth: '.mkdf-portfolio-list-masonry-grid-sizer'
			}
		});
	}

	function mkdfResizeMasonry(size, container) {

		var defaultMasonryItem = container.find('.mkdf-default-masonry-item');
		var largeWidthMasonryItem = container.find('.mkdf-large-width-masonry-item');
		var largeHeightMasonryItem = container.find('.mkdf-large-height-masonry-item');
		var largeWidthHeightMasonryItem = container.find('.mkdf-large-width-height-masonry-item');

		defaultMasonryItem.css('height', size);
		largeHeightMasonryItem.css('height', Math.round(2 * size));

		if(mkdf.windowWidth > 600) {
			largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
			largeWidthMasonryItem.css('height', size);
		} else {
			largeWidthHeightMasonryItem.css('height', size);
			largeWidthMasonryItem.css('height', Math.round(size / 2));

		}
	}

	/**
	 * Initializes portfolio pinterest
	 */
	function mkdfInitPortfolioListPinterest() {

		var portList = $('.mkdf-portfolio-list-holder-outer.mkdf-ptf-pinterest');
		if(portList.length) {
			portList.each(function() {
				var thisPortList = $(this).children('.mkdf-portfolio-list-holder');
				mkdfInitPinterest(thisPortList);
				$(window).resize(function() {
					mkdfInitPinterest(thisPortList);
				});
			});

		}
	}

	function mkdfInitPinterest(container) {
		container.animate({opacity: 1});
		container.isotope({
			itemSelector: '.mkdf-portfolio-item',
			masonry: {
				columnWidth: '.mkdf-portfolio-list-masonry-grid-sizer',
				gutter: '.mkdf-portfolio-list-masonry-grid-gutter'
			}
		});

	}

	/**
	 * Initializes portfolio masonry filter
	 */
	function mkdfInitPortfolioMasonryFilter() {

		var filterHolder = $('.mkdf-portfolio-filter-holder.mkdf-masonry-filter');

		if(filterHolder.length) {
			filterHolder.each(function() {

				var thisFilterHolder = $(this);

				var portfolioIsotopeAnimation = null;

				var filter = thisFilterHolder.find('ul li').data('class');

				thisFilterHolder.find('.filter:first').addClass('current');

				thisFilterHolder.find('.filter').click(function() {

					var currentFilter = $(this);
					clearTimeout(portfolioIsotopeAnimation);

					$('.isotope, .isotope .isotope-item').css('transition-duration', '0.8s');

					portfolioIsotopeAnimation = setTimeout(function() {
						$('.isotope, .isotope .isotope-item').css('transition-duration', '0s');
					}, 700);

					var selector = $(this).attr('data-filter');
					thisFilterHolder.siblings('.mkdf-portfolio-list-holder-outer').find('.mkdf-portfolio-list-holder').isotope({filter: selector});

					thisFilterHolder.find('.filter').removeClass('current');
					currentFilter.addClass('current');

					return false;

				});

			});
		}
	}

	/**
	 * Initializes portfolio load more function
	 */
	function mkdfInitPortfolioLoadMore() {
		var portList = $('.mkdf-portfolio-list-holder-outer.mkdf-ptf-load-more');
		var loading = false;

		if(portList.length) {
			portList.each(function() {

				var thisPortList = $(this);
				var thisPortListInner = thisPortList.find('.mkdf-portfolio-list-holder');
				var nextPage;
				var maxNumPages;
				var loadMoreButton = thisPortList.find('.mkdf-ptf-list-load-more a');
				var loadMoreOriginalText = loadMoreButton.text();
				var loadingText = loadMoreButton.data('loading-label');

				if(typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
					maxNumPages = thisPortList.data('max-num-pages');
				}

				loadMoreButton.on('click', function(e) {
					var loadMoreDatta = mkdfGetPortfolioAjaxData(thisPortList);
					loadMoreButton.text(loadingText);

					nextPage = loadMoreDatta.nextPage;
					e.preventDefault();
					e.stopPropagation();
					if(nextPage <= maxNumPages && !loading) {
						loading = true;
						var ajaxData = mkdfSetPortfolioAjaxData(loadMoreDatta);
						$.ajax({
							type: 'POST',
							data: ajaxData,
							url: mkdCoreAjaxUrl,
							success: function(data) {
								nextPage++;
								thisPortList.data('next-page', nextPage);
								var response = $.parseJSON(data);
								var responseHtml = mkdfConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with

								loadMoreButton.text(loadMoreOriginalText);

								thisPortList.waitForImages(function() {
									setTimeout(function() {
										if(thisPortList.hasClass('mkdf-ptf-masonry') || thisPortList.hasClass('mkdf-ptf-pinterest')) {
											thisPortListInner.isotope().append(responseHtml).isotope('appended', responseHtml).isotope('reloadItems');

											if(thisPortList.hasClass('mkdf-ptf-masonry')) {
												var size = thisPortList.find('.mkdf-portfolio-list-masonry-grid-sizer').width();
												mkdfResizeMasonry(size, thisPortList);

												mkdfInitMasonry(thisPortList);
											}
										} else {
											thisPortListInner.mixItUp('append', responseHtml);
										}

										loading = false;
									}, 400);
								});
							}
						});
					}
					if(nextPage === maxNumPages) {
						loadMoreButton.hide();
					}
				});

			});
		}
	}

	function mkdfConvertHTML(html) {
		var newHtml = $.trim(html),
			$html = $(newHtml),
			$empty = $();

		$html.each(function(index, value) {
			if(value.nodeType === 1) {
				$empty = $empty.add(this);
			}
		});

		return $empty;
	}

	/**
	 * Initializes portfolio load more data params
	 * @param portfolio list container with defined data params
	 * return array
	 */
	function mkdfGetPortfolioAjaxData(container) {
		var returnValue = {};

		returnValue.type = '';
		returnValue.columns = '';
		returnValue.gridSize = '';
		returnValue.orderBy = '';
		returnValue.order = '';
		returnValue.number = '';
		returnValue.imageSize = '';
		returnValue.customImageDimensions = '';
		returnValue.filter = '';
		returnValue.filterOrderBy = '';
		returnValue.category = '';
		returnValue.selectedProjectes = '';
		returnValue.showLoadMore = '';
		returnValue.titleTag = '';
		returnValue.nextPage = '';
		returnValue.maxNumPages = '';
		returnValue.showExcerpt = '';

		if(typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
			returnValue.type = container.data('type');
		}

		if(typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {
			returnValue.gridSize = container.data('grid-size');
		}

		if(typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {
			returnValue.columns = container.data('columns');
		}

		if(typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
			returnValue.orderBy = container.data('order-by');
		}

		if(typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
			returnValue.order = container.data('order');
		}

		if(typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
			returnValue.number = container.data('number');
		}

		if(typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {
			returnValue.imageSize = container.data('image-size');
		}

		if(typeof container.data('custom-image-dimensions') !== 'undefined' && container.data('custom-image-dimensions') !== false) {
			returnValue.customImageDimensions = container.data('custom-image-dimensions');
		}

		if(typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {
			returnValue.filter = container.data('filter');
		}

		if(typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {
			returnValue.filterOrderBy = container.data('filter-order-by');
		}

		if(typeof container.data('category') !== 'undefined' && container.data('category') !== false) {
			returnValue.category = container.data('category');
		}

		if(typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {
			returnValue.selectedProjectes = container.data('selected-projects');
		}

		if(typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
			returnValue.showLoadMore = container.data('show-load-more');
		}

		if(typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
			returnValue.titleTag = container.data('title-tag');
		}

		if(typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
			returnValue.nextPage = container.data('next-page');
		}

		if(typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
			returnValue.maxNumPages = container.data('max-num-pages');
		}

		if(typeof container.data('show-excerpt') !== 'undefined' && container.data('show-excerpt') !== false) {
			returnValue.showExcerpt = container.data('show-excerpt');
		}

		return returnValue;
	}

	/**
	 * Sets portfolio load more data params for ajax function
	 * @param portfolio list container with defined data params
	 * return array
	 */
	function mkdfSetPortfolioAjaxData(container) {
		var returnValue = {
			action: 'mkd_core_portfolio_ajax_load_more',
			type: container.type,
			columns: container.columns,
			gridSize: container.gridSize,
			orderBy: container.orderBy,
			order: container.order,
			number: container.number,
			imageSize: container.imageSize,
			customImageDimensions: container.customImageDimensions,
			filter: container.filter,
			filterOrderBy: container.filterOrderBy,
			category: container.category,
			selectedProjectes: container.selectedProjectes,
			showLoadMore: container.showLoadMore,
			titleTag: container.titleTag,
			nextPage: container.nextPage,
			showExcerpt: container.showExcerpt
		};
		return returnValue;
	}

	/**
	 * Slider object that initializes whole slider functionality
	 * @type {Function}
	 */
	var mkdfSlider = mkdf.modules.shortcodes.mkdfSlider = function() {

		//all sliders on the page
		var sliders = $('.mkdf-slider .carousel');
		//image regex used to extract img source
		var imageRegex = /url\(["']?([^'")]+)['"]?\)/;
		//default responsive breakpoints set
		var responsiveBreakpointSet = [1600, 1200, 900, 650, 500, 320];
		//var init for coefficiens array
		var coefficientsGraphicArray;
		var coefficientsTitleArray;
		var coefficientsSubtitleArray;
		var coefficientsTextArray;
		var coefficientsButtonArray;
		//var init for slider elements responsive coefficients
		var sliderGraphicCoefficient;
		var sliderTitleCoefficient;
		var sliderSubtitleCoefficient;
		var sliderTextCoefficient;
		var sliderButtonCoefficient;
		var sliderTitleCoefficientLetterSpacing;
		var sliderSubtitleCoefficientLetterSpacing;
		var sliderTextCoefficientLetterSpacing;

		/*** Functionality for translating image in slide - START ***/

		var matrixArray = {
			zoom_center: '1.2, 0, 0, 1.2, 0, 0',
			zoom_top_left: '1.2, 0, 0, 1.2, -150, -150',
			zoom_top_right: '1.2, 0, 0, 1.2, 150, -150',
			zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150',
			zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'
		};

		// regular expression for parsing out the matrix components from the matrix string
		var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

		// parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
		// returns an array with the matrix components
		var parseMatrix = function(val) {
			return val.match(matrixRE)[0].substr(1).
				split(",").map(function(s) {
					return parseFloat(s);
				});
		};

		// transform css property names with vendor prefixes;
		// the plugin will check for values in the order the names are listed here and return as soon as there
		// is a value; so listing the W3 std name for the transform results in that being used if its available
		var transformPropNames = [
			"transform",
			"-webkit-transform"
		];

		var getTransformMatrix = function(el) {
			// iterate through the css3 identifiers till we hit one that yields a value
			var matrix = null;
			transformPropNames.some(function(prop) {
				matrix = el.css(prop);
				return (matrix !== null && matrix !== "");
			});

			// if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
			matrix = (!matrix || matrix === "none") ?
				"matrix(1,0,0,1,0,0)" : matrix;
			return parseMatrix(matrix);
		};

		// set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
		// in "transformPropName" to ensure that the std compliant prop name shows up last
		var setTransformMatrix = function(el, matrix) {
			var m = "matrix(" + matrix.join(",") + ")";
			for(var i = transformPropNames.length - 1; i >= 0; --i) {
				el.css(transformPropNames[i], m + ' rotate(0.01deg)');
			}
		};

		// interpolates a value between a range given a percent
		var interpolate = function(from, to, percent) {
			return from + ((to - from) * (percent / 100));
		};

		$.fn.transformAnimate = function(opt) {
			// extend the options passed in by caller
			var options = {
				transform: "matrix(1,0,0,1,0,0)"
			};
			$.extend(options, opt);

			// initialize our custom property on the element to track animation progress
			this.css("percentAnim", 0);

			// supplant "options.step" if it exists with our own routine
			var sourceTransform = getTransformMatrix(this);
			var targetTransform = parseMatrix(options.transform);
			options.step = function(percentAnim, fx) {
				// compute the interpolated transform matrix for the current animation progress
				var $this = $(this);
				var matrix = sourceTransform.map(function(c, i) {
					return interpolate(c, targetTransform[i],
						percentAnim);
				});

				// apply the new matrix
				setTransformMatrix($this, matrix);

				// invoke caller's version of "step" if one was supplied;
				if(opt.step) {
					opt.step.apply(this, [matrix, fx]);
				}
			};

			// animate!
			return this.stop().animate({percentAnim: 100}, options);
		};

		/*** Functionality for translating image in slide - END ***/


		/**
		 * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
		 * @param slider, current slider
		 * @param defaultHeight, default height of slider, set in shortcode
		 * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
		 * @param reset, boolean for reseting heights
		 */
		var setSliderHeight = function(slider, defaultHeight, responsive_breakpoint_set, reset) {
			var sliderHeight = defaultHeight;
			if(!reset) {
				if(mkdf.windowWidth > responsive_breakpoint_set[0]) {
					sliderHeight = defaultHeight;
				} else if(mkdf.windowWidth > responsive_breakpoint_set[1]) {
					sliderHeight = defaultHeight * 0.75;
				} else if(mkdf.windowWidth > responsive_breakpoint_set[2]) {
					sliderHeight = defaultHeight * 0.6;
				} else if(mkdf.windowWidth > responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.55;
				} else if(mkdf.windowWidth <= responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.45;
				}
			}

			slider.css({'height': (sliderHeight) + 'px'});
			slider.find('.mkdf-slider-preloader').css({'height': (sliderHeight) + 'px'});
			slider.find('.mkdf-slider-preloader .mkdf-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (sliderHeight) + 'px'});
		};

		/**
		 * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
		 * @param slider, current slider
		 */
		var setSliderFullHeight = function(slider) {
			var mobileHeaderHeight = mkdf.windowWidth < 1000 ? mkdfGlobalVars.vars.mkdfMobileHeaderHeight + $('.mkdf-top-bar').height() : 0;
			slider.css({'height': (mkdf.windowHeight - mobileHeaderHeight) + 'px'});
			slider.find('.mkdf-slider-preloader').css({'height': (mkdf.windowHeight) + 'px'});
			slider.find('.mkd-slider-preloader .mkdf-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (mkdf.windowHeight) + 'px'});
		};

		/**
		 * Set initial sizes for slider elements and put them in global variables
		 * @param slideItem, each slide
		 * @param index, index od slide item
		 */
		var setSizeGlobalVariablesForSlideElements = function(slideItem, index) {
			window["slider_graphic_width_" + index] = [];
			window["slider_graphic_height_" + index] = [];
			window["slider_title_" + index] = [];
			window["slider_subtitle_" + index] = [];
			window["slider_text_" + index] = [];
			window["slider_button1_" + index] = [];
			window["slider_button2_" + index] = [];

			//graphic size
			window["slider_graphic_width_" + index].push(parseFloat(slideItem.find('.mkdf-thumb img').data("width")));
			window["slider_graphic_height_" + index].push(parseFloat(slideItem.find('.mkdf-thumb img').data("height")));

			// font-size (0)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkdf-slide-title').css("font-size")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkdf-slide-subtitle').css("font-size")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkdf-slide-text').css("font-size")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(0)').css("font-size")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(1)').css("font-size")));

			// line-height (1)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkdf-slide-title').css("line-height")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkdf-slide-subtitle').css("line-height")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkdf-slide-text').css("line-height")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(0)').css("line-height")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(1)').css("line-height")));

			// letter-spacing (2)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkdf-slide-title').css("letter-spacing")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkdf-slide-subtitle').css("letter-spacing")));
			window["slider_text_" + index].push(parseFloat(slideItem.find('.mkdf-slide-text').css("letter-spacing")));
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(0)').css("letter-spacing")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(1)').css("letter-spacing")));

			// margin-bottom (3)
			window["slider_title_" + index].push(parseFloat(slideItem.find('.mkdf-slide-title').css("margin-bottom")));
			window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.mkdf-slide-subtitle').css("margin-bottom")));


			// slider_button padding top/bottom(3), padding left/right(4)
			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(0)').css("padding-top")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(1)').css("padding-top")));

			window["slider_button1_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(0)').css("padding-left")));
			window["slider_button2_" + index].push(parseFloat(slideItem.find('.mkdf-btn:eq(1)').css("padding-left")));
		};

		/**
		 * Set responsive coefficients for slider elements
		 * @param responsiveBreakpointSet, responsive breakpoints
		 * @param coefficientsGraphicArray, responsive coeaficcients for graphic
		 * @param coefficientsTitleArray, responsive coeaficcients for title
		 * @param coefficientsSubtitleArray, responsive coeaficcients for subtitle
		 * @param coefficientsTextArray, responsive coeaficcients for text
		 * @param coefficientsButtonArray, responsive coeaficcients for button
		 */
		var setSliderElementsResponsiveCoeffeicients = function(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray) {

			function coefficientsSetter(graphicArray, titleArray, subtitleArray, textArray, buttonArray) {
				sliderGraphicCoefficient = graphicArray;
				sliderTitleCoefficient = titleArray;
				sliderSubtitleCoefficient = subtitleArray;
				sliderTextCoefficient = textArray;
				sliderButtonCoefficient = buttonArray;
			}

			if(mkdf.windowWidth > responsiveBreakpointSet[0]) {
				coefficientsSetter(coefficientsGraphicArray[0], coefficientsTitleArray[0], coefficientsSubtitleArray[0], coefficientsTextArray[0], coefficientsButtonArray[0]);
			} else if(mkdf.windowWidth > responsiveBreakpointSet[1]) {
				coefficientsSetter(coefficientsGraphicArray[1], coefficientsTitleArray[1], coefficientsSubtitleArray[1], coefficientsTextArray[1], coefficientsButtonArray[1]);
			} else if(mkdf.windowWidth > responsiveBreakpointSet[2]) {
				coefficientsSetter(coefficientsGraphicArray[2], coefficientsTitleArray[2], coefficientsSubtitleArray[2], coefficientsTextArray[2], coefficientsButtonArray[2]);
			} else if(mkdf.windowWidth > responsiveBreakpointSet[3]) {
				coefficientsSetter(coefficientsGraphicArray[3], coefficientsTitleArray[3], coefficientsSubtitleArray[3], coefficientsTextArray[3], coefficientsButtonArray[3]);
			} else if(mkdf.windowWidth > responsiveBreakpointSet[4]) {
				coefficientsSetter(coefficientsGraphicArray[4], coefficientsTitleArray[4], coefficientsSubtitleArray[4], coefficientsTextArray[4], coefficientsButtonArray[4]);
			} else if(mkdf.windowWidth > responsiveBreakpointSet[5]) {
				coefficientsSetter(coefficientsGraphicArray[5], coefficientsTitleArray[5], coefficientsSubtitleArray[5], coefficientsTextArray[5], coefficientsButtonArray[5]);
			} else {
				coefficientsSetter(coefficientsGraphicArray[6], coefficientsTitleArray[6], coefficientsSubtitleArray[6], coefficientsTextArray[6], coefficientsButtonArray[6]);
			}

			// letter-spacing decrease quicker
			sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient;
			sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient;
			sliderTextCoefficientLetterSpacing = sliderTextCoefficient;
			if(mkdf.windowWidth <= responsiveBreakpointSet[0]) {
				sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient / 2;
				sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient / 2;
				sliderTextCoefficientLetterSpacing = sliderTextCoefficient / 2;
			}
		};

		/**
		 * Set sizes for slider elements
		 * @param slideItem, each slide
		 * @param index, index od slide item
		 * @param reset, boolean for reseting sizes
		 */
		var setSliderElementsSize = function(slideItem, index, reset) {

			if(reset) {
				sliderGraphicCoefficient = sliderTitleCoefficient = sliderSubtitleCoefficient = sliderTextCoefficient = sliderButtonCoefficient = sliderTitleCoefficientLetterSpacing = sliderSubtitleCoefficientLetterSpacing = sliderTextCoefficientLetterSpacing = 1;
			}

			slideItem.find('.mkdf-thumb').css({
				"width": Math.round(window["slider_graphic_width_" + index][0] * sliderGraphicCoefficient) + 'px',
				"height": Math.round(window["slider_graphic_height_" + index][0] * sliderGraphicCoefficient) + 'px'
			});

			slideItem.find('.mkdf-slide-title').css({
				"font-size": Math.round(window["slider_title_" + index][0] * sliderTitleCoefficient) + 'px',
				"line-height": Math.round(window["slider_title_" + index][1] * sliderTitleCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_title_" + index][2] * sliderTitleCoefficient) + 'px',
				"margin-bottom": Math.round(window["slider_title_" + index][3] * sliderTitleCoefficient) + 'px'
			});

			slideItem.find('.mkdf-slide-subtitle').css({
				"font-size": Math.round(window["slider_subtitle_" + index][0] * sliderSubtitleCoefficient) + 'px',
				"line-height": Math.round(window["slider_subtitle_" + index][1] * sliderSubtitleCoefficient) + 'px',
				"margin-bottom": Math.round(window["slider_subtitle_" + index][3] * sliderSubtitleCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_subtitle_" + index][2] * sliderSubtitleCoefficientLetterSpacing) + 'px'
			});

			slideItem.find('.mkdf-slide-text').css({
				"font-size": Math.round(window["slider_text_" + index][0] * sliderTextCoefficient) + 'px',
				"line-height": Math.round(window["slider_text_" + index][1] * sliderTextCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_text_" + index][2] * sliderTextCoefficientLetterSpacing) + 'px'
			});

			slideItem.find('.mkdf-btn:eq(0)').css({
				"font-size": Math.round(window["slider_button1_" + index][0] * sliderButtonCoefficient) + 'px',
				"line-height": Math.round(window["slider_button1_" + index][1] * sliderButtonCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_button1_" + index][2] * sliderButtonCoefficient) + 'px',
				"padding-top": Math.round(window["slider_button1_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-bottom": Math.round(window["slider_button1_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-left": Math.round(window["slider_button1_" + index][4] * sliderButtonCoefficient) + 'px',
				"padding-right": Math.round(window["slider_button1_" + index][4] * sliderButtonCoefficient) + 'px'
			});
			slideItem.find('.mkdf-btn:eq(1)').css({
				"font-size": Math.round(window["slider_button2_" + index][0] * sliderButtonCoefficient) + 'px',
				"line-height": Math.round(window["slider_button2_" + index][1] * sliderButtonCoefficient) + 'px',
				"letter-spacing": Math.round(window["slider_button2_" + index][2] * sliderButtonCoefficient) + 'px',
				"padding-top": Math.round(window["slider_button2_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-bottom": Math.round(window["slider_button2_" + index][3] * sliderButtonCoefficient) + 'px',
				"padding-left": Math.round(window["slider_button2_" + index][4] * sliderButtonCoefficient) + 'px',
				"padding-right": Math.round(window["slider_button2_" + index][4] * sliderButtonCoefficient) + 'px'
			});
		};

		/**
		 * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
		 * @param slider, current slider
		 */
		var setHeights = function(slider) {

			slider.find('.item').each(function(i) {
				setSizeGlobalVariablesForSlideElements($(this), i);
				setSliderElementsSize($(this), i, false);
			});

			if(slider.hasClass('mkdf-full-screen')) {

				setSliderFullHeight(slider);

				$(window).resize(function() {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					setSliderFullHeight(slider);
					slider.find('.item').each(function(i) {
						setSliderElementsSize($(this), i, false);
					});
				});

			} else if(slider.hasClass('mkdf-responsive-height')) {

				var defaultHeight = slider.data('height');
				setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

				$(window).resize(function() {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
					slider.find('.item').each(function(i) {
						setSliderElementsSize($(this), i, false);
					});
				});

			} else {
				var defaultHeight = slider.data('height');

				slider.find('.mkdf-slider-preloader').css({'height': (slider.height()) + 'px'});
				slider.find('.mkdf-slider-preloader .mkdf-ajax-loader').css({'display': 'block'});

				mkdf.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

				$(window).resize(function() {
					setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);
					if(mkdf.windowWidth < 1000) {
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
						slider.find('.item').each(function(i) {
							setSliderElementsSize($(this), i, false);
						});
					} else {
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
						slider.find('.item').each(function(i) {
							setSliderElementsSize($(this), i, true);
						});
					}
				});
			}
		};

		/**
		 * Set prev/next numbers on navigation arrows
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 */
		var setPrevNextNumbers = function(slider, currentItem, totalItemCount) {
			if(currentItem == 1) {
				slider.find('.left.carousel-control .prev').html(totalItemCount);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			} else if(currentItem == totalItemCount) {
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(1);
			} else {
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			}
		};

		/**
		 * Set video background size
		 * @param slider, current slider
		 */
		var initVideoBackgroundSize = function(slider) {
			var min_w = 1500; // minimum video width allowed
			var video_width_original = 1920;  // original video dimensions
			var video_height_original = 1080;
			var vid_ratio = 1920 / 1080;

			slider.find('.item .mkdf-video .mkdf-video-wrap').each(function() {

				var slideWidth = mkdf.windowWidth;
				var slideHeight = $(this).closest('.carousel').height();

				$(this).width(slideWidth);

				min_w = vid_ratio * (slideHeight + 20);
				$(this).height(slideHeight);

				var scale_h = slideWidth / video_width_original;
				var scale_v = (slideHeight - mkdfGlobalVars.vars.mkdfMenuAreaHeight) / video_height_original;
				var scale = scale_v;
				if(scale_h > scale_v)
					scale = scale_h;
				if(scale * video_width_original < min_w) {
					scale = min_w / video_width_original;
				}

				$(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original + 2));
				$(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original + 2));
				$(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
				$(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
				$(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
			});
		};

		/**
		 * Init video background
		 * @param slider, current slider
		 */
		var initVideoBackground = function(slider) {
			$('.item .mkdf-video-wrap .video').mediaelementplayer({
				enableKeyboard: false,
				iPadUseNativeControls: false,
				pauseOtherPlayers: false,
				// force iPhone's native controls
				iPhoneUseNativeControls: false,
				// force Android's native controls
				AndroidUseNativeControls: false
			});

			$(window).resize(function() {
				initVideoBackgroundSize(slider);
			});

			//mobile check
			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
				$('.mkdf-slider .mkdf-mobile-video-image').show();
				$('.mkdf-slider .mkdf-video-wrap').remove();
			}
		};

		/**
		 * initiate slider
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 * @param slideAnimationTimeout, timeout for slide change
		 */
		var initiateSlider = function(slider, totalItemCount, slideAnimationTimeout) {

			//set active class on first item
			slider.find('.carousel-inner .item:first-child').addClass('active');
			//check for header style
			mkdfCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('mkdf-header-effect'));
			// setting numbers on carousel controls
			if(slider.hasClass('mkdf-slider-numbers')) {
				setPrevNextNumbers(slider, 1, totalItemCount);
			}
			// set video background if there is video slide
			if(slider.find('.item video').length) {
				initVideoBackgroundSize(slider);
				initVideoBackground(slider);
			}

			//init slider
			if(slider.hasClass('mkdf-auto-start')) {
				slider.carousel({
					interval: slideAnimationTimeout,
					pause: false
				});

				//pause slider when hover slider button
				slider.find('.slide_buttons_holder .qbutton')
					.mouseenter(function() {
						slider.carousel('pause');
					})
					.mouseleave(function() {
						slider.carousel('cycle');
					});
			} else {
				slider.carousel({
					interval: 0,
					pause: false
				});
			}


			//initiate image animation
			if($('.carousel-inner .item:first-child').hasClass('mkdf-animate-image') && mkdf.windowWidth > 1000) {
				slider.find('.carousel-inner .item.mkdf-animate-image:first-child .mkdf-image').transformAnimate({
					transform: "matrix(" + matrixArray[$('.carousel-inner .item:first-child').data('mkdf_animate_image')] + ")",
					duration: 30000
				});
			}
		};

		return {
			init: function() {
				if(sliders.length) {
					sliders.each(function() {
						var $this = $(this);
						var slideAnimationTimeout = $this.data('slide_animation_timeout');
						var totalItemCount = $this.find('.item').length;
						if($this.data('mkdf_responsive_breakpoints')) {
							if($this.data('mkdf_responsive_breakpoints') == 'set2') {
								responsiveBreakpointSet = [1600, 1300, 1000, 768, 567, 320];
							}
						}
						coefficientsGraphicArray = $this.data('mkdf_responsive_graphic_coefficients').split(',');
						coefficientsTitleArray = $this.data('mkdf_responsive_title_coefficients').split(',');
						coefficientsSubtitleArray = $this.data('mkdf_responsive_subtitle_coefficients').split(',');
						coefficientsTextArray = $this.data('mkdf_responsive_text_coefficients').split(',');
						coefficientsButtonArray = $this.data('mkdf_responsive_button_coefficients').split(',');

						setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet, coefficientsGraphicArray, coefficientsTitleArray, coefficientsSubtitleArray, coefficientsTextArray, coefficientsButtonArray);

						setHeights($this);

						/*** wait until first video or image is loaded and than initiate slider - start ***/
						if(mkdf.htmlEl.hasClass('touch')) {
							if($this.find('.item:first-child .mkdf-mobile-video-image').length > 0) {
								var src = imageRegex.exec($this.find('.item:first-child .mkdf-mobile-video-image').attr('style'));
							} else {
								var src = imageRegex.exec($this.find('.item:first-child .mkdf-image').attr('style'));
							}
							if(src) {
								var backImg = new Image();
								backImg.src = src[1];
								$(backImg).load(function() {
									$('.mkdf-slider-preloader').fadeOut(500);
									initiateSlider($this, totalItemCount, slideAnimationTimeout);
								});
							}
						} else {
							if($this.find('.item:first-child video').length > 0) {
								$this.find('.item:first-child video').get(0).addEventListener('loadeddata', function() {
									$('.mkdf-slider-preloader').fadeOut(500);
									initiateSlider($this, totalItemCount, slideAnimationTimeout);
								});
							} else {
								var src = imageRegex.exec($this.find('.item:first-child .mkdf-image').attr('style'));
								if(src) {
									var backImg = new Image();
									backImg.src = src[1];
									$(backImg).load(function() {
										$('.mkdf-slider-preloader').fadeOut(500);
										initiateSlider($this, totalItemCount, slideAnimationTimeout);
									});
								}
							}
						}
						/*** wait until first video or image is loaded and than initiate slider - end ***/

						/* before slide transition - start */
						$this.on('slide.bs.carousel', function() {
							$this.addClass('mkdf-in-progress');
							$this.find('.active .mkdf-slider-content-outer').fadeTo(250, 0);
						});
						/* before slide transition - end */

						/* after slide transition - start */
						$this.on('slid.bs.carousel', function() {
							$this.removeClass('mkdf-in-progress');
							$this.find('.active .mkdf-slider-content-outer').fadeTo(0, 1);

							// setting numbers on carousel controls
							if($this.hasClass('mkdf-slider-numbers')) {
								var currentItem = $('.item').index($('.item.active')[0]) + 1;
								setPrevNextNumbers($this, currentItem, totalItemCount);
							}

							// initiate image animation on active slide and reset all others
							$('.item.mkdf-animate-image .mkdf-image').stop().css({
								'transform': '',
								'-webkit-transform': ''
							});
							if($('.item.active').hasClass('mkdf-animate-image') && mkdf.windowWidth > 1000) {
								$('.item.mkdf-animate-image.active .mkdf-image').transformAnimate({
									transform: "matrix(" + matrixArray[$('.item.mkdf-animate-image.active').data('mkdf_animate_image')] + ")",
									duration: 30000
								});
							}
						});
						/* after slide transition - end */

						/* swipe functionality - start */
						$this.swipe({
							swipeLeft: function() {
								$this.carousel('next');
							},
							swipeRight: function() {
								$this.carousel('prev');
							},
							threshold: 20
						});
						/* swipe functionality - end */

					});

					//adding parallax functionality on slider
					if($('.no-touch .carousel').length) {
						var skrollr_slider = skrollr.init({
							smoothScrolling: false,
							forceHeight: false
						});
						skrollr_slider.refresh();
					}

					$(window).scroll(function() {
						//set control class for slider in order to change header style
						if($('.mkdf-slider .carousel').height() < mkdf.scroll) {
							$('.mkdf-slider .carousel').addClass('mkdf-disable-slider-header-style-changing');
						} else {
							$('.mkdf-slider .carousel').removeClass('mkdf-disable-slider-header-style-changing');
							mkdfCheckSliderForHeaderStyle($('.mkdf-slider .carousel .active'), $('.mkdf-slider .carousel').hasClass('mkdf-header-effect'));
						}

						//hide slider when it is out of viewport
						if($('.mkdf-slider .carousel').hasClass('mkdf-full-screen') && mkdf.scroll > mkdf.windowHeight && mkdf.windowWidth > 1000) {
							$('.mkdf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						} else if(!$('.mkdf-slider .carousel').hasClass('mkdf-full-screen') && mkdf.scroll > $('.mkdf-slider .carousel').height() && mkdf.windowWidth > 1000) {
							$('.mkdf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						} else {
							$('.mkdf-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
						}
					});
				}
			}
		};
	};

	/**
	 * Check if slide effect on header style changing
	 * @param slide, current slide
	 * @param headerEffect, flag if slide
	 */

	function mkdfCheckSliderForHeaderStyle(slide, headerEffect) {

		if($('.mkdf-slider .carousel').not('.mkdf-disable-slider-header-style-changing').length > 0) {

			var slideHeaderStyle = "";
			if(slide.hasClass('light')) {
				slideHeaderStyle = 'mkdf-light-header';
			}
			if(slide.hasClass('dark')) {
				slideHeaderStyle = 'mkdf-dark-header';
			}

			if(slideHeaderStyle !== "") {
				if(headerEffect) {
					mkdf.body.removeClass('mkdf-dark-header mkdf-light-header').addClass(slideHeaderStyle);
				}
			} else {
				if(headerEffect) {
					mkdf.body.removeClass('mkdf-dark-header mkdf-light-header').addClass(mkdf.defaultHeaderStyle);
				}

			}
		}
	}

	function mkdfProcess() {
		var processes = $('.mkdf-process-holder');

		var setProcessItemsPosition = function(process) {
			var items = process.find('.mkdf-process-item-holder');
			var highlighted = items.filter('.mkdf-pi-highlighted');

			if(highlighted.length) {
				if(highlighted.length === 1) {
					var afterHighlighed = highlighted.nextAll();

					if(afterHighlighed.length) {
						afterHighlighed.addClass('mkdf-pi-push-right');
					}
				} else {
					process.addClass('mkdf-process-multiple-highlights');
				}
			}
		};

		var processAnimation = function(process) {
			if(!mkdf.body.hasClass('mkdf-no-animations-on-touch')) {
				var items = process.find('.mkdf-process-item-holder');
				var background = process.find('.mkdf-process-bg-holder');

				process.appear(function() {
					var tl = new TimelineLite();
					tl.fromTo(background, 0.2, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
					tl.staggerFromTo(items, 0.3, {opacity: 0, y: 50, ease: Back.easeOut.config(2)}, {
						opacity: 1,
						y: 0,
						ease: Back.easeOut.config(2)
					}, 0.2);
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			}
		};

		return {
			init: function() {
				if(processes.length) {
					processes.each(function() {
						setProcessItemsPosition($(this));
						processAnimation($(this));
					});
				}
			}
		};
	}

	function mkdfComparisonPricingTables() {
		var pricingTablesHolder = $('.mkdf-comparision-pricing-tables-holder');

		var alterPricingTableColumn = function(holder) {
			var featuresHolder = holder.find('.mkdf-cpt-features-item');
			var pricingTables = holder.find('.mkdf-comparision-table-holder');

			if(pricingTables.length) {
				pricingTables.each(function() {
					var currentPricingTable = $(this);
					var pricingItems = currentPricingTable.find('.mkdf-cpt-table-content li');

					if(pricingItems.length) {
						pricingItems.each(function(i) {
							var pricingItemFeature = featuresHolder[i];
							var pricingItem = this;
							var pricingItemContent = pricingItem.innerHTML;

							if(typeof pricingItemFeature !== 'undefined') {
								pricingItem.innerHTML = '<span class="mkdf-cpt-table-item-feature">' + $(pricingItemFeature).text() + ': </span>' + pricingItemContent;
							}
						});
					}
				});
			}
		};

		return {
			init: function() {
				if(pricingTablesHolder.length) {
					pricingTablesHolder.each(function() {
						alterPricingTableColumn($(this));
					});
				}
			}
		};
	}

	function mkdfProgressBarVertical() {
		var progressBars = $('.mkdf-vertical-progress-bar-holder');

		var animateProgressBar = function(progressBar) {

			progressBar.appear(function() {
				var barHolder = progressBar.find('.mkdf-vpb-bar');
				var activeBar = progressBar.find('.mkdf-vpb-active-bar');
				var percentage = barHolder.data('percent');

				activeBar.animate({
					height: percentage + '%'
				}, 1500);

			}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
		};

		var animatePercentageNumber = function(progressBar) {
			progressBar.appear(function() {
				var barHolder = progressBar.find('.mkdf-vpb-bar');
				var percentage = barHolder.data('percent');
				var percentHolder = progressBar.find('.mkdf-vpb-percent-number');

				percentHolder.countTo({
					from: 0,
					to: percentage,
					speed: 1500,
					refreshInterval: 50
				});
			});
		};

		return {
			init: function() {

				if(progressBars.length) {

					progressBars.each(function() {
						animateProgressBar($(this));
						animatePercentageNumber($(this));
					});
				}
			}
		};
	}

	function mkdfIconProgressBar() {
		var progressBars = $('.mkdf-icon-progress-bar');

		var animateActiveIcons = function(progressBar) {
			var timeouts = [];
			progressBar.appear(function() {
				var numberOfActive = parseInt(progressBar.data('number-of-active-icons'));
				var icons = progressBar.find('.mkdf-ipb-icon');
				var customColor = progressBar.data('icon-active-color');

				if(typeof numberOfActive !== 'undefined') {

					icons.each(function(i) {
						if(i < numberOfActive) {
							var time = (i + 1) * 150;
							var currentIcon = $(this);

							timeouts[i] = setTimeout(function() {
								animateSingleIcon(currentIcon, customColor);
								$(icons[i]).addClass('active');
							}, time);
						}
					});
				}
			}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
		};

		var animateSingleIcon = function(icon, customColor) {
			icon.addClass('mkdf-ipb-active');

			if(typeof customColor !== 'undefined' && customColor !== '') {
				icon.find('.mkdf-ipb-icon-elem').css('color', customColor);
			}
		};

		return {
			init: function() {
				if(progressBars.length) {
					progressBars.each(function() {
						animateActiveIcons($(this));
					});
				}
			}
		};
	}

	function mkdfBlogSlider() {
		var blogSliders = $('.mkdf-blog-slider-holder');

		if(blogSliders.length) {
			blogSliders.each(function() {
				var thisSlider = $(this);

				thisSlider.owlCarousel({
					singleItem: true,
					navigation: true,
					autoHeight: true,
					pagination: false,
					slideSpeed: 600,
					transitionStyle: 'fade',
					navigationText: [
						'<span class="mkdf-prev-icon"><i class="fa fa-angle-left"></i></span>',
						'<span class="mkdf-next-icon"><i class="fa fa-angle-right"></i></span>'
					]
				});
			});
		}
	}

	function emptySpaceResponsive() {
		var emptySpaces = $('.vc_empty_space');

		var sizes = {
			'large_laptop': 1559,
			'laptop': 1279,
			'tablet_landscape': 1023,
			'tablet_portrait': 767,
			'phone_landscape': 599,
			'phone_portrait': 479
		};

		var sizeValues = function() {
			var values = [];
			for(var size in sizes) {
				values.push(sizes[size]);
			}

			return values;
		}();

		var getHeights = function(emptySpace) {
			var heights = {};

			for(var size in sizes) {
				var dataValue = emptySpace.data(size);
				if(typeof dataValue !== 'undefined' && dataValue !== '') {
					heights[size] = dataValue;
				}
			}

			return heights;
		};

		var usedSizes = function(emptySpace) {
			var usedSizes = [];

			for(var size in sizes) {
				var dataValue = emptySpace.data(size);
				if(typeof dataValue !== 'undefined' && dataValue !== '') {
					usedSizes.push(sizes[size]);
				}
			}

			return usedSizes;
		};

		var resizeEmptySpace = function(heights, emptySpace) {
			if(typeof heights !== 'undefined') {
				var originalHeight = emptySpace.data('original-height');
				var sizeValues = usedSizes(emptySpace);
				var heightestSize = Math.max.apply(null, sizeValues);

				for(var size in sizes) {
					if(mkdf.windowWidth <= sizes[size]) {
						emptySpace.height(heights[size]);
					} else if(mkdf.windowWidth > heightestSize) {
						emptySpace.height(originalHeight);
					}
				}
			}
		};

		return {
			init: function() {
				if(emptySpaces.length) {
					emptySpaces.each(function() {
						var heights = getHeights($(this));

						resizeEmptySpace(heights, $(this));

						var thisEmptySpace = $(this);

						$(window).resize(function() {
							resizeEmptySpace(heights, thisEmptySpace);
						});
					});
				}
			}
		};
	}

	function blogCarousel() {
		var blogCarousels = $('.mkdf-blog-carousel');

		if(blogCarousels.length) {
			blogCarousels.each(function() {
				var currentCarousel = $(this);

				currentCarousel.owlCarousel({
					itemsCustom: [
						[0, 1], [768, 2], [1025, 3]
					],
					pagination: true
				});
			});
		}
	}

	function zoomingSlider() {
		var zoomingSliders = $('.mkdf-zooming-slider-holder');

		if(zoomingSliders.length) {
			zoomingSliders.each(function() {
				$(this).slick({
					centerMode: true,
					slidesToShow: 3,
					arrows: false,
					centerPadding: '37.5px',
					dots: true,
					speed: 750,
					cssEase: 'cubic-bezier(.19,1,.22,1)',
					swipeToSlide: true,
					responsive: [
						{
							breakpoint: 1400,
							settings: {
								centerPadding: '1px',
							}
						},
						{
							breakpoint: 1024,
							settings: {
								centerPadding: false,
								centerMode: false,
								slidesToShow: 1,
							}
						}
					]
				});
			});
		}
	}

	function teamSlider() {
		var teamSlidersHolder = $('.mkdf-team-slider-holder');

		if(teamSlidersHolder.length) {
			teamSlidersHolder.each(function() {
				var thisSlider = $(this).find('.mkdf-team-slider'),
					prevArrow = $(this).find('.mkdf-team-slider-prev'),
					nextArrow = $(this).find('.mkdf-team-slider-next');

				if(thisSlider.length) {
					thisSlider.slick({
						prevArrow: prevArrow,
						nextArrow: nextArrow,
						slidesToShow: 4,
						slidesToScroll: 1,
						swipeToSlide: true,
						touchTreshold: 20,
						cssEase: 'cubic-bezier(.19,1,.22,1)',
						speed: 850,
						responsive: [
							{
								breakpoint: 1400,
								settings: {
									slidesToShow: 3
								}
							},
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2
								}
							},
							{
								breakpoint: 600,
								settings: {
									slidesToShow: 1
								}
							}
						]
					});
				}
			});
		}
	}

	function infoCardSlider() {
		var infoCardSliders = $('.mkdf-info-card-carousel-holder');

		if(infoCardSliders.length) {
			infoCardSliders.each(function() {
				$(this).owlCarousel({
					items: 3,
					itemsCustom: [
						[1200, 3],
						[1000, 2],
						[768, 2],
						[600, 1],
						[480, 1],
						[320, 1]
					],
					pagination: true,
					navigation: false,
					slideSpeed: 800,
					mouseDrag: false
				});
			});
		}
	}

	function horizontalTimeline() {
		var timelines = $('.mkdf-horizontal-timeline'),
			eventsMinDistance;

		function initTimeline(timelines) {
			timelines.each(function(){
				var timeline = $(this),
					timelineComponents = {};

				eventsMinDistance = timeline.data('distance');

				//cache timeline components
				timelineComponents['timelineWrapper'] = timeline.find('.mkdf-horizontal-timeline-events-wrapper');
				timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.mkdf-horizontal-timeline-events');
				timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.mkdf-horizontal-timeline-filling-line');
				timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
				timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
				timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
				timelineComponents['timelineNavigation'] = timeline.find('.mkdf-timeline-navigation');
				timelineComponents['eventsContent'] = timeline.children('.mkdf-horizontal-timeline-events-content');

				//select initial event
				timelineComponents['timelineEvents'].first().addClass('selected');
				timelineComponents['eventsContent'].find('li').first().addClass('selected');

				//assign a left postion to the single events along the timeline
				setDatePosition(timelineComponents, eventsMinDistance);
				//assign a width to the timeline
				var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
				//the timeline has been initialize - show it
				timeline.addClass('loaded');

				//detect click on the next arrow
				timelineComponents['timelineNavigation'].on('click', '.next', function(event){
					event.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'next');
				});
				//detect click on the prev arrow
				timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
					event.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'prev');
				});
				//detect click on the a single event - show new event content
				timelineComponents['eventsWrapper'].on('click', 'a', function(event){
					event.preventDefault();
					timelineComponents['timelineEvents'].removeClass('selected');
					$(this).addClass('selected');
					updateOlderEvents($(this));
					updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
					updateVisibleContent($(this), timelineComponents['eventsContent']);
				});

				//on swipe, show next/prev event content
				timelineComponents['eventsContent'].on('swipeleft', function(){
					showNewContent(timelineComponents, timelineTotWidth, 'next');
				});
				timelineComponents['eventsContent'].on('swiperight', function(){
					showNewContent(timelineComponents, timelineTotWidth, 'prev');
				});

				//keyboard navigation
				$(document).keyup(function(event){
					if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
						showNewContent(timelineComponents, timelineTotWidth, 'prev');
					} else if( event.which=='39' && elementInViewport(timeline.get(0))) {
						showNewContent(timelineComponents, timelineTotWidth, 'next');
					}
				});


			});
		}

		function updateSlide(timelineComponents, timelineTotWidth, string) {
			//retrieve translateX value of timelineComponents['eventsWrapper']
			var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
				wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
			//translate the timeline to the left('next')/right('prev')
			(string == 'next')
				? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
				: translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
		}

		function showNewContent(timelineComponents, timelineTotWidth, string) {
			//go from one event to the next/previous one
			var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
				newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

			if ( newContent.length > 0 ) { //if there's a next/prev event - show it
				var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
					newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');

				updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
				updateVisibleContent(newEvent, timelineComponents['eventsContent']);
				newEvent.addClass('selected');
				selectedDate.removeClass('selected');
				updateOlderEvents(newEvent);
				updateTimelinePosition(string, newEvent, timelineComponents);
			}
		}

		function updateTimelinePosition(string, event, timelineComponents) {
			//translate timeline to the left/right according to the position of the selected event
			var eventStyle = window.getComputedStyle(event.get(0), null),
				eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
				timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
				timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
			var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

			if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
				translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
			}
		}

		function translateTimeline(timelineComponents, value, totWidth) {
			var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
			value = (value > 0) ? 0 : value; //only negative translate value
			value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
			setTransformValue(eventsWrapper, 'translateX', value+'px');
			//update navigation arrows visibility
			(value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
			(value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
		}

		function updateFilling(selectedEvent, filling, totWidth) {
			//change .mkdf-horizontal-timeline-filling-line length according to the selected event
			var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
				eventLeft = eventStyle.getPropertyValue("left"),
				eventWidth = eventStyle.getPropertyValue("width");
			eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
			var scaleValue = eventLeft/totWidth;
			setTransformValue(filling.get(0), 'scaleX', scaleValue);
		}

		function setDatePosition(timelineComponents, min) {
			for (var i = 0; i < timelineComponents['timelineDates'].length; i++) {
				var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
					distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
				timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
			}
		}

		function setTimelineWidth(timelineComponents, width) {
			var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
				timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
				timeSpanNorm = Math.round(timeSpanNorm) + 4,
				totalWidth = timeSpanNorm*width;
			timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
			updateFilling(timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents['fillingLine'], totalWidth);
			updateTimelinePosition('next', timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents);

			return totalWidth;
		}

		function updateVisibleContent(event, eventsContent) {
			var eventDate = event.data('date'),
				visibleContent = eventsContent.find('.selected'),
				selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
				selectedContentHeight = selectedContent.height();

			if (selectedContent.index() > visibleContent.index()) {
				var classEnetering = 'selected enter-right',
					classLeaving = 'leave-left';
			} else {
				var classEnetering = 'selected enter-left',
					classLeaving = 'leave-right';
			}

			selectedContent.attr('class', classEnetering);
			visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
				visibleContent.removeClass('leave-right leave-left');
				selectedContent.removeClass('enter-left enter-right');
			});
			eventsContent.css('height', selectedContentHeight+'px');
		}

		function updateOlderEvents(event) {
			event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
		}

		function getTranslateValue(timeline) {
			var timelineStyle = window.getComputedStyle(timeline.get(0), null),
				timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
					timelineStyle.getPropertyValue("-moz-transform") ||
					timelineStyle.getPropertyValue("-ms-transform") ||
					timelineStyle.getPropertyValue("-o-transform") ||
					timelineStyle.getPropertyValue("transform");

			if( timelineTranslate.indexOf('(') >=0 ) {
				var timelineTranslate = timelineTranslate.split('(')[1];
				timelineTranslate = timelineTranslate.split(')')[0];
				timelineTranslate = timelineTranslate.split(',');
				var translateValue = timelineTranslate[4];
			} else {
				var translateValue = 0;
			}

			return Number(translateValue);
		}

		function setTransformValue(element, property, value) {
			element.style["-webkit-transform"] = property+"("+value+")";
			element.style["-moz-transform"] = property+"("+value+")";
			element.style["-ms-transform"] = property+"("+value+")";
			element.style["-o-transform"] = property+"("+value+")";
			element.style["transform"] = property+"("+value+")";
		}

		//based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
		function parseDate(events) {
			var dateArrays = [];
			events.each(function(){
				var singleDate = $(this),
					dateCompStr = new String(singleDate.data('date')),
					dateComp = dateCompStr.split('T');

				if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
					var dayComp = dateComp[0].split('/'),
						timeComp = dateComp[1].split(':');
				} else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
					var dayComp = ["2000", "0", "0"],
						timeComp = dateComp[0].split(':');
				} else { //only DD/MM/YEAR
					var dayComp = dateComp[0].split('/'),
						timeComp = ["0", "0"];
				}
				var	newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
				dateArrays.push(newDate);
			});
			return dateArrays;
		}

		function daydiff(first, second) {
			return Math.round((second-first));
		}

		function minLapse(dates) {
			//determine the minimum distance among events
			var dateDistances = [];
			for (var i = 1; i < dates.length; i++) {
				var distance = daydiff(dates[i-1], dates[i]);
				dateDistances.push(distance);
			}
			return Math.min.apply(null, dateDistances);
		}

		/*
		 How to tell if a DOM element is visible in the current viewport?
		 http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
		 */
		function elementInViewport(el) {
			var top = el.offsetTop;
			var left = el.offsetLeft;
			var width = el.offsetWidth;
			var height = el.offsetHeight;

			while(el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
				left += el.offsetLeft;
			}

			return (
				top < (window.pageYOffset + window.innerHeight) &&
				left < (window.pageXOffset + window.innerWidth) &&
				(top + height) > window.pageYOffset &&
				(left + width) > window.pageXOffset
			);
		}

		function checkMQ() {
			//check if mobile or desktop device
			return window.getComputedStyle(document.querySelector('.mkdf-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
		}

		return {
			init: function() {
				(timelines.length > 0) && initTimeline(timelines);
			}
		}
	}

	function socialFeedCarousel() {
		var carousels = $('.mkdf-social-feed-carousel'),
			carouselObject;

		var initCarousel = function(socialFeedHolder) {
			var carousel = socialFeedHolder.find('.mkdf-social-feed-carousel-holder');

			carouselObject = carousel.slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				swipeToSlide: true,
				cssEase: 'cubic-bezier(.19,1,.22,1)',
				speed: 850,
				touchThreshold: 20,
				prevArrow: '<span class="arrow_carrot-left mkdf-social-feed-carousel-prev"></span>',
				nextArrow: '<span class="arrow_carrot-right mkdf-social-feed-carousel-next"></span>',
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});
		}

		var initFilter = function(socialFeedHolder) {
			var filters = socialFeedHolder.find('.mkdf-social-feed-filter-item');

			filters.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				var currentFilter = $(this);

				setFilterState(filters, currentFilter);

				var type = currentFilter.data('type');

				if(typeof type === 'undefined') {
					TweenLite.to(carouselObject, 0.2, { opacity: 0 });

					setTimeout(function() {
						carouselObject.slick('slickUnfilter').slick('slickGoTo', 0);

						TweenLite.to(carouselObject, 0.2, { opacity: 1 });
					}, 200);

					return;
				}

				TweenLite.to(carouselObject, 0.2, { opacity: 0 });

				setTimeout(function() {
					carouselObject.slick('slickFilter', function() {
						return $('.' + type, this).length;
					}).slick('slickGoTo', 0);

					TweenLite.to(carouselObject, 0.2, { opacity: 1 });
				}, 200);
			});
		};

		var setFilterState = function(filters, currentFilter) {
			filters.removeClass('mkdf-social-feed-current-filter');
			currentFilter.addClass('mkdf-social-feed-current-filter');
		};

		return {
			init: function() {
				if(carousels.length) {
					carousels.each(function() {
						initCarousel($(this));
						initFilter($(this));
					});
				}
			}
		};
	};

	function socialFeedMasonry() {
		var socialFeeds = $('.mkdf-social-feed-masonry'),
			masonryObject;

		var initMasonry = function(socialFeed) {
			var masonryHolder = socialFeed.find('.mkdf-social-feed-masonry-holder');

			masonryHolder.animate({ opacity: 1 });

			masonryObject = masonryHolder.isotope({
				percentPosition: true,
				itemSelector: '.mkdf-social-feed-masonry-item-holder',
				transitionDuration: '0.4s',
				hiddenStyle: {
					opacity: 0
				},
				visibleStyle: {
					opacity: 1
				},
				masonry: {
					columnWidth: '.mkdf-social-feed-masonry-grid-sizer'
				}
			});
		};

		var initFilter = function(socialFeed) {
			var filters = socialFeed.find('.mkdf-social-feed-filter-item');

			filters.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				var currentFilter = $(this);
				var type = currentFilter.data('type');

				filters.removeClass('mkdf-social-feed-current-filter');
				currentFilter.addClass('mkdf-social-feed-current-filter');

				type = typeof type === 'undefined' ? '*' : '.' + type;

				masonryObject.isotope({
					filter: type
				});
			});
		};

		return {
			init: function() {
				if(socialFeeds.length) {
					socialFeeds.each(function() {
						initMasonry($(this));
						initFilter($(this));
					});
				}
			}
		}
	}

})(jQuery);