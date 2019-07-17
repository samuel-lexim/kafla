<div class="col-md-12 padding-article">		
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
    </div>
                <span class="title-article"><?php sienna_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?></span>
                <span class="title-sub">Description or Sub-title can go on here.</span>
</div>
<div class="col-md-8">
    
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content lampk">
        <?php sienna_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php
                the_content();

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
        </div>
        <?php if(has_tag()): ?>
            <div class="mkdf-tag-holder">
                <?php do_action('sienna_mikado_before_blog_article_closed_tag'); ?>
            </div>
        <?php endif; ?>
    </div>
</article>
</div>