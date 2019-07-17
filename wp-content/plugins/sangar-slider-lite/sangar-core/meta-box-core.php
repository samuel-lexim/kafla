<?php

/** 
 * Prints the core meta box
 */
function sslider_slide_core_meta_callback($post) 
{
    $sangar_icon = array(        
        'sangarico-aircraft',
        'sangarico-music',
        'sangarico-clock',
        'sangarico-eye',
        'sangarico-game',
        'sangarico-heart-o',
        'sangarico-heart',
        'sangarico-laptop',
        'sangarico-location',
        'sangarico-message',
        'sangarico-news',
        'sangarico-quote',
        'sangarico-share',
        'sangarico-chart',
        'sangarico-star-o',
        'sangarico-star',
        'sangarico-dislike',
        'sangarico-like',
        'sangarico-trophy',
        'sangarico-typing',
        'sangarico-video',
        'sangarico-facebook',
        'sangarico-google',
        'sangarico-instagram',
        'sangarico-linkedin',
        'sangarico-pinterest',
        'sangarico-tumblr',
        'sangarico-twitter',
        'sangarico-vimeo',
        'sangarico-youtube',
        'sangarico-chevron-right',
        'sangarico-chevron-circle-right'
    );

    ?>

    <div id="sslider-shortcode-on-single">
        <strong>Shortcode: &nbsp;</strong> 
        <div><code>[sangar-slider id=<?php echo $post->ID ?>]</code></div>
        <div class="sslider-clear-both"></div>
    </div>

    <div id="layer-modal-available-icons" style="display:none;">
        <table class="table-content" style="width:100%;">

            <?php foreach ($sangar_icon as $key => $value): ?>

            <tr>
                <td scope="row" class="sangarico-icon"><span class="<?php echo $value ?>"></span></td>
                <td><code>&lt;span class=&quot;<?php echo $value ?>&quot;&gt;&lt;/span&gt;</code></td>
            </tr>

            <?php endforeach ?>
            
        </table>
    </div>

    <?php 
}