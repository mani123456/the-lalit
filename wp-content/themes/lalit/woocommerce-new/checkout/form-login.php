<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showlogin checkout-signin">' . __( 'LogIn', 'woocommerce' ) . '<i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a>';
//wc_print_notice( $info_message, 'notice' );
?>
<div class="checkout-login-section">	
	<?php echo $info_message; ?>
</div>

<?php
woocommerce_login_form(
	array(
		'message'  => __( 'Login to access your details, if you have shopped with us before. If you are a new customer, please complete the form starting with your Personal Details.', 'woocommerce' ),
		'redirect' => wc_get_page_permalink( 'checkout' ),
		'hidden'   => true,
	)
);

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
