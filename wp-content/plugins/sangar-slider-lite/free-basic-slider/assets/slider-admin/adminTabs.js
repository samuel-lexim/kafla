var adminTabs;

;(function($) {
	adminTabs = function(base)
	{
		if ( $('.sslider-tabs').length > 0 ) {
	        js_tabs('.sslider-tabs','.group','active');
	    }

	    if ( $('.sslider-layer-tabs').length > 0 ) {
	        js_tabs('.sslider-layer-tabs','.group-layer','active');
	    }

	    if ( $('.sslider-conf-tabs').length > 0 ) {
	        js_tabs('.sslider-conf-tabs','.group-conf','active');
	    }

	    function js_tabs(tabs,container,activeClassName) 
	    {
	        var navtabs = $(tabs),
	        	group = $(container),	            
	            active_tab = '',
	            localStorageName = tabs.substring(1);

	        /* Hide all group on start */
	        group.hide();

	        if(navtabs.children('.' + activeClassName).length > 0)
	        {
	        	var selected = navtabs.children('.' + activeClassName).attr('href');

	        	$(container + selected).show();
	        }
	        else
	        {
	        	/* Find if a selected tab is saved in localStorage */
		        if ( typeof(localStorage) != 'undefined' ) {
		            active_tab = localStorage.getItem(localStorageName);
		        }

		        /* If active tab is saved and exists, load it's .group */
		        if ( active_tab != '' && $(container + active_tab).length ) {
		            $(container + active_tab).fadeIn();
		            navtabs.children(active_tab + '-tab').addClass(activeClassName);
		        } else {
		            $(container + ':first').fadeIn();
		            navtabs.children('a:first').addClass(activeClassName);
		            active_tab = navtabs.children('a:first');
		        }
	        }

	        /* Bind tabs clicks */
	        navtabs.children('a').click(function(e) {

	            e.preventDefault();

	            /* Remove active class from all tabs */
	            navtabs.children('a').removeClass(activeClassName);

	            $(this).addClass(activeClassName).blur();

	            if (typeof(localStorage) != 'undefined' ) {
	                localStorage.setItem(localStorageName, $(this).attr('href') );
	            }

	            var selected = $(this).attr('href');

	            group.hide();

	            $(container + selected).fadeIn();
	        });
	    }
	}
})(jQuery);