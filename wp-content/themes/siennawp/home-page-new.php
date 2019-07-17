<?php 
/*
Template Name: Home Page New
*/ 
?>
<?php
$sidebar = sienna_mikado_sidebar_layout(); ?>

<?php get_header(); ?>


<div class="mkdf-full-width">
	<div class="mkdf-full-width-inner">
	    <div class="content-top-home parent-position ">
			<div class="content-top-child-home child-position">	
				<div id="header-top-home">
					<div id="donate-top-right">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							 <input type="hidden" name="cmd" value="_s-xclick">
		                     <input type="hidden" name="hosted_button_id" value="625DYMQKHTEW4">
		                     <input type="image" src="/wp-content/themes/siennawp/assets/css/images/btn-donate-home-top.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="width: 223px;height: 30px">
	                    </form>     	
					</div>	
				 	<div class="col-md-3"> 
				 		<a href="/"><div id="icon-home"></div></a>	                    
				 	</div>
				 	<div class="col-md-7 "> 				 	
				   <?php //do_action('sienna_mikado_before_top_navigation'); ?>
				

						<nav id="menu-main-home-top" class="mkdf-main-menu mkdf-drop-down mkdf-default-nav ">
							<?php
							wp_nav_menu(array(
								'theme_location'  => 'main-navigation',
								'container'       => '',
								'container_class' => '',
								'menu_class'      => 'clearfix',
								'menu_id'         => '',
								'fallback_cb'     => 'top_navigation_fallback',
								'link_before'     => '<span>',
								'link_after'      => '</span>',
								'walker'          => new SiennaMikadoTopNavigationWalker()
							));
							?>
						</nav>

					
					<?php // do_action('sienna_mikado_after_top_navigation'); ?>
				 	</div>
				 	<div class="col-md-2 nopadding"> 
				 		<div id="multi-languages-home-top" class="top-multi-languages">
				 			<?php the_widget('qTranslateXWidget', array('type' => 'custom', 'format' => '%c') );?>

				 			<div class="decor-find-home"></div>
				 			<div id="ic-find"></div>
				 		</div>
				 		<div class="form-search-home-top " style="display: none;" >
				 			<?php get_search_form(); ?>
				 		</div>				 		
				 	</div>	
				 	<div class="clearfix"></div>
			 	</div>
			 	<div class="child-position content-home-center">

			 		<a href="https://twitter.com/kafla1962" target="_blank"><div id="ic-tw"></div></a>	
                    <a href="https://www.facebook.com/kafla0700" target="_blank"><div id="ic-fb"></div></a>
                    <div id="follow-us-text"></div>	
                    <div id="decor-top-left"></div>

			 		<div class="titles-top-home">25 years after racial tensions erupted, black and Korean communities reflect on L.A.</div>	
			 		<div class="text-center"><a href="/videos/" id="btn-watchvideo" class="btn btn-link" role="button">Watch video</a></div>		 	 		
			 	</div>	
		 	</div>
		</div>	

   		

		<div class="about-kafla-content parent-position" >
			<div class="about-kafla-content-child child-position">				                              
                <div class="empowerment-anchor-box">
                	<div class="col-md-4">
		                <div class="empowerment-box parent-position">
		                	<div class="empowerment-box-child child-position">
			                	<div id="ic-community"></div>	
								<div class="empowerment-titles">Community Empowerment </div>
							</div>
		                </div>
	                </div>
	                <div class="col-md-4">
		                <div class="empowerment-box parent-position">
		                	<div class="empowerment-box-child child-position">
			                	<div id="ic-political"></div>	
		                		<div class="empowerment-titles"> Political  Empowerment</div>
	                		</div>
		                </div>
	                </div>
	                <div class="col-md-4">
		                <div class="empowerment-box parent-position">
		                	<div class="empowerment-box-child child-position">
			                	<div id="ic-economic"></div>
		                		<div class="empowerment-titles">Economic  Empowerment </div>
	                		</div>
		                </div>
	                </div>
	                <div class="clearfix"></div>
                </div>
                <div class="news-box">
                	<div class="row">
                		<a href="/ournews/">
	                		<div id="news-korean" class="check-active-overlay">
	                			<div class="korean-news-titles">KOREAN NEWS</div>
	                			<div class="korean-news-descript">[Korea Times] KAFLA Hosts 72nd <br> Korean Independence Day Ceremony</div>
	                			<div class="hover-overlay-effect "></div>
	                		</div>
                		</a>
                	</div>
                	<div class="col-md-6">
                		<a href="/photos/">
		                	<div id="news-gallery" class="check-active-overlay">
		                		<div class="news-titles">PHOTO GALLERY</div>
	                			<div class="news-descript">Sebastian Ridley-Thomas visited KAFLA</div>
	                			<div class="hover-overlay-effect "></div>
		                	</div>
	                	</a>
	                	<a href="/videos/">
		                	<div id="news-video" class="check-active-overlay">
		                		<div class="news-titles">VIDEO STORY</div>
	                			<div class="news-descript">LA Korean American Association Introduction</div>
	                			<div class="hover-overlay-effect "></div>
		                	</div>
	                	</a>
                	</div>
                	<div class="col-md-6">
                		<a href="/events/">
	                		<div id="news-event" class="check-active-overlay">
	                			<div class="news-titles">UP COMING EVENT</div>
	                			<div class="news-descript">2017 Heritage Night</div>
	                			<div class="hover-overlay-effect "></div>
	                		</div>
                		</a>
                	</div>
                	<div class="clearfix"></div>
                </div>

			</div>
		</div>	

		<div class="detailing-content parent-position" >
			<div class="detailing-content-child child-position">
				<div class="col-md-6 nopadding">
					<div class="detailing-content-left parent-position">
						<div class="detailing-content-left-child child-position">
							<div class="detailing-content-titles">
								The Korean American Federation of Los Angeles (KAFLA)
							</div>
							<div class="detailing-descript">
								The Korean American Federation of Los Angeles (KAFLA) is a registered 501(c)(3) non-profit organization that serves the Korean American community in Greater Los Angeles.
							</div>
							<div ><a href="/about-us/" id="btn-read-more" class="btn btn-link" role="button">Read more</a></div>
						</div>
					</div>	
				</div>
				<div class="col-md-6 nopadding">
					<div id="img-hand"></div>
				</div>
				<div class="clearfix"></div>

			</div>
		</div>	

		<div class="brand-content parent-position" >
			<div class="brand-content-child child-position">
				<div class="brand-titles">Heritage Night 2016-2017 Sponsors</div>
				<div id="ic-bank-of-hope"></div>
				
				<div class="col-md-4">
					<div id="ic-korean-war"></div>
				</div>	
				<div class="col-md-4">
					<div id="ic-hanmi-bank"></div>
				</div>	
				<div class="col-md-4">	
					<div id="ic-korean-text"></div>
				</div>	
				<div class="clearfix"></div>
				<div class="btn-show-more" ><a href="#show-more" id="btn-show-more"  class="btn btn-link" role="button">Show more</a></div>
			</div>
		</div>		

		<div class="footer-content parent-position" >
			<div class="footer-content-child child-position">
				<div class="info-footer">
					981 S. Western Ave., Suite 100, Los Angeles, CA 90006 | Tel: 323-732-0700 | Fax: 323-732-7009 | E-mail: info@kafla.org
				</div>
				<div class="donate-footer">

					<div class="col-md-5">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							 <input type="hidden" name="cmd" value="_s-xclick">
		                     <input type="hidden" name="hosted_button_id" value="625DYMQKHTEW4">
		                     <input class="btn-donate-home-footer" type="image" src="/wp-content/themes/siennawp/assets/css/images/btn-donate-home-top-2.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" >
	                    </form>  					
					</div>							
					<div class="col-md-1">
						<div id="decor-footer"></div>
					</div>
					<div class="col-md-1">
						<div id="follow-us-text-footer">FOLLOW US</div>
					</div>
					<div class="col-md-1">
						<a href="https://www.facebook.com/kafla0700" target="_blank"><div id="ic-fb-2"></div></a>
					</div>
					<div class="col-md-1">
						<a href="https://twitter.com/kafla1962" target="_blank"><div id="ic-tw-2"></div></a>
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
			<div id="copyright-home"><div>2018 Korean American Federation of Los Angeles. All right reserved.</div></div>
		</div>	
	</div>
</div>
<!-- # CUSTOM  -->
  

<?php get_footer(); ?>