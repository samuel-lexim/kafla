jQuery(document).ready(function($) {
	/**
	 * Tabs
	 */
	if ( $('.nav-tab-wrapper').length > 0 ) {
		js_tabs();
	}

	function js_tabs() {

		var group = $('.group'),
			navtabs = $('.nav-tab-wrapper a'),
			active_tab = '';

		/* Hide all group on start */
		group.hide();

		if(window.location.hash)
		{
			/* Find if a hash link selected */
			active_tab = window.location.hash;
		}
		else if(typeof(localStorage) != 'undefined')
		{
			/* Find if a selected tab is saved in localStorage */
			active_tab = localStorage.getItem('active_tab');
		}

		/* If active tab is saved and exists, load it's .group */
		if ( active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
			active_tab = $('.nav-tab-wrapper a:first');
		}

		/* Bind tabs clicks */
		navtabs.click(function(e) {

			e.preventDefault();

			/* Remove active class from all tabs */
			navtabs.removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_tab', $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			group.hide();
			$(selected).fadeIn();
		});
	}
	// activate navbar tab via button
	$('.navbar-button, .btn-upgrade').click(function(){
		$('.nav-tab-wrapper a').trigger('click');

		setTimeout(function() {
			window.scrollTo(0, 0);
		}, 1);
	});
	// disable hash jump
	if (window.location.hash) {
		setTimeout(function() {
			window.scrollTo(0, 0);
		}, 1);
	}
});