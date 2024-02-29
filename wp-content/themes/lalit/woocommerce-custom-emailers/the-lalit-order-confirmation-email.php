<?php
add_action('the_lalit_woocommerce_email_header', 'the_lalit_woocommerce_email_header_callback', 10, 3);
function the_lalit_woocommerce_email_header_callback($order, $email_heading, $email)
{

	$order_items = $order->get_items();
	$hotel_email = '';

	$order_contains_virtual_products = false;
	foreach ($order_items as $item_id => $item_data) {

		if ($item_data['variation_id']) {

			$product_id = $item_data['variation_id'];
		} else {

			$product_id = $item_data['product_id'];
		}

		$product = wc_get_product($product_id);

		if (!$product->is_virtual()) {

			$product_hotel_id = get_post_meta($product_id, 'hotel_product', true);
		} else {

			$order_contains_virtual_products = true;
		}
	}

	$hotel_email = get_post_meta($product_hotel_id[0], 'email', true);

	$customer_last_name = '';
	$customer_first_name = '';
	$customer_salutation = '';

	if ($order->needs_shipping_address()) {

		$customer_last_name = $order->get_shipping_last_name();
		$customer_first_name = $order->get_shipping_first_name();
		$customer_salutation = get_post_meta($order->get_id(), 'shipping_salutation', true);
	} else {

		$customer_last_name = $order->get_billing_last_name();
		$customer_first_name = $order->get_billing_first_name();
		$customer_salutation = get_post_meta($order->get_id(), 'billing_salutation', true);
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8">
		<meta name="viewport" content="width: 600, initial-scale: 1">
		<title>The LaLit: Order <?php echo (!$order->needs_shipping_address() && $order_contains_virtual_products) ?  'Complete' : 'Confirmed'; ?></title>
	</head>

	<body style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#f7f7f7; background-color:#f7f7f7; margin: 0px; padding:0px;" yahoo="fix">
		<table id="emailerContainer" cellspacing="0" cellpadding="0" width="100%" style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#333333; background-color:#f7f7f7; margin: 0px; padding:0px;">
			<tbody>
				<tr>
					<td>
						<table cellspacing="0" cellpadding="0" width="600" align="center" class="container">
							<tr>
								<td>
									<table cellspacing="0" cellpadding="0" width="100%">
										<tbody>

											<tr>
												<td style="padding-top: 30px; padding-bottom: 60px;">
													<table border="0" cellspacing="0" cellpadding="0" width="100%">
														<tbody>
															<tr>
																<td style="width: 100%; text-align: left;" class="bannerCell">
																	<a href="<?php echo site_url(); ?>" style="cursor: pointer; text-decoration: none;">
																		<img src="<?php echo get_template_directory_uri(); ?>/images/Lalit-Logo.png" alt="The Lalit Logo" border="0" height="auto" width="114" style="text-decoration: none; border-width:0;" />
																	</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>

											<tr>
												<td>
													<table border="0" cellspacing="0" cellpadding="0" width="100%">
														<tbody>
															<tr>
																<td style="padding: 38px 45px;border: 1px solid #000000; background-color: #ffffff;">
																	<table>
																		<tbody>
																			<tr>
																				<td>
																					<table border="0" cellspacing="0" cellpadding="0" width="100%">
																						<tbody>
																							<tr>
																								<?php

																								if (!$order->needs_shipping_address() && $order_contains_virtual_products) {

																									//Only virtual products are in the order
																								?>
																									<td style=" float: left;font-weight: normal; font-family:Arial; font-size: 21px; line-height: 25px; color: #996600; letter-spacing: 0.3px; padding-bottom: 40px;">Order Complete!</td>
																								<?php
																								} else {

																								?>
																									<td style=" float: left;font-weight: normal; font-family:Arial; font-size: 21px; line-height: 25px; color: #996600; letter-spacing: 0.3px; padding-bottom: 40px;">Order Confirmed!</td>
																								<?php
																								}
																								?>
																								<td style=" float:right; font-size: 16px; font-weight: bold; line-height: 1.38; letter-spacing: 0.8px; color: #363636; font-family:Arial; padding-bottom: 40px;">Order #<?php echo $order->get_order_number(); ?></td>
																							</tr>
																							<tr>
																								<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 30px;">
																									Dear <?php echo $customer_salutation . ' ' . ucfirst($customer_first_name) . ' ' . ucfirst($customer_last_name); ?>,</td>
																							</tr>
																							<tr>
																								<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 30px;">
																									Namaskar!</td>
																							</tr>
																							<?php
																							if (!$order->needs_shipping_address() && $order_contains_virtual_products) {

																								//Only virtual products are in the order
																							?>
																								<tr>
																									<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">We convey our heartiest gratitude for placing your order with The LaLiT, and we look forward to the pleasure of serving you.</td>
																								</tr>
																								<tr>
																									<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;"><strong>Please find your Voucher(s) attached with this email.</strong> Please note the <strong>redemption instructions</strong> on the voucher that you will need to follow, in order to redeem your Voucher at the appropriate venue.</td>
																								</tr>
																							<?php
																							} else if ($order->needs_shipping_address() && $order_contains_virtual_products) {

																								//Both shippable and virtual products are in the order
																							?>
																								<tr>
																									<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">We convey our heartiest gratitude for placing your order with The LaLiT, and we look forward to the pleasure of serving you.</td>
																								</tr>
																								<tr>
																									<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;"><strong>Please find your Voucher(s) attached with this email.</strong> Please note the <strong>redemption instructions</strong> on the voucher that you will need to follow, in order to redeem your Voucher at the appropriate venue.</td>
																								</tr>
																								<!-- <tr>
																										<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">If you do not receive your order within 10-12 business days, please email us at <?php echo $hotel_email; ?>. Please include your order number to allow us to quickly track your order.</td>
																									</tr> -->
																							<?php
																							} else if ($order->needs_shipping_address() && !$order_contains_virtual_products) {

																								//Only shippable products are in the order
																							?>
																								<tr>
																									<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">We convey our heartiest gratitude for placing your order with The LaLiT, your order will be shipped soon.</td>
																								</tr>
																								<!-- <tr>
																										<td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">If you do not receive your order within 10-12 business days, please email us at <?php echo $hotel_email; ?>. Please include your order number to allow us to quickly track your order.</td>
																									</tr> -->
																							<?php
																							}
																							?>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		<?php
																	}


																	add_action('the_lalit_woocommerce_email_order_details', 'the_lalit_woocommerce_email_order_details_callback', 11, 4);
																	function the_lalit_woocommerce_email_order_details_callback($order, $sent_to_admin, $plain_text, $email)
																	{

																		$payment_type = get_post_meta($order->get_id(), 'Payment type', true);
																		$order_items = $order->get_items();

																		?>
																			<tr>
																				<td>
																					<table border="0" cellspacing="0" cellpadding="0" width="100%">
																						<tbody>
																							<tr>
																								<td style="font-weight: normal; font-family:Arial; font-size: 18px; line-height: 22px; color: #996600; letter-spacing: 0.3px; padding-bottom: 25px; text-transform: uppercase;">Order Details</td>
																							</tr>
																							<tr>
																								<td style="font-weight: bold; font-family:Arial; font-size: 18px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 15px;">Order #<?php echo $order->get_order_number(); ?></td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>

																			<tr>
																				<td>
																					<table border="0" cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td style="border: 1px solid #cccccc; border-left: none; border-right: none;">
																								<table border="0" cellspacing="0" cellpadding="0" width="100%">
																									<tbody>
																										<tr>
																											<td width="60%" style="padding: 10px; font-family: Arial; font-size: 14px; line-height: 18px;font-weight: bold;">Products</td>

																											<td width="20%" style="padding: 10px; font-family:Arial; font-size: 14px; line-height: 18px;font-weight: bold; text-align: right;">Quantity</td>
																											<td width="20%" style="padding: 10px; font-family:Arial; font-size: 14px; line-height: 18px;font-weight: bold;text-align: right;">Price</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>

																			<tr>
																				<td style="padding: 10px 0px; border-bottom: 1px solid #cccccc;">
																					<table border="0" cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td style="padding: 0 0 0 10px;">
																								<table border="0" cellspacing="0" cellpadding="0" width="100%">
																									<tbody>
																										<?php

																										foreach ($order_items as $item_id => $item_data) {

																											$product_id = $item_data['product_id'];
																											$product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name', true);
																											$item_quantity = $order->get_item_meta($item_id, '_qty', true);
																											$item_total = $order->get_item_meta($item_id, '_line_total', true);
																											$item_variation_attributes = $item_data->get_meta_data();
																										?>
																											<tr>
																												<td width="60%" style="font-size: 12px;font-weight: normal;line-height: 16px; font-family: Arial;">
																													<table>
																														<tr>
																															<td><?php echo trim($product_display_name); ?></td>
																														</tr>
																														<?php
																														if ($item_variation_attributes) {
																															foreach ($item_variation_attributes as $item_variation_attribute) {

																																$item_attribute_name = ucwords(str_replace('pa_', '', $item_variation_attribute->key));
																																$item_attribute_name = str_replace('-', ' ', $item_attribute_name);
																																$item_attribute_name = str_replace('-', ' ', $item_attribute_name);
																																$item_attribute_name = str_replace('-', ' ', $item_attribute_name);
																																$item_attribute_value = $item_variation_attribute->value;
																														?>
																																<tr>
																																	<td style="font-size: 11px; line-height: 15px;font-family: Arial;">
																																		<span style="font-weight: bold;">
																																			<?php echo $item_attribute_name; ?>:
																																		</span>
																																		<?php echo $item_attribute_value; ?>
																																	</td>
																																</tr>
																														<?php

																															}
																														}
																														?>
																													</table>
																												</td>
																												<td width="20%" style="font-size: 12px;font-weight: normal;line-height: 16px; font-family: Arial; text-align: right; padding: 5px 10px;"><?php echo $item_quantity; ?></td>
																												<td width="20%" style="font-size: 12px;font-weight: normal;line-height: 16px; font-family: Arial; text-align: right; padding: 5px 10px;"><span class="currency-symol" style="padding:2px" ;>&#x20B9;</span><span class="price-amount"><?php echo $item_total; ?></span></td>
																											</tr>
																										<?php
																										}
																										?>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>

																			<tr>
																				<td style="padding: 20px 0;">
																					<table border="0" cellspacing="0" cellpadding="0" width="50%" align="right">
																						<tr>
																							<td>
																								<table border="0" cellspacing="0" cellpadding="0" width="100%">
																									<tbody>
																										<tr>
																											<td width="50%" style="font-size: 14px;line-height: 18px; font-family: Arial; text-align: left; padding-bottom: 10px;">Subtotal</td>
																											<td width="50%" style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px;padding-right: 10px; text-align: right; padding-bottom: 10px;"><span class="currency-symol" style="padding:2px" ;>&#x20B9;</span><span class="price-amount"><?php echo $order->get_subtotal(); ?></span></td>
																										</tr>
																										<?php

																										$order_taxes_array = $order->get_taxes();

																										if ($order_taxes_array) {

																											foreach ($order_taxes_array as $order_tax) {
																												$tax = $order_tax->get_data();
																										?>
																												<tr>
																													<td width="50%" style="font-size: 14px;line-height: 18px; font-family: Arial; text-align: left; padding-bottom: 10px;"><?php echo $tax['label']; ?></td>

																													<td width="50%" style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px;padding-right: 10px; text-align: right; padding-bottom: 10px;"><span class="currency-symol" style="padding:2px" ;>&#x20B9;</span><span class="price-amount"><?php echo $tax['tax_total']; ?></span></td>
																												</tr>
																											<?php
																											}
																										}

																										if ($payment_type) {
																											?>
																											<tr>
																												<td width="50%" style="font-size: 14px;line-height: 18px; font-family: Arial; text-align: left; padding-bottom: 10px;">Payment Method</td>

																												<td width="50%" style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px;padding-right: 10px; text-align: right; padding-bottom: 10px;"><?php echo $payment_type; ?></td>
																											</tr>
																										<?php

																										}
																										?>
																										<tr>
																											<td width="50%" style="padding: 10px 0; font-family: Arial; font-weight: bold; font-family:Arial; font-size: 16px; line-height: 20px; text-align: left;">Grand Total</td>

																											<td width="50%" style="padding: 10px 10px 10px 0; font-family: Arial; font-weight: bold; font-family:Arial; font-size: 16px; line-height: 20px; text-align: right;"><span class="currency-symol" style="padding:2px" ;>&#x20B9;</span><span class="price-amount"><?php echo $order->get_total(); ?></span></td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		<?php
																	}

																	add_action('the_lalit_woocommerce_email_customer_details', 'the_lalit_woocommerce_email_customer_details_callback', 12, 4);
																	function the_lalit_woocommerce_email_customer_details_callback($order, $sent_to_admin, $plain_text, $email)
																	{

																		$customer_email = $order->get_billing_email();
																		$customer_phone = $order->get_billing_phone();
																		$order_contains_shippable_product = false;

																		if ($order->needs_shipping_address()) {

																			$order_contains_shippable_product = true;
																			$shipping_address_line_1 = $order->get_shipping_address_1();
																			$shipping_address_line_2 = $order->get_shipping_address_2();
																			$shipping_city = $order->get_shipping_city();
																			$shipping_postcode = $order->get_shipping_postcode();
																			$shipping_state_code = $order->get_shipping_state();
																			$shipping_country_code = $order->get_shipping_country();
																			$customer_first_name = ucfirst($order->get_shipping_first_name());
																			$customer_last_name = ucfirst($order->get_shipping_last_name());
																		} else {

																			$billing_address_line_1 = $order->get_billing_address_1();
																			$billing_address_line_2 = $order->get_billing_address_2();
																			$billing_city = $order->get_billing_city();
																			$billing_postcode = $order->get_billing_postcode();
																			$billing_state_code = $order->get_billing_state();
																			$billing_country_code = $order->get_billing_country();
																			$customer_first_name = ucfirst($order->get_billing_first_name());
																			$customer_last_name = ucfirst($order->get_billing_last_name());
																		}

																		?>
																			<tr>
																				<td style="padding-bottom: 50px;">
																					<table border="0" cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td>
																								<table border="0" cellspacing="0" cellpadding="0" width="100%">
																									<tbody>
																										<tr>
																											<td style="font-weight: normal; font-family: Arial; font-size: 18px; line-height: 22px; color: #996600; letter-spacing: 0.3px; padding-bottom: 25px; text-transform: uppercase;">Customer Details</td>
																										</tr>
																										<tr>
																											<td style="font-weight: bold; font-family: Arial; font-size: 16px; line-height: 20px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $customer_first_name . ' ' . $customer_last_name; ?></td>
																										</tr>
																										<tr>
																											<td style="font-weight: normal; font-family: Arial; font-size: 12px; line-height: 16px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $customer_email; ?></td>
																										</tr>
																										<tr>
																											<td style="font-weight: normal; font-family: Arial; font-size: 12px; line-height: 16px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $customer_phone; ?></td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>

																			<tr>
																				<td style="padding-bottom: 20px; border-bottom: 1px solid #cccccc;">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td>
																								<table cellspacing="0" cellpadding="0" width="100%">
																									<tr>
																										<?php

																										if (!$order_contains_shippable_product) {

																											$countries_obj = new WC_Countries();
																											$countries_array = $countries_obj->get_countries();
																											$billing_country_name = $countries_array[$billing_country_code];

																											$billing_country_states = $countries_obj->get_states($billing_country_code);
																											$billing_state_name = $billing_country_states[$billing_state_code];

																										?>
																											<td width="50%">
																												<table cellspacing="0" cellpadding="0" width="100%">
																													<tbody>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 18px; line-height: 22px; color: #996600; letter-spacing: 0.3px; padding-bottom: 25px; text-transform: uppercase;">Billing Address</td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $billing_address_line_1; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $billing_address_line_2; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $billing_city . ' - ' . $billing_postcode; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $billing_state_name; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $billing_country_name; ?></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										<?php
																										} else {

																											$countries_obj = new WC_Countries();
																											$countries_array = $countries_obj->get_countries();
																											$shipping_country_name = $countries_array[$shipping_country_code];

																											$shipping_country_states = $countries_obj->get_states($shipping_country_code);
																											$shipping_state_name = $shipping_country_states[$shipping_state_code];

																										?>
																											<td width="50%">
																												<table cellspacing="0" cellpadding="0" width="100%">
																													<tbody>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 18px; line-height: 22px; color: #996600; letter-spacing: 0.3px; padding-bottom: 25px; text-transform: uppercase;">Shipping Address</td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $shipping_address_line_1; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $shipping_address_line_2; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $shipping_city . ' - ' . $shipping_postcode; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $shipping_state_name; ?></td>
																														</tr>
																														<tr>
																															<td style="font-weight: normal; font-family: Arial; font-size: 14px; line-height: 18px; color: #000000; letter-spacing: 0.3px;padding-bottom: 5px;"><?php echo $shipping_country_name; ?></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										<?php
																										}
																										?>
																									</tr>
																								</table>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		<?php
																	}

																	add_action('the_lalit_woocommerce_email_hotel_venues', 'the_lalit_woocommerce_email_hotel_venues_callback', 13, 4);
																	function the_lalit_woocommerce_email_hotel_venues_callback($order, $sent_to_admin, $plain_text, $email)
																	{

																		$order_items = $order->get_items();
																		$count = 1;
																		$hotel_details = array();
																		$venue_details_html = '';

																		foreach ($order_items as $item_id => $item_data) {

																			$product_id = $item_data['product_id'];
																			$product_hotel_id = get_post_meta($product_id, 'hotel_product', true);
																			$hotel_details[$product_hotel_id[0]]['hotel_name'] = get_post_meta($product_hotel_id[0], 'name', true);
																			$hotel_details[$product_hotel_id[0]]['hotel_phone'] = get_post_meta($product_hotel_id[0], 'phone', true);
																			$hotel_details[$product_hotel_id[0]]['hotel_email'] = get_post_meta($product_hotel_id[0], 'email', true);
																		}
																		foreach ($hotel_details as $hotel_info) {

																			$venue_details_html .= "<td><table><tbody><tr><td><strong>" . $hotel_info['hotel_name'] . "</strong></td></tr>";

																			if ($hotel_info['hotel_phone']) {
																				$venue_details_html .= "<tr><td>" . $hotel_info['hotel_phone'] . "</td></tr>";
																			}

																			if ($hotel_info['hotel_email']) {
																				$venue_details_html .= "<tr><td>" . $hotel_info['hotel_email'] . "</td></tr>";
																			}

																			$venue_details_html .= "</tbody></table></td>";

																			if ($count % 2 == 0) {

																				$venue_details_html .= "</tr><tr>";
																			}
																			$count++;
																		}

																		$venue_details_html = rtrim($venue_details_html, '</tr><tr>');
																		?>
																			<tr>
																				<td style="padding-top: 30px; font-family: Arial; font-size: 14px; line-height: 18px; letter-spacing: 0.7px; color: #363636;">Please don't hesitate to contact us for any assistance:
																				</td>
																			</tr>

																			<tr>
																				<td style="font-family: Arial; font-size: 14px; line-height: 1.57;letter-spacing: 0.7px; color: #363636;">
																					<table>
																						<tbody>
																							<tr>
																								<?php

																								echo $venue_details_html;
																								?>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		<?php
																	}


																	add_action('the_lalit_woocommerce_email_footer', 'the_lalit_woocommerce_email_footer_callback', 14, 4);
																	function the_lalit_woocommerce_email_footer_callback($email)
																	{

																		?>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		<?php
																	}
																	add_action('the_lalit_woocommerce_email_global_footer', 'the_lalit_woocommerce_email_global_footer_callback', 13);
																	function the_lalit_woocommerce_email_global_footer_callback()
																	{
		?>
			<tfoot width="600" align="center" class="container">
				<tr>
					<td style="padding-top: 20px;font-family: Arial; font-size: 12px; line-height: 16px; letter-spacing: 0.6px; color: #363636;">
						India Toll Free: 1800 11 77 11 | Corporate Office: +91 11 4444 7474
					</td>
				</tr>
				<tr>
					<td style="font-family: Arial; font-size: 11px; font-weight: 300; line-height: 15px; letter-spacing: 0.6px; color: #363636; padding-top: 15px; padding-bottom: 15px;">
						© The LaLiT <?php echo date('Y'); ?>. All rights reserved by Bharat Hotels Ltd.
					</td>
				</tr>
			</tfoot>
		</table>
	</body>

	</html>
<?php
																	}
?>