var adminQuery;

;(function($) {
    adminQuery = function(base)
    {
        base.querySelectNumber = 0;
        var $container = $('#sslider-query-editor-container');

        if($container.find(".toclone").length > 0) {
            base.querySelectNumber = $container.find(".toclone").length;
        }

        $container.cloneya()
            .on('clone_before_clone', function(event, toclone, newclone) {
                $container.find(".ordinary-select-2")
                    .children("select")
                    .select2("destroy")
                    .end();
            })
            .on('clone_after_append', function(event, toclone, newclone) {            
                $(newclone).find("select[class='sangar_query_post_type']").attr('data-number',base.querySelectNumber);
                $(newclone).find("select[class='sangar_query_terms select2']").attr('data-number',base.querySelectNumber).html('');
                
                // fill
                $(newclone).find("select[class='sangar_query_order_by']")
                    .attr('data-number',base.querySelectNumber).val('date');            
                $(newclone).find("select[class='sangar_query_order']")
                    .attr('data-number',base.querySelectNumber).val('DESC');
                $(newclone).find("input[class='sangar_query_limit']")
                    .attr('data-number',base.querySelectNumber).val('10');

                $container.find(".ordinary-select-2").children("select").select2();

                // for lite
                $(newclone).find("select[class='sangar_query_post_type']")
                    .attr('data-number',base.querySelectNumber).trigger('change');                
                
                base.querySelectNumber++;
            })
            .on('clone_before_delete', function(event, toDelete) {
                $(toDelete).find("select[class='sangar_query_post_type']").val('').trigger('change');
            });

        $('#sangar_query_clone').click(function(){
            var $toclone = $container.find(".toclone").last();
            $container.triggerHandler('clone_clone',[$toclone]);
        });

        $('#sslider-query-editor-container').sortable({
            items: '.toclone',
            opacity: 0.5,
            cursor: 'pointer',
            distance: 5,
            handle: '.sort-handle'
            // placeholder: "sslider-management-placeholder",
        });
    }
})(jQuery);