<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support('woocommerce');

//Disable the default WooCommerce stylesheet.
if(version_compare(WOOCOMMERCE_VERSION, "2.1") >= 0) {
	add_filter('woocommerce_enqueue_styles', '__return_false');
} else {
	define('WOOCOMMERCE_USE_CSS', false);
}

if(!function_exists('sienna_mikado_woocommerce_content')) {
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function sienna_mikado_woocommerce_content() {

		if(is_singular('product')) {

			while(have_posts()) : the_post();

				wc_get_template_part('content', 'single-product');

			endwhile;

		} else {

			if(have_posts()) :

				do_action('woocommerce_before_shop_loop');

				woocommerce_product_loop_start();

				woocommerce_product_subcategories();

				while(have_posts()) : the_post();

					wc_get_template_part('content', 'product');

				endwhile; // end of the loop.

				woocommerce_product_loop_end();

				do_action('woocommerce_after_shop_loop');

			elseif(!woocommerce_product_subcategories(array(
				'before' => woocommerce_product_loop_start(false),
				'after'  => woocommerce_product_loop_end(false)
			))
			) :

				wc_get_template('loop/no-products-found.php');

			endif;

		}
	}
}

//Define number of products per page
add_filter('loop_shop_per_page', 'sienna_mikado_woocommerce_products_per_page', 20);

//Set number of related products
add_filter('woocommerce_output_related_products_args', 'sienna_mikado_woocommerce_related_products_args');

//Overide Product List Loop Title
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'sienna_mikado_woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//Override Product List Loop Add To Cart
add_filter('woocommerce_loop_add_to_cart_link', 'sienna_mikado_woocommerce_loop_add_to_cart_link');

//Remove default link around whole product content in loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

//Single Product Title template override
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'sienna_mikado_woocommerce_template_single_title', 5);

//Single Product override tabs position
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

//Single product add social share)
add_action('woocommerce_share', 'sienna_mikado_woocommerce_share', 70);

//Sale flash template override
add_filter('woocommerce_sale_flash', 'sienna_mikado_woocommerce_sale_flash');

//Override Checkout Fields
add_filter('woocommerce_checkout_fields', 'sienna_mikado_custom_override_checkout_fields');

//Set Woocommerce button style
//Simple and grouped products
add_action('sienna_mikado_woocommerce_add_to_cart_button', 'sienna_mikado_get_woocommerce_add_to_cart_button');

//External product
add_action('sienna_mikado_woocommerce_add_to_cart_button_external', 'sienna_mikado_get_woocommerce_add_to_cart_button_external');

//Variable product
remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
add_action('woocommerce_single_variation', 'sienna_mikado_woocommerce_single_variation_add_to_cart_button', 20);

//Apply Coupon Button
add_action('sienna_mikado_woocommerce_apply_coupon_button', 'sienna_mikado_get_woocommerce_apply_coupon_button');

//Update Cart
add_action('sienna_mikado_woocommerce_update_cart_button', 'sienna_mikado_get_woocommerce_update_cart_button');

//Proceed To Checkout Button
remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
add_action('woocommerce_proceed_to_checkout', 'sienna_mikado_woocommerce_button_proceed_to_checkout', 20);

//Update Totals Button, Shipping Calculator
add_action('sienna_mikado_woocommerce_update_totals_button', 'sienna_mikado_get_woocommerce_update_totals_button');

//Pay For Order Button, Checkout page
add_filter('woocommerce_pay_order_button_html', 'sienna_mikado_woocommerce_pay_order_button_html');

//Place Order Button, Checkout page
add_filter('woocommerce_order_button_html', 'sienna_mikado_woocommerce_order_button_html');

//Replace default navigation on shop list
add_filter('woocommerce_pagination_args', 'sienna_mikado_alter_woo_pagination');

//add hover image in product loop
add_action('woocommerce_before_shop_loop_item_title', 'sienna_mikado_product_hover_image');

