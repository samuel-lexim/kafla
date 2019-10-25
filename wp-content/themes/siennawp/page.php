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
						<?php the_content(); ?>
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