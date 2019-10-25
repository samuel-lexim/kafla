<?php 
/*
Template Name: Sponsors
*/ 
?>


<?php $sidebar = sienna_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php sienna_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkdf-container">
		<?php do_action('sienna_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner clearfix">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="mkdf-grid-row-medium-gutter">
					<div class="mkdf-page-content-holder mkdf-grid-col-9 mkdf-grid-col-push-3">

						<div class="content-sponsors">
							<div class="tittles-top-sponsors text-center">2018-2019 Heritage Night Sponsors</div>

							<div class="tittles-sponsors">TITTLE
								 <div class="decor-tittles-sponsors"></div> 
							</div>                       
	                        
	                        <div class="col-xs-6 col-md-6">
								<a href="https://joseon.kr/" style="cursor: pointer;" target="_blank"><div id="sp-a2"></div></a>
							</div> 
	                        <div class="col-xs-6 col-md-6"><div id="sp-a"></div></div> 
							
							<div class="clearfix margin-bottom-100"></div>

							<div class="tittles-sponsors">PLATINUM
								<div class="decor-tittles-sponsors"></div> 
							</div>
							
							<div class="col-xs-4 col-md-4"><div id="sp-b1"></div></div> 
							<div class="col-xs-4 col-md-4"><div id="sp-b2"></div></div> 
							<div class="col-xs-4 col-md-4"><div id="sp-b3"></div></div> 
							<div class="clearfix margin-bottom-100"></div>

							<div class="tittles-sponsors">GOLD
								<div class="decor-tittles-sponsors"></div> 
							</div>
							
							<div class="col-xs-6 col-md-6"><div id="sp-c1"></div></div> 
							<div class="col-xs-6 col-md-6"><div id="sp-c2"></div></div> 
							<div class="clearfix margin-bottom-100"></div>

							<div class="tittles-sponsors">SILVER
								<div class="decor-tittles-sponsors"></div>
							</div>
							 
							<div class="col-xs-3 col-md-3"><div id="sp-d1"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-d2"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-d3"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-d4"></div></div>
							<div class="clearfix margin-bottom-100"></div>

							<div class="tittles-sponsors">BRONZE
								<div class="decor-tittles-sponsors"></div> 
							</div>
							
							<div class="col-xs-3 col-md-3"><div id="sp-e1"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e2"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e3"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e4"></div></div>
							<div class="clearfix margin-bottom-40"></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e5"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e6"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e7"></div></div>
							<div class="col-xs-3 col-md-3"><div id="sp-e8"></div></div>
							<div class="clearfix margin-bottom-40"></div>
							<div class="col-xs-6 col-md-6"><div id="sp-e9"></div></div>
							<div class="col-xs-6 col-md-6"><div id="sp-e10"></div></div>
							<div class="clearfix margin-bottom-100"></div>

							<div class="tittles-sponsors">FEDERATION
								<div class="decor-tittles-sponsors"></div> 	
							</div>
							
							<div id="sp-f"></div>

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