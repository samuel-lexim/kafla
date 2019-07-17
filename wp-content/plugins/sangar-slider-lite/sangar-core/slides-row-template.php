<?php
/** 
 * Slide row template
 */

function sslider_row($rwdata, $image_only = false, $number = 0) 
{
    $list_item_attr = 'sslider-edit-slide';
    $title_treshold = 13;
    $title = strlen($rwdata['title']) > $title_treshold ? substr($rwdata['title'],0,$title_treshold) . '...' : $rwdata['title'];

    $print_number = $number > 0 ? "<div class='sslider_slide_order'>$number</div>" : '';

    $img_style = $image_only ? "style='background:{$rwdata['thumbnail']}'" : '';

    if($rwdata['thumbtype'] == 'color')
    {
        $color = plugin_dir_url( __FILE__ ).'assets/images/bg_img_empty.png';
        $thumbnail = "<div style='height:100px;width:100px;background-color:{$rwdata['thumbnail']};'></div>";
    }

    switch ($rwdata['thumbtype']) {
        case 'image':
            $thumbnail = "<img $img_style src='{$rwdata['thumbnail']}'>";
            break;

        case 'color':
            $image = plugin_dir_url( __FILE__ ).'assets/images/small_thumb_color.png';
            $thumbnail = "<img $img_style src='$image' style='background:{$rwdata['thumbnail']}'>";
            break;

        case 'video':
            $image = plugin_dir_url( __FILE__ ).'assets/images/small_thumb_video.jpg';
            $thumbnail = "<img $img_style src='$image'>";
            break;

        case 'iframe':
            $image = plugin_dir_url( __FILE__ ).'assets/images/small_thumb_you_vim.jpg';
            $thumbnail = "<img $img_style src='$image'>";
            break;

        case 'html':
            $image = plugin_dir_url( __FILE__ ).'assets/images/small_thumb_html.jpg';
            $thumbnail = "<img $img_style src='$image'>";
            break;

        case 'add-new-slide':
            $thumbnail = "";
            $list_item_attr = 'sslider-add-slide';
            $title = $rwdata['title'];
            break;
            
        default:
            # code...
            break;
    }

if($image_only):

    return $thumbnail;

else:

return <<<EOT
    <li class='list_item slide_item' id="{$rwdata['slug']}">
        <div class='sslider_td_container' data-type='{$rwdata['type']}' data-slug='{$rwdata['slug']}'>
            <div class='sslider_slide_thumbnail {$rwdata['type']}' $list_item_attr >
                $print_number
                $thumbnail
            </div>
            <div class='sslider_slide_info'>
            <span>$title</span>
            </div>
            <div class='sslider_slide_edit'>
                <a class='sslider-btn-edit' title='Edit Slide' sslider-edit-slide></a>
                <a class='sslider-btn-duplicate' title='Duplicate Slide' data-slug='{$rwdata['slug']}' sslider-duplicate-slide></a>
                <a class='sslider-btn-delete' title='Delete Slide' data-slug='{$rwdata['slug']}' sslider-delete-slide></a>
            </div>
        </div>
    </li>
EOT;

endif;

}