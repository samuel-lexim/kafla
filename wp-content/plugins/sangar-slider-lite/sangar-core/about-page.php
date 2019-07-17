<?php
/**
 * ECAE about page
 *
 * @package ECAE
 */

$theme = wp_get_theme();
?>
<div class="wrap">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" id="opt-overview-tab" href="#opt-overview"><?php esc_html_e( 'Overview', 'sangar-slider' ); ?></a>
		<?php if ( SANGAR_SLIDER_ACTIVATED === 'Lite' ) : ?>
			<a class="nav-tab" id="opt-upgrade-tab" href="#opt-upgrade"><?php esc_html_e( 'Upgrade to PRO Version', 'sangar-slider' ); ?></a>
		<?php endif; ?>
		<a class="nav-tab" id="opt-other-tab" href="#opt-other"><?php esc_html_e( 'Other Cool Stuff for Your Website', 'sangar-slider' ); ?></a>
		<?php if ( SANGAR_SLIDER_ACTIVATED === 'Premium' ) : ?>
			<a class="nav-tab" id="opt-license-tab" href="#opt-license"><?php esc_html_e( 'Tonjoo License', 'sangar-slider' ); ?></a>
		<?php endif; ?>
	</h2>
	<div id="sslider-boarding">
		<div id="opt-overview" class="group">
			<div class="sslider-content">
				<div class="row">
					<div class="col-half">

						<div class="sslider-logo">
							<img class="logo-sslider" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/sslider_about.png" alt="">

							<div class="sslider-version">
								<?php if ( SANGAR_SLIDER_ACTIVATED === 'Lite' ) : ?>
									Lite Version<br>
								<?php endif; ?>
								v<?php echo esc_html( SANGAR_SLIDER_VERSION ); ?>
							</div>
						</div>

						<p><?php esc_html_e( 'Sangar Slider is already easy to customize even without toucing your code! With drag-and-drop and a staggering number of animation features, you can customize your slider with just a few clicks.', 'sangar-slider' ); ?></p>

						<div class="main-cta">
							<a href="<?php echo esc_url( admin_url( 'admin.php?page=sangar_slider_admin' ) ); ?>" class="btn btn-blue-welcome"><?php esc_html_e( 'Manage slider', 'sangar-slider' ); ?></a>
							<?php if ( SANGAR_SLIDER_ACTIVATED === 'Lite' ) : ?>
								<a href="https://tonjoostudio.com/product/sangar-slider-responsive-wordpress-slider-plugin/?utm_source=wp_dashboard&utm_medium=onboarding_overview&utm_campaign=upsell" class="btn btn-red-welcome"><?php esc_html_e( 'Upgrade to PRO version!', 'sangar-slider' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-half">
						<div class="frame"><iframe css="display:block;margin:0px auto;max-height:300px" width="100%" height="300px" src="https://www.youtube.com/embed/SKcVL9Zff-M" frameborder="0" allowfullscreen=""></iframe></div>
					</div>
				</div>
			</div>

			<?php if ( SANGAR_SLIDER_ACTIVATED === 'Lite' ) : ?>
				<div class="sslider-learn-more">
					<div class="banner-content">
						<div>
							<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/banner_logo.png" alt="">
							<p><?php esc_html_e( 'Upgrade to PRO Version and get full features of Sangar Slider', 'sangar-slider' ); ?></p>
						</div>
						<div class="main-cta">
							<a href="https://tonjoostudio.com/product/sangar-slider-responsive-wordpress-slider-plugin/?utm_source=wp_dashboard&utm_medium=onboarding_overview&utm_campaign=upsell" class="btn btn-orange-welcome">
								<i class="fa fa-rocket" aria-hidden="true"></i>
								<?php esc_html_e( 'Upgrade Now', 'sangar-slider' ); ?>
							</a>
							<a href="http://sangarslider.com/wordpress-pro/?utm_source=wp_dashboard&utm_medium=onboarding_overview&utm_campaign=upsell" class="btn btn-white-welcome">
								<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								<?php esc_html_e( 'Learn More', 'sangar-slider' ); ?>
							</a>
						</div>
					</div>
					<div class="banner-content sslider-features">
						<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/banner_feature_1.png" alt="">
						<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/banner_feature_2.png" alt="">
						<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/banner_feature_3.png" alt="">
						<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/banner_feature_4.png" alt="">
					</div>
				</div>
			<?php endif; ?>

			<div class="sslider-more" class="group">
				<div class="more-content">
					<div class="more-text">
						<h3><?php esc_html_e( 'Documentation', 'sangar-slider' ); ?></h3>
						<p><?php esc_html_e( "Our online documentation will give you  important information about the plugin. This is an exceptional resource to start discovering the plugin's true potential.", 'sangar-slider' ); ?></p>
					</div>
					<div class="more-btn">
						<a href="http://pustaka.tonjoostudio.com/plugins/sangar-slider-codex/?utm_source=wp_dashboard&utm_medium=onboarding_overview&utm_campaign=upsell" class="button-primary">
							<?php esc_html_e( 'Learn More', 'sangar-slider' ); ?>
							<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</a>
					</div>
				</div>

				<div class="more-content">
					<div class="more-text">
						<h3><?php esc_html_e( 'Support Forum', 'sangar-slider' ); ?></h3>
						<p><?php esc_html_e( 'We offer outstanding support through our forum. To get support first you need to register (create an account) and open a thread in our forum.', 'sangar-slider' ); ?></p>
					</div>
					<div class="more-btn">
						<a href="https://forum.tonjoostudio.com/?utm_source=wp_dashboard&utm_medium=onboarding_overview&utm_campaign=upsell" class="button-primary">
							<?php esc_html_e( 'Learn More', 'sangar-slider' ); ?>
							<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</a>
					</div>
				</div>

				<div class="more-content">
					<div class="more-text">
						<h3><?php esc_html_e( 'Rate Us', 'sangar-slider' ); ?></h3>
						<p><?php esc_html_e( 'If you have a moment, please help us spread the word by reviewing the plugin on WordPress.', 'sangar-slider' ); ?></p>
					</div>
					<div class="more-btn">
						<a href="https://wordpress.org/support/plugin/sangar-slider-lite/reviews/#new-post" class="button-primary">
							<?php esc_html_e( 'Review Our Plugin', 'sangar-slider' ); ?>
							<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<?php if ( SANGAR_SLIDER_ACTIVATED === 'Lite' ) : ?>
			<div id="opt-upgrade" class="group">
				<div class="sslider-upgrade">
					<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/upgrade_banner.jpg" alt="">

					<div class="whats-included">
						<div class="sslider-container">
							<h3><?php esc_html_e( "What's included in Pro Edition", 'sangar-slider' ); ?></h3>

							<p><?php esc_html_e( 'Completed with the layers and tools so you don’t have to think any technical details, just drag and drop. Also start creating sliders with preset system. You won’t believe how easy it is. Here are some of the features you will get:', 'sangar-slider' ); ?></p>

							<ul>
								<li><?php esc_html_e( 'Post Slider', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'Layer Editor', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'Preset System', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'Layered Video and Popup Video', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( '10 Templates, 20 Presets, 90 Themes', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'Complete and Advanced Options', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'Individual Slide Timer Duration', 'sangar-slider' ); ?></li>
								<li><?php esc_html_e( 'No ads', 'sangar-slider' ); ?></li>
							</ul>
						</div>
						<br>
						<div class="frame" style="max-width: 600px;margin: 40px auto 0;"><iframe css="display:block;margin:0px auto;max-height:400px" width="600px" height="400px" src="https://www.youtube.com/embed/myVdvRdfnj4" frameborder="0" allowfullscreen=""></iframe></div>
					</div>

					<div class="money-back">
						<div class="sslider-container no-risk">
							<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ); ?>assets/about/money_back.png" alt="">
							<div>
								<h3><?php esc_html_e( '100% No-Risk Money Back Guarantee!', 'sangar-slider' ); ?></h3>
								<p><?php esc_html_e( "You are fully protected by our 100% No-Risk Double-Guarantee. We offer 7 days moneyback guarantee, then we'll happily refund 100% of your money. Terms and Conditions Applied.", 'sangar-slider' ); ?></p>
							</div>
						</div>
					</div>

					<div class="learn-more">
						<div class="sslider-container">
							<p><?php esc_html_e( 'Create beautiful WordPress sliders in minutes. With Sangar Slider, you can build sliders with images, WordPress post, layered, YouTube or Vimeo video, and HTML.', 'sangar-slider' ); ?></p>
							<div class="main-cta">
								<a href="http://sangarslider.com/wordpress-pro/?utm_source=wp_dashboard&utm_medium=onboarding_upgrade&utm_campaign=upsell" class="btn btn-white-welcome">
									<?php esc_html_e( 'Learn More About PRO Version', 'sangar-slider' ); ?>
								</a>
								<a href="https://tonjoostudio.com/product/sangar-slider-responsive-wordpress-slider-plugin/?utm_source=wp_dashboard&utm_medium=onboarding_upgrade&utm_campaign=upsell" class="btn btn-orange-welcome">
									<?php esc_html_e( 'Get Sangar Slider PRO Now!', 'sangar-slider' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div id="opt-other" class="group">
			<?php
			require 'class-tonjoo-plugins-upsell.php';
			$upsell = new Tonjoo_Plugins_Upsell( 'ecae-premium' );
			$upsell->render();
			?>
		</div>

		<?php if ( SANGAR_SLIDER_ACTIVATED === 'Premium' ) : ?>
			<div id="opt-license" class="group">
				<?php include SANGAR_SLIDER_DIR_PATH . 'license-page.php'; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
