<?php

// Sangar Slider Addons
add_filter('sangar_slider_default_options_slide', function($data){

	$group = 'sangar_slider';

	$options['slide-title'] = '';
	$options['slide-hyperlink'] = '';
	$options['slide-hyperlink-target'] = '_self';
	$options['slide-type'] = 'static'; // static or layer
	$options['slide-layer'] = '';
	$options['slide-layer-is-mobile'] = 'false';
	$options['tab-preset'] = 'no-preset';

	// tab-bg
	$options['tab-bg-selection'] = 'image';
	$options['tab-bg-image'] = 'image';
	$options['tab-bg-color'] = '#222222';
	$options['tab-bg-video-type'] = 'html5';
	$options['tab-bg-video-html5'] = '';
	$options['tab-bg-video-html5-poster'] = '';
	$options['tab-bg-video-iframe'] = '';
	$options['tab-bg-html'] = '';

	$options['tab-content-selection'] = 'text';
	$options['tab-content-type'] = 'title-content-button';
	$options['tab-content-position'] = 'left';
	$options['tab-content-width'] = '8';
	$options['tab-content-padding-type'] = 'large';
	$options['tab-content-padding'] = '2.5em 2.5em 2.5em 2.5em';
	$options['tab-content-bg-type'] = 'transparent';
	$options['tab-content-bg-transparent'] = 'black';
	$options['tab-content-bg-color'] = '#222222';
	$options['tab-content-text'] = '';
	$options['tab-content-html'] = '';
	$options['tab-html-bg-type'] = 'none';
	$options['tab-html-bg-transparent'] = 'black';
	$options['tab-html-bg-color'] = '#222222';

	// tab-content-style
	$options['tab-content-title-align'] = 'left';
	$options['tab-content-title-color'] = '#ffffff';
	$options['tab-content-title-size'] = '3.5';
	$options['tab-content-title-font'] = '';
	$options['tab-content-title-bg-type'] = 'none';
	$options['tab-content-title-bg-transparent'] = 'black';
	$options['tab-content-title-bg-color'] = '#222222';
	$options['tab-content-title-bg-padding'] = 'medium';
	$options['tab-content-title-bg-padding-custom'] = '2.5em 2.5em 2.5em 2.5em';
		
	$options['tab-content-description-align'] = 'left';
	$options['tab-content-description-color'] = '#ffffff';
	$options['tab-content-description-size'] = '1.4';
	$options['tab-content-description-font'] = '';
	$options['tab-content-description-bg-type'] = 'none';
	$options['tab-content-description-bg-transparent'] = 'black';
	$options['tab-content-description-bg-color'] = '#222222';
	$options['tab-content-description-bg-padding'] = 'medium';
	$options['tab-content-description-bg-padding-custom'] = '2.5em 2.5em 2.5em 2.5em';

	$options['tab-content-btn-size'] = '1.6';
	$options['tab-content-btn-font'] = '';
	$options['tab-content-btn-skin'] = 'sslider-buttonskin-white';
	$options['tab-content-btn-align'] = 'left';
	$options['tab-content-btn-caption'] = 'Button Is Here';
	$options['tab-content-btn-link'] = '';
	$options['tab-content-btn-link-target'] = '_self';

	// background overlay
	$options['tab-overlay-selection'] = '';
	$options['tab-overlay-color'] = '';
	$options['tab-overlay-select-image'] = '';
	$options['tab-overlay-upload-image'] = '';

	// content animation
	$options['tab-content-anim-all'] = 'desktop';
	$options['tab-content-anim-type'] = 'transition.slideDownIn';
	$options['tab-content-anim-duration'] = '1000';
	$options['tab-content-anim-stagger'] = '600';

	// grouping
	if(defined('SSLIDER_CURRENT_ADDON')) {
		$data = array_merge($data,$options);
	} else {
		$data[$group] = $options;
	}

	return $data;
});


// Sangar Slider Addons
add_filter('sangar_slider_default_options_config', function($data){ 

	$group = 'sangar_slider';

	$options['is_preview'] = 'false';
	$options['template'] = 'horizontal-bullet-pagination';
	$options['themeClass'] = 'default';
	$options['animation'] = 'horizontal-slide';
	$options['animationSpeed'] = '1000';
	$options['fadeAnimation'] = 'false';
	$options['continousSliding'] = 'true';
	$options['timer'] = 'false';
	$options['timerAnimation'] = 'true';
	$options['advanceSpeed'] = '7000';
	$options['pauseOnHover'] = 'true';
	$options['startClockOnMouseOut'] = 'true';
	$options['startClockOnMouseOutAfter'] = '800';
	$options['directionalNav'] = 'autohide';
	$options['directionalNavShowOpacity'] = '1';
	$options['directionalNavHideOpacity'] = '0';
	$options['pagination'] = 'bullet';
	$options['paginationContentType'] = 'text';
	$options['paginationContentWidth'] = '200';
	$options['paginationImageHeight'] = '90';
	$options['paginationContentOutside'] = 'true';
	$options['html5VideoNextOnEnded'] = 'false';
	$options['width'] = '800';
	$options['height'] = '500';
	$options['background'] = '#222222';
	$options['timerColor'] = '';
	$options['fullWidth'] = 'false';
	$options['fullHeight'] = 'false';
	$options['fullHeightPercentage'] = '100';
	$options['minHeight'] = '300';
	$options['maxHeight'] = '0';
	$options['mobileTreshold'] = '400';
	$options['mobileDimension'] = 'true';
	$options['mobileWidth'] = '400';
	$options['mobileHeight'] = '550';
	$options['mobileFullContentBox'] = 'true';

	// custom_css
	$theme_url = SANGAR_SLIDER_DIR_PATH."elements/themes/{$options['themeClass']}.css";
    if(file_exists($theme_url)) {
        $options['custom_css'] = file_get_contents($theme_url, FILE_USE_INCLUDE_PATH);
    }
    else $options['custom_css'] = '';

	$options['panelDisplay'] = 'autohide';
	$options['panelNumber'] = 'true';
	$options['panelContentPaginationAutohide'] = 'true';
	$options['parallax'] = 'off';
	$options['parallaxSpeed'] = '1';
	$options['loadingEachContent'] = 'true';

	// grouping
	if(defined('SSLIDER_CURRENT_ADDON')) {
		$data = array_merge($data,$options);
	} else {
		$data[$group] = $options;
	}

	return $data;
});