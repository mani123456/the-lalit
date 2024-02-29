<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>
<div class="container">
	<div class="row">
		<div class="col col6 offsetBy3">
			<?php wc_print_notices(); ?>
			<h2 class="align-center account-login-header password-sent password-reset-header">Reset Your Password</h2>
			<form method="post" class="woocommerce-ResetPassword lost_reset_password new-password-register">

				<p class="password-reset-description"><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Choose a new password for your account.', 'woocommerce' ) ); ?></p>
				
				<div class="reset-password-section">
					<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
						<label class="register-labels" for="password_1"><?php _e( 'New Password', 'woocommerce' ); ?><span class="required"></span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text forgot-password-input" name="password_1" id="password_1" />
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
						<label class="register-labels" for="password_2"><?php _e( 'Re-type New Password', 'woocommerce' ); ?><span class="required"></span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text forgot-password-input" name="password_2" id="password_2" />
					</p>

					<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
					<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

					<div class="clear"></div>

					<?php do_action( 'woocommerce_resetpassword_form' ); ?>

					<p class="woocommerce-form-row form-row reset-password-btn-section">
						<input type="hidden" name="wc_reset_password" value="true" />
						<input type="submit" class="woocommerce-Button button forgot-password-submit" value="<?php esc_attr_e( 'Reset Password', 'woocommerce' ); ?>" />
					</p>

					<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
do_action( 'woocommerce_after_reset_password_form' );

