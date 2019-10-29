<?php
/*
Template Name: Sponsors
*/
?>

<?php $sidebar = sienna_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php sienna_mikado_get_title(); ?>


    <div class="mkdf-container">
        <?php do_action('sienna_mikado_after_container_open'); ?>
        <div class="mkdf-container-inner clearfix">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="mkdf-grid-row-medium-gutter">
                    <div class="mkdf-page-content-holder mkdf-grid-col-9 mkdf-grid-col-push-3">

                        <?php
                        $theTitle = get_field('sp_title');
                        $sponsor_group = get_field('sponsor_group');
                        ?>

                        <div class="content-sponsors">
                            <div class="tittles-top-sponsors"><?= $theTitle ?></div>

                            <?php if (isset($sponsor_group) && is_array($sponsor_group)) { ?>

                                <?php $i = 1;
                                foreach ($sponsor_group as $group) {
                                    $heading = $group['sponsor_heading'];
                                    $sponsor_list = $group['sponsor_list'];
                                    ?>

                                    <div class="sponsor-heading">
                                        <img alt="" src="<?= $heading ?>"/>
                                    </div>

                                    <?php if (is_array($sponsor_list) && count($sponsor_list) > 0) { ?>

                                        <div class="sponsor-list-inner sponsor-list-<?= $i ?>">
                                            <?php foreach ($sponsor_list as $item) { ?>
                                                <!--<div class="sponsor-item-box">-->
                                                <img alt="" src="<?= $item['url'] ?>"/>
                                                <!--</div>-->
                                            <?php } ?>
                                        </div>

                                    <?php } ?>
                                    <?php $i++; ?>
                                <?php } ?>

                            <?php } ?>
                        </div>

                        <?php do_action('sienna_mikado_page_after_content'); ?>
                    </div>


                    <div class="mkdf-sidebar-holder mkdf-grid-col-3 mkdf-grid-col-pull-9">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>