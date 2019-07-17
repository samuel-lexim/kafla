<div class="mkdf-big-image-holder">
    <?php
    $media = sienna_mikado_get_portfolio_single_media();

    if(is_array($media) && count($media)) : ?>
        <div class="mkdf-portfolio-media">
            <?php foreach($media as $single_media) : ?>
                <div class="mkdf-portfolio-single-media">
                    <?php sienna_mikado_portfolio_get_media_html($single_media); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="mkdf-two-columns-66-33 clearfix">
    <div class="mkdf-column1">
        <div class="mkdf-column-inner">
            <?php sienna_mikado_portfolio_get_info_part('content'); ?>
        </div>
    </div>
    <div class="mkdf-column2">
        <div class="mkdf-column-inner">
            <div class="mkdf-portfolio-info-holder">
                <?php
                //get portfolio custom fields section
                sienna_mikado_portfolio_get_info_part('custom-fields');

                //get portfolio date section
                sienna_mikado_portfolio_get_info_part('date');

                // get portfolio author section
                sienna_mikado_portfolio_get_info_part('author');

                //get portfolio tags section
                sienna_mikado_portfolio_get_info_part('tags');

                //get portfolio share section
                sienna_mikado_portfolio_get_info_part('social');
                ?>
            </div>
        </div>
    </div>
</div>