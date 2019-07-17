<div class="settings-container">
    <?php
        $animation_arr = array(
            '0' => array(
                'value' => 'desktop',
                'label' => 'Desktop Only'
            ),
            '1' => array(
                'value' => 'all',
                'label' => 'Mobile and Desktop'
            ),
            '2' => array(
                'value' => 'none',
                'label' => 'No Animation'
            )
        );

        $boolean_arr_data = array(
            '0' => array(
                'value' =>  'false',
                'label' =>  'Disable'
            ),
            '1' => array(
                'value' =>  'true',
                'label' =>  'Enable' 
            )
        );
    ?>

    <!-- Animation Settings -->
    <div class="widgets-holder-wrap exclude locked content-style-textbox">
        <div class="sidebar-name">
            <h3>Animation Settings</h3>
        </div>
        <div class="sidebar-content widgets-sortables clearfix">
            <table class="table-content">                
                <tr valign="top">
                    <th scope="row">Animation</th>
                    <td>
                        <?php $form_lib->print_select($animation_arr,'tab-content-anim-all'); ?>
                    </td>                    
                </tr>

                <tr valign="top" id='textbox_color'>
                    <th scope="row">Animation Type</th>
                    <td>
                        <?php 
                            $arr_data = array(
                                '0' => array(
                                    'value' =>  'transition.slideUpIn',
                                    'label' =>  'Slide Up'
                                ),
                                '1' => array(
                                    'value' =>  'transition.slideDownIn',
                                    'label' =>  'Slide Down' 
                                ),
                                '2' => array(
                                    'value' =>  'transition.slideLeftIn',
                                    'label' =>  'Slide Left' 
                                ),
                                '3' => array(
                                    'value' =>  'transition.slideRightIn',
                                    'label' =>  'Slide Right' 
                                ),
                                '4' => array(
                                    'value' =>  'transition.fadeIn',
                                    'label' =>  'Fade' 
                                )
                            );

                            
                            $form_lib->print_select($arr_data,'tab-content-anim-type');
                        ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Animation Duration</th>
                    <td>
                        <input class="regular-text" type="number" style="width:100px;" name="tab-content-anim-duration" value="" />
                        <label class="description" ></label>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Animation Stagger</th>
                    <td>
                        <input class="regular-text" type="number" style="width:100px;" name="tab-content-anim-stagger" value="" />
                        <label class="description" >Time between items to do the animation</label>
                    </td>
                </tr>
                <tr>
                    <th>
                        <a class="button do_anim_preview" href="javascript:;">Preview</a>
                    </th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>
                        <div class="container-layer-preview">
                            <div class="layer-box layer-red"></div>
                            <div class="layer-box layer-green"></div>
                            <div class="layer-box layer-blue"></div>
                        </div>
                    </th>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>

</div>