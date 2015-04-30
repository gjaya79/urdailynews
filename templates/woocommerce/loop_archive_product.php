<?php
global $post, $woocommerce, $product;
 
$placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
$placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );

$output = '<div class="woo-image"><a href="' . get_permalink() . '">';
$output .= has_post_thumbnail() ? get_the_post_thumbnail( $post->ID, 'shop_catalog' ) : '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="" height="" />'; 
$output .= '<span class="woo-over"></span>';
$output .= '<div class="woo-info"></a>' . 

apply_filters( 'woocommerce_loop_add_to_cart_link',
sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>',
	esc_url( $product->add_to_cart_url() ),
	esc_attr( $product->id ),
	esc_attr( $product->get_sku() ),
	$product->is_purchasable() ? 'add_to_cart_button' : '',
	esc_attr( $product->product_type ),
	esc_html( $product->add_to_cart_text() )
), $product ) . '</div>';

$output .= '</div>';

echo $output;
?>