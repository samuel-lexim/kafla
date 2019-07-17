<div <?php sienna_mikado_class_attribute($holder_classes); ?>>
    <div class="mkdf-info-card-front-side">

        <div class="mkdf-info-card-front-side-holder">
            <div class="mkdf-info-card-front-side-holder-inner">
                <?php if(!empty($number)) : ?>
                    <div class="mkdf-info-card-number">
                        <span><?php echo esc_html($number); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(!empty($front_side_image)) : ?>
                    <div class="mkdf-info-card-image-holder">
                        <?php echo wp_get_attachment_image($front_side_image, 'full'); ?>
                    </div>
                <?php endif; ?>

                <h3 class="mkdf-info-card-title"><?php echo esc_html($title); ?></h3>
                <div class="mkdf-info-card-front-side-content">
                    <p><?php echo esc_html($front_side_content); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="mkdf-info-card-back-side">

        <div class="mkdf-info-card-back-side-holder">
            <div class="mkdf-info-card-back-side-holder-inner">
                <?php if(!empty($number)) : ?>
                    <div class="mkdf-info-card-number">
                        <span><?php echo esc_html($number); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(!empty($back_side_image)) : ?>
                    <div class="mkdf-info-card-image-holder">
                        <?php echo wp_get_attachment_image($back_side_image, 'full'); ?>
                    </div>
                <?php endif; ?>

                <p><?php echo esc_html($back_side_content); ?></p>

                <?php if($show_btn) : ?>
                    <div class="mkdf-info-card-item-link">
                        <a href="<?php echo esc_url($button_params['link']) ?>" target="<?php echo esc_attr($button_params['target']); ?>">
                            <?php echo esc_html($button_params['text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>