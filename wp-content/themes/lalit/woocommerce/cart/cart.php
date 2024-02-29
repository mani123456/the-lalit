<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents woocommerce-cart-table" cellspacing="0">
		<thead>
			<tr class="cart-header-row">
				<th class="product-thumbnail cart-product-header align-left"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-name">&nbsp;</th>
				<!-- <th class="product-remove">&nbsp;</th> -->
				<th class="product-price cart-product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity cart-product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal cart-product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody class="cart-table-body">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item cart-product-row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-thumbnail cart-product-image <?php if(isMobile()) { ?>mob-landscape<?php } ?>">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
							?>
						</td>

						<?php
						if(isMobile())
						{
						?>
						<td class="product-thumbnail cart-product-image mob-portrait">
							<?php
								$thumbnail = $_product->get_image( 'shop_catalog' );
								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
							?>
						</td>
						<?php
						}
						?>
						
						<td class="cart-product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<div class="product-name">
								<?php

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
										<h6 class="product-hotel"><?php echo $hote_name; ?></h6>
								<?php
								
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $product_display_name, $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_display_name ), $cart_item, $cart_item_key );
									}

									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
							</div>
							<div class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</div>
						</td>
						
						<td class="product-price cart-product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity cart-product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" min="1"/>', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->get_max_purchase_quantity(),
										'min_value'   => '1',
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
							?>
						</td>

						<td class="product-subtotal cart-product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>
		</tbody>
	</table>
	<table class="cart-collaterals-subtotal">
		<tbody>
			<tr class="clearfix collaterals-subtotal">
				<td class="actions coupon-action">
					<div class="cart-collaterals">
						<?php
							/**
							* the_lalit_cross_sells hook.
							*
							* @hooked woocommerce_cross_sell_display
							*/
							do_action( 'the_lalit_cross_sells' );
						?>
					</div>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); 
						/**
						* the_lalit_display_destinations hook.
						*
						* @hooked the_lalit_display_destinations_callback
						*/
						do_action('the_lalit_display_destinations');
					?>
				</td>

				<td class="subtotal-action">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon cart-coupon">
							<a class="cart-coupon-label"><?php _e( 'Have a coupon code?', 'woocommerce' ); ?></a> 
							<div class="coupon-container">
								<div class="fluidRow">
									<div class="col col7">
										<input type="text" name="coupon_code" class="input-text cart-coupon-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter Coupon Code', 'woocommerce' ); ?>" /> 
									</div>
									<div class="col col5">
										<input type="submit" class="button cart-coupon-submit" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
									</div>
								</div>
							</div><!-- coupon-container -->	
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<input type="submit" class="button cart-update" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" />
					<?php

						/**
						* the_lalit_display_subtotals hook.
						*
						* @hooked woocommerce_cart_totals - 10
						*/
						do_action( 'the_lalit_display_subtotals');
					?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php
do_action( 'woocommerce_after_cart' );
?>