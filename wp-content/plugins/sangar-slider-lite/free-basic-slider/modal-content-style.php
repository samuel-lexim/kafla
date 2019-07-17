<div class="settings-container" >    

    <!-- Title -->
    <div class="widgets-holder-wrap exclude locked content-style-textbox">
        <div class="sidebar-name">
            <h3>Title</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
                <tr valign="top" id='textbox_color'>
                    <th scope="row">Align</th>
                    <td>
                        <?php 
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'left',
                                    'label' =>  'Left'
                                ),
                                '1' => array(
                                    'value' =>  'center',
                                    'label' =>  'Center' 
                                ),
                                '2' => array(
                                    'value' =>  'right',
                                    'label' =>  'Right' 
                                )
                            );

                            
                            $form_lib->print_select($arr_data,'tab-content-title-align');
                        ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Size</th>
                    <td>
                        <input class="regular-text" type="number" step="0.1" style="width:100px;" name="tab-content-title-size" value="" />
                        <label class="description" >The size is in em, in this case 1em = 10px</label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Color</th>
                    <td>
                        <input class="regular-text minicolors" type="text" name="tab-content-title-color" value="" />
                        <label class="description" ></label>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Font</th>
                    <td>
                        <?php $form_lib->print_select(tonjooGoogleFonts::select(),'tab-content-title-font','','class="select2"'); ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Background</th>
                    <td class="sslider-color-changer">
                        <div class="sslider-color-select">
                            <?php 
                                $arr_data = array(
                                    '0' => array(
                                        'value' =>  'transparent',
                                        'label' =>  'Transparent'
                                    ),
                                    '1' => array(
                                        'value' =>  'color',
                                        'label' =>  'Solid Color' 
                                    ),
                                    '2' => array(
                                        'value' =>  'none',
                                        'label' =>  'None' 
                                    )
                                );
                                
                                $form_lib->print_select($arr_data,'tab-content-title-bg-type');
                            ?>
                        </div>

                        <div class="sslider-color-transparent">
                            <?php $form_lib->print_select($transparent_images,'tab-content-title-bg-transparent');?>
                            <div class="transparent_bg_prev"></div>
                        </div>
                        <div class="sslider-color-color">
                            <input class="regular-text minicolors" type="text" name="tab-content-title-bg-color" value="" />
                            <label class="description" ></label>
                        </div>
                    </td>
                </tr>
                <tr id="textbox_padding" >
                    <th scope="row">Padding</th>
                    <td class="sslider-padding-changer">
                        <div class="sslider-padding-select">
                        <?php
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'small',
                                    'label' =>  'Small'
                                ),
                                '1' => array(
                                    'value' =>  'medium',
                                    'label' =>  'Medium'
                                ),
                                '3' => array(
                                    'value' =>  'large',
                                    'label' =>  'Large'
                                ),
                                '4' => array(
                                    'value' =>  'x-large',
                                    'label' =>  'Extra Large'
                                ),
                                '5' => array(
                                    'value' =>  'custom',
                                    'label' =>  'Custom'
                                )
                            );

                            $form_lib->print_select($arr_data,"tab-content-title-bg-padding");
                        ?>
                        </div>

                        <div class="sslider-padding-custom">
                            <input class="regular-text" name="tab-content-title-bg-padding-custom" value="" />
                            <label class="description">[top]em [right]em [bottom]em [left]em</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- Description -->
    <div class="widgets-holder-wrap exclude locked content-style-textbox">
        <div class="sidebar-name">
            <h3>Content Description</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
                <tr valign="top" id='textbox_color'>
                    <th scope="row">Align</th>
                    <td>
                        <?php 
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'left',
                                    'label' =>  'Left'
                                ),
                                '1' => array(
                                    'value' =>  'center',
                                    'label' =>  'Center' 
                                ),
                                '2' => array(
                                    'value' =>  'right',
                                    'label' =>  'Right' 
                                )
                            );

                            
                            $form_lib->print_select($arr_data,'tab-content-description-align');
                        ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Size</th>
                    <td>
                        <input class="regular-text" type="number" step="0.1" style="width:100px;" name="tab-content-description-size" value="" />
                        <label class="description" >The size is in em, in this case 1em = 10px</label>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Color</th>
                    <td>
                        <input class="regular-text minicolors" type="text" name="tab-content-description-color" value="" />
                        <label class="description" ></label>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Font</th>
                    <td>
                        <?php $form_lib->print_select(tonjooGoogleFonts::select(),'tab-content-description-font','','class="select2"'); ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Background</th>
                    <td class="sslider-color-changer">
                        <div class="sslider-color-select">
                            <?php 
                                $arr_data = array(
                                    '0' => array(
                                        'value' =>  'transparent',
                                        'label' =>  'Transparent'
                                    ),
                                    '1' => array(
                                        'value' =>  'color',
                                        'label' =>  'Solid Color' 
                                    ),
                                    '2' => array(
                                        'value' =>  'none',
                                        'label' =>  'None' 
                                    )
                                );
                                
                                $form_lib->print_select($arr_data,'tab-content-description-bg-type');
                            ?>
                        </div>

                        <div class="sslider-color-transparent">
                            <?php $form_lib->print_select($transparent_images,'tab-content-description-bg-transparent');?>
                            <div class="transparent_bg_prev"></div>
                        </div>
                        <div class="sslider-color-color">
                            <input class="regular-text minicolors" type="text" name="tab-content-description-bg-color" value="" />
                            <label class="description" ></label>
                        </div>
                    </td>
                </tr>

                <tr id="textbox_padding" >
                    <th scope="row">Padding</th>
                    <td class="sslider-padding-changer">
                        <div class="sslider-padding-select">
                        <?php
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'small',
                                    'label' =>  'Small'
                                ),
                                '1' => array(
                                    'value' =>  'medium',
                                    'label' =>  'Medium'
                                ),
                                '3' => array(
                                    'value' =>  'large',
                                    'label' =>  'Large'
                                ),
                                '4' => array(
                                    'value' =>  'x-large',
                                    'label' =>  'Extra Large'
                                ),
                                '5' => array(
                                    'value' =>  '',
                                    'label' =>  'Custom'
                                )
                            );

                            $form_lib->print_select($arr_data,"tab-content-description-bg-padding");
                        ?>
                        </div>

                        <div class="sslider-padding-custom">
                            <input class="regular-text" name="tab-content-description-bg-padding-custom" value="" />
                            <label class="description">[top]em [right]em [bottom]em [left]em</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- Button -->
    <div class="widgets-holder-wrap exclude locked content-style-button">
        <div class="sidebar-name">
            <h3>Button</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
                <tr valign="top">
                    <th scope="row">Align</th>
                    <td>
                        <?php 
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'left',
                                    'label' =>  'Left'
                                ),
                                '1' => array(
                                    'value' =>  'center',
                                    'label' =>  'Center' 
                                ),
                                '2' => array(
                                    'value' =>  'right',
                                    'label' =>  'Right' 
                                )
                            );

                            
                            $form_lib->print_select($arr_data,'tab-content-btn-align');
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Size</th>
                    <td>
                        <input class="regular-text" type="number" step="0.1" style="width:100px;" name="tab-content-btn-size" value="" />
                        <label class="description" >The size is in em, in this case 1em = 10px</label>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Font</th>
                    <td>
                        <?php $form_lib->print_select(tonjooGoogleFonts::select(),'tab-content-btn-font','','class="select2"'); ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Skin</th>
                    <td>
                        <?php 
                            $buttons = apply_filters('sangar_slider_buttons',array());
                            $arr_data = array();

                            foreach ($buttons as $key => $value) 
                            {                                
                                $data = array(
                                    "label" => $value['name'],
                                    "value" => $key,
                                    "attr" => "data-imageSrc = '{$value['url']}'"
                                );

                                array_push($arr_data,$data);
                            }
                            
                            $form_lib->print_select($arr_data,'','','id="tab-content-btn-skin"');
                        ?>

                        <input type="hidden" style="display:none;" name="tab-content-btn-skin">
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>