<?php 
/*
Template Name: Political Empowerment
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

						 <div class="col-xs-12 col-md-6  ce-empowerment">
						 	<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Citizenship Assistance & Voter Registration</div>
				 	 		<div class="clearfix"></div>
						    <div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Korean American Grassroots Conference</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Youth Political Boot Camp</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Collaborate with Neighborhood Councils</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	LA Mayor’s Korean American Advisory Committee</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Hoover & Wilshire Bridge Housing Advisory Committee</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	  Interethnic Community Coalition</div>
				 	 		<div class="clearfix"></div>
					 	 	<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">Engage with Elected Officials</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Candidates Community Forums</div>
				 	 		<div class="clearfix"></div>
				 	 		<div class="col-xs-1 col-md-1">
				 	 			<div class="decor-point-e"></div>
				 	 		</div>
				 	 		<div class="col-xs-11 col-md-11">	Political Action Committee (PAC)</div>
				 	 		<div class="clearfix"></div>
				 	 		
						</div>
						<div class="col-xs-12 col-md-6 ">
						  	   <div id="img-pe"></div>
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