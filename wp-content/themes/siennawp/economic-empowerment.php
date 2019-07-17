<?php
/*
Template Name: Economic Empowerment
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
                <div class="mkdf-grid-row-medium-gutter">
                    <div class="mkdf-page-content-holder mkdf-grid-col-9 mkdf-grid-col-push-3">


                        <div id="img-ee"></div>
                        <div class="ee-empowerment">
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Wilshire-Koreatown Community Plan</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11">Koreatown Visitor Center and Community Guide Website</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Employment Referral</div>
                            <div class="clearfix"></div>
                        </div>


                        <?php do_action('sienna_mikado_page_after_content'); ?>
                    </div>

                    <!-- <?php //if(!in_array($sidebar, array('default', ''))) : ?> -->
                    <div class="mkdf-sidebar-holder mkdf-grid-col-3 mkdf-grid-col-pull-9">
                        <?php get_sidebar(); ?>
                    </div>
                    <!-- <?php //endif; ?> -->
                </div>
            <?php endwhile; endif; ?>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>