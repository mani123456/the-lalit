<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
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
 * @version     3.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$email_heading = 'Welcome to The LaLiT!';
$user = get_user_by('email', $email->user_email);
//$customer_obj = new WC_Customer($user->ID);
$account_salutation = get_user_meta($user->ID, 'salutation', true);
$last_name = get_user_meta($user->ID, 'last_name', true);


/**
 * @hooked the_lalit_email_new_account_header_callback Output the email header - 10
 */
do_action( 'the_lalit_email_new_account_header', $email_heading, $account_salutation,$last_name );


/**
 * @hooked the_lalit_email_new_account_hotel_links_callback Output the hotel links - 11
 */
do_action( 'the_lalit_email_new_account_hotel_links');

/**
 * @hooked the_lalit_email_new_account_body_callback Output the hotel links - 12
 */
do_action( 'the_lalit_email_new_account_body');

/**
 * @hooked the_lalit_email_new_account_footer_callback Output the email header - 13
 * 
 */
do_action( 'the_lalit_email_new_account_footer' );