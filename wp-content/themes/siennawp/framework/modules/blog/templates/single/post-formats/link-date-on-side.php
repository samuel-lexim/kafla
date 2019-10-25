<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
        <div class="mkdf-post-content clearfix">
            <div class="mkdf-post-text">
                <div class="mkdf-post-text-inner">
                    <div class="mkdf-post-mark">
                        <?php echo sienna_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                    </div>
                    <h4 class="mkdf-post-title">
                        <a href="<?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>
            </div>
        </div>
    </a>

    <div class="mkdf-link-content">
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