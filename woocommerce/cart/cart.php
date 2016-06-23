<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="shop_table shop_table_responsive cart">
	<h2>Shopping Cart</h2>
	<div class="row thead">
		<div class="col-xs-1 product-quantity text-center"><strong>Qty.</strong></div>
		<div class="col-xs-7 product-name"><strong>Item</strong></div>
		<div class="col-xs-2 product-subtotal"><strong>Price</strong></div>
		<div class="col-xs-2 product-remove"><strong>Remove</strong></div>
	</div>

	<?php do_action( 'woocommerce_before_cart_contents' ); ?>

	<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>"
						data-product_sku="<?php echo esc_attr($_product->get_sku()); ?>">

					<div class="col-xs-1 text-center product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = $cart_item['quantity'];
							}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</div>

					<div class="col-xs-7 product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $_product->is_visible() ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								$_product_name = sprintf( '%s<br><span class="shortdesc-shipping">%s</span>', $_product->get_title(), $_product->post->post_excerpt );
								if($_product->get_price() == '3.99'){
									$_product_name = sprintf( '<strong>%s<br><span class="shortdesc-shipping">%s</span></strong>', $_product->get_title(), $_product->post->post_excerpt );
								}


								echo apply_filters( 'woocommerce_cart_item_name', $_product_name, $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );
						?>
					</div>

					<div class="col-xs-2 product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</div>

					<div class="col-xs-2 product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s" name="%s">&times;</a>',
						esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
						__( 'Remove this item', 'woocommerce' ),
						esc_attr( $product_id ),
						esc_attr( $_product->get_sku() ),
						$cart_item_key), $cart_item_key );
						?>
					</div>
				</div>
				<?php
			}
		}
	do_action( 'woocommerce_cart_contents' );
	?>
		<div class="row">

			<?php if ( wc_coupons_enabled() ) { ?>
			<div class="coupon col-md-offset-7 col-md-5 ">
				<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Promo Code', 'woocommerce' ); ?>" />
				<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />

				<?php do_action( 'woocommerce_cart_coupon' ); ?>
			</div>
			<?php } ?>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>

	<?php do_action( 'woocommerce_after_cart_contents' ); ?>
</div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
