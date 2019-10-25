<?php
    /*
    Template Name: Blog: Standard Date On Side Whole Post
    */
?>
<?php get_header(); ?>
<?php sienna_mikado_get_title(); ?>

<?php get_template_part('slider'); ?>
	<ul class="permark-link-page">
    		<li>
      		<a href="http://52.41.15.109/lexim/">Home ></a>
    		</li>
    		<li>
		<a href="http://52.41.15.109/lexim/index.php/contact-us/">Contact Us</a>

      		
    		</li>
  	</ul>
    <div class="mkdf-container">
        <?php do_action('sienna_mikado_after_container_open'); ?>
        <div class="mkdf-container-inner">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <div class="mkdf-blog-template-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>

            <?php sienna_mikado_get_blog('standard-whole-post'); ?>
        </div>
        <?php do_action('sienna_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>