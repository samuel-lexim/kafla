<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <?php sienna_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
        <div class="mkdf-date-format">
            <?php if(!sienna_mikado_post_has_title()) : ?>
            <a href="<?php esc_url(the_permalink()); ?>">
                <?php endif; ?>

                <span class="mkdf-day"><?php the_time('j') ?></span>
                <span class="mkdf-month"><?php the_time('M') ?></span>

                <?php if(!sienna_mikado_post_has_title()) : ?>
            </a>
        <?php endif; ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php sienna_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                <?php
                sienna_mikado_excerpt($excerpt_length);

                $args_pages = array(
                    'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
                    'after'       => '</div></div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '%'
                );

                wp_link_pages($args_pages);
                ?>
            </div>

            <div class="mkdf-author-desc clearfix">
                <div class="mkdf-post-info">
                    <?php sienna_mikado_post_info(array(
                        'category' => 'yes',
                        'comments' => 'yes',
                        'like'     => 'yes'
                    )) ?>
                </div>
                <div class="mkdf-share-icons">
                    <?php $post_info_array['share'] = sienna_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
                    <?php if($post_info_array['share'] == 'yes'): ?>
                        <span class="mkdf-share"><?php esc_html_e('Share', 'sienna'); ?></span>
                    <?php endif; ?>
                    <?php echo sienna_mikado_get_social_share_html(array(
                        'type' => 'list'
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</article>