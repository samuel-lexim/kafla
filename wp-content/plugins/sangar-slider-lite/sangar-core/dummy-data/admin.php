<?php

require_once( plugin_dir_path( __FILE__ ) . 'class.php');
require_once( plugin_dir_path( __FILE__ ) . 'data-post.php');
require_once( plugin_dir_path( __FILE__ ) . 'data-product.php');

$sslider_addons = apply_filters('sangar_slider_addons',array());

$type = isset($_GET['type']) ? $_GET['type'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// filter type
if($type != 'post' && $type != 'product') $type = '';

// do if all exist
if($type != '' && $action != '')
{
	$taxonomy = $type == 'post' ? 'category' : 'product_cat';
	$class = new ssliderDummyPost($type,$taxonomy);

	// do loading
	echo '<div class="wrap"><h2>Loading...</div></div>';

	// do by action
	switch ($action) 
	{
		case 'import':
			$class->insert();
			break;

		case 'delete':
			$class->delete();
			break;
		
		default:
			// silent
			break;
	}

	// do redirect
	$location = admin_url("admin.php?page=sslider_import_dummy_data") . '&settings-updated=true';
	echo "<meta http-equiv='refresh' content='0;url=$location' />";
	exit();
}

?>

<div class="wrap">
	<?php echo "<h2>".__("Import Dummy Data ",SANGAR_SLIDER)."</h2>"; ?>
	<p><?php _e('Pemember, all imported data will go into <code>post</code> post type. You can remove dummy post if needed.',SANGAR_SLIDER); ?></p>
	<hr />

	<?php $permalink = admin_url('admin.php?page=sslider_import_dummy_data') ?>

	<h3>Status</h3>
	<?php ssliderDummyPost::status() ?>

	<!-- Post Dummy Data -->
	<?php if(isset($sslider_addons['sangar_slider_post'])): ?>

	<h3>Post Dummy Data</h3>
	<a class="button" href="<?php echo $permalink . '&type=post&action=import' ?>">Import</a>
	<a class="button" href="<?php ssliderDummyPost::get_dummy_slider_link('post') ?>">View</a>
	<a class="button" href="<?php echo $permalink . '&type=post&action=delete' ?>">Delete</a>

	<br />

	<?php endif ?>

	<!-- Product Dummy Data -->
	<?php if(isset($sslider_addons['sangar_slider_shop'])): ?>

	<h3>Product Dummy Data</h3>
	<a class="button" href="<?php echo $permalink . '&type=product&action=import' ?>">Import</a>
	<a class="button" href="<?php ssliderDummyPost::get_dummy_slider_link('product') ?>">View</a>
	<a class="button" href="<?php echo $permalink . '&type=product&action=delete' ?>">Delete</a>

	<?php endif ?>
</div>
