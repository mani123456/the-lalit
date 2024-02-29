<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
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
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();
?>
<section class="woocommerce-customer-details">

	<!--<h2><?php //_e( 'Customer details', 'woocommerce' ); ?></h2>-->

	<!--<table class="woocommerce-table woocommerce-table-customer-details shop_table customer_details">-->

		<?php //if ( $order->get_customer_note() ) : ?>
			<!--<tr>
				<th><?php //_e( 'Note:', 'woocommerce' ); ?></th>
				<td><?php //echo wptexturize( $order->get_customer_note() ); ?></td>
			</tr>-->
		<?php //endif; ?>

		<?php //if ( $order->get_billing_email() ) : ?>
			<!--<tr>
				<th><?php //_e( 'Email:', 'woocommerce' ); ?></th>
				<td><?php //echo esc_html( $order->get_billing_email() ); ?></td>
			</tr>-->
		<?php //endif; ?>

		<?php //if ( $order->get_billing_phone() ) : ?>
			<!--<tr>
				<th><?php //_e( 'Phone:', 'woocommerce' ); ?></th>
				<td><?php //echo esc_html( $order->get_billing_phone() ); ?></td>
			</tr>-->
		<?php //endif; ?>

		<?php //do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

	<!--</table>-->

	<?php
	$contains_shipping_address = false;
	if(true === $order->needs_shipping_address() )
	{
		$contains_shipping_address = true;
	}
	/*foreach ( $order->get_items() as $item_id => $item ) 
	{
		$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
		if($product->is_type('simple') && !$product->is_virtual())
		{
			$contains_shipping_address = true;
		}
	}*/
	?>


	<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
		<?php //if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
			<div class="container">
				<div class="row">
					<?php
					if(isMobile())
					{
					?>
						<div class="col col4">
							<table>
								<tbody class="thankyou-subtotal-container">
									<?php
										$grand_total = '';
										foreach ( $order->get_order_item_totals() as $key => $total ) 
										{
											$total['label'] = substr(trim($total['label']), 0, -1);			
											if($total['label'] != 'Total')
											{
									?>
												<tr>
									<?php
													if($total['label'] == 'Subtotal')
													{
									?>
														<td class="thankyou-subtotal-header thankyou-subtotal">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price thankyou-subtotal-price"><?php echo $total['value']; ?></td>
									<?php
													}
													else if($total['label'] == 'Discount')
													{
														$total['label'] = 'Coupon discount';
									?>
														<td class="thankyou-subtotal-header thankyou-coupon">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price thankyou-coupon-price"><?php echo $total['value']; ?></td>
									<?php
													}
													else if($total['label'] == 'Payment method' && ($order->has_status( 'processing' ) || $order->has_status('completed') || $order->has_status( 'failed' ) || $order->has_status( 'pending' ) || $order->has_status( 'cancelled' ) ))
													{
														if($current_endpoint != 'order-pay')
														{
															if($order->has_status( 'pending' ))
															{
																
															}
															else
															{	
																$payment_method = get_post_meta($order->get_id(), 'Payment type', true);
																if($payment_method)
																{
									?>					
																	<td class="thankyou-subtotal-header">
																		<?php echo $total['label']; ?>
																	</td>
																	<td class="thankyou-price"><?php if($payment_method) { echo $payment_method; } else { echo $total['value']; } ?></td>
									<?php
																}
									
															}
														}
													}
													else
													{
									?>				
														<td class="thankyou-subtotal-header">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price"><?php echo $total['value']; ?></td>
									<?php
													}
									?>
												</tr>
									<?php
											}
											else
											{
												$grand_total = $total['value'];
											}
										}
									?>
								</tbody>
								<tfoot>
									<tr class="thankyou-grand-total-row">
										<td class="thankyou-subtotal-header thankyou-grand-total">Grand Total</td>
										<td class="thankyou-price thankyou-total-price"><?php echo $grand_total; ?></td>
									</tr>
								</tfoot>
							</table>
						</div><!-- col col6 -->

						<div class="col col6">
							<div class="row">
								<?php
								if($contains_shipping_address == false)
								{
									if($order->get_formatted_billing_address())
									{	
								?>
										<div class="col col6">
											<h5 class="customer-section-header"><?php _e( 'Billing address', 'woocommerce' ); ?></h5>
											<p class="customer-address">
												<?php 
													echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); 
												?>
												<br/>
												<?php
												if($order->billing_country == 'IN')
												{
													echo WC()->countries->countries[$order->billing_country];
													echo '<br/>';
												}
												?>
												Tel: <?php echo esc_html( $order->get_billing_phone() ); ?>
											</p> 
										</div><!-- col col6 -->
								<?php
									}
								}

								if($contains_shipping_address == true)
								{	
									if($order->get_formatted_shipping_address())
									{		
								?>
										<div class="col col6">
											<h5 class="customer-section-header"><?php _e( 'Shipping address', 'woocommerce' ); ?></h5>
											<p class="customer-address">
												<?php 
													echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); 
												?>
												<br/>
												<?php
												if($order->shipping_country == 'IN')
												{
													echo WC()->countries->countries[$order->shipping_country];
													echo '<br/>';
												}
												?>
												Tel: <?php echo esc_html(get_post_meta(  $order->id, 'shipping_phone', true )); 
												?>
											</p> 
										</div><!-- col col6 -->
								<?php
									}
								}
								?>
							</div><!-- row -->
						</div><!-- col col6 -->
					<?php
					}
					else
					{
					?>
						<div class="col col6">
							<div class="row">
								<?php
								if($contains_shipping_address == false)
								{
									if($order->get_formatted_billing_address())
									{	
								?>
										<div class="col col6">
											<h5 class="customer-section-header"><?php _e( 'Billing address', 'woocommerce' ); ?></h5>
											<p class="customer-address">
												<?php 
													echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); 
												?>
												<br/>
												<?php
												if($order->billing_country == 'IN')
												{
													echo WC()->countries->countries[$order->billing_country];
													echo '<br/>';
												}
												?>
												Tel: <?php echo esc_html( $order->get_billing_phone() ); ?>
											</p> 
										</div><!-- col col6 -->
								<?php
									}
								}

								if($contains_shipping_address == true)
								{	
									if($order->get_formatted_shipping_address())
									{		
								?>
										<div class="col col6">
											<h5 class="customer-section-header"><?php _e( 'Shipping address', 'woocommerce' ); ?></h5>
											<p class="customer-address">
												<?php 
													echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); 
												?>
												<br/>
												<?php
												if($order->shipping_country == 'IN')
												{
													echo WC()->countries->countries[$order->shipping_country];
													echo '<br/>';
												}
												?>
												Tel: <?php echo esc_html(get_post_meta(  $order->id, 'shipping_phone', true )); 
												?>
											</p> 
										</div><!-- col col6 -->
								<?php
									}
								}
								?>

							</div><!-- row -->
						</div><!-- col col6 -->

						<div class="col <?php if(isIPad()) { ?>col5<?php } else { ?>col4<?php } ?>">
							<table>
								<tbody class="thankyou-subtotal-container">
									<?php
										$grand_total = '';
										foreach ( $order->get_order_item_totals() as $key => $total ) 
										{
											$total['label'] = substr(trim($total['label']), 0, -1);			
											if($total['label'] != 'Total')
											{
									?>
												<tr>
									<?php
													if($total['label'] == 'Subtotal')
													{
									?>
														<td class="thankyou-subtotal-header thankyou-subtotal">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price thankyou-subtotal-price"><?php echo $total['value']; ?></td>
									<?php
													}
													else if($total['label'] == 'Discount')
													{
														$total['label'] = 'Coupon discount';
									?>
														<td class="thankyou-subtotal-header thankyou-coupon">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price thankyou-coupon-price"><?php echo $total['value']; ?></td>
									<?php
													}
													else if($total['label'] == 'Payment method' && ($order->has_status( 'processing' ) || $order->has_status('completed') || $order->has_status( 'failed' ) || $order->has_status( 'pending' ) || $order->has_status( 'cancelled' ) ))
													{
														if($current_endpoint != 'order-pay')
														{
															if($order->has_status( 'pending' ))
															{
																
															}
															else
															{	
																$payment_method = get_post_meta($order->get_id(), 'Payment type', true);
																if($payment_method)
																{
									?>					
																	<td class="thankyou-subtotal-header">
																		<?php echo $total['label']; ?>
																	</td>
																	<td class="thankyou-price"><?php if($payment_method) { echo $payment_method; } else { echo $total['value']; } ?></td>
									<?php
																}
									
															}
														}
													}
													else
													{
									?>				
														<td class="thankyou-subtotal-header">
															<?php echo $total['label']; ?>
														</td>
														<td class="thankyou-price"><?php echo $total['value']; ?></td>
									<?php
													}
									?>
												</tr>
									<?php
											}
											else
											{
												$grand_total = $total['value'];
											}
										}
									?>
								</tbody>
								<tfoot>
									<tr class="thankyou-grand-total-row">
										<td class="thankyou-subtotal-header thankyou-grand-total">Grand Total</td>
										<td class="thankyou-price thankyou-total-price"><?php echo $grand_total; ?></td>
									</tr>
								</tfoot>
							</table>
						</div><!-- col col6 -->
					<?php
					}
					?>
				</div><!-- row -->
			</div><!-- container -->
		<?php //endif; ?>
	</section>

</section>