<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocomerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
	<div class="row">
<div class="<?php if(isMobile()) { ?>mob-col mob-col12<?php } else {?>col col6<?php } ?>">
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; ?>

			<p class="form-row form-row-first checkout-username">
				<label class="register-labels" for="username"><?php _e( 'Email address', 'woocommerce' ); ?></label>
				<input type="email" class="input-text checkout-username-input" name="username" id="username" placeholder="Enter your registered email id"/>
			</p>
			<p class="form-row form-row-last checkout-password">
				<label class="register-labels" for="password"><?php _e( 'Password', 'woocommerce' ); ?></label>
				<input class="input-text checkout-password-input" type="password" name="password" id="password" placeholder="Enter your password" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row checkout-login-section">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkout-rememberme-section">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox checkout-checkbox-rememberme" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<input type="submit" class="button checkout-login-btn" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
				
			</p>
			<p class="lost_password checkout-lost-password">
				<a class="checkout-password-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot password?', 'woocommerce' ); ?></a>
			</p>

			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>
</form>
