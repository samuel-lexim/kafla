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


                        <div class="col-xs-12 col-md-6 ce-empowerment">
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Food Bank</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Medicare & Medi-Cal Assistance</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Senior & Affordable Housing Consultation</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Flu Shot Fair</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Community Emergency Response Team (CERT)
                                Trainings (with LA Fire Dept)
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> LAPD Olympic Station Translator Program</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Pro Bono Immigration & Labor Legal Clinic</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Community Education & Outreach</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Homeless Outreach</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11"> Cultural Preservation Programs</div>
                            <div class="clearfix"></div>
                            <div class="col-xs-1 col-md-1">
                                <div class="decor-point-e"></div>
                            </div>
                            <div class="col-xs-11 col-md-11">Korean National Holiday Events</div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div id="img-ce"></div>
                        </div>

                        <?php do_action('sienna_mikado_page_after_content'); ?>
                    </div>

                </div>
            <?php endwhile; endif; ?>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>