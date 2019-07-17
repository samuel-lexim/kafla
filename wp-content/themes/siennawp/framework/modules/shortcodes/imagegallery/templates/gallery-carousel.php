<div class="mkdf-image-gallery">
    <div class="mkdf-image-gallery-carousel <?php echo esc_attr($space); ?>" <?php echo sienna_mikado_get_inline_attrs($image_carousel_data); ?>>
        <?php foreach($images as $image) { ?>
            <div class="mkdf-gallery-image-carousel<?php echo esc_attr($hover_overlay); ?>">
                <div class="mkdf-image-gallery-holder">
                    <?php if($pretty_photo) { ?>
                    <a href="<?php echo esc_url($image['url']) ?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
                        <div class="mkdf-icon-holder"><?php echo sienna_mikado_icon_collections()->renderIcon('fa-plus', 'font_awesome'); ?></div>
                        <?php } ?>
                        <?php if(is_array($image_size) && count($image_size)) : ?>
                            <?php echo sienna_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
                        <?php endif; ?>
                        <span class="mkdf-image-gallery-hover"></span>
                        <?php if($pretty_photo) { ?>
                    </a>
                <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>