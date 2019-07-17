<?php
/*
Template Name: Slider Page Template
*/
?>


<?php $sidebar = sienna_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php sienna_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="mkdf-container">
        <?php do_action('sienna_mikado_after_container_open'); ?>
        <div class="mkdf-container-inner clearfix">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                $slider = get_field("slider_repeater");
                $items = get_field("items");
                $layout = get_field("layout_of_items");
                ?>

                <div class="mkdf-grid-row-medium-gutter">
                    <div class="mkdf-sidebar-holder mkdf-grid-col-3">
                        <?php get_sidebar(); ?>
                    </div>

                    <div class="mkdf-page-content-holder mkdf-grid-col-9">
                        <?php if (isset($slider) && is_array($slider) && count($slider) > 0) { ?>
                            <div class="single-image-slick">
                                <?php foreach ($slider as $image) {
                                    if (isset($image['image'])) { ?>
                                        <div><img src="<?= $image['image'] ?>" alt=""/></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="item-title-wrap <?= $layout ?>">
                            <?php if (isset($items) && is_array($items) && count($items) > 0) { ?>
                                <?php foreach ($items as $title) {
                                    if (isset($title['item_title'])) { ?>
                                        <div class="item-title-inner"><?= $title['item_title'] ?></div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>

                        <?php do_action('sienna_mikado_page_after_content'); ?>
                    </div>

                </div>
            <?php endwhile; endif; ?>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>