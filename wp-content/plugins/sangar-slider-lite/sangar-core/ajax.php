<?php
/**
 * Ajax Show Modal
 */
add_action('wp_ajax_sslider_show_modal', 'sslider_show_modal');
function sslider_show_modal() 
{
    $bg_image_default = plugin_dir_url( __FILE__ ).'assets/images/thumb_img.png';
    $bg_video_default = plugin_dir_url( __FILE__ ).'assets/images/thumb_video.png';
    $bg_type_img = $bg_image_default;    
    $bg_type_img_url = '';
    $bg_type_img_mobile = $bg_image_default;
    $bg_type_img_mobile_url = '';
    $bg_overlay_img_url = '';
    $bg_video_poster = $bg_image_default;
    $bg_video_poster_url = '';
    $bg_type_video_html5 = "<img style='width:450px;' src='$bg_video_default' >";
    $bg_video_isset = 'false';
    $default = $_POST['defaultSlideOptions'];
    $dataRow = array();

    // if edit data
    if($_POST['slug'] != 'false')
    {
        $serializedData = $_POST['serializedData'];
        $arrData = unserialize(base64_decode($serializedData));    
        $dataRow = $arrData[$_POST['slug']];

        // set default data
        $dataRow = array_merge($default,$dataRow);

        // background image
        $img_id = $dataRow['tab-bg-image'];

        if($img_id != '' && $img_id > 0)
        {
            $scr = wp_get_attachment_image_src($img_id,'medium');
            $scr_url = wp_get_attachment_image_src($img_id,'original');
            $bg_type_img = $scr[0];
            $bg_type_img_url = $scr_url[0];
        }

        // background mobile image
        $img_id = isset($dataRow['tab-bg-mobile-image']) ? $dataRow['tab-bg-mobile-image'] : '';

        if($img_id != '' && $img_id > 0)
        {
            $scr = wp_get_attachment_image_src($img_id,'medium');
            $scr_url = wp_get_attachment_image_src($img_id,'original');
            $bg_type_img_mobile = $scr[0];
            $bg_type_img_mobile_url = $scr_url[0];
        }

        // overlay image
        $img_id = $dataRow['tab-overlay-upload-image'];

        if($img_id != '' && $img_id > 0)
        {
            $scr = wp_get_attachment_image_src($img_id,'medium');
            $scr_url = wp_get_attachment_image_src($img_id,'original');
            $bg_overlay_img_url = $scr_url[0];
        }

        // video
        $video_id = $dataRow['tab-bg-video-html5'];

        if($video_id != '' && $video_id > 0)
        {
            $scr = wp_get_attachment_url($video_id);
            $bg_type_video_html5 = $scr;
            $bg_video_isset = 'true';
        }

        // video poster (image)
        $img_id = $dataRow['tab-bg-video-html5-poster'];

        if($img_id != '' && $img_id > 0)
        {
            $scr = wp_get_attachment_image_src($img_id,'original');
            $scr_url = wp_get_attachment_image_src($img_id,'original');
            $bg_video_poster = $scr[0];
            $bg_video_poster_url = $scr_url[0];
        }
    }
    else
    {
        // set default data
        $dataRow = array_merge($default,$dataRow);

        // set the auto title
        $serializedData = $_POST['serializedData'];
        $arrData = unserialize(base64_decode($serializedData));
        
        $count = count($arrData);
        $new_title = '';

        if($count == 1 && $arrData == false)
        {
            $dataRow['slide-title'] = 'Slide 1';
        }
        else
        {
            for ($i = ($count + 1); $i < 999; $i++)
            { 
                if(! isset($arrData['slide-' . $i]))
                {
                    $new_title = 'Slide ' . $i;

                    break;
                }
            }

            $dataRow['slide-title'] = $new_title;
        }
    }

    $return = array(
        'success' => true,
        'bg_type_img' => $bg_type_img,
        'bg_type_img_url' => $bg_type_img_url,
        'bg_type_img_mobile' => $bg_type_img_mobile,
        'bg_type_img_mobile_url' => $bg_type_img_mobile_url,
        'bg_overlay_img_url' => $bg_overlay_img_url,
        'bg_type_video_html5' => $bg_type_video_html5,
        'bg_video_poster' => $bg_video_poster,
        'bg_video_poster_url' => $bg_video_poster_url,
        'bg_video_isset' => $bg_video_isset,
        'bg_image_default' => $bg_image_default,        
        'bg_video_default' => $bg_video_default,
        'dataRow' => $dataRow
    );

    echo json_encode($return);

    wp_die();
}


/**
 * Ajax Save (add slide to serialized textarea)
 */
add_action('wp_ajax_sslider_add_slide', 'sslider_add_slide' );
function sslider_add_slide() 
{
    $serializedData = $_POST['serializedData'];
    $formData = json_decode(stripslashes($_POST['formData']));

    $formData = postdata_to_array($formData);

    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));
    }

    // is new data or edit old data
    if($_POST['isNewData'] == 'true')
    {
        $slug = get_slide_slug($formData,$arrData);
    }
    else $slug = $_POST['slug'];

    // add some data
    $formData['slide-type'] = $_POST['type'];

    // set data and serializing
    $arrData[$slug] = $formData;
    $serialized = base64_encode(serialize($arrData));
    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}

add_action('wp_ajax_sslider_add_youtube_slide', 'sslider_add_youtube_slide' );
function sslider_add_youtube_slide() 
{
    $serializedData = $_POST['serializedData']; 
    $formData = json_decode(stripslashes($_POST['formData']));
    $formData = (array) $formData;
    
    $formData['tab-bg-selection'] = 'iframe';
    $formData['slide-type'] = 'iframe';

    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));
    }

    // is new data or edit old data
    if($_POST['isNewData'] == 'true')
    {
        $slug = get_slide_slug($formData,$arrData);
    }
    else $slug = $_POST['slug'];
    
    // set data and serializing
    $arrData[$slug] = $formData;
    $serialized = base64_encode(serialize($arrData));
    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}

function get_slide_slug($formData,$arrData)
{
    $title = $formData['slide-title'];

    $slug = sanitize_title($title);

    if(count($arrData) > 0 && isset($arrData[$slug]))
    {
        for ($i=1; $i<999; $i++) 
        { 
            if(! isset($arrData[$slug.'-'.$i]))
            {
                $slug = $slug.'-'.$i;

                break;
            }
        }
    }

    return $slug;
}

function get_slide_rows($data)
{
    // come from ajax or not
    if(isset($_POST['defaultSlideOptions']))
    {
        $default = $_POST['defaultSlideOptions'];
    }
    else
    {
        $default = ssliderDefault::slide();
    }    

    $rows = '';
    $number = 1;

    if(! empty($data) && is_array($data))
    {
        foreach ($data as $slug => $slide) 
        {
            $slide = array_merge($default,$slide);

            // title
            $rwdata['title'] = $slide['slide-title'];
            $rwdata['slug'] = $slug;
            $rwdata['type'] = $slide['slide-type'];

            // image
            $rwdata['thumbnail'] = $slide['tab-bg-color'];
            $rwdata['thumbtype'] = $slide['tab-bg-selection'];            
            $img_id = $slide['tab-bg-image'];

            if($rwdata['thumbtype'] == 'image')
            {
                $rwdata['thumbnail'] = plugin_dir_url( __FILE__ ).'assets/images/small_thumb_img.jpg';

                if($img_id != '' && $img_id > 0)
                {
                    $scr = wp_get_attachment_image_src($img_id,'thumbnail');
                    $rwdata['thumbnail'] = $scr[0];
                }
            }        

            $row = sslider_row($rwdata,false,$number++);
            $rows .= $row;
        }
    }

    return $rows;
}

function postdata_to_array($data)
{
    $return = array();

    foreach ($data as $key => $value) 
    {
        $return[$value->name] = $value->value;
    }

    return $return;
}


/**
 * Ajax switch slider type, 'static' or 'layer'
 */
add_action('wp_ajax_sslider_switch_type', 'sslider_switch_type' );
function sslider_switch_type() 
{
    $slug = $_POST['slug'];
    $serializedData = $_POST['serializedData'];    
    $arrData = unserialize(base64_decode($serializedData));    

    // change slide-type
    $type = $arrData[$slug]['slide-type'];
    $arrData[$slug]['slide-type'] = $type == 'static' ? 'layer' : 'static' ;

    // set data and serializing
    $serialized = base64_encode(serialize($arrData));
    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}


/**
 * Ajax delete slide in serialized textarea
 */
add_action('wp_ajax_sslider_delete_slide', 'sslider_delete_slide' );
function sslider_delete_slide() 
{
    $serializedData = $_POST['serializedData'];
    $slug = $_POST['slug'];

    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));
    }

    // set data and serializing
    unset($arrData[$slug]);
    
    if(count($arrData) > 0)
    {
        $serialized = base64_encode(serialize($arrData));
    }
    else $serialized = '';

    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}


/**
 * Ajax duplicate slide
 */
add_action('wp_ajax_sslider_duplicate_slide', 'sslider_duplicate_slide');
function sslider_duplicate_slide()
{
    $serializedData = $_POST['serializedData'];
    $slug = $_POST['slug'];

    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));
    }

    $formData = $arrData[$slug]; //get copy

    $new_slug = get_slide_slug($formData,$arrData);

    // set data and serializing
    $arrData = arr_push_after($new_slug,$formData,$slug,$arrData);
    $serialized = base64_encode(serialize($arrData));
    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}

function arr_push_after($new_key,$new_val,$indexer,$stack)
{
    $new_stack = array();

    foreach ($stack as $key => $value) 
    {
        $new_stack[$key] = $value;

        if($key == $indexer) $new_stack[$new_key] = $new_val;
    }

    return $new_stack;
}


/**
 * Ajax disable preview
 */
add_action('wp_ajax_sslider_disable_preview', 'sslider_disable_preview');
function sslider_disable_preview() 
{
    $id = $_POST['id'];

    // get
    $config = get_post_meta($id, 'sslider_config',true);
    $config = unserialize(base64_decode($config));
    
    // set
    $config['is_preview'] = 'false';
    $config = base64_encode(serialize($config));
    update_post_meta($id,'sslider_config',$config);

    wp_die();
}


/**
 * Ajax sort slides
 */
add_action('wp_ajax_sslider_sort_slides', 'sslider_sort_slides');
function sslider_sort_slides() 
{
    $serializedData = $_POST['serializedData'];
    $order = $_POST['order'];

    $sorted = array();
    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));

        foreach ($order as $key => $value) 
        {
            $sorted[$value] = $arrData[$value];
        }
    }

    if(count($sorted) > 0)
    {
        $serialized = base64_encode(serialize($sorted));
    }
    else $serialized = '';

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized
    );

    echo json_encode($return);

    wp_die();
}


/**
 * Ajax get theme file
 */
add_action('wp_ajax_sslider_get_theme_file', 'sslider_get_theme_file');
function sslider_get_theme_file() 
{
    $templates = apply_filters('sangar_slider_templates',array());
    $template = $templates[$_POST['template']];
    $theme = $_POST['theme'];
    $textfile = false;

    // theme from template
    if(! empty($template['themesLocation']))
    {
        $theme_url = $template['themesLocation']."/$theme.css";

        if(file_exists($theme_url))
        {
            $textfile = file_get_contents($theme_url, FILE_USE_INCLUDE_PATH);
        }
    }

    // theme default
    if(! $textfile)
    {
        $theme_url = plugin_dir_path( __DIR__ )."elements/themes/$theme.css";

        if(file_exists($theme_url))
        {
            $textfile = file_get_contents($theme_url, FILE_USE_INCLUDE_PATH);
        }   
    }

    if(! $textfile) $textfile = '';

    // json return
    $return = array(
        'success' => true,
        'textfile' => $textfile
    );

    echo json_encode($return);

    wp_die();
}


/**
 * Ajax replace all slide config with theme config
 */
add_action('wp_ajax_sslider_slide_config_theme_replace', 'sslider_slide_config_theme_replace' );
function sslider_slide_config_theme_replace() 
{
    $serializedData = $_POST['serializedData'];
    $default = $_POST['defaultSlideOptions'];

    $arrData = array();

    // if there are a previous data
    if($serializedData != '')
    {
        $arrData = unserialize(base64_decode($serializedData));

        foreach ($arrData as $key => $value) 
        {
            $value = array_merge($default,$value);

            $arrData[$key] = $value;
        }    
    }
    
    $serialized = base64_encode(serialize($arrData));
    $rows = get_slide_rows($arrData);

    // json return
    $return = array(
        'success' => true,
        'serialized' => $serialized,
        'rows' => $rows
    );

    echo json_encode($return);

    wp_die();
}

add_action('wp_ajax_sslider_do_shortcode_content', 'sslider_do_shortcode_content' );
function sslider_do_shortcode_content() {
    // $content = wp_kses($_POST['content']);
    $content = $_POST['content'];
    $content = stripslashes($content);

    echo do_shortcode($content);

    wp_die();
}

// for wp below 4.1
if(! function_exists('wp_die')) {
    function wp_die() {
        die();
    }
}