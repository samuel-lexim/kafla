<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-image">
            <?php sienna_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner clearfix">
                <?php sienna_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                <?php the_content(); ?>
            </div>
            <div class="mkdf-category-share-holder clearfix">
                <div class="mkdf-category-holder">
                    <div class="mkdf-post-info">
                        <?php sienna_mikado_post_info(array(
                            'date'     => 'yes',
                            'like'     => 'yes',
                            'comments' => 'yes',
                            'category' => 'yes'
                        )) ?>
                    </div>
                </div>
                <div class="mkdf-share-icons-single">
                    <?php $post_info_array['share'] = sienna_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
                    <?php if($post_info_array['share'] == 'yes'): ?>
                        <span class="mkdf-share-label"><?php esc_html_e('Share', 'sienna'); ?></span>
                    <?php endif; ?>
                    <?php echo sienna_mikado_get_social_share_html(array(
                        'type'      => 'list',
                        'icon_type' => 'normal'
                    )); ?>
                </div>
            </div>
        </div>
    </div>
    <?php do_action('sienna_mikado_before_blog_article_closed_tag'); ?>
</article>