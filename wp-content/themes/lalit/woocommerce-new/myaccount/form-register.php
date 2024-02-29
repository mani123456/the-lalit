<?php
/**
 * Registration Form
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

<?php //do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_registration">

	<div class="u-column2 col-2">
		<div class="container">
			<div class="row">
				<div class="col col6 offsetBy3">
					<h2 class="align-center account-login-header">
						<?php _e( 'Register with The LaLiT', 'woocommerce' ); ?>
					</h2>

						<form method="post" class="register">

							<?php do_action( 'woocommerce_register_form_start' ); ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						       	<label class="register-labels" for="reg_account_first_name"><?php _e( 'Salutation', 'woocommerce' ); ?><span class="required"></span></label>
						       	<select class="account_salutaton country-dropdown select" name="account_salutation" autofocus tabindex="1">
						       		<option value="Mr" <?php if ( $_POST['account_salutation'] == 'Mr' )  echo esc_attr( 'selected' ); ?>>Mr</option>
						       		<option value="Ms" <?php if ( $_POST['account_salutation'] == 'Ms' )  echo esc_attr( 'selected' ); ?>>Ms</option>
						       		<option value="Mrs" <?php if ( $_POST['account_salutation'] == 'Mrs' )  echo esc_attr( 'selected' ); ?>>Mrs</option>
						       	</select>
						    </p>
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						       	<label class="register-labels" for="reg_account_first_name"><?php _e( 'First Name', 'woocommerce' ); ?><span class="required"></span></label>
						       	<input type="text" class="input-text" name="account_first_name" id="reg_account_first_name" tabindex="2" value="<?php if ( ! empty( $_POST['account_first_name'] ) ) echo esc_attr( $_POST['account_first_name'] ); ?>" placeholder="First Name"/>
						    </p>
						    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						       	<label class="register-labels" for="reg_account_last_name"><?php _e( 'Last Name', 'woocommerce' ); ?><span class="required"></span></label>
						       	<input type="text" class="input-text" name="account_last_name" id="reg_account_last_name" tabindex="3" value="<?php if ( ! empty( $_POST['account_last_name'] ) ) echo esc_attr( $_POST['account_last_name'] ); ?>" placeholder="Last Name" />
						    </p>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label class="register-labels" for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required"></span></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" tabindex="5" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?> "placeholder="Username"/>
								</p>

							<?php endif; ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label class="register-labels" for="reg_email"><?php _e( 'Email Address', 'woocommerce' ); ?><span class="required"></span></label>
								<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" tabindex="6" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?> "placeholder="Email Id" />
							</p>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide register-password-margin">
									<label class="register-labels" for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?><span class="required"></span></label>
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" tabindex="7" placeholder="Password"/>
								</p>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide register-password-margin">
									<label class="register-labels" for="reg_confirm_password"><?php _e( 'Confirm Password', 'woocommerce' ); ?><span class="required"></span></label>
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="confirm_password" tabindex="8" id="reg_confirm_password" placeholder="Confirm Password"/>
								</p>


							<?php endif; ?>

							<!-- Spam Trap -->
							<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

							<?php do_action( 'woocommerce_register_form' ); ?>

							<p class="woocomerce-FormRow form-row align-center">
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<input type="submit" class="woocommerce-Button button account-login-btn " tabindex="9" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
							</p>
							<p class="woocomerce-FormRow form-row align-center register-login-link">
							<a class="account-lost-password-link" tabindex="10" href="/my-account"><?php _e( 'Already a Member? Login Now', 'woocommerce' ); ?> </a>
							</p>

							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
				</div>
			</div>
		</div>
	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
