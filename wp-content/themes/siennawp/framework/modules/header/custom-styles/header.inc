<?php

if(!function_exists('sienna_mikado_header_top_bar_styles')) {
	/**
	 * Generates styles for header top bar
	 */
	function sienna_mikado_header_top_bar_styles() {
		global $sienna_mikado_options;

		if($sienna_mikado_options['top_bar_height'] !== '') {
			echo sienna_mikado_dynamic_css('.mkdf-top-bar', array('height' => $sienna_mikado_options['top_bar_height'].'px'));
			echo sienna_mikado_dynamic_css('.mkdf-top-bar .mkdf-logo-wrapper a', array('max-height' => $sienna_mikado_options['top_bar_height'].'px'));
		}

		if($sienna_mikado_options['top_bar_in_grid'] == 'yes') {
			$top_bar_grid_selector = '.mkdf-top-bar .mkdf-grid .mkdf-vertical-align-containers';
			$top_bar_grid_styles   = array();
			if($sienna_mikado_options['top_bar_grid_background_color'] !== '') {
				$grid_background_color        = $sienna_mikado_options['top_bar_grid_background_color'];
				$grid_background_transparency = 1;

				if(sienna_mikado_options()->getOptionValue('top_bar_grid_background_transparency')) {
					$grid_background_transparency = sienna_mikado_options()->getOptionValue('top_bar_grid_background_transparency');
				}

				$grid_background_color                   = sienna_mikado_rgba_color($grid_background_color, $grid_background_transparency);
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}

			echo sienna_mikado_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
		}

		$background_color = sienna_mikado_options()->getOptionValue('top_bar_background_color');
		$top_bar_styles   = array();
		if($background_color !== '') {
			$background_transparency = 1;
			if(sienna_mikado_options()->getOptionValue('top_bar_background_transparency') !== '') {
				$background_transparency = sienna_mikado_options()->getOptionValue('top_bar_background_transparency');
			}

			$background_color                   = sienna_mikado_rgba_color($background_color, $background_transparency);
			$top_bar_styles['background-color'] = $background_color;
		}

		echo sienna_mikado_dynamic_css('.mkdf-top-bar', $top_bar_styles);
	}

	//add_action('sienna_mikado_style_dynamic', 'sienna_mikado_header_top_bar_styles');
}

if(!function_exists('sienna_mikado_header_standard_menu_area_styles')) {
	/**
	 * Generates styles for header standard menu
	 */
	function sienna_mikado_header_standard_menu_area_styles() {
		global $sienna_mikado_options;

		$menu_area_header_standard_styles = array();

		if($sienna_mikado_options['menu_area_background_color_header_standard'] !== '') {
			$menu_area_background_color        = $sienna_mikado_options['menu_area_background_color_header_standard'];
			$menu_area_background_transparency = 1;

			if($sienna_mikado_options['menu_area_background_transparency_header_standard'] !== '') {
				$menu_area_background_transparency = $sienna_mikado_options['menu_area_background_transparency_header_standard'];
			}

			$menu_area_header_standard_styles['background-color'] = sienna_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
		}

		if($sienna_mikado_options['menu_area_height_header_standard'] !== '') {
			$max_height = intval(sienna_mikado_filter_px($sienna_mikado_options['menu_area_height_header_standard']) * 0.9).'px';
			echo sienna_mikado_dynamic_css('.mkdf-header-standard .mkdf-page-header .mkdf-logo-wrapper a', array('max-height' => $max_height));

			$menu_area_header_standard_styles['height'] = sienna_mikado_filter_px($sienna_mikado_options['menu_area_height_header_standard']).'px';

		}

		echo sienna_mikado_dynamic_css('.mkdf-header-standard .mkdf-page-header .mkdf-menu-area', $menu_area_header_standard_styles);

		$menu_area_grid_header_standard_styles = array();

		if($sienna_mikado_options['menu_area_in_grid_header_standard'] == 'yes' && $sienna_mikado_options['menu_area_grid_background_color_header_standard'] !== '') {
			$menu_area_grid_background_color        = $sienna_mikado_options['menu_area_grid_background_color_header_standard'];
			$menu_area_grid_background_transparency = 1;

			if($sienna_mikado_options['menu_area_grid_background_transparency_header_standard'] !== '') {
				$menu_area_grid_background_transparency = $sienna_mikado_options['menu_area_grid_background_transparency_header_standard'];
			}

			$menu_area_grid_header_standard_styles['background-color'] = sienna_mikado_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
		}

		echo sienna_mikado_dynamic_css('.mkdf-header-standard .mkdf-page-header .mkdf-menu-area .mkdf-grid .mkdf-vertical-align-containers', $menu_area_grid_header_standard_styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_header_standard_menu_area_styles');
}

if(!function_exists('sienna_mikado_sticky_header_styles')) {
	/**
	 * Generates styles for sticky haeder
	 */
	function sienna_mikado_sticky_header_styles() {
		global $sienna_mikado_options;

		if($sienna_mikado_options['sticky_header_in_grid'] == 'yes' && $sienna_mikado_options['sticky_header_grid_background_color'] !== '') {
			$sticky_header_grid_background_color        = $sienna_mikado_options['sticky_header_grid_background_color'];
			$sticky_header_grid_background_transparency = 1;

			if($sienna_mikado_options['sticky_header_grid_transparency'] !== '') {
				$sticky_header_grid_background_transparency = $sienna_mikado_options['sticky_header_grid_transparency'];
			}

			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-grid .mkdf-vertical-align-containers', array('background-color' => sienna_mikado_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
		}

		if($sienna_mikado_options['sticky_header_background_color'] !== '') {

			$sticky_header_background_color              = $sienna_mikado_options['sticky_header_background_color'];
			$sticky_header_background_color_transparency = 1;

			if($sienna_mikado_options['sticky_header_transparency'] !== '') {
				$sticky_header_background_color_transparency = $sienna_mikado_options['sticky_header_transparency'];
			}

			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-sticky-holder', array('background-color' => sienna_mikado_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
		}

		if($sienna_mikado_options['sticky_header_height'] !== '') {
			$max_height = intval(sienna_mikado_filter_px($sienna_mikado_options['sticky_header_height']) * 0.9).'px';

			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header', array('height' => $sienna_mikado_options['sticky_header_height'].'px'));
			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-logo-wrapper a', array('max-height' => $max_height));
		}

		$sticky_menu_item_styles = array();
		if($sienna_mikado_options['sticky_color'] !== '') {
			$sticky_menu_item_styles['color'] = $sienna_mikado_options['sticky_color'];
		}
		if($sienna_mikado_options['sticky_google_fonts'] !== '-1') {
			$sticky_menu_item_styles['font-family'] = sienna_mikado_get_formatted_font_family($sienna_mikado_options['sticky_google_fonts']);
		}
		if($sienna_mikado_options['sticky_fontsize'] !== '') {
			$sticky_menu_item_styles['font-size'] = $sienna_mikado_options['sticky_fontsize'].'px';
		}
		if($sienna_mikado_options['sticky_lineheight'] !== '') {
			$sticky_menu_item_styles['line-height'] = $sienna_mikado_options['sticky_lineheight'].'px';
		}
		if($sienna_mikado_options['sticky_texttransform'] !== '') {
			$sticky_menu_item_styles['text-transform'] = $sienna_mikado_options['sticky_texttransform'];
		}
		if($sienna_mikado_options['sticky_fontstyle'] !== '') {
			$sticky_menu_item_styles['font-style'] = $sienna_mikado_options['sticky_fontstyle'];
		}
		if($sienna_mikado_options['sticky_fontweight'] !== '') {
			$sticky_menu_item_styles['font-weight'] = $sienna_mikado_options['sticky_fontweight'];
		}
		if($sienna_mikado_options['sticky_letterspacing'] !== '') {
			$sticky_menu_item_styles['letter-spacing'] = $sienna_mikado_options['sticky_letterspacing'].'px';
		}

		$sticky_menu_item_selector = array(
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li > a'
		);

		echo sienna_mikado_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

		$sticky_menu_item_hover_styles = array();
		if($sienna_mikado_options['sticky_hovercolor'] !== '') {
			$sticky_menu_item_hover_styles['color'] = $sienna_mikado_options['sticky_hovercolor'];
		}

		$sticky_menu_item_hover_selector = array(
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li:hover > a',
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li.mkdf-active-item:hover > a',
			'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu.mkdf-sticky-nav > ul > li:hover > a',
			'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu.mkdf-sticky-nav > ul > li.mkdf-active-item:hover > a'
		);

		echo sienna_mikado_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_sticky_header_styles');
}

if(!function_exists('sienna_mikado_fixed_header_styles')) {
	/**
	 * Generates styles for fixed haeder
	 */
	function sienna_mikado_fixed_header_styles() {
		global $sienna_mikado_options;

		if($sienna_mikado_options['fixed_header_grid_background_color'] !== '') {

			$fixed_header_grid_background_color              = $sienna_mikado_options['fixed_header_grid_background_color'];
			$fixed_header_grid_background_color_transparency = 1;

			if($sienna_mikado_options['fixed_header_grid_transparency'] !== '') {
				$fixed_header_grid_background_color_transparency = $sienna_mikado_options['fixed_header_grid_transparency'];
			}

			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-fixed-wrapper.fixed .mkdf-grid .mkdf-vertical-align-containers',
				array('background-color' => sienna_mikado_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
		}

		if($sienna_mikado_options['fixed_header_background_color'] !== '') {

			$fixed_header_background_color              = $sienna_mikado_options['fixed_header_background_color'];
			$fixed_header_background_color_transparency = 1;

			if($sienna_mikado_options['fixed_header_transparency'] !== '') {
				$fixed_header_background_color_transparency = $sienna_mikado_options['fixed_header_transparency'];
			}

			echo sienna_mikado_dynamic_css('.mkdf-page-header .mkdf-fixed-wrapper.fixed .mkdf-menu-area',
				array('background-color' => sienna_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
		}

	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_fixed_header_styles');
}

if(!function_exists('sienna_mikado_main_menu_styles')) {
	/**
	 * Generates styles for main menu
	 */
	function sienna_mikado_main_menu_styles() {
		global $sienna_mikado_options;

		if($sienna_mikado_options['menu_color'] !== '' || $sienna_mikado_options['menu_fontsize'] != '' || $sienna_mikado_options['menu_fontstyle'] !== '' || $sienna_mikado_options['menu_fontweight'] !== '' || $sienna_mikado_options['menu_texttransform'] !== '' || $sienna_mikado_options['menu_letterspacing'] !== '' || $sienna_mikado_options['menu_google_fonts'] != "-1") { ?>
			.mkdf-main-menu.mkdf-default-nav > ul > li > a,
			.mkdf-page-header #lang_sel > ul > li > a,
			.mkdf-page-header #lang_sel_click > ul > li > a,
			.mkdf-page-header #lang_sel ul > li:hover > a{
			<?php if($sienna_mikado_options['menu_color']) { ?> color: <?php echo esc_attr($sienna_mikado_options['menu_color']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['menu_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['menu_google_fonts'])); ?>', sans-serif;
			<?php } ?>
			<?php if($sienna_mikado_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($sienna_mikado_options['menu_fontsize']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($sienna_mikado_options['menu_fontstyle']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($sienna_mikado_options['menu_fontweight']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($sienna_mikado_options['menu_texttransform']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($sienna_mikado_options['menu_letterspacing']); ?>px; <?php } ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_google_fonts'] != "-1") { ?>
			.mkdf-page-header #lang_sel_list{
			font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['menu_google_fonts'])); ?>', sans-serif !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_hovercolor'] !== '') { ?>
			.mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
			.mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a,
			body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
			body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a,
			.mkdf-page-header #lang_sel ul li a:hover,
			.mkdf-page-header #lang_sel_click > ul > li a:hover{
			color: <?php echo esc_attr($sienna_mikado_options['menu_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_activecolor'] !== '') { ?>
			.mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a,
			body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a{
			color: <?php echo esc_attr($sienna_mikado_options['menu_activecolor']); ?>;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_hover_background_color'] !== '') {
			$menu_hover_background_color = $sienna_mikado_options['menu_hover_background_color'];

			if($sienna_mikado_options['menu_hover_background_color_transparency'] !== '') {
				$menu_hover_background_color_rgb = sienna_mikado_hex2rgb($menu_hover_background_color);
				$menu_hover_background_color     = 'rgba('.$menu_hover_background_color_rgb[0].', '.$menu_hover_background_color_rgb[1].', '.$menu_hover_background_color_rgb[2].', '.$sienna_mikado_options['menu_hover_background_color_transparency'].')';
			} ?>

			.mkdf-main-menu.mkdf-default-nav > ul > li > a span.item_outer:before,
			.mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a span.item_outer:before {
			background-color: <?php echo esc_attr($menu_hover_background_color); ?>;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_active_background_color'] !== '') {
			$menu_active_background_color = $sienna_mikado_options['menu_active_background_color'];

			if($sienna_mikado_options['menu_active_background_color_transparency'] !== '') {
				$menu_active_background_color_rgb = sienna_mikado_hex2rgb($menu_active_background_color);
				$menu_active_background_color     = 'rgba('.$menu_active_background_color_rgb[0].', '.$menu_active_background_color_rgb[1].', '.$menu_active_background_color_rgb[2].', '.$sienna_mikado_options['menu_active_background_color_transparency'].')';
			}
			?>
			.mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a span.item_outer:before {
			background-color: <?php echo esc_attr($menu_active_background_color); ?>;
			}
		<?php } ?>


		<?php if($sienna_mikado_options['menu_light_hovercolor'] !== '') { ?>
			.light .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
			.light .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a{
			color: <?php echo esc_attr($sienna_mikado_options['menu_light_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_light_activecolor'] !== '') { ?>
			.light .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a{
			color: <?php echo esc_attr($sienna_mikado_options['menu_light_activecolor']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_dark_hovercolor'] !== '') { ?>
			.dark .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
			.dark .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a{
			color: <?php echo esc_attr($sienna_mikado_options['menu_dark_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_dark_activecolor'] !== '') { ?>
			.dark .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a{
			color: <?php echo esc_attr($sienna_mikado_options['menu_dark_activecolor']); ?>;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_lineheight'] != "" || $sienna_mikado_options['menu_padding_left_right'] !== '') { ?>
			.mkdf-main-menu.mkdf-default-nav > ul > li > a span.item_inner{
			<?php if($sienna_mikado_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($sienna_mikado_options['menu_lineheight']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['menu_padding_left_right']) { ?> padding: 0  <?php echo esc_attr($sienna_mikado_options['menu_padding_left_right']); ?>px; <?php } ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['menu_margin_left_right'] !== '') { ?>
			.mkdf-main-menu.mkdf-default-nav > ul > li{
			margin: 0  <?php echo esc_attr($sienna_mikado_options['menu_margin_left_right']); ?>px;
			}
		<?php } ?>

		<?php
		if($sienna_mikado_options['dropdown_background_color'] != "" || $sienna_mikado_options['dropdown_background_transparency'] != "") {

			//dropdown background and transparency styles
			$dropdown_bg_color_initial        = '#ffffff';
			$dropdown_bg_transparency_initial = 1;

			$dropdown_bg_color        = $sienna_mikado_options['dropdown_background_color'] !== "" ? $sienna_mikado_options['dropdown_background_color'] : $dropdown_bg_color_initial;
			$dropdown_bg_transparency = $sienna_mikado_options['dropdown_background_transparency'] !== "" ? $sienna_mikado_options['dropdown_background_transparency'] : $dropdown_bg_transparency_initial;

			$dropdown_bg_color_rgb = sienna_mikado_hex2rgb($dropdown_bg_color);

			?>

			.mkdf-drop-down .second .inner ul,
			.mkdf-drop-down .second .inner ul li ul,
			.shopping_cart_dropdown,
			li.narrow .second .inner ul,
			.mkdf-main-menu.mkdf-default-nav #lang_sel ul ul,
			.mkdf-main-menu.mkdf-default-nav #lang_sel_click  ul ul,
			.header-widget.widget_nav_menu ul ul,
			.mkdf-drop-down .wide.wide_background .second{
			background-color: <?php echo esc_attr($dropdown_bg_color); ?>;
			background-color: rgba(<?php echo esc_attr($dropdown_bg_color_rgb[0]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[1]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[2]); ?>,<?php echo esc_attr($dropdown_bg_transparency); ?>);
			}

		<?php } //end dropdown background and transparency styles ?>

		<?php
		if($sienna_mikado_options['dropdown_top_padding'] !== '') {

			if($sienna_mikado_options['dropdown_top_padding'] !== '') {
				?>
				li.narrow .second .inner ul,
				.mkdf-drop-down .wide .second .inner > ul{
				padding-top: <?php echo esc_attr($sienna_mikado_options['dropdown_top_padding']); ?>px;
				}
			<?php } ?>
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_bottom_padding'] !== '') { ?>
			li.narrow .second .inner ul,
			.mkdf-drop-down .wide .second .inner > ul{
			padding-bottom: <?php echo esc_attr($sienna_mikado_options['dropdown_bottom_padding']); ?>px;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_top_position'] !== '') { ?>
			header .mkdf-drop-down .second {
			top: <?php echo esc_attr($sienna_mikado_options['dropdown_top_position']).'%;'; ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_color'] !== '' || $sienna_mikado_options['dropdown_fontsize'] !== '' || $sienna_mikado_options['dropdown_lineheight'] !== '' || $sienna_mikado_options['dropdown_fontstyle'] !== '' || $sienna_mikado_options['dropdown_fontweight'] !== '' || $sienna_mikado_options['dropdown_google_fonts'] != "-1" || $sienna_mikado_options['dropdown_texttransform'] !== '' || $sienna_mikado_options['dropdown_letterspacing'] !== '') { ?>
			.mkdf-drop-down .second .inner > ul > li > a,
			.mkdf-drop-down .second .inner > ul > li > h4,
			.mkdf-drop-down .wide .second .inner > ul > li > h4,
			.mkdf-drop-down .wide .second .inner > ul > li > a,
			.mkdf-drop-down .wide .second ul li ul li.menu-item-has-children > a,
			.mkdf-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children > a,
			.mkdf-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4 a,
			.mkdf-drop-down .wide .second .inner > ul li .flexslider ul li  h4 a,
			.mkdf-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4,
			.mkdf-drop-down .wide .second .inner > ul li .flexslider ul li  h4,
			.mkdf-main-menu.mkdf-default-nav #lang_sel ul li li a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel_click ul li ul li a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel ul ul a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel_click ul ul a{
			<?php if(!empty($sienna_mikado_options['dropdown_color'])) { ?> color: <?php echo esc_attr($sienna_mikado_options['dropdown_color']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['dropdown_google_fonts'])); ?>', sans-serif !important;
			<?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($sienna_mikado_options['dropdown_fontsize']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($sienna_mikado_options['dropdown_lineheight']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($sienna_mikado_options['dropdown_fontstyle']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($sienna_mikado_options['dropdown_fontweight']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($sienna_mikado_options['dropdown_texttransform']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($sienna_mikado_options['dropdown_letterspacing']); ?>px;  <?php } ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_color'] !== '') { ?>
			.shopping_cart_dropdown ul li
			.item_info_holder .item_left a,
			.shopping_cart_dropdown ul li .item_info_holder .item_right .amount,
			.shopping_cart_dropdown .cart_bottom .subtotal_holder .total,
			.shopping_cart_dropdown .cart_bottom .subtotal_holder .total_amount{
			color: <?php echo esc_attr($sienna_mikado_options['dropdown_color']); ?>;
			}
		<?php } ?>

		<?php if(!empty($sienna_mikado_options['dropdown_hovercolor'])) { ?>
			.mkdf-drop-down .second .inner > ul > li:hover > a,
			.mkdf-drop-down .wide .second ul li ul li.menu-item-has-children:hover > a,
			.mkdf-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children:hover > a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel ul li li:hover a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel_click ul li ul li:hover a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel ul li:hover > a,
			.mkdf-main-menu.mkdf-default-nav #lang_sel_click ul li:hover > a{
			color: <?php echo esc_attr($sienna_mikado_options['dropdown_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if(!empty($sienna_mikado_options['dropdown_background_hovercolor'])) { ?>
			.mkdf-drop-down li:not(.wide) .second .inner > ul > li:hover{
			background-color: <?php echo esc_attr($sienna_mikado_options['dropdown_background_hovercolor']); ?>;
			}
		<?php } ?>

		<?php if(!empty($sienna_mikado_options['dropdown_padding_top_bottom'])) { ?>
			.mkdf-drop-down .wide .second>.inner>ul>li.sub>ul>li>a,
			.mkdf-drop-down .second .inner ul li a,
			.mkdf-drop-down .wide .second ul li a,
			.mkdf-drop-down .second .inner ul.right li a{
			padding-top: <?php echo esc_attr($sienna_mikado_options['dropdown_padding_top_bottom']); ?>px;
			padding-bottom: <?php echo esc_attr($sienna_mikado_options['dropdown_padding_top_bottom']); ?>px;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_wide_color'] !== '' || $sienna_mikado_options['dropdown_wide_fontsize'] !== '' || $sienna_mikado_options['dropdown_wide_lineheight'] !== '' || $sienna_mikado_options['dropdown_wide_fontstyle'] !== '' || $sienna_mikado_options['dropdown_wide_fontweight'] !== '' || $sienna_mikado_options['dropdown_wide_google_fonts'] !== "-1" || $sienna_mikado_options['dropdown_wide_texttransform'] !== '' || $sienna_mikado_options['dropdown_wide_letterspacing'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner > ul > li > a{
			<?php if($sienna_mikado_options['dropdown_wide_color'] !== '') { ?> color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_color']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['dropdown_wide_google_fonts'])); ?>', sans-serif !important;
			<?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontsize']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_lineheight']); ?>px; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontstyle']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontweight']); ?>; <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_texttransform']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_letterspacing']); ?>px;  <?php } ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_wide_hovercolor'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner > ul > li:hover > a {
			color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if(!empty($sienna_mikado_options['dropdown_wide_background_hovercolor'])) { ?>
			.mkdf-drop-down .wide .second .inner > ul > li:hover > a{
			background-color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_background_hovercolor']); ?>
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_wide_padding_top_bottom'] !== '') { ?>
			.mkdf-drop-down .wide .second>.inner > ul > li.sub > ul > li > a,
			.mkdf-drop-down .wide .second .inner ul li a,
			.mkdf-drop-down .wide .second ul li a,
			.mkdf-drop-down .wide .second .inner ul.right li a{
			padding-top: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_padding_top_bottom']); ?>px;
			padding-bottom: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_padding_top_bottom']); ?>px;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_color_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_fontsize_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_lineheight_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_fontstyle_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_fontweight_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_google_fonts_thirdlvl'] != "-1" || $sienna_mikado_options['dropdown_texttransform_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_letterspacing_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .second .inner ul li.sub ul li a{
			<?php if($sienna_mikado_options['dropdown_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($sienna_mikado_options['dropdown_color_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_google_fonts_thirdlvl'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['dropdown_google_fonts_thirdlvl'])); ?>', sans-serif;
			<?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($sienna_mikado_options['dropdown_fontsize_thirdlvl']); ?>px;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($sienna_mikado_options['dropdown_lineheight_thirdlvl']); ?>px;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($sienna_mikado_options['dropdown_fontstyle_thirdlvl']); ?>;   <?php } ?>
			<?php if($sienna_mikado_options['dropdown_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($sienna_mikado_options['dropdown_fontweight_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($sienna_mikado_options['dropdown_texttransform_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($sienna_mikado_options['dropdown_letterspacing_thirdlvl']); ?>px;  <?php } ?>
			}
		<?php } ?>
		<?php if($sienna_mikado_options['dropdown_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .second .inner ul li.sub ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next),
			.mkdf-drop-down .second .inner ul li ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next){
			color: <?php echo esc_attr($sienna_mikado_options['dropdown_hovercolor_thirdlvl']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_background_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .second .inner ul li.sub ul li:hover,
			.mkdf-drop-down .second .inner ul li ul li:hover{
			background-color: <?php echo esc_attr($sienna_mikado_options['dropdown_background_hovercolor_thirdlvl']); ?>;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_wide_color_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_fontsize_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_lineheight_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_fontstyle_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_fontweight_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_google_fonts_thirdlvl'] != "-1" || $sienna_mikado_options['dropdown_wide_texttransform_thirdlvl'] !== '' || $sienna_mikado_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner ul li.sub ul li a,
			.mkdf-drop-down .wide .second ul li ul li a{
			<?php if($sienna_mikado_options['dropdown_wide_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_color_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_google_fonts_thirdlvl'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $sienna_mikado_options['dropdown_wide_google_fonts_thirdlvl'])); ?>', sans-serif;
			<?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontsize_thirdlvl']); ?>px;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_lineheight_thirdlvl']); ?>px;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontstyle_thirdlvl']); ?>;   <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_fontweight_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_texttransform_thirdlvl']); ?>;  <?php } ?>
			<?php if($sienna_mikado_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_letterspacing_thirdlvl']); ?>px;  <?php } ?>
			}
		<?php } ?>
		<?php if($sienna_mikado_options['dropdown_wide_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner ul li.sub ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover,
			.mkdf-drop-down .wide .second .inner ul li ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover{
			color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_hovercolor_thirdlvl']); ?> !important;
			}
		<?php } ?>

		<?php if($sienna_mikado_options['dropdown_wide_background_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner ul li.sub ul li:hover,
			.mkdf-drop-down .wide .second .inner ul li ul li:hover{
			background-color: <?php echo esc_attr($sienna_mikado_options['dropdown_wide_background_hovercolor_thirdlvl']); ?>;
			}
		<?php }
	}

	add_action('sienna_mikado_style_dynamic', 'sienna_mikado_main_menu_styles');
}