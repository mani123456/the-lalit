<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if($_GET['action'] != 'register')
{
?>
	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="u-columns col2-set" id="customer_login">

		<div class="u-column1 col-1">

			<div class="container">
				<div class="row">
					<div class="col col6 offsetBy3">
						<h2 class="align-center account-login-header"><?php _e( 'Login to The LaLiT', 'woocommerce' ); ?></h2>

						<form class="woocomerce-form woocommerce-form-login login" method="post">

							<?php do_action( 'woocommerce_login_form_start' ); ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label class="account-email-label" for="username"><?php _e( 'Email Address', 'woocommerce' ); ?> <span class="required"></span></label>
								<input type="email" class="woocommerce-Input woocommerce-Input--text input-text account-email-input" tabindex="1" name="username" id="username" autofocus placeholder="Enter your registered email id" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
							</p>
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide account-password-row">
								<label class="account-email-label" for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required"></span></label>
								<input class="woocommerce-Input woocommerce-Input--text input-text account-email-input" tabindex="2" type="password" name="password" id="password" placeholder="Enter your password"/>
							</p>

							<?php do_action( 'woocommerce_login_form' ); ?>
							<div class="account-login-links align-center">
								<p class="form-row">
									<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
									<input type="submit" class="woocommerce-Button button account-login-btn" tabindex="3" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
									<!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
										<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php //_e( 'Remember me', 'woocommerce' ); ?></span>
									</label> -->
								</p>
								<p class="form-row woocommerce-LostPassword lost_password">
									<a class="account-lost-password-link" tabindex="4" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot Password?', 'woocommerce' ); ?></a>
								</p>
								<p class="form-row register-new-account">
									<a class="register-account-link" tabindex="5" href="<?php get_permalink(woocommerce_get_page_id('myaccount'))?>?action=register"><?php _e( 'New to the lalit? Register Now', 'woocommerce' ); ?></a>
								</p>
							</div>
							
							<?php do_action( 'woocommerce_login_form_end' ); ?>

						</form>
					</div>
				</div>
			</div>

		</div>

	</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php
}
?>
