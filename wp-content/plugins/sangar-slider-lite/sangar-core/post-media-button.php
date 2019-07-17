<?php
/**
 * Adds a media button (for inserting a slideshow) to the Post Editor
 */
add_action( 'media_buttons', 'sangar_slider_post_media_button', 11 );
function sangar_slider_post_media_button( $editor_id ) 
{
    global $wp_version;

    $is_updated_admin = false;
    $is_updated_admin = ( version_compare( $wp_version, '3.8', '>=' ) ) ? true : false;

    /** Show appropriate button and styling */
    if ( $is_updated_admin ) 
    {
        /** WordPress v3.8+ button */
        ?>
        <style type="text/css">
            .insert-slideshow.button .insert-slideshow-icon:before {
                content: "\f128";
                font: 400 18px/1 dashicons;
                speak: none;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        </style>
        <a href="#TB_inline?&inlineId=choose-sangar-slider" class="thickbox button insert-slideshow" data-editor="<?php echo esc_attr( $editor_id ); ?>" title="Add sangar slider to your post"><?php echo '<span class="wp-media-buttons-icon insert-slideshow-icon"></span> Sangar Slider' ?></a>
        <?php
    }
    else 
    {
        /** Backwards compatibility button */
        ?>
        <style type="text/css">
            .insert-slideshow.button .insert-slideshow-icon {
                /* none */
            }
        </style>
        <a href="#TB_inline?&inlineId=choose-sangar-slider" class="thickbox button insert-slideshow" data-editor="<?php echo esc_attr( $editor_id ); ?>" title="Add sangar slider to your post"><?php echo '<span class="insert-slideshow-icon"></span> Sangar Slider' ?></a>
        <?php
    }
}

/**
 * Append the thickbox content to the bottom of selected admin pages
 */
add_action('admin_footer', 'sangar_slider_post_media_button_modal');

function sangar_slider_post_media_button_modal() 
{
    global $pagenow;

    // Only run in post/page creation and edit screens
    if (in_array($pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php'))) {           
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.insert-sslider-to-post').on('click', function() {
                    var id = $(this).parent('.choose-sslider-container')
                                    .children('select[name="select-sslider"]').val();

                    window.send_to_editor('[sangar-slider id="' + id + '"]');
                    tb_remove();
                });
            });
        </script>
        <div id="choose-sangar-slider" style="display: none;">
            <div class="wrap">

            <?php
                $sslider_addons = apply_filters('sangar_slider_addons',array());
                $create_post_type = array();
                
                foreach($sslider_addons as $key => $value)
                {
                    $args = array(
                        'post_type' => $key,
                        'posts_per_page' => -1, // -1 mean show all data
                        'post_status' => 'publish'
                    );

                    $the_query = new WP_Query($args);
                    $total_number = $the_query->found_posts;

                    echo "<div class='choose-sslider-container'>";

                    if($total_number > 0)
                    {
                        $arr_data = array();
                        $posts = $the_query->posts;

                        foreach ($posts as $post)
                        {
                            $arr_data[] = array(
                                'value' => $post->ID,
                                'label' => $post->post_title == '' ? '(no title)' : $post->post_title
                            );
                        }

                        wp_reset_query();

                        echo "<h3 style='margin: 20px 0 10px;'>Sangar {$value['name']}</h3>";
                        
                        $form_lib = new tonjooFormLibrary();
                        $form_lib->print_select($arr_data,"select-sslider");

                        echo "&nbsp;";
                        echo "<button class='button primary insert-sslider-to-post'>Insert Slideshow</button>";    
                    }
                    else echo "<h3 style='margin-bottom: 20px;'>No sangar slider found.</h3>";

                    echo '</div>';
                }
            ?>

            </div>
        </div>

        <?php
    }
}