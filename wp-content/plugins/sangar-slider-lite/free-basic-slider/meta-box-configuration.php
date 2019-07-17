<?php

/**
 * Prints the box content
 */
function sslider_configuration_callback( $post ) {
	$form_lib = new tonjooFormLibrary();

	// Use nonce for verification
	wp_nonce_field( SANGAR_SLIDER, 'sslider_noncename' );

	$config = get_post_meta( $post->ID, 'sslider_config', true );
	$config = unserialize( base64_decode( $config ) );
	$config = ssliderDefault::config( $config );

	$boolean = array(
		'0' => array(
			'value' => 'true',
			'label' => 'Yes',
		),
		'1' => array(
			'value' => 'false',
			'label' => 'No',
		),
	);

	$mobileDimension = array(
		'0' => array(
			'value' => 'false',
			'label' => 'Same as default base dimension',
		),
		'1' => array(
			'value' => 'true',
			'label' => 'Use custom size',
		),
	);

?>

	<!-- Default Config -->
	<span id="sslider-default-config" style="display:none;">
		<?php
			$default = ssliderDefault::config();

			$templates = apply_filters( 'sangar_slider_templates', array() );

			$all_config['default']   = $default;
			$all_config['templates'] = $templates;

			echo json_encode( $all_config );
		?>
	</span>

	<!-- Is Preview -->
	<input style="display:none;" type="hidden" name="config[is_preview]" value="<?php echo $config['is_preview']; ?>" />
	<input style="display:none;" type="hidden" id="is_preview_saved" value="true" />

	<!-- Custom CSS -->
	<textarea id="temp_custom_css" style="display:none;"></textarea>
	<textarea name="config[custom_css]" style="display:none;"><?php echo stripslashes( $config['custom_css'] ); ?></textarea>
	<div id="sslider-custom-css" class="sslider-full-modal" title="Custom CSS" style="display:none;">
		<div class="modal-footer-label">
			<p>
				<code>[ss-id]</code> will replaced with <code>.sangar-slider-<?php echo $post->ID; ?>.sangar-slideshow-container</code>,
				<br/><code>[ss-dir]</code> will replaced with sangar slider plugin directory.
			</p>
		</div>
		<textarea id="sslider-custom-css-field"></textarea>
	</div>


	<!-- Template And Skin -->
	<div class="meta-box-sortables ui-sortable">
	<div class="settings-container" >
	<div class="widgets-holder-wrap accordion-config-one exclude locked"> <!-- can be: exclude locked -->
	<div class="sidebar-name">
		<div class="sidebar-name-arrow"></div>
		<h3>Templates</h3>
	</div>
	<div class="sidebar-content widgets-sortables no-padding clearfix">

		<div class="sslider_row">
			<div id="sslider-thumb-templates-container">
				<div id="sslider-thumb-templates">
					<?php
						$templates = apply_filters( 'sangar_slider_templates', array() );
						$arr_data  = array();

						$templates['horizontal-text-pagination']  = array(
							'pro' => true,
						);
						$templates['horizontal-image-pagination'] = array(
							'pro' => true,
						);
						$templates['vertical-no-pagination']      = array(
							'pro' => true,
						);
						$templates['vertical-bullet-pagination']  = array(
							'pro' => true,
						);
						$templates['vertical-text-pagination']    = array(
							'pro' => true,
						);
						$templates['carousel-bullet-pagination']  = array(
							'pro' => true,
						);
						$templates['carousel-text-pagination']    = array(
							'pro' => true,
						);
						$templates['carousel-image-pagination']   = array(
							'pro' => true,
						);
						$templates['carousel-fixed-width']        = array(
							'pro' => true,
						);

					foreach ( $templates as $key => $value ) {
						$thumbnail = str_replace( '-', '_', $key );
						$path      = SANGAR_SLIDER_DIR_PATH . "sangar-core/assets/images/template/$thumbnail.png";
						$selected  = $key == $config['template'] ? 'active' : '';

						if ( file_exists( $path ) ) {
							$thumbnail = SANGAR_SLIDER_DIR_URL . "sangar-core/assets/images/template/$thumbnail.png";
						} else {
							$thumbnail = SANGAR_SLIDER_DIR_URL . 'sangar-core/assets/images/template/no_thumb.png';
						}

						if ( ! empty( $value['pro'] ) ) {
							echo "<div class='sslider-template pro'>";
							echo "<img src='$thumbnail'>";
							echo '</div>';
						} else {
							echo "<div class='sslider-template $selected'>";
							echo "<a href='javascript:;' data-template='$key' title='{$value['name']}'><img src='$thumbnail'></a>";
							echo '</div>';
						}
					}
					?>
				</div>
				<div class="upgrade-to-unlock">
					<a href="https://tonjoostudio.com/product/sangar-slider-responsive-wordpress-slider-plugin/?utm_source=wp_dashboard&utm_medium=setting_template&utm_campaign=upsell"><span>Upgrade to unlock all templates</span></a>
				</div>
			</div>

			<?php
				$templates = apply_filters( 'sangar_slider_templates', array() );
				$arr_data  = array();

			foreach ( $templates as $key => $value ) {
				$template['value'] = $key;
				$template['label'] = $value['name'];

				// theme
				if ( ! empty( $value['themesAvailable'] ) && is_array( $value['themesAvailable'] ) ) {
					$theme = '';

					foreach ( $value['themesAvailable'] as $key_theme => $value_theme ) {
						$theme .= '"' . $value_theme . '"' . ',';
					}

					$theme            = rtrim( $theme, ',' );
					$template['attr'] = 'data-theme=[' . $theme . ']';
				}

				$arr_data[] = $template;
			}

				$form_lib->print_select( $arr_data, 'config[template]', $config['template'], "data-old='{$config['template']}' style='display:none;'" );
			?>
		</div>
	</div>
	</div>
	</div>
	</div>


	<!-- Dimension -->
	<div class="meta-box-sortables ui-sortable">
	<div class="settings-container" >
	<div class="widgets-holder-wrap accordion-config-one exclude locked">
	<div class="sidebar-name">
		<div class="sidebar-name-arrow"></div>
		<h3>Slideshow Options</h3>
	</div>
	<div class="sidebar-content widgets-sortables no-padding clearfix">

		<div class="sslider_row">
			<p class="label"><label>Slider Base Width</label></p>
			<input type="number" name="config[width]" value="<?php echo $config['width']; ?>">
		</div>

		<div class="sslider_row">
			<p class="label"><label>Slider Base Height</label></p>
			<input type="number" name="config[height]" value="<?php echo $config['height']; ?>">
		</div>

		<div class="sslider_row" style="display:none;">
			<p class="label"><label>Theme</label></p>

			<span style="display:none;" id="onloaded_slider_theme"><?php echo $config['themeClass']; ?></span>

			<?php
				$arr_data = array(
					'0' => array(
						'value' => 'default',
						'label' => 'Default',
					),
				);

				$form_lib->print_select( $arr_data, 'config[themeClass]', $config['themeClass'], "data-old='{$config['themeClass']}'" );
			?>
		</div>

		<div class="sslider_row">
			<p class="label"><label>Animation Speed</label></p>
			<input type="number" name="config[animationSpeed]" value="<?php echo $config['animationSpeed']; ?>">
		</div>

		<div class="sslider_row">
			<p class="label"><label>Time Between Transitions</label></p>
			<input type="number" name="config[advanceSpeed]" value="<?php echo $config['advanceSpeed']; ?>">
		</div>

		<div class="sslider_row" style="text-align:right;display:none;">
			<a href="javascript:;" sslider-advanced-config class="button">Advanced Options</a>
		</div>

		<div class="sslider_row">
			<p class="label"><label>Display Panel</label></p>
			<?php
				$arr_data = array(
					'0' => array(
						'value' => 'autohide',
						'label' => 'Autohide',
					),
					'1' => array(
						'value' => 'show',
						'label' => 'Show',
					),
					'2' => array(
						'value' => 'hide',
						'label' => 'Hide',
					),
				);

				$form_lib->print_select( $arr_data, 'config[panelDisplay]', $config['panelDisplay'], "data-old='{$config['panelDisplay']}'" );
			?>
		</div>

		<div class="sslider_row">
			<p class="label"><label>Auto Play</label></p>
			<?php $form_lib->print_select( $boolean, 'config[timer]', $config['timer'] ); ?>
			<label class="description">
				Activate this option will activate <b>pause on hover</b> behaviour and disable the panel's <b>pause button</b> behaviour.
			</label>
		</div>

	</div>
	</div>
	</div>
	</div>


	<!-- Advanced Settings Modal -->
	<div id='sslider-conf-settings-container'></div>

	<div id='sslider-conf-settings' title="" style="display:none;">

		<style type="text/css">
			#sslider-conf-settings {
				padding: 0;
			}
			#sslider-conf-settings .banner-bg{
				position: absolute;
				left: 0;
				top: 0;
			}
			#sslider-conf-settings .button-box{
				position: absolute;
				bottom: 0;
				right: 0;
				left: 0;
				text-align: center;
				z-index: 1;
				padding: 50px 0;
			}
			#sslider-conf-settings .button-box .button{
				border-radius: 9999px;
				-webkit-border-radius: 9999px;
				-moz-border-radius: 9999px;
				line-height: 45px;
				padding: 0 20px;
				font-weight: bold;
				margin: 0 10px;
				width: 185px;
				text-align: center;
				height: 45px;
				border: none;
				color: #fff;
				outline: none;
				font-size: 16px;
			}
			#sslider-conf-settings .button-box .button img{
				display: inline-block;
				vertical-align: middle;
				position: relative;
				top: -2px;
				margin-right: 4px;
			}
			#sslider-conf-settings .button-box .button-blue{
				background: #2979FF;
				box-shadow: inset 0 0 1px #3F87FF;
			}
			#sslider-conf-settings .button-box .button-blue:hover{
				background-color: #0664FF;
			}
			#sslider-conf-settings .button-box .button-orange{
				background: #F57F17;
				box-shadow: inset 0 0 1px #F68C2F;
			}
			#sslider-conf-settings .button-box .button-orange:hover{
				background-color: #DC6D0A;
			}
			#sslider-conf-settings-container .ui-button.ui-dialog-titlebar-close{
				z-index: 2;
				color: #fff;
				opacity: 0.5;
			}
			#sslider-conf-settings-container .ui-button.ui-dialog-titlebar-close:hover{
				opacity: 1;
				color: #fff;
			}
		</style>
		<div class="button-box">
			<a href="http://coba.tonjoostudio.com/wp-admin/" target="_blank" class="button button-blue"><img src="<?php echo SANGAR_SLIDER_DIR_URL; ?>/images/icon_btn_demo.png">Live Demo</a>
			<a href="http://sangarslider.com/wordpress-pro/?utm_source=wp_dashboard&utm_medium=link_update&utm_campaign=ss" target="_blank" class="button button-orange"><img src="<?php echo SANGAR_SLIDER_DIR_URL; ?>/images/icon_btn_upgrade.png">Upgrade Now!</a>
		</div>
		<img class="banner-bg" src="<?php echo SANGAR_SLIDER_DIR_URL; ?>/images/banner_premium_bg.png">

	</div>

<?php

}
