<div class="settings-container" >
    <!-- Content Position -->
    <div class="widgets-holder-wrap exclude locked content-options-textbox">
        <div class="sidebar-name">
            <h3>Content Position</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
            <tr valign="top">
                <td colspan="2">
                <div id="sslider-text-position-preview">
                    <div id="sslider-position-preview-outer">
                        <div id="sslider-position-preview-padding-left">&nbsp;</div>
                        <div id="sslider-position-preview-padding-top">&nbsp;</div>
                        <div id="sslider-position-preview-padding-right">&nbsp;</div>
                        <div id="sslider-position-preview-padding-bottom">&nbsp;</div>
                        <div id="sslider-position-preview-inner">
                            <div id="sslider-position-preview-obj">Content</div>
                        </div>
                    </div>
                </div>
                </td>
            </tr>
            <tr id="textbox_padding" >
                <th scope="row">Content Position</th>
                <td>
                    <?php 
                        $arr_data = array(
                            '0' => array(
                                'value' =>  'left',
                                'label' =>  'Left'
                            ),
                            '1' => array(
                                'value' =>  'top-left',
                                'label' =>  'Top Left'
                            ),
                            '2' => array(
                                'value' =>  'top',
                                'label' =>  'Top'
                            ),
                            '3' => array(
                                'value' =>  'top-right',
                                'label' =>  'Top Right'
                            ),
                            '4' => array(
                                'value' =>  'right',
                                'label' =>  'Right' 
                            ),
                            '5' => array(
                                'value' =>  'bottom-right',
                                'label' =>  'Bottom Right' 
                            ),
                            '6' => array(
                                'value' =>  'bottom',
                                'label' =>  'Bottom' 
                            ),
                            '7' => array(
                                'value' =>  'bottom-left',
                                'label' =>  'Bottom Left' 
                            ),
                            '8' => array(
                                'value' =>  'center',
                                'label' =>  'Center' 
                            ),
                            '9' => array(
                                'value' =>  'sticky-top',
                                'label' =>  'Sticky Top' 
                            ),
                            '10' => array(
                                'value' =>  'sticky-bottom',
                                'label' =>  'Sticky Bottom' 
                            )
                        );
                          
                        $form_lib->print_select($arr_data,"tab-content-position");
                    ?>
                </td>
            </tr>
            
            <tr id="textbox_padding" >
                <th scope="row">Content Width</th>
                <td>
                    <?php 
                        $arr_data = array(
                            '0' => array(
                                'value' =>  1,
                                'label' =>  '1 / 12'
                            ),
                            '1' => array(
                                'value' =>  2,
                                'label' =>  '2 / 12' 
                            ),
                            '2' => array(
                                'value' =>  3,
                                'label' =>  '3 / 12' 
                            ),
                            '3' => array(
                                'value' =>  4,
                                'label' =>  '4 / 12' 
                            ),
                            '4' => array(
                                'value' =>  5,
                                'label' =>  '5 / 12' 
                            ),
                            '5' => array(
                                'value' =>  6,
                                'label' =>  '6 / 12' 
                            ),
                            '6' => array(
                                'value' =>  7,
                                'label' =>  '7 / 12' 
                            ),
                            '7' => array(
                                'value' =>  8,
                                'label' =>  '8 / 12' 
                            ),
                            '8' => array(
                                'value' =>  9,
                                'label' =>  '9 / 12' 
                            ),
                            '9' => array(
                                'value' =>  10,
                                'label' =>  '10 / 12' 
                            ),
                            '10' => array(
                                'value' =>  11,
                                'label' =>  '11 / 12' 
                            ),
                            '11' => array(
                                'value' =>  12,
                                'label' =>  '12 / 12' 
                            )
                        );

                        $form_lib->print_select($arr_data,"tab-content-width");
                    ?>
                </td>
            </tr>

            <tr>
                <th scope="row">Content Padding</th>
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

                        $form_lib->print_select($arr_data,"tab-content-padding-type");
                    ?>
                    </div>

                    <div class="sslider-padding-custom">
                        <input class="regular-text" name="tab-content-padding" value="" />
                        <label class="description">[top]px [right]px [bottom]px [left]px</label>
                    </div>
                </td>
            </tr>

            </table>
        </div>
    </div>

    <!-- Content Background -->
    <div class="widgets-holder-wrap exclude locked content-options-textbox">
        <div class="sidebar-name">
            <h3>Content Background</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
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
                                
                                $form_lib->print_select($arr_data,'tab-content-bg-type');
                            ?>
                        </div>

                        <div class="sslider-color-transparent">
                            <?php $form_lib->print_select($transparent_images,'tab-content-bg-transparent');?>
                            <div class="transparent_bg_prev"></div>
                        </div>
                        <div class="sslider-color-color">
                            <input class="regular-text minicolors" type="text" name="tab-content-bg-color" value="" />
                            <label class="description" ></label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- HTML Background -->
    <div class="widgets-holder-wrap exclude locked content-options-html">
        <div class="sidebar-name">
            <h3>Content HTML</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">
                <tr>
                    <th scope="row">HTML Background</th>
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
                                
                                $form_lib->print_select($arr_data,'tab-html-bg-type');
                            ?>
                        </div>

                        <div class="sslider-color-transparent">
                            <?php $form_lib->print_select($transparent_images,'tab-html-bg-transparent');?>
                            <div class="transparent_bg_prev"></div>
                        </div>
                        <div class="sslider-color-color">
                            <input class="regular-text minicolors" type="text" name="tab-html-bg-color" value="" />
                            <label class="description" ></label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>