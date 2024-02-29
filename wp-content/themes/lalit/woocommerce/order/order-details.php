<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}

$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();

$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
//$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
//$downloads             = $order->get_downloadable_items();
//$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
$actions = wc_get_account_orders_actions( $order );

/*if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}*/
?>
<section class="woocommerce-order-details">
	<div class="<?php if($current_endpoint == 'view-order') { ?>myaccount-order-product-detail<?php } else { ?>thankyou-order-item<?php } ?>">
		<?php
		if($current_endpoint == 'view-order') 
		{
		?>
		<div class="page-heading">
            <h2 class="card-info-title bdr-bottom">
                <span class="bdr-bottom-gold"><?php _e( 'Order Details', 'woocommerce' ); ?></span>
            </h2>
		</div>
		<div class="order-details-product">
			<p class="myaccount-order-no mob-order-no">Order No. <?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?></p>
			<?php
			if(isMobile())
			{
			?>
				<p class="myaccount-order-date mob-order-date">Ordered on <?php echo esc_html( date('jS M Y', strtotime($order->order_date) ) ); ?></p>
			<?php
			}
			else
			{
			?>
				<p class="myaccount-order-date mob-order-date">Ordered on <?php echo esc_html( date('jS M Y', strtotime($order->order_date) ) ); ?></p>
			<?php
			}
			?>
			<div class="myaccount-order-detail-link-section pull-right">
				<p class="myaccout-order-status mob-order-status">
					<?php

						$the_lalit_order_status = wc_get_order_status_name( $order->get_status() );
						if($the_lalit_order_status == 'Completed'){

							$the_lalit_order_status = 'Complete';
						}
					?>
					Status: <span class="order-detail-status"> <?php echo $the_lalit_order_status; ?></span>
				<?php
				foreach ( $actions as $key => $action ) 
				{
					if($key != 'view')
					{
				?>
				<a class="myaccount-order-detail-<?php echo $key; ?>" href="<?php echo esc_url( $action['url'] ); ?>"><?php echo esc_html( $action['name'] ); ?></a>
				<?php if($key != 'cancel') { ?>
					<span class="border-pay-cancel">|</span>
				<?php } ?>
				<?php
					}
				}
				?>
			</div>
		</div>
			<?php
			if(count($order_items) > 1)
			{
			?>
				<p class="myaccount-item-count"><?php echo count($order_items); ?> items</p>
			<?php
			}
			else
			{
			?>
				<p class="myaccount-item-count"><?php echo count($order_items); ?> item</p>
			<?php
			}
			?>
        <?php
    	}
    	else
    	{
    		if($current_endpoint != 'order-pay')
    		{
        ?>
				<h2 class="woocommerce-order-details__title"><?php _e( 'Order Summary', 'woocommerce' ); ?></h2>
		<?php
			}
		}
		?>
		<table class="woocommerce-table woocommerce-table--order-details shop_table order_details thankyou-order-details-table">

			<tbody>
				<?php
					foreach ( $order_items as $item_id => $item ) {
						$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

						if($product)
						{
							wc_get_template( 'order/order-details-item.php', array(
								'order'			     => $order,
								'item_id'		     => $item_id,
								'item'			     => $item,
								//'show_purchase_note' => $show_purchase_note,
								//'purchase_note'	     => $product ? $product->get_purchase_note() : '',
								'product'	         => $product,
							) );
						}
					}
				?>
				<?php do_action( 'woocommerce_order_items_table', $order ); ?>
			</tbody>
		</table>
	</div>

	<?php //do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

	<?php if ( $show_customer_details ) : ?>
		<?php wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) ); ?>
	<?php endif; ?>

</section>
