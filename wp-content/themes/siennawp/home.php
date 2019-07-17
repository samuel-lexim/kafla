<?php 
/*
Template Name: Home
*/ 
?>
<?php
$sidebar = sienna_mikado_sidebar_layout(); ?>

<?php get_header(); ?>


<div class="mkdf-full-width">
<div class="mkdf-full-width-inner">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="mkdf-grid-row-medium-gutter">
			<div <?php echo sienna_mikado_get_content_sidebar_class(); ?>>
				<?php the_content(); ?>
				<?php do_action('sienna_mikado_page_after_content'); ?>
			</div>

			<?php if(!in_array($sidebar, array('default', ''))) : ?>
				<div <?php echo sienna_mikado_get_sidebar_holder_class(); ?>>
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endwhile; endif; ?>
</div>
</div>
<!-- # CUSTOM  -->
  

<?php get_footer(); ?>