<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
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
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// wc_print_notices();
// wc_print_notice( __( 'Password reset email has been sent.', 'woocommerce' ) );
?>
<div class="container">
	<div class="row">
		<div class="col <?php if(isIPad()) { ?>col9 offsetBy2<?php } else { ?>col6 offsetBy3<?php } ?> forgot-password-container">
			<h2 class="align-center account-login-header password-sent"><i class="ico-sprite sprite size-30 ico-check-with-circle"></i>Password Reset Link Sent!</h2>
			<p class="align-center password-sent-description"><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'We&apos;ve sent you an email with a link to reset your password, please check your inbox and click on the link to reset your password.', 'woocommerce' ) ); ?></p>
		</div>	
	</div>
</div>