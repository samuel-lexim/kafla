<?php do_action('sienna_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
	<?php if($show_fixed_wrapper) : ?>
	<div class="mkdf-fixed-wrapper">
		<?php endif; ?>
		<!-- Custom for top of the page -->
		<div class='container-fluid multi-languages'>
			<div class="mkdf-grid">
				<div class='col-md-12 home-header-kafla mkdf-grid'>					
					<!-- <?php //if ( is_user_logged_in() ) : ?>
						<a href='http://52.41.15.109/lexim/index.php/my-account/'>My Account</a>
						|
						<a href="http://52.41.15.109/lexim/wp-login.php?action=logout&redirect_to=http%3A%2F%2F52.41.15.109%2Flexim%2Findex.php">Log Out</a>
					<?php //else : ?>
						<a href='http://52.41.15.109/lexim/index.php/login/'>Log In</a>
						|
						<a href='http://52.41.15.109/lexim/index.php/register/'>Sign Up</a>
					<?php //endif; ?> -->
					
					<div class="top-multi-languages col-md-2">
		              	<?php the_widget('qTranslateXWidget', array('type' => 'custom', 'format' => '%c') );?>
		          	</div>

		          	<div class="tl-search-bar col-md-5"><?php get_search_form(); ?></div>

		          	<div class="kafla-top-bar-donate col-md-5">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		                    <div align="right">
		                      <input type="hidden" name="cmd" value="_s-xclick">
		                      <input type="hidden" name="hosted_button_id" value="625DYMQKHTEW4">
		                     <input type="image" src="/wp-content/uploads/2017/12/kafla-donate-line.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="width: 290px;">
		                      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"> 
		                    </div>
	                  	</form>
	                </div>
				</div>
			</div>
		</div>
		<!-- End Custom for to of the page -->

		<div class="mkdf-menu-area">
			<?php if($menu_area_in_grid) : ?>
			<div class="mkdf-grid">
				<?php endif; ?>
				<?php do_action('sienna_mikado_after_header_menu_area_html_open') ?>
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-left">
						<div class="mkdf-position-left-inner">
							<?php if(!$hide_logo) {
								sienna_mikado_get_logo();
							} ?>
						</div>
					</div>
					<div class="mkdf-position-right">
						<div class="mkdf-position-right-inner">
							<?php sienna_mikado_get_main_menu(); ?>
							<?php if(is_active_sidebar('mkdf-right-from-main-menu')) : ?>
								<div class="mkdf-main-menu-widget-area">
									<div class="mkdf-main-menu-widget-area-inner">
										<?php dynamic_sidebar('mkdf-right-from-main-menu'); ?>
									</div>

								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if($show_fixed_wrapper) : ?>
	</div>
<?php endif; ?>
	<?php if($show_sticky) {
		sienna_mikado_get_sticky_header();
	} ?>
</header>

<?php do_action('sienna_mikado_after_page_header'); ?>

 <?php 
   if( (get_the_title() == "HOME") || (get_the_title() == "Home KAFLA") ) { 
    ?>
<!-- <?php //echo do_shortcode('[sangar-slider id=515]'); ?> -->
<?php echo do_shortcode('[pjc_slideshow slide_type="home-page"]'); ?>
<?php } ?>