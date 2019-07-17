<?php
	/*
	Template Name: Blog: Masonry Full Width
	*/
?>
<?php get_header(); ?>

<?php sienna_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

	<div class="mkdf-full-width">
		<div class="mkdf-full-width-inner clearfix">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="mkdf-blog-template-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>

			<?php sienna_mikado_get_blog('masonry-full-width'); ?>
		</div>
	</div>
<?php get_footer(); ?>