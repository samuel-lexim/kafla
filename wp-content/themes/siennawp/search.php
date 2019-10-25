<?php
$sidebar              = sienna_mikado_sidebar_layout();
$excerpt_length_array = sienna_mikado_blog_lists_number_of_chars();

$excerpt_length = 0;
if(is_array($excerpt_length_array) && array_key_exists('standard', $excerpt_length_array)) {
    $excerpt_length = $excerpt_length_array['standard'];
}

?>

<?php get_header(); ?>
<?php

if(get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif(get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$blog_page_range = sienna_mikado_get_blog_page_range();
?>
<?php sienna_mikado_get_title(); ?>
    <div class="mkdf-container">
        <?php do_action('sienna_mikado_after_container_open'); ?>
        <div class="mkdf-container-inner clearfix">
            <div class="mkdf-grid-row-medium-gutter">
                <?php do_action('sienna_mikado_after_container_open'); ?>
                <div class="mkdf-page-content-holder mkdf-grid-col-9 mkdf-grid-col-push-3">
                    <div class="mkdf-blog-holder mkdf-blog-date-on-side">
                        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="mkdf-post-content">
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
                                            <h2 class="mkdf-post-title">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h2>
                                            <?php if(get_post_type() === 'post') : ?>
                                                <?php sienna_mikado_excerpt($excerpt_length); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mkdf-author-desc clearfix">
                                            <div class="mkdf-post-info">
                                                <?php sienna_mikado_post_info(array(
                                                    'comments' => 'yes',
                                                    'like'     => 'yes'
                                                )) ?>
                                                <?php if(has_post_thumbnail() == '') : ?>
                                                    <?php sienna_mikado_post_info(array('category' => 'yes')) ?>
                                                <?php endif; ?>
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
                        <?php endwhile; ?>
                            <?php
                            if(sienna_mikado_options()->getOptionValue('pagination') == 'yes') {
                                sienna_mikado_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
                            }
                            ?>
                        <?php else: ?>
                            <div class="entry">
                                <p><?php esc_html_e('No posts were found.', 'sienna'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php do_action('sienna_mikado_before_container_close'); ?>
                </div>
                
                <div class="mkdf-sidebar-holder mkdf-grid-col-3 mkdf-grid-col-pull-9">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>