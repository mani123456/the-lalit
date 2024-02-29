<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>
<div class="container">
	<div class="row">
		<div class="forgot-password-container">
			<h2 class="align-center account-login-header">
				<?php _e( 'Forgot Your Password?', 'woocommerce' ); ?>
			</h2>

			<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			
				<p class="forgot-password-text"><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Enter your registered email address, and we&apos;ll send you a link to reset your password.' , 'woocommerce' ) ); ?></p>
				<div class="reset-password-section">	
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
						<label class="align-center register-labels" for="user_login"><?php _e( 'Email Address', 'woocommerce' ); ?><span class="required"></span></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text forgot-password-input" type="email" name="user_login" id="user_login" placeholder="Enter your registered email id" />
					</p>

					<div class="clear"></div>

					<?php do_action( 'woocommerce_lostpassword_form' ); ?>

					<p class="woocommerce-form-row form-row">
						<input type="hidden" name="wc_reset_password" value="true" />
						<input type="submit" class="woocommerce-Button button forgot-password-submit" value="<?php esc_attr_e( 'Send Mail', 'woocommerce' ); ?>" />
					</p>

				<?php wp_nonce_field( 'lost_password' ); ?>
				</div>
			</form>
</div>
</div>
</div>
