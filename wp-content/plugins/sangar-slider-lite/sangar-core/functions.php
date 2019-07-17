<?php
/**
 * Sangar Slider Core Functions
 */
define( 'SANGAR_SLIDER', 'sangar-slider' );
define( 'SANGAR_CORE_DIR_URL', plugin_dir_url( __FILE__ ) );

// require core files
require_once plugin_dir_path( __FILE__ ) . 'form-library.php';
require_once plugin_dir_path( __FILE__ ) . 'google-fonts.php';
require_once plugin_dir_path( __FILE__ ) . 'default.php';
require_once plugin_dir_path( __FILE__ ) . 'wp-media-uploader.php';
require_once plugin_dir_path( __FILE__ ) . 'meta-box.php';
require_once plugin_dir_path( __FILE__ ) . 'meta-box-core.php';
require_once plugin_dir_path( __FILE__ ) . 'slides-row-template.php';
require_once plugin_dir_path( __FILE__ ) . 'ajax.php';
require_once plugin_dir_path( __FILE__ ) . 'post-media-button.php';
require_once plugin_dir_path( __FILE__ ) . 'gutenberg.php';
require_once plugin_dir_path( __FILE__ ) . 'ssliderGenerate.php';
require_once plugin_dir_path( __DIR__ ) . 'shortcode.php';

/**
 * Sangar Slider Admin
 */
add_action( 'admin_menu', 'sslider_admin_menu' );
function sslider_admin_menu() {
	add_menu_page(
		'Sangar Slider',
		'Sangar Slider',
		'moderate_comments',
		'sangar_slider_admin',
		'sangar_slider_admin_callback',
		plugin_dir_url( __FILE__ ) . 'assets/images/sangar_icon.png', '5.09421983627'
	);
}
function sangar_slider_admin_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'admin.php';
}

/**
 * Import dummy data page
 */
$sslider_addons = apply_filters( 'sangar_slider_addons', array() );
if ( count( $sslider_addons ) > 1 ) {
	add_action( 'admin_menu', 'sslider_import_dummy_data_menu' );
	function sslider_import_dummy_data_menu() {
		add_submenu_page(
			'sangar_slider_admin',
			'Dummy Data',
			'Dummy Data',
			'moderate_comments',
			'sslider_import_dummy_data',
			'sslider_import_dummy_data_callback'
		);
	}
	function sslider_import_dummy_data_callback() {
		require_once plugin_dir_path( __FILE__ ) . 'dummy-data/admin.php';
	}
}

/**
 * Register post type
 */
add_action( 'init', 'sslider_register_post_type' );
function sslider_register_post_type() {
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	foreach ( $sslider_addons as $key => $value ) {
		$name = $value['name'];

		$args = array(
			'labels'              => array(
				'name'               => 'Sangar Slider - ' . $name,
				'singular_name'      => 'Sangar Slider - ' . $name,
				'add_new'            => 'Add ' . $name,
				'add_new_item'       => 'Add New ' . $name,
				'edit'               => 'Edit',
				'edit_item'          => 'Edit Slider',
				'new_item'           => 'New Slider',
				'view'               => 'View',
				'view_item'          => 'View Slider',
				'search_items'       => 'Search Slider',
				'not_found'          => 'No Slider Found',
				'not_found_in_trash' => 'No Slider found in the trash',
				'parent'             => 'Parent Slider view',
			),
			'public'              => true,
			'supports'            => array( 'title' ),
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'show_in_menu'        => false,
		);

		register_post_type( $key, $args );

		// require ssliderGenerate for each addons
		require_once plugin_dir_path( $value['directory'] ) . 'ssliderGenerate.php';
		require_once plugin_dir_path( $value['directory'] ) . 'default.php';
	}
}

/**
 * Load addons if in current screen
 */
add_action( 'current_screen', 'sslider_current_screen' );
function sslider_current_screen() {
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );
	$screen         = get_current_screen();
	$key            = $screen->post_type;

	if ( array_key_exists( $key, $sslider_addons ) ) {
		require_once $sslider_addons[ $key ]['directory'];
	}
}

/**
 * Submenu per addons
 */
add_action( 'admin_menu', 'sslider_submenu_addons' );
function sslider_submenu_addons() {
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	foreach ( $sslider_addons as $key => $value ) {
		$name = $value['name'];

		add_submenu_page(
			'sangar_slider_admin',
			'Add ' . $name,
			'Add ' . $name,
			'moderate_comments',
			'post-new.php?post_type=' . $key
		);
	}
}

/**
 * Sort all submenu
 */
add_filter( 'custom_menu_order', 'sslider_custom_menu_order' );
function sslider_custom_menu_order( $menu_ord ) {
	global $submenu;

	// return false if the capabilities is lower than editor
	if ( ! isset( $submenu['sangar_slider_admin'] ) ) {
		return;
	}

	$count = count( $submenu['sangar_slider_admin'] );
	$count = $count - 1;

	foreach ( $submenu['sangar_slider_admin'] as $key => $value ) {
		if ( $value[0] == 'Tonjoo License' && $key != $count ) {
			$temp_value = $submenu['sangar_slider_admin'][ $count ];

			$submenu['sangar_slider_admin'][ $count ] = $value;
			$submenu['sangar_slider_admin'][ $key ]   = $temp_value;
		} elseif ( $value[0] == 'Add Layer Slider' && $key != 1 ) {
			$temp_value = $submenu['sangar_slider_admin'][1];

			$submenu['sangar_slider_admin'][1]      = $value;
			$submenu['sangar_slider_admin'][ $key ] = $temp_value;
		}
	}

	// change subtitle
	$submenu['sangar_slider_admin'][0][0] = 'All Slider';

	return $menu_ord;
}

/**
 * Get slideshow thumbnail (1st slide)
 */
function sslider_get_slideshow_thumbnail( $sslider_data, $post ) {
	$slide_thumbnail = '';

	if ( is_array( $sslider_data ) && count( $sslider_data ) > 0 ) {
		foreach ( $sslider_data as $slug => $slide ) {
			$rwdata['title']     = isset( $slide['slide-title'] ) ? $slide['slide-title'] : '';
			$rwdata['slug']      = $slug;
			$rwdata['thumbtype'] = $slide['tab-bg-selection'];

			// color
			if ( $rwdata['thumbtype'] == 'color' ) {
				$rwdata['thumbnail'] = $slide['tab-bg-color'];
			} else {
				$rwdata['thumbnail'] = '#000000';
			}

			// image
			if ( $rwdata['thumbtype'] == 'image' ) {
				$rwdata['thumbnail'] = plugin_dir_url( __FILE__ ) . 'assets/images/small_thumb_img.jpg';
				$img_id              = $slide['tab-bg-image'];

				if ( $img_id != '' && $img_id > 0 ) {
					$scr                 = wp_get_attachment_image_src( $img_id, 'thumbnail' );
					$rwdata['thumbnail'] = $scr[0];
				}
			}

			$slide_thumbnail = sslider_row( $rwdata, true );

			break;
		}
	} else {
		$img_style = 'style="background:#111;"';
		$image     = plugin_dir_url( __FILE__ ) . 'assets/images/small_thumb_color.png';

		$slide_thumbnail = "<img $img_style src='$image'>";
	}

	return "<a class='sslider-thumblist' href='" . get_edit_post_link( $post->ID ) . "'>" . $slide_thumbnail . '</a>';
}

/**
 * Make submenu active on edit
 */
add_action( 'admin_head', 'sslider_submenu_make_active' );
function sslider_submenu_make_active() {
	global $post_type;

	if ( ! is_string( $post_type ) ) {
		return;
	}

	$screen = get_current_screen();

	// return on add
	if ( isset( $screen->action ) && $screen->action == 'add' ) {
		return;
	}

	// get all addons
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	if ( ! array_key_exists( $post_type, $sslider_addons ) ) {
		return;
	}

	?>

	<script type="text/javascript">
		jQuery(function($) {
			$('a[href="admin.php?page=sangar_slider_admin"]')
				.parent('li')
				.removeClass('wp-not-current-submenu')
				.addClass('current wp-has-current-submenu');
		});
	</script>

	<?php
}

/**
 * Hide permalink on admin
 */
add_action( 'admin_head', 'sslider_hide_permalink' );
function sslider_hide_permalink() {
	global $post_type;

	if ( ! is_string( $post_type ) ) {
		return;
	}

	// get all addons
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	if ( ! array_key_exists( $post_type, $sslider_addons ) ) {
		return;
	}

	echo '<style>#edit-slug-box {display:none;}</style>';
}

/**
 * add custom html editor code
 */
add_action( 'admin_print_footer_scripts', 'sslider_eg_quicktags' );
function sslider_eg_quicktags() {
	global $post_type;

	if ( ! is_string( $post_type ) ) {
		return;
	}

	// get all addons
	$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

	if ( ! array_key_exists( $post_type, $sslider_addons ) ) {
		return;
	}

	?>
	<script type="text/javascript" charset="utf-8">
	/* Adding Quicktag buttons to the editor WordPress ver. 3.3 and above
	* - Button HTML ID (required)
	* - Button display, value="" attribute (required)
	* - Opening Tag (required)
	* - Closing Tag (required)
	* - Access key, accesskey="" attribute for the button (optional)
	* - Title, title="" attribute (optional)
	* - Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)
	*/
	if(typeof(QTags) !== 'undefined')
	{
		QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p' );
		QTags.addButton( 'eg_hyperlink', 'link', '<a href="">', '</a>', 'p' );
		QTags.addButton( 'eg_pre', 'pre','<pre lang="php">', '</pre>', 'q' );
		QTags.addButton( 'eg_newline', 'new line','<br> \n' );
	}
	</script>
	<?php
}

/**
 * add sangar_slider_delete_query filter
 */
add_filter(
	'sangar_slider_delete_query', function( $data ) {
		$key = $data[0];
		$url = $data[1];

		$url = preg_replace( '/(.*)(\?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&' );
		$url = substr( $url, 0, -1 );

		return $url;
	}
);

/**
 * add post_updated_messages filter
 */
add_filter( 'post_updated_messages', 'sslider_post_updated_messages', 10, 1 );
function sslider_post_updated_messages( $messages ) {
	$messages['sangar_slider'][1]      = 'Slider updated. Press <b>Preview</b> button to see the result.';
	$messages['sangar_slider_post'][1] = 'Slider updated.';

	return $messages;
}

/**
 * admin_enqueue_scripts - equeue on addons custom post type
 */
add_action( 'admin_enqueue_scripts', 'sslider_admin_core_enqueue_scripts', 10, 1 );
function sslider_admin_core_enqueue_scripts( $hook ) {
	// enqueue on sangar_slider_admin page
	if ( $hook == 'toplevel_page_sangar_slider_admin' ) {
		// link with query string
		$query_string = str_replace( 'page=sangar_slider_admin', '', $_SERVER['QUERY_STRING'] );
		$url          = admin_url( 'admin.php?page=sangar_slider_admin' . $query_string );

		// remove query string
		$url = apply_filters( 'sangar_slider_delete_query', array( 'addon', $url ) );
		$url = apply_filters( 'sangar_slider_delete_query', array( 'delete', $url ) );
		$url = apply_filters( 'sangar_slider_delete_query', array( 'id', $url ) );

		// init admin_url
		echo "<script type='text/javascript'>";
		echo "var admin_url = '" . $url . "'; \r\n";
		echo '</script>';

		// lib jquery on WordPress
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );

		// sangar slider admin page script & style
		wp_enqueue_style( 'sslider-admin-page-css', plugin_dir_url( __FILE__ ) . 'assets/sangar-slider-admin-page.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-admin-page-js', plugin_dir_url( __FILE__ ) . 'assets/sangar-slider-admin-page.js', array(), SANGAR_SLIDER_VERSION );
	}

	// enqueue on sangar slider post editor
	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
		global $post, $post_type;

		// get all addons
		$sslider_addons = apply_filters( 'sangar_slider_addons', array() );

		if ( ! is_string( $post_type ) ) {
			return;
		}
		if ( ! array_key_exists( $post_type, $sslider_addons ) ) {
			return;
		}

		$http_proto = is_ssl() ? 'https://' : 'http://';
		$delete_url = admin_url( 'admin.php?page=sangar_slider_admin&delete=trash&id=' . $post->ID );

		// init base_url
		echo "<script type='text/javascript'>";
			echo "var base_url = '" . plugin_dir_url( __DIR__ ) . "'; \r\n";
			echo "var core_url = '" . plugin_dir_url( __FILE__ ) . "'; \r\n";
			echo "var http_proto = '" . $http_proto . "'; \r\n";
			echo "var post_delete_url = '" . $delete_url . "'; \r\n";
			echo "var tonjooGoogleFonts = new Object(); \r\n";

		foreach ( tonjooGoogleFonts::$fonts as $key => $value ) {
			echo "tonjooGoogleFonts['$key'] = '$value'; \r\n";
		}
		echo '</script>';

		// wp media
		wp_enqueue_media();
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-tooltip' );

		// general style & script
		wp_enqueue_style( 'sslider-admin-general-css', plugin_dir_url( __FILE__ ) . 'assets/sangar-slider-general.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-admin-general-js', plugin_dir_url( __FILE__ ) . 'assets/sangar-slider-general.js', array(), SANGAR_SLIDER_VERSION );

		// mustache &  sangar layer
		wp_enqueue_script( 'sslider-mustache-js', plugin_dir_url( __FILE__ ) . 'assets/mustache.min.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-layer-js', plugin_dir_url( __FILE__ ) . 'assets/sangar-layer.js', array(), SANGAR_SLIDER_VERSION );

		// minicolor
		wp_enqueue_style( 'sslider-minicolor-css', plugin_dir_url( __FILE__ ) . 'assets/jquery-minicolors/jquery.minicolors.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-minicolor-js', plugin_dir_url( __FILE__ ) . 'assets/jquery-minicolors/jquery.minicolors.js', array(), SANGAR_SLIDER_VERSION );

		// sangar buttons
		wp_enqueue_style( 'sslider-buttons-css', plugin_dir_url( __FILE__ ) . 'assets/sangar-buttons.css', array(), SANGAR_SLIDER_VERSION );

		// codemirror
		wp_enqueue_style( 'sslider-codemirror-css', plugin_dir_url( __FILE__ ) . 'assets/codemirror/codemirror.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-codemirror-js', plugin_dir_url( __FILE__ ) . 'assets/codemirror/codemirror.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-codemirror-xml-js', plugin_dir_url( __FILE__ ) . 'assets/codemirror/mode/xml/xml.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-codemirror-javascript-js', plugin_dir_url( __FILE__ ) . 'assets/codemirror/mode/javascript/javascript.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-codemirror-css-js', plugin_dir_url( __FILE__ ) . 'assets/codemirror/mode/css/css.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-codemirror-htmlmixed-js', plugin_dir_url( __FILE__ ) . 'assets/codemirror/mode/htmlmixed/htmlmixed.js', array(), SANGAR_SLIDER_VERSION );

		// sangarSlider packaged js. Loaded here too, just in case if some function need the slider js on add new
		// wp_enqueue_script('sslider-js',plugin_dir_url( __FILE__ )."assets/bower_components/sangar-slider/dist/js/sangarSlider-packaged.min.js",array(),SANGAR_SLIDER_VERSION);
		// velocity if there is no slider
		wp_enqueue_script( 'velocity', plugin_dir_url( __FILE__ ) . 'assets/velocity/velocity.min.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'velocity-ui', plugin_dir_url( __FILE__ ) . 'assets/velocity/velocity.ui.js', array(), SANGAR_SLIDER_VERSION );

		// wp-accordion
		wp_enqueue_style( 'sslider-wp-accordion-css', plugin_dir_url( __FILE__ ) . 'assets/wp-accordion/wp-accordion.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-wp-accordion-js', plugin_dir_url( __FILE__ ) . 'assets/wp-accordion/wp-accordion.js', array(), SANGAR_SLIDER_VERSION );

		// ddSlick
		wp_enqueue_script( 'sslider-ddslick-js', plugin_dir_url( __FILE__ ) . 'assets/jquery.ddslick.min.js', array(), SANGAR_SLIDER_VERSION );

		// select2
		wp_enqueue_style( 'sslider-select2-css', plugin_dir_url( __FILE__ ) . 'assets/select2/select2.css', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_script( 'sslider-select2-js', plugin_dir_url( __FILE__ ) . 'assets/select2/select2.min.js', array(), SANGAR_SLIDER_VERSION );

		// jQuery form
		wp_enqueue_script( 'sslider-jquery-form-js', plugin_dir_url( __FILE__ ) . 'assets/jquery.form.min.js', array(), SANGAR_SLIDER_VERSION );

		// Google webfont api
		wp_enqueue_script( 'sslider-webfont-js', 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js', array(), SANGAR_SLIDER_VERSION );

		// dialog style
		wp_enqueue_style( 'sslider-wp-jqueryui-dialog', plugin_dir_url( __FILE__ ) . 'assets/wp-jqueryui-dialog.css', array(), SANGAR_SLIDER_VERSION );

		// sangarico icon
		wp_enqueue_style( 'sslider-sangarico-css', plugin_dir_url( __FILE__ ) . 'assets/sangarico/style.css', array(), SANGAR_SLIDER_VERSION );
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'sslider_about_page' ) {
		wp_enqueue_script( 'sslider-admin-js', plugin_dir_url( __FILE__ ) . 'assets/admin-script.js', array(), SANGAR_SLIDER_VERSION );
		wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'sslider-admin-css', plugin_dir_url( __FILE__ ) . 'assets/admin-style.css', array(), SANGAR_SLIDER_VERSION );
	}
}

add_action( 'admin_menu', 'sslider_about_menu' );
function sslider_about_menu() {
	add_submenu_page(
		'sangar_slider_admin',
		'About Sangar Slider',
		'About Sangar Slider',
		'moderate_comments',
		'sslider_about_page',
		'sslider_about_page_callback'
	);
}
function sslider_about_page_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'about-page.php';
}

/**
 * Redirect to about page after plugin activated
 *
 * @param string $plugin Plugin name.
 */
function sslider_activation_redirect( $plugin ) {
	if ( 'sangar-slider-lite/sangar-slider-lite.php' === $plugin ) {
		wp_safe_redirect( admin_url( 'admin.php?page=sslider_about_page' ) );
		exit;
	}
	if ( 'sangar-slider/sangar-slider.php' === $plugin ) {
		wp_safe_redirect( admin_url( 'admin.php?page=sslider_about_page' ) );
		exit;
	}
}
add_action( 'activated_plugin', 'sslider_activation_redirect' );
