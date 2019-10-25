<?php 
/*
Template Name: Blog list
*/ 
?>
<?php
$sidebar = sienna_mikado_sidebar_layout(); ?>

<?php get_header(); ?>

<?php 
// echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="4" max_pages="4" button_label="Load Older Posts"]'); 
?>

<section class="section1-service">
    <div class="container">
        <div class="row">
            <ul class="permark-link-page">
    		<li>
      		<a href="<?php echo site_url(); ?>">Home ></a>
    		</li>
    		<li>
		<a href="<?php echo get_permalink(); ?>">Services</a>

      		
    		</li>
  	</ul>

                <p class="title-list">Blog list.</p>
            <div class="col-md-8">
		
                <div class="row"id="lamtrum">
                    <?php 
                    // echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="4" max_pages="4" button_label="Load Older Posts"]');
                     ?>
                    <?php
$lastposts = get_posts( array(    
) );
 
if ( $lastposts ) {
    foreach ( $lastposts as $post ) :
        setup_postdata( $post ); ?>


                  <!--   <div class="col-lg-12 col-md-12 col-sm-6 col-sx-12 backgroud-list dropdown">

                        <div class="col-lg-12 title-blog">
                            <p class="title-list-3"><?php the_title(); ?></p>
                              <a href="#" data-toggle="dropdown"class="icon-arrow1"><i class="icon-arrow"></i></a>
                            
                        </div>
                        <div class="dropdown-blog">                       
                            <div class="demo-3">
                                <p class="text-">Post at 08:34AM on july 4th, 2016 in PST</p>
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/images/blog/image-list.png')); ?>" style="width:100%">
                            </div>
                            <div class="demo-3">
                             <?php the_content(); ?>
                            </div>
                            <div class="demo-3">
                                <span class="title-socia"> SHARE THIS POST</span>
                                <ul>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/letter.png')); ?>" alt=""></li>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/face.png')); ?>" alt=""></li>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/socia.png')); ?>" alt=""></li>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/twitter.png')); ?>" alt=""></li>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/line.png')); ?>" alt=""></li>
                                    <li class="socia-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/talk.png')); ?>" alt=""></li>
                                </ul>
                            </div>
                         </div>
                    </div>
        -->
        
    <?php
    endforeach; 
    wp_reset_postdata();
}
?>
                   
                    <div class="col-lg-12 col-md-12 col-sm-6 col-sx-12 backgroud-list dropdown">
                        <div class="col-lg-12 title-blog">
                            <p class="title-list-3">Blog Title - The most recent.</p>
                              <a href="#" data-toggle="dropdown"class="icon-arrow1 dropdown-toggle the" id="lampk"><i class="icon-arrow close"></i></a>
                            
                        </div>
                        <div class="dropdown-blog hide">                       
                            <div class="demo-3">
                                <p class="text-">Post at 08:34AM on july 4th, 2016 in PST</p>
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/images/blog/image-list.png')); ?>" style="width:100%">
                            </div>
                            <div class="demo-3">
                              "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                            </div>
                            <div class="demo-3">
                                <span class="title-socia"> SHARE THIS POST</span>
                                <ul>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/letter.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/face.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/socia.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/twitter.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/line.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/talk.png')); ?>" alt=""></li>
                                </ul>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-6 col-sx-12 backgroud-list dropdown1">
                        <div class="col-lg-12 title-blog">
                            <p class="title-list-3">Blog Title - The most recent.</p>
                              <a href="#" data-toggle="dropdown"class="icon-arrow1 dropdown-toggle the" id="lampk"><i class="icon-arrow close"></i></a>
                            
                        </div>
                        <div class="dropdown-blog1 hide">                       
                            <div class="demo-3">
                                <p class="text-">Post at 08:34AM on july 4th, 2016 in PST</p>
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/images/blog/image-list.png')); ?>" style="width:100%">
                            </div>
                            <div class="demo-3">
                              "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                            </div>
                            <div class="demo-3">
                                <span class="title-socia"> SHARE THIS POST</span>
                                <ul>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/letter.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/face.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/socia.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/twitter.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/line.png')); ?>" alt=""></li>
                                    <li class="socia-icon1"><img src="<?php echo esc_url(home_url('/wp-content/uploads/images/icon-socia/talk.png')); ?>" alt=""></li>
                                </ul>
                            </div>
                         </div>
                    </div>
			<div class='pagination-custom-services'>
		    		<a href="#">View All Posts</a>
		    		<a href="#">Load Next 10 Posts</a>
			</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <div class="demo-3">
                                <p class="title-socia"> SHARE THIS POST</p>
                                <ul class="sidebar-post">
                            <li class="socia-icon"><a href='#'>Category #1</a>
                                <ul class="hidden">
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                </ul>
                            </li>
                            <li class="socia-icon"><a href='#'>Category #2</a>
                                <ul class="hidden">
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                </ul>
                            </li>
                            <li class="socia-icon"><a href='#'>Category #3</a>
                                <ul  class="hidden">
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                    <li><a href='#'>Blog Post #1-1</a></li>
                                </ul>
                            </li>
                        </ul>
                            </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
jQuery(document).ready(function(){
    
    jQuery('.dropdown').click(function(){
    	if(jQuery(".dropdown-blog").hasClass("show")) {
            jQuery('.icon-arrow').removeClass('open').addClass('close');
            jQuery('.dropdown-blog').removeClass('show').addClass('hide');
        } 
        else {
            jQuery('.icon-arrow').removeClass('close').addClass('open');
            jQuery('.dropdown-blog').removeClass('hide').addClass('show');
        }
    });
    jQuery('.dropdown1').click(function() {    
        if(jQuery(".dropdown-blog1").hasClass("show")) {
            jQuery('.icon-arrow').removeClass('open1').addClass('close1');
            jQuery('.dropdown-blog1').removeClass('show').addClass('hide');
        } 
        else {
            jQuery('.icon-arrow').removeClass('close1').addClass('open1');
            jQuery('.dropdown-blog1').removeClass('hide').addClass('show');
        }
    });

    jQuery('.socia-icon > a').click(function(){
        var ul = jQuery(this).parent().find('ul');
        if (ul.hasClass("hidden")) {
            ul.removeClass("hidden");
        } else {
            ul.addClass("hidden");
        }
    })
});
</script>

<!-- CUSTOM -->
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





