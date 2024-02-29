<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(!is_user_logged_in())
{
	wp_redirect(site_url('/my-account/'));
	exit;
}
else
{	  		
	if($order)
	{
		$customer_user_id = get_post_meta( $order->get_id(), '_customer_user', true );
		$current_user_id = get_current_user_id();
	
		if($current_user_id != $customer_user_id)
		{
			wp_redirect(site_url('/my-account/'));
			exit;
		}
	}
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : do_action('trigger_failed_email_to_admin', $order); ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><i class="ico-sprite sprite size-26 ico-close-with-circle error-message-icon"></i> <?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Try Again', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php elseif ( $order->has_status( 'processing' ) || $order->has_status( 'completed' ) ) : ?>
		<?php

		do_action('the_lalit_order_summary_check', $order);
		do_action('the_lalit_changed_order_status', $order);
		do_action('the_lalit_order_confirmed_email', $order);
		
		$contains_virtual = false;
		if(false === $order->needs_shipping_address() )
		{
			$contains_virtual = true;
		}
		?>
				<div class="thankyou-header-container">
					<div class="thankyou-header-section">
						<i class="sprite ico-check-with-circle size-40"></i><h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received thankyou-header"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Your order is placed. Thank you!', 'woocommerce' ), $order ); ?></h2>
					</div>
					<div class="thankyou-order-description">
						<p class="woocommerce-order-overview__order order thankyou-orderno">
							<?php _e( '<strong>Order Number : </strong>', 'woocommerce' );  
								echo $order->get_order_number(); ?>
						</p>
						<p class="thankyou-send-voucher">
							<strong>Thank you for placing your order with The LaLiT!</strong>
						</p>
						<?php
						if($contains_virtual)
						{
						?>
							<p class="thankyou-note">Please find your Voucher(s) below, we have sent these to your registered email address with the order conformation.</p>
							<p class="thankyou-note">Please note the Redemption instructions you will need to follow to redeem your Voucher at the appropriate venue.</p>
						<?php
						}
						else
						{
						?>
							<p class="thankyou-note">We have sent a copy of the order confirmation to your registered email address in case you need to refer to it.</p>
						<?php
						}
						?>
						<p class="thankyou-note">You can also access this order from <strong><a class="thankyou-myorder-link" href="<?php echo site_url()?>/my-account/orders" target="_blank">My Orders</a></strong> section of the website.</p>
						<!-- <a class="thankyou-account-link" href="/my-account/">My Account</a> -->

						<!-- <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<li class="woocommerce-order-overview__order order">
								<?php //_e( 'Order number:', 'woocommerce' ); ?>
								<strong><?php //echo $order->get_order_number(); ?></strong>
							</li>

							<li class="woocommerce-order-overview__date date">
								<?php //_e( 'Date:', 'woocommerce' ); ?>
								<strong><?php //echo wc_format_datetime( $order->get_date_created() ); ?></strong>
							</li>

							<li class="woocommerce-order-overview__total total">
								<?php //_e( 'Total:', 'woocommerce' ); ?>
								<strong><?php //echo $order->get_formatted_order_total(); ?></strong>
							</li>

							<?php //if ( $order->get_payment_method_title() ) : ?>

							<li class="woocommerce-order-overview__payment-method method">
								<?php //_e( 'Payment method:', 'woocommerce' ); ?>
								<strong><?php //echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
							</li>

							<?php //endif; ?>

						</ul> -->
					</div>
				</div>

		<?php endif; ?>
		<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() );?>
		<?php do_action('the_lalit_change_user_details', $order); ?>

	<?php else : ?>

		<!--<div class="thankyou-header-container">
			<div class="thankyou-header-section">
				<i class="sprite ico-check-with-circle size-40"></i><h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received thankyou-header"><?php //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></h2>
			</div>
		</div>-->

		<div class= "woocommerce-error error-message-woocommerce">
			Invalid Order.
		</div>

	<?php endif; ?>

</div>
