<div class="mkdf-portfolio-item-social">
    <?php if(sienna_mikado_options()->getOptionValue('enable_social_share') == 'yes'
             && sienna_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes'
    ) : ?>
        <div class="mkdf-portfolio-single-share-holder">
            <?php echo sienna_mikado_get_social_share_html(array(
                'type'      => 'list',
                'icon_type' => 'circle'
            )); ?>
        </div>
    <?php endif; ?>
    <div class="mkdf-portfolio-single-likes">
        <?php echo sienna_mikado_like_portfolio_list(get_the_ID()); ?>
    </div>
</div>
