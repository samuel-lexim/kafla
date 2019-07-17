<?php

/** 
 * Prints the box content 
 */
function sslider_slide_management_callback($post) 
{
    $sslider_data = get_post_meta($post->ID, 'sslider_data',true);    

    // setup initial data
    if($sslider_data == '') 
    {
        // add a one blank layer slide named post-slider
        $original_sslider_data = 'a:1:{s:11:"post-slider";a:24:{s:10:"tab-preset";s:9:"no-preset";s:11:"slide-layer";s:98:"{"desktop":{"number":0,"options":{},"content":[]},"mobile":{"number":0,"options":{},"content":[]}}";s:21:"slide-layer-is-mobile";s:5:"false";s:20:"tab-bg-featured-size";s:4:"full";s:29:"tab-bg-permalink-current-post";s:5:"_self";s:21:"tab-overlay-selection";s:0:"";s:17:"tab-overlay-color";s:0:"";s:24:"tab-overlay-upload-image";s:0:"";s:16:"tab-bg-selection";s:5:"image";s:12:"tab-bg-image";s:5:"image";s:12:"tab-bg-color";s:7:"#222222";s:18:"tab-bg-video-html5";s:0:"";s:25:"tab-bg-video-html5-poster";s:0:"";s:11:"tab-bg-html";s:0:"";s:20:"tab-content-anim-all";s:7:"desktop";s:21:"tab-content-anim-type";s:20:"transition.slideUpIn";s:25:"tab-content-anim-duration";s:4:"1000";s:24:"tab-content-anim-stagger";s:3:"600";s:22:"sangar_query_post_type";a:1:{i:0;s:0:"";}s:18:"sangar_query_terms";a:1:{i:0;N;}s:21:"sangar_query_order_by";a:1:{i:0;s:4:"date";}s:18:"sangar_query_order";a:1:{i:0;s:4:"DESC";}s:18:"sangar_query_limit";a:1:{i:0;s:2:"10";}s:10:"slide-type";s:5:"layer";}}';
        $sslider_data = base64_encode($original_sslider_data);

        $slideshow = "Select <b>Edit Template</b> then setup the query editor and then save it to make a slideshow.";
    }
    else {
        $slideshow = do_shortcode("[sangar-slider id={$post->ID}]");
    }

    ?>

    <div class="slide-management" style="margin-top:12px;">
        <textarea id="original-sslider-data" style="display:none;"><?php echo $sslider_data ?></textarea>
        <textarea id="edited-sslider-data" style="display:none;" name="sslider_data" ><?php echo $sslider_data ?></textarea>

        <div style="max-width:100%;width:100%;overflow:hidden;">
            <?php echo $slideshow ?>
        </div>
    </div>

    <?php
}

