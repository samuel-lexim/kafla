<?php
/**
 * Gel all terms and let the jquery choose it by post type
 */
function sslider_get_post_taxonomy()
{
    $data = array();

    $taxonomies = get_object_taxonomies('post', 'names');

    $args = array(
        'orderby' => 'name', 
        'order' => 'ASC',
        'hide_empty' => false
    );

    $terms = get_terms($taxonomies,$args);

    $i = 0;     

    foreach ($terms as $key2 => $value2)
    {
        $data[] = array(
            'id' => $value2->term_id,
            'text' => $value2->name,
            'taxonomy' => $value2->taxonomy
        );
    }

    return json_encode($data);
}

?>

<script type="text/javascript">
    jQuery(function($){
        var selectData = <?php echo sslider_get_post_taxonomy() ?>;        
        var $container = $('#sslider-query-editor-container');
        var $terms = $container.find('select[name="sangar_query_terms"]');

        $.each(selectData,function(index,value){
            $terms.append('<option value="' + selectData[index].taxonomy + '::' + selectData[index].id + '">'+selectData[index].text+'</option>');
        });

        $terms.trigger('change').select2();        
    });
</script>


<div class="settings-container" >    

    <!-- Animation Settings -->
    <div class="widgets-holder-wrap exclude locked content-style-textbox">
        <div class="sidebar-name">
            <h3>Query Editor</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix" id="sslider-query-editor-container">
            <table class="table-content">
                <tr valign="top">
                    <th scope="row">Categories or Tags</th>
                    <td>
                        <div class="ordinary-select-2">
                            <select name="sangar_query_terms" class="select2" multiple="multiple" placeholder="Set to empty to select all categories"></select>
                        </div>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Order By</th>
                    <td>
                        <select name="sangar_query_order_by" style="margin-right:10px;">
                            <option value="date">Date</option>
                            <option value="title">Title</option>
                            <option value="comment_count">Comment Count</option>
                        </select>

                        <select name="sangar_query_order">
                            <option value="DESC">DESC</option>
                            <option value="ASC">ASC</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show limit</th>
                    <td>
                        <input name="sangar_query_limit" type="number">
                        <label class="description">Fill with <code>-1</code> to show all post</label>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>