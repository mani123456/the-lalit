<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

do_action( 'woocommerce_before_edit_account_form' ); ?>
<div class="account-personal-details">
	<div class="page-heading">
		<h2 class="personal-details-header bdr-bottom"><span class="bdr-bottom-gold">Personal Details</span></h2>
	</div>

	<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

		<div class="row">
			<div class="<?php if(isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col2<?php } ?> account-salutation">
				<p class="form-row form-row-wide validate-required myaccount-personal-details" id="account_salutation_field" data-priority="">
					<label for="account_salutation myaccount-personel-label">Salutation<abbr class="required checkout-required" title="required"></abbr></label>
					<select name="account_salutation" id="account_salutation" class="select" data-placeholder="Select Salutation">
						<option value="Mr" <?php if($user->salutation == 'Mr') { echo 'selected="selected"'; } ?>
							>Mr</option>
						<option value="Ms" <?php if($user->salutation == 'Ms') { echo 'selected="selected"'; } ?>>Ms</option>
						<option value="Mrs" <?php if($user->salutation == 'Mrs') { echo 'selected="selected"'; } ?>>Mrs</option>
					</select>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col col5 myaccount-personal-details-section">
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first myaccount-personal-details">
					<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?><abbr class="required checkout-required" title="required"></abbr></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" placeholder="Name" />
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last myaccount-personal-details">
					<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><abbr class="required checkout-required" title="required"></abbr></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" placeholder="Surname" />
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide myaccount-personal-details">
					<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?><abbr class="required checkout-required" title="required"></abbr></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" readonly value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="Email" />
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first myaccount-personal-details">
					<label for="account_phone"><?php _e( 'Phone Number', 'woocommerce' ); ?></label>
					<input type="tel" class="woocommerce-Input woocommerce-Input--text input-text input-less-width" name="account_phone" id="account_phone" value="<?php echo esc_attr( $user->phone ); ?>"/>
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last myaccount-personal-details">
					<label for="account_last_name"><?php _e( 'Date of Birth', 'woocommerce' ); ?></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text date-picker input-less-width" name="account_dob" id="account_dob" value="<?php echo esc_attr( $user->date_of_birth ); ?>" placeholder="Select Date" readonly/>
				</p>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide myaccount-personal-details">
					<label for="account_email"><?php _e( 'Marriage Anniversary', 'woocommerce' ); ?></label>
					<input type="text" class="woocommerce-Input input-text date-picker input-less-width" name="account_marriage_anv" id="account_marriage_anv" value="<?php echo esc_attr( $user->marriage_anniversary ); ?>" placeholder="Select Date" readonly/>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first myaccount-personal-details">
					<label for="account_first_name"><?php _e( 'City', 'woocommerce' ); ?></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-less-width" name="account_city" id="account_city" value="<?php echo esc_attr( $user->city ); ?>"/>
				</p>

				<?php
				$countries_obj = new WC_Countries();
				$countries = $countries_obj->get_allowed_countries();
				?>
				<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last myaccount-personal-details">
					<label for="account_last_name"><?php _e( 'Country', 'woocommerce' ); ?></label>
					<select name="account_country" id="account_country" class="country_to_state country_select country-dropdown country-details-dropdown" name="account_country" id="account_country" autocomplete="country" placeholder="Select a country">
						<option value="">Select a country</option>
						<?php
						foreach($countries as $key=>$value)
						{
						?>
							<option value="<?php echo $key; ?>" <?php if($user->country == $key) { echo 'selected="selected"'; } ?> ><?php echo $value; ?></option>
						<?php
						}
						?>
					</select>
				</p>

				<div class="clear"></div>
			</div>
		</div>

		<div class="row">
			<div class="col col5 change-password">
				<fieldset>
					<h5 class="myaccount-change-password-header"><?php _e( 'Change Password', 'woocommerce' ); ?></h5>

					<p class="myaccount-password-change-note">If you do not wish to change your password, please leave the following fields blank.</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide myaccount-personal-details">
						<label for="password_current"><?php _e( 'Current Password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current"/>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide myaccount-personal-details">
						<label for="password_1"><?php _e( 'New Password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1"/>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide myaccount-personal-details">
						<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2"/>
					</p>
				</fieldset>
				<div class="clear"></div>
			</div>
		</div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

		<p>
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="woocommerce-Button button myaccount-save-button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
