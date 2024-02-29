<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contains_shipping_address = false;
if(true === $order->needs_shipping_address() )
{
	$contains_shipping_address = true;
}
/*$contains_shipping_address = false;
foreach ( $order->get_items() as $item_id => $item ) 
{
	$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
	if($product->is_type('simple') && !$product->is_virtual())
	{
		$contains_shipping_address = true;
	}
}*/

$text_align = is_rtl() ? 'right' : 'left';

?><table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
	<tr>
		<td class="td" style="text-align:<?php echo $text_align; ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
			<h3>
			<?php 
			if($contains_shipping_address) 
			{ 
				_e( 'Shipping address', 'woocommerce' );
			?>
				<p class="text">
					<?php echo $order->get_formatted_shipping_address(); ?>
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
			<?php
			} 
			else 
			{ 
				_e( 'Billing address', 'woocommerce' ); 
			?>
				<p class="text">
					<?php echo $order->get_formatted_billing_address(); ?>
					<br/>
					<?php
					if($order->shipping_country == 'IN')
					{
						echo WC()->countries->countries[$order->billing_country];
						echo '<br/>';
					}
					?>
					Tel: <?php echo esc_html( $order->get_billing_phone() ); ?>
				</p>
			<?php
			} 
			?>
				
			</h3>
			
		</td>
		<?php //if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
			<!--<td class="td" style="text-align:<?php //echo $text_align; ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
				<h3><?php //_e( 'Shipping address', 'woocommerce' ); ?></h3>

				<p class="text"><?php //echo $shipping; ?></p>
			</td>-->
		<?php //endif; ?>
	</tr>
</table>
