<?php

/**
 * ---------------
 * Plugin Styling
 * ---------------
 * WP Mobile Menu
 * Copyright WP Mobile Menu 2019 - http://www.wpmobilemenu.com/
 * CUSTOM CSS OUTPUT
 */
global  $mm_fs ;
$titan = TitanFramework::getInstance( 'mobmenu' );
$mobmenu_admin_bar = 0;
$default_elements = '';
$logo_height = '';
$def_el_arr = $titan->getOption( 'default_hided_elements' );
$trigger_res = $titan->getOption( 'width_trigger' );
$right_menu_width = $titan->getOption( 'right_menu_width' ) . 'px';
$right_menu_width_translate = '100%';
$left_menu_width_translate = '100%';
$left_menu_height_translate = '100%';
$woo_menu_width_translate = '100%';
if ( is_admin_bar_showing() ) {
    $mobmenu_admin_bar = 32;
}
if ( in_array( '1', $def_el_arr ) ) {
    $default_elements .= '.nav, ';
}
if ( in_array( '2', $def_el_arr ) ) {
    $default_elements .= '.main-navigation, ';
}
if ( in_array( '3', $def_el_arr ) ) {
    $default_elements .= '.genesis-nav-menu, ';
}
if ( in_array( '4', $def_el_arr ) ) {
    $default_elements .= '#main-header, ';
}
if ( in_array( '5', $def_el_arr ) ) {
    $default_elements .= '#et-top-navigation, ';
}
if ( in_array( '6', $def_el_arr ) ) {
    $default_elements .= '.site-header, ';
}
if ( in_array( '7', $def_el_arr ) ) {
    $default_elements .= '.site-branding, ';
}
if ( in_array( '8', $def_el_arr ) ) {
    $default_elements .= '.ast-mobile-menu-buttons, ';
}
if ( in_array( '9', $def_el_arr ) ) {
    $default_elements .= '.storefront-handheld-footer-bar, ';
}
$default_elements .= '.hide';
// Check if the Naked Header is enabled.

if ( $titan->getOption( 'enabled_naked_header' ) ) {
    $header_bg_color = 'transparent';
    $wrap_padding_top = '0';
} else {
    $header_bg_color = $titan->getOption( 'header_bg_color' );
    $wrap_padding_top = $titan->getOption( 'header_height' );
}

// Determine the Width of the Left menu panel.

if ( $titan->getOption( 'left_menu_width_units' ) ) {
    $left_menu_width = $titan->getOption( 'left_menu_width' ) . 'px';
    $left_menu_width_translate = $titan->getOption( 'left_menu_width' ) - 1 . 'px';
} else {
    $left_menu_width = $titan->getOption( 'left_menu_width_percentage' ) . '%';
}

// Determine the Width of the Right menu panel.

if ( $titan->getOption( 'right_menu_width_units' ) ) {
    $right_menu_width = $titan->getOption( 'right_menu_width' ) . 'px';
} else {
    $right_menu_width = $titan->getOption( 'right_menu_width_percentage' ) . '%';
}


if ( $titan->getOption( 'logo_height' ) > 0 ) {
    $logo_height = $titan->getOption( 'logo_height' );
} else {
    $logo_height = $titan->getOption( 'header_height' );
}

$logo_height = 'height:' . $logo_height . 'px!important;';
$header_height = $titan->getOption( 'header_height' );
$total_header_height = $header_height;
$banner_height = 0;
$header_margin_top = '0px';
$header_banner_padding_top = 0;
// Left Menu Background Image.
$left_menu_bg_image = $titan->getOption( 'left_menu_bg_image' );
$left_menu_bg_image_size = $titan->getOption( 'left_menu_bg_image_size' );
$header_margin_left = '0';
$header_margin_right = '0';
$header_text_position = 'absolute';
$border_menu_size = $titan->getOption( 'menu_items_border_size' );
$submenu_open_icon_font = $titan->getOption( 'submenu_open_icon_font' );
// Sticky Header.

if ( $titan->getOption( 'enabled_sticky_header' ) ) {
    $header_position = 'fixed';
} else {
    $header_position = 'absolute';
}


if ( 'center' == $titan->getOption( 'header_text_align' ) ) {
    $logo_header_position = 'absolute';
} else {
    $logo_header_position = 'relative';
}

// Header Text alignment.
if ( 'center' === $titan->getOption( 'header_text_align' ) ) {
    $header_text_position = 'initial';
}
if ( 'left' === $titan->getOption( 'header_text_align' ) ) {
    $header_margin_left = $titan->getOption( 'header_text_left_margin' ) . 'px;';
}
if ( 'right' === $titan->getOption( 'header_text_align' ) ) {
    $header_margin_right = $titan->getOption( 'header_text_right_margin' ) . 'px;';
}
if ( $titan->getOption( 'logo_img_retina' ) ) {
    ?>
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {

	.mob-retina-logo {
		display: inline-block;
	}
	.mob-standard-logo {
		display: none!important;
	}
}
<?php 
}
?>
@media only screen and (min-width:<?php 
echo  $trigger_res + 1 ;
?>px){
	.mob_menu, .mobmenu-panel, .mobmenu, .mobmenu-cart-panel, .mobmenu-footer-menu-holder, .mobmenu-right-panel, .mobmenu-left-panel  {
		display: none!important;
	}
}
<?php 

if ( 0 < $border_menu_size ) {
    $border_menu_color = $titan->getOption( 'menu_items_border_color' );
    $border_style = $border_menu_size . 'px solid ' . $border_menu_color;
    ?>

		.mobmenu-content li {
			border-bottom: <?php 
    echo  $border_style ;
    ?>;
		}

<?php 
}


if ( '' !== $titan->getOption( 'hide_elements' ) ) {
    ?>
	/* Our css Custom Options values */
	@media only screen and (max-width:<?php 
    echo  $trigger_res ;
    ?>px){
		<?php 
    echo  $titan->getOption( 'hide_elements' ) ;
    ?> {
			display:none !important;
		}
	}

	<?php 
}

?>
	
	@media only screen and (max-width:<?php 
echo  $trigger_res ;
?>px) {
		<?php 
?>
	@media screen and ( min-width: 782px ){
		#mobmenu-footer li:hover {
			background-color: <?php 
echo  $titan->getOption( 'footer_bg_color_hover' ) ;
?>;
		}
		#mobmenu-footer li:hover i {
			color: <?php 
echo  $titan->getOption( 'footer_icon_color_hover' ) ;
?>;
		}
	}
	@media screen and ( min-width: 782px ){
		body.admin-bar .mobmenu {
			top: 32px!important;
		}
		<?php 
if ( is_admin_bar_showing() ) {
    $admin_bar_height = '32';
}
?>
		.mobmenu-search-holder {
				top: <?php 
echo  $total_header_height + $admin_bar_height ;
?>px!important;
		}
	}
	@media screen and ( max-width: 782px ){	
		body.admin-bar .mobmenu {
			top: 46px!important;
		}
	
		body.admin-bar .mob-menu-header-banner {
			top: <?php 
echo  $header_banner_padding_top ;
?>px!important;
		}
		<?php 

if ( is_admin_bar_showing() ) {
    $admin_bar_height = '46';
    ?>
			.mobmenu-search-holder {
				top: <?php 
    echo  $total_header_height + $admin_bar_height ;
    ?>px!important;
			}
			.mob-menu-slideout .mobmenu-search-holder {
				top: <?php 
    echo  $header_height ;
    ?>px!important;
			}
		<?php 
}

?>
	}

	.mobmenu-search img {
		width: <?php 
echo  esc_attr( $titan->getOption( 'search_icon_font_size' ) ) ;
?>px;
		margin-top : <?php 
echo  $titan->getOption( 'search_icon_top_margin' ) ;
?>px;
	}
	.mobmenu-cart img {
		width: <?php 
echo  $titan->getOption( 'mm_woo_menu_icon_font_size' ) ;
?>px;
		margin-top : <?php 
echo  $titan->getOption( 'cart_icon_top_margin' ) ;
?>px;
		
	}	
	.mobmenur-container i {
		color: <?php 
echo  $titan->getOption( 'right_menu_icon_color' ) ;
?>;
	}
	.mobmenul-container i {
		color: <?php 
echo  $titan->getOption( 'left_menu_icon_color' ) ;
?>;
	}
	.mobmenul-container img {
		max-height:  <?php 
echo  $titan->getOption( 'header_height' ) ;
?>px;
		float: left;
	}
	.mobmenur-container img {
		max-height:  <?php 
echo  $titan->getOption( 'header_height' ) ;
?>px;
		float: right;
	}
	.mob-expand-submenu i {
		font-size: <?php 
echo  $titan->getOption( 'submenu_icon_font_size' ) ;
?>px;
	}
	#mobmenuleft li a , #mobmenuleft li a:visited, .mobmenu-left-panel .mob-cancel-button, .mobmenu-content h2, .mobmenu-content h3, .show-nav-left .mob-menu-copyright, .show-nav-left .mob-expand-submenu i {
		color: <?php 
echo  $titan->getOption( 'left_panel_text_color' ) ;
?>;

	}
	.mob-cancel-button {
		font-size: <?php 
echo  $titan->getOption( 'close_icon_font_size' ) ;
?>px!important;
	}
	<?php 

if ( 'enabled' === $titan->getOption( 'enable_over_effects' ) ) {
    ?>
	/* 3rd Level Left Menu Items Background color on Hover*/
	.mobmenu-content #mobmenuleft .sub-menu  .sub-menu li a:hover {
		color: <?php 
    echo  $titan->getOption( 'left_panel_3rd_menu_text_color_hover' ) ;
    ?>;
	}
	/* 3rd Level Left Menu Items Background color on Hover*/
	.mobmenu-content #mobmenuleft .sub-menu .sub-menu li:hover {
		background-color: <?php 
    echo  $titan->getOption( 'left_panel_3rd_menu_bg_color_hover' ) ;
    ?>;
	}
	.mobmenu-content #mobmenuleft li:hover, .mobmenu-content #mobmenuright li:hover  {
		background-color: <?php 
    echo  $titan->getOption( 'left_panel_hover_bgcolor' ) ;
    ?>;
	}
	.mobmenu-content #mobmenuright li:hover  {
		background-color: <?php 
    echo  $titan->getOption( 'right_panel_hover_bgcolor' ) ;
    ?> ;
	}
	/* 3rd Level Right Menu Items Background color on Hover*/
	.mobmenu-content #mobmenuright .sub-menu .sub-menu li:hover {
		background-color: <?php 
    echo  $titan->getOption( 'right_panel_3rd_menu_bg_color_hover' ) ;
    ?>;
	}
	/* 3rd Level Right Menu Items Background color on Hover*/
	.mobmenu-content #mobmenuright .sub-menu  .sub-menu li a:hover {
		color: <?php 
    echo  $titan->getOption( 'right_panel_3rd_menu_text_color_hover' ) ;
    ?>;
	}
		

	<?php 
}

?>
	.mobmenu-content #mobmenuleft .sub-menu {
		background-color: <?php 
echo  $titan->getOption( 'left_panel_submenu_bgcolor' ) ;
?> ;
		margin: 0;
		color: <?php 
echo  $titan->getOption( 'left_panel_submenu_text_color' ) ;
?> ;
		width: 100%;
		position: initial;
	}
	.mob-menu-left-bg-holder {
		<?php 

if ( $left_menu_bg_image ) {
    ?>
				background: url(<?php 
    echo  wp_get_attachment_url( $left_menu_bg_image ) ;
    ?>);
		<?php 
}

?>
		opacity: <?php 
echo  $titan->getOption( 'left_menu_bg_opacity' ) / 100 ;
?>;
		background-attachment: fixed ;
		background-position: center top ;
		-webkit-background-size:  <?php 
echo  $left_menu_bg_image_size ;
?>;
		-moz-background-size: <?php 
echo  $left_menu_bg_image_size ;
?>;
		background-size: <?php 
echo  $left_menu_bg_image_size ;
?>;
	}
	.mob-menu-right-bg-holder { 
		<?php 

if ( $titan->getOption( 'right_menu_bg_image' ) ) {
    ?>
				background: url(<?php 
    echo  wp_get_attachment_url( $titan->getOption( 'right_menu_bg_image' ) ) ;
    ?>);
		<?php 
}

?>
		opacity: <?php 
echo  $titan->getOption( 'right_menu_bg_opacity' ) / 100 ;
?>;
		background-attachment: fixed ;
		background-position: center top ;
		-webkit-background-size: <?php 
echo  $titan->getOption( 'right_menu_bg_image_size' ) ;
?>;
		-moz-background-size: <?php 
echo  $titan->getOption( 'right_menu_bg_image_size' ) ;
?>;
		background-size:  <?php 
echo  $titan->getOption( 'right_menu_bg_image_size' ) ;
?>;
	}
	<?php 
?>
	.mobmenu-content #mobmenuleft .sub-menu a {
		color: <?php 
echo  $titan->getOption( 'left_panel_submenu_text_color' ) ;
?> ;
	}
	.mobmenu-content #mobmenuright .sub-menu  a {
		color: <?php 
echo  $titan->getOption( 'right_panel_submenu_text_color' ) ;
?> ;
	}
	.mobmenu-content #mobmenuright .sub-menu .sub-menu {
		background-color: inherit;
	}
	.mobmenu-content #mobmenuright .sub-menu {
		background-color: <?php 
echo  $titan->getOption( 'right_panel_submenu_bgcolor' ) ;
?> ;
		margin: 0;
		color: <?php 
echo  $titan->getOption( 'right_panel_submenu_text_color' ) ;
?> ;
		position: initial;
		width: 100%;
	}
	#mobmenuleft li:hover a, #mobmenuleft li:hover i {
		color: <?php 
echo  $titan->getOption( 'left_panel_hover_text_color' ) ;
?>;
	}
	#mobmenuright li a , #mobmenuright li a:visited, .show-nav-right .mob-menu-copyright, .show-nav-right .mob-expand-submenu i, .mobmenu-right-panel .mob-cancel-button {
		color: <?php 
echo  $titan->getOption( 'right_panel_text_color' ) ;
?> ;
	}
	#mobmenuright li a:hover {
		color: <?php 
echo  $titan->getOption( 'right_panel_hover_text_color' ) ;
?> ;
	}
	.mobmenul-container {
		top: <?php 
echo  $titan->getOption( 'left_icon_top_margin' ) ;
?>px;
		margin-left: <?php 
echo  $titan->getOption( 'left_icon_left_margin' ) ;
?>px;
		margin-top: <?php 
echo  $header_margin_top ;
?>;
		height: <?php 
echo  $header_height ;
?>px;
		float: left;
	}
	.mobmenur-container {
		top: <?php 
echo  $titan->getOption( 'right_icon_top_margin' ) ;
?>px;
		margin-right: <?php 
echo  $titan->getOption( 'right_icon_right_margin' ) ;
?>px;
		margin-top: <?php 
echo  $header_margin_top ;
?>;
	}
	<?php 
switch ( $titan->getOption( 'header_text_align' ) ) {
    case 'left':
        $header_logo_float = 'float:left;';
        break;
    case 'center':
        $header_logo_float = '';
        break;
    case 'right':
        $header_logo_float = 'float:right;';
        break;
}
?>
	.mob-menu-logo-holder {
		padding-top:  <?php 
echo  $titan->getOption( 'logo_top_margin' ) ;
?>px;
		margin-top:   <?php 
echo  $header_margin_top ;
?>;
		text-align:   <?php 
echo  $titan->getOption( 'header_text_align' ) ;
?>;
		margin-left:  <?php 
echo  $header_margin_left ;
?>;
		margin-right: <?php 
echo  $header_margin_right ;
?>;
		height:       <?php 
echo  $header_height ;
?>px ;
		<?php 
echo  $header_logo_float ;
?>;
	}
	.mob-menu-header-holder {
		background-color: <?php 
echo  $header_bg_color ;
?> ;
		height: <?php 
echo  $total_header_height ;
?>px ;
		position:<?php 
echo  $header_position ;
?>;
	}
	body {
		padding-top: <?php 
echo  $wrap_padding_top ;
?>px;
	}
	<?php 

if ( '' !== $titan->getOption( 'left_menu_bg_gradient' ) ) {
    $left_panel_bg_color = $titan->getOption( 'left_menu_bg_gradient' ) . ';';
} else {
    $left_panel_bg_color = 'background-color:' . $titan->getOption( 'left_panel_bg_color' ) . ';';
}


if ( '' !== $titan->getOption( 'right_menu_bg_gradient' ) ) {
    $right_panel_bg_color = $titan->getOption( 'right_menu_bg_gradient' ) . ';';
} else {
    $right_panel_bg_color = 'background-color:' . $titan->getOption( 'right_panel_bg_color' ) . ';';
}


if ( '' !== $titan->getOption( 'mm_woo_menu_bg_gradient' ) ) {
    $cart_panel_bg_color = $titan->getOption( 'mm_woo_menu_bg_gradient' ) . ';';
} else {
    $cart_panel_bg_color = 'background-color:' . $titan->getOption( 'mm_woo_menu_panel_bg_color' ) . ';';
}

?>
	.mobmenul-container, .mobmenur-container{
		position: <?php 
echo  $logo_header_position ;
?>; 
	}
	.mobmenu-left-panel {
		<?php 
echo  $left_panel_bg_color ;
?>;
		width:  <?php 
echo  $left_menu_width ;
?>;  
	}
	.mobmenu-right-panel {
		<?php 
echo  $right_panel_bg_color ;
?>
		width:  <?php 
echo  $right_menu_width ;
?>; 
	}
	.show-nav-left .mobmenu-overlay, .show-nav-right .mobmenu-overlay, .show-mob-menu-search .mobmenu-overlay  {
		background: <?php 
echo  $titan->getOption( 'overlay_bg_color' ) ;
?>;
	}
	.show-nav-left .mob-menu-header-holder, .show-nav-right .mob-menu-header-holder{
		-webkit-transition: .5s;
		-moz-transition: .5s;
		-ms-transition: .5s;
		-o-transition: .5s;
		transition: .5s;
	}	
	.mob-menu-slideout-top .mobmenu-overlay, .show-nav-right.mob-menu-slideout .mobmenur-container {
		display:none!important;
	}
	.mob-menu-slideout.show-nav-left .mobmenu-push-wrap, .mob-menu-slideout.show-nav-left .mob-menu-header-holder {
		-webkit-transform: translateX(<?php 
echo  $left_menu_width ;
?>);
		-moz-transform: translateX(<?php 
echo  $left_menu_width ;
?>);
		-ms-transform: translateX(<?php 
echo  $left_menu_width ;
?>);
		-o-transform: translateX(<?php 
echo  $left_menu_width ;
?>);
		transform: translateX(<?php 
echo  $left_menu_width ;
?>);
	}
	.mob-menu-slideout.show-nav-right .mobmenu-push-wrap, .mob-menu-slideout.show-nav-right .mob-menu-header-holder {
		-webkit-transform: translateX(-<?php 
echo  $right_menu_width ;
?>);
		-moz-transform: translateX(-<?php 
echo  $right_menu_width ;
?>);
		-ms-transform: translateX(-<?php 
echo  $right_menu_width ;
?>);
		-o-transform: translateX(-<?php 
echo  $right_menu_width ;
?>);
		transform: translateX(-<?php 
echo  $right_menu_width ;
?>);
	}
	.mob-menu-slideout-top .mobmenu-panel {
		width:  100%;
		height: <?php 
echo  $left_menu_height_translate ;
?>;
		z-index: 999999;
		position: fixed;
		left: 0px;
		top: 0px;
		max-height: <?php 
echo  $left_menu_height_translate ;
?>;
		-webkit-transform: translateY(-<?php 
echo  $left_menu_height_translate ;
?>);
		-moz-transform: translateY(-<?php 
echo  $left_menu_height_translate ;
?>);
		-ms-transform: translateY(-<?php 
echo  $left_menu_height_translate ;
?>);
		-o-transform: translateY(-<?php 
echo  $left_menu_height_translate ;
?>);
		transform: translateY(-<?php 
echo  $left_menu_height_translate ;
?>);
	}
	.mob-menu-slideout-top.show-nav-left .show-panel, .mob-menu-slideout-top.show-nav-right .show-panel  {
		-webkit-transform: translateY(0px);
		-moz-transform: translateY(0px);
		-ms-transform: translateY(0px);
		-o-transform: translateY(0px);
		transform: translateY(0px);
	}
	.mob-menu-slideout-over.show-nav-left .mobmenu-left-panel {
		overflow: hidden;
	}
	.mob-menu-slideout-over .mobmenu-cart-panel.show-panel {
		-webkit-transform: translateX( 0 );
		-moz-transform: translateX( 0 );
		-ms-transform: translateX( 0 );
		-o-transform: translateX(0 );
		transform: translateX( 0 );
		overflow: hidden;
	}
	/* Hides everything pushed outside of it */
	.mob-menu-slideout .mobmenu-panel, .mob-menu-slideout-over .mobmenu-panel, .mob-menu-slideout .mobmenu-cart-panel, .mob-menu-slideout-over .mobmenu-cart-panel {
		position: fixed;
		top: 0;
		height: 100%;
		z-index: 300000;
		overflow-y: auto;   
		overflow-x: hidden;
		opacity: 1;
	}
	/*End of Mobmenu Slide Over */
	.mobmenu .headertext { 
		color: <?php 
echo  $titan->getOption( 'header_text_color' ) ;
?> ;
	}
	.headertext span {
		position: <?php 
echo  $header_text_position ;
?>;
		line-height: <?php 
echo  $header_height ;
?>px;
	}
	.mobmenu-search-holder {
		top: <?php 
echo  $total_header_height + $admin_bar_height ;
?>px;
	}
	/*Premium options  */
	<?php 
?>

	/* Mobile Menu Frontend CSS Style*/
	html, body {
		overflow-x: hidden;
		-webkit-overflow-scrolling: touch; 
		overflow-y: scroll; 
	}
	.mobmenu-left-panel li a, .leftmbottom, .leftmtop{
		padding-left: <?php 
echo  $titan->getOption( 'left_menu_content_padding' ) ;
?>%;
		padding-right: <?php 
echo  $titan->getOption( 'left_menu_content_padding' ) ;
?>%;
	}
	.mobmenu-content li > .sub-menu li {
		padding-left: calc(<?php 
echo  $titan->getOption( 'left_menu_content_padding' ) ;
?>*2%);
	}

	.mobmenu-right-panel li, .rightmbottom, .rightmtop{
		padding-left: <?php 
echo  $titan->getOption( 'right_menu_content_padding' ) ;
?>%;
		padding-right: <?php 
echo  $titan->getOption( 'right_menu_content_padding' ) ;
?>%;
	}
	.mobmenu-cart-panel .mobmenu-content {
		padding-left: <?php 
echo  $titan->getOption( 'mm_woo_menu_content_padding' ) ;
?>%!important;
		padding-right: <?php 
echo  $titan->getOption( 'mm_woo_menu_content_padding' ) ;
?>%!important;
		position: absolute;
	}
	.mobmenul-container i {
		line-height: <?php 
echo  $titan->getOption( 'left_icon_font_size' ) ;
?>px;
		font-size: <?php 
echo  $titan->getOption( 'left_icon_font_size' ) ;
?>px;
		float: left;
	}
	.left-menu-icon-text {
		float: left;
		line-height: <?php 
echo  $titan->getOption( 'left_icon_font_size' ) ;
?>px;
	}
	.mobmenu-left-panel .mobmenu-display-name {
		color: <?php 
echo  $titan->getOption( 'left_panel_text_color' ) ;
?>!important;
	}
	.mobmenu-right-panel .mobmenu-display-name {
		color: <?php 
echo  $titan->getOption( 'right_panel_text_color' ) ;
?>!important;
	}
	.right-menu-icon-text {
		float: right;
		line-height: <?php 
echo  $titan->getOption( 'right_icon_font_size' ) ;
?>px;
		color: <?php 
echo  $titan->getOption( 'header_text_before_icon' ) ;
?>;
	}
	.mobmenur-container i.mob-search-button, .mobmenul-container i.mob-search-button {
		color: <?php 
echo  $titan->getOption( 'search_icon_color' ) ;
?>;
		font-size: <?php 
echo  $titan->getOption( 'search_icon_font_size' ) ;
?>px;
	}
	.mobmenur-container i.mob-cart-button, .mobmenul-container i.mob-cart-button {
		color: <?php 
echo  $titan->getOption( 'mm_woo_menu_icon_color' ) ;
?>;
		font-size: <?php 
echo  $titan->getOption( 'mm_woo_menu_icon_font_size' ) ;
?>px;
	}
	.mob-menu-search-form button[type=submit] i, .mob-menu-search-form button[type=submit] span{
		color: <?php 
echo  $titan->getOption( 'search_form_submit_color' ) ;
?>;
	}
	.mob-menu-search-form input {
		background: transparent;
		color: <?php 
echo  $titan->getOption( 'search_form_text_color' ) ;
?>;
	}
	.mob-menu-search-form input:focus {
		color: <?php 
echo  $titan->getOption( 'search_form_text_color' ) ;
?>;
	}
	.mob-menu-search-form input[type=text]:focus {
		color: <?php 
echo  $titan->getOption( 'search_form_text_color' ) ;
?>;
		background-color: transparent;
	}
	.mobmenu-search-holder {
		background-color: <?php 
echo  $titan->getOption( 'search_form_bg_color' ) ;
?>;
	}
	.mob-menu-search-field::-webkit-input-placeholder {
		color: <?php 
echo  $titan->getOption( 'search_form_placeholder_color' ) ;
?>;
	}
	.mob-menu-search-field::-moz-placeholder {
		color: <?php 
echo  $titan->getOption( 'search_form_placeholder_color' ) ;
?>;
	}
	.mob-menu-search-field:-ms-input-placeholder {
		color: <?php 
echo  $titan->getOption( 'search_form_placeholder_color' ) ;
?>;
	}
	.mobmenur-container i {
		line-height: <?php 
echo  $titan->getOption( 'right_icon_font_size' ) ;
?>px;
		font-size: <?php 
echo  $titan->getOption( 'right_icon_font_size' ) ;
?>px;
		float: right;
	}
	.mobmenu-content .current_page_item {
		border-left-color:  <?php 
echo  $titan->getOption( 'highlight_current_page' ) ;
?>;
	}
	<?php 
echo  $default_elements ;
?> {
		display: none!important;
	}
	.mob-standard-logo {
		display: inline-block;
		<?php 
echo  $logo_height ;
?>
	}
	.mob-retina-logo {
		<?php 
echo  $logo_height ;
?>
	}

}
