<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$email_heading = 'Reset Your Password ';
$user = get_user_by('email', $email->user_email);
$customer_obj = new WC_Customer($user->ID);
$account_salutation = get_user_meta($user->ID, 'salutation', true);
//$user_login = $customer_obj->display_name;
/**
 * @hooked the_lalit_email_header_callback Output the email header - 10
 * 
 */
do_action( 'the_lalit_email_header', $email_heading, $account_salutation, $customer_obj );


/**
 * @hooked the_lalit_email_body_callback Output the email header - 11
 * 
 */
do_action( 'the_lalit_email_body', $reset_key, $user_login );

$footer_text = "Please don't hesitate to contact us for any assistance:";

/**
 * @hooked the_lalit_email_body_callback Output the email header - 12
 * 
 */
do_action( 'the_lalit_email_footer', $footer_text );

/**
 * @hooked the_lalit_global_footer_callback Output the email header - 13
 * 
 */
do_action( 'the_lalit_email_reset_password_footer' );