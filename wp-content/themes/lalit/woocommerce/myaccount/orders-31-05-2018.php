<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<!--<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php //foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php //echo esc_attr( $column_id ); ?>"><span class="nobr"><?php //echo esc_html( $column_name ); ?></span></th>
				<?php //endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php //foreach ( $customer_orders->orders as $customer_order ) :
				//$order      = wc_get_order( $customer_order );
				//$item_count = $order->get_item_count();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php //echo esc_attr( $order->get_status() ); ?> order">
					<?php //foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php //echo esc_attr( $column_id ); ?>" data-title="<?php //echo esc_attr( $column_name ); ?>">
							<?php //if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php //do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php //elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php //echo esc_url( $order->get_view_order_url() ); ?>">
									<?php //echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</a>

							<?php //elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php //echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php //echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php //elseif ( 'order-status' === $column_id ) : ?>
								<?php //echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php //elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								//printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
								?>

							<?php //elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								//$actions = wc_get_account_orders_actions( $order );
								
								//if ( ! empty( $actions ) ) {
									//foreach ( $actions as $key => $action ) {
										//echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									//}
								//}
								?>
							<?php //endif; ?>
						</td>
					<?php //endforeach; ?>
				</tr>
			<?php //endforeach; ?>
		</tbody>
	</table>-->

	<?php
	if(isMobile())
	{
	?>
		<div class="order-dashboard-section">
			<div class="page-heading">
				<h2 class="personal-details-header bdr-bottom"><span class="bdr-bottom-gold">My Orders</span></h2>
			</div>

			<?php foreach ( $customer_orders->orders as $customer_order )
			{
				$order  = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
				$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
				$actions = wc_get_account_orders_actions( $order );
			?>
				<div class="myaccount-order">
					<div class="myaccount-order-details">
						<div class="myaccount-order-content clearfix">
							<div class="myaccount-order-no-section">
								<p class="myaccount-order-no">
									Order No. <?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</p>
								<p class="myaccount-order-date">Ordered on <?php echo esc_html( date('jS M Y', strtotime($order->order_date) ) ); ?></p>
							</div>
							<div class="myaccount-order-date-section">
								<p class="myaccount-order-price">Order Total <?php echo $order->get_formatted_order_total(); ?></p>
								<?php

									$the_lalit_order_status = wc_get_order_status_name( $order->get_status() );
									if($the_lalit_order_status == 'Completed'){

										$the_lalit_order_status = 'Complete';
									}
								?>
								<p class="myaccount-order-status">Status: <span class="order-detail-status"> <?php echo $the_lalit_order_status; ?></span>
								<p class="myaccout-order-pay-cancel">
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
								</p>
							</div>
						</div>
					</div>

					<div class="myaccount-order-section">
						<?php
						foreach ( $order_items as $item_id => $item ) 
						{
							$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
							
							if($product)
							{
								if($product->parent->id || $product->is_type( 'variable' ))
								{
									$product_id = $product->parent->id;

								}
								else
								{
									$product_id = $product->get_id();
								}
								$product_display_name = get_post_meta( $product_id, 'woocommerce_product_display_name', true );
								$hotel_id = get_post_meta($product_id, 'hotel_product', true);
								$hotel_name = get_the_title($hotel_id[0]);
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $item ) : '', $item, $item_id );

								$quantity = $item->get_quantity();
								$thumbnail_portrait = $product->get_image( 'shop_catalog' );
								$thumbnail_landscape = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $item, $item_id );

								if(count($order_items) > 1) { $class = "myaccount-order-container"; } else { $class = "myaccount-single-order"; }
						?>
								<div class="<?php echo $class; ?>">
									<div class="myaccount-order-image mob-portrait">
										<?php
										if($product_permalink)
										{
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail_portrait ); 
										}
										else
										{
											echo $thumbnail_portrait;
										}
										?>
									</div>
									<div class="myaccount-order-image mob-landscape">
										<?php 
										if($product_permalink)
										{
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail_landscape );
										}
										else
										{
											echo $thumbnail_landscape;
										}
										?>
									</div>
									<div class="myaccount-order-hotel-product">
										<h6 class="myaccount-order-hotel-name"><?php echo strtoupper($hotel_name); ?></h6>
										<a class="myaccount-order-product-name" href="<?php if($product_permalink) { echo $product_permalink; } else { echo 'javascript:void(0);'; } ?>"><?php echo $product_display_name; ?></a>
										<?php echo wc_display_item_meta( $item ); ?>
									</div>
									<div class="myaccount-order-quantity">
										<p class="myaccount-order-quantity-no">Qty: <?php echo sprintf( $quantity ); ?></p>
									</div>
									<div class="myaccount-order-price-section">
										<p class="myaccount-order-price-detail">
											<?php echo $order->get_formatted_line_subtotal( $item ); ?>
										</p>
									</div>
									<?php
									if( ( $product->is_virtual() || $product->is_type( 'variable' ) ) && ( $order->has_status( 'completed' ) || $order->has_status( 'processing' ) )  )
									{	
										$voucher_path = '';
										$voucher_codes_array = json_decode( get_post_meta( $order->get_order_number(), 'the_lalit_vouchers_details', true ), true );

										if($voucher_codes_array) 
										{
											foreach ($voucher_codes_array as $products) 
											{
												foreach ($products as $order_product) 
												{
													if(array_key_exists('variation_id', $order_product))
													{
														if($order_product['variation_id'] == $product->get_variation_id())
														{

															$voucher_path .= $order_product['voucher_path'].' | ';
														}
													}
													else
													{
														if($order_product['product_id'] == $product_id)
														{

															$voucher_path .= $order_product['voucher_path'].' | ';
														}
													}
												}
											}
											$voucher_path = rtrim($voucher_path, ' | ');
											if($voucher_path)
											{
									?>
												<div class="myaccount-order-print">
													<a class="myaccount-order-print-link" href="javascript:void(0);" data-item="<?php echo $voucher_path; ?>"><?php if($quantity > 1) { ?>Print Vouchers <?php } else { ?> Print Voucher <?php } ?></a>
												</div>
									
									<?php
											}
										}
									}
									?>
								</div>
							
						<?php
							}
						}
						?>
						<a class="myaccount-order-detail-link" href="<?php echo esc_url( $order->get_view_order_url() ); ?>">Order Details</a>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	<?php
	}
	else
	{
	?>
		<div class="order-dashboard-section">
			<div class="page-heading">
				<h2 class="personal-details-header bdr-bottom"><span class="bdr-bottom-gold">My Orders</span></h2>
			</div>

			<?php foreach ( $customer_orders->orders as $customer_order )
			{
				$order  = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
				$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
				$actions = wc_get_account_orders_actions( $order );
			?>
				<div class="myaccount-order">
					<div class="myaccount-order-details clearfix">
						<div class="myaccount-order-content pull-left">
							<div class="myaccount-order-no-section">
								<p class="myaccount-order-no">
									Order No. <?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</p>
							</div>
							<div class="myaccount-order-date-section">
								<?php
								if(isIPad())
								{
								?>
									<p class="myaccount-order-date">Ordered on <?php echo esc_html( date('jS M Y', strtotime($order->order_date) ) ); ?></p>
								<?php
								}
								else
								{
								?>
									<p class="myaccount-order-date">Ordered on <?php echo esc_html( date('jS M Y', strtotime($order->order_date) ) ); ?></p>
								<?php
								}
								?>
								<p class="myaccount-order-price">Order Total <?php echo $order->get_formatted_order_total(); ?></p>
							</div>
						</div>
						<div class="myaccount-order-detail-link-section pull-right">
							<?php
							if(isIPad())
							{
							?>
							<p class="ipad-portrait-sec" style="display:none;">
							<?php
								if($actions)
								{
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
								}
							?>
							</p>
							<?php
							}
							?>
							<p class="myaccout-order-status">
								<?php

									$the_lalit_order_status = wc_get_order_status_name( $order->get_status() );
									if($the_lalit_order_status == 'Completed'){

										$the_lalit_order_status = 'Complete';
									}
								?>
								Status: <span class="order-detail-status"> <?php echo $the_lalit_order_status; ?></span>
								<?php
								if($actions)
								{		
									foreach ( $actions as $key => $action ) 
									{
										if($key != 'view')
										{
								?>
									<a class="myaccount-order-detail-<?php echo $key; ?> <?php if(isIPad()) { ?>ipad-landscape-sec<?php } ?>" href="<?php echo esc_url( $action['url'] ); ?>" <?php if(isIpad()) { ?> style="display:none;" <?php } ?> ><?php echo esc_html( $action['name'] ); ?></a>
									<?php if($key != 'cancel') { ?>
										<span class="border-pay-cancel <?php if(isIPad()) { ?>ipad-landscape-sec<?php } ?>" <?php if(isIpad()) { ?> style="display:none;" <?php } ?>>|</span>
									<?php } ?>
								<?php
										}
									}	
								}
								?>
								
							<a class="myaccount-order-detail-link" href="<?php echo esc_url( $order->get_view_order_url() ); ?>">Order Details</a>
						</div>
					</div>

					<div class="myaccount-order-section">
						<?php
						foreach ( $order_items as $item_id => $item ) 
						{
							$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
							if($product)
							{
								if($product->parent->id || $product->is_type( 'variable' ))
								{
									$product_id = $product->parent->id;

								}
								else
								{
									$product_id = $product->get_id();
								}
								$product_display_name = get_post_meta( $product_id, 'woocommerce_product_display_name', true );
								$hotel_id = get_post_meta($product_id, 'hotel_product', true);
								$hotel_name = get_the_title($hotel_id[0]);
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $item ) : '', $item, $item_id );

								$quantity = $item->get_quantity();
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $item, $item_id );

								if(count($order_items) > 1) { $class = "myaccount-order-container"; } else { $class = "myaccount-single-order"; }
						?>
								<div class="<?php echo $class; ?>">
									<div class="myaccount-order-image">
										<?php
										if($product_permalink)
										{	
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); 
										}
										else
										{
											echo $thumbnail;
										}
										?>
									</div>
									<div class="myaccount-order-hotel-product">
										<h6 class="myaccount-order-hotel-name"><?php echo strtoupper($hotel_name); ?></h6>
										<a class="myaccount-order-product-name" href="<?php if($product_permalink) { echo $product_permalink; } else { echo 'javascript:void(0);'; } ?>"><?php echo $product_display_name; ?></a>
										<?php echo wc_display_item_meta( $item ); ?>
									</div>
									<div class="myaccount-order-quantity">
										<p class="myaccount-order-quantity-no">Qty: <?php echo sprintf( $quantity ); ?></p>
									</div>
									<div class="myaccount-order-price-section">
										<p class="myaccount-order-price-detail">
											<?php echo $order->get_formatted_line_subtotal( $item ); ?>
										</p>
									</div>
									<?php
									if( ( $product->is_virtual() || $product->is_type( 'variable' ) ) && ( $order->has_status( 'completed' ) || $order->has_status( 'processing' ) )  )
									{	
										$voucher_path = '';
										$voucher_codes_array = json_decode( get_post_meta( $order->get_order_number(), 'the_lalit_vouchers_details', true ), true );

										if($voucher_codes_array) 
										{
											foreach ($voucher_codes_array as $products) 
											{
												foreach ($products as $order_product) 
												{
													if(array_key_exists('variation_id', $order_product))
													{
														if($order_product['variation_id'] == $product->get_variation_id())
														{

															$voucher_path .= $order_product['voucher_path'].' | ';
														}
													}
													else
													{
														if($order_product['product_id'] == $product_id)
														{

															$voucher_path .= $order_product['voucher_path'].' | ';
														}
													}
												}
											}
											$voucher_path = rtrim($voucher_path, ' | ');
											if($voucher_path)
											{
									?>
												<div class="myaccount-order-print">
													<a class="myaccount-order-print-link" href="javascript:void(0);" data-item="<?php echo $voucher_path; ?>"><?php if($quantity > 1) { ?>Print Vouchers <?php } else { ?> Print Voucher <?php } ?></a>
												</div>
									
									<?php
											}
										}
									}
									?>
								</div>
						<?php
							}
						}
						?>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	<?php
	}
	?>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><i class="sprite ico-bold-red-arrow-left"></i><?php _e( 'Previous', 'woocommerce' ); ?>
				</a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?>
					<i class="sprite ico-bold-red-arrow-right"></i>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<?php _e( 'No orders yet! Go ahead and place your first order to enjoy our legendary service.', 'woocommerce' ); ?>
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ) ?>
		</a>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>