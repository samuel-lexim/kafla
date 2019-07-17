/**
 * jQuery sccoedion for WordPress admin site
 *
 * 'exclude' class mean it's not affect with other accordion
 * 'locked' class mean it's always show or hide
 * 'closed' class mean it's closed/hide on start
 */

;(function($) {

    var wpAccordionClasses = [];

    $.fn.wpAccordion = function() 
    {
        var selector = this.selector;

        if($.inArray(selector, wpAccordionClasses) !== -1) return;

        this.each(function(){
            var base = this;
            var $el = $(base);
            var $toggle = $el.children('.sidebar-name');
            var $content = $el.children('.sidebar-content');

            // add class to settings-container
            $el.parent('.settings-container').addClass('wpAccordionContainer');

            // $el.addClass('widgets-holder-wrap')
            //    .wrap('<div class="settings-container" />')
            //    .wrap('<div class="meta-box-sortables ui-sortable" />');

            $toggle.on('click',function(){

                if ($el.hasClass('locked')) return;

                // Close the other widgets before opening selected widget
                if (! $el.hasClass('exclude'))
                {
                    $(selector).children('.sidebar-name').each(function() {

                        // Get parent
                        var $parent = $(this).parent();

                        // Close the widget
                        if (! $parent.hasClass('exclude') && ! $parent.hasClass('closed') ) {
                            // $parent.find('.sidebar-content').slideUp(200, function() {
                            //     $parent.addClass('closed');
                            // });

                            $parent.find('.sidebar-content').hide();
                            $parent.addClass('closed');
                        }

                    });
                }

                // Open/close the widget
                if ( $el.hasClass('closed') )
                {
                    // $content.slideDown(200, function() {
                    //     $el.removeClass('closed');
                    // });

                    $content.show();
                    $el.removeClass('closed');
                }                    
                else
                {
                    // $content.slideUp(200, function() {
                    //     $el.addClass('closed');
                    // });

                    $content.hide();
                    $el.addClass('closed');
                }

            });
        });
            
        return this;
    };

})(jQuery);