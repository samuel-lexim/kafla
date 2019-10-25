<?php if(!empty($lightbox)) : ?>
<a title="<?php echo esc_attr($media['title']); ?>" data-rel="prettyPhoto[single_pretty_photo]" href="<?php echo esc_url($media['image_url']); ?>">
    <?php endif; ?>
    <?php if(sienna_mikado_options()->getOptionValue('portfolio_single_overlay') === 'yes') : ?>
        <div class="mkdf-image-hover">
        <?php if($gallery) { ?>
            <div class="mkdf-portfolio-gallery-text-holder mkdf-portfolio-circle-overlay">
                <div class="mkdf-portfolio-gallery-text-holder-inner">
                    <h4><?php echo esc_html($media['title']); ?></h4>
                </div>
                <span class="mkdf-ptf-portfolio-overlay-bg"></span>
            </div>
        <?php } ?>
        <img src="<?php echo esc_url($media['image_url']); ?>" alt="<?php echo esc_attr($media['description']); ?>"/>

        <?php if(!empty($lightbox)) : ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <?php if($gallery) { ?>
            <div class="mkdf-portfolio-gallery-text-holder">
                <div class="mkdf-portfolio-gallery-text-holder-inner">
                    <h4><?php echo esc_html($media['title']); ?></h4>
                </div>
                <span class="mkdf-ptf-portfolio-overlay-bg"></span>
            </div>
        <?php } ?>

        <img src="<?php echo esc_url($media['image_url']); ?>" alt="<?php echo esc_attr($media['description']); ?>"/>
        <?php if(!empty($lightbox)) : ?>

        <?php endif; ?>
    <?php endif; ?>
</a>