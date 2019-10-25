<article class="mkdf-portfolio-item <?php echo esc_attr($article_masonry_size) ?> <?php echo esc_attr($categories) ?>">
    <div class="mkdf-portfolio-masonry-item mkdf-portfolio-item-holder">
        <a class="mkdf-portfolio-link" href="<?php echo esc_url($item_link); ?>"></a>

        <div class="mkdf-item-image-holder">
            <?php
            echo get_the_post_thumbnail(get_the_ID(), $thumb_size);
            ?>
        </div>
        <div class="mkdf-ptf-item-text-overlay">
            <div class="mkdf-ptf-item-text-overlay-inner">
                <div class="mkdf-ptf-item-text-holder">
                    <div class="mkdf-ptf-item-text-holder-inner">
                        <<?php echo esc_attr($title_tag) ?> class="mkdf-ptf-item-title">
                        <a href="<?php echo esc_url($item_link) ?>">
                            <?php echo esc_attr(get_the_title()); ?>
                        </a>
                    </<?php echo esc_attr($title_tag) ?>>

                    <div class="mkdf-ptf-item-lightbox">
                        <a href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-rel="prettyPhoto[portfolio-gallery]">
                            <?php echo sienna_mikado_icon_collections()->renderIcon('fa-plus', 'font_awesome'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mkdf-ptf-portfolio-overlay-bg"></div>
    </div>
</article>
