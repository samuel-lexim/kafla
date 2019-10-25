<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="mkdf-post-content clearfix">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <?php echo sienna_mikado_icon_collections()->renderIcon('icon_quotations', 'font_elegant'); ?>
                </div>
                <div class="mkdf-post-title-holder">
                    <a href="<?php the_permalink() ?>">
                        <h4 class="mkdf-post-title"><?php echo esc_html(get_post_meta(get_the_ID(), 'mkdf_post_quote_text_meta', true)); ?></h4>

                        <p class="mkdf-quote-author"><?php the_title(); ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mkdf-quote-content">
        <?php the_content(); ?>
    </div>
    <div class="mkdf-info-share clearfix">
        <div class="mkdf-post-info">
            <?php sienna_mikado_post_info(array(
                'date'     => 'yes',
                'like'     => 'yes',
                'comments' => 'yes',
                'category' => 'yes',
            )) ?>
        </div>
        <div class="mkdf-share-icons-single">
            <?php $post_info_array['share'] = sienna_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
            <?php if($post_info_array['share'] == 'yes'): ?>
                <span class="mkdf-share-label"><?php esc_html_e('Share', 'sienna'); ?></span>
            <?php endif; ?>
            <?php echo sienna_mikado_get_social_share_html(array(
                'type' => 'list'
            )); ?>
        </div>
    </div>
    <?php if(has_tag()): ?>
        <div class="mkdf-tag-holder">
            <?php do_action('sienna_mikado_before_blog_article_closed_tag'); ?>
        </div>
    <?php endif; ?>
</article>