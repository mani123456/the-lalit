<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
		'shipping' => __( 'Shipping address', 'woocommerce' ),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'woocommerce' ),
	), $customer_id );
}
 //echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> <!-- col- --><?php //echo ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2; ?>
<!-- $oldcol = 1;
 $col    = 1; -->

<div class="address-dashboard-section">
	<div class="page-heading">
		<h2 class="personal-details-header bdr-bottom"><span class="bdr-bottom-gold">My Addresses</span></h2>
	</div>


<?php //if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="row">
		
<?php// endif; ?>

		<?php 
		$count = 0;
		foreach ( $get_addresses as $name => $title ) : 
			if(isMobile() && $count == 0)
			{
				$cls = 'myaccount-form-address';
			}
			else
			{
				$cls = '';
			}
		?>	
		<div class="address col <?php if(isIPad()) { ?>col6<?php } else { ?>col4<?php } ?> <?php echo $cls; ?>">
			<div class="u-column woocommerce-Address">
				<header class="woocommerce-Address-title title">
					<h3 class="dashboard-address-subheader"><?php echo $title; ?></h3>
				</header>
				<address>
					<?php
					$salutation = get_user_meta( $customer_id, $name . '_salutation', true );
					$first_name = get_user_meta( $customer_id, $name . '_first_name', true );
					$last_name = get_user_meta( $customer_id, $name . '_last_name', true );
					?>
					<p class="address-customer-name"><?php if($salutation) echo $salutation.'.'; ?> <?php echo $first_name; ?> <?php echo $last_name; ?></p>
					<?php
						$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
							//'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
							//'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
							//'company'     => get_user_meta( $customer_id, $name . '_company', true ),
							'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
							'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
							'city'        => get_user_meta( $customer_id, $name . '_city', true ),
							'state'       => get_user_meta( $customer_id, $name . '_state', true ),
							'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
							'country'     => get_user_meta( $customer_id, $name . '_country', true ),
						), $customer_id, $name );

						$formatted_address = WC()->countries->get_formatted_address( $address );

						if ( ! $formatted_address ) {
							_e( 'You have not set up '.$name.' address yet.', 'woocommerce' );
						} else {
							echo $formatted_address.'<br/>';
							if( get_user_meta( $customer_id, $name . '_country', true ) == 'IN')
							{
								echo WC()->countries->countries[get_user_meta( $customer_id, $name . '_country', true )].'<br/>';
							}
							echo 'Tel : '.get_user_meta( $customer_id, $name . '_phone', true );
						}
					?>
				</address>
				<a class="dashboard-address-link" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php _e( 'Edit', 'woocommerce' ); ?></a>
			</div>
		</div>
		<?php $count++; endforeach; ?>

<?php //if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	
	</div><!-- row -->
<?php //endif;
?>
</div><!-- address-dashboard-section -->

