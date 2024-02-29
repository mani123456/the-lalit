<?php

	add_action('the_lalit_refunded_order_email_header', 'the_lalit_refunded_order_email_header_callback', 10, 3);
	function the_lalit_refunded_order_email_header_callback($order, $email_heading, $email){

		$user = get_user_by('email', $email->user_email);
		$customer_obj = new WC_Customer($user->ID);
		$account_salutation = get_user_meta($user->ID, 'account_salutation', true);

		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8">
			<meta name="viewport" content="width: 600, initial-scale: 1">
			<title>The LaLit: Order Confirmed</title>
		</head>
		<body style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#f7f7f7; background-color:#f7f7f7; margin: 0px; padding:0px;" yahoo="fix">
			<table id="emailerContainer" cellspacing="0" cellpadding="0" width="100%" style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#333333; background-color:#f7f7f7; margin: 0px; padding:0px;">
			   <tbody>
			      <tr>
			         <td>
			            <table cellspacing="0" cellpadding="0" width="600" align="center" class="container">
			               <tbody>
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
																<img src="<?php echo get_template_directory_uri(); ?>/images/Lalit-Logo.png" alt="The Lalit Logo" border="0" height="auto" width="114" style="text-decoration: none; border-width:0;"/>
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
			                                                                     <td style=" float: left;font-weight: normal; font-family:Arial; font-size: 21px; line-height: 25px; color: #996600; letter-spacing: 0.3px; padding-bottom: 40px;">Refund Processed!</td>
			                                                                     <td style=" float:right; font-size: 16px; font-weight: bold; line-height: 1.38; letter-spacing: 0.8px; color: #363636; font-family:Arial; padding-bottom: 40px;">Order #<?php echo $order->get_id(); ?></td>
			                                                                  </tr>
			                                                                  <tr>
			                                                                     <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 30px;">Dear <?php echo $account_salutation.' '.$customer_obj->get_last_name(); ?>, Namaskar!</td>
			                                                                  </tr>
			                                                                  <tr>
			                                                                     <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">We’d like to inform you that the refund of <?php echo $order->get_total(); ?> for your order #<?php echo $order->get_id(); ?> has been processed successfully.</td>
			                                                                  </tr>
			                                                               </tbody>
			                                                            </table>
			                                                         </td>
			                                                      </tr>
					<?php
	}


	add_action('the_lalit_refunded_order_email_items', 'the_lalit_refunded_order_email_items_callback', 11, 4);
	function the_lalit_refunded_order_email_items_callback($order, $sent_to_admin, $plain_text, $email){

		$payment_type = get_post_meta($order->get_id(), 'Payment type', true);
		$order_items = $order->get_items();
		?>
			<tr>
                 <td>
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                       <tbody>
                          <tr>
                             <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">The Refund is for following items:</td>
                          </tr>
                          <?php

                          	foreach ($order_items as $item_id => $item_data) {
                          		?>
                          		
                          		<?php
                          	}

                          ?>
                          <tr>
                             <td style="font-weight: normal; font-family:Arial; font-size: 12px; line-height: 16px; color: #363636; letter-spacing: 0.3px; padding-bottom: 10px;">Express Lunch at Baluchi</td>
                          </tr>
                          <tr>
                             <td style="font-weight: normal; font-family:Arial; font-size: 12px; line-height: 16px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">Delhi Tour</td>
                          </tr>
                          <tr>
                             <td style="font-weight: normal; font-family:Arial; font-size: 12px; line-height: 16px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">Airport Transfer</td>
                          </tr>
                       </tbody>
                    </table>
                 </td>
              </tr>
		<?php

	}
?>