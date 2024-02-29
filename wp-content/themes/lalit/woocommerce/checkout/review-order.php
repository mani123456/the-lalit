<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="shop_table checkout-review-order-table">
	<!-- <thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead> -->
	<tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					
					if($_product->parent->id && isset($cart_item['variation']) && count($cart_item['variation']) > 0)
					{
						$product_id = $_product->parent->id;

					}
					else
					{
						$product_id = $_product->get_id();
					}
					$product_display_name = get_post_meta( $product_id, 'woocommerce_product_display_name', true );

					$hotel_id = get_post_meta($product_id, 'hotel_product', true);
					$hote_name = get_the_title($hotel_id[0]);
					?>
					<!-- <tr class="<?php //echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-name">
							<?php //echo apply_filters( 'woocommerce_cart_item_name', $product_display_name, $cart_item, $cart_item_key ) . '&nbsp;'; ?>
							<?php //echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
							<?php //echo WC()->cart->get_item_data( $cart_item ); ?>
						</td>
						<td class="product-total">
							<?php //echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
					</tr> -->


					<tr>
						<td class="product-thumbnail checkout-product-image">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								echo $thumbnail;
							?>
						</td>
						<td class="order-review-content">
							<h6 class="product-hotel"><?php echo $hote_name; ?></h6>
							<span class="product-name" ><?php echo apply_filters( 'woocommerce_cart_item_name', $product_display_name, $cart_item, $cart_item_key ) . '&nbsp;'; ?></span>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							<div class="order-qty-row">
								<label for="checkout-quantity" class="checkout-quantity">Qty: </label> <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity checkout-order-product">' .$cart_item['quantity']. '</span>', $cart_item, $cart_item_key ); ?>
								<label for="checkout-subtotal-order" class="checkout-subtotal-order">Total: </label><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</div>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal order-review-subtotal">
			<td class="order-review-subtotal-header"><?php _e( 'Subtotal', 'woocommerce' ); ?></td>
			<td class="order-review-total"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<td class="order-review-subtotal-header"><?php wc_cart_totals_coupon_label( $coupon ); ?></td>
			<td class="order-review-total"><?php lalit_checkout_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<td class="order-review-subtotal-header"><?php echo esc_html( $fee->name ); ?></td>
				<td class="order-review-total"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<td class="order-review-tax-header"><?php echo esc_html( $tax->label ); ?></td>
						<td class="order-review-tax-total"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<td class="order-review-tax-header"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></td>
					<td class="order-review-tax-total"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total checkout-order-total">
		<td class="order-review-subtotal-header"><?php _e( 'Grand Total', 'woocommerce' ); ?></td>
		<td class="order-review-total"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
</table>
