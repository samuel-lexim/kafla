var adminPreview;

;(function($) {
    adminPreview = function(base)
    {
        /**
         * Slide preview
         */
        base.previewModal.dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            draggable: false,
            hide: false,
            dialogClass: "fullscreen-ui-with-button-modal",
            open: function (event, ui) {
                // disable scroll on body
                $('body').addClass('stop-scrolling');
                $('body').bind('touchmove', function(e){e.preventDefault()});
            },
            close: function (event, ui) {
                // re-enable scroll on body
                $('body').removeClass('stop-scrolling');
                $('body').unbind('touchmove', function(e){e.preventDefault()});

                $(this).remove();
            }
        }).parent('.ui-dialog').attr('id','sangar-slider-modal-dialog');

        base.disablePreview = function() 
        {
            base.ajaxOnProgress();

            var postID = $("input[name='post_ID']").val();
            
            var data = {
                action: 'sslider_disable_preview',
                id: postID,
                defaultSlideOptions: defaultSlideOptions
            }

            $.post(ajaxurl, data, function(response){
                base.ajaxOnProgress('hide');
            });
        }

        // on click preview
        $("#publishing-action").on('click','#sslider-preview-slide',function(){
            $("input[name='config[is_preview]']").val("true");
            
            $("input[type='submit'][id='publish']").trigger('click');
        });

        // on load
        if($("input[name='config[is_preview]']").val() == "true")
        {
            base.previewModal.dialog("open");

            $("input[name='config[is_preview]']").val("false");
            $("#is_preview_saved").val("false");

            base.disablePreview();
        }
    }
})(jQuery);