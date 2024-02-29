<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}

$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();

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
$quantity = $item->get_quantity();
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">
	<?php
	if(isMobile())
	{
		$thumbnail = $product->get_image( 'shop_catalog' );
		$thumbnail_2 = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $item, $item_id );
	}
	else
	{
		$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $item, $item_id );
	}
	?>

	<?php
	if(isMobile())
	{
	?>
		<td class="product-thumbnail thankyou-product-thumbnail mob-product-thumbnail mob-portrait">
			<?php echo $thumbnail; ?>
		</td>
		<td class="product-thumbnail thankyou-product-thumbnail mob-product-thumbnail mob-landscape">
			<?php echo $thumbnail_2; ?>
		</td>
	<?php
	}
	else
	{
	?>
		<td class="product-thumbnail thankyou-product-thumbnail">
			<?php echo $thumbnail; ?>
		</td>
	<?php
	}
	?>

	<td class="woocommerce-table__product-name product-name thankyou-product-name mob-product-name">
		<h4 class="product-hotel"><?php echo strtoupper($hotel_name); ?></h4>
		<?php
			$is_visible = $product && $product->is_visible();
			//$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
			?>
			<span class="product-name"><?php echo $product_display_name; ?></span>
			<?php

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			wc_display_item_meta( $item );
			// wc_display_item_downloads( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
		?>
		<?php
		if($product->is_virtual())
		{
			$parent_product = get_post_meta($product_id, 'parent_product', true);
			if($parent_product)
			{
				$redemption_details = get_post_meta( $parent_product[0], 'woocommerce_redemption_instructions', true );
				if($redemption_details != '')
				{
		?>
					<div class="redemption-details-section mob-landscape">
						<h6>Redemption details <i class="sprite ico-bold-red-arrow-up"></i></h6> 
							<div class="redemption-details">	
								<?php echo $redemption_details; ?>
							</div>
					</div>
		<?php
				}
			}
			else
			{
				$redemption_details = get_post_meta( $product_id, 'woocommerce_redemption_instructions', true );

				if($redemption_details != '')
				{
		?>
					<div class="redemption-details-section mob-landscape">
						<h6>Redemption details <i class="sprite ico-bold-red-arrow-up"></i></h6> 
							<div class="redemption-details">	
								<?php echo $redemption_details; ?>
							</div>
					</div>
		<?php
				}
			}
		}
		?>
	</td>
	<td class="product-quantity thankyou-product-quantity mob-product-quantity">
		<?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <span class="product-quantity"> Qty: ' . sprintf( $quantity ) . '</span>', $item );?>
	</td>
	<td class="woocommerce-table__product-total thankyou-product-total mob-product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>

	<?php
	if(isMobile())
	{
	?>
	<td class="thankyou-redemption-details mob-portrait">
	<?php
	if($product->is_virtual())
	{
		$parent_product = get_post_meta($product_id, 'parent_product', true);
		if($parent_product)
		{
			$redemption_details = get_post_meta( $parent_product[0], 'woocommerce_redemption_instructions', true );
			if($redemption_details != '')
			{
		?>
				<div class="redemption-details-section">
					<h6>Redemption details <i class="sprite ico-bold-red-arrow-up"></i></h6> 
						<div class="redemption-details">	
							<?php echo $redemption_details; ?>
						</div>
				</div>
		<?php
			}
		}
		else
		{
			$redemption_details = get_post_meta( $product_id, 'woocommerce_redemption_instructions', true );

			if($redemption_details != '')
			{
		?>
				<div class="redemption-details-section">
					<h6>Redemption details <i class="sprite ico-bold-red-arrow-up"></i></h6> 
						<div class="redemption-details">	
							<?php echo $redemption_details; ?>
						</div>
				</div>
		<?php
			}
		}
	}
	?>
	</td>
	<?php
	}
	?>

	<?php
	if($current_endpoint != 'order-pay')
	{
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
					<td class="thankyou-print-voucher mob-print-voucher">
						<a  class="thankyou-voucher-link  <?php if($quantity == 1) {echo 'thankyou-voucher-single-link';} ?>"" href="javascript:void(0);" data-item="<?php echo $voucher_path; ?>"><?php if($quantity > 1) { ?>Print Vouchers <?php } else { ?>Print Voucher <?php } ?></a>	
						<?php echo do_shortcode('[the_lalit_print_voucher_icon quantity="'.$quantity.'"]'); ?>
					</td>
	<?php
				}
				else
				{
	?>
					<td></td>
	<?php
				}
			}
			else
			{
	?>
				<td></td>
	<?php
			}
		}
		else
		{
	?>
			<td></td>
	<?php
		}
	}
	else
	{
	?>
		<td></td>
	<?php
	}
	?>

</tr>

<?php //if ( $show_purchase_note && $purchase_note ) : ?>

<!--<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="3"><?php //echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>-->

<?php //endif; ?>