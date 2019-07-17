<thead class="tab-bg tab-bg-selection" id="tab-bg-selection">
    <tr valign="top">
        <th>Featured image size</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  'full',
                        'label' =>  'Full'
                    ),
                    '1' => array(
                        'value' =>  'large',
                        'label' =>  'Large'
                    ),
                    '2' => array(
                        'value' =>  'medium',
                        'label' =>  'Medium'
                    )
                );

                $form_lib->print_select($arr_data,"tab-bg-featured-size","full");
            ?>
        </td>
        <td>&nbsp;</td>
    </tr>

    <tr valign="top">
        <th>Permalink current post</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  '_self',
                        'label' =>  'Yes, open on the same page'
                    ),
                    '1' => array(
                        'value' =>  '_blank',
                        'label' =>  'Yes, open on new page'
                    ),
                    '2' => array(
                        'value' =>  'false',
                        'label' =>  'Disable the slide permalink'
                    )
                );

                $form_lib->print_select($arr_data,"tab-bg-permalink-current-post","true");
            ?>

            <label class="description" >Will override all layer's link if enabled, including button</label>
        </td>
        <td>&nbsp;</td>
    </tr>

    <tr valign="top">
        <th>Overlay Type</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  '',
                        'label' =>  'Dont Use Overlay'
                    ),
                    '1' => array(
                        'value' =>  'color',
                        'label' =>  'Color' 
                    ),
                    '2' => array(
                        'value' =>  'select-image',
                        'label' =>  'Select Image'
                    ),
                    '3' => array(
                        'value' =>  'upload-image',
                        'label' =>  'Upload Image'
                    )
                );

                $form_lib->print_select($arr_data,"tab-overlay-selection");
            ?>
        </td>
        <td>&nbsp;</td>
    </tr>

    <tr valign="top" class="tab-overlay" id="tab-overlay-color">
        <th scope="row">Overlay Color</th>
        <td>
            <input type="text" class="regular-text minicolors_opacify" name="tab-overlay-color" value="" />
            <label class="description" ></label>
        </td>
    </tr>

    <tr valign="top" class="tab-overlay" id="tab-overlay-select-image">
        <th>Overlay Select Image</th>
        <td>
            <?php 
                $pattern_images = apply_filters('sangar_slider_pattern_images',array());
                $pattern_images_select = array();

                foreach ($pattern_images as $key => $value) 
                {
                    $pattern_images_select[] = array(
                        'label' => $value['name'],
                        'value' => $key,
                    );
                }

                $form_lib->print_select($pattern_images_select,"tab-overlay-select-image");
            ?>
        </td>
    </tr>

    <tr valign="top" class="tab-overlay" id="tab-overlay-upload-image">
        <th>Overlay Upload Image</th>
        <td>
            <?php $wpMediaUploader = new wpMediaUploader('tab-overlay-upload-image','image','select','false','false') ?>
        </td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <th colspan="3"><h3>If there is no featured image:</h3></th>
    </tr>

    <tr valign="top">
        <th>Background Type</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  'image',
                        'label' =>  'Image' 
                    ),
                    '1' => array(
                        'value' =>  'color',
                        'label' =>  'Solid Color'
                    ),
                    '2' => array(
                        'value' =>  'video',
                        'label' =>  'Video'
                    ),
                    '3' => array(
                        'value' =>  'html',
                        'label' =>  'HTML'
                    )
                );

                $form_lib->print_select($arr_data,"tab-bg-selection","image");
            ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</thead>

<thead class="tab-bg" id="tab-bg-image">
    <tr valign="top" id="background-type-image">
        <th>Background Image</th>
        <td>
            <?php $wpMediaUploader = new wpMediaUploader('tab-bg-image','image') ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</thead>

<thead class="tab-bg" id="tab-bg-color">
    <tr valign="top" id='background-type-color'>
        <th scope="row">Solid Color</th>
        <td>
            <input type="text" class="regular-text minicolors" name="tab-bg-color" value="" />
            <label class="description" ></label>
        </td>
    </tr>
</thead>

<thead class="tab-bg" id="tab-bg-video">
    <tr valign="top" id="background-type-image">
        <th>HTML5 Video</th>
        <td>
            <?php $wpMediaUploader = new wpMediaUploader('tab-bg-video-html5','video') ?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr valign="top" id="background-type-image">
        <th>HTML5 Video Poster</th>
        <td>
            <?php $wpMediaUploader = new wpMediaUploader('tab-bg-video-html5-poster','image') ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</thead>

<thead class="tab-bg" id="tab-bg-html">
    <tr valign="top" id='background-type-color'>
        <th scope="row">HTML Source</th>
        <td>
            <textarea id="bg-html-editor" class="bg-html-editor" name="tab-bg-html"></textarea>
        </td>
    </tr>
</thead>

<thead>
    
</thead>