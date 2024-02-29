<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$contains_shipping_address = false;
if ( true === WC()->cart->needs_shipping_address() )
{
	$contains_shipping_address = true;
}

$fields = $checkout->get_checkout_fields( 'billing' );
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3 class="checkout-heading-accordian active"><i class="sprite ico-brown-arrow-up"></i> <?php _e( 'Personal Details', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3 class="checkout-heading-accordian active"><i class="sprite ico-brown-arrow-up"></i> <?php _e( 'Personal Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<div>
		<?php if (!is_user_logged_in()) 
		{ 
		?>
			<p class="login-description">Go ahead and complete the form and we’ll create a new account for you. You can use this account to place &amp; view orders, and stay connected to us. All fields are mandatory, unless indicated otherwise. </p>
		<?php 
		} 
		?>

		<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

		<div class="woocommerce-billing-fields__field-wrapper checkout-billing-container-details">
			<?php
				foreach ( $fields as $key => $field ) 
				{

					if($key == 'billing_salutation' || $key == 'billing_first_name' || $key == 'billing_last_name' || $key == 'billing_phone' || $key == 'billing_email')
					{
						if(is_user_logged_in())
						{
							$user_id = get_current_user_id();
							if($key == 'billing_salutation' || $key == 'billing_first_name' || $key == 'billing_last_name')
							{
								$val = get_user_meta($user_id, $key, true);
							}
							else
							{
								$val = $checkout->get_value( $key );
							}
						}
						else
						{
							$val = $checkout->get_value( $key );
						}
						
						lalit_checkout_form_field( $key, $field, $val );
					}
				} 
			?>
		
			<?php
			if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : 
			?>
					<div class="woocommerce-account-fields">
						<?php if ( ! $checkout->is_registration_required() ) : ?>

							<p class="form-row form-row-wide create-account checkout-account-password">
								<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'woocommerce' ); ?></span>
								</label>
							</p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

						<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

							<div class="create-account checkout-account-password">
								<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
									<?php lalit_checkout_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
								<?php endforeach; ?>
								<div class="clear"></div>
							</div>

						<?php endif; ?>

						<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
					</div>
			<?php 
			endif;
			?>
		</div>
	</div>
	<?php
	if ( $contains_shipping_address )
	{
	?>
		<h3 class="checkout-heading-accordian checkout-billing-address active">
			<i class="sprite ico-brown-arrow-up"></i> 
			<?php _e( 'Shipping Address', 'woocommerce' ); ?>
		</h3>
	<?php
	}
	else
	{
	?>
		<h3 class="checkout-heading-accordian checkout-billing-address active">
			<i class="sprite ico-brown-arrow-up"></i> 
			<?php _e( 'Billing Address', 'woocommerce' ); ?>
		</h3>
	<?php
	}
	?>
	<div class="woocommerce-billing-fields__field-wrappe checkout-billing-container">
		<?php
			foreach ( $fields as $key => $field ) 
			{	
				if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) 
				{
					$field['country'] = $checkout->get_value( $field['country_field'] );
				}

				if($key == 'billing_country' || $key == 'billing_address_1' || $key == 'billing_address_2' || $key == 'billing_city' || $key == 'billing_state' || $key == 'billing_postcode' )
				{	
					if(is_user_logged_in())
					{
						$val = get_user_meta($user_id, $key, true);
					}
					else
					{
						$val = $checkout->get_value( $key );
					}		
					lalit_checkout_form_field( $key, $field, $val );
				}
			}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>