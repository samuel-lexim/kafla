<?php
/**
 * Single Product Image
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.14
 */

if(!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$gallery_class = '';
$gallery_ids = sienna_mikado_get_product_gallery_ids();

$has_gallery = is_array($gallery_ids) && count($gallery_ids);

?>
<div class="mkdf-single-product-images <?php if($has_gallery) { echo 'mkdf-single-product-with-gallery'; } ?>">
    <div class="images">
        <div class="mkdf-image">
            <?php
            if(has_post_thumbnail()) {

                $image_title   = esc_attr(get_the_title(get_post_thumbnail_id()));
                $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
                $image_link    = wp_get_attachment_url(get_post_thumbnail_id());
                $image         = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                    'title' => $image_title,
                    'alt'   => $image_title
                ));

                $attachment_count = count($product->get_gallery_attachment_ids());

                if($attachment_count > 0) {
                    $gallery = '[product-gallery]';
                } else {
                    $gallery = '';
                }

                echo apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto'.$gallery.'">%s</a>', $image_link, $image_caption, $image), $post->ID);

            } else {

                echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__('Placeholder', 'sienna')), $post->ID);

            }
            ?>
        </div>

        <div class="mkdf-thumbnails">
            <?php do_action('woocommerce_product_thumbnails'); ?>
        </div>
    </div>
</div>