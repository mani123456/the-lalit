<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
	<div class="row">

		<?php if ( $checkout->get_checkout_fields() ) : ?>
			<div class="col col6">
				<div class="col2-set" id="customer_details">
					<div class="col-1">
						<?php
						//if ( false === WC()->cart->needs_shipping() )
						//{
						 	do_action( 'woocommerce_checkout_billing' ); 
						//}
						?>
					</div>

					<div class="col-2">
						<?php
						//if ( true === WC()->cart->needs_shipping() )
						//{
							do_action( 'woocommerce_checkout_shipping' ); 
						//}
						?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php 
				if(isMobile())
				{
				?>
					<div class="col col6">
						<div class="order-review-checkout">
							<h3 id="order_review_heading" class="order-review-title"><?php _e( 'Order Summary', 'woocommerce' ); ?></h3>

								<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

									<div id="order_review" class="woocommerce-checkout-review-order checkout-order-review">
										<?php do_action( 'woocommerce_checkout_order_review' ); ?>
									</div>

									<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
						<!--<a class="checkout-continue-shopping" href="192.168.0.175:8085/products/the-lalit-delhi">Continue Shopping</a>-->
					</div><!-- col col6 -->
				<?php
				}
				?>

				<div class="form-row place-order">
					<noscript>
						<?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
						<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" />
					</noscript>

					<?php wc_get_template( 'checkout/terms.php' ); ?>

					<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
					<?php $order_button_text = 'Pay Now'; ?>

					<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt checkout-submit" name="woocommerce_checkout_place_order" id="place_order" value="'.$order_button_text.'" data-value="'.$order_button_text.'" />' ); ?>

					<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

					<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
				</div>
			</div><!-- col col6 -->
		<?php endif; ?>

		<?php
		if(!isMobile())
		{
		?>
			<div class="col col6">
				<div class="order-review-checkout">
					<h3 id="order_review_heading" class="order-review-title"><?php _e( 'Order Summary', 'woocommerce' ); ?></h3>

						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

							<div id="order_review" class="woocommerce-checkout-review-order checkout-order-review">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							</div>

							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</div>
				<!-- <a class="checkout-continue-shopping" href="192.168.0.175:8085/products/the-lalit-delhi">Continue Shopping</a> -->
			</div><!-- col col6 -->
		<?php
		}
		?>
	</div><!-- row -->
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>