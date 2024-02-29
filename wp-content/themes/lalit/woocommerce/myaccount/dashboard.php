<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!--<p><?php
	/* translators: 1: user display name 2: logout url */
	//printf(
		//__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		//'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		//esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	//);
?></p>

<p><?php
	//printf(
		//__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		//esc_url( wc_get_endpoint_url( 'orders' ) ),
		//esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		//esc_url( wc_get_endpoint_url( 'edit-account' ) )
	//);
?></p>-->

<h1 class="customer-name-dashboard">Welcome <?php echo esc_html( get_user_meta(get_current_user_id(), 'account_first_name', true) ); ?>!</h1>
<div class="dashboard-main-content">
	<div class="row">
		<div class="dashboard-content-section col <?php if(isIPad()) { ?>col6<?php } else { ?>col4<?php } ?>">
			<div class="dashboard-icons">
				<img src="<?php echo get_template_directory_uri(); ?>/images/myaccount-dashboard/orders.png" itemprop="logo" alt="The Lalit - Dashboard Order">
				<h6 class="dashboard-description-header dashboard-order-header">Orders</h6>
			</div>
			<div class="dashboard-description">
				
				<p class="dashboard-description-content ">View your orders and access your vouhcers</p>
				<a class="dashboard-description-link" href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>">View Orders</a>
			</div>	
		</div>
		<div class="dashboard-content-section col <?php if(isIPad()) { ?>col6<?php } else { ?>col4<?php } ?>">
			<div class="dashboard-icons">
				<img src="<?php echo get_template_directory_uri(); ?>/images/myaccount-dashboard/addresses.png" itemprop="logo" alt="The Lalit - Dashboard Order">
				<h6 class="dashboard-description-header">Addresses</h6>	
			</div>
			<div class="dashboard-description dashboard-address-description">
				
				<p class="dashboard-description-content">Edit your Billing and Shipping addresses, for faster checkout</p>
				<a class="dashboard-description-link" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>">View Addresses</a>
			</div>
		</div>
		<div class="dashboard-content-section col <?php if(isIPad()) { ?>col6 dashboard-personal-details-seciton<?php } else { ?>col4<?php } ?>">
			<div class="dashboard-icons">
				<img src="<?php echo get_template_directory_uri(); ?>/images/myaccount-dashboard/account.png" itemprop="logo" alt="The Lalit - Dashboard Order">
				<h6 class="dashboard-description-header">Personal Details</h6>
			</div>
			<div class="dashboard-description dashboard-detail-description">
				<p class="dashboard-description-content">Edit your email address, number, password and more.</p>
				<a class="dashboard-description-link" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>">Add Details</a>	
			</div>
		</div>
	</div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	//do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	//do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
