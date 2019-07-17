<thead class="tab-content" id="tab-content-selection">
    <tr valign="top">
        <th>Content Type</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  'none',
                        'label' =>  'None' 
                    ),
                    '1' => array(
                        'value' =>  'text',
                        'label' =>  'Text'
                    ),
                    '2' => array(
                        'value' =>  'text-and-button',
                        'label' =>  'Text And Button' 
                    ),
                    '3' => array(
                        'value' =>  'html',
                        'label' =>  'HTML'
                    )
                );

                $form_lib->print_select($arr_data,"tab-content-selection","image");
            ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</thead>

<thead class="tab-content" id="tab-content-sel-text">
    <tr valign="top" class="content-repeatable">
        <th scope="row">Content Description</th>
        <td>
            <?php 
                $settings = array(
                    'textarea_rows' => '12',
                    'media_buttons' => false,
                    'quicktags' => false,
                    'editor_height' => 200
                );

                wp_editor('','tab-content-text',$settings);
            ?>
        </td>
    </tr>
</thead>

<thead class="tab-content" id="tab-content-sel-html">
    <tr valign="top">
        <th scope="row">Content HTML</th>
        <td>
            <textarea id="content-html-editor" name="tab-content-html"></textarea>
        </td>
    </tr>
</thead>

<thead class="tab-content" id="tab-content-sel-button">
    <tr class="button_attr">
        <th scope="row">Button Text</th>
        <td>
            <input class="regular-text" type="text" name="tab-content-btn-caption" value="" placeholder="Type the button text" />
        </td>
    </tr>

    <tr class="button_attr">
        <th scope="row">Button Hyperlink</th>
        <td>
            <input class="regular-text" type="text"  name="tab-content-btn-link" value="" placeholder="Type the button hyperlink" />
        </td>
    </tr>

    <tr valign="top">
        <th>Button Hyperlink Target</th>
        <td>
            <?php 
                $arr_data = array(                                  
                    '0' => array(
                        'value' =>  '_self',
                        'label' =>  'Open on the same page'
                    ),
                    '1' => array(
                        'value' =>  '_blank',
                        'label' =>  'Open on new page'
                    ),
                    '2' => array(
                        'value' =>  '_parent',
                        'label' =>  'Open in parent frame'
                    ),
                    '3' => array(
                        'value' =>  '_top',
                        'label' =>  'Open in main frame'
                    )
                );

                $form_lib->print_select($arr_data,"tab-content-btn-link-target","true");
            ?>
        </td>
        <td>&nbsp;</td>
    </tr>
</thead>